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
		var max_width = $('#search-results').width()/4;
		$('#search-results img').each(function(img){
			$($('#search-results img')[img]).css({'maxWidth' : max_width});
			// console.log($('#search-results img')[img]);
		});
		$('#search-results').isotope({
			itemSelector : '.tag',
			layoutMode : 'masonry',
			animationEngine: 'best-available',
			masonry: {
				columnWidth: 1
			}
		},function(){
			$('.fancybox').fancybox({
				type: 'ajax',
				autoSize: false,
				// autoResize: true,
				fitToView: true,
				// aspectRatio: true,
				title: 'test',
				titlePosition: 'over',
				closeEffect: 'elastic',
				beforeLoad: function() {
					this.title = $(this.element).children().first().attr('title');
				},
				afterShow: function(){
					$.fancybox.update();
					// $.fancybox.center();
				}
			});
		});
	}

	$('#search-results').imagesLoaded(function(e){
		$('#search-results').show();
		initIsotope();
	});
	
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
					$('#search-results').html('');
					$('#search-results').isotope('destroy');
					$('#search-results').css({'display':'none'});
					$('#search-results').append(data);

					$('#search-results').imagesLoaded(function(e){
					$('#search-results').css({'display':'block'});
						initIsotope();
					})
				}
			});
		}
	})

})