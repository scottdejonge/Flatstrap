// Avoid `console` errors in browsers that lack a console.
if (!(window.console && console.log)) {
    (function() {
        var noop = function() {};
        var methods = ['assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error', 'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log', 'markTimeline', 'profile', 'profileEnd', 'markTimeline', 'table', 'time', 'timeEnd', 'timeStamp', 'trace', 'warn'];
        var length = methods.length;
        var console = window.console = {};
        while (length--) {
            console[methods[length]] = noop;
        }
    }());
}

(function($){})(window.jQuery);

jQuery(document).ready(function (){

	/* Modal */
	
	$('#modal').modal({
		show: true
	});
	
	/* Carousel */
	
	$('#carousel').carousel({
		interval: 6000
	});
	
	$(".carousel-indicators li:first").addClass("active");
	$(".carousel-inner .item:first").addClass("active");

	/* Gallery */
	
	$('.gallery').addClass('row');
	
	$('.gallery-item').addClass('span2');
	
	/* Tooltip */
	
	$('a[rel=tooltip]').tooltip();
	
	$('a[rel=popover]').popover({
		trigger: 'hover'
	});
	
});   