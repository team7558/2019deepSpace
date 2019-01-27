var gameMode = "preload", habLevelPreload = -1, habLevelStart = -1, habLevelEnd = -1, holdingItem = false, itemType = "cargo", rocketLevel = 1,
cargoGrabbedHuman = 0, cargoGrabbedFloor = 0, panelGrabbedHuman = 0, panelGrabbedFloor = 0, cargoDropped = 0, panelDropped = 0, station = "R1", xscale = 1, preloadedItem = "Nothing";

var defenseLevel = 0, carryBotNumber = 0, wasCarried = false;

var scoreSheet = [ //Cargo, panel, cargoWhen, panelWhen, nullPanel - index is listed below
	//will be no, yes, or try (only temporary)
	//cargoWhen and panelWhen will be "notscored", "preload", "sandstorm", or"teleop"
	//nullPanel can only be true for one position
	["no", "no", "notscored", "notscored", false],
	["no", "no", "notscored", "notscored", false],
	["no", "no", "notscored", "notscored", false],
	["no", "no", "notscored", "notscored", false],
	["no", "no", "notscored", "notscored", false],
	["no", "no", "notscored", "notscored", false],
	["no", "no", "notscored", "notscored", false],
	["no", "no", "notscored", "notscored", false],
	["no", "no", "notscored", "notscored", false],
	["no", "no", "notscored", "notscored", false],
	["no", "no", "notscored", "notscored", false],
	["no", "no", "notscored", "notscored", false],
	["yes", "no", "preload", "notscored", false],
	["yes", "no", "preload", "notscored", false],
	["no", "no", "notscored", "notscored", false],
	["no", "no", "notscored", "notscored", false],
	["no", "no", "notscored", "notscored", false],
	["no", "no", "notscored", "notscored", false],
	["no", "no", "notscored", "notscored", false],
	["no", "no", "notscored", "notscored", false]
];

var buttonPlacement = [ //For each button, then the rocket displays
	//will be left: ... value for scaleX(1) and scaleX(-1)

	[354,914],
	[514,754],
	[354,914],
	[514,754],
	[354,914],
	[514,754],
	[354,914],
	[514,754],
	[354,914],
	[514,754],
	[354,914],
	[514,754],

	[514,754],
	[514,754],
	[634,634],
	[634,634],
	[754,514],
	[754,514],
	[874,394],
	[874,394],

	[434,834],
	[434,834],

	[314, 914]

];

var normCol = "#2196F3", stopCol = "#8FC1E2", checkCol = "#167BCC", tryCol = "#FFCA32", preloadCol = "#6CCC12", sandstormCol = "#D57217", teleopCol = "#3881DC", miscCol = "#D7271A", redCol = "#F94F42", blueCol = "#1281F0";

//Run a few methods at the very beginning of the game


function updateGameStats() {
}

function changeButtonPlacement() {
	if(xscale==1) xscale = -1;
	else xscale = 1;

	var x = document.getElementsByClassName("scorespaces");
	for(i = 0; i < x.length; i++) {
		if(xscale == 1) x[i].style.left = buttonPlacement[i][0];
		else x[i].style.left = buttonPlacement[i][1];
	}
	if(xscale == 1) {
		document.getElementById("rocketleveldisplay1").style.left = buttonPlacement[20][0];
		document.getElementById("rocketleveldisplay2").style.left = buttonPlacement[21][0];
		document.getElementById("gamemap").style.transform = "scaleX(1)";
		document.getElementById("robotscorespace").style.left = buttonPlacement[22][0];
	} else {
		document.getElementById("rocketleveldisplay1").style.left = buttonPlacement[20][1];
		document.getElementById("rocketleveldisplay2").style.left = buttonPlacement[21][1];
		document.getElementById("gamemap").style.transform = "scaleX(-1)";
		document.getElementById("robotscorespace").style.left = buttonPlacement[22][1];
	}
		
}


function print2D(arr) {
	var msg = "";
	for(i = 0; i < arr.length; i++) {
		for(j = 0; j < arr[i].length; j++) {
			msg+=arr[i][j]+"   ";
		}
		msg+="\n";
	}
	alert(msg);
}





