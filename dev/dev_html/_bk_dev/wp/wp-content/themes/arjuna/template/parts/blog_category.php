<?php
	if( !is_single() ){
		$term_id = 0;
	}

	$args = array(
		'orderby'    => 'name',
		'hide_empty' => 0,
		'pad_counts' => 0,
		'parent'     => 0,
		'exclude'    => array( $term_id ),
	);
	$terms = get_terms( 'category' , $args );

	$card_terms       = array();
	$hashtag_terms    = array();
	$underscore_terms = array();

	foreach ( $terms as $term ){
		$term_name      = $term->name;
		$first_term_txt = substr($term_name, 0, 1);

		if ($first_term_txt === '#'){
			array_push( $hashtag_terms , $term );
		} elseif($first_term_txt === '_'){
			array_push( $underscore_terms , $term );
		} else{
			array_push( $card_terms , $term );
		}
	}
?>
<div class="p-category">
	<ul class="p-category__main">
		<?php foreach ( $card_terms as $term ): ?>
		<?php
			$term_id   = $term->term_id;
			$term_link = get_term_link($term);
			$term_name = str_replace('\\', '<br>', $term->name );

			$category_name         = SCF::get_term_meta( $term_id, 'category', 'category_name' );
			$category_en           = SCF::get_term_meta( $term_id, 'category', 'category_en' );
			$category_post         = SCF::get_term_meta( $term_id, 'category', 'category_post' );
			$category_degree_group = SCF::get_term_meta( $term_id, 'category', 'category_degree_group' );
			$category_thumbnail    = SCF::get_term_meta( $term_id, 'category', 'category_thumbnail' );
			$category_content      = SCF::get_term_meta( $term_id, 'category', 'category_content' );

			if( $category_thumbnail ){
				$category_thumbnail_file = wp_get_attachment_image_src($category_thumbnail,'160_160_thumbnail')[0];
			} else{
				$category_thumbnail_file = '';
			}
		 ?>
		<li class="p-category__card c-radius-rg-mqUp-lg">
			<div class="p-category__card__another">
				<?php if( $category_thumbnail_file ): ?>
				<figure class="p-category__card__figure c-aspect -square c-radius-circle">
					<img class="c-objectfit -cover" src="<?= $category_thumbnail_file; ?>" alt="" decoding="async">
				</figure>
				<?php endif; ?>
				<div class="p-category__card__profile">
					<?php if( $category_name ): ?>
					<p class="p-category__card__name">
						<?= $category_name; ?>
					</p>
					<?php endif; ?>
					<?php if ( $category_en ): ?>
					<p class="p-category__card__kana">
						<?= $category_en; ?>
					</p>
					<?php endif; ?>
					<?php if( $category_post ): ?>
					<p class="p-category__card__post">
						<?= $category_post; ?>
					</p>
					<?php endif; ?>
					<?php if( $category_degree_group ): ?>
						<?php foreach ( $category_degree_group as $fields ): ?>
						<p class="p-category__card__degree">
							<?= $fields['category_degree_cell']; ?>
						</p>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
			<div class="p-category__card__accordion js-accordion-click">
				<h2 class="p-category__card__title c-crop">
					<?= $term_name; ?>
				</h2>
				<button class="p-category__card__plus js-accordion__switch" type="button">
					<i class="c-plus"></i>
				</button>
				<div class="p-category__card__outline js-accordion__panel">
					<?php if( $category_content ): ?>
					<p class="c-txt-xl c-crop">
						<?= nl2br( $category_content ); ?>
					</p>
					<?php endif; ?>
				</div>
			</div>
			<p class="p-category__card__button p-button3">
				<a href="<?= $term_link; ?>#target-archive">記事一覧へ&nbsp;<span class="c-arrow3">＞</span>
				</a>
			</p>
		</li>
		<?php endforeach; ?>

	</ul>
	<ul class="p-category__sub">
		<?php foreach ( $hashtag_terms as $term ): ?>
		<?php
			$term_link = get_term_link($term);
			$term_name = $term->name;
		 ?>
		<li>
			<a class="c-radius-max" href="<?= $term_link; ?>#target-archive">
				<?= $term_name; ?>
			</a>
		</li>
		<?php endforeach; ?>
	</ul>
</div>

