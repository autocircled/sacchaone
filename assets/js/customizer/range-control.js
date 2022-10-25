(function ($) {
	wp.customize("sacchaone_container_width", function (value) {
		value.bind(function (to) {
			$(".sacchaone-range-input").val(to);
		});

		$(".sacchaone-reset-range-control").on("click", function () {
			$(".sacchaone-range-input").val(
				SACCHAONE_CUSTOMIZE_DATA.range_control_default
			);
			$(".sacchaone-range-input").trigger("change");
		});
	});
})(jQuery);
