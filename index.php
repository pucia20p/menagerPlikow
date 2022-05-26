<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <style>
        table{
            border: 1px solid black;
        }
        tr{
            display: flex;
            flex-direction: row;
        }
        td{
            width: 200px;
            height: 50px;
            border: 1px solid black;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
    </style>
</head>
<body class="bg-secondary text-info">
    <?php
session_start();
include "functions/loginChecker.php";
if(!loginChecker() || $_SESSION["perms"] <= 0){
    header("Location: login.php");
}
$errorMessage = "";
if(isset($_SESSION["errorMessage"])){
    $errorMessage = $_SESSION["errorMessage"];
    $_SESSION["errorMessage"] = null;
}
    ?>
    <div class="m-3 d-flex flex-row justify-content-end align-items-center">
        <div class="mx-3"><?php echo "Zalogowany user: ".$_SESSION["user"]; ?></div>
        <a href="login.php" class="btn btn-danger">Wyloguj</a>
    </div>


    <?php
$user = $_SESSION["user"];
$pass = $_SESSION["pass"];

function readLogins($fileName, $splitter){ //zwróć tablicę 2wymiarową
    $inputs[0][0] = "💀";
    $file = fopen($fileName, "r") or die("Nie morzna otworzyć pliku!");
    $i=0;
    while(($line = fgets($file)) != false){
        $inputs[$i] = explode($splitter, $line);
        $i++;
    }
    fclose($file);
    return $inputs;
}



    ?>
    <main class="d-flex w-100 align-items-center flex-column">
        <table class="m-3 bg-light text-dark">
            <tr class="bg-primary fw-bold text-light">
                <td>platforma</td>
                <td>login</td>
                <td>hasło</td>
            </tr>
            <?php
$read = readLogins("files/$user.txt", "😎");
if($read[0][0] != "💀"){
    foreach($read as $rec){
        echo "<tr><td>$rec[0]</td><td>$rec[1]</td><td class='pass text-warning bg-dark' onclick='navigator.clipboard.writeText(\"$rec[2]\")' onmouseover='mouseov(this)' onmouseout='mouseou(this)' ondblclick='revealPass(this, \"$rec[2]\")'></td></tr>";
    }
}
            ?>
        </table>
        <a href="addRecord.php" class="btn btn-primary">Dodaj rekord!</a>
    </main>
    <div class="errorMessage m-3 d-flex justify-content-center"><?php echo $errorMessage; ?></div>

    <script>
function mouseov(that){
    that.innerText = "Kliknij aby skopiować hasło";
}
function mouseou(that){
    that.innerText = "";
}
function revealPass(that, pass){
    that.innerText = pass;
}
    </script>
</body>
</html>