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
<script>
jQuery(document).ready(function($){
	var air_active = 0;
	var caption = $('#slider .caption .content');
	$("#slider .left, #slider .right").on('click', function(){
		var $t = $(this);
		if( ($t.hasClass('left') && air_active > 0) || ($t.hasClass('right') && air_active < airings.length - 1) ){
			air_active = air_active + ($t.hasClass('left')? -1 : 1);
			$('#slider > img').attr('src', airings[air_active].image);
			caption.find('h2').html(airings[air_active].white);
			caption.find('h3').html(airings[air_active].airtime);
		}
	});
});
</script>
<div id="slider">
	<?php echo get_the_post_thumbnail($air->ID, 'full') ?>
	<div class="caption">
		<div class="container">
			<div class="row">
				<div class="left"></div>
				<div class="content">
					<h2><?php echo $air->post_title ?></h2>
					<h3><?php echo $air->post_excerpt ?></h3>
				</div>
				<div class="right"></div>
			</div>
		</div>
	</div>
</div>
<div id="main">
	<div class="container">
		<div class="row">
			<div id="reel">
				<h2 class="title"><span>Demo Reel</span></h2>
				<a target="_blank" href="//player.vimeo.com/video/118300083" class="fancybox fancybox.iframe vimeo">
					<img style="width:100%;height:auto" src="<?php echo site_url(); ?>/wp-content/uploads/2015/06/demo-screen.png"></img>
				</a>
			</div>
			<div id="news">
				<h2 class="title"><span>News</span></h2>
				<?php
				$query = new WP_Query( array('post_type'=>'pap_latest', 'posts_per_page' => 2) );
				while($query->have_posts()){
					$query->the_post();
				?>
				<a href="<?php the_permalink() ?>" class="item row">
					<?php the_post_thumbnail() ?>
					<div class="content">
						<h4><?php echo get_the_date('M j') ?></h4>
						<h3><?php the_title() ?></h3>
					</div>
				</a>
				<?php } ?>
				<a href="<?php echo site_url()?>/the-latest" class="link">News</a>				
			</div>
			<div id="ontheair">
				<h2 class="title"><span>On The Air</span></h2>
				<div class="row">
					<div class="productions">
						<div class="row">
							<?php 
							rewind_posts();
							$query2 = new WP_query(array('post_type'=>'pap_productions','posts_per_page'=>6));
							$_i = 0;
							while($query2->have_posts()){
							$_i++;
							$query2->the_post();
							$excerpt = get_the_excerpt();
							?>
							<a href="<?php the_permalink() ?>" class="item">
								<div class="top">
									<?php the_post_thumbnail(); ?>
									<span>
										<h3><?php the_title(); ?></h3>
									</span>
								</div>
								<div class="bottom">
									<div class="inner">
										<?php
											$broadpost = get_field('broadcaster');
											if(count($broadpost)){
												$post = $broadpost[0];
												setup_postdata( $post );
												the_post_thumbnail(array(50,50));
												wp_reset_postdata();
											}
										?>
										<div class="excerpt">
											<p><?php echo $excerpt; ?></p>
										</div>
									</div>
								</div>
							</a>
							<?php } ?>
						</div>					
					</div>
					<div class="twitter">
						<a class="twitter-timeline" data-dnt="true" href="https://twitter.com/Paperny" data-widget-id="606765861458853888">Tweets by @Paperny</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script> 
					</div>
					<?php /*
					<div class="twitter">
						<div class="inner">
							<?php
							$query3 = new WP_Query(array('post_type'=>'pap_tweet', 'posts_per_page'=>12));
							while($query3->have_posts()){
								$query3->the_post();
							?>
								<div class="tweet">
									<h3><?php the_title(); ?></h3>
									<?php the_content(); ?>
								</div>
							<?php } ?>
						</div>
						<a href="/productions" class="link">Productions</a>
					</div>
					*/
					?>
				</div>
			</div>
			<?php /*
			<div id="store">
				<h2 class="title"><span>Store</span></h2>
				<?php
					$args = array( 'post_type' => 'product', 'posts_per_page' => 3, 'product_cat' => 'dvd');
					$data = get_posts($args);
				?>
				<a href="<?php echo site_url()?>/shop" class="link">Visit Store</a>
			</div>
			*/ ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>
