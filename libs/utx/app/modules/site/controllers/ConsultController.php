<?php
namespace UtSite;

class ConsultController extends BaseController {


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
        $validator = \Validator::make($attrs, \Consultrequest::$rules);
        try {
            $isOK = 1;
            if ($validator->fails()) {
                $isOK = 0;
            }

            if (!$isOK) {
                throw new \Exception('Validation failed');
            }

            $record = \Consultrequest::create($attrs);

if (1) {
            $precontent  = 'Message from '.$attrs['contact_name'].' (consult:'.$attrs['requesttype'].')';
            $precontent .= !empty($attrs['contact_phone']) 
                                ? ', phone number : '.$attrs['contact_phone']
                                : ', no phone number provided';
            $content = $attrs['contact_message'];

            \Mail::send('emails.support.request', ['precontent'=>$precontent,'content'=>$content], function($message) use($attrs) {
                    $to = [
                            'yuliya'=> 'y.chekmareva@utilitworx.com',
                            'peter' => 'peter@peltronic.com', // TEST ONLY %FIXME
                            'peter2' => 'peter.gorgone@gmail.com', // TEST ONLY %FIXME
                        ];
                    $from = $attrs['contact_email'];
                    $subject = $attrs['contact_topic'];

                    $message->from($from, $attrs['contact_name']);
                    $message
                        ->to($to['yuliya'])
                        //->to($to['peter'])
                        ->cc($to['peter2'])
                        ->subject($subject);
                    
                });
}
    
            $response = [
                        'is_ok'=>1,
                        'html'=>\View::make('site::consult._success')->render(),
                        ];

        } catch (\Exception $e) { 
            $code = $e->getCode();
            $messages = $validator->messages();
            $response = ['is_ok'=>0,'messages'=>$messages];
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
