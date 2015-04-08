
<?php 

try { 

    require_once "../conexionDb.php";
    $confirmation = true;

    $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT confirmation, game_idgame FROM friend WHERE confirmation = :confirmation");
    $stmt->bindParam(':confirmation', $confirmation , PDO::PARAM_INT);

    $stmt->execute();

    //OPTION 1
    // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // print_r($result);

    //OPTION 2
    $gameschecked = array();

    while( $result = $stmt->fetch(PDO::FETCH_ASSOC) ) {
        
        echo '<br/>';
        echo 'RESULT:';
        echo '<br/>';
        echo '-------------------';
        echo '<br/>';
        print_r($result);
        echo '<br/>';
        $idgame = $result['game_idgame'];
        echo $idgame . '<br/>';
        
        echo '<br/>';
        echo '<br/>';
        print_r($gameschecked);
        echo '<br/>';
        $j = count($gameschecked);
        echo $j;
        echo '<br/>';

        

        $flat = false;
        for ($i = 0; $i < $j ; $i++) {
            if ( $gameschecked[$i] == $idgame ) {
                $flat = true;
            }
        }
        if( $flat == false ) {
            $conn2 = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
            $conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt2 = $conn2->prepare("SELECT friendname, confirmation FROM friend WHERE game_idgame = :game_idgame");
            $stmt2->bindParam(':game_idgame', $idgame , PDO::PARAM_INT);

            $stmt2->execute();

            echo '<br/>';
            echo 'GROUP:';
            echo '<br/>';
            while ( $group = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                $confirmation = $group['confirmation'];
                echo $confirmation;
            }
            
            array_push($gameschecked, $idgame);
        }

        echo '<br/>';
        echo '<br/>';
        echo '<br/>';

    };

    echo '<br/>';
    echo 'FINAL ARRAY:';
    echo '<br/>';
    echo '-------------------';
    echo '<br/>';
    print_r($gameschecked);

}catch(Exception $e){
        
        if( $e->getCode() == 23000){
            $error = $error;
        }
        else{
            $error = $e->getCode();
        }
}//End Try





?>
