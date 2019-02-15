<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
$db_HOST = "localhost";
$db_USER = "jslighth_1";
$db_PASS = "1234";
$db_NAME = "jslighth_frctest";
$connect = mysqli_connect($db_HOST, $db_USER, $db_PASS, $db_NAME);

//$sortType = htmlspecialchars($_GET["sortType"]); // Should be a column name
//$sortOrder = htmlspecialchars($_GET["sortOrder"]); // Should be ASC or DSC
$sql = "SELECT * FROM `matches` WHERE 1";

$search_result = mysqli_query($connect, $sql);

// this is a function since there may need to be more than one query later on

?>
<html>
<head>
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
<table>
<tr>
    <th>Team Number</th>
    <th>Match Number</th>
    <th>Score</th>
    <th>View Full</th>
  </tr>
<?php while($row = mysqli_fetch_array($search_result)):?>
  <tr>
    <td><?php echo $row['TeamNumber']; ?></td>
    <td><?php echo $row['MatchNumber']; ?></td>
    <td><?php echo $row['Score']; ?></td>
    <td><a href="/full.php?id=<?php echo $row['ID']; ?>">Full</a></td>
  </tr>

<?php endwhile; ?>
</table>
</html>