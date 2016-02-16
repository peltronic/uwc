<!DOCTYPE html>
<html class="no-js" lang="en">

@include('layouts._head', [])

<body>

<div id="page-wrapper" class="layout-admin page-admin">

    <header id="mast_header" class="row">
        <div class="small-12 columns">
            <section id="main_nav" class="row">
                @include('layouts._mainNav', [])
            </section>
            <section class="row">
                <article class="small-12 columns">
                    <ul class="crate-nav_admin_tabs">
                        <li>{{ link_to_route('admin.home','Home',[],['class'=>'button tiny radius']) }}</li>
                        <li>{{ link_to_route('admin.messages.index','Messages',[],['class'=>'button tiny radius']) }}</li>
                        <li>{{ link_to_route('admin.ugroups.index','Groups',[],['class'=>'button tiny radius']) }}</li>
                        <li>{{ link_to_route('admin.universities.index','Universities',[],['class'=>'button tiny radius']) }}</li>
                        <li>{{ link_to_route('admin.pointtypes.index','Point Types',[],['class'=>'button tiny radius']) }}</li>
                        <li>{{ link_to_route('admin.rewards.index','Rewards',[],['class'=>'button tiny radius']) }}</li>
                        <li>{{ link_to_route('admin.users.index','Users',[],['class'=>'button tiny radius']) }}</li>
                        <li>{{ link_to_route('admin.businessprofiles.index','Business Profiles',[],['class'=>'button tiny radius']) }}</li>
                        <li>{{ link_to_route('admin.configs.index','Config',[],['class'=>'button tiny radius']) }}</li>
                    </ul>
                </article>
            </section>
        </div>
    </header>

    <div class="row container-admin_body">
        <aside class="large-3 columns tag-sidebar">
            @yield('sidebar')
        </aside>
        <div class="large-9 columns">
            @yield('content')
        </div>
    </div>

    <footer class="row tag-admin_footer">
        @include('layouts._footer', [])
    <footer>

</div>

<script type="application/javascript">
var g_php2jsVars = <?php echo json_encode($g_php2jsVars); ?>;
</script>

<?php
echo $g_jsMgr->renderLibs();
echo $g_jsMgr->renderInlines();
?>
<script>
  $(document).foundation();
</script>

</body>
</html>
