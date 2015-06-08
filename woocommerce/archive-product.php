<?php get_header() ?>
<?php
$prefix = parse_url(site_url(), PHP_URL_PATH);
$url = substr($_SERVER['REQUEST_URI'], strlen($prefix));
if($url == '/shop/'){
	include 'front-page.php';
	die();
}
$parts = explode('/', $url);
$args = array(
	'post_type' => 'product',
	'posts_per_page' => 12,
	'orderby' => 'meta_value_num',
	'order' => 'ASC',
	'meta_key' => '_price',
);
$ft_args = array(
	'post_type' => 'product',
	'posts_per_page' => 3,
);

if($parts[1] == 'product-category'){
	$args['product_cat'] = $parts[2];
	$ft_args['product_cat'] = $parts[2];
	$ft_args['product_tag'] = 'featured';
} elseif($parts[1] == 'product-tag') {
	$args['product_tag'] = $parts[2];
	$ft_args['product_tag'] = $parts[2].'+featured';
} else {
	die();
}
?>
<div id="main">
	<div class="container">
		<div class="row">
			<div class="tab right">
				<a href="<?php echo site_url() ?>/shipping-delivery/">Shipping &amp; Delivery</a>
				<a href="<?php echo site_url() ?>/return-policy/">Return Policy</a>
				<span>Search</span>
				<form>
				    <input type="text" placeholder="Search..." required>
				    <button type="submit"><span class="fa fa-search"></span></button>
				</form>
			</div>
			<div id="filters">
				<div class="tab left cyan">
					<span>Categories</span>
				</div>
				<ul>
				<?php foreach(get_categories(array('taxonomy'=>'product_cat','orderby'=>'name','hierarchical'=>1,'hide_empty'=>1)) as $cat){
					if($cat->category_parent != 0){continue;}
					echo '<li><a href="',get_term_link((int)$cat->term_id, 'product_cat'),'">',$cat->name,'</a></li>';
				}
				?>
				</ul>
				<div class="tab left cyan remove">
					<div id="cart">
						<a href="<?php echo site_url()?>/cart">
							<span class="total"><?php echo WC()->cart->get_cart_total(); ?></span>
							<span class="items"><?php echo sprintf (_n( '%d item', '%d items', WC()->cart->cart_contents_count ), WC()->cart->cart_contents_count ); ?> |</span>
						</a>
					</div>					
				</div>				
			</div>
			<div id="product-list">
				<h2 class="title"><span>Featured</span></h2>
				<div class="featured">
					<?php
					$fquery = new WP_Query($ft_args);
					while($fquery->have_posts()){ $fquery->the_post();$product = new WC_Product(get_the_ID()); ?>
						<a href="<?php echo get_permalink(); ?>" class="product-item">
							<div class="thumb"><?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?></div>
							<div class="name"><?php echo get_the_title(); ?></div>
							<div class="price"><?php echo $product->get_price_html(); ?></div>
						</a>
					<?php } ?>
				</div>
			</div>			
		</div>
	</div>
</div>
<?php get_footer(); ?>
