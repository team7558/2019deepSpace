<?php 
requires(db.php);
error_reporting(E_ERROR | E_PARSE);
session_start();
$conn = new mysqli($db_HOST, $db_USER, $db_PASS, $db_NAME);
$date = date("Y/m/d");
$time = date("h:i:sa");
$matchNumber = strip_tags($_POST['matchNumber']);
$teamNumber = strip_tags($_POST['teamNumber']);

$sql = "INSERT INTO matches (Date, Time, MatchNumber, TeamNumber) VALUES ($date, $time, $matchNumber, $teamNumber)";

$query = mysqli_query($connect, $sql);

if ($conn->query($sql) === TRUE) {
    echo "AD Posted";
}else{
	echo "Error: " . $sql . "<br>" . $conn->error;
}

?>

