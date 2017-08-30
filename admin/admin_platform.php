<?php
session_start();
include("db/authentication.php");
authenticate();

$admin_id = $_SESSION['admin_id'];
$admin_name = $_SESSION['admin_name'];

$page = array(1 =>'Add Client',
              2 => 'View Clients');

if(isset($_GET['page_id']) && isset($_GET['page_name'])){
  $page2 = $_GET['page_id'];
  $client_page = $_GET['page_name'];
}




?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <h1>ZEE_WORLD</h1>
    <h2>...always there</h2>

    <?php echo "<p> Welcome,<strong> $admin_name</strong></p>" ?>
    <a href="admin_home.php">Home</a>
    <?php foreach($page as $page_id => $page_name){ ?>


    <a href="admin_platform.php?page_id=<?php echo $page_id?>&page_name=<?php echo $page_name  ?>"><?php echo $page_name ?></a>

    <?php } ?>
    <a href="viewasset.php?page_id=3&page_name=viewasset">View Asset</a>
<a href="logout.php">Logout</a>

    <?php echo "<p>$client_page</p>" ?>

    <?php
if($client_page == "Add Client"){

  if(isset($_POST['submit'])){
    $error = array();

  if(empty($_POST['client'])){
    $error[] = "Enter Your Client Name";
  }
    else{
        $client =  mysqli_real_escape_string($db, $_POST['client']);
    }

  if(empty($_POST['address'])){
      $error[] = "Enter Clients Address";
    }
    else{
        $address = mysqli_real_escape_string($db, $_POST['address']);
      }

  if(empty($_POST['mail'])){
    $error[] = "Enter Your E-mail Address";
  }
  else{
      $mail = mysqli_real_escape_string($db, $_POST['mail']);
  }
  if(empty($_POST['user'])){
    $error[] = "Chosse A Username";
  }
    else{
        $user = mysqli_real_escape_string($db, $_POST['user']);
    }

  if(empty($_POST['pword'])){
    $error[] = "Enter Your Password";
  }
    else{
        $pword = mysqli_real_escape_string($db, $_POST['pword']);
    }

  if(empty($_POST['cpword'])){
    $error[] = "Re-enter Your Password";
  }elseif(isset($_POST['pword']) && $_POST['pword'] != $_POST['cpword']){
    $error[] = "Password not match";
  }else{
        $cpword = md5(mysqli_real_escape_string($db, $_POST['cpword']));
    }
    if(empty($error)){

      $check = mysqli_query($db, "SELECT * FROM client WHERE client_email= '".$mail."' ") or die (mysqli_error($db));

      if(mysqli_num_rows($check)== 1){
        $null= "Email already used to register ";
        header("Location:admin_home.php?null=$null");
      }else{
        $recheck = mysqli_query($db, "SELECT * FROM client WHERE client_username= '".$user."' ") or die (mysqli_error($db));
        if(mysqli_num_rows($recheck)==0 ){

      $create = mysqli_query($db, "INSERT INTO client VALUES(NULL, '".$client."', '".$address."', '".$mail."',
                   '".$user."', '".$pword."', '".md5($cpword)."', NOW()) ") or die(mysqli_error($db));



            $success = "Field Successfully Entered";
            header("Location:admin_platform.php?page_id=$page2&page_name=$client_page&succ=$success");
          }else{
            $wrong = "username already exists";
            header("Location:admin_home.php?wrong=$wrong");
          }
  }


            }else{
              foreach($error as $err){
              echo "<p>". $err. "</p>";
        }

    }
  }

  if(isset($_GET['succ'])){
    echo "<p>". $_GET['succ']."</p>";
  }

  if(isset($_GET['null'])){
    echo "<p>". $_GET['null']."</p>";
  }

  if(isset($_GET['wrong'])){
    echo "<p>". $_GET['wrong']."</p>";
  }

  ?>

  <form action="" method="post">

  <p> Client Name: <input type="text" name="client"/></p>
    <p> Client Address:<input type="text" name="address"/></p>
    <p> Client E-mail: <input type="text" name="mail"/></p>
    <p> Client Username: <input type="text" name="user"/></p>
    <p> Client Password: <input type="password" name="pword"/></p>
    <p> Confirm Password:<input type="password" name="cpword"/></p>
    <input type="submit" name="submit" value="Add"/>

  </form>


<?php }else{

$view= mysqli_query($db, "SELECT * FROM client") or die(mysqli_error($db));



?>
<table border="1">
  <tr>
    <th>Client ID</th><th>Client Name</th><th>Clients Email</th><th>Client Username</th><th>Client Address</th>
  </tr>

  <tr>
    <?php
    while($get = mysqli_fetch_array($view)){
      extract($get);
?>
<td><?php echo $client_id ?></td>
<td><?php echo $client_name ?></td>
<td><?php echo $client_email ?></td>
<td><?php echo $client_username ?></td>
<td><?php echo $client_address ?></td>
  </tr>
<?php } ?>

</table>
<?php } ?>



  </body>
</html>