function updateMode(mode) {
	if(mode==0) gameMode = "preload";
	else if(mode==1) gameMode = "sandstorm";
	else if(mode==2) gameMode = "teleop";
	else gameMode = "misc";

	var x = document.getElementsByClassName("modebtns");
	for(i = 0; i < x.length; i++) {
		var button = x[i];
		button.style.background = stopCol;
	 	button.style.cursor = "pointer";
	 	button.style.fontSize = "20px";

	 	if(gameMode == "preload" && i == 0) {
			button.style.background = preloadCol;
		 	button.style.cursor = "default";
		 	button.style.fontSize = "24px";
	 	} else if(gameMode == "sandstorm" && i == 1) {
	 		button.style.background = sandstormCol;
		 	button.style.cursor = "default";
		 	button.style.fontSize = "24px";
	 	} else if(gameMode == "teleop" && i == 2) {
	 		button.style.background = teleopCol;
	 		button.style.cursor = "default";
	 		button.style.fontSize = "24px";
	 	} else if(gameMode == "misc" && i == 3) {
	 		button.style.background = miscCol;
	 		button.style.cursor = "default";
	 		button.style.fontSize = "24px";
	 	}
	}

	if(gameMode == "preload") {

		document.getElementById("habpreload").style.display = "table-cell";
		document.getElementById("habstart").style.display = "none";
		document.getElementById("habend").style.display = "none";
		document.getElementById("pickuppreload").style.display = "table-cell";
		document.getElementById("pickup").style.display = "none";
		document.getElementById("scoringrocket1").style.display = "block";
		document.getElementById("scoringrocket2").style.display = "block";
		document.getElementById("scoringship").style.display = "block";
		document.getElementById("robotscorespace").style.display = "block";
		document.getElementById("gamemap").style.display = "block";
		document.getElementById("miscellaneous").style.display = "none";


		var y = document.getElementsByClassName("modelbl");
		for(i = 0; i < y.length; i++) {
			y[i].innerHTML = "PRELOAD SETTINGS";
			y[i].style.fontSize = "48px";
			y[i].style.fontWeight = "600";
			y[i].style.textAlign = "center";
			y[i].style.color = "white";
			y[i].style.backgroundColor = preloadCol;
		}

	} else if(gameMode == "sandstorm") {

		document.getElementById("habpreload").style.display = "none";
		document.getElementById("habstart").style.display = "table-cell";
		document.getElementById("habend").style.display = "none";
		document.getElementById("pickuppreload").style.display = "none";
		document.getElementById("pickup").style.display = "table-cell";
		document.getElementById("scoringrocket1").style.display = "block";
		document.getElementById("scoringrocket2").style.display = "block";
		document.getElementById("scoringship").style.display = "block";
		document.getElementById("robotscorespace").style.display = "none";
		document.getElementById("gamemap").style.display = "block";
		document.getElementById("miscellaneous").style.display = "none";


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
		
		document.getElementById("habpreload").style.display = "none";
		document.getElementById("habstart").style.display = "none";
		document.getElementById("habend").style.display = "table-cell";
		document.getElementById("pickuppreload").style.display = "none";
		document.getElementById("pickup").style.display = "table-cell";
		document.getElementById("scoringrocket1").style.display = "block";
		document.getElementById("scoringrocket2").style.display = "block";
		document.getElementById("scoringship").style.display = "block";
		document.getElementById("robotscorespace").style.display = "none";
		document.getElementById("gamemap").style.display = "block";
		document.getElementById("miscellaneous").style.display = "none";

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
		
		document.getElementById("habpreload").style.display = "none";
		document.getElementById("habstart").style.display = "none";
		document.getElementById("habend").style.display = "none";
		document.getElementById("pickuppreload").style.display = "none";
		document.getElementById("pickup").style.display = "none";
		document.getElementById("scoringrocket1").style.display = "none";
		document.getElementById("scoringrocket2").style.display = "none";
		document.getElementById("scoringship").style.display = "none";
		document.getElementById("robotscorespace").style.display = "none";
		document.getElementById("gamemap").style.display = "none";
		document.getElementById("miscellaneous").style.display = "table";

		var y = document.getElementsByClassName("modelbl");
		for(i = 0; i < y.length; i++) {
			y[i].innerHTML = "MISCELLANEOUS PERIOD";
			y[i].style.fontSize = "48px";
			y[i].style.fontWeight = "600";
			y[i].style.textAlign = "center";
			y[i].style.color = "white";
			y[i].style.backgroundColor = miscCol;
		}
	}

	updateGameStats();
}


