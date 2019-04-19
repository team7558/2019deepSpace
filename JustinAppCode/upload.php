<?php
session_start();
   	$cid = $_GET['id'];
   	$query = "SELECT * FROM `competitions` WHERE `id` = '$cid'";
   	$belongsToUser = false;
   
   	$search_result = filterTable($query);
   	while($row = mysqli_fetch_array($search_result)):
   		if($row['Username'] == $_SESSION['username']){
   			$belongsToUser = true;	
   		}
   	endwhile;
if ($belongsToUser && isset($_SESSION['username'])) {
   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
	  $file_name_new = "".htmlspecialchars($_POST["TeamNumber"])."_".($_GET["id"]).".jpg"; 
      $file_size = $_FILES['image']['size'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpg");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="Please only upload .JPG files.";
      }
      
      if($file_size > 2097152) {
         $errors[]='File size must be under 2 MB';
      }
      
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"uploads/".$file_name_new);
         echo "Success";
      }else{
         print_r($errors);
      }
   }
}else{
	
	?>
        <script type="text/javascript">
window.location.href = 'https://scouting.team7558.com/';
</script>
        <?php
}

function filterTable($query)
   	{
       	$connect = mysqli_connect("", "", "", "");
       	$filter_Result = mysqli_query($connect, $query);
      		return $filter_Result;
   	}
   	
?>
<html>
   <body>
      
      <form action = "" method = "POST" enctype = "multipart/form-data">
         <input type = "file" name = "image" />
         Team Number: <input type = "text" name = "TeamNumber">
         <input type = "submit" value = "Upload" />
			
         <ul>
            <li>Sent file: <?php echo $_FILES['image']['name'];  ?>
            <li>File size: <?php echo $_FILES['image']['size'];  ?>
            <li>File type: <?php echo $_FILES['image']['type'] ?>
         </ul>
			
      </form>
      
   </body>
</html>