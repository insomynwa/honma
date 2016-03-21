<?php
/**
 * Honma functions and definitions
 *
 * @package Honma
 */
 
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', esc_url(get_template_directory_uri() . '/inc/') );
	require( get_template_directory() . '/inc/options-framework.php' );
}
if ( ! function_exists( 'honma_setup' ) ) :
function honma_setup() {
    global $content_width;
	if ( ! isset( $content_width ) ) { $content_width = 1000; }
	load_theme_textdomain( 'honma', get_template_directory() . '/languages' );
	register_nav_menu( 'main', __( 'Main Menu', "honma" ) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );	
	add_theme_support( 'custom-background' );	
	$custom_header_support = array(
		'default-text-color' => '000',
		'flex-height' => true,
	);
	set_post_thumbnail_size( 150, 150, true );
	add_image_size( 'news-honma', 200, 200, true );
	add_image_size( 'large-feature-honma', 600, 480, true );
	add_image_size( 'small-feature-honma', 500, 300 );

}
endif; 
add_action( 'after_setup_theme', 'honma_setup' );


if ( ! function_exists( 'honma_of_register_js' ) ) :
function honma_of_register_js() {
	wp_enqueue_script('main-honma', esc_url(get_template_directory_uri() . '/js/main.js'), array('jquery'),'1.0', true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
endif; 
add_action('wp_enqueue_scripts', 'honma_of_register_js');

function honma_ie_support_header() {
    echo '<!--[if lt IE 9]>'. "\n";
    echo '<script src="' . esc_url( get_template_directory_uri() . '/js/html5.js' ) . '"></script>'. "\n";
    echo '<![endif]-->'. "\n";
}
add_action( 'wp_head', 'honma_ie_support_header', 1 );

if ( ! function_exists( 'honma_widgets_init' ) ) :
function honma_widgets_init() {
	register_sidebar(array(
		'name' => __( 'Sidebar Widget Area', "honma"),
		'id' => 'sidebar-widget-area',
		'description' => __( 'The sidebar widget area', "honma"),
		'before_widget' => '<aside id="%1$s" class="widget %2$s"> ', 
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3><hr>',
	));		
	register_sidebar(array(
		'name' => __( 'Footer Widget Area 1', "honma"),
		'id' => 'footer-widget-area-1',
		'description' => __( 'The footer widget area 1', "honma"),
		'before_widget' => '<aside id="%1$s" class="widget %2$s"> ',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));	
	register_sidebar(array(
		'name' => __( 'Footer Widget Area 2', "honma"),
		'id' => 'footer-widget-area-2',
		'description' => __( 'The footer widget area 2', "honma"),
		'before_widget' => '<aside id="%1$s" class="widget %2$s"> ',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));	
	register_sidebar(array(
		'name' => __( 'Footer Widget Area 3', "honma"),
		'id' => 'footer-widget-area-3',
		'description' => __( 'The footer widget area 3', "honma"),
		'before_widget' => '<aside id="%1$s" class="widget %2$s"> ',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));	
	register_sidebar(array(
		'name' => __( 'Footer Widget Area 4', "honma"),
		'id' => 'footer-widget-area-4',
		'description' => __( 'The footer widget area 4', "honma"),
		'before_widget' => '<aside id="%1$s" class="widget %2$s"> ',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>'
	));		
}
endif;
add_action( 'widgets_init', 'honma_widgets_init' );

if ( ! function_exists( 'honma_head_css' ) ) :
function honma_head_css() {
        $meta = '';
		
		$fav_icon = of_get_option('fav_icon');
		if ($fav_icon <> '') {
			$meta .= "<link rel=\"shortcut icon\" href=\"".esc_url($fav_icon)."\" type=\"image/x-icon\" />\n";
		}
		$web_clip = of_get_option('web_clip');
		if ($web_clip <> '') {
			$meta .= "<link rel=\"apple-touch-icon-precomposed\" href=\"".esc_url($web_clip)."\" />\n";
		}		

		if ($meta <> '') {
			echo $meta;
		}														
}
endif;
add_action('wp_head', 'honma_head_css');

function honma_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}
	
	$title .= get_bloginfo( 'name', 'display' );

	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'honma' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'honma_wp_title', 10, 2 );

if ( ! function_exists( 'honma_get_list_posts' ) ) :
function honma_get_list_posts($n) {
    global $wp_query;
	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
    $args = array(
        'post_type' => 'post',
        'orderby' => 'date',
		'order' => 'DESC',
		'posts_per_page' => $n
    );
	$wp_query->query( $args );
    return new WP_Query( $args );
}
endif; 

