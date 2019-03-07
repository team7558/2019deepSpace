function scoreForm() {
	updateFormData();
}

function updateFormData() {
    thisData = document.getElementById("datateamname");
    thisData.value = document.getElementById("inputteamname").value;
        
    thisData = document.getElementById("datateamnumber");
    thisData.value = document.getElementById("inputteamnumber").value;
    
    //Drivetrain
    thisData = document.getElementById("datadrivetraintype");
    var drivetrain = document.getElementsByName("drivetrain");
    for(var i = 0; i < drivetrain.length; i++){
        if(drivetrain[i].checked){
            thisData.value = drivetrain[i].value;
        }
    }
    
    thisData = document.getElementById("datawheels");
    thisData.value = document.getElementById("wheelcount").value;
    
    thisData = document.getElementById("datamotors");
    thisData.value = document.getElementById("motorcount").value;
    
    //HAB Start
    thisData = document.getElementById("datahabstart");
    var sandstormlevel = document.getElementsByName("sandstormlevel");
    for(var i = 0; i < sandstormlevel.length; i++){
        if(sandstormlevel[i].checked){
            thisData.value = sandstormlevel[i].value;
        }
    }
    
    thisData = document.getElementById("datacargosandstorm");
    thisData.value = document.getElementById("cargosandstorm").value;
    
    thisData = document.getElementById("datapanelsandstorm");
    thisData.value = document.getElementById("panelsandstorm").value;
    
    //HAB End
    thisData = document.getElementById("datahabstart");
    var sandstormlevel = document.getElementsByName("sandstormlevel");
    for(var i = 0; i < sandstormlevel.length; i++){
        if(sandstormlevel[i].checked){
            thisData.value = sandstormlevel[i].value;
        }
    }
    
    
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
    thisData.value = document.getElementById("lifttype").value;
    
    thisData = document.getElementById("datarookie");
    thisData.value = document.getElementById("rookieteam").checked;
    
    thisData = document.getElementById("datacycletime");
    thisData.value = document.getElementById("cycletimeseconds").value;

    thisData = document.getElementById("datarobotweight");
    thisData.value = document.getElementById("robotweightpounds").value;
}