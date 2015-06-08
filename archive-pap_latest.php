<?php $has_items = false; if (have_posts()) : the_post();$has_items = true; endif; ?>
<?php get_header() ?>
<div id="top-image">
	<div class="image">
		<?php if(get_field('header')){ ?><img src="<?php the_field('header'); ?>"><?php } ?>
	</div>
	<div class="caption">
		<div class="container">
			<div class="row">
				<div class="content">
					<div class="top">
						<div class="cat-title">
							<h1>News</h1>
						</div>
						<div class="latest-title">
							<h2><?php if($has_items)the_title(); ?></h2>							
						</div>
					</div>
					<div class="bottom">
						<div class="date">
							<p>
								<?php if($has_items)the_date('M . j . Y') ?>
							</p>
						</div>
						<div class="excerpt">
							<?php if($has_items)the_excerpt(); ?>
							<a href="<?php echo get_permalink(); ?>" class="link before">MORE</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="main">
	<div class="container">
		<div class="row">
			<div id="searchbar" class="tab right">
				<span>Search</span>
				<form>
				    <input type="text" placeholder="Search..." required>
				    <button type="submit"><span class="fa fa-search"></span></button>
				</form>
			</div>
			<div id="latest-container">
				<h1 class="title"><span>News</span></h1>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<a href="<?php the_permalink(); ?>" class="item">
						<div class="date">
							<p>
								<?php echo get_the_date('M . j . Y') ?>
							</p>
						</div>
						<div class="info">
							<h2><?php the_title(); ?></h2>
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
							<span class="link before">MORE</span>							
						</div>
					</a>
				<?php endwhile;
				echo '<div class="lazyload"></div>';
				else: ?>
					<p><?php _e($has_items?'No other posts matched your criteria':'Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>				
			</div>
		</div>
	</div>
</div>
<div id="template" style="display: none;">
	<a href="" class="item">
		<div class="date">
			<p></p>
		</div>
		<div class="info">
			<h2></h2>
			<div class="image">
			</div>
			<div class="excerpt">
				<p></p>
			</div>
			<span class="link before">MORE</span>							
		</div>
	</a>
</div>
<script>
$(document).ready(function(){
	var original = {order:'date',type:'news',posts:8};
	var args = {order:'date',type:'news',posts:8};
	$("#searchbar >span").on("click",function(){
		$(this).fadeOut(function(){
			$("#searchbar form").css("display","inline-block");
		});
	});
	$( "#searchbar form" ).submit(function(e) {
		e.preventDefault();
		args = jQuery.extend({}, original);
		args.search = $("#searchbar input").val().trim();
		$("#latest-container .item").remove();
		$(window).trigger('lazyload');
	});
	$(window).on('resize scroll lazyload', function(){
		if($('.lazyload').length && isElementInViewport($('.lazyload'))){
			$('.lazyload').removeClass('lazyload');
			args.offset = $('#latest-container .item').length;
			$.ajax({
				dataType: 'json',
				url: '<?php echo site_url() ?>/api/',
				data: args,
				success: function(d){
					var wrapper = $('#latest-container');
					for(var i = 0; i<d.length; i++){
						var p = d[i];
						var e = $('#template >a').clone().appendTo(wrapper);
						e.attr('href', p.link);
						e.find('.image').append(p.thumb);
						console.log(p.thumb);
						e.find('.date p').html(p.date);
						e.find('h2').html(p.title);
						e.find('.excerpt p').html(p.excerpt);
						e.show();
					}
					if(d.length){
						wrapper.append('<div class="lazyload"></div>');
					}
				}
			});
		}
	});
	$(window).trigger('lazyload');
});
</script>	
<?php get_footer(); ?>
