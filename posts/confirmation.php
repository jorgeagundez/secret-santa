<?php 

session_start();

include "../includes/header.php";
?>

  <body>
    <div class="container">
      <header>
        <h1>CONFIRMATION WAS ACCEPTED</h1>
      </header>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          Thank you so much. You will recieve an email with the name of the friend you are partner with.
        </div>
      </div>
    </div>

<script>
setTimeout( function(){ 
    $(location).attr('href', '/controller/logout.php');
  }
 , 5000 );
  
</script>

<?php 
include "../includes/footer.php";
?>

 