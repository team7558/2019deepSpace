<?php
session_start();
if (isset($_POST['username'])) {
    
    
    $conn = new mysqli("", "", "", "");
    
    
    // Form
    $user = ($_POST['username']);
    $pass = ($_POST['password']);
	$email = ($_POST['email']);
    $teamnumber = ($_POST['teamnumber']);
	$schoolname = ($_POST['schoolname']);
	
if((!isset($user) || trim($user) == '') || (!isset($pass) || trim($pass) == '') || (!isset($teamnumber) || trim($teamnumber) == ''|| (!isset($schoolname) || trim($schoolname) == '')))
{
   $errors = "You did not fill out the required fields.";
} else{
	$sql = "SELECT * FROM `users` WHERE `Username` = '$user'";
	$search_result = mysqli_query($conn, $sql);
	$exists = false;
	while($row = mysqli_fetch_array($search_result)):
	$exists = true;
	endwhile;
	if($exists){
		$errors = "That username already exists";	
	}
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  		$errors = "Invalid email";
	}
	if (!preg_match("/^[a-zA-Z ]*$/",$schoolname)) {
  		$errors = "Only letters and spaces permitted in school name";
	}
	
	
	$length = 24;
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $verifyID = '';
    for ($i = 0; $i < $length; $i++) {
        $verifyID .= $characters[rand(0, $charactersLength - 1)];
    }
	
	if(!isset($errors) || trim($errors) == ''){
    	$sql = "INSERT INTO `users` (Username, Password, Email, TeamNumber, School, Verified, VerifyID) VALUES ('$user', '$pass', '$email', '$teamnumber', '$schoolname', '1', '$verifyID')";
    	
	if ($conn->query($sql) === TRUE) {
    
    $link = "https://www.scouting.team7558.com/verify.php?verifyID=".$verifyID;
    
    
	$email_to = "scouting@team7558.com";
 
    $email_subject = "New Account at Team7558.com";
    $email_message .= "Hello, Team ".($teamnumber). "\n";
	 
    $email_message .= "Thanks for registering your account at scouting.team7558.com. You must first verify your account by visiting the following link and logging in: ".$link."\n";
	
	$email_message .= "Please make a note of your account information, it is as follows:"."\n";
	$email_message .= "\n"."Username: ".($user)."\n";
	$email_message .= "Email: ".($email)."\n";
	$email_message .= "Team Number: ".($teamnumber)."\n";
	$email_message .= "School Name: ".($schoolname)."\n";	
	// create email headers
 
	$headers = 'From: '.$email_to."\r\n".
 
	'Reply-To: '.$email."\r\n" .
 
	'X-Mailer: PHP/' . phpversion();
 
	@mail($email_to, $email_subject, $email_message, $headers);  
 
	@mail($email, $email_subject, $email_message, $headers);  

	} else {
    echo "Error updating record: " . $conn->error;
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
            <form action="/register.php" enctype="multipart/form-data" id="form" method="post" name="form">
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
              <?php echo $errors; ?>
            </div>
        </div>
    </div>
</body>

</html>