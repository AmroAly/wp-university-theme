<?php

function university_files() {
    wp_enqueue_script('main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), null, microtime(), true);
    wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles', get_stylesheet_uri(), NULL);
}

add_action('wp_enqueue_scripts', 'university_files');

function university_features() {
    register_nav_menu('headerMenuLocation', 'Header Menu Location');
    register_nav_menu('footerLocationOne', 'Footer Location One');
    register_nav_menu('footerLocationTwo', 'Footer Location Two');
    add_theme_support('title');
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'university_features');


function university_adjust_queries($query) {
    // check to see if the query is not for the posts 
    // in the dashbord and a query for the default url based query and not a custom one
    if(! is_admin() &&  is_post_type_archive('event') && $query->is_main_query()) {
        $today = date('Ymd');
        $query->set('orderby', 'event_date');
        $query->set('meta_query', array(
            array(
              'key' => 'event_date',
              'compare' => '>=',
              'value' => $today,
              'type' => 'numeric'
            )
          ));
        $query->set('order', 'ASC');
    }
}

add_action('pre_get_posts', 'university_adjust_queries');