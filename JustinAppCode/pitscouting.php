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
      <link rel="stylesheet" type="text/css" href="css/pitscoutingstyle.css">
      <title>7558 Pit Scouting Sheet - 2019 Season</title>
      <script src="pitscoutingjavascript.js"></script>
      <script>
      
      </script>
   </head>
   <body>
       
      <div id="modelbltop" class="modelbl"><p>PIT SCOUTING</p></div>
      <div id="showtop">
          
         <button id="loadteambutton" onclick="if(document.getElementById('loadteamnumber').value!=='Select') window.location.href = 'https://WWW.scouting.team7558.com/pitscouting.php?id=<?php echo $cid;?>&TeamNumber='+document.getElementById('loadteamnumber').value;
            "><span id="loadteam">Edit Team
            <select id="loadteamnumber">
                <option>Select</option>
                <?php
                        $query = "SELECT * FROM `pitdata` WHERE `Competition` = '$cid' ORDER BY TeamNumber";
                        $search_result = filterTable($query);
                 ?>
         
                <?php while($row = mysqli_fetch_array($search_result)):?>
                
                <option><?php echo $row['TeamNumber'];?></option>

                <?php endwhile;?>
            </select>
            </span></button>
          
         <form id="form" action="/postpit.php" method="post" enctype = "multipart/form-data">
             
             <!--Image inputs-->
             <label for="image" class="customupload">
                 <input id="image" name="image" type="file">
            </label>

            
            <!--Regular inputs-->
             <input type="hidden" id="datateamname" name="TeamName" value="N/A">
             <input type="hidden" id="datateamnumber" name="TeamNumber" value="0">
             <input type="hidden" id="datageneralcomments" name="GeneralComments" value="">
             <input type="hidden" name="Competition" value="<?php echo $cid; ?>">
             
             <input type="hidden" id="datadrivetraintype" name="DrivetrainType" value="">
             <input type="hidden" id="datawheels" name="WheelType" value="">
             <input type="hidden" id="datamotors" name="NumberDriveMotors" value="0">
             
             <input type="hidden" id="datahabstart" name="HABStart" value="Level 1">
             <input type="hidden" id="datasandstormmovement" name="SandstormMovement" value="">
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
               
               <div class="element"><span id="generalcomments">General Comments:</span><br><br><textarea id="generalcommentbox" rows="4" cols="72" placeholder="Any extra important information"></textarea></div>


            </div>
            <div id="start">
               <div class="title">Sandstorm</div>

               <div class="element"><span class="label">Starting HAB Level</span></div>
               <div id="sandstormrow">
                  <span class="element" id="sandstormleft">Level 1<input class="inputs" type="radio" name="sandstormlevel" value="Level 1" checked></span>
                  <span class="element">Level 2<input class="inputs" type="radio" name="sandstormlevel" value="Level 2"></span>
               </div>
               
               <div class="element"><span class="label">Sandstorm Movement</span></div>
               
               <div id="sandstormrow">
                  
                  
                  <span class="element"><input class="checkinputs" type="checkbox" name="sandstormMove" id="sandstormmovestay"><span class="checkelementsand" value="Does Not Move">Stays</span>
                  
                  <span class="element"><input class="checkinputs" type="checkbox" name="sandstormMove" id="sandstormmoveauto"><span class="checkelementsand" value="Autonomous">Auto</span>
                  
                  <span class="element"><input class="checkinputs" type="checkbox" name="sandstormMove" id="sandstormmovemanual"><span class="checkelementsand" value="Manual Control">Manual</span>
               </div>
               
               
               <div class="element"><span class="label">Sandstorm Activity</span></div><br>

               <div class="sandstormelement" id="sandstormitemleft"><span class="label">Cargo: </span><input class="sandstorminputs" type="number" min=0 max=4 name="sandstormCargo" id="cargosandstorm" value="0"></div>

               <div class="sandstormelement"><span class="label">Panels: </span><input class="sandstorminputs" type="number" min=0 max=4 name="sandstormPanels" id="panelsandstorm" value="0"></div>
            </div>
         </div>

         <div id="middlerow">
            <div id="drive">
               <div class="title">Drive</div>
               
               <div class="element"><span id="drivetraincomments">Drivetrain Type:</span><br><br><textarea id="drivetraintype" rows="5" cols="76" placeholder="i.e. tank, omni"></textarea></div>

               <div class="element"><span class="label">Type of Wheels: </span><input class="inputs" type="text"name="wheelType" id="wheeltype" value=""></div>

               <div class="element"><span class="label">Drive Motor Count: </span><input class="inputs" type="number" min=0 max=16 name="numberDriveMotors" id="drivemotorcount" value="0"></div>
               
              
              
              
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
                  <span class="element">No<input class="inputs" type="radio" name="rookieteam" id="notrookieteam" checked></span>
               </div>

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
            <?php
           //Load team
            if(isset($_GET['TeamNumber'])) {
                $team = $_GET['TeamNumber'];
                $query = "SELECT * FROM `pitdata` WHERE `competition` = '$cid' AND `TeamNumber`=$team";
                $search_result = filterTable($query);
                while($row = mysqli_fetch_array($search_result)):
                    ?><script>
                        
                        document.getElementById("inputteamname").value="<?php echo $row['TeamName'];?>";
                        document.getElementById("inputteamnumber").value="<?php echo $row['TeamNumber'];?>";
                        document.getElementById("generalcommentbox").value="<?php echo $row['GeneralComments'];?>";
                        document.getElementById("drivetraintype").value="<?php echo $row['DrivetrainType'];?>";
                        document.getElementById("wheeltype").value="<?php echo $row['WheelType'];?>";
                        document.getElementById("drivemotorcount").value="<?php echo $row['NumberDriveMotors'];?>";
                        
                        
                        //HAB Start
                        if('<?php echo $row['HABStart'];?>'=="Level 1") {
                            document.getElementsByName("sandstormlevel")[0].checked=true;
                            document.getElementsByName("sandstormlevel")[1].checked=false;
                        } else
                        if('<?php echo $row['HABStart'];?>'=="Level 2") {
                            document.getElementsByName("sandstormlevel")[0].checked=false;
                            document.getElementsByName("sandstormlevel")[1].checked=true;
                        }
                        
                        
                        //Sandstorm
                        if("<?php if(strpos($row['SandstormMovement'],"oes")>0) echo "STAYS"; else echo "NO";?>"=="STAYS") document.getElementById("sandstormmovestay").checked = true;
                        if("<?php if(strpos($row['SandstormMovement'],"uton")>0) echo "AUTO"; else echo "NO";?>"=="AUTO") document.getElementById("sandstormmoveauto").checked = true;
                        if("<?php if(strpos($row['SandstormMovement'],"anual")>0) echo "MANUAL"; else echo "NO";?>"=="MANUAL") document.getElementById("sandstormmovemanual").checked = true;
                        
                        document.getElementById("cargosandstorm").value="<?php echo $row['CargoSandstorm'];?>";
                        document.getElementById("panelsandstorm").value="<?php echo $row['PanelSandstorm'];?>";
                        
                        
                        //Hatch
                        if('<?php echo $row['IntakeHatchGround'];?>'=="true") document.getElementById("hatchintakeground").checked=true;
                        if('<?php echo $row['IntakeHatchHuman'];?>'=="true") document.getElementById("hatchintakehuman").checked=true;
                        if('<?php echo $row['ScoreHatchShip'];?>'=="true") document.getElementById("hatchscoringship").checked=true;
                        if('<?php echo $row['ScoreHatchLow'];?>'=="true") document.getElementById("hatchscoringlow").checked=true;
                        if('<?php echo $row['ScoreHatchMid'];?>'=="true") document.getElementById("hatchscoringmid").checked=true;
                        if('<?php echo $row['ScoreHatchHigh'];?>'=="true") document.getElementById("hatchscoringhigh").checked=true;
                        
                        //Cargo
                        if('<?php echo $row['IntakeCargoGround'];?>'=="true") document.getElementById("cargointakeground").checked=true;
                        if('<?php echo $row['IntakeCargoHuman'];?>'=="true") document.getElementById("cargointakehuman").checked=true;
                        if('<?php echo $row['ScoreCargoShip'];?>'=="true") document.getElementById("cargoscoringship").checked=true;
                        if('<?php echo $row['ScoreCargoLow'];?>'=="true") document.getElementById("cargoscoringlow").checked=true;
                        if('<?php echo $row['ScoreCargoMid'];?>'=="true") document.getElementById("cargoscoringmid").checked=true;
                        if('<?php echo $row['ScoreCargoHigh'];?>'=="true") document.getElementById("cargoscoringhigh").checked=true;
                        
                        
                        
                        //HAB End
                        if('<?php echo $row['HABStart'];?>'=="Level 1") {
                            document.getElementsByName("endgamelevel")[0].checked=true;
                            document.getElementsByName("endgamelevel")[1].checked=false;
                            document.getElementsByName("endgamelevel")[2].checked=false;
                        } else
                        if('<?php echo $row['HABStart'];?>'=="Level 2") {
                            document.getElementsByName("endgamelevel")[0].checked=false;
                            document.getElementsByName("endgamelevel")[1].checked=true;
                            document.getElementsByName("endgamelevel")[2].checked=false;
                        } else
                        if('<?php echo $row['HABStart'];?>'=="Level 3") {
                            document.getElementsByName("endgamelevel")[0].checked=false;
                            document.getElementsByName("endgamelevel")[1].checked=false;
                            document.getElementsByName("endgamelevel")[2].checked=true;
                        }
                        
                        document.getElementById("robotscarried").value="<?php echo $row['RobotsCarried'];?>";
                        document.getElementById("lifttype").value="<?php echo $row['LiftType'];?>";
                        
                        //Rookie Team
                        if('<?php echo $row['IsRookie'];?>'=="true") {
                            document.getElementById("rookieteam").checked=true;
                            document.getElementById("notrookieteam").checked=false;
                        } else
                        if('<?php echo $row['HABStart'];?>'=="Level 2") {
                            document.getElementById("rookieteam").checked=false;
                            document.getElementById("notrookieteam").checked=true;
                        }
                        
                        document.getElementsByName("robotWeight")[0].value="<?php echo $row['RobotWeightPounds'];?>";
                    
                    </script><?php
                endwhile;
            }
            ?>
         </div>

      </div>

   </body>
</html>