$(document).ready(function(){

    // ========================
    // ========================
    //  REMEMBER PASSWORD PAGE
    // ========================
    // ========================

    var h = $(window).height();
    $('.pass-wrap').height(h - 130);


	
	// ************
	// DASHBOARD
	// ************

    //Open options each friend-list

    $('.friends').on( 'click', '.content-top', function() {
        if (!$(this).find('span').hasClass('no-move')) {
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

            //json datas
            var newfriend = {
                "name" : name,
                "email" : email
            };

            function setFriendwrap(id, name, email){

                var friendcode = '<div style=\"opacity: 0;\" class=\"col-xs-12 d col-sm-6 col-md-4 friend-wrap\" id=\"' + id + '\"><div class=\"content-wrapper\" ><div class=\"content-top ligthgray\"><p class=\"name bold text-capitalize\" id=\"' + name + '\">' + name + '</p><small class=\"email text-lowercase\" id=\"' + email + '\"> (' + email.substring(0,23) + '...)</small><i class=\"icon_status sky fa fa-clock-o\"></i></div><div class=\"content-behind\"><a class=\"remaind-btn behind-btn\" aria-label=\"Left Align\" href=\"\">Recordar</a><a class=\"delete-btn behind-btn\" aria-label=\"Left Align\" href=\"\"><span class=\"glyphicon glyphicon-trash white\" aria-hidden=\"true\"></span></a></div></div></div>';
                return friendcode;
            };


            $.ajax({
                data:  newfriend,
                type:  'POST',
                url:   '../controller/ajax/addFriend.php',
                success:  function (response) {
                    if (response.error){
                        alert(response.mensaje);
                        // alert(response.type);
                        // console.log(response.type);
                    }else{
                        var code = setFriendwrap(response.newid, name, email);
                        console.log(response.mensaje);
                        $('.friends').find('.no-friend').remove();
                        if ($('.friends > .wrapper > .row > div').length == 0 ) {
                            $('.friends > .wrapper > .row:last-child').append(code);
                        }else{
                            $('.friends').find('.friend-wrap:last-child').after(code);
                        }
                        $('.friends').find('.friend-wrap:last-child').fadeTo('slow', 1);
                        $('.group-confirmed').hide();

                        var totalNoConfirmed =parseInt($('.total-no-confirmed').html());
                        $('.total-no-confirmed').empty();
                        $('.total-no-confirmed').html(totalNoConfirmed + 1);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR);
                }
            });

            $(this).trigger("reset");
            return false;
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
                            var totalNoConfirmed =parseInt($('.total-no-confirmed').html());
                            $('.total-no-confirmed').empty();
                            $('.total-no-confirmed').html(totalNoConfirmed - 1);
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
        var confirmation = confirm('Su cuenta va a ser borrada por completo. Todo los datos de su juego y amigos se perderán. ¿Está de acuerdo?');
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





