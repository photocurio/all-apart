<?php
/**
 * The search results template.
 *
 * @package all-apart
 */

get_header(); ?>

<main id="site-content" role="main">	
	<div class="posts section-inner">
	<?php
		$search_results_total = $wp_query->found_posts;
		$heading              = 0 === $search_results_total ? 'h2' : 'h4';
		$search_context       = 1 === $search_results_total ? 'result was found' : 'results were found';
		printf(
			'<%2$s class="search-results-total-h4"><span id="search-results-total">%1$d</span> %3$s</%2$s>',
			esc_html( $search_results_total ),
			esc_html( $heading ),
			esc_html( $search_context )
		);
		if ( have_posts() ) :
			/*
			 * @hooked chaplin_output_previous_posts_link - 10.
			 */
			do_action( 'chaplin_posts_start' );
			$post_grid_column_classes = chaplin_get_post_grid_column_classes();
			?>
			<div class="posts-grid grid load-more-target <?php echo esc_attr( $post_grid_column_classes ); ?>">
				<?php
				// Calculate the current offset.
				$iteration = intval( $wp_query->get( 'posts_per_page' ) ) * intval( $wp_query->get( 'paged' ) );
				while ( have_posts() ) :
					the_post();
					$iteration++;
					/**
					 * Fires before output of a grid item in the posts loop.
					 *
					 * Allows output of custom elements within the posts loop, like banners.
					 * To add markup spanning the entire width of the posts grid, wrap it in the following element:
					 * <div class="grid-item col-1">[Your content]</div>
					 *
					 * @param int   $post_id    Post ID.
					 * @param int   $iteration  The current iteration of the loop.
					 */
					do_action( 'chaplin_posts_loop_before_grid_item', $post->ID, $iteration );
					?>
					<div class="grid-item">
						<?php get_template_part( 'parts/preview', get_post_type() ); ?>
					</div><!-- .grid-item -->
					<?php
					/**
					 * Fires after output of a grid item in the posts loop.
					 */
					do_action( 'chaplin_posts_loop_after_grid_item', $post->ID, $iteration );
				endwhile;
				?>
			</div><!-- .posts-grid -->
			<?php do_action( 'chaplin_posts_end' ); ?>
		<?php elseif ( is_search() ) : ?>
			<div class="no-search-results-form">
				<?php get_search_form(); ?>
			</div><!-- .no-search-results -->
		<?php endif; ?>
	</div><!-- .posts -->
	<?php get_template_part( 'pagination' ); ?>
</main><!-- #site-content -->
<?php get_footer(); ?>
