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
$TeamNumber = strip_tags($_GET['TeamNumber']);

//$sortType = htmlspecialchars($_GET["sortType"]); // Should be a column name
//$sortOrder = htmlspecialchars($_GET["sortOrder"]); // Should be ASC or DSC
$sql = "SELECT * FROM `matches` WHERE `TeamNumber` = '$TeamNumber' AND `Competition` = '$cid'";
$search_result = mysqli_query($connect, $sql);
}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/databasestyle.css">
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
<h1>Team: <?php echo $TeamNumber; ?></h1>
<img src="/uploads/<?php echo $TeamNumber; ?>.jpg" height="500" width="500" />
<h2>Comments: </h2>


<h2>Matches</h2>
<table>
<tr>
    <th>Team Number</th>
    <th>Match Number</th>
    <th>HAB Start</th>
    <th>Sandstorm Cargo</th>
    <th>Sandstorm Panels</th>
    <th>Cargo From Floor</th>
    <th>Cargo From Human</th>
    <th>Panel From Floor</th>
    <th>Panel From Human</th>
    <th>Defense Level</th>
    <th>Ship Hatch</th>
    <th>Ship Cargo</th>
    <th>Rocket Hatch</th>
    <th>Rocket Cargo</th>
    <th>HAB End</th>
    <th>Robots Carried</th>
    <th>Comments</th>
    <th>Scout Name</th>
    
  </tr>
<?php while($row = mysqli_fetch_array($search_result)):?>
  <tr>
    <td><?php echo $row['TeamNumber']; ?></td>
    <td><a href="/match.php?MatchNumber=<?php echo $row['MatchNumber']; ?>"><?php echo $row['MatchNumber']; ?></a></td>
    <td class="habitems"><?php echo $row['HABSandstormScore']; ?></td>
    <?php $totalHABSandstormScore += $row['HABSandstormScore']; ?>
    <td class="cargoitems"><?php echo $row['SandstormCargo']; ?></td>
    <?php $totalSandstormCargo += $row['SandstormCargo']; ?>
    <td class="panelitems"><?php echo $row['SandstormPanels']; ?></td>
    <?php $totalSandstormPanels += $row['SandstormPanels']; ?>
    <td class="cargoitems"><?php echo $row['CargoFromFloor']; ?></td>
    <?php $totalCargoFromFloor += $row['CargoFromFloor']; ?>
    <td class="cargoitems"><?php echo $row['CargoFromHuman']; ?></td>
    <?php $totalCargoFromHuman += $row['CargoFromHuman']; ?>
    <td class="panelitems"><?php echo $row['PanelFromFloor']; ?></td>
    <?php $totalPanelFromFloor += $row['PanelFromFloor']; ?>
    <td class="panelitems"><?php echo $row['PanelFromHuman']; ?></td>
    <?php $totalPanelFromHuman += $row['PanelFromHuman']; ?>
    <td class="habitems"><?php echo $row['DefenseLevel']; ?></td>
     <?php $totalDefenseLevel += $row['DefenseLevel']; ?>
    <td class="panelitems"><?php echo $row['ShipPanels']; ?></td>
    <?php $totalShipPanels += $row['ShipPanels']; ?>
    <td class="cargoitems"><?php echo $row['ShipCargo']; ?></td>
    <?php $totalShipCargo += $row['ShipCargo']; ?>
    <td class="panelitems">A<?php echo $row['HighRocketPanels']; ?><br>B<?php echo $row['MidRocketPanels']; ?><br>C<?php echo $row['LowRocketPanels']; ?></td>
    <?php $totalHighRocketPanels += $row['HighRocketPanels']; ?>
    <?php $totalMidRocketPanels += $row['MidRocketPanels']; ?>
    <?php $totalLowRocketPanels += $row['LowRocketPanels']; ?>
    <td class="cargoitems">A<?php echo $row['HighRocketCargo']; ?><br>B<?php echo $row['MidRocketCargo']; ?><br>C<?php echo $row['LowRocketCargo']; ?></td>
    <?php $totalHighRocketCargo += $row['HighRocketCargo']; ?>
    <?php $totalMidRocketCargo += $row['MidRocketCargo']; ?>
    <?php $totalLowRocketCargo += $row['LowRocketCargo']; ?>
    <td class="habitems"><?php echo $row['HABEndScore']; ?></td>
    <?php $totalHABEndScore += $row['HABEndScore']; ?>
    <td class="habitems"><?php echo $row['RobotsCarried']; ?></td>
    <?php $totalRobotsCarried += $row['RobotsCarried']; ?>
    <td><?php echo $row['Comments']; ?></td>
    <td><?php echo $row['ScoutName']; ?></td>
  </tr>
	<?php $counter++; ?>
