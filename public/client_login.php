<?php

session_start();
 include ('db/db_config.php');


?>



<html>
<head>
<title> Client Login </title>
<link rel="stylesheet" href="style.css">
</head>



<body>
      <div class="container"> <!-- Container -->






    <div class="login"> <!-- Login Container -->
      <h1> Client Login </h1>
      <?php
        if (isset ($_POST['client_login'])) {
          $error = array ();

          if (empty($_POST['client_user'])){
            $error[]= "Please Enter Your Username";
          } else {
            $username = mysqli_real_escape_string($db, $_POST['client_user']);
          }

          if (empty ($_POST['client_pword'])) {
            $error[] = "Please Enter Your Password";
          } else {
            $password = md5(mysqli_real_escape_string($db, $_POST['client_pword']));
          }

          if (empty($error)){
            $query=mysqli_query($db, "SELECT * FROM client WHERE client_username ='".$username."' AND client_secured_password='".md5($password)."'") or die (mysqli_error($db));

            if (mysqli_num_rows($query)==1){
              $row=mysqli_fetch_array($query);

              $_SESSION['client_id'] = $row['client_id'];
              $_SESSION['client_username'] = $row['client_username'];


              header("Location:client_home.php");

            } else {
              $error_message="Invalid account name and password";

              header("Location:client_login.php?err=$error_message");}
          } foreach ($error as $error) {
            echo "<p>".$error."</p>";
          }

        }//Main IF

        if(isset($_GET['err'])){
          echo "<p>".$_GET['err']."</p>";
        }

       ?>
    <form  method="post" action="">

      <p>
        Username:
      </p><input  type="text" name="client_user"/>

      <p>
        Password:
      </p><input  type="password" name="client_pword"/>


        <input type="submit" name="client_login" value="LOGIN" id="button"/>



    </form>
  </div><!-- form div-->
  <div class="footer">
    &copy; Copyright of Zee World 2017
    </div>
  </div><!-- Container -->

</body>


</html>
