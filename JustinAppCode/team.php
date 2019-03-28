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
?><script type="text/javascript">console.log(<?php echo $cid; ?>);</script><?php //This actually makes the upload work for some reason - leave it in
$TeamNumber = strip_tags($_GET['TeamNumber']);
$sql = "SELECT * FROM `pitdata` WHERE `TeamNumber` = '$TeamNumber' AND `Competition` = '$cid'";
$search_result = mysqli_query($connect, $sql);

$defCounter=0;
?>
<html>
<head>
<title>Profile for Team <?php echo $TeamNumber; ?> @ Competition <?php echo $cid; ?></title>
<link rel="stylesheet" type="text/css" href="css/databasestyle.css">

</head>
<h1 class="matchdataheader">Team: <?php echo $TeamNumber; ?> @ Competition ID: <?php echo $cid; ?></h1>
<h2>Comments: </h2>
<a href="https://www.scouting.team7558.com/matchhome.php?id=<?php echo $cid; ?>"><button id="gohome">Go Back to<br>Competition</button></a>

<div id="containertable">
<div id="containerrow">

<div id="teamphoto">
<h2>Team Photo: </h2>
<img src="/uploads/<?php echo $cid; ?>_<?php echo $TeamNumber; ?>.jpg" height="500" width="500" />
</div>

<div id="containerpitdata">
<h2>Pit Data</h2>
<table id="pitdatatable">
<?php $row = mysqli_fetch_array($search_result)?> 
<tr>
    <td>
    <span class="pitdatafield">Team Name</span>
    <span class="pitdatalong"><?php echo $row['TeamName']; ?></span>
    </td>
</tr>
<tr>
    <td>
    <span class="pitdatafieldbig">General Comments</span>
    <span class="pitdatabig"><?php echo $row['GeneralComments']; ?></span>
    </td>
</tr>
<tr>
    <td>
    <span class="pitdatafield">Drivetrain Type</span>
    <span class="pitdatalong"><?php echo $row['DrivetrainType']; ?></span>
    </td>
</tr>
<tr>
    <td>
    <span class="pitdatafield">Wheel Type</span>
    <span class="pitdatashort"><?php echo $row['WheelType']; ?></span>
    <span class="pitdatafield">Number of Drive Motors</span>
    <span class="pitdatashort"><?php echo $row['NumberDriveMotors']; ?></span>
    </td>
</tr>
<tr>
    <td>
    <span class="pitdatafield">HAB Start Level</span>
    <span class="pitdatalong"><?php echo $row['HABStart']; ?></span>
    </td>
</tr>
<tr>
    <td>
    <span class="pitdatafield">Sandstorm Movement</span>
    <span class="pitdatalong"><?php echo $row['SandstormMovement']; ?></span>
    </td>
</tr>
<tr>
    <td>
    <span class="pitdatafield"id="cargotable">Cargo in Sandstorm</span>
    <span class="pitdatashort"id="cargotable"><?php echo $row['CargoSandstorm']; ?></span>
    <span class="pitdatafield"id="paneltable">Panel in Sandstorm</span>
    <span class="pitdatashort"id="paneltable"><?php echo $row['PanelSandstorm']; ?></td>
    </td>
</tr>
<tr>
    <td>
    <span class="pitdatafield"id="cargotable">Cargo Intake Ground</span>
    <span class="pitdatashort"id="cargotable"><?php echo $row['IntakeCargoGround']; ?></span>
    <span class="pitdatafield"id="paneltable">Hatch Intake Ground</span>
    <span class="pitdatashort"id="paneltable"><?php echo $row['IntakeHatchGround']; ?></span>
    </td>
</tr>
<tr>
    <td>
    <span class="pitdatafield"id="cargotable">Cargo Intake Human</span>
    <span class="pitdatashort"id="cargotable"><?php echo $row['IntakeCargoHuman']; ?></span>
    <span class="pitdatafield"id="paneltable">Hatch Intake Human</span>
    <span class="pitdatashort"id="paneltable"><?php echo $row['IntakeHatchHuman']; ?></span>
    </td>
</tr>
<tr>
    <td>
    <span class="pitdatafield"id="cargotable">Cargo Scoring Ship</span>
    <span class="pitdatashort"id="cargotable"><?php echo $row['ScoreCargoShip']; ?></span>
    <span class="pitdatafield"id="paneltable">Hatch Scoring Ship</span>
    <span class="pitdatashort"id="paneltable"><?php echo $row['ScoreHatchShip']; ?></span>
    </td>
