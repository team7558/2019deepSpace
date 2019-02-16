<?php 
$db_HOST = "localhost";
$db_USER = "jslighth_1";
$db_PASS = "1234";
$db_NAME = "jslighth_frctest";
error_reporting(E_ERROR | E_PARSE);
session_start();

$conn = new mysqli($db_HOST, $db_USER, $db_PASS, $db_NAME);

$Date = date("Y/m/d");
$Time = date("h:i:sa");
$MatchNumber = strip_tags($_POST['MatchNumber']);
$TeamNumber = strip_tags($_POST['TeamNumber']);
$TopRocketCloseLevel1 = strip_tags($_POST['TopRocketCloseLevel1']);
$TopRocketFarLevel1 = strip_tags($_POST['TopRocketFarLevel1']);
$TopRocketClosetLevel2 = strip_tags($_POST['TopRocketClosetLevel2']);
$TopRocketFarLevel2 = strip_tags($_POST['TopRocketFarLevel2']);
$TopRocketCloseLevel3 = strip_tags($_POST['TopRocketCloseLevel3']);
$TopRocketFarLeve31 = strip_tags($_POST['TopRocketFarLeve31']);
$BottomRocketCloseLevel1 = strip_tags($_POST['BottomRocketCloseLevel1']);
$BottomRocketFarLevel1 = strip_tags($_POST['BottomRocketFarLevel1']);
$BottomRocketCloseLevel2 = strip_tags($_POST['BottomRocketCloseLevel2']);
$BottomRocketFarLevel2 = strip_tags($_POST['BottomRocketFarLevel2']);
$BottomRocketCloseLevel3 = strip_tags($_POST['BottomRocketCloseLevel3']);
$BottomRocketFarLevel3 = strip_tags($_POST['BottomRocketFarLevel3']);
$ShipFrontUpper = strip_tags($_POST['ShipFrontUpper']);
$ShipFrontLower = strip_tags($_POST['ShipFrontLower']);
$ShipTopClose = strip_tags($_POST['ShipTopClose']);
$ShipBottomClose = strip_tags($_POST['ShipBottomClose']);
$ShipTopMedium = strip_tags($_POST['ShipTopMedium']);
$ShipBottomMedium = strip_tags($_POST['ShipBottomMedium']);
$ShipTopFar = strip_tags($_POST['ShipTopFar']);
$ShipBottomFar = strip_tags($_POST['ShipBottomFar']);
$HABPositionPreload = strip_tags($_POST['HABPositionPreload']);
$HABPositionStart = strip_tags($_POST['HABPositionStart']);
$HABPositionEnd = strip_tags($_POST['HABPositionEnd']);
$CargoGrabbedFromHuman = strip_tags($_POST['CargoGrabbedFromHuman']);
$CargoGrabbedFromFloor = strip_tags($_POST['CargoGrabbedFromFloor']);
$PanelGrabbedFromHuman = strip_tags($_POST['PanelGrabbedFromHuman']);
$PanelGrabbedFromFloor = strip_tags($_POST['PanelGrabbedFromFloor']);
$RobotPreloadedItem = strip_tags($_POST['RobotPreloadedItem']);
$DefenseLevel = strip_tags($_POST['DefenseLevel']);
$RobotsCarriedAtEnd = strip_tags($_POST['RobotsCarriedAtEnd']);
$WasCarriedAtEnd = strip_tags($_POST['WasCarriedAtEnd']);
$RobotStation = strip_tags($_POST['RobotStation']);
$Competition = strip_tags($_POST['Competition']);

$sql = "INSERT INTO matches (MatchNumber, TeamNumber, TopRocketCloseLevel1, TopRocketFarLevel1, TopRocketClosetLevel2, TopRocketFarLevel2, TopRocketCloseLevel3, TopRocketFarLeve31, BottomRocketCloseLevel1, BottomRocketFarLevel1, BottomRocketCloseLevel2, BottomRocketFarLevel2, BottomRocketCloseLevel3, BottomRocketFarLevel3, ShipFrontUpper, ShipFrontLower, ShipTopClose, ShipBottomClose, ShipTopMedium, ShipBottomMedium, ShipTopFar, ShipBottomFar, HABPositionPreload, HABPositionStart, HABPositionEnd, CargoGrabbedFromHuman, CargoGrabbedFromFloor, PanelGrabbedFromHuman, PanelGrabbedFromFloor, RobotPreloadedItem, DefenseLevel, RobotsCarriedAtEnd, WasCarriedAtEnd, RobotStation, Competition) VALUES ('$MatchNumber', '$TeamNumber', '$TopRocketCloseLevel1', '$TopRocketFarLevel1', '$TopRocketClosetLevel2', '$TopRocketFarLevel2', '
$TopRocketCloseLevel3', '$TopRocketFarLeve31', '$BottomRocketCloseLevel1', '$BottomRocketFarLevel1', '$BottomRocketCloseLevel2', '$BottomRocketFarLevel2', '$BottomRocketCloseLevel3', '$BottomRocketFarLevel3', '$ShipFrontUpper', '$ShipFrontLower', '$ShipTopClose', '$ShipBottomClose', '$ShipTopMedium', '$ShipBottomMedium', '$ShipTopFar', '$ShipBottomFar', '$HABPositionPreload', '$HABPositionStart', '$HABPositionEnd', '$CargoGrabbedFromHuman', '$CargoGrabbedFromFloor', '$PanelGrabbedFromHuman', '$PanelGrabbedFromFloor', '$RobotPreloadedItem', '$DefenseLevel', '$RobotsCarriedAtEnd', '$WasCarriedAtEnd', '$RobotStation', '$Competition')";

$query = mysqli_query($connect, $sql);

if ($conn->query($sql) === TRUE) {
    echo "Success!";
}else{
	echo "Error: " . $sql . "<br>" . $conn->error;
}

?>

