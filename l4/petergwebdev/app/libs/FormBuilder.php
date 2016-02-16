<?php

namespace Psg;

class FormBuilder {

    protected $_route = null;
    protected $_method = null;
    protected $_id = null;
    protected $_classes = [];
    protected $_openConfig = [];
    protected $_elems = [];
    protected $_customs = [];
    protected $_cancel = [];

    public function __construct($route,$method='GET',$id,$classes=[],$datas=[]) 
    {
        $this->_route = $route;
        $this->_method = $method;

        $this->_openConfig = ['route'=>$this->_route, 'method'=>$this->_method,'id'=>$id];

        foreach ($classes as $c) {
            $this->_classes[] = $c;
        }
        $this->_openConfig['class'] = implode(' ',$this->_classes);

        $this->_customs = [
            'submit_title'=>'Submit',
            'submit_classes'=>['tag-clickme_to_submit button tiny radius'],
        ];
    }

	public function addSelect($name,$label,$options=[],$default=null,$id=null,$classes=[],$datas=[],$placeholder='')
    {
        $elem = [
            'type'    => 'select',
            'label'    => \Form::label($name,$label),
            'obj'      => \Form::select($name,$options,$default,['placeholder'=>$placeholder,'class'=>$this->renderClasses($classes)]),
            'errhook'  => '<div class="tag-verr tag-'.$name.'_verr"></div>',
        ];
        $this->_elems[] = $elem;
    }

	public static function processSubmitAjax($attrs=[],$rules=[],$cbFunc=null)
    {
        $validator = \Validator::make($attrs, $rules);

        try {
            if ($validator->fails()) {
                throw new \Exception('Validation failed', LLEX_VALIDATION);
            }

            if (is_callable($cbFunc)) {
                // Autoloading will be invoked to load the class "ClassName" if it's not
                // yet defined, and PHP will check that the class has a method
                // "someStaticMethod". Note that is_callable() will NOT verify that the
                // method can safely be executed in static context.
            
                //$response = call_user_func($cbFunc, $arg1, $arg2);
                $response = call_user_func($cbFunc, $attrs);
            } else {
                $response = ['is_ok'=>1];
            }

        } catch (\Exception $e) { 
            $ecode = $e->getCode();
            switch ($ecode) {
                case LLEX_VALIDATION:
                    $messages = $validator->messages();
                    $meta = [];
                    break;
                default:
                    $messages = [];
                    $meta['other'] = $e->getMessage();
            }
            $response = ['is_ok'=>0,'messages'=>$messages,'meta'=>$meta];
        }
        return $response;
    }

	public function render()
    {

        $html = '';
        $html .= \Form::open($this->_openConfig);

        foreach ($this->_elems as $e) {
            $html .= $this->renderElem($e);
        }
        $html .= \Form::submit($this->_customs['submit_title'], ['class'=>implode(' ',$this->_customs['submit_classes'])]);
        if ( count($this->_cancel) ) {
            //$html .= link_to_route('site.profiles.show','Cancel',[$user->id],['class'=>'tag-clickme_to_cancel button small radius secondary']); // %TODO
        }
        $html .= \Form::close();
        return $html;
    }

    public function setSubmitTitle($str) 
    {
        $this->_customs['submit_title'] = $str;
    }
    public function setSubmitClasses($classes) 
    {
        $this->_customs['submit_classes'] = $classes;
    }


	protected function renderClasses($classArray)
    {
        return implode(' ',$classArray);
    }

	protected function renderElem($elem)
    {
        $html = '';
        $html .= $elem['label'];
        $html .= $elem['obj'];
        $html .= $elem['errhook'];
        return $html;
    }

}

    /*
	public static function getCountrySelectOptions()
    {
        $countries = \Country::get();
        $countryList = [];
        //$countryList[''] = '';
        foreach ($countries as $i => $c) {
            $k = $c->name;
            $v = $c->name;
            $countryList[$k] = $v;
        }
        return $countryList;
    }
     */
