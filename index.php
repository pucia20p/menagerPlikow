<?php
session_start();
if(!$_SESSION["perms"] > 0){
    header("Location: login.php");
}
echo "coolstorybro";
