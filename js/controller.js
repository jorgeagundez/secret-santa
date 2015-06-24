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

	// Functions

    function getFriendData(object){

		var thisobject = object;
    	var friendWrap = thisobject.parents('div[class^="friend-wrap"]');
        var friend_id = friendWrap.attr('id');
        var friend_name = friendWrap.find('.name').attr('id');
        var friend_email = friendWrap.find('.email').attr('id');
        var friend = {
                        "friendid" : friend_id,
                        "friendname" : friend_name,
                        "friendemail" : friend_email
                };

        return friend;

    }

	// Add friend Ajax

        $('#activator').click(function(evento){
            evento.preventDefault();
            addFriend('lolita', 'lolita@mail.com');

            function addFriend(name, email){
                var newfriend = {
                        "name" : name,
                        "email" : email
                };
                $.ajax({
                        data:  newfriend,
                        url:   '../controller/ajax/addFriend.php',
                        type:  'post',
                        beforeSend: function () {
                                $("#result").html("Procesando, espere por favor...");
                        },
                        success:  function (response) {
                                $("#result").html(response);
                        }
                });
            }
        });

    // Invite single friend

        $('.invite').click(function(evento){

            evento.preventDefault();

            var confirmation = confirm('Se enviará una invitación. ¿Desea continuar?');
            
            if( confirmation ) {
            
                var friendWrap = $(this).parents('div[class^="friend-wrap"]');
                var friend = getFriendData($(this));

                $.ajax({
                        data:  friend,
                        type:  'POST',
                        dataType: 'json',
                        url:   '../controller/ajax/singleInvitation.php',
                        success:  function (response) {
                            if (response.error){
                                alert(response.mensaje);
                            }else{
                                alert(response.mensaje)
                                $(friendWrap).find('.invite').remove();
                                $(friendWrap).find('.panel-body').append('<a id="" class="btn-sm btn btn-default warning-btn remaind" aria-label="Left Align" href=""><span class="glyphicon glyphicon-time yellow" aria-hidden="true"></span> Recordar</a>');
                                $(friendWrap).find('.panel-body').append('&nbsp;<a id="" class="btn-sm btn btn-default warning-btn delete" aria-label="Left Align" href=""><span class="glyphicon glyphicon-trash red" aria-hidden="true"></span> Borrar</a>');
                                $('.icon_status_inv').remove();
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Ha ocurrido un error, por favor, intentelo mas tarde');
                        }
                });
            };
        });


    // Remaind single friend

        $('.remaind').click(function(evento){

            evento.preventDefault();

            var confirmation = confirm('Se enviará un mensaje recordatorio. ¿Desea continuar?');

            if( confirmation ) {
            
                var friendWrap = $(this).parents('div[class^="friend-wrap"]');
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
                                alert(response.mensaje);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Ha ocurrido un error, por favor, intentelo mas tarde');
                        }
                });
            };
        });

	// Delete Friend

		$('.delete').click(function(evento){

            evento.preventDefault();
            
            var friendWrap = $(this).parents('div[class^="friend-wrap"]');
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
                                alert(response.mensaje);
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

    $('.delete_account').click(function(){
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


    //Collapse Control
    // var obj = document.getElementById('145');
    // obj.addEventListener('touchmove', function(event) {
    //     // If there's exactly one finger inside this element
    //     if (event.targetTouches.length == 1) {
    //         var touch = event.targetTouches[0];
    //         // Place element where the finger is
    //         obj.style.left = touch.pageX + 'px';
    //         obj.style.top = touch.pageY + 'px';
    //     }
    // }, false);


});



