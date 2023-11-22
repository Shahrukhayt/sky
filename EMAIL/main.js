$(document).ready(function() {
    $('#pingForm').validate({
        rules: {
            fullname: "required",            
            email: {
                required: true,
                email: true
            },
            mobile: {
                required: true,
                number: true
            },
            category: "required"
        },
        errorElement: "span" ,                            
        messages: {
            fullname: "Please enter your sweet name",
            email: "Please enter valid email address",
            mobile: "Please enter your mobile number",
            category: "Please choose category"
        },
        submitHandler: function(form) {
            var dataparam = $('#pingForm').serialize();

            $.ajax({
                type: 'POST',
                async: true,
                url: 'process.php',
                data: dataparam,
                datatype: 'json',
                cache: true,
                global: false,
                beforeSend: function() { 
                    $('#loader').show();
                },
                success: function(data) {
                    if(data == 'success'){
                        console.log(data);
                    } else {
                        $('.no-config').show();
                        console.log(data);
                    }

                },
                complete: function() { 
                    $('#loader').hide();
                }
            });
        }                
    });
});