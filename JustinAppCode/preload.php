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
   $user = $_SESSION['username'];
}else{
    	?>
        <script type="text/javascript">
window.location.href = 'https://scouting.team7558.com/';
</script>
        <?php
}

function filterTable($query)
   	{
       	$connect = mysqli_connect("localhost", "team7558_s", "Mr.Roboto11235", "team7558_scouting");
       	$filter_Result = mysqli_query($connect, $query);
      		return $filter_Result;
   	}
   	
?>
<html>

   <head>
      <link rel="stylesheet" type="text/css" href="/css/databasestyle.css">
      <title>Preload Teams and Matches</title>
      <script src="preloadjavascript.js"></script>
   </head>
   <body>
       
      <div id="showtop">
         <form id="form" action="/postpreload.php" method="post">

            
            <!--Regular inputs-->
             <input type="hidden" id="dataqualsnumber" name="QualsNumber" value="0">
             <input type="hidden" id="dataqualslist" name="QualsList" value="">
             <input type="hidden" name="Competition" value="<?php echo $cid; ?>">
             <input type="submit" id="submitform" value="Submit" onclick="scoreForm();">
            
         </form>
         
         <a href="https://www.scouting.team7558.com/scoutinghome.php"><button id="gohome">Go Home</button></a>
         
         
      </div>

      <div id="inputlist">
         <span class="label">Number of Quals: </span><input class="inputs" type="number" name="qualsNumber" min=0 max=240 id="inputqualsnumber">
       
         <span id="qualscommentbox">Quals List:</span><br><br><textarea id="inputqualslist" rows="200" cols="200" placeholder="Quals 1&#10;123 456 7890 321 654 9870&#10;Quals 2&#10;R1 R2 R3 B1 B2 B3"></textarea></div>
      </div>
   </body>
</html>