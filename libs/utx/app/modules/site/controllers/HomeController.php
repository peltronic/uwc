<?php
namespace UtSite;

class HomeController extends BaseController {

    public function __construct()
    {
        parent::__construct();

        // must be after parent call!
        $this->registerJsLibs([
            //'/js/site/libs/clSiteUtils.js',
         ]);
        $this->registerJsInlines([
            //'/js/site/initAuth.js',
            //'/js/site/initHome.js',
         ]);
    }


	public function show()
	{
        $data = [];
        \View::share('g_body_tag', 'home');
        return \View::make('site::home/index',$data);
	} // show()


}
