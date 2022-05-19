<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

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
<body>
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
        <a href="logout.php" class="btn btn-danger">Wyloguj</a>
    </div>


    <?php
$user = $_SESSION["user"];
$pass = $_SESSION["pass"];

$connect = mysqli_connect("localhost", $user, $pass, "menagerPlikow");
$zap = "select * from $user";
$wyn = mysqli_query($connect, $zap);
$count = mysqli_num_rows($wyn);



    ?>
    <main class="d-flex w-100 align-items-center flex-column">
        <table class="m-3">
            <tr>
                <td>platforma</td>
                <td>login</td>
                <td>hasło</td>
            </tr>
            <?php
while($rec = mysqli_fetch_row($wyn)){
    echo "<tr><td>$rec[1]</td><td>$rec[2]</td><td class='pass' onclick='navigator.clipboard.writeText(\"$rec[3]\")'></td></tr>";
}
            ?>
        </table>
        <a href="addRecord.php" class="btn btn-primary">Dodaj rekord!</a>
    </main>
    <div class="errorMessage m-3 d-flex justify-content-center"><?php echo $errorMessage; ?></div>

</body>
</html>