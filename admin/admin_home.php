<?php
session_start();
include("db/authentication.php");
authenticate();

$admin_id = $_SESSION['admin_id'];
$admin_name = $_SESSION['admin_name'];


$page = array(1 =>'Add Client',
              2 => 'View Clients',
              3 => 'View Asset');



 ?>

 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <title>Admin_Home</title>
   </head>

   <h1>ZEE_WORLD</h1>
   <h2>...always there</h2>

   <?php echo "<p> Welcome,<strong> $admin_name</strong></p>" ?>

<a href="admin_home.php">Home</a>
   <?php foreach($page as $page_id => $page_name){ ?>


   <a href="admin_platform.php?page_id=<?php echo $page_id?>&page_name=<?php echo $page_name  ?>"><?php echo $page_name ?></a>

<?php } ?>

<a href="logout.php">Logout</a>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>




   </body>
 </html>
