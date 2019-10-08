jQuery(function($){
    $(window).load(function() {
    	var load = $("div").data('loader');
       	// Animate loader off screen
        $(".loader_" + load).fadeOut("slow");
	});
});