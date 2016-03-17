<?php
namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;

class PagesController extends Controller {

    public function __construct()
    {
        parent::__construct();

        // must be after parent call!
        $this->registerJsLibs([
            //'/js/site/libs/bbSiteUtils.js',
         ]);
        $this->registerJsInlines([
            //'/js/site/initPortfolio.js',
         ]);
    }

    public function home()
    {
        $data = [
                  'contents'=>[],
                ];

        $parsedown = new \Parsedown();

        $tmp = \App\Content::where('slug','home-page-1')->pluck('content');
        $data['contents']['home-page-1'] = $parsedown->text($tmp[0]);
        //$data['contents']['home-page-1'] = $parsedown->text('Hello _Parsedown_!');
        //dd($tmp);
        return \View::make('site.pages.home',$data);
    }

    public function show($slug)
    {
        $data = [];
        switch ($slug) {
            case 'something-else':
                $viewFile = 'site.pages.'.$slug;
                break;
            case 'causes':
                $data['partners'] = \Partner::get();
                $viewFile = 'site.pages.'.$slug;
                break;
            case 'contact-us':
                $viewFile = 'site.pages.contact';
                break;
            case 'home':
                return redirect('/');
                break;
            default:
                //\App::abort(404);
                $viewFile = 'site.pages.'.$slug;
        }

        try {
            return \View::make($viewFile, $data);
        } catch (\Exception $e) {
            \App::abort(404);
        }

    } // show()

    public function contactConfirm()
    {
        return \View::make('site.pages.contact-confirm');
    } // contactConfirm()

}
