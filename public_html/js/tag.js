$(document).ready(function () {

// $("#image").tag({
// 	showTag: 'hover'
// });

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
		console.log(ratio)

		for( var tag in tags ) {
			tags[tag].width = tags[tag].width * ratio;
			tags[tag].height = tags[tag].height * ratio;			

			tags[tag].top = tags[tag].top * ratio;
			tags[tag].left = tags[tag].left * ratio;
		}

		$("#image").tag({
			minWidth: ($("#image").width() / 10),
			minHeight: ($("#image").width() / 10),
			defaultWidth: ($("#image").width() / 4),
			defaultHeight: ($("#image").width() / 4),
			clickToTag: true,
			showTag: 'always',
			save: function(width,height,top_pos,left,label,the_tag){
				console.log('I can save this tag ('+width+','+height+','+top_pos+','+left+','+label+')');
			},
			remove: function(id){
				console.log('Here I can do some ajax to delete tag #'+id+' in my db');
			},
			defaultTags: tags
		});

	}
})