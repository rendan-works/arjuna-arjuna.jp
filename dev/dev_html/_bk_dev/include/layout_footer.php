<!-- l-footer-->
<footer class="l-footer">
	<div class="l-footer__inner c-inner-max">
		<div class="l-footer__profile">
			<p class="l-footer__logo">
				<a href="<?= $root; ?>">
					<img class="js-svg" src="<?= $img_path; ?>common/logo.svg" alt="デザインアルジュナ" decoding="async" />
				</a>
			</p>
			<p class="l-footer__service">
				<span class="c-crop">
					Branding Design<br>
					Graphic Design<br>
					Web Design<br>
					Product Development</span>
			</p>
			<p class="l-footer__address c-crop">
				株式会社アルジュナ<br>
				長崎県長崎市万才町<span class="u-font-sans-serif">2-7</span>松本ビル<span class="u-font-sans-serif">202</span>
			</p>
		</div>
		<nav class="l-footer__nav">
			<ul class="l-footer__nav__en">
				<li>
					<a href="<?= $root; ?>about/">About us</a>
				</li>
				<li>
					<a href="<?= $root; ?>branding/">Branding</a>
				</li>
				<li>
					<a href="<?= $root; ?>works/">Works</a>
				</li>
				<li>
					<a href="<?= $root; ?>blog/">Blog</a>
				</li>
				<li>
					<a href="<?= $root; ?>contact/">Contact</a>
				</li>
			</ul>
			<div class="l-footer__nav__group">
				<p class="l-footer__nav__parent">
					<a href="<?= $root; ?>works/">サービス案内</a>
				</p>
				<ul class="l-footer__nav__children">
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
			<div class="l-footer__nav__group">
				<p class="l-footer__nav__parent">
					<a href="<?= $root; ?>works/">制作実績</a>
				</p>
				<ul class="l-footer__nav__children">
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
		</nav>
	</div>
</footer>
<!-- /l-footer-->
