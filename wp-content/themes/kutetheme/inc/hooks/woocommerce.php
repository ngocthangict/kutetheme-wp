<?php
/**
 * Remove noties of wootheme update
 * */
if(is_admin())
    remove_action( 'admin_notices', 'woothemes_updater_notice' );

add_filter("woocommerce_product_get_rating_html", "kt_get_rating_html", 10, 2);

/**
 * Price Regular + Sale
 * */
add_action( "kt_after_loop_item_title", "woocommerce_template_loop_price", 5 );
/**
 * Sale price Percentage
 */
add_filter( 'woocommerce_sale_price_html', 'woocommerce_custom_sales_price', 10, 2 );

function woocommerce_custom_sales_price( $price, $product ) {
	$percentage = round( ( ( $product->regular_price - $product->sale_price ) / $product->regular_price ) * 100 );
	return $price . sprintf( __('<span class="colreduce-percentage">-%s</span>', THEME_LANG ), $percentage . '%' );
}

/**
 * Change DOM html loop template price
 * */
if( ! function_exists("kt_get_price_html_from_to")){
    
    function kt_get_price_html_from_to($price, $from, $to, $product ){
        if($product->is_type( 'variable' )){
            // Main price
			$prices = array( $product->get_variation_price( 'min', true ), $product->get_variation_price( 'max', true ) );
            $multi_price = false;
            if($prices[0] !== $prices[1]){
                $multi_price = true;
            }
            $pr = $prices[0];
			// Sale
			$prices = array( $product->get_variation_regular_price( 'min', true ), $product->get_variation_regular_price( 'max', true ) );
            if($prices[0] !== $prices[1]){
                $multi_price = true;
            }
			$sale = $prices[1];
            $html_sale ='';
            if($multi_price){
                $html_sale .='~';
            }
            
            if($pr != $sale){
                $percentage = round( ( ( $sale - $pr  ) / $sale ) * 100 );
                $price .= sprintf( __('<span class="colreduce-percentage">-%s</span>', THEME_LANG ), $html_sale . $percentage . '%' );
            }
        }
        return $price;
    }
}


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
add_action('kt_loop_product_thumbnail', 'kt_template_loop_product_thumbnail', 10);

add_action('kt_after_shop_loop_item_title', 'woocommerce_template_loop_price', 5);

add_action('kt_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 10);

add_action( 'kt_loop_product_function' , 'kt_get_tool_wishlish', 1);

add_action( 'kt_loop_product_function' , 'kt_get_tool_compare', 5);

add_action( 'kt_loop_product_function' , 'kt_get_tool_quickview', 10);

add_action( 'kt_loop_product_label', 'kt_show_product_loop_new_flash', 5 );

add_action( 'kt_loop_product_label', 'woocommerce_show_product_loop_sale_flash', 10 );

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
if( ! function_exists( 'kt_template_loop_product_thumbnail' ) ){
    function kt_template_loop_product_thumbnail( $size = 'shop_catalog' ){
        $size = apply_filters( 'kt_template_loop_product_thumbnail_size' , $size );
        $size = $size ? $size : 'shop_catalog';
        echo woocommerce_get_product_thumbnail( $size );
    }
}

if ( ! function_exists( 'kt_show_product_loop_new_flash' ) ) {

	/**
	 * Get the sale flash for the loop.
	 *
	 * @subpackage	Loop
	 */
	function kt_show_product_loop_new_flash() {
		wc_get_template( 'loop/new-flash.php' );
	}
}

//Lastest Deal

add_action( 'woocommerce_datatime_sale_product', 'woocommerce_datatime_sale_product_variable' );

function woocommerce_datatime_sale_product_variable( $product = false, $post = false ){
    $product_id = 0;
    if( is_object( $product ) ){
        $product_id = $product->id;
    }elseif( is_object( $post) ){
        $product_id = $post->ID;
    }else{
        global $post;
        $product_id =  $post->ID;
    }

    if( ! $product_id  ){
        return;
    }

    $cache_key = 'time_sale_price_'.$product_id;
    $cache = wp_cache_get($cache_key);
    if( $cache ){
        echo $cache;
        return;
    }
    // Get variations
    $args = array(
        'post_type'     => 'product_variation',
        'post_status'   => array( 'private', 'publish' ),
        'numberposts'   => -1,
        'orderby'       => 'menu_order',
        'order'         => 'asc',
        'post_parent'   => $product_id
    );
    $variations = get_posts( $args );
    $variation_ids = array();
    if( $variations ){
        foreach ( $variations as $variation ) {
            $variation_ids[]  = $variation->ID;
        }
    }
    $sale_price_dates_to = false;

    if( !empty(  $variation_ids )   ){
        global $wpdb;
        $sale_price_dates_to = $wpdb->get_var( "
            SELECT
            meta_value
            FROM $wpdb->postmeta
            WHERE meta_key = '_sale_price_dates_to' and post_id IN(".join(',',$variation_ids).")
            ORDER BY meta_value DESC
            LIMIT 1
        " );

        if( $sale_price_dates_to !='' ){
            $sale_price_dates_to = date('Y-m-d', $sale_price_dates_to);
        }
    }

    if( !$sale_price_dates_to ){
        $sale_price_dates_to 	= ( $date = get_post_meta( $product_id, '_sale_price_dates_to', true ) ) ? date_i18n( 'Y-m-d', $date ) : '';
    }

    if($sale_price_dates_to){
        $cache = 'data-countdown="'.$sale_price_dates_to.'" data-time="'.$sale_price_dates_to.'" data-strtotime="'.strtotime($sale_price_dates_to).'"';
        wp_cache_add( $cache_key, $cache );
        echo $cache;
    }else{
        wp_cache_delete( $cache_key );
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


/*
* Return a new number of maximum columns for shop archives
* @param int Original value
* @return int New number of columns
*/
function kt_loop_shop_columns( $number_columns ) {
    $kt_woo_grid_column = kt_option('kt_woo_grid_column','3');
    return $kt_woo_grid_column;
}
add_filter( 'loop_shop_columns', 'kt_loop_shop_columns', 1, 10 );

/**
* Custom category page
**/

//remove woocommerce resultcount
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

// add products display
add_filter( 'woocommerce_before_shop_loop' , 'kt_custom_display_view' );

if(!function_exists('kt_custom_display_view')){
    function kt_custom_display_view(){
        ?>
        <ul class="display-product-option">
            <li class="view-as-grid">
                <span><?php _e('grid',THEME_LANG);?></span>
            </li>
            <li class="view-as-list selected">
                <span><?php _e('list', THEME_LANG );?></span>
            </li>
        </ul>
        <?php
    }
}




/* Remove pagination on the bottom of shop page */
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

/* Show pagination on the top of shop page */
add_action( 'woocommerce_after_shop_loop', 'kt_paging_nav', 10 );
add_action( 'woocommerce_after_shop_loop', 'woocommerce_catalog_ordering', 11 );

/**
 * Custom  products per page
**/
add_filter( 'loop_shop_per_page','kt_custom_products_per_page', 20 );
function kt_custom_products_per_page(){
    $loop_shop_per_page = kt_option('kt_woo_products_perpage',18);
    // Display 24 products per page. Goes in functions.php
    
    return $loop_shop_per_page;
}
