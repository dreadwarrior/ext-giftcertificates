try {
	jQuery(function($) {
		$('.action-bar input, .action-bar a').button();

		$('#shipping_type').change(function() {
			var targetId = '#shipping_type_'+ $(this).val();

			$('.shipping-type:visible').toggle();
			$(targetId).toggle();
		})
	});
} catch (e) {}