<?php

function paperny_scripts() {
  // Load our main stylesheet.
  wp_enqueue_style( 'paperny-style', get_stylesheet_uri() );

  wp_enqueue_script( 'paperny-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ));

  wp_enqueue_script( 'jquery' );

  wp_enqueue_style( 'fancybox-style', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.css');
 
  wp_enqueue_script( 'fancybox-script', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.js', array( 'jquery' ));
}
add_action( 'wp_enqueue_scripts', 'paperny_scripts' );

add_action('woocommerce_single_product_summary','addshare', 40);
function addshare(){
  echo sharing_display();
}

function custom_excerpt_more( $more ) {
	return ' ...';
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );

add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
    add_theme_support( 'woocommerce' );
}

add_action( 'init', 'create_posttype' );
function create_posttype() {
  register_post_type( 'pap_latest',
    array(
      'labels' => array(
        'name' => __( 'The Latest' ),
        'singular_name' => __( 'The Latest' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'the-latest'),
	  'taxonomies' => array('post_tag', 'category'),
	  'supports' => array(
		  'title',
		  'editor',
		  'excerpt',
		  'revisions',
		  'thumbnail',
		  'page-attributes',
	  ),
    )
  );

  register_post_type( 'pap_productions',
    array(
      'labels' => array(
        'name' => __( 'Productions' ),
        'singular_name' => __( 'Production' )
      ),
      'public' => true,
      'has_archive' => true,
	  'taxonomies' => array('post_tag'),
      'rewrite' => array('slug' => 'productions'),
	  'supports' => array(
		  'title',
		  'editor',
		  'excerpt',
		  'revisions',
		  'thumbnail',
		  'page-attributes',
	  ),
    )
  );

  register_post_type( 'pap_broadcaster',
    array(
      'labels' => array(
        'name' => __( 'Broadcasters' ),
        'singular_name' => __( 'Broadcaster' )
      ),
      'public' => true,
      'has_archive' => false,
	  'with_front' => false,
	  'supports' => array(
		  'title',
		  'thumbnail',
	  ),
    )
  );

  register_post_type( 'pap_genre',
    array(
      'labels' => array(
        'name' => __( 'Genres' ),
        'singular_name' => __( 'Genre' )
      ),
      'public' => true,
      'has_archive' => false,
	  'supports' => array(
		  'title',
	  ),
    )
  );

  register_post_type( 'pap_airing',
    array(
      'labels' => array(
        'name' => __( 'Airings' ),
        'singular_name' => __( 'Airing' )
      ),
      'public' => true,
      'has_archive' => false,
	  'supports' => array(
		  'title',
		  'excerpt',
		  'revisions',
		  'thumbnail',
	  ),
    )
  );

  register_post_type( 'pap_staff',
    array(
      'labels' => array(
        'name' => __( 'Staff' ),
        'singular_name' => __( 'Staff' )
      ),
      'public' => true,
      'has_archive' => true,
      'rewrite' => array('slug' => 'staff'),
	  'taxonomies' => array('category'), 
	  'hierarchical' => true,
	  'supports' => array(
		  'title',
		  'editor',
		  'revisions',
		  'thumbnail',
	  ),
    )
  );

  register_post_type( 'pap_position',
    array(
      'labels' => array(
        'name' => __( 'Opportunities' ),
        'singular_name' => __( 'Opportunity' )
      ),
      'public' => true,
      'has_archive' => false,
      'rewrite' => array('slug' => 'opportunities'),
    )
  );

  register_post_type( 'pap_award',
    array(
      'labels' => array(
        'name' => __( 'Awards' ),
        'singular_name' => __( 'Award' )
      ),
      'public' => true,
      'has_archive' => false,
	  'supports' => array(
		  'title',
		  'thumbnail',
	  ),
    )
  );

  register_post_type( 'pap_tweet',
    array(
      'labels' => array(
        'name' => __( 'Tweets' ),
        'singular_name' => __( 'Tweet' )
      ),
      'public' => true,
      'has_archive' => false,
    )
  );

  register_post_type( 'pap_address',
    array(
      'labels' => array(
        'name' => __( 'Addresses' ),
        'singular_name' => __( 'Address' )
      ),
      'public' => true,
      'has_archive' => false,
    )
  );
}

add_filter( 'jetpack_implode_frontend_css', '__return_false' );
function remove_jp_css() {
  wp_deregister_style( 'AtD_style' ); // After the Deadline
  wp_deregister_style( 'jetpack_likes' ); // Likes
  wp_deregister_style( 'jetpack_related-posts' ); //Related Posts
  wp_deregister_style( 'jetpack-carousel' ); // Carousel
  wp_deregister_style( 'grunion.css' ); // Grunion contact form
  wp_deregister_style( 'the-neverending-homepage' ); // Infinite Scroll
  wp_deregister_style( 'infinity-twentyten' ); // Infinite Scroll - Twentyten Theme
  wp_deregister_style( 'infinity-twentyeleven' ); // Infinite Scroll - Twentyeleven Theme
  wp_deregister_style( 'infinity-twentytwelve' ); // Infinite Scroll - Twentytwelve Theme
  wp_deregister_style( 'noticons' ); // Notes
  wp_deregister_style( 'post-by-email' ); // Post by Email
  wp_deregister_style( 'publicize' ); // Publicize
  wp_deregister_style( 'sharedaddy' ); // Sharedaddy
  wp_deregister_style( 'sharing' ); // Sharedaddy Sharing
  wp_deregister_style( 'stats_reports_css' ); // Stats
  wp_deregister_style( 'jetpack-widgets' ); // Widgets
  wp_deregister_style( 'jetpack-slideshow' ); // Slideshows
  wp_deregister_style( 'presentations' ); // Presentation shortcode
  wp_deregister_style( 'jetpack-subscriptions' ); // Subscriptions
  wp_deregister_style( 'tiled-gallery' ); // Tiled Galleries
  wp_deregister_style( 'widget-conditions' ); // Widget Visibility
  wp_deregister_style( 'jetpack_display_posts_widget' ); // Display Posts Widget
  wp_deregister_style( 'gravatar-profile-widget' ); // Gravatar Widget
  wp_deregister_style( 'widget-grid-and-list' ); // Top Posts widget
  wp_deregister_style( 'jetpack-widgets' ); // Widgets
}
add_action('wp_print_styles', 'remove_jp_css' );