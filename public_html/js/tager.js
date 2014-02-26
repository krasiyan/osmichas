$(function(){
	$.extend(osmichas, {
		initTager: function() {
			$.extend(osmichas, {
				tag_image: {
					original_image: new Image(),
					ratio: 1.0,
					tags: {}
				}
			});
			osmichas.tag_image.original_image.src = $("#image").attr('src');

			osmichas.tag_image.original_image.onload = osmichas.setTags;
			$(window).resize(osmichas.setTags);
		}, 
		setTags: function(){
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
	});

	if ( osmichas.controller == 'image' && osmichas.action == 'tager' ){
		osmichas.initTager();

		$.ajax(osmichas.url_base + "ajax/labels/", {
			dataType: 'json',
			async: true
		}).done(function (data) {
			var headline = [{ text: 'Можеш да ибереш една или повече категории', disabled: true}];
			var data_with_headline = headline.concat(data);
			$('#image-labels').select2({
				data: data_with_headline,
				tags: [],
				maximumInputLength: 30,
				selectOnBlur: true,
				minimumResultsForSearch: 100,
				formatNoMatches: function() {return 'Липсват отговарящи на търсенето категории...'},
				width: '75%'
			}).on("select2-selecting", function(e) { 
				$.ajax(osmichas.url_base + "ajax/image_label/", {
					method: 'post',
					dataType: 'json',
					data: {
						action: 'add',
						imageid: $("#image").data('iddb'),
						labelid: e.val
					},
					async: true
				}).done(function (data) {
					console.log(data);
					console.log($("#image").data('iddb'));
				});
			}).on("select2-removing", function(e) { 
				$.ajax(osmichas.url_base + "ajax/image_label/", {
					method: 'post',
					dataType: 'json',
					data: {
						action: 'remove',
						imageid: $("#image").data('iddb'),
						labelid: e.val
					},
					async: true
				}).done(function (data) {
					console.log(data);
					console.log($("#image").data('iddb'));
				});
			});

			$('#image-labels').select2('val', labels);

		});
	}
})