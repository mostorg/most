/**
 * Most Scripts & Functions
 *
 */
jQuery(document).ready(function($) {
	//alert('document ready occurred!');
	$('#side-menu li').toggle(function(){
		$('ul', this).show();
	},function(){
		$('ul', this).hide();
	});

	//theme sets
	// $('#theme-bar li').click(function(){
	// 	var set = $('a',this).attr('href').substring(1);
	// 	$('body').addClass(set);
	// });

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

});

jQuery(window).load(function($) {
	//alert('window load occurred!');
});