// http://www.slideshare.net/rmurphey/building-large-jquery-applications
// http://weblog.bocoup.com/publishsubscribe-with-jquery-custom-events
// http://ejohn.org/blog/simple-javascript-inheritance/

;(function($) {
	$('#previewTrigger').click(function(event) {
		var $form = $(event.target).parents('form');
		var url = $form.attr('action');

		$.fancybox({
			href: url,
			type: 'iframe',
			ajax: {
				data: $form.serialize(),
				type: 'POST'
			},
			onStart: function() {},
			onCancel: function() {},
			onComplete: function() {},
			onCleanup: function() {},
			onClosed: function() {}
		});

		event.preventDefault();
	});
})(jQuery);