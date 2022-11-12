wp.customize.controlConstructor["sacchaone-slider"] =
	wp.customize.Control.extend({
		ready: function () {
			"use strict";
			var e,
				t,
				n = this,
				i = n.container.find(".sacchaone-slider.desktop-slider"),
				a = i
					.next(".sacchaone-slider-input")
					.find("input.desktop-input"),
				s = n.container.find(".sacchaone-slider.tablet-slider"),
				l = s
					.next(".sacchaone-slider-input")
					.find("input.tablet-input"),
				u = n.container.find(".sacchaone-slider.mobile-slider"),
				p = u
					.next(".sacchaone-slider-input")
					.find("input.mobile-input");
			i.slider({
				range: "min",
				value: a.val(),
				min: +a.attr("min"),
				max: +a.attr("max"),
				step: +a.attr("step"),
				slide: function (e, t) {
					a.val(t.value).keyup();
				},
				change: function (e, t) {
					n.settings.desktop.set(t.value);
				},
			}),
				s.slider({
					range: "min",
					value: l.val(),
					min: +l.attr("min"),
					max: +l.attr("max"),
					step: +a.attr("step"),
					slide: function (e, t) {
						l.val(t.value).keyup();
					},
					change: function (e, t) {
						n.settings.tablet.set(t.value);
					},
				}),
				u.slider({
					range: "min",
					value: p.val(),
					min: +p.attr("min"),
					max: +p.attr("max"),
					step: +a.attr("step"),
					slide: function (e, t) {
						p.val(t.value).keyup();
					},
					change: function (e, t) {
						n.settings.mobile.set(t.value);
					},
				}),
				jQuery("input.desktop-input").on(
					"change keyup paste",
					function () {
						(e = jQuery(this)),
							(t = e.val()),
							e
								.parent()
								.prev(".sacchaone-slider.desktop-slider")
								.slider("value", t);
					}
				),
				jQuery("input.tablet-input").on(
					"change keyup paste",
					function () {
						(e = jQuery(this)),
							(t = e.val()),
							e
								.parent()
								.prev(".sacchaone-slider.tablet-slider")
								.slider("value", t);
					}
				),
				jQuery("input.mobile-input").on(
					"change keyup paste",
					function () {
						(e = jQuery(this)),
							(t = e.val()),
							e
								.parent()
								.prev(".sacchaone-slider.mobile-slider")
								.slider("value", t);
					}
				),
				n.container.on(
					"change keyup paste",
					".desktop input",
					function () {
						n.settings.desktop.set(jQuery(this).val());
					}
				),
				n.container.on(
					"change keyup paste",
					".tablet input",
					function () {
						n.settings.tablet.set(jQuery(this).val());
					}
				),
				n.container.on(
					"change keyup paste",
					".mobile input",
					function () {
						n.settings.mobile.set(jQuery(this).val());
					}
				);
		},
	});
