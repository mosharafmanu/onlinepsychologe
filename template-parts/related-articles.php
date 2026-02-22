<?php
/**
 * Related Articles Section
 *
 * Displayed at the bottom of single posts.
 * Queries up to 3 posts from the same categories as the current post,
 * ordered randomly, excluding the current post.
 *
 * @package Psychologe Haegermann
 */

if ( ! is_singular( 'post' ) ) {
	return;
}

$current_id = get_the_ID();
$categories = wp_get_post_categories( $current_id );

$query = new WP_Query( [
	'post_type'           => 'post',
	'posts_per_page'      => 3,
	'post__not_in'        => [ $current_id ],
	'category__in'        => $categories ?: [],
	'orderby'             => 'rand',
	'ignore_sticky_posts' => 1,
] );

if ( ! $query->have_posts() ) {
	return;
}
?>

<section class="related-articles">
	<div class="related-articles__inner">

		<div class="related-articles__header">
			<p class="related-articles__eyebrow">WEITERLESEN</p>
			<h2 class="related-articles__heading">Das könnte Sie auch interessieren</h2>
		</div>

		<div class="related-articles__grid">

			<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<?php
				$card_id      = get_the_ID();
				$card_cats    = get_the_category();
				$card_title   = get_the_title();
				$card_url     = get_permalink();
				$card_excerpt = get_the_excerpt();
				$card_excerpt = wp_trim_words( $card_excerpt, 10, '.' );
				$thumb_id     = get_post_thumbnail_id( $card_id );

				// Reading time from ACF flexible content, fallback to word-count estimate.
				$read_time = null;
				$cms_rows  = get_field( 'cms', $card_id );
				if ( $cms_rows ) {
					foreach ( $cms_rows as $row ) {
						if ( 'single_post_hero' === ( $row['acf_fc_layout'] ?? '' ) && ! empty( $row['reading_time'] ) ) {
							$read_time = (int) $row['reading_time'];
							break;
						}
					}
				}
				if ( ! $read_time ) {
					$word_count = str_word_count( strip_tags( get_post_field( 'post_content', $card_id ) ) );
					$read_time  = max( 1, (int) round( $word_count / 200 ) );
				}
				?>
				<article class="related-articles__card">
					<a href="<?php echo esc_url( $card_url ); ?>" class="related-articles__card-link">

						<div class="related-articles__card-image">
							<?php if ( $thumb_id ) : ?>
								<?php echo wp_get_attachment_image( $thumb_id, 'medium_large', false, [
									'class' => 'related-articles__card-img',
									'alt'   => esc_attr( $card_title ),
								] ); ?>
							<?php else : ?>
								<div class="related-articles__card-img related-articles__card-img--placeholder"></div>
							<?php endif; ?>
						</div>

						<div class="related-articles__card-body">

							<?php if ( $card_cats ) : ?>
								<p class="related-articles__card-category">
									<?php echo esc_html( strtoupper( $card_cats[0]->name ) ); ?>
								</p>
							<?php endif; ?>

							<div class="relatedt-article-title-wrapper">
								<h3 class="related-articles__card-title">
									<?php echo esc_html( $card_title ); ?>
								</h3>
							</div>

							<?php if ( $card_excerpt ) : ?>
								<p class="related-articles__card-excerpt">
									<?php echo esc_html( $card_excerpt ); ?>
								</p>
							<?php endif; ?>

							<p class="related-articles__card-meta">
								<span>Artikel</span>
								<span class="related-articles__card-meta-sep" aria-hidden="true">&middot;</span>
								<span><?php echo esc_html( $read_time ); ?> Min.&nbsp;Lesezeit</span>
							</p>

						</div><!-- .related-articles__card-body -->

					</a><!-- .related-articles__card-link -->
				</article><!-- .related-articles__card -->

			<?php endwhile; ?>
			<?php wp_reset_postdata(); ?>

		</div><!-- .related-articles__grid -->

	</div><!-- .related-articles__inner -->
</section><!-- .related-articles -->

