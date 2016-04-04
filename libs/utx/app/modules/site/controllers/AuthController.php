<?php
namespace ClSite;

// http://laravelbook.com/laravel-user-authentication/
// http://code.tutsplus.com/tutorials/authentication-with-laravel-4--net-35593
// http://scotch.io/tutorials/simple-and-easy-laravel-login-authentication
// http://stackoverflow.com/questions/3521290/logout-get-or-post

class AuthController extends BaseController {

    protected $_lmessages; // hack until we encapsualte this to its own class

    public function __construct()
    {
        $this->_lmessages = array();

        parent::__construct();

        // must be after parent call!
        $this->registerJsLibs([
            //'/js/site/libs/clSiteUtils.js',
         ]);
        $this->registerJsInlines([
            '/js/site/initAuth.js',
         ]);
    }

    public function doLogout() {
        \Auth::logout();
        return \Redirect::route('site.showlogin')->with('message', 'You are now logged out!');
    }

    public function showLogin()
    {
        if ( \Auth::user() ) {
            return \Redirect::route('site.home');
        }
        return \View::make('site::auth.login');
    }


    public function doLogin()
    {
        $user = null;

        $attrs = \Input::all();
        unset($attrs['_trackcode']);

        $rules = [
            'password'=>'required',
            'email'=>'required|email',
        ];

        $validator = \Validator::make($attrs, $rules);

        $response = ['is_ok'=>0];

        try {

            if ($validator->fails()) {

                $this->_lmessages = $validator->messages();
                throw new \Exception('Validation failed', CLEX_VALIDATION);

            } else {

                $credentials = [
                                'email' => $attrs['email'],
                                'password' => $attrs['password'],
                                'is_confirmed' => 1, // require confirmation to login
                               ];
                if ( \Auth::attempt($credentials) ) {
                    // login successful!
                    $user = \Auth::user();
                } else {        
                    $user = \User::where('email','=',$attrs['email'])->first();
                    if ( !empty($user) && !$user->is_confirmed ) {
                        throw new \Exception('Login failed', CLEX_UNCONFIRMED_ACCOUNT); // user exists but not confirmed
                    } else {
                        throw new \Exception('Login failed', CLEX_INVALID_CREDENTIALS);
                    }
                }
            }

        } catch (\Exception $e) {        

            // validation not successful, send back to form 
            $ecode = $e->getCode();
            switch ($ecode) {
                case CLEX_VALIDATION:
                    $messages = $validator->messages();
                    $metaError = null;
                    break;
                case CLEX_INVALID_CREDENTIALS:
                    $messages = [];
                    $metaError = 'Incorrect username and/or password';
                    break;
                case CLEX_UNCONFIRMED_ACCOUNT:
                    $messages = [];
                    $metaError = 'Account has not been confirmed. Please check your email inbox for confirmation email.';
                    break;
                default:
                    $metaError = $e->getMessage();
            }
            if (!\Request::ajax()) {
                if ( !empty($metaError) ) {
                    \Session::set('meta_error',$metaError);
                }
                return \Redirect::back()
    	                    ->withErrors($validator)
    	                    ->withInput(\Input::except('password'));
            } else {
                $response = ['is_ok'=>0,'messages'=>$messages,'meta_errors'=>[$metaError]];
                return \Response::json($response);
            }
        } // try-catch

        if ($user->hasRole('business')) {
            $redirectURL = route('business.rewards.showRedeem');
        } else {
            $redirectURL = \Cl\Utils::getDashboardURL();
        }

        if (!\Request::ajax()) {
            return \Redirect::to($redirectURL);
        } else {
            unset($user->password);
            $response = [ 'is_ok'=>1, 'redirect_url'=>$redirectURL, 'obj'=>$user ];
            return \Response::json($response);
        }
    } // doLogin()

    public function showRegister()
    {
        if ( \Auth::user() ) {
            return \Redirect::route('site.home');
        }
        return \View::make('site::auth.register');
    }


