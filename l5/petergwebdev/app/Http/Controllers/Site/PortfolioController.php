<?php
namespace App\Http\Controllers\Site;

use Validator;
use App\Http\Controllers\Controller;

class PortfolioController extends Controller {

    public function __construct()
    {
        parent::__construct();

        // must be after parent call!
        $this->registerJsLibs([
            //'/js/site/libs/bbSiteUtils.js',
         ]);
        $this->registerJsInlines([
            '/js/site/initPortfolio.js',
         ]);
    }

    public function index()
    {
        $data = [];
        //$data['user'] = $user = \User::where('username',$username)->firstOrFail();
        //$this->enforceAccountOwner($user->id);
        //$data['is_account_owner'] = $this->isAccountOwner($user->id);

        //$data['my_stories'] = $my_stories = \Story::getMy($user);

        return \View::make('site.portfolio/index',$data);
    }


}
