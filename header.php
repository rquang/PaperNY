<!DOCTYPE html>
<html>
<head>
	<title>Paperny Entertainment</title>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/js/fancybox/jquery.fancybox.css">
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/fancybox/jquery.fancybox.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/functions.js"></script>
	<script>
	$(document).ready(function(){
		$('#header .top .content .mobile-menu').click(function(){
			$('#header .top .content .nav-holder').toggle();
		});
		$('.fancybox').fancybox();
	});
	$('document').ready(function(){
		$('.search').click(function(){
			var $t = $(this);
			var action = '<?php echo site_url(); ?>';
			if($t.data('link')){
				action += $t.data('link');
			}
			$t.hide();
			$t.parent().append('<form method="get" action="'+action+'" class="'+$t.prop('class')+'"><input type="text" name="s"></form>');
		});
	});
	</script>
</head>
<body>
<?php
$staff = array();
foreach(get_categories(array('type'=>'pap_staff','parent'=>25)) as $parent){
	$staff[] = array('data' => $parent, 'children' => get_categories(array('type'=>'pap_staff','parent'=>$parent->cat_ID)));
}
?>
<div id="wrapper">
	<div id="header">
		<div class="top">
			<div class="content">
				<div class="papernylogo"><div class="main">Paperny</div><div class="second">Entertainment</div><div class="end">an <b>entertainment one</b> company</div></div>
				<div class="mobile-menu">☰</div>
				<div class="mobile-links">
					<a target="_blank" href="http://www.facebook.com/PapernyEntertainment"><div class="icon sm facebook"></div></a>
					<a target="_blank" href="http://twitter.com/Paperny"><div class="icon sm twitter"></div></a>
					<a target="_blank" href="//player.vimeo.com/video/118300083" class="fancybox fancybox.iframe"><div class="icon sm vimeo"></div></a>
				</div>
				<div class="nav-holder">
					<ul class="nav">
					<li class="empty"></li>
					<li><a href="<?php echo site_url()?>">Home</a></li>
					<li><a href="<?php echo site_url()?>/productions">Productions</a></li>
					<li><a href="<?php echo site_url()?>/the-latest">The Latest</a></li>
					<li><a href="<?php echo site_url()?>/opportunities">Opportunities</a></li>
					<li><a href="<?php echo site_url()?>/shop">Store</a></li>
					<li>
						<a href="<?php echo site_url()?>/about-us">About Us</a>
						<ul class="inner">
							<li>
								<a href="<?php echo site_url()?>/about-us">Paperny Entertainment</a>
								<ul class="inner">
									<li><a href="<?php echo site_url()?>/about-us">Contact Us</a></li>
								</ul>
							</li>
							<?php foreach($staff as $scat){ $catdata = $scat['data']; ?>
							<li>
								<a href="<?php echo site_url() ?>/staff/<?php echo $catdata->slug ?>"><?php echo $catdata->name ?></a>
								<?php if(count($scat['children'])){ ?>
								<ul class="inner">
								<?php foreach($scat['children'] as $ccat){ ?>
									<li><a href="<?php echo site_url(),'/staff/',$ccat->slug;?>"><?php echo $ccat->name; ?></a></li>
								<?php } ?>
								</ul>
								<?php } ?>
							</li>
							<?php } ?>
						</ul>
					</li>
					<li class="media">
						<div class="links">
							<a target="_blank" href="http://www.facebook.com/PapernyEntertainment"><div class="icon sm facebook"></div></a>
							<a target="_blank" href="http://twitter.com/Paperny"><div class="icon sm twitter"></div></a>
							<a target="_blank" href="//player.vimeo.com/video/118300083" class="fancybox fancybox.iframe"><div class="icon sm vimeo"></div></a>
						</div>
					</li>
					</ul>
				</div>
				<div class="clear"></div>
			</div>
		</div>
