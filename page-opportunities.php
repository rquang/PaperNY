<?php
function print_date($arg){
	echo date("M j. Y", strtotime($arg));
}
$qawards = new WP_Query(array('posts_per_page'=>-1,'post_type'=>'pap_award'));
?>
<?php the_post() ?>
	<?php get_header() ?>
		<div class="image">
		</div>
	</div>
	<div id="main">
		<div class="top">
			<div class="content">
				<h1>Opportunities</h1>
			</div>
		</div>
		<div id="body">
			<h1><span><?php the_title(); ?></span></h1>
			<div id="awards">
				<div class="left"><</div>
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
					<div class="clear"></div>
				</div>
				<div class="right">></div>
				<div class="clear"></div>
			</div>
			<script>
			$(document).ready(function(){
				$('#awards > .left').click(function(){
					$('#awards .slider .award:first').appendTo('#awards .slider');
					$('#awards .slider .clear').appendTo('#awards .slider');
				});
				$('#awards > .right').click(function(){
					$('#awards .slider .award:last').prependTo('#awards .slider');
				});
			});
			</script>
			<p><?php the_content(); ?></p>
		</div>
	</div>
	<div id="jobs">
		<div class="wrap">
			<h1><span>Current job opportunities</span></h1>
			<div>
				<?php
				$theposts = get_posts(array('posts_per_page'=>-1,'post_type'=>'pap_position'));
				$_i = 0;
				if(count($theposts)){
					while(count($theposts)){ $post = array_shift($theposts);setup_postdata($post);$_i++;
				?>
				<div class="opening <?php echo $_i%2==1?(count($theposts)?'odd':'middle'):'even'; ?>">
					<div class="title"><?php the_title(); ?></div>
					<div class="content">
						<div>Posting Date: <span class="posting-date"><?php print_date(get_field('posting_date')); ?></span></div>
						<div>Closing Date: <span class="closing-date"><?php print_date(get_field('closing_date')); ?></span></div>
						<div class="hr">Job Description</div>
						<div class="text"><?php echo get_the_content(); ?></div>
					</div>
					<a href="mailto:info@papernyentertainement.com">
						<div class="foot">
							<div class="upper">E-mail your CV and References to:</div>
							<div>info@papernyentertainement.com</div>
						</div>
					</a>
				</div>
				<?php 
					if($_i%2==0){
						echo '<div class="clear padder"></div>';
					}
				}
				} else { ?>
				<div class="empty">
					<div>There are currently no job opportunities at this time.</div>
					<div>Please check back for future opportunitites</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
	<?php get_footer(); ?>
