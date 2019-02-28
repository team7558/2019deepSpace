var gameMode = "preload", habLevelPreload = -1, habLevelStart = -1, habLevelEnd = -1, holdingItem = false, itemType = "cargo", rocketLevel = 1,
cargoGrabbedHuman = 0, cargoGrabbedFloor = 0, panelGrabbedHuman = 0, panelGrabbedFloor = 0, cargoDropped = 0, panelDropped = 0, xscale = 1, preloadedItem = "Nothing", preloadedItemState = "Not Assigned";

var teamNumber = "7558", competitionName = "Unknown", matchNumber = 0, station = "R1";

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

	[0,640], //0
	[160,480], //1
	[0,640], //2
	[160,480], //3
	[0,640], //4
	[160,480], //5
	[0,640], //6
	[160,480], //7
	[0,640], //8
	[160,480], //9
	[0,640], //10
	[160,480], //11

	[400,240], //12
	[400,240], //13
	[480,160], //14
	[480,160], //15
	[560,80], //16
	[560,80], //17
	[640,0], //18
	[640,0], //19

	[80,560], //rocket 1
	[80,560], //rocket 2

	[0,560], //robot preload
	[160,320] //teamnumber

];

var normCol = "#636363", stopCol = "#3f3f3f", checkCol = "#7C7C7C", tryCol = "#999891", preloadCol = "#6CCC12", sandstormCol = "#D57217", teleopCol = "#3881DC", miscCol = "#D7271A", redCol = "#F94F42", blueCol = "#1281F0";
var scoredCol = "#2F9E38", notscoredCol = "#333333", triedCol = "#CCB92A", canclickCol = "#444444", cantclickCol = "#161616";


function initialize() {
	document.getElementById("teamnumber").innerHTML = teamNumber;
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
		document.getElementById("mapteamnumber").style.left = buttonPlacement[23][0];
	} else {
		document.getElementById("rocketleveldisplay1").style.left = buttonPlacement[20][1];
		document.getElementById("rocketleveldisplay2").style.left = buttonPlacement[21][1];
		document.getElementById("gamemap").style.transform = "scaleX(-1)";
		document.getElementById("robotscorespace").style.left = buttonPlacement[22][1];
		document.getElementById("mapteamnumber").style.left = buttonPlacement[23][1];
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
	//Deal with item dropping
	var itemToTake = "Nothing";

	if(gameMode == "preload") {
		if(holdingItem) dropItem();

		if(mode == 1 || mode == 2) {
			if(preloadedItemState == "Assigned") {
				holdingItem = false;
				itemToTake = preloadedItem;
			}
		}
	}


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
		document.getElementById("robotscorespace").style.display = "block";
		document.getElementById("gamemap").style.display = "block";
		document.getElementById("sstable").style.display = "table";
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

		var z = document.getElementsByClassName("scorespaces");
		for(i = 0; i < z.length; z++) {
			z[i].style.display = "block";
		}

		document.getElementById("modetable").style.top = "-480px"; //Accounts for the sstable


	} else if(gameMode == "sandstorm") {

		document.getElementById("habpreload").style.display = "none";
		document.getElementById("habstart").style.display = "table-cell";
		document.getElementById("habend").style.display = "none";
		document.getElementById("pickuppreload").style.display = "none";
		document.getElementById("pickup").style.display = "table-cell";
		document.getElementById("robotscorespace").style.display = "none";
		document.getElementById("gamemap").style.display = "block";
		document.getElementById("sstable").style.display = "table";
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

		var z = document.getElementsByClassName("scorespaces");
		for(i = 0; i < z.length; z++) {
			z[i].style.display = "block";
		}

		document.getElementById("modetable").style.top = "-480px"; //Accounts for the sstable

	} else if(gameMode == "teleop") {
		
		document.getElementById("habpreload").style.display = "none";
		document.getElementById("habstart").style.display = "none";
		document.getElementById("habend").style.display = "table-cell";
		document.getElementById("pickuppreload").style.display = "none";
		document.getElementById("pickup").style.display = "table-cell";
		document.getElementById("robotscorespace").style.display = "none";
		document.getElementById("gamemap").style.display = "block";
		document.getElementById("sstable").style.display = "table";
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

		var z = document.getElementsByClassName("scorespaces");
		for(i = 0; i < z.length; z++) {
			z[i].style.display = "block";
		}

		document.getElementById("modetable").style.top = "-480px"; //Accounts for the sstable

	} else {
		
		document.getElementById("habpreload").style.display = "none";
		document.getElementById("habstart").style.display = "none";
		document.getElementById("habend").style.display = "none";
		document.getElementById("pickuppreload").style.display = "none";
		document.getElementById("pickup").style.display = "none";
		document.getElementById("robotscorespace").style.display = "none";
		document.getElementById("gamemap").style.display = "none";
		document.getElementById("sstable").style.display = "none";
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

		var z = document.getElementsByClassName("scorespaces");
		for(i = 0; i < z.length; z++) {
			z[i].style.display = "none";
		}

		document.getElementById("modetable").style.top = "0px"; //Accounts for the sstable

	}

	if(itemToTake == "Cargo") {
		holdingItem = false;
		getCargoFloor();
		cargoGrabbedFloor--;
		document.getElementById("cargoFloor").style.background = checkCol;
	} else if(itemToTake == "Hatch Panel") {
		holdingItem = false;
		getPanelFloor();
		panelGrabbedFloor--;
		document.getElementById("panelFloor").style.background = checkCol;
	}
}


