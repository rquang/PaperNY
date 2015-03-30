<?php get_header(); the_post();
$staff = array();
foreach(get_categories(array('type'=>'pap_staff','parent'=>25)) as $parent){
	$staff[] = array('data' => $parent, 'children' => get_categories(array('type'=>'pap_staff','parent'=>$parent->cat_ID)));
}
?>
		<div class="image">
		</div>
	</div>
	<div id="main">
		<div class="top">
			<div class="content">
				<h1>Paperny Entertainment</h1>
				<div class="controls staff">
				<?php foreach($staff as $t1){
					$catdata = $t1['data'];
					echo '<a href="', site_url() ,'/staff/', $catdata->slug ,'"><div>', $catdata->name ,'</div></a>';
					foreach($t1['children'] as $catdata){
						echo '<a href="', site_url() ,'/staff/', $catdata->slug ,'"><div>', $catdata->name ,'</div></a>';
					}
				}
				?>
				</div>
			</div>
		</div>
		<div id="body">
			<h1><span><?php the_title() ?></span></h1>
			<div class="text"><?php the_content() ?></div>
			<h1><span>Contact Us</span></h1>
			<div class="contacts">
				<div class="data">
				<?php
					$addresses = get_posts(array('posts_per_page'=>-1,'post_type'=>'pap_address','order'=>'date'));
					$i = 0;
					foreach($addresses as $address){
				?>
					<div id="address-<?php echo $i ?>" class="contact<?php if($i==0){echo ' active';}?>">
						<div class="title"><?php echo $address->post_title ?> ></div>
						<?php echo $address->post_content ?>
						<script>
						$(document).ready(function(){$('#body .maps').append('<iframe class="address-<?php echo $i ?>" width="100%" height="700" style="border:0;position:absolute;top:0;left:0;<?php if($i){echo ';z-index:-1;';} ?>" src="<?php echo get_field('gmap',$address->ID) ?>"></iframe>');});
						</script>
					</div>
				<?php $i++;} ?>
				</div>
				<div class="maps" style="position:relative">
				</div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<script>
	$(document).ready(function(){
		$('#body .contacts .contact').on('click',function(){
			var $t = $(this);
			if($t.hasClass('active')){
				return true;
			}
			$t.parent().find('.contact').removeClass('active');
			$t.addClass('active');
			$t.closest('.contacts').find('.maps iframe').css({"z-index":-1});
			$('.'+$t.attr('id')).css('z-index', 0);
		});
	});
	</script>
<?php get_footer(); ?>
