<!-- l-header-->
<header class="l-header">
	<!-- l-header__inner-->
	<div class="l-header__inner">
		<?php if( $web_path == $root ): ?>
		<h1 class="l-header__logo">
			<a href="<?= $root; ?>">
				<img class="js-svg" src="<?= $img_path; ?>common/logo.svg" alt="デザインアルジュナ" decoding="async" />
			</a>
		</h1>
		<?php else: ?>
		<p class="l-header__logo">
			<a href="<?= $root; ?>">
				<img class="js-svg" src="<?= $img_path; ?>common/logo.svg" alt="デザインアルジュナ" decoding="async" />
			</a>
		</p>
		<?php endif; ?>
		<!-- l-header__nav-->
		<nav class="l-header__nav">
			<ul>
				<li>
					<a class="c-anchor-lineIn -type-current" href="<?= $root; ?>about/">
						<span class="c-ls">About us</span>
					</a>
				</li>
				<li>
					<a class="c-anchor-lineIn -type-current" href="<?= $root; ?>branding/">
						<span class="c-ls">Branding</span>
					</a>
				</li>
				<li>
					<a class="c-anchor-lineIn -type-current" href="<?= $root; ?>works/">
						<span class="c-ls">Works</span>
					</a>
				</li>
				<li>
					<a class="c-anchor-lineIn -type-current" href="<?= $root; ?>blog/">
						<span class="c-ls">Blog</span>
					</a>
				</li>
				<li>
					<a class="c-anchor-lineIn -type-current" href="<?= $root; ?>contact/">
						<span class="c-ls">Contact</span>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /l-header__nav-->
	</div>
	<!-- /l-header__inner-->
	<!-- l-header__button-->
	<button class="l-header__button" type="button" aria-label="メインメニューの切替">
		<span></span>
		<span></span>
	</button>
	<!-- /l-header__button-->
</header>
<!-- /l-header-->
<!-- l-sitemap-->
<nav class="l-sitemap">
	<div class="l-sitemap__inner c-inner-max -contents-lg">
		<header class="l-sitemap__header">
			<p class="l-sitemap__logo">
				<img class="js-svg" src="<?= $img_path; ?>common/logo.svg" alt="デザインアルジュナ" decoding="async" />
			</p>
			<p class="l-sitemap__service">
				<span class="c-crop">
					Branding Design<br>
					Graphic Design<br>
					Web Design<br>
					Product Development</span>
			</p>
		</header>
		<div class="l-sitemap__main">
			<ul>
				<li>
					<a class="l-sitemap__parent" href="<?= $root; ?>about/">
						<span class="l-sitemap__main__en">
							<span>About us</span>
						</span>
						<span class="l-sitemap__main__ja">私達について</span>
					</a>
					<ul class="l-sitemap__children">
						<li>
							<a href="<?= $root; ?>staff/">
								<span class="l-sitemap__main__en">
									<span>Staff</span>
								</span>
								<span class="l-sitemap__main__ja">スタッフ紹介</span>
							</a>
						</li>
						<li>
							<a href="<?= $root; ?>press/">
								<span class="l-sitemap__main__en">
									<span>Press</span>
								</span>
								<span class="l-sitemap__main__ja">メディア掲載</span>
							</a>
						</li>
					</ul>
				</li>
				<li>
					<a class="l-sitemap__parent" href="<?= $root; ?>branding/">
						<span class="l-sitemap__main__en">
							<span>Branding</span>
						</span>
						<span class="l-sitemap__main__ja">ブランディング</span>
					</a>
				</li>
			</ul>
			<ul>
				<li>
					<a class="l-sitemap__parent" href="<?= $root; ?>works/">
						<span class="l-sitemap__main__en">
							<span>Works</span>
						</span>
						<span class="l-sitemap__main__ja">製作実績</span>
					</a>
					<ul class="l-sitemap__children2">
						<li class="js-accordion-click-mqDown-lg">
							<p class="l-sitemap__children2__title">
								<button class="js-accordion__switch" type="button">
									<span>[種別]</span>
									<i class="c-plus"></i>
								</button>
							</p>
							<div class="l-sitemap__children2__list js-accordion__panel">
								<ul>
									<?php
										$args = array(
											'orderby'    => 'name',
											'hide_empty' => 0,
											'pad_counts' => 0,
											'parent'     => 0,
										);
										$terms = get_terms( 'works_category' , $args );

										foreach ( $terms as $term ) :
											$term_link = get_term_link($term);
											$term_name = $term->name;
									?>
									<li>
										<a href="<?= $term_link; ?>">
											<?= $term_name; ?>
										</a>
									</li>
									<?php endforeach; ?>
								</ul>
							</div>
						</li>
						<li class="js-accordion-click-mqDown-lg">
							<p class="l-sitemap__children2__title">
								<button class="js-accordion__switch" type="button">
									<span>[業種]</span>
									<i class="c-plus"></i>
								</button>
							</p>
							<div class="l-sitemap__children2__list js-accordion__panel">
								<ul>
									<li>
										<a href="<?= $root; ?>works/">すべて</a>
									</li>
									<?php
										$args = array(
											'orderby'    => 'name',
											'hide_empty' => 0,
											'pad_counts' => 0,
											'parent'     => 0,
										);
										$terms = get_terms( 'works_industry' , $args );

										foreach ( $terms as $term ) :
											$term_link = get_term_link($term);
											$term_name = $term->name;
									?>
									<li>
										<a href="<?= $term_link; ?>">
											<?= $term_name; ?>
										</a>
									</li>
									<?php endforeach; ?>
								</ul>
							</div>
						</li>
					</ul>
				</li>
			</ul>
			<ul>
				<li>
					<a class="l-sitemap__parent" href="<?= $root; ?>blog/">
						<span class="l-sitemap__main__en">
							<span>Blog</span>
						</span>
						<span class="l-sitemap__main__ja">ブログ</span>
					</a>
				</li>
			</ul>
			<ul>
				<li>
					<a class="l-sitemap__parent" href="<?= $root; ?>contact/">
						<span class="l-sitemap__main__en">
							<span>Contact</span>
						</span>
						<span class="l-sitemap__main__ja">お問い合わせ</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
<!-- /l-sitemap-->
