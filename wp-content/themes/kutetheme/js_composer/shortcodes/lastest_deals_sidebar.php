<?php
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

if( class_exists( 'WPBakeryShortCode' ) ){
    // Setting shortcode lastest
    vc_map( array(
        "name" => __( "Lastest Deals", THEME_LANG),
        "base" => "lastest_deals_sidebar",
        "category" => __('Kute Theme', THEME_LANG ),
        "description" => __( "Show lastest deal products in sidebar", THEME_LANG),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => __( "Title", THEME_LANG ),
                "param_name" => "title",
                "admin_label" => true,
                'description' => __( 'Display title lastest deal box, It\'s hidden when empty', THEME_LANG )
            ),
            array(
                "type" => "attach_image",
                "heading" => __( "Icon", THEME_LANG ),
                "param_name" => "icon",
                "admin_label" => false,
                'description' => __( 'Upload icon', THEME_LANG )
            ),
            array(
                "type" => "dropdown",
            	"heading" => __("Order by", THEME_LANG),
            	"param_name" => "orderby",
            	"value" => array(
            		__('None', THEME_LANG)     => 'none',
                    __('ID', THEME_LANG)       => 'ID',
                    __('Author', THEME_LANG)   => 'author',
                    __('Name', THEME_LANG)     => 'name',
                    __('Date', THEME_LANG)     => 'date',
                    __('Modified', THEME_LANG) => 'modified',
                    __('Rand', THEME_LANG)     => 'rand',
            	),
                'std' => 'date',
            	"description" => __("Select how to sort retrieved posts.",THEME_LANG)
            ),
            array(
                "type" => "dropdown",
            	"heading" => __("Order", THEME_LANG),
            	"param_name" => "order",
            	"value" => array(
                    __('ASC', THEME_LANG) => 'ASC',
                    __('DESC', THEME_LANG) => 'DESC'
            	),
                'std' => 'DESC',
            	"description" => __("Designates the ascending or descending order.",THEME_LANG)
            ),
            array(
    			'type' => 'css_editor',
    			'heading' => __( 'Css', 'js_composer' ),
    			'param_name' => 'css',
    			// 'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
    			'group' => __( 'Design options', 'js_composer' )
    		),
            array(
                "type" => "textfield",
                "heading" => __( "Extra class name", THEME_LANG ),
                "param_name" => "el_class",
                "description" => __( "If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer" ),
            )
        )
    ));
}
class WPBakeryShortCode_Lastest_Deals_Sidebar extends WPBakeryShortCode {
    protected function content($atts, $content = null) {
        $atts = shortcode_atts( array(
            'title' => '',
            'orderby' => 'date',
            'order' => 'DESC',
            
            
            
            'css_animation' => '',
            'el_class' => '',
            'css' => '',
            
        ), $atts );
        extract($atts);
        
        
        $elementClass = array(
        	'base' => apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'latest-deals ', $this->settings['base'], $atts ),
        	'extra' => $this->getExtraClass( $el_class ),
        	'css_animation' => $this->getCSSAnimation( $css_animation ),
            'shortcode_custom' => vc_shortcode_custom_css_class( $css, ' ' )
        );
        
        $elementClass = preg_replace( array( '/\s+/', '/^\s|\s$/' ), array( ' ', '' ), implode( ' ', $elementClass ) );
        
        $elementClass = apply_filters( 'kt_lastest_deals_sidebar_class_container', $elementClass );
        
        ob_start();
        ?>
        <div class="<?php echo $elementClass; ?>">
            <h2 class="latest-deal-title"><?php echo $title; ?></h2>
            <div class="latest-deal-content">
                <ul class="product-list owl-carousel" data-dots="false" data-loop="true" data-nav = "true" data-autoplayTimeout="1000" data-autoplayHoverPause = "true" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":1}}'>
                    <li>
                        <div class="count-down-time" data-countdown="2015/06/27"></div>
                        <div class="left-block">
                            <a href="#"><img class="img-responsive" alt="product" src="<?php echo THEME_URL ?>assets/data/ld1.jpg" /></a>
                            <div class="quick-view">
                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                    <a title="Add to compare" class="compare" href="#"></a>
                                    <a title="Quick view" class="search" href="#"></a>
                            </div>
                            <div class="add-to-cart">
                                <a title="Add to Cart" href="#">Add to Cart</a>
                            </div>
                        </div>
                        <div class="right-block">
                            <h5 class="product-name"><a href="#">Maecenas consequat mauris</a></h5>
                            <div class="content_price">
                                <span class="price product-price">$38,95</span>
                                <span class="price old-price">$52,00</span>
                                <span class="colreduce-percentage">(-10%)</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="count-down-time" data-countdown="2015/06/27 9:20:00"></div>
                        <div class="left-block">
                            <a href="#"><img class="img-responsive" alt="product" src="<?php echo THEME_URL ?>assets/data/ld2.jpg" /></a>
                            <div class="quick-view">
                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                    <a title="Add to compare" class="compare" href="#"></a>
                                    <a title="Quick view" class="search" href="#"></a>
                            </div>
                            <div class="add-to-cart">
                                <a title="Add to Cart" href="#">Add to Cart</a>
                            </div>
                        </div>
                        <div class="right-block">
                            <h5 class="product-name"><a href="#">Maecenas consequat mauris</a></h5>
                            <div class="content_price">
                                <span class="price product-price">$38,95</span>
                                <span class="price old-price">$52,00</span>
                                <span class="colreduce-percentage">(-90%)</span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="count-down-time" data-countdown="2015/06/27 9:20:00"></div>
                        <div class="left-block">
                            <a href="#"><img class="img-responsive" alt="product" src="<?php echo THEME_URL ?>assets/data/ld3.jpg" /></a>
                            <div class="quick-view">
                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                    <a title="Add to compare" class="compare" href="#"></a>
                                    <a title="Quick view" class="search" href="#"></a>
                            </div>
                            <div class="add-to-cart">
                                <a title="Add to Cart" href="#">Add to Cart</a>
                            </div>
                        </div>
                        <div class="right-block">
                            <h5 class="product-name"><a href="#">Maecenas consequat mauris</a></h5>
                            <div class="content_price">
                                <span class="price product-price">$38,95</span>
                                <span class="price old-price">$52,00</span>
                                <span class="colreduce-percentage">(-20%)</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <?php
        $result = ob_get_contents();
        ob_clean();
        return $result;
    }
}