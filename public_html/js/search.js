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
			// ajax: {
			// 	url: osmichas.url_base + "ajax/userlabels",
			// 	dataType: 'json',
			// 	data: function (term, page) {
			// 		return {
			// 			q: term, // search term
			// 			page_limit: 10
			// 		};
			// 	},
			// 	results: function (data, page) { // parse the results into the format expected by Select2.
			// 		// since we are using custom formatting functions we do not need to alter remote JSON data
			// 		// return {results: data.movies};
			// 		console.log(data);
			// 	}
			// },
		});
	});
})