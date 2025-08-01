<?php $this_path = 'works/'; ?>
<?php require_once( dirname( __FILE__ ) . '/../../../../../../include/variable.php' ); ?>
<?php require_once( dirname( __FILE__ ) . '/../../../../../../include/functions.php' ); ?>
<?php relativeURL(); ?>
<?php
	$directory = array(
		array('HOME','Home',''),
		array('WORKS','Works','works/'),
	);
	$robots = true;

	$meta = array(
		'title'       => getTitle($directory),
		'description' => '',
		'keywords'    => '',
	);

	$preload = array();
	$style = array(
		$root . 'assets/css/page-works.css',
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
		<main class="l-main works-main">
			<!-- p-hero-->
			<header class="p-hero">
				<div class="p-hero__inner c-inner-max">
					<?php if( !is_tax() && !is_date() ): ?>
					<h1 class="p-hero__en">
						<span class="js-splittext">WORKS</span>
					</h1>
					<?php else: ?>
					<p class="p-hero__en">
						<span class="js-splittext">WORKS</span>
					</p>
					<h1 class="p-hero__ja">
						<?= wp_get_document_title(); ?>
					</h1>
					<?php endif; ?>
				</div>
			</header>
			<!-- /p-hero-->
			<!-- works-terms-->
			<aside class="works-terms p-category2">
				<div class="p-category2__inner c-inner-max js-accordion-click">
					<header class="p-category2__header">
						<h2 class="p-category2__title">絞り込み条件</h2>
						<button class="p-category2__button js-accordion__switch" type="button">
							<span class="p-category2__button__txt">
								<span>Open</span>
								<span>Close</span>
							</span>
							<i class="c-down"></i>
						</button>
					</header>
					<div class="p-category2__contents js-accordion__panel">
						<div class="p-category2__contents__inner">
							<dl class="p-category2__cell">
								<dt>
									<span class="p-category2__cell__en">Industry</span>
									<span class="p-category2__cell__ja">業種</span>
								</dt>
								<dd>
									<ul class="p-category2__cell__list">
										<li>
											<a href="<?= $root; ?>works/">すべて</a>
										</li>
										<?php
											$args = array(
												'orderby'    => 'name',
												'hide_empty' => 1,
												'pad_counts' => 0,
												'parent'     => 0,
											);
											$terms = get_terms( 'works_industry' , $args );

											foreach ( $terms as $term ) :
												$term_link = get_term_link($term);
												$term_name = $term->name;
										?>
										<li>
											<a href="<?= $term_link; ?>">
												<?= $term_name; ?>
											</a>
										</li>
										<?php endforeach; ?>
									</ul>
								</dd>
							</dl>
							<dl class="p-category2__cell">
								<dt>
									<span class="p-category2__cell__en">Category</span>
									<span class="p-category2__cell__ja">製作物の種類</span>
								</dt>
								<dd>
									<ul class="p-category2__cell__list">
										<li>
											<a href="<?= $root; ?>works/">すべて</a>
										</li>
										<?php
											$args = array(
												'orderby'    => 'name',
												'hide_empty' => 1,
												'pad_counts' => 0,
												'parent'     => 0,
											);
											$terms = get_terms( 'works_category' , $args );

											foreach ( $terms as $term ) :
												$term_link = get_term_link($term);
												$term_name = $term->name;
										?>
										<li>
											<a href="<?= $term_link; ?>">
												<?= $term_name; ?>
											</a>
										</li>
										<?php endforeach; ?>
									</ul>
								</dd>
							</dl>
						</div>
					</div>
				</div>
			</aside>
			<!-- /works-terms-->
			<!-- works-list-->
			<div class="works-list">
				<div class="c-inner-max -contents-lg">
					<div class="c-column -col-4-xl-md -gap-30">
						<?php if ( have_posts() ) : ?>
						<?php while ( have_posts()) : the_post(); ?>
						<?php
							/* ---------- SCF ---------- */
							$works_brand = SCF::get('works_brand');


							/* ---------- term ---------- */
							$terms      = get_the_terms( $post->ID , 'works_category' );
							$outputTerm = '';

							foreach ( $terms as $term ) {
								$term_name = $term->name;
								$term_slug = $term->slug;

								$outputTerm .= '<li>' . $term_name . '</li>';
							}


							/* ---------- thumbnail ---------- */
							if( has_post_thumbnail() ){
								$thumbnail_id   = get_post_thumbnail_id();
								$thumbnail_file = wp_get_attachment_image_src($thumbnail_id,'376_376_thumbnail')[0];

								$thumbnail_image = '<img src="'. $placeholder_file .'" data-original="'. $thumbnail_file .'" alt="" class="c-objectfit -cover js-lazyload">';
							} else{
								$thumbnail_image = '<img src="'. $noimage_file .'" alt="" class="c-objectfit -cover">';
							}

						 ?>
						<!-- p-card2-->
						<article class="p-card2">
							<a href="<?php the_permalink(); ?>">
								<figure class="c-aspect -square c-bg2">
									<?= $thumbnail_image; ?>
								</figure>
								<div class="p-card2__contents">
									<h2 class="p-card2__title">
										<?= $works_brand; ?>
									</h2>
									<ul class="p-card2__category c-list-slash">
										<?= $outputTerm; ?>
									</ul>
								</div>
							</a>
						</article>
						<!-- /p-card2-->
						<?php endwhile; ?>
						<?php else: ?>
							<p class="c-txt-lg">現在投稿がありません。</p>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<!-- /works-list-->
			<!-- p-pagination -->
			<?php pagination($wp_query->max_num_pages); ?>
			<!-- /p-pagination -->
		</main>
		<?php require_once($web_root.$root.'include/layout_contact.php'); ?>
		<?php require_once($web_root.$root.'include/layout_footer.php'); ?>
	</body>
</html>
