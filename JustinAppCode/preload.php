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
       	$connect = mysqli_connect("", "", "", "");
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
         <span class="label">Number of Quals: </span><br><input class="inputs" type="number" name="qualsNumber" min=0 max=240 id="inputqualsnumber">
        <br><br>
        <div id="pretable">
            <div id="prerow">
                <div class="preitem">
                    <span id="qualsinsert"><span id="qualscommentbox">Quals List:</span><br><textarea id="inputqualslist" rows="40" cols="64" placeholder="Quals 1&#10;771&Tab;1114&Tab;1241&Tab;188&Tab;1310&Tab;907&#10;Quals 2&#10;33&Tab;1&Tab;4343&Tab;610&Tab;7558&Tab;7603&#10;Quals 32&#10;854&Tab;5917&Tab;2708&Tab;6141&Tab;3683&Tab;7735&#10;"></textarea></span>
                </div>
            </div>
        </div>
      </div>
   </body>
</html>