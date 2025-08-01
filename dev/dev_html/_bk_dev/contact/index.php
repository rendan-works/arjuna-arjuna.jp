<?php
	/**************************************************************
	 * mode パラメーターで判定
	 *
	 * modeは5種類
	 * index -- 入力ページ
	 * check -- 確認ページ
	 * mail  -- メール送信
	 * submit -- 送信ページ
	 * error -- エラーページ （有効期限エラーと未入力エラー両方で使用し、$error_typeで判別する）
	**************************************************************/
	$submit_only = false;

	/* ---------- mode ---------- */
	if( isset( $_GET["mode"] ) ){
		$mode = $_GET['mode'];
	} else{
		$mode = 'index';
	}

	/* ---------- セッションスタート ---------- */
	if( $mode !== 'submit' ){
		session_start();
	}

	/* ---------- トークン ---------- */
	if( $mode === 'check' || ($mode === 'mail' && $submit_only === false) ){
		if( isset($_POST["token"]) && isset($_SESSION["token"]) && $_POST["token"] === $_SESSION['token'] ){
		} else{
			$mode         = 'error';
			$error_type   = 'effective';
			$errorMessage = '有効期限が切れています。<br>大変お手数ですが、最初からやり直してください。';
		}
	}

	/* ---------- URLリスト ---------- */
	$form_url = array(
		'index'  => './',
		'check'  => './?mode=check',
		'mail'   => './?mode=mail',
		'submit' => './?mode=submit',
	);




	/**************************************************************
	 * 不正アクセス ./ へリダイレクト
	**************************************************************/
	/* ---------- POST ---------- */
	if (
		$mode !== 'index' &&
		empty($_SERVER["HTTP_REFERER"]) &&
		$_SERVER["REQUEST_METHOD"] != "POST"
	) {
		header( 'Location:'. $form_url['index'] );
		exit;
	}

	/* ---------- token ---------- */
	if( $mode === 'check' || $mode === 'mail' ){
		if ( isset( $_SESSION["token"] ) && !empty( $_SESSION["token"] ) ) {
		} else {
			// echo "不正なリクエストです" . "\n";
			header( 'Location:'. $form_url['index'] );
			exit;
		}
	}




	/**************************************************************
	 * クリックジャッキング対策
	**************************************************************/
	header('X-FRAME-OPTIONS: SAMEORIGIN');





	if( $mode == 'index' ){
		/**************************************************************
		 * 入力ページ
		**************************************************************/

		/**************************************************************
		 * トークン生成
		**************************************************************/
		/* ---------- トークンを生成 ---------- */
		$toke_byte = openssl_random_pseudo_bytes(32);
		$token     = bin2hex($toke_byte);

		/* ---------- セッションに保存 ---------- */
		$_SESSION['token'] = $token;


	} elseif( $mode == 'check' ){
		/**************************************************************
		 * 確認ページ
		**************************************************************/

		/**************************************************************
		 * トークン
		**************************************************************/
		if( isset($_POST["token"]) && $_POST["token"] === $_SESSION['token'] ){
			$token             = $_POST['token'];
			$_SESSION['token'] = $token;
		}



		/**************************************************************
		 * shaping
		**************************************************************/
		function shapingText( $text ){
			/* ---------- HTML特殊文字をエスケープ ---------- */
			$text = htmlspecialchars($text,ENT_QUOTES,'UTF-8');

			/* ---------- 前後の半角全角スペースを削除 ---------- */
			$text = preg_replace('/^[ 　]+/u', '', $text);
			$text = preg_replace('/[ 　]+$/u', '', $text);

			/* ---------- 文字代替 ---------- */
			$text = str_replace("<", "&lt;", $text);
			$text = str_replace(">", "&gt;", $text);
			$text = str_replace(",", "",$text);
			$text = str_replace("'", "",$text);
			$text = mb_convert_kana($text,'KVa',"UTF-8");

			return $text;
		}

		function shaping( $value ) {
			if( is_array( $value ) ){
				$values = '';
				$count  = 0;

				foreach ( $value as $text) {
					if( $count == 0 ){
						$joint = '';
					} else{
						$joint = '、';
						// $joint = "\n";
					}

					$values .= $joint . $text;
					$count++;
				}

				return $values;
			} else{
				$text = shapingText( $value );
				return $text;
			}
		}



		/**************************************************************
		 * value
		 * POSTされたデータを各変数に入れる
		**************************************************************/
		$f_name       = shaping( isset( $_POST['f_name'] ) ? $_POST['f_name'] : NULL );;
		$f_tel        = shaping( isset( $_POST['f_tel'] ) ? $_POST['f_tel'] : NULL );;
		$f_mail       = shaping( isset( $_POST['f_mail'] ) ? $_POST['f_mail'] : NULL );;
		$f_mail_check = shaping( isset( $_POST['f_mail-check'] ) ? $_POST['f_mail-check'] : NULL );;
		$f_address    = shaping( isset( $_POST['f_address'] ) ? $_POST['f_address'] : NULL );;
		$f_message    = shaping( isset( $_POST['f_message'] ) ? $_POST['f_message'] : NULL );;



		/**************************************************************
		 * value check
		**************************************************************/
		$errorMessage = '';

		/* ---------- $errorMessage ---------- */
		if( $errorMessage === '' ){
			if( $f_name == '' ) $errorMessage .= '「お名前」を入力してください。<br>';
			if( $f_tel == '' ) $errorMessage .= '「電話番号」を入力してください。<br>';
			if( $f_mail == '' ) $errorMessage .= '「メールアドレス」を入力してください。<br>';
			if( $f_address == '' ) $errorMessage .= '「ご住所」を入力してください。<br>';
			if( $f_message == '' ) $errorMessage .= '「お問い合わせ内容」を入力してください。<br>';
		}

		/* ---------- エラーがなければセッションに追加 ---------- */
		if( $errorMessage === '' ){
			$_SESSION['f_name']    = $f_name;
			$_SESSION['f_tel']     = $f_tel;
			$_SESSION['f_mail']    = $f_mail;
			$_SESSION['f_address'] = $f_address;
			$_SESSION['f_message'] = $f_message;

			if( $submit_only === true ){
				/* エラーがなく$submit_onlyがtrueなら、確認を飛ばしてメールを送信後、完了ページにリダイレクト */
				header( 'Location:'. $form_url['mail'] );
			}
		} else{
			$mode       = 'error';
			$error_type = 'required';
		}


		/* ---------- outputValue ---------- */
		function outputValue( $value ){
			if( isset( $value ) ) {
				echo nl2br( $value );
			} else{
				echo '入力内容に不備があります。再度入力して下さい。';
			}
		}



	} elseif( $mode == 'mail' ){
		/**************************************************************
		 * メール送信設定
		**************************************************************/
		mb_language("ja");
		mb_internal_encoding("UTF-8");


		/* ---------- variable ---------- */
		$mail_from_title = 'お問い合わせ'; // お問い合わせ or 資料請求 or 採用エントリー
		$mail_from_type  = 'お問い合わせ'; // お問い合わせ or 請求 or エントリー or お申し込み
		$mail_from_name  = '株式会社アルジュナ';
		$mail_to_mail    = 'test@rendan.jp';
		$mail_from_mail  = 'info@arjuna.jp';


		/* ---------- クレジット ---------- */
		$mail_credit = "ーーーーーーーーーーーーーーーーーーーーーーーーー

{$mail_from_name}
HP：https://arjuna.jp/

長崎オフィス
〒850-0033
長崎県長崎市万才町2-7松本ビル202
095-801-0780

福岡オフィス
〒810-0074
福岡県福岡市中央区大手門3丁目12-12 BLDG64 3F
050-3623-2865

ーーーーーーーーーーーーーーーーーーーーーーーーー
";


		/* ---------- 送信内容 ---------- */
		$mail_content = "{$mail_from_type}内容
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
お名前：{$_SESSION['f_name']}
電話番号：{$_SESSION['f_tel']}
メールアドレス：{$_SESSION['f_mail']}
ご住所：{$_SESSION['f_address']}
お問い合わせ内容：{$_SESSION['f_message']}
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
";



		/**************************************************************
		 * 受付メール
		**************************************************************/
		$reception_mail = array(
			'to'      => $mail_to_mail,
			'header'  =>
				'From: ' . mb_encode_mimeheader( mb_convert_encoding( $mail_from_name ,'JIS' , 'auto' ) ) . '<'. $mail_from_mail .'>'
				. "\r\n" . 'MIME-Version: 1.0'
				. "\r\n" . 'Content-Transfer-Encoding: 8bit'
				. "\r\n" . 'Content-Type: text/plain; charset=UTF-8'
			,
			'subject' => 'ホームページから'. $mail_from_title .'が届きました',
			'message' => "ホームページの{$mail_from_title}フォームから{$mail_from_type}がありました。
{$mail_from_type}内容は以下の通りです。


{$mail_content}
",
		);



		/**************************************************************
		 * 自動返信メール
		**************************************************************/
		$auto_mail = array(
			'to'      => $_SESSION['f_mail'],
			'header'  =>
				'From: ' . mb_encode_mimeheader( mb_convert_encoding( $mail_from_name ,'JIS' , 'auto' ) ) . '<'. $mail_from_mail .'>'
				. "\r\n" . 'MIME-Version: 1.0'
				. "\r\n" . 'Content-Transfer-Encoding: 8bit'
				. "\r\n" . 'Content-Type: text/plain; charset=UTF-8'
			,
			'subject' => '【'. $mail_from_name .'】'. $mail_from_title .'ありがとうございました',
			'message' => "{$_SESSION['f_name']} 様

この度は{$mail_from_name}へ{$mail_from_type}いただき、ありがとうございます。
下記の内容にて{$mail_from_type}を承りました。
折り返し担当者よりご連絡させていただきますので、今しばらくお待ちくださいませ。


{$mail_content}


※本メールはシステムからの自動返信メールです。
※本メールに返信されても、返信内容の確認およびご返答が出来ない場合がございます。
※本メールにお心当たりのないお客様や内容に誤りがありましたら、お手数ですが下記連絡先までお問い合わせください。

{$mail_credit}
",
		);



		/**************************************************************
		 * 送信
		**************************************************************/
		// mb_send_mail( 'test@rendan.jp' , $reception_mail['subject'] , $reception_mail['message'] , $reception_mail['header'] );
		mb_send_mail( $reception_mail['to'] , $reception_mail['subject'] , $reception_mail['message'] , $reception_mail['header'] , '-f ' . $reception_mail['to'] );
		mb_send_mail( $auto_mail['to'] , $auto_mail['subject'] , $auto_mail['message'] , $auto_mail['header'] , '-f ' . $auto_mail['to'] );



		/**************************************************************
		 * 完了ページへリダイレクト
		**************************************************************/
		header( 'Location:'. $form_url['submit'] );


		/**************************************************************
		 * セッション終了
		**************************************************************/
		session_destroy();



	} elseif( $mode == 'submit' ){
		/**************************************************************
		 * 完了ページ
		**************************************************************/
	}

 ?>
