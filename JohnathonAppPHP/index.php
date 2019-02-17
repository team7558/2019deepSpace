<?php
session_start();
if (isset($_POST['username'])) {
    
    $dbCon = mysqli_connect("", "", "", "");
    
    
    // Form
    $user = ($_POST['username']);
    $pass = ($_POST['password']);
if(!isset($user) || trim($user) == '')
{
   echo "You did not fill out the required fields.";
} else{
    
    
    $sql        = "SELECT * FROM users WHERE username = '$user' LIMIT 1";
    $query      = mysqli_query($dbCon, $sql); //search database
    $row        = mysqli_fetch_row($query);
    $uid        = $row[0];
    $dbUsname   = $row[1];
    $dbPassword = $row[2];
	echo $dbUsname;
	echo $dbUsname;
	$acti = $row[5];
    // Check if user=user and pass=pass
	
    if ($user == $dbUsname && $pass == $dbPassword) {
		
        // Set session 
        $_SESSION['username'] = $user;
        $_SESSION['id'] = $uid;
		?>
        <script type="text/javascript">
		window.location.href = 'http://www.scouting.team7558.com/scoutinghome';
		</script>
        <?php
    } else {
        echo "<h2>Oops that username or password combination was incorrect.
        <br /> Please try again.</h2>";
    }
}
	
    
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
</head>

<body>
 <form action="/login.php" enctype="multipart/form-data" id="form" method="post" name="form">
 Username: <input name="username" type="text" placeholder="Username" class="form2"><br><br />

						Password: <input name="password" type="password" placeholder="Password" class="form2"><br><br />

						<input name="Submit" type="submit" value="Login" style="width: 20%; background-color: #263e4a; border: none; color: white; border-radius: 0px; padding: 8px;"><br />
  </form>

</body>
</html>