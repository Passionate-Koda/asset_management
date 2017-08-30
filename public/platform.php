<?php
session_start();

include("db/authentication.php");
authenticate();

$client_id = $_SESSION['client_id'];
$client_user = $_SESSION['client_username'];

if(isset($_GET['cat_id']) && isset($_GET['cat_name'])){
  $categ_id = $_GET['cat_id'];
  $categ_name = $_GET['cat_name'];
}


$tabs = mysqli_query($db, "SELECT * FROM category") or die(mysqli_error($db));

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Zee_World</title>
  </head>
  <body>

    <h1>ZEE_WORLD</h1>
    <h2>...always there</h2>
<?php echo "<p>Client_Id:<strong> $client_id</strong></p>";

 echo "<p>Client:<strong> $client_user</strong></p><hr>"


?>
<a href="client_home.php">Home</a>

<?php
while($ref = mysqli_fetch_array($tabs)){

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

<?php echo "<p>$categ_name</p>" ?>

<?php
if($categ_name == "Human Resources"){
echo "<p> Enter Your Human Resource Assets Here </p>";
if(isset ($_POST['enter'])){
  $null = array();
  if(empty($_POST['staff_name'])){
    $null[] = "Please Enter Staff's Full Name";
  }else{
    $staff_name = mysqli_real_escape_string($db, $_POST['staff_name']);
  }

  if(empty($_POST['staff_rank'])){
    $null[] = "Please enter staff rank";
  }else{
    $staff_rank = mysqli_real_escape_string($db, $_POST['staff_rank']);
  }

  if(empty($_POST['staff_salary'])){
    $null[] = "Please Enter Staff Salary";
  }elseif(isset($_POST['staff_salary']) && $_POST['staff_salary'] == !is_numeric($_POST['staff_salary'])){
    $null[] = "Please Enter Numeric Value fo  STaff Salary";
  }else{
    $staff_salary = mysqli_real_escape_string($db, $_POST['staff_salary']);
  }

  if(empty($_POST['appointment_date'])){
    $null[] = "Please Enter Date of Appointment";
  }else{
    $appointment = mysqli_real_escape_string($db, $_POST['appointment_date']);
  }

  if(empty($null)){
    $annual_salary = ($staff_salary * 12);
$ins = mysqli_query($db, "INSERT INTO human_resources
VALUES(NULL,
      '".$categ_id."',
      '".$categ_name."',
      '".$client_user."',
      '".rand(10000,999999)."',
      '".$staff_name."',
      '".$staff_rank."',
      '".$staff_salary."',
      '".$annual_salary."',
      '".$appointment."',
      NOW() )") or die (mysqli_error($db));

      $successful = "Human Resource asset  Successfully Added";
      header("Location:platform.php?cat_id=$categ_id&cat_name=$categ_name&successful=$successful");

  }else{
    foreach($null as $null){
      echo $null;
}
  }
}

if(isset($_GET['successful'])){
  $successful = $_GET['successful'];
  echo "<p>$successful</p>";
}

?>

<form class="" action="platform.php?cat_id=<?php echo $categ_id ?>&cat_name=<?php echo $categ_name ;?>" method="post">

<p>Staff's Full Name: <input type="text" name="staff_name" value=""></p>
<p>Staff Rank:</p>

<p><strong><input type="radio" name="staff_rank" value="Rank 1">(*)

<input type="radio" name="staff_rank" value="Rank 2">(**)

<input type="radio" name="staff_rank" value="Rank 3">(***)

<input type ="radio" name="staff_rank" value="Rank 4">(****)
<input type ="radio" name="staff_rank" value="rank 5">(*****)</strong></p>

<p>Staff_Salary<input type="text" name="staff_salary" value=""></p>
<p>Date of Appointmrnt:<input type="date" name="appointment_date" value=""></p>
<input type="submit" name="enter" value="Submit">

</form>






<?PHP }else{?>


<?PHP


  if(isset($_POST['submit'])){
  $wrong = array();

  if (empty($_POST['asset_name'])) {
    $wrong[] = "Enter Asset Name";
  }else{
    $asset_name = mysqli_real_escape_string($db, $_POST['asset_name']);
  }

  if(empty($_POST['asset_value'])){
    $wrong[] = "Enter Asset Value";
  }elseif(isset($_POST['asset_value']) && $_POST['asset_value'] == !is_numeric($_POST['asset_value'])){
    $wrong[] = "Enter numeric value for asset Value";
  }else{
    $asset_value = mysqli_real_escape_string($db, $_POST['asset_value']);
  }

  if(empty($_POST['asset_quantity'])){
    $wrong[] = "Enter Asset Quantity";
  }elseif(isset($_POST['asset_quantity']) && $_POST["asset_quantity"] == !is_numeric($_POST['asset_quantity'])){
    $wrong[] = "Enter numeric value for asset quantity";
  }else{
    $asset_quantity = mysqli_real_escape_string($db, $_POST['asset_quantity']);
  }

  if(empty($_POST['asset_address'])){
    $wrong[] = "Please enter Asset Location";
  }else{
    $asset_address = mysqli_real_escape_string($db, $_POST['asset_address']);
  }

  if(empty($_POST['asset_des'])){
    $wrong[] = "Plaese enter assept Description";
  }else{
    $asset_des = mysqli_real_escape_string($db, $_POST['asset_des']);
  }

  if(empty($wrong)){
    $insert = mysqli_query($db, "INSERT INTO assets
    VALUES (NULL,
    '".$categ_id."',
    '".$categ_name."',
    '".$client_user."',
    '".$asset_name."',
    '".$asset_value."',
    '".$asset_quantity."',
    '".$asset_address."',
    NOW(),
    '".$asset_des."') ") or die(mysqli_error($db));

    $success = "Your Asset Has been added to the database";
    header("Location:platform.php?cat_id=$categ_id&cat_name=$categ_name&success=$success");
  }else{
    foreach($wrong as $error){
    echo "<p>$error</p>";
  }
}

}


if(isset($_GET['success'])){
  $success = $_GET['success'];
  echo "<p>$success</p>";
}



 ?>

<p>Please Take inventory of your assets below</p>
<form class="" action="platform.php?cat_id=<?php echo $categ_id; ?>&cat_name=<?php echo $categ_name; ?>" method="post">




<p>Asset Name: <input type="text" name="asset_name" value=""></p>
<p>Asset value: <input type="text" name="asset_value" value=""></p>
<p>Asset quantity: <input type="text" name="asset_quantity" value=""></p>
<p>Asset Location Address:<br><textarea name="asset_address" rows="3" cols="30"></textarea>
<p>Asset Descpition: </p><br>
<textarea name="asset_des" rows="8" cols="80"></textarea>
<input type="submit" name="submit" value="enter">

<br>
<br>
<br>

</form>





<?php }?>
  </body>
</html>
