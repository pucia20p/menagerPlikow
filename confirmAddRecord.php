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
    $connect = mysqli_connect("localhost", $user, $pass, "menagerPlikow");
    $true = mysqli_query($connect, "insert into $user values ('', '$platform', '$nick', '$password')") ? $true : false;

    $_SESSION["errorMessage"] = $true ? "Sukcesywnie dodano rekord!" : "Coś źle się stało :( nie wiem co :)";
}
$header = $true ? "index.php" : "addRecord.php";

header("Location: $header");


?>