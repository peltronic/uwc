<?php
namespace PsgSite;

class BaseController extends \Controller {

    protected $_jsMgr = null; // object
    protected $_cssMgr = null; // object
    protected $_php2jsVars = array();
    
    public function __construct()
    {
        // Check account status
        $this->beforeFilter('auth.suspended');

        $this->_cssMgr = new \CssManager();
        $this->_jsMgr = new \JsManager();

        // common to all site controllers
        $this->registerJsLibs([
            '/js/vendor/foundation/jquery.js',
            //'/js/vendor/foundation/fastclick.js',
            '/js/vendor/foundation/foundation.min.js',
            '/js/common/libs/clUtils.js',
         ]);

        $this->registerJsInlines([
            '/js/site/initCommon.js',
            //'/js/vendor/tag-it.min.js', 
         ]);

        $this->registerCssInlines([
            '/css/vendor/foundation/normalize.css',
            '/css/vendor/foundation/foundation.min.css',
            '//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css',
            '/css/vendor/webicons.css',
            '/css/site/base.css',
            '/css/site/common.css',
            '/css/site/styles.css',
            '/css/site/staticpages.css',
         ]);

        \View::share('g_user', \User::getUser());
        \View::share('g_php2jsVars',$this->_php2jsVars); // may be overridden in child
        \View::share('g_body_bg', 'default');
        
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
