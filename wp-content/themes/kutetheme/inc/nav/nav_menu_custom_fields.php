<?php
/**
 * Define all custom fields in menu
 *
 * @version: 1.0.0
 * @package  Kute/Template
 * @author   KuteThemes
 * @link	 http://kutethemes.com
 */

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

add_action( 'walker_nav_menu_custom_fields', 'kt_add_custom_fields', 10, 4 );

function kt_add_custom_fields( $item_id, $item, $depth, $args ) { 
    ?>
    <div class="clearfix"></div>
    <div class="container-megamenu container-<?php echo $depth; ?>">
        <p class="field-image description description-wide">
            <?php
                $preview = false;
                $img_preview = "";
                if($item->img_icon){
                    $img_preview = wp_get_attachment_url($item->img_icon);
                    $preview = true;
                }
            ?>
            <label for="menu-item-image-<?php echo $item_id; ?>">
                <?php _e( 'Image Icon', THEME_LANG); ?><br />
                <input type="hidden" value="<?php echo esc_attr( $item->img_icon ); ?>" name="menu-item-megamenu-img_icon[<?php echo $item_id; ?>]" id="menu-item-imgicon-<?php echo $item_id; ?>" class="widefat edit-menu-item-image" />
            </label>
            <span class="clearfix"></span>
            <span class="kt_image_preview" style="<?php if($preview){ echo "display: block;";} ?>">
                <img src="<?php echo esc_url($img_preview); ?>" alt="" title="" />
                <i class="fa fa-times">X</i>
            </span>
            <span class="clearfix"></span>
            <input type="button" class="button-secondary kt_image_menu" value="<?php _e('Upload image', THEME_LANG); ?>" />
        </p>
        <?php if(post_type_exists('megamenu')){
            $post_type = 'megamenu';
        }else{
            $post_type = 'page';
        }
        $pages = new WP_Query( array( 'post_type' => $post_type ));
        if($pages->have_posts()):
        ?>
        <div class="wrapper-megamenu">
            <p class="field-enable description description-wide">
                <label for="menu-item-enable-<?php echo $item_id; ?>">
                    <input type="checkbox" <?php checked($item->enable, 'enabled'); ?> data-id="<?php echo $item_id; ?>" id="menu-item-enable-<?php echo $item_id; ?>" name="menu-item-megamenu-enable[<?php echo $item_id; ?>]" value="enabled" class="edit-menu-item-enable"/>
                    <b><?php _e( 'Enable Mega Menu (only for main menu)', THEME_LANG); ?></b>
                </label>
            </p>
            <div id="content-megamenu-<?php echo $item_id; ?>" class="megamenu-layout clearfix">
                <div class="megamenu-layout-depth-1">
                    <p class="field-menu_page description description-wide">
                        <label for="menu-item-menu_page-<?php echo $item_id; ?>">
                            <?php _e('Menu Page', THEME_LANG); ?><br />
                            <select class="widefat"  id="menu-item-menu_page-<?php echo $item_id; ?>" name="menu-item-megamenu-menu_page[<?php echo $item_id; ?>]">
                                <option value="0">Choose Menu Page</option>
                                <?php
                                while($pages->have_posts()): $pages->the_post();
                                    $id = get_the_ID();
                                    echo '<option '.selected($id, $item->menu_page, false).' value="'.$id.'">'.get_the_title().'</option>';
                                endwhile;
                                ?>
                            </select>
                        </label>
                    </p>
                </div>
            </div><!-- #content-megamenu-<?php echo $item_id; ?> -->
        </div><!-- .wrapper-megamenu -->
        <?php endif; 
        wp_reset_query();
        wp_reset_postdata();
        ?>
    </div><!-- .container-megamenu -->
<?php }
