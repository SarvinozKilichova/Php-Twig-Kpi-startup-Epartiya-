$(function() {
    $('.ui.form')
    .form({
        fields: {
            email: {
                identifier  : 'login',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Логин киритилмаган'
                    }
                ]
            },
            password: {
                identifier  : 'password',
                rules: [
                    {
                        type   : 'empty',
                        prompt : 'Парол киритилмаган'
                    }
                ]
            }
        }
    });

    $("#showpass").click(function(){
    	var passwordinput = $('input[name="password"]'); 
    	if (passwordinput.attr("type")=="password") {
    		passwordinput.attr("type", "text");
    		$(this).addClass("slash");
    	} else {
    		passwordinput.attr("type", "password");
    		$(this).removeClass("slash");
    	}
    });
});