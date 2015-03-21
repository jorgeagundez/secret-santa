<?php 

session_start();

if(!isset($_SESSION['user_id']))
{
    header('Location:/secret_santa/index.php?error=' . 'You must be logged in to updated your details');
    die();

}elseif($_SESSION['id_session'] != session_id()){

    echo 'There was a mistake in the session, please, login again <a href="/ejemplos-php/practicas/ejemplo_autentificacion2/includes/logout.php">here</a>';
    die();

}elseif(!isset($_FILES['image'])){

    $error = 'Please enter a valid file';

}elseif( $_POST['form_token'] != $_SESSION['form_token']){

    $error = 'Invalid form update, please try again <a href="/ejemplos-php/practicas/ejemplo_autentificacion2/updateImage.php">here</a>';

}else{

    $user_id = $_SESSION['user_id'];

    require_once "/conexionDb.php";

    try {

        $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //INSERT THE IMAGE INTO A FOLDER UPLOADS IN SERVER
        $target_path = "../images/users/";
        $image = basename($_FILES['image']['name']);
        $image_name = explode('.', $image);
        $image_type = array_pop( $image_name);
        $image = $_SESSION['user_name'] . '.' . $image_type;
        $image_path = $target_path . $image;
        $moving = move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
        $image_path = '/ejemplos-php/practicas/ejemplo_autentificacion2/images/users/' . $image;
       
        //INSERT THE PATH OF THE IMAGE IN SERVER TO THE DATABASE
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        
        $stmt = $conn->prepare("UPDATE user SET userimage = :user_image WHERE idusuario = :id");
        $stmt->bindParam(':id', $user_id, PDO::PARAM_STR);
        $stmt->bindParam(':user_image', $image, PDO::PARAM_STR, 40);
      
        $stmt->execute();
        
        unset( $_SESSION['form_token'] );

        if (!$user_id || !$moving) {

            $error = 'Update Failed. Please, try again.';

        }else{

            $_SESSION['user_image'] = $image;
            header('Location:/secret_santa/userPages/dashboard.php?info=You are now update your image');

        }

    }catch(Exception $e){
            
        var_dump($e->getMessage());
        
        $error = 'We are unable to process your request. Please try again later"';

    }
}

if (isset($error)) {

    header('Location:/secret_santa/userPages/updateImage.php?error=' . $error);
    unset($error);
}

?>