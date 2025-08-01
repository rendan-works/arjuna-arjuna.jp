<?php
/* ------------------------------------------------------------------------------
 ontent widthの指定
------------------------------------------------------------------------------ */
if ( ! isset( $content_width ) ) $content_width = 1000;




/* ------------------------------------------------------------------------------
 不要なページを無効化
------------------------------------------------------------------------------ */
function custom_handle_404() {
	if (
		// 不要なタクソノミー、シングルページを無効化
		// シングルページは、確認もあるため single-[〇〇].php で制御
		// is_post_type_archive('pickup') ||

		is_date() ||
		is_tax('works_client') ||
		is_singular('press') ||

		// 検索ページ、作成者ページ、添付ファイルページを無効化
		is_search() ||
		is_author() ||
		is_attachment()
	) {
		global $wp_query;
		$wp_query->set_404();
		status_header( 404 );
		nocache_headers();
	}
}
add_action( 'template_redirect', 'custom_handle_404' );






/* ------------------------------------------------------------------------------
 デフォルト投稿
------------------------------------------------------------------------------ */
/* ----------------------------------------
 左メニュー「投稿」名称を変更
---------------------------------------- */
function edit_admin_menus(){
	global $menu;
	global $submenu;

	$menu[5][0] = 'BLOG';
	$submenu['edit.php'][5][0] = 'BLOG';
}
add_action('admin_menu','edit_admin_menus');


/* ----------------------------------------
 投稿関連の非表示の設定
---------------------------------------- */
function remove_post_supports() {
	// remove_post_type_support( 'post', 'author' ); // 作成者
	// remove_post_type_support( 'post', 'thumbnail' ); // アイキャッチ
	remove_post_type_support( 'post', 'excerpt' ); // 抜粋
	remove_post_type_support( 'post', 'trackbacks' ); // トラックバック
	remove_post_type_support( 'post', 'custom-fields' ); // カスタムフィールド
	remove_post_type_support( 'post', 'comments' ); // コメント
	remove_post_type_support( 'post', 'revisions' ); // リビジョン
	remove_post_type_support( 'post', 'page-attributes' ); // ページ属性
	remove_post_type_support( 'post', 'post-formats' ); // 投稿フォーマット

	// unregister_taxonomy_for_object_type( 'category', 'post' ); // カテゴリ
	unregister_taxonomy_for_object_type( 'post_tag', 'post' ); // タグ
}
add_action( 'init', 'remove_post_supports' );


/* ----------------------------------------
 URLから/category/を消す
---------------------------------------- */
// function remcat_function($link) {
// 	return str_replace("/category/", "/", $link);
// }
// add_filter('user_trailingslashit', 'remcat_function');

// function remcat_flush_rules() {
// 	global $wp_rewrite;
// 	$wp_rewrite->flush_rules();
// }
// add_action('init', 'remcat_flush_rules');

// function remcat_rewrite($wp_rewrite) {
// 	$new_rules = array('(.+)/page/(.+)/?' => 'index.php?category_name='.$wp_rewrite->preg_index(1).'&paged='.$wp_rewrite->preg_index(2));
// 	$wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
// }
// add_filter('generate_rewrite_rules', 'remcat_rewrite');








