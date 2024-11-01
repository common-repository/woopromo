<?php
/**
 * WooPromo
 *
 * @package     WooPromo
 * @author      Codingeek
 * @copyright   2019 Codingeek
 * @license     GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name: WooPromo
 * Plugin URI:  https://codingeek.net/wp/woopromo
 * Description: WooPromo allow you to create beautiful promotional action banner with or without countdown to inform your customers about upcoming events or offer.
 * Version:     1.0.4
 * Author:      Codingeek
 * Author URI:  https://codingeek.net/
 * Text Domain: woopromo
 * License:     GPL v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 */

if( !defined( 'WPINC' ) ) {
    die;
}

/**
 * Define Plugin Dir Path Url constant
 * @since 1.0
 *
 */

// Plugin version
define( 'WOOPROMO_VERSION', '1.0.0' );

// Plugin base dir path
define('WOOPROMO_DIR_PATH' ,plugin_dir_path( __FILE__ ) );

// Admin dir path
define('WOOPROMO_DIR_ADMIN' , trailingslashit( WOOPROMO_DIR_PATH. 'admin' ) );

// Inc dir path
define('WOOPROMO_DIR_INC' , trailingslashit( WOOPROMO_DIR_PATH. 'inc' ) );

// Plugin base dir url
define('WOOPROMO_DIR_URL', plugin_dir_url( __FILE__ ) );


final class WooPromo{

	function __construct() {

		$this->init();

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_script' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_script' ) );
		add_filter( 'manage_woo_promo_posts_columns', array( $this, 'woopromo_posts_columns' ) );
		add_action( 'manage_woo_promo_posts_custom_column', array( $this, 'woopromo_data_column' ), 10, 2);
	}

	/**
	 * Initialize the plugin
	 *
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init() {

		// Init include file
		$this->include_files();

	}

	/**
	 * Enqueue Front-End Script
	 *
	 *
	 * @since 1.0.0
	 * @access public
	 */

	public function enqueue_frontend_script() {
		wp_enqueue_style( 'countdown', WOOPROMO_DIR_URL.'/assets/css/countdown.css', array(), '1.0.0', false );
		wp_enqueue_script( 'countdown', WOOPROMO_DIR_URL.'/assets/js/countdown.js', array(), '1.0.0', true );
		wp_enqueue_script( 'woopromo', WOOPROMO_DIR_URL.'/assets/js/woopromo.js', array('jquery'), '1.0.0', true );
	}
	/**
	 * Enqueue Front-End Script
	 *
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function enqueue_admin_script() {

		wp_enqueue_style( 'wp-color-picker' );

		wp_enqueue_style( 'woopromo-admin', WOOPROMO_DIR_URL.'/assets/css/admin.css', array(), '1.0.0', false );
		wp_enqueue_style( 'jquery-ui-datepicker-style' , WOOPROMO_DIR_URL.'/assets/css/jquery-ui.css');

		wp_enqueue_media();
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'woopromo-admin', WOOPROMO_DIR_URL.'/assets/js/admin.js', array( 'jquery','wp-color-picker', 'media-upload' ), '1.0.0', true );

	}

	/**
	 * Include require files
	 *
	 *
	 * @since 1.0.0
	 * @access public
	 */

	public function include_files() {
		require_once( WOOPROMO_DIR_INC.'woo-general-tab-fields.php' ) ;
		require_once( WOOPROMO_DIR_INC.'post-type-register.php' ) ;
		require_once( WOOPROMO_DIR_INC.'woo-promo-config.php' ) ;
		require_once( WOOPROMO_DIR_INC.'promo-shortcode.php' ) ;
	} 




// Add Column

public function woopromo_posts_columns( $columns ) {
  $columns['shortcode'] = __( 'Shortcode', 'woopromo' );
  return $columns;
}

// Column data


public function woopromo_data_column( $column, $post_id ) {



  // Image column
  if ( 'shortcode' === $column ) {

  	?>
  	<style>
  		.show-shortcode {
		  	background-color: #eee;
		    padding: 6px;
		    display: inline-block;
		    border-radius: 4px;
  		}
  		.woo-shortcode-copy{
	  	padding: 5px;
	    background-color: #bababa;
	    margin-left: 7px;
	    cursor: pointer;
	    color: #000;
	    text-align: center;
	    border-radius: 4px;
	    transition: 0.5s;
  		}
  		.woo-shortcode-copy:hover{
	    background-color: red;
	    color: #fff;
  		}
  	</style>
  	
  	<?php


  	echo '<div class="show-shortcode">[woopromo promo_id="'.esc_html( get_the_ID() ).'"]</div>';

  }


}


}

new WooPromo();
?>