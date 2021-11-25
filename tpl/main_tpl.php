<?php

if (isset($_SESSION)) {
    $username = $_SESSION['login'];
    include "Views/user_panel.php";
}
