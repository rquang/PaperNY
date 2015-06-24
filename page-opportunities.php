<?php
function print_date($arg){
	echo date("M j. Y", strtotime($arg));
}
$qawards = new WP_Query(array('posts_per_page'=>-1,'post_type'=>'pap_award'));
?>
<?php the_post() ?>
<?php get_header() ?>
	<div id="top-image" class="overlay">
		<div class="image">
			<img src="<?php echo site_url(); ?>/wp-content/uploads/2015/04/374975_516819491687550_1393040941_n.jpg"></img>
		</div>
		<div class="caption">
			<div class="container">
				<div class="row">
					<div class="content">
						<h2>Opportunities</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
<div id="main">
	<div class="container">
		<div class="row">
			<h1 class="title"><span><?php the_title(); ?></span></h1>
			<div id="awards">
				<div class="left"></div>
				<div class="slider">
					<?php $i = 0;while($qawards->have_posts()){
							$qawards->the_post();
						?>
						<div class="award <?php echo $i; ?>">
							<div class="year"><?php echo get_field('year'); ?></div>
							<div class="image"><?php the_post_thumbnail(); ?></div>
							<div class="name"><?php the_title(); ?></div>
						</div>
					<?php $i++;} wp_reset_postdata(); ?>					
				</div>
				<div class="right"></div>
			</div>
			<div class="full-content mb">
				<div class="excerpt">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="cyan-bg">
		<div class="container">
			<div class="row">
				<h2 class="title"><span>Current job opportunities</span></h2>
				<div id="jobs">
					<?php
					$theposts = get_posts(array('posts_per_page'=>-1,'post_type'=>'pap_position'));
					$_i = 0;
					if(count($theposts)){
						while(count($theposts)){ $post = array_shift($theposts);setup_postdata($post);$_i++;
					?>
						<div class="opening <?php echo $_i%2==1?(count($theposts)?'odd':'middle'):'even'; ?>">
							<h3><?php the_title(); ?></h3>
							<div class="content">
								<div class="date">
									<p>Posting Date: <span class="posting-date"><?php print_date(get_field('posting_date')); ?></span></p>
								</div>
								<div class="date">
									<p>Closing Date: <span class="closing-date"><?php print_date(get_field('closing_date')); ?></span></p>
								</div>
								<div class="excerpt">
									<span>Job Description</span>
									<?php echo get_the_content(); ?>
								</div>
							</div>
							<a href="mailto:info@papernyentertainement.com">
								<p>E-mail your CV and References to:</p>
								<small>info@papernyentertainement.com</small>
							</a>
						</div>
					<?php }
					} else { ?>
						<div class="empty">
							<h3>There are currently no job opportunities at this time.</h3>
							<p>Please check back for future opportunitites</p>
						</div>
					<?php } ?>				
				</div>
			</div>
		</div>
	</div>
</div>
<script>
jQuery(document).ready(function($){
	$('#awards .right').click(function(){
		$('#awards .slider .award:first').appendTo('#awards .slider');
	});
	$('#awards .left').click(function(){
		$('#awards .slider .award:last').prependTo('#awards .slider');
	});
});
</script>
<?php get_footer(); ?>
