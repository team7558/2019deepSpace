var gameMode = "sandstorm", habLevelStart = 0, habLevelEnd = 0, holdingItem = false, itemType = "cargo", rocketLevel = 1,
cargoGrabbedHuman = 0, cargoGrabbedFloor = 0, panelGrabbedHuman = 0, panelGrabbedFloor = 0;

var scoreSheet = [ //Cargo, panel, cargoDuringSandstorm, panelDuringSandstorm - index is listed below
	//will be no, yes, or try (only temporary)
	["no", "no", false, false],
	["no", "no", false, false],
	["no", "no", false, false],
	["no", "no", false, false],
	["no", "no", false, false],
	["no", "no", false, false],
	["no", "no", false, false],
	["no", "no", false, false],
	["no", "no", false, false],
	["no", "no", false, false],
	["no", "no", false, false],
	["no", "no", false, false],
	["no", "no", false, false],
	["no", "no", false, false],
	["no", "no", false, false],
	["no", "no", false, false],
	["no", "no", false, false],
	["no", "no", false, false],
	["no", "no", false, false],
	["no", "no", false, false],
	["no", "no", false, false],
	["no", "no", false, false]
];

var normCol = "#E2E2E2", stopCol = "#C2C2C2", checkCol = "#66FF46", tryCol = "#FFCA32", sandstormCol = "#D57217", teleopCol = "#3881DC", miscCol = "#D7271A", redCol = "#F94F42", blueCol = "#1281F0";

//Run a few methods at the very beginning of the game



function updateGameStats() {
	document.getElementById("panelsfromfloor").innerHTML = panelGrabbedFloor + "<br>";
	document.getElementById("panelsfromhuman").innerHTML = panelGrabbedHuman + "<br>";
	document.getElementById("cargofromfloor").innerHTML = cargoGrabbedFloor + "<br>";
	document.getElementById("cargofromhuman").innerHTML = cargoGrabbedHuman + "<br>";
	document.getElementById("holdingitem").innerHTML = itemType + "<br>";
	document.getElementById("gamemode").innerHTML = gameMode + "<br>";
}

function updateMode(mode) {
	if(mode==0) gameMode = "sandstorm";
	else if(mode==1) gameMode = "teleop";
	else gameMode = "misc";

	var x = document.getElementsByClassName("modebtns");
	for(i = 0; i < x.length; i++) {
		var button = x[i];
		button.style.background = stopCol;
	 	button.style.cursor = "pointer";
	 	button.style.fontSize = "20px";

	 	if(gameMode == "sandstorm" && i == 0) {
	 		button.style.background = sandstormCol;
		 	button.style.cursor = "default";
		 	button.style.fontSize = "24px";
	 	} else if(gameMode == "teleop" && i == 1) {
	 		button.style.background = teleopCol;
	 		button.style.cursor = "default";
	 		button.style.fontSize = "24px";
	 	} else if(gameMode == "misc" && i == 2) {
	 		button.style.background = miscCol;
	 		button.style.cursor = "default";
	 		button.style.fontSize = "24px";
	 	}
	}

	if(gameMode == "sandstorm") {

		document.getElementById("habstart").style.display = "table-cell";
		document.getElementById("habend").style.display = "none";
		document.getElementById("pickup").style.display = "table-cell";
		document.getElementById("scoringrocket1").style.display = "block";
		document.getElementById("scoringrocket2").style.display = "block";
		document.getElementById("scoringship").style.display = "block";


		var y = document.getElementsByClassName("modelbl");
		for(i = 0; i < y.length; i++) {
			y[i].innerHTML = "SANDSTORM PERIOD";
			y[i].style.fontSize = "48px";
			y[i].style.fontWeight = "600";
			y[i].style.textAlign = "center";
			y[i].style.color = "white";
			y[i].style.backgroundColor = sandstormCol;
		}

	} else if(gameMode == "teleop") {
		document.getElementById("habstart").style.display = "none";
		document.getElementById("habend").style.display = "table-cell";
		document.getElementById("pickup").style.display = "table-cell";
		document.getElementById("scoringrocket1").style.display = "block";
		document.getElementById("scoringrocket2").style.display = "block";
		document.getElementById("scoringship").style.display = "block";

		var y = document.getElementsByClassName("modelbl");
		for(i = 0; i < y.length; i++) {
			y[i].innerHTML = "TELE-OPERATED PERIOD";
			y[i].style.fontSize = "48px";
			y[i].style.fontWeight = "600";
			y[i].style.textAlign = "center";
			y[i].style.color = "white";
			y[i].style.backgroundColor = teleopCol;
		}
	} else {
		document.getElementById("habstart").style.display = "none";
		document.getElementById("habend").style.display = "none";
		document.getElementById("pickup").style.display = "none";
		document.getElementById("scoringrocket1").style.display = "none";
		document.getElementById("scoringrocket2").style.display = "none";
		document.getElementById("scoringship").style.display = "none";
	}

	updateGameStats();
}



