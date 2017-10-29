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

       main();
       function main()
       {
           //error_reporting(0);
           $DirPath = "";
            if($_SERVER["REQUEST_METHOD"]=="POST")
            {
                $username = $_POST["Username"];
                $password = $_POST["Password"];
                if($username==""||$password=="")
                {
                    echo("<center>");
                    echo("<h1 id='err'>You Must Enter Values</h1>");
                    Login();
                    echo("</center>");
                    return;
                }
                else if(strlen($username)<4)
                {
                    echo("<center>");
                    echo("<h1 id='err'>Username Must Contains at least 4 characters</h1>");
                    Login();
                    echo("</center>");
                    return;
                }
                else if(strlen($password)<3)
                {
                    echo("<center>");
                    echo("<h1 id='err'>Password Must Contains at least 3 characters</h1>");
                    Login();
                    echo("</center>");
                    return;
                }
                if($_POST["type"]=="Login")
                {
                    $fusers = fopen($DirPath."Users.txt","a+");
                    $users = json_decode(fread($fusers,10000),true);
                    $index = findUser($users,$username);
                    if($index==-1)
                    {
                        fclose($fusers);
                        echo("<center>");
                        echo("<h1 id='err'>Username or Password not correct</h1>");
                        Login();
                        echo("</center>");
                        return;
                    }
                    if($users[$index]["Password"]==$password)
                        $_SESSION["username"] = $username;
                    else{
                        fclose($fusers);
                        echo("<center>");
                        echo("<h1 id='err'>Username or Password not correct</h1>");
                        Login();
                        echo("</center>");
                        return;
                    }
                    fclose($fusers);
                }
                else
                {
                    $email = $_POST["Email"];
                    $fusers = fopen($DirPath."Users.txt","a+");
                    $users = json_decode(fread($fusers,10000),true);
                    if($password!=$_POST["Rpass"])
                    {
                        echo("<center>");
                        echo("<h1 id='err'>Passwords does not match</h1>");
                        Login();
                        echo("</center>");
                        fclose($fusers);
                        return;
                    }
                    if(findUser($users,$username)==-1)
                    {
                        $index = sizeof($users);
                        $users[$index]["Username"] = $username;
                        $users[$index]["Password"] = $password;
                        $users[$index]["Email"] = $email;
						if($username!="shai")
                            $users[$index]["Permissions"]=1;
                        else 
                            $users[$index]["Permissions"]=3;
                        fclose(fopen($DirPath."Users.txt","w+"));
                        fwrite($fusers,json_encode($users));
                        //echo(json_encode($users));
                    }
                    else 
                    {
                        if($_SESSION["username"]!="")
                        {
                            
                        }
                        fclose($fusers);
                        echo("<center>");
                        echo("<h1 id='err'>Username Already exist</h1>");
                        Login();
                        echo("</center>");
                        return;
                    }
                }
            }
            else
            {
                echo("<center>");
                Login();
                echo("</center>");
            }
       }
       function options($DirPath)
       {
           $per=0;
           if($_SESSION["username"]!=null)
           {
               $fusers = fopen($DirPath."Messages.txt");
               $users = json_decode(fread($fusers,10000),true);
               $index = findUser($users,$_SESSION["username"]);
               $per = $users[$index]["Permissions"];
           }
           switch($per)
           {
               case 0:
                echo("");
           }
       }
       function Login()
       {
           //$type = json_encode($_POST);
           echo(" <form action='' method='post' id='frm'>
           <div class='box' id='logBox'>
               <div class='content'>
                   <header class='align-center'>
               <table>
               <tr><td colspan='2'><h1 id='title'></h1></td></tr>
               <tr><td><h4>Username</h4></td><td><div class='6u 12u$(xsmall)'>
                   <input style='width:300px' type='text' name='Username' id='username' value='' placeholder='User Name' /></div></td></tr>
               <tr><td><h4>Password</h4></td><td><div class='6u$ 12u$(xsmall)'>
                   <input style='width:300px' type='password' name='Password' id='password' value='' placeholder='Password' /></div></td></tr>
                   <tr id='RpassRow'><td><h4>Repeat Password</h4></td><td><div class='6u$ 12u$(xsmall)'>
                   <input type='password' name='Rpass' id='rpassword' style='width:300px' placeholder='Repeat Password'></div></td></tr>
                   <tr id='emailRow'><td><h4>Email</h4></td><td><div class='6u$ 12u$(xsmall)'><input type='text' name='Email' id='email' style='width:300px' placeholder='Email'></div></td></tr>
                   <tr><td><input type='button' onclick='Login()' value='Login' id='login'></td>
                   <td><input type='button' onclick='Register()' value='Register' id='register'></td></tr>
               <tr><td colspan='2'><input type='button' value='send' style='width:500px;height:100px' onclick='Send()'></td></tr>
               <tr><td colspan='2'><h4 id='errors' style='color:red' align='center'></h4></td></tr>
           </table>
           </header>
           </div>
               </div>
               <input name='type' name='Type' id='type' type='text' style='display:none'>
       </form>");
           /* echo("<div id='logBox'><form action='' method='post' id='frm'>");
            echo("<input type='text' style='display:none' id='type' name='Type'>");
            echo("<table id='tlog'>");
            echo("<tr><td colspan='2'><h1 id='title'></h1></td></tr>");
            echo("<tr id='nameRow'><td><h2>Username</h2></td><td><input type='text' name='Username' id='username'/><td></tr>");
            echo("<tr id='passRow'><td><h2>Password</h2></td><td><input type='password' name='Password' id='password'></td></tr>");
            echo("<tr id='RpassRow'><td><h2>Repeat Password</h2></td><td><input type='password' name='Rpass' id='rpassword'></td></tr>");
            echo("<tr id='emailRow'><td><h2>Email</h2></td><td><input type='text' name='Email' id='email'></td></tr>");
            echo("<tr><td><input type='button' onclick='Login()' value='Login' id='login'></td>");
            echo("<td><input type='button' onclick='Register()' value='Register' id='register'></td></tr>");
            echo("<tr><td colspan='2'><input type='button' onclick='Send()' value='Submit'></td></tr>");
            echo("<tr><td colspan='2'><h4 id='errors' style='color:red'></h4></td></tr>");*/
       }
       function findUser($users,$username)
       {
            for($i=0;$i<sizeof($users);$i++)
            {
                if($users[$i]["Username"]==$username){
                    return $i;
                }
            }
            return -1;
       }
    ?>



       
       <!---         JAVASCRIPT PART        !-->
       <!---         JAVASCRIPT PART        !-->
    <script src='jquery-3.2.1.min.js'></script>
    <script>
        String.prototype.Alert = function()
        {
            document.getElementById("errors").innerText=this;
        }
        function error(message)
        {
            document.getElementById("errors").innerText=message;
        }
        function mark(id)
        {
            var element = document.getElementById(id);
            if(element.style["background-color"]!="blue")
            {
                element.style="background-color:green";
            }
        }
        function disMark(id)
        {
            document.getElementById(id).style="background-color:white";
        }
        function Login()
        {
            document.getElementById("title").innerText = "Log-In";
            document.getElementById("type").value="Login";
            document.getElementById("login").style="background-color:blue;color:white";
            document.getElementById("register").style="background-color:white;color:black";
            document.getElementById("RpassRow").style="display:none";
            document.getElementById("emailRow").style = "display:none";
        }
        function Register()
        {
            document.getElementById("title").innerText = "Register";
            document.getElementById("type").value="Register";
            document.getElementById("login").style="background-color:white;color:black";
            document.getElementById("register").style="background-color:blue;color:white";
            document.getElementById("RpassRow").style="display:normal";
            document.getElementById("emailRow").style = "display:normal";
        }
        function Send()
        {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            if(username==""){
                    error("You Must Enter Username");
                    return;
                }
            if(password==""){
                error("You Must Enter Password");
                return;
            }
            if(document.getElementById("type").value=="Login")
            {  
                
                document.getElementById("frm").submit();
            }
            else
            {
                var rePassword = document.getElementById("rpassword").value;
                var email = document.getElementById("email").value;
                if(password!=rePassword){
                    error("Password does not Match");return;
                }
                if(email==""){
                    error("You Must Enter email");return;
                }
                if(password.length<3){
                    error("password must contain at least 3 characters");return;
                }
                if(password.length>12){
                    error("password cannot contain more than 12 characters");return;
                }
                if(username.length<4){
                    error("Username must contain at least 4 characters");return;
                }
                if(username.length>12){
                    error("Username cannot contain more than 12 characters");return;
                }
                document.getElementById("frm").submit();
            }
        }
        if(document.getElementById("type")!=undefined)
            Login();
        function httpRequest(url)
        {
            xmlhttp = new XMLHttpRequest();
            xmlhttp.open
        }
        function mark2()
        {
            var element = document.getElementById("err");
            if(element==undefined)
                return;
            element.innerText.Alert();
            element.style["display"] = "none";
        }
        mark2();
    </script>
    <script src="assets/js/jquery.min.js"></script>
       <script src="assets/js/jquery.scrollex.min.js"></script>
       <script src="assets/js/skel.min.js"></script>
       <script src="assets/js/util.js"></script>
       <script src="assets/js/main.js"></script>
</body>
</html>