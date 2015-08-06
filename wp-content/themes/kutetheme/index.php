<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * e.g., it puts together the home page when no home.php file exists.
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @package WordPress
 * @subpackage Kute Theme
 * @since KuteTheme 1.0
 */
get_header(); 
$kt_sidebar_are = kt_option('kt_sidebar_are','full');
$sidebar_are_layout = 'sidebar-'.$kt_sidebar_are;
if( $kt_sidebar_are == "left" || $kt_sidebar_are == "right" ){
    $col_class = "main-content col-xs-12 col-sm-8 col-md-9"; 
}else{
    $col_class = "main-content col-xs-12 col-sm-12 col-md-12";
}
?>
	<div id="primary" class="content-area <?php echo esc_attr($sidebar_are_layout);?>">
		<main id="main" class="site-main" role="main">
        <div class="container">
            <div class="row">
                <div class="<?php echo esc_attr($col_class);?>">
                    <?php if ( have_posts() ) : ?>
            			<?php if ( is_home() && ! is_front_page() ) : ?>
            				<header>
            					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
            				</header>
            			<?php endif; ?>
            
            			<?php
            			// Start the loop.
            			while ( have_posts() ) : the_post();
            				/*
            				 * Include the Post-Format-specific template for the content.
            				 * If you want to override this in a child theme, then include a file
            				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
            				 */
            				get_template_part( 'content', get_post_format() );
            
            			// End the loop.
            			endwhile;
            
            			// Previous/next page navigation.
            			the_posts_pagination( array(
            				'prev_text'          => __( 'Previous page', THEM_LANG ),
            				'next_text'          => __( 'Next page', THEM_LANG ),
            				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', THEM_LANG ) . ' </span>',
            			) );
            
            		// If no content, include the "No posts found" template.
            		else :
            			get_template_part( 'content', 'none' );
            
            		endif;
            		?>
                </div>
                <?php
                if($kt_sidebar_are!='full'){
                    ?>
                    <div class="col-xs-12 col-sm-4 col-md-3">
                        <div class="sidebar">
                            <?php get_sidebar();?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>
