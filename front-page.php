	<?php get_header() ?>
<?php
function custom_excerpt_length( $length ) {
return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
$airings = get_posts(array('posts_per_page'=>-1,'post_type'=>'pap_airing','order'=>'date'));
echo '<script>var airings = [';
$air = false;
foreach($airings as $a){
	if(!$air){
		$air = $a;
	} else {
		echo ',';
	}
	echo '{white:"'.$a->post_title.'",airtime:"'.$a->post_excerpt.'",image:"'.wp_get_attachment_url( get_post_thumbnail_id($a->ID)).'"}';
}
echo ']</script>';
?>
		<div class="image">
			<?php echo get_the_post_thumbnail($air->ID, 'full') ?>
			<div class="title front">
				<div class="wrapper">
					<div class="left"><</div>
					<div class="content">
						<div class="white"><?php echo $air->post_title ?></div>
						<div class="airtime"><?php echo $air->post_excerpt ?></div>
					</div>
					<div class="right">></div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
	<div id="main">
		<div id="body" class="front">
			<div class="first">
				<div class="reel">
					<h1 class="title"><span>Demo Reel</span></h1>
					<div style="width100%;height:300px;background:#DCDAD5"></div>
				</div>
				<div class="news">
					<h1 class="title"><span>News</span></h1>
					<?php
					$query = new WP_Query( array('post_type'=>'pap_latest', 'posts_per_page' => 2) );
					while($query->have_posts()){
						$query->the_post();
					?>
					<a href="<?php the_permalink() ?>">
					<div class="item">
						<div class="thumb"><?php the_post_thumbnail() ?></div>
						<div class="data">
							<div class="date"><?php echo get_the_date('M j') ?></div>
							<div class="hr"></div>
							<div class="title"><?php the_title() ?></div>
						</div>
						<div class="clear"></div>
					</div>
					</a>
					<?php } ?>
				</div>
				<div class="clear"></div>
				<div class="link"><a href="/the-latest">News ></a></div>
			</div>
			<div class="second">
				<h1><span>ON THE AIR</span></h1>
				<div class="s-w">
					<div class="productions">
						<?php 
						rewind_posts();
						$query2 = new WP_query(array('post_type'=>'pap_productions','posts_per_page'=>6));
						$_i = 0;
						while($query2->have_posts()){
						$_i++;
						$query2->the_post();
						$excerpt = get_the_excerpt();
						?>
						<a href="<?php the_permalink() ?>">
						<div class="production">
							<div class="top">
								<div class="background"><?php the_post_thumbnail(); ?></div>
								<div class="title"><h2><?php the_title(); ?></h2></div>
							</div>
							<div class="bottom">
								<div class="bottom-wrapper">
								<?php
									$broadpost = get_field('broadcaster');
									if(count($broadpost)){
										$post = $broadpost[0];
										setup_postdata( $post );
										?><div class="broadcaster"><?php the_post_thumbnail(array(50,50)); ?></div><?php
										wp_reset_postdata();
									}
								?>
								<div class="excerpt"><?php echo $excerpt; ?></div>
								<div class="clear"></div>
								</div>
							</div>
						</div>
						</a>
						<?php
						if($_i == 3){
							echo '<div class="clear"></div>';
						}
						} ?>
					</div>
					<div class="twitter">
						<div class="inner">
					<?php
					$query3 = new WP_Query(array('post_type'=>'pap_tweet', 'posts_per_page'=>12));
					while($query3->have_posts()){
						$query3->the_post();
					?>
						<div class="tweet">
							<div class="title"><?php the_title(); ?></div>
							<div class="content"><?php the_content(); ?></div>
						</div>
					<?php } ?>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="link"><a href="/productions">Productions ></a></div>
			</div>
			<div class="third">
				<h1><span>STORE</span></h1>
				<div class="store">
					<?php
					$args = array( 'post_type' => 'product', 'posts_per_page' => 3, 'product_cat' => 'dvd');
					$data = get_posts($args);
					?>
				</div>
				<div class="link"><a href="<?php echo site_url()?>/shop">Visit Store ></a></div>
			</div>
		</div>
	</div>
<script>
$(document).ready(function(){
	var air_active = 0;
	var front_title = $('#header .image .title.front');
	$(".left, .right",front_title).css({cursor:'pointer'}).on('click', function(){
		var $t = $(this);
		if( ($t.hasClass('left') && air_active > 0) || ($t.hasClass('right') && air_active < airings.length - 1) ){
			air_active = air_active + ($t.hasClass('left')? -1 : 1);
			$('#header .image > img').attr('src', airings[air_active].image);
			front_title.find('.white').html(airings[air_active].white);
			front_title.find('.airtime').html(airings[air_active].airtime);
		}
	});
});
</script>
	<?php get_footer(); ?>
