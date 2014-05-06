$(document).ready(function () {
	if( osmichas.controller == 'image' && osmichas.action == 'upload' ){	
		$("#source").hide();

		Dropzone.options.imageUpload = {
			autoProcessQueue: false,
			paramName: "image",
			acceptedFiles: "image/*", 
			maxFiles: 1,
			maxFilesize: 2,
			uploadMultiple: false,
			addRemoveLinks: true,
			thumbnailHeight: "100",
			dictDefaultMessage: "<h3>Довлачи изображение тук<br />(или кликни за да избереш)</h3>",
			dictRemoveFile: 'Премахни',
			dictCancelUpload: 'Премахни',
			dictMaxFilesExceeded: 'Не можеш да добавяш повече от 1 изображение наведнъж',
			dictInvalidFileType: 'Можеш да добавяш само изображения',
			init: function() {
			},
			success: function(file, response){
				if( !isNaN(response) ) {
					window.location = osmichas.url_base+"image/tager/"+response;
				}
			}
		};

		$("[name='private_material']").bootstrapSwitch({
			size: 'small',
			onColor: 'success',
			offColor: 'danger',
			onText: 'Да',
			offText: 'Не',
			onSwitchChange: function(event, state){
				$("#source").slideToggle()
			}
		});		

		$("[name='tos']").bootstrapSwitch({
			size: 'large',
			onColor: 'success',
			offColor: 'danger',
			onText: 'ДА',
			offText: 'НЕ',
			onSwitchChange: function(event, state){
				
			}
		});

	}
})