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

class Woopromo_Woo_promo_config {

	function __construct() {

		add_action( 'woocommerce_before_add_to_cart_button', array( $this, 'use_shortcode' ) );

	}

	public function use_shortcode() {

		$promo = get_post_meta( get_the_ID(), 'woopromo_shortcode', true);

		if( $promo && $promo != 'none' ) {
			echo do_shortcode('[woopromo promo_id="'.esc_attr( $promo ).'"]');
		}

	}

}
new Woopromo_Woo_promo_config();

