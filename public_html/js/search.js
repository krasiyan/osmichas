$(document).ready(function () {
	var preload_data = [
		{ text: 'Можеш да ибереш една или повече категории', disabled: true},
		{ id: 'year_all', text: 'Учебни години 1-12 клас', children:[
			{ id: 'year_1', text: '1 клас'},
			{ id: 'year_2', text: '2 клас'},
			{ id: 'year_3', text: '3 клас'},
			{ id: 'year_4', text: '4 клас'},
			{ id: 'year_5', text: '5 клас'},
		]},		
		{ id: 'bio', text: 'Биология', children:[
			{ id: 'bio_anat', text: 'Анатомия'},
			{ id: 'bio_eco', text: 'Екология'},
			{ id: 'bio_oth', text: 'Еволюция'}
		]},
		{ id: 'math', text: 'Математика', children: [
			{ id: 'math_geo', text: 'Геометрия'},
			{ id: 'math_alg', text: 'Алгебра'}
		]}
			
	];
	
	$('#home-search').add('#header-search').select2({
		tags:[],
		data:preload_data,
		maximumInputLength: 30,
		selectOnBlur: true,
		minimumResultsForSearch: 100,

		createSearchChoice: function(term) {
			return {id: term, text: term};
		}
	});
})