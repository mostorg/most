/**
 * Most Scripts & Functions
 */
jQuery(document).ready(function($) {
	//alert('document ready occurred!');

    $('.theme-sets').click(function(){
        $this = $(this);
        //get these tricky values individually
        var values = {
            'selected_theme_set' : $this.attr('data-set')
        };
        var data = {
            action: 'most_theme_set_ajax',
            options: values
        };
        $.post(ajaxurl, data, function( msg ) {
            //things to do
            console.log($this.attr('data-set'));
        });
    });

    $('#calendar .day-number').popover({ html : true });

});

jQuery(window).load(function($) {
	//alert('window load occurred!');
});