<?php get_header() ?>
<div id="main">
	<div class="container">
		<div class="row">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<h1 class="title"><span><?php the_title(); ?></span></h1>
				<p><?php the_content(__('(more...)')); ?></p>
			<?php endwhile; endif; ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
