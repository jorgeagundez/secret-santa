<?php 

session_start();

if(isset($_SESSION['user_id']))
{
    header('Location:/controller/logout.php');

}elseif(!isset( $_POST['useremail'],$_POST['password'])){

	$_SESSION['error'] = 'Por favor, introduzca un email y password validos';

}elseif( $_POST['form_token'] != $_SESSION['form_token']){

    $_SESSION['error'] = 'Envio de formulario incorrecto, por favor, intentelo de nuevo';

}elseif (strlen( $_POST['password']) < 8 || strlen($_POST['password']) > 20){

    $_SESSION['error'] = 'Incorrecto numero de caracteres para password';

}elseif (ctype_alnum($_POST['password']) != true){

    $_SESSION['error'] = "Password must be alpha numeric";

}else{

  	$useremail = filter_var($_POST['useremail'],FILTER_SANITIZE_STRING);
	$password = filter_var($_POST['password'],FILTER_SANITIZE_STRING);
    $password = sha1( $password );

    require_once "conexionDb.php";

    try {

        $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT idusuario, nombreusuario, email FROM user WHERE email = :user_email AND password = :user_password");
        $stmt->bindParam(':user_email', $useremail, PDO::PARAM_STR);
        $stmt->bindParam(':user_password', $password, PDO::PARAM_STR, 40);
        
        $stmt->execute();
        $user_id = $stmt->fetchColumn(0);

        $stmt->execute();
        $user_name = $stmt->fetchColumn(1);

        $stmt->execute();
        $user_email = $stmt->fetchColumn(2);

        unset( $_SESSION['form_token'] );

        if (!$user_id) {

            $_SESSION['error'] = 'Por favor, intentelo de nuevo.';

        }else{

            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user_name;
            $_SESSION['user_email'] = $user_email;

            header('Location:/user/dashboard.php');

        }//End Else

    }catch(Exception $e){
            
            $_SESSION['error'] = $e . ' We are unable to process your request. Please try again later';

    }//End Try
}//End Else

if (isset($_SESSION['error'])) {

    header('Location:/index.php');

}

?>