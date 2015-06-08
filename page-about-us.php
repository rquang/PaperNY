<?php get_header(); the_post();
$staff = array();
foreach(get_categories(array('type'=>'pap_staff','parent'=>25)) as $parent){
	$staff[] = array('data' => $parent, 'children' => get_categories(array('type'=>'pap_staff','parent'=>$parent->cat_ID)));
}
?>
	<div id="top-image" class="overlay">
		<div class="image">
			<img src="http://neko.dragonbyte.me/wordpress/wp-content/uploads/2015/06/office-3000.jpg"></img>
		</div>
		<div class="caption">
			<div class="container">
				<div class="row">
					<div class="content">
						<h2>PaperNY Entertainment</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
<div id="staff-options">
	<div class="container">
		<div class="row">
			<div class="controls">
				<ul>
					<?php foreach($staff as $t1){
						$catdata = $t1['data'];
						echo '<li><a href="', site_url() ,'/staff/', $catdata->slug ,'">', $catdata->name ,'</a></li>';
						foreach($t1['children'] as $catdata){
							echo '<li><a href="', site_url() ,'/staff/', $catdata->slug ,'">', $catdata->name ,'</a></li>';
						}
					}
					?>
				</ul>
			</div>		
		</div>
	</div>
</div>
<div id="main">
	<div class="container">
		<div class="row">
			<div id="about">
				<h1 class="title"><span><?php the_title() ?></span></h1>
				<div class="text"><?php the_content() ?></div>
				<h1 class="title"><span>Contact Us</span></h1>
				<div class="row">
					<div class="contact">
						<div class="row">
							<?php
								$addresses = get_posts(array('posts_per_page'=>-1,'post_type'=>'pap_address','order'=>'date'));
								$i = 0;
								foreach($addresses as $address){
							?>
								<div class="location<?php if($i==0){echo ' active';}?>">
									<h2><?php echo $address->post_title ?></h2>
									<?php echo $address->post_content ?>
									<script>
									$(document).ready(function(){$('.map').append('<iframe class="address-<?php echo $i ?>"src="<?php echo get_field('gmap',$address->ID) ?>"></iframe>');});
									</script>
								</div>
							<?php $i++;} ?>
						</div>						
					</div>
					<div class="map">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$(".location script").remove();
	$('.location').on('click',function(){
		var $t = $(this);
		if($t.hasClass('active')){
			return false;
		}
		$('.location').removeClass('active');
		$t.addClass('active');
		$('.map iframe').css({"z-index":-1});
		$('.map iframe:eq('+$t.index()+')').css('z-index', 0);
	});
});
</script>
<?php get_footer(); ?>
