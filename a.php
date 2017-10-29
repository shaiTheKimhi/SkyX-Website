<?php
    $file = fopen("Users.txt","a+");
    $str = fread($file,5);
    echo($str);
    $temp = fopen("Users.txt","w+");
    fclose($temp);
    fclose($file);
?>