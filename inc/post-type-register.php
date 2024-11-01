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

class Woopomo_Register_Post_Type {

	private static $instance;

	public static function getInstance() {
		
		if( self::$instance === null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function __construct() {

		add_action('init', array( $this, 'post_type_register' ) );
		add_action( 'add_meta_boxes', array( $this, 'meta_box_init' ) );
		add_action( 'save_post', array( $this, 'save_meta_box' ) );
	}

	// Post type register
	public function post_type_register() {

	    register_post_type('woo_promo',
			array(
			   'labels'      => array(
			       'name'          => __( 'WooPromo', 'woopromo' ),
			       'singular_name' => __( 'WooPromo', 'woopromo' ),

			   ),
			   'public'      => true,
			   'has_archive' => true,
			   'rewrite'     => array( 'slug' => 'woopromo' ), // my custom slug
			   'supports' => array('title')
			)
	    );

	}

	// Meta Box Init
	public function meta_box_init() {
		add_meta_box(
			'woopromo_meta',
			'Promo Settings',
			array( $this, 'meta_field' ),
			'woo_promo'
		);
	}

	// Meta Field Display Callback
	public function meta_field() {
		?>
		<div class="woopromo-meta-field-wrap">
			<div class="settings-tab">
				<ul>
					<li class="content-settings active" ><?php esc_html_e( 'Content', 'woopromo' ); ?></li>
					<li class="style-settings" ><?php esc_html_e( 'Settings', 'woopromo' ); ?></li>
				</ul>
			</div>
			<!-- Content Area -->
			<div class="content-area settings-show">
				<p style="font-weight: bold"><?php esc_html_e( 'Use this shortcode', 'woopromo' ); ?></p>
				<div class="preview-shortcode" style="background-color: #eee;padding: 6px; margin-bottom: 35px;display: inline-block; ">
					[woopromo promo_id="<?php echo esc_html( get_the_ID() ); ?>"]
				</div>
				<div class="field-item">
					<label><?php esc_html_e( 'Top Title', 'woopromo' ); ?></label>
					<?php 
					$topTitle = get_post_meta( get_the_ID(), 'woopromo_top_title', true );
					?>
					<input type="text" name="top_title" value="<?php echo esc_html( $topTitle ); ?>"/>
				</div>
				<div class="field-item">
					<label><?php esc_html_e( 'Top Bottom Title', 'woopromo' ); ?></label>
					<?php 
					$topBottomTitle = get_post_meta( get_the_ID(), 'woopromo_top_bottom_title', true );
					?>
					<input type="text" name="top_bottom_title" value="<?php echo esc_html( $topBottomTitle ); ?>"/>
				</div>
				<div class="field-item">
					<label><?php esc_html_e( 'Offer Text', 'woopromo' ); ?></label>
					<?php 
					$offerText = get_post_meta( get_the_ID(), 'woopromo_offer_text', true );
					?>
					<input type="text" name="offer_text" value="<?php echo esc_html( $offerText ); ?>"/>
				</div>
				<div class="field-item">
					<label><?php esc_html_e( 'Offer Date', 'woopromo' ); ?></label>
					<?php 
					$date = get_post_meta( get_the_ID(), 'woopromo_offer_date', true );
					?>
					<input type="text" class="jquery-datepicker" name="offer_date" value="<?php echo esc_html( $date ); ?>"/>
				</div>
				<div class="field-item">
					<label><?php esc_html_e( 'Content', 'woopromo' ); ?></label>
					<?php 
					$content = get_post_meta( get_the_ID(), 'woopromo_promo_content', true );
					?>
					<?php  wp_editor( $content, 'promo_content', array('textarea_rows'=>4), false ); ?>
				</div>
			</div>
			<!-- Settings Area -->
			<div class="settings-area settings-hide">
				<div class="field-item">
					<label><?php esc_html_e( 'Select Background Type', 'woopromo' ); ?></label>
					<?php 
					$bgType = get_post_meta( get_the_ID(), 'woopromo_bg_type', true );
					?>
					<select name="bg_type" >
						<option value="premade" <?php selected( $bgType, 'premade' ); ?>><?php esc_html_e( 'Premade Style', 'woopromo' ); ?></option>
						<option value="custom" <?php selected( $bgType, 'custom' ); ?>><?php esc_html_e( 'Custom Style', 'woopromo' ); ?></option>
					</select>
				</div>
				<!-- If premade bg this option will work -->
				<div class="field-item">
					<label><?php esc_html_e( 'Select Background', 'woopromo' ); ?></label>
					<?php 
					$premadeBg = get_post_meta( get_the_ID(), 'woopromo_premade_bg', true );
					?>
					<select name="premade_bg" >
						<option value="style_1" <?php selected( $premadeBg, 'style_1' ); ?>><?php esc_html_e( 'Style 1 ( Star Animation )', 'woopromo' ); ?></option>
						<option value="style_2" <?php selected( $premadeBg, 'style_2' ); ?>><?php esc_html_e( 'Style 2 ( Star Animation )', 'woopromo' ); ?></option>
						<option value="style_3" <?php selected( $premadeBg, 'style_3' ); ?>><?php esc_html_e( 'Style 3 ( Bomb Rrocket )', 'woopromo' ); ?></option>
						<option value="style_4" <?php selected( $premadeBg, 'style_4' ); ?>><?php esc_html_e( 'Style 4 ( Gradient Animation )', 'woopromo' ); ?></option>
						<option value="style_5" <?php selected( $premadeBg, 'style_5' ); ?>><?php esc_html_e( 'Style 5 ( Flat Color )', 'woopromo' ); ?></option>
						<option value="style_6" <?php selected( $premadeBg, 'style_6' ); ?>><?php esc_html_e( 'Style 6 ( Flat Color )', 'woopromo' ); ?></option>
						<option value="style_7" <?php selected( $premadeBg, 'style_7' ); ?>><?php esc_html_e( 'Style 7 ( Flat Color )', 'woopromo' ); ?></option>
						<option value="style_8" <?php selected( $premadeBg, 'style_8' ); ?>><?php esc_html_e( 'Style 8 ( Gradient Color )', 'woopromo' ); ?></option>
						<option value="style_9" <?php selected( $premadeBg, 'style_9' ); ?>><?php esc_html_e( 'Style 9 ( Gradient Color )', 'woopromo' ); ?></option>
					</select>
				</div>
				<!-- End If premade bg this option will work -->
				<!-- If custom bg this option will work -->
				<div class="field-item">
					<label><?php esc_html_e( 'Background Color', 'woopromo' ); ?></label>
					<?php 
					$bgColor = get_post_meta( get_the_ID(), 'woopromo_bg_color', true );
					?>
					<input type="text" class="woopromo-color-field" name="bg_color" value="<?php echo esc_html( $bgColor ); ?>" />
				</div>
				<div class="field-item">
					<label><?php esc_html_e( 'Background Image', 'woopromo' ); ?></label>
					<?php
					$img = get_post_meta( get_the_ID(), 'woopromo_bg_image', true );

					echo $this->woopromo_image_uploader_field( 'bg_image', $img );
					?>
				</div>
				<!-- End If custom bg this option will work -->

				<!-- Title and Text Color Settings -->
				<div class="field-item">
					<label><?php esc_html_e( 'Top Title Color', 'woopromo' ); ?></label>
					<?php 
					$topTitleColor = get_post_meta( get_the_ID(), 'woopromo_top_title_color', true );
					?>
					<input type="text" class="woopromo-color-field" name="top_title_color" value="<?php echo esc_html( $topTitleColor ); ?>" />
				</div>
				<div class="field-item">
					<label><?php esc_html_e( 'Top Bottom Title Color', 'woopromo' ); ?></label>
					<?php 
					$topTitleColor = get_post_meta( get_the_ID(), 'woopromo_top_bottom_title_color', true );
					?>
					<input type="text" class="woopromo-color-field" name="top_bottom_title_color" value="<?php echo esc_html( $topTitleColor ); ?>" />
				</div>
				<div class="field-item">
					<label><?php esc_html_e( 'Text Color', 'woopromo' ); ?></label>
					<?php 
					$textColor = get_post_meta( get_the_ID(), 'woopromo_text_color', true );
					?>
					<input type="text" class="woopromo-color-field" name="text_color" value="<?php echo esc_html( $textColor ); ?>" />
				</div>
				<!-- Offer Text Style -->
				<div class="field-item">
					<label><?php esc_html_e( 'Offer Text Style', 'woopromo' ); ?></label>
					<?php 
					$offerTextStyle = get_post_meta( get_the_ID(), 'woopromo_offer_text_style', true );
					?>
					<select name="offer_text_style" >
						<option value="style-1" <?php selected( $offerTextStyle, 'style-1' ); ?>><?php esc_html_e( 'Style 1', 'woopromo' ); ?></option>
						<option value="style-2" <?php selected( $offerTextStyle, 'style-2' ); ?>><?php esc_html_e( 'Style 2', 'woopromo' ); ?></option>
						<option value="style-3" <?php selected( $offerTextStyle, 'style-3' ); ?>><?php esc_html_e( 'Style 3', 'woopromo' ); ?></option>
					</select>
				</div>
				<!-- CountDown Style -->
				<div class="field-item">
					<label><?php esc_html_e( 'CountDown Style', 'woopromo' ); ?></label>
					<?php 
					$countdownStyle = get_post_meta( get_the_ID(), 'woopromo_countdown_style', true );
					?>
					<select name="countdown_style" >
						<option value="style-1" <?php selected( $countdownStyle, 'style-1' ); ?>><?php esc_html_e( 'Style 1', 'woopromo' ); ?></option>
						<option value="style-2" <?php selected( $countdownStyle, 'style-2' ); ?>><?php esc_html_e( 'Style 2', 'woopromo' ); ?></option>
						<option value="style-3" <?php selected( $countdownStyle, 'style-3' ); ?>><?php esc_html_e( 'Style 3', 'woopromo' ); ?></option>
					</select>
				</div>
				<div class="field-item">
					<label><?php esc_html_e( 'CountDown Text Color', 'woopromo' ); ?></label>
					<?php 
					$countdownTextColor = get_post_meta( get_the_ID(), 'woopromo_countdown_text_color', true );
					?>
					<input type="text" class="woopromo-color-field" name="countdown_text_color" value="<?php echo esc_html( $countdownTextColor ); ?>" />
				</div>
				<div class="field-item">
					<label><?php esc_html_e( 'CountDown Background Color', 'woopromo' ); ?></label>
					<?php 
					$countdownBgColor = get_post_meta( get_the_ID(), 'woopromo_countdown_bg_color', true );
					?>
					<input type="text" class="woopromo-color-field" name="countdown_bg_color" value="<?php echo esc_html( $countdownBgColor ); ?>" />
				</div>
			</div>
		</div>
		<?php

	}

	// Save meta box content.
	public function save_meta_box( $post_id ) {


	  	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	    if ( $parent_id = wp_is_post_revision( $post_id ) ) {
	        $post_id = $parent_id;
	    }

	    $fields = [
	    	'top_title',
	    	'top_bottom_title',
	    	'offer_date',
	    	'offer_text',
	    	'offer_text_style',
	    	'promo_content',
	    	'bg_type',
	    	'premade_bg',
	    	'bg_color',
	    	'bg_image',
	    	'top_title_color',
	    	'top_bottom_title_color',
	    	'text_color',
	    	'countdown_style',
	    	'countdown_text_color',
	    	'countdown_bg_color'
	    ];

		foreach( $fields as $field ) {
			if( array_key_exists( $field , $_POST ) ) {

				if( $field == 'promo_content' || $field == 'offer_text'  ) {
					update_post_meta(  $post_id, 'woopromo_'.$field, wp_kses_post( $_POST[$field] ) );
				} else {
					update_post_meta(  $post_id, 'woopromo_'.$field, sanitize_text_field( $_POST[$field] ) );
				}

			}
		}

		
	}

	// Image uploader field
	function woopromo_image_uploader_field( $name, $value = '') {
		$image = ' button">Upload image';
		$image_size = 'full'; // it would be better to use thumbnail size here (150x150 or so)
		$display = 'none'; // display state ot the "Remove image" button
	 
		if( $image_attributes = wp_get_attachment_image_src( $value, $image_size ) ) {
	 	 
			$image = '"><img src="' . $image_attributes[0] . '" style="max-width:95%;display:block;" />';
			$display = 'inline-block';
	 
		} 
	 
		return '
		<div>
			<a href="#" class="woopromo_upload_image_button' . $image . '</a>
			<input type="hidden" name="' . $name . '" id="' . $name . '" value="' . esc_attr( $value ) . '" />
			<a href="#" class="woopromo_remove_image_button" style="display:inline-block;display:' . $display . '">Remove image</a>
		</div>';
	}
	

}

Woopomo_Register_Post_Type::getInstance();

