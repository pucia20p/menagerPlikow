<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <?php
session_start();
include "functions/loginChecker.php";
if(!loginChecker() || $_SESSION["perms"] <= 0){
    header("Location: login.php");
}
    ?>
    <div class="m-3 d-flex flex-column align-items-end">
        <a href="logout.php" class="btn btn-danger mb-3">Wyloguj</a>
    </div>
    <div class="m-3 ">
        <?php echo "Zalogowany user: ".$_SESSION["user"]; ?>
    </div>
    

    
</body>
</html>