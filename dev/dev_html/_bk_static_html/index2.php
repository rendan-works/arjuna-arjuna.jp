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
			<div class="home-kv">
				<div class="home-kv__inner c-inner-max -contents-full">
					<p class="home-kv__txt -left">branding&amp;design</p>
					<p class="home-kv__txt -right">arjuna.co</p>
					<div class="home-kv__image">
						<img src="<?= $this_img_path; ?>apng-kv.png" alt="" decoding="async">
					</div>
				</div>
			</div>
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
			<!-- home-about-->
			<section class="home-about">
				<div class="home-about__inner c-inner-max">
					<h2 class="home-about__catch js-trigger js-splittext">デザインが楽しくする</h2>
					<p class="home-about__txt -unique1 c-txt-xxl2 c-crop">
						社会の何を。<br>
						地域の何を。<br>
						私たちの何を。<br>
						<br>
						デザインは、楽しくしてゆくのだろう。
					</p>
					<div class="home-about__illust -unique1 js-parallax -medium">
						<img src="<?= $this_img_path; ?>about_illust_1.webp" alt="" decoding="async">
					</div>
					<div class="home-about__illust -unique2 c-anime-floating2">
						<picture>
							<source srcset="<?= $this_img_path; ?>about_illust_2-pc.webp" media="<?= $mqUpLg; ?>">
							<source srcset="<?= $this_img_path; ?>about_illust_2-sp.webp" media="<?= $mqDownLg; ?>">
							<img src="<?= $this_img_path; ?>about_illust_2-pc.webp" alt="" decoding="async">
						</picture>
					</div>
					<p class="home-about__txt -unique2 c-txt-xxl2 c-crop">
						デザインは、装飾品でなければ、<br class="u-n-mqUp-lg">芸術品でもない。<br>
						だから、みんなで一緒につくっていく<br class="u-n-mqUp-lg">プロセスが大事。<br>
						デザインが、何を楽しくできるのか。<br>
						立ち止まって考えて、オープンに問い続ける<br class="u-n-mqUp-lg">姿勢こそ<br class="u-n-mqDown-lg">
						大切なのだと私たちは思います。
					</p>
					<div class="home-about__illust -unique3 c-anime-floating2 c-delay-7">
						<img src="<?= $this_img_path; ?>about_illust_3.webp" alt="" decoding="async">
					</div>
					<p class="home-about__txt -unique3 c-txt-xxl2 c-crop">
						想像して、工夫して、思い合って、寄り添って。<br>
						頭を動かし、手を動かし、心を動かすまで。<br>
						私たちの手を離れたあとに見えてくるもの、<br>
						その道のりこそ、デザインと呼ばれるもので<br>はないでしょうか。
					</p>
					<div class="home-about__illusts -group1">
						<div class="home-about__illust -unique4 js-parallax -small">
							<img src="<?= $this_img_path; ?>about_illust_4.webp" alt="" decoding="async">
						</div>
						<div class="home-about__illust -unique5 c-anime-floating2 c-delay-2">
							<img src="<?= $this_img_path; ?>about_illust_5.webp" alt="" decoding="async">
						</div>
						<div class="home-about__illust -unique8 js-parallax -small">
							<img src="<?= $this_img_path; ?>about_illust_8.webp" alt="" decoding="async">
						</div>
					</div>
					<p class="home-about__txt -unique4 c-txt-xxl2 c-crop">
						だから、ともに重ねてゆく時間は、<br>
						できるだけ、楽しいほうがいいというのが<br>
						アルジュナの考えです。<br>
					</p>
					<div class="home-about__illusts -group2">
						<div class="home-about__illust -unique6 c-anime-floating2 c-delay-12">
							<img src="<?= $this_img_path; ?>about_illust_6.webp" alt="" decoding="async">
						</div>
						<div class="home-about__illust -unique7 js-parallax -large">
							<img src="<?= $this_img_path; ?>about_illust_7.webp" alt="" decoding="async">
						</div>
					</div>
					<p class="home-about__txt -unique5 c-txt-xxl2 c-crop">
						あなたがどこの誰であっても、<br>
						どんな立場であっても、<br>
						デザインに関わることができる。<br>
						そうすることでデザインは、みんなでつくる、<br>
						あなたのものになってゆくのだと信じています。
					</p>
					<div class="home-about__illust -unique9 c-anime-floating2 c-delay-8">
						<img src="<?= $this_img_path; ?>about_illust_9.webp" alt="" decoding="async">
					</div>
					<p class="home-about__button p-button -regular -black">
						<a href="<?= $root; ?>about/">
							<span class="p-button__en">read more</span>
							<i class="c-icon c-arrow"></i>
						</a>
					</p>
				</div>
			</section>
			<!-- /home-about-->
			<!-- home-service-->
			<section class="home-service">
				<div class="home-service__inner c-inner-max">
					<header class="home-service__header">
						<h2 class="c-title js-trigger js-splittext">Service</h2>
						<p class="home-service__txt c-txt-xxl c-crop">
							わたしたちは<br>
							企業のマインドを<br class="u-n-mqDown-sm">
							楽しさに変える<br>
							ブランディングデザインの<br class="u-n-mqDown-sm">
							会社です。
						</p>
						<p class="home-service__button p-button -regular -black u-n-mqDown-lg">
							<a href="<?= $root; ?>works/">
								<span class="p-button__en">View More</span>
								<i class="c-icon c-arrow"></i>
							</a>
						</p>
					</header>
					<ul class="home-service__list">
						<li class="c-crop">ブランディング</li>
						<li class="c-crop">MVV・BDM作成</li>
						<li class="c-crop">CI・VI・デザイン開発（コンセプト/ストーリー）</li>
						<li class="c-crop">パッケージデザイン</li>
						<li class="c-crop">広告制作（ペーパーツール、冊子、WEB、SNS、映像）等</li>
						<li class="c-crop">イラスト</li>
					</ul>
					<p class="home-service__button p-button -regular -black u-n-mqUp-lg">
						<a href="<?= $root; ?>works/">
							<span class="p-button__en">View More</span>
							<i class="c-icon c-arrow"></i>
						</a>
					</p>
				</div>
			</section>
			<!-- /home-service-->
			<!-- home-blog-->
			<section class="home-blog">
				<header class="home-blog__header">
					<div class="c-inner-max">
						<h2 class="c-title js-trigger js-splittext">Blog</h2>
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
					<a href="<?= $root; ?>blog/">
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
