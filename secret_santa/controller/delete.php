<?php
/*** begin our session ***/
session_start();

require_once "conexionDb.php";
$user_id = $_SESSION['user_id'];

try {

    $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("DELETE FROM user WHERE idusuario = :id");
    $stmt->bindParam(':id', $user_id, PDO::PARAM_STR);

    $stmt->execute();

    unset( $_SESSION['form_token'] );
    header('Location:logout.php');


}catch(Exception $e){
        
    echo 'We are unable to process your request. Please try again later';
    echo '<a href="/secret_santa/userPages/dashboard.php" class="btn btn-default" >Go back to the member page</a>';

}
?>