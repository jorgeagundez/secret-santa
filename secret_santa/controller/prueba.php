<?php

try { 

    $mysql_hostname = 'localhost';
    $mysql_username = 'root';
    $mysql_password = 'jam19977';
    $mysql_dbname = 'secretsanta';

$friendname = 'mami';
$friendemail = 'mami@gmail.com';

                $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("INSERT INTO friend (friendname, friendemail) VALUES (:friend_name, :friend_email)");
                $stmt->bindParam(':friend_name', $friendname, PDO::PARAM_STR);
                $stmt->bindParam(':friend_email', $friendemail, PDO::PARAM_STR);
                

                $stmt->execute();

               


            }catch(Exception $e){
                    
                $error = $e->getCode();
                $error = $error . ' // ' . $e->getMessage();
            }

if (isset($error)) {
    echo $error;
    unset($error);
}

?>