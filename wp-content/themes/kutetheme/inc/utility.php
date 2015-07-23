<?php
/**
* Function to get options in front-end
* @param int $option The option we need from the DB
* @param string $default If $option doesn't exist in DB return $default value
* @return string
*/

if ( ! function_exists( 'kt_option' ) ){
    function kt_option( $option = false, $default = false ){
        if($option === FALSE){
            return FALSE;
        }
        $option_name = apply_filters('theme_option_name', THEME_OPTIONS );
        $kt_options  = wp_cache_get( $option_name );
        if(  !$kt_options ){
            $kt_options = get_option( $option_name );
            if( empty($kt_options)  ){
                // get default theme option
                if( defined( 'ICL_LANGUAGE_CODE' ) ){
                    $kt_options = get_option( THEME_OPTIONS );
                }
            }
            wp_cache_delete( $option_name );
            wp_cache_add( $option_name, $kt_options );
        }
        
        if(isset($kt_options[$option]) && $kt_options[$option] !== ''){
            return $kt_options[$option];
        }else{
            return $default;
        }
    }
}

if( ! function_exists( "kt_get_logo" ) ){
    function kt_get_logo(){
        $logo = array();
        //get setting logo default
        $default = kt_option("logo");
        //get setting logo higher quanlity on among screen retina, 2k, 4k
        $retina = kt_option("logo_retina");
        
        if(is_array($default) && $default['url']){
            $logo['default'] = $default['url'];
        }
        if(is_array($retina) && $retina["url"]){
            $logo["retina"] = $retina["url"];
        }
        return $logo;
    }
}
/**
 * Display dropdown choose language
 * */
if( ! function_exists( "kt_get_wpml" )){
    function kt_get_wpml(){
        //Check function icl_get_languages exist 
        if( kt_is_wpml() ){
            $languages = icl_get_languages( 'skip_missing=0&orderby=code' );
            
            if(!empty($languages)){
                //Find language actived
                foreach( $languages as $lang_k => $lang ){
                    if( $lang['active'] ){
                        $active_lang = $lang;
                    }
                }
            }
            echo '<div class="top-bar-link top-bar-languages">
                    <div class="link-container dropdown '.( (count($languages) > 1) ? 'menu-item-has-children' : '').'">
                        <a class="current-selected" href="#" data-toggle="dropdown">';
                            printf('<span><img src="%s" alt="languages"></span>', esc_url($active_lang['country_flag_url']));
                  echo '</a>
                        <ul class="dropdown-menu" role="menu">';
                            foreach($languages as $lang):
                                printf('<li><a href="%4$s"><span><img src="%1$s" alt="%2$s"></span> %3$s</a></li>',
                                    esc_url($lang['country_flag_url']),
                                    $lang["language_code"],
                                    $lang["translated_name"],
                                    $lang['url']
                                );
                            endforeach;
                    echo '</ul>
                </div>
			</div>';
        }
    }
}
if( ! function_exists('kt_menu_my_account')){
    function kt_menu_my_account($output = ''){
        $output .= '<div class="top-bar-link top-bar-services">
                        <div class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children right-dropdown dropdown link-container">
                            <a class="current-selected" href="#" data-toggle="dropdown" >My account</a>
                            <ul class="dropdown-menu" role="menu">';
        if ( ! is_user_logged_in() ): 
            $url = get_permalink( get_option('woocommerce_myaccount_page_id') );
            if( ! $url || ! kt_is_wc()){
                $url = wp_login_url();
                $url_register = wp_registration_url();
                $output .= '<li><a href="'.$url.'" title="'.__('Login', THEME_LANG).'">'.__('Login', THEME_LANG).'</a></li>';
                $output .= '<li><a href="'.$url_register.'" title="'.__('Register', THEME_LANG).'">'.__('Register', THEME_LANG).'</a></li>';
            }else{
                $output .= '<li><a href="'.$url.'" title="'.__('Login / Register','woothemes').'">'.__('Login / Register','woothemes').'</a></li>';
            }
        else:
            $output .= '<li><a href="'.wp_logout_url().'">'.__('Logout', THEME_LANG).'</a></li>';
            if( function_exists( 'YITH_WCWL' ) ){
                $wishlist_url = YITH_WCWL()->get_wishlist_url();
                $output .=  '<li><a href="'.$wishlist_url.'">'.__( 'Wishlists', THEME_LANG).'</a></li>';
            }
        endif;
        if(defined( 'YITH_WOOCOMPARE' )){
            global $yith_woocompare;
            $count = count($yith_woocompare->obj->products_list);
            
            $output .=  '<li><a href="#" class="yith-woocompare-open">'.__("Compare", THEME_LANG).'<span>('.$count.')</span></a></li>';
            
        }
        $output .=  '       </ul>
                        </div>
                    </div>';   
        return $output;   
    }
}
/************************************************************************************************************/
/**
 * Function check install plugin wpnl
 * */