function switchDefense(level) {
	var x = document.getElementsByClassName("switchdefense");
	for(i = 0; i < x.length; i++) x[i].style.background = canclickCol;
	var y = document.getElementById("defense"+level);
	y.style.background = checkCol;
	defenseLevel = level;
}

function switchCarryBot(level) {
	var x = document.getElementsByClassName("switchcarrybot");
	for(i = 0; i < x.length; i++) x[i].style.background = canclickCol;
	var y = document.getElementById("carrybot"+level);
	y.style.background = checkCol;
	carryBotNumber = level;
}

function switchWasCarried() {
	wasCarried = !wasCarried;
	document.getElementById("wascarried").style.background = canclickCol;
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
			checkButtonScored(x[i], hasCargo, hasPanel);
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
			if(hasCargo == "no" && hasPanel == "no") x[i].innerHTML = "Cargo: &#x2716<br><br>Panel: &#x2716";
			else if(hasCargo == "no" && hasPanel == "yes") x[i].innerHTML = "Cargo: &#x2716<br><br>Panel: &#x2714";
			else if(hasCargo == "yes" && hasPanel == "no") x[i].innerHTML = "Cargo: &#x2714<br><br>Panel: &#x2716";
			else x[i].innerHTML = "Cargo: &#x2714<br><br>Panel: &#x2714";
		} else {
			makeButtonNorm(x[i]);
			if(itemType == "cargo") {
				if(hasCargo == "no") {
					x[i].innerHTML = "Empty";
					x[i].style.background = canclickCol;
				} else if(hasCargo == "try") {
					x[i].innerHTML = "Attempted";
					x[i].style.background = triedCol;
				} else {
					x[i].innerHTML = "Scored";
					x[i].style.background = scoredCol;
				}
			} else {
				if(hasPanel == "no") {
					x[i].innerHTML = "Empty";
					x[i].style.background = canclickCol;
				} else if(hasPanel == "try") {
					x[i].innerHTML = "Attempted";
					x[i].style.background = triedCol;
				} else {
					x[i].innerHTML = "Scored";
					x[i].style.background = scoredCol;
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
		bot.style.backgroundImage = "-webkit-linear-gradient(top,"+scoredCol+","+scoredCol+" 50%,"+scoredCol+" 50%,"+scoredCol+" 100%)";
	}


	var y = document.getElementsByClassName("rocketleveldisplay");
	for(i = 0; i < y.length; i++) {
		y[i].style.backgroundColor = cantclickCol;
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
		preloadedItemState = "Assigned";
		if(holdingItem) {
			if(itemType == "cargo") {
				preloadedItem = "Cargo";
			} else if(itemType == "panel") {
				preloadedItem = "Hatch Panel";
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
				} else if(preloadedItemState=="Assigned") preloadedItemState="Used";
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
				} else if(preloadedItemState=="Assigned") preloadedItemState="Used";
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
				makeSideButtonOn(document.getElementById("habLevel"+type+habLevelPreload));
			} else {
				habLevelPreload = -1;
				changeLevel(level,type);
			}
		} else if(type == 1) {
			if(level >= 0 && habLevelStart==-1) {
				habLevelStart = level;
				changeLevel(level, type);
				makeSideButtonOn(document.getElementById("habLevel"+type+habLevelStart));
			} else {
				habLevelStart = -1;
				changeLevel(level,type);
			}
		} else {
			if(level >= 0 && habLevelEnd==-1) {
				habLevelEnd = level;
				changeLevel(level, type);
				makeSideButtonOn(document.getElementById("habLevel"+type+habLevelEnd));
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
		makeSideButtonOn(document.getElementById("cargoFloor"));
	}
}

function getCargoHuman() {
	if(!holdingItem) {
		itemType = "cargo";
		cargoGrabbedHuman++;
		holdingItem = true;
		changePickup("grab");
		makeSideButtonOn(document.getElementById("cargoHuman"));
	}
}

function getPanelFloor() {
	if(!holdingItem) {
		itemType = "panel";
		panelGrabbedFloor++;
		holdingItem = true;
		changePickup("grab");
		makeSideButtonOn(document.getElementById("panelFloor"));
	}
}

function getPanelHuman() {
	if(!holdingItem) {
		itemType = "panel";
		panelGrabbedHuman++;
		holdingItem = true;
		changePickup("grab");
		makeSideButtonOn(document.getElementById("panelHuman"));
	}
}

function getCargoPreload() {
	if(!holdingItem) {
		itemType = "cargo";
		holdingItem = true;
		changePickup("grab");
		makeSideButtonOn(document.getElementById("cargoPreload"));
	}
}

function getPanelPreload() {
	if(!holdingItem) {
		itemType = "panel";
		holdingItem = true;
		changePickup("grab");
		makeSideButtonOn(document.getElementById("panelPreload"));
	}
}




function dropItem() {
	if(holdingItem) {
		itemType = "";
		holdingItem = false;
		changePickup("drop");

		if(preloadedItemState=="Assigned" && gameMode!="preload") preloadedItemState="Used";
	}
}

function changeLevel(level, type) {
	updateButtonLook();

	if(level >= 0) {
		var x = document.getElementsByClassName("hablevels");
		for(i = 0; i < x.length; i++) {
			if(type == 0 && i <= 2)	makeSideButtonStop(x[i]);
			if(type == 1 && i > 2 && i <= 6) makeSideButtonStop(x[i]);
			if(type == 2 && i > 6) makeSideButtonStop(x[i]);
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
	var text = "";
	for(i = 0; i < x.length; i++) {
		makeButtonStop(x[i]);
		x[i].style.fontSize = "12px";
	}

	if(col==0) { //Red
		var y = document.getElementById("stationR"+num);
		y.style.background = redCol;
		y.style.fontSize = "16px";
		text = "R";

		var z = document.getElementById("gamemap");
		z.style.background = redCol;
	} else { //Blue
		var y = document.getElementById("stationB"+num);
		y.style.background = blueCol;
		y.style.fontSize = "16px";
		text = "B";

		var z = document.getElementById("gamemap");
		z.style.background = blueCol;
	}
	station = text+num;
}

function changePickup(type) {
	updateButtonLook();
	if(type=="grab") {
		//Change pickups
		var x = document.getElementsByClassName("itempickups");
		for(i = 0; i < x.length; i++) {
			makeSideButtonStop(x[i]);
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
}

function makeButtonNorm(button) {
	 button.style.background = canclickCol;
	 button.style.cursor = "pointer";
	 button.style.opacity = "1.0";
}

function makeButtonStop(button) {
	 button.style.background = cantclickCol;
	 button.style.cursor = "default";
}

function makeSideButtonOn(button) {
	button.style.background = checkCol;
	button.style.opacity = "1.0";
}

function makeSideButtonStop(button) {
	button.style.background = cantclickCol;
	button.style.cursor = "default";
	button.style.opacity = "0.0";
}






function checkButtonScored(button, cargo, panel) {
	if(cargo == "yes" && panel == "yes") {
		button.style.backgroundImage = "-webkit-linear-gradient(top,"+scoredCol+","+scoredCol+" 50%,"+scoredCol+" 50%,"+scoredCol+" 100%)";
	} else if(cargo == "yes") {
		button.style.backgroundImage = "-webkit-linear-gradient(top,"+scoredCol+","+scoredCol+" 50%,"+notscoredCol+" 50%,"+notscoredCol+" 100%)";
	} else if(panel == "yes") {
		button.style.backgroundImage = "-webkit-linear-gradient(top,"+notscoredCol+","+notscoredCol+" 50%,"+scoredCol+" 50%,"+scoredCol+" 100%)";
	} else {
		button.style.backgroundImage = "-webkit-linear-gradient(top,"+notscoredCol+","+notscoredCol+" 50%,"+notscoredCol+" 50%,"+notscoredCol+" 100%)";
	}
}



function getSandstormScored(type) {
	var count = 0;
	for(i = 0; i < scoreSheet.length; i++) {
		if(scoreSheet[i][type+2]=="sandstorm") count++;
	}
	return count;
}

function getObjectsScored(type, where) {
	var count = 0;

	//Account for scored ship cargo
	if(type==0 && where=="ship") count=-2;

	for(i = 0; i < scoreSheet.length; i++) {

		if(scoreSheet[i][type] == "yes") {

			if(i>=12) {
				if(where=="ship") count++;
			} else if(i==0||i==1||i==6||i==7) {
				if(where=="low") count++;
			} else if(i==2||i==3||i==8||i==9) {
				if(where=="mid") count++;
			} else {
				if(where=="high") count++;
			}

		} 

	}
	return count;
}





function scoreForm() {
	updateFormData();
}

function updateFormData() {
	var thisData = null; //Used to modify each different input
	var message = "";
	
	document.getElementById("matchdatascoutname").value = document.getElementById("scoutname").value;
	document.getElementById("matchdatamatchcode").value = document.getElementById("matchcode").value;

	//HAB Sandstorm Score
	thisData = document.getElementById("datahabstart");
	if(habLevelStart == 1 || habLevelStart == 2) thisData.value = habLevelStart*3;
	message += thisData.value+"%0D%0A";

	//Sandstorm Cargo
	thisData = document.getElementById("datasandstormcargo");
	thisData.value = getSandstormScored(0);
	message += thisData.value+"%0D%0A";

	//Sandstorm Panel
	thisData = document.getElementById("datasandstormpanel");
	thisData.value = getSandstormScored(1);
	message += thisData.value+"%0D%0A";



	//Cargo From Floor
	thisData = document.getElementById("datacargofloor");
	thisData.value = cargoGrabbedFloor;
	message += thisData.value+"%0D%0A";

	//Cargo From Human
	thisData = document.getElementById("datacargohuman");
	thisData.value = cargoGrabbedHuman;
	message += thisData.value+"%0D%0A";

	//Panel From Floor
	thisData = document.getElementById("datapanelfloor");
	thisData.value = panelGrabbedFloor;
	message += thisData.value+"%0D%0A";

	//Panel From Human
	thisData = document.getElementById("datapanelhuman");
	thisData.value = panelGrabbedHuman;
	message += thisData.value+"%0D%0A";

	//Defense Level
	thisData = document.getElementById("datadefense");
	thisData.value = defenseLevel;
	message += thisData.value+"%0D%0A";



	//Ship Cargo
	thisData = document.getElementById("datashipcargo");
	thisData.value = getObjectsScored(0, "ship");
	message += thisData.value+"%0D%0A";

	//Ship Panel
	thisData = document.getElementById("datashippanel");
	thisData.value = getObjectsScored(1, "ship");
	message += thisData.value+"%0D%0A";

	//Low Rocket Cargo
	thisData = document.getElementById("datalowcargo");
	thisData.value = getObjectsScored(0, "low");
	message += thisData.value+"%0D%0A";

	//Low Rocket Panel
	thisData = document.getElementById("datalowpanel");
	thisData.value = getObjectsScored(1, "low");
	message += thisData.value+"%0D%0A";

	//Mid Rocket Cargo
	thisData = document.getElementById("datamidcargo");
	thisData.value = getObjectsScored(0, "mid");
	message += thisData.value+"%0D%0A";

	//Mid Rocket Panel
	thisData = document.getElementById("datamidpanel");
	thisData.value = getObjectsScored(1, "mid");
	message += thisData.value+"%0D%0A";

	//High Rocket Cargo
	thisData = document.getElementById("datahighcargo");
	thisData.value = getObjectsScored(0, "high");
	message += thisData.value+"%0D%0A";

	//High Rocket Panel
	thisData = document.getElementById("datahighpanel");
	thisData.value = getObjectsScored(1, "high");
	message += thisData.value+"%0D%0A";



	//Was Carried
	thisData = document.getElementById("datawascarried");
	thisData.value = wasCarried;
	message += thisData.value+"%0D%0A";

	//Robots Carried
	thisData = document.getElementById("datarobotscarried");
	thisData.value = carryBotNumber;
	message += thisData.value+"%0D%0A";

	//HAB Endgame Score
	thisData = document.getElementById("datahabend");
	if(habLevelEnd==1||habLevelEnd==2) thisData.value = habLevelEnd*3;
	else if(habLevelEnd==3) thisData.value = 12;
	message += thisData.value+"%0D%0A";

	//Comments
	thisData = document.getElementById("datacomments");
	thisData.value = document.getElementById("commentbox").value;

	//Competition Information
	document.getElementById("matchdatateamnumber").value = teamNumber;
	document.getElementById("matchdatacompetition").value = competitionName;
	document.getElementById("matchdatamatchnumber").value = matchNumber;
	document.getElementById("matchdatarobotstation").value = station;
	message+=station;


	window.open("mailto:jnarayan@bayviewglen.ca&subject=Scouting Entry&body="+message);
}