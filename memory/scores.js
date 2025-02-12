/***************************************************************************************************
*********
***************************************************************************************************/
function getBestScores (uID)
{
	var request = $.ajax({
		url: "scores.php?gID=" + gameID + "&uID=" + uID,
		type: "GET",
		dataType: "html"});
	
	request.success(function(msg) {
		var a = document.getElementById("bestuserscores");
		a.innerHTML = msg;
	});
	
	request.fail   (function(jqXHR, textStatus) {alert( "Request failed: " + textStatus );});
}

/***************************************************************************************************
*********
***************************************************************************************************/
function getBestGlobalScores ()
{
	var request = $.ajax({
		url: "scores.php?gID=" + gameID + "&uID=GLOBAL",
		type: "GET",
		dataType: "html"});
	
	request.success(function(msg) {
		id = "bestglobalscores" + gameID;
//		alert(id);
		var a = document.getElementById(id);
		a.innerHTML = msg;
	});
	
	request.fail   (function(jqXHR, textStatus) {alert( "Request failed: " + textStatus );});
}

/***************************************************************************************************
*********
***************************************************************************************************/
function getBestGlobalScores1 ()
{
	var request = $.ajax({
		url: "scores.php?gID=1&uID=GLOBAL",
		type: "GET",
		dataType: "html"});
	
	request.success(function(msg) {
		id = "bestglobalscores1";
//		alert(id);
		var a = document.getElementById(id);
		a.innerHTML = msg;
	});
	
	request.fail   (function(jqXHR, textStatus) {alert( "Request failed: " + textStatus );});
}
/***************************************************************************************************
*********
***************************************************************************************************/
function getBestGlobalScores2 ()
{
	var request = $.ajax({
		url: "scores.php?gID=2&uID=GLOBAL",
		type: "GET",
		dataType: "html"});
	
	request.success(function(msg) {
		id = "bestglobalscores2";
//		alert(id);
		var a = document.getElementById(id);
		a.innerHTML = msg;
	});
	
	request.fail   (function(jqXHR, textStatus) {alert( "Request failed: " + textStatus );});
}

/***************************************************************************************************
*********
***************************************************************************************************/
function setBestScores (uID, turns, tijd, callBack)
{
/********
*** Dit is voor spelID = 1
********/
	var link = "scores.php?gID=" + gameID +"&uuID=" + uID + "&turns=" + turns + "&tijd=" + tijd;
//	alert (link);
	var request = $.ajax({
		url: link,
		type: "GET",
		dataType: "html"});
	
	request.success(function(msg) {
		if (msg != 'TRUE')
		{
			alert('Foute boel!:' + msg);
//			request.fail(function(jqXHR, textStatus) {alert( "Request failed: " + textStatus );});
		}
	});
	
	request.fail   (function(jqXHR, textStatus) {alert( "Request failed: " + textStatus );});
	
//	callBack();
}

function callBack () {
	getBestScores(userID);
	getBestGlobalScores();	
}

/***************************************************************************************************
*********
***************************************************************************************************/
Array.prototype.memory_tile_shuffle = function() {
	var i = this.length,
		j, temp;
	i--;
	while (--i > 0) {
		j = Math.floor(Math.random() * (i + 1));
		temp = this[j];
		this[j] = this[i];
		this[i] = temp;
	}
};

/***************************************************************************************************
*********
***************************************************************************************************/
function newBoard() {
	start = 0;
    myFound = document.getElementById('pairFound');
	myFound.textContent = "0";
	myFound.innerText = "0";
    myTurned = document.getElementById('cardsTurned');
	myTurned.textContent = "0";
	myTurned.innerText = "0";
	getBestScores(userID);
	getBestGlobalScores();
	tiles_flipped = 0;
	tiles_used = 0;
    var myClock = document.getElementById('clockDisplay');
	myClock.textContent = "00:00:00";
	myClock.innerText = "00:00:00";
	tiles_flipped = 0;
	var output = '';
	var fn = '';
	var aspectratio = 'l';
	memory_array.memory_tile_shuffle();
	for (var i = 0; i < memory_array.length; i++) {
		fn = memory_array[i].fileNameTN;
		if (parseInt(memory_array[i].pictHeight,10) > parseInt(memory_array[i].pictWidth, 10))
		{
			aspectratio = 'p';
		} else
		{
			if (parseInt(memory_array[i].pictHeight,10) < parseInt(memory_array[i].pictWidth, 10))
			{
				aspectratio = 'l';
			} else
			{
				aspectratio = 's';
			}
		}
		output += '<div id="tile_' + i + '" onclick="memoryFlipTile(this,\'' + fn + '\', \'' + aspectratio + '\')"></div>';
	}
	document.getElementById('memory_board').innerHTML = output;
}
 
