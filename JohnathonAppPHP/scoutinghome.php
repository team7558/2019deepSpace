<?php
session_start();
if (isset($_SESSION['id'])){
	$uid = $_SESSION['id'];
    $user = $_SESSION['username']; 
    $query = "SELECT * FROM `competitions` WHERE Username = '$user'";
// function to connect and execute the query
    $connect = mysqli_connect("", "", "", "");
    $filter_Result = mysqli_query($connect, $query);

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>Untitled Document</title>
</head>

<body>
<h1>Your Matches</h1>

<table>
                <tr>
                    <th>ID</th>
                    <th>Competition Name</th>
                    <th>Competition Page</th>
                    <th>Add Teams/Matches</th>
                    <th>Delete Competition</th>
                </tr>

      <!-- populate table from mysql database -->
                <?php while($row = mysqli_fetch_array($filter_result)):?>
                <tr>
                    <td><?php echo $row['ID'];?></td>
                    <td><?php echo $row['Competition Name'];?></td>
                    <td><a herf="/matchhome.php?id=<?php echo $row['ID'];?>"> View </a></td>
                    <td><a herf="/edit.php?id=<?php echo $row['ID'];?>"> View </a></td>
                    <td><a herf="/delete.php?id=<?php echo $row['ID'];?>"> View </a></td>
                </tr>
                <?php endwhile;?>
            </table>
</body>
</html>