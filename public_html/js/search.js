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
	
	function initIsotope()
	{
		$('#search-results').isotope({
			itemSelector : '.tag',
			layoutMode : 'masonry',
			animationEngine: 'best-available',
			masonry: {
				columnWidth: 50
			}
		},function(){
			$('.fancybox').fancybox({
				type: 'ajax',
				// autoSize: true,
				// autoResize: true,
				fitToView: true,
				// aspectRatio: true,
				title: 'test',
				titlePosition: 'over',
				closeEffect: 'elastic',
				beforeLoad: function() {
					this.title = $(this.element).children().first().attr('title');
				}
			});
		});
	}

	$('#search-results').imagesLoaded(function(e){
		initIsotope();
	})
	
	$("#home-search-form").bind('submit', function(e){
		e.preventDefault();
		if ( $("#home-search").val() ) {
			$.ajax(osmichas.url_base + "ajax/search", {
				method: 'POST',
				dataType: 'html',
				async: true,
				data: {
					'search': $("#home-search").val()
				}
			}).done(function (data) {
				if( ! data ){
					$('#search-results').isotope('destroy');
					$('#search-results').html('<h4 class="text-center">Няма намерени резултати</h4>');
				}
				else {
					var max_width = $('#search-results').width()/3;
					
					$('#search-results').html('');
					$('#search-results').isotope('destroy');
					
					$('#search-results').append(data);
					$('#search-results img').each(function(img){
						$(img).css('maxWidth', max_width);
					});
					$('#search-results').imagesLoaded(function(e){
						initIsotope();
					})
				}
			});
		}
	})

})