<?php

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $link = "https"; 
else {
    $link = "http"; 
    header("Location: https://www.scouting.team7558.com", true, 301);
}
session_start();
if (isset($_POST['username'])) {
    

    $dbCon = mysqli_connect("", "", "Mr.", "");
    
    
    // Form
    $user = ($_POST['username']);
    $pass = ($_POST['password']);
if(!isset($user) || trim($user) == '')
{
   $errors = "You did not fill out the required fields<br />";
} else{
    
    
    $sql        = "SELECT * FROM users WHERE Username = '$user' LIMIT 1";
    $query      = mysqli_query($dbCon, $sql); //search database
    $row        = mysqli_fetch_row($query);
    $uid        = $row[0];
    $dbUsname   = $row[1];
    $dbPassword = $row[2];
	$dbVerified = $row[6];
    // Check if user=user and pass=pass
  
    if ($user == $dbUsname && $pass == $dbPassword && $dbVerified == 0) {
    
        // Set session 
        $_SESSION['username'] = $user;
        $_SESSION['id'] = $uid;
    ?>
        <script type="text/javascript">
    window.location.href = 'https://www.scouting.team7558.com/scoutinghome.php';
    </script>
        <?php
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
    <title>Login</title>
</head>

<body>
    <div id="mainbox">
        <div id="outerbox">
            <form action="/index.php" enctype="multipart/form-data" id="form" method="post" name="form">
              <h1>TEAM 7558<br>SCOUTING APP<br><i>LOGIN</i></h1>
              <br>
              USERNAME: <br>
              <input name="username" type="text" placeholder="Username" class="form2">
              <br>
              <br/> PASSWORD: <br>
              <input name="password" type="password" placeholder="Password" class="form2">
              <br>
              <br>
              <br>
              <input type="submit" id="login" name="submit" value="Login">
              <br>
            </form>
            <span id="reghome"><a href="http://scouting.team7558.com/register.php"><button id="register">Register</button></a></span>
            <div id="errors">
            <?php echo $errors; ?>
            </div>
        </div>
    </div>
</body>

</html>