$(document).ready(function(){

	// Scroll animation 
	$(function() {
		$('a[href*=#]:not([href=#])').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				if (target.length) {
					$('html,body').animate({
						scrollTop: target.offset().top
					}, 1000);
					return false;
				}
			}
		});
	});

	// ************
	// STEP 3
	// ************

	var i = 1;
	$('.addFriend').click(function(){
		i++;
		var friend = '<hr /><div class="row"><div class="col-md-3 input_wrapper"><label for="friendname' + i + '">Friend</label><input type="text" name="friendname' + i + '" class="form-control" id="friendname' + i + '" placeholder="name" required="true"/></div><div class="col-md-9 input_wrapper"><label for="friendemail' + i + '">Email</label><input type="email" name="friendemail' + i + '" class="form-control" id="friendemail' + i + '" placeholder="Email" required="true"/></div><?php $nFriends++;  ?></div>';
		$('div.friendList').append(friend);
	});

	$('form#stepThree').submit(function() {
		$('.nFriends').val(i);
	});


});
