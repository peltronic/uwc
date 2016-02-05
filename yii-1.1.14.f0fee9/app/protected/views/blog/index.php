<?php
spl_autoload_unregister(array('YiiBase', 'autoload'));
$this->pageTitle=Yii::app()->name . ' | Blog';
define('WP_USE_THEMES', false);
require('../wordpress/wp-blog-header.php');

$posts = get_posts('numberposts=10&order=ASC&orderby=post_title');
foreach ($posts as $post) {
    setup_postdata( $post );
    the_date(); 
    echo "<br />";
    the_title();
    the_excerpt();
}

spl_autoload_register(array('YiiBase', 'autoload'));
