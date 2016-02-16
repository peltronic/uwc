<?php
$isLoggedIn = !\Auth::guest();
if ($isLoggedIn ) {
    $isAdmin = \Auth::user()->can('access_admin');
    $user = \Auth::user();
    $numNotify = $user->countNotifications();
    if ($numNotify>0) {
        $notifyHtml = '<span>Me</span><span id="box-cartcount" class="numberCircle">'.$numNotify.'</span>';
    } else {
        $notifyHtml = '<span>Me</span>';
    }
} else {
    $isAdmin = 0;
    $user = null;
}
?>
<nav class="top-bar" data-topbar role="navigation" data-options="is_hover: false">
  <ul class="title-area">
      <li class="tag-nonicon">
      @if ($isLoggedIn and $user->hasRole('student'))
      {{ \Cl\ViewHelpers::linkToRouteWithImg('site.boards.show', '/img/clssfy-logo-white.png','clssfy logo' ,['class'=>'tag-mainlogo'],['class'=>'box-mainlogo'],[$user->getUniversityUgroup()->slug] ) }}
      @else
      {{ \Cl\ViewHelpers::linkToWithImg('/', '/img/clssfy-logo-white.png','clssfy logo' ,['class'=>'tag-mainlogo'],['class'=>'box-mainlogo'] ) }}
      @endif
      @if ($isLoggedIn)
       @if ($user->hasRole('student'))
      <h1 class="tag-name">{{{ \Auth::user()->username }}} (<span class="tag-broadcast-session_user_net_points">{{link_to_route('rewards.index',\Cl\PointManager::netByUserID($user->id))}}</span>)</h1>
      @elseif($user->hasRole('business'))
      <h1 class="tag-name">{{{ \Auth::user()->username }}} ({{{$user->businessprofile->business_name}}})</h1>
       @else
      <h1 class="tag-name">{{{ \Auth::user()->username }}}</h1>
       @endif
      @endif
      </li>
      </li>
     <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
     <li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
  </ul>

  <section class="top-bar-section">
    <!-- Right Nav Section -->
    <ul class="right">
{{--
      @if ($isLoggedIn)
       @if ($user->hasRole('student'))
      <li class="name OFF-tag-user_greeting"><h1 class="tag-name">{{{ \Auth::user()->username }}} (<span class="tag-broadcast-session_user_net_points">{{link_to_route('rewards.index',\Cl\PointManager::netByUserID($user->id))}}</span>)</h1></li>
       @else
      <li class="name OFF-tag-user_greeting"><h1 class="tag-name">{{{ \Auth::user()->username }}}</h1></li>
       @endif
      @else
        <li class="name OFF-tag-user_greeting"></li>
      @endif
--}}
    </ul>

    <!-- Left Nav Section -->
    <ul class="left">
        @if ($isLoggedIn)
            @if ($isAdmin)
                <li>{{ link_to_route('admin.home','Admin Panel') }}</li>
            @endif
            @if ($user->hasRole('business'))
            <li>{{ link_to_route('business.dashboard.index','Dashboard',null) }}</li>
            <li>{{ link_to_route('business.profiles.show','My Profile',[$user->username]) }}</li>
            <li>{{ link_to_route('business.rewards.showRedeem','Redeem') }}</li>
            @endif
            @if ($user->hasRole('student'))
            <li>{{ link_to_route('site.boards.world','World') }}</li>
            <li>{{ link_to_route('site.boards.show','University',$user->getUniversityUgroup()->slug) }}</li>
            <li>{{ link_to_route('site.ugroups.index','Groups') }}</li>
            {{--<li>{{ link_to_route('site.boards.my','Me',[$user->username]) }}</li>--}}
            {{--<li class="tag-notify_icon has-dropdown">{{ \Cl\ViewHelpers::linkToRouteWithHtml('site.notifications.index',$notifyHtml,[],[]) }}</li>--}}
            <li class="tag-notify has-dropdown">
                <a href="#">{{$notifyHtml}}</a>
                <ul class="dropdown">
                    <li>{{link_to_route('site.boards.my','My Board',[$user->username])}}</li>
                    <li>{{link_to_route('site.profiles.show','My Profile',[$user->username])}}</li>
                    <li>{{link_to_route('site.notifications.index','My Notifications',[$user->username])}}</li>
                </ul>
            </li>
            @endif
            <li>{{ link_to_route('site.dologout','Logout') }}</li>
            {{--<li class="tag-notify_icon">{{ \Cl\ViewHelpers::linkToRouteWithHtml('site.notifications.index',$notifyHtml,[],[]) }}</li>--}}
        @else
            <li>{{ link_to('/','Home') }}</li>
            <li>{{ link_to_route('site.showlogin','Login') }}</li>
            <li>{{ link_to_route('site.showregister','Sign Up') }}</li>
            <li>{{ link_to_route('business.home','Business?') }}</li>
        @endif
    </ul>
  </section>
</nav>
