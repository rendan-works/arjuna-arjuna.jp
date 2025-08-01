<?php $this_path = 'blog/single/'; ?>
<?php require_once( dirname( __FILE__ ) . '/../include/variable.php' ); ?>
<?php require_once( dirname( __FILE__ ) . '/../include/functions.php' ); ?>
<?php
	$directory = array(
		array('HOME','Home',''),
		array('BLOG','Blog','blog/'),
		array('記事のタイトルが入ります','記事のタイトルが入ります','blog/id'),
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
			<div class="p-article">
				<div class="p-article__inner c-inner-max">
					<header class="p-article__header u-n-mqUp-lg">
						<h1 class="p-article__title c-crop">はじめてのロゴ制作 第1弾<br>ダミーテキストダミーテキストダミー</h1>
					</header>
					<!-- p-article__flex-->
					<div class="p-article__flex">
						<!-- p-article__another-->
						<aside class="p-article__another">
							<div class="p-article__another__flex">
								<figure class="p-article__another__figure c-aspect -square c-radius-circle">
									<img class="c-objectfit -cover" src="https://placehold.jp/320x320.png" alt="" decoding="async">
								</figure>
								<div class="p-article__another__profile">
									<p class="p-article__another__name">笹田 健一</p>
									<p class="p-article__another__kana">Kenichi Sasada</p>
									<p class="p-article__another__post">代表取締役</p>
									<p class="p-article__another__degree">クリエイティブマネージャー</p>
								</div>
							</div>
							<p class="p-article__another__title c-crop">デザイン経営の三点倒立</p>
							<p class="p-article__another__txt c-txt-xl c-crop">笹田ブログ内容紹介が入りますテキストダミーです。笹田ブログ内容紹介が入りますテキストダミーです。笹田ブログ内容紹介が入りますテキストダミーです。笹田ブログ内容紹介が入りますテキストダミーです。</p>
							<p class="p-article__another__button p-button3">
								<a href="<?= $root; ?>">記事一覧へ&nbsp;<span class="c-arrow3">＞</span>
								</a>
							</p>
						</aside>
						<!-- /p-article__another-->
						<!-- p-article__main-->
						<article class="p-article__main">
							<header class="p-article__header u-n-mqDown-lg">
								<p class="p-article__time">
									<time>2024.05.01</time>
								</p>
								<h1 class="p-article__title c-crop">はじめてのロゴ制作 第1弾<br>ダミーテキストダミーテキストダミー</h1>
							</header>
							<figure class="p-article__figure">
								<img src="https://placehold.jp/1680x940.png" alt="" decoding="async">
							</figure>
							<div class="p-article__contents s-editor">
								<h2>制作費に必要な項目を確認</h2>
								<p>
									アルジュナでロゴをデザインして欲しいとメールや電話で問い合わせをいただく事があります！そう今この記事を見ている方もそうなのかもしれませんね。それではメールでも電話でも問い合わせをいただいた方とのやりとりを紹介いたします。<br>
									メールの場合は先ず私は、ロゴだけでなくどんな案件でも問い合わせに対して「はじめての名刺制作 第1弾」に記載したようなメールを返信します。<br>
									メールに返信が来た方と打ち合わせをさせていただきます。<br>
									電話でお問い合わせを頂く方は費用を知りたい方が多いので、はじめに伺う事は下記の内容です。<br>
									・つくるロゴはシンボルマークとロゴタイプのそれぞれが必要か？<br>
									※シンボルマークとロゴタイプがわからない方もいらっしゃると思いますので参考まで
								</p>
								<h2>ロゴをデザインする為に必要な項目を確認</h2>
								<p>この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。</p>
								<p>
									<a href="<?= $root; ?>">テキストリンク</a>
								</p>
								<ul>
									<li>この文章はダミーです。</li>
									<li>この文章はダミーです。</li>
									<li>この文章はダミーです。</li>
								</ul>
								<ol>
									<li>この文章はダミーです。</li>
									<li>この文章はダミーです。</li>
									<li>この文章はダミーです。</li>
								</ol>
								<hr>
								<blockquote>
									<p>この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。この文章はダミーです。文字の大きさ、量、字間、行間等を確認するために入れています。</p>
								</blockquote>
							</div>
						</article>
						<!-- /p-article__main-->
					</div>
					<!-- /p-article__flex-->
					<!-- p-article__footer-->
					<footer class="p-article__footer">
						<p class="p-article__footer__button p-button3">
							<a href="<?= $root; ?>">記事一覧へ&nbsp;<span class="c-arrow3">＞</span>
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
			<!-- /single-category-->
		</main>
		<?php require_once($web_root.$root.'include/layout_contact.php'); ?>
		<?php require_once($web_root.$root.'include/layout_footer.php'); ?>
	</body>
</html>
