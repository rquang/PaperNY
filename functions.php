<?php

add_theme_support( 'woocommerce' );

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
	  'taxonomies' => array('post_tag'),
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
