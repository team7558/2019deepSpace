<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
$db_HOST = "localhost";
$db_USER = "team7558_s";
$db_PASS = "Mr.Roboto11235";
$db_NAME = "team7558_scouting";
if(isset($_SESSION['username'])){
$connect = mysqli_connect($db_HOST, $db_USER, $db_PASS, $db_NAME);
$cid = $_SESSION['cid'];
$MatchNumber = strip_tags($_GET['MatchNumber']);

$real = true;

//$sortType = htmlspecialchars($_GET["sortType"]); // Should be a column name
//$sortOrder = htmlspecialchars($_GET["sortOrder"]); // Should be ASC or DSC
$sql = "SELECT * FROM `matches` WHERE `MatchNumber` = '$MatchNumber' AND `Competition` = '$cid' ORDER BY RobotStation";
$search_result = mysqli_query($connect, $sql);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="css/databasestyle.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Match Results @ Competition <?php echo $cid; ?></title>
</head>



<!--make script that will calculate scopre per game-->
<script type="text/javascript">
    
</script>





<button id="findmatchbutton" onclick="if(document.getElementById('inputmatchnumber').value > 0) window.location.href = 'https://www.scouting.team7558.com/match.php?MatchNumber='+document.getElementById('inputmatchnumber').value;"><span id="findmatch">Find Match<input type="number" id="inputmatchnumber" min=0 max=200 value=0></span></button>

<a href="https://www.scouting.team7558.com/scoutinghome.php"><button id="gohome">Go Home</button></a>

<body>
<h1 class="matchdataheader">Results From Match <?php echo $MatchNumber; ?> @ Competition ID: <?php echo $cid; ?></h1>
<table class="matchdatatable">
<tr>
    <th>Station</th>
    <th>Team Number</th>
    <th>HAB Start</th>
    <th>Sandstorm Cargo</th>
    <th>Sandstorm Panels</th>
    <th>Cargo From Floor</th>
    <th>Cargo From Human</th>
    <th>Panel From Floor</th>
    <th>Panel From Human</th>
    <th>DefenseLevel</th>
    <th>Ship Panels</th>
    <th>Ship Cargo</th>
    <th>Rocket Panels</th>
    <th>Rocket Cargo</th>
    <th>HAB End</th>
    <th>Robots Carried</th>
    <th>Comments</th>
    <th>Scout Name</th>
    <th>(Prospective) Score</th>
  </tr>
<?php while($row = mysqli_fetch_array($search_result)):?>
  <tr>
      
      
      
    <td id="station<?php echo $row['ID'];?>"><?php echo $row['RobotStation']; ?></td>
    
    <!--Adjust defense colours-->
    <script type="text/javascript">
        var station = "<?php echo $row['RobotStation']?>";
        var x = document.getElementById("station<?php echo $row['ID'];?>");
        
        if(station=="B1" || station=="B2" || station=="B3") x.style.backgroundColor="#1752b2";
        else x.style.backgroundColor="#ce3418";
    </script>
    
    
    
    <?php 
        $real = true;
        if($row['Updated']=='0') {
            $newsql = "SELECT * FROM `matchAverages` WHERE `TeamNumber` = '$row[TeamNumber]' AND `Competition` = '$cid'"; //Don't worry about the lack of quotes on TeamNumber it works
            $newsearch_result = mysqli_query($connect, $newsql);
            $row = mysqli_fetch_array($newsearch_result);
            $real = false;
        }
    ?>  
    
    <td class="defenseitems<?php echo $row['ID'];?>"><a href="/team.php?TeamNumber=<?php echo $row['TeamNumber']; ?>"><?php echo $row['TeamNumber']; ?> </a></td>
    
    <td class="habitems habitems<?php echo $row['ID'];?>"><?php if($real) echo $row['HABSandstormScore']; else echo number_format($row['HABSandstormScore'],2); ?></td>
    
    <td class="cargoitems cargoitems<?php echo $row['ID'];?>"><?php if($real) echo $row['SandstormCargo']; else echo number_format($row['SandstormCargo'],2); ?></td>
    
    <td class="panelitems panelitems<?php echo $row['ID'];?>"><?php if($real) echo $row['SandstormPanels']; else echo number_format($row['SandstormPanels'],2); ?></td>
    
    <td class="cargoitems cargoitems<?php echo $row['ID'];?>"><?php if($real) echo $row['CargoFromFloor']; else echo number_format($row['CargoFromFloor'],2); ?></td>
    
    <td class="cargoitems cargoitems<?php echo $row['ID'];?>"><?php if($real) echo $row['CargoFromHuman']; else echo number_format($row['CargoFromHuman'],2); ?></td>
    
    <td class="panelitems panelitems<?php echo $row['ID'];?>"><?php if($real) echo $row['PanelFromFloor']; else echo number_format($row['PanelFromFloor'],2); ?></td>
    
    <td class="panelitems panelitems<?php echo $row['ID'];?>"><?php if($real) echo $row['PanelFromHuman']; else echo number_format($row['PanelFromHuman'],2); ?></td>
    
    <td class="defenseitems<?php echo $row['ID'];?>"><?php if($real) echo $row['DefenseLevel']; else echo number_format($row['DefenseLevel'],2); ?></td>
    
    
        
    <!--Adjust defense colours-->
    <script type="text/javascript">
        var defense = "<?php echo $row['DefenseLevel']?>";
        var x = document.getElementsByClassName("defenseitems<?php echo $row['ID'];?>");
        
        for(i = 0; i < x.length; i++) {
            if(defense >= 0.5 && defense < 1.5) x[i].style.backgroundColor = "#ff8770";
            else if(defense >= 1.5) x[i].style.backgroundColor = "#ed694b";
        }
    </script>
    
    
    
    <td class="panelitems panelitems<?php echo $row['ID'];?>"><?php if($real) echo $row['ShipPanels']; else echo number_format($row['ShipPanels'],2); ?></td>
    
    <td class="cargoitems cargoitems<?php echo $row['ID'];?>"><?php if($real) echo $row['ShipCargo']; else echo number_format($row['ShipCargo'],2); ?></td>
    
    <td class="panelitems panelitems<?php echo $row['ID'];?>">A<?php if($real) echo $row['HighRocketPanels']; else echo number_format($row['HighRocketPanels'],2); ?><br>B<?php if($real) echo $row['MidRocketPanels']; else echo number_format($row['MidRocketPanels'],2); ?><br>C<?php if($real) echo $row['LowRocketPanels']; else echo number_format($row['LowRocketPanels'],2); ?></td>
    
    <td class="cargoitems cargoitems<?php echo $row['ID'];?>">A<?php if($real) echo $row['HighRocketCargo']; else echo number_format($row['HighRocketCargo'],2); ?><br>B<?php if($real) echo $row['MidRocketCargo']; else echo number_format($row['MidRocketCargo'],2); ?><br>C<?php if($real) echo $row['LowRocketCargo']; else echo number_format($row['LowRocketCargo'],2); ?></td>
    
    <td class="habitems habitems<?php echo $row['ID'];?>"><?php if($real) echo $row['HABEndScore']; else echo number_format($row['HABEndScore'],2); ?></td>
    
    <td class="habitems habitems<?php echo $row['ID'];?>"><?php if($real) echo $row['RobotsCarried']; else echo number_format($row['RobotsCarried'],2); ?></td>
    
    <td class="miscitems<?php echo $row['ID'];?>"><?php if($real) echo $row['Comments']; ?></td>
    <td class="miscitems<?php echo $row['ID'];?>"><?php if($real) echo $row['ScoutName']; ?></td>
    
    
    
    
    
    <td id="matchpoints<?php echo $row['ID'];?>">
        <script type="text/javascript">
            function getScore() {
                var score = 0;
                
                var habStart = <?php echo $row['HABSandstormScore']; ?>;
                var cargo = <?php echo $row['SandstormCargo']; ?>+<?php echo $row['ShipCargo']; ?>+<?php echo $row['LowRocketCargo']; ?>+<?php echo $row['MidRocketCargo']; ?>+<?php echo $row['HighRocketCargo']; ?>;
                var panels = <?php echo $row['SandstormPanels']; ?>+<?php echo $row['ShipPanels']; ?>+<?php echo $row['LowRocketPanels']; ?>+<?php echo $row['MidRocketPanels']; ?>+<?php echo $row['HighRocketPanels']; ?>;
                var habEnd = <?php echo $row['HABEndScore']; ?>;
                
                score+=Math.ceil(habStart)*3;
                score+=Math.ceil(cargo)*3;
                score+=Math.ceil(panels)*2;
                score+=Math.ceil(habEnd)*3;
                if(Math.ceil(habEnd)==3)score+=3;
                
                document.getElementById("matchpoints<?php echo $row['ID'];?>").innerHTML = Math.ceil(score)+"pts";
            }
            getScore();
        </script>
        
    <!--Check if match has occurred yet-->
    <script type="text/javascript">
        var updated = "<?php echo $real?>";
        var x = document.getElementsByClassName("defenseitems<?php echo $row['ID'];?>");
        var h = document.getElementsByClassName("habitems<?php echo $row['ID'];?>");
        var c = document.getElementsByClassName("cargoitems<?php echo $row['ID'];?>");
        var p = document.getElementsByClassName("panelitems<?php echo $row['ID'];?>");
        var m = document.getElementsByClassName("miscitems<?php echo $row['ID'];?>");
        
        if(updated==false) {
        
            for(i = 0; i < x.length; i++) {
                x[i].style.backgroundColor = "white";
                x[i].style.fontStyle = "italic";
            }
            for(i = 0; i < h.length; i++) {
                h[i].style.backgroundColor = "white";
                h[i].style.fontStyle = "italic";
            }
            for(i = 0; i < c.length; i++) {
                c[i].style.backgroundColor = "white";
                c[i].style.fontStyle = "italic";
            }
            for(i = 0; i < p.length; i++) {
                p[i].style.backgroundColor = "white";
                p[i].style.fontStyle = "italic";
            }
            for(i = 0; i < m.length; i++) {
                m[i].style.backgroundColor = "white";
                m[i].style.fontStyle = "italic";
            }
            
            
        }
    </script>
    </td>
  </tr>

<?php endwhile; ?>
</table>
</body>
</html>
