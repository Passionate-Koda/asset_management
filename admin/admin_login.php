<?php
session_start();
include("db/db_config.php");

 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Zee_World | Admin Login</title>
     <link rel="stylesheet" type="text/css"  href="style\style.css">
   </head>
   <body>

        <div class="container"> <!-- Container -->

          <div class="login"> <!-- Login Container -->
       <h1 class="txt">Zee World</h1>
       <h4 class="txt">Admin Login</h4>

       <h6 class="txt">Login Please</h6>
<?php
        if(isset($_POST['submit'])){
        $error = array();
        if(empty($_POST['username'])){
          $error[] = "Please Enter Username";
        }else{
          $username = mysqli_real_escape_string($db, $_POST['username']);
        }


        if (empty($_POST['password'])) {
          $error[] = "Please Enter Password";
        }else{
          $password = md5(mysqli_real_escape_string($db, $_POST['password']));
        }

        if(empty($error)){

        $check = mysqli_query($db, "SELECT * FROM admin WHERE admin_name = '".$username."' AND  secured_password = '".$password."'") or die(mysqli_error($db));

        if(mysqli_num_rows($check)== 1){
        while($row = mysqli_fetch_array($check)){

        $_SESSION['admin_id'] = $row['admin_id'];
        $_SESSION['admin_name']= $row['admin_name'];
        header("Location:admin_home.php");
        }
        }else{
          $invalid = "invalid username and password";
          header("Location:admin_login.php?invalid=$invalid");
        }


        }else{
          foreach ($error as $err){
            echo"<p>".$err."</p>";
          }
        }

        }

        if(isset($_GET['invalid'])){
          $invalid = $_GET['invalid'];
          echo "<p>$invalid</P>";
        }

        if(isset($_GET['msg'])){
          $msg = $_GET['msg'];
          echo "<p>$msg</p>";
        }

         ?>
         <div class="form.container">


        <form action="" method="post" class ="form_style">


        <p>Username:</p>
        <input type="text" name="username" value="">
        <p>Password:</p>
        <input type="password" name="password" value=""><br>
        <input type="submit" name="submit" value="Login" id="button">

        <div class="footer">
          &copy; Copyright of Zee World 2017
          </div>
        </form>
      </div> <!-- Login Container -->





      </div><!-- Container -->


   </body>
 </html>
