<html>
<head>
    <title>Message Sending</title>
    <style></style>
</head>
<body>
<center>
    <?php
        session_start();
        $DirPath = "";
        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            $title = $_POST["Title"];
            $text = $_POST["Text"];
            $username = $_SESSION["username"];  
            if($username==null)
                $username = "Anonymous";
            $fMsg = fopen($DirPath."Messages.txt","a+");
            $Messages = json_decode(fread($fMsg,10000),true);
            $index = sizeof($Messages);
            $Messages[$index]["Title"] = $title;
            $Messages[$index]["Text"] = $text;
            $Messages[$index]["Username"] = $username;
            fclose(fopen($DirPath."Messages.txt","w+"));
            fwrite($fMsg,json_encode($Messages));
            fclose($fMsg);
            echo("<h4>Message was successfully sent</h4>");
        }
        $fMsg = fopen($DirPath."Messages.txt","a+");
        $Messages = json_decode(fread($fMsg,10000),true);
         echo("<table class='comment'>");
        for($i=0;$i<sizeof($Messages);$i++)
        {
            $row = $Messages[$i];
            echo("<tr><td colspan='2' class='title'>".$row["Title"]."</td></tr>");
            echo("<tr><td colspan='2' class='text'>".$row["Text"]."</td></tr>");
            echo("<tr class='Username'><td>By:</td><td>".$row["Username"]."</td></tr>");
           echo("<tr><td style='color: white'>________</td></tr>");
        }
         echo("</table>");
        fclose($fMsg);
    ?>
    <form action='' method="POST" id="frm">
    <table>
        <tr><td colspan="2"><h1>Tell Us What You Think</h1></td></tr>
        <tr><td>Title</td><td><input type="text" name="Title" id="title"></td></tr>
        <tr><td colspan="2"><textarea name="Text" id="text" style="height:50px;width:225px"></textarea></td></tr>
        <tr><td colspan="2"><h3 id='errors' style='display: none'></h3></td></tr>
        <tr><td colspan="2"><input type="button" value="send" onclick="Send()"></td></tr>
    </table>
    </form>
    </center>

    <!------JavaScript------>
    <script type="text/javascript">
        String.prototype.contains = function(substring)
        {
            var counter=0;
            for(i=0;i<this.length;i++)
            {
                if(this[i] == substring[counter])
                    counter++;
                else
                    counter=0;
                if(counter==substring.length)
                    return true;
            }
            return false;
        }
        String.prototype.replace = function(original,New)
        {
            for(i=0;i<this.length;i++)
            {
                if(this[i]==original)
                    this[i]=New;
            }
        }
        function Send()
        {
            var title = document.getElementById("title").value;
            var text = document.getElementById("text").value;
            title.replace(' ','');
            text.replace(' ','');
            title = title.toLowerCase();
            text = text.toLowerCase();
            if(title==""||text=="")
                error("You must Enter values");
            else if(title.contains("<script>")||text.contains("<script>"))
                error("Do not enter JS scripts");
            else
                document.getElementById("frm").submit();
        }
        function error(Message)
        {
            var error = document.getElementById("errors");
            error.style="display:normal";
            error.innerText = Message;
        }
        function httpGet(url)
        {
            xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET",url,false);
            xmlhttp.send(null);
            return XMLHttpRequest.responseText;
        }
    </script>
</body>
</html>