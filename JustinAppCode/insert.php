<?php
$xmldata = simplexml_load_file("https://www.thebluealliance.com/event/2019onosh/feed") or die("Failed to load");

foreach($xmldata->children() as $empl) {         
 echo $empl->title . ", ";     
 echo $empl->link . ", ";     
} 
?>