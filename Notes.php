<html>
<head>
    <title>See All Notes</title>
    style>
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
    <section id="one" class="wrapper style2">
    <div class="inner">
    <div class="grid"
    <?php
        main();
        function main()
        {
            $DirPath="";
            $file = fopen($DirPath."Notes.txt","r+");
            $content = json_decode(fread($file,10000),true);
            for($i=0;$i<sizeof($content);$i++)
            {
                $item = $content[$i];
                echo Note($item["Title"],$item["Text"],$item["Username"],$i);
            }
        }    
        function Note($title,$text,$name,$serial)
        {
            $username = $name=="Anonymous"?$name:"Written By:".$name;
            return "<div class='box'>
            <div class='content'>
                <header class='align-center'>
                    <h2>$title</h2>
                </header>
                <center>
                <h4 style='color:gray' id='$serial'>$text</h4>
                </center>
                <footer class='align-left'>
                <p>$username</p>
                </footer>
            </div>
        </div>";
        }
    ?>
    </div>
    </div></section>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.scrollex.min.js"></script>
    <script src="assets/js/skel.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>