<?php


	/**************************************************************
	 * getTitle
	**************************************************************/
	function getTitle( $array ){
		if( !$array ){
			return false;
		}

		$array = array_reverse($array);
		global $base_title;
		$title = '';

		for ($i = 0; $i < count($array); ++$i) {

			if( $array[$i][0] == 'ホーム' || $array[$i][0] == 'Home' || $array[$i][0] == 'HOME'  ){
				$title .= $base_title;
			} else{
				$title .= $array[$i][0];
			}

			if( isset( $array[$i+1] ) && $array[$i+1][1] ){
				$title .= ' | ';
			}
		}

		return $title;
	}



	/**************************************************************
	 * outputStyle
	**************************************************************/
	function outputStyle( $array ){
		if( !$array ){
			return false;
		}

		global $cash_data;
		foreach ( $array as $_this ) {
			echo '	<link rel="stylesheet" href="'. $_this . $cash_data .'">' . "\n";
		}
	}



	/**************************************************************
	 * outputScript
	**************************************************************/
	function outputScript( $array ){
		if( !$array ){
			return false;
		}

		global $cash_data;
		foreach ( $array as $_this ) {
			echo '	<script src="'. $_this . $cash_data .'" defer></script>' . "\n";
		}
	}



	/**************************************************************
	 * outputPreload
	**************************************************************/
	function outputPreload( $array ){
		if( !$array ){
			return false;
		}

		for( $i = 0; $i < count($array); $i++ ){

			$href  = ' href="' . $array[$i]['href'] . '"';
			$as    = '';
			$type  = '';
			$media = '';

			if ( !empty( $array[$i]['as'] ) ) $as = ' as="' . $array[$i]['as'] . '"';
			if ( !empty( $array[$i]['type'] ) ) $type = ' type="' . $array[$i]['type'] . '"';
			if ( !empty( $array[$i]['media'] ) ) $media = ' media="' . $array[$i]['media'] . '"';

			echo '	<link rel="preload"'. $href . $as . $type . $media .'>' . "\n";
		}
	}




	/**************************************************************
	 * getWPDirectory
	**************************************************************/
	function getWPDirectory( $directory ){
		function removeHomeUrl( $url ){
			$url = str_replace( get_home_url() , '' , $url );
			$url = ltrim( $url , '/' );
			return $url;
		}

		// WordPress
		if( is_tax() ){
			$term_slug = get_term_by('slug', get_query_var('term'), get_query_var( 'taxonomy' ) );
			$term_id   = $term_slug->term_id;
			$term_array = array();

			while ( $term_id != 0 ){
				$term      = get_term( $term_id );
				$term_name = $term->name;
				$term_slug = $term->slug;
				$term_link = get_term_link( $term_id );
				$term_link = removeHomeUrl( $term_link );

				$array = array( $term_name , $term_slug , $term_link );
				array_unshift( $term_array , $array );

				$term_id = $term->parent;
			}

			if( $term_array ){
				foreach ( $term_array as $value ) {
					array_push( $directory , $value );
				}
			}

		} elseif( is_category() ){
			$category_id    = get_query_var('cat');
			$category_array = array();

			while ($category_id != 0){
				$category      = get_category( $category_id );
				$category_name = $category->name;
				$category_slug = $category->slug;
				$category_link = get_category_link( $category_id );
				$category_link = removeHomeUrl( $category_link );

				$array = array( $category_name , $category_slug , $category_link );
				array_unshift( $category_array , $array );

				$category_id = $category->parent;
			}

			if( $category_array ){
				foreach ( $category_array as $value ) {
					array_push( $directory , $value );
				}
			}

		} elseif( is_tag() ){
			$tag_id    = get_query_var('tag');
			$tag_array = array();

			while ($tag_id != 0){
				$tag      = get_tag( $tag_id );
				$tag_name = $tag->name;
				$tag_slug = $tag->slug;
				$tag_link = get_term_link( $tag_id , 'post_tag' );
				$tag_link = removeHomeUrl( $tag_link );

				$array = array( $tag_name , $tag_slug , $tag_link );
				array_unshift( $tag_array , $array );

				$tag_id = $tag->parent;
			}

			if( $tag_array ){
				foreach ( $tag_array as $value ) {
					array_push( $directory , $value );
				}
			}

		} elseif( is_month() ){
			$year          = get_the_date( 'Y' );
			$month         = get_the_date( 'm' );
			$archive_title = trim(wp_get_document_title());
			$archive_en    = $year . '.' . $month;
			$archive_link  = get_month_link( $year, $month );
			$archive_link  = removeHomeUrl( $archive_link );

			$array = array( $archive_title , $archive_en , $archive_link );
			array_push( $directory , $array );

		} elseif( is_year() ){
			$year          = get_the_date( 'Y' );
			$archive_title = trim(wp_get_document_title());
			$archive_en    = $year;
			$archive_link  = get_year_link( $year );
			$archive_link  = removeHomeUrl( $archive_link );

			$array = array( $archive_title , $archive_title , $archive_link );
			array_push( $directory , $array );

		} elseif( is_search() ){
			$year         = get_the_date( 'Y' );
			$month        = get_the_date( 'm' );
			$search_title = '"' . get_search_query() . '"の検索結果';

			global $url_parameter;

			$array = array( $search_title , 'Search' , $url_parameter );
			array_push( $directory , $array );
		}

		return $directory;
	}




	/**************************************************************
	 * outputJsonld
	**************************************************************/
	function outputJsonld( $directory , $title , $description , $page_jsonld = '' ){
		global $robots;
		if( !$directory || is_category() || is_tax() || is_month() || is_404() || $robots == false ){
			return false;
		}

		global $url;
		global $site_name;
		global $home_url;
		global $jsonld_data;
		global $sitemap_data;
		global $link_data;


		/* ---------- SNSリスト生成 ---------- */
		$jsonld_sns = '';
		if( $link_data ){
			$position = 0;
			$jsonld_sns_list = '';

			foreach( $link_data as $key => $value ){
				$position++;
				if( $position > 1 ){
					$jsonld_sns_list .= ',';
				}
				$jsonld_sns_list .= '"'. $value .'"';
			}

			$jsonld_sns .= '"sameAs":[';
			$jsonld_sns .= $jsonld_sns_list;
			$jsonld_sns .= '],';
		}


		/* ---------- ロゴリスト生成 ---------- */
		$jsonld_logo = '';
		if ( isset( $jsonld_data['logo'] ) ) {
			$jsonld_logo .= '"logo": {';
			$jsonld_logo .= '	"@type" : "ImageObject",';
			$jsonld_logo .= '	"url"   : "'. $jsonld_data['logo']['url'] .'",';
			$jsonld_logo .= '	"width" : "'. $jsonld_data['logo']['width'] .'",';
			$jsonld_logo .= '	"height": "'. $jsonld_data['logo']['height'] .'"';
			$jsonld_logo .= '},';
		}


		/* ---------- お問い合わせリスト生成 ---------- */
		$jsonld_contact = '';
		if ( isset( $jsonld_data['contact'] ) ) {
			$jsonld_contact .= '"contactPoint" : {';
			$jsonld_contact .= '	"@type" : "ContactPoint",';

			if( $jsonld_data['contact']['telephone'] ){
				$jsonld_contact .= '	"telephone" : "'. $jsonld_data['contact']['telephone'] .'",';
			}
			if( $jsonld_data['contact']['fax'] ){
				$jsonld_contact .= '	"faxNumber" : "'. $jsonld_data['contact']['fax'] .'",';
			}
			if( $jsonld_data['contact']['email'] ){
				$jsonld_contact .= '	"email" : "'. $jsonld_data['contact']['email'] .'",';
			}

			$jsonld_contact .= '	"url"              : "'. $home_url .'",';
			$jsonld_contact .= '	"contactType"      : "customer support",';
			$jsonld_contact .= '	"areaServed"       : "'. $jsonld_data['address']['country'] .'",';
			$jsonld_contact .= '	"availableLanguage": "'. $jsonld_data['address']['language'] .'"';
			$jsonld_contact .= '},';
		}


		/* ---------- サイトマップリスト生成 ---------- */
		$jsonld_sitemap = '';
		if( $sitemap_data ){
			$position = 0;
			$jsonld_sitemap_name = '';
			$jsonld_sitemap_url  = '';

			foreach( $sitemap_data as $key => $value ){
				$position++;
				if( $position > 1 ){
					$jsonld_sitemap_name .= ',';
					$jsonld_sitemap_url  .= ',';
				}
				$jsonld_sitemap_name .= '"'. $key .'"';
				$jsonld_sitemap_url  .= '"'. $value .'"';
			}

			$jsonld_sitemap .= '{';
			$jsonld_sitemap .= '	"@context": "https://schema.org",';
			$jsonld_sitemap .= '	"@type": "SiteNavigationElement",';
			$jsonld_sitemap .= '	"name": [';
			$jsonld_sitemap .= $jsonld_sitemap_name;
			$jsonld_sitemap .= '	],';
			$jsonld_sitemap .= '	"url": [';
			$jsonld_sitemap .= $jsonld_sitemap_url;
			$jsonld_sitemap .= '	]';
			$jsonld_sitemap .= '},';
		}


		/* ---------- パンくずリスト生成 ---------- */
		$json_itemList = '';

		$position = 0;
		foreach ( $directory as $value ) {
			$position++;
			if( $position > 1 ){
				$json_itemList .= ',';
			}
			$json_itemList .= '{';
			$json_itemList .= '	"@type": "ListItem",';
			$json_itemList .= '	"position": '. $position .',';
			$json_itemList .= '	"item": {';
			$json_itemList .= '		"@id": "'. $home_url . $value[1] .'",';
			$json_itemList .= '		"name": "'. $value[0] .'"';
			$json_itemList .= '	}';
			$json_itemList .= '}';
		}





		/* ---------- main ---------- */
		$jsonld = '[
			{
				"@context"   : "https://schema.org",
				"@type"      : "WebSite",
				"name"       : "'. $site_name .'",
				"description": "'. $description .'",
				"url"        : "'. $url .'"
			},
			{
				"@context"     : "http://schema.org",
				"@type"        : "Organization",
				"url"          : "'. $home_url .'",
				"name"         : "'. $jsonld_data['corporation'] .'",
				'. $jsonld_sns .'
				'. $jsonld_logo .'
				'. $jsonld_contact .'
				"location": {
					"@type": "Place",
					"@id"  : "'. $home_url .'",
					"name" : "'. $jsonld_data['corporation'] .'",
					"address": {
						"@type"          : "PostalAddress",
						"addressCountry" : "'. $jsonld_data['address']['country'] .'",
						"postalCode"     : "'. $jsonld_data['address']['postal_code'] .'",
						"addressRegion"  : "'. $jsonld_data['address']['regiony'] .'",
						"addressLocality": "'. $jsonld_data['address']['locality'] .'",
						"streetAddress"  : "'. $jsonld_data['address']['street'] .'"
					}
				}
			},
			'. $jsonld_sitemap .'
			{
				"@context": "http://schema.org",
				"@type": "BreadcrumbList",
				"itemListElement": ['
			;
		$jsonld .= $json_itemList;
		$jsonld .= '
				]
			}
			'. $page_jsonld .'
		]';

		$jsonld = removeUseless($jsonld);

		echo '	<script type="application/ld+json">'. $jsonld .'</script>' . "\n";
	}




	/**************************************************************
	 * outputBreadcrumb
	**************************************************************/
	function outputBreadcrumb( $directory , $class = '' ){
		if( !$directory ){
			return false;
		}

		global $root;

		echo '<ol class="c-breadcrumb '. $class .'">';

		// directory
		foreach ( $directory as $_this ) {
			if( $_this[1] == 'entry' ){
				continue;
			}
			echo '	<li><a href="'. $root . $_this[2] .'" class="c-anchor-lineIn">'. $_this[1] .'</a></li>' . "\n";
		}

		echo '</ol>';
	}




	/**************************************************************
	 * removeUseless
	**************************************************************/
	function removeUseless( $target ){
		$target = str_replace(PHP_EOL, '', $target); //改行削除
		$target = preg_replace('/(\t|\r\n|\r|\n)/s', '', $target); //タブ削除
		$target = preg_replace('/　/', ' ', $target); //連続する2つ以上の全角スペース
		$target = preg_replace('/\s\s+/', ' ', $target); //連続する2つ以上の半角スペース

		return $target;
	}




	/**************************************************************
	 * getSubstr
	**************************************************************/
	function getSubstr($text,$max,$endText){
		$text = strip_shortcodes($text);
		$text = strip_tags($text);
		$text = str_replace("\n", "", $text);
		$text = str_replace("\r", "", $text);
		$text = str_replace('&nbsp;', " ", $text);

		if( mb_strlen($text) > $max ) {
			$text = mb_substr($text, 0, $max) . $endText;
		} else{
			$text = $text;
		}

		return $text;
	}





	/**************************************************************
	 * outputSanitize
	 *
	 * phpを圧縮したい場合
	 * https://prfac.com/php-minify/
	 * https://manablog.org/php-html-minify/
	 * https://codesapuri.com/articles/21
	**************************************************************/
	function outputSanitize($buffer) {

		/* ----- 改行が必要なタグは抽出 ---------- */
		preg_match_all('#\<textarea.*\>.*\<\/textarea\>#Uis', $buffer, $foundTxt);
		preg_match_all('#\<pre.*\>.*\<\/pre\>#Uis', $buffer, $foundPre);
		preg_match_all('#\<article class=\"(p-article|pg-blog-article)\">.*\<\/article\>#Uis', $buffer, $foundTxt);

		/* ----- 改行が必要なタグを先に置換しておく ---------- */
		$buffer = str_replace($foundTxt[0], array_map(function ($el) {
			return '<textarea>' . $el . '</textarea>';
		}, array_keys($foundTxt[0])), $buffer);

		$buffer = str_replace($foundPre[0], array_map(function ($el) {
			return '<pre>' . $el . '</pre>';
		}, array_keys($foundPre[0])), $buffer);

		$buffer = str_replace($foundTxt[0], array_map(function ($el) {
			return '<article>' . $el . '</article>';
		}, array_keys($foundTxt[0])), $buffer);

		/* ----- 一旦全て削除 ---------- */
		$search = array(
			'/\>[^\S ]+/s',      // strip whitespaces after tags, except space
			'/[^\S ]+\</s',      // strip whitespaces before tags, except space
			'/(\s)+/s',          // shorten multiple whitespace sequences
			'/<!--[\s\S]*?-->/s' // コメントを削除
		);
		$replace = array(
			'>',
			'<',
			'\\1',
			''
		);
		$buffer = preg_replace($search, $replace, $buffer);

		/* ----- 改行が必要なタグを元に戻す ---------- */
		$buffer = str_replace(array_map(function ($el) {
			return '<textarea>' . $el . '</textarea>';
		}, array_keys($foundTxt[0])), $foundTxt[0], $buffer);

		$buffer = str_replace(array_map(function ($el) {
			return '<pre>' . $el . '</pre>';
		}, array_keys($foundPre[0])), $foundPre[0], $buffer);

		$buffer = str_replace(array_map(function ($el) {
			return '<article>' . $el . '</article>';
		}, array_keys($foundTxt[0])), $foundTxt[0], $buffer);


		return $buffer;

	}
	ob_start('outputSanitize');






