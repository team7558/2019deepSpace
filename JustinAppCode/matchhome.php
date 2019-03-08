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
	    $query = "SELECT * FROM `matchAverages` WHERE `competition` = '$cid' ORDER BY $sortType DESC";
	    
	}else{
        $query = "SELECT * FROM `matchAverages` WHERE `competition` = '$cid'";
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
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

<body>
<h2>Match Averages</h2>
<table>
<tr>
    <th>Team Number</th>
    <th><a href="/matchhome.php?id=<?php echo $cid ?>&SortType=HABSandstormScore">Hab Start</a></th>
    <th><a href="/matchhome.php?id=<?php echo $cid ?>&SortType=SandstormCargo">Sandstorm Cargo</a></th>
    <th><a href="/matchhome.php?id=<?php echo $cid ?>&SortType=SandstormPanels">Sandstorm Panels</a></th>
    <th><a href="/matchhome.php?id=<?php echo $cid ?>&SortType=CargoFromFloor">Cargo From Floor</a></th>
    <th><a href="/matchhome.php?id=<?php echo $cid ?>&SortType=CargoFromHuman">Cargo From Human</a></th>
    <th><a href="/matchhome.php?id=<?php echo $cid ?>&SortType=PanelFromFloor">Panel From Floor</a></th>
    <th><a href="/matchhome.php?id=<?php echo $cid ?>&SortType=PanelFromHuman">Panel From Human</a></th>
    <th><a href="/matchhome.php?id=<?php echo $cid ?>&SortType=DefenseLevel">DefenseLevel</a></th>
    <th><a href="/matchhome.php?id=<?php echo $cid ?>&SortType=ShipPanels">Ship Hatch</a></th>
    <th><a href="/matchhome.php?id=<?php echo $cid ?>&SortType=ShipCargo">Ship Cargo</a></th>
    <th>Rocket Hatch (<a href="/matchhome.php?id=<?php echo $cid ?>&SortType=HighRocketPanels">A</a>, <a href="/matchhome.php?id=<?php echo $cid ?>&SortType=MidRocketPanels">B</a>, <a href="/matchhome.php?id=<?php echo $cid ?>&SortType=LowRocketPanels">C</a>)</th>
    <th>Rocket Cargo (<a href="/matchhome.php?id=<?php echo $cid ?>&SortType=HighRocketCargo">A</a>, <a href="/matchhome.php?id=<?php echo $cid ?>&SortType=MidRocketCargo">B</a>, <a href="/matchhome.php?id=<?php echo $cid ?>&SortType=LowRocketCargo">C</a>)</th>
    <th><a href="/matchhome.php?id=<?php echo $cid ?>&SortType=HabEndScore">Hab End</a></th>
    <th><a href="/matchhome.php?id=<?php echo $cid ?>&SortType=RobotsCarried">Robots Carried</a></th>
  </tr>
<?php while($row = mysqli_fetch_array($search_result)):?>
  <tr>
    <td><a href="/team.php?TeamNumber=<?php echo $row['TeamNumber']; ?>"><?php echo $row['TeamNumber']; ?> </a></td>
    <td><?php echo $row['HABSandstormScore']; ?></td>
    <td><?php echo $row['SandstormCargo']; ?></td>
    <td><?php echo $row['SandstormPanels']; ?></td>
    <td><?php echo $row['CargoFromFloor']; ?></td>
    <td><?php echo $row['CargoFromHuman']; ?></td>
    <td><?php echo $row['PanelFromFloor']; ?></td>
    <td><?php echo $row['PanelFromHuman']; ?></td>
    <td><?php echo $row['DefenseLevel']; ?></td>
    <td><?php echo $row['ShipPanels']; ?></td>
    <td><?php echo $row['ShipCargo']; ?></td>
    <td>A<?php echo $row['HighRocketPanels']; ?>, B<?php echo $row['MidRocketPanels']; ?>, C<?php echo $row['LowRocketPanels']; ?></td>
    <td>A<?php echo $row['HighRocketCargo']; ?>, B<?php echo $row['MidRocketCargo']; ?>, C<?php echo $row['LowRocketCargo']; ?></td>
    <td><?php echo $row['HabEndScore']; ?></td>
    <td><?php echo $row['RobotsCarried']; ?></td>
  </tr>

<?php endwhile; ?>
</table>

</body>
</html>