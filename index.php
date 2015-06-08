<?php
$path = substr($_SERVER['REQUEST_URI'], strlen(parse_url(site_url(),PHP_URL_PATH)));
if(strpos($path, '/staff/') === 0){
	$rest = substr($path, 7);
	include 'archive-pap_staff.php';
	die;
}
?>
<?php get_header() ?>
<?php if(get_field('header')){ ?>
	<div id="top-image" class="overlay">
		<div class="image">
			<img src="<?php the_field('header'); ?>">
		</div>
	</div>
<?php } ?>
<div id="main">
	<div class="container">
		<div class="row">
			<div class="full-content mb">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<h1 class="title"><span><?php the_title(); ?></span></h1>
					<p><?php the_field('year') ?></p>
					<p><?php the_content(__('(more...)')); ?></p>
				<?php endwhile; else: ?>
					<div class="empty">
						<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
					</div>
				<?php endif; ?>								
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>
