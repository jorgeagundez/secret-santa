<?php 
session_start();

if (!isset($_SESSION['form_token']) ){
  header('Location:/secretsanta/controller/logout.php');
}

$form_token = md5( uniqid('auth', true) );
$_SESSION['form_token'] = $form_token;

include "includes/header.php";
?>

  <body>
    <div class="container">
      <header>
        <h1>STEP 3: Send invitations</h1>
      </header>
    </div>
    <div class="container">
      <form role="form" id="stepThree" method="post" action="controller/stepThree.php">
        <div class="col-md-8 well">
          <div class="row">
            <div class="col-md-12">
              <?php if (isset($_SESSION['error'])){ echo $_SESSION['error']; unset($_SESSION['error']);}?>
            </div>
          </div>
          <div class="friendList">
            <div class="row">
              <div class="col-md-3">
                <label for="friendname1">Friend</label>
                <input type="text" name="friendname1" class="form-control" id="friendname1" placeholder="name" required="true"/>
              </div>
              <div class="col-md-9">
                <label for="friendemail1">Email</label>
                <input type="email" name="friendemail1" class="form-control" id="friendemail1" placeholder="Email" required="true"/>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <hr />
              <button type="button" class="btn btn-info addFriend pull-left"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> FRIEND</button>
              <input type="hidden" name="form_token" value="<?php echo $form_token; ?>" />
              <input type="hidden" class="nFriends" name="nFriends"/>
              <button type="submit" class="btn btn-default pull-right">Send invitations</button>
            </div>
          </div>
        </div>
      </form>
    </div>
<?php 
include "includes/footer.php";
?>



