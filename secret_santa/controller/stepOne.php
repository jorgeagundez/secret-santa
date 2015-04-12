<?php 

session_start();

if(isset($_SESSION['user_id']))
{
    // $_SESSION['error'] = 'You are already subscribed, please login';
    header('Location:/secret_santa/controller/logout.php');


}elseif(!isset($_POST['username'],$_POST['password'],$_POST['rPassword'],$_POST['email'],$_POST['rEmail'],$_POST['form_token'])){

	$_SESSION['error'] = 'Please enter a valid data';

}elseif( $_POST['form_token'] != $_SESSION['form_token']){

    $_SESSION['error'] = 'Invalid form submission, please try again';

}elseif (strlen( $_POST['username']) < 5 || strlen($_POST['username']) > 20) {

    $_SESSION['error'] = 'Incorrect Length for Username';

}elseif (strlen( $_POST['password']) < 8 || strlen($_POST['password']) > 20){

    $_SESSION['error'] = 'Incorrect Length for Password';

}elseif ($_POST['password'] != $_POST['rPassword']){

    $_SESSION['error'] = 'The passwords have to be the same. Please, try again.';

}elseif ($_POST['email'] != $_POST['rEmail']){

    $_SESSION['error'] = 'The emailes have to be the same. Please, try again';

}elseif (ctype_alnum($_POST['username']) != true){
 
    $_SESSION['error'] = "Username must be alpha numeric";

}elseif (ctype_alnum($_POST['password']) != true){

    $_SESSION['error'] = "Password must be alpha numeric";

}else{

    $username = strip_tags($_POST['username']);
    $password = strip_tags($_POST['password']);
    $email = strip_tags($_POST['email'])

  	$_SESSION['user_name'] = filter_var($username,FILTER_SANITIZE_STRING);
	$password = filter_var($password,FILTER_SANITIZE_STRING);
    $_SESSION['user_password'] = sha1( $password );
    $_SESSION['user_email'] = filter_var($email,FILTER_SANITIZE_EMAIL);

    header('Location:/secret_santa/stepTwo.php');

}

if (isset($_SESSION['error'])) {

    header('Location:/secret_santa/stepOne.php');
}

?>