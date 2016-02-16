<?php

namespace Psg;

class Utils {

    public static function getDefaultLanguageByUser($user=null)
    {
        // KISS for now
        $user = empty($user) ? \Auth::user() : $user;
        $language = \Language::whereHas('user', function($q1) use($user) {
            $q1->where('user_id','=',$user->id);
        })->first();
        return $language;
    }

    public static function getDBNameByLanguageSlug($slug)
    {
        $dbname = 'll_'.$slug;
        return $dbname;
    }

    // if student, goes to university board
    public static function getDashboardURL($user=null)
    {
        $user = empty($user) ? \Auth::user() : $user;
        /*
        if ($user->hasRole('business')) {
            $redirectURL = route('business.dashboard.index');
        } else if ($user->hasRole('student')) {
            $univUGroup = $user->getUniversityUgroup();
            $redirectURL = route('site.boards.show',$univUGroup->slug);
        } else {
            $redirectURL = route('site.contact');
        }
         */
        $redirectURL = route('site.dashboard.show');
        return $redirectURL;
    }
    public static function redirectToDashboard($user=null)
    {
        $user = empty($user) ? \Auth::user() : $user;
        $redirectURL = self::getDashboardURL($user);
        return \Redirect::to($redirectURL);
    }

    public static function getHourSelectOptions($is24Period=1)
    {
        $options = [];
        if ($is24Period) {
            for ($i = 0 ; $i <= 23 ; $i++ ) {
                $options[$i] = sprintf('%02d', $i);
            }
        } else {
            // am/pm periods
            foreach ( [12,1,2,3,4,5,6,7,9,10,11] as $h) {
                $options[$h] = sprintf('%02d', $h);
            }
        }
        return $options;
    }
    public static function getMinuteSelectOptions()
    {
        $options = [];
        for ($i = 0 ; $i <= 59 ; $i++ ) {
            $options[$i] = sprintf('%02d', $i);
        }
        return $options;
    }

    public static function _formval($obj,$field)
    {
        if (empty($obj)) {
            return null;
        }
        /*
        if (empty($obj->{$field})) {
            throw new \Exception('field not found: '.$field);
            return null;
        }
         */
        $val = $obj->{$field};
        return empty($val) ? null : $val;
    }

    public static function currentMonthNum()
    {
        return date('m');
    }
    public static function currentYear()
    {
        return date('Y');
    }

    public static function fillUrlFromDomain($domain)
    {
        $url = 'http://www.'.$domain;
        return $url;
    }
    public static function parseDomainFromURL($url)
    {
        $urlParts = parse_url($url);
        $domain = preg_replace('/^www\./', '', $urlParts['host']); // remove www
        return $domain;
    }

    public static function getLaravelEnv()
    {
        $laravelEnv = null;

        if        ( !empty($_SERVER['SERVER_ADDR']) && ($_SERVER['SERVER_ADDR']=='127.0.0.1') ) {
            $laravelEnv = 'local';
        } else if ( !empty($_SERVER['HTTP_HOST']) && ($_SERVER['HTTP_HOST']=='www.dev-clssfy.com') )  {
            $laravelEnv = 'local';
        } else if (
            !empty($_SERVER['HTTP_HOST']) &&
            ( ($_SERVER['HTTP_HOST']=='www.clssfy.com') || ($_SERVER['HTTP_HOST']=='staging.clssfy.com')  )
        )
        {
            $laravelEnv = 'production';
        }
        return $laravelEnv;
    }


    public static function mixpanelIgnore()
    {
        $ignore = 0;
        if  (\Auth::guest()) {
            return $ignore; // this will not ignore them
        }
        $serverName = \Request::server ("SERVER_NAME");
        switch ($serverName) {
            case 'www.dev-clssfy.com':
            case 'staging.clssfy.com':
                $ignore = 1;
                break;
        }

        $user = \Auth::user();
        switch ($user->email) {
            case 'peter@peltronic.com':
            case 'peter@ucla.edu':
            case 'kevin1@ucsd.edu':
            case 'kky005@ucsd.edu':
            case 'thunderkate@ucsd.edu':
            case 'admin@ucsd.edu':
                $ignore = 1;
                break;
        }
        return $ignore;
    }

    public static function getJSRoutes()
    {
        $routes = [];
        $routeCollection = \Route::getRoutes();
        foreach ($routeCollection as $value) {
            $methods = $value->methods();
            foreach ($methods as $m) {
                if ($m != 'HEAD') {
                    $routes[$m.'.'.$value->getName()] = '/'.$value->getUri();
                }
            }
        }
        return $routes;
    }

    static public function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

        // trim
        $text = trim($text, '-');

        /*
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
         */

        // lowercase
        $text = strtolower($text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }  // slugify()

    static public function getValidationMessages($v)
    {
        $messages = [];
        foreach ($v->messages()->toArray() as $k => $m) {
            $messages[$k] = $m[0];
        }
        return $messages;
    }

	public static function getSelectOptions($model,$keyfield,$valfield)
    {
        $records = $model::get();
        $list = [];
        $list[''] = '';
        foreach ($records as $i => $r) {
            $k = $r->{$keyfield};
            $v = $r->{$valfield};
            $list[$k] = $v;
        }
        return $list;
    }
}
