$(document).ready(function () {

	//overide the default jQuery validator's behaviour to comply with Bootstrap
	$.validator.setDefaults({
		highlight: function(element) {
			$(element).closest('.control-group').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest('.control-group').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'help-block',
		errorPlacement: function(error, element) {
			if(element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			} else {
				error.insertAfter(element);
			}
		}
	});

	//translate the jQuery validator messages
	jQuery.extend(jQuery.validator.messages, {
		required: "Задължително поле.",
		remote: "Грешна стойност.",
		email: "Невалиден имейл.",
		url: "Моля въведи валиден URL.",
		date: "Моля въведи валидна дата.",
		// dateISO: "Please enter a valid date (ISO).",
		number: "Моля въведи валидно число.",
		digits: "Моля въведи само цифри.",
		// creditcard: "Please enter a valid credit card number.",
		equalTo: "Моля въведи същата стойност отново.",
		accept: "Please enter a value with a valid extension.",
		// maxlength: jQuery.validator.format("Please enter no more than {0} characters."),
		// minlength: jQuery.validator.format("Please enter at least {0} characters."),
		// rangelength: jQuery.validator.format("Please enter a value between {0} and {1} characters long."),
		// range: jQuery.validator.format("Please enter a value between {0} and {1}."),
		// max: jQuery.validator.format("Please enter a value less than or equal to {0}."),
		// min: jQuery.validator.format("Please enter a value greater than or equal to {0}.")
	});

	//home and header search box validation
	$('#home-search-form').add('#header-search-form').validate({
		rules: {
			query: {
				minlength: 1,
				required: true
			}
		},
		messages: {
			query: {
				required: "Моля въведи ключова дума"
			}
		}
	});

	//header login box validation
	$('#header-login').validate({
		rules: {
			email: {
				required: true,
				email: true
			}
		}
	});

	$('#imageUpload').validate({
		rules: {
			source: {
				required: true
			},
			email: {
				required: true,
				email: true
			}
		}
	});

})