if ( ! function_exists( 'honma_paginate_page' ) ) :
function honma_paginate_page() {
	wp_link_pages( array( 'before' => '<div class="pagination">', 'after' => '</div><div class="clear"></div>', 'link_before' => '<span class="current_pag">','link_after' => '</span>' ) );
}
endif; 

if ( ! function_exists( 'honma_credits' ) ) :
function honma_credits() {
	$text = __('Theme created by <a href="'.esc_url('http://www.pwtthemes.com/theme/honma-free-responsive-wordpress-theme').'">PWT</a>. Powered by <a href="'.esc_url('http://wordpress.org/').'">WordPress.org</a>', 'honma');
	echo apply_filters( 'honma_credits_text', $text) ;
}
endif; 
add_action( 'honma_display_credits', 'honma_credits' );

/**
* CUSTOM BY FIKA
*
* Content:
* 1. Add Bootstrap & Custom Style
* 2. Menu Walker
* 3. Connect To Plugin
* 	a. get Kategori
* 4. Meta-Box
* 5. Render Template
*
*/
// 1. Add Bootstrap
// CDN
// function my_scripts_enqueue() {
// 	wp_register_script( 'bootstrap-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', array( 'jquery' ), NULL, true );
// 	wp_register_style( 'bootstrap-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css', false, NULL, 'all' );
// 	wp_register_style( 'sltg-css', get_template_directory_uri() . '/css/sltg-style.css', false, NULL, 'all' );

// 	wp_enqueue_script( 'bootstrap-js' );
// 	wp_enqueue_style( 'bootstrap-css' );
// 	wp_enqueue_style( 'sltg-css');
// }
// LOCAL
function my_scripts_enqueue() {
	/*wp_register_script( 'bootstrap-js', get_template_directory_uri() . '/css/js/bootstrap.min.js', array( 'jquery' ), NULL, true );
	wp_register_style( 'bootstrap-css', get_template_directory_uri() . '/css/css/bootstrap.min.css', false, NULL, 'all' );
	wp_register_style( 'sltg-css', get_template_directory_uri() . '/css/sltg-style.css', false, NULL, 'all' );

	wp_enqueue_script( 'bootstrap-js' );
	wp_enqueue_style( 'bootstrap-css' );
	wp_enqueue_style( 'sltg-css');*/
	wp_enqueue_script( 'sltg-template-script', get_template_directory_uri() . '/js/sltg-script.js', array( 'jquery' ) );
	wp_enqueue_script( 'freewall-script', get_template_directory_uri() . '/js/freewall.js', array( 'jquery' ) );

	wp_localize_script( 'sltg-template-script', 'sltgtempscript', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'security' => wp_create_nonce( 'sltg-special-string') ) );

}
add_action( 'wp_enqueue_scripts', 'my_scripts_enqueue' );

// 2. Menu Walker
// class CSS_Menu_Walker extends Walker {

// 	var $db_fields = array('parent' => 'menu_item_parent', 'id' => 'db_id');
	
// 	function start_lvl(&$output, $depth = 0, $args = array()) {
// 		$indent = str_repeat("\t", $depth);
// 		$output .= "\n$indent<ul>\n";
// 	}
	
// 	function end_lvl(&$output, $depth = 0, $args = array()) {
// 		$indent = str_repeat("\t", $depth);
// 		$output .= "$indent</ul>\n";
// 	}
	
// 	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
	
// 		global $wp_query;
// 		$indent = ($depth) ? str_repeat("\t", $depth) : '';
// 		$class_names = $value = '';
// 		$classes = empty($item->classes) ? array() : (array) $item->classes;
		
// 		/* Add active class */
// 		if (in_array('current-menu-item', $classes)) {
// 			$classes[] = 'active';
// 			unset($classes['current-menu-item']);
// 		}
		
// 		/* Check for children */
// 		$children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
// 		if (!empty($children)) {
// 			$classes[] = 'has-sub';
// 		}
		
// 		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
// 		$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
		
// 		$id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
// 		$id = $id ? ' id="' . esc_attr($id) . '"' : '';
		
// 		$output .= $indent . '<li' . $id . $value . $class_names .'>';
		
// 		$attributes  = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
// 		$attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target    ) .'"' : '';
// 		$attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn       ) .'"' : '';
// 		$attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url       ) .'"' : '';
		
