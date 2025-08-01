<?php $this_path = 'works/'; ?>
<?php require_once( dirname( __FILE__ ) . '/../include/variable.php' ); ?>
<?php require_once( dirname( __FILE__ ) . '/../include/functions.php' ); ?>
<?php
	$directory = array(
		array('HOME','Home',''),
		array('WORKS','Works','works/'),
		array('ブランド名 カテゴリー','ブランド名 カテゴリー','Works/id'),
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
			<article class="p-article2">
				<div class="c-inner-max">
					<!-- p-article2__header-->
					<header class="p-article2__header">
						<h1 class="p-article2__title">ZENPI パッケージデザイン</h1>
						<div class="p-article2__outline">
							<dl>
								<dt>BRAND</dt>
								<dd>
									<span class="-large">ZENPI</span>
								</dd>
							</dl>
							<dl>
								<dt>CLIENT</dt>
								<dd class="-en">KAIKA.Co., Ltd.</dd>
							</dl>
							<dl>
								<dt>GENRE</dt>
								<dd>エステサロン・美容</dd>
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
						<ul class="swiper-wrapper">
							<li class="p-article2__figure__slide swiper-slide">
								<img class="c-objectfit -cover" src="https://placehold.jp/3000x2250.png" alt="" decoding="async">
							</li>
							<li class="p-article2__figure__slide swiper-slide">
								<img class="c-objectfit -cover" src="https://placehold.jp/3000x2250.png" alt="" decoding="async">
							</li>
							<li class="p-article2__figure__slide swiper-slide">
								<img class="c-objectfit -cover" src="https://placehold.jp/3000x2250.png" alt="" decoding="async">
							</li>
						</ul>
						<ul class="p-article2__figure__ui">
							<li class="p-article2__figure__ui__prev">
								<button class="u-reverse" type="button">
									<i class="c-icon c-arrow4"></i>
								</button>
							</li>
							<li class="p-article2__figure__ui__next">
								<button type="button">
									<i class="c-icon c-arrow4"></i>
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
									<p class="p-article2__client__title__en">KAIKA.Co., Ltd.</p>
									<h2 class="p-article2__client__title__ja">株式会社カイカ</h2>
								</div>
							</header>
							<div class="p-article2__client__title__contents">
								<h3 class="p-article2__client__title2">クライアント概要</h3>
								<p class="p-article2__client__txt c-txt-md c-crop">
									時代が転換期の今、「目に見えない物」こそ未来に価値を生み出す、私はそう考えています。目に見えない物…それは、「健康」「愛」「心」など、数値では測ることのないかけがえのないものたちです。<br>
									健康・愛・心が豊かになることに重きが置かれた、新しい時代を築くためにカイカができることは何か？私たちは常に新鮮なアイディアを出し、チャレンジを続けていきます。<br>
									カイカは「人・物が開花するお手伝い」を企業理念に掲げています。健康美を専門としたサロン・企業さまと共に私自身も成長していきます。
								</p>
							</div>
						</div>
						<div class="p-article2__client__table c-table2 -size1">
							<dl>
								<dt>
									<span class="c-table2__en">CLIENT</span>
								</dt>
								<dd>
									<span class="c-table2__txt">株式会社カイカ</span>
								</dd>
							</dl>
							<dl>
								<dt>
									<span class="c-table2__en">INDUSTRY</span>
								</dt>
								<dd>
									<span class="c-table2__txt">美容・化粧品メーカー</span>
								</dd>
							</dl>
							<dl>
								<dt>
									<span class="c-table2__en">CATEGORY</span>
								</dt>
								<dd>
									<ul class="p-article2__client__table__list">
										<li>
											<a href="<?= $root; ?>">ブランディング</a>
										</li>
										<li>
											<a href="<?= $root; ?>">ロゴ（CI/VI）/ネーミング</a>
										</li>
										<li>
											<a href="<?= $root; ?>">パンフレット・会社案内</a>
										</li>
										<li>
											<a href="<?= $root; ?>">フライヤー・ポスター・DM</a>
										</li>
										<li>
											<a href="<?= $root; ?>">コーポレートサイト</a>
										</li>
										<li>
											<a href="<?= $root; ?>">動画・ムービー</a>
										</li>
										<li>
											<a href="<?= $root; ?>">パッケージデザイン</a>
										</li>
									</ul>
								</dd>
							</dl>
							<dl>
								<dt>
									<span class="c-table2__en">TAG</span>
								</dt>
								<dd>
									<ul class="p-article2__client__table__list3">
										<li>
											<a href="<?= $root; ?>">プロデュース</a>
										</li>
										<li>
											<a href="<?= $root; ?>">企画・ディレクション</a>
										</li>
										<li>
											<a href="<?= $root; ?>">写真撮影</a>
										</li>
										<li>
											<a href="<?= $root; ?>">動画撮影</a>
										</li>
										<li>
											<a href="<?= $root; ?>">ブランディング</a>
										</li>
										<li>
											<a href="<?= $root; ?>">CI・VI開発</a>
										</li>
										<li>
											<a href="<?= $root; ?>">ロゴ</a>
										</li>
										<li>
											<a href="<?= $root; ?>">名刺・ショップカード・封筒</a>
										</li>
										<li>
											<a href="<?= $root; ?>">フライヤー・チラシ・DM</a>
										</li>
										<li>
											<a href="<?= $root; ?>">看板・サイン</a>
										</li>
										<li>
											<a href="<?= $root; ?>">ウェブサイト制作</a>
										</li>
										<li>
											<a href="<?= $root; ?>">HTMLコーディング</a>
										</li>
										<li>
											<a href="<?= $root; ?>">レスポンシブ</a>
										</li>
										<li>
											<a href="<?= $root; ?>">CMS設計・構築</a>
										</li>
										<li>
											<a href="<?= $root; ?>">九州</a>
										</li>
										<li>
											<a href="<?= $root; ?>">長崎</a>
										</li>
									</ul>
								</dd>
							</dl>
							<dl>
								<dt>
									<span class="c-table2__en">WEBSITE</span>
								</dt>
								<dd>
									<a class="c-table2__txt c-anchor-lineIn" href="<?= $root; ?>">http://kaika82.com</a>
								</dd>
							</dl>
						</div>
					</section>
					<!-- /p-article2__client-->
					<!-- p-article2__contents-->
					<section class="p-article2__contents">
						<div class="c-flex -size1">
							<div class="c-flex__side">
								<header>
									<div class="c-title3">
										<h2 class="c-title3__en">
											<span class="c-crop">
												Package<br>
												Design</span>
										</h2>
										<p class="c-title3__ja">パッケージデザイン</p>
									</div>
								</header>
								<p class="p-article2__contents__txt c-txt-lg c-crop">ロゴデザインについての文章テキストダミーです。ロゴデザインについての文章テキストダミーです。ロゴデザインについての文章テキストダミーです。ロゴデザインについての文章テキストダミーです。ロゴデザインについての文章テキストダミーです。ロゴデザインについての文章テキストダミーです。ロゴデザインについての文章テキストダミーです。ロゴデザインについての文章テキストダミーです。</p>
							</div>
							<div class="c-flex__main">
								<figure class="p-article2__contents__figure">
									<img src="https://placehold.jp/1880x1220.png" alt="" decoding="async">
								</figure>
								<figure class="p-article2__contents__figure">
									<img src="https://placehold.jp/1880x1220.png" alt="" decoding="async">
								</figure>
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
							<div class="c-flex__main">
								<div class="c-table2 -size2">
									<dl>
										<dt>
											<span class="c-table2__ja">クライアント</span>
										</dt>
										<dd>
											<span class="c-table2__txt">株式会社カイカ</span>
										</dd>
									</dl>
									<dl>
										<dt>
											<span class="c-table2__ja">アートディレクション</span>
										</dt>
										<dd>
											<span class="c-table2__txt">クレジットが入ります</span>
										</dd>
									</dl>
									<dl>
										<dt>
											<span class="c-table2__ja">Graphicデザイン</span>
										</dt>
										<dd>
											<span class="c-table2__txt">クレジットが入ります</span>
										</dd>
									</dl>
									<dl>
										<dt>
											<span class="c-table2__ja">サイト構築・CMS構築</span>
										</dt>
										<dd>
											<span class="c-table2__txt">クレジットが入ります</span>
										</dd>
									</dl>
									<dl>
										<dt>
											<span class="c-table2__ja">スチール撮影</span>
										</dt>
										<dd>
											<span class="c-table2__txt">クレジットが入ります</span>
										</dd>
									</dl>
									<dl>
										<dt>
											<span class="c-table2__ja">コピー</span>
										</dt>
										<dd>
											<span class="c-table2__txt">クレジットが入ります</span>
										</dd>
									</dl>
									<dl>
										<dt>
											<span class="c-table2__ja">イラスト</span>
										</dt>
										<dd>
											<span class="c-table2__txt">クレジットが入ります</span>
										</dd>
									</dl>
								</div>
							</div>
						</div>
					</section>
					<!-- /p-article2__team-->
					<!-- p-article2__other-->
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
									<!-- p-card3-->
									<article class="p-card3">
										<a href="<?= $root; ?>">
											<figure class="c-aspect -square c-bg2">
												<img class="c-objectfit -cover" src="https://placehold.jp/540x540.png" alt="" decoding="async">
											</figure>
											<h3 class="p-card3__title">
												<span class="c-crop"> KAIKA CI</span>
											</h3>
										</a>
									</article>
									<!-- /p-card3-->
									<!-- p-card3-->
									<article class="p-card3">
										<a href="<?= $root; ?>">
											<figure class="c-aspect -square c-bg2">
												<img class="c-objectfit -cover" src="https://placehold.jp/540x540.png" alt="" decoding="async">
											</figure>
											<h3 class="p-card3__title">
												<span class="c-crop"> KAIKA CI</span>
											</h3>
										</a>
									</article>
									<!-- /p-card3-->
									<!-- p-card3-->
									<article class="p-card3">
										<a href="<?= $root; ?>">
											<figure class="c-aspect -square c-bg2">
												<img class="c-objectfit -cover" src="https://placehold.jp/540x540.png" alt="" decoding="async">
											</figure>
											<h3 class="p-card3__title">
												<span class="c-crop"> KAIKA CI</span>
											</h3>
										</a>
									</article>
									<!-- /p-card3-->
									<!-- p-card3-->
									<article class="p-card3">
										<a href="<?= $root; ?>">
											<figure class="c-aspect -square c-bg2">
												<img class="c-objectfit -cover" src="https://placehold.jp/540x540.png" alt="" decoding="async">
											</figure>
											<h3 class="p-card3__title">
												<span class="c-crop"> KAIKA CI</span>
											</h3>
										</a>
									</article>
									<!-- /p-card3-->
									<!-- p-card3-->
									<article class="p-card3">
										<a href="<?= $root; ?>">
											<figure class="c-aspect -square c-bg2">
												<img class="c-objectfit -cover" src="https://placehold.jp/540x540.png" alt="" decoding="async">
											</figure>
											<h3 class="p-card3__title">
												<span class="c-crop"> KAIKA CI</span>
											</h3>
										</a>
									</article>
									<!-- /p-card3-->
									<!-- p-card3-->
									<article class="p-card3">
										<a href="<?= $root; ?>">
											<figure class="c-aspect -square c-bg2">
												<img class="c-objectfit -cover" src="https://placehold.jp/540x540.png" alt="" decoding="async">
											</figure>
											<h3 class="p-card3__title">
												<span class="c-crop"> KAIKA CI</span>
											</h3>
										</a>
									</article>
									<!-- /p-card3-->
								</div>
							</div>
						</div>
					</aside>
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
