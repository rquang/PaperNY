<?php $has_items = false; if (have_posts()) : the_post();$has_items = true; endif; ?>
	<?php get_header() ?>
		<div class="image">
			<div class="thumb-header">
				<?php if(get_field('header')){ ?><img src="<?php the_field('header'); ?>"><?php } ?>
			</div>
			<div class="top-news">
				<a href="<?php the_permalink(); ?>">
					<div class="wrapper">
						<div class="cat-title">>>NEWS</div>
						<div class="latest-title"><h1><?php if($has_items)the_title(); ?></h1></div>
						<div class="delimeter"></div>
						<div class="date"><?php if($has_items)the_date('M . j . Y') ?></div>
						<div class="text"><?php if($has_items)the_excerpt(); ?></div>
						<div class="clear"></div>
						<div class="link"><?php if($has_items){?>>><span>MORE</span><?php } ?></div>
					</div>
				</a>
			</div>
		</div>
	</div>
	<div id="main">
		<div class="top">
			<div class="content"></div>
		</div>
		<div id="body">
			<div class="category_wrapper">
				<div class="search-holder"><div class="search" data-link="/the-latest">Search</div></div>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<a href="<?php the_permalink(); ?>" class="wrapper_link latest-link">
				<div class="latest">
					<div class="delimeter"></div>
					<div class="date"><?php echo get_the_date('M . j . Y') ?></div>
					<div class="wrapper">
						<div class="title"><h2><?php the_title(); ?></h2></div>
						<div class="image">
							<?php 
								the_post_thumbnail( 'full' );
								$prod = get_field('productions');
								if(count($prod)){
									$post = $prod[0];
									setup_postdata( $post );
									?><div class="subtitle"><?php the_title(); ?></div><?php
									wp_reset_postdata();
								}
							?>
							</div>
						<div class="excerpt">
							<?php the_excerpt(); ?>
						</div>
						<div class="more">>><span>MORE</span></div>
					</div>
				</div>
				</a>
				<?php endwhile; else: ?>
				<p><?php _e($has_items?'No other posts matched your criteria':'Sorry, no posts matched your criteria.'); ?></p><?php endif; ?>
			</div>
		</div>
	</div>
	<?php get_footer(); ?>
