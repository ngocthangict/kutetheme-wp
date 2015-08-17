<?php
if( isset( $banner_left ) && $banner_left ): 
    $banner_left_args = array(
        'post_type' => 'attachment',
        'include'   => $banner_left,
        'orderby'   => 'post__in'
    );
    $list_banner_left = get_posts( $banner_left_args );
    ob_start();
    foreach($list_banner_left as $l):
        ?>
        <li>
            <a href="<?php echo $term_link ? $term_link : ''; ?>">
                <img alt="<?php echo esc_attr($l->post_title) ?>" src="<?php echo wp_get_attachment_url($l->ID) ?>" />
            </a>
        </li>
        <?php
    endforeach;
    $banner_carousel = ob_get_clean();
endif;
?>
<div class="<?php echo $elementClass; ?>" id="change-color-<?php echo $id; ?>" data-target="change-color" data-color="<?php echo $main_color; ?>" data-rgb="<?php echo implode( ',', $main_color_rgb ) ;  ?>">
    <!-- featured category sports -->
    <div class="category-featured sports">
        <nav class="navbar nav-menu show-brand">
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
                                    echo sprintf('%1$s %2$s', __( "Tab", THEME_LANG ), $i );
                                }
                            }else{
                               echo sprintf('%1$s %2$s', __( "Tab", THEME_LANG ), $i );
                            }
                             ?>
                        </a>
                    </li>
                    <?php $i++; ?>
                <?php endforeach;?>
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
          <div id="elevator-2" class="floor-elevator">
            <a href="#elevator-1" class="btn-elevator up fa fa-angle-up"></a>
            <a href="#elevator-3" class="btn-elevator down fa fa-angle-down"></a>
          </div>
        </nav>
       <div class="product-featured clearfix">
            <div class="row">
                <div class="col-sm-2 sub-category-wapper">
                    <ul class="sub-category-list">
                        <?php foreach( $subcats as $cate ): ?>
                            <?php $cate_link = get_term_link($cate); ?>
                            <li><a href="<?php echo $cate_link; ?>"><?php echo $cate->name ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-sm-10 col-right-tab">
                    <div class="product-featured-tab-content">
                        <div class="tab-container">
                            <div class="tab-panel active" id="tab-6">
                                <div class="box-left">
                                    <div class="deal-product">
                                        <div class="deal-product-head">
                                            <h3><span>Deals of The Day</span></h3>
                                        </div>
                                        <ul class="owl-carousel" data-items="1" data-nav="true" data-dots="false">
                                            <li class="deal-product-content">
                                                <div class="col-sm-5 deal-product-image">
                                                    <a href="#"><img src="assets/data/p54.jpg" alt="Prodcut"></a>
                                                </div>
                                                <div class="col-sm-7 deal-product-info">
                                                    <p><a href="#">Top Selling Product 1</a></p>
                                                    <div class="price">
                                                        <span class="product-price">$38.95</span>
                                                        <span class="old-price">$52.00</span>
                                                        <span  class="sale-price">-15%</span>
                                                    </div>
                                                    <div class="show-count-down">
                                                        <span class="countdown-lastest" data-y="2015" data-m="7" data-d="1" data-h="00" data-i="00" data-s="00"></span>
                                                    </div>
                                                    <div class="product-star">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                    </div>
                                                    <div class="product-desc">
                                                        Sound performance tuning includes the smallest details like...
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="deal-product-content">
                                                <div class="col-sm-5 deal-product-image">
                                                    <a href="#"><img src="assets/data/p58.jpg" alt="Prodcut"></a>
                                                </div>
                                                <div class="col-sm-7 deal-product-info">
                                                    <p><a href="#">Top Selling Product 2</a></p>
                                                    <div class="price">
                                                        <span class="product-price">$38.95</span>
                                                        <span class="old-price">$52.00</span>
                                                        <span  class="sale-price">-15%</span>
                                                    </div>
                                                    <div class="show-count-down">
                                                        <span class="countdown-lastest" data-y="2015" data-m="10" data-d="1" data-h="00" data-i="00" data-s="00"></span>
                                                    </div>
                                                    <div class="product-star">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                    </div>
                                                    <div class="product-desc">
                                                        Sound performance tuning includes the smallest details like...
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php if( isset( $banner_carousel ) && $banner_carousel ) : ?>
                                    <ul class="owl-intab owl-carousel" data-loop="true" data-items="1" data-dots="false" data-nav="true">
                                        <?php echo $banner_carousel; ?>
                                    </ul>
                                    <?php endif; ?>
                                </div>
                                <div class="box-right">
                                    <ul class="product-list row">
                                        <li class="col-sm-4">
                                            <div class="right-block">
                                                <h5 class="product-name"><a href="#">Sexy Sport Shoes</a></h5>
                                                <div class="content_price">
                                                    <span class="price product-price">$38,95</span>
                                                    <span class="price old-price">$52,00</span>
                                                </div>
                                            </div>
                                            <div class="left-block">
                                                <a href="#">
                                                <img class="img-responsive" alt="product" src="assets/data/p55.jpg" /></a>
                                                <div class="quick-view">
                                                        <a title="Add to my wishlist" class="heart" href="#"></a>
                                                        <a title="Add to compare" class="compare" href="#"></a>
                                                        <a title="Quick view" class="search" href="#"></a>
                                                </div>
                                                <div class="add-to-cart">
                                                    <a title="Add to Cart" href="#">Add to Cart</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="col-sm-4">
                                            <div class="right-block">
                                                <h5 class="product-name"><a href="#">Tennis Blue Hat</a></h5>
                                                <div class="content_price">
                                                    <span class="price product-price">$38,95</span>
                                                    <span class="price old-price">$52,00</span>
                                                </div>
                                            </div>
                                            <div class="left-block">
                                                <a href="#">
                                                <img class="img-responsive" alt="product" src="assets/data/p56.jpg" /></a>
                                                <div class="quick-view">
                                                        <a title="Add to my wishlist" class="heart" href="#"></a>
                                                        <a title="Add to compare" class="compare" href="#"></a>
                                                        <a title="Quick view" class="search" href="#"></a>
                                                </div>
                                                <div class="add-to-cart">
                                                    <a title="Add to Cart" href="#">Add to Cart</a>
                                                </div>
                                            </div>
                                            
                                        </li>
                                        <li class="col-sm-4">
                                            <div class="right-block">
                                                <h5 class="product-name"><a href="#">Blue T-Shirt</a></h5>
                                                <div class="content_price">
                                                    <span class="price product-price">$38,95</span>
                                                </div>
                                            </div>
                                            <div class="left-block">
                                                <a href="#">
                                                <img class="img-responsive" alt="product" src="assets/data/p57.jpg" /></a>
                                                <div class="quick-view">
                                                        <a title="Add to my wishlist" class="heart" href="#"></a>
                                                        <a title="Add to compare" class="compare" href="#"></a>
                                                        <a title="Quick view" class="search" href="#"></a>
                                                </div>
                                                <div class="add-to-cart">
                                                    <a title="Add to Cart" href="#">Add to Cart</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="col-sm-4">
                                            <div class="right-block">
                                                <h5 class="product-name"><a href="#">Tennis Racquet</a></h5>
                                                <div class="content_price">
                                                    <span class="price product-price">$38,95</span>
                                                    <span class="price old-price">$52,00</span>
                                                </div>
                                            </div>
                                            <div class="left-block">
                                                <a href="#">
                                                <img class="img-responsive" alt="product" src="assets/data/p58.jpg" /></a>
                                                <div class="quick-view">
                                                        <a title="Add to my wishlist" class="heart" href="#"></a>
                                                        <a title="Add to compare" class="compare" href="#"></a>
                                                        <a title="Quick view" class="search" href="#"></a>
                                                </div>
                                                <div class="add-to-cart">
                                                    <a title="Add to Cart" href="#">Add to Cart</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="col-sm-4">
                                            <div class="right-block">
                                                <h5 class="product-name"><a href="#">Fashion & Sport</a></h5>
                                                <div class="content_price">
                                                    <span class="price product-price">$38,95</span>
                                                    <span class="price old-price">$52,00</span>
                                                </div>
                                            </div>
                                            <div class="left-block">
                                                <a href="#">
                                                <img class="img-responsive" alt="product" src="assets/data/p59.jpg" /></a>
                                                <div class="quick-view">
                                                        <a title="Add to my wishlist" class="heart" href="#"></a>
                                                        <a title="Add to compare" class="compare" href="#"></a>
                                                        <a title="Quick view" class="search" href="#"></a>
                                                </div>
                                                <div class="add-to-cart">
                                                    <a title="Add to Cart" href="#">Add to Cart</a>
                                                </div>
                                            </div>
                                            
                                        </li>
                                        <li class="col-sm-4">
                                            <div class="right-block">
                                                <h5 class="product-name"><a href="#">Versatile Package</a></h5>
                                                <div class="content_price">
                                                    <span class="price product-price">$38,95</span>
                                                </div>
                                            </div>
                                            <div class="left-block">
                                                <a href="#">
                                                <img class="img-responsive" alt="product" src="assets/data/p60.jpg" /></a>
                                                <div class="quick-view">
                                                    <a title="Add to my wishlist" class="heart" href="#"></a>
                                                    <a title="Add to compare" class="compare" href="#"></a>
                                                    <a title="Quick view" class="search" href="#"></a>
                                                </div>
                                                <div class="add-to-cart">
                                                    <a title="Add to Cart" href="#">Add to Cart</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </div>
    <!-- end featured category sports-->
</div>