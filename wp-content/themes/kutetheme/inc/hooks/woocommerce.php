<?php
/**
 * Remove noties of wootheme update
 * */
if(is_admin())
    remove_action( 'admin_notices', 'woothemes_updater_notice' );

add_filter("woocommerce_product_get_rating_html", "kt_get_rating_html", 10, 2);

function kt_get_rating_html($rating_html, $rating){
    $rating_html = '';
    global $product;
    if ( ! is_numeric( $rating ) ) {
        $rating = $product->get_average_rating();
    }
    $rating_html  = '<div class="product-star" title="' . sprintf( __( 'Rated %s out of 5', THEME_LANG ), $rating > 0 ? $rating : 0  ) . '">';
    for($i = 1;$i <= 5 ;$i++){
        if($rating >= $i){
            if( ( $rating - $i ) > 0 && ( $rating - $i ) < 1 ){
                $rating_html .= '<i class="fa fa-star-half-o"></i>';    
            }else{
                $rating_html .= '<i class="fa fa-star"></i>';
            }
        }else{
            $rating_html .= '<i class="fa fa-star-o"></i>';
        }
    }
    $rating_html .= '</div>';
    return $rating_html;
}

//content-product-tab.php
add_action('kt_loop_product_thumbnail', 'woocommerce_template_loop_product_thumbnail', 10);

add_action('kt_after_shop_loop_item_title', 'woocommerce_template_loop_price', 5);

add_action('kt_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 10);

add_action( 'kt_loop_product_function' , 'kt_get_tool_wishlish', 1);

add_action( 'kt_loop_product_function' , 'kt_get_tool_compare', 5);

add_action( 'kt_loop_product_function' , 'kt_get_tool_quickview', 10);
if( ! function_exists('kt_get_tool_compare')){
    function kt_get_tool_compare(){
        if(defined( 'YITH_WOOCOMPARE' )){
            echo do_shortcode('[yith_compare_button]');
        }
    }
}
if( ! function_exists('kt_get_tool_wishlish') ){
    function kt_get_tool_wishlish(){
        if(class_exists('YITH_WCWL_UI')){
            echo do_shortcode('[yith_wcwl_add_to_wishlist]');    
        }
    }
}
if( ! function_exists('kt_get_tool_quickview') ){
    function kt_get_tool_quickview(){
        echo sprintf('<a title="%1$s" data-id="%2$s" class="search btn-quick-view" href="#"></a>', __('Quick view', THEME_LANG), get_the_ID() );
    }
}


// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php)
add_filter( 'woocommerce_add_to_cart_fragments', 'kt_header_add_to_cart_fragment' );

function kt_header_add_to_cart_fragment( $fragments ) {
	$fragments['#cart-block.shopping-cart-box'] = kt_cart_button();
	
	return $fragments;
}

add_action( 'kt_woocommerce_single_product', 'kt_woocommerce_single_product' );
function kt_woocommerce_single_product(){
    
    
    ?>
    <div class="product-detail-info">
        <div class="product-section">
            <?php
            woocommerce_template_single_meta();
            woocommerce_template_single_rating();
            woocommerce_template_single_excerpt();
            ?>
        </div>
        <div class="product-section">
            <?php
                woocommerce_template_single_add_to_cart();
            ?>
            <div class="group-product-price">
                <label><?php _e( 'Price', THEME_LANG );?></label>
                <?php woocommerce_template_single_price();?>
            </div>
        </div>
        <div class="product-section">
            <?php woocommerce_template_single_sharing();?>
        </div>
    </div>
    <?php
}

/***********************************
*AJAX
***********************************/
/**
 * Product Quick View callback AJAX request 
 *
 * @since 1.0
 * @return html
 */

function wp_ajax_frontend_product_quick_view_callback() {
    check_ajax_referer( 'screenReaderText', 'security' );
    
    global $product, $woocommerce, $post;

	$product_id = $_POST["product_id"];
	
	$post = get_post( $product_id );

	$product = wc_get_product( $product_id );
    
    // Call our template to display the product infos
    wc_get_template_part( 'content', 'quickview');
    
    die();
    
}
add_action( 'wp_ajax_frontend_product_quick_view', 'wp_ajax_frontend_product_quick_view_callback' );
add_action( 'wp_ajax_nopriv_frontend_product_quick_view', 'wp_ajax_frontend_product_quick_view_callback' );