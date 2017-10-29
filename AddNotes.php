<html>
<head>
    <title>Add Note</title>
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
    require("header.php");
    if (isset($_SESSION["username"])) {
        require("loggedinmenu.php");
    }
    else {
        require("menu.php"); 
    }
?>
<form action='' method='post' id='frm'>
        <div class='box' id='logBox'>
            <div class='content'>
                <header class='align-center'>
            <table>
            <tr><td colspan='2'><h1 id='title'></h1></td></tr>
            <tr><td><h4>Enter title:</h4></td><td><div class='6u 12u$(xsmall)'>
                <input style='width:300px' type='text' name='Title' id='title' value='' placeholder='Title' /></div></td></tr>
            <tr><td><h4>Enter Note Text:</h4></td><td><div class='6u 12u$(xsmall)'>
                    <textarea style='width:500px'  name='Title' id='title' value='' placeholder='Title'></textarea></textarea></div></td></tr>
            <tr><td colspan='2'><input type='button' value='send' style='width:500px;height:100px' onclick='Send()'></td></tr>
            <tr><td colspan='2'><h4 id='errors' style='color:red' align='center'></h4></td></tr>
        </table>
        </header>
        </div>
            </div>
            <input name='type' name='Type' id='type' type='text' style='display:none'>
    </form>

</body>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.scrollex.min.js"></script>
<script src="assets/js/skel.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>
</html>