</tr>
<tr>
    <td>
    <span class="pitdatafield"id="cargotable">Cargo Scoring Low</span>
    <span class="pitdatashort"id="cargotable"><?php echo $row['ScoreCargoLow']; ?></span>
    <span class="pitdatafield"id="paneltable">Hatch Scoring Low</span>
    <span class="pitdatashort"id="paneltable"><?php echo $row['ScoreHatchLow']; ?></span>
    </td>
</tr>
<tr>
    <td>
    <span class="pitdatafield"id="cargotable">Cargo Scoring Mid</span>
    <span class="pitdatashort"id="cargotable"><?php echo $row['ScoreCargoMid']; ?></span>
    <span class="pitdatafield"id="paneltable">Hatch Scoring Mid</span>
    <span class="pitdatashort"id="paneltable"><?php echo $row['ScoreHatchMid']; ?></span>
    </td>
</tr>
<tr>
    <td>
    <span class="pitdatafield"id="cargotable">Cargo Scoring High</span>
    <span class="pitdatashort"id="cargotable"><?php echo $row['ScoreCargoHigh']; ?></span>
    <span class="pitdatafield"id="paneltable">Hatch Scoring High</span>
    <span class="pitdatashort"id="paneltable"><?php echo $row['ScoreHatchHigh']; ?></span>
    </td>
</tr>
<tr>
    <td>
    <span class="pitdatafield">HAB End Level</span>
    <span class="pitdatalong"><?php echo $row['HABEnd']; ?></span>
    </td>
</tr>
<tr>
    <td>
    <span class="pitdatafield">Robots Carried</span>
    <span class="pitdatalong"><?php echo $row['RobotsCarried']; ?></span>
    </td>
</tr>
<tr>
    <td>
    <span class="pitdatafield">Lift Type</span>
    <span class="pitdatalong"><?php echo $row['LiftType']; ?></span>
    </td>
</tr>
<tr>
    <td>
    <span class="pitdatafield">Is Rookie</span>
    <span class="pitdatalong"><?php echo $row['IsRookie']; ?></span>
    </td>
</tr>
<tr>
    <td>
    <span class="pitdatafield">Robot Weight Pounds</span>
    <span class="pitdatalong"><?php echo $row['RobotWeightPounds']; ?></span>
    </td>
</tr>
</table>
</div>

</div>
</div>


<?php

//$sortType = htmlspecialchars($_GET["sortType"]); // Should be a column name
//$sortOrder = htmlspecialchars($_GET["sortOrder"]); // Should be ASC or DSC
$sql = "SELECT * FROM `matches` WHERE `TeamNumber` = '$TeamNumber' AND `Competition` = '$cid' ORDER BY MatchNumber";
$search_result = mysqli_query($connect, $sql);

}

?>


</table>


<h2>Matches</h2>
<table class="matchdatatable">
<tr>
    <th>Match Number</th>
    <th><a href="https://www.scouting.team7558.com/matchhome.php?id=7&SortType=HABSandstormScore">HAB Start</a></th>
    <th><a href="https://www.scouting.team7558.com/matchhome.php?id=7&SortType=SandstormCargo">Sandstorm Cargo</a></th>
    <th><a href="https://www.scouting.team7558.com/matchhome.php?id=7&SortType=SandstormPanels">Sandstorm Panels</a></th>
    <th><a href="https://www.scouting.team7558.com/matchhome.php?id=7&SortType=CargoFromFloor">Cargo From Floor</a></th>
    <th><a href="https://www.scouting.team7558.com/matchhome.php?id=7&SortType=CargoFromHuman">Cargo From Human</a></th>
    <th><a href="https://www.scouting.team7558.com/matchhome.php?id=7&SortType=PanelFromFloor">Panel From Floor</a></th>
    <th><a href="https://www.scouting.team7558.com/matchhome.php?id=7&SortType=PanelFromHuman">Panel From Human</a></th>
    <th><a href="https://www.scouting.team7558.com/matchhome.php?id=7&SortType=DefenseLevel">Defense Level</a></th>
    <th><a href="https://www.scouting.team7558.com/matchhome.php?id=7&SortType=ShipPanels">Ship Panels</a></th>
    <th><a href="https://www.scouting.team7558.com/matchhome.php?id=7&SortType=ShipCargo">Ship Cargo</a></th>
    <th>Rocket Panels<br>(<a href="https://www.scouting.team7558.com/matchhome.php?id=7&SortType=HighRocketPanels">A</a>, <a href="https://www.scouting.team7558.com/matchhome.php?id=7&SortType=MidRocketPanels">B</a>, <a href="https://www.scouting.team7558.com/matchhome.php?id=7&SortType=LowRocketPanels">C</a>)</th>
    <th>Rocket Cargo<br>(<a href="https://www.scouting.team7558.com/matchhome.php?id=7&SortType=HighRocketCargo">A</a>, <a href="https://www.scouting.team7558.com/matchhome.php?id=7&SortType=MidRocketCargo">B</a>, <a href="https://www.scouting.team7558.com/matchhome.php?id=7&SortType=LowRocketCargo">C</a>)</th>
    <th><a href="https://www.scouting.team7558.com/matchhome.php?id=7&SortType=HABEndScore">HAB End</a></th>
    <th><a href="https://www.scouting.team7558.com/matchhome.php?id=7&SortType=RobotsCarried">Robots Carried</a></th>
    <th>Comments</th>
    <th>Scout Name</th>
    
  </tr>
