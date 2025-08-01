<?php $this_path = 'press/'; ?>
<?php require_once( dirname( __FILE__ ) . '/../include/variable.php' ); ?>
<?php require_once( dirname( __FILE__ ) . '/../include/functions.php' ); ?>
<?php
	$directory = array(
		array('HOME','Home',''),
		array('PRESS','Press','press/'),
	);
	$robots = true;

	$meta = array(
		'title'       => getTitle($directory),
		'description' => '',
		'keywords'    => '',
	);

	$preload = array();
	$style = array(
		$root . 'assets/css/page-press.css',
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
		<main class="l-main press-main">
			<!-- p-hero-->
			<header class="p-hero -bg3">
				<div class="p-hero__inner c-inner-max">
					<h1 class="p-hero__en">
						<span>PRESS</span>
					</h1>
				</div>
			</header>
			<!-- /p-hero-->
			<!-- press-list-->
			<div class="press-list">
				<div class="c-inner-max">
					<div class="c-column -col-3-lg-sm -gap-c-86 -gap-r-100-2">
						<!-- p-card4-->
						<article class="p-card4">
							<figure class="c-aspect -square c-bg2">
								<img class="c-objectfit -cover" src="https://placehold.jp/752x752.png" alt="" decoding="async">
							</figure>
							<p class="p-card4__company">MDN出版社</p>
							<h2 class="p-card4__title c-crop">デザイナーズファイル2023</h2>
							<p class="p-button -regular -black">
								<a href="" target="_blank" rel="noopener noreferrer">
									<span class="p-button__en">Buy this</span>
									<i class="c-icon c-arrow"></i>
								</a>
							</p>
						</article>
						<!-- /p-card4-->
						<!-- p-card4-->
						<article class="p-card4">
							<figure class="c-aspect -square c-bg2">
								<img class="c-objectfit -cover" src="https://placehold.jp/752x752.png" alt="" decoding="async">
							</figure>
							<p class="p-card4__company">MDN出版社</p>
							<h2 class="p-card4__title c-crop">企業・ブランド・プロジェクトの個性を伝えるオリジナルフォントとデザイン事例54</h2>
							<p class="p-button -regular -black">
								<a href="" target="_blank" rel="noopener noreferrer">
									<span class="p-button__en">Buy this</span>
									<i class="c-icon c-arrow"></i>
								</a>
							</p>
						</article>
						<!-- /p-card4-->
						<!-- p-card4-->
						<article class="p-card4">
							<figure class="c-aspect -square c-bg2">
								<img class="c-objectfit -cover" src="https://placehold.jp/752x752.png" alt="" decoding="async">
							</figure>
							<p class="p-card4__company">MDN出版社</p>
							<h2 class="p-card4__title c-crop">デザイナーズファイル2023</h2>
							<p class="p-button -regular -black">
								<a href="" target="_blank" rel="noopener noreferrer">
									<span class="p-button__en">Buy this</span>
									<i class="c-icon c-arrow"></i>
								</a>
							</p>
						</article>
						<!-- /p-card4-->
						<!-- p-card4-->
						<article class="p-card4">
							<figure class="c-aspect -square c-bg2">
								<img class="c-objectfit -cover" src="https://placehold.jp/752x752.png" alt="" decoding="async">
							</figure>
							<p class="p-card4__company">MDN出版社</p>
							<h2 class="p-card4__title c-crop">デザイナーズファイル2023</h2>
							<p class="p-button -regular -black">
								<a href="" target="_blank" rel="noopener noreferrer">
									<span class="p-button__en">Buy this</span>
									<i class="c-icon c-arrow"></i>
								</a>
							</p>
						</article>
						<!-- /p-card4-->
						<!-- p-card4-->
						<article class="p-card4">
							<figure class="c-aspect -square c-bg2">
								<img class="c-objectfit -cover" src="https://placehold.jp/752x752.png" alt="" decoding="async">
							</figure>
							<p class="p-card4__company">MDN出版社</p>
							<h2 class="p-card4__title c-crop">デザイナーズファイル2023</h2>
							<p class="p-button -regular -black">
								<a href="" target="_blank" rel="noopener noreferrer">
									<span class="p-button__en">Buy this</span>
									<i class="c-icon c-arrow"></i>
								</a>
							</p>
						</article>
						<!-- /p-card4-->
						<!-- p-card4-->
						<article class="p-card4">
							<figure class="c-aspect -square c-bg2">
								<img class="c-objectfit -cover" src="https://placehold.jp/752x752.png" alt="" decoding="async">
							</figure>
							<p class="p-card4__company">MDN出版社</p>
							<h2 class="p-card4__title c-crop">デザイナーズファイル2023</h2>
							<p class="p-button -regular -black">
								<a href="" target="_blank" rel="noopener noreferrer">
									<span class="p-button__en">Buy this</span>
									<i class="c-icon c-arrow"></i>
								</a>
							</p>
						</article>
						<!-- /p-card4-->
					</div>
				</div>
			</div>
			<!-- /press-list-->
		</main>
		<?php require_once($web_root.$root.'include/layout_contact.php'); ?>
		<?php require_once($web_root.$root.'include/layout_footer.php'); ?>
	</body>
</html>
