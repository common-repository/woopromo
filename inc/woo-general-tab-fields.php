<?php
/**
 * WooPromo
 *
 * @package     WooPromo
 * @author      Codingeek
 * @copyright   2019 Codingeek
 * @license     GPL-2.0-or-later
 *
 *
 */


if( !defined( 'WPINC' ) ) {
    die;
}

class Woopromo_Woo_General_Tab_Fields{

	function __construct() {

		add_action( 'woocommerce_product_options_general_product_data', [ $this, 'general_tab_custom_field' ] );

		add_action( 'woocommerce_process_product_meta', [ $this, 'general_tab_custom_field_data_save' ] );

		add_filter( 'sanitize_post_meta_woopromo_shortcode', [ $this, 'sanitize_meta_woopromo_shortcode' ] );

	}

	// 
	public function general_tab_custom_field() {

		$value = get_post_meta( get_the_ID(), 'woopromo_shortcode', true );

		// Select
		woocommerce_wp_select(
			array( 
			  'id' => 'woopromo_shortcode', 
			  'label' => __( 'Select Promo Banner', 'woopromo' ), 
			  'options' => $this->get_all_promo(),
			  'value'   => esc_attr($value),
			)
		);
	}

	//
	public function get_all_promo() {

		$args = array(
			'post_type' => 'woo_promo',
			'posts_per_page' => '-1',
		);

		$allPromo = get_posts( $args );

		$promoCodes = [ 'none' => 'None' ];

		foreach ( $allPromo as $val ) {
			$promoCodes[$val->ID] = $val->post_title;
		}

		return $promoCodes;

	}

	// Save Fields
	function general_tab_custom_field_data_save( $post_id ) {

		// Select
	    if( !empty( $_POST['woopromo_shortcode'] ) ) {

	    	$metaValue = sanitize_meta( 'woopromo_shortcode', $_POST['woopromo_shortcode'], 'post' );

	        update_post_meta( $post_id, 'woopromo_shortcode', $metaValue );

	    }

	}

	//
	function sanitize_meta_woopromo_shortcode( $shortcodeId ) {

		if( isset( $shortcodeId ) && $shortcodeId != 'none' ) {
			$data = $shortcodeId;
		} else {
			$data = 'none';
		}

		return  sanitize_text_field( $data ); 

	}

}

new Woopromo_Woo_General_Tab_Fields();

