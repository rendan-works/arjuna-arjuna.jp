<?php $this_path = 'blog/'; ?>
<?php require_once( dirname( __FILE__ ) . '/../include/variable.php' ); ?>
<?php require_once( dirname( __FILE__ ) . '/../include/functions.php' ); ?>
<?php
	$directory = array(
		array('HOME','Home',''),
		array('BLOG','Blog','blog/'),
	);
	$robots = true;

	$meta = array(
		'title'       => getTitle($directory),
		'description' => '',
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
					<h1 class="p-hero__en">
						<span>BLOG</span>
					</h1>
					<p class="p-hero__catch c-crop">
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
					<div class="p-category">
						<ul class="p-category__main">
							<li class="p-category__card c-radius-rg-mqUp-lg">
								<div class="p-category__card__another">
									<figure class="p-category__card__figure c-aspect -square c-radius-circle">
										<img class="c-objectfit -cover" src="https://placehold.jp/320x320.png" alt="" decoding="async">
									</figure>
									<div class="p-category__card__profile">
										<p class="p-category__card__name">笹田 健一</p>
										<p class="p-category__card__kana">Kenichi Sasada</p>
										<p class="p-category__card__post">代表取締役</p>
										<p class="p-category__card__degree">クリエイティブマネージャー</p>
									</div>
								</div>
								<div class="p-category__card__accordion js-accordion-click">
									<h1 class="p-category__card__title c-crop">デザイン経営の三点倒立</h1>
									<button class="p-category__card__plus js-accordion__switch" type="button">
										<i class="c-plus"></i>
									</button>
									<div class="p-category__card__outline js-accordion__panel">
										<p class="c-txt-xl c-crop">ブログ内容紹介が入りますテキストダミーです。樹世ブログ内容紹介が入りますテキストダミーです。樹世ブログ内容紹介が入りますテキストダミーです。樹世ブログ内容紹介が入りますテキストダミーです。</p>
									</div>
								</div>
								<p class="p-category__card__button p-button3">
									<a href="<?= $root; ?>">記事一覧へ&nbsp;<span class="c-arrow3">＞</span>
									</a>
								</p>
							</li>
							<li class="p-category__card c-radius-rg-mqUp-lg">
								<div class="p-category__card__another">
									<figure class="p-category__card__figure c-aspect -square c-radius-circle">
										<img class="c-objectfit -cover" src="https://placehold.jp/320x320.png" alt="" decoding="async">
									</figure>
									<div class="p-category__card__profile">
										<p class="p-category__card__name">笹田 健一</p>
										<p class="p-category__card__kana">Kenichi Sasada</p>
										<p class="p-category__card__post">代表取締役</p>
										<p class="p-category__card__degree">クリエイティブマネージャー</p>
									</div>
								</div>
								<div class="p-category__card__accordion js-accordion-click">
									<h1 class="p-category__card__title c-crop">デザイン経営の三点倒立</h1>
									<button class="p-category__card__plus js-accordion__switch" type="button">
										<i class="c-plus"></i>
									</button>
									<div class="p-category__card__outline js-accordion__panel">
										<p class="c-txt-xl c-crop">ブログ内容紹介が入りますテキストダミーです。樹世ブログ内容紹介が入りますテキストダミーです。樹世ブログ内容紹介が入りますテキストダミーです。樹世ブログ内容紹介が入りますテキストダミーです。</p>
									</div>
								</div>
								<p class="p-category__card__button p-button3">
									<a href="<?= $root; ?>">記事一覧へ&nbsp;<span class="c-arrow3">＞</span>
									</a>
								</p>
							</li>
							<li class="p-category__card c-radius-rg-mqUp-lg">
								<div class="p-category__card__another">
									<figure class="p-category__card__figure c-aspect -square c-radius-circle">
										<img class="c-objectfit -cover" src="https://placehold.jp/320x320.png" alt="" decoding="async">
									</figure>
									<div class="p-category__card__profile">
										<p class="p-category__card__name">笹田 健一</p>
										<p class="p-category__card__kana">Kenichi Sasada</p>
										<p class="p-category__card__post">代表取締役</p>
										<p class="p-category__card__degree">クリエイティブマネージャー</p>
									</div>
								</div>
								<div class="p-category__card__accordion js-accordion-click">
									<h1 class="p-category__card__title c-crop">デザイン経営の三点倒立</h1>
									<button class="p-category__card__plus js-accordion__switch" type="button">
										<i class="c-plus"></i>
									</button>
									<div class="p-category__card__outline js-accordion__panel">
										<p class="c-txt-xl c-crop">ブログ内容紹介が入りますテキストダミーです。樹世ブログ内容紹介が入りますテキストダミーです。樹世ブログ内容紹介が入りますテキストダミーです。樹世ブログ内容紹介が入りますテキストダミーです。</p>
									</div>
								</div>
								<p class="p-category__card__button p-button3">
									<a href="<?= $root; ?>">記事一覧へ&nbsp;<span class="c-arrow3">＞</span>
									</a>
								</p>
							</li>
							<li class="p-category__card c-radius-rg-mqUp-lg">
								<div class="p-category__card__another">
									<figure class="p-category__card__figure c-aspect -square c-radius-circle">
										<img class="c-objectfit -cover" src="https://placehold.jp/320x320.png" alt="" decoding="async">
									</figure>
									<div class="p-category__card__profile">
										<p class="p-category__card__name">笹田 健一</p>
										<p class="p-category__card__kana">Kenichi Sasada</p>
										<p class="p-category__card__post">代表取締役</p>
										<p class="p-category__card__degree">クリエイティブマネージャー</p>
									</div>
								</div>
								<div class="p-category__card__accordion js-accordion-click">
									<h1 class="p-category__card__title c-crop">デザイン経営の三点倒立</h1>
									<button class="p-category__card__plus js-accordion__switch" type="button">
										<i class="c-plus"></i>
									</button>
									<div class="p-category__card__outline js-accordion__panel">
										<p class="c-txt-xl c-crop">ブログ内容紹介が入りますテキストダミーです。樹世ブログ内容紹介が入りますテキストダミーです。樹世ブログ内容紹介が入りますテキストダミーです。樹世ブログ内容紹介が入りますテキストダミーです。</p>
									</div>
								</div>
								<p class="p-category__card__button p-button3">
									<a href="<?= $root; ?>">記事一覧へ&nbsp;<span class="c-arrow3">＞</span>
									</a>
								</p>
							</li>
						</ul>
						<ul class="p-category__sub">
							<li>
								<a class="c-radius-max" href="<?= $root; ?>">#お知らせ</a>
							</li>
							<li>
								<a class="c-radius-max" href="<?= $root; ?>">#リクルート</a>
							</li>
							<li>
								<a class="c-radius-max" href="<?= $root; ?>">#実績紹介</a>
							</li>
						</ul>
					</div>
				</div>
			</aside>
			<!-- /blog-category-->
			<!-- blog-archive-->
			<section class="blog-archive" id="target-archive">
				<div class="c-inner-max -contents-lg">
					<header>
						<div class="c-title2">
							<p class="c-title2__main">新着ブログ</p>
							<h2 class="c-title2__ja">#全ての記事</h2>
							<p class="c-title2__en">ALL article</p>
						</div>
					</header>
					<div class="blog-archive__list c-column -col-2-md -gap-c-118 -gap-r-100">
						<!-- p-card-->
						<article class="p-card -type2">
							<a href="<?= $root; ?>"></a>
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
									<p class="p-card__button p-button3">
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
						<article class="p-card -type2">
							<a href="<?= $root; ?>"></a>
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
									<p class="p-card__button p-button3">
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
						<article class="p-card -type2">
							<a href="<?= $root; ?>"></a>
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
									<p class="p-card__button p-button3">
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
						<article class="p-card -type2">
							<a href="<?= $root; ?>"></a>
							<figure class="p-card__figure c-bg2">
								<img class="c-objectfit -cover" src="<?= $img_path; ?>common/noimage.webp" alt="" decoding="async">
							</figure>
							<div class="p-card__contents">
								<div>
									<p class="p-card__time">
										<time>2024.05.01</time>
									</p>
									<h3 class="p-card__title c-crop">
										<span>はじめてのロゴ制作はじめてのロゴ制作はじめてのロゴ制作はじめてのロゴ制作はじめてのロゴ制作はじめてのロゴ制作はじめてのロゴ制作はじめてのロゴ制作はじめてのロゴ制作</span>
									</h3>
								</div>
								<div class="p-card__another">
									<p class="p-card__button p-button3">
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
					<!-- p-pagination-->
					<footer class="p-pagination">
						<ul class="p-pagination__list">
							<li>
								<a href="<?= $root; ?>">1</a>
							</li>
							<li>
								<a href="<?= $root; ?>">2</a>
							</li>
							<li>
								<a href="<?= $root; ?>">3</a>
							</li>
							<li class="p-pagination__ellipsis">…</li>
							<li>
								<a href="<?= $root; ?>">6</a>
							</li>
							<li>
								<a href="<?= $root; ?>">7</a>
							</li>
						</ul>
					</footer>
					<!-- /p-pagination-->
				</div>
			</section>
			<!-- /blog-archive-->
		</main>
		<?php require_once($web_root.$root.'include/layout_contact.php'); ?>
		<?php require_once($web_root.$root.'include/layout_footer.php'); ?>
	</body>
</html>
