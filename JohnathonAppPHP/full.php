<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
$db_HOST = "localhost";
$db_USER = "jslighth_1";
$db_PASS = "1234";
$db_NAME = "jslighth_frctest";
$connect = mysqli_connect($db_HOST, $db_USER, $db_PASS, $db_NAME);

$id = strip_tags($_GET['id']);
$sql = "SELECT * FROM matches WHERE id = '$id' LIMIT 1";

$query = mysqli_query($connect, $sql);
$row = mysqli_fetch_row($query);
?>
<html>

<!--action="post.php" method="post"-->
   <head>
      <link rel="stylesheet" type="text/css" href="newstyle.css">
      <script src="javascript.js"></script>
      <title>7558 Scouting App - 2019 Season</title>
   </head>
   <body>
      <div id="modelbltop" class="modelbl"><p>PRELOAD PERIOD</p></div>
      <div id="teaminfo">
         Team Number: <span id="teamnumber"><?php echo $row[4]; ?></span><br>
         Match Number: <span id="matchnumber"><?php echo $row[3]; ?></span><br>
      </div>

      <div id="stations">
         <div id="stationrow">
         <?php
		 if (strpos($row[36], 'R') !== false){
		 echo '<script type="text/javascript">',
     	'changeStation(0, '
		;
		 echo $row[36][1]; echo ');
    	 </script>'
		 ;
		 }else{
		echo '<script type="text/javascript">',
     	'changeStation(1, '
		;
		 echo $row[36][1]; echo ');
    	 </script>'
		 ;
		 }
		 
		 ?>
            <button class="stationbutton" id="stationR1" >Station<br>Red 1</button>
            <button class="stationbutton" id="stationR2" >Station<br>Red 2</button>
            <button class="stationbutton" id="stationR3" >Station<br>Red 3</button>

            <button id="flipsides" onClick="changeButtonPlacement();">Flip Sides</button>

            <button class="stationbutton" id="stationB1" >Station<br>Blue 1</button>
            <button class="stationbutton" id="stationB2" >Station<br>Blue 2</button>
            <button class="stationbutton" id="stationB3" >Station<br>Blue 3</button>
         </div>
      </div>

      <div id="playfield">
         <div id="playfieldrow">

            <div id="habpreload">
               <p class="btnheader">Preload Setting</p>
               <button class="hablevels" id="habLevel01" onClick="leaveHAB(1, 0);">Started<br>on HAB Level 1<br><span class="habsandstormtag">(During Preload)</span></button>
               <button class="hablevels" id="habLevel02" onClick="leaveHAB(2, 0);">Started<br>on HAB Level 2<br><span class="habsandstormtag">(During Preload)</span></button>
               <button class="hablevels" id="habLevel03" onClick="leaveHAB(3, 0);">Started<br>on HAB Level 3<br><span class="habsandstormtag">(During Preload)</span></button>
               <button class="cancel" onClick="leaveHAB(-1, 0);">Cancel HAB Selection</button>
            </div>

            <div id="habstart">
               <p class="btnheader">HAB Activity</p>
               <button class="hablevels" id="habLevel10" onClick="leaveHAB(0, 1);">Stayed<br>on HAB<br><span class="habsandstormtag">(During Sandstorm)</span></button>
               <button class="hablevels" id="habLevel11" onClick="leaveHAB(1, 1);">Left HAB<br>Level 1<br><span class="habsandstormtag">(During Sandtorm)</span></button>
               <button class="hablevels" id="habLevel12" onClick="leaveHAB(2, 1);">Left HAB<br>Level 2<br><span class="habsandstormtag">(During Sandtorm)</span></button>
               <button class="hablevels" id="habLevel13" onClick="leaveHAB(3, 1);">Left HAB<br>Level 3<br><span class="habsandstormtag">(During Sandtorm)</span></button>
               <button class="cancel" onClick="leaveHAB(-1, 1);">Cancel HAB Selection</button>
            </div>

            <div id="habend">
               <p class="btnheader">HAB Activity</p>
               <button class="hablevels" id="habLevel20" onClick="leaveHAB(0, 2);">Remained<br>on Field<br><span class="habsandstormtag">(During Endgame)</span></button>
               <button class="hablevels" id="habLevel21" onClick="leaveHAB(1, 2);">Entered HAB<br>Level 1<br><span class="habsandstormtag">(During Endgame)</span></button>
               <button class="hablevels" id="habLevel22" onClick="leaveHAB(2, 2);">Entered HAB<br>Level 2<br><span class="habsandstormtag">(During Endgame)</span></button>
               <button class="hablevels" id="habLevel23" onClick="leaveHAB(3, 2);">Entered HAB<br>Level 3<br><span class="habsandstormtag">(During Endgame)</span></button>
               <button class="cancel" onClick="leaveHAB(-1, 2);">Cancel HAB Selection</button>
            </div>

            <div id="gamearea">
               <div id="gamemap"></div>

               <button id="robotscorespace" onClick="preloadRobot();">Your Robot<br>is Holding:<br><br>Nothing</button>

               <<div id="scoringrocket1">
                  <button class="rocketleveldisplay" id="rocketleveldisplay1" onClick="changeRocket();">Level 1</button>

                  <!--Top Rocket Level 1-->
                  <button class="scorespaces" id="scorespace0" onClick="score(0);">Cargo: &#x2716<br>Panel: &#x2716</button>
                  <button class="scorespaces" id="scorespace1" onClick="score(1);">Cargo: &#x2716<br>Panel: &#x2716</button>
                  <!--Top Rocket Level 2-->
                  <button class="scorespaces" id="scorespace0" onClick="score(2);">Cargo: &#x2716<br>Panel: &#x2716</button>
                  <button class="scorespaces" id="scorespace1" onClick="score(3);">Cargo: &#x2716<br>Panel: &#x2716</button>
                  <!--Top Rocket Level 3-->
                  <button class="scorespaces" id="scorespace0" onClick="score(4);">Cargo: &#x2716<br>Panel: &#x2716</button>
                  <button class="scorespaces" id="scorespace1" onClick="score(5);">Cargo: &#x2716<br>Panel: &#x2716</button>
               </div>
               <div id="scoringrocket2">
                  <button class="rocketleveldisplay" id="rocketleveldisplay2" onClick="changeRocket();">Level 1</button>

                  <!--Bottom Rocket Level 1-->
                  <button class="scorespaces" id="scorespace6" onClick="score(6);">Cargo: &#x2716<br>Panel: &#x2716</button>
                  <button class="scorespaces" id="scorespace7" onClick="score(7);">Cargo: &#x2716<br>Panel: &#x2716</button>
                  <!--Bottom Rocket Level 2-->
                  <button class="scorespaces" id="scorespace8" onClick="score(8);">Cargo: &#x2716<br>Panel: &#x2716</button>
                  <button class="scorespaces" id="scorespace9" onClick="score(9);">Cargo: &#x2716<br>Panel: &#x2716</button>
                  <!--Bottom Rocket Level 3-->
                  <button class="scorespaces" id="scorespace10" onClick="score(10);">Cargo: &#x2716<br>Panel: &#x2716</button>
                  <button class="scorespaces" id="scorespace11" onClick="score(11);">Cargo: &#x2716<br>Panel: &#x2716</button>
               </div>
               
               <div id="scoringship">
                  <button class="scorespaces" id="scorespace12" onClick="score(12);">Cargo: &#x2714<br>Panel: &#x2716</button>
                  <button class="scorespaces" id="scorespace13" onClick="score(13);">Cargo: &#x2714<br>Panel: &#x2716</button>
                  <button class="scorespaces" id="scorespace14" onClick="score(14);">Cargo: &#x2716<br>Panel: &#x2716</button>
                  <button class="scorespaces" id="scorespace15" onClick="score(15);">Cargo: &#x2716<br>Panel: &#x2716</button>
                  <button class="scorespaces" id="scorespace16" onClick="score(16);">Cargo: &#x2716<br>Panel: &#x2716</button>
                  <button class="scorespaces" id="scorespace17" onClick="score(17);">Cargo: &#x2716<br>Panel: &#x2716</button>
                  <button class="scorespaces" id="scorespace18" onClick="score(18);">Cargo: &#x2716<br>Panel: &#x2716</button>
                  <button class="scorespaces" id="scorespace19" onClick="score(19);">Cargo: &#x2716<br>Panel: &#x2716</button>
               </div>
               <div id="miscellaneous">
                  <div id="miscellaneousrow">
                     <div id="miscellaneousleft">
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
                     </div>
                     <div id="miscellaneousright">
                        <form id="form" action="post.php" method="post">

                           <!--Top Rocket-->
                           <input type="hidden" id="scorespacedata0" name="TopRocketCloseLevel1" value="No_No_Not Scored_Not Scored_Normal">
                           <input type="hidden" id="scorespacedata1" name="TopRocketFarLevel1" value="No_No_Not Scored_Not Scored_Normal">
                           <input type="hidden" id="scorespacedata2" name="TopRocketClosetLevel2" value="No_No_Not Scored_Not Scored_Normal">
                           <input type="hidden" id="scorespacedata3" name="TopRocketFarLevel2" value="No_No_Not Scored_Not Scored_Normal">
                           <input type="hidden" id="scorespacedata4" name="TopRocketCloseLevel3" value="No_No_Not Scored_Not Scored_Normal">
                           <input type="hidden" id="scorespacedata5" name="TopRocketFarLeve31" value="No_No_Not Scored_Not Scored_Normal">

                           <!--Bottom Rocket-->
                           <input type="hidden" id="scorespacedata6" name="BottomRocketCloseLevel1" value="No_No_Not Scored_Not Scored_Normal">
                           <input type="hidden" id="scorespacedata7" name="BottomRocketFarLevel1" value="No_No_Not Scored_Not Scored_Normal">
                           <input type="hidden" id="scorespacedata8" name="BottomRocketCloseLevel2" value="No_No_Not Scored_Not Scored_Normal">
                           <input type="hidden" id="scorespacedata9" name="BottomRocketFarLevel2" value="No_No_Not Scored_Not Scored_Normal">
                           <input type="hidden" id="scorespacedata10" name="BottomRocketCloseLevel3" value="No_No_Not Scored_Not Scored_Normal">
                           <input type="hidden" id="scorespacedata11" name="BottomRocketFarLevel3" value="No_No_Not Scored_Not Scored_Normal">

                           <!--Cargo Ship-->
                           <input type="hidden" id="scorespacedata12" name="ShipFrontUpper" value="No_No_Not Scored_Not Scored_Normal">
                           <input type="hidden" id="scorespacedata13" name="ShipFrontLower" value="No_No_Not Scored_Not Scored_Normal">
                           <input type="hidden" id="scorespacedata14" name="ShipTopClose" value="No_No_Not Scored_Not Scored_Normal">
                           <input type="hidden" id="scorespacedata15" name="ShipBottomClose" value="No_No_Not Scored_Not Scored_Normal">
                           <input type="hidden" id="scorespacedata16" name="ShipTopMedium" value="No_No_Not Scored_Not Scored_Normal">
                           <input type="hidden" id="scorespacedata17" name="ShipBottomMedium" value="No_No_Not Scored_Not Scored_Normal">
                           <input type="hidden" id="scorespacedata18" name="ShipTopFar" value="No_No_Not Scored_Not Scored_Normal">
                           <input type="hidden" id="scorespacedata19" name="ShipBottomFar" value="No_No_Not Scored_Not Scored_Normal">

                           <!--Other Information-->
                           <input type="hidden" id="hableveldatapreload" name="HABPositionPreload" value="Not Recorded">
                           <input type="hidden" id="hableveldatastart" name="HABPositionStart" value="Not Recorded">
                           <input type="hidden" id="hableveldataend" name="HABPositionEnd" value="Not Recorded">
                           <input type="hidden" id="grabdatacargohuman" name="CargoGrabbedFromHuman" value="0">
                           <input type="hidden" id="grabdatacargofloor" name="CargoGrabbedFromFloor" value="0">
                           <input type="hidden" id="grabdatapanelhuman" name="PanelGrabbedFromHuman" value="0">
                           <input type="hidden" id="grabdatapanelfloor" name="PanelGrabbedFromFloor" value="0">
                           <input type="hidden" id="miscdatapreloadeditem" name="RobotPreloadedItem" value="Nothing">
                           <input type="hidden" id="miscdatadefenselevel" name="DefenseLevel" value="0">
                           <input type="hidden" id="miscdatarobotscarried" name="RobotsCarriedAtEnd" value="0">
                           <input type="hidden" id="miscdatawascarried" name="WasCarriedAtEnd" value="false">


                           <!--Match Info-->
                           <input type="hidden" id="matchdatateamnumber" name="TeamNumber" value="000">
                           <input type="hidden" id="matchdatacompetition" name="Competition" value="Unknown">
                           <input type="hidden" id="matchdatamatchnumber" name="MatchNumber" value="1">
                           <input type="hidden" id="matchdatarobotstation" name="RobotStation" value="R1">




                           <input type="submit" value="Submit" onClick="scoreForm();">
                        </form>
                     </div>
                  </div>
               </div>
            </div>


            <div id="pickuppreload">
               <p class="btnheader">Item Pickup</p>
               <button class="itempickups" id="cargoPreload" onClick="getCargoPreload();">Cargo</button>
               <button class="itempickups" id="panelPreload" onClick="getPanelPreload();">Hatch Panel</button>
               <button class="cancel" onClick="dropItem();">Drop Item</button>
            </div>

            <div id="pickup">
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

            <div id="modemisc">
               <button class="modebtns" id="miscmodebtn" onClick="updateMode(3);">Miscellaneous</button>
            </div>
         </div>
      </div>

      <!--<div id="modelblbtm" class="modelbl"><p>PRELOAD PERIOD</p></div>-->

   </body>
   <div id="localSubmissions"></div>
</html>