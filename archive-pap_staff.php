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
<?php if($head_img){ ?>
	<div id="top-image" class="overlay">
		<div class="image">
			<img src="<?php echo $head_img; ?>">
		</div>
		<div class="caption">
			<div class="container">
				<div class="row">
					<div class="content">
						<h2>PaperNY Entertainment</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<div id="staff-options">
	<div class="container">
		<div class="row">
			<div class="controls">
				<ul>
					<?php foreach($staff as $t1){
						$catdata = $t1['data'];
						echo '<li><a href="', site_url() ,'/staff/', $catdata->slug ,'">', $catdata->name ,'</a></li>';
						foreach($t1['children'] as $catdata){
							echo '<li><a href="', site_url() ,'/staff/', $catdata->slug ,'">', $catdata->name ,'</a></li>';
						}
					}
					?>
				</ul>
				<!--
				<ul>
					<li>						<a href="">Vancouver</a>
					</li>
					<li>						<a href="">Production</a>
					</li>
					<li>						<a href="">Finance</a>
					</li>
					<li>						<a href="">Executives</a>
					</li>
					<li>						<a href="">Business &amp; Legal Affairs</a>
					</li>
					<li>						<a href="">Development</a>
					</li>
					<li>						<a href="">Operations</a>
					</li>
					<li>						<a href="">Post Production</a>
					</li>
					<li>						<a href="">New York</a>
					</li>
				</ul>
				-->	
			</div>		
		</div>
	</div>
</div>
<div id="main">
	<div class="container">
		<div class="row">
			<h1 class="title"><span><? echo $slugcat->name; ?></span></h1>
			<div id="staff">
				<?php if (count($slugposts)) : while ($post = array_shift($slugposts)) : setup_postdata($post); ?>
					<div class="item">
						<div class="image">
							<?php the_post_thumbnail(); ?>
						</div>
						<div class="info">
							<h2 class="name"><?php the_title() ?></h2>
							<h3 class="position"><?php the_field('position') ?></h3>
							<div class="desc">
									<?php the_content(); ?>
							</div>
						</div>
					</div>
				<?php endwhile; endif; ?>				
			</div>			
		</div>
	</div>
</div>
<?php get_footer(); ?>