/* ------------------------------------------------------------------------------
 カスタム投稿タイプ、SCFオプションページ
------------------------------------------------------------------------------ */
/* ------------------------------------------------------------
 WORKS（works）
------------------------------------------------------------ */
add_action('init','register_custom_post_works');
function register_custom_post_works(){
	register_post_type(
		'works',
		array(
			'label'           => 'WORKS',
			'public'          => true,
			'capability_type' => 'post',
			'menu_position'   => 5,
			'has_archive'     => true,
			'hierarchical'    => true,
			'supports'        => array(
				'title',
				'thumbnail',
				'page-attributes',
			),
			'rewrite' => array('with_front' => false),
			'labels' => array(
				'name'               => 'WORKS',
				'singular_name'      => 'WORKS',
				'add_new'            => '新規投稿を追加',
				'add_new_item'       => '新規投稿を追加',
				'edit_item'          => '投稿を編集',
				'new_item'           => '新規投稿',
				'view_item'          => '投稿を表示',
				'search_items'       => '投稿を検索',
				'not_found'          => '投稿が見つかりませんでした',
				'not_found_in_trash' => 'ゴミ箱に投稿が見つかりませんでした',
			),
		)
	);
	register_taxonomy(
		'works_client',
		'works',
		array(
			'hierarchical' => true,
			'label'        => 'クライアント',
			'query_var'    => true,
			'rewrite' => array(
				'with_front' => false,
				'slug'       => 'client'
			)
		)
	);
	register_taxonomy(
		'works_industry',
		'works',
		array(
			'hierarchical' => true,
			'label'        => '業種',
			'query_var'    => true,
			'rewrite' => array(
				'with_front' => false,
				'slug'       => 'industry'
			)
		)
	);
	register_taxonomy(
		'works_category',
		'works',
		array(
			'hierarchical' => true,
			'label'        => '製作物の種類',
			'query_var'    => true,
			'rewrite' => array(
				'with_front' => false,
				'slug'       => 'category'
			)
		)
	);
	register_taxonomy(
		'works_tag',
		'works',
		array(
			'hierarchical' => true,
			'label'        => 'タグ',
			'query_var'    => true,
			'rewrite' => array(
				'with_front' => false,
				'slug'       => 'tag'
			)
		)
	);
}




/* ------------------------------------------------------------
 PRESS（press）
------------------------------------------------------------ */
add_action('init','register_custom_post_press');
function register_custom_post_press(){
	register_post_type(
		'press',
		array(
			'label'           => 'PRESS',
			'public'          => true,
			'capability_type' => 'post',
			'menu_position'   => 5,
			'has_archive'     => true,
			'supports'        => array(
				'title',
				'thumbnail',
			),
			'rewrite' => array('with_front' => false)
		)
	);
}










/* ------------------------------------------------------------------------------
 フロント
------------------------------------------------------------------------------ */
/* ------------------------------------------------------------
 相対パス
------------------------------------------------------------ */
class relative_URI {
	function relative_URL() {
		add_action('relativeURL_start', array(&$this, 'relativeURL_start'), 1);
		add_action('relativeURL_end', array(&$this, 'relativeURL_end'), 99999);
	}
	function replace_relative_URL($content) {
		$home_url = trailingslashit(get_home_url('/'));
		$parsed   = parse_url($home_url);
		$replace  = $parsed['scheme'] . '://' . $parsed['host'];
		$pattern  = array(
			'# (href|src|action)="'.preg_quote($replace).'([^"]*)"#ism',
			"# (href|src|action)='".preg_quote($replace)."([^']*)'#ism",
		);
		$content  = preg_replace($pattern, ' $1="$2"', $content);
		$pattern  = '#<(meta [^>]*name=[\'"]twitter:image:src[^\'"]*[\'"] [^>]*content=|meta [^>]*property=[\'"]og:[^\'"]*[\'"] [^>]*content=|link [^>]*rel=[\'"]canonical[\'"] [^>]*href=|link [^>]*rel=[\'"]contents[\'"] [^>]*href=|link [^>]*rel=[\'"]index[\'"] [^>]*href=|link [^>]*rel=[\'"]shortlink[\'"] [^>]*href=|data-href=|data-url=)[\'"](/[^\'"]*)[\'"]([^>]*)>#uism';
		$content = preg_replace($pattern, '<$1"'.$replace.'$2"$3>', $content);
		return $content;
	}
	function relativeURL_start(){
		ob_start(array(&$this, 'replace_relative_URL'));
	}
	function relativeURL_end(){
		ob_end_flush();
	}
}

$class_relative_URI = new relative_URI();

function relativeURL(){
	global $class_relative_URI;
	$class_relative_URI->relativeURL_start();
}




/* ------------------------------------------------------------
 表示件数制御
------------------------------------------------------------ */
add_action('pre_get_posts','my_pre_get_posts');
function my_pre_get_posts( $query ) {
	if(is_admin() || ! $query -> is_main_query()) return;

	if(
		$query -> is_post_type_archive('works') ||
		$query -> is_tax('works_industry') ||
		$query -> is_tax('works_category') ||
		$query -> is_tax('works_tag')
	){
		$query -> set('posts_per_page',24);
	} elseif(
		$query -> is_post_type_archive('press')
	){
		$query -> set('posts_per_page',-1);
	} elseif(
		$query -> is_home() ||
		$query -> is_category() ||
		$query -> is_date()
	 ){
		$query -> set('posts_per_page',6);
	}
}




