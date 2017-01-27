$(function() {

	// Get the form.
	var form = $('#order-form');

	// Get the messages div.
	var formMessages = $('#form-messages');
        function validateOrderForm() {
            
            var valid = true;
            var name = $("#input-name").val();
            var email = $("#input-email").val();
            var phone = $("#input-phone").val();
            var delivery = $("#input-delivery").val();
            var order = $("#input-order").val();
            var regexp_email	= /^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/;
            
            if (name == '' ) {
                document.getElementById("input-name").style.borderColor = "#f37c05";
                document.getElementById("name-error").style.display = "inline";
                document.getElementById('name-error').innerHTML = 'Va rugam sa introduceti numele dumneavoastra';

                $("#input-name").focus(function() {

                        $("#name-error").fadeOut(2000);
                        $("#input-name").css("border", "1px solid #d5d5d5");
                });

                valid = false;
            }
            if (name.length < 3 || name.length > 32 ) {
                document.getElementById("input-name").style.borderColor = "#f37c05";
                document.getElementById("name-error").style.display = "inline";
                document.getElementById('name-error').innerHTML = 'Va rugam sa introduceti numele dumneavoastra. Numele poate avea intre 3 si 32 de caractere';

                $("#input-name").focus(function() {

                        $("#name-error").fadeOut(2000);
                        $("#input-name").css("border", "1px solid #d5d5d5");
                });

                valid = false;
            }            
                        
            if (email == '' ) {
                document.getElementById("input-email").style.borderColor = "#f37c05";
                document.getElementById("email-error").style.display = "inline";
                document.getElementById('email-error').innerHTML = 'Va rugam sa introduceti o adresa de email';

                $("#input-email").focus(function() {

                        $("#email-error").fadeOut(2000);
                        $("#input-email").css("border", "1px solid #d5d5d5");
                });

                valid = false;
            }
            
            if (email.search(regexp_email) == - 1 && email.trim !== email) {
                document.getElementById("input-email").style.borderColor = "#f37c05";
                document.getElementById("email-error").style.display = "inline";
                document.getElementById('email-error').innerHTML = 'Va rugam sa introduceti o adresa de email valida';

                $("#input-email").focus(function() {

                        $("#email-error").fadeOut(2000);
                        $("#input-email").css("border", "1px solid #d5d5d5");
                });

                valid = false;
                
            }
                        
            if (phone.length < 3 || phone.length > 15 ) {
                document.getElementById("input-phone").style.borderColor = "#f37c05";
                document.getElementById("phone-error").style.display = "inline";
                document.getElementById('phone-error').innerHTML = 'Va rugam sa introduceti un telefon de contact. Numarul poate avea intre 3 si 15 cifre.';

                $("#input-phone").focus(function() {

                        $("#phone-error").fadeOut(2000);
                        $("#input-phone").css("border", "1px solid #d5d5d5");
                });

                valid = false;
            }
            
            if (delivery.length < 10 || delivery.length > 300) {
                document.getElementById("input-delivery").style.borderColor = "#f37c05";
                document.getElementById("delivery-error").style.display = "inline";
                document.getElementById('delivery-error').innerHTML = 'Va rugam sa introduceti adresa de livrare. Aceasta poatea avea intre 10 si 300 de caractere.';

                $("#input-delivery").focus(function() {

                        $("#delivery-error").fadeOut(2000);
                        $("#input-delivery").css("border", "1px solid #d5d5d5");
                });

                valid = false;
            }

            if (order.length < 10 || order.length > 300) {
                document.getElementById("input-order").style.borderColor = "#f37c05";
                document.getElementById("order-error").style.display = "inline";
                document.getElementById('order-error').innerHTML = 'Va rugam sa introduceti comanda dumneavoastra. Aceasta poate avea intre 10 si 300 de caractere.';

                $("#input-order").focus(function() {

                        $("#order-error").fadeOut(2000);
                        $("#input-order").css("border", "1px solid #d5d5d5");
                });

                valid = false;
            }
            
            var x = document.getElementById("uploadFile");
            if ('files' in x) {
                if (x.files.length == 0) {                 
                    document.getElementById("uploadFile").style.borderColor = "#f37c05";
                    document.getElementById("fisier-error").style.display = "inline";
                    document.getElementById('fisier-error').innerHTML = 'Va rugam sa alegeti un fisier.';
                    valid = false;
                } else {
                    for (var i = 0; i < x.files.length; i++) {
                        var file = x.files[i];
                        if ('size' in file) {
                            
                            if (file.size>419430400) {
                                
                                document.getElementById("uploadFile").style.borderColor = "#f37c05";
                                document.getElementById("fisier-error").style.display = "inline";
                                document.getElementById('fisier-error').innerHTML = 'Eroare: Fisierul depaseste 5MB';
                                valid = false;
                            }                                                      
                        }
                        // check if extension is allowed
                        var allowedExtensions = ["CDR", "AI", "PSD", "PDF", "EPS", "TIFF", "ZIP", "RAR", "cdr", "ai", "psd", "pdf", "eps", "tiff", "zip", "rar"];
                        if ('name' in file) {
                            fileExtension = file.name.slice((file.name.lastIndexOf(".") - 1 >>> 0) + 2);
                            var extensieAcceptata = false;
                            for (var j = 0; j < allowedExtensions.length; j++) {
                                
                                if (fileExtension == allowedExtensions[j]) {
                                    extensieAcceptata = true;
                                }                                
                            }
                            if (!extensieAcceptata) {                                
                                document.getElementById("uploadFile").style.borderColor = "#f37c05";
                                document.getElementById("fisier-error").style.display = "inline";
                                document.getElementById('fisier-error').innerHTML = 'Eroare: Tipurile de fisiere permise sunt: CDR, AI, PSD, PDF, EPS, TIFF, ZIP, RAR.';
                                valid = false;
                            }
                        }
                    }
                }
            }             
            
            if (!valid) return false;
            
            return true;
        }
                
	// Set up an event listener for the contact form.
	$(form).submit(function(e) {
            
		// Stop the browser from submitting the form.
		e.preventDefault();

		// Serialize the form data.
		//var formData = $(form).serialize();
                

		// Submit the form using AJAX.
		$.ajax({
			type: "POST",
			url: $(form).attr('action'),
                        //url: "upload.php",
                        cache: false,
                        contentType: false,
                        processData: false,
			data: new FormData(this),
                        beforeSend : function(xhr, opts){
                            if (validateOrderForm() === false)
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
                        document.getElementById("order-form").style.display = "none";
			$('#input-name, #input-email, #input-phone, #input-company, #input-delivery').val('');
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