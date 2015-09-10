<?php 

session_start();

$form_token = md5( uniqid('auth', true) );
$_SESSION['form_token'] = $form_token;

if ( !isset($_GET['gameKey']) || !isset($_GET['friendemail']) ){ 
  
  header('Location:/');
  
}else{

  require_once "controller/conexionDb.php";

  $gamekey = strip_tags($_GET['gameKey']);
  $friendemail = strip_tags($_GET['friendemail']);

  $gamekey = filter_var($gamekey,FILTER_SANITIZE_STRING);
  $friendemail = filter_var($friendemail, FILTER_SANITIZE_EMAIL);

  try { 

    $conn = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT idfriend, friendname, friendemail FROM friend WHERE gamekey = :game_key AND friendemail = :friend_email");
    $stmt->bindParam(':game_key',$gamekey, PDO::PARAM_INT);
    $stmt->bindParam(':friend_email',$friendemail, PDO::PARAM_STR);

    $stmt->execute();
    $_SESSION['confirmation_friend'] = $stmt->fetch(PDO::FETCH_ASSOC);

    }catch(Exception $e){
      
      $_SESSION['error'] = 'You can not confirm your game. Please, try it later';
      header('Location:/index.php');

  }//End Try

}//EndElse

include "includes/header.php";
?>

  <body>

    <header class="pass-page">
      <div class="fullwidth_wraper white">
        <div class="container">
          <div class="row">
            <div class="col-xs-12">
              <nav class="main_nav" role="navigation">
                <a class="top_bar" href="/">Secret <span class="red">Santa</span></a>
                <a class="top_bar pull-right" href="#"><small>About</small></a>
              </nav>
            </div>
          </div>  
        </div><!--/.container-->
      </div><!--/.fullwidth_wraper-->
    </header>
      
    <section class="pass-wrap">
      <form role="form" id="confirm" method="post" action="controller/confirmation.php" class="pass-form">  
        <div class="pass_header blue">
          <p class="white">A Jugar!</p>
        </div>
        <div class="input_wrapper">
          <label for="title"></label>
        </div>
        <div class=" input_wrapper">
          <input type="hidden" name="form_token" value="<?php echo $_SESSION['form_token']; ?>" />
          <button type="submit" class="btn btn-default">Confirmar Participación</button>
        </div>
      </form>
    </section>  

    <section class="blue ribbon info-wrap">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 text-center"> 
            <?php if (isset($_SESSION['error'])) { ?>
            <p class="white">
              <a name="info"></a>
              <?php 
              echo $_SESSION['error']; 
              unset($_SESSION['error']);
              ?>
            </p>
            <?php } ?>
          </div>
        </div>
      </div>
    </section>

    
 
<?php include 'includes/footer.php';?>

 