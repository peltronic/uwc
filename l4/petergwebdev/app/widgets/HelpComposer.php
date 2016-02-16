<?php

namespace Ll;

class HelpComposer {

    public function compose($view)
    {
        $viewdata = $view->getData();
        $data = [];
        
        switch ($viewdata['slug']) {
            case 'dashboard':
                $data['header'] = 'Dashboard Help';
                $data['body'] = 'Copy and paste any chunk of text in the language you are studying in the box, then click the red "Save" button to use the vocabulary tool. If you would like to use our pre-defined content, you can browse and choose lessons in the '.link_to_route('materials.index','Read Menu').'.';
                break;
            case 'vocablist':
                $data['header'] = 'Vocab List Help';
                $data['body'] = 'In the vocabulary list below, click the upload icon to add a translation for a word. Click the tool icon to edit a translation or highligh the word in the text';
                break;
            default:
                $data['header'] = 'Help';
                $data['body'] = '...generic help...';
        }
        $view->with($data);
    }

}