/* ------------------------------------------------------------
 アイキャッチ画像　
------------------------------------------------------------ */
add_theme_support('post-thumbnails');
add_image_size('160_160_thumbnail',320,320,true); // BLOGカテゴリーのサムネイル
add_image_size('376_376_thumbnail',752,752,true); // PRESS一覧のサムネイル + WORKS一覧のサムネイル + トップページのWORKSサムネイル
add_image_size('590_333_thumbnail',1180,666,true); // BLOG一覧のサムネイル

add_image_size('840_auto_figure',1680,1680,false); // BLOG詳細のメイン画像
add_image_size('940_auto_figure',1880,2560,false); // WORKS詳細の説明画像
add_image_size('2560_1920_figure',2560,1920,true); // WORKS詳細のメイン画像

add_image_size('ogp',1200,630,true);




/* ------------------------------------------------------------
 srcset無効
------------------------------------------------------------ */
add_filter( 'wp_calculate_image_srcset_meta', '__return_null' );




/* ------------------------------------------------------------
 change_document_title_parts
------------------------------------------------------------ */
function change_document_title_parts( $title_parts ){
	$title_parts['tagline'] = '';
	$title_parts['site'] = '';

	if( is_date() ){
		$year  = get_query_var('year');
		$month = get_query_var('monthnum');
		$day   = get_query_var('day');

		$title = ($year ? $year . '年' : '') .
				 ($month ? $month . '月' : '') .
				 ($day ? $day . '日' : '');

		$title = preg_replace("/( |　)/", "", $title );

		$title_parts['title'] = $title;
	}

	return $title_parts;
}
add_filter( 'document_title_parts', 'change_document_title_parts' );



/* ------------------------------------------------------------
 content
------------------------------------------------------------ */
/* ---------------------------------------------------
 lazyload
-------------------------------------------------- */
function contentLazyload( $content ){
	$placeholder = 'https://~/placeholder.gif';
	$content = preg_replace('/(<img[^>]*)\s+src=/', '$1 src="'. $placeholder .'" data-original=', $content);

	$content = preg_replace_callback('/<img([^>]*)>/', function( $matches ) {
		$match = rtrim ( $matches[1], '/' );

		//classを持っているかどうか
		if ( strpos( $match, 'class=' ) !== false ) {
			//クラスを持っていなければ追加
			if ( strpos( $match, 'lazyload' ) === false ) {
				$match = preg_replace('/class="([^"]*)"/', 'class="$1 js-lazyload"', $match);
			}
		} else {
			//classがなければ、classごと追加
			$match .= 'class="js-lazyload" ';
		}

		return '<img'. $match .'>';
	}, $content);

	return $content;
}

/* ----- the_content でも発動 ----- */
add_filter('the_content', function( $content ) {
	return contentLazyload( $content );
});


/* ---------------------------------------------------
 本文のimgタグだけfigureタグで括る
-------------------------------------------------- */
function fb_unautop_4_img( $content ){
	$content = preg_replace(
		'/<p>\\s*?(<a rel=\"attachment.*?><img.*?><\\/a>|<img.*?>)?\\s*<\\/p>/s',
		'<figure>$1</figure>',
		$content
	);
	return $content;
}
add_filter( 'the_content', 'fb_unautop_4_img', 99 );


/* ---------------------------------------------------
 本文のiframeタグを <div class="youtube"></div> で括るための置換処理
-------------------------------------------------- */
function ag_wrap_iframe($the_content){
	if ( is_singular() ) {
		$the_content = preg_replace('/<iframe/i', '<div class="c-youtube2"><iframe', $the_content);
		$the_content = preg_replace('/<\/iframe>/i', '</iframe></div>', $the_content);
	}
	return $the_content;
}
add_filter('the_content','ag_wrap_iframe');



