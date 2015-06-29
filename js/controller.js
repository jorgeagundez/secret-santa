$(document).ready(function(){



	// ************
	// STEP 3 PAGE
	// ************

	var i = 1;
	$('.addFriend').click(function(){
		i++;
		var friend = '<div class="row friend_wrap"><div class="col-md-3 input_wrapper"><label for="friendname' + i + '">Amigo n&deg;' + i + '</label><input type="text" name="friendname' + i + '" class="form-control" id="friendname' + i + '" placeholder="Nombre" required="true"/></div><div class="col-md-9 input_wrapper"><label for="friendemail' + i + '">Email</label><input type="email" name="friendemail' + i + '" class="form-control" id="friendemail' + i + '" placeholder="Correo Electrónico" required="true"/></div></div>';
		$('div.friendList').append(friend);
	});

	$('form#stepThree').submit(function() {
		$('.nFriends').val(i);
	});

	// ************
	// DASHBOARD
	// ************

    //Open options each friend-list

    $('.friends').on( 'click', '.content-top', function() {
        if (!$(this).find('span').hasClass('green')) {
            $(this).toggleClass('move');
        }
    });

    // Functions

    function getFriendData(object){

		var thisobject = object;
        var friendWrap = thisobject.parents('.friend-wrap');
        var friend_id = friendWrap.attr('id');
        var friend_name = friendWrap.find('.name').attr('id');
        var friend_email = friendWrap.find('.email').attr('id');
        var friend = {
                        'friendid' : friend_id,
                        'friendname' : friend_name,
                        'friendemail' : friend_email
                };

        return friend;

    }

	// Add friend Ajax

        $('body').on( 'submit', '#addFriend' ,function(){

            var name = $(this).find('.friendname').val();
            var email = $(this).find('.friendemail').val();

            //Validation
            var filter = new RegExp(/[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/);
            var valid = filter.test(email);

            if ( name == '' || name.length < 5 || name.length > 8) {
                alert('El nombre debe contener entre 5 y 8 letras');
                return false;
            }
            if (!valid) {
                alert('El email introducido no es valido');
                return false;
            }

            //json datas
            var newfriend = {
                "name" : name,
                "email" : email
            };

            function setFriendwrap(id, name, email){

                if ( name + email > 35) {
                    console.log('yeah');
                }
                var friendcode = '<div style=\"opacity: 0;\" class=\"col-xs-12 d col-sm-6 col-md-4 friend-wrap\" id=\"' + id + '\"><div class=\"content-wrapper\" ><div class=\"content-top ligthgray\"><p class=\"name bold text-capitalize\" id=\"' + name + '\">' + name + '</p><small class=\"email text-lowercase\" id=\"' + email + '\"> (' + email.substring(0,23) + '...)</small><i class=\"icon_status yellow fa fa-exclamation-triangle\"></i></div><div class=\"content-behind\"><a class=\"invite-btn behind-btn\" aria-label=\"Left Align\" href=\"\"> Invitar</a><a class="delete-btn behind-btn" aria-label="Left Align" href=""><span class="glyphicon glyphicon-trash white" aria-hidden="true"></span></a></div></div></div>';
                return friendcode;
            }


            $.ajax({
                data:  newfriend,
                type:  'POST',
                url:   '../controller/ajax/addFriend.php',
                success:  function (response) {
                    if (response.error){
                        alert(response.mensaje);
                        console.log(response.type);
                    }else{
                        var code = setFriendwrap(response.newid, name, email);
                        // $('.friends').find('.friend-wrap:last-child').add(code);
                        $('.friends').find('.friend-wrap:last-child').after(code);
                        $('.friends').find('.friend-wrap:last-child').fadeTo('slow', 1);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Ha ocurrido un error, por favor, intentelo mas tarde');
                }
            });

            $(this).trigger("reset");
            return false;
        });

    // Invite single friend

        $('body').on( 'click', '.invite-btn', function(evento){

            evento.preventDefault();

            var confirmation = confirm('Se enviará una invitación. ¿Desea continuar?');

            if( confirmation ) {

                var friendWrap = $(this).parents('.friend-wrap');
                var friend = getFriendData($(this));

                console.log (friend);

                $.ajax({
                        data:  friend,
                        type:  'POST',
                        dataType: 'json',
                        url:   '../controller/ajax/singleInvitation.php',
                        success:  function (response) {
                            if (response.error){
                                alert(response.mensaje);
                            }else{
                                $(friendWrap).find('.icon_status').remove();
                                $(friendWrap).find('.content-top ').removeClass('move').append('<i class="icon_status sky fa fa-question-circle"></i>');
                                $(friendWrap).find('.invite-btn').remove();
                                $(friendWrap).find('.content-behind').append('<a class="remaind-btn behind-btn" aria-label="Left Align" href="">Recordar</a><a class="delete-btn behind-btn" aria-label="Left Align" href=""><span class="glyphicon glyphicon-trash white" aria-hidden="true"></span></a>');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Ha ocurrido un error, por favor, intentelo mas tarde. Error: ' + errorThrown);
                            console.log(jqXHR);
                        }
                });
            };
        });


    // Remaind single friend

        $('body').on( 'click', '.remaind-btn', function(evento){

            evento.preventDefault();

            var confirmation = confirm('Se enviará un mensaje recordatorio. ¿Desea continuar?');

            if( confirmation ) {

                var friendWrap = $(this).parents('.friend-wrap');
                var friend = getFriendData($(this));

                $.ajax({
                        data:  friend,
                        type:  'POST',
                        dataType: 'json',
                        url:   '../controller/ajax/remaindFriend.php',
                        success:  function (response) {
                            if (response.error){
                                alert(response.mensaje);
                            }else{
                                $(friendWrap).find('.content-top ').removeClass('move');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Ha ocurrido un error, por favor, intentelo mas tarde');
                        }
                });
            };
        });

	// Delete Friend

		$('body').on( 'click', '.delete-btn' ,function(evento){

            evento.preventDefault();

            var friendWrap = $(this).parents('.friend-wrap');
            var friend = getFriendData($(this));

            var confirmation = confirm('Su amigo será eliminado del juego. ¿Desea continuar?');
            if( confirmation ) {
                $.ajax({
                    data:  friend,
                    type:  'POST',
                    dataType: 'json',
                    url:   '../controller/ajax/deleteFriend.php',
                    success:  function (response) {
                            if (response.error){
                                alert(response.mensaje);
                            }else{
                                $(friendWrap).fadeOut('slow', function(){
                                    $(this).remove();
                                });
                            }
                        },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Ha ocurrido un error, por favor, intentelo mas tarde');
                    }
                });
            }else{
                return false;
            }
        });


    //Delete Account

    $('body').on( 'click', '.delete_account' , function(){
        var confirmation = confirm('Su cuenta va a ser borrada por completo. Todo los datos de su juego y amigos invitados se perderán. ¿Está de acuerdo?');
        if( confirmation ) {
            return true;
        }else{
            return false;
        }
    })



    // Style amends

    var window_width = $(window).width();
    if (window_width > '768' ) {
        $('.friend-wrap').find('.collapse').addClass('in');
    }



}); // doc ready





