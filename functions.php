<?php

/*
 *	ENQUEUE SCRIPTS AND STYLES
 *********************************/
add_action('wp_enqueue_scripts', 'ofrendas_scripts_styles');
function ofrendas_scripts_styles(){
	wp_enqueue_style('setup', get_stylesheet_directory_uri()."/css/setup.css", array(), '2013-08-20');
	wp_enqueue_style('ofrendas-style', get_stylesheet_uri(), array(), '2013-08-19');
}
add_action('admin_enqueue_scripts', 'ofrendas_admin_script');
function ofrendas_admin_script(){
	wp_enqueue_script('ofrendas-admin', get_stylesheet_directory_uri().'/js/admin.js', array('jquery'), '2013-08-21');
}

/*
 * DON'T MOVE CHECKED CAT TO TOP
 ********************************/
add_filter('wp_terms_checklist_args','dont_float_checked_cat', 10, 2 );
function dont_float_checked_cat($args, $post_id){
	if(isset($args['taxonomy']) && ('student' == $args['taxonomy'] || 'phase' == $args['taxonomy'])){
		$args['checked_ontop'] = false;
	}
	return $args;
}

/*
 * REGISTER MAIN NAV 
 ********************************/
register_nav_menu( 'primary', 'Primary Menu' );

/*
 * REGISTER SIDEBARS
 ********************************/
register_sidebar( array(
	'name'          => 'Translation',
	'id'            => 'sidebar-translation',
	'description'   => 'Enter the content for the translation widget.',
	'before_widget' => '',
	'after_widget'  => '',
	'before_title'  => '<h3 class="widget-title">',
	'after_title'   => '</h3>',
));
register_sidebar( array(
	'name'          => 'General Sidebar',
	'id'            => 'sidebar-general',
	'description'   => 'Appears on video, ofrenda, phase and school archives.',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h3 class="widget-title">',
	'after_title'   => '</h3>',
) );
register_sidebar( array(
	'name'          => 'News Sidebar',
	'id'            => 'sidebar-news',
	'description'   => 'Appears on the front page and blog (news) pages.',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget'  => '</aside>',
	'before_title'  => '<h3 class="widget-title">',
	'after_title'   => '</h3>',
) );

/*
 * CUSTOM POST TYPES
 ********************************/

add_action( 'init', 'generate_ofrenda_cpt', 0 );
function generate_ofrenda_cpt() {
	$labels = array(
		'name'                => 'Ofrendas',
		'singular_name'       => 'Ofrenda',
		'menu_name'           => 'Ofrendas',
		'parent_item_colon'   => 'Parent Ofrenda:',
		'all_items'           => 'All Ofrendas',
		'view_item'           => 'View Ofrenda',
		'add_new_item'        => 'Add New Ofrenda',
		'add_new'             => 'New Ofrenda',
		'edit_item'           => 'Edit Ofrenda',
		'update_item'         => 'Update Ofrenda',
		'search_items'        => 'Search ofrendas',
		'not_found'           => 'No ofrendas found',
		'not_found_in_trash'  => 'No ofrendas found in Trash',
	);
	$rewrite = array(
		'slug'                => 'ofrendas',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => 'ofrenda',
		'description'         => 'A single ofrenda page.',
		'labels'              => $labels,
		'supports'            => array( 'comments', 'editor', 'title' ),
		'taxonomies'          => array( 'student', 'phase' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'				 => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'ofrenda', $args );
}

add_action( 'init', 'generate_video_cpt', 0 );
function generate_video_cpt() {
	$labels = array(
		'name'                => 'Videos',
		'singular_name'       => 'Video',
		'menu_name'           => 'Videos',
		'parent_item_colon'   => 'Parent Video:',
		'all_items'           => 'All Videos',
		'view_item'           => 'View Video',
		'add_new_item'        => 'Add New Video',
		'add_new'             => 'New Video',
		'edit_item'           => 'Edit Video',
		'update_item'         => 'Update Video',
		'search_items'        => 'Search videos',
		'not_found'           => 'No videos found',
		'not_found_in_trash'  => 'No videos found in Trash',
	);
	$rewrite = array(
		'slug'                => 'videos',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => 'video',
		'description'         => 'A single video page.',
		'labels'              => $labels,
		'supports'            => array( 'comments', 'editor', 'title' ),
		'taxonomies'          => array( 'student', 'phase' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => '',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'				 => $rewrite,
		'capability_type'     => 'page',
	);
	register_post_type( 'video', $args );
}

/*
 * CUSTOM TAXONOMIES
 ********************************/
 
add_action( 'init', 'generate_student_tax', 0 );
function generate_student_tax()  {
	$labels = array(
		'name'                       => 'Students',
		'singular_name'              => 'Student',
		'menu_name'                  => 'Students',
		'all_items'                  => 'All Students',
		'parent_item'                => 'School',
		'parent_item_colon'          => 'School:',
		'new_item_name'              => 'New Student Name',
		'add_new_item'               => 'Add New Student',
		'edit_item'                  => 'Edit Student',
		'update_item'                => 'Update Student',
		'separate_items_with_commas' => 'Separate students with commas',
		'search_items'               => 'Search students',
		'add_or_remove_items'        => 'Add or remove students',
		'choose_from_most_used'      => 'Choose from the most used students',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'rewrite'						  => array('slug' => 'school', 'hierarchical' => true ),
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'student', array('ofrenda','video'), $args );
}

add_action( 'init', 'generate_phase_tax', 0 );
function generate_phase_tax()  {
	$labels = array(
		'name'                       => 'Phases',
		'singular_name'              => 'Phase',
		'menu_name'                  => 'Phases',
		'all_items'                  => 'All Phases',
		'parent_item'                => 'Parent Phase',
		'parent_item_colon'          => 'Parent Phase:',
		'new_item_name'              => 'New Phase Name',
		'add_new_item'               => 'Add New Phase',
		'edit_item'                  => 'Edit Phase',
		'update_item'                => 'Update Phase',
		'separate_items_with_commas' => 'Separate phases with commas',
		'search_items'               => 'Search phases',
		'add_or_remove_items'        => 'Add or remove phases',
		'choose_from_most_used'      => 'Choose from the most used phases',
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'phase', array('video'), $args );
}

/*
 * CUSTOMIZE EXCERPT_MORE
 ***************************/
add_filter('excerpt_more', 'new_excerpt_more');
function new_excerpt_more($more) {
	global $post;
	return '... <br /><br /><a class="readmore" href="' . get_permalink() . '">Read&nbsp;more&nbsp;&raquo;</a>';
}

/*
 * HELPERS
 ***************/
function ksortRecursive($array){
	foreach($array as $key=>$nestedArray){
		if(is_array($nestedArray) && !empty($nestedArray)){
			$array[$key] = ksortRecursive($nestedArray);
		}
	}
	ksort($array);
	return $array;
}

?>