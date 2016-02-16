<!DOCTYPE html>
<html class="no-js" lang="en">

@include('layouts._head', [])

<body class="tag-default">

<div id="page-wrapper" class="layout-site row">
    <div class="small-12 columns">
        @include('layouts._header', [])
        @yield('content')
        @include('layouts._footer', [])
    </div>
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

@include('layouts._jsroutes', [])

</body>
</html>
