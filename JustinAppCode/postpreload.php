<?php 
$db_HOST = "localhost";
$db_USER = "team7558_s";
$db_PASS = "Mr.Roboto11235";
$db_NAME = "team7558_scouting";
error_reporting(E_ERROR | E_PARSE);
session_start();

$conn = new mysqli($db_HOST, $db_USER, $db_PASS, $db_NAME);

$QualsNumber = strip_tags($_POST['QualsNumber']);
$QualsList = strip_tags($_POST['QualsList']);
$Username = strip_tags($_POST['Username']);
$Competition = strip_tags($_POST['Competition']);
$_SESSION['cid'] = $Competition;

$qualCount = 1;
$sep = "~~~";
$lines = explode("~~~",$QualsList);

$teamList = "";
$teamCount = 0;



for($x=1;$x<$QualsNumber*2;$x+=2) {
    if($lines[$x]!==null) {
        //Working with the line that has all the teams
        $i = 0;
        
        $l = $lines[$x];
        $team = strtok($l,"\t");
        for($i = 0; $i<6; $i++) {
            $stat = "R1";
            if($i==1) $stat = "R2";
            if($i==2) $stat = "R3";
            if($i==3) $stat = "B1";
            if($i==4) $stat = "B2";
            if($i==5) $stat = "B3";
            
            
            
            //Create an empty match with given Competition, MatchNumber, TeamNumber, and Station
            $sql = "SELECT * FROM `matches` WHERE `TeamNumber` = '$team' AND `MatchNumber` = '$qualCount' AND `Competition` = '$Competition'";
            $search_result = mysqli_query($conn, $sql);
            $exists = false;
            while($row = mysqli_fetch_array($search_result)):
            $exists = true;
            endwhile;
                        
            
            if(!$exists) {
                $sql = "INSERT INTO `matches` (Date, Time, Username, Updated, HABSandstormScore, SandstormCargo, SandstormPanels, CargoFromFloor, CargoFromHuman, PanelFromFloor, PanelFromHuman, DefenseLevel, ShipCargo, ShipPanels, LowRocketCargo, LowRocketPanels, MidRocketCargo, MidRocketPanels, HighRocketCargo, HighRocketPanels, RobotsCarried, HABEndScore, Comments, TeamNumber, Competition, MatchNumber, RobotStation, ScoutName) VALUES ('', '', '$Username', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '', '$team', '$Competition', '$qualCount', '$stat', '')";
            }
            
            
            $query = mysqli_query($connect, $sql);
            
            if ($conn->query($sql) === TRUE) {
               echo "Success for ".$team." at match ".$qualCount.".\r\n";
            }else{
            	echo "Error for ".$team." at match ".$qualCount.".\r\n";
            }
            
            
            /*/Add names to teamList
            $pos = strpos($teamList, "".$team);
            if($pos==false) { 
                $teamList = $teamList." ".$team;
                $teamCount++;
            }*/
            
            
            //Create an empty match total and match average
            $sql = "SELECT * FROM `matchTotals` WHERE `TeamNumber` = '$team' AND `Competition` = '$Competition'";
            $search_result = mysqli_query($conn, $sql);
            $exists = false;
            while($row = mysqli_fetch_array($search_result)):
            $exists = true;
            endwhile;
            
            if(!$exists) {
                $sql = "INSERT INTO `matchTotals` (Competition, TeamNumber, HABSandstormScore, SandstormCargo, SandstormPanels, CargoFromFloor, CargoFromHuman, PanelFromFloor, PanelFromHuman, DefenseLevel, ShipCargo, ShipPanels, LowRocketCargo, LowRocketPanels, MidRocketCargo, MidRocketPanels, HighRocketCargo, HighRocketPanels, RobotsCarried, HabEndScore) VALUES ('$Competition', '$team', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0')";
            }
            
            $query = mysqli_query($connect, $sql);
            
            if ($conn->query($sql) === TRUE) {
               echo "Success for match total of ".$team."\r\n";
            }else{
            	echo "Error for match total of ".$team."\r\n";
            }
            
            
            
            
            
            $sql = "SELECT * FROM `matchAverages` WHERE `TeamNumber` = '$team' AND `Competition` = '$Competition'";
            $search_result = mysqli_query($conn, $sql);
            $exists = false;
            while($row = mysqli_fetch_array($search_result)):
            $exists = true;
            endwhile;
            
            if(!$exists) {
                $sql = "INSERT INTO `matchAverages` (Competition, TeamNumber, HABSandstormScore, SandstormCargo, SandstormPanels, CargoFromFloor, CargoFromHuman, PanelFromFloor, PanelFromHuman, DefenseLevel, ShipCargo, ShipPanels, LowRocketCargo, LowRocketPanels, MidRocketCargo, MidRocketPanels, HighRocketCargo, HighRocketPanels, RobotsCarried, HabEndScore) VALUES ('$Competition', '$team', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0')";
            }
            
            $query = mysqli_query($connect, $sql);
            
            if ($conn->query($sql) === TRUE) {
               echo "Success for match average of ".$team."\r\n";
            }else{
            	echo "Error for match average of ".$team."\r\n";
            }
            
            
            
            $team = strtok("\t");
        }
    } else {
        ?><script type="text/javascript">alert("Encountered an error while trying to input teams for Qualification Match <?php echo $qualCount; ?>;. Please locate the error and resubmit the entire qualification match list.");</script><?php
        break;
    }
    $qualCount++;

}


/*/Match averages
$text = "";
$team = strtok($teamList, " ");
for($y=0; $y < $teamCount; $y++) {
    $sql = "SELECT * FROM `matchTotals` WHERE `TeamNumber` = '$team' AND `Competition` = '$Competition'";
    $search_result = mysqli_query($conn, $sql);
    $exists = false;
    while($row = mysqli_fetch_array($search_result)):
    $exists = true;
    endwhile;
    
    if(!$exists) {
        $sql = "INSERT INTO `matchTotals` (Competition, TeamNumber, HABSandstormScore, SandstormCargo, SandstormPanels, CargoFromFloor, CargoFromHuman, PanelFromFloor, PanelFromHuman, DefenseLevel, ShipCargo, ShipPanels, LowRocketCargo, LowRocketPanels, MidRocketCargo, MidRocketPanels, HighRocketCargo, HighRocketPanels, RobotsCarried, HabEndScore) VALUES ('$cid', '$team', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0')";
            ?><script type="text/javascript">alert("Match Total for <?php echo $team; ?>");</script><?php
    }
    
    $query = mysqli_query($connect, $sql);
    
    if ($conn->query($sql) === TRUE) {
       echo "Success for match total of ".$team."\r\n";
    }else{
    	echo "Error for match total of ".$team."\r\n";
    }
        
        
    $team = strtok(" ");
}
*/


?>
<script type="text/javascript">
window.location.href = 'https://www.scouting.team7558.com/scoutinghome.php';
</script>
<?php

?>

