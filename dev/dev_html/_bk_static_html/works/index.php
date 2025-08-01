<?php $this_path = 'works/'; ?>
<?php require_once( dirname( __FILE__ ) . '/../include/variable.php' ); ?>
<?php require_once( dirname( __FILE__ ) . '/../include/functions.php' ); ?>
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
					<h1 class="p-hero__en">
						<span>WORKS</span>
					</h1>
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
											<a href="<?= $root; ?>">すべて</a>
										</li>
										<li>
											<a href="<?= $root; ?>">カテゴリ１</a>
										</li>
										<li>
											<a href="<?= $root; ?>">カテゴリ１</a>
										</li>
										<li>
											<a href="<?= $root; ?>">カテゴリ１</a>
										</li>
										<li>
											<a href="<?= $root; ?>">カテゴリ１</a>
										</li>
										<li>
											<a href="<?= $root; ?>">カテゴリ１</a>
										</li>
										<li>
											<a href="<?= $root; ?>">カテゴリ１</a>
										</li>
										<li>
											<a href="<?= $root; ?>">カテゴリ１</a>
										</li>
										<li>
											<a href="<?= $root; ?>">カテゴリ１</a>
										</li>
										<li>
											<a href="<?= $root; ?>">カテゴリ１</a>
										</li>
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
											<a href="<?= $root; ?>">すべて</a>
										</li>
										<li>
											<a href="<?= $root; ?>">カテゴリ１</a>
										</li>
										<li>
											<a href="<?= $root; ?>">カテゴリ１</a>
										</li>
										<li>
											<a href="<?= $root; ?>">カテゴリ１</a>
										</li>
										<li>
											<a href="<?= $root; ?>">カテゴリ１</a>
										</li>
										<li>
											<a href="<?= $root; ?>">カテゴリ１</a>
										</li>
										<li>
											<a href="<?= $root; ?>">カテゴリ１</a>
										</li>
										<li>
											<a href="<?= $root; ?>">カテゴリ１</a>
										</li>
										<li>
											<a href="<?= $root; ?>">カテゴリ１</a>
										</li>
										<li>
											<a href="<?= $root; ?>">カテゴリ１</a>
										</li>
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
				<div class="c-inner-max">
					<div class="c-column -col-4-md -gap-30">
						<!-- p-card2-->
						<article class="p-card2">
							<a href="<?= $root; ?>">
								<figure class="c-aspect -square c-bg2">
									<img class="c-objectfit -cover" src="https://placehold.jp/604x604.png" alt="" decoding="async">
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
									<img class="c-objectfit -cover" src="https://placehold.jp/604x604.png" alt="" decoding="async">
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
									<img class="c-objectfit -cover" src="https://placehold.jp/604x604.png" alt="" decoding="async">
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
									<img class="c-objectfit -cover" src="https://placehold.jp/604x604.png" alt="" decoding="async">
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
									<img class="c-objectfit -cover" src="https://placehold.jp/604x604.png" alt="" decoding="async">
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
									<img class="c-objectfit -cover" src="https://placehold.jp/604x604.png" alt="" decoding="async">
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
									<img class="c-objectfit -cover" src="https://placehold.jp/604x604.png" alt="" decoding="async">
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
									<img class="c-objectfit -cover" src="https://placehold.jp/604x604.png" alt="" decoding="async">
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
			<!-- /works-list-->
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
		</main>
		<?php require_once($web_root.$root.'include/layout_contact.php'); ?>
		<?php require_once($web_root.$root.'include/layout_footer.php'); ?>
	</body>
</html>
