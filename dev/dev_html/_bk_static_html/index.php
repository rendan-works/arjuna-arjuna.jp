<?php $this_path = 'home/'; ?>
<?php require_once( dirname( __FILE__ ) . '/include/variable.php' ); ?>
<?php require_once( dirname( __FILE__ ) . '/include/functions.php' ); ?>
<?php
	$directory   = array(
		array('HOME','Home',''),
	);
	$robots = true;

	$meta = array(
		// 'title'       => $site_name,
		'title'       => getTitle($directory),
		'description' => '',
		'keywords'    => '',
	);

	$preload = array(
		//- array(
		//- 	'href' => $this_img_path . 'visual_01.jpg',
		//- 	'as'   => 'image',
		//- ),
	);
	$style = array(
		$root . 'assets/css/page-home.css',
	);
	$script = array(
		$root . 'assets/js/page-home.js',
	);
	$jquery  = false;

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
		<main class="home-main">
			<!-- home-kv-->
			<div class="home-kv"></div>
			<!-- /home-kv-->
			<!-- home-works-->
			<section class="home-works js-loopslider-wrap">
				<div class="home-works__row js-loopslider-mqUp-lg">
					<div class="js-loopslider__content">
						<div class="home-works__row__list">
							<!-- p-card2-->
							<article class="p-card2">
								<a href="<?= $root; ?>">
									<figure class="c-aspect -square c-bg2">
										<img class="c-objectfit -cover" src="https://placehold.jp/700x700.png" alt="" decoding="async">
									</figure>
									<div class="p-card2__contents">
										<h2 class="p-card2__title">たまらん堂</h2>
										<p class="p-card2__category">パッケージデザイン</p>
									</div>
								</a>
							</article>
							<!-- /p-card2-->
							<!-- p-card2-->
							<article class="p-card2">
								<a href="<?= $root; ?>">
									<figure class="c-aspect -square c-bg2">
										<img class="c-objectfit -cover" src="https://placehold.jp/700x700.png" alt="" decoding="async">
									</figure>
									<div class="p-card2__contents">
										<h2 class="p-card2__title">たまらん堂</h2>
										<p class="p-card2__category">パッケージデザイン</p>
									</div>
								</a>
							</article>
							<!-- /p-card2-->
							<!-- p-card2-->
							<article class="p-card2">
								<a href="<?= $root; ?>">
									<figure class="c-aspect -square c-bg2">
										<img class="c-objectfit -cover" src="https://placehold.jp/700x700.png" alt="" decoding="async">
									</figure>
									<div class="p-card2__contents">
										<h2 class="p-card2__title">たまらん堂</h2>
										<p class="p-card2__category">パッケージデザイン</p>
									</div>
								</a>
							</article>
							<!-- /p-card2-->
							<!-- p-card2-->
							<article class="p-card2">
								<a href="<?= $root; ?>">
									<figure class="c-aspect -square c-bg2">
										<img class="c-objectfit -cover" src="https://placehold.jp/700x700.png" alt="" decoding="async">
									</figure>
									<div class="p-card2__contents">
										<h2 class="p-card2__title">たまらん堂</h2>
										<p class="p-card2__category">パッケージデザイン</p>
									</div>
								</a>
							</article>
							<!-- /p-card2-->
							<!-- p-card2-->
							<article class="p-card2">
								<a href="<?= $root; ?>">
									<figure class="c-aspect -square c-bg2">
										<img class="c-objectfit -cover" src="https://placehold.jp/700x700.png" alt="" decoding="async">
									</figure>
									<div class="p-card2__contents">
										<h2 class="p-card2__title">たまらん堂</h2>
										<p class="p-card2__category">パッケージデザイン</p>
									</div>
								</a>
							</article>
							<!-- /p-card2-->
							<!-- p-card2-->
							<article class="p-card2">
								<a href="<?= $root; ?>">
									<figure class="c-aspect -square c-bg2">
										<img class="c-objectfit -cover" src="https://placehold.jp/700x700.png" alt="" decoding="async">
									</figure>
									<div class="p-card2__contents">
										<h2 class="p-card2__title">たまらん堂</h2>
										<p class="p-card2__category">パッケージデザイン</p>
									</div>
								</a>
							</article>
							<!-- /p-card2-->
						</div>
					</div>
				</div>
				<div class="home-works__row js-loopslider-mqUp-lg">
					<div class="js-loopslider__content">
						<div class="home-works__row__list">
							<!-- p-card2-->
							<article class="p-card2">
								<a href="<?= $root; ?>">
									<figure class="c-aspect -square c-bg2">
										<img class="c-objectfit -cover" src="https://placehold.jp/700x700.png" alt="" decoding="async">
									</figure>
									<div class="p-card2__contents">
										<h2 class="p-card2__title">たまらん堂</h2>
										<p class="p-card2__category">パッケージデザイン</p>
									</div>
								</a>
							</article>
							<!-- /p-card2-->
							<!-- p-card2-->
							<article class="p-card2">
								<a href="<?= $root; ?>">
									<figure class="c-aspect -square c-bg2">
										<img class="c-objectfit -cover" src="https://placehold.jp/700x700.png" alt="" decoding="async">
									</figure>
									<div class="p-card2__contents">
										<h2 class="p-card2__title">たまらん堂</h2>
										<p class="p-card2__category">パッケージデザイン</p>
									</div>
								</a>
							</article>
							<!-- /p-card2-->
							<!-- p-card2-->
							<article class="p-card2">
								<a href="<?= $root; ?>">
									<figure class="c-aspect -square c-bg2">
										<img class="c-objectfit -cover" src="https://placehold.jp/700x700.png" alt="" decoding="async">
									</figure>
									<div class="p-card2__contents">
										<h2 class="p-card2__title">たまらん堂</h2>
										<p class="p-card2__category">パッケージデザイン</p>
									</div>
								</a>
							</article>
							<!-- /p-card2-->
							<!-- p-card2-->
							<article class="p-card2">
								<a href="<?= $root; ?>">
									<figure class="c-aspect -square c-bg2">
										<img class="c-objectfit -cover" src="https://placehold.jp/700x700.png" alt="" decoding="async">
									</figure>
									<div class="p-card2__contents">
										<h2 class="p-card2__title">たまらん堂</h2>
										<p class="p-card2__category">パッケージデザイン</p>
									</div>
								</a>
							</article>
							<!-- /p-card2-->
							<!-- p-card2-->
							<article class="p-card2">
								<a href="<?= $root; ?>">
									<figure class="c-aspect -square c-bg2">
										<img class="c-objectfit -cover" src="https://placehold.jp/700x700.png" alt="" decoding="async">
									</figure>
									<div class="p-card2__contents">
										<h2 class="p-card2__title">たまらん堂</h2>
										<p class="p-card2__category">パッケージデザイン</p>
									</div>
								</a>
							</article>
							<!-- /p-card2-->
							<!-- p-card2-->
							<article class="p-card2">
								<a href="<?= $root; ?>">
									<figure class="c-aspect -square c-bg2">
										<img class="c-objectfit -cover" src="https://placehold.jp/700x700.png" alt="" decoding="async">
									</figure>
									<div class="p-card2__contents">
										<h2 class="p-card2__title">たまらん堂</h2>
										<p class="p-card2__category">パッケージデザイン</p>
									</div>
								</a>
							</article>
							<!-- /p-card2-->
						</div>
					</div>
				</div>
				<div class="home-works__row js-loopslider-mqUp-lg">
					<div class="js-loopslider__content">
						<div class="home-works__row__list">
							<!-- p-card2-->
							<article class="p-card2">
								<a href="<?= $root; ?>">
									<figure class="c-aspect -square c-bg2">
										<img class="c-objectfit -cover" src="https://placehold.jp/700x700.png" alt="" decoding="async">
									</figure>
									<div class="p-card2__contents">
										<h2 class="p-card2__title">たまらん堂</h2>
										<p class="p-card2__category">パッケージデザイン</p>
									</div>
								</a>
							</article>
							<!-- /p-card2-->
							<!-- p-card2-->
							<article class="p-card2">
								<a href="<?= $root; ?>">
									<figure class="c-aspect -square c-bg2">
										<img class="c-objectfit -cover" src="https://placehold.jp/700x700.png" alt="" decoding="async">
									</figure>
									<div class="p-card2__contents">
										<h2 class="p-card2__title">たまらん堂</h2>
										<p class="p-card2__category">パッケージデザイン</p>
									</div>
								</a>
							</article>
							<!-- /p-card2-->
							<!-- p-card2-->
							<article class="p-card2">
								<a href="<?= $root; ?>">
									<figure class="c-aspect -square c-bg2">
										<img class="c-objectfit -cover" src="https://placehold.jp/700x700.png" alt="" decoding="async">
									</figure>
									<div class="p-card2__contents">
										<h2 class="p-card2__title">たまらん堂</h2>
										<p class="p-card2__category">パッケージデザイン</p>
									</div>
								</a>
							</article>
							<!-- /p-card2-->
							<!-- p-card2-->
							<article class="p-card2">
								<a href="<?= $root; ?>">
									<figure class="c-aspect -square c-bg2">
										<img class="c-objectfit -cover" src="https://placehold.jp/700x700.png" alt="" decoding="async">
									</figure>
									<div class="p-card2__contents">
										<h2 class="p-card2__title">たまらん堂</h2>
										<p class="p-card2__category">パッケージデザイン</p>
									</div>
								</a>
							</article>
							<!-- /p-card2-->
							<!-- p-card2-->
							<article class="p-card2">
								<a href="<?= $root; ?>">
									<figure class="c-aspect -square c-bg2">
										<img class="c-objectfit -cover" src="https://placehold.jp/700x700.png" alt="" decoding="async">
									</figure>
									<div class="p-card2__contents">
										<h2 class="p-card2__title">たまらん堂</h2>
										<p class="p-card2__category">パッケージデザイン</p>
									</div>
								</a>
							</article>
							<!-- /p-card2-->
							<!-- p-card2-->
							<article class="p-card2">
								<a href="<?= $root; ?>">
									<figure class="c-aspect -square c-bg2">
										<img class="c-objectfit -cover" src="https://placehold.jp/700x700.png" alt="" decoding="async">
									</figure>
									<div class="p-card2__contents">
										<h2 class="p-card2__title">たまらん堂</h2>
										<p class="p-card2__category">パッケージデザイン</p>
									</div>
								</a>
							</article>
							<!-- /p-card2-->
						</div>
					</div>
				</div>
			</section>
			<!-- /home-works-->
			<!-- home-blog-->
			<section class="home-blog">
				<header class="home-blog__header">
					<div class="c-inner-max">
						<h2 class="c-title">Blog</h2>
					</div>
				</header>
				<div class="home-blog__list">
					<div class="home-blog__list__inner swiper-wrapper">
						<!-- p-card-->
						<article class="p-card -type1 swiper-slide">
							<figure class="p-card__figure c-bg2">
								<img class="c-objectfit -cover" src="<?= $img_path; ?>common/noimage.webp" alt="" decoding="async">
							</figure>
							<div class="p-card__contents">
								<div>
									<p class="p-card__time">
										<time>2024.05.01</time>
									</p>
									<h3 class="p-card__title c-crop">
										<span>はじめてのロゴ制作</span>
									</h3>
								</div>
								<div class="p-card__another">
									<p class="p-card__button p-button3 -small">
										<a href="<?= $root; ?>">記事を読む&nbsp;<span class="c-arrow3">＞</span>
										</a>
									</p>
									<div class="p-card__info">
										<p class="p-card__term">デザイン経営の三点倒立デザイン経営の三点倒立</p>
										<p class="p-card__name">笹田 健一</p>
									</div>
									<figure class="p-card__term-image c-aspect -square c-radius-circle">
										<img class="c-objectfit -cover" src="https://placehold.jp/320x320.png" alt="" decoding="async">
									</figure>
								</div>
							</div>
						</article>
						<!-- /p-card-->
						<!-- p-card-->
						<article class="p-card -type1 swiper-slide">
							<figure class="p-card__figure c-bg2">
								<img class="c-objectfit -cover" src="<?= $img_path; ?>common/noimage.webp" alt="" decoding="async">
							</figure>
							<div class="p-card__contents">
								<div>
									<p class="p-card__time">
										<time>2024.05.01</time>
									</p>
									<h3 class="p-card__title c-crop">
										<span>はじめてのロゴ制作はじめてのロゴ制作はじめてのロゴ制作はじめてのロゴ制作</span>
									</h3>
								</div>
								<div class="p-card__another">
									<p class="p-card__button p-button3 -small">
										<a href="<?= $root; ?>">記事を読む&nbsp;<span class="c-arrow3">＞</span>
										</a>
									</p>
									<div class="p-card__info">
										<p class="p-card__term">デザイン経営の三点倒立デザイン経営の三点倒立</p>
										<p class="p-card__name">笹田 健一</p>
									</div>
									<figure class="p-card__term-image c-aspect -square c-radius-circle">
										<img class="c-objectfit -cover" src="https://placehold.jp/320x320.png" alt="" decoding="async">
									</figure>
								</div>
							</div>
						</article>
						<!-- /p-card-->
						<!-- p-card-->
						<article class="p-card -type1 swiper-slide">
							<figure class="p-card__figure c-bg2">
								<img class="c-objectfit -cover" src="<?= $img_path; ?>common/noimage.webp" alt="" decoding="async">
							</figure>
							<div class="p-card__contents">
								<div>
									<p class="p-card__time">
										<time>2024.05.01</time>
									</p>
									<h3 class="p-card__title c-crop">
										<span>はじめてのロゴ制作</span>
									</h3>
								</div>
								<div class="p-card__another">
									<p class="p-card__button p-button3 -small">
										<a href="<?= $root; ?>">記事を読む&nbsp;<span class="c-arrow3">＞</span>
										</a>
									</p>
									<div class="p-card__info">
										<p class="p-card__term">デザイン経営の三点倒立デザイン経営の三点倒立</p>
										<p class="p-card__name">笹田 健一</p>
									</div>
									<figure class="p-card__term-image c-aspect -square c-radius-circle">
										<img class="c-objectfit -cover" src="https://placehold.jp/320x320.png" alt="" decoding="async">
									</figure>
								</div>
							</div>
						</article>
						<!-- /p-card-->
						<!-- p-card-->
						<article class="p-card -type1 swiper-slide">
							<figure class="p-card__figure c-bg2">
								<img class="c-objectfit -cover" src="<?= $img_path; ?>common/noimage.webp" alt="" decoding="async">
							</figure>
							<div class="p-card__contents">
								<div>
									<p class="p-card__time">
										<time>2024.05.01</time>
									</p>
									<h3 class="p-card__title c-crop">
										<span>はじめてのロゴ制作</span>
									</h3>
								</div>
								<div class="p-card__another">
									<p class="p-card__button p-button3 -small">
										<a href="<?= $root; ?>">記事を読む&nbsp;<span class="c-arrow3">＞</span>
										</a>
									</p>
									<div class="p-card__info">
										<p class="p-card__term">デザイン経営の三点倒立デザイン経営の三点倒立</p>
										<p class="p-card__name">笹田 健一</p>
									</div>
									<figure class="p-card__term-image c-aspect -square c-radius-circle">
										<img class="c-objectfit -cover" src="https://placehold.jp/320x320.png" alt="" decoding="async">
									</figure>
								</div>
							</div>
						</article>
						<!-- /p-card-->
						<!-- p-card-->
						<article class="p-card -type1 swiper-slide">
							<figure class="p-card__figure c-bg2">
								<img class="c-objectfit -cover" src="<?= $img_path; ?>common/noimage.webp" alt="" decoding="async">
							</figure>
							<div class="p-card__contents">
								<div>
									<p class="p-card__time">
										<time>2024.05.01</time>
									</p>
									<h3 class="p-card__title c-crop">
										<span>はじめてのロゴ制作</span>
									</h3>
								</div>
								<div class="p-card__another">
									<p class="p-card__button p-button3 -small">
										<a href="<?= $root; ?>">記事を読む&nbsp;<span class="c-arrow3">＞</span>
										</a>
									</p>
									<div class="p-card__info">
										<p class="p-card__term">デザイン経営の三点倒立デザイン経営の三点倒立</p>
										<p class="p-card__name">笹田 健一</p>
									</div>
									<figure class="p-card__term-image c-aspect -square c-radius-circle">
										<img class="c-objectfit -cover" src="https://placehold.jp/320x320.png" alt="" decoding="async">
									</figure>
								</div>
							</div>
						</article>
						<!-- /p-card-->
					</div>
				</div>
				<p class="home-blog__button p-button -regular -black">
					<a href="<?= $root; ?>">
						<span class="p-button__en">View More</span>
						<i class="c-icon c-arrow"></i>
					</a>
				</p>
			</section>
			<!-- /home-blog-->
		</main>
		<?php require_once($web_root.$root.'include/layout_contact.php'); ?>
		<?php require_once($web_root.$root.'include/layout_footer.php'); ?>
	</body>
</html>
