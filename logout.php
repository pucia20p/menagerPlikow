<?php
function logout(){
    $_SESSION["user"] = null;
    $_SESSION["perms"] = 0;
    $_SESSION["pass"] = null;
}
logout();