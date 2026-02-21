<?php
/**
 * Flexible Content Layout: Pullquote
 *
 * ACF sub-fields:
 *   quote       – textarea  (required)
 *   attribution – text      (optional)
 *
 * @package Psychologe Haegermann
 */

$quote       = get_sub_field( 'quote' );
$attribution = get_sub_field( 'attribution' );

if ( ! $quote ) {
	return;
}
?>

<section class="pullquote">
	<div class="pullquote__inner">
		<blockquote class="pullquote__block">

			<p class="pullquote__text"><?php echo esc_html( $quote ); ?></p>

			<?php if ( $attribution ) : ?>
				<footer class="pullquote__attribution">
					<cite><?php echo esc_html( $attribution ); ?></cite>
				</footer>
			<?php endif; ?>

		</blockquote>
	</div><!-- .pullquote__inner -->
</section><!-- .pullquote -->

