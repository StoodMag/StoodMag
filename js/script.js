$(function () {

    $(".navbar a, footer a").on("click", function(e){
        e.preventDefault();
        let hash = this.hash;

        $('body').animate({scrollTop:
            $(hash).offset().top}, 900 , function () {window.location.hash = hash;})
        })

        $('#HTML').on('shown.bs.modal', function () {
            $('#closeHTML').trigger('focus')
          })

        $('#CSS').on('shown.bs.modal', function () {
            $('#closeCSS').trigger('focus')
          })

        $('#JS').on('shown.bs.modal', function () {
            $('#closeJS').trigger('focus')
          }) 
        
          $('#Python').on('shown.bs.modal', function () {
            $('#closePython').trigger('focus')
          }) 


    $('#contact-form').submit(function (e) {
        e.preventDefault();
        $('.comments').empty();
        $('p').remove('.thank-you');
        let postData = $("#contact-form").serialize();

        $.ajax({
            type: 'POST',
            url: 'php/contact.php',
            data: postData,
            dataType: 'json',
            success: function (result) {
                if (result.isSuccess) {
                    $("#contact-form").append("<p class= 'thank-you'> Your message has been sent. Thanks for contacting me. </p>")
                    $("#contact-form")[0].reset()
                } else {
                    $("#firstname + .comments").html(result.firstnameError);
                    $("#name + .comments").html(result.nameError);
                    $("#email + .comments").html(result.emailError);
                    $("#message + .comments").html(result.messageError);
                }
            }
        });
    })
})