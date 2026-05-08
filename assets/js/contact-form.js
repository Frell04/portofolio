$(function() {

	// Get the form.
	var form = $('#contact-form');
	var submitButton = $(form).find('button[type="submit"]');

	// Get the messages div.
	var formMessages = $('.form-message');
	
	// Hide spinner initially
	submitButton.find('.spinner-border').hide();

	// Set up an event listener for the contact form.
	$(form).submit(function(e) {
		// Stop the browser from submitting the form.
		e.preventDefault();

		// Disable button and show loading state.
		submitButton.prop('disabled', true);
		submitButton.find('.spinner-border').show();
		submitButton.contents().first().replaceWith('Sending...');

		// Serialize the form data.
		var formData = $(form).serialize();

		// Submit the form using AJAX.
		$.ajax({
			type: 'POST',
			url: $(form).attr('action'),
			data: formData
		})
		.done(function(response) {
			// Make sure that the formMessages div has the 'success' class.
			$(formMessages).removeClass('error');
			$(formMessages).addClass('success');

			// Set the message text.
			$(formMessages).text(response);

			// Clear the form.
			$('#contact-form input,#contact-form textarea').val('');

			// Notify the user.
			alert('Pesan berhasil dikirim! Terima kasih.');
		})
		.fail(function(data) {
			// Make sure that the formMessages div has the 'error' class.
			$(formMessages).removeClass('success');
			$(formMessages).addClass('error');

			// Set the message text.
			if (data.responseText !== '') {
				$(formMessages).text(data.responseText);
			} else {
				$(formMessages).text('Oops! An error occured and your message could not be sent.');
			}
		})
		.always(function() {
			// Restore button state.
			submitButton.prop('disabled', false);
			submitButton.find('.spinner-border').hide();
			submitButton.contents().first().replaceWith('Send Me');
		});
	});

});


