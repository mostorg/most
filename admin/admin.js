/**
 * Most Admin Theme Scripts & Functions
 *
 */
jQuery(document).ready(function($) {
	$('.handlediv, .hndle').click(function(){
		$(this).parent().toggleClass('closed');
	});

    var custom_uploader;
    $('.upload-image-button').click(function(e) {
    	var button = $(this);
        e.preventDefault();
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: { text: 'Save Image' },
            multiple: false
        });
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            var id = button.attr('name');
            $('#'+id).val(attachment.url);
            button.next('img').attr( 'src', attachment.url );
        });
        //Open the uploader dialog
        custom_uploader.open();
    });

    //$( '#event-start-date' ).datepicker();
});