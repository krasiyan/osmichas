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
		var max_width = $('#search-results').width()/5;
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
		togglePreloader();
		$('#search-results').show();
		initIsotope();
	});
	
	$("#home-search-form").bind('submit', function(e){
		e.preventDefault();
		if ( $("#home-search").val() ) {
			$('#search-results').isotope('destroy');
			$('#search-results').html('');
			togglePreloader();
		
			$.ajax(osmichas.url_base + "ajax/search_image", {
				method: 'POST',
				dataType: 'html',
				async: true,
				data: {
					'search': $("#home-search").val()
				}
			}).done(function (data) {
				if( ! data ){
					togglePreloader();
					$('#search-results').html('<h4 class="text-center">Няма намерени резултати</h4>');
				}
				else {
					$('#search-results').css({'display':'none'});
					$('#search-results').append(data);

					$('#search-results').imagesLoaded(function(e){
						togglePreloader(function(){
							$('#search-results').css({'display':'block'});
							initIsotope();
						});
					})
				}
			});
		}
	})

	function togglePreloader(next){
		$("#preloader").slideToggle(400, next);
	}

})