<?php 

session_start();

if ( !isset($_GET['gameKey']) || !isset($_GET['friendemail']) ){ 
  
  header('Location:/secret_santa/');
  
}else{

  require_once "/controller/conexionDb.php";

  try { 

    $conn = new PDO("mysql:host=localhost;dbname=secretsanta", 'root', 'jam19977');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT friendemail FROM friend WHERE gamekey = :game_key AND friendemail = :friend_email");
    $stmt->bindParam(':game_key',$_GET['gameKey'], PDO::PARAM_INT);
    $stmt->bindParam(':friend_email',$_GET['friendemail'], PDO::PARAM_STR);

    $stmt->execute();
    $friendemail = $stmt->fetchcolumn(0);

    }catch(Exception $e){
      
      header('Location:/secret_santa/index.php?error=' . 'You can not confirm your game. Please, try it later');

  }//End Try

}//EndElse

include "/includes/header.php";
?>

  <body>
    <div class="container">
      <header>
        <h1>CONFIRMATION</h1>
      </header>
    </div>
    <div class="container">
      <form role="form" id="stepTwo" method="post" action="controller/confirmation.php">
        <div class="col-md-5 well">
          <div class="row">
            <div class="col-md-12">
              <?php if (isset($_GET['error'])){ echo $_GET['error'];}?>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <label for="title">To confirm press the button</label>
              <input type="hidden" name="form_token" value="<?php echo $_SESSION['form_token']; ?>" />
              <button type="submit" class="btn btn-default">Confirm</button>
            </div>
          </div>
        </div>
      </form>
    </div>

<?php 
include "/includes/footer.php";
?>

 