<?php while($row = mysqli_fetch_array($search_result)):?>
  <tr>
    <td class="defenseitems<?php echo $row['ID'];?>"><a href="/match.php?MatchNumber=<?php echo $row['MatchNumber']; ?>"><?php echo $row['MatchNumber']; ?></a></td>
    <td class="habitems habitems<?php echo $row['ID'];?>"><?php echo $row['HABSandstormScore']; ?></td>
    <?php if($row['Updated']==1) $totalHABSandstormScore += $row['HABSandstormScore']; ?>
    
    <td class="cargoitems cargoitems<?php echo $row['ID'];?>"><?php echo $row['SandstormCargo']; ?></td>
    <?php if($row['Updated']==1) $totalSandstormCargo += $row['SandstormCargo']; ?>
    
    <td class="panelitems panelitems<?php echo $row['ID'];?>"><?php echo $row['SandstormPanels']; ?></td>
    <?php if($row['Updated']==1) $totalSandstormPanels += $row['SandstormPanels']; ?>
    
    <td class="cargoitems cargoitems<?php echo $row['ID'];?>"><?php echo $row['CargoFromFloor']; ?></td>
    <?php if($row['Updated']==1) $totalCargoFromFloor += $row['CargoFromFloor']; ?>
    
    <td class="cargoitems cargoitems<?php echo $row['ID'];?>"><?php echo $row['CargoFromHuman']; ?></td>
    <?php if($row['Updated']==1) $totalCargoFromHuman += $row['CargoFromHuman']; ?>
    
    <td class="panelitems panelitems<?php echo $row['ID'];?>"><?php echo $row['PanelFromFloor']; ?></td>
    <?php if($row['Updated']==1) $totalPanelFromFloor += $row['PanelFromFloor']; ?>
    
    <td class="panelitems panelitems<?php echo $row['ID'];?>"><?php echo $row['PanelFromHuman']; ?></td>
    <?php if($row['Updated']==1) $totalPanelFromHuman += $row['PanelFromHuman']; ?>
    
    <td class="defenseitems<?php echo $row['ID'];?>"><?php echo $row['DefenseLevel']; ?></td>
     <?php if($row['Updated']==1) {
        $totalDefenseLevel += $row['DefenseLevel'];
        if($row['DefenseLevel']>0) $defCounter++;
     }
    ?>
     
     
         
    <!--Adjust defense colours-->
    <script type="text/javascript">
        var defense = "<?php echo $row['DefenseLevel']?>";
        var x = document.getElementsByClassName("defenseitems<?php echo $row['ID'];?>");
        
        for(i = 0; i < x.length; i++) {
            if(defense >= 0.5 && defense < 1.5) x[i].style.backgroundColor = "#ff8770";
            else if(defense >= 1.5) x[i].style.backgroundColor = "#ed694b";
        }
    </script>
     
     
     
     
    <td class="panelitems panelitems<?php echo $row['ID'];?>"><?php echo $row['ShipPanels']; ?></td>
    <?php if($row['Updated']==1) $totalShipPanels += $row['ShipPanels']; ?>
    
    <td class="cargoitems cargoitems<?php echo $row['ID'];?>"><?php echo $row['ShipCargo']; ?></td>
    <?php if($row['Updated']==1) $totalShipCargo += $row['ShipCargo']; ?>
    
    <td class="panelitems panelitems<?php echo $row['ID'];?>">A<?php echo $row['HighRocketPanels']; ?><br>B<?php echo $row['MidRocketPanels']; ?><br>C<?php echo $row['LowRocketPanels']; ?></td>
    <?php if($row['Updated']==1) $totalHighRocketPanels += $row['HighRocketPanels']; ?>
    <?php if($row['Updated']==1) $totalMidRocketPanels += $row['MidRocketPanels']; ?>
    <?php if($row['Updated']==1) $totalLowRocketPanels += $row['LowRocketPanels']; ?>
    
    <td class="cargoitems cargoitems<?php echo $row['ID'];?>">A<?php echo $row['HighRocketCargo']; ?><br>B<?php echo $row['MidRocketCargo']; ?><br>C<?php echo $row['LowRocketCargo']; ?></td>
    <?php if($row['Updated']==1) $totalHighRocketCargo += $row['HighRocketCargo']; ?>
    <?php if($row['Updated']==1) $totalMidRocketCargo += $row['MidRocketCargo']; ?>
    <?php if($row['Updated']==1) $totalLowRocketCargo += $row['LowRocketCargo']; ?>
    
    <td class="habitems habitems<?php echo $row['ID'];?>"><?php echo $row['HABEndScore']; ?></td>
    <?php if($row['Updated']==1) $totalHABEndScore += $row['HABEndScore']; ?>
    
    <td class="habitems habitems<?php echo $row['ID'];?>"><?php echo $row['RobotsCarried']; ?></td>
    <?php if($row['Updated']==1) $totalRobotsCarried += $row['RobotsCarried']; ?>
    
    <td class="miscitems"><?php echo $row['Comments']; ?></td>
    <td class="miscitems"><?php echo $row['ScoutName']; ?></td>
    
    
    
    
    
    <!--Check if match has occurred yet-->
    <script type="text/javascript">
        var updated = "<?php echo $row['Updated']?>";
        var x = document.getElementsByClassName("defenseitems<?php echo $row['ID'];?>");
        var h = document.getElementsByClassName("habitems<?php echo $row['ID'];?>");
        var c = document.getElementsByClassName("cargoitems<?php echo $row['ID'];?>");
        var p = document.getElementsByClassName("panelitems<?php echo $row['ID'];?>");
        var m = document.getElementsByClassName("miscitems<?php echo $row['ID'];?>");
        
        if(updated=='0') {
        
            for(i = 0; i < x.length; i++) {
                x[i].style.backgroundColor = "white";
                x[i].style.fontStyle = "italic";
            }
            for(i = 0; i < h.length; i++) {
                h[i].style.backgroundColor = "white";
                h[i].style.fontStyle = "italic";
            }
            for(i = 0; i < c.length; i++) {
                c[i].style.backgroundColor = "white";
                c[i].style.fontStyle = "italic";
            }
            for(i = 0; i < p.length; i++) {
                p[i].style.backgroundColor = "white";
                p[i].style.fontStyle = "italic";
            }
            for(i = 0; i < m.length; i++) {
                m[i].style.backgroundColor = "white";
                m[i].style.fontStyle = "italic";
            }
            
            
        }
    </script>
    
  </tr>
	<?php if($row['Updated']==1) $counter++; ?>