    public function doRegister()
    {
        $attrs = \Input::all();

        try {
            // Set input validation rules 
            $rules = [];
            $rules['email'] = 'required|email|unique:users';
            $rules['username'] = 'required|alpha_dash|unique:users';
            $rules['password'] = 'required|min:8';

            $validator = \Validator::make($attrs, $rules);

            if ( $validator->fails() ) {
                throw new \Exception('Validation failed', CLEX_VALIDATION);
            }

            $user = \DB::transaction(function() use($attrs) {
                $user = new \User;
                $user->email = $attrs['email'];
                $user->username = $attrs['username'];
                $user->password = \Hash::make($attrs['password']);
                $user->is_confirmed = 1; // confirm them for testing purposes
                $user->confirmation_code = str_random(30);
                $user->save();

                // match the email against known univeristy email suffixes...
                $domain = substr(strrchr($user->email, "@"), 1);
                //$university = \University::where('url',$domain)->firstOrFail();
                // The ugroup for the unversity-wide, not a class
                $ugroup = \Ugroup::whereHas('university', function($q) use ($domain) {
                    $q->where('url','=',$domain);
                })->where('course_id','=',NULL)->first();

                if( empty($ugroup) ) {
                    throw new \Exception('Could not locate university with domain: '.$domain);
                }

                $id = \DB::table('ugroup_user')->insertGetId(
                    ['user_id'=>$user->id, 'ugroup_id' => $ugroup->id]
                );

                // Add student role
                $role = \Role::where('name','=','student')->firstOrFail();
                $roleID = \DB::table('assigned_roles')->insertGetId(
                    ['user_id' => $user->id, 'role_id' => $role->id]
                );

                \Cl\PointManager::recordPointsByUser($user->id,'signup');

                return $user;
            });

            // Send verification email
if (0) {
    // skip for now, as we don't want emails being sent to random students while testing
            \Mail::send('emails.auth.verify', ['confirmation_code'=>$user->confirmation_code], function($message) use($user) {
                $message->to($user->email, $user->username)->subject('Please Verify Clssfy Account');
            });
}

            $redirectURL = route('site.showlogin'); // override below if we login

            // Try to log in the user that just registered
            $credentials = [
                            'email' => $attrs['email'],
                            'password' => $attrs['password'],
                            'is_confirmed' => 1, // require confirmation to login
                           ];
            if ( \Auth::attempt($credentials) ) {
                // login successful!
                $redirectURL = \Cl\Utils::getDashboardURL(); // will go to univ board if student
            } else {        
                throw new \Exception('Login failed', CLEX_INVALID_CREDENTIALS);
            }

        } catch (\Exception $e) {        

            // validation not successful, send back to form 
            $ecode = $e->getCode();
            switch ($ecode) {
                case CLEX_VALIDATION:
                    $messages = $validator->messages();
                    $metaError = null;
                    break;
                case CLEX_INVALID_CREDENTIALS:
                    $messages = [];
                    $metaError = $e->getMessage();
                    break;
                default:
                    $messages = [];
                    $metaError = $e->getMessage();
            }
            if (!\Request::ajax()) {
                if ( !empty($metaError) ) {
                    \Session::set('meta_error',$metaError);
                }
                return \Redirect::back()
    	                    ->withErrors($validator)
    	                    ->withInput(\Input::except('password'));
            } else {
                $response = ['is_ok'=>0,'messages'=>$messages,'meta_errors'=>[$metaError]];
                return \Response::json($response);
            }

        } // try-catch

        if (!\Request::ajax()) {
            return \Redirect::to($redirectURL);
        } else {
            unset($user->password);
            $response = [ 'is_ok'=>1, 'redirect_url'=>$redirectURL, 'obj'=>$user, 'is_business'=>0 ];
            return \Response::json($response);
        }

    } // doRegister()

    public function showVerify()
    {
        return \View::make('site::auth.verify');
    }

    public function doVerify($confirmationCode)
    {
        if( empty($confirmationCode) ) {
            throw new \InvalidConfirmationCodeException;
        }

        $user = \User::where('confirmation_code','=',$confirmationCode)
                     ->where('is_confirmed','=',0)
                     ->firstOrFail();
        $user->is_confirmed = 1;
        $user->confirmation_code = null;
        $user->save();

        \Session::flash('message','You have successfully verified your account.');
        return \Redirect::route('site.showlogin');
    }

}
