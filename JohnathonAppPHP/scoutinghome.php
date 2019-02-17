<?php
session_start();
if (isset($_SESSION['id'])){
	$uid = $_SESSION['id'];
    $user = $_SESSION['username']; 
    $query = "SELECT * FROM `listings` WHERE username = '$user'";
    $search_result = filterTable($query);
// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("", "", "", "");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>Untitled Document</title>
</head>

<body>
<h1></h1>
</body>
</html>