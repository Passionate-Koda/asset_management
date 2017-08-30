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
    <a href="viewasset.php">View Asset</a>
<a href="logout.php">Logout</a>

<p>View Asset</p>

<?php
    $views= mysqli_query($db, "SELECT * FROM assets") or die(mysqli_error($db));

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
    while($info1 = mysqli_fetch_array($views)){
      extract($info1);

      ?>

      <td><?php echo $info1['asset_id']; ?></td>
      <td><?php echo $info1['category_name']; ?></td>
      <td><?php echo $info1['client_name']; ?></td>
      <td><?php echo $info1['asset_name']; ?></td>
      <td><?php echo $info1['asset_value']; ?></td>
      <td><?php echo $info1['asset_quantity']; ?></td>
      <td><?php echo $info1['asset_location']; ?></td>
      <td><?php echo $info1['date_time']; ?></td>
      <td><?php echo $info1['description']; ?></td>





    </tr>

    <?php } ?>

    </table>
  </body>
</html>
