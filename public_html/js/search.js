$(document).ready(function () {
	$.ajax(osmichas.url_base + "ajax/labels/", {
		dataType: 'json',
		async: true
	}).done(function (data) {
		var headline = [{ text: 'Можеш да ибереш една или повече категории', disabled: true}];
		var data_with_headline = headline.concat(data);

		$('#home-search').add('#header-search').select2({
			data: data_with_headline,
			tags: [],
			maximumInputLength: 30,
			selectOnBlur: true,
			minimumResultsForSearch: 100,
			createSearchChoice: function(term) {
				return {id: term, text: term};
			},
			formatSearching: function() {return 'Търсене...'},
			formatNoMatches: function() {return 'Няма намерени съвпадения...'}
		});
	});

	$("#home-search-form").bind('submit', function(e){
		e.preventDefault();
		if ( $("#home-search").val() ) {
			$.ajax(osmichas.url_base + "ajax/search", {
				method: 'POST',
				dataType: 'json',
				async: true,
				data: {
					'search': $("#home-search").val()
				}
			}).done(function (data) {
				var max_width = $('#search-results').width()/3;
				for (image in data){
					var $tag = $('<img src="'+osmichas.url_base +'image/fetch_tag/'+image+'" class="tag" title="'+data[image]+'" />');
					$tag.css('max-width', max_width);
					$tag.imagesLoaded(function(e){
						$('#search-results').isotope( 'insert', e );		
					})
				}
			});
		}
	})
	$('#search-results').isotope({
		itemSelector : '.tag',
		layoutMode : 'masonry',
		animationEngine: 'css'
	});

})