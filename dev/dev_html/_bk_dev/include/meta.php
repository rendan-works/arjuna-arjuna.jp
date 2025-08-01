<?php
	$title       = removeUseless( $meta['title'] );
	$description = removeUseless( $meta['description'] );
	$keywords    = removeUseless( $meta['keywords'] );
 ?>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-M27DRJP');</script>
	<!-- End Google Tag Manager -->
	<meta charset="UTF-8">
	<title><?= $title; ?></title>
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
	<meta name="format-detection" content="telephone=no">
<?php if( $robots == true ): ?>
	<meta name="robots" content="all">
<?php else: ?>
	<meta name="robots" content="noindex,nofollow">
<?php endif; ?>
<?php if( $description ): ?>
	<meta name="description" content="<?= $description; ?>">
<?php endif; ?>
<?php if( $keywords ): ?>
	<meta name="keywords" content="<?= $keywords; ?>">
<?php endif; ?>
	<meta name="copyright" content="© <?= $author; ?>">
	<meta name="author" content="<?= $author; ?>">
	<meta name="theme-color" content="<?= $theme_color; ?>">
	<meta name="msapplication-TileColor" content="<?= $theme_color; ?>">
	<meta name="application-name" content="<?= $site_name; ?>">
	<meta name="apple-mobile-web-app-title" content="<?= $site_name; ?>">
	<meta name="thumbnail" content="<?= $ogp_url; ?>">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="<?= $title;?>">
<?php if( $description ): ?>
	<meta name="twitter:description" content="<?= $description; ?>">
<?php endif; ?>
	<meta name="twitter:image:src" content="<?= $ogp_url; ?>">
<?php if( $web_path == $root ): ?>
	<meta property="og:type" content="website">
<?php else: ?>
	<meta property="og:type" content="article">
<?php endif; ?>
	<meta property="og:site_name" content="<?= $site_name; ?>">
	<meta property="og:title" content="<?= $title;?>">
<?php if( $description ): ?>
	<meta property="og:description" content="<?= $description; ?>">
<?php endif; ?>
	<meta property="og:url" content="<?= $url; ?>">
	<meta property="og:image" content="<?= $ogp_url; ?>">
	<meta property="og:locale" content="ja_JP">
	<link rel="dns-prefetch" href="//use.typekit.net">
	<link rel="dns-prefetch" href="//www.google-analytics.com">
	<link rel="preload" href="<?= $root; ?>assets/css/common.min.css<?= $cash_data; ?>" as="style">
	<link rel="preload" href="<?= $root; ?>assets/js/library.js<?= $cash_data; ?>" as="script">
	<link rel="preload" href="<?= $root; ?>assets/js/module.min.js<?= $cash_data; ?>" as="script">
	<!-- <link rel="preload" href="<?= $root; ?>assets/img/common/loading.svg" as="image"> -->
<?php outputPreload( $preload ); ?>
	<link rel="index" href="<?= $home_url; ?>">
<?php if( !is_404() ): ?>
	<link rel="canonical" href="<?= $url; ?>">
<?php endif; ?>
	<!-- <link rel="contents" href="<?= $home_url; ?>sitemap.xml" title="サイトマップ"> -->
	<link rel="icon" type="image/png" href="<?= $root; ?>assets/img/meta/favicon.png">
	<link rel="icon" type="image/svg+xml" href="<?= $root; ?>assets/img/meta/favicon.svg">
	<link rel="apple-touch-icon" href="<?= $root; ?>assets/img/meta/apple-touch-icon.png">
	<link rel="stylesheet" href="<?= $root; ?>assets/css/common.min.css<?= $cash_data; ?>">
<?php outputStyle( $style ); ?>
	<script> </script>
<?php if( $jquery === true ): ?>
	<script src="<?= $root; ?>assets/js/jquery-library.js<?= $cash_data; ?>" defer></script>
<?php endif; ?>
	<script src="<?= $root; ?>assets/js/library.js<?= $cash_data; ?>" defer></script>
	<script src="<?= $root; ?>assets/js/module.min.js<?= $cash_data; ?>" defer></script>
	<script src="<?= $root; ?>assets/js/common.js<?= $cash_data; ?>" defer></script>
<?php outputScript( $script ); ?>
	<!-- Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-Z6E4NERRZ3"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());
		gtag('config', 'G-Z6E4NERRZ3');
	</script>
<?php if( $test_mode == true ): ?>
	<meta name="robots" content="noindex,nofollow">
<?php endif; ?>
