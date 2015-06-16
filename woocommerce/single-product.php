<?php get_header(); ?>
<div class="cyan-bg">
	<div class="container">
		<div class="row">
			<div id="shopping-cart">
				<a href="<?php echo site_url()?>/cart">
					<span class="total"><?php echo WC()->cart->get_cart_total(); ?></span>
					<span class="items"><?php echo sprintf (_n( '%d item', '%d items', WC()->cart->cart_contents_count ), WC()->cart->cart_contents_count ); ?> |</span>
				</a>
			</div>
		</div>
	</div>
</div>
<div id="main">
	<div class="container">
		<div class="row">
			<div id="single-product">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php wc_get_template_part( 'content', 'single-product' ); ?>
				<?php endwhile; // end of the loop. ?>				
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	var container = $('.thumbnails');
	if(container.find('a').length > 3) {
		container.append("<span class='up'></span><span class='down'></span>");
	}
	container.on('click', '.up' , function(){
		$('.thumbnails a:first').appendTo('.thumbnails');
	});
	container.on('click', '.down' , function(){
		$('.thumbnails a:last').prependTo('.thumbnails');
	});
	container.on('click', 'a' ,function(e){
		e.preventDefault();
		if(!$(this).hasClass("active")) {
			$('.images >a img').attr('src', $(this).find('img').attr('src'));
			$('.thumbnails a').removeClass("active");
			$(this).addClass("active");
		}
	});
});
</script>
<script type="text/javascript" src="<?php echo plugins_url(); ?>/woocommerce/assets/js/frontend/add-to-cart-variation.min.js"></script>
<?php get_footer(); ?>