// 		$item_output = $args->before;
// 		$item_output .= '<a'. $attributes .'><span>';
// 		$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
// 		$item_output .= '</span></a>';
// 		$item_output .= $args->after;
		
// 		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
// 	}
	
// 	function end_el(&$output, $item, $depth = 0, $args = array()) {
// 		$output .= "</li>\n";
// 	}
// }

// 3. Connect To Plugin
// a. get Kategori
function get_kategori_product() {
	//require ( '')
	if( class_exists( 'Salatiga_Plugin_Controller' ) ) {
		$kategoris = new Sltg_Kategori_Product();

		$arrKategori = array();

		$rows = $kategoris->DataList();
		foreach( $rows as $row ) {
			$kategori = new Sltg_Kategori_Product();
			$kategori->HasID( $row->id_kategori );
			$arrKategori[] = $kategori;
		}

		return $arrKategori;
	}
	//do_action( 'sltg_product_category_pagination');
	/*if( class_exists('Salatiga_Plugin_Admin'))
		echo "true";
	else
		echo "false";
	if( function_exists('get_kategori_product'))
		echo "true";
	else
		echo "false";*/
	//var_dump(get_kategori_product());
}
// 4. Meta-Box
// add_filter( 'rwmb_meta_boxes', 'your_prefix_meta_boxes' );
// function fika_meta_boxes( $meta_boxes ) {

