<?php $this_path = 'about/'; ?>
<?php require_once( dirname( __FILE__ ) . '/../include/variable.php' ); ?>
<?php require_once( dirname( __FILE__ ) . '/../include/functions.php' ); ?>
<?php
	$directory = array(
		array('HOME','Home',''),
		array('ABOUT US','About us','about/'),
	);
	$robots = true;

	$meta = array(
		'title'       => getTitle($directory),
		'description' => '',
		'keywords'    => '',
	);

	$preload = array();
	$style = array(
		$root . 'assets/css/page-about.css',
	);
	$script = array(
		$root . 'assets/js/page-about.js',
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
		<main class="l-main about-main">
			<!-- p-hero-->
			<header class="p-hero -bg3">
				<div class="p-hero__inner c-inner-max">
					<h1 class="p-hero__en">
						<span class="js-splittext">ABOUT US</span>
					</h1>
				</div>
			</header>
			<!-- /p-hero-->
			<!-- about-intro-->
			<section class="about-intro" data-chapter="1">
				<div class="about-intro__inner c-inner-max -contents-lg">
					<div class="about-intro__contents">
						<h2 class="about-intro__catch c-crop-v-h-lg">会いにいくよ。</h2>
						<div class="about-intro__txt">
							<div class="about-intro__txt__cell -unique1 c-txts">
								<p class="c-crop-v-h-lg">会いにいくことが好きだ。</p>
								<p class="c-crop-v-h-lg">
									まだ見ぬ誰かが世のなかや、<br>
									地域や、社会のために、<br>
									やっとの想いで<br>
									送り出そうとしているものがある。<br>
									変わろうとするチカラを<br>
									応援してほしいという願いがある。
								</p>
								<p class="c-crop-v-h-lg">
									そんな勇気や熱に触れたとき、<br>
									私たちの心はどくどく、と動く。<br>
									会いたい、と思う前に、<br class="u-n-mqDown-lg">
									もう走り出している。
								</p>
							</div>
							<div class="about-intro__txt__cell -unique2 c-txts">
								<p class="c-crop-v-h-lg">
									アナログコミュニケーションに<br>
									こだわって、会って、話して、ぶつかって。<br>
									一緒にジタバタして、よろこびあう。<br>
									会うことでうまれる価値があると、<br>
									会うことで築ける関係があると、<br>
									信じているから。
								</p>
								<p class="c-crop-v-h-lg">
									私たちはあなたに会いに行く。<br>
									デザインは、ここからはじまる。<br>
									これが、私たちの大好きな<br>
									仕事のはなしです。
								</p>
							</div>
						</div>
					</div>
					<div class="about-intro__illust">
						<div class="about-intro__illust__cell -unique1">
							<img src="<?= $this_img_path; ?>intro_illust_1.webp" alt="" decoding="async">
						</div>
						<div class="about-intro__illust__cell -unique2">
							<img src="<?= $this_img_path; ?>intro_illust_2.webp" alt="" decoding="async">
						</div>
					</div>
				</div>
			</section>
			<!-- /about-intro-->
			<!-- about-contentss-->
			<div class="about-contentss">
				<!-- about-contents-->
				<section class="about-contents">
					<div class="about-contents__flex c-inner-max">
						<div class="about-contents__contents js-trigger">
							<header>
								<div class="c-title5 js-fadeups">
									<p class="c-title5__en">1.PURPOSE</p>
									<h2 class="c-title5__ja">アルジュナの存在意義</h2>
								</div>
							</header>
							<h3 class="about-contents__catch c-crop js-splittext js-var-delay-6">らしさを届ける</h3>
							<p class="about-contents__txt c-crop">
								一人ひとりと真向かいに接し、「らしさ」を見つけ、<br class="u-n-mqDown-lg">
								企業の魅力をクリエイティブの力で社会へ届けます。
							</p>
							<p class="about-contents__txt2 c-txt-lg3 c-crop">日々、様々な職種の方々と接しながら、クライアントの魅力を形に変えて伝えています。立場が違っても、私たちは皆同じ。一人ひとりを大切にし、真心を込めて接することが重要です。アルジュナでは人々の個性や魅力を可視化し、その「らしさ」をちょうど良い形で社会に届けることを大切にします。</p>
						</div>
						<figure class="about-contents__illust -unique1 js-trigger js-fadeup">
							<div class="c-anime-rotate">
								<img src="<?= $this_img_path; ?>contents_illust_1.webp" alt="" decoding="async">
							</div>
						</figure>
					</div>
				</section>
				<!-- /about-contents-->
				<!-- about-contents-->
				<section class="about-contents">
					<div class="about-contents__flex c-inner-max">
						<div class="about-contents__contents js-trigger">
							<header>
								<div class="c-title5 js-fadeups">
									<p class="c-title5__en">2.CREDO</p>
									<h2 class="c-title5__ja">アルジュナの行動指針</h2>
								</div>
							</header>
							<h3 class="about-contents__catch c-crop js-splittext js-var-delay-6">一緒に創る</h3>
							<p class="about-contents__txt c-crop">デザインとは目的を果たすための計画のこと。</p>
							<p class="about-contents__txt2 c-txt-lg3 c-crop">デザインとは、単に装飾や芸術を表現することに留まらず、ブランドの価値や経営者の想いを形作る重要な計画を意味します。協力し合いながら、アイデアを共有し、お互いをサポートし、一緒に楽しいものを創り上げましょう。</p>
						</div>
						<figure class="about-contents__illust -unique2 js-trigger js-fadeup">
							<div class="c-anime-floating3">
								<img src="<?= $this_img_path; ?>contents_illust_2.webp" alt="" decoding="async">
							</div>
						</figure>
					</div>
				</section>
				<!-- /about-contents-->
				<!-- about-contents-->
				<section class="about-contents">
					<div class="about-contents__flex c-inner-max">
						<div class="about-contents__contents js-trigger">
							<header>
								<div class="c-title5 js-fadeups">
									<p class="c-title5__en">3.MISSION</p>
									<h2 class="c-title5__ja">アルジュナの使命</h2>
								</div>
							</header>
							<h3 class="about-contents__catch c-crop js-splittext js-var-delay-6">クロコになる</h3>
							<p class="about-contents__txt c-crop">
								わたしたちはクライアントの未来を楽しくするために、<br class="u-n-mqDown-lg">
								2つの「そうぞう力」を身に付けた職人の集団。<br>
								それはまるでクロコのような存在です。
							</p>
							<p class="about-contents__txt2 c-txt-lg3 c-crop">クライアントの未来を明るくするため、想像力と創造力を持った職人集団です。まるで舞台裏のクロコのように、私たちはプロフェッショナルとして技術を磨きつつ、人間らしい温かさと思いやりを忘れずに、クライアントの思いを形にします。</p>
						</div>
						<figure class="about-contents__illust -unique3 js-trigger js-fadeup">
							<div>
								<img class="c-anime-flashing" src="<?= $this_img_path; ?>contents_illust_3_1.webp" alt="" decoding="async">
								<img src="<?= $this_img_path; ?>contents_illust_3_2.webp" alt="" decoding="async">
							</div>
						</figure>
					</div>
				</section>
				<!-- /about-contents-->
				<!-- about-contents-->
				<section class="about-contents">
					<div class="about-contents__flex c-inner-max">
						<div class="about-contents__contents js-trigger">
							<header>
								<div class="c-title5 js-fadeups">
									<p class="c-title5__en">4.VALUE</p>
									<h2 class="c-title5__ja">アルジュナの価値</h2>
								</div>
							</header>
							<h3 class="about-contents__catch c-crop js-splittext js-var-delay-6">機能と情緒</h3>
							<p class="about-contents__txt c-crop">
								世の中でしっかり機能し、人のこころに心地よく。<br class="u-n-mqDown-lg">
								問題解決を中心に据え、デザインで応えます。
							</p>
							<p class="about-contents__txt2 c-txt-lg3 c-crop">デザインが実用的であることと同時に、心に響く感動を与えることの両方を大切にしています。私たちは、問題を解決するだけでなく、デザインを通じて人の心をゆさぶる情緒を届けたいと思っています。機能的価値とは、明瞭で使いやすく、実益をもたらすもの。情緒的価値とは、感覚に訴え、共感を呼び、新たな意欲を喚起するもの。アルジュナは、これらの価値をバランス良く組み合わせることで、デザインがより深い意味を持ち、社会にとって価値あるものになると信じています。</p>
						</div>
						<figure class="about-contents__illust -unique4 js-trigger js-fadeup">
							<div>
								<img src="<?= $this_img_path; ?>contents_illust_4_1.webp" alt="" decoding="async">
								<img class="js-fade js-var-delay-12" src="<?= $this_img_path; ?>contents_illust_4_2.webp" alt="" decoding="async">
							</div>
						</figure>
					</div>
				</section>
				<!-- /about-contents-->
				<!-- about-contents-->
				<section class="about-contents">
					<div class="about-contents__flex c-inner-max">
						<div class="about-contents__contents js-trigger">
							<header>
								<div class="c-title5 js-fadeups">
									<p class="c-title5__en">5.VISION</p>
									<h2 class="c-title5__ja">アルジュナが目指す未来</h2>
								</div>
							</header>
							<h3 class="about-contents__catch c-crop js-splittext js-var-delay-6">みんながデザインする</h3>
							<p class="about-contents__txt c-crop">デザイン思考で社会との架け橋をつくり、経営者自身が自ずからデザインしていける未来を目指します。</p>
							<p class="about-contents__txt2 c-txt-lg3 c-crop">デザインがブランドの要として機能しはじめたら、そこからが本当のスタートです。デザインが私達デザイナーの手から離れた後、経営者の皆さんが自分たちで考え、自分たちで行動を起こそうとするモチベーションの起因になれば、その先に経営者自身が自らデザインしていける未来が待っています。</p>
						</div>
						<figure class="about-contents__illust -unique5 js-trigger js-fadeup">
							<div>
								<img class="c-anime-change" src="<?= $this_img_path; ?>contents_illust_5_1.webp" alt="" decoding="async">
								<img src="<?= $this_img_path; ?>contents_illust_5_2.webp" alt="" decoding="async">
							</div>
						</figure>
					</div>
				</section>
				<!-- /about-contents-->
				<!-- about-contents-->
				<section class="about-contents">
					<div class="about-contents__flex c-inner-max">
						<div class="about-contents__contents js-trigger">
							<header>
								<div class="c-title5 js-fadeups">
									<p class="c-title5__en">6.SPIRIT</p>
									<h2 class="c-title5__ja">アルジュナの精神</h2>
								</div>
							</header>
							<h3 class="about-contents__catch c-crop js-splittext js-var-delay-6">素直でいよう</h3>
							<p class="about-contents__txt c-crop">自分に、他人に素直に向き合える人で。</p>
							<p class="about-contents__txt2 c-txt-lg3 c-crop">素直さを大切にしましょう。自分自身や他人に素直に向き合うことで、お互いが成長し、支え合うことができる。疑問に思ったことは遠慮なく話し合い、新しい挑戦に勇敢に取り組んでいくことでデザインがそれぞれの生活や将来を楽しくしてくれます。</p>
						</div>
						<figure class="about-contents__illust -unique6 js-trigger js-fadeup">
							<div>
								<img src="<?= $this_img_path; ?>contents_illust_6_1.webp" alt="" decoding="async">
								<img class="js-fade js-var-delay-12" src="<?= $this_img_path; ?>contents_illust_6_2.webp" alt="" decoding="async">
							</div>
						</figure>
					</div>
				</section>
				<!-- /about-contents-->
				<!-- about-contents-->
				<section class="about-contents">
					<div class="about-contents__flex c-inner-max">
						<div class="about-contents__contents js-trigger">
							<header>
								<div class="c-title5 js-fadeups">
									<p class="c-title5__en">7.SLOGAN</p>
									<h2 class="c-title5__ja">アルジュナの合言葉</h2>
								</div>
							</header>
							<h3 class="about-contents__catch c-crop js-splittext js-var-delay-6">デザインが楽しくする</h3>
							<p class="about-contents__txt c-crop">働くこと、創ること、そして人と接すること全てにおいて、アルジュナは「楽しい」ことを大切にします。</p>
							<p class="about-contents__txt2 c-txt-lg3 c-crop">楽しい、が生活のまんなかにあれば、どんなに難しい問題でも切り開いていけると私達は信じています。「どうしたら楽しくなるだろう？」という命題に向かい工夫を重ねていく道のりこそ、デザインそのもの。働くことが楽しくなる、創ることが楽しくなる、人と接することが楽しくなる。そんな毎日を目指しながら共創していける幸せな会社を目指しています。</p>
						</div>
						<figure class="about-contents__illust -unique7 js-trigger js-fadeup">
							<div class="c-anime-floating3">
								<img src="<?= $this_img_path; ?>contents_illust_7.webp" alt="" decoding="async">
							</div>
						</figure>
					</div>
				</section>
				<!-- /about-contents-->
			</div>
			<!-- /about-contentss-->
			<!-- about-logo-->
			<section class="about-logo">
				<div class="c-inner-max">
					<header>
						<div class="c-title5 js-trigger js-fadeups u-t-center">
							<p class="c-title5__en">8.LOGO MARK</p>
							<h2 class="c-title5__ja">アルジュナのロゴマーク</h2>
						</div>
					</header>
					<div class="about-logo__flex">
						<div class="about-logo__fex__contents">
							<section class="about-logo__item">
								<h3 class="about-logo__item__title">シンボルマーク</h3>
								<p class="about-logo__item__txt c-txt-lg3 c-crop">社名「アルジュナ」は仏教哲学の始祖「ナーガールジュナ(Nāgārjuna)」に由来。シンボルは釈尊が悟りを開いた菩提樹の葉をモチーフに一筆書きで7枚の葉をあしらい、7つの理念（ミッション・ビジョン・スピリッツ・クレド・パーパス・バリュー）を現しています。葉をとりまく図形は理論的には存在しない「正7角形」。割り切れない状況の中でもまっすぐに身を据え他人を尊重することを忘れずしっかりと社会に立っていきたいという願いを込めました。</p>
								<figure class="about-logo__item__figure">
									<img src="<?= $this_img_path; ?>logo_1.webp" alt="" decoding="async">
								</figure>
							</section>
							<section class="about-logo__item">
								<h3 class="about-logo__item__title">タイポグラフィ</h3>
								<p class="about-logo__item__txt c-txt-lg3 c-crop">ベースとなる書体「TRAJAN SANS」は、ローマにあるトラヤヌス帝の円柱の台座（紀元前1世紀）に刻まれた碑文を元に作字。古くから愛される書体を用いることで、トレンドに左右されることなく、長く愛される会社でいたいという願いを込めました。</p>
							</section>
							<section class="about-logo__item">
								<h3 class="about-logo__item__title">ブランドカラー</h3>
								<p class="about-logo__item__txt c-txt-lg3 c-crop">アルジュナのミッションである「クロコに徹する」になぞらえ黒を基調としたモノトーンの2色で展開しています。</p>
								<figure class="about-logo__item__figure">
									<img src="<?= $this_img_path; ?>logo_2.webp" alt="" decoding="async">
								</figure>
							</section>
							<p class="about-logo__button p-button -large -black">
								<a href="" target="_blank" rel="noopener noreferrer">
									<span class="p-button__en">ARJUNA LOGO guideline</span>
								</a>
							</p>
						</div>
						<figure class="about-logo__fex__figure">
							<ul>
								<li>
									<img src="<?= $this_img_path; ?>logo_1.webp" alt="" decoding="async">
								</li>
								<li>
									<img src="<?= $this_img_path; ?>logo_2.webp" alt="" decoding="async">
								</li>
							</ul>
						</figure>
					</div>
				</div>
			</section>
			<!-- /about-logo-->
			<!-- about-info-->
			<section class="about-info">
				<div class="c-inner-max">
					<header>
						<div class="c-title5 js-trigger js-fadeups">
							<p class="c-title5__en">co.info</p>
							<h2 class="c-title5__ja">会社概要</h2>
						</div>
					</header>
					<div class="about-info__table c-table">
						<div>
							<dl>
								<dt class="c-crop">社名</dt>
								<dd class="c-crop">株式会社アルジュナ</dd>
							</dl>
						</div>
						<div>
							<dl>
								<dt class="c-crop">代表</dt>
								<dd class="c-crop">
									代表取締役　笹田健一<br>
									取締役　亀井樹世
								</dd>
							</dl>
						</div>
						<div>
							<dl>
								<dt class="c-crop">所在地／TEL</dt>
								<dd class="c-crop">
									長崎オフィス<br>
									<span class="c-table__line-height">
										〒850-0033長崎県長崎市万才町2-7松本ビル202<br>
										095-801-0780
									</span>
									<br>
									福岡オフィス<br>
									<span class="c-table__line-height">
										〒810-0074<br>
										福岡県福岡市中央区大手門3丁目12-12 BLDG64 3F<br>
										050-3623-2865
									</span>
								</dd>
							</dl>
						</div>
						<div>
							<dl>
								<dt class="c-crop">設立</dt>
								<dd class="c-crop">2008年 11 月 1 日設立 / 2019年 10 月法人化</dd>
							</dl>
						</div>
						<div>
							<dl>
								<dt class="c-crop">業務内容</dt>
								<dd class="c-crop">
									企業 PR、販売促進ツールの企画制作<br>
									広告制作 (フライヤー、パンフレット、雑誌、ポスター、映像等)<br>
									VI / CI /企業ブランディング<br>
									商品パッケージデザイン<br>
									商品企画・開発<br>
									ウェブサイト制作…等
								</dd>
							</dl>
						</div>
					</div>
				</div>
			</section>
			<!-- /about-info-->
			<!-- about-prize-->
			<section class="about-prize">
				<div class="c-inner-max">
					<header>
						<div class="c-title5 js-trigger js-fadeups">
							<p class="c-title5__en">PRIZE</p>
							<h2 class="c-title5__ja">受賞歴</h2>
						</div>
					</header>
					<div class="about-prize__table c-table">
						<div>
							<dl>
								<dt class="c-crop">2015年</dt>
								<dd class="c-crop">長崎デザインアワード入選</dd>
							</dl>
						</div>
						<div>
							<dl>
								<dt class="c-crop">2017年</dt>
								<dd class="c-crop">経済産業庁北海道パッケージデザインコンテストグランプリ</dd>
							</dl>
						</div>
						<div>
							<dl>
								<dt class="c-crop">2018年</dt>
								<dd class="c-crop">K-ADCアワード ベストナイン賞</dd>
							</dl>
						</div>
						<div>
							<dl>
								<dt class="c-crop">2018年</dt>
								<dd class="c-crop">おいしい東北パッケージデザイン展入選</dd>
							</dl>
						</div>
						<div>
							<dl>
								<dt class="c-crop">2019年</dt>
								<dd class="c-crop">長崎デザインアワード審査員特別賞</dd>
							</dl>
						</div>
						<div>
							<dl>
								<dt class="c-crop">2020年</dt>
								<dd class="c-crop">長崎デザインアワード金賞</dd>
							</dl>
						</div>
						<div>
							<dl>
								<dt class="c-crop">2021年</dt>
								<dd class="c-crop">長崎デザインアワード入選</dd>
							</dl>
						</div>
						<div>
							<dl>
								<dt class="c-crop">2022年</dt>
								<dd class="c-crop">長崎デザインアワード銀賞/入選</dd>
							</dl>
						</div>
						<div>
							<dl>
								<dt class="c-crop">2023年</dt>
								<dd class="c-crop">日本タイポグラフィ年鑑入選</dd>
							</dl>
						</div>
						<div>
							<dl>
								<dt class="c-crop">2023年</dt>
								<dd class="c-crop">K-ADCアワード ブランディング部門大賞</dd>
							</dl>
						</div>
						<div>
							<dl>
								<dt class="c-crop">2024年</dt>
								<dd class="c-crop">日本タイポグラフィ年鑑入選</dd>
							</dl>
						</div>
					</div>
					<p class="about-prize__button -open p-button -regular -black">
						<button type="button">
							<span class="p-button__en">View More</span>
							<i class="c-icon c-arrow"></i>
						</button>
					</p>
					<p class="about-prize__button -close p-button -regular -black">
						<button type="button">
							<i class="c-icon c-arrow u-reverse"></i>
							<span class="p-button__en">close</span>
						</button>
					</p>
				</div>
			</section>
			<!-- /about-prize-->
			<!-- about-staff-->
			<section class="about-staff">
				<div class="c-inner-max">
					<header>
						<div class="c-title5 js-trigger js-fadeups">
							<p class="c-title5__en">STAFF</p>
							<h2 class="c-title5__ja">スタッフ紹介</h2>
						</div>
					</header>
					<figure class="about-staff__figure">
						<img src="<?= $this_img_path; ?>staff_figure.webp" alt="" decoding="async">
					</figure>
					<p class="about-staff__button p-button -regular -black">
						<a href="<?= $root; ?>staff/">
							<span class="p-button__en">read more</span>
							<i class="c-icon c-arrow"></i>
						</a>
					</p>
				</div>
			</section>
			<!-- /about-staff-->
			<!-- about-press-->
			<section class="about-press">
				<div class="c-inner-max">
					<header class="about-press__header">
						<div class="c-title5 js-trigger js-fadeups">
							<p class="c-title5__en">PRESS</p>
							<h2 class="c-title5__ja">メディア掲載</h2>
						</div>
					</header>
					<div class="about-press__carousel p-card4-carousel">
						<div class="swiper-wrapper">
							<!-- p-card4-->
							<article class="p-card4 -small swiper-slide">
								<figure class="c-aspect -square c-bg2">
									<img class="c-objectfit -cover" src="https://placehold.jp/752x752.png" alt="" decoding="async">
								</figure>
								<p class="p-card4__company">MDN出版社</p>
								<h2 class="p-card4__title c-crop">デザイナーズファイル2023</h2>
								<p class="p-button -regular2 -black">
									<a href="" target="_blank" rel="noopener noreferrer">
										<span class="p-button__en">read more</span>
										<i class="c-icon c-arrow"></i>
										<i class="c-icon c-arrow -small"></i>
									</a>
								</p>
							</article>
							<!-- /p-card4-->
							<!-- p-card4-->
							<article class="p-card4 -small swiper-slide">
								<figure class="c-aspect -square c-bg2">
									<img class="c-objectfit -cover" src="https://placehold.jp/752x752.png" alt="" decoding="async">
								</figure>
								<p class="p-card4__company">MDN出版社</p>
								<h2 class="p-card4__title c-crop">デザイナーズファイル2023</h2>
								<p class="p-button -regular2 -black">
									<a href="" target="_blank" rel="noopener noreferrer">
										<span class="p-button__en">read more</span>
										<i class="c-icon c-arrow"></i>
										<i class="c-icon c-arrow -small"></i>
									</a>
								</p>
							</article>
							<!-- /p-card4-->
							<!-- p-card4-->
							<article class="p-card4 -small swiper-slide">
								<figure class="c-aspect -square c-bg2">
									<img class="c-objectfit -cover" src="https://placehold.jp/752x752.png" alt="" decoding="async">
								</figure>
								<p class="p-card4__company">MDN出版社</p>
								<h2 class="p-card4__title c-crop">デザイナーズファイル2023</h2>
								<p class="p-button -regular2 -black">
									<a href="" target="_blank" rel="noopener noreferrer">
										<span class="p-button__en">read more</span>
										<i class="c-icon c-arrow"></i>
										<i class="c-icon c-arrow -small"></i>
									</a>
								</p>
							</article>
							<!-- /p-card4-->
							<!-- p-card4-->
							<article class="p-card4 -small swiper-slide">
								<figure class="c-aspect -square c-bg2">
									<img class="c-objectfit -cover" src="https://placehold.jp/752x752.png" alt="" decoding="async">
								</figure>
								<p class="p-card4__company">MDN出版社</p>
								<h2 class="p-card4__title c-crop">デザイナーズファイル2023</h2>
								<p class="p-button -regular2 -black">
									<a href="" target="_blank" rel="noopener noreferrer">
										<span class="p-button__en">read more</span>
										<i class="c-icon c-arrow"></i>
										<i class="c-icon c-arrow -small"></i>
									</a>
								</p>
							</article>
							<!-- /p-card4-->
							<!-- p-card4-->
							<article class="p-card4 -small swiper-slide">
								<figure class="c-aspect -square c-bg2">
									<img class="c-objectfit -cover" src="https://placehold.jp/752x752.png" alt="" decoding="async">
								</figure>
								<p class="p-card4__company">MDN出版社</p>
								<h2 class="p-card4__title c-crop">デザイナーズファイル2023</h2>
								<p class="p-button -regular2 -black">
									<a href="" target="_blank" rel="noopener noreferrer">
										<span class="p-button__en">read more</span>
										<i class="c-icon c-arrow"></i>
										<i class="c-icon c-arrow -small"></i>
									</a>
								</p>
							</article>
							<!-- /p-card4-->
							<!-- p-card4-->
							<article class="p-card4 -small swiper-slide">
								<figure class="c-aspect -square c-bg2">
									<img class="c-objectfit -cover" src="https://placehold.jp/752x752.png" alt="" decoding="async">
								</figure>
								<p class="p-card4__company">MDN出版社</p>
								<h2 class="p-card4__title c-crop">デザイナーズファイル2023</h2>
								<p class="p-button -regular2 -black">
									<a href="" target="_blank" rel="noopener noreferrer">
										<span class="p-button__en">read more</span>
										<i class="c-icon c-arrow"></i>
										<i class="c-icon c-arrow -small"></i>
									</a>
								</p>
							</article>
							<!-- /p-card4-->
							<!-- p-card4-->
							<article class="p-card4 -small swiper-slide">
								<figure class="c-aspect -square c-bg2">
									<img class="c-objectfit -cover" src="https://placehold.jp/752x752.png" alt="" decoding="async">
								</figure>
								<p class="p-card4__company">MDN出版社</p>
								<h2 class="p-card4__title c-crop">デザイナーズファイル2023</h2>
								<p class="p-button -regular2 -black">
									<a href="" target="_blank" rel="noopener noreferrer">
										<span class="p-button__en">read more</span>
										<i class="c-icon c-arrow"></i>
										<i class="c-icon c-arrow -small"></i>
									</a>
								</p>
							</article>
							<!-- /p-card4-->
							<!-- p-card4-->
							<article class="p-card4 -small swiper-slide">
								<figure class="c-aspect -square c-bg2">
									<img class="c-objectfit -cover" src="https://placehold.jp/752x752.png" alt="" decoding="async">
								</figure>
								<p class="p-card4__company">MDN出版社</p>
								<h2 class="p-card4__title c-crop">デザイナーズファイル2023</h2>
								<p class="p-button -regular2 -black">
									<a href="" target="_blank" rel="noopener noreferrer">
										<span class="p-button__en">read more</span>
										<i class="c-icon c-arrow"></i>
										<i class="c-icon c-arrow -small"></i>
									</a>
								</p>
							</article>
							<!-- /p-card4-->
						</div>
					</div>
					<p class="about-press__button p-button -regular -black">
						<a href="<?= $root; ?>press/">
							<span class="p-button__en">VIEW more</span>
							<i class="c-icon c-arrow"></i>
						</a>
					</p>
				</div>
			</section>
			<!-- /about-press-->
		</main>
		<?php require_once($web_root.$root.'include/layout_contact.php'); ?>
		<?php require_once($web_root.$root.'include/layout_footer.php'); ?>
	</body>
</html>
