<?php
function isSetted($z){
    return isset($z) && $z != " " && $z != "";
}
session_start();
$user = $_SESSION["user"];
$pass = $_SESSION["pass"];

$nick = $_POST["nick"];
$password = $_POST["password"];
$platform = $_POST["platform"];

$true = true;



if(!isSetted($_POST["nick"]) || !isSetted($_POST["password"]) || !isSetted($_POST["platform"])){
    $_SESSION["errorMessage"] = "Wypełnij wszystkie pola!";
    $true = false;
} else {
    $file = fopen("files/$user.txt", 'a');
    fwrite($file, $platform."😎".$nick."😎".$password."😎\n");
    fclose($file);
}
$header = $true ? "index.php" : "addRecord.php";
$_SESSION["errorMessage"] = $true ? "Sukcesywnie dodano rekord!" : "Coś źle się stało :( nie wiem co :)";
header("Location: $header");


?>