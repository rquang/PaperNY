	<?php get_header() ?>
<?php
$image = '';
$theposts = get_posts(array('posts_per_page'=>1,'post_type'=>'pap_productions'));
if(count($theposts)){
	$t = reset($theposts);
	$id = $t->ID;
	$image = get_field('header', $id);
}
?>
		<div class="image">
			<?php if($image){ echo '<img src="',$image,'">';} ?>
		</div>
	</div>
	<div id="main">
		<div class="top">
			<div class="content">
				<h1>Productions</h1>
				<div class="controls">
					<span>Sort By:</span>
					<div class="recent">Most Recent</div>
					<div class="alphabetical">Alphabetical</div>
					<div class="filter genre">Genre</div>
					<div class="filter broadcaster">Broadcaster</div>
					<div>Search</div>
					<span class="reel"><a class="fancybox fancybox.iframe" href="//player.vimeo.com/video/118300083">Watch our Demo Reel</a></span>
				</div>
			</div>
		</div>
		<div id="body">
			<div class="filter genre">
				<div class="0">--All--</div>
			<?php $genres = get_posts(array('posts_per_page'=>-1,'post_type'=>'pap_genre','order'=>'ASC','orderby'=>'title'));
			foreach($genres as $genre){
				echo '<div class="',$genre->ID,'">',$genre->post_title,'</div>';
			}
			?>
			</div>
			<div class="filter broadcaster">
				<div class="0">--All--</div>
			<?php $genres = get_posts(array('posts_per_page'=>-1,'post_type'=>'pap_broadcaster','order'=>'ASC','orderby'=>'title'));
			foreach($genres as $genre){
				echo '<div class="',$genre->ID,'">',$genre->post_title,'</div>';
			}
			?>
			</div>
			<div class="template" style="display:none">
				<a href="" class="wrapper_link">
				<div class="production">
					<div class="top">
						<div class="background"></div>
						<div class="title"><h2></h2></div>
					</div>
					<div class="bottom">
						<div class="bottom-wrapper">
							<div class="excerpt">
								<p></p>
							</div>
							<div class="data">
								<div class="year"></div>
								<div class="episodes"></div>
								<div class="broadcaster"></div>
							</div>
						</div>
					</div>
				</div>
				</a>
			</div>
			<div class="category_wrapper">
				<div class="clear lazyload"></div>
			</div>
		</div>
	</div>
<script>
$(document).ready(function(){
	var args = {order:'date',type:'productions',posts:12,broadcaster:0,genre:0};
	$('#main .top .controls .recent').on('click',function(e){
		args.order = 'date';
		$('#body .category_wrapper .production').remove();
		$(window).trigger('lazyload');
	});
	$('#main .top .controls .alphabetical').on('click',function(e){
		args.order = 'alpha';
		$('#body .category_wrapper .production').remove();
		$(window).trigger('lazyload');
	});
	$('#main .top .controls .filter').on('click',function(e){
		$('#body .'+$(this).attr('class').replace(' ','.')).toggle();
	});
	$('#body .filter div').on('click', function(){
		var id = $(this).attr('class');
		var classes = $(this).parent().attr('class').split(' ');
		for(var i = 0;i<classes.length; i ++){
			if(args.hasOwnProperty(classes[i])){
				args[classes[i]] = id;
				break;
			}
		}
		$('#body .category_wrapper .production').remove();
		$(window).trigger('lazyload');
		$(this).parent().hide();
	});
	$(window).on('resize scroll lazyload', function(){
		if($('.lazyload').length && isElementInViewport($('.lazyload'))){
			$('.lazyload').removeClass('lazyload');
			args.offset = $('#body .production').length;
			$.ajax({
				dataType: 'json',
				url: '<?php echo site_url() ?>/api',
				data: args,
				success: function(d){
					var wrapper = $('#body .category_wrapper');
					for(var i = 0; i<d.length; i++){
						var p = d[i];
						var e = $('#body .template .wrapper_link').clone().appendTo(wrapper);
						if(i%4==3){
							e.addClass('last');
						}
						e.attr('href', p.link);
						e.find('.top .background').html(p.thumb);
						e.find('.top .title h2').html(p.title);
						e.find('.bottom .excerpt p').html(p.excerpt);
						e.find('.bottom .data .year').html(p.year);
						e.find('.bottom .data .episodes').html(p.episodes);
						e.find('.bottom .data .broadcaster').html(p.broadcaster);
						e.show();
					}
					if(d.length){
						wrapper.append('<div class="clear lazyload"></div>');
					}
				}
			});
		}
	});
	$(window).trigger('lazyload');
});
</script>
	<?php get_footer(); ?>
