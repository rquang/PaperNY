		<?php get_header(); ?>
		<div class="image">
			<?php if(get_field('header')){ ?><img class="production" src="<?php the_field('header'); ?>"><?php } ?>
			<div class="overlay"></div>
		</div>
	</div>
	<div id="main">
		<div class="top">
			<div class="content">
				<h1><?php the_title() ?></h1>
			</div>
		</div>
		<div id="body">
<div id="production">
	<div class="hr"></div>
	<div class="left">
		<div class="data">
			<?php
				$broadpost = get_field('broadcaster');
				if(count($broadpost)){
					$post = $broadpost[0];
					setup_postdata( $post );
					?><div class="broadcaster"><?php the_post_thumbnail(); ?></div><?php
					wp_reset_postdata();
				}
			?>
			<div class="episodes"><?php the_field('episodes') ?></div>
			<div class="genre"><?php echo get_field('genre')[0]->post_title ?></div>
			<div class="clear"></div>
		</div>
		<div class="hr"></div>
		<div class="content">
			<?php the_content(); ?>
		</div>
		<div class="social">
		<?php foreach(array('facebook'=>'', 'twitter'=>'https://twitter.com/') as $key=>$url){
			if(get_field($key)){
				echo '<a target="_blank" href="',$url,get_field($key),'"><div class="icon sm '.$key.'"></div></a>';
			}
		}
		?>
		</div>
	</div>
	<div class="right">
	</div>
	<?php 
		$tquery = new WP_Query( array('post_type'=>'pap_latest', 'posts_per_page' => -1, 'meta_query' => array (array ('key' => 'productions', 'value' => $post->ID, 'compare' => 'LIKE'))) );
		if($tquery->have_posts()){
	?>
	<div class="news">
		<h2>News</h2>
		<div class="hr"></div>
		<?php while($tquery->have_posts()){
		$tquery->the_post();
		?>
		<a href="<?php the_permalink() ?>">
			<div class="news-item">
				<div class="date"><?php echo get_the_date('M . j . Y') ?></div>
				<div class="title"><?php the_title() ?></div>
			</div>
		</a>
		<?php } ?>
	</div>
	<?php } ?>
</div>
<script type="text/javascript">
$(document).ready(function(){
	if($('#production .gallery').length){
		var limit = 6;
		$('<div class="display"><img></div><div class="navigation"><div class="left"><</div><div class="right">></div></div><div class="images"></div>').appendTo('#production .right');
		$('#production .gallery').each(function(){
			var lim = limit;
			var $g = $(this);
			$g.find('.gallery-item a').each(function(){
				lim--;
				var $a = $(this);
				var link = $a.attr('href');
				var img = $a.find('img').attr('src');
				var e = $('<img src="'+img+'">').appendTo('#production .right .images');
				if(lim < 0){
					e.hide();
				}
				if(link != img){
					e.data('src', link);
				}
			});
			$g.remove();
		});
		$('#production .right .images img').on('click', function(){
			var $t = $(this);
			var img = $t.attr('src');
			$('#production .right .display img').attr('src', img);
		});
		$('#production .right .navigation div').on('click',function(){
			var dir = 'first';
			var call = 'prev';
			if($(this).hasClass('right')){
				dir = 'last';
				call = 'next';
			}
			var e = $('#production .right .images img:visible:'+dir);
			if(!e[call]().length){
				return false;
			}
			$('#production .right .images img:visible').hide();
			for(var i = limit;i>0;i--){
				e = e[call]().show();
			}

		});
		$('#production .right .images img:first').trigger('click');
	}
});
</script>
</div></div>
<?php get_footer(); ?>
