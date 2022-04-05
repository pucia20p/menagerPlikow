<?php
session_start();
function isSetted($z){
    return isset($z) && $z != " " && $z != "";
}
function readLogins($fileName, $splitter){ //zwróć tablicę 2wymiarową
    $file = fopen($fileName, "r") or die("Nie morzna otworzyć pliku!");
    $i=0;
    while(($line = fgets($file)) != false){
        $inputs[$i] = explode($splitter, $line);
        $i++;
    }
    fclose($file);
    return $inputs;
}
function checkUsers($data, $login, $password){
    return $data[0] == $login && $data[1] == $password;
}
function checkInputs($nick, $pass){
    $userData = readLogins("validate.txt", "😎");
    foreach($userData as $info){
        if(checkUsers($info, $nick, $pass)){
            $_SESSION["user"] = $nick;
            $_SESSION["perms"] = intval($info[2]);
            return true;
        } else {
            $_SESSION["errorMessage"] = "Niepoprawny login/hasło!";
        }
    }
    return false;
}
if(!isSetted($_GET["nick"]) || !isSetted($_GET["password"])){
    $_SESSION["errorMessage"] = "Wypełnij wszystkie pola!";
    header("Location: login.php");
} else if(checkInputs($_GET["nick"], $_GET["password"])){
    header("Location: index.php"); 
} else {
    header("Location: login.php");
}