/* ---------------------------------------------------
 アーカイブタイトル
-------------------------------------------------- */
add_filter( 'get_the_archive_title', function ( $title ) {
	if( is_category() || is_archive() ) {
		$title = single_cat_title( '', false );
	}
	elseif( is_tag() ) {
		$title = single_tag_title( '', false );
	} elseif( is_month() ){
		$title = get_query_var('year') . "年".get_query_var('monthnum')."月";
		$title = single_month_title( '', false );
	}
	return $title;
});

function jp_date_wp_title( $title, $sep, $seplocation ) {
	if ( is_date() ) {
		$m = get_query_var('m');
		if ( $m ) {
			$year = substr($m, 0, 4);
			$month = intval(substr($m, 4, 2));
			$day = intval(substr($m, 6, 2));
		} else {
			$year = get_query_var('year');
			$month = get_query_var('monthnum');
			$day = get_query_var('day');
		}

		$title = ($seplocation != 'right' ? " $sep " : '') .
				($year ? $year . '年' : '') .
				($month ? $month . '月' : '') .
				($day ? $day . '日' : '') .
				($seplocation == 'right' ? " $sep " : '');
	}
	return $title;
}
add_filter( 'wp_title', 'jp_date_wp_title', 10, 3 );




/* ------------------------------------------------------------
 pagination
------------------------------------------------------------ */
if( !function_exists('pagination') ){
	function pagination($pages = '', $anchor_target = ''){

		/* ----------------------------------------
		 ページ情報の取得
		---------------------------------------- */
		global $paged; //現在のページの値

		if( empty($paged) ){  //デフォルトのページ
			$paged = 1;
		}
		if( $pages == '' ){
			global $wp_query;
			$pages = $wp_query->max_num_pages;  //全ページ数を取得
			if( !$pages ){ //全ページ数が空の場合は、1にする
				$pages = 1;
			}
		}

		$booby = $pages;
		$booby--;

		if( $pages > 5 ){
			if( $paged == 1 || $paged == $pages ){
				$range = 3;
			} else if( $paged == 2 || $paged == $booby ){
				$range = 2;
			} else{
				$range = 1;
			}
		} else{
			$range = 4;
		}

		$showitems = ($range * 1)+1;



		/* ----------------------------------------
		 出力
		---------------------------------------- */
		if( 1 != $pages ){  //全ページ数が1以外の場合は以下を出力する

			/* ---------- p-pagination ---------- */
			echo '<footer class="p-pagination">';
				echo '<ul class="p-pagination__list">';

					if( $pages > 5 && $paged > 2 ){
						echo '<li><a href="'. get_pagenum_link(1) . $anchor_target .'">1</a></li>';
					}
					if( $pages > 5 && $paged > 3 ){
						echo '<li class="p-pagination__ellipsis">…</li>';
					}
					for ($i=1; $i <= $pages; $i++){
						if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
							echo ($paged == $i)? '<li><a href="javascript:void(0);" class="is-current">'.$i.'</a></li>':
							'<li><a href="'. get_pagenum_link($i) . $anchor_target .'">'. $i .'</a></li>';
						}
					}
					if( $pages > 5 && $paged < $booby-1 ){
						echo '<li class="p-pagination__ellipsis">…</li>';
					}
					if( $pages > 5 && $paged < $booby ){
						echo '<li><a href="'. get_pagenum_link($pages) . $anchor_target .'">'. $pages .'</a></li>';
					}

				echo '</ul>';
			echo '</footer>';
		}

	}
}








/* ------------------------------------------------------------------------------
 管理画面カスタマイズ
------------------------------------------------------------------------------ */
/* ------------------------------------------------------------
 管理画面とログイン画面にタグを追加
------------------------------------------------------------ */
function login_tag() {
	echo '<link rel="stylesheet" type="text/css" href="'.get_home_url().'/assets/css/wp-admin.css">';
}
add_action( 'login_enqueue_scripts', 'login_tag' );

function my_admin_tag() {
	echo '<link rel="stylesheet" type="text/css" href="'.get_home_url().'/assets/css/wp-admin.css">';
	echo '<script src="'.get_home_url().'/assets/js/wp-admin.js"></script>';
}
add_action('admin_print_scripts', 'my_admin_tag');




