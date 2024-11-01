;(function($) {
  'use strict';


  	$('.woopromo-color-field').wpColorPicker();

  	 $('.jquery-datepicker').datepicker();

	/*
	 * Select/Upload image(s) event
	 */
	$('body').on('click', '.woopromo_upload_image_button', function(e){
		e.preventDefault();
 
    		var button = $(this),
    		    custom_uploader = wp.media({
			title: 'Insert image',
			library : {
				// uncomment the next line if you want to attach image to the current post
				// uploadedTo : wp.media.view.settings.post.id, 
				type : 'image'
			},
			button: {
				text: 'Use this image' // button label text
			},
			multiple: false // for multiple image selection set to true
		}).on('select', function() { // it also has "open" and "close" events 
			var attachment = custom_uploader.state().get('selection').first().toJSON();
			$(button).removeClass('button').html('<img class="true_pre_image" src="' + attachment.url + '" style="max-width:95%;display:block;" />').next().val(attachment.id).next().show();

		})
		.open();
	});
 
	/*
	 * Remove image event
	 */
	$('body').on('click', '.woopromo_remove_image_button', function(){
		$(this).hide().prev().val('').prev().addClass('button').html('Upload image');
		return false;
	});


	// Settings Click event
	$( '.content-settings' ).on( 'click', function() {

		var $this = $( this );

		$( '.style-settings' ).removeClass('active');

		$this.addClass( 'active' );


		// Settings area event

		var contentArea = $('.content-area'),
			settingsArea = $('.settings-area');

		contentArea.removeClass( 'settings-hide' );
		settingsArea.removeClass( 'settings-show' );

		contentArea.addClass( 'settings-show' );
		settingsArea.addClass( 'settings-hide' );

	} );

	//
	$( '.style-settings' ).on( 'click', function() {

		var $this = $( this );

		$( '.content-settings' ).removeClass('active');
		$this.addClass( 'active' );

		// Settings area event

		var settingsArea = $('.settings-area'),
			contentArea = $('.content-area');

		settingsArea.removeClass( 'settings-hide' );
		contentArea.removeClass( 'settings-show' );

		settingsArea.addClass( 'settings-show' );
		contentArea.addClass( 'settings-hide' );

	} )




})(jQuery);
