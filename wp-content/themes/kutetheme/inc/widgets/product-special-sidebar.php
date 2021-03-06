<?php
if ( ! defined( 'ABSPATH' ) ) {
    die;
}

/**
 * Pages widget class
 *
 * @since 1.0
 */
class Widget_KT_Product_Special extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
                        'classname' => 'widget_kt_product_special', 
                        'description' => __( 'Box special product on sidebar.', THEME_LANG ) );
		parent::__construct( 'widget_kt_product_special', __('KT Special Product', THEME_LANG ), $widget_ops );
	}

	public function widget( $args, $instance ) {
        echo $args['before_widget'];
        
        $title   = isset( $instance[ 'title' ] )   ? esc_attr($instance[ 'title' ])   : '';
        
        $orderby = isset( $instance[ 'orderby' ] ) ? $instance[ 'orderby' ] : 'date';
        $order   = isset( $instance[ 'order' ] )   ? $instance[ 'order' ]   : 'desc';
        
        $meta_query = WC()->query->get_meta_query();
        $params = array(
			'post_type'				=> 'product',
			'post_status'			=> 'publish',
			'ignore_sticky_posts'	=> 1,
			'posts_per_page' 		=> 1,
			'meta_query' 			=> $meta_query,
            'suppress_filter'       => true,
            'orderby'               => $orderby,
            'order'	                => $order
		);
        
        $product = new WP_Query( $params );
        ?>
        <!-- SPECIAL -->
        <div class="block left-module">
            <p class="title_block"><?php echo $title ?></p>
            <?php
            if ( $product->have_posts() ):
            ?>
                <?php while($product->have_posts()): $product->the_post(); ?>
                    <?php wc_get_template_part( 'content', 'special-product-sidebar' ); ?>
                <?php endwhile; ?>
            <?php
            endif;
            wp_reset_query();
            wp_reset_postdata();
            ?>
        </div>
        <!-- ./SPECIAL -->
        <?php
        echo $args[ 'after_widget' ];
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $new_instance;
        $instance[ 'title' ] = isset( $new_instance[ 'title' ] ) ? $new_instance[ 'title' ] : '';
        
        $instance[ 'orderby' ]  = $new_instance[ 'orderby' ] ? $new_instance[ 'orderby' ] : 'date';
        $instance[ 'order' ]    = $new_instance[ 'order' ]   ? $new_instance[ 'order' ] : 'desc';
        
		return $instance;
	}

	public function form( $instance ) {
		//Defaults
        $title      = isset( $instance[ 'title' ] )      ? $instance[ 'title' ] : '';
        
        $orderby    = isset( $instance[ 'orderby' ] )    ? $instance[ 'orderby' ] : 'date';
        $order      = isset( $instance[ 'order' ] )      ? $instance[ 'order' ] : 'desc';
	?>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', THEME_LANG); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'orderby' ); ?>"><?php _e( 'Order By:', THEME_LANG); ?></label> 
            <select class="widefat" id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name('orderby'); ?>">
                <option value="id" <?php selected( 'id', $orderby ) ?>><?php _e( 'ID', THEME_LANG ) ?></option>
            	<option class="author" value="author" <?php selected( 'author', $orderby ) ?>><?php _e( 'Author', THEME_LANG ) ?></option>
            	<option class="name" value="name" <?php selected( 'name', $orderby ) ?>><?php _e( 'Name', THEME_LANG ) ?></option>
            	<option class="date" value="date" <?php selected( 'date', $orderby ) ?>><?php _e( 'Date', THEME_LANG ) ?></option>
            	<option class="modified" value="modified" <?php selected( 'modified', $orderby ) ?>><?php _e( 'Modified', THEME_LANG ) ?></option>
            	<option class="rand" value="rand" <?php selected( 'rand', $orderby ) ?>><?php _e( 'Rand', THEME_LANG ) ?></option>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e( 'Order Way:', THEME_LANG); ?></label> 
            <select class="widefat" id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name('order'); ?>">
                <option value="desc" <?php selected( 'desc', $order ) ?>><?php _e( 'DESC', THEME_LANG ) ?></option>
            	<option value="asc" <?php selected( 'asc', $order ) ?>><?php _e( 'ASC', THEME_LANG ) ?></option>
            </select>
        </p>
        
    <?php
	}

}
add_action( 'widgets_init', function(){
    register_widget( 'Widget_KT_Product_Special' );
} );