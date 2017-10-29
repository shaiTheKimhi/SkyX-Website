<header id="header" style='background-color:blue;color:cornsilk' >
				<div class="logo"><a href="index.php"><span style='background-color:blue;color:cornsilk'>SkyX- the flight assistnat</span></a></a></div>
				<a href="#menu">Menu</a>
				
			</header>
			
<!--<div id="batteryDiv" style="position: fixed; bottom: 0; left: 0; width: 1%; z-index: 10000; background-color: red;">&nbsp;</div>
-->

<script>
 function show(sender)
{
	var elm = document.getElementById(sender);
	elm.style["display"]=elm.style["display"]=="none"?"":"none";
}
/*window.onload = function() {
	if (!localStorage.getItem("battery")) {
		localStorage.setItem("battery", (new Date().getTime() + 1000 * 60 * 100).toString());
	}
	function pad2(s) {
		pad = "00";
		return pad.substring(0, 2 - s.length) + s;
	}*/
	/*setInterval(function() {
		if (localStorage.getItem("battery") == "-1") {
			return;
		}
		time = parseInt(localStorage.getItem("battery")) - new Date().getTime();
		time /= 60000;
		time = Math.round(time);
		document.getElementById("batteryDiv").style.height = time + "%";
		document.getElementById("batteryDiv").style.backgroundColor = "#" + "%c%c00".replace("%c", pad2((Math.round(255 - time * 2.5)).toString(16))).replace("%c", pad2((Math.round(time * 2.5)).toString(16)));
		x = document.getElementById("showDiv");
		if (x) {
			x.innerText = time + "%";
		}
		if (time <= 0) {
			localStorage.setItem("battery", "-1");
			alert("You lost! Your time is over. However, you can definitely keep playing even though your battery has drained.");
		}
	}, 100);
};*/
</script>