<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package starter
 */

get_header();
?>

<header class="page-header starter-page-header">
	<div class="container">
		<div class="row">			
			<div class="col-md-12">
				<h1 class="page-title">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="archive-description">', '</div>' );
					?>
				</h1>
			</div>
		</div>
	</div>
</header><!-- .page-header -->

<div class="starter-main-body">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
			<?php if ( have_posts() ) : 
				
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					get_template_part( 'template-parts/content', get_post_type() );

				endwhile;

				if( paginate_links() ): ?>					
					<div class="starter-pagination">
						<ul class="pagination">
							<li>
							<?php
					
							$big = 999999999; // need an unlikely integer

							echo paginate_links(
								array (
								'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
								'format'    => '?paged=%#%',
								'current'   => max(1, get_query_var('paged')),
								'total'     => $wp_query->max_num_pages,
								'type'      => '',
								'prev_text' => '<i class="las la-arrow-left"></i>',
								'next_text' => '<i class="las la-arrow-right"></i>',
							));

							?>
							</li>
						</ul>
					</div>
				<?php

				endif; // End pagina checking

				else :

				get_template_part( 'template-parts/content', 'none' );

				endif;
				?>
			</div>
			<div class="col-md-4">
				<div class="starter-sidebar">
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();