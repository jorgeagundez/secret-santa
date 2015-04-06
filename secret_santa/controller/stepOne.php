<?php 

session_start();

if(isset($_SESSION['user_id']))
{
    header('Location:/logout.php');

}elseif(!isset($_POST['username'],$_POST['password'],$_POST['rPassword'],$_POST['email'],$_POST['rEmail'],$_POST['form_token'])){

	$error = 'Please enter a valid data';

}elseif( $_POST['form_token'] != $_SESSION['form_token']){

    $error = 'Invalid form submission, please try again';

}elseif (strlen( $_POST['username']) < 5 || strlen($_POST['username']) > 20) {

    $error = 'Incorrect Length for Username';

}elseif (strlen( $_POST['password']) < 8 || strlen($_POST['password']) > 20){

    $error = 'Incorrect Length for Password';

}elseif ($_POST['password'] != $_POST['rPassword']){

    $error = 'The passwords have to be the same. Please, try again.';

}elseif ($_POST['email'] != $_POST['rEmail']){

    $error = 'The emailes have to be the same. Please, try again';

}elseif (ctype_alnum($_POST['username']) != true){
 
    $error = "Username must be alpha numeric";

}elseif (ctype_alnum($_POST['password']) != true){

    $error = "Password must be alpha numeric";

}else{

  	$_SESSION['user_name'] = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
	$password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
    $_SESSION['user_password'] = sha1( $password );
    $_SESSION['user_email'] = filter_var($_POST['email'],FILTER_SANITIZE_STRING);

    header('Location:/secret_santa/stepTwo.php?form_token=' . $_SESSION['form_token']);

}

if (isset($error)) {

    header('Location:/secret_santa/stepOne.php?error=' . $error);
    unset($error);
}

?>