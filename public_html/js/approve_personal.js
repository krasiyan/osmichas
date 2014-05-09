$(document).ready(function () {
	if( 
		(osmichas.controller == 'image' && osmichas.action == 'for_approval') ||
		(osmichas.controller == 'user' && osmichas.action == 'contributions')
	 ){	
		function initIsotope()
		{
			$('.images').isotope({
				itemSelector : '.image-container',
				layoutMode : 'masonry',
				animationEngine: 'best-available',
				masonry: {
					columnWidth: 1
				}
			});
		}

		$('.images').imagesLoaded(function(e){
			initIsotope();
		});
	}
})