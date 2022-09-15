(function ($) {
	$("body").on(
		"click",
		".sacchaone-toggle-control, .toggle-text",
		function () {
			let parentEl = $(this).parent();
			let $this = $(parentEl).find(".sacchaone-toggle-control");
			var raw_ids = $($this).attr("target_ids").split(" ");
			if ($($this).hasClass("showing")) {
				$($this).removeClass("showing");
				$(raw_ids).each(function (i, v) {
					$("#customize-control-" + v).hide();
				});
			} else {
				$($this).addClass("showing");
				$(raw_ids).each(function (i, v) {
					$("#customize-control-" + v).show();
				});
			}
		}
	);
})(jQuery);
