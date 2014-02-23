$(document).ready(function () {
	var preload_data = [
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

		createSearchChoice: function(term) {
			return {id: term, text: term};
		}
	});

})