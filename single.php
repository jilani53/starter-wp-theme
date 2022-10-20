<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package starter
 */

get_header();

$meta = get_post_meta( $post->ID );
$select_layout = ( isset( $meta['select_layout'][0] ) && '' !== $meta['select_layout'][0] ) ? $meta['select_layout'][0] : 1;

if( $select_layout == 1 ) { // Post without sidebar 
?>

<div class="starter-main-body">
	<div class="container">
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', get_post_type() );

					the_post_navigation(
						array(
							'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'starter' ) . '</span> <span class="nav-title">%title</span>',
							'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'starter' ) . '</span> <span class="nav-title">%title</span>',
						)
					);

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
			</div>

			<?php echo do_shortcode( '[blog-related-post title="Related Items" max_post="6" max_char="35"]' ); ?>
			
		</div>
	</div>
</div>

<?php } else if( $select_layout == 2 ) { // Post with sidebar  ?>

<div class="starter-main-body">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', get_post_type() );

					the_post_navigation(
						array(
							'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'starter' ) . '</span> <span class="nav-title">%title</span>',
							'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'starter' ) . '</span> <span class="nav-title">%title</span>',
						)
					);

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>
			</div>
			<div class="col-md-4">
				<div class="starter-sidebar">
					<?php get_sidebar(); ?>
				</div>
			</div>
			
			<?php echo do_shortcode( '[blog-related-post title="Related Items" max_post="6" max_char="35"]' ); ?>			

		</div>
	</div>
</div>

<?php
}
get_footer();
