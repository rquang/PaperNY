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
				<div id="searchbar">
					<span>Search</span>
					<form>
					    <input type="text" placeholder="Search..." required>
					    <button type="submit"><i class="fa fa-search"></i></button>
					</form>					
				</div>
				<div id="shopping-cart">
					<a href="<?php echo site_url()?>/cart">
						<?php echo WC()->cart->get_cart_total(); ?>
						<span class="items"><?php echo sprintf (_n( '%d item', '%d items', WC()->cart->cart_contents_count ), WC()->cart->cart_contents_count ); ?> |</span>
					</a>
				</div>
			</div>
			<div id="product-filters">
				<select name="category">
					<option value="">Categories</option>
				    <?php 
				        $get_parent_cats = array(
				            'parent' => '0',
				            'taxonomy' => 'product_cat',
				            'hide_empty' => '0'
				        ); 
				        $all_categories = get_categories( $get_parent_cats ); 
				        foreach( $all_categories as $single_category ){
				            $catID = $single_category->cat_ID;
				            $catSlug = $single_category->slug;
				            echo '<option value="' . get_term_link( $catSlug, 'product_cat' )  . '">' . $single_category->name . '</option>';
				            $get_children_cats = array(
				                'child_of' => $catID,			            
				                'taxonomy' => 'product_cat',
				            	'hide_empty' => '0'
				            );
				            $child_cats = get_categories( $get_children_cats );
				            if (sizeof($child_cats) > 0) {
				                foreach( $child_cats as $child_cat ){
			           				$childSlug = $child_cat->slug;
				                    echo '<option value="' . get_term_link( $childSlug, 'product_cat' )  . '">- ' . $child_cat->name . '</option>';
				                }
				        	}
				        }
				    ?>
				</select>
				<div class="tab left cyan">
					<span>Categories</span>
				</div>
			    <?php 
			        $get_parent_cats = array(
			            'parent' => '0',
			            'taxonomy' => 'product_cat',
			            'hide_empty' => '0'
			        ); 
			        $all_categories = get_categories( $get_parent_cats ); 
			        foreach( $all_categories as $single_category ){
			            $catID = $single_category->cat_ID;
			            $catSlug = $single_category->slug;
			            echo '<div class="filter-category"><a href="' . get_term_link( $catSlug, 'product_cat' )  . '">' . $single_category->name . '</a>';
			            $get_children_cats = array(
			                'child_of' => $catID,			            
			                'taxonomy' => 'product_cat',
			            	'hide_empty' => '0'
			            );
			            $child_cats = get_categories( $get_children_cats );
			            if (sizeof($child_cats) > 0) {
				            echo '<ul class="children">';
				                foreach( $child_cats as $child_cat ){
			           				$childSlug = $child_cat->slug;
				                    echo '<li><a href="' . get_term_link( $childSlug, 'product_cat' )  . '">' . $child_cat->name . '</a></li>';
				                }
				            echo '</ul>';
			        	}
			        	echo '</div>';
			        }
			    ?>
			    <!--
				<div id="shopping-cart" class="tab left cyan remove">
					<a href="<?php echo site_url()?>/cart">
						<span class="total"><?php echo WC()->cart->get_cart_total(); ?></span>
						<span class="items"><?php echo sprintf (_n( '%d item', '%d items', WC()->cart->cart_contents_count ), WC()->cart->cart_contents_count ); ?> |</span>
					</a>
				</div>	
				-->				
			</div>
			<div id="product-list">
				<h2 class="title top"><span>Featured</span></h2>
				<div class="featured">
					<?php
					$fquery = new WP_Query($ft_args);
					while($fquery->have_posts()){ $fquery->the_post();$product = new WC_Product(get_the_ID()); ?>
						<a href="<?php echo get_permalink(); ?>" class="product-item">
							<div class="thumb">
								<div class="inner"><?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?></div>
							</div>
							<p class="name"><?php echo get_the_title(); ?></p>
							<p class="price"><?php echo $product->get_price_html(); ?></p>
						</a>
					<?php } ?>
				</div>
				<div class="sort">
					<span>Sort By</span>
					<select name="sort">
						<option value="price">Price (Low to High)</option>
						<option value="price_desc">Price (High to Low)</option>
						<option value="date">Newest</option>}
					</select>
				</div>
				<div class="products">
					<?php
					$query = new WP_Query($args);
					while($query->have_posts()){ $query->the_post();$product = new WC_Product(get_the_ID()); ?>
					<a href="<?php echo get_permalink(); ?>" class="product-item">
						<div class="thumb">
							<div class="inner"><?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?></div>
						</div>
						<p class="name"><?php echo get_the_title(); ?></p>
						<p class="price"><?php echo $product->get_price_html(); ?></p>
					</a>
					<?php } ?>
					<div class="clear lazyload"></div>	
				</div>
			</div>			
		</div>
	</div>
</div>
<div id="template" style="display:none">
	<a class="product-item">
		<div class="thumb">
			<div class="inner"></div>
		</div>
		<p class="name"></p>
		<p class="price"></p>
	</a>
</div>
<script>
jQuery(document).ready(function($){
	var wrapper = $('#product-list .products');
	var args = {'order':'price', 'type': 'product'};
	<?php if(isset($args['product_cat'])){
		echo 'args.category = "',$args['product_cat'],'";';
	} elseif(isset($args['product_tag'])){
		echo 'args.tag = "',$args['product_tag'],'";';
	} ?>
	var original = args;
	$("#searchbar >span").on("click",function(){
		$(this).fadeOut(function(){
			$("#searchbar form").css("display","inline-block");
		});
	});
	$( "#searchbar form" ).submit(function(e) {
	  e.preventDefault();
	  args = original;
	  args.search = $("#searchbar input").val().trim();
	  $("#latest-container .item").remove();
	  $(window).trigger('lazyload');
	});
	$('#product-filters select').on('change',function(){
		window.location.href = $(this).val();
	});
	$('.sort select').on('change',function(){
		args.order = $(this).val();
		wrapper.html('<div class="clear lazyload">');
		$(window).trigger('lazyload');
	});
	$(window).on('resize scroll lazyload', function(){
		if($('.lazyload').length && isElementInViewport($('.lazyload'))){
			$('.lazyload').remove();
			args.offset = wrapper.find('a').length;
			$.ajax({
				dataType: 'json',
				url: '<?php echo site_url() ?>/api',
				data: args,
				success: function(d){
					for(var i = 0; i<d.length; i++){
						var p = d[i];
						var e = $('#template a').clone().appendTo(wrapper);
						e.attr('href', p.link);
						e.find('.thumb .inner').html(p.thumb);
						e.find('.name').html(p.title);
						e.find('.price').html(p.price);
						e.show();
					}
					wrapper.append('<div class="clear lazyload"></div>');
				}
			});
		}
	});
});
</script>
<?php get_footer(); ?>
