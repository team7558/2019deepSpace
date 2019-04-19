function fixText(text) {
    var curr = text.replace(/'/g,"");
    curr = curr.replace(/\"/g,"");
    curr = curr.replace(/`/g,"");
    return curr;
}

function scoreForm() {
	updateFormData();
}

function updateFormData() {
    thisData = document.getElementById("datateamname");
    thisData.value = fixText(document.getElementById("inputteamname").value);
        
    thisData = document.getElementById("datateamnumber");
    thisData.value = document.getElementById("inputteamnumber").value;
    
    thisData = document.getElementById("datageneralcomments");
    thisData.value = fixText(document.getElementById("generalcommentbox").value);
    
    thisData = document.getElementById("datadrivetraintype");
    thisData.value = fixText(document.getElementById("drivetraintype").value);
    
    thisData = document.getElementById("datawheels");
    thisData.value = fixText(document.getElementById("wheeltype").value);
    
    thisData = document.getElementById("datamotors");
    thisData.value = document.getElementById("drivemotorcount").value;
    
    
    //HAB Start
    thisData = document.getElementById("datahabstart");
    var sandstormlevel = document.getElementsByName("sandstormlevel");
    for(var i = 0; i < sandstormlevel.length; i++){
        if(sandstormlevel[i].checked){
            thisData.value = sandstormlevel[i].value;
        }
    }
    
    //HAB Movement
    thisData = document.getElementById("datasandstormmovement");
    if(document.getElementById("sandstormmovestay").checked) thisData.value+="Does Not Move";
    if(document.getElementById("sandstormmoveauto").checked) {
        if(thisData.value.length>0) thisData.value += " AND ";
        thisData.value+="Autonomous";
    }
    if(document.getElementById("sandstormmovemanual").checked) {
        if(thisData.value.length>0) thisData.value += " AND ";
        thisData.value+="Manual Control";
    }
    
    
    
    
    thisData = document.getElementById("datacargosandstorm");
    thisData.value = document.getElementById("cargosandstorm").value;
    
    thisData = document.getElementById("datapanelsandstorm");
    thisData.value = document.getElementById("panelsandstorm").value;
    
    
    //Hatch
    thisData = document.getElementById("datahatchground");
    thisData.value = document.getElementById("hatchintakeground").checked;
    thisData = document.getElementById("datahatchhuman");
    thisData.value = document.getElementById("hatchintakehuman").checked;
    thisData = document.getElementById("datahatchship");
    thisData.value = document.getElementById("hatchscoringship").checked;
    thisData = document.getElementById("datahatchlow");
    thisData.value = document.getElementById("hatchscoringlow").checked;
    thisData = document.getElementById("datahatchmid");
    thisData.value = document.getElementById("hatchscoringmid").checked;
    thisData = document.getElementById("datahatchhigh");
    thisData.value = document.getElementById("hatchscoringhigh").checked;
    
    //Cargo
    thisData = document.getElementById("datacargoground");
    thisData.value = document.getElementById("cargointakeground").checked;
    thisData = document.getElementById("datacargohuman");
    thisData.value = document.getElementById("cargointakehuman").checked;
    thisData = document.getElementById("datacargoship");
    thisData.value = document.getElementById("cargoscoringship").checked;
    thisData = document.getElementById("datacargolow");
    thisData.value = document.getElementById("cargoscoringlow").checked;
    thisData = document.getElementById("datacargomid");
    thisData.value = document.getElementById("cargoscoringmid").checked;
    thisData = document.getElementById("datacargohigh");
    thisData.value = document.getElementById("cargoscoringhigh").checked;
    
    //HAB End
    thisData = document.getElementById("datahabend");
    var endgamelevel = document.getElementsByName("endgamelevel");
    for(var i = 0; i < endgamelevel.length; i++){
        if(endgamelevel[i].checked){
            thisData.value = endgamelevel[i].value;
        }
    }
    
    thisData = document.getElementById("datarobotscarried");
    thisData.value = document.getElementById("robotscarried").value;
    
    thisData = document.getElementById("datalifttype");
    thisData.value = fixText(document.getElementById("lifttype").value);
    
    thisData = document.getElementById("datarookie");
    thisData.value = document.getElementById("rookieteam").checked;
    
    thisData = document.getElementById("datarobotweight");
    thisData.value = fixText(document.getElementById("robotweightpounds").value);
}