/***************************************************************************************************
*********
***************************************************************************************************/
function flip2Back() {
	// Flip the 2 tiles back over
		var tile = [];
		for (var i = 0; i < memory_values.length; i++) {
			tile[i] = document.getElementById(memory_tile_ids[i]);
			tile[i].style.background = 'url(css/cardJHMZ.jpg) no-repeat';
			tile[i].innerHTML = "";
		}
		memory_values = [];
		memory_tile_ids = [];
}


/***************************************************************************************************
*********
***************************************************************************************************/
function memoryFlipTile(tile, val, ar) {
	var setL;
	
	if (start === 0)
	{
		start = 1;
		renderTime();
	}
	if (gameID == 1)
		{ setL = 2; }
		else
		{ setL = 3;	}
		
	if (memory_values.length == setL) {
		flip2Back();
	}
	if (tile.innerHTML === "" && memory_values.length < setL) {
		tiles_used++;
		myTurned.textContent = tiles_used;
		myTurned.innerText = tiles_used;
		tile.style.background = '#FFF';
		if (ar == 'p')
		{
			tile.innerHTML = "<img src='" + val + "' width='100%' style='position: absolute; top: -20px; left: 0px'/>";			
		} else
		{
			if (ar == 'l')
			{
				tile.innerHTML = "<img src='" + val + "' height='100%' style='position: absolute; left: -30px; top: 0px'/>";
			} else
			{
				tile.innerHTML = "<img src='" + val + "' height='100%' style='position: absolute; left: 0px; top: 0px'/>";			
			}
		}

		if (memory_values.length < setL - 1) {
			memory_values.push(val);
			memory_tile_ids.push(tile.id);
		} else 
			if (memory_values.length < setL) {
			memory_values.push(val);
			memory_tile_ids.push(tile.id);

			if (memory_values[0] == memory_values[setL - 1] && memory_values[0] == memory_values[setL - 2]) {
				tiles_flipped += setL;
				myFound.textContent = tiles_flipped;
				myFound.innerText = tiles_flipped;
				// Clear both arrays
				memory_values = [];
				memory_tile_ids = [];
				// Check to see if the whole board is cleared
				if (tiles_flipped == memory_array.length) {
					loop = clearTimeout(loop);
					var myTime = document.getElementById('clockDisplay');
					var tijd = myTime.innerText;
					setBestScores(userID, tiles_used, tijd, callBack);
					getBestScores(userID);
					getBestGlobalScores();
				}
			}
		}
	}
}
/***************************************************************************************************
*********
***************************************************************************************************/
function renderTime() {
	if (start !== 0)
	{
		var myClock = document.getElementById('clockDisplay');
		var H, M, S;
		if (myClock.textContent == "00:00:00") {
			s = 0;
			m = 0;
			h = 0;
		}
		if (myClock.innerText == "00:00:00") {
			s = 0;
			m = 0;
			h = 0;		
		}
	
		s++;
		if (s > 59) {
			m++;
			s = 0;
		}
		if (m > 59) {
			h++;
			m = 0;
		}
		loop = setTimeout("renderTime()",1000);
		if (h < 10) {
			H = "0" + h;
		} else {
			H = h;
		}
		if (m < 10) {
			M = "0" + m;
		} else {
			M = m;
		}
		if (s < 10) {
			S = "0" + s;
		} else {
			S = s;
		}
		myClock = document.getElementById('clockDisplay');
		myClock.textContent = H + ":" + M + ":" + S;
		myClock.innerText = H + ":" + M + ":" + S;
	}		
}
