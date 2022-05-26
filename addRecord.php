<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Document</title>
</head>
<body class="bg-secondary text-info">
    
    <form class="m-3 d-flex flex-column align-items-center fw-bold text-light" action="confirmAddRecord.php" method="POST">
        <h2 class="text-warning">Dodawanie rekordów: </h2>
        <div>
            <label class="form-label" for="platform">Platforma: <input class="form-control" type="text" name="platform" id="platform"></label>
        </div>
        <div>
            <label class="form-label" for="nick">Nazwa użytkownika: <input class="form-control" type="text" name="nick" id="nick"></label>
        </div>
        <div>
            <label class="form-label" for="password">Hasło: <input class="form-control" type="password" name="password" id="password"></label>
        </div>
        <div><input class="btn btn-primary mb-3" type="submit" name="submit" id="submit"></div>
    </form>

    
    <?php
session_start();
$errorMessage = "";
if(isset($_SESSION["errorMessage"])){
    $errorMessage = $_SESSION["errorMessage"];
    $_SESSION["errorMessage"] = null;
}
    ?>
    <div class="errorMessage m-3 d-flex justify-content-center"><?php echo $errorMessage; ?></div>
</body>
</html>