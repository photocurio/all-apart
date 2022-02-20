<?php
/**
 * The home template
 *
 * @package all-apart
 */

get_header(); ?>

<main id="site-content" role="main">

	<?php
	/**
	 * The all-apart home page template loads a "featured page"
	 * and displays the featured image and excerpt for that page.
	 */
	$archive_title    = '';
	$archive_subtitle = '';

	$featured_page    = get_post( 2 );
	$archive_title    = $featured_page->post_title;
	$archive_subtitle = $featured_page->post_excerpt;

	// On the cover page template, output the cover header.

	$cover_header_style   = '';
	$cover_header_classes = '';

	$color_overlay_style   = '';
	$color_overlay_classes = '';

	$section_inner_classes = '';
	$image_url             = get_the_post_thumbnail_url( 2, 'chaplin_fullscreen' );

	if ( $image_url ) {
		$cover_header_style   = 'background-image: url( ' . esc_url( $image_url ) . ' );';
		$cover_header_classes = ' bg-image';
	}

	// Get the color used for the color overlay.
	$color_overlay_color = get_theme_mod( 'chaplin_cover_template_overlay_background_color' );

	$color_overlay_style = $color_overlay_color ? 'color: ' . esc_attr( $color_overlay_color ) . ';' : '';


	// Note: The text color is applied by chaplin_get_customizer_css(), in functions.php.

	// Get the fixed background attachment option.
	if ( get_theme_mod( 'chaplin_cover_template_fixed_background', true ) ) {
		$cover_header_classes .= ' bg-attachment-fixed';
	}

	// Get the opacity of the color overlay.
	$color_overlay_opacity  = get_theme_mod( 'chaplin_cover_template_overlay_opacity' );
	$color_overlay_opacity  = ( false === $color_overlay_opacity ) ? 80 : $color_overlay_opacity;
	$color_overlay_classes .= ' opacity-' . $color_overlay_opacity;

	// Get the blend mode of the color overlay (default = multiply).
	$color_overlay_opacity  = get_theme_mod( 'chaplin_cover_template_overlay_blend_mode', 'multiply' );
	$color_overlay_classes .= ' blend-mode-' . $color_overlay_opacity;

	// Check whether we're fading the text.
	$overlay_fade_text     = get_theme_mod( 'chaplin_cover_template_fade_text', true );
	$section_inner_classes = $overlay_fade_text ? ' fade-block' : '';
	?>

	<div class="cover-header screen-height screen-width<?php echo esc_attr( $cover_header_classes ); ?>" style="<?php echo esc_attr( $cover_header_style ); ?>">
		<div class="cover-header-inner-wrapper">
			<div class="cover-header-inner">
				<div class="cover-color-overlay color-accent<?php echo esc_attr( $color_overlay_classes ); ?>" style="<?php echo esc_attr( $color_overlay_style ); ?>"></div>
				<div class="section-inner<?php echo esc_attr( $section_inner_classes ); ?>">
					<header class="entry-header">
						<?php if ( $archive_title ) : ?>
						<h1 class="entry-title"><?php echo wp_kses_post( $archive_title ); ?></h1>
						<?php endif; ?>

						<?php if ( $archive_subtitle ) : ?>
						<div class="archive-subtitle section-inner thin max-percentage intro-text">
							<?php echo wp_kses_post( wpautop( $archive_subtitle ) ); ?>
						</div>
						<?php endif; ?>

						<div class="to-the-content-wrapper">
							<a href="#section-inner" class="to-the-content">
								<div class="icon fill-children-current-color"><?php chaplin_the_theme_svg( 'arrow-down-circled' ); ?></div>
								<div class="text"><?php esc_html_e( 'Scroll Down', 'chaplin' ); ?></div>
							</a><!-- .to-the-content -->
						</div><!-- .to-the-content-wrapper -->
					</header>
				</div><!-- .section-inner -->
			</div><!-- .cover-header-inner -->
		</div><!-- .cover-header-inner-wrapper -->
	</div><!-- .cover-header -->

	<header class="archive-header section-inner" id="section-inner">

	</header><!-- .archive-header -->

	<div class="posts section-inner">

		<?php
		if ( have_posts() ) :

			$post_grid_column_classes = chaplin_get_post_grid_column_classes();

			?>

		<div class="posts-grid grid load-more-target <?php echo esc_attr( $post_grid_column_classes ); ?>">

			<?php
			while ( have_posts() ) :
				the_post();
				?>

			<div class="grid-item">

				<?php get_template_part( 'parts/preview', get_post_type() ); ?>

			</div><!-- .grid-item -->

			<?php endwhile; ?>

		</div><!-- .posts-grid -->

		<?php elseif ( is_search() ) : ?>

		<div class="no-search-results-form">

			<?php get_search_form(); ?>

		</div><!-- .no-search-results -->

		<?php endif; ?>

	</div><!-- .posts -->

	<?php get_template_part( 'pagination' ); ?>

</main><!-- #site-content -->

<?php get_footer(); ?>
