<?php 

session_start();

if($_POST['form_token'] != $_SESSION['form_token']){

    $_SESSION['error'] = 'There was a problem sending the confirmation. Please, try it later';

}else{

	require_once "conexionDb.php";
    $confirmation = true;
    $id_friend = $_SESSION['confirmation_friend']['idfriend'];

    try { 

        $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("UPDATE friend SET confirmation = :confirmation WHERE idfriend = :id_friend");
        $stmt->bindParam(':id_friend', $id_friend , PDO::PARAM_INT);
        $stmt->bindParam(':confirmation', $confirmation , PDO::PARAM_BOOL );

        $stmt->execute();

        header('Location:/secret_santa/posts/confirmation.php');

    }catch(Exception $e){
            
        $_SESSION['error'] = 'There was a problem sending the confirmation. Please, try it later.';
        header('Location:/secret_santa/index.php');

    }//end try
}

if (isset($_SESSION['error'])) {
    
   	header('Location:/secret_santa/user/dashboard.php');
    
}

?>

    