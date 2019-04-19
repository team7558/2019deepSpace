<?php 
error_reporting(E_ERROR | E_PARSE);
session_start();

$conn = new mysqli($db_HOST, $db_USER, $db_PASS, $db_NAME);

$Date = date("Y/m/d");
$Time = date("h:i:sa");
$Username = strip_tags($_POST['Username']);
$Updated = true;
$HABSandstormScore = strip_tags($_POST['HABSandstormScore']);
$SandstormCargo = strip_tags($_POST['SandstormCargo']);
$SandstormPanels = strip_tags($_POST['SandstormPanels']);
$CargoFromFloor = strip_tags($_POST['CargoFromFloor']);
$CargoFromHuman = strip_tags($_POST['CargoFromHuman']);
$PanelFromFloor = strip_tags($_POST['PanelFromFloor']);
$PanelFromHuman = strip_tags($_POST['PanelFromHuman']);

$DefenseLevel = strip_tags($_POST['DefenseLevel']);
$ShipCargo = strip_tags($_POST['ShipCargo']);
$ShipPanels = strip_tags($_POST['ShipPanels']);
$LowRocketCargo = strip_tags($_POST['LowRocketCargo']);
$LowRocketPanels = strip_tags($_POST['LowRocketPanels']);
$MidRocketCargo = strip_tags($_POST['MidRocketCargo']);
$MidRocketPanels = strip_tags($_POST['MidRocketPanels']);

$HighRocketCargo = strip_tags($_POST['HighRocketCargo']);
$HighRocketPanels = strip_tags($_POST['HighRocketPanels']);
$RobotsCarried = strip_tags($_POST['RobotsCarried']);
$HABEndScore = strip_tags($_POST['HABEndScore']);
$Comments = strip_tags($_POST['Comments']);
$TeamNumber = strip_tags($_POST['TeamNumber']);

$Competition = strip_tags($_POST['Competition']);
$_SESSION['cid'] = $Competition;
$MatchNumber = strip_tags($_POST['MatchNumber']);
$RobotStation = strip_tags($_POST['RobotStation']);
$ScoutName = strip_tags($_POST['ScoutName']);





$sql = "SELECT * FROM `matches` WHERE `TeamNumber` = '$TeamNumber' AND `MatchNumber` = '$MatchNumber' AND `Competition` = '$Competition'";

$search_result = mysqli_query($conn, $sql);
$exists = false;
while($row = mysqli_fetch_array($search_result)):
$exists = true;
endwhile;

if($exists) {
    $sql = "UPDATE `matches` SET `Date` = '$Date', `Time` = '$Time', `Username` = '$Username', `Updated` = '1', `HABSandstormScore`='$HABSandstormScore',`SandstormCargo`='$SandstormCargo',`SandstormPanels`='$SandstormPanels',`CargoFromFloor`='$CargoFromFloor',`CargoFromHuman`='$CargoFromHuman',`PanelFromFloor`='$PanelFromFloor',`PanelFromHuman`='$PanelFromHuman' ,`DefenseLevel`='$DefenseLevel',`ShipCargo`='$ShipCargo',`ShipPanels`='$ShipPanels',`LowRocketCargo`='$LowRocketCargo',`LowRocketPanels`='$LowRocketPanels',`MidRocketCargo`='$MidRocketCargo',`MidRocketPanels`='$MidRocketPanels',`HighRocketCargo`='$HighRocketCargo',`HighRocketPanels`='$HighRocketPanels',`RobotsCarried`='$RobotsCarried',`HABEndScore`='$HABEndScore', `Comments` = '$Comments', `ScoutName` = '$ScoutName' WHERE `TeamNumber` = '$TeamNumber' AND `MatchNumber` = '$MatchNumber'";
} else {
    $sql = "INSERT INTO `matches` (Date, Time, Username, Updated, HABSandstormScore, SandstormCargo, SandstormPanels, CargoFromFloor, CargoFromHuman, PanelFromFloor, PanelFromHuman, DefenseLevel, ShipCargo, ShipPanels, LowRocketCargo, LowRocketPanels, MidRocketCargo, MidRocketPanels, HighRocketCargo, HighRocketPanels, RobotsCarried, HABEndScore, Comments, TeamNumber, Competition, MatchNumber, RobotStation, ScoutName) VALUES ('$Date', '$Time', '$Username', '1', '$HABSandstormScore', '$SandstormCargo', '$SandstormPanels', '$CargoFromFloor', '$CargoFromHuman', '$PanelFromFloor', '$PanelFromHuman', '$DefenseLevel', '$ShipCargo', '$ShipPanels', '$LowRocketCargo', '$LowRocketPanels', '$MidRocketCargo', '$MidRocketPanels', '$HighRocketCargo', '$HighRocketPanels', '$RobotsCarried', '$HABEndScore', '$Comments', '$TeamNumber', '$Competition', '$MatchNumber', '$RobotStation', '$ScoutName')";
}

$query = mysqli_query($connect, $sql);

if ($conn->query($sql) === TRUE) {
    echo "Success!";
    ?>
   <script type="text/javascript">
	window.location.href = 'https://www.scouting.team7558.com/team.php?TeamNumber=<?php echo $TeamNumber; ?>';
	</script>
    <?php
}else{
	echo "Error: " . $sql . "<br>" . $conn->error;
}

?>

