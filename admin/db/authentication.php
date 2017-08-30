<?php
include("db/db_config.php");
function authenticate(){

if(!isset($_SESSION["admin_id"]) && !isset($_SESSION['admin_name'])){
  $msg = "You are not logged in. please login to continue";
  header("Location:admin_login.php?msg=$msg");

}
}


 ?>
