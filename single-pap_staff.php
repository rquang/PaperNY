	<?php get_header() ?>
<?php
$currentcat = get_the_category();
$curcat = $currentcat[0];
?>
		<div class="image">
			<div class="title">
				<div class="padder"></div>
				<div class="text">Paperny Entertainment</div>
				<div class="triangle"></div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<div id="main">
		<div class="top">
			<div class="content"></div>
		</div>
		<div id="body">
			<h1><span><? echo $curcat->name; ?></span></h1>
			<div class="staff_wrapper">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="staff">
					<div class="left">
						<?php the_post_thumbnail(); ?>
					</div>
					<div class="delim"></div>
					<div class="right">
						<div class="name"><?php the_title() ?></div>
						<div class="position"><?php the_field('position') ?></div>
						<div class="hr"></div>
						<div class="desc">
								<?php the_content(); ?>
						</div>
					</div>
				</div>
				<?php endwhile; endif; ?>
			</div>
		</div>
	</div>
	<?php get_footer(); ?>