<?php $this_path = 'contact/'; ?>
<?php require_once( dirname( __FILE__ ) . '/../include/variable.php' ); ?>
<?php require_once( dirname( __FILE__ ) . '/../include/functions.php' ); ?>
<?php

	/**************************************************************
	 * modeによる振り分け
	**************************************************************/
	if( $mode == 'index' ){
		$page_description = '';
		$robots = true;
	} else{
		$page_description = '';
		$robots = false;
	}


	/**************************************************************
	 * template
	**************************************************************/
	$directory = array(
		array('HOME','Home',''),
		array('CONTACT','Contact','contact/'),
	);

	$meta = array(
		'title'       => getTitle($directory),
		'description' => $page_description,
		'keywords'    => '',
	);

	$preload = array();
	$style = array(
		$root . 'assets/css/page-contact.css',
	);
	$script = array(
		$root . 'assets/js/component-form.js',
	);
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
		<main class="l-main contact-main">
			<?php if( $mode == 'index' ): ?>
			<?php
				/**************************************************************
				 * 入力ページ
				**************************************************************/
			?>
			<!-- p-hero-->
			<header class="p-hero -bg3">
				<div class="p-hero__inner c-inner-max">
					<h1 class="p-hero__en">
						<span class="js-splittext">CONTACT</span>
					</h1>
				</div>
			</header>
			<!-- /p-hero-->
			<!-- contact-tel-->
			<div class="contact-tel">
				<div class="c-inner-max -contents-lg">
					<p class="contact-tel__txt c-txt-xxxl c-crop">
						ブランディング、パッケージデザイン、webサイト、<br>
						販促ツール制作などのご相談は、<br class="u-n-mqUp-sm">まずはお気軽にご連絡ください。
					</p>
					<p class="contact-tel__num">
						<span class="contact-tel__num__txt">Tel.</span>
						<span class="contact-tel__num__num">095-801-0780</span>
					</p>
					<p class="contact-tel__small">
						<small>受付時間 9:00-18:00（土日・祝祭日休）</small>
					</p>
				</div>
			</div>
			<!-- /contact-tel-->
			<!-- contact-form-->
			<div class="contact-form">
				<div class="c-inner-max">
					<form method="post" action="<?= $form_url['check']; ?>" name="contactForm" class="p-form">
						<input type="hidden" name="mode" value="check">
						<input type="hidden" name="token" value="<?= $token ?>">
						<!-- p-form__table -->
						<div class="p-form__table">
							<div class="p-form__table__flex">
								<dl class="p-form__table__cell">
									<dt>
										お名前
										<span class="p-form__required">必須</span>
									</dt>
									<dd class="p-form__control">
										<input type="text" name="f_name" placeholder="山田 太郎" autocomplete="name" data-name-ja="お名前" class="p-form__txtbox">
									</dd>
								</dl>
								<dl class="p-form__table__cell">
									<dt>
										電話番号
										<span class="p-form__required">必須</span>
									</dt>
									<dd class="p-form__control">
										<input type="tel" name="f_tel" placeholder="XXXX-XX-XXXX" autocomplete="tel" data-name-ja="電話番号" class="p-form__txtbox">
									</dd>
								</dl>
							</div>
							<div class="p-form__table__flex">
								<dl class="p-form__table__cell">
									<dt>
										メールアドレス
										<span class="p-form__required">必須</span>
									</dt>
									<dd class="p-form__control">
										<input type="email" name="f_mail" placeholder="xxx@xxx.co.jp" autocomplete="email" data-name-ja="メールアドレス" class="p-form__txtbox">
									</dd>
								</dl>
								<dl class="p-form__table__cell">
									<dt>
										メールアドレス（確認用）
										<span class="p-form__required">必須</span>
									</dt>
									<dd class="p-form__control">
										<input type="email" name="f_mail-check" placeholder="xxx@xxx.co.jp" data-name-ja="メールアドレス（確認用）" class="p-form__txtbox">
									</dd>
								</dl>
							</div>
							<dl class="p-form__table__cell">
								<dt>
									ご住所
									<span class="p-form__required">必須</span>
								</dt>
								<dd class="p-form__control">
									<input type="text" name="f_address" placeholder="東京都品川区○○○○○○123番地" autocomplete="address" data-name-ja="ご住所" class="p-form__txtbox">
								</dd>
							</dl>
							<dl class="p-form__table__cell">
								<dt>
									お問い合わせ内容
									<span class="p-form__required">必須</span>
								</dt>
								<dd class="p-form__control">
									<textarea name="f_message" rows="6" placeholder="お問い合わせ内容をご入力ください" data-name-ja="お問い合わせ内容" class="p-form__txtbox"></textarea>
								</dd>
							</dl>
						</div>
						<!-- /p-form__table -->
						<!-- p-form__button -->
						<div class="p-form__button">
							<p class="p-form__check p-button -medium -black">
								<a href="javascript:void(0);">
									<span class="p-button__ja">確認画面へ</span>
									<i class="c-icon c-arrow -medium"></i>
								</a>
							</p>
						</div>
						<!-- /p-form__button -->
					</form>
				</div>
			</div>
			<!-- /contact-form-->
			<?php elseif( $mode == 'error' ): ?>
			<?php
				/**************************************************************
				 * エラーページ
				**************************************************************/
			?>
			<!-- p-hero-->
			<header class="p-hero -bg3">
				<div class="p-hero__inner c-inner-max">
					<p class="p-hero__en">
						<span>CONTACT</span>
					</p>
				</div>
			</header>
			<!-- /p-hero-->
			<!-- contact-form-->
			<div class="contact-form">
				<div class="c-inner-max">
					<div class="p-form">
						<!-- p-form__attention -->
						<div class="p-form__attention">
							<h1 class="p-form__attention__title c-crop">
								<span class="u-ib">エラー</span>
							</h1>
							<p class="p-form__attention__txt c-txt-lg c-crop">
								<?= $errorMessage; ?>
							</p>
						</div>
						<!-- /p-form__attention -->
						<!-- p-form__button -->
						<div class="p-form__button">
							<p class="p-form__back p-button -medium -black">
								<?php if( $error_type == 'effective' ): ?>
								<a href="./">
									<span class="p-button__ja">やり直す</span>
								<?php else: ?>
								<a href="javascript:void(0);" onclick="window.history.back();">
									<span class="p-button__ja">戻る</span>
								<?php endif; ?>
									<i class="c-icon c-arrow -medium"></i>
								</a>
							</p>
						</div>
						<!-- /p-form__button -->
					</div>
				</div>
			</div>
			<!-- /contact-form-->
			<?php elseif( $mode == 'check' ): ?>
			<?php
				/**************************************************************
				 * 確認ページ
				**************************************************************/
			?>
			<!-- p-hero-->
			<header class="p-hero -bg3">
				<div class="p-hero__inner c-inner-max">
					<p class="p-hero__en">
						<span>CONTACT</span>
					</p>
				</div>
			</header>
			<!-- /p-hero-->
			<!-- contact-form-->
			<div class="contact-form">
				<div class="c-inner-max">
					<form method="post" action="<?= $form_url['mail']; ?>" name="contactForm" class="p-form">
						<input type="hidden" name="mode" value="mail">
						<input type="hidden" name="token" value="<?= $token ?>">
						<!-- p-form__table -->
						<div class="p-form__table">
							<div class="p-form__table__flex">
								<dl class="p-form__table__cell">
									<dt>
										お名前
										<span class="p-form__required">必須</span>
									</dt>
									<dd class="p-form__txtbox">
										<?php outputValue( $f_name ); ?>
									</dd>
								</dl>
								<dl class="p-form__table__cell">
									<dt>電話番号</dt>
									<dd class="p-form__txtbox">
										<?php outputValue( $f_tel ); ?>
									</dd>
								</dl>
							</div>
							<div class="p-form__table__flex">
								<dl class="p-form__table__cell">
									<dt>
										メールアドレス
										<span class="p-form__required">必須</span>
									</dt>
									<dd class="p-form__txtbox">
										<?php outputValue( $f_mail ); ?>
									</dd>
								</dl>
								<dl class="p-form__table__cell">
									<dt>メールアドレス（確認用）</dt>
									<dd class="p-form__txtbox">
										<?php outputValue( $f_mail_check ); ?>
									</dd>
								</dl>
							</div>
							<dl class="p-form__table__cell">
								<dt>
									ご住所
									<span class="p-form__required">必須</span>
								</dt>
								<dd class="p-form__txtbox">
									<?php outputValue( $f_address ); ?>
								</dd>
							</dl>
							<dl class="p-form__table__cell">
								<dt>
									お問い合わせ内容
									<span class="p-form__required">必須</span>
								</dt>
								<dd class="p-form__txtbox -textarea">
									<?php outputValue( $f_message ); ?>
								</dd>
							</dl>
						</div>
						<!-- /p-form__table -->
						<!-- p-form__button -->
						<div class="p-form__button">
							<p class="p-form__back p-button -medium -border">
								<a href="javascript:void(0);" onclick="window.history.back();">
									<i class="c-icon c-arrow -medium -reverse"></i>
									<span class="p-button__ja">前の画面へ</span>
								</a>
							</p>
							<p class="p-form__submit p-button -medium -black">
								<a href="javascript:void(0);">
									<span class="p-button__ja">送信</span>
									<i class="c-icon c-arrow -medium"></i>
								</a>
							</p>
						</div>
						<!-- /p-form__button -->
					</form>
				</div>
			</div>
			<!-- /contact-form-->
			<?php elseif( $mode == 'submit' ): ?>
			<?php
				/**************************************************************
				 * 完了ページ
				**************************************************************/
			?>
			<!-- p-hero-->
			<header class="p-hero -bg3">
				<div class="p-hero__inner c-inner-max">
					<p class="p-hero__en">
						<span>CONTACT</span>
					</p>
				</div>
			</header>
			<!-- /p-hero-->
			<!-- contact-form-->
			<div class="contact-form">
				<div class="c-inner-max">
					<div class="p-form">
						<!-- p-form__attention -->
						<div class="p-form__attention">
							<h1 class="p-form__attention__title c-crop">
								<span class="u-ib">お問い合わせフォームの</span>
								<span class="u-ib">送信を完了致しました。</span>
							</h1>
							<p class="p-form__attention__txt c-txt-lg c-crop">
								この度はお問い合わせいただきまして誠にありがとうございます。<br class="u-n-mqDown-lg">
								内容を確認次第、担当者より折返しご連絡させていただきます。<br class="u-n-mqDown-lg">
								今しばらくお待ちくださいませ。
							</p>
							<p class="p-form__attention__txt2 c-txt-md2 c-crop">
								<small>
									※ご送信後、ご確認メールが届かない場合は、フォームご入力のメールアドレスの誤り、もしくはシステム等の不具合が考えられます。<br class="u-n-mqDown-lg">
									その際にはお手数ですがもう一度ご送信下さいますか、お電話にてお問い合わせくださいますようお願い申し上げます。<br class="u-n-mqDown-lg">
									また、まれに迷惑メールフォルダへ入っている場合がございますので、合わせてご確認ください。
								</small>
							</p>
						</div>
						<!-- /p-form__attention -->
					</div>
				</div>
			</div>
			<!-- /contact-form-->
			<?php endif; ?>
		</main>
		<?php require_once($web_root.$root.'include/layout_footer.php'); ?>
	</body>
</html>
