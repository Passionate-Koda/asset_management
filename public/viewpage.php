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
    <title>View Page</title>
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



<?php  $view2 = mysqli_query($db, "SELECT * FROM human_resources WHERE client_name= '".$client_user."' ") or die(mysqli_error($db));

if(mysqli_num_rows($view2) == 0 ){
  echo "<p>Your General Assets Are Displayed Below";
}else{?>
  <table border="1">
    <tr>
      <th>Asset ID</th>
      <th>Asset Category</th>
      <th>Client</th>
      <th>STAFF ID</th>
      <th>Staff Name</th>
      <th>Staff Rank</th>
      <th>Staff Salary</th>
      <th>Staff Annual Salary</th>
      <th>Appointment_date</th>
      <th>Date Time</th>

    </tr>

    <tr>

  <?php
  while($info2 = mysqli_fetch_array($view2)){
    extract($info2);

    ?>

    <td><?php echo $info2['asset_id']; ?></td>
    <td><?php echo $info2['category_name']; ?></td>
    <td><?php echo $info2['client_name']; ?></td>
    <td><?php echo $info2['staff_id']; ?></td>
    <td><?php echo $info2['staff_name']; ?></td>
    <td><?php echo $info2['staff_cadre']; ?></td>
    <td><?php echo $info2['staff_salary']; ?></td>
    <td><?php echo $info2['staff_annual_salary']; ?></td>
    <td><?php echo $info2['appointment_date']; ?></td>
    <td><?php echo $info2['reg_date']; ?></td>





  </tr>

  <?php } ?>





  </table>



<?php } ?>


<?php
$view = mysqli_query($db, "SELECT * FROM assets WHERE client_name= '".$client_user."' ") or die(mysqli_error($db));

 ?>

<table border="1">
  <tr>
    <th>Asset ID</th>
    <th>Asset Category</th>
    <th>Client</th>
    <th>Asset Name</th>
    <th>Asset Value</th>
    <th>Asset Quantity</th>
    <th>Asset Location</th>
    <th>Date Time</th>
    <th>Description</th>
  </tr>

  <tr>

<?php
while($info = mysqli_fetch_array($view)){
  extract($info);

  ?>

  <td><?php echo $info['asset_id']; ?></td>
  <td><?php echo $info['category_name']; ?></td>
  <td><?php echo $info['client_name']; ?></td>
  <td><?php echo $info['asset_name']; ?></td>
  <td><?php echo $info['asset_value']; ?></td>
  <td><?php echo $info['asset_quantity']; ?></td>
  <td><?php echo $info['asset_location']; ?></td>
  <td><?php echo $info['date_time']; ?></td>
  <td><?php echo $info['description']; ?></td>





</tr>

<?php } ?>





</table>
<?php
print_r ($info['date_time']);
?>
  </body>
</html>