/* ------------------------------------------------------------
 投稿画面 カスタマイズ
------------------------------------------------------------ */
/* ----------------------------------------
 投稿画面で入れ子になったカテゴリ選択ボックスの階層を保つ
---------------------------------------- */
function solecolor_wp_terms_checklist_args($args,$post_id){
	$args['checked_ontop'] = false;

	return $args;
}
add_filter('wp_terms_checklist_args','solecolor_wp_terms_checklist_args',10,2);



/* ----------------------------------------
 メディアの移動
---------------------------------------- */
function customize_menus(){
	global $menu;
	$menu[19] = $menu[10];
	unset($menu[10]);
}
add_action( 'admin_menu', 'customize_menus' );



/* ------------------------------------------------------------
 ビジュアルエディタ カスタマイズ
------------------------------------------------------------ */
/* ----------------------------------------
 ビジュアルエディタ内にタグ追加
---------------------------------------- */
add_editor_style( get_home_url() . '/assets/css/common.min.css' );
add_editor_style( get_home_url() . '/assets/css/wp-visual-editor.css' );


/* ----------------------------------------
 諸々ボタン追加
---------------------------------------- */
function ilc_mce_buttons($buttons){
	array_push( $buttons , "backcolor", "copy", "cut", "paste", "fontsizeselect", "cleanup" );
	return $buttons;
}
add_filter("mce_buttons", "ilc_mce_buttons");


/* ----------------------------------------
 段落、クラス、フォントサイズのカスタマイズ
---------------------------------------- */
function custom_editor_settings($initArray) {
	global $post_type;

	if( $post_type === 'post' ){
		$post_original_class = '';
	} else{
		$post_original_class = '';
	}

	$initArray['body_class']    = 'wp-visual-editor s-editor ' . $post_original_class;
	$initArray['block_formats'] = "段落=p;見出し1=h2;見出し2=h3;";

	/* base size: 16px */
	$settings['fontsize_formats'] = '10px=62.5% 12px=75% 14px=87.5% 16px=100% 18px=112.5% 20px=125% 24px=150% 28px=175% 32px=200%';

	return $initArray;
}
add_filter('tiny_mce_before_init', 'custom_editor_settings');



/* ------------------------------------------------------------
 固定ページでビジュアルモードを使用しない
------------------------------------------------------------ */
function stop_rich_editor($editor) {
	global $typenow;
	global $post;
	if(in_array($typenow, array('page','tinymcetemplates'))) {
		$editor = false;
	}
	return $editor;
}
add_filter('user_can_richedit', 'stop_rich_editor');




/* ------------------------------------------------------------
 一覧カラムカスタマイズ
------------------------------------------------------------ */
/* ----------------------------------------
 tableにcolumnを追加
---------------------------------------- */
function sort_custom_columns( $columns ) {
	global $post_type;
	if ( $post_type == 'post' ) {
		$columns = array(
			'cb'         => '<input type="checkbox" />',
			'title'      => 'タイトル',
			'categories' => 'カテゴリー',
			'thumbnail'  => 'サムネイル',
			'author'     => '作成者',
			'date'       => '日付'
		);
	} elseif( $post_type == 'works' ){
		$columns = array(
			'cb'              => '<input type="checkbox" />',
			'title'           => 'タイトル',
			'scf-works_brand' => 'ブランド名',
			// 'works_client'    => 'クライアント',
			// 'works_industry'  => '業種',
			'works_category'  => '制作物の種類',
			'thumbnail'       => 'サムネイル',
			'author'          => '作成者',
			'date'            => '日付'
		);
	} elseif( $post_type == 'press' ){
		$columns = array(
			'cb'                  => '<input type="checkbox" />',
			'title'               => 'タイトル',
			'scf-press_publisher' => '出版社',
			'thumbnail'           => 'サムネイル',
			'author'              => '作成者',
			'date'                => '日付'
		);
	}
	return $columns;
}


/* ----------------------------------------
 columnsにカテゴリー名を表示
---------------------------------------- */
function getAdminTermList($post_name,$tax_name,$id){
	$terms = wp_get_object_terms( $id , $tax_name );
	if( $terms ){
		$count = 0;
		foreach ( $terms as $term ) {
			$term_name = $term->name;
			$term_slug = $term->slug;
			if( $count > 0 ){
				echo ',';
			}
			echo '<a href="'. get_home_url() .'/wp/wp-admin/edit.php?post_type='. $post_name .'&'. $tax_name .'='. $term_slug .'">'. $term_name .'</a>';
			$count++;
		}
	} else{
		echo '－';
	}
}


