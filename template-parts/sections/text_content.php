<?php
/**
 * Flexible Content Layout: Text Content
 *
 * ACF sub-fields:
 *   heading – text    (optional, renders with left-border accent)
 *   content – wysiwyg
 *
 * @package Psychologe Haegermann
 */

$heading = get_sub_field( 'heading' );
$content = get_sub_field( 'content' );

if ( ! $heading && ! $content ) {
	return;
}
?>

<section class="text-content">
	<div class="text-content__inner">

		<?php if ( $heading ) : ?>
			<h2 class="text-content__heading">
				<?php echo esc_html( $heading ); ?>
			</h2>
		<?php endif; ?>

		<?php if ( $content ) : ?>
			<div class="text-content__body">
				<?php echo wp_kses_post( $content ); ?>
			</div>
		<?php endif; ?>

	</div><!-- .text-content__inner -->
</section><!-- .text-content -->

