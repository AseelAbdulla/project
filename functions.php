
<?php

//include navwalker class for bootstrap nav menu
require_once('class-wp-bootstrap-navwalker.php');

// add custom styles
function task_style(){
wp_enqueue_style('bootstrap-css', get_template_directory_uri().'/css/bootstrap.min.css');
wp_enqueue_style('bootstrap-css-icon', get_template_directory_uri().'/css/bootstrap-icons.css');
wp_enqueue_style('fontawesome-css', get_template_directory_uri().'/css/all.min.css');
wp_enqueue_style('main', get_template_directory_uri().'/css/main.css');
wp_enqueue_style('responsive', get_template_directory_uri().'/css/responsive.css');
}

// add custom scripts
function task_scripts(){

    If (is_admin_bar_showing()) {
//remove registered jquery
wp_deregister_script('utils');  
//register anew jquery in footer
wp_register_script('utils', includes_url('/js/utils.min.js'),array('jquery') ,'', true);  
//enqueue the new jquery
wp_enqueue_script('utils');


//remove registered jquery
wp_deregister_script('embed');  
//register anew jquery in footer
wp_register_script('embed', includes_url('/js/wp-embed.min.js'),false,'', true);  
//enqueue the new jquery
wp_enqueue_script('embed');

    }

//remove registered jquery
wp_deregister_script('jquery');  
//register anew jquery in footer
wp_register_script('jquery', includes_url('/js/jquery/jquery.js'),false,'', true);  
//enqueue the new jquery
wp_enqueue_script('jquery');

wp_enqueue_script('bootstrap-js', get_template_directory_uri().'/js/bootstrap.bundle.min.js', array(), false, true);
wp_enqueue_script('main-js', get_template_directory_uri().'/js/main.js', array(), false, true);
wp_enqueue_script('wp-js',includes_url('/js/wp-embed.min.js', array(), false, true) );
}


//add custom menu support

function register_custom_menu(){
    register_nav_menus(
        array(
            // set many menus to use it in many places and deffrence contain
          'bootstrap-menu' =>'Navigation Bar',
          'footer-menu'    =>'Footer Menu',

        ));
}


function custom_nav_menu_ul_class($args) {
    if ($args['theme_location'] === 'bootstrap-menu') {
        $args['menu_class'] = 'navbar-nav me-auto'; // كلاس ul الخاص بـ Bootstrap
    }
    return $args;
}


function custom_nav_menu_a_class($atts, $item, $args, $depth) {
    if ($args->theme_location === 'bootstrap-menu') {
        $atts['class'] = 'nav-link'; // كلاس للرابط
        if ($depth > 0) {
            $atts['class'] .= ' dropdown-item'; // روابط القائمة الفرعية
        }
        if (in_array('menu-item-has-children', $item->classes)) {
            $atts['class'] .= ' dropdown-toggle'; // رابط القائمة الفرعية
            $atts['data-bs-toggle'] = 'dropdown'; // تفعيل القائمة الفرعية
        }
    }
    return $atts;
}

function custom_nav_menu_submenu_class($classes, $args, $depth) {
    if ($args->theme_location === 'bootstrap-menu') {
        $classes= array('dropdown-menu'); // كلاس ul للقائمة الفرعية
    }
    return $classes;
}

function custom_nav_menu_link_attributes($atts, $item, $args, $depth) {
    if ($args->theme_location === 'bootstrap-menu') {
        $atts['class'] = 'nav-link'; // كلاس افتراضي للرابط
        if ($depth > 0) {
            $atts['class'] = 'dropdown-item'; // كلاس للقوائم الفرعية
        }
        if (in_array('menu-item-has-children', $item->classes)) {
            $atts['class'] .= ' dropdown-toggle'; // كلاس خاص بالقوائم المنسدلة
            $atts['data-bs-toggle'] = 'dropdown'; // لتفعيل القائمة المنسدلة
        }
    }
    return $atts;
}

