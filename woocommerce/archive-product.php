	<?php get_header() ?>
	<?php
	$prefix = parse_url(site_url(), PHP_URL_PATH);
	$url = substr($_SERVER['REQUEST_URI'], strlen($prefix));
	if($url == '/shop/'){
		include 'front-page.php';
		die();
	}
	$parts = explode('/', $url);
	$args = array(
		'post_type' => 'product',
		'posts_per_page' => 12,
		'orderby' => 'meta_value_num',
		'order' => 'ASC',
		'meta_key' => '_price',
	);
	$ft_args = array(
		'post_type' => 'product',
		'posts_per_page' => 3,
	);

	if($parts[1] == 'product-category'){
		$args['product_cat'] = $parts[2];
		$ft_args['product_cat'] = $parts[2];
		$ft_args['product_tag'] = 'featured';
	} elseif($parts[1] == 'product-tag') {
		$args['product_tag'] = $parts[2];
		$ft_args['product_tag'] = $parts[2].'+featured';
	} else {
		die();
	}
	?>
		<div class="shop-image">
			<div class="left"><</div>
			<div class="preview">
				<div class="thumb"></div>
				<div class="data">
					<div class="name">T-Shirts</div>
					<div class="description">100% cotton, 30% OFF ></div>
				</div>
			<div class="clear"></div>
			</div>
			<div class="right">></div>
			<div class="clear"></div>
		</div>
	</div>
	<div id="shop" class="list">
		<div class="top">
			<div class="padder"></div>
			<div class="content"><span>Shipping & Delivery</span><span>Return Policy</span><span class="search" data-link="/shop/">Search</span></div>
			<div class="triangle"></div>
			<div class="clear"></div>
		</div>
		<div id="left">
			<div class="title">
				<div class="name">Categories</div>
				<div class="triangle"></div>
				<div class="clear"></div>
			</div>
			<div class="menu">
				<ul>
				<?php foreach(get_categories(array('taxonomy'=>'product_cat','orderby'=>'name','hierarchical'=>1,'hide_empty'=>1)) as $cat){
					if($cat->category_parent != 0){continue;}
					echo '<li><a href="',get_term_link((int)$cat->term_id, 'product_cat'),'">',$cat->name,'</a></li>';
				}
				?>
				</ul>
			</div>
			<a href="<?php echo WC()->cart->get_cart_url(); ?>">
			<div class="cart">
				<span class="total"><?php echo WC()->cart->get_cart_total(); ?></span>
				<span class="items"><?php echo sprintf (_n( '%d item', '%d items', WC()->cart->cart_contents_count ), WC()->cart->cart_contents_count ); ?></span>
				<span> | CART</span>
			</div>
			</a>
		</div>
		<div id="body" class="shop-list">
			<div class="template" style="display:none">
				<a>
				<div class="item">
					<div class="thumb"></div>
					<div class="name"></div>
					<div class="price"></div>
				</div>
				</a>
			</div>
			<h1><span>Featured</span></h1>
			<div class="featured">
				<?php
				$fquery = new WP_Query($ft_args);
				while($fquery->have_posts()){ $fquery->the_post();$product = new WC_Product(get_the_ID()); ?>
				<a href="<?php echo get_permalink(); ?>">
				<div class="item">
					<div class="thumb"><?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?></div>
					<div class="name"><?php echo get_the_title(); ?></div>
					<div class="price"><?php echo $product->get_price_html(); ?></div>
				</div>
				</a>
				<?php } ?>
				<div class="clear"></div>
			</div>
			<div class="items">
				<div class="header">
					<span class="sort-title">Sort By</span>
					<span class="select">
						<ul>
							<li data-value="price" class="active">Price (Low to High)</li>
							<li data-value="price_desc">Price (High to Low)</li>
							<li data-value="date">Newest</li>
						</ul>
					</span>
				</div>
				<div class="item-holder">
					<?php
					$query = new WP_Query($args);
					while($query->have_posts()){ $query->the_post();$product = new WC_Product(get_the_ID()); ?>
					<a href="<?php echo get_permalink(); ?>">
					<div class="item">
						<div class="thumb"><?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?></div>
						<div class="name"><?php echo get_the_title(); ?></div>
						<div class="price"><?php echo $product->get_price_html(); ?></div>
					</div>
					</a>
					<?php } ?>
					<div class="clear lazyload"></div>
				</div>
			</div>
		</div>
		<div class="clear"></div>
		<script>
		$(document).ready(function(){
			var args = {'order':'price', 'type': 'product'};
			<?php if(isset($args['product_cat'])){
				echo 'args.category = "',$args['product_cat'],'";';
			} elseif(isset($args['product_tag'])){
				echo 'args.tag = "',$args['product_tag'],'";';
			} ?>
			$('.select').on('click', 'ul:not(.open)', function(){
				$(this).addClass('open');
			});
			$('.select').on('click', 'ul.open li', function(e){
				e.stopPropagation();
				var $t = $(this);
				if(!$t.hasClass('active')){
					$t.parent().find('li').removeClass('active');
					$t.addClass('active');
				}
				$t.closest('ul').removeClass('open');
				args.order = $t.attr('data-value');
				$('#body .items .item-holder').html('<div class="clear lazyload">');
				$(window).trigger('lazyload');
			});
			$(window).on('resize scroll lazyload', function(){
				if($('.lazyload').length && isElementInViewport($('.lazyload'))){
					$('.lazyload').remove();
					var wrapper = $('#body .items .item-holder');
					args.offset = wrapper.find('a').length;
					$.ajax({
						dataType: 'json',
						url: '<?php echo site_url() ?>/api',
						data: args,
						success: function(d){
							for(var i = 0; i<d.length; i++){
								var p = d[i];
								console.log(p);
								var e = $('#body .template a').clone().appendTo(wrapper);
								e.attr('href', p.link);
								e.find('.thumb').html(p.thumb);
								e.find('.name').html(p.title);
								e.find('.price').html(p.price);
								e.show();
							}
							wrapper.append('<div class="clear lazyload"></div>');
						}
					});
				}
			});
		});
		</script>
	</div>
	<?php get_footer(); ?>
