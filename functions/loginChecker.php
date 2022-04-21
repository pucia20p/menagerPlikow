<?php
function loginChecker(){
    return isset($_SESSION["perms"]) && $_SESSION["perms"] != null;
}