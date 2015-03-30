	<?php get_header() ?>
<?php
$slugcat = get_category_by_slug($rest);
$head_img = category_image_src( array( 'size' => 'full', 'term_id' => $slugcat->cat_ID ) , false );
$slugposts = get_posts(array('posts_per_page'=>-1, 'post_type' => 'pap_staff', 'category' => $slugcat->cat_ID));
$staff = array();
foreach(get_categories(array('type'=>'pap_staff','parent'=>25)) as $parent){
	$staff[] = array('data' => $parent, 'children' => get_categories(array('type'=>'pap_staff','parent'=>$parent->cat_ID)));
}
?>
		<div class="image">
			<img src="<?php echo $head_img; ?>">
			<div class="title">
			</div>
		</div>
	</div>
	<div id="main">
		<div class="top">
			<div class="content">
				<h1>Paperny Entertainment</h1>
				<div class="controls staff">
				<?php foreach($staff as $t1){
					$catdata = $t1['data'];
					echo '<a href="', site_url() ,'/staff/', $catdata->slug ,'"><div>', $catdata->name ,'</div></a>';
					foreach($t1['children'] as $catdata){
						echo '<a href="', site_url() ,'/staff/', $catdata->slug ,'"><div>', $catdata->name ,'</div></a>';
					}
				}
				?>
				</div>
			</div>
		</div>
		<div id="body">
			<h1><span><? echo $slugcat->name; ?></span></h1>
			<div class="staff_wrapper">
				<?php if (count($slugposts)) : while ($post = array_shift($slugposts)) : setup_postdata($post); ?>
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
