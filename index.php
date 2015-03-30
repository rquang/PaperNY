<?php
$path = substr($_SERVER['REQUEST_URI'], strlen(parse_url(site_url(),PHP_URL_PATH)));
if(strpos($path, '/staff/') === 0){
	$rest = substr($path, 7);
	include 'archive-pap_staff.php';
	die;
}
?>
	<?php get_header() ?>
		<div class="image">
		index
		</div>
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
		<div id="body">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<h1><span><?php the_title(); ?></span></h1>
			<p><?php the_field('year') ?></p>
			<p><?php the_content(__('(more...)')); ?></p>
			<?php endwhile; else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; ?>
		</div>
	</div>
	<?php get_footer(); ?>
