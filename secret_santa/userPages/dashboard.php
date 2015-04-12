<?php 

session_start();

if(!isset($_SESSION['user_id'])) {
  header('Location:/secret_santa/controller/logout.php');
}

$_SESSION['id_session'] = session_id();

include "../controller/dashboard.php";
include "../includes/header.php";
?>
<!-- htmlspecialchars($_SESSION['error']) -->
  <body>
    <div class="container">
      <header>
        <h1>Welcome <?php echo $_SESSION['user_name'] ?></h1>
      </header>
    </div>
    <div class="container">
      <div class="col-md-12 well">
        <div class="detailsWrapper">
          <?php 

            echo '<h2>User</h2>';

            echo ( '<strong>Id Admin User</strong>:' . $_SESSION['user_id'] . '<br/>' 
              . '<strong>User Name</strong>: ' . $_SESSION['user_name'] . '<br/>'
              . '<strong>User Email</strong>: ' . $_SESSION['user_email']);

            echo '<br/>';
            echo '<br/>';

            echo '<h2>Game Details</h2>';

            if(isset($_SESSION['game_id'])) {
                echo ('<strong>Game Id</strong>:' . $_SESSION['game_id'] . '<br/>' 
                  . '<strong>Game Title</strong>: ' . $_SESSION['game_title']  . '<br/>' 
                  . '<strong>Description</strong>: ' . $_SESSION['game_description']  . '<br/>' 
                  . '<strong>Price</strong>: ' . $_SESSION['game_price']  . '<br/>' 
                  . '<strong>Place</strong>: ' . $_SESSION['game_place'] . '<br/>' 
                  . '<strong>Game Date</strong>: ' . $_SESSION['game_date'] . '<br/>' 
                  . '<strong>Draw Date</strong>: ' . $_SESSION['game_drawdate'] . '<br/>' 
                  . '<strong>Num of Friends</strong>: ' . $_SESSION['numberfriends']);
            }

            echo '<br/>';
            echo '<br/>';

            echo '<h2>Friends List: (' . $_SESSION['numberfriends'] . ')</h2>';


            if(isset($_SESSION['friendname1'])){
              for ($i = 1; $i <= $_SESSION['numberfriends']; $i++) {
                echo $i;
                echo '<br/>';
                echo '<strong>Name</strong>: ' . $_SESSION['friendname' . $i] . ' <strong>Email</strong>: ' . $_SESSION['friendemail' . $i] . '<br/>';
                echo '<strong>Invitation is sent</strong>: ' .$_SESSION['friendinvitation' . $i]. '<br/>';
                echo '<strong>Invitation is confirmed</strong>: ' .$_SESSION['friendconfirmation' . $i]. '<br/>';
                echo '<a href="/secret_santa/controller/delete-friend.php?idfriend=' . $_SESSION['idfriend' . $i] . '&number=' . $i . '">Delete friend</a>';
                echo '<br/><br/>';
              }
            }

            if($_SESSION['groupConfirmed']) {
              echo 'THIS GROUP HAS BEEN CONFIRMED BY ALL FRIENDS. THE DRAW NAMES HAS BEEN DONE SUCCESSFULLY';
              echo '<br/><br/>';
            }

          ?>

       <!--  <form role="form" id="addingFriends" method="post" action="../controller/stepThree.php">
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
              <button type="submit" class="btn btn-default pull-right">Send invitations</button>
            </div>
          </div>
        </div>
      </form> -->
         
        </div>
      </div>
      <div class="col-md-12">
         <?php if (isset($_GET['error'])){ echo $_GET['error'];}?>
         <?php if (isset($_GET['info'])){ echo $_GET['info'];}?>
      </div>
      <div class="col-md-12 well">
        <a href="/secret_santa/userPages/update.php" class="btn btn-default" >Update your Details</a>
      </div>
      <div class="col-md-12 well">
        <a href="/secret_santa/controller/delete-user.php" class="btn btn-default" >Delete your account</a>
      </div>
      <div class="col-md-12 well">
        <a href="/secret_santa/controller/logout.php" class="btn btn-default" >Logout</a>
      </div>
    </div>
   
<?php 
  include "../includes/footer.php";
?>