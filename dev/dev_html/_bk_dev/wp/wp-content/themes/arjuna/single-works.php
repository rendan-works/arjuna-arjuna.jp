<?php $this_path = 'works/'; ?>
<?php require_once( dirname( __FILE__ ) . '/../../../../include/variable.php' ); ?>
<?php require_once( dirname( __FILE__ ) . '/../../../../include/functions.php' ); ?>
<?php relativeURL(); ?>
<?php

	/**************************************************************
	 * title
	**************************************************************/
	/* ---------- SCF ---------- */
	$works_brand    = SCF::get('works_brand');
	$works_title_ja = SCF::get('works_title_ja');

	$page_title  = $works_brand . ' ' . $works_title_ja;


	/**************************************************************
	 * template
	**************************************************************/
	$directory = array(
		array('HOME','Home',''),
		array('WORKS','Works','works/'),
		array( $page_title , $page_title ,'Works/'. $post->post_name .'/'),
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
		<main class="l-main single-main">
			<!-- p-hero-->
			<header class="p-hero">
				<div class="p-hero__inner c-inner-max">
					<p class="p-hero__en">
						<span>WORKS</span>
					</p>
				</div>
			</header>
			<!-- /p-hero-->
			<!-- p-article2-->
			<?php
				/**************************************************************
				 * variable
				**************************************************************/
				/* ---------- terms ---------- */
				$client   = get_the_terms( $post->ID , 'works_client' )[0];
				$industry = get_the_terms( $post->ID , 'works_industry' )[0];


				/* ---------- SCF ---------- */
				$works_brand        = SCF::get('works_brand');
				$works_figure_group = SCF::get('works_figure_group');

				$works_title_en    = SCF::get('works_title_en');
				$works_title_ja    = SCF::get('works_title_ja');
				$works_txt         = SCF::get('works_txt');
				$works_image_group = SCF::get('works_image_group');

				$works_team_group = SCF::get('works_team_group');


				/**************************************************************
				 * client
				**************************************************************/
				$client_id       = $client->term_id;
				$client_slug     = $client->slug;
				$client_name     = $client->name;
				$client_en       = SCF::get_term_meta( $client_id, 'works_client' , 'client_en' );
				$client_industry = SCF::get_term_meta( $client_id, 'works_client' , 'client_industry' );
				$client_category = SCF::get_term_meta( $client_id, 'works_client' , 'client_category' );
				$client_tag      = SCF::get_term_meta( $client_id, 'works_client' , 'client_tag' );
				$client_website  = SCF::get_term_meta( $client_id, 'works_client' , 'client_website' );
				$client_outline  = SCF::get_term_meta( $client_id, 'works_client' , 'client_outline' );


				$outputIndustry = '';
				$outputCategory = '';
				$outputTag      = '';

				foreach ( $client_industry as $term_id ){
					$term      = get_term( $term_id , 'works_industry');
					$term_link = get_term_link($term);
					$term_name = $term->name;

					$outputIndustry .= '<li><a href="'. $term_link .'">' . $term_name . '</a></li>';
				}

				foreach ( $client_category as $term_id ){
					$term      = get_term( $term_id , 'works_category');
					$term_link = get_term_link($term);
					$term_name = $term->name;

					$outputCategory .= '<li><a href="'. $term_link .'">' . $term_name . '</a></li>';
				}

				foreach ( $client_tag as $term_id ){
					$term      = get_term( $term_id , 'works_tag');
					$term_link = get_term_link($term);
					$term_name = $term->name;

					$outputTag .= '<li><a href="'. $term_link .'">' . $term_name . '</a></li>';
				}


				/**************************************************************
				 * industry
				**************************************************************/
				$industry_id   = $industry->term_id;
				$industry_name = $industry->name;


			 ?>
			<article class="p-article2">
				<div class="c-inner-max">
					<!-- p-article2__header-->
					<header class="p-article2__header">
						<h1 class="p-article2__title">
							<?= $page_title; ?>
						</h1>
						<div class="p-article2__outline">
							<dl>
								<dt>BRAND</dt>
								<dd>
									<span class="-large">
										<?= $works_brand; ?>
									</span>
								</dd>
							</dl>
							<dl>
								<dt>CLIENT</dt>
								<dd class="-en">
									<?= $client_en; ?>
								</dd>
							</dl>
							<dl>
								<dt>GENRE</dt>
								<dd>
									<?= $industry_name; ?>
								</dd>
							</dl>
						</div>
						<p class="p-button4">
							<a href="<?= $root; ?>works/">
								<i class="c-icon c-index"></i>
								<span class="c-arrow3 -prev">＜</span>
								<span class="p-button4__txt">&nbsp;back to list</span>
							</a>
						</p>
					</header>
					<!-- /p-article2__header-->
					<!-- p-article2__figure-->
					<figure class="p-article2__figure">
						<ul class="p-article2__figure__content">
							<?php
								foreach ($works_figure_group as $fields):
									$image_id = $fields['works_figure_cell'];

									if( $image_id ){
										$works_figure_file = wp_get_attachment_image_src($image_id,'2560_1920_figure')[0];
									} else{
										$works_figure_file = $noimage_file;
									}
							 ?>
							<li class="p-article2__figure__slide">
								<img class="c-objectfit -cover" src="<?= $works_figure_file; ?>" alt="" decoding="async">
							</li>
							<?php endforeach; ?>
						</ul>
						<ul class="p-article2__figure__ui">
							<li class="p-article2__figure__ui__prev">
								<button class="u-reverse" type="button">
									<i class="c-icon c-arrow2 -large"></i>
								</button>
							</li>
							<li class="p-article2__figure__ui__next">
								<button type="button">
									<i class="c-icon c-arrow2 -large"></i>
								</button>
							</li>
						</ul>
					</figure>
					<!-- /p-article2__figure-->
					<!-- p-article2__client-->
					<section class="p-article2__client">
						<div class="p-article2__client__intro">
							<header class="p-article2__client__header">
								<div class="p-article2__client__title">
									<p class="p-article2__client__title__en">
										<?= $client_en; ?>
									</p>
									<h2 class="p-article2__client__title__ja">
										<?= $client_name; ?>
									</h2>
								</div>
							</header>
							<?php if( $client_outline ): ?>
							<div class="p-article2__client__title__contents">
								<h3 class="p-article2__client__title2">クライアント概要</h3>
								<p class="p-article2__client__txt c-txt-md c-crop">
									<?= $client_outline; ?>
								</p>
							</div>
							<?php endif; ?>
						</div>
						<div class="p-article2__client__table c-table2 -size1">
							<?php if( $client_name ): ?>
							<dl>
								<dt>
									<span class="c-table2__en">CLIENT</span>
								</dt>
								<dd>
									<span class="c-table2__txt">
										<?= $client_name; ?>
									</span>
								</dd>
							</dl>
							<?php endif; ?>
							<?php if( $outputIndustry ): ?>
							<dl>
								<dt>
									<span class="c-table2__en">INDUSTRY</span>
								</dt>
								<dd>
									<ul class="p-article2__client__table__list c-table2__txt c-list-slash -large">
										<?= $outputIndustry; ?>
									</ul>
								</dd>
							</dl>
							<?php endif; ?>
							<?php if( $outputCategory ): ?>
							<dl>
								<dt>
									<span class="c-table2__en">CATEGORY</span>
								</dt>
								<dd>
									<ul class="p-article2__client__table__list2">
										<?= $outputCategory; ?>
									</ul>
								</dd>
							</dl>
							<?php endif; ?>
							<?php if( $outputTag ): ?>
							<dl>
								<dt>
									<span class="c-table2__en">TAG</span>
								</dt>
								<dd>
									<ul class="p-article2__client__table__list3">
										<?= $outputTag; ?>
									</ul>
								</dd>
							</dl>
							<?php endif; ?>
							<?php if( $client_website ): ?>
							<dl>
								<dt>
									<span class="c-table2__en">WEBSITE</span>
								</dt>
								<dd>
									<a class="c-table2__txt c-anchor-lineIn" href="<?= $client_website; ?>" target="_blank" rel="noopener noreferrer">
										<?= $client_website; ?>
									</a>
								</dd>
							</dl>
							<?php endif; ?>
						</div>
					</section>
					<!-- /p-article2__client-->
					<!-- p-article2__contents-->
					<section class="p-article2__contents">
						<div class="c-flex -size1">
							<div class="c-flex__side c-sticky">
								<header>
									<div class="c-title3">
										<h2 class="c-title3__en">
											<span class="c-crop">
												<?= nl2br( $works_title_en ); ?>
											</span>
										</h2>
										<p class="c-title3__ja">
											<?= $works_title_ja; ?>
										</p>
									</div>
								</header>
								<p class="p-article2__contents__txt c-txt-lg c-crop">
									<?= nl2br( $works_txt ); ?>
								</p>
							</div>
							<div class="c-flex__main">
								<?php
								foreach ($works_image_group as $fields):
									$image_id  = $fields['works_image_cell'];
									$image_url = $fields['works_image_url'];

										if( $image_id ){
											$works_image_file = wp_get_attachment_image_src($image_id,'940_auto_figure')[0];
										} else{
											continue;
										}
								 ?>
								<figure class="p-article2__contents__figure">
									<img src="<?= $works_image_file; ?>" alt="" decoding="async">
									<?php if( $image_url ): ?>
									<figcaption>
										<a class="c-anchor-lineOut" href="<?= $image_url; ?>" target="_blank" rel="noopener noreferrer">
											<?= $image_url; ?>
										</a>
									</figcaption>
									<?php endif; ?>
								</figure>
								<?php endforeach; ?>
							</div>
						</div>
					</section>
					<!-- /p-article2__contents-->
					<!-- p-article2__team-->
					<section class="p-article2__team">
						<div class="c-flex -size2">
							<div class="c-flex__side">
								<header>
									<div class="c-title3">
										<h2 class="c-title3__en">
											<span class="c-crop">
												Project<br>
												Team</span>
										</h2>
										<p class="c-title3__ja">制作チーム</p>
									</div>
								</header>
							</div>
							<div class="c-flex__main p-article2__team__main">
								<div class="c-table2 -size2">
									<dl>
										<dt>
											<span class="c-table2__ja">クライアント</span>
										</dt>
										<dd>
											<span class="c-table2__txt">
												<?= $client_name; ?>
											</span>
										</dd>
									</dl>
									<?php
									foreach ($works_team_group as $fields):
										$works_team_dt = $fields['works_team_dt'];
										$works_team_dd = $fields['works_team_dd'];
									 ?>
									<dl>
										<dt>
											<span class="c-table2__ja">
												<?= $works_team_dt; ?>
											</span>
										</dt>
										<dd>
											<span class="c-table2__txt">
												<?= $works_team_dd; ?>
											</span>
										</dd>
									</dl>
									<?php endforeach; ?>
								</div>
							</div>
						</div>
					</section>
					<!-- /p-article2__team-->
					<!-- p-article2__other-->
					<?php
						$args = array(
							'post_type'      => 'works',
							'post_status'    => 'publish',
							'posts_per_page' => 6,
							'post__not_in'   => array(get_the_ID()),
							'tax_query' => array(
								array(
									'taxonomy' => 'works_client',
									'field'    => 'slug',
									'terms' => array(
										$client_slug,
									),
								),
								'relation' => 'AND'
							),
						);
						$the_query = new WP_Query( $args );
						if ( $the_query->have_posts() ) :
					?>
					<aside class="p-article2__other">
						<div class="c-flex -size2">
							<div class="c-flex__side">
								<header>
									<div class="c-title3">
										<h2 class="c-title3__en">
											<span class="c-crop">
												Other<br>
												Project</span>
										</h2>
										<p class="c-title3__ja">その他のプロジェクト</p>
									</div>
								</header>
							</div>
							<div class="p-article2__other__main c-flex__main">
								<div class="c-column -col-3-md -gap-c-70 -gap-r-70">
									<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
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
									<!-- p-card3-->
									<article class="p-card3">
										<a href="<?php the_permalink(); ?>">
											<figure class="c-aspect -square c-bg2">
												<?= $thumbnail_image; ?>
											</figure>
											<h3></h3>
											<h3 class="p-card3__title">
												<span class="c-crop">
													<?= $works_brand; ?>
												</span>
											</h3>
											<ul class="p-card3__category c-list-slash c-crop">
												<?= $outputTerm; ?>
											</ul>
										</a>
									</article>
									<!-- /p-card3-->
									<?php endwhile; ?>
								</div>
							</div>
						</div>
					</aside>
					<?php
						endif;
						wp_reset_postdata();
					?>
					<!-- /p-article2__other-->
				</div>
			</article>
			<!-- /p-article2-->
			<!-- p-pagination2-->
			<footer class="p-pagination2">
				<div class="c-inner-max">
					<p class="p-button4">
						<a href="<?= $root; ?>works/">
							<i class="c-icon c-index"></i>
							<span class="c-arrow3 -prev">＜</span>
							<span class="p-button4__txt">&nbsp;back to list</span>
						</a>
					</p>
				</div>
			</footer>
			<!-- /p-pagination2-->
		</main>
		<?php require_once($web_root.$root.'include/layout_contact.php'); ?>
		<?php require_once($web_root.$root.'include/layout_footer.php'); ?>
	</body>
</html>
