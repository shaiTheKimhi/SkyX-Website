<?php
$DirPath = "";
$type = $_GET["type"];
$fusers = fopen($DirPath."Users.txt","a+");
if($type=="r")
{
    $users = json_decode(fread($fusers,10000),true);
    $username = $_GET["username"];
    if(findUser($users,$username)!=-1)
    {
        echo("-1");
    }
    else
        echo("0");
}
else
{
    $users = json_decode(fread($fusers,10000),true);
    $username = $_GET["username"];
    $password = $_GET["password"];
    $index = findUser($users,$username);
    if($index==-1)
        echo("-1");
    else if($users[$index]["$Password"]==$password)
        echo("0");
    else 
        echo("-1");
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