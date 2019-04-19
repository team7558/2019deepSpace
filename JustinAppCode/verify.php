<?php
session_start();
$verifyID = strip_tags($_GET['verifyID']);
if (isset($_POST['username'])) {
    

    $dbCon = mysqli_connect("", "", "", "");
    
    // Form
    $user = ($_POST['username']);
    $pass = ($_POST['password']);
if(!isset($user) || trim($user) == '')
{
   $errors = "You did not fill out the required fields<br />";
} else{
    
    
    $sql        = "SELECT * FROM `users` WHERE Username = '$user'";
    $query      = mysqli_query($dbCon, $sql); //search database
    $row        = mysqli_fetch_row($query);
    $uid        = $row[0];
    $dbUsname   = $row[1];
    $dbPassword = $row[2];
	$dbVerified = $row[6];
	$dbVerifyID = $row[7];
    // Check if user=user and pass=pass
  
    if ($user == $dbUsname && $pass == $dbPassword && $verifyID == $dbVerifyID) {
    
        // Set session 
        $_SESSION['username'] = $user;
        $_SESSION['id'] = $uid;
        
        
        
        $sql = "SELECT * FROM `users` WHERE `Username` = '$user' AND `Password` = '$pass'";

        $search_result = mysqli_query($dbCon, $sql);
        $exists = false;
        while($row = mysqli_fetch_array($search_result)):
        $exists = true;
        endwhile;
        
        if($exists) $sql = "UPDATE `users` SET `Verified`='0' WHERE `Username` = '$user' AND `Password` = '$pass'";
        
        if ($dbCon->query($sql) === TRUE) {
            ?><script type="text/javascript">
            alert("Account has been successfully verified!");
        	window.location.href = 'https://www.scouting.team7558.com/?>';
        	</script><?php
        }
        else echo "Error: " . $sql . "<br>" . $conn->error;
    } else {
		$errors = " ";
		if($dbVerified == 1){
			$errors = "Your account is unverified";
		}else{
        $errors = "That username and password combination is incorrect";
		}
    }
}
  
    
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <link rel="stylesheet" type="text/css" href="css/mainstyle.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Verify</title>
</head>

<body>
    <div id="mainbox">
        <div id="outerbox">
            <form action="/verify.php?verifyID=<?php echo $verifyID;?>" enctype="multipart/form-data" id="form" method="post" name="form">
              <h1>TEAM 7558<br>SCOUTING APP<br><i>VERIFICATION</i></h1>
              <br>
              USERNAME: <br>
              <input name="username" type="text" placeholder="Username" class="form2">
              <br>
              <br/> PASSWORD: <br>
              <input name="password" type="password" placeholder="Password" class="form2">
              <br>
              <br>
              <br>
              <input type="submit" id="login" name="submit" value="Verify">
              <br>
            </form>
            <span id="reghome"><a href="http://scouting.team7558.com/register.php"><button id="register">Register</button></a><br /></span>
            <div id="errors">
            <?php echo $errors; ?>
            </div>
        </div>
    </div>
</body>

</html>