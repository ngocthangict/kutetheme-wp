<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage KuteTheme
 * @since Kute Theme 1.0.0
 */
?>

</div><!-- .site-content -->

<!-- Footer -->
<footer id="footer">
     <div class="container">
            <!-- introduce-box -->
            <div id="introduce-box" class="row">
                <div class="col-md-3">
                    <div id="address-box">
                        <?php 
                            $logo = kt_get_logo_footer();  
                            $address = kt_get_info_address();
                            $hotline = kt_get_info_hotline();
                            $email   = kt_get_info_email();
                            echo $logo;
                        ?>
                        <div id="address-list">
                            <?php if( $address ): ?>
                                <div class="tit-name"><?php _e( 'Address:', THEME_LANG ) ?></div>
                                <div class="tit-contain"><?php echo $address;  ?></div>
                            <?php endif; ?>
                            
                            <?php if( $hotline ): ?>
                                <div class="tit-name"><?php _e( 'Phone:', THEME_LANG ) ?></div>
                                <div class="tit-contain"><?php echo $hotline; ?></div>
                            <?php endif; ?>
                            
                            <?php if( $email ): ?>
                                <div class="tit-name"><?php _e( 'Email:', THEME_LANG ) ?></div>
                                <div class="tit-contain"><?php echo $email; ?></div>
                            <?php endif; ?>
                        </div>
                    </div> 
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-sm-4">
                            <?php
                                if(is_active_sidebar('footer-menu-1')){
                                    dynamic_sidebar('footer-menu-1');
                                }
                            ?>
                        </div>
                        <div class="col-sm-4">
                            <?php
                                if(is_active_sidebar('footer-menu-2')){
                                    dynamic_sidebar('footer-menu-2');
                                }
                            ?>
                        </div>
                        <div class="col-sm-4">
                            <?php
                                if(is_active_sidebar('footer-menu-3')){
                                    dynamic_sidebar('footer-menu-3');
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div id="contact-box">
                        <div class="introduce-title">Newsletter</div>
                        <div class="input-group" id="mail-box">
                          <input type="text" placeholder="Your Email Address"/>
                          <span class="input-group-btn">
                            <button class="btn btn-default" type="button">OK</button>
                          </span>
                        </div><!-- /input-group -->
                        <div class="introduce-title">Let's Socialize</div>
                        <div class="social-link">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            <a href="#"><i class="fa fa-vk"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-google-plus"></i></a>
                        </div>
                    </div>
                    
                </div>
            </div><!-- /#introduce-box -->
        
            <!-- #trademark-box -->
            <div id="trademark-box" class="row">
                <div class="col-sm-12">
                    <ul id="trademark-list">
                        <li id="payment-methods">Accepted Payment Methods</li>
                        <li>
                            <a href="#"><img src="<?php echo THEME_URL?>assets/data/trademark-ups.jpg"  alt="ups"/></a>
                        </li>
                        <li>
                            <a href="#"><img src="<?php echo THEME_URL?>assets/data/trademark-qiwi.jpg"  alt="ups"/></a>
                        </li>
                        <li>
                            <a href="#"><img src="<?php echo THEME_URL?>assets/data/trademark-wu.jpg"  alt="ups"/></a>
                        </li>
                        <li>
                            <a href="#"><img src="<?php echo THEME_URL?>assets/data/trademark-cn.jpg"  alt="ups"/></a>
                        </li>
                        <li>
                            <a href="#"><img src="<?php echo THEME_URL?>assets/data/trademark-visa.jpg"  alt="ups"/></a>
                        </li>
                        <li>
                            <a href="#"><img src="<?php echo THEME_URL?>assets/data/trademark-mc.jpg"  alt="ups"/></a>
                        </li>
                        <li>
                            <a href="#"><img src="<?php echo THEME_URL?>assets/data/trademark-ems.jpg"  alt="ups"/></a>
                        </li>
                        <li>
                            <a href="#"><img src="<?php echo THEME_URL?>assets/data/trademark-dhl.jpg"  alt="ups"/></a>
                        </li>
                        <li>
                            <a href="#"><img src="<?php echo THEME_URL?>assets/data/trademark-fe.jpg"  alt="ups"/></a>
                        </li>
                        <li>
                            <a href="#"><img src="<?php echo THEME_URL?>assets/data/trademark-wm.jpg"  alt="ups"/></a>
                        </li>
                    </ul> 
                </div>
            </div> <!-- /#trademark-box -->
            
            <!-- #trademark-text-box -->
            <div id="trademark-text-box" class="row">
                <div class="col-sm-12">
                    <ul id="trademark-search-list" class="trademark-list">
                        <li class="trademark-text-tit">HOT SEARCHED KEYWORDS:</li>
                        <li><a href="#" >Xiaomo Mi3</a></li>
                        <li><a href="#" >Digifli Pro XT 712 Tablet</a></li>
                        <li><a href="#" >Mi 3 Phones</a></li>
                        <li><a href="#" >Iphoneo 6 Plus</a></li>
                        <li><a href="#" >Women's Messenger Bags</a></li>
                        <li><a href="#" >Wallets</a></li>
                        <li><a href="#" >Women's Clutches</a></li>
                        <li><a href="#" >Backpacks Totes</a></li>
                    </ul>
                </div>
                <div class="col-sm-12">
                    <ul id="trademark-tv-list" class="trademark-list">
                        <li class="trademark-text-tit">TVS:</li>
                        <li><a href="#" >Sonyo TV</a></li>
                        <li><a href="#" >Samsing TV</a></li>
                        <li><a href="#" >LGG TV</a></li>
                        <li><a href="#" >Onidai TV</a></li>
                        <li><a href="#" >Toshibao TV</a></li>
                        <li><a href="#" >Philipsi TV</a></li>
                        <li><a href="#" >Micromax TV</a></li>
                        <li><a href="#" >LED TV</a></li>
                        <li><a href="#" >LCD TV</a></li>
                        <li><a href="#" >Plasma TV</a></li>
                        <li><a href="#" >3D TV</a></li>
                        <li><a href="#" >Smart TV</a></li>
                    </ul>
                </div>
                <div class="col-sm-12">
                    <ul id="trademark-mobile-list" class="trademark-list">
                        <li class="trademark-text-tit">MOBILES:</li>  
                        <li><a href="#" >Moto E</a></li>
                        <li><a href="#" >Samsing Mobile</a></li>
                        <li><a href="#" >Micromaxi Mobile</a></li>
                        <li><a href="#" >Nokian Mobile</a></li>
                        <li><a href="#" >HTCK Mobile</a></li>
                        <li><a href="#" >Sonyo Mobile</a></li>
                        <li><a href="#" >Appleo Mobile</a></li>
                        <li><a href="#" >LGG Mobile</a></li>
                        <li><a href="#" >Karbonno Mobile</a></li>
                    </ul>
                </div>
                <div class="col-sm-12">
                    <ul id="trademark-laptop-list" class="trademark-list">
                        <li class="trademark-text-tit">LAPTOPS::</li> 
                        <li><a href="#" >Appleo Laptop</a></li>
                        <li><a href="#" >Acero Laptop</a></li>
                        <li><a href="#" >Samsing Laptop</a></li>
                        <li><a href="#" >Lenov Laptop</a></li>
                        <li><a href="#" >Sonyo Laptop</a></li>
                        <li><a href="#" >Dello Laptop</a></li>
                        <li><a href="#" >Asuso Laptop</a></li>
                        <li><a href="#" >Toshibao Laptop</a></li>
                        <li><a href="#" >LGG Laptop</a></li>
                        <li><a href="#" >HPO Laptop</a></li>
                        <li><a href="#" >Notebook</a></li>
                    </ul>
                </div>
                <div class="col-sm-12">
                    <ul id="trademark-watches-list" class="trademark-list">
                        <li class="trademark-text-tit">WATCHES:</li>  
                        <li><a href="#" >FCUKJ Watches</a></li>
                        <li><a href="#" >Titan Watches</a></li>
                        <li><a href="#" >Casioo Watches</a></li>
                        <li><a href="#" >Fastracki Watches</a></li>
                        <li><a href="#" >Timexe Watches</a></li>
                        <li><a href="#" >Fossill Watches</a></li>
                        <li><a href="#" >Diesel Watches</a></li>
                        <li><a href="#" >Toshibao Laptop</a></li>
                        <li><a href="#" >Luxury Watches</a></li>
                    </ul>
                </div>
                <div class="col-sm-12">
                    <ul id="trademark-shoes-list" class="trademark-list">
                        <li class="trademark-text-tit">FOOTWEAR:</li>  
                        <li><a href="#" >Shoes</a></li>
                        <li><a href="#" >Casual Shoes</a></li>
                        <li><a href="#" >Sports Shoes</a></li>
                        <li><a href="#" >Adidas Shoes</a></li>
                        <li><a href="#" >Gas Shoes</a></li>
                        <li><a href="#" >Puma Shoes</a></li>
                        <li><a href="#" >Reebok Shoes</a></li>
                        <li><a href="#" >Woodland Shoes</a></li>
                        <li><a href="#" >Red tape Shoes</a></li>
                        <li><a href="#" >Nike Shoes</a></li>
                    </ul>
                </div>
            </div><!-- /#trademark-text-box -->
            <div id="footer-menu-box">
                <div class="col-sm-12">
                    <ul class="footer-menu-list">
                        <li><a href="#" >Company Info - Partnerships</a></li>
                    </ul>
                </div>
                <div class="col-sm-12">
                    <ul class="footer-menu-list">
                        <li><a href="#" >Online Shopping</a></li>
                        <li><a href="#" >Promotions</a></li>
                        <li><a href="#" >My Orders</a></li>
                        <li><a href="#" >Help</a></li>
                        <li><a href="#" >Site Map</a></li>
                        <li><a href="#" >Customer Service</a></li>
                        <li><a href="#" >Support</a></li>
                    </ul>
                </div>
                <div class="col-sm-12">
                    <ul class="footer-menu-list">
                        <li><a href="#" >Most Populars</a></li>
                        <li><a href="#" >Best Sellers</a></li>
                        <li><a href="#" >New Arrivals</a></li>
                        <li><a href="#" >Special Products</a></li>
                        <li><a href="#" >Manufacturers</a></li>
                        <li><a href="#" >Our Stores</a></li>
                        <li><a href="#" >Shipping</a></li>
                        <li><a href="#" >Payments</a></li>
                        <li><a href="#" >Warantee</a></li>
                        <li><a href="#" >Refunds</a></li>
                        <li><a href="#" >Checkout</a></li>
                        <li><a href="#" >Discount</a></li>
                    </ul>
                </div>
                <div class="col-sm-12">
                    <ul class="footer-menu-list">
                        <li><a href="#" >Terms & Conditions</a></li>
                        <li><a href="#" >Policy</a></li>
                        <li><a href="#" >Shipping</a></li>
                        <li><a href="#" >Payments</a></li>
                        <li><a href="#" >Returns</a></li>
                        <li><a href="#" >Refunds</a></li>
                        <li><a href="#" >Warrantee</a></li>
                        <li><a href="#" >FAQ</a></li>
                        <li><a href="#" >Contact</a></li>
                    </ul>
                </div>
                <p class="text-center">Copyrights &#169; 2015 KuteShop. All Rights Reserved. Designed by KuteThemes.com</p>
            </div><!-- /#footer-menu-box -->
        </div> 
    </footer>
    <!--end footer-->
    </div><!--.content-->
</div><!-- .site -->

<?php wp_footer(); ?>

</body>
</html>
