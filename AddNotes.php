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
<?php
    main();
    function main()
    {
        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            $DirPath = "";
            $file = fopen($DirPath."Notes.txt","a+");
            $notes = json_decode(fread($file,10000),true);
            $username = isset($_SESSION["username"])?$_SESSION["username"]:"Anonymous";
            $title = $_POST["Title"];
            $text = $_POST["Text"];
            if($title==""||$text=="")
                echo "<div id='err'>You must enter values</div>";
            $i=NoteExists($notes,$text);
            if($i!=-1)
            {
                echo "<div id='err'>$i</div>";
            }
            
        }
    }
    function NoteExists($notes,$text)
    {
        for($i=0;$i<sizeof($notes);$i++)
        {
            if(strtolower($notes[$i]["Text"])==strtolower($text))
                return $i;
        }
        return -1;
    }

?>
<form action='' method='post' id='frm'>
        <div class='box' id='logBox'>
            <div class='content'>
                <header class='align-center'>
            <table>
            <tr><td colspan='2'><h1 id='title'></h1></td></tr>
            <tr><td><h4 id='etitle'>Enter title:</h4></td><td><div class='6u 12u$(xsmall)'>
                <input  type='text' name='Title' id='title' value='' placeholder='Title' /></div></td></tr>
            <tr><td><h4 id='etext'>Enter Note Text:</h4></td><td><div class='6u 12u$(xsmall)'>
                    <textarea   name='Text' id='text' value='' placeholder='Text'></textarea></div></td></tr>
            <tr><td colspan='2'><input type='button' value='send' style='width:500px;height:100px' onclick='Send()'></td></tr>
            <tr><td colspan='2'><h4 id='errors' style='color:red' align='center'></h4></td></tr>
        </table>
        </header>
        </div>
            </div>
            <input name='type' name='Type' id='type' type='text' style='display:none'>
    </form>

</body>
<script>
    function Send()
    {
        var title = document.getElementById("title");
        var text = document.getElementById("text");
        if(text.value==""||title.value==""){
            "You must enter values".error();
            return;
        }
        else 
            "".error();
        document.getElementById("frm").submit();
    }
    String.prototype.error = function()
    {
        document.getElementById("errors").innerHTML = this;
    }
    var err = document.getElementById("err");
    if(err!=undefined){
        if(err.innerText!="You must enter values"){
            var str="<a href='Notes.php/#"+err.innerText+"'>Note already exist</a>";
            str.error();
        }
        else 
            "You must Enter values".error();
    }
</script>
<script>
    var erelsize = 0.28294177732379977;
    var trelsize =0.8855975485188968;
    var title = document.getElementById("title");
    var text = document.getElementById("text");
    //text.style["width"]=document.documentElement.clientWidth-text.getBoundingClientRect().left;
    //text.style["width"] = "150px";
    /*document.getElementById("etitle").style.width = document.documentElement.clientWidth*erelsize;
    document.getElementById("etext").style.width = document.documentElement.clientWidth*erelsize;
    title.style.width = document.documentElement.clientWidth*trelsize;
    text.style.width = document.documentElement.clientWidth*trelsize;*/
</script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.scrollex.min.js"></script>
<script src="assets/js/skel.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>
</html>