<?php

namespace Ll;

class EditlanguageComposer {

    public function compose($view)
    {
        $viewdata = $view->getData();

        $activeLanguage = \Language::getActive();
        $alSlug = empty($activeLanguage->slug) ? null : $activeLanguage->slug;

        $fb = new \Ll\FormBuilder(['api.widgets.setLanguage'],'POST','form-set_language',['form-set_language','form-generic']); 
	    $fb->addSelect('language','Set Language',\User::getSelectOptionsAvailLanguages(),$alSlug);

        if ( !empty($viewdata['submit_title']) ) {
            $fb->setSubmitTitle($viewdata['submit_title']);
        }

        $view->with('form', $fb);
    }

}
