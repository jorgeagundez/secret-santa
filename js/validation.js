$(document).ready(function(){

    $('form').each(function(key, value) {

        $(value).submit(function(){

            var errors = [];
            var pass = '';
            var email = '';

            $(this).find('select, input, textarea').each(function(){

                switch($(this).attr('name')){

                    case 'username':
                        if ($(this).val() == '' || $(this).val().length < 2 || $(this).val().length > 8) {
                            errors.push('El nombre de usuario debe contener entre 2 y 8 letras');
                            $(this).addClass('error');                     
                        }else{
                            $(this).removeClass('error');
                            $(this).addClass('correct');
                        };
                    break;
                    case 'password':
                        if ($(this).val() == '' || $(this).val().length < 8 || $(this).val().length > 20) {
                            errors.push('El Pasword debe contener entre 8 y 20 caracteres');
                            $(this).addClass('error');
                        }else{
                            $(this).removeClass('error');
                            $(this).addClass('correct');
                            pass = $(this).val();
                        };
                    break;
                    case 'rPassword':
                        if ($(this).val() == '' || $(this).val().length < 8 || $(this).val().length > 20) {
                            errors.push('Password is invalid');
                            $(this).addClass('error');
                        }else if($(this).val() != pass ){
                            errors.push('Los passwords deben de ser iguales');
                            $(this).addClass('error');
                        }else{
                            $(this).removeClass('error');
                            $(this).addClass('correct');
                        };
                    break; 
                    case 'useremail':
                        var filter = new RegExp(/[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/);
                        var valid = filter.test($(this).val());
                        if (!valid) {
                            errors.push('Email no válido. Por favor, vuelva a escribir su email');
                            $(this).addClass('error');
                        }else{
                            $(this).removeClass('error');
                            $(this).addClass('correct');
                            email = $(this).val();
                        }
                    break;
                    case 'friendname':
                        if ($(this).val() == ' ') {
                            errors.push('El nombre de un amigo debe contener al menos una letra');
                            $(this).addClass('error');                     
                        }else{
                            $(this).removeClass('error');
                            $(this).addClass('correct');
                        };
                    break;
                    case 'friendemail':
                        var filter = new RegExp(/[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/);
                        var valid = filter.test($(this).val());
                        if (!valid) {
                            errors.push('Email no válido. Por favor, vuelva a escribir su email');
                            $(this).addClass('error');
                        }else{
                            $(this).removeClass('error');
                            $(this).addClass('correct');
                            email = $(this).val();
                        }
                    break;  
                    case 'title':
                        if ($(this).val() == '' ) {
                            errors.push('Title is invalid');
                            $(this).addClass('error');                     
                        }else{
                            $(this).removeClass('error');
                            $(this).addClass('correct');
                        };
                    break;
                    case 'price':
                        if ($(this).val() == '' && !$(this).isNumeric() ) {
                            errors.push('Price is invalid, It has to be a number');
                            $(this).addClass('error');                     
                        }else{
                            $(this).removeClass('error');
                            $(this).addClass('correct');
                        };
                    break;
                    case 'topic':
                        if ($(this).val() == '' ) {
                            errors.push('Title is invalid');
                            $(this).addClass('error');                     
                        }else{
                            $(this).removeClass('error');
                            $(this).addClass('correct');
                        };
                    break;
                     case 'place':
                        if ($(this).val() == '' ) {
                            errors.push('Title is invalid');
                            $(this).addClass('error');                     
                        }else{
                            $(this).removeClass('error');
                            $(this).addClass('correct');
                        };
                    break;
                    
                    			
                } //End switch function

            }); //End find function
			
            if (errors.length > 0) {
                alert(errors[0]);
                return false;
            }

        }); //End Submit function

    }); //End Validation

});


