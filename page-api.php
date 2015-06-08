<?php
function custom_excerpt_length( $length ) {
return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
if($_GET['type'] == 'product'){
	$args = array();
	if(isset($_GET['order'])){
		switch($_GET['order']){
			case 'price_desc': 
				$args['order'] = 'DESC';
				$args['orderby'] = 'meta_value_num';
				$args['meta_key'] = '_price';
				break;
			case 'price': 
				$args['order'] = 'ASC';
				$args['orderby'] = 'meta_value_num';
				$args['meta_key'] = '_price';
				break;
			default:
				$args['order'] = 'DESC';
				$args['orderby'] = 'date';
		}
	}
	$args['post_type'] = 'product';
	$args['posts_per_page'] = 12;
	if(isset($_GET['category'])){
		$args['product_cat'] = $_GET['category'];
	} elseif(isset($_GET['tag'])){
		$args['product_tag'] = $_GET['tag'];
	}
	$args['offset'] = isset($_GET['offset'])? (int)$_GET['offset'] : 0;
	$query = new WP_Query($args);
	$data = array();
	while($query->have_posts()){ $query->the_post();
		$product = new WC_Product(get_the_ID());
		$data[] = array(
			'link' => get_permalink(),
			'thumb' => get_the_post_thumbnail(get_the_ID(), 'full'),
			'title' => get_the_title(),
			'price' => $product->get_price_html(),
		);
	}
	die(json_encode($data));
}
$args['post_type'] = isset($_GET['type']) && $_GET['type'] == 'news' ? 'pap_latest' : 'pap_productions';
$args['offset'] = isset($_GET['offset'])? (int)$_GET['offset'] : 0;
$args['order'] = 'DESC';
$args['orderby'] = 'date';
if(isset($_GET['order']) && $_GET['order'] == 'alpha'){
	$args['order'] = 'ASC';
	$args['orderby'] = 'title';
}
$args['posts_per_page'] = isset($_GET['posts']) && (int)$_GET['posts'] ? (int)$_GET['posts'] : 12;
$filters = array();
foreach(array('genre', 'broadcaster') as $key){
	if(isset($_GET[$key]) && (int)$_GET[$key]){
		$filters[$key] = (int)$_GET[$key];
	}
}
if(count($filters)){
	$args['meta_query'] = array();
	if(count($filters)>1){
		$args['meta_query']['relation'] = 'AND';
	}
	foreach($filters as $key=>$val){
		$args['meta_query'][] = array(
			'key' => $key,
			'value' => $val,
			'compare' => 'LIKE'
		);
	}
}
if(isset($_GET['search'])){
	$args['s'] = $_GET['search'];
}

$theposts = get_posts($args);
$data = array();
foreach($theposts as $post){
	setup_postdata($post);
	$t = array();
	$t['title'] = get_the_title();
	$t['id'] = $post->ID;
	$t['link'] = get_permalink();
	$t['date'] = get_the_date('M . j . Y');
	$t['thumb'] = get_the_post_thumbnail($post->ID, 'full');
	$t['excerpt'] = get_the_excerpt();
	$t['year'] = get_field('year');
	$t['episodes'] = get_field('episodes');
	$broadcaster = get_field('broadcaster');
	if($broadcaster){
		$b = reset($broadcaster);
		$t['broadcaster'] = get_the_post_thumbnail($b->ID, 'full');
	}
	$data[] = $t;
}
die(json_encode($data));
