<?php
//This file checks whether the Message written already exists in the database.
$DirPath = "";
$file = fopen($DirPath."Messages.txt","a+");
$messages = json_decode(fread($file,10000),true);
if(ArrDictContains($messages,"Title",$_GET["title"]))
    echo("yes");
else 
    echo("no");
fclose($file);

function ArrDictContains($ArrDict,$key,$value)
{
    for($i=0;$i<sizeof($ArrDict);$i++)
    {
        $Dict = $ArrDict[$i];
        if($Dict[$key]==$value)
            return true;
    }
    return false;
}

?>