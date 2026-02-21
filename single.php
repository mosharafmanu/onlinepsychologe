<?php
/**
 * Template for displaying single posts.
 *
 * Drives the page via the ACF "cms" flexible_content field.
 * Each active row resolves to template-parts/sections/{layout-name}.php.
 * Falls back to the_content() for posts that have no cms rows.
 *
 * Mirrors the Astra parent structure so that sidebar, primary hooks,
 * header and footer all continue to work as expected.
 *
 * @package Psychologe Haegermann
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

if ( astra_page_layout() === 'left-sidebar' ) :
	get_sidebar();
endif;
?>

<div id="primary" <?php astra_primary_class(); ?>>

	<?php astra_primary_content_top(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php if ( have_rows( 'cms' ) ) : ?>

			<?php while ( have_rows( 'cms' ) ) : the_row(); ?>
				<?php get_template_part( 'template-parts/sections/' . get_row_layout() ); ?>
			<?php endwhile; ?>

		<?php else : ?>

			<?php the_content(); ?>

		<?php endif; ?>

	<?php endwhile; ?>

	<?php astra_primary_content_bottom(); ?>

</div><!-- #primary -->

<?php if ( astra_page_layout() === 'right-sidebar' ) : ?>
	<?php get_sidebar(); ?>
<?php endif; ?>

<?php get_footer(); ?>

