<?php
session_start();
	$cid = $_GET['id'];
	$query = "SELECT * FROM `competitions` WHERE `id` = '$cid' ";
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
    $query = "SELECT * FROM `matchAverages` WHERE `competition` = '$cid'";
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
    <th>Hab Start</th>
    <th>Sandstorm Cargo</th>
    <th>Sandstorm Panels</th>
    <th>Cargo From Floor</th>
    <th>Cargo From Human</th>
    <th>Panel From Floor</th>
    <th>Panel From Human</th>
    <th>Ship Hatch</th>
    <th>Ship Cargo</th>
    <th>Rocket Hatch</th>
    <th>Rocket Cargo</th>
    <th>Hab End</th>
    <th>Robots Carried</th>
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