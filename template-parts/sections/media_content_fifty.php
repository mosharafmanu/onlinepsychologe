<?php
/**
 * Flexible Content Layout: Media Content Fifty
 *
 * 50 / 50 grid: image on one side, heading + rich text on the other.
 *
 * ACF sub-fields:
 *   image_position – select  ('left' | 'right')
 *   heading        – text
 *   content        – wysiwyg
 *   image          – image (array)
 *   image_caption  – text
 *
 * @package Psychologe Haegermann
 */

$image_position = get_sub_field( 'image_position' ) ?: 'left';
$heading        = get_sub_field( 'heading' );
$content        = get_sub_field( 'content' );
$image          = get_sub_field( 'image' );
$image_caption  = get_sub_field( 'image_caption' );

if ( ! $image && ! $heading && ! $content ) {
	return;
}

$modifier = 'media-content-fifty--image-' . esc_attr( $image_position );
?>

<section class="media-content-fifty <?php echo $modifier; ?>">
	<div class="media-content-fifty__inner">

		<!-- Image block -->
		<?php if ( $image ) : ?>
			<div class="media-content-fifty-left">
				<figure class="media-content-fifty__image">
					<img
						src="<?php echo esc_url( $image['url'] ); ?>"
						alt="<?php echo esc_attr( $image['alt'] ); ?>"
						width="<?php echo esc_attr( $image['width'] ); ?>"
						height="<?php echo esc_attr( $image['height'] ); ?>"
					>
				</figure>
				<?php if ( $image_caption ) : ?>
					<figcaption class="media-content-fifty__caption">
						<?php echo esc_html( $image_caption ); ?>
					</figcaption>
				<?php endif; ?>
			</div>
		<?php else : ?>
			<div class="media-content-fifty__image media-content-fifty__image--empty"></div>
		<?php endif; ?>

		<!-- Text block -->
		<div class="media-content-fifty__text">

			<?php if ( $heading ) : ?>
				<h2 class="media-content-fifty__heading">
					<?php echo esc_html( $heading ); ?>
				</h2>
			<?php endif; ?>

			<?php if ( $content ) : ?>
				<div class="media-content-fifty__body">
					<?php echo wp_kses_post( $content ); ?>
				</div>
			<?php endif; ?>

		</div><!-- .media-content-fifty__text -->

	</div><!-- .media-content-fifty__inner -->
</section><!-- .media-content-fifty -->

