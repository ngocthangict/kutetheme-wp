<?php
if (!function_exists('kt_register_sidebars')) {

    function kt_register_sidebars(){

        register_sidebar( array(
            'name'          => __( 'Primary Widget Area', THEME_LANG),
            'id'            => 'primary-widget-area',
            'description'   => __( 'The primary widget area', THEME_LANG),
            'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );

        register_sidebar( array(
            'name'          => __( 'Shop Widget Area', THEME_LANG),
            'id'            => 'shop-widget-area',
            'description'   => __( 'The shop widget area', THEME_LANG),
            'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );

        register_sidebar( array(
            'name'          => __( 'Blog Widget Area', THEME_LANG),
            'id'            => 'blog-widget-area',
            'description'   => __( 'The blog widget area', THEME_LANG),
            'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );

        for( $i=1; $i <= 6; $i++ ){

            
            
        }


        $sidebars =  kt_option('custom_sidebars');
        if( !empty( $sidebars ) && is_array( $sidebars ) ){
            foreach( $sidebars as $sidebar ){
                
                $sidebar =  wp_parse_args( $sidebar, array('title' => '', 'description' => '' ));
                
                if(  $sidebar['title'] !='' ){
                    
                    $id = sanitize_title( $sidebar['title'] );
                    
                    register_sidebar( array(
                        'name'          => $sidebar['title'],
                        'id'            => $id,
                        'description'   => $sidebar['description'],
                        'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
                        'after_widget'  => '</div>',
                        'before_title'  => '<h3 class="widget-title">',
                        'after_title'   => '</h3>',
                    ) );

                }
            }
        }

    }

    add_action( 'widgets_init', 'kt_register_sidebars' );

}