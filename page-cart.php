	<?php get_header() ?>
	</div>
	<div id="main">
		<div class="top">
			<div class="title">
				<div class="padder"></div>
				<div class="text"></div>
				<div class="clear"></div>
			</div>
			<div class="content"></div>
		</div>
		<div id="body" class="cart">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<h1><span><?php the_title(); ?></span></h1>
			<p><?php the_content(__('(more...)')); ?></p>
			<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; ?>
		</div>
	</div>
	<?php get_footer(); ?>
