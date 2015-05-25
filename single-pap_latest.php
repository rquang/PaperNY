<?php get_header(); the_post();?>	
		<div class="image">
			<?php if(get_field('header')){ ?><img src="<?php the_field('header'); ?>"><?php } ?>
			<div class="news-title">
				<div class="wrapper"><div class="text"><?php the_title() ?></div></div>
			</div>
		</div>
	</div>
	<div id="main">
		<div id="body">
<div id="the-latest">
	<h1><?php the_title() ?></h1>
	<div class="hr"></div>
	<div class="date"><?php echo date('M . j . Y') ?></div>
	<div class="share">
		<div class="media">
			<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/{$_SERVER['REQUEST_URI']}"); ?>"><div class="icon sm facebook gray"></div></a>
			<a target="_blank" href="https://twitter.com/intent/tweet?url=<?php echo urlencode('http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/{$_SERVER['REQUEST_URI']}"); ?>"><div class="icon sm twitter gray"></div></a>
			<a target="_blank" href="https://plus.google.com/share?url=<?php echo urlencode('http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/{$_SERVER['REQUEST_URI']}"); ?>"></a>
		</div>
		<div>SHARE</div>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	<div class="text">
		<?php the_content(); ?>
	</div>
</div>
<style>
#header .icon.sm {
	background-image: url("/wordpress/wp-content/themes/paperny/images/icons_news.png");
}
#header .top {
	background: #000000;
}

#header .top .content .papernylogo, #header .top .content .nav-holder .nav > li > .inner {
	background: rgba(0,0,0,0.4);
}

#header .top .content .nav-holder .nav > li > a {
	border-bottom: 4px solid #000000;
}

#header .top .content .nav-holder .nav > li > a:hover {
	border-bottom: 4px solid #545454;
}
</style>
</div></div>
	<div class="bottom">
		<div class="tags">
			<?php the_tags(''); ?>
		</div>
	</div>
<?php get_footer(); ?>	
