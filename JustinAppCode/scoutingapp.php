<?php
session_start();
   $cid = $_GET['id'];
   $query = "SELECT * FROM `competitions` WHERE `id` = '$cid'";
   $belongsToUser = false;
   $_SESSION['cid'] = $cid;
   $search_result = filterTable($query);
   while($row = mysqli_fetch_array($search_result)):
      if($row['Username'] == $_SESSION['username']){
         $belongsToUser = true;  
      }
   endwhile;
   if((isset($_SESSION['username']) && $belongsToUser)){
   $user = $_SESSION['username'];
   }else{
   ?>
   <script type="text/javascript">
   window.location.href = 'https://www.scouting.team7558.com';
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

      <link rel="stylesheet" type="text/css" href="scoutingappstyle.css">

      <title>7558 Scouting App - 2019 Season</title>

      <script src="scoutingappjavascript.js"></script>

      <script>

      

      </script>

   </head>

   <body>



      <div id="modelbltop" class="modelbl"><p>PRELOAD PERIOD</p></div>

      <div id="gameinfo">
       <span class="toptitle">Competition ID:</span><?php echo $cid; ?><br>
       <span class="toptitle">Match Number:</span><span id="matchnumber"><input type="number" min=0 max=500 id="inputmatchnumber"></span><br>
      </div>
      <div id="teaminfo">
        <br><span class="toptitle">Team Number:</span><span id="teamnumber"><input type="number" min=0 max=7915 id="inputteamnumber" onchange="updateTeamNumber();"></span>
      </div>



      <div id="stations">

         <div id="stationrow">

            <button class="stationbutton" id="stationR1" onClick="changeStation(0,1);">Station<br>Red 1</button>

            <button class="stationbutton" id="stationR2" onClick="changeStation(0,2);">Station<br>Red 2</button>

            <button class="stationbutton" id="stationR3" onClick="changeStation(0,3);">Station<br>Red 3</button>

            <button id="flipsides" onClick="changeButtonPlacement();">Flip Sides</button>

            <button class="stationbutton" id="stationB1" onClick="changeStation(1,1);">Station<br>Blue 1</button>

            <button class="stationbutton" id="stationB2" onClick="changeStation(1,2);">Station<br>Blue 2</button>

            <button class="stationbutton" id="stationB3" onClick="changeStation(1,3);">Station<br>Blue 3</button>

         </div>

      </div>



      <div id="playfield">

         <div id="playfieldrow">



            <div id="habpreload" class="habbuttons">

               <p class="btnheader">Preload Setting</p>

               <button class="hablevels" id="habLevel01" onClick="leaveHAB(1, 0);">Started<br>on HAB Level 1<br><span class="habsandstormtag">(During Preload)</span></button>

               <button class="hablevels" id="habLevel02" onClick="leaveHAB(2, 0);">Started<br>on HAB Level 2<br><span class="habsandstormtag">(During Preload)</span></button>

               <button class="hablevels" id="habLevel03" onClick="leaveHAB(3, 0);">Started<br>on HAB Level 3<br><span class="habsandstormtag">(During Preload)</span></button>

               <button class="cancel" onClick="leaveHAB(-1, 0);">Cancel HAB Selection</button>

            </div>



            <div id="habstart" class="habbuttons">

               <p class="btnheader">HAB Activity</p>

               <button class="hablevels" id="habLevel10" onClick="leaveHAB(0, 1);">Stayed<br>on HAB<br><span class="habsandstormtag">(During Sandstorm)</span></button>

               <button class="hablevels" id="habLevel11" onClick="leaveHAB(1, 1);">Left HAB<br>Level 1<br><span class="habsandstormtag">(During Sandtorm)</span></button>

               <button class="hablevels" id="habLevel12" onClick="leaveHAB(2, 1);">Left HAB<br>Level 2<br><span class="habsandstormtag">(During Sandtorm)</span></button>

               <button class="hablevels" id="habLevel13" onClick="leaveHAB(3, 1);">Left HAB<br>Level 3<br><span class="habsandstormtag">(During Sandtorm)</span></button>

               <button class="cancel" onClick="leaveHAB(-1, 1);">Cancel HAB Selection</button>

            </div>



            <div id="habend" class="habbuttons">

               <p class="btnheader">HAB Activity</p>

               <button class="hablevels" id="habLevel20" onClick="leaveHAB(0, 2);">Remained<br>on Field<br><span class="habsandstormtag">(During Endgame)</span></button>

               <button class="hablevels" id="habLevel21" onClick="leaveHAB(1, 2);">Entered HAB<br>Level 1<br><span class="habsandstormtag">(During Endgame)</span></button>

               <button class="hablevels" id="habLevel22" onClick="leaveHAB(2, 2);">Entered HAB<br>Level 2<br><span class="habsandstormtag">(During Endgame)</span></button>

               <button class="hablevels" id="habLevel23" onClick="leaveHAB(3, 2);">Entered HAB<br>Level 3<br><span class="habsandstormtag">(During Endgame)</span></button>

               <button class="cancel" onClick="leaveHAB(-1, 2);">Cancel HAB Selection</button>

            </div>



            <div id="gamearea">

               <div id="gamemap"></div>



               <div id="sstable">



                  <!--Top Row - Rocket 1-->

                  <div class="sstablerow">

                     <div class="sstableitem">

                        <button class="scorespaces" id="scorespace0" onClick="score(0);">Cargo: &#x2716<br><br>Panel: &#x2716</button>

                        <button class="scorespaces" id="scorespace1" onClick="score(1);">Cargo: &#x2716<br><br>Panel: &#x2716</button>



                        <button class="scorespaces" id="scorespace2" onClick="score(2);">Cargo: &#x2716<br><br>Panel: &#x2716</button>

                        <button class="scorespaces" id="scorespace3" onClick="score(3);">Cargo: &#x2716<br><br>Panel: &#x2716</button>



                        <button class="scorespaces" id="scorespace4" onClick="score(4);">Cargo: &#x2716<br><br>Panel: &#x2716</button>

                        <button class="scorespaces" id="scorespace5" onClick="score(5);">Cargo: &#x2716<br><br>Panel: &#x2716</button>



                        <button class="rocketleveldisplay" id="rocketleveldisplay1" onClick="changeRocket();">Low<br><br>Level C</button>

                     </div>

                  </div>   



                  <div class="sstablerow">

                     <div class="sstableitem">

                        <button class="scorespaces" id="scorespace6" onClick="score(6);">Cargo: &#x2716<br><br>Panel: &#x2716</button>

                        <button class="scorespaces" id="scorespace7" onClick="score(7);">Cargo: &#x2716<br><br>Panel: &#x2716</button>



                        <button class="scorespaces" id="scorespace8" onClick="score(8);">Cargo: &#x2716<br><br>Panel: &#x2716</button>

                        <button class="scorespaces" id="scorespace9" onClick="score(9);">Cargo: &#x2716<br><br>Panel: &#x2716</button>



                        <button class="scorespaces" id="scorespace10" onClick="score(10);">Cargo: &#x2716<br><br>Panel: &#x2716</button>

                        <button class="scorespaces" id="scorespace11" onClick="score(11);">Cargo: &#x2716<br><br>Panel: &#x2716</button>



                        <button class="rocketleveldisplay" id="rocketleveldisplay2" onClick="changeRocket();">Low<br><br>Level C</button>

                     </div>

                  </div>



                  <div class="sstablerow">

                     <div class="sstableitem">

                        <!--Robot Score Space-->

                        <button id="robotscorespace" onClick="preloadRobot();">Your Robot<br>is Holding:<br><br>Nothing</button>



                        <!--Team Number-->

                        <button id="mapteamnumber">0</button>



                        <button class="scorespaces" id="scorespace12" onClick="score(12);">Cargo: &#x2716<br><br>Panel: &#x2716</button>

                     </div>

                  </div>



                  <div class="sstablerow">

                     <div class="sstableitem">

                        <button class="scorespaces" id="scorespace13" onClick="score(13);">Cargo: &#x2716<br><br>Panel: &#x2716</button>

                     </div>

                  </div>





                  <div class="sstablerow">

                     <div class="sstableitem">

                        <button class="scorespaces" id="scorespace14" onClick="score(14);">Cargo: &#x2716<br><br>Panel: &#x2716</button>

                        <button class="scorespaces" id="scorespace15" onClick="score(15);">Cargo: &#x2716<br><br>Panel: &#x2716</button>

                        <button class="scorespaces" id="scorespace16" onClick="score(16);">Cargo: &#x2716<br><br>Panel: &#x2716</button>

                     </div>

                  </div>



                  <div class="sstablerow">

                     <div class="sstableitem">

                        <button class="scorespaces" id="scorespace17" onClick="score(17);">Cargo: &#x2716<br><br>Panel: &#x2716</button>

                        <button class="scorespaces" id="scorespace18" onClick="score(18);">Cargo: &#x2716<br><br>Panel: &#x2716</button>

                        <button class="scorespaces" id="scorespace19" onClick="score(19);">Cargo: &#x2716<br><br>Panel: &#x2716</button>

                     </div>

                  </div>



               </div>







               <div id="miscellaneous">

                  <p class="btnheader">Robot Defense Activity</p>

                  <div id="defensebuttons">

                     <button class="switchdefense" id="defense0" onClick="switchDefense(0);">0</button>

                     <button class="switchdefense" id="defense1" onClick="switchDefense(1);">1</button>

                     <button class="switchdefense" id="defense2" onClick="switchDefense(2);">2</button>

                  </div>

                  <p class="btnheader">Number of Bots Carried</p>

                  <div id="carrybotbuttons">

                     <button class="switchcarrybot" id="carrybot0" onClick="switchCarryBot(0);">0</button>

                     <button class="switchcarrybot" id="carrybot1" onClick="switchCarryBot(1);">1</button>

                     <button class="switchcarrybot" id="carrybot2" onClick="switchCarryBot(2);">2</button>

                  </div>

                  <button id="wascarried" onClick="switchWasCarried();">Was Carried</button>

                  <p class="btnheader">Comment Area</p>

                  <textarea id="commentbox" placeholder="Type some general comments..."></textarea>





                  <form id="form" method="post">



                     <!--Sandstorm Info-->

                     <input type="hidden" id="datahabstart" name="HABSandstormScore" value="0">

                     <input type="hidden" id="datasandstormcargo" name="SandstormCargo" value="0">

                     <input type="hidden" id="datasandstormpanel" name="SandstormPanels" value="0">





                     <!--General Info-->

                     <input type="hidden" id="datacargofloor" name="CargoFromFloor" value="0">

                     <input type="hidden" id="datacargohuman" name="CargoFromHuman" value="0">

                     <input type="hidden" id="datapanelfloor" name="PanelFromFloor" value="0">

                     <input type="hidden" id="datapanelhuman" name="PanelFromHuman" value="0">

                     <input type="hidden" id="datadefense" name="DefenseLevel" value="0">



                     

                     <!--TeleOp Info-->

                     <input type="hidden" id="datashipcargo" name="ShipCargo" value="0">

                     <input type="hidden" id="datashippanel" name="ShipPanels" value="0">

                     <input type="hidden" id="datalowcargo" name="LowRocketCargo" value="0">

                     <input type="hidden" id="datalowpanel" name="LowRocketPanels" value="0">

                     <input type="hidden" id="datamidcargo" name="MidRocketCargo" value="0">

                     <input type="hidden" id="datamidpanel" name="MidRocketPanels" value="0">

                     <input type="hidden" id="datahighcargo" name="HighRocketCargo" value="0">

                     <input type="hidden" id="datahighpanel" name="HighRocketPanels" value="0">





                     <!--Endgame Info-->

                     <input type="hidden" id="datawascarried" name="WasCarried" value="false">

                     <input type="hidden" id="datarobotscarried" name="RobotsCarried" value="0">

                     <input type="hidden" id="datahabend" name="HABEndScore" value="0">

                     <input type="hidden" id="datacomments" name="Comments" value="">





                     <!--Match Info-->

                     <input type="hidden" id="matchdatateamnumber" name="TeamNumber" value="000">

                     <input type="hidden" name="Competition" value="<?php echo $cid; ?>">

                     <input type="hidden" id="matchdatamatchnumber" name="MatchNumber" value="1">

                     <input type="hidden" id="matchdatarobotstation" name="RobotStation" value="R1">







                     <input type="submit" id="submitform" value="Submit" onClick="scoreForm();">

                  </form>





               </div>

            </div>





            <div id="pickuppreload" class="pickupbuttons">

               <p class="btnheader">Item Pickup</p>

               <button class="itempickups" id="cargoPreload" onClick="getCargoPreload();">Cargo</button>

               <button class="itempickups" id="panelPreload" onClick="getPanelPreload();">Hatch Panel</button>

               <button class="cancel" onClick="dropItem();">Drop Item</button>

            </div>



            <div id="pickup" class="pickupbuttons">

               <p class="btnheader">Item Pickup</p>

               <button class="itempickups" id="cargoFloor" onClick="getCargoFloor();">Cargo<br><span class="itemgrabtag">(On Floor)</span></button>

               <button class="itempickups" id="cargoHuman" onClick="getCargoHuman();">Cargo<br><span class="itemgrabtag">(Human Load)</span></button>

               <button class="itempickups" id="panelFloor" onClick="getPanelFloor();">Hatch Panel<br><span class="itemgrabtag">(On Floor)</span></button>

               <button class="itempickups" id="panelHuman" onClick="getPanelHuman();">Hatch Panel<br><span class="itemgrabtag">(Human Load)</span></button>

               <button class="cancel" onClick="dropItem();">Drop Item or<br>Cross Mid</button>

            </div>

         </div>

      </div>











      <div id="modetable">

         <div id="moderow">

            <div id="modepreload">

               <button class="modebtns" id="preloadmodebtn" onClick="updateMode(0);">Preload</button>

            </div>



            <div id="modesandstorm">

               <button class="modebtns" id="sandstormmodebtn" onClick="updateMode(1);">Sandstorm</button>

            </div>



            <div id="modeteleop">

               <button class="modebtns" id="teleopmodebtn" onClick="updateMode(2);">Tele-Operated</button>

            </div>

            
            
            <div id="modeerrors">

               <button class="modebtns" id="errorsmodebtn" onClick="updateMode(3);">Errors</button>

            </div>



            <div id="modemisc">

               <button class="modebtns" id="miscmodebtn" onClick="updateMode(4);">Miscellaneous</button>

            </div>


         </div>

      </div>



   </body>

</html>