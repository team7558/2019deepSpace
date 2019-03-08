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



if(isset($_FILES['image'])){

 
  $errors= array();
  $file_name = $_FILES['image']['name'];
  $file_name_new = "".htmlspecialchars($_POST["TeamNumber"])."_".($_GET["id"]).".jpg"; 
  $file_size = $_FILES['image']['size'];
  $file_tmp = $_FILES['image']['tmp_name'];
  $file_type = $_FILES['image']['type'];
  $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
  
  $expensions= array("jpg");
  
  
  if(in_array($file_ext,$expensions)=== false){
     $errors[]="Please only upload .JPG files.";
  }
  
  if($file_size > 2097152) {
     $errors[]='File size must be under 2 MB';
  }
  
  if(empty($errors)==true) {
    
     $upload_name = $TeamNumber.'_'.$Competition.'.jpg';
     move_uploaded_file($file_tmp,"uploads/".$upload_name);
     $image = "uploads/"+$upload_name;
  }else{
     print_r($errors);
     $image = "error";
  }
} else {
?><script type="text/javascript">alert('error');</script><?php
}



$sql = "SELECT * FROM `pitdata` WHERE `TeamNumber` = '$TeamNumber' AND `Competition` = '$cid'";

$search_result = mysqli_query($connect, $sql);
$exists = false;
while($row = mysqli_fetch_array($search_result)):
$exists = true;
endwhile;

if($exists){
    $sql = "UPDATE `pitdata` SET `Date` = '$Date', `Time` = '$Time', `Username` = '$Username', `TeamName` = '$TeamName', `TeamNumber` = '$TeamNumber', `DrivetrainType` = '$DrivetrainType', `NumberWheels` = '$NumberWheels', `NumberMotors` = '$NumberMotors', `HABStart` = '$HABStart', `CargoSandstorm` = '$CargoSandstorm', `PanelSandstorm` = '$PanelSandstorm', `IntakeHatchGround` = '$IntakeHatchGround', `IntakeHatchHuman` = '$IntakeHatchHuman', `ScoreHatchShip` = '$ScoreHatchShip', `ScoreHatchLow` = '$ScoreHatchLow', `ScoreHatchMid` = '$ScoreHatchMid', `ScoreHatchHigh` = '$ScoreHatchHigh', `IntakeCargoGround` = '$IntakeCargoGround', `IntakeCargoHuman` = '$IntakeCargoHuman', `ScoreCargoShip` = '$ScoreCargoShip', `ScoreCargoLow` = '$ScoreCargoLow', `ScoreCargoMid` = '$ScoreCargoMid', `ScoreCargoHigh` = '$ScoreCargoHigh', `HABEnd` = '$HABEnd', `RobotsCarried` = '$RobotsCarried', `LiftType` = '$LiftType', `IsRookie` = '$IsRookie', `CycleTimeSeconds` = '$CycleTimeSeconds', `RobotWeightPounds` = '$RobotWeightPounds', `image` = '$image'";
}else{
    
$sql = "INSERT INTO pitdata (Date, Time, Username, TeamName, TeamNumber, DrivetrainType, NumberWheels, NumberMotors, HABStart, CargoSandstorm, PanelSandstorm, IntakeHatchGround, IntakeHatchHuman, ScoreHatchShip, ScoreHatchLow, ScoreHatchMid, ScoreHatchHigh, IntakeCargoGround, IntakeCargoHuman, ScoreCargoShip, ScoreCargoLow, ScoreCargoMid, ScoreCargoHigh, HABEnd, RobotsCarried, LiftType, IsRookie, CycleTimeSeconds, RobotWeightPounds, Competition, image) VALUES ('$Date', '$Time', '$Username', '$TeamName', '$TeamNumber', '$DrivetrainType', '$NumberWheels', '$NumberMotors', '$HABStart', '$CargoSandstorm', '$PanelSandstorm', '$IntakeHatchGround', '$IntakeHatchHuman', '$ScoreHatchShip', '$ScoreHatchLow', '$ScoreHatchMid', '$ScoreHatchHigh', '$IntakeCargoGround', '$IntakeCargoHuman', '$ScoreCargoShip', '$ScoreCargoLow', '$ScoreCargoMid', '$ScoreCargoHigh', '$HABEnd', '$RobotsCarried', '$LiftType', '$IsRookie', '$CycleTimeSeconds', '$RobotWeightPounds', '$Competition', '$image')";
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

