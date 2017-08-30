<?php
session_start();

    include('db/authentication.php');
    authenticate();

    $client_id =$_SESSION['client_id'] ;
    $client_user = $_SESSION['client_username'];

    $link = mysqli_query($db, "SELECT * FROM category") or die (mysqli_error($db));


 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Home</title>
   </head>
   <body>
     <h1>ZEE_WORLD</h1>
     <h2>...always there</h2>
     <?php echo "<p>Client_Id:<strong> $client_id</strong></p>";

     echo "<p>Client:<strong> $client_user</strong></p><hr>"


     ?>
     <a href="client_home.php">Home</a>

     <?php
     while($ref = mysqli_fetch_array($link)){

     extract($ref);

     ?>

     <a href="platform.php?cat_id=<?php echo $category_id; ?>&cat_name=<?php echo $category_name?>"><?php echo $category_name ?></a>

     <?php  } ?>
     <a href="logout.php">Logout</a>
     <?php if(isset($_POST['view'])){
     header("Location:viewpage.php?cat_id=$categ_id&cat_name=$categ_name");
     } ?>
     <form class="" action="" method="post">
     <input type="submit" name="view" value="View Asset">
     </form>




<br>
<hr>
<h2>lorem ipsum</h2>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>









   </body>
 </html>
