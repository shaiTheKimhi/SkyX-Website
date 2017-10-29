<html>
<head>
<title>HomePage</title>
<style>
    #tlog{
        background-color:lightblue;
        border-radius:25px;
    }
    input{
        border:none;
        border-radius:25px;
        height:40px
    }
</style>
<link rel="stylesheet" href="assets/css/main.css" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3mobile.css">
</head>
<body>

    <?php
       session_start();
       require("header.php");
       if (isset($_SESSION["username"])) {
           require("loggedinmenu.php");
       }
       else {
           require("menu.php"); 
       }
       ?>
       <?php
       $file = fopen("aboutUs.txt","r+");
       $cont = str_replace("\n","<br/>",fread($file,1000));
       $parts = explode(";",$cont);
       if(sizeof($parts)>1)
       {    
        echo("<div id='part1'>$parts[0]</div>");
        echo("<div id='part2'>$parts[1]</div>");
       }
       ?>

<section id="one" class="wrapper style2">
				<div class="inner">
					<div class="grid-style">

						<div>
							<div class="box">
								<div class="image fit">
									<!--<img src="images/pic02.jpg" alt="" />!-->
								</div>
								<div class="content">
									<header class="align-center">
										<p>More about us</p>
										<h2>Who are we?</h2>
									</header>
									<p id='about' style="display:none"></p>
									<footer class="align-center">
										<a  class="button alt" onclick="show('about')">Learn More</a>
									</footer>
								</div>
							</div>
						</div>

						<div>
							<div class="box">
								<div class="image fit">
									<!--<img src="images/pic01.jpg" alt="" />!-->
								</div>
								<div class="content">
									<header class="align-center">
										<p>How it all started</p>
										<h2>The origin</h2>
									</header>
									<p id='origin' style='display:none'></p>
									<footer class="align-center">
										<a  class="button alt" onclick="show('origin')">Learn More</a>
									</footer>
								</div>
							</div>
						</div>

					</div>
				</div>
			</section>



       <!---         JAVASCRIPT PART        !-->
       <script>
           document.getElementById("part1").style["display"] = "none";
           document.getElementById("part2").style["display"]="none";
           var part1 = document.getElementById("part1").innerText;
           var part2 = document.getElementById("part2").innerText;
           document.getElementById("about").innerText = part1;
           document.getElementById("origin").innerText = part2;
       </script>
       <script src="assets/js/jquery.min.js"></script>
       <script src="assets/js/jquery.scrollex.min.js"></script>
       <script src="assets/js/skel.min.js"></script>
       <script src="assets/js/util.js"></script>
       <script src="assets/js/main.js"></script>
      
</body>