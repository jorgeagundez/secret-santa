<?php 

session_start();

$form_token = md5( uniqid('auth', true) );
$_SESSION['form_token'] = $form_token;

if ( !isset($_GET['gameKey']) || !isset($_GET['friendemail']) ){ 
  
  header('Location:/');
  
}else{

  require_once "controller/conexionDb.php";

  try { 

    $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT idfriend, friendname, friendemail FROM friend WHERE gamekey = :game_key AND friendemail = :friend_email");
    $stmt->bindParam(':game_key',$_GET['gameKey'], PDO::PARAM_INT);
    $stmt->bindParam(':friend_email',$_GET['friendemail'], PDO::PARAM_STR);

    $stmt->execute();
    $_SESSION['confirmation_friend'] = $stmt->fetch(PDO::FETCH_ASSOC);

    }catch(Exception $e){
      
      header('Location:/index.php?error=' . 'You can not confirm your game. Please, try it later');

  }//End Try

}//EndElse

include "includes/header.php";
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
include "includes/footer.php";
?>

 