$(document).ready(function () {
	$("#image").tag({
		clickToTag: true
	});

	$(".jTagPngOverlay").bind('mousemove', function(e) {

		$(this).animate({
			'background-position-x': e.pageX,
			'background-position-y': e.pageY
		}, 100, 'swing');

	})
})