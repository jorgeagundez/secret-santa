<?php 
session_start();

if (!isset($_GET['form_token']) || $_GET['form_token']!=$_SESSION['form_token'] ){

   header('Location:/secretsanta/controller/logout.php');
}

include "includes/header.php";
?>

  <body>
    <div class="container">
      <header>
        <h1>STEP 2: Game Rules</h1>
      </header>
    </div>
    <div class="container">
      <form role="form" id="stepTwo" method="post" action="controller/stepTwo.php">
        <div class="col-md-5 well">
          <div class="row">
            <div class="col-md-12">
              <?php if (isset($_GET['error'])){ echo $_GET['error'];}?>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <label for="title">Game Title</label>
              <input type="text" name="title" class="form-control" id="title" placeholder="Choose The Game Title" required="true"/>
            </div>
          </div>
          <div class="row">
             <div class="col-md-12">
              <label for="description">Description</label>
              <textarea type="text" name="description" class="form-control" id="description" required="true">Juego bla bla bla bla</textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <label for="price">Price</label>
              <input type="text" name="price" class="form-control" id="price" placeholder="Maximum set price" required="true"/>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <label for="gameplace">Place of the game</label>
              <input type="text" name="gameplace" class="form-control" id="gameplace" placeholder="Where the game is gonna be?" required="true"/>
            </div>
          </div>
           <div class="row">
            <div class="col-md-12">
              <label for="gamedate">Date of the game</label>
              <input type="date" name="gamedate" class="form-control" id="gamedate" placeholder="Where the game is gonna be?" required="true"/>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <label for="drawdate">Date of the Draw</label>
              <input type="date" name="drawdate" class="form-control" id="drawdate" placeholder="Date for the draw of names" required="true"/>
            </div>
          </div>
          <div class="row">
            <div class="col-md-2">
              <br>
              <input type="hidden" name="form_token" value="<?php echo $_SESSION['form_token']; ?>" />
              <button type="submit" class="btn btn-default">Next Step</button>
            </div>
          </div>
        </div>
      </form>
    </div>

<?php 
include "includes/footer.php";
?>