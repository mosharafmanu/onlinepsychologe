<?php
/**
 * Flexible Content Layout: Single Post Hero
 *
 * ACF sub-fields used:
 *   heading_styled_word  – word in the title that gets italic emphasis
 *   reading_time         – reading time in minutes
 *   key_takeaways_title  – heading for the takeaways card
 *   key_takeaways        – repeater → item (textarea)
 */

// ── ACF fields ──────────────────────────────────────────────────────────────
$styled_word      = get_sub_field( 'heading_styled_word' );
$reading_time     = get_sub_field( 'reading_time' );
$takeaways_title  = get_sub_field( 'key_takeaways_title' ) ?: 'Das Wichtigste auf einen Blick';
$takeaways        = get_sub_field( 'key_takeaways' );

// ── Post data ────────────────────────────────────────────────────────────────
$post_title  = get_the_title();
$author_name = get_the_author();
$post_date   = get_the_date( 'F Y' );  // locale-aware, e.g. "Februar 2026"
$categories  = get_the_category();

// ── Build styled title: wrap the chosen word in <em> ────────────────────────
if ( $styled_word ) {
	$styled_title = str_replace(
		$styled_word,
		'<em class="single-post-hero__title-em">' . esc_html( $styled_word ) . '</em>',
		esc_html( $post_title )
	);
} else {
	$styled_title = esc_html( $post_title );
}
?>

<section class="single-post-hero">
	<div class="single-post-hero__inner">

		<!-- ── Left: content ── -->
		<div class="single-post-hero__content">

			<?php if ( $categories ) : ?>
				<span class="single-post-hero__category">
					<?php echo esc_html( strtoupper( $categories[0]->name ) ); ?>
				</span>
			<?php endif; ?>

			<h1 class="single-post-hero__title">
				<?php echo wp_kses( $styled_title, [ 'em' => [ 'class' => [] ] ] ); ?>
			</h1>

			<div class="single-post-hero__meta">

				<?php if ( $categories ) : ?>
					<span class="single-post-hero__meta-categories">
						<?php foreach ( $categories as $i => $cat ) : ?>
							<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>">
								<?php echo esc_html( strtoupper( $cat->name ) ); ?>
							</a><?php echo ( $i < count( $categories ) - 1 ) ? ', ' : ''; ?>
						<?php endforeach; ?>
					</span>
					<span class="single-post-hero__meta-sep" aria-hidden="true">&middot;</span>
				<?php endif; ?>

				<span class="single-post-hero__meta-author">
					Von <?php echo esc_html( $author_name ); ?>
				</span>

				<?php if ( $reading_time ) : ?>
					<span class="single-post-hero__meta-sep" aria-hidden="true">&middot;</span>
					<span class="single-post-hero__meta-reading-time">
						<?php echo esc_html( $reading_time ); ?> Min. Lesezeit
					</span>
				<?php endif; ?>

				<span class="single-post-hero__meta-sep" aria-hidden="true">&middot;</span>
				<span class="single-post-hero__meta-date">
					<?php echo esc_html( $post_date ); ?>
				</span>

			</div><!-- .single-post-hero__meta -->
		</div><!-- .single-post-hero__content -->

		<!-- ── Right: key takeaways card ── -->
		<?php if ( $takeaways ) : ?>
			<aside class="single-post-hero__takeaways" aria-label="Key Takeaways">
				<div class="single-post-hero__takeaways-card">

					<div class="single-post-hero__takeaways-header">
						<span class="single-post-hero__takeaways-icon" aria-hidden="true">&#10022;</span>
						<span class="single-post-hero__takeaways-title">
							<?php echo esc_html( strtoupper( $takeaways_title ) ); ?>
						</span>
					</div>

					<ul class="single-post-hero__takeaways-list">
						<?php foreach ( $takeaways as $row ) : ?>
							<li class="single-post-hero__takeaways-item">
								<span><svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M5 12.5L10.1375 17.6375C10.5837 18.0837 11.3266 18.0101 11.6766 17.4851L20 5" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
								</svg></span>
								<?php echo wp_kses_post( $row['item'] ); ?>
							</li>
						<?php endforeach; ?>
					</ul>

				</div><!-- .single-post-hero__takeaways-card -->
			</aside><!-- .single-post-hero__takeaways -->
		<?php endif; ?>

	</div><!-- .single-post-hero__inner -->
</section><!-- .single-post-hero -->
