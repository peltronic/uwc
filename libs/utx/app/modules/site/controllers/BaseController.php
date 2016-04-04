<?php
namespace UtSite;

class BaseController extends \Controller {

    protected $_jsMgr = null; // object
    protected $_cssMgr = null; // object
    protected $_php2jsVars = array();
    
    
    public function __construct()
    {
        $this->_cssMgr = new \Ut\CssManager();
        $this->_jsMgr = new \Ut\JsManager();

        // Check for active account
        /*
        $user = \Auth::user();
        if ( !empty($user) && $user->is_active != 1 ) {
            \Auth::logout();
            return \Redirect::route('site.showlogin')->with('message', 'You are now logged out!');
        }
         */

        // common to all site controllers
        $this->registerJsLibs([
            '/vendor/foundation-6/js/vendor/jquery.min.js',
            '/vendor/foundation-6/js/vendor/what-input.min.js',
            '/vendor/foundation-6/js/foundation.min.js',
            '/js/site/libs/mag-popup.js',
            '/js/site/libs/siteUtils.js',
         ]);

        $this->registerJsInlines([
            '/js/site/initNav.js',
            '/js/site/initForms.js',
         ]);

        $this->registerCssInlines([
            '/vendor/foundation-6/css/normalize.css',
            '/vendor/foundation-6/css/foundation.min.css',
            '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
            '/css/vendor/webicons.css',
            //'/css/site/base.css',
            '/css/site/mag-popup.css',
            '/css/site/styles.css',
            //'/css/site/dividers-orig.css',
            '/css/site/dividers.css',
            '/css/site/responsive.css',
         ]);

        //\View::share('g_user', \User::getUser());
        \View::share('g_php2jsVars',$this->_php2jsVars); // may be overridden in child
        \View::share('g_body_tag', 'default');
        
        return;
    }

	protected function setupLayout()
	{
		if ( !is_null($this->layout))
		{
			$this->layout = \View::make($this->layout);
		}
	}

    // Can be called multiple times
    public function registerJsLibs($libPaths=array())
    {
        foreach ($libPaths as $l) {
            $this->_jsMgr->pushLib($l);
        }
        \View::share('g_jsMgr',$this->_jsMgr);
    }
    public function registerJsInlines($inlinePaths=array())
    {
        foreach ($inlinePaths as $l) {
            $this->_jsMgr->pushInline($l);
        }
        \View::share('g_jsMgr',$this->_jsMgr);
    }

    public function registerCssInlines($inlinePaths=array())
    {
        foreach ($inlinePaths as $l) {
            $this->_cssMgr->pushInline($l);
        }
        \View::share('g_cssMgr',$this->_cssMgr);
    }

}
