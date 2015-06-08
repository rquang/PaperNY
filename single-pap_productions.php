<?php get_header(); ?>
<?php if(get_field('header')){ ?>
	<div id="top-image" class="overlay">
		<div class="image">
			<img src="<?php the_field('header'); ?>">
		</div>
		<div class="caption">
			<div class="container">
				<div class="row">
					<div class="content">
						<h2><?php the_title() ?></h2>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<div id="main">
	<div class="container">
		<div class="row">
			<div id="production">
				<div class="hr"></div>
				<div class="top">
					<table>
						<tbody>
							<tr>
								<td class="broadcaster">
									<?php
									$broadpost = get_field('broadcaster');
									if(count($broadpost)){
										$post = $broadpost[0];
										setup_postdata( $post );
										the_post_thumbnail();
										wp_reset_postdata();
									}
									?>
								</td>
								<td class="episodes">
									<?php the_field('episodes') ?>
								</td>
								<td class="genre">
									<?php echo get_field('genre')[0]->post_title ?>
								</td>
							</tr>
						</tbody>
					</table>
					<div class="hr"></div>					
				</div>
				<div class="slideshow"></div>
				<div class="content">
					<?php the_content(); ?>	
				<div class="social-media">
					<ul>
						<?php foreach(array('facebook'=>'', 'twitter'=>'https://twitter.com/') as $key=>$url){
							if(get_field($key)){
								echo '<li><a target="_blank" href="',$url,get_field($key),'" class="'.$key.'"></a></li>';
							}
						}
						if(get_field('website')){
							echo '<li><a target="_blank" href="',get_field('website'),'" class="link"></a></li>';
						}
						?>
					</ul>
				</div>						
				</div>
				<?php 
					$tquery = new WP_Query( array('post_type'=>'pap_latest', 'posts_per_page' => -1, 'meta_query' => array (array ('key' => 'productions', 'value' => $post->ID, 'compare' => 'LIKE'))) );
					if($tquery->have_posts()){
				?>
					<div class="news">
						<h2>News</h2>
						<?php while($tquery->have_posts()){
						$tquery->the_post();
						?>
						<a href="<?php the_permalink() ?>" class="item">
							<p><?php echo get_the_date('M . j . Y') ?></p>
							<h3><?php the_title() ?></h3>
						</a>
						<?php } ?>			
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	var $obj = $('#production .slideshow');
	if($('#production .gallery, #production video').length){
		var limit = 6;
		var lim = 6;
		$('<div class="display"><img></div><div class="nav"><div class="left"></div><div class="right"></div></div><div class="images"><div class="row"></div>').appendTo($obj);
		var row = $obj.find('.row');
		var display = $obj.find('.display');
		$('#production video').each(function(){
			lim--;
			$(this).appendTo(row).removeAttr('controls');
		});
		$('#production .gallery').each(function(){
			$(this).find('.gallery-item a').each(function(){
				lim--;
				var $a = $(this);
				var link = $a.attr('href');
				var img = $a.find('img').attr('src');
				var e = $('<div class="image"><img src="'+img+'"></div>').appendTo(row);
				if(lim < 0){
					e.hide();
				}
				if(link != img){
					e.data('src', link);
				}
			});
			$(this).remove();
		});
		row.on('click', '*', function(){
			display.empty().html($(this).clone());
			if($(this).prop("tagName").toLowerCase() == 'video'){
				display.find('video').attr('controls', 'controls');
			}
			$obj.find('.active').removeClass('active');
			$(this).addClass('active');
		});
		$obj.on('click', '.nav div',function(){
			var image = row.find('.active');
			var queue = image.prev();
			if($(this).hasClass('right')){
				queue = image.next();
			}
			if(queue.length) {
				display.empty().html(queue.clone().show());
				if(queue.prop("tagName").toLowerCase() == 'video'){
					display.find('video').attr('controls', 'controls');
				}
				$obj.find('.active').removeClass('active');
				queue.addClass('active');
			}
		});
		$('#production .slideshow .images .row *:first').trigger('click');
	} else {
		$obj.remove();
	}
});
</script>
<style>
.display video {
	width: 100%;
	height: auto;
}
.slideshow .row video {
	width: 33.333%;
	float: left;
	max-height: 90px;
	padding: 0 3px 6px;
}
#production .social-media ul li {
	margin-right: 10px;
}
</style>
<?php get_footer(); ?>
