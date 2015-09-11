<?php 

session_start();

include "../includes/header.php";
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
      <form role="form" id="confirm" method="post" action="/secret_santa/controller/confirmation.php" class="pass-form">  
        <div class="pass_header blue">
          <p class="white">CONFIRMACIÓN ACEPTADA</p>
        </div>
        <div class=" input_wrapper">
          <label> Muchas gracias.<br/> Recibirás un email <br/> con el nombre del<br/> amigo que te ha tocado <br/> tan pronto todos los <br/> miembros del juego <br/>hayan confirmado.</label>
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

<script>
setTimeout( function(){ 
    $(location).attr('href', '/controller/logout.php');
  }
 , 10000 );
  
</script>

<?php 
include "../includes/footer.php";
?>

 