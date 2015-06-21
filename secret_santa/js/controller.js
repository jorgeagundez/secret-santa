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
        });

    // Invite single friend

        $('.invite').click(function(evento){

            evento.preventDefault();
            
            var friendWrap = $(this).parents('div[class^="friend-wrap"]');
            var friend = getFriendData($(this));

            console.log(friend);

            $.ajax({
                    data:  friend,
                    url:   '../controller/ajax/singleInvitation.php',
                    type:  'post',
                    success:  function (response) {
                        $(friendWrap).find('.invite').remove();
                        $(friendWrap).find('.panel-body').append('<a id="" class="btn-sm btn btn-default warning-btn remaind" aria-label="Left Align" href=""><span class="glyphicon glyphicon-time" aria-hidden="true"></span> Recordar</a>');
                        $(friendWrap).find('.panel-body').append('<a id="" class="btn-sm btn btn-default warning-btn remaind" aria-label="Left Align" href=""><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Borrar</a>');
                    }
            });
        });

	// Delete Friend

		$('.delete').click(function(evento){

            evento.preventDefault();
            
            var friendWrap = $(this).parents('div[class^="friend-wrap"]');
            var friend = getFriendData($(this));

            $.ajax({
                data:  friend,
                url:   '../controller/ajax/deleteFriend.php',
                type:  'post',
                success:  function (response) {
                    $(friendWrap).remove();
                }
            });
        });

    // Style amends

    var window_width = $(window).width();
    if (window_width > '768' ) {
    	$('.friend-wrap').find('.collapse').addClass('in');
    }

    


});
