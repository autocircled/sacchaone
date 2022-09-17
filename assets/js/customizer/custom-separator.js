(function ($) {
	$("body").on(
		"click",
		".sacchaone-separator-title-area",
		function () {
			let $this = $(this).closest(".customize-control-sacchaone_separator");
			let toggleIcon = $(this).find(".sacchaone-toggle-control");
			var raw_ids = $(toggleIcon).attr("target_ids").split(" ");
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
