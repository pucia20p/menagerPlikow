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
        if(password_verify($nick, $info[0])){
            return true;
        }
    }
    return false;
}

function checkPattern($mask, $input){
    return preg_match($mask, $input); //I forgot to put here strlen(), so i was quite worried why "12345abc" worked and "abcdefgh" didn't :kekw:
}

function addUser($nick, $pass, $fileName, $splitter){
    $true = true;

    
    $file = fopen("files/$nick.txt", "a");
    fwrite($file, "");
    if($true){
        $_SESSION["errorMessage"] = "Pomyślnie utworzono użytkownika.";
        $file = fopen($fileName, 'a');
        fwrite($file, password_hash($nick, PASSWORD_DEFAULT).$splitter.password_hash($pass, PASSWORD_DEFAULT).$splitter."2\n");
    } else {
        $_SESSION["errorMessage"] = "NiePomyślnie utworzono użytkownika.";
    }
    fclose($file);
    
}


if(!isSetted($_POST["nick"]) || !isSetted($_POST["password"])){
    $_SESSION["errorMessage"] = "Wypełnij wszystkie pola!";
    header("Location: register.php");
} else if(isInBase($_POST["nick"])){
    $_SESSION["errorMessage"] = "Taki użytkownik już istnieje!";
    header("Location: register.php");
} else if(!checkPattern('/^[A-Za-z0-9]/', $_POST["nick"]) || strlen($_POST["nick"]) < 3){
    $_SESSION["errorMessage"] = "Login może mieć min. 3 znaki i składać się tylko z liter i cyfr!";
    header("Location: register.php");
} else if(!checkPattern('/^[!@#%&*_+-=a-zA-Z0-9]/', $_POST["password"]) || strlen($_POST["password"]) < 8) {
    $_SESSION["errorMessage"] = "Hasło musi mieć przynajmniej 8 znaków i nie może zawierać niepoprawnych znaków!";
    header("Location: register.php");
} else {
    addUser($_POST["nick"], $_POST["password"], "validate.txt", "😎");
    
    header("Location: login.php");
}