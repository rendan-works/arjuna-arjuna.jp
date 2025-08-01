<?php $this_path = 'blog/single/'; ?>
<?php require_once( dirname( __FILE__ ) . '/../../../../include/variable.php' ); ?>
<?php require_once( dirname( __FILE__ ) . '/../../../../include/functions.php' ); ?>
<?php relativeURL(); ?>
<?php
	$directory = array(
		array('HOME','Home',''),
		array('BLOG','Blog','blog/'),
		array( get_the_title() , get_the_title() ,'blog/'. $post->post_name .'/'),
	);
	$robots = true;

	if ( $post->post_excerpt ) {
		$page_description = $post->post_excerpt;
	} else {
		$page_description = getSubstr( $post->post_content , 100 , '...' );
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
		<main class="l-main single-main">
			<!-- p-hero-->
			<header class="p-hero -bg3">
				<div class="p-hero__inner c-inner-max">
					<p class="p-hero__en">
						<span>BLOG</span>
					</p>
				</div>
			</header>
			<!-- /p-hero-->
			<!-- p-article-->
			<?php
				/* ---------- term ---------- */
				$term = get_the_terms( $post->ID , 'category' )[0];

				$term_id   = $term->term_id;
				$term_link = get_term_link($term);
				$term_name = str_replace('\\', '<br>', $term->name );
				$term_slug = $term->slug;

				$category_name         = SCF::get_term_meta( $term_id, 'category', 'category_name' );
				$category_en           = SCF::get_term_meta( $term_id, 'category', 'category_en' );
				$category_post         = SCF::get_term_meta( $term_id, 'category', 'category_post' );
				$category_degree_group = SCF::get_term_meta( $term_id, 'category', 'category_degree_group' );
				$category_thumbnail    = SCF::get_term_meta( $term_id, 'category', 'category_thumbnail' );
				$category_content      = SCF::get_term_meta( $term_id, 'category', 'category_content' );

				if( $category_thumbnail ){
					$category_thumbnail_file = wp_get_attachment_image_src($category_thumbnail,'160_160_thumbnail')[0];
				} else{
					$category_thumbnail_file = '';
				}


				/* ---------- thumbnail ---------- */
				if( has_post_thumbnail() ){
					$thumbnail_id   = get_post_thumbnail_id();
					$thumbnail_file = wp_get_attachment_image_src($thumbnail_id,'840_auto_figure')[0];

					$article_figure_image = '<img src="'. $placeholder_file .'" data-original="'. $thumbnail_file .'" alt="" class="c-objectfit -cover js-lazyload">';
				} else{
					$article_figure_image = '';
				}

			 ?>
			<div class="p-article">
				<div class="p-article__inner c-inner-max">
					<header class="p-article__header u-n-mqUp-lg">
						<h1 class="p-article__title c-crop">
							<?php the_title(); ?>
						</h1>
					</header>
					<!-- p-article__flex-->
					<div class="p-article__flex">
						<!-- p-article__another-->
						<aside class="p-article__another">
							<?php
								if(
									$category_thumbnail_file ||
									$category_name ||
									$category_en ||
									$category_post ||
									$category_degree_group[0]['category_degree_cell']
								):
							?>
							<div class="p-article__another__flex">
								<?php if( $category_thumbnail_file ): ?>
								<figure class="p-article__another__figure c-aspect -square c-radius-circle">
									<img class="c-objectfit -cover" src="<?= $category_thumbnail_file; ?>" alt="" decoding="async">
								</figure>
								<?php endif; ?>
								<div class="p-article__another__profile">
									<?php if( $category_name ): ?>
									<p class="p-article__another__name">
										<?= $category_name; ?>
									</p>
									<?php endif; ?>
									<?php if( $category_en ): ?>
									<p class="p-article__another__kana">
										<?= $category_en; ?>
									</p>
									<?php endif; ?>
									<?php if( $category_post ): ?>
									<p class="p-article__another__post">
										<?= $category_post; ?>
									</p>
									<?php endif; ?>
									<?php if( $category_degree_group ): ?>
										<?php foreach ( $category_degree_group as $fields ): ?>
										<p class="p-article__another__degree">
											<?= $fields['category_degree_cell']; ?>
										</p>
										<?php endforeach; ?>
									<?php endif; ?>
								</div>
							</div>
							<?php endif; ?>
							<p class="p-article__another__title c-crop">
								<?= $term_name; ?>
							</p>
							<?php if( $category_content ): ?>
							<p class="p-article__another__txt c-txt-xl c-crop">
								<?= nl2br($category_content); ?>
							</p>
							<?php endif; ?>
							<p class="p-article__another__button p-button3">
								<a href="<?= $term_link; ?>#target-archive">記事一覧へ&nbsp;<span class="c-arrow3">＞</span>
								</a>
							</p>
						</aside>
						<!-- /p-article__another-->
						<!-- p-article__main-->
						<article class="p-article__main">
							<header class="p-article__header u-n-mqDown-lg">
								<p class="p-article__time">
									<time datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
								</p>
								<h1 class="p-article__title c-crop">
									<?php the_title(); ?>
								</h1>
							</header>
							<?php if( $article_figure_image ): ?>
							<figure class="p-article__figure">
								<?= $article_figure_image; ?>
							</figure>
							<?php endif; ?>
							<div class="p-article__contents s-editor">
								<?php the_content(); ?>
							</div>
						</article>
						<!-- /p-article__main-->
					</div>
					<!-- /p-article__flex-->
					<!-- p-article__footer-->
					<footer class="p-article__footer">
						<p class="p-article__footer__button p-button3">
							<a href="<?= $term_link; ?>#target-archive">記事一覧へ&nbsp;<span class="c-arrow3">＞</span>
							</a>
						</p>
					</footer>
					<!-- /p-article__footer-->
				</div>
			</div>
			<!-- /p-article-->
			<!-- single-category-->
			<aside class="single-category">
				<div class="c-inner-max">
					<?php require_once( dirname( __FILE__ ) . '/template/parts/blog_category.php'); ?>
				</div>
			</aside>
			<!-- /single-category-->
		</main>
		<?php require_once($web_root.$root.'include/layout_contact.php'); ?>
		<?php require_once($web_root.$root.'include/layout_footer.php'); ?>
	</body>
</html>