<?php endwhile; ?>


</table>
</html>

<?php
$totalHABSandstormScore /= $counter;
$totalSandstormCargo /= $counter;
$totalSandstormPanels /= $counter;
$totalCargoFromFloor /= $counter;
$totalCargoFromHuman /= $counter;
$totalPanelFromFloor /= $counter;
$totalPanelFromHuman /= $counter;
$totalDefenseLevel /= $counter;
$totalShipPanels /= $counter;
$totalShipCargo /= $counter;
$totalHighRocketPanels /= $counter;
$totalMidRocketPanels /= $counter;
$totalLowRocketPanels /= $counter;
$totalHighRocketCargo /= $counter;
$totalMidRocketCargo /= $counter;
$totalLowRocketCargo /= $counter;
$totalHABEndScore /= $counter;
$totalRobotsCarried /= $counter;

$sql = "SELECT * FROM `matchAverages` WHERE `TeamNumber` = '$TeamNumber' AND `Competition` = '$cid'";

$search_result = mysqli_query($connect, $sql);
$exists = false;
while($row = mysqli_fetch_array($search_result)):
$exists = true;
endwhile;

if($exists){
$sql = "UPDATE `matchAverages` SET `HABSandstormScore`='$totalHABSandstormScore',`SandstormCargo`='$totalSandstormCargo',`SandstormPanels`='$totalSandstormPanels',`CargoFromFloor`='$totalCargoFromFloor',`CargoFromHuman`='$totalCargoFromHuman',`PanelFromFloor`='$totalPanelFromFloor',`PanelFromHuman`='$totalPanelFromHuman ,`DefenseLevel`='$totalDefenseLevel',`ShipCargo`='$totalShipCargo',`ShipPanels`='$totalShipPanels',`LowRocketCargo`='$totalLowRocketPanels',`LowRocketPanels`='$totalLowRocketPanels',`MidRocketCargo`='$totalMidRocketCargo',`MidRocketPanels`='$totalMidRocketPanels',`HighRocketCargo`='$totalHighRocketCargo',`HighRocketPanels`='$totalHighRocketPanels',`RobotsCarried`='$totalRobotsCarried',`HabEndScore`='$totalHABEndScore' WHERE `TeamNumber` = '$TeamNumber' AND `Competition` = '$cid'";
}else{
    $sql = "INSERT INTO `matchAverages` (Competition, TeamNumber, HABSandstormScore, SandstormCargo, SandstormPanels, CargoFromFloor, CargoFromHuman, PanelFromFloor, PanelFromHuman, DefenseLevel, ShipCargo, ShipPanels, LowRocketCargo, LowRocketPanels, MidRocketCargo, MidRocketPanels, HighRocketCargo, HighRocketPanels, RobotsCarried, HabEndScore) VALUES ('$cid', '$TeamNumber', '$totalHABSandstormScore', '$totalSandstormCargo', '$totalSandstormPanels', '$totalCargoFromFloor', '$totalCargoFromHuman', '$totalPanelFromFloor', '$totalPanelFromHuman', '$totalDefenseLevel', '$totalShipCargo', '$totalShipPanels', '$totalLowRocketCargo', '$totalLowRocketPanels', '$totalMidRocketCargo', '$totalMidRocketPanels', '$totalHighRocketCargo', '$totalHighRocketPanels', '$totalRobotsCarried', '$totalHabEndScore')";
    
}

if ($connect->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
?>