/* ----------------------------------------
 カラム内表示
---------------------------------------- */
function add_custom_column_id($column_name,$id) {
	global $post_type;
	/* ---------- common ---------- */
	if ( $column_name == 'thumbnail' ) {
		$value = get_the_post_thumbnail( $id, array( 100, 100 ), 'thumbnail' );
		echo ( $value ) ? $value : '－';
	}

	// /* ---------- opencampus ---------- */
	if( $column_name == 'scf-works_brand' ) {
		$value = get_post_meta($id,'works_brand',false)[0];
		echo $value;
	}
	if( $column_name == 'works_client' ) {
		getAdminTermList( 'works','works_client',$id );
	}
	if( $column_name == 'works_industry' ) {
		getAdminTermList( 'works','works_industry',$id );
	}
	if( $column_name == 'works_category' ) {
		getAdminTermList( 'works','works_category',$id );
	}

	/* ---------- press ---------- */
	if( $column_name == 'scf-press_publisher' ) {
		$value = get_post_meta($id,'press_publisher',false)[0];
		echo $value;
	}
}


/* ----------------------------------------
 絞込み機能追加
---------------------------------------- */
function my_add_filter() {
	global $post_type;
	$args = array(
		'hide_empty' => false,
	);

	if ( $post_type == 'works' ) {
		$terms = get_terms('works_client',$args);
		echo '<select name="works_client">';
			echo '<option value="">クライアント一覧</option>';
			foreach ($terms as $term) {
				echo '<option value="'. $term->slug .'" ';
				if ( isset( $_GET['works_client'] ) && $_GET['works_client'] == $term->slug ) {
					echo 'selected';
				}
				echo '>';
				echo $term->name . '</option>';
			}
		echo '</select>';

		$terms = get_terms('works_industry',$args);
		echo '<select name="works_industry">';
			echo '<option value="">業種一覧</option>';
			foreach ($terms as $term) {
				echo '<option value="'. $term->slug .'" ';
				if ( isset( $_GET['works_industry'] ) && $_GET['works_industry'] == $term->slug ) {
					echo 'selected';
				}
				echo '>';
				echo $term->name . '</option>';
			}
		echo '</select>';

		$terms = get_terms('works_category',$args);
		echo '<select name="works_category">';
			echo '<option value="">制作物の種類一覧</option>';
			foreach ($terms as $term) {
				echo '<option value="'. $term->slug .'" ';
				if ( isset( $_GET['works_category'] ) && $_GET['works_category'] == $term->slug ) {
					echo 'selected';
				}
				echo '>';
				echo $term->name . '</option>';
			}
		echo '</select>';

		$terms = get_terms('works_tag',$args);
		echo '<select name="works_tag">';
			echo '<option value="">タグ一覧</option>';
			foreach ($terms as $term) {
				echo '<option value="'. $term->slug .'" ';
				if ( isset( $_GET['works_tag'] ) && $_GET['works_tag'] == $term->slug ) {
					echo 'selected';
				}
				echo '>';
				echo $term->name . '</option>';
			}
		echo '</select>';
	}
}
add_action( 'restrict_manage_posts', 'my_add_filter' );


/* ----------------------------------------
 action
---------------------------------------- */
/* ---------- post --------- */
add_action('manage_post_posts_custom_column', 'add_custom_column_id', 10, 2);
add_filter( 'manage_post_posts_columns', 'sort_custom_columns' );

/* ---------- works --------- */
add_action('manage_works_posts_custom_column', 'add_custom_column_id', 10, 2);
add_filter( 'manage_works_posts_columns', 'sort_custom_columns' );

/* ---------- press --------- */
add_action('manage_press_posts_custom_column', 'add_custom_column_id', 10, 2);
add_filter( 'manage_press_posts_columns', 'sort_custom_columns' );








/* ------------------------------------------------------------------------------
 管理者以外の管理画面カスタマイズ
 管理者以外のアカウントがないので不要
------------------------------------------------------------------------------ */









