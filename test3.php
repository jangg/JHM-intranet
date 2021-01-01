<!--Copyright to Shen Huang, you can reach me out at shenhuang@live.ca-->
	<!DOCTYPE html>
	<meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
	<html>
	 <head>
	  <title>FIREWORK DEMO</title>
	  <style>
	   body {
		background-color : #001126;
	   }
	   @keyframes    firework-animation {
		   0% {background-color : #ff8426;}
		   25% {background-color : #fffc84;}
		   50% {background-color : #ff83f4;}
		   75% {background-color : #83b6ff;}
		   100% {background-color : #ff8426;}
	   }
	   @-webkit-keyframes firework-animation {
		   0% {background-color : #ff8426;}
		   25% {background-color : #fffc84;}
		   50% {background-color : #ff83f4;}
		   75% {background-color : #83b6ff;}
		   100% {background-color : #ff8426;}
	   }
	   .fireWorkParticle {
		   z-index : 999;
		   position: absolute;
		   height : 5px;
		   width : 5px;
		   border-radius : 5px;
		   animation-name : firework-animation;
		   animation-timing-function : linear;
		   animation-duration : 1s;
		   animation-iteration-count : infinite;
	   }
	  </style>
	 </head>
	 <body>
	  <!-- YOUR PRECIOUS HTML CODE GOES HERE -->
	  <div class = "fireWorkParticle"></div>
	  <div id = "board"></div>
	 </body>
	 <script>
	  // YOUR SUPPER COOL SCRIPTS GOES HERE
	  // function newFireworkParticle(x, y, angle)
	  // {
		//  var fwkPtc = document.createElement("DIV");
		//  fwkPtc.setAttribute('class', 'fireWorkParticle');
		//  fwkPtc.position = [];
		//  fwkPtc.position.x = x;
		//  fwkPtc.position.y = y;
		//  fwkPtc.style.left = fwkPtc.position.x + 'px';
		//  fwkPtc.style.top = fwkPtc.position.y + 'px';
		//  brd.appendChild(fwkPtc);
		//  particles.push(fwkPtc);
		//  return fwkPtc;
	  // }
	  function newFireworkParticle(x, y, angle)
	  {
		 var fwkPtc = document.createElement("DIV");
		 fwkPtc.setAttribute('class', 'fireWorkParticle');
		 brd.appendChild(fwkPtc);
		 fwkPtc.time = fwkPtcIniT;
		 while(angle > 360)
		  angle -= 360;
		 while(angle < 0)
		  angle += 360;
		 fwkPtc.velocity = [];
		 if(angle > 270)
		 {
		  fwkPtc.velocity.x = fwkPtcIniV * Math.sin(angle * Math.PI / 180);
		  fwkPtc.velocity.y = fwkPtcIniV * Math.cos(angle * Math.PI / 180);
		 }
		 else if(angle > 180)
		 {
		  fwkPtc.velocity.x = fwkPtcIniV * Math.sin(angle * Math.PI / 180);
		  fwkPtc.velocity.y = fwkPtcIniV * Math.cos(angle * Math.PI / 180);
		 }
		 else if(angle > 90)
		 {
		  fwkPtc.velocity.x = fwkPtcIniV * Math.sin(angle * Math.PI / 180);
		  fwkPtc.velocity.y = fwkPtcIniV * Math.cos(angle * Math.PI / 180);
		 }
		 else
		 {
		  fwkPtc.velocity.x = fwkPtcIniV * Math.sin(angle * Math.PI / 180);
		  fwkPtc.velocity.y = fwkPtcIniV * Math.cos(angle * Math.PI / 180));
		 }
		 fwkPtc.position = [];
		 fwkPtc.position.x = x;
		 fwkPtc.position.y = y;
		 fwkPtc.style.left = fwkPtc.position.x + 'px';
		 fwkPtc.style.top = fwkPtc.position.y + 'px';
		 if(seeds == null)
		  seeds = [];
		 particles.push(fwkPtc);
		 return fwkPtc;
	  }
	  
	  var before = Date.now();
	  var id = setInterval(frame, 5);
	  function frame()
	  {
		 var current = Date.now();
		 var deltaTime = current - before;
		 before = current;
		 for(i in particles)
		 {
		  var fwkPtc = particles[i];
		  fwkPtc.time -= deltaTime;
		  if(fwkPtc.time > 0)
		  {
		   fwkPtc.velocity.x -= fwkPtc.velocity.x * a * deltaTime;
		   fwkPtc.velocity.y -= g * deltaTime + fwkPtc.velocity.y * a * deltaTime;
		   fwkPtc.position.x += fwkPtc.velocity.x * deltaTime;
		   fwkPtc.position.y -= fwkPtc.velocity.y * deltaTime;
		   fwkPtc.style.left = fwkPtc.position.x + 'px';
		   fwkPtc.style.top = fwkPtc.position.y + 'px';
		  }
		  else
		  {
		   fwkPtc.parentNode.removeChild(fwkPtc);
		   particles.splice(i, 1);
		  }
		 }
	  }
	  
	  var brd = document.createElement("DIV");
	  document.body.insertBefore(brd, document.getElementById("board"));
	  particles = [];
	  const fwkPtcIniV = 0.5;
	  const fwkPtcIniT = 2500;
	  const a = 0.0005;
	  const g = 0.0005;
	  newFireworkParticle(200, 200, 30);
	  
	 </script>
	</html>