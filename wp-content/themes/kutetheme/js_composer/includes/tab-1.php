<div class="<?php echo $elementClass; ?>" id="change-color-<?php echo $id; ?>" data-target="change-color" data-color="<?php echo $main_color; ?>" data-rgb="<?php echo implode( ',', $main_color_rgb ) ;  ?>">
    <!-- featured category fashion -->
    <div class="category-featured container-tab">
        <nav class="navbar nav-menu nav-menu-red show-brand">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-brand">
                <a href="<?php echo $term_link ? $term_link : ''; ?>">
                    <?php 
                        if( isset( $icon ) && $icon ): 
                            $att_icon = wp_get_attachment_image_src( $icon, '30x30' );  
                            $att_icon_url =  is_array($att_icon) ? esc_url($att_icon[0]) : ""; 
                        endif; 
                    ?>
                    <img alt="<?php  echo ( isset( $title ) && $title ) ? $title : __( 'Tabs Name', THEME_LANG );  ?>" src="<?php echo $att_icon_url; ?>" />
                    <?php  echo ( isset( $title ) && $title ) ? $title : __( 'Tabs Name', THEME_LANG );  ?>
                </a>
            </div>
            <span class="toggle-menu"></span>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse">           
                <ul class="nav navbar-nav">
                    <?php $i = 0; ?>
                    <?php foreach( $tabs as $tab ): ?>
                        <li <?php echo $i == 0 ? 'class="active"': '' ?> >
                            <a data-toggle="tab" href="<?php echo '#tab-'.$id.'-'.$i; ?>">
                                <?php
                                if(isset( $tab['header'] ) && $tab['header']){
                                    echo $tab['header'];
                                }elseif( isset($tab['section_type']) && $tab['section_type'] == 'new-arrival' ){
                                    _e( 'New Arrivals', THEME_LANG );
                                }elseif( isset($tab['section_type']) && $tab['section_type'] == 'most-review' ){
                                    _e( 'Most Reviews', THEME_LANG );
                                }elseif( isset($tab['section_type']) && $tab['section_type'] == 'on-sales' ){
                                    _e( 'On sales', THEME_LANG );
                                }elseif( isset($tab['section_type']) && $tab['section_type'] == 'category' && isset( $tab['section_cate'] ) && intval( $tab['section_cate'] ) >0 ){
                                    $child_term = get_term( $tab['section_cate'], 'product_cat' );
                                    if($child_term){
                                        echo $child_term->name;
                                    }else{
                                        _e( "Best Sellers", THEME_LANG );
                                    }
                                }else{
                                   _e( "Best Sellers", THEME_LANG );
                                }
                                 ?>
                            </a>
                        </li>
                        <?php $i++; ?>
                    <?php endforeach;?>
                </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
          <div id="elevator-1" class="floor-elevator">
                <a href="#" class="btn-elevator up  fa fa-angle-up"></a>
                <a href="#" class="btn-elevator down fa fa-angle-down"></a>
          </div>
        </nav>
        <?php
        if( isset( $banner_top ) &&  $banner_top ):
            $banner_top_args = array(
                'post_type' => 'attachment',
                'include'   => $banner_top,
                'orderby'   => 'post__in'
            );
            $list_banner_top = get_posts( $banner_top_args );
            if( $list_banner_top ):
            $class = 12/ ( count( $list_banner_top ) );
            ?>
            <div class="category-banner">
                <?php foreach($list_banner_top as $b): ?>
                <div class="col-sm-<?php echo $class ?> banner">
                    <a href="<?php echo $term_link ? $term_link : ''; ?>">
                        <img alt="<?php echo $b->post_title ?>" class="img-responsive" src="<?php echo wp_get_attachment_url($b->ID) ?>" />
                    </a>
                </div>
                <?php endforeach; ?>
           </div>
           <?php endif; ?>
       <?php endif; ?>
        <div class="product-featured clearfix">
            <div class="banner-featured">
                <?php if( isset($featured) && $featured ): ?>
                    <div class="featured-text">
                        <span>
                            <?php  _e( 'featured', THEME_LANG ) ?>
                        </span>
                    </div>
                <?php endif; ?>
                <?php 
                if( isset( $banner_left ) && $banner_left ): 
                    $banner_left_args = array(
                        'post_type' => 'attachment',
                        'include'   => $banner_left,
                        'orderby'   => 'post__in'
                    );
                    $list_banner_left = get_posts( $banner_left_args );
                    if( $list_banner_left ):
                    ?>
                    <?php foreach($list_banner_left as $l): ?>
                        <div class="banner-img">
                            <a href="<?php echo $term_link ? $term_link : ''; ?>">
                                <img alt="<?php echo esc_attr($l->post_title) ?>" src="<?php echo wp_get_attachment_url($l->ID) ?>" />
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <?php endif; ?>
            </div>
            <div class="product-featured-content">
                <div class="product-featured-list">
                    <div class="tab-container">
                        <?php 
                        $meta_query = WC()->query->get_meta_query();
                        $args = array(
                			'post_type'				=> 'product',
                			'post_status'			=> 'publish',
                			'ignore_sticky_posts'	=> 1,
                			'posts_per_page' 		=> $per_page,
                			'meta_query' 			=> $meta_query,
                            'suppress_filter'       => true,
                            'tax_query'             => array(
                                array(
                                    'taxonomy' => 'product_cat',
                                    'field'    => 'id',
                                    'terms'    => $term->term_id,
                                    'operator' => 'IN'
                                ),
                            )
                		);
                        $i = 0; ?>
                        <?php foreach( $tabs as $tab ): ?>
                        
                        <?php 
                        $tab = function_exists( 'vc_map_get_attributes' ) ? vc_map_get_attributes( 'tab_section', $tab ) : $atts;
                        
                        extract( shortcode_atts( array(
                            'header'       => 'Section Name',
                            'section_type' => 'best-seller',
                            'section_cate' => 0,
                            'orderby'      => 'date',
                            'order'        => 'DESC'
                        ), $tab ) );
                        ?>
                        
                        <?php 
                        
                        $key = isset( $tab['section_type'] ) ? $tab['section_type'] : 'best-seller';
                        
                        $newargs = $args;
                        if( $key == 'new-arrival' ){
                            $newargs['orderby'] = 'date';
                            $newargs['order'] 	 = 'DESC';
                        }elseif( $key == 'on-sales' ){
                            $product_ids_on_sale = wc_get_product_ids_on_sale();
                            $newargs['post__in'] = array_merge( array( 0 ), $product_ids_on_sale );
                            
                            if( $orderby == '_sale_price' ){
                                $orderby = 'date';
                                $order   = 'DESC';
                            }
                            $newargs['orderby'] = $orderby;
                            $newargs['order'] 	= $order;
                        }elseif( $key == 'custom' ){
                            if( $orderby == '_sale_price' ){
                                $newargs['meta_query'] = array(
                                    'relation' => 'OR',
                                    array( // Simple products type
                                        'key'           => '_sale_price',
                                        'value'         => 0,
                                        'compare'       => '>',
                                        'type'          => 'numeric'
                                    ),
                                    array( // Variable products type
                                        'key'           => '_min_variation_sale_price',
                                        'value'         => 0,
                                        'compare'       => '>',
                                        'type'          => 'numeric'
                                    )
                                );
                            }else{
                                $newargs['orderby'] = $orderby;
                                $newargs['order'] 	= $order;
                            }
                        }
                        elseif( $key == 'best-sellers' ){
                            $newargs['meta_key'] = 'total_sales';
                            $newargs['orderby']  = 'meta_value_num';
                        }elseif( $key == 'most-review'){
                            add_filter( 'posts_clauses', array( $this, 'order_by_rating_post_clauses' ) );
                        }
                        if($key == 'category' && intval( $tab['section_cate'] ) > 0 ){
                            $chil_term = get_term( $category, 'product_cat' );
                            if( $chil_term ){
                                $newargs['tax_query'] = array(
                                    array(
                                        'taxonomy' => 'product_cat',
                                        'field'    => 'id',
                                        'terms'    => $chil_term->term_id,
                                        'operator' => 'IN'
                                    ),
                                );
                            }
                            if( $orderby == '_sale_price' ){
                                $newargs['meta_query'] = array(
                                    'relation' => 'OR',
                                    array( // Simple products type
                                        'key'           => '_sale_price',
                                        'value'         => 0,
                                        'compare'       => '>',
                                        'type'          => 'numeric'
                                    ),
                                    array( // Variable products type
                                        'key'           => '_min_variation_sale_price',
                                        'value'         => 0,
                                        'compare'       => '>',
                                        'type'          => 'numeric'
                                    )
                                );
                            }else{
                                $newargs['orderby'] = $orderby;
                                $newargs['order'] 	= $order;
                            }
                        }
                        $products = new WP_Query( apply_filters( 'woocommerce_shortcode_products_query', $newargs, $atts ) );
                        
                        if( $key == 'most-review'){
                            remove_filter( 'posts_clauses', array( $this, 'order_by_rating_post_clauses' ) );
                        }
                        //$woocommerce_loop['columns'] = $atts['columns'];
                
                        if ( $products->have_posts() ) :
                            $data_carousel = array(
                                "autoplay" => $autoplay,
                                "navigation" => $navigation,
                                "margin"    => $margin,
                                "slidespeed" => $slidespeed,
                                "theme" => 'style-navigation-bottom',
                                "autoheight" => 'false',
                                'nav' => 'true',
                                'dots' => 'false',
                                'loop' => 'false',
                                'autoplayTimeout' => 1000,
                                'autoplayHoverPause' => 'true'
                            );
                            
                            if( ! $use_responsive){
                                $arr = array('0' => array("items" => $items_mobile), '768' => array("items" => $items_tablet), '992' => array("items" => $items_destop));
                                $data_responsive = json_encode($arr);
                                $data_carousel["responsive"] = $data_responsive;
                            }else{
                                if( $product_column > 0 )
                                    $data_carousel['items'] =  $product_column;
                            }
                        
                        ?>
                        <!-- tab product -->
                        <div class="tab-panel <?php echo ( $i == 0) ? 'active' : ''; ?>" id="<?php echo 'tab-'.$id.'-'.$i; ?>">
                            <ul class="product-list owl-carousel" <?php echo _data_carousel($data_carousel); ?>>
                                <?php 
                                while ( $products->have_posts() ) : $products->the_post();
                                    wc_get_template_part( 'content', 'product-tab' );
                                endwhile; // end of the loop.
                                ?>
                            </ul>
                        </div>
                        <?php
                        endif;
                        wp_reset_query();
                        wp_reset_postdata();
                        $i++; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
       </div>
    </div>
    <!-- end featured category fashion -->
</div>