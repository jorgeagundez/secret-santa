<?php 
session_start();

if (!isset($_GET['form_token']) || $_GET['form_token']!=$_SESSION['form_token'] ){ 
   header('Location:/secret_santa/stepOne.php?error=There was a server problem. Please, try it again.');
}

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
              <?php if (isset($_GET['error'])){ echo $_GET['error'];}?>
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
              <input type="hidden" name="form_token" value="<?php echo $_SESSION['form_token']; ?>" />
              <input type="hidden" class="nFriends" name="nFriends"/>
              <button type="submit" class="btn btn-default pull-right">Next Step</button>
            </div>
          </div>
        </div>
      </form>
    </div>
<?php 
include "includes/footer.php";
?>