function  kt_is_wpml(){
    return function_exists( 'icl_get_languages' );
}
/**
 * Function check if WC Plugin installed
 */
function kt_is_wc(){
    return function_exists( 'is_woocommerce' );
}
/**
* Function check exist Visual composer
**/
 function kt_is_vc(){
    return function_exists( "vc_map" );
 }
 if ( ! function_exists( 'kt_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Fourteen 1.0
 *
 * @global WP_Query   $wp_query   WordPress Query object.
 * @global WP_Rewrite $wp_rewrite WordPress Rewrite object.
 */
function kt_paging_nav() {
	global $wp_query, $wp_rewrite;
    
    // Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}
    
    echo get_the_posts_pagination( array(
        'prev_text'          => __( '<i class="fa fa-caret-left"></i>', THEME_LANG ),
        'next_text'          => __( '<i class="fa fa-caret-right"></i>', THEME_LANG ),
        'screen_reader_text' => __('Page:',THEME_LANG),
        'before_page_number' => '',
    ) );
    
}
endif;

if ( ! function_exists( 'kt_comment_nav' ) ) :
    /**
     * Display navigation to next/previous comments when applicable.
     *
     * @since London 1.0
     */
    function kt_comment_nav() {
        // Are there comments to navigate through?
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
            ?>
            <nav class="navigation comment-navigation" role="navigation">
                <h2 class="screen-reader-text"><?php _e( 'Comment navigation', THEME_LANG ); ?></h2>
                <div class="nav-links">
                    <?php
                    if ( $prev_link = get_previous_comments_link( __( 'Older Comments', THEME_LANG ) ) ) :
                        printf( '<div class="nav-previous">%s</div>', $prev_link );
                    endif;

                    if ( $next_link = get_next_comments_link( __( 'Newer Comments',  THEME_LANG ) ) ) :
                        printf( '<div class="nav-next">%s</div>', $next_link );
                    endif;
                    ?>
                </div><!-- .nav-links -->
            </nav><!-- .comment-navigation -->
        <?php
        endif;
    }
endif;

/**
 *
 * Custom call back function for default post type
 *
 * @param $comment
 * @param $args
 * @param $depth
 */
function kt_comments($comment, $args, $depth) {
    $GLOBALS[ 'comment' ] = $comment; ?>

<li <?php comment_class('comment'); ?> id="li-comment-<?php comment_ID() ?>">
    <div  id="comment-<?php comment_ID(); ?>" class="comment-item">

        <div class="comment-avatar">
            <?php echo get_avatar( $comment->comment_author_email, $size = '90', $default = '' ); ?>
        </div>
        <div class="comment-content">
            <div class="comment-meta">
                <a class="comment-author" href="#"><?php printf(__('<b class="author_name">%s </b>'), get_comment_author_link()) ?></a>
                <span class="comment-date"><?php printf( '%1$s' , get_comment_date( 'F j, Y \a\t g:i a' )); ?></span>
            </div>
            <div class="comment-entry entry-content">
                <?php comment_text() ?>
                <?php if ( $comment->comment_approved == '0' ) : ?>
                    <em><?php _e( 'Your comment is awaiting moderation.', THEME_LANG ) ?></em>
                <?php endif; ?>
            </div>
            <div class="comment-actions clear">
                <?php edit_comment_link( __( '(Edit)', THEME_LANG),'  ','' ) ?>
                <?php comment_reply_link( array_merge( $args,
                    array('depth' => $depth,
                        'max_depth' => $args['max_depth'],
                        'reply_text' =>'<i class="fa fa-share"></i> '.__('Reply')
                    ))) ?>
            </div>
        </div>

        <div class="clear"></div>
    </div>
<?php
}

function kt_get_all_revSlider( ){
	$options = array();
    
    if ( class_exists( 'RevSlider' ) ) {
        $revSlider = new RevSlider();
        $arrSliders = $revSlider->getArrSliders();
        
        if(!empty($arrSliders)){
			foreach($arrSliders as $slider){
			   $options[$slider->getParam("alias")] = $slider->getParam("title");
			}
        }
    }

	return $options;
}
if( ! function_exists('kt_logo')){
    function kt_logo(){
        $logo = kt_get_logo();
        $logo_class = ( isset($logo['retina']) && $logo['retina']) ? 'retina-logo-wrapper' : '';
        $tag_wrapper = (is_front_page() && is_home())? "h1" : "p";
        ob_start();
        ?>
        <div class="logo">
    		<a href="<?php echo esc_url( get_home_url( '/' ) ); ?>" title="<?php bloginfo( 'description' ); ?>">
                <img src="<?php echo esc_url($logo['default']); ?>" class="default-logo" alt="<?php bloginfo( 'name' ); ?>" />
                <?php if( isset($logo['retina']) && $logo['retina']): ?>
                    <img src="<?php echo esc_url($logo['retina']); ?>" class="retina-logo" alt="<?php bloginfo( 'name' ); ?>" />
                <?php endif; ?>
            </a>
        </div>
        <?php
        $result = ob_get_contents();
        ob_end_clean();
        echo $result;
    }
}
if( ! function_exists( "kt_cart" )){
    function kt_cart(){
        if ( kt_is_wc() ) {
            $cart_total = WC()->cart->get_cart_total();
            $cart_count = WC()->cart->cart_contents_count;
            ob_start();
            ?>
            <div class="shopping-cart-top">
				<a class="info-cart" href="<?php echo esc_url(WC()->cart->get_cart_url()); ?>">
					<span class="shopping-cart-name"><?php _e('Shopping Cart', THEME_LANG ) ?></span>
					<span class="shopping-cart-desc">
						<span class="shopping-cart-qty"><?php echo $cart_count ; ?> Item(s)</span>
						<span class="shopping-cart-total"> - <?php echo $cart_total; ?></span>
					</span>
				</a>
                <div class="cart-mini">
                <?php
                    wc_get_template_part( 'cart/mini', 'cart' );
                ?>
                </div>
			</div>
            <?php
            $result = ob_get_contents();
            ob_end_clean();
            echo $result;
        }
    }
}
/**
* Function to get sidebars
* 
* @return array
*/

if ( ! function_exists('kt_sidebars') ){
    function kt_sidebars( ){
        $sidebars = array();
        foreach ( $GLOBALS[ 'wp_registered_sidebars' ] as $item ) {
            $sidebars[ $item[ 'id' ] ] = $item[ 'name' ];
        }
        return $sidebars;
    }
}
/**
 * Function get menu by setting
 * Create menu's place holder
 * @param array $setting The Menu is changed by it
 * */
if( ! function_exists( "kt_get_menu" ) ){
    function kt_get_menu($setting = array( 'theme_location' => 'primary', 'container' => 'nav', 'container_id' => 'main-nav-mobile', 'menu_class' => 'menu navigation-mobile' )){
        if( ! isset($setting["walker"])){
            $setting[ "walker" ] = new KTMegaWalker();
        }
        wp_nav_menu( $setting );
    }
}