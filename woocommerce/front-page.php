<?php
	$fquery = new WP_Query(array('post_type'=>'product', 'product_tag'=>'featured', 'posts_per_page'=>5));
	$shop_featured = array();
	while($fquery->have_posts()){
		$fquery->the_post();
		$product = new WC_Product( get_the_ID() );
		$shop_featured[] = array(
			'thumb' => get_the_post_thumbnail(get_the_ID(), 'full'),
			'title' => get_the_title(),
			'desc' => get_the_excerpt(),
			//'price' => get_post_meta(get_the_ID(), "_price", true),
			//'x' => $product->price,
			'price' => $product->get_price_html(),
			'link' => get_permalink(),
		);
	}
?>
<div id="shop-image">
	<div class="container">
		<div class="row">
			<div class="left"></div>
			<div class="preview">
				<div class="row">
					<div class="thumb">
						<?php echo $shop_featured[0]['thumb']; ?>
					</div>
					<div class="data">
						<h3 class="name">
							<?php echo $shop_featured[0]['title']; ?>
						</h3>
						<div class="desc">
							<p><?php echo $shop_featured[0]['desc']; ?></p>
						</div>
						<p class="price">
							<?php echo $shop_featured[0]['price']; ?>
						</p>
						<div class="shop-link">
							<a href="<?php echo $shop_featured[0]['link']; ?>">Shop Now</a>							
						</div>
					</div>
				</div>
			</div>
			<div class="right"></div>
		</div>
	</div>
</div>
<div id="main">
	<div class="container">
		<div class="row">
			<div id="searchbar" class="tab right">
				<a href="<?php echo site_url() ?>/shipping-delivery/">Shipping &amp; Delivery</a>
				<a href="<?php echo site_url() ?>/return-policy/">Return Policy</a>
				<span>Search</span>
				<form>
				    <input type="text" placeholder="Search..." required>
				    <button type="submit"><span class="fa fa-search"></span></button>
				</form>
			</div>
			<h1 class="title"><span>Paperny Entertainment Store</span></h1>
			<div id="category">
				<?php foreach(array('dvd', 'clothing', 'merchandise') as $pcat){
					$cat = get_term_by('slug',$pcat,'product_cat');
					$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
				?>
					<a href="<?php echo get_term_link( $cat->term_id, 'product_cat' ); ?>" class="product-item product-category">
						<div class="thumb"><img src="<?php echo wp_get_attachment_url( $thumbnail_id ); ?>"></div>
						<span class="name"><?php echo $cat->name; ?></span>
					</a>
				<?php } ?>
			</div>
		</div>
	</div>
	<div id="dvd">
		<div class="container">
			<div class="row">
				<h2 class="title"><span>DVDS</span></h2>
				<?php
					$dquery = new WP_Query(array('post_type'=>'product', 'product_cat' => 'dvd', 'product_tag'=>'featured', 'posts_per_page'=>4));
					while($dquery->have_posts()){ 
						$dquery->the_post();
						$xproduct = new WC_Product( get_the_ID() );
						?>
						<a href="<?php echo get_permalink(); ?>" class="product-item product-dvd">
							<div class="thumb"><?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?></div>
							<span class="name"><?php echo get_the_title(); ?></span>
							<p class="price"><?php echo $xproduct->get_price_html(); ?></p>
						</a>
						<?php
					}
				?>
				</div>
				<a href="<?php echo get_term_link( $cat->term_id, 'product_cat' ); ?>" class="link">DVDs</a>			
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<h2 class="title"><span>Clothing</span></h2>
			<div id="clothing">
				<div class="main">
				<?php 
					$dquery = new WP_Query(array('post_type'=>'product', 'product_cat' => 'clothing', 'product_tag'=>'featured', 'posts_per_page'=>3));
					while($dquery->have_posts()){ $dquery->the_post();
						$xproduct = new WC_Product( get_the_ID() ); ?>
							<a href="<?php echo get_permalink(); ?>" class="product-item product-clothing">
								<?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
								<div class="info">
									<div class="name"><?php echo get_the_title(); ?></div>
									<div class="price"><?php echo $xproduct->get_price_html(); ?></div>
								</div>
								<span class="link">Shop Now</span>
							</a>
					<?php break; } ?>					
				</div>
				<div class="side">
					<div class="row">
						<?php while($dquery->have_posts()){ 
							$dquery->the_post();?>
								<a href="<?php echo get_permalink() ?>" class="product-item product-clothing">
									<?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
								</a>
						<?php } ?>
					</div>
					<a href="<?php echo get_term_link( $cat->term_id, 'product_cat' ); ?>" class="link">Clothing</a>							
				</div>
			</div>
			<h2 class="title"><span>Merchandise</span></h2>
			<div id="merchandise">
				<?php
					$dquery = new WP_Query(array('post_type'=>'product', 'product_cat' => 'merchandise', 'product_tag'=>'featured', 'posts_per_page'=>3));
					while($dquery->have_posts()){ $dquery->the_post();
						?>
						<a href="<?php echo get_permalink(); ?>" class="product-item product-merch">
							<?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
						</a>
						<?php
					}
				?>
				<a href="<?php echo get_term_link( $cat->term_id, 'product_cat' ); ?>" class="link">Merchandise</a>			
			</div>
		</div>
	</div>
</div>
<script>
var shop_featured = <?php echo json_encode($shop_featured); ?>;
$(document).ready(function(){
	var original = {order:'date',type:'news',posts:8};
	var args = {order:'date',type:'news',posts:8};
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
	var shop_active = 0;
	$('#shop-image .right, #shop-image .left').on('click', function(){
		var $t = $(this);
		var $e = $('#shop-image .preview');
		if( ($t.hasClass('left') && shop_active > 0) || ($t.hasClass('right') && shop_active < shop_featured.length - 1) ){
			shop_active += ($t.hasClass('left')?-1:1);
			var s = shop_featured[shop_active];
			$e.find('.thumb').html(s.thumb);
			$e.find('.name').html(s.title);
			$e.find('.desc p').html(s.desc);
			$e.find('.price').html(s.price);
			$e.find('.shop-link a').attr('href', s.link);
		}
	});
});
</script>
<?php get_footer(); ?>
