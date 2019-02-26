<?php
session_start();
if (isset($_POST['username'])) {
    
    $dbCon = mysqli_connect("localhost", "team7558_s", "Mr.Roboto11235", "team7558_scouting");
    
    
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
    window.location.href = 'http://scouting.team7558.com/scoutinghome';
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
    <link rel="stylesheet" type="text/css" href="mainstyle.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Login</title>
</head>

<body>
    <div id="mainbox">
        <div id="outerbox">
            <form action="/index.php" enctype="multipart/form-data" id="form" method="post" name="form">
              <h1>TEAM 7558<br>SCOUTING APP<br><i>REGISTRATION</i></h1>
              <br>
              USERNAME: <br>
              <input name="username" type="text" placeholder="Username" class="form2">
              <br>
              <br/> PASSWORD: <br>
              <input name="password" type="password" placeholder="Password" class="form2">
              <br>
              <br/> EMAIL: <br>
              <input name="email" type="email" placeholder="Email" class="form2">
              <br>
              <br/> TEAM NUMBER: <br>
              <input name="teamnumber" type="number" placeholder="Team Number" class="form2">
              <br>
              <br/> SCHOOL NAME: <br>
              <input name="schoolname" type="text" placeholder="School Name" class="form2">
              <br>
              <br>
              <input type="submit" id="register" name="submit" value="Register">
              <br>
            </form>
            <a href="http://scouting.team7558.com"><button id="login">Login</button></a>
            <br/>
            <div id="errors">
              You inputted an invalid username or password.<br>Please try again.
            </div>
        </div>
    </div>
</body>

</html>