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
});

jQuery(window).load(function($) {
	//alert('window load occurred!');
});