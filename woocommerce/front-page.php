<?php
	$fquery = new WP_Query(array('post_type'=>'product', 'product_tag'=>'featured', 'posts_per_page'=>5));
	$shop_featured = array();
	while($fquery->have_posts()){
		$fquery->the_post();
		$product = new WC_Product( get_the_ID() );
		$shop_featured[] = array(
			'thumb' => get_the_post_thumbnail(get_the_ID(), 'full'),
			'title' => get_the_title(),
			'desc' => get_the_excerpt(),
			//'price' => get_post_meta(get_the_ID(), "_price", true),
			//'x' => $product->price,
			'price' => $product->get_price_html(),
			'link' => get_permalink(),
		);
	}
	?>
	<script>var shop_featured = <?php echo json_encode($shop_featured); ?>;
	$(document).ready(function(){
		var shop_active = 0;
		$('.right, .left', '#header .shop-image').css({cursor: 'pointer'}).on('click', function(){
			var $t = $(this);
			var $e = $('#header .shop-image .preview');
			if( ($t.hasClass('left') && shop_active > 0) || ($t.hasClass('right') && shop_active < shop_featured.length - 1) ){
				shop_active += ($t.hasClass('left')?-1:1);
				var s = shop_featured[shop_active];
				$e.find('.thumb').html(s.thumb);
				$e.find('.name').html(s.title);
				$e.find('.description').html(s.desc);
				$e.find('.price').html(s.price);
				$e.find('.link a').attr('href', s.link);
			}
		});
	});
	</script>
		<div class="shop-image">
			<div class="left"><</div>
			<div class="preview">
				<div class="thumb"><?php echo $shop_featured[0]['thumb']; ?></div>
				<div class="data">
					<div class="name"><?php echo $shop_featured[0]['title']; ?></div>
					<div class="description"><?php echo $shop_featured[0]['desc']; ?></div>
					<div class="price"><?php echo $shop_featured[0]['price']; ?></div>
					<div class="link"><a href="<?php echo $shop_featured[0]['link']; ?>"><span>> Shop Now</span></a></div>
				</div>
			<div class="clear"></div>
			</div>
			<div class="right">></div>
			<div class="clear"></div>
		</div>
	</div>
	<div id="shop">
		<div class="top">
			<div class="padder"></div>
			<div class="content"><span>Shipping & Delivery</span><span>Return Policy</span><span class="search" data-link="/shop/">Search</span></div>
			<div class="triangle"></div>
			<div class="clear"></div>
		</div>
		<div id="body" class="shop">
			<h1><span>Paperny Entertainment Store</span></h1>
			<div class="categories">
				<?php foreach(array('dvd', 'clothing', 'merchandise') as $pcat){
					$cat = get_term_by('slug',$pcat,'product_cat');
					$thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
				?>
				<a href="<?php echo get_term_link( $cat->term_id, 'product_cat' ); ?>">
					<div class="product_category">
						<div class="thumb"><img src="<?php echo wp_get_attachment_url( $thumbnail_id ); ?>"></div>
						<div class="name"><?php echo $cat->name; ?> ></div>
					</div>
				</a>
				<?php } ?>
			</div>
		</div>
		<div id="dvd">
			<div class="body">
				<h1><span>DVDs</span></h1>
				<div class="products">
				<?php
					$dquery = new WP_Query(array('post_type'=>'product', 'product_cat' => 'dvd', 'product_tag'=>'featured', 'posts_per_page'=>4));
					while($dquery->have_posts()){ $dquery->the_post();
						$xproduct = new WC_Product( get_the_ID() );
						?>
						<a href="<?php echo get_permalink(); ?>">
						<div class="dvd">
							<div class="thumb"><?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?></div>
							<div class="name"><?php echo get_the_title(); ?></div>
							<div class="price"><?php echo $xproduct->get_price_html(); ?></div>
						</div>
						</a>
						<?php
					}
				?>
				</div>
				<?php $cat = get_term_by('slug','dvd','product_cat'); ?>
				<div class="link"><a href="<?php echo get_term_link( $cat->term_id, 'product_cat' ); ?>">DVDs >></a></div>
			</div>
		</div>
		<div id="cats">
			<div class="body">
				<h1><span>Clothing</span></h1>
				<div class="clothing">
				<?php
					$dquery = new WP_Query(array('post_type'=>'product', 'product_cat' => 'clothing', 'product_tag'=>'featured', 'posts_per_page'=>3));
					while($dquery->have_posts()){ $dquery->the_post();
						$xproduct = new WC_Product( get_the_ID() );
						?>
						<div class="first">
							<div class="thumb"><?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
								<div class="left">
									<div class="name"><?php echo get_the_title(); ?></div>
									<div class="price"><?php echo $xproduct->get_price_html(); ?></div>
								</div>
								<div class="right">
									<div class="link"><a href="<?php echo get_permalink(); ?>">Shop Now ></a></div>
								</div>
							</div>
						</div>
							<?php
						break;
					}
					echo '<div class="side">';
					while($dquery->have_posts()){ $dquery->the_post();
						?>
						<a href="<?php echo get_permalink() ?>">
						<div class="item">
							<?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
						</div>
						</a>
					<?php } ?>
					</div>
					<div class="clear"></div>
				</div>
				<?php $cat = get_term_by('slug','clothing','product_cat'); ?>
				<div class="link"><a href="<?php echo get_term_link( $cat->term_id, 'product_cat' ); ?>">Clothing >></a></div>
				<h1><span>Merchandise</span></h1>
				<div class="merchandise">
				<?php
					$dquery = new WP_Query(array('post_type'=>'product', 'product_cat' => 'merchandise', 'product_tag'=>'featured', 'posts_per_page'=>3));
					while($dquery->have_posts()){ $dquery->the_post();
						?>
						<a href="<?php echo get_permalink(); ?>">
						<div class="merch">
							<?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
						</div>
						</a>
						<?php
					}
				?>
					<div class="clear"></div>
				</div>
				<?php $cat = get_term_by('slug','merchandise','product_cat'); ?>
				<div class="link"><a href="<?php echo get_term_link( $cat->term_id, 'product_cat' ); ?>">Merchandise >></a></div>
			</div>
		</div>
	</div>
	<?php get_footer(); ?>
