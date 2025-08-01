<?php $this_path = 'blog/'; ?>
<?php require_once( dirname( __FILE__ ) . '/../../../../../../include/variable.php' ); ?>
<?php require_once( dirname( __FILE__ ) . '/../../../../../../include/functions.php' ); ?>
<?php relativeURL(); ?>
<?php
	$directory = array(
		array('ホーム','トップ',''),
		array('ブログ','ブログ', $this_path ),
	);
	$robots = true;

	if( is_home() && !is_date() && !is_tax() ){
		$page_description = '';
	} else{
		$directory        = getWPDirectory( $directory );
		$page_description = '〇〇のカテゴリー別ブログ「'. wp_get_document_title() .'」についてご案内します。';
	}

	$meta = array(
		'title'       => getTitle($directory),
		'description' => $page_description,
		'keywords'    => '',
	);

	$preload = array(
		array(
			'href' => $this_img_path . 'hero-pc.jpg',
			'as'   => 'image',
		),
	);
	$style  = array();
	$script = array();
	$jquery = false;

	$header_class = '-opaque';
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<?php require_once($web_root.$home_url.'include/meta.php'); ?>
</head>
<body data-root="<?= $home_url; ?>">
<?php require_once($web_root.$home_url.'include/preload-svg.php'); ?>
<?php require_once($web_root.$home_url.'include/loading.php'); ?>
<?php require_once($web_root.$home_url.'include/header.php'); ?>
<?php require_once($web_root.$home_url.'include/sitemap.php'); ?>
	<main class="l-main <?= $headerTypeClass; ?>">
		<!-- p-hero2 -->
		<header class="p-hero2 js-load-trigger">
			<p class="p-hero2__en js-effect-fadeup">blog</p>
			<?php if( is_home() && !is_date() && !is_tax() ): ?>
			<?php // if( !is_tax() && !is_date() ): ?>
			<h1 class="p-hero2__ja js-splittext">
				ブログ
			</h1>
			<?php else: ?>
			<h1 class="p-hero2__ja js-splittext">
				ブログ ／ <span class="u-ib"><?= wp_get_document_title(); ?></span>
			</h1>
			<?php endif; ?>
		</header>
		<!-- /p-hero2 -->
		<!-- u-p-relative -->
		<div class="u-p-relative">
			<section class="u-pb-medium">
				<div class="c-inner-large">
					<div class="c-line u-mb-small2"></div>
					<!-- c-flex2 -->
					<div class="c-flex2">
						<!-- c-flex2__side -->
						<div class="c-flex2__side">
							<?php require_once( dirname( __FILE__ ) . './../parts/sidebar.php'); ?>
						</div>
						<!-- /c-flex2__side -->
						<!-- c-flex2__main -->
						<div class="c-flex2__main">
							<?php if ( have_posts() ) : ?>
							<!-- p-card -->
							<ul class="p-card c-column-m40 -col-3-sm -m-40">
								<?php while ( have_posts()) : the_post(); ?>
								<?php
									/* ---------- new ---------- */
									$post_time      = get_the_time('U');
									$new_period_new = 7;
									$last           = time() - ($new_period_new * 24 * 60 * 60);

									if ( $post_time > $last ) {
										$new_tag = '<p class="c-new">NEW</p>';
									} else{
										$new_tag = '<div></div>';
									}


									/* ---------- term ---------- */
									// 親要素がある場合は、親要素を表示
									$term = get_the_terms( $post->ID , 'category' )[0];
									$term_name = $term->name;
									$term_slug = $term->slug;

									if( $term->parent ){
										$parent_id   = $term->parent;
										$parent_data = get_term( $parent_id , 'category' );
										$term_name = $parent_data->name;
										$term_slug = $parent_data->slug;
									}


									// 全て取得
									$term = get_the_terms( $post->ID , 'category' )
									$outputTerm = '';

									foreach ( $categorys as $category ) {
										$term_name = $category->name;
										$term_slug = $category->slug;

										$outputTerm .= '<li data-category="'. $term_slug .'">' . $term_name . '</li>';
									}


									/* ---------- thumbnail ---------- */
									if( has_post_thumbnail() ){
										$thumbnail_id  = get_post_thumbnail_id();
										$thumbnail_file = wp_get_attachment_image_src($thumbnail_id,'180_120_thumbnail')[0];

										$thumbnail_image = '<img src="'. $placeholder_file .'" data-original="'. $thumbnail_file .'" alt="" class="c-objectfit -cover js-lazyload">';
									} else{
										$thumbnail_image = '<img src="'. $noimage_file .'" alt="" class="c-objectfit -cover">';
									}

								 ?>
								<li class="p-card__cell">
									<a href="<?php the_permalink(); ?>">
										<figure class="p-card__figure">
											<?= $thumbnail_image; ?>
										</figure>
										<div class="c-meta -type1">
											<p class="c-meta__category" data-category="<?= $term_slug; ?>">
												<?= $term_name; ?>
											</p>
											<ul>
												<?php echo $outputTerm; ?>
											</ul>
											<p class="c-meta__time">
												<time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
											</p>
										</div>
										<h2 class="p-card__title">
											<span class="c-anchor-lineIn -black3">
												<?php the_title(); ?>
											</span>
										</h2>
										<p class="p-card__paragraph"><?php echo wp_trim_words( get_the_content(), 42, '...' ); ?></p>
									</a>
								</li>
								<?php endwhile; ?>
							</ul>
							<!-- /p-card -->
							<?php
								else:
									echo '<p class="c-txt-xlarge u-font-600">現在投稿がありません。</p>';
								endif;
							 ?>
							<!-- p-pagination -->
							<?php pagination($wp_query->max_num_pages); ?>
							<!-- /p-pagination -->
						</div>
						<!-- /c-flex2__main -->
					</div>
					<!-- /c-flex2 -->
				</div>
			</section>
		</div>
		<!-- /u-p-relative -->
	</main>
<?php require_once($web_root.$home_url.'include/footer.php'); ?>
</body>
</html>
