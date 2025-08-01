<?php $this_path = 'press/'; ?>
<?php require_once( dirname( __FILE__ ) . '/../../../../../../include/variable.php' ); ?>
<?php require_once( dirname( __FILE__ ) . '/../../../../../../include/functions.php' ); ?>
<?php relativeURL(); ?>
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
						<span class="js-splittext">PRESS</span>
					</h1>
				</div>
			</header>
			<!-- /p-hero-->
			<!-- press-list-->
			<div class="press-list">
				<div class="c-inner-max">
					<div class="c-column -col-3-lg-sm -gap-c-86 -gap-r-100-2">
						<?php if ( have_posts() ) : ?>
						<?php while ( have_posts()) : the_post(); ?>
						<?php
							/* ---------- SCF ---------- */
							$press_publisher = SCF::get('press_publisher');
							$press_link      = SCF::get('press_link');


							/* ---------- thumbnail ---------- */
							if( has_post_thumbnail() ){
								$thumbnail_id   = get_post_thumbnail_id();
								$thumbnail_file = wp_get_attachment_image_src($thumbnail_id,'376_376_thumbnail')[0];

								$thumbnail_image = '<img src="'. $placeholder_file .'" data-original="'. $thumbnail_file .'" alt="" class="c-objectfit -cover js-lazyload">';
							} else{
								$thumbnail_image = '<img src="'. $noimage_file .'" alt="" class="c-objectfit -cover">';
							}
						 ?>
						<!-- p-card4-->
						<article class="p-card4 -large">
							<figure class="c-aspect -square c-bg2">
								<?= $thumbnail_image; ?>
							</figure>
							<p class="p-card4__company">
								<?= $press_publisher; ?>
							</p>
							<h2 class="p-card4__title c-crop">
								<?php the_title(); ?>
							</h2>
							<p class="p-button -regular -black">
								<a href="<?= $press_link; ?>" target="_blank" rel="noopener noreferrer">
									<span class="p-button__en">Buy this</span>
									<i class="c-icon c-arrow"></i>
								</a>
							</p>
						</article>
						<!-- /p-card4-->
						<?php endwhile; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<!-- /press-list-->
		</main>
		<?php require_once($web_root.$root.'include/layout_contact.php'); ?>
		<?php require_once($web_root.$root.'include/layout_footer.php'); ?>
	</body>
</html>
