<?php
namespace PsgSite;

class PagesController extends BaseController {

    public function __construct() 
    {
        $defaultTitle = '';
        $defaultDesc = '';
        parent::__construct(); // inits scripts

        // must be after parent call!
        $this->registerJsLibs([
         ]);
        $this->registerJsInlines([
         ]);

        $this->registerCssInlines([
         ]);
    }

    public function show($slug)
    {
        $data = [];
        switch ($slug) {
            case 'something-else':
                $viewFile = 'site::pages.'.$slug;
                break;
            case 'causes':
                $data['partners'] = \Partner::get();
                $viewFile = 'site::pages.'.$slug;
                break;
            case 'contact-us':
                $viewFile = 'site::pages.contact';
                break;
            default:
                //\App::abort(404);
                $viewFile = 'site::pages.'.$slug;
        }
            
        try {
            return \View::make($viewFile, $data);
        } catch (\Exception $e) {
            \App::abort(404);
        }

    } // show()

    public function contactConfirm()
    {
        return \View::make('site::pages.contact-confirm');
    } // contactConfirm()

}
