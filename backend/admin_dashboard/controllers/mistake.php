<?php 

require_once "helpers/functions.php";


(is_set_session())? false : session_start();
echo($_SESSION["mistake"] ?? "");
$_SESSION["mistake"] = null;
?>