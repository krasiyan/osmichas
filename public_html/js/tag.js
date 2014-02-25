$(document).ready(function () {

	if( osmichas.controller == 'image' && osmichas.action == 'tag' ){
		$.extend(osmichas, {
			tag_image: {
				original_image: new Image(),
				ratio: 1.0,
				tags: {}
			}
		});
		osmichas.tag_image.original_image.src = $("#image").attr('src');

		osmichas.tag_image.original_image.onload = set_tags;
		$(window).resize(set_tags);

		function set_tags(){
			var h_orig = osmichas.tag_image.original_image.height;
			var h_dom = $("#image").height();

			ratio = Math.min(h_orig, h_dom) / Math.max(h_orig, h_dom);
			osmichas.tag_image.ratio = ratio;

			for( var tag in tags ) {
				tags[tag].width = tags[tag].width * ratio;
				tags[tag].height = tags[tag].height * ratio;			

				tags[tag].top = tags[tag].top * ratio;
				tags[tag].left = tags[tag].left * ratio;
			}

			$("#image").tag({
				defaultTags: tags,
				minWidth: ($("#image").width() / 10),
				minHeight: ($("#image").width() / 10),
				defaultWidth: ($("#image").width() / 4),
				defaultHeight: ($("#image").width() / 4),
				clickToTag: true,
				showTag: 'always',
				save: function(width,height,top,left,label,the_tag){
					ratio = 1.0 / osmichas.tag_image.ratio;
			
					$.ajax(osmichas.url_base + "ajax/save_tag/", {
						method: 'post',
						dataType: 'json',
						data: {
							imageid: $("#image").data('iddb'),
							width: Math.round( width*ratio ),
							height: Math.round( height*ratio ),
							top: Math.round( top*ratio ),
							left: Math.round( left*ratio ),
							label: label
						},
						async: true
					}).done(function (data) {

					});
				},
				remove: function(id){
					$.ajax(osmichas.url_base + "ajax/delete_tag/", {
						method: 'post',
						dataType: 'json',
						data: {
							imageid: $("#image").data('iddb'),
							tagid: id
						},
						async: true
					}).done(function (data) {

					});
				}
			});

		}
	}
})