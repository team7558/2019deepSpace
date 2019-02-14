<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
requires(db.php);
$connect = mysqli_connect($db_HOST, $db_USER, $db_PASS, $db_NAME);

$sortType = htmlspecialchars($_GET["sortType"]); // Should be a column name
$sortOrder = htmlspecialchars($_GET["sortOrder"]); // Should be ASC or DSC
$sql = "SELECT * FROM matches ORDER BY'$sortType' '$sortOrder'";

$search_result = filterTable($sql);

// this is a function since there may need to be more than one query later on
function filterTable($query)
{
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}

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
<?php while($row = mysqli_fetch_array($search_result)):?>
	<table>
  <tr>
    <th>ID</th>
    <th>Date & Time</th>
    <th>Match Number</th>
    <th>Team Number</th>
  </tr>
  <tr>
    <td><?php echo $row['ID']; ?></td>
    <td><?php echo $row['Date']; ?> @ <?php echo $row['Time']; ?></td>
    <td><?php echo $row['MatchNumber']; ?></td>
    <td><?php echo $row['TeamNumber']; ?></td>
  </tr>
</table>
<?php endwhile; ?>
</html>