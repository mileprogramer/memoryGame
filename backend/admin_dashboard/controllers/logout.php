<?php

require_once "../../helpers/functions.php";

(is_set_session())? false : session_start();
session_destroy();

header("Location: ./login.php");

?>