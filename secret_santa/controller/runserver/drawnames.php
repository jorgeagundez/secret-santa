<?php

 	//To get an array with all group
    $stmt2->execute();
    $group = $stmt2->fetchAll();


    //Array with ids of friend in the same group
    $ids = array();
    for ($i = 0; $i < $nFriends; $i++){
    	array_push($ids, array() );
    	array_push($ids[$i], $group[$i]['idfriend'] );
    	array_push($ids[$i], $group[$i]['friendname'] );
    	array_push($ids[$i], $group[$i]['friendemail'] );		
    }//Endfor

    $pair = false;
    while ($pair == false) {
    	
    	$pair = true;
	    $idsUnMixed = $ids;
	    shuffle($ids);
	    $idsMixed = $ids;

	    //Array 2D for couples
	    $couples = array();

	    //Checking if there is not wrong couples
	    for ($i = 0; $i < $nFriends; $i++){

	    	array_push($couples, array() );
	    	array_push($couples, array() );
	    	array_push($couples[$i],$idsUnMixed[$i]);
	    	array_push($couples[$i],$idsMixed[$i]);
	   

	    	if( $idsUnMixed[$i][0] == $idsMixed[$i][0] ) {
	    		$pair = false;
	    	}
	 
	    }//Endfor
	    

	    if ($pair) {
 
	    	include 'sendemails.php';

	    }
	    
	}//EndWhile

?>