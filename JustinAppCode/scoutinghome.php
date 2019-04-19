<?php
	session_start();
	echo 'Welcome, '.$_SESSION['username']; 
	if(isset($_SESSION['username'])){
	$user = $_SESSION['username'];
    $query = "SELECT * FROM `competitions` WHERE `Username` = '$user' ORDER BY ID";
    $search_result = filterTable($query);
	}else{
	?>

   <script type="text/javascript">
window.location.href = 'https://www.scouting.team7558.com';
</script>

    <?php
}
    $connect = mysqli_connect("", "", "", "");
	function filterTable($query)
	{
	       $connect = mysqli_connect("", "", "", "");
    	$filter_Result = mysqli_query($connect, $query);
   		return $filter_Result;
	}
	
	if (isset($_POST['CompetitionName'])) {
	    $uname = $_SESSION['username'];
	    $compname = strip_tags($_POST['CompetitionName']);
        
        $sql = "INSERT INTO `competitions` (Username, CompetitionName) VALUES ('$uname', '$compname')";
    
        if ($connect->query($sql) === TRUE) {
            echo "Success!";
            ?><script>
        	window.location.href = 'https://www.scouting.team7558.com/scoutinghome.php';</script>
            <?php
        }
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link rel="stylesheet" type="text/css" href="css/databasestyle.css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 

<title>Team 7558 Scouting App</title>

</head>



<body>

<h1>Your Competitions</h1>



<table id="hometable">

                <tr>

                    <th id="homeid">ID</th>

                    <th id="homename">Competition Name</th>

                    <th id="homeview">Competition Page</th>
					
                    <th id="homescout">Scout Match</th>
                    
                    <th id="homepit">Pit Scout</th>

                    <th id="homepreload">Preload Teams and Matches</th>

                    <th id="homedelete">Delete Competition</th>
                    
                    

                </tr>



      <!-- populate table from mysql database -->

                <?php while($row = mysqli_fetch_array($search_result)):?>

                <tr>

                    <td><?php echo $row['ID'];?></td>

                    <td><?php echo $row[2];?></td>

                    <td><a href="/matchhome.php?id=<?php echo $row['ID'];?>"> View </a></td>

					<td><a href="/scoutingapp.php?id=<?php echo $row['ID'];?>"> Scout Match </a></td>
					
					<td><a href="/pitscouting.php?id=<?php echo $row['ID'];?>"> Pit Scout </a></td>

                    <td><a href="/preload.php?id=<?php echo $row['ID'];?>">Preload </a></td>

                    <td><a href="" onclick="alert();"> Edit/Delete </a></td>

                </tr>

                <?php endwhile;?>

            </table>
            
            <h3>Add Competition</h3>
            <form action="/scoutinghome.php" enctype="multipart/form-data" id="form" method="post" name="form">
                <input type="text" name="CompetitionName" id="compname" placeholder="Competition Name">
                <input type="submit" value="Created">
            </form>

</body>

</html>