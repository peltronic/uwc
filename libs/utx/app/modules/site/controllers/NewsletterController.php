<?php
namespace UtSite;

class NewsletterController extends BaseController {

    public function __construct()
    {
        parent::__construct();
    }

    // Store support request
	public function store()
	{
        if (!\Request::ajax()) {
            throw new \Exception('Requires AJAX');
        }

        $attrs = \Input::all();
        $validator = \Validator::make($attrs, \Subscriber::$rules);
        try {
            $isOK = 1;
            if ($validator->fails()) {
                $isOK = 0;
            }

            if (!$isOK) {
                throw new \Exception('Validation failed');
            }

            $message = \Subscriber::create([
                            'email'=>$attrs['email'],
                    ]);
    
            $response = [
                        'is_ok'=>1,
                        'html'=>\View::make('site::newsletter._success')->render(),
                        ];

        } catch (\Exception $e) { 
            $code = $e->getCode();
            $messages = $validator->messages();
            $response = ['is_ok'=>0,'messages'=>$messages];
            //return \Redirect::back()->withErrors($validator)->withInput();
        }

        return \Response::json($response);

    } // store()

}

