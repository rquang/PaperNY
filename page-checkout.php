<?php get_header() ?>
<div id="main">
	<div class="container">
		<div class="row">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<?php the_content(__('(more...)')); ?>
			<?php endwhile; endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
