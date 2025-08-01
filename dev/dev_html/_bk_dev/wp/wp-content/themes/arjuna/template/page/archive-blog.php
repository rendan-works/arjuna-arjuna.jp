<?php $this_path = 'blog/'; ?>
<?php require_once( dirname( __FILE__ ) . '/../../../../../../include/variable.php' ); ?>
<?php require_once( dirname( __FILE__ ) . '/../../../../../../include/functions.php' ); ?>
<?php relativeURL(); ?>
<?php
	$directory = array(
		array('HOME','Home',''),
		array('BLOG','Blog','blog/'),
	);
	$robots = true;

	if( is_home() && !is_date() && !is_tax() ){
		$page_description = '';
	} else{
		$directory        = getWPDirectory( $directory );
		$page_description = 'アルジュナのカテゴリー別BLOG「'. wp_get_document_title() .'」についてご案内します。';
	}

	$meta = array(
		'title'       => getTitle($directory),
		'description' => $page_description,
		'keywords'    => '',
	);

	$preload = array();
	$style = array(
		$root . 'assets/css/page-blog.css',
	);
	$script = array();
	$jquery = false;

	$contact_class = '';
?>
<!DOCTYPE html>
<html lang="ja">
	<head>
		<?php require_once($web_root.$root.'include/meta.php'); ?>
	</head>
	<body data-root="<?= $root; ?>">
		<?php require_once($web_root.$root.'include/layout_loading.php'); ?>
		<?php require_once($web_root.$root.'include/layout_header.php'); ?>
		<main class="l-main blog-main">
			<!-- p-hero-->
			<header class="p-hero -bg3">
				<div class="p-hero__inner c-inner-max">
					<p class="p-hero__en">
						<span class="js-splittext">BLOG</span>
					</p>
					<p class="p-hero__catch c-crop js-fade js-var-delay-7">
						考えたこと、<br>
						できあがっていくもの<br>
						出会ったひと。<br>
						デザインに包まれた私達の日常です。
					</p>
				</div>
			</header>
			<!-- /p-hero-->
			<!-- blog-category-->
			<aside class="blog-category">
				<div class="c-inner-max">
					<?php require_once( dirname( __FILE__ ) . './../parts/blog_category.php'); ?>
				</div>
			</aside>
			<!-- /blog-category-->
			<!-- blog-archive-->
			<section class="blog-archive" id="target-archive">
				<div class="c-inner-max -contents-lg">
					<header>
						<div class="c-title2 js-trigger js-fadeups">
							<p class="c-title2__main">新着ブログ</p>
							<?php if( is_home() && !is_date() && !is_tax() ): ?>
								<h1 class="c-title2__ja">#全ての記事</h1>
								<p class="c-title2__en">ALL&nbsp;article</p>
							<?php else: ?>
								<h1 class="c-title2__ja">
									<?php
										$first_title_txt = substr( wp_get_document_title() , 0, 1);

										if ($first_title_txt !== '#'){
											echo '#';
										}

										echo wp_get_document_title() . 'の記事';
									?>
								</h1>
								<p class="c-title2__en">
									<?php
										$post_obj  = $wp_query->get_queried_object();
										$term_slug = $post_obj->category_nicename;
									?>
									<?= $term_slug; ?>&nbsp;article
								</p>
							<?php endif; ?>
						</div>
					</header>
					<div class="blog-archive__list c-column -col-2-md -gap-c-118 -gap-r-100">
						<?php if ( have_posts() ) : ?>
						<?php while ( have_posts()) : the_post(); ?>
						<?php
							/* ---------- term ---------- */
							$term      = get_the_terms( $post->ID , 'category' )[0];
							$term_id   = $term->term_id;
							$term_name = str_replace('\\', '', $term->name );
							$term_slug = $term->slug;

							$category_name      = SCF::get_term_meta( $term_id, 'category', 'category_name' );
							$category_thumbnail = SCF::get_term_meta( $term_id, 'category', 'category_thumbnail' );


							if( $category_thumbnail ){
								$category_thumbnail_file = wp_get_attachment_image_src($category_thumbnail,'160_160_thumbnail')[0];
							} else{
								$category_thumbnail_file = '';
							}


							/* ---------- thumbnail ---------- */
							if( has_post_thumbnail() ){
								$thumbnail_id   = get_post_thumbnail_id();
								$thumbnail_file = wp_get_attachment_image_src($thumbnail_id,'590_333_thumbnail')[0];

								$thumbnail_image = '<img src="'. $placeholder_file .'" data-original="'. $thumbnail_file .'" alt="" class="c-objectfit -cover js-lazyload">';
							} else{
								$thumbnail_image = '<img src="'. $noimage_file .'" alt="" class="c-objectfit -cover">';
							}

						 ?>
						<!-- p-card-->
						<article class="p-card -type2">
							<a href="<?php the_permalink(); ?>"></a>
							<figure class="p-card__figure c-bg2">
								<?= $thumbnail_image; ?>
							</figure>
							<div class="p-card__contents">
								<div>
									<p class="p-card__time">
										<time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
									</p>
									<h3 class="p-card__title c-crop">
										<span>
											<?php the_title(); ?>
										</span>
									</h3>
								</div>
								<div class="p-card__another">
									<p class="p-card__button p-button3">
										<a href="<?php the_permalink(); ?>">
											記事を読む&nbsp;<span class="c-arrow3">＞</span>
										</a>
									</p>
									<div class="p-card__info">
										<p class="p-card__term">
											<?= $term_name; ?>
										</p>
										<?php if( $category_name ): ?>
										<p class="p-card__name">
											<?= $category_name; ?>
										</p>
										<?php endif; ?>
									</div>
									<?php if( $category_thumbnail_file ): ?>
									<figure class="p-card__term-image c-aspect -square c-radius-circle">
										<img class="c-objectfit -cover" src="<?= $category_thumbnail_file; ?>" alt="" decoding="async">
									</figure>
									<?php endif; ?>
								</div>
							</div>
						</article>
						<!-- /p-card-->
						<?php endwhile; ?>
						<?php else: ?>
							<p class="c-txt-lg">現在投稿がありません。</p>
						<?php endif; ?>
					</div>
					<!-- p-pagination -->
					<?php pagination($wp_query->max_num_pages,'#target-archive'); ?>
					<!-- /p-pagination -->
				</div>
			</section>
			<!-- /blog-archive-->
		</main>
		<?php require_once($web_root.$root.'include/layout_contact.php'); ?>
		<?php require_once($web_root.$root.'include/layout_footer.php'); ?>
	</body>
</html>