<?php endwhile; ?>


</table>
</html>

<?php
$sql = "SELECT * FROM `matchTotals` WHERE `TeamNumber` = '$TeamNumber' AND `Competition` = '$cid'";

$search_result = mysqli_query($connect, $sql);
$exists = false;
while($row = mysqli_fetch_array($search_result)):
$exists = true;
endwhile;

if($exists){
$sql = "UPDATE `matchTotals` SET `HABSandstormScore`='$totalHABSandstormScore',`SandstormCargo`='$totalSandstormCargo',`SandstormPanels`='$totalSandstormPanels',`CargoFromFloor`='$totalCargoFromFloor',`CargoFromHuman`='$totalCargoFromHuman',`PanelFromFloor`='$totalPanelFromFloor',`PanelFromHuman`='$totalPanelFromHuman' ,`DefenseLevel`='$totalDefenseLevel',`ShipCargo`='$totalShipCargo',`ShipPanels`='$totalShipPanels',`LowRocketCargo`='$totalLowRocketCargo',`LowRocketPanels`='$totalLowRocketPanels',`MidRocketCargo`='$totalMidRocketCargo',`MidRocketPanels`='$totalMidRocketPanels',`HighRocketCargo`='$totalHighRocketCargo',`HighRocketPanels`='$totalHighRocketPanels',`RobotsCarried`='$totalRobotsCarried',`HabEndScore`='$totalHABEndScore' WHERE `TeamNumber` = '$TeamNumber' AND `Competition` = '$cid'";
}else{
    $sql = "INSERT INTO `matchTotals` (Competition, TeamNumber, HABSandstormScore, SandstormCargo, SandstormPanels, CargoFromFloor, CargoFromHuman, PanelFromFloor, PanelFromHuman, DefenseLevel, ShipCargo, ShipPanels, LowRocketCargo, LowRocketPanels, MidRocketCargo, MidRocketPanels, HighRocketCargo, HighRocketPanels, RobotsCarried, HabEndScore) VALUES ('$cid', '$TeamNumber', '$totalHABSandstormScore', '$totalSandstormCargo', '$totalSandstormPanels', '$totalCargoFromFloor', '$totalCargoFromHuman', '$totalPanelFromFloor', '$totalPanelFromHuman', '$totalDefenseLevel', '$totalShipCargo', '$totalShipPanels', '$totalLowRocketCargo', '$totalLowRocketPanels', '$totalMidRocketCargo', '$totalMidRocketPanels', '$totalHighRocketCargo', '$totalHighRocketPanels', '$totalRobotsCarried', '$totalHabEndScore')";
    
}
if ($connect->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}


