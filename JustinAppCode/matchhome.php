<?php
session_start();
	$cid = $_GET['id'];
	$sortType = $_GET['SortType'];
	$query = "SELECT * FROM `competitions` WHERE `id` = '$cid'";
	$belongsToUser = false;
	$_SESSION['cid'] = $cid;
	$search_result = filterTable($query);
	while($row = mysqli_fetch_array($search_result)):
		if($row['Username'] == $_SESSION['username']){
			$belongsToUser = true;	
		}
	endwhile;
	if((isset($_SESSION['username']) && $belongsToUser)){
	$user = $_SESSION['username'];
	
	if(isset($_GET['SortType'])){
	    if($sortType == "TeamNumber") $query = "SELECT * FROM `matchAverages` WHERE `competition` = '$cid' ORDER BY $sortType ASC";
	    
	    else $query = "SELECT * FROM `matchAverages` WHERE `competition` = '$cid' ORDER BY $sortType DESC";
	    
	}else{
        $query = "SELECT * FROM `matchAverages` WHERE `competition` = '$cid' ORDER BY TeamNumber";
	}
    $search_result = filterTable($query);
	
	}else{
	?>
   <script type="text/javascript">
	window.location.href = 'https://www.scouting.team7558.com';
	</script>
    <?php
}
	function filterTable($query)
	{
    	$connect = mysqli_connect("localhost", "team7558_s", "Mr.Roboto11235", "team7558_scouting");
    	$filter_Result = mysqli_query($connect, $query);
   		return $filter_Result;
	}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="css/databasestyle.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Match Averages @  Competition <?php echo $cid; ?></title>
</head>

<button id="findmatchbutton" onclick="if(document.getElementById('inputmatchnumber').value > 0) window.location.href = 'https://www.scouting.team7558.com/match.php?MatchNumber='+document.getElementById('inputmatchnumber').value;"><span id="findmatch">Find Match<input type="number" id="inputmatchnumber" min=0 max=200 value=0></span></button>

<a href="https://www.scouting.team7558.com/scoutinghome.php"><button id="gohome">Go Home</button></a>

<body>
<h1 class="matchdataheader">Match Averages @ Competition ID: <?php echo $cid; ?></h1>
<table class="matchdatatable">
<tr>
    <th><a href="/matchhome.php?id=<?php echo $cid ?>&SortType=TeamNumber">Team Number</a></th>
    <th><a href="/matchhome.php?id=<?php echo $cid ?>&SortType=HABSandstormScore">HAB Start</a></th>
    <th><a href="/matchhome.php?id=<?php echo $cid ?>&SortType=SandstormCargo">Sandstorm Cargo</a></th>
    <th><a href="/matchhome.php?id=<?php echo $cid ?>&SortType=SandstormPanels">Sandstorm Panels</a></th>
    <th><a href="/matchhome.php?id=<?php echo $cid ?>&SortType=CargoFromFloor">Cargo From Floor</a></th>
    <th><a href="/matchhome.php?id=<?php echo $cid ?>&SortType=CargoFromHuman">Cargo From Human</a></th>
    <th><a href="/matchhome.php?id=<?php echo $cid ?>&SortType=PanelFromFloor">Panel From Floor</a></th>
    <th><a href="/matchhome.php?id=<?php echo $cid ?>&SortType=PanelFromHuman">Panel From Human</a></th>
    <th><a href="/matchhome.php?id=<?php echo $cid ?>&SortType=DefenseLevel">DefenseLevel</a></th>
    <th><a href="/matchhome.php?id=<?php echo $cid ?>&SortType=ShipPanels">Ship Panels</a></th>
    <th><a href="/matchhome.php?id=<?php echo $cid ?>&SortType=ShipCargo">Ship Cargo</a></th>
    <th>Rocket Panels<br></b>(<a href="/matchhome.php?id=<?php echo $cid ?>&SortType=HighRocketPanels">A</a>, <a href="/matchhome.php?id=<?php echo $cid ?>&SortType=MidRocketPanels">B</a>, <a href="/matchhome.php?id=<?php echo $cid ?>&SortType=LowRocketPanels">C</a>)</th>
    <th>Rocket Cargo<br>(<a href="/matchhome.php?id=<?php echo $cid ?>&SortType=HighRocketCargo">A</a>, <a href="/matchhome.php?id=<?php echo $cid ?>&SortType=MidRocketCargo">B</a>, <a href="/matchhome.php?id=<?php echo $cid ?>&SortType=LowRocketCargo">C</a>)</th>
    <th><a href="/matchhome.php?id=<?php echo $cid ?>&SortType=HABEndScore">HAB End</a></th>
    <th><a href="/matchhome.php?id=<?php echo $cid ?>&SortType=RobotsCarried">Robots Carried</a></th>
  </tr>
<?php while($row = mysqli_fetch_array($search_result)):?>
  <tr>
    <td class="defenseitems<?php echo $row['ID'];?>"><a href="/team.php?TeamNumber=<?php echo $row['TeamNumber']; ?>"><?php echo $row['TeamNumber']; ?> </a></td>
    <td class="habitems"><?php echo number_format($row['HABSandstormScore'],2); ?></td>
    <td class="cargoitems"><?php echo number_format($row['SandstormCargo'],2); ?></td>
    <td class="panelitems"><?php echo number_format($row['SandstormPanels'],2); ?></td>
    <td class="cargoitems"><?php echo number_format($row['CargoFromFloor'],2); ?></td>
    <td class="cargoitems"><?php echo number_format($row['CargoFromHuman'],2); ?></td>
    <td class="panelitems"><?php echo number_format($row['PanelFromFloor'],2); ?></td>
    <td class="panelitems"><?php echo number_format($row['PanelFromHuman'],2); ?></td>
    <td class="defenseitems<?php echo $row['ID'];?>"><?php echo number_format($row['DefenseLevel'],2); ?></td>
    
    <!--Adjust defense colours-->
    <script type="text/javascript">
        var defense = "<?php echo $row['DefenseLevel']?>";
        var x = document.getElementsByClassName("defenseitems<?php echo $row['ID'];?>");
        
        for(i = 0; i < x.length; i++) {
            if(defense >= 1.25 && defense < 1.75) x[i].style.backgroundColor = "#ff8770";
            else if(defense >= 1.75) x[i].style.backgroundColor = "#ed694b";
        }
    </script>
    
    
    
    
    <td class="panelitems"><?php echo number_format($row['ShipPanels'],2); ?></td>
    <td class="cargoitems"><?php echo number_format($row['ShipCargo'],2); ?></td>
    <td class="panelitems">A <?php echo number_format($row['HighRocketPanels'],2); ?><br>B <?php echo number_format($row['MidRocketPanels'],2); ?><br>C <?php echo number_format($row['LowRocketPanels'],2); ?></td>
    <td class="cargoitems">A <?php echo number_format($row['HighRocketCargo'],2); ?><br>B <?php echo number_format($row['MidRocketCargo'],2); ?><br>C <?php echo number_format($row['LowRocketCargo'],2); ?></td>
    <td class="habitems"><?php echo number_format($row['HABEndScore'],2); ?></td>
    <td class="habitems"><?php echo number_format($row['RobotsCarried'],2); ?></td>
  </tr>

<?php endwhile; ?>
</table>

</body>
</html>