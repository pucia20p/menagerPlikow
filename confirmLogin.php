<?php
session_start();
include "functions/loginChecker.php";
if(loginChecker()){
    header("Location: index.php");
}

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
    return password_verify($login, $data[0]) && password_verify($password, $data[1]);
}
function checkInputs($nick, $pass){
    $userData = readLogins("validate.txt", "😎");
    foreach($userData as $info){
        if(checkUsers($info, $nick, $pass)){
            $_SESSION["user"] = $nick;
            $_SESSION["pass"] = $pass;
            $_SESSION["perms"] = intval($info[2]);
            $_SESSION["errorMessage"] = null;
            return true;
        } else {
            $_SESSION["errorMessage"] = "Niepoprawny login/hasło!";
        }
    }
    return false;
}
if(!isSetted($_POST["nick"]) || !isSetted($_POST["password"])){
    $_SESSION["errorMessage"] = "Wypełnij wszystkie pola!";
    header("Location: login.php");
} else if(checkInputs($_POST["nick"], $_POST["password"])){
    header("Location: index.php"); 
} else {
    header("Location: login.php");
}
