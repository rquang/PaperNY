<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
get_header();
?>
<div class="cyan-bg">
	<div class="container">
		<div class="row">
			<div id="cart">
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
<?php get_footer(); ?>