$totalHABSandstormScore /= $counter;
$totalSandstormCargo /= $counter;
$totalSandstormPanels /= $counter;
$totalCargoFromFloor /= $counter;
$totalCargoFromHuman /= $counter;
$totalPanelFromFloor /= $counter;
$totalPanelFromHuman /= $counter;
$totalDefenseLevel /= $defCounter;
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
$sql = "UPDATE `matchAverages` SET `HABSandstormScore`='$totalHABSandstormScore',`SandstormCargo`='$totalSandstormCargo',`SandstormPanels`='$totalSandstormPanels',`CargoFromFloor`='$totalCargoFromFloor',`CargoFromHuman`='$totalCargoFromHuman',`PanelFromFloor`='$totalPanelFromFloor',`PanelFromHuman`='$totalPanelFromHuman' ,`DefenseLevel`='$totalDefenseLevel',`ShipCargo`='$totalShipCargo',`ShipPanels`='$totalShipPanels',`LowRocketCargo`='$totalLowRocketCargo',`LowRocketPanels`='$totalLowRocketPanels',`MidRocketCargo`='$totalMidRocketCargo',`MidRocketPanels`='$totalMidRocketPanels',`HighRocketCargo`='$totalHighRocketCargo',`HighRocketPanels`='$totalHighRocketPanels',`RobotsCarried`='$totalRobotsCarried',`HabEndScore`='$totalHABEndScore' WHERE `TeamNumber` = '$TeamNumber' AND `Competition` = '$cid'";
}else{
    $sql = "INSERT INTO `matchAverages` (Competition, TeamNumber, HABSandstormScore, SandstormCargo, SandstormPanels, CargoFromFloor, CargoFromHuman, PanelFromFloor, PanelFromHuman, DefenseLevel, ShipCargo, ShipPanels, LowRocketCargo, LowRocketPanels, MidRocketCargo, MidRocketPanels, HighRocketCargo, HighRocketPanels, RobotsCarried, HabEndScore) VALUES ('$cid', '$TeamNumber', '$totalHABSandstormScore', '$totalSandstormCargo', '$totalSandstormPanels', '$totalCargoFromFloor', '$totalCargoFromHuman', '$totalPanelFromFloor', '$totalPanelFromHuman', '$totalDefenseLevel', '$totalShipCargo', '$totalShipPanels', '$totalLowRocketCargo', '$totalLowRocketPanels', '$totalMidRocketCargo', '$totalMidRocketPanels', '$totalHighRocketCargo', '$totalHighRocketPanels', '$totalRobotsCarried', '$totalHabEndScore')";
    
}

if ($connect->query($sql) === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
?>