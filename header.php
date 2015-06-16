<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width" />
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
		if($(window).width() < 992) {
			$('#mobile-nav').on("click", function(){
				if ($(this).hasClass("active")) {
					$('nav li').removeClass('active');
					$('nav .inner').hide();
				}
				$(this).toggleClass("active");
				$('nav').toggleClass("active");
			});
			$('nav li').on("click", function(e){
				var $t = $(this);
				if ($t.hasClass("parent") && !$t.hasClass("active")) {
					$t.find(">.inner").slideToggle();
					$t.addClass("active");
					return false;
				}
			});
		}
		$('.search').click(function(){
			var $t = $(this);
			var action = '<?php echo site_url(); ?>';
			if($t.data('link')){
				action += $t.data('link');
			}
			$t.hide();
			$t.parent().append('<form method="get" action="'+action+'" class="'+$t.prop('class')+'"><input type="text" name="s" placeholder="Search"></form>');
		});
	});
	$(window).on('resize load', function(){
		var h = $('#header .image img').outerHeight();
		var max = parseInt($('#header .image').css('max-height'));
		$('#header .image').css('height', (h > max ? max : h)+'px');
	});
	</script>
</head>
<body <?php body_class(); ?>>
<?php
$staff = array();
foreach(get_categories(array('type'=>'pap_staff','parent'=>25)) as $parent){
	$staff[] = array('data' => $parent, 'children' => get_categories(array('type'=>'pap_staff','parent'=>$parent->cat_ID)));
}
?>
<header>
	<div class="container">
		<div class="row">
			<div id="logo">
				<a href="<?php echo site_url()?>"><img src="<?php bloginfo('template_directory'); ?>/images/paperny-logo-white-350.png" title="Go To Homepage" alt="PaperNY Logo"></a>
			</div>
			<nav>
				<ul>
					<li><a href="<?php echo site_url()?>">Home</a></li>
					<li><a href="<?php echo site_url()?>/productions">Productions</a></li>
					<li><a href="<?php echo site_url()?>/the-latest">The Latest</a></li>
					<li><a href="<?php echo site_url()?>/opportunities">Opportunities</a></li>
					<li><a href="<?php echo site_url()?>/shop">Store</a></li>
					<li class="parent">
						<a href="<?php echo site_url()?>/about-us">About Us</a>
						<ul class="inner">
							<li class="parent">
								<a href="<?php echo site_url()?>/about-us">Paperny Entertainment</a>
								<ul class="inner">
									<li><a href="<?php echo site_url()?>/about-us">Contact Us</a></li>
								</ul>
							</li>
							<?php $first = 1;foreach($staff as $scat){ $catdata = $scat['data']; ?>
							<li class="parent">
								<?php if(!$first){ ?><a href="<?php echo site_url() ?>/staff/<?php echo $catdata->slug ?>"><?php echo $catdata->name ?></a><?php } ?>
								<?php if(count($scat['children'])){ ?>
								<ul class="inner">
								<?php foreach($scat['children'] as $ccat){ ?>
									<li><a href="<?php echo site_url(),'/staff/',$ccat->slug;?>"><?php echo $ccat->name; ?></a></li>
								<?php } ?>
								</ul>
								<?php } ?>
							</li>
							<?php $first = 0;} ?>
						</ul>
					</li>
				</ul>
			</nav>
			<div id="social-media">
				<ul>
					<li>
						<a target="_blank" href="http://www.facebook.com/PapernyEntertainment" class="facebook"></a>
					</li>
					<li>
						<a target="_blank" href="http://twitter.com/Paperny" class="twitter"></a>
					</li>
					<li>
						<a target="_blank" href="//player.vimeo.com/video/118300083" class="fancybox fancybox.iframe vimeo"></a>
					</li>	
				</ul>			
			</div>
			<div id="mobile-nav"></div>				
		</div>	
	</div>
</header>