//     $meta_boxes[] = array(
//         'title'      => __( 'Test Meta Box', 'textdomain' ),
//         'post_types' => 'post',
//         'fields'     => array(
//             array(
//                 'id'   => 'name',
//                 'name' => __( 'Name', 'textdomain' ),
//                 'type' => 'text',
//             ),
//             array(
//                 'id'      => 'gender',
//                 'name'    => __( 'Gender', 'textdomain' ),
//                 'type'    => 'radio',
//                 'options' => array(
//                     'm' => __( 'Male', 'textdomain' ),
//                     'f' => __( 'Female', 'textdomain' ),
//                 ),
//             ),
//             array(
//                 'id'   => 'email',
//                 'name' => __( 'Email', 'textdomain' ),
//                 'type' => 'email',
//             ),
//             array(
//                 'id'   => 'bio',
//                 'name' => __( 'Biography', 'textdomain' ),
//                 'type' => 'textarea',
//             ),
//         ),
//     );
//     return $meta_boxes;
// }
// add_filter( 'rwmb_meta_boxes', 'fika_register_meta_boxes' );
// /**
//  * Register meta boxes
//  *
//  * Remember to change "your_prefix" to actual prefix in your project
//  *
//  * @param array $meta_boxes List of meta boxes
//  *
//  * @return array
//  */
// function fika_register_meta_boxes( $meta_boxes )
// {
// 	/**
// 	 * prefix of meta keys (optional)
// 	 * Use underscore (_) at the beginning to make keys hidden
// 	 * Alt.: You also can make prefix empty to disable it
// 	 */
// 	// Better has an underscore as last sign
// 	$prefix = 'your_prefix_';
// 	// 1st meta box
// 	$meta_boxes[] = array(
// 		// Meta box id, UNIQUE per meta box. Optional since 4.1.5
// 		'id'         => 'standard',
// 		// Meta box title - Will appear at the drag and drop handle bar. Required.
// 		'title'      => __( 'Standard Fields', 'your-prefix' ),
// 		// Post types, accept custom post types as well - DEFAULT is 'post'. Can be array (multiple post types) or string (1 post type). Optional.
// 		'post_types' => array( 'post', 'page' ),
// 		// Where the meta box appear: normal (default), advanced, side. Optional.
// 		'context'    => 'normal',
// 		// Order of meta box: high (default), low. Optional.
// 		'priority'   => 'high',
// 		// Auto save: true, false (default). Optional.
// 		'autosave'   => true,
// 		// List of meta fields
// 		'fields'     => array(
// 			// TEXT
// 			array(
// 				// Field name - Will be used as label
// 				'name'  => __( 'Text', 'your-prefix' ),
// 				// Field ID, i.e. the meta key
// 				'id'    => "{$prefix}text",
// 				// Field description (optional)
// 				'desc'  => __( 'Text description', 'your-prefix' ),
// 				'type'  => 'text',
// 				// Default value (optional)
// 				'std'   => __( 'Default text value', 'your-prefix' ),
// 				// CLONES: Add to make the field cloneable (i.e. have multiple value)
// 				'clone' => true,
// 			),
// 			// CHECKBOX
// 			array(
// 				'name' => __( 'Checkbox', 'your-prefix' ),
// 				'id'   => "{$prefix}checkbox",
// 				'type' => 'checkbox',
// 				// Value can be 0 or 1
// 				'std'  => 1,
// 			),
// 			// RADIO BUTTONS
// 			array(
// 				'name'    => __( 'Radio', 'your-prefix' ),
// 				'id'      => "{$prefix}radio",
// 				'type'    => 'radio',
// 				// Array of 'value' => 'Label' pairs for radio options.
// 				// Note: the 'value' is stored in meta field, not the 'Label'
// 				'options' => array(
// 					'value1' => __( 'Label1', 'your-prefix' ),
// 					'value2' => __( 'Label2', 'your-prefix' ),
// 				),
// 			),
// 			// SELECT BOX
// 			array(
// 				'name'        => __( 'Select', 'your-prefix' ),
// 				'id'          => "{$prefix}select",
// 				'type'        => 'select',
// 				// Array of 'value' => 'Label' pairs for select box
// 				'options'     => array(
// 					'value1' => __( 'Label1', 'your-prefix' ),
// 					'value2' => __( 'Label2', 'your-prefix' ),
// 				),
// 				// Select multiple values, optional. Default is false.
// 				'multiple'    => false,
// 				'std'         => 'value2',
// 				'placeholder' => __( 'Select an Item', 'your-prefix' ),
// 			),
// 			// HIDDEN
// 			array(
// 				'id'   => "{$prefix}hidden",
// 				'type' => 'hidden',
// 				// Hidden field must have predefined value
// 				'std'  => __( 'Hidden value', 'your-prefix' ),
// 			),
// 			// PASSWORD
// 			array(
// 				'name' => __( 'Password', 'your-prefix' ),
// 				'id'   => "{$prefix}password",
// 				'type' => 'password',
// 			),
// 			// TEXTAREA
// 			array(
// 				'name' => __( 'Textarea', 'your-prefix' ),
// 				'desc' => __( 'Textarea description', 'your-prefix' ),
// 				'id'   => "{$prefix}textarea",
// 				'type' => 'textarea',
// 				'cols' => 20,
// 				'rows' => 3,
// 			),
// 		),
// 		'validation' => array(
// 			'rules'    => array(
// 				"{$prefix}password" => array(
// 					'required'  => true,
// 					'minlength' => 7,
// 				),
// 			),
// 			// optional override of default jquery.validate messages
// 			'messages' => array(
// 				"{$prefix}password" => array(
// 					'required'  => __( 'Password is required', 'your-prefix' ),
// 					'minlength' => __( 'Password must be at least 7 characters', 'your-prefix' ),
// 				),
// 			),
// 		),
// 	);
// 	// 2nd meta box
// 	$meta_boxes[] = array(
// 		'title' => __( 'Advanced Fields', 'your-prefix' ),
// 		'fields' => array(
// 			// HEADING
// 			array(
// 				'type' => 'heading',
// 				'name' => __( 'Heading', 'your-prefix' ),
// 				'desc' => __( 'Optional description for this heading', 'your-prefix' ),
// 			),
// 			// SLIDER
// 			array(
// 				'name'       => __( 'Slider', 'your-prefix' ),
// 				'id'         => "{$prefix}slider",
// 				'type'       => 'slider',
// 				// Text labels displayed before and after value
// 				'prefix'     => __( '$', 'your-prefix' ),
// 				'suffix'     => __( ' USD', 'your-prefix' ),
// 				// jQuery UI slider options. See here http://api.jqueryui.com/slider/
// 				'js_options' => array(
// 					'min'  => 10,
// 					'max'  => 255,
// 					'step' => 5,
// 				),
// 			),
// 			// NUMBER
// 			array(
// 				'name' => __( 'Number', 'your-prefix' ),
// 				'id'   => "{$prefix}number",
// 				'type' => 'number',
// 				'min'  => 0,
// 				'step' => 5,
// 			),
// 			// DATE
// 			array(
// 				'name'       => __( 'Date picker', 'your-prefix' ),
// 				'id'         => "{$prefix}date",
// 				'type'       => 'date',
// 				// jQuery date picker options. See here http://api.jqueryui.com/datepicker
// 				'js_options' => array(
// 					'appendText'      => __( '(yyyy-mm-dd)', 'your-prefix' ),
// 					'dateFormat'      => __( 'yy-mm-dd', 'your-prefix' ),
// 					'changeMonth'     => true,
// 					'changeYear'      => true,
// 					'showButtonPanel' => true,
// 				),
// 			),
// 			// DATETIME
// 			array(
// 				'name'       => __( 'Datetime picker', 'your-prefix' ),
// 				'id'         => $prefix . 'datetime',
// 				'type'       => 'datetime',
// 				// jQuery datetime picker options.
// 				// For date options, see here http://api.jqueryui.com/datepicker
// 				// For time options, see here http://trentrichardson.com/examples/timepicker/
// 				'js_options' => array(
// 					'stepMinute'     => 15,
// 					'showTimepicker' => true,
// 				),
// 			),
// 			// TIME
// 			array(
// 				'name'       => __( 'Time picker', 'your-prefix' ),
// 				'id'         => $prefix . 'time',
// 				'type'       => 'time',
// 				// jQuery datetime picker options.
// 				// For date options, see here http://api.jqueryui.com/datepicker
// 				// For time options, see here http://trentrichardson.com/examples/timepicker/
// 				'js_options' => array(
// 					'stepMinute' => 5,
// 					'showSecond' => true,
// 					'stepSecond' => 10,
// 				),
// 			),
// 			// COLOR
// 			array(
// 				'name' => __( 'Color picker', 'your-prefix' ),
// 				'id'   => "{$prefix}color",
// 				'type' => 'color',
// 			),
// 			// CHECKBOX LIST
// 			array(
// 				'name'    => __( 'Checkbox list', 'your-prefix' ),
// 				'id'      => "{$prefix}checkbox_list",
// 				'type'    => 'checkbox_list',
// 				// Options of checkboxes, in format 'value' => 'Label'
// 				'options' => array(
// 					'value1' => __( 'Label1', 'your-prefix' ),
// 					'value2' => __( 'Label2', 'your-prefix' ),
// 				),
// 			),
// 			// AUTOCOMPLETE
// 			array(
// 				'name'    => __( 'Autocomplete', 'your-prefix' ),
// 				'id'      => "{$prefix}autocomplete",
// 				'type'    => 'autocomplete',
// 				// Options of autocomplete, in format 'value' => 'Label'
// 				'options' => array(
// 					'value1' => __( 'Label1', 'your-prefix' ),
// 					'value2' => __( 'Label2', 'your-prefix' ),
// 				),
// 				// Input size
// 				'size'    => 30,
// 				// Clone?
// 				'clone'   => false,
// 			),
// 			// EMAIL
// 			array(
// 				'name' => __( 'Email', 'your-prefix' ),
// 				'id'   => "{$prefix}email",
// 				'desc' => __( 'Email description', 'your-prefix' ),
// 				'type' => 'email',
// 				'std'  => 'name@email.com',
// 			),
// 			// RANGE
// 			array(
// 				'name' => __( 'Range', 'your-prefix' ),
// 				'id'   => "{$prefix}range",
// 				'desc' => __( 'Range description', 'your-prefix' ),
// 				'type' => 'range',
// 				'min'  => 0,
// 				'max'  => 100,
// 				'step' => 5,
// 				'std'  => 0,
// 			),
// 			// URL
// 			array(
// 				'name' => __( 'URL', 'your-prefix' ),
// 				'id'   => "{$prefix}url",
// 				'desc' => __( 'URL description', 'your-prefix' ),
// 				'type' => 'url',
// 				'std'  => 'http://google.com',
// 			),
// 			// OEMBED
// 			array(
// 				'name' => __( 'oEmbed', 'your-prefix' ),
// 				'id'   => "{$prefix}oembed",
// 				'desc' => __( 'oEmbed description', 'your-prefix' ),
// 				'type' => 'oembed',
// 			),
// 			// SELECT ADVANCED BOX
// 			array(
// 				'name'        => __( 'Select', 'your-prefix' ),
// 				'id'          => "{$prefix}select_advanced",
// 				'type'        => 'select_advanced',
// 				// Array of 'value' => 'Label' pairs for select box
// 				'options'     => array(
// 					'value1' => __( 'Label1', 'your-prefix' ),
// 					'value2' => __( 'Label2', 'your-prefix' ),
// 				),
// 				// Select multiple values, optional. Default is false.
// 				'multiple'    => false,
// 				// 'std'         => 'value2', // Default value, optional
// 				'placeholder' => __( 'Select an Item', 'your-prefix' ),
// 			),
// 			// TAXONOMY
// 			array(
// 				'name'       => __( 'Taxonomy', 'your-prefix' ),
// 				'id'         => "{$prefix}taxonomy",
// 				'type'       => 'taxonomy',
// 				// Taxonomy name
// 				'taxonomy'   => 'category',
// 				// How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree', select_advanced or 'select'. Optional
// 				'field_type' => 'checkbox_list',
// 				// Additional arguments for get_terms() function. Optional
// 				'query_args' => array(),
// 			),
// 			// POST
// 			array(
// 				'name'        => __( 'Posts (Pages)', 'your-prefix' ),
// 				'id'          => "{$prefix}pages",
// 				'type'        => 'post',
// 				// Post type
// 				'post_type'   => 'page',
// 				// Field type, either 'select' or 'select_advanced' (default)
// 				'field_type'  => 'select_advanced',
// 				'placeholder' => __( 'Select an Item', 'your-prefix' ),
// 				// Query arguments (optional). No settings means get all published posts
// 				'query_args'  => array(
// 					'post_status'    => 'publish',
// 					'posts_per_page' => - 1,
// 				),
// 			),
// 			// WYSIWYG/RICH TEXT EDITOR
// 			array(
// 				'name'    => __( 'WYSIWYG / Rich Text Editor', 'your-prefix' ),
// 				'id'      => "{$prefix}wysiwyg",
// 				'type'    => 'wysiwyg',
// 				// Set the 'raw' parameter to TRUE to prevent data being passed through wpautop() on save
// 				'raw'     => false,
// 				'std'     => __( 'WYSIWYG default value', 'your-prefix' ),
// 				// Editor settings, see wp_editor() function: look4wp.com/wp_editor
// 				'options' => array(
// 					'textarea_rows' => 4,
// 					'teeny'         => true,
// 					'media_buttons' => false,
// 				),
// 			),
// 			// DIVIDER
// 			array(
// 				'type' => 'divider',
// 			),
// 			// FILE UPLOAD
// 			array(
// 				'name' => __( 'File Upload', 'your-prefix' ),
// 				'id'   => "{$prefix}file",
// 				'type' => 'file',
// 			),
// 			// FILE ADVANCED (WP 3.5+)
// 			array(
// 				'name'             => __( 'File Advanced Upload', 'your-prefix' ),
// 				'id'               => "{$prefix}file_advanced",
// 				'type'             => 'file_advanced',
// 				'max_file_uploads' => 4,
// 				'mime_type'        => 'application,audio,video', // Leave blank for all file types
// 			),
// 			// IMAGE UPLOAD
// 			array(
// 				'name' => __( 'Image Upload', 'your-prefix' ),
// 				'id'   => "{$prefix}image",
// 				'type' => 'image',
// 			),
// 			// THICKBOX IMAGE UPLOAD (WP 3.3+)
// 			array(
// 				'name' => __( 'Thickbox Image Upload', 'your-prefix' ),
// 				'id'   => "{$prefix}thickbox",
// 				'type' => 'thickbox_image',
// 			),
// 			// PLUPLOAD IMAGE UPLOAD (WP 3.3+)
// 			array(
// 				'name'             => __( 'Plupload Image Upload', 'your-prefix' ),
// 				'id'               => "{$prefix}plupload",
// 				'type'             => 'plupload_image',
// 				'max_file_uploads' => 4,
// 			),
// 			// IMAGE ADVANCED (WP 3.5+)
// 			array(
// 				'name'             => __( 'Image Advanced Upload', 'your-prefix' ),
// 				'id'               => "{$prefix}imgadv",
// 				'type'             => 'image_advanced',
// 				'max_file_uploads' => 4,
// 			),
// 			// BUTTON
// 			array(
// 				'id'   => "{$prefix}button",
// 				'type' => 'button',
// 				'name' => ' ', // Empty name will "align" the button to all field inputs
// 			),
// 		),
// 	);
// 	return $meta_boxes;
// }
// 5. Render Template
function get_html_template( $location, $template_name, $attributes = null , $return_val = FALSE) {
	if (! $attributes ) {
		$attributes = array();
	}
	ob_start();
	require( $location . '/' . $template_name . '.php' );
	$html = ob_get_contents();
	ob_end_clean();
	if ( $return_val )
		return $html;
	//var_dump($html);
	echo $html;
}
?>