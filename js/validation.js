$(document).ready(function(){

    $('form').each(function(key, value) {

        $(value).submit(function(){

            var errors = [];
            var pass = '';
            var email = '';

            $(this).find('select, input, textarea').each(function(){

                switch($(this).attr('name')){
                    case 'username':
                        if ($(this).val() == '' || $(this).val().length < 5 || $(this).val().length > 8) {
                            errors.push('Username is invalid');
                            $(this).addClass('error');                     
                        }else{
                            $(this).removeClass('error');
                            $(this).addClass('correct');
                        };
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
                    case 'password':
                        if ($(this).val() == '' || $(this).val().length < 8 || $(this).val().length > 20) {
                            errors.push('Password is invalid');
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
                        	errors.push('The passwords have to be the same');
                        	$(this).addClass('error');
                        }else{
                            $(this).removeClass('error');
                            $(this).addClass('correct');
                        };
                    break;
                    case 'lastName':
                        if ($(this).val() == '') {
                            errors.push('Last Name is required');
                            $(this).addClass('error');
                        }else{
                            $(this).removeClass('error');
                            $(this).addClass('correct');
                        };
                    break;
                    case 'email':
                        var filter = new RegExp(/[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/);
                        var valid = filter.test($(this).val());
                        if (!valid) {
                            errors.push('Valid Email is required');
                            $(this).addClass('error');
                        }else{
                            $(this).removeClass('error');
                            $(this).addClass('correct');
                            email = $(this).val();
                        }
                    break;	
                    case 'rEmail':
                        var filter = new RegExp(/[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/);
                        var valid = filter.test($(this).val());
                        if (!valid) {
                            errors.push('Valid Email is required');
                            $(this).addClass('error');
                        }else if($(this).val() != email ){
                        	errors.push('The emailes have to be the same');
                        	$(this).addClass('error');
                        }else{
                            $(this).removeClass('error');
                            $(this).addClass('correct');
                        }
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


