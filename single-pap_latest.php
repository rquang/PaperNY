<?php get_header(); the_post();?>
<?php if(get_field('header')){ ?>	
	<div id="top-image">
		<div class="image">
			<img src="<?php the_field('header'); ?>">
		</div>
		<div class="caption">
			<div class="container">
				<div class="row">
					<div class="content">
						<h2><?php the_field('caption') ?></h2>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<div id="main">
	<div class="container">
		<div class="row">
			<div id="the-latest">
				<div class="top">
					<h1><?php the_title() ?></h1>					
					<div class="row">
						<div class="date">
							<p><?php the_date('M . j . Y') ?></p>
						</div>
						<div class="share">
							<ul>
								<li>Share</li>
								<li>							
									<a target="_blank" class="facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/{$_SERVER['REQUEST_URI']}"); ?>"></a>
								</li>
								<li>							
									<a target="_blank" class="twitter" href="https://twitter.com/intent/tweet?url=<?php echo urlencode('http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/{$_SERVER['REQUEST_URI']}"); ?>"></a>
								</li>
								<li>							
									<a target="_blank" class="google" href="https://plus.google.com/share?url=<?php echo urlencode('http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}/{$_SERVER['REQUEST_URI']}"); ?>"></a>	
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="content">
					<?php the_content(); ?>					
				</div>
			</div>
		</div>
	</div>
	
	<div class="gray-bg">
		<div class="container">
			<div class="row">
				<div id="tags">

					<span><?php echo strip_tags(get_the_tag_list('',', ','')); ?></span>

				</div>
			</div>
		</div>
	</div>
	
</div>
<?php get_footer(); ?>	
