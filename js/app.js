$(function() {

	var form = $('#ajax-contact');

	var formMessages = $('#form-messages');

	$(form).submit(function(e) {
		

		e.preventDefault();

		$(formMessages).removeClass('error').html('');
		
		$('#loader').fadeIn();
		

		var formData = $(form).serialize();

		$.ajax({

			type: 'POST',

			url: $(form).attr('action'),

			data: formData

		}).done(function(response) {

			$('#loader').fadeOut();

			$(formMessages).removeClass('error');

			$(formMessages).addClass('success');

			$(formMessages).text(response);

            

            $(".wait-mortgage").hide();

			$('#name').val('');

			$('#email').val('');

			$('#phone').val('');

            $('#besttime').val('');

            $('#comments').val('');

            $('#message').val('');

            $('#subject').val('');

            }).fail(function(data) {

			$('#loader').fadeOut();

			$(formMessages).removeClass('success');

			$(formMessages).addClass('error');

			if (data.responseText !== '') {

                $(".wait-mortgage").hide();

				$(formMessages).text(data.responseText);

			} else {

                $(".wait-mortgage").hide();

				$(formMessages).text('Oops! An error occured and your message could not be sent.');

			}

		});

	});

    

  	var form2 = $('#ajax-contact2');

	var formMessages = $('#form-messages');

	$(form2).submit(function(e) {

		e.preventDefault();

		$('#loader').fadeIn();

        

		var formData = $(form2).serialize();

		$.ajax({

			type: 'POST',

			url: $(form2).attr('action'),

			data: formData

		}).done(function(response) {

			

            form2.prev("div").addClass('success').removeClass('error').html(response);

			

            $('#ajax-contact2 input[type=text]').each(function(index, element) {

                $(this).val('');

            });

            

            }).fail(function(data) {

            

                if (data.responseText !== '')  var error = data.responseText;

                else var error = 'Oops! An error occured and your message could not be sent.';

                

                form2.prev("div").removeClass('success').addClass('error').html(error);

                 return false;

			

		});

	});



    

});