function updateButtonLook() {
	var x = document.getElementsByClassName("scorespaces");

	//Check the rocket level
	if(rocketLevel == 1) {
		x[0].style.display = "block";
		x[1].style.display = "block";
		x[2].style.display = "none";
		x[3].style.display = "none";
		x[4].style.display = "none";
		x[5].style.display = "none";
		x[6].style.display = "block";
		x[7].style.display = "block";
		x[8].style.display = "none";
		x[9].style.display = "none";
		x[10].style.display = "none";
		x[11].style.display = "none";
	} else if(rocketLevel == 2) {
		x[0].style.display = "none";
		x[1].style.display = "none";
		x[2].style.display = "block";
		x[3].style.display = "block";
		x[4].style.display = "none";
		x[5].style.display = "none";
		x[6].style.display = "none";
		x[7].style.display = "none";
		x[8].style.display = "block";
		x[9].style.display = "block";
		x[10].style.display = "none";
		x[11].style.display = "none";
	} else {
		x[0].style.display = "none";
		x[1].style.display = "none";
		x[2].style.display = "none";
		x[3].style.display = "none";
		x[4].style.display = "block";
		x[5].style.display = "block";
		x[6].style.display = "none";
		x[7].style.display = "none";
		x[8].style.display = "none";
		x[9].style.display = "none";
		x[10].style.display = "block";
		x[11].style.display = "block";
	}

	for(i = 0; i < x.length; i++) {
		var hasCargo = scoreSheet[i][0];
		var hasPanel = scoreSheet[i][1];
		//alert("hi");
		if(!holdingItem) {
			//Check - &#x2714
			//Cross - &#x2716
			makeButtonStop(x[i]);
			//Check if they were just attempted
			if(hasCargo == "try") {
				hasCargo = "no";
				scoreSheet[i][0] = "no";
			}
			if(hasPanel == "try") {
				hasPanel = "no";
				scoreSheet[i][1] = "no";
			}

			//Indicate if scored
			if(hasCargo == "no" && hasPanel == "no") x[i].innerHTML = "Cargo: &#x2716<br>Panel: &#x2716";
			else if(hasCargo == "no" && hasPanel == "yes") x[i].innerHTML = "Cargo: &#x2716<br>Panel: &#x2714";
			else if(hasCargo == "yes" && hasPanel == "no") x[i].innerHTML = "Cargo: &#x2714<br>Panel: &#x2716";
			else x[i].innerHTML = "Cargo: &#x2714<br>Panel: &#x2714";
		} else {
			makeButtonNorm(x[i]);
			if(itemType == "cargo") {
				if(hasCargo == "no") {
					x[i].innerHTML = "Empty";
					x[i].style.background = normCol;
				} else if(hasCargo == "try") {
					x[i].innerHTML = "Attempted";
					x[i].style.background = tryCol;
				} else {
					x[i].innerHTML = "Scored";
					x[i].style.background = checkCol;
				}
			} else {
				if(hasPanel == "no") {
					x[i].innerHTML = "Empty";
					x[i].style.background = normCol;
				} else if(hasPanel == "try") {
					x[i].innerHTML = "Attempted";
					x[i].style.background = tryCol;
				} else {
					x[i].innerHTML = "Scored";
					x[i].style.background = checkCol;
				}
			}
		}
	}


	var y = document.getElementsByClassName("rocketleveldisplay");
	for(i = 0; i < y.length; i++) {
		makeButtonNorm(y[i]); //Always displayed as usable
	}
}

function changeRocket() {
	rocketLevel++;
	if(rocketLevel>3) rocketLevel = 1;
	var x = document.getElementsByClassName("rocketleveldisplay");
	for(i = 0; i < x.length; i++) x[i].innerHTML = "Level " + rocketLevel;
	updateButtonLook();
}

function score(place) { //Actually scores on a given position
	var cargoState = scoreSheet[place][0];
	var panelState = scoreSheet[place][1];
	var x = document.getElementsByClassName("scorespaces");
	var pos = x[i];

	if(holdingItem) {
		if(itemType == "cargo") {
			if(cargoState == "no") {
				scoreSheet[place][0] = "try";
			} else if(cargoState == "try") {
				scoreSheet[place][0] = "yes";
				if(gameMode=="sandstorm") scoreSheet[place][2] = true;
				dropItem();
			}
		} else {
			if(panelState == "no") {
				scoreSheet[place][1] = "try";
			} else if(panelState == "try") {
				scoreSheet[place][1] = "yes";
				if(gameMode=="sandstorm") scoreSheet[place][3] = true;
				dropItem();
			}
		}
	}
	updateButtonLook();
}

