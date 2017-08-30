<?php
  include ('db/db_config.php');

  function authenticate(){
    if (!isset ($_SESSION['client_id']) && !isset($_SESSION['client_username'])){
      header("Location:client_login.php");
    }
  }


 ?>
