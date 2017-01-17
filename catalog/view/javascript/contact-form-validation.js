$(function() {

	// Get the form.
	var form = $('#contact-form');

	// Get the messages div.
	var formMessages = $('#form-messages');
        function validateBookForm() {
            
            var valid = true;
            var name = $("#input-name").val();
            var email = $("#input-email").val();
            var phone = $("#input-phone").val();
            var enquiry = $("#input-enquiry").val();
            var regexp_email	= /^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/;
            
            if (name == '' ) {
                document.getElementById("input-name").style.borderColor = "red";
                document.getElementById("name-error").style.display = "inline";
                document.getElementById('name-error').innerHTML = 'Va rugam sa introduceti numele dumneavoastra';

                $("#input-name").focus(function() {

                        $("#name-error").fadeOut(2000);
                        $("#input-name").css("border", "1px solid #d5d5d5");
                });

                valid = false;
            }
            if (name.length < 3 || name.length > 32 ) {
                document.getElementById("input-name").style.borderColor = "red";
                document.getElementById("name-error").style.display = "inline";
                document.getElementById('name-error').innerHTML = 'Va rugam sa introduceti numele dumneavoastra. Numele poate avea intre 3 si 32 de caractere';

                $("#input-name").focus(function() {

                        $("#name-error").fadeOut(2000);
                        $("#input-name").css("border", "1px solid #d5d5d5");
                });

                valid = false;
            }            
                        
            if (email == '' ) {
                document.getElementById("input-email").style.borderColor = "red";
                document.getElementById("email-error").style.display = "inline";
                document.getElementById('email-error').innerHTML = 'Va rugam sa introduceti o adresa de email';

                $("#input-email").focus(function() {

                        $("#email-error").fadeOut(2000);
                        $("#input-email").css("border", "1px solid #d5d5d5");
                });

                valid = false;
            }
            
            if (email.search(regexp_email) == - 1 && email.trim !== email) {
                document.getElementById("input-email").style.borderColor = "red";
                document.getElementById("email-error").style.display = "inline";
                document.getElementById('email-error').innerHTML = 'Va rugam sa introduceti o adresa de email valida';

                $("#input-email").focus(function() {

                        $("#email-error").fadeOut(2000);
                        $("#input-email").css("border", "1px solid #d5d5d5");
                });

                valid = false;
                
            }
                        
            if (phone.length < 3 || phone.length > 15 ) {
                document.getElementById("input-phone").style.borderColor = "red";
                document.getElementById("phone-error").style.display = "inline";
                document.getElementById('phone-error').innerHTML = 'Va rugam sa introduceti un telefon de contact. Numarul poate avea intre 3 si 15 cifre';

                $("#input-phone").focus(function() {

                        $("#phone-error").fadeOut(2000);
                        $("#input-phone").css("border", "1px solid #d5d5d5");
                });

                valid = false;
            }
            
            if (enquiry.length < 10 || enquiry.length > 3000) {
                document.getElementById("input-enquiry").style.borderColor = "red";
                document.getElementById("enquiry-error").style.display = "inline";
                document.getElementById('enquiry-error').innerHTML = 'Va rugam sa introduceti mesajul dumneavoastra. Acesta poatea avea intre 3 si 3000 de caractere.';

                $("#input-enquiry").focus(function() {

                        $("#enquiry-error").fadeOut(2000);
                        $("#input-enquiry").css("border", "1px solid #d5d5d5");
                });

                valid = false;
            }            
            
            if (!valid) return false;
            
            return true;
        }
                
	// Set up an event listener for the contact form.
	$(form).submit(function(e) {
            
		// Stop the browser from submitting the form.
		e.preventDefault();

		// Serialize the form data.
		var formData = $(form).serialize();

		// Submit the form using AJAX.
		$.ajax({
			type: 'POST',
			url: $(form).attr('action'),
			data: formData,
                        beforeSend : function(xhr, opts){
                            if (validateBookForm() === false)
                            {
                                xhr.abort();
                            }
                        }
		})
		.done(function(response) {
			// Make sure that the formMessages div has the 'success' class.
			$(formMessages).removeClass('alert alert-danger');
			$(formMessages).addClass('alert alert-success');

			// Set the message text.
			$(formMessages).text(response);

			// Clear the form.
                        document.getElementById("contact-form").style.display = "none";
			$('#input-name, #input-email, #input-phone, #input-company, #input-enquiry').val('');
		})
		.fail(function(data) {                    
			$(formMessages).removeClass('alert alert-success');

			// Set the message text.
                        if (typeof data.responseText !== 'undefined') {
			//if (data.responseText !== '') {
                            // Make sure that the formMessages div has the 'error' class.
                            $(formMessages).addClass('alert alert-danger');
                            $(formMessages).text(data.responseText);
			}                       
		});

	});

});