$(document).ready(function () {
	Dropzone.options.imageUpload = {
		autoProcessQueue: true,
		paramName: "image",
		acceptedFiles: "image/*", 
		maxFiles: 1,
		maxFilesize: 2,
		uploadMultiple: false,
		addRemoveLinks: true,
		thumbnailHeight: "100",
		dictDefaultMessage: "<h3>Довлачи изображение тук<br />(или кликни)</h3>",
		dictRemoveFile: 'Премахни',
		dictCancelUpload: 'Премахни',
		dictMaxFilesExceeded: 'Не можеш да добавяш повече от 1 изображение наведнъж',
		dictInvalidFileType: 'Можеш да добавяш само изображения',
		init: function() {
		},
		success: function(file, response){
			if( !isNaN(response) ) {
				window.location = osmichas.url_base+"image/tag/"+response;
			}
		}
	};
})