function switchDefense(level) {
	var x = document.getElementsByClassName("switchdefense");
	for(i = 0; i < x.length; i++) x[i].style.background = normCol;
	var y = document.getElementById("defense"+level);
	y.style.background = checkCol;
	defenseLevel = level;
}

function switchCarryBot(level) {
	var x = document.getElementsByClassName("switchcarrybot");
	for(i = 0; i < x.length; i++) x[i].style.background = normCol;
	var y = document.getElementById("carrybot"+level);
	y.style.background = checkCol;
	carryBotNumber = level;
}

function switchWasCarried() {
	wasCarried = !wasCarried;
	document.getElementById("wascarried").style.background = normCol;
	if(wasCarried) document.getElementById("wascarried").style.background = checkCol
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

	//Preload robot specific
	var bot = document.getElementById("robotscorespace");
	if(preloadedItem == "Nothing") {
		if(!holdingItem) {
			makeButtonStop(bot);
			bot.innerHTML = "Your Robot<br>is Holding:<br><br>Nothing";
		} else {
			makeButtonNorm(bot);
			bot.innerHTML = "Empty";
		}
	} else {
		bot.innerHTML = "Your Robot<br>is Holding:<br><br>" + preloadedItem;
		makeButtonStop(bot);
		
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

function preloadRobot() {
	if(preloadedItem == "Nothing") {
		if(holdingItem) {
			if(itemType == "cargo") {
				preloadedItem = "Cargo";
			} else if(itemType == "panel") {
				preloadedItem = "Null Hatch Panel";
			}
			dropItem();
			//print2D(scoreSheet);
/*
			//Make it so that the item has been selected
			holdingItem = false;
			if(preloadedItem == "Cargo") {
				getCargoHuman();
				cargoGrabbedHuman--;
			} else if(preloadedItem == "Panel") {
				getPanelHuman();
				panelGrabbedHuman--;
			}
			makeButtonStop(document.getElementsByClassName("cancel")[3]);
			document.getElementsByClassName("cancel")[3].style.fontSize = "12px";*/
		}
	}
	updateButtonLook();
	updateGameStats();
}

function score(place) { //Actually scores on a given position
	var cargoState = scoreSheet[place][0];
	var panelState = scoreSheet[place][1];
	var x = document.getElementsByClassName("scorespaces");

	if(holdingItem) {
		if(itemType == "cargo") {
			if(cargoState == "no") {
				scoreSheet[place][0] = "try";

				//No attempt during preload
				if(gameMode == "preload") {
					scoreSheet[place][0] = "yes";
					scoreSheet[place][2] = gameMode;

					dropItem();
				}
			} else if(cargoState == "try") {
				scoreSheet[place][0] = "yes";
				
				scoreSheet[place][2] = gameMode;
				dropItem();
			}
		} else {
			if(panelState == "no") {
				scoreSheet[place][1] = "try";

				//No attempt during preload
				if(gameMode == "preload") {
					scoreSheet[place][1] = "yes";
					scoreSheet[place][3] = gameMode;

					scoreSheet[place][4] = true;
					dropItem();
				}
			} else if(panelState == "try") {
				scoreSheet[place][1] = "yes";
				scoreSheet[place][3] = gameMode;
				dropItem();
			}
		}
	}
	updateButtonLook();
}

function leaveHAB(level, type) {

	if(level == -1 || (type==0&&habLevelPreload==-1) || (type==1&&habLevelStart==-1) || (type==2&&habLevelEnd==-1)) {

		if(type == 0) {
			if(level >= 0 && habLevelPreload==-1) {
				habLevelPreload = level;
				changeLevel(level, type);
				document.getElementById("habLevel"+type+habLevelPreload).style.background = checkCol;
			} else {
				habLevelPreload = -1;
				changeLevel(level,type);
			}
		} else if(type == 1) {
			if(level >= 0 && habLevelStart==-1) {
				habLevelStart = level;
				changeLevel(level, type);
				document.getElementById("habLevel"+type+habLevelStart).style.background = checkCol;
			} else {
				habLevelStart = -1;
				changeLevel(level,type);
			}
		} else {
			if(level >= 0 && habLevelEnd==-1) {
				habLevelEnd = level;
				changeLevel(level, type);
				document.getElementById("habLevel"+type+habLevelEnd).style.background = checkCol;
			} else {
				habLevelEnd = -1;
				changeLevel(level,type);
			}
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

function getCargoPreload() {
	if(!holdingItem) {
		itemType = "cargo";
		holdingItem = true;
		changePickup("grab");
		document.getElementById("cargoPreload").style.background = checkCol;
	}
}

function getPanelPreload() {
	if(!holdingItem) {
		itemType = "panel";
		holdingItem = true;
		changePickup("grab");
		document.getElementById("panelPreload").style.background = checkCol;
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
			if(type == 0 && i <= 2)	makeButtonStop(x[i]);
			if(type == 1 && i > 2 && i <= 6) makeButtonStop(x[i]);
			if(type == 2 && i > 6) makeButtonStop(x[i]);
		}
		if(gameMode=="preload") {
			makeButtonNorm(document.getElementsByClassName("cancel")[0]);
			document.getElementsByClassName("cancel")[0].style.fontSize = "16px";
		} else if(gameMode=="sandstorm") {
			makeButtonNorm(document.getElementsByClassName("cancel")[1]);
			document.getElementsByClassName("cancel")[1].style.fontSize = "16px";
		} else {
			makeButtonNorm(document.getElementsByClassName("cancel")[2]);
			document.getElementsByClassName("cancel")[2].style.fontSize = "16px";
		}
	} else {
		var x = document.getElementsByClassName("hablevels");
		for(i = 0; i < x.length; i++) {
			if(type == 0 && i <= 2)	makeButtonNorm(x[i]);
			if(type == 1 && i > 2 && i <= 6) makeButtonNorm(x[i]);
			if(type == 2 && i > 6) makeButtonNorm(x[i]);
		}
		if(gameMode=="preload") {
			makeButtonStop(document.getElementsByClassName("cancel")[0]);
			document.getElementsByClassName("cancel")[0].style.fontSize = "12px";
		} else if(gameMode=="sandstorm") {
			makeButtonStop(document.getElementsByClassName("cancel")[1]);
			document.getElementsByClassName("cancel")[1].style.fontSize = "12px";
		} else {
			makeButtonStop(document.getElementsByClassName("cancel")[2]);
			document.getElementsByClassName("cancel")[2].style.fontSize = "12px";
		}
	}
}

function changeStation(col, num) {
	var x = document.getElementsByClassName("stationbutton");
	station = "R1";
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
	updateButtonLook();
	if(type=="grab") {
		//Change pickups
		var x = document.getElementsByClassName("itempickups");
		for(i = 0; i < x.length; i++) {
			makeButtonStop(x[i]);
		}

		//Change drop item
		if(gameMode == "preload") {
			makeButtonNorm(document.getElementsByClassName("cancel")[3]);
			document.getElementsByClassName("cancel")[3].style.fontSize = "16px";
		} else {
			makeButtonNorm(document.getElementsByClassName("cancel")[4]);
			document.getElementsByClassName("cancel")[4].style.fontSize = "16px";
		}
		
	} else {
		//Change pickups
		var x = document.getElementsByClassName("itempickups");
		for(i = 0; i < x.length; i++) {
			makeButtonNorm(x[i]);
		}

		//Change drop item
		if(gameMode == "preload") {
			makeButtonStop(document.getElementsByClassName("cancel")[3]);
			document.getElementsByClassName("cancel")[3].style.fontSize = "12px";
		} else {
			makeButtonStop(document.getElementsByClassName("cancel")[4]);
			document.getElementsByClassName("cancel")[4].style.fontSize = "12px";
		}
	}
	updateGameStats();
}

function makeButtonNorm(button) {
	 button.style.background = normCol;
	 button.style.cursor = "pointer";
}

function makeButtonStop(button) {
	 button.style.background = stopCol;
	 button.style.cursor = "default";
}