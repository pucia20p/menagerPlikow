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
function isInBase($nick){
    $userData = readLogins("validate.txt", "😎");
    foreach($userData as $info){
        if($info[0] == $nick){
            return true;
        }
    }
    return false;
}

function checkPattern($mask, $input){
    return preg_match($mask, $input) && strlen($input) >= 8; //I forgot to put here strlen(), so i was quite worried why "12345abc" worked and "abcdefgh" didn't :kekw:
}

function addUser($nick, $pass, $fileName, $splitter){
    $file = fopen($fileName, 'a');
    fwrite($file, $nick.$splitter.$pass.$splitter."1\n");
}


if(!isSetted($_GET["nick"]) || !isSetted($_GET["password"])){
    $_SESSION["errorMessage"] = "Wypełnij wszystkie pola!";
    header("Location: register.php");
} else if(isInBase($_GET["nick"])){
    $_SESSION["errorMessage"] = "Taki użytkownik już istnieje!";
    header("Location: register.php");
} else if(!checkPattern('/^[A-Za-z0-9]/', $_GET["nick"])){
    $_SESSION["errorMessage"] = "Login może mieć tylko 8 znaków i składać się tylko z liter i cyfr!";
    header("Location: register.php");
} else if(!checkPattern('/^[!@#%&*_+-=a-zA-Z0-9]/', $_GET["password"])) {
    $_SESSION["errorMessage"] = "Hasło musi mieć więcej niż 8 znaków i nie może zawierać niepoprawnych znaków!";
    header("Location: register.php");
} else {
    addUser($_GET["nick"], $_GET["password"], "validate.txt", "😎");
    $_SESSION["errorMessage"] = "Pomyślnie utworzono użytkownika.";
    header("Location: login.php");
}