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
<div id="top-image" class="overlay">
	<div class="image">
		<?php if($image){ echo '<img src="',$image,'">';} ?>
	</div>
	<div class="caption">
		<div class="container">
			<div class="row">
				<div class="content">
					<h2>Productions</h2>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="sort-options">
	<div class="container">
		<div class="row">
			<div class="controls">
				<span>Sort By:</span>
				<select name="sort">
					<option value="date">Most Recent</option>
					<option value="alpha">Alphabetical</option>
					<option value="-">---Genre---</option>
					<?php 
						$genres = get_posts(array('posts_per_page'=>-1,'post_type'=>'pap_genre','order'=>'ASC','orderby'=>'title'));
						foreach($genres as $genre){
							echo '<option class="genre" value="',$genre->ID,'">',$genre->post_title,'</option>';
						}
					?>	
					<option value="-">---Broadcaster---</option>
					<?php 
						$genres = get_posts(array('posts_per_page'=>-1,'post_type'=>'pap_broadcaster','order'=>'ASC','orderby'=>'title'));
						foreach($genres as $genre){
							echo '<option class="broadcaster" value="',$genre->ID,'">',$genre->post_title,'</option>';
						}
					?>		
				</select>
				<ul>
					<li class="recent active">Most Recent</li>
					<li class="alpha">Alphabetical</li>
					<li class="genre">Genre</li>
					<li class="broadcaster">Broadcaster</li>
				</ul>
				<div id="searchbar">
					<span>Search</span>
					<form>
					    <input type="text" placeholder="Search..." required>
					    <button type="submit"><span class="fa fa-search"></span></button>
					</form>						
				</div>
				<a class="fancybox fancybox.iframe" href="//player.vimeo.com/video/118300083">Watch our Demo Reel</a>
			</div>
		</div>
	</div>
</div>
<div id="main">
	<div class="container">
		<div class="row">
			<div id="filter">
				<div class="genre">
					<span class="0">All</span>
					<?php 
						$genres = get_posts(array('posts_per_page'=>-1,'post_type'=>'pap_genre','order'=>'ASC','orderby'=>'title'));
						foreach($genres as $genre){
							echo '<span class="',$genre->ID,'">',$genre->post_title,'</span>';
						}
					?>					
				</div>
				<div class="broadcaster">
					<span class="0">All</span>
					<?php 
						$genres = get_posts(array('posts_per_page'=>-1,'post_type'=>'pap_broadcaster','order'=>'ASC','orderby'=>'title'));
						foreach($genres as $genre){
							echo '<span class="',$genre->ID,'">',$genre->post_title,'</span>';
						}
					?>					
				</div>
			</div>
			<div id="productions-container">
				<div class="lazyload"></div>
			</div>
		</div>
	</div>
</div>
<div id="template" style="display:none">
	<a href="" class="item">
		<div class="top">
			<div class="image"></div>
			<span>
				<h3></h3>
			</span>
		</div>
		<div class="bottom">
			<div class="inner">
				<div class="excerpt">
					<p></p>
				</div>
				<div class="row">
					<div class="year"><p></p></div>
					<div class="episodes"><p></p></div>
					<div class="broadcaster"></div>
				</div>
			</div>
		</div>
	</a>
</div>
<script>
$(document).ready(function(){
	var wrapper = $('#productions-container');
	var original = {order:'date',type:'productions',posts:12,broadcaster:0,genre:0};
	var args = {order:'date',type:'productions',posts:12,broadcaster:0,genre:0};
	$("#searchbar >span").on("click",function(){
		$(this).fadeOut(function(){
			$("#searchbar form").css("display","inline-block");
		});
	});
	$( "#searchbar form" ).submit(function(e) {
		e.preventDefault();
		args = jQuery.extend({}, original);
		args.search = $("#searchbar input").val().trim();
		wrapper.find('.item').remove();
		lazy_load();
	});
	$('.controls li').on('click',function(e){
		var $t = $(this);
		args = jQuery.extend({}, original);
		if(!$t.hasClass('genre') && !$t.hasClass('broadcaster') && !$t.hasClass('active')){
			$("#filter >div").hide();
			$("#filter span").removeClass("active");
			$("#filter").removeClass("open");
			if($t.hasClass('recent')) {
				args.order = 'date';
			} else if($t.hasClass('alpha')) {
				args.order = 'alpha';
			}
			wrapper.find('.item').remove();
			lazy_load();
		} else {
			if (!$t.hasClass('active')){
				$("#filter >div").hide();
				$("#filter span").removeClass("active");
			}
			$("#filter ."+$t.attr('class')).show();
			$("#filter").addClass("open");
		}
		$('.controls .active').removeClass('active');
		$t.addClass('active');
	});
	$('#filter span').on('click', function(){
		var id = $(this).attr('class');
		var classes = $(this).parent().attr('class');
		$("#filter span").removeClass("active");
		$(this).addClass("active");
		args = jQuery.extend({}, original);
		args[classes] = id;
		wrapper.find('.item').remove();
		lazy_load();
	});
	$("#sort-options select").on('change',function(){
		var $t = $(this);
		args = jQuery.extend({}, original);
		if ($t.val() == "-") {
			return true;
		}
		if ($t.find(":selected").hasClass("genre") || $t.find(":selected").hasClass("broadcaster")) {
			args[$t.find(":selected").attr('class')] = $t.val();
			console.log($t.find(":selected").attr('class')+'//'+$t.val());
		} else {
			args.order = $t.val();
		}
		wrapper.find('.item').remove();
		lazy_load();
	});
	$(window).on('resize scroll', function(){
		if($('.lazyload').length && isElementInViewport($('.lazyload'))){
			lazy_load();
		}
	});
	function lazy_load(){
		args.offset = $('#productions-container .item').length;
		$('.lazyload, .empty').remove();
		$.ajax({
			dataType: 'json',
			url: '<?php echo site_url() ?>/api',
			data: args,
			success: function(d){
				for(var i = 0; i<d.length; i++){
					var p = d[i];
					var e = $('#template >a').clone().appendTo(wrapper);
					e.attr('href', p.link);
					e.find('.top .image').html(p.thumb);
					e.find('.top h3').html(p.title);
					e.find('.excerpt p').html(p.excerpt);
					e.find('.year p').html(p.year);
					e.find('.episodes p').html(p.episodes);
					e.find('.broadcaster').html(p.broadcaster);
					e.show();
				}
				if(d.length){
					wrapper.append('<div class="lazyload"></div>');
				}
				console.log(d.length);
				if(!$.trim(wrapper.html())) {
					wrapper.append('<div class="empty"><p>Sorry, no productions matched your criteria.</p></div>');
				}
			}
		});
	};
	lazy_load();
});
</script>
<?php get_footer(); ?>
