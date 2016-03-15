<?php
namespace PsgSite;

class ProfilesController extends BaseController {

    public function __construct()
    {
        parent::__construct();

        // must be after parent call!
        $this->registerJsLibs([
            //'/js/site/libs/bbSiteUtils.js',
         ]);
        $this->registerJsInlines([
            '/js/site/initProfile.js',
         ]);
    }

    public function show($username)
    {
        $user = empty($username) ? \Auth::user() : \User::where('username',$username)->firstOrFail();

        $data = [];
        $data['user'] = $user;
        $data['is_account_owner'] = $this->isAccountOwner($user->id);

        $data['my_stories'] = $my_stories = \Story::getMy($user);
        $data['my_chapters'] = $my_chapters = \Chapterversion::getMy($user);

        return \View::make('site::profile/show',$data);
    }

    public function stories($username)
    {
        $data = [];
        $data['user'] = $user = \User::where('username',$username)->firstOrFail();
        //$this->enforceAccountOwner($user->id);
        $data['is_account_owner'] = $this->isAccountOwner($user->id);

        $data['my_stories'] = $my_stories = \Story::getMy($user);

        return \View::make('site::profile/stories',$data);
    }

    public function chapters($username)
    {
        $data = [];
        $data['user'] = $user = \User::where('username',$username)->firstOrFail();
        //$this->enforceAccountOwner($user->id);
        $data['is_account_owner'] = $this->isAccountOwner($user->id);

        // %FIXME: chatper product vs version
        $data['my_chapters'] = $my_chapters = \Chapterversion::getMy($user);
        $data['my_chapterproducts'] = $my_chapterproducts = \Chapterproduct::getMy($user);

        return \View::make('site::profile/chapters',$data);
    }


    public function edit($username)
    {
        $data = [];
        $user = \User::where('username',$username)->firstOrFail();
        $data['user'] = $user = \User::where('username',$username)->firstOrFail();

        $this->enforceAccountOwner($user->id);

        $data['is_account_owner'] = $this->isAccountOwner($user->id);

        return \View::make('site::profile/edit',$data);
    }

    public function update($userID)
    {
        $user = \User::where('id',$userID)->firstOrFail();
        $this->enforceAccountOwner($user->id);

        $response = null;

        $attrs = \Input::all();

        unset($attrs['email']); // not editable

        $userRules = [
            'firstname'=>'alpha_dash_space',
            'lastname'=>'alpha_dash_space',
        ];
        $userValidator = \Validator::make($attrs, $userRules);

        try {
            $isOK = 1;
            $lmessages = [];
            if ($userValidator->fails()) {
                $isOK = 0;
                $lmessages = $userValidator->messages();
            }

            if (!$isOK) {
                throw new \Exception('Validation failed', EX_VALIDATION);
            }

            $user = \DB::transaction(function() use($attrs,$user) {

                // --- user record ---
                unset($user->password);
                $user->fill( $attrs ); // mass assignment
                $user->save();

                unset($user->password);
                unset($user->remember_token);
                return $user;
            });

            $response = ['is_ok'=>1,'obj'=>$user];

        } catch (\Exception $e) { 
            $code = $e->getCode();
            if ($code == EX_VALIDATION) {
                $messages = $lmessages;
            } else {
                throw $e;
            }
            $response = ['is_ok'=>0,'messages'=>$messages];
        }

        if (\Request::ajax()) {
            return \Response::json($response);
        } else {
            if ($response['is_ok']) {
                return \Redirect::route('site.profiles.show',[$user->username]);
            } else {
                return \Redirect::back()->withErrors($userValidator)->withInput(); // %FIXME: merge errors
            }
        }

    } // update()


    public function editPassword($username)
    {
        $data = [];
        $data['user'] = $user = \User::where('username',$username)->firstOrFail();
        
        $this->enforceAccountOwner($user->id);
        $data['is_account_owner'] = $this->isAccountOwner($user->id);

        return \View::make('site::profile/edit_password',$data);
    }

    public function updatePassword($username)
    {
        $user = \User::where('username',$username)->firstOrFail();
        $this->enforceAccountOwner($user->id);

        $response = null;

        $attrs = [];
        $attrs['password'] = \Input::get('password');
        $attrs['password_confirmation'] = \Input::get('password_confirmation');

        $rules = [];
        $rules['password'] = 'required|confirmed|min:8';
        //$rules['password_confirmation'] = 'required|min:8';
        $userValidator = \Validator::make($attrs, $rules);

        try {
            $isOK = 1;
            $lmessages = [];
            if ($userValidator->fails()) {
                $isOK = 0;
                $lmessages = $userValidator->messages();
            }

            if (!$isOK) {
                throw new \Exception('Validation failed', EX_VALIDATION);
            }

            $user = \DB::transaction(function() use($attrs,$user) {

                // --- user record ---
                $user->password = \Hash::make($attrs['password']);
                $user->save();

                unset($user->password);
                unset($user->remember_token);
                return $user;
            });

            $response = ['is_ok'=>1,'obj'=>$user];

        } catch (\Exception $e) { 
            $code = $e->getCode();
            if ($code == EX_VALIDATION) {
                $messages = $lmessages;
            } else {
                $messages = array($e->getMessage());
            }
            $response = ['is_ok'=>0,'messages'=>$messages];
        }

        if (\Request::ajax()) {
            return \Response::json($response);
        } else {
            if ($response['is_ok']) {
                return \Redirect::route('site.profiles.show',[$user->username]);
            } else {
                return \Redirect::back()->withErrors($userValidator)->withInput(); // %FIXME: merge errors
            }
        }
    } // updatePassword()

    protected function isAccountOwner($pkid)
    {
        $sessionUser = \Auth::user();
        $is = ($pkid == $sessionUser->id);
        return $is;
    }

    protected function enforceAccountOwner($pkid)
    {
        $sessionUser = \Auth::user();
        if ($pkid != $sessionUser->id) {
            \App::abort(403, 'Unauthorized action.');
            
        }
        return;
    }


}
