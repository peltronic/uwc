<?php
namespace Psg;

class ViewHelpers {

    public static function classes($classArray)
    {
        return implode(' ',$classArray);
    }

    // toggle sort param 'asc'<->'desc'
    public static function toggleSortParam($p)
    {
        return ($p=='desc') ? 'asc' : 'desc';
    }

    public static function parseDate($datetimeStr)
    {
        //$datetime = "1999-10-20 23:15:30"; 
        $dt = strtotime($datetimeStr);
        return date("m/d/Y", $dt);
    }

    public static function renderUserNameOnMap($user,$code)
    {
        $str = null;
        if (   $user->is_name_display_enabled 
            && \Rs\CodeManager::isNameDisplayEnabledByCode($user,$code) 
        ) {
            $str = trim(self::renderUserFullname($user));
        }
        $str = empty($str) ? '&nbsp;' : $str;
        return $str;
    }

    public static function renderLocationOnMap($codelocation)
    {
        $str = trim(self::getLocationStr($codelocation));
        $str = empty($str) ? '&nbsp;' : $str;
        return $str;
    }

    public static function renderUserFullname($user)
    {
        $str = $user->firstname.' '.$user->lastname;
        return $str;
    }

    public static function linkToRouteWithHtml($route,$html,$params=[],$attrs=[])
    {
        $html = html_entity_decode( 
                                    link_to_route( 
                                        $route,
                                        $html,
                                        $params,
                                        $attrs
                                    ) 
                                  );
        return $html;
    }

    public static function linkToWithHtml($url,$html,$attrs=[])
    {
        $html = html_entity_decode( 
                                    link_to( 
                                        $url,
                                        $html,
                                        $attrs
                                    ) 
                                  );
        return $html;
    }

    public static function linkToRouteWithImg($route,$imgPath,$imgAlt,$imgAttrs=[],$linkClasses=[])
    {
        $html = html_entity_decode( 
                                    link_to_route( 
                                        $route,
                                        \HTML::image(
                                            $imgPath,
                                            $imgAlt,
                                            $imgAttrs //array('class'=>'tag-usericon'), array( 'width' => 70, 'height' => 70 )
                                        ) 
                                    ) 
                                  );
        return $html;
    }

    public static function linkToWithImg($url,$imgPath,$imgAlt,$imgClasses=[],$linkClasses=[])
    {
        $html = html_entity_decode( 
                                    link_to( 
                                        $url,
                                        \HTML::image(
                                            $imgPath,
                                            $imgAlt,
                                            $imgClasses //array('class'=>'tag-usericon')
                                        ), 
                                        $linkClasses
                                    ) 
                                  );
        return $html;
    }

    public static function renderOddClass($isOdd) {
        $str = $isOdd ? 'tag-odd' : 'tag-even';
        return $str;
    }

    // %FIXME: un-hardcode base urls
    public static function renderSocialMediaLinks($user) {
        $html = '';
        if (!$user->is_name_display_enabled) {
            $html = '&nbsp;';
            return $html;
        }
        if (!empty($user->facebook_url)) {
            //$html .= link_to($user->facebook_url,'Facebook',['class'=>'webicon facebook']);
            $html .= self::linkToWithImg($user->facebook_url,'/img/facebook-icon.png','Facebook',['class'=>'tag-facebook']);
        }
        if (!empty($user->twitter_handle)) {
            //$html .= link_to('http://www.twitter.com/'.$user->twitter_handle,'Twitter',['class'=>'webicon twitter']);
            $html .= self::linkToWithImg($user->twitter_handle,'/img/twitter-icon.png','Twitter',['class'=>'tag-twitter']);
        }
        if (!empty($user->instagram_handle)) {
            //$html .= link_to('http://www.instagram.com/'.$user->instagram_handle,'Instagram',['class'=>'webicon instagram']);
            $html .= self::linkToWithImg($user->instagram_handle,'/img/instagram-icon.png','Instagram',['class'=>'tag-instagram']);
        }
        if (!empty($user->snapchat_handle)) {
            //$html .= '<span data-tooltip aria-haspopup="true" class="has-tip" title="'.$user->snapchat_handle.'">[NEED .PNG]</span>';
            $html .= '<span data-tooltip aria-haspopup="true" class="has-tip" title="'.$user->snapchat_handle.'"><img src="/img/snapchat-icon.png" class="tag-snapchat" alt="Snapchat"></span>';
        }
        return $html;
    }

}
