<?php
	/**
	 * @template: project
	 * @url     : https://github.com/taichaaan/tpl-project
	 * @creation: 2021.08.17
	 * @update  : 2023.10.17
	 * @version : 2.1.2
	 *
	 * @name: name
	 *
	 * Copyright (C) 2023 Taichi Matsutaka
	 */

	/**************************************************************
	 * settings
	**************************************************************/
	$test_mode = true;



	/**************************************************************
	 * wp-load
	**************************************************************/
	require_once( dirname( __FILE__ ) . '/../wp/wp-load.php' );



	/**************************************************************
	 * variable
	 *
	 * root -- トップページのpath
	 * url  -- httpから始まる変数
	 * path -- パスの変数
	 * dir  -- ディレクトリ名の変数（ディレクトリ名単体）
	 * file -- ファイルへのパス変数
	**************************************************************/
	$connection    = (empty($_SERVER["HTTPS"]) ? "http://" : "https://");
	$domain        = $_SERVER["HTTP_HOST"];
	$web_root      = $_SERVER['DOCUMENT_ROOT'];
	$web_path      = preg_replace( '/\?.+$/', '', $_SERVER['REQUEST_URI'] );
	$url           = $connection . $domain . $web_path;
	$url_parameter = $connection . $domain . $_SERVER['REQUEST_URI'];
	$ua            = strtolower($_SERVER['HTTP_USER_AGENT']);

	// $root         = '/';
	$root          = '/arjuna/arjuna/public_html/';
	$img_path      = $root . 'assets/img/';
	$this_img_path = $img_path . $this_path;

	$current_dir  = basename(dirname($_SERVER['SCRIPT_NAME']));
	$current_path = str_replace($root,'', $web_path);

	$home_url       = $connection . $domain . $root;





	/**************************************************************
	 * basic
	**************************************************************/
	$site_name   = 'デザインアルジュナ';
	$base_title  = 'デザインアルジュナ【長崎のグラフィックデザイン事務所・ブランディング・Webデザイン事務所】';
	$author      = 'ARJUNA';
	$theme_color = '#000000';
	$address     = '〒 熊本県熊本市中央区';
	$telephone   = '095-801-0780';
	$ogp_url     = $home_url . 'assets/img/meta/ogp.png';

	$placeholder_file = $img_path . 'common/placeholder.gif';
	$noimage_file     = $img_path . 'common/noimage.webp';

	$googlemap_url  = '';


	/* ---------- post ---------- */
	// $new_period_blog = 7;
	// $new_period_news = 14;


	/* ---------- sns ---------- */
	$link_data = array(
		// 'facebook'   => '',
		// 'instagram'  => '',
		// 'twitter'    => '',
		// 'youtube'    => '',
		// 'pinterest'  => '',
		// 'onlineshop' => '',
	);

	/* ---------- cash_data ---------- */
	$cash_data = '';
	// $cash_data = '?'. date("Ymd-Hi");



	/**************************************************************
	 * Media Query
	 * 使用する可能性のある主要サイズのみ
	**************************************************************/
	$bpSm = 560;
	$bpMd = 767;
	$bpLg = 1023;

	$mqUpSm = '(min-width:'. ($bpSm + 1) .'px)';
	$mqUpMd = '(min-width:'. ($bpMd + 1) .'px)';
	$mqUpLg = '(min-width:'. ($bpLg + 1) .'px)';

	$mqDownSm = '(max-width:'. $bpSm .'px)';
	$mqDownMd = '(max-width:'. $bpMd .'px)';
	$mqDownLg = '(max-width:'. $bpLg .'px)';



	/**************************************************************
	 * time
	**************************************************************/
	// date_default_timezone_set('Asia/Tokyo');
	// $nowTime = date('Y/m/d H:i:s');
	// $week    = ['日','月','火','水','木','金','土',];



	/**************************************************************
	 * form_prefecture
	**************************************************************/
	$form_prefecture = '
		<option value="">選択してください</option>
		<option value="北海道">北海道</option>
		<option value="青森県">青森県</option>
		<option value="岩手県">岩手県</option>
		<option value="宮城県">宮城県</option>
		<option value="秋田県">秋田県</option>
		<option value="山形県">山形県</option>
		<option value="福島県">福島県</option>
		<option value="東京都">東京都</option>
		<option value="神奈川県">神奈川県</option>
		<option value="埼玉県">埼玉県</option>
		<option value="千葉県">千葉県</option>
		<option value="茨城県">茨城県</option>
		<option value="栃木県">栃木県</option>
		<option value="群馬県">群馬県</option>
		<option value="山梨県">山梨県</option>
		<option value="新潟県">新潟県</option>
		<option value="長野県">長野県</option>
		<option value="富山県">富山県</option>
		<option value="石川県">石川県</option>
		<option value="福井県">福井県</option>
		<option value="愛知県">愛知県</option>
		<option value="岐阜県">岐阜県</option>
		<option value="静岡県">静岡県</option>
		<option value="三重県">三重県</option>
		<option value="大阪府">大阪府</option>
		<option value="兵庫県">兵庫県</option>
		<option value="京都府">京都府</option>
		<option value="滋賀県">滋賀県</option>
		<option value="奈良県">奈良県</option>
		<option value="和歌山県">和歌山県</option>
		<option value="鳥取県">鳥取県</option>
		<option value="島根県">島根県</option>
		<option value="岡山県">岡山県</option>
		<option value="広島県">広島県</option>
		<option value="山口県">山口県</option>
		<option value="徳島県">徳島県</option>
		<option value="香川県">香川県</option>
		<option value="愛媛県">愛媛県</option>
		<option value="高知県">高知県</option>
		<option value="福岡県">福岡県</option>
		<option value="佐賀県">佐賀県</option>
		<option value="長崎県">長崎県</option>
		<option value="熊本県">熊本県</option>
		<option value="大分県">大分県</option>
		<option value="宮崎県">宮崎県</option>
		<option value="鹿児島県">鹿児島県</option>
		<option value="沖縄県">沖縄県</option>
	';




	/**************************************************************
	 * OGP
	**************************************************************/
	if( is_single() || is_singular() ){
		$str = $post->post_content;
		$searchPattern = '/<img.*?src=(["\'])(.+?)\1.*?>/i';
		if( has_post_thumbnail() ){
			$image_id = get_post_thumbnail_id();
			$image = wp_get_attachment_image_src( $image_id, 'ogp');
			$ogp_url = $image[0];
		}else if( preg_match( $searchPattern, $str, $imgurl ) && !is_archive() ) {
			$first_image = '/<img.*?src=(["\'])(.+?)\1.*?>/i';
			preg_match($first_image, $post->post_content, $image);
			$ogp_url = $image[2];
		}
	}
	wp_reset_query();





	/**************************************************************
	 * UserAgent
	**************************************************************/
	// if (strstr($ua , 'edge')) {
	// 	// Edge;
	// } elseif (strstr($ua , 'trident') || strstr($ua , 'msie')) {
	// 	// Internet Explorer;
	// } elseif (strstr($ua , 'chrome')) {
	// 	// Google Chrome;
	// } elseif (strstr($ua , 'firefox')) {
	// 	// Firefox;
	// } elseif (strstr($ua , 'safari')) {
	// 	// Safari;
	// } elseif (strstr($ua , 'opera')) {
	// 	// Opera;
	// } else {
	// 	// Other;
	// }




