function leaveHAB(level, type) {

	if(type == 0) {
		if(level >= 0 && habLevelStart==0) {
			habLevelStart = level;
			changeLevel(level, type);
			document.getElementById("habLevel"+type+habLevelStart).style.background = checkCol;
		} else {
			habLevelStart = 0;
			changeLevel(level,type);
		}
	} else {
		if(level >= 0 && habLevelEnd==0) {
			habLevelEnd = level;
			changeLevel(level, type);
			document.getElementById("habLevel"+type+habLevelEnd).style.background = checkCol;
		} else {
			habLevelEnd = 0;
			changeLevel(level,type);
		}
	}
}

//Pickup items
function getCargoFloor() {
	if(!holdingItem) {
		itemType = "cargo";
		cargoGrabbedFloor++;
		holdingItem = true;
		changePickup("grab");
		document.getElementById("cargoFloor").style.background = checkCol;
	}
}

function getCargoHuman() {
	if(!holdingItem) {
		itemType = "cargo";
		cargoGrabbedHuman++;
		holdingItem = true;
		changePickup("grab");
		document.getElementById("cargoHuman").style.background = checkCol;
	}
}

function getPanelHuman() {
	if(!holdingItem) {
		itemType = "panel";
		panelGrabbedHuman++;
		holdingItem = true;
		changePickup("grab");
		document.getElementById("panelHuman").style.background = checkCol;
	}
}

function getPanelFloor() {
	if(!holdingItem) {
		itemType = "panel";
		panelGrabbedFloor++;
		holdingItem = true;
		changePickup("grab");
		document.getElementById("panelFloor").style.background = checkCol;
	}
}

function dropItem() {
	if(holdingItem) {
		itemType = "";
		holdingItem = false;
		changePickup("drop");
	}
}

function changeLevel(level, type) {
	updateGameStats();
	updateButtonLook();

	if(level >= 0) {
		var x = document.getElementsByClassName("hablevels");
		for(i = 0; i < x.length; i++) {
			if(type == 0 && i <= 3)	makeButtonStop(x[i]);
			if(type == 1 && i > 3) makeButtonStop(x[i]);
		}
		if(gameMode=="sandstorm") {
			makeButtonNorm(document.getElementsByClassName("cancel")[0]);
			document.getElementsByClassName("cancel")[0].style.fontSize = "16px";
		} else {
			makeButtonNorm(document.getElementsByClassName("cancel")[1]);
			document.getElementsByClassName("cancel")[1].style.fontSize = "16px";
		}
	} else {
		var x = document.getElementsByClassName("hablevels");
		for(i = 0; i < x.length; i++) {
			if(type == 0 && i <= 3)	makeButtonNorm(x[i]);
			if(type == 1 && i > 3) makeButtonNorm(x[i]);
		}
		if(gameMode=="sandstorm") {
			makeButtonStop(document.getElementsByClassName("cancel")[0]);
			document.getElementsByClassName("cancel")[0].style.fontSize = "12px";
		} else {
			makeButtonStop(document.getElementsByClassName("cancel")[1]);
			document.getElementsByClassName("cancel")[1].style.fontSize = "12px";
		}
	}
}

function changeStation(col, num) {
	var x = document.getElementsByClassName("stationbutton");
	for(i = 0; i < x.length; i++) {
		makeButtonStop(x[i]);
		x[i].style.fontSize = "12px";
	}

	if(col==0) { //Red
		var y = document.getElementById("stationR"+num);
		y.style.background = redCol;
		y.style.fontSize = "16px";
	} else { //Blue
		var y = document.getElementById("stationB"+num);
		y.style.background = blueCol;
		y.style.fontSize = "16px";
	}
}

function changePickup(type) {
	updateGameStats();
	updateButtonLook();
	if(type=="grab") {
		//Change pickups
		var x = document.getElementsByClassName("itempickups");
		for(i = 0; i < x.length; i++) {
			makeButtonStop(x[i]);
		}

		//Change drop item
		makeButtonNorm(document.getElementsByClassName("cancel")[2]);
		document.getElementsByClassName("cancel")[2].style.fontSize = "16px";
	} else {
		//Change pickups
		var x = document.getElementsByClassName("itempickups");
		for(i = 0; i < x.length; i++) {
			makeButtonNorm(x[i]);
		}

		//Change drop item
		makeButtonStop(document.getElementsByClassName("cancel")[2]);
		document.getElementsByClassName("cancel")[2].style.fontSize = "12px";
	}
}

function makeButtonNorm(button) {
	 button.style.background = normCol;
	 button.style.cursor = "pointer";
}

function makeButtonStop(button) {
	 button.style.background = stopCol;
	 button.style.cursor = "default";
}