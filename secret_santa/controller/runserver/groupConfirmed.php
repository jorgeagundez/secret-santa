
<?php 

try { 

    require_once "../conexionDb.php";
    $confirmation = true;

    $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT confirmation, game_idgame FROM friend WHERE confirmation = :confirmation");
    $stmt->bindParam(':confirmation', $confirmation , PDO::PARAM_INT);
    $stmt->execute();

    //Array with list of games with at least one friend confirmed
    $gamesChecked = array();

    //Each of the friends
    while($friendRow = $stmt->fetch(PDO::FETCH_ASSOC) ) {
        
        $idgame = $friendRow['game_idgame'];
        $j = count($gamesChecked);

        $match = false;
        for ($i = 0; $i < $j ; $i++) {
            if ( $gamesChecked[$i] == $idgame ) {
                $match = true;
            }
        }
        if(!$match) {

            //To don't check the game more than once
            array_push($gamesChecked, $idgame);

            $conn2 = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
            $conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt2 = $conn2->prepare("SELECT friendname, confirmation FROM friend WHERE game_idgame = :game_idgame");
            $stmt2->bindParam(':game_idgame', $idgame , PDO::PARAM_INT);
            $stmt2->execute();

            $nFriends = 0;
            $groupConfirmation = array();
            while ( $friend = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                array_push($groupConfirmation, $friend['confirmation'] );
                $nFriends = $nFriends + 1;
            }

            $groupComplete = true;
            for ($i = 0; $i < $nFriends ; $i++) {
                if ( $groupConfirmation[$i] == false ) {
                    $groupComplete = false;
                }
            }

            if( $groupComplete == true ) {

                $confirmed = true;
                $conn3 = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
                $conn3->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt3 = $conn3->prepare("UPDATE game SET confirmed = :confirmed WHERE idgame = :game_idgame");
                $stmt3->bindParam(':game_idgame', $idgame , PDO::PARAM_INT);
                $stmt3->bindParam(':confirmed', $confirmed , PDO::PARAM_BOOL);
                $stmt3->execute();

                echo '<br/> GROUP WITH ID: ' . $idgame . ' is completed. Ready for DRAWNAMES. <br/>';
            }

        }

    };

}catch(Exception $e){
        
        if( $e->getCode() == 23000){
            $error = $error;
        }
        else{
            $error = $e->getCode();
        }
}//End Try





?>
