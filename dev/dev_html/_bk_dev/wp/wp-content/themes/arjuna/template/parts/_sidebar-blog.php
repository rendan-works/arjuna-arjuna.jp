<?php
	$cat_page_slug = get_query_var('category_name');

	$post_dir  = 'blog';
	$post_type = 'post';
	$taxonomy  = 'category';

	if( is_date() || is_category() || is_tax() ){
		$page_archive_name = wp_get_document_title();
	} else{
		$page_archive_name = '選択してください';
	}
 ?>
<aside>
	<div class="p-post-sidebar__items">
		<h2>カテゴリ</h2>
		<ul class="p-post-sidebar__cat-list">
			<?php
				$args = array(
					'orderby'    => 'name',
					'hide_empty' => 0,
					'pad_counts' => 0,
					'parent'     => 0,
				);
				$terms = get_terms( $taxonomy , $args );

				foreach ( $terms as $term ) :
					$term_slug = $term->slug;
					$term_link = get_term_link($term);
					$term_name = $term->name;
					$term_num  = $term->count;

					if( $term_num == 0 ) $term_num = '';

					if( $page_category_name == $term_name ){
						$checked = 'checked';
					} else{
						$checked = '';
					}

					$inputId = 'term-' . $term_slug;
			?>
			<li>
				<div class="c-radio -blue">
					<input id="<?= $inputId; ?>" name="term" type="radio" value="<?= $term_link; ?>" onclick="location.href=this.value" <?= $checked; ?>>
					<label for="<?= $inputId; ?>">
						<span class="c-radio__icon -large"></span>
						<span class="c-radio__text -large"><?= $term_name; ?></span>
					</label>
				</div>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="p-post-sidebar__items">
		<h2>アーカイブ</h2>
		<?php
			$args = array(
				'post_type'      => $post_type,
				'posts_per_page' => -1
			);
			$archive_query = new WP_Query( $args );
			while ( $archive_query->have_posts() ) {
				$archive_query->the_post();
				$archive_list[ get_the_time( 'Y/n', $post->ID ) ][] = $post->post_title;
			}
			wp_reset_postdata();

			if( $archive_list ) :
		?>
		<select name="select_archives" onchange="location.href=value;">
			<option value="<?= home_url() . '/' . $post_dir . '/'; ?>" data-text="アーカイブ">選択してください</option>
			<?php foreach( $archive_list as $year_month => $archive ) : ?>
				<?php
					$year_month_arr = explode( '/', $year_month );
					$format = $year_month_arr[0] . '年' . $year_month_arr[1] . '月';

					if( $page_archive_name == $format ){
						$selected = 'selected';
					} else{
						$selected = '';
					}
				?>
				<option value="<?= home_url() . '/' . $post_dir . '/date/'. $year_month ?>" <?= $selected; ?>>
					<?= $format; ?>
				</option>
			<?php endforeach; ?>
		</select>
		<?php endif; ?>
	</div>
</aside>
