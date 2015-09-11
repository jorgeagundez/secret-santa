<?php 

session_start();

if(isset($_SESSION['user_id']))
{
    // $_SESSION['error'] = 'You are already subscribed, please login';
    header('Location:/secret_santa/controller/logout.php');

}elseif(!isset($_POST['username'],$_POST['password'],$_POST['useremail'],$_POST['form_token'])){

	$_SESSION['error'] = 'Por favor, introduzca un valor válido';

}elseif( $_POST['form_token'] != $_SESSION['form_token']){

    $_SESSION['error'] = 'Envío del formulario no válido, por favor intente de nuevo';

}elseif (strlen( $_POST['username']) < 2 || strlen($_POST['username']) > 20) {

    $_SESSION['error'] = 'El nombre de usuario debe contener entre 2 y 8 letras';

}elseif (strlen( $_POST['password']) < 4 ){

    $_SESSION['error'] = 'El password debe contener al menos 4 dígitos';

}elseif (ctype_alnum($_POST['username']) != true){
 
    $_SESSION['error'] = "El nombre de usuario sólo permite carácteres alpha numéricos";

}elseif (ctype_alnum($_POST['password']) != true){

    $_SESSION['error'] = "El nombre de usuario sólo permite carácteres alpha numéricos";

}else{

    $username = strip_tags($_POST['username']);
    $password = strip_tags($_POST['password']);
    $useremail = strip_tags($_POST['useremail']);

  	$_SESSION['user_name'] = filter_var($username,FILTER_SANITIZE_STRING);
	$password = filter_var($password,FILTER_SANITIZE_STRING);
    $_SESSION['user_password'] = sha1( $password );
    $_SESSION['user_email'] = filter_var($useremail,FILTER_SANITIZE_EMAIL);

    $form_token = md5( uniqid('auth', true) );
    $_SESSION['form_token_step1'] = $form_token;
    $_SESSION['form_token'] = $_SESSION['form_token_step1'];
    
    header('Location:/secret_santa/stepTwo.php');

}

if (isset($_SESSION['error'])) {

    header('Location:/secret_santa/stepOne.php');
}

?>