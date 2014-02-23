$(document).ready(function () {
	Dropzone.options.imageUpload = {
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
			this.on("addedfile", function(file) {
				$("#start-upload").hide();
				$("#start-upload").removeClass('hidden');
				$("#start-upload").fadeIn('slow');
			});

			this.on("removedfile", function(file) {
				if( !this.files.length )
					$("#start-upload").fadeOut('slow');
			});
		}
	};
})