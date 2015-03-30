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
</div>
<a href="<?php echo WC()->cart->get_cart_url(); ?>">
<div id="cart">
	<span class="total"><?php echo WC()->cart->get_cart_total(); ?></span>
	<span class="items"><?php echo sprintf (_n( '%d item', '%d items', WC()->cart->cart_contents_count ), WC()->cart->cart_contents_count ); ?></span>
	<span> | CART</span>
	<span class="padder"></span>
</div>
</a>
<div id="shop">
	<div class="wrapper">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>
		<div class="clear"></div>
		<div style="height:100px;"></div>
	</div>
</div>
<?php get_footer(); ?>
