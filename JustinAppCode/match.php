<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
$db_HOST = "localhost";
$db_USER = "team7558_s";
$db_PASS = "Mr.Roboto11235";
$db_NAME = "team7558_scouting";
if(isset($_SESSION['username'])){
$connect = mysqli_connect($db_HOST, $db_USER, $db_PASS, $db_NAME);
$cid = $_SESSION['cid'];
$MatchNumber = strip_tags($_GET['MatchNumber']);

//$sortType = htmlspecialchars($_GET["sortType"]); // Should be a column name
//$sortOrder = htmlspecialchars($_GET["sortOrder"]); // Should be ASC or DSC
$sql = "SELECT * FROM `matches` WHERE `MatchNumber` = '$MatchNumber' AND `Competition` = '$cid'";
$search_result = mysqli_query($connect, $sql);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="css/databasestyle.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>

<body>
<h1>Results From Match <?php echo $MatchNumber; ?></h1>
<table>
<tr>
    <th>Team Number</th>
    <th>Hab Start</th>
    <th>Sandstorm Cargo</th>
    <th>Sandstorm Panels</th>
    <th>Cargo From Floor</th>
    <th>Cargo From Human</th>
    <th>Panel From Floor</th>
    <th>Panel From Human</th>
    <th>Ship Hatch</th>
    <th>Ship Cargo</th>
    <th>Rocket Hatch</th>
    <th>Rocket Cargo</th>
    <th>Hab End</th>
    <th>Robots Carried</th>
  </tr>
<?php while($row = mysqli_fetch_array($search_result)):?>
  <tr>
    <td><a href="/team.php?TeamNumber=<?php echo $row['TeamNumber']; ?>"><?php echo $row['TeamNumber']; ?> </a></td>
    <td><?php echo $row['HABSandstormScore']; ?></td>
    <td><?php echo $row['SandstormCargo']; ?></td>
    <td><?php echo $row['SandstormPanels']; ?></td>
    <td><?php echo $row['CargoFromFloor']; ?></td>
    <td><?php echo $row['CargoFromHuman']; ?></td>
    <td><?php echo $row['PanelFromFloor']; ?></td>
    <td><?php echo $row['PanelFromHuman']; ?></td>
    <td><?php echo $row['ShipPanels']; ?></td>
    <td><?php echo $row['ShipCargo']; ?></td>
    <td>A<?php echo $row['HighRocketPanels']; ?>, B<?php echo $row['MidRocketPanels']; ?>, C<?php echo $row['LowRocketPanels']; ?></td>
    <td>A<?php echo $row['HighRocketCargo']; ?>, B<?php echo $row['MidRocketCargo']; ?>, C<?php echo $row['LowRocketCargo']; ?></td>
    <td><?php echo $row['HabEndScore']; ?></td>
    <td><?php echo $row['RobotsCarried']; ?></td>
  </tr>

<?php endwhile; ?>
</table>
</body>
</html>
