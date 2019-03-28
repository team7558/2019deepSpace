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
$GeneralComments = strip_tags($_POST['GeneralComments']);

$DrivetrainType = strip_tags($_POST['DrivetrainType']);
$WheelType = strip_tags($_POST['WheelType']);
$NumberDriveMotors = strip_tags($_POST['NumberDriveMotors']);

$HABStart = strip_tags($_POST['HABStart']);
$SandstormMovement = strip_tags($_POST['SandstormMovement']);
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
  
  if($file_size > 8388608) {
     $errors[]='File size must be under 8 MB';
  }
  
  if(empty($errors)==true) {
    
     $upload_name = $Username.'_'.$Competition.'_'.$TeamNumber.'.jpg';
     move_uploaded_file($file_tmp,"uploads/".$upload_name);
     $image = "uploads/"+$upload_name;
     ?><script type="text/javascript">alert('Successful Upload to Competition <?php echo $Competition; ?>!');</script><?php
  }else{
     print_r($errors);
     $image = "error";
     ?><script type="text/javascript">alert('Upload failed! Image too big or not .jpg! You should try uploading JUST the image again!');</script><?php
  }
} else {
    ?><script type="text/javascript">alert('Upload failed!');</script><?php
}



$sql = "SELECT * FROM `pitdata` WHERE `TeamNumber` = '$TeamNumber' AND `Competition` = '$cid'";

$search_result = mysqli_query($connect, $sql);
$exists = false;
while($row = mysqli_fetch_array($search_result)):
$exists = true;
endwhile;

if($exists){
    $sql = "UPDATE `pitdata` SET `Date` = '$Date', `Time` = '$Time', `Username` = '$Username', `TeamName` = '$TeamName', `TeamNumber` = '$TeamNumber', `GeneralComments` = '$GeneralComments', `DrivetrainType` = '$DrivetrainType', `WheelType` = '$WheelType', `NumberDriveMotors` = '$NumberDriveMotors', `HABStart` = '$HABStart', `SandstormMovement` = '$SandstormMovement', `CargoSandstorm` = '$CargoSandstorm', `PanelSandstorm` = '$PanelSandstorm', `IntakeHatchGround` = '$IntakeHatchGround', `IntakeHatchHuman` = '$IntakeHatchHuman', `ScoreHatchShip` = '$ScoreHatchShip', `ScoreHatchLow` = '$ScoreHatchLow', `ScoreHatchMid` = '$ScoreHatchMid', `ScoreHatchHigh` = '$ScoreHatchHigh', `IntakeCargoGround` = '$IntakeCargoGround', `IntakeCargoHuman` = '$IntakeCargoHuman', `ScoreCargoShip` = '$ScoreCargoShip', `ScoreCargoLow` = '$ScoreCargoLow', `ScoreCargoMid` = '$ScoreCargoMid', `ScoreCargoHigh` = '$ScoreCargoHigh', `HABEnd` = '$HABEnd', `RobotsCarried` = '$RobotsCarried', `LiftType` = '$LiftType', `IsRookie` = '$IsRookie', `RobotWeightPounds` = '$RobotWeightPounds', `image` = '$image'";
}else{
    
$sql = "INSERT INTO pitdata (Date, Time, Username, TeamName, TeamNumber, GeneralComments, DrivetrainType, WheelType, NumberDriveMotors, HABStart, SandstormMovement, CargoSandstorm, PanelSandstorm, IntakeHatchGround, IntakeHatchHuman, ScoreHatchShip, ScoreHatchLow, ScoreHatchMid, ScoreHatchHigh, IntakeCargoGround, IntakeCargoHuman, ScoreCargoShip, ScoreCargoLow, ScoreCargoMid, ScoreCargoHigh, HABEnd, RobotsCarried, LiftType, IsRookie, RobotWeightPounds, Competition, image) VALUES ('$Date', '$Time', '$Username', '$TeamName', '$TeamNumber', '$GeneralComments', '$DrivetrainType', '$WheelType', '$NumberDriveMotors', '$HABStart', '$SandstormMovement', '$CargoSandstorm', '$PanelSandstorm', '$IntakeHatchGround', '$IntakeHatchHuman', '$ScoreHatchShip', '$ScoreHatchLow', '$ScoreHatchMid', '$ScoreHatchHigh', '$IntakeCargoGround', '$IntakeCargoHuman', '$ScoreCargoShip', '$ScoreCargoLow', '$ScoreCargoMid', '$ScoreCargoHigh', '$HABEnd', '$RobotsCarried', '$LiftType', '$IsRookie', '$RobotWeightPounds', '$Competition', '$image')";
}
$query = mysqli_query($connect, $sql);

if ($conn->query($sql) === TRUE) {
    $_SESSION['cid'] = $Competition;
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

