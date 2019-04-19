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
       	$connect = mysqli_connect("", "team7558_s", "Mr.Roboto11235", "team7558_scouting");
       	$filter_Result = mysqli_query($connect, $query);
      		return $filter_Result;
   	}
   	
?>
<html>

   <head>
      <link rel="stylesheet" type="text/css" href="css/pitscoutingstyle.css">
      <title>7558 Scouting App - 2019 Season</title>
      <script src="pitscoutingjavascript.js"></script>
      <script>
      
      </script>
   </head>
   <body>
       
      <div id="modelbltop" class="modelbl"><p>PIT SCOUTING</p></div>
      <div id="showtop">
         <form id="form" action="/postpitold.php" method="post" enctype = "multipart/form-data">
             
                 <input id="image" name="image" type="file">

            
            <!--Regular inputs-->
             <input type="hidden" id="datateamname" name="TeamName" value="N/A">
             <input type="hidden" id="datateamnumber" name="TeamNumber" value="0">
             <input type="hidden" name="Competition" value="<?php echo $cid; ?>">
             <input type="hidden" id="datadrivetraintype" name="DrivetrainType" value="">
             <input type="hidden" id="datawheels" name="NumberWheels" value="0">
             <input type="hidden" id="datamotors" name="NumberMotors" value="0">
             
             <input type="hidden" id="datahabstart" name="HABStart" value="Level 1">
             <input type="hidden" id="datacargosandstorm" name="CargoSandstorm" value="0">
             <input type="hidden" id="datapanelsandstorm" name="PanelSandstorm" value="0">
             
             <input type="hidden" id="datahatchground" name="IntakeHatchGround" value="false">
             <input type="hidden" id="datahatchhuman" name="IntakeHatchHuman" value="false">
             <input type="hidden" id="datahatchship" name="ScoreHatchShip" value="false">
             <input type="hidden" id="datahatchlow" name="ScoreHatchLow" value="false">
             <input type="hidden" id="datahatchmid" name="ScoreHatchMid" value="false">
             <input type="hidden" id="datahatchhigh" name="ScoreHatchHigh" value="false">
             
             <input type="hidden" id="datacargoground" name="IntakeCargoGround" value="false">
             <input type="hidden" id="datacargohuman" name="IntakeCargoHuman" value="false">
             <input type="hidden" id="datacargoship" name="ScoreCargoShip" value="false">
             <input type="hidden" id="datacargolow" name="ScoreCargoLow" value="false">
             <input type="hidden" id="datacargomid" name="ScoreCargoMid" value="false">
             <input type="hidden" id="datacargohigh" name="ScoreCargoHigh" value="false">
             
             <input type="hidden" id="datahabend" name="HABEnd" value="Level 1">
             <input type="hidden" id="datarobotscarried" name="RobotsCarried" value="0">
             <input type="hidden" id="datalifttype" name="LiftType" value="N/A">
             
             <input type="hidden" id="datarookie" name="IsRookie" value="false">
             <input type="hidden" id="datacycletime" name="CycleTimeSeconds" value="N/A">
             <input type="hidden" id="datarobotweight" name="RobotWeightPounds" value="N/A">
             
             
            <input type="submit" id="submitform" value="Submit" onclick="scoreForm();">
            
         </form>
            <a href="https://www.scouting.team7558.com/scoutinghome.php"><button id="gohome">Go Home</button></a>
         
         
      </div>

      <div id="bigtable">
         <div id="toprow">
            <div id="general">
               <div class="title">General</div>

               <div class="element"><span class="label">Team Name: </span><input class="inputs" type="text" name="teamName" placeholder="ALT-F4" id="inputteamname"></div>

               <div class="element"><span class="label">Team Number: </span><input class="inputs" type="number" min=0 max=7915 name="teamNumber" placeholder="7558" id="inputteamnumber"></div>


            </div>
            <div id="start">
               <div class="title">Sandstorm</div>

               <div class="element"><span class="label">Starting HAB Level</span></div>
               <div id="sandstormrow">
                  <span class="element" id="sandstormleft">Level 1<input class="inputs" type="radio" name="sandstormlevel" value="Level 1" checked></span>
                  <span class="element">Level 2<input class="inputs" type="radio" name="sandstormlevel" value="Level 2"></span>
               </div>

               <div class="sandstormelement" id="sandstormitemleft"><span class="label">Cargo: </span><input class="sandstorminputs" type="number" min=0 max=4 name="sandstormCargo" id="cargosandstorm" value="0"></div>

               <div class="sandstormelement"><span class="label">Panels: </span><input class="sandstorminputs" type="number" min=0 max=4 name="sandstormPanels" id="panelsandstorm" value="0"></div>
            </div>
         </div>

         <div id="middlerow">
            <div id="drive">
               <div class="title">Drive</div>

               <div class="element"><span class="label">Drivetrain Type</span></div>
               <br>
               <div id="driverow1" class="driverow">
                  <span class="element">Tank<input class="inputs" type="radio" name="drivetrain" value="Tank" checked></span>
                  <span class="element">Swerve<input class="inputs" type="radio" name="drivetrain" value="Swerve"></span>
               </div>
               <div id="driverow2" class="driverow">
                  <span class="element">Omni<input class="inputs" type="radio" name="drivetrain" value="Omni"></span>
                  <span class="element">Mecanum<input class="inputs" type="radio" name="drivetrain" value="Mecanum"></span>
               </div>
               <div id="driverow3" class="driverow">
                  <span class="element">H-Drive<input class="inputs" type="radio" name="drivetrain" value="H-Drive"></span>
                  <span class="element">Treads<input class="inputs" type="radio" name="drivetrain" value="Treads"></span>
                  <span class="element">Bi-Pedal<input class="inputs" type="radio" name="drivetrain" value="Bi-Pedal"></span>
               </div>



               <div class="element"><span class="label">Number of Wheels: </span><input class="inputs" type="number" min=0 max=16 name="wheelNumber" id="wheelcount" value="0"></div>

               <div class="element"><span class="label">Number of Motors: </span><input class="inputs" type="number" min=0 max=16 name="motorNumber" id="motorcount" value="0"></div>
            </div>
            <div id="hatchcargo">
               <div id="hatchcargotable">
                  <div id="hatchcargorow">
                     <div id="hatch">
                        <div id="h">
                           <div class="title">Hatch</div>

                           <div class="element"><span class="label">Intake</span></div>

                           <div class="element"><input class="checkinputs" type="checkbox" name="hatchintakeground" id="hatchintakeground"><span class="checkelement">Ground</span></div>

                           <div class="element"><input class="checkinputs" type="checkbox" name="hatchintakehuman" id="hatchintakehuman"><span class="checkelement">Human</span></div>

                           <span class="itemelementdown"><div class="element"><span class="label">Scoring</span></div></span>

                           <div class="element"><input class="checkinputs" type="checkbox" name="hatchscoringship" id="hatchscoringship"><span class="checkelement">Ship</span></div>

                           <div class="element"><input class="checkinputs" type="checkbox" name="hatchscoringlow" id="hatchscoringlow"><span class="checkelement">Low Level</span></div>

                           <div class="element"><input class="checkinputs" type="checkbox" name="hatchscoringmid" id="hatchscoringmid"><span class="checkelement">Mid Level</span></div>

                           <div class="element"><input class="checkinputs" type="checkbox" name="hatchscoringhigh" id="hatchscoringhigh"><span class="checkelement">High Level</span></div>
                        </div>
                     </div>
                     <div id="cargo">
                        <div id="c">
                           <div class="title">Cargo</div>

                           <div class="element"><span class="label">Intake</span></div>

                           <div class="element"><span class="checkelement">Ground</span><input class="checkinputs" type="checkbox" name="cargointakeground" id="cargointakeground"></div>

                           <div class="element"><span class="checkelement">Human</span><input class="checkinputs" type="checkbox" name="cargointakehuman" id="cargointakehuman"></div>

                           <span class="itemelementdown"><div class="element"><span class="label">Scoring</span></div></span>

                           <div class="element"><span class="checkelement">Ship</span><input class="checkinputs" type="checkbox" name="cargoscoringship" id="cargoscoringship"></div>

                           <div class="element"><span class="checkelement">Low Level</span><input class="checkinputs" type="checkbox" name="cargoscoringlow" id="cargoscoringlow"></div>

                           <div class="element"><span class="checkelement">Mid Level</span><input class="checkinputs" type="checkbox" name="cargoscoringmid" id="cargoscoringmid"></div>

                           <div class="element"><span class="checkelement">High Level</span><input class="checkinputs" type="checkbox" name="cargoscoringhigh" id="cargoscoringhigh"></div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div id="bottomrow">
            <div id="misc">
               <div class="title">Miscellaneous</div>

               <div class="element"><span class="label">Rookie Team</span></div>
               <div id="rookierow">
                  <span class="element" id="rookieleft">Yes<input class="inputs" type="radio" name="rookieteam" id="rookieteam"></span>
                  <span class="element">No<input class="inputs" type="radio" name="rookieteam" checked></span>
               </div>

               <div class="element"><span class="label">Cycle Time: </span><input class="inputs" type="text" name="cycleTime" placeholder="In seconds" id="cycletimeseconds"></div>

               <div class="element"><span class="label">Robot Weight: </span><input class="inputs" type="text" name="robotWeight" placeholder="In pounds" id="robotweightpounds"></div>

            </div>
            <div id="end">
               <div class="title">Endgame</div>

               <div class="element"><span class="label">Ending HAB Level</span></div>
               <div id="endgamerow">
                  <span class="endgameleft">Level 1<input class="inputs" type="radio" name="endgamelevel" value="Level 1" checked></span>
                  <span class="endgameleft">Level 2<input class="inputs" type="radio" name="endgamelevel" value="Level 2"></span>
                  <span class="element">Level 3<input class="inputs" type="radio" name="endgamelevel" value="Level 3"></span>
                </div>
                  
                <div class="element"><span class="label">Number of Carried Bots: </span><input class="miniinputs" type="number" name="liftedBots" value="0" min=0 max=2 id="robotscarried"></div>

               <div class="element"><span class="label">Lift Type: </span><input class="inputs" type="text" name="liftType" id="lifttype"></div>
            </div>
         </div>

      </div>

   </body>
</html>