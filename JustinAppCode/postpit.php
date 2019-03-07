<?php 
$db_HOST = "localhost";
$db_USER = "team7558_s";
$db_PASS = "Mr.Roboto11235";
$db_NAME = "team7558_scouting";
error_reporting(E_ERROR | E_PARSE);
session_start();

$conn = new mysqli($db_HOST, $db_USER, $db_PASS, $db_NAME);

$Date = date("Y/m/d");
$Time = date("h:i:sa");
$Username = strip_tags($_POST['Username']);
$TeamName = strip_tags($_POST['TeamName']);
$TeamNumber = strip_tags($_POST['TeamNumber']);

$DrivetrainType = strip_tags($_POST['DrivetrainType']);
$NumberWheels = strip_tags($_POST['NumberWheels']);
$NumberMotors = strip_tags($_POST['NumberMotors']);

$HABStart = strip_tags($_POST['HABStart']);
$CargoSandstorm = strip_tags($_POST['CargoSandstorm']);
$PanelSandstorm = strip_tags($_POST['PanelSandstorm']);

$IntakeHatchGround = strip_tags($_POST['IntakeHatchGround']);
$IntakeHatchHuman = strip_tags($_POST['IntakeHatchHuman']);
$ScoreHatchShip = strip_tags($_POST['ScoreHatchShip']);
$ScoreHatchLow = strip_tags($_POST['ScoreHatchLow']);
$ScoreHatchMid = strip_tags($_POST['ScoreHatchMid']);
$ScoreHatchHigh = strip_tags($_POST['ScoreHatchHigh']);

$IntakeCargoGround = strip_tags($_POST['IntakeCargoGround']);
$IntakeCargoHuman = strip_tags($_POST['IntakeCargoHuman']);
$ScoreCargoShip = strip_tags($_POST['ScoreCargoShip']);
$ScoreCargoLow = strip_tags($_POST['ScoreCargoLow']);
$ScoreCargoMid = strip_tags($_POST['ScoreCargoMid']);
$ScoreCargoHigh = strip_tags($_POST['ScoreCargoHigh']);

$HABEnd = strip_tags($_POST['HABEnd']);
$RobotsCarried = strip_tags($_POST['RobotsCarried']);
$LiftType = strip_tags($_POST['LiftType']);
$IsRookie = strip_tags($_POST['IsRookie']);
$CycleTimeSeconds = strip_tags($_POST['CycleTimeSeconds']);
$RobotWeightPounds = strip_tags($_POST['RobotWeightPounds']);


$Competition = strip_tags($_POST['Competition']);
$_SESSION['cid'] = $Competition;


$sql = "INSERT INTO pitdata (Date, Time, Username, TeamName, TeamNumber, DrivetrainType, NumberWheels, NumberMotors, HABStart, CargoSandstorm, PanelSandstorm, IntakeHatchGround, IntakeHatchHuman, ScoreHatchShip, ScoreHatchLow, ScoreHatchMid, ScoreHatchHigh, IntakeCargoGround, IntakeCargoHuman, ScoreCargoShip, ScoreCargoLow, ScoreCargoMid, ScoreCargoHigh, HABEnd, RobotsCarried, LiftType, IsRookie, CycleTimeSeconds, RobotWeightPounds) VALUES ('$Date', '$Time', '$Username', '$TeamName', '$TeamNumber', '$DrivetrainType', '$NumberWheels', '$NumberMotors', '$HABStart', '$CargoSandstorm', '$PanelSandstorm', '$IntakeHatchGround', '$IntakeHatchHuman', '$ScoreHatchShip', '$ScoreHatchLow', '$ScoreHatchMid', '$ScoreHatchHigh', '$IntakeCargoGround', '$IntakeCargoHuman', '$ScoreCargoShip', '$ScoreCargoLow', '$ScoreCargoMid', '$ScoreCargoHigh', '$HABEnd', '$RobotsCarried', '$LiftType', '$IsRookie', '$CycleTimeSeconds', '$RobotWeightPounds')";

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