function custom_nav_menu_li_class($classes, $item, $args, $depth) {
    if ($args->theme_location === 'bootstrap-menu') {
        $classes[] = 'nav-item'; // كلاس افتراضي للعناصر
        if (in_array('menu-item-has-children', $classes)) {
            $classes[] = 'dropdown'; // كلاس للقوائم التي تحتوي على عناصر فرعية
        }
    }
    return $classes;
}

function bootstrap_menu(){ 
Wp_nav_menu(array(
    'theme_location'  => 'bootstrap-menu', // موقع القائمة
    'menu_class'      => 'navbar-nav me-auto', // الكلاسات لـ <ul>
    'container'       => 'div', // الحاوية الخارجية
    'container_class' => 'collapse navbar-collapse', // كلاس الحاوية الخارجية
    'container_id'    => 'navbarNav', // معرف الحاوية
));
}

// excerpt function
function add_excerpt_length($length){
    if (is_author()) {
       return 30;
    }elseif(is_category()){
        return 20;
    }
    else{
        return 40;
    }
}

function change_excerpt_dotis($more){
 return ' ...';
}

function numbering_pagenation(){
    global $wp_query; //this tool form wordpress to make wp_query global
    $all_pages = $wp_query -> max_num_pages;
    $current_pages = max(1, get_query_var('paged')); //get the max number
    if ($all_pages > 1) { //check if there is more than 1 page
       return paginate_links(array(
        'base'      => get_pagenum_link().'%_%' , //get link for a page number %_% you should make it like this to transform between pagenation
        'formate'   => 'page/%#%', // the format for 
        'current'   => $current_pages,
        'prev_text' => 'Previose' ,
        'next_text' => 'Next'  //<< تعمل بدل عن كلمي بعد وقبل
       ));
    }
}

function count_category_comments(){
    $comments_arge =  array(
        'status'  => 'approve' // appear only the approved comments
    );
    $comments_count = 0; // start form 0
    $all_comments = get_comments($comments_arge); //get all comments
    $category = get_queried_object(); //get full pbjects
    $cat_id = $category->cat_ID; // get cat-id from object
  
foreach ($all_comments as $comment) { //loop through all comments
    $post_id = $comment->comment_post_ID;
     if (! in_category( $cat_id , $post_id )) {
         # code...
         continue;
     }
     $comments_count++ ;
    
    }
    return $comments_count;
}
function posts_count(){
    $category = get_queried_object(); //get full pbjects
    $posts_count = $category->count; //get posta-count from object
     return  $posts_count ;
}

function main_sidebar(){
   //Register Main Saidebar
    register_sidebar(array(
        'name'   => 'Main Sidebar',
        'id' /* should be small */ => 'main-sidebar',
        'description' => 'this is main sidwbar',
        'class' => 'main-sidebar',
        'before_widget' => '<div class="widget-content" >',
        'after_widget'  => '</div>',
        'before_title'  => '<h1 class="widget-title"> ',
        'after_title'  => '</h1>'
    ));

}
add_action('widgets_init', 'main_sidebar');


//add filters

add_filter('excerpt_length' , 'add_excerpt_length');

add_filter('excerpt_more' ,'change_excerpt_dotis');

add_filter('wp_nav_menu_args', 'custom_nav_menu_ul_class');
// كلاس للرابط
add_filter('nav_menu_link_attributes', 'custom_nav_menu_a_class', 10, 4);
// كلاس ul للقائمة الفرعية
add_filter('nav_menu_submenu_css_class', 'custom_nav_menu_submenu_class', 10, 3);
// كلاس للقوائم الفرعية
add_filter('nav_menu_link_attributes', 'custom_nav_menu_link_attributes', 10, 4);
// كلاس للقوائم التي تحتوي على عناصر فرعية
add_filter('nav_menu_css_class', 'custom_nav_menu_li_class', 10, 4);

//add featured image support
add_theme_support('post-thumbnails');

// add actions 

//add css style
add_action('wp_enqueue_scripts', 'task_scripts');
//add js script
add_action('wp_enqueue_scripts', 'task_style');
// register_custom_menu
add_action('init', 'register_custom_menu');
// كلاس ul الخاص بـ Bootstrap add
