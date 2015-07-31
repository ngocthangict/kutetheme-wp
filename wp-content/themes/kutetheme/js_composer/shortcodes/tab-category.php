<?php
// Exit if accessed directly
if ( !defined('ABSPATH')) exit;
vc_map( array(
    "name" => __( "Categories Tab", THEME_LANG),
    "base" => "categories_tab",
    "category" => __('Kute Theme', THEME_LANG ),
    "description" => __( "Show tab categories", THEME_LANG),
    "as_parent" => array('only' => 'tab_section'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
    "content_element" => true,
    "show_settings_on_create" => true,
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __( "Title", THEME_LANG ),
            "param_name" => "title",
            "admin_label" => true,
        ),
        
        array(
            "type" => "dropdown",
        	"heading" => __("Tabs Type", THEME_LANG),
        	"param_name" => "tabs_type",
            "admin_label" => true,
            'std' => 'tabs1',
            'value' => array(
        		__( 'Tab 1', THEME_LANG ) => 'tab-1',
                __( 'Tab 2', THEME_LANG ) => 'tab-2',
                __( 'Tab 3', THEME_LANG ) => 'tab-3',
                __( 'Tab 4', THEME_LANG ) => 'tab-4',
                __( 'Tab 5', THEME_LANG ) => 'tab-5',
                __( 'Tab 6', THEME_LANG ) => 'tab-6',
                __( 'Tab 7', THEME_LANG ) => 'tab-7',
        	),
        ),
        
        array(
            "type" => "kt_categories",
        	"heading" => __("Choose Category", THEME_LANG),
        	"param_name" => "category",
            "admin_label" => true,
        ),
        
        array(
            "type" => "colorpicker",
        	"heading" => __("Main Color", THEME_LANG),
        	"param_name" => "main_color",
            "admin_label" => true,
        ),
        
        array(
    		'type' => 'attach_image',
    		'heading' => __( 'Icon', THEME_LANG ),
    		'param_name' => 'icon',
            "dependency" => array("element" => "tabs_type","value" => array('tab-1', 'tab-2', 'tab-3', 'tab-4', 'tab-5')),
    		'description' => __( 'Setup icon for the tab', THEME_LANG )
    	),
        array(
    		'type' => 'attach_images',
    		'heading' => __( 'Banner top', THEME_LANG ),
    		'param_name' => 'banner_top',
            "dependency" => array("element" => "tabs_type","value" => array('tab-1')),
    		'description' => __( 'Setup image on  top of the tab', THEME_LANG )
    	),
        
        array(
    		'type' => 'attach_images',
    		'heading' => __( 'Banner left', THEME_LANG ),
    		'param_name' => 'banner_left',
            "dependency" => array("element" => "tabs_type","value" => array('tab-1')),
    		'description' => __( 'Setup image on  left of the tab', THEME_LANG )
    	),
        
        array(
    		'type' => 'checkbox',
    		'heading' => __( 'Featured', THEME_LANG ),
    		'param_name' => 'featured',
            "dependency" => array("element" => "tabs_type", "value" => array('tab-1')),
    		'description' => __( 'Setup image on  left of the tab', THEME_LANG ),
            'value' => array( __( 'Yes', THEME_LANG ) => 'yes' )
    	)
        
    ),
    "js_view" => 'VcColumnView'
));
vc_map( array(
    "name" => __("Section Tab", THEME_LANG),
    "base" => "tab_section",
    "content_element" => true,
    "as_child" => array('only' => 'categories_tab'), // Use only|except attributes to limit parent (separate multiple values with comma)
    "params" => array(
        // add params same as with any other content element
        array(
            "type" => "textfield",
            "heading" => __( "Header", THEME_LANG ),
            "param_name" => "header",
            "admin_label" => true,
        ),
        array(
            "type" => "dropdown",
        	"heading" => __("Section Type", THEME_LANG),
        	"param_name" => "section_type",
            "admin_label" => true,
            'std' => 'best-seller',
            'value' => array(
        		__( 'Best Seller', THEME_LANG ) => 'best-seller',
                __( 'Most Review', THEME_LANG ) => 'most-review',
                __( 'New Arrival', THEME_LANG ) => 'new-arrival',
                __( 'On Sales', THEME_LANG ) => 'on-sales',
                __( 'Trending', THEME_LANG ) => 'trending',
                __( 'Category', THEME_LANG ) => 'category'
        	),
        ),
        
        array(
            "type" => "kt_categories",
        	"heading" => __("Choose Category", THEME_LANG),
        	"param_name" => "section_cate",
            "admin_label" => false,
            "dependency" => array("element" => "section_type", "value" => array('category')),
        )
        
    )
) );
class WPBakeryShortCode_Categories_Tab extends WPBakeryShortCodesContainer {
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'categories_tab', $atts ) : $atts;
        extract( shortcode_atts( array(
            'title' => 'Tabs Name',
            'tabs_type' => 'tab-1',
            'category' => 0,
            'main_color' => '#ff3366',
            'icon' => '',
            'banner_top' => '',
            'banner_left' => '',
            "featured" => false,
        ), $atts ) );
    
        $tabs = kt_get_all_attributes( 'tab_section', $content );
        if( count( $tabs ) >0 ):
            @include( THEME_DIR.'js_composer/includes/'.$tabs_type.'.php' );
        endif;
    }
}

class WPBakeryShortCode_Tab_Section extends WPBakeryShortCode{
    protected function content($atts, $content = null) {
        $atts = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'tab_section', $atts ) : $atts;
    }
}