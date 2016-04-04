<?php
namespace UtSite;

class SupportController extends BaseController {


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

        $validator = \Validator::make($attrs, \Supportemail::$rules);

        try {
            $isOK = 1;
            if ($validator->fails()) {
                $isOK = 0;
            }

            if (!$isOK) {
                throw new \Exception('Validation failed');
            }

    
            $record = \Supportemail::create([
                            'from_email'=>$attrs['from_email'],
                            'from_name'=>$attrs['from_name'],
                            'subject'=>$attrs['subject'],
                            'body'=>$attrs['content'],
                    ]);
    
if (1) {
            $precontent = 'Message from '.$attrs['from_name'].' (support)';
            $content = $attrs['content'];

            \Mail::send('emails.support.request', ['precontent'=>$precontent,'content'=>$content], function($message) use($attrs) {
                    $to = [
                            'yuliya'=> 'y.chekmareva@utilitworx.com',
                            'peter' => 'peter@peltronic.com', // TEST ONLY %FIXME
                            'peter2' => 'peter.gorgone@gmail.com', // TEST ONLY %FIXME
                        ];
                    $from = $attrs['from_email'];
                    $subject = $attrs['subject'];

                    $message->from($from, $attrs['from_name']);
                    $message
                        ->to($to['yuliya'])
                        //->to($to['peter'])
                        ->cc($to['peter2'])
                        ->subject($subject);
                    
                });
}
            $response = [
                        'is_ok'=>1,
                        'html'=>\View::make('site::support._success')->render(),
                        ];

        } catch (\Exception $e) { 
            //throw $e;
            $code = $e->getCode();
            $messages = $validator->messages();
            $response = ['is_ok'=>0,'messages'=>$messages];
            //return \Redirect::back()->withErrors($validator)->withInput();
        }

        return \Response::json($response);

    } // store()

}

/* this is what replaces it via ajax 
views.py: HelperFunctions.sendEmail(request,form_class_fhalf,form_class_shalf)
utils.py: 
specialfordotemail = "y.chekmareva@utilitworx.com"
*/
//
