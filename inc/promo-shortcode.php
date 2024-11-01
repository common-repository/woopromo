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

class Woopromo_Promo_Shortcode{

	function __construct() {

		add_shortcode( 'woopromo', array( $this, 'promo_shortcode_genarate' ) );

	}

	public function promo_shortcode_genarate( $atts ) {

		$attr = shortcode_atts( array(
			'promo_id' => ''
		), $atts );


		$promo_id = $attr['promo_id'];

		// Top Title 
		$topTitle = get_post_meta( $promo_id, 'woopromo_top_title', true );
		$topBottomTitle = get_post_meta( $promo_id, 'woopromo_top_bottom_title', true );
		$offerText = get_post_meta( $promo_id, 'woopromo_offer_text', true );
		$offerTextStyle = get_post_meta( $promo_id, 'woopromo_offer_text_style', true );
		$offerDate = get_post_meta( $promo_id, 'woopromo_offer_date', true );
		$promoContent = get_post_meta( $promo_id, 'woopromo_promo_content', true );
		$bgType = get_post_meta( $promo_id, 'woopromo_bg_type', true );
		$bgStyle = get_post_meta( $promo_id, 'woopromo_premade_bg', true );

		$bgColor = get_post_meta( $promo_id, 'woopromo_bg_color', true );
		$bgImg = get_post_meta( $promo_id, 'woopromo_bg_image', true );

		$topTitleColor = get_post_meta( $promo_id, 'woopromo_top_title_color', true );
		$topBottomTitleColor = get_post_meta( $promo_id, 'woopromo_top_bottom_title_color', true );
		$textColor = get_post_meta( $promo_id, 'woopromo_text_color', true );
		$countDownStyle = get_post_meta( $promo_id, 'woopromo_countdown_style', true );
		$countdownTextColor = get_post_meta( $promo_id, 'woopromo_countdown_text_color', true );
		$countdownBgColor = get_post_meta( $promo_id, 'woopromo_countdown_bg_color', true );

		// init variable
		$night = $pixelstars = false;
		$preBgStyle = $inlineStyle = '';


		// Bg type and  style
		if( $bgType == 'premade' ) {

			switch( $bgStyle ) {
				case 'style_1': 
						$preBgStyle = 'shooting-star-wrapper';
						$night = true;
					break;
				case 'style_2': 
						$preBgStyle = 'pixel-star';
						$pixelstars = true;
					break;
				case 'style_3':
						$preBgStyle = 'promo-bomb-rocket';
					break;
				case 'style_4':
						$preBgStyle = 'gradient-bg';
					break;
				case 'style_5':
						$preBgStyle = 'flat-color-blue-martina';
					break;
				case 'style_6':
						$preBgStyle = 'flat-color-leagues-under-the-sea';
					break;
				case 'style_7':
						$preBgStyle = 'flat-color-jalapeno-red';
					break;
				case 'style_8':
						$preBgStyle = 'gradient-bg-1';
					break;
				case 'style_9':
						$preBgStyle = 'gradient-bg-2';
					break;
			}

		} else {

			$styleBgColor = $styleBgImg = '';

			// Bg Color
			if( $bgColor ) {
				$styleBgColor = 'background-color:'.$bgColor.';';
			}
			// Bg image
			if( $bgImg ) {

				$url = wp_get_attachment_url( $bgImg );

				$styleBgImg = 'background-image:url('.esc_url( $url ).');';
			}

			if( $styleBgColor || $styleBgImg ) {
				$inlineStyle = 'style="'.$styleBgColor.$styleBgImg.'"';
			}

		}

		ob_start();

		?>
		
		<div class="promo-wrapper <?php echo esc_attr( $preBgStyle.' promo-'.$promo_id ); ?>" <?php echo $inlineStyle; ?>>

			<?php 
			if( $preBgStyle == 'promo-bomb-rocket' ):
			?>

			<div class="bomb-rocket"></div>
			<div class="bomb-rocket"></div>
			<div class="bomb-rocket"></div>
			<div class="bomb-rocket"></div>
			<div class="bomb-rocket"></div>
			<div class="bomb-rocket"></div>
			<div class="bomb-rocket"></div>
			<div class="bomb-rocket"></div>
			<div class="bomb-rocket"></div>
			<div class="bomb-rocket"></div>
			<div class="bomb-rocket"></div>
			<div class="bomb-rocket"></div>
			<div class="bomb-rocket"></div>
			<div class="bomb-rocket"></div>
			<div class="bomb-rocket"></div>
			<div class="normal-rocket"></div>
			<div class="normal-rocket"></div>
			<div class="normal-rocket"></div>
			<div class="normal-rocket"></div>
			<div class="normal-rocket"></div>
			<div class="normal-rocket"></div>
			<div class="normal-rocket"></div>
			<div class="normal-rocket"></div>
			<div class="normal-rocket"></div>
			<div class="normal-rocket"></div>
			<div class="normal-rocket"></div>
			<div class="normal-rocket"></div>
			<div class="normal-rocket"></div>
			<div class="normal-rocket"></div>
			<div class="normal-rocket"></div>
			
			<?php 
			endif;
			?>

			<?php 
			if( $night ):
			?>
			<div class="night">
				<div class="shooting_star"></div>
				<div class="shooting_star"></div>
				<div class="shooting_star"></div>
				<div class="shooting_star"></div>
				<div class="shooting_star"></div>
				<div class="shooting_star"></div>
				<div class="shooting_star"></div>
				<div class="shooting_star"></div>
				<div class="shooting_star"></div>
				<div class="shooting_star"></div>
				<div class="shooting_star"></div>
				<div class="shooting_star"></div>
				<div class="shooting_star"></div>
				<div class="shooting_star"></div>
				<div class="shooting_star"></div>
				<div class="shooting_star"></div>
				<div class="shooting_star"></div>
				<div class="shooting_star"></div>
				<div class="shooting_star"></div>
				<div class="shooting_star"></div>
			</div>
			<?php
			endif;
			?>
			<?php 
			if( $pixelstars ):
			?>
			<div id="pixelstars"></div>
			<div id="pixelstars2"></div>
			<div id="pixelstars3"></div>
			<?php 
			endif;
			?>

			<div class="promo-text">

				<?php 
				if( $offerText ) {
					if( $offerTextStyle == 'style-1' ) {
						echo '<h4 class="text">'.wp_kses_post( $offerText ).'</h4>';
					} else if( $offerTextStyle == 'style-2' ) {
						echo '<div class="text-animation-1"><span>'.wp_kses_post( $offerText ).'</span></div>';
					} else{
						echo '<h1 class="offer-text-2">'.wp_kses_post( $offerText ).'</h1>';
					}
				}
				// Top Title
				if( !empty( $topTitle ) ) {
					echo '<h2 style="color:'.esc_attr( $topTitleColor ).';">'.esc_html( $topTitle ).'</h2>';
				}
				// Top Bottom Title
				if( !empty( $topBottomTitle ) ) {
					echo '<h3 style="color:'.esc_attr( $topBottomTitleColor ).';">'.esc_html( $topBottomTitle ).'</h3>';
				}
				//
				if( !empty( $promoContent ) ) {
					echo '<p style="color:'.esc_attr( $textColor ).';">'.esc_html( $promoContent ).'</p>';
				}
				?>
			
			</div>

			<?php 
			if( !empty( $offerDate ) ):
				$created = date_create( $offerDate );
				$date = date_format( $created, "Y/m/d" );
			//
			if( $countdownTextColor || $countdownBgColor ):
			?>

			<style>
				.promo-wrapper.promo-<?php echo esc_attr( $promo_id ); ?> .promo-clock-wrapper .clock ul li {
					background-color: <?php echo esc_html( $countdownBgColor ); ?>;
					color: <?php echo esc_html( $countdownTextColor ); ?>;
				}
			</style>
			<?php 
			endif;
			?>

			<div class="promo-clock-wrapper <?php echo esc_attr( $countDownStyle ); ?>">
				<span class="clock" data-countdown="<?php echo esc_html( $date ); ?>"></span>
			</div>
			<?php 
			endif;
			?>

		</div>

		<?php

		return ob_get_clean();
	}


}
new Woopromo_Promo_Shortcode();

