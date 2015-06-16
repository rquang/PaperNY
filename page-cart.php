<?php get_header() ?>
<div id="main">
	<div class="container">
		<div class="row">
			<h1 class="title"><span>Cart</span></h1>
			<div id="cart">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; endif; ?>
			</div>			
		</div>
	</div>
</div>
<?php get_footer(); ?>
