<?php

if (isset($_SESSION['login'])) {
    $username = $_SESSION['login'];
    echo '<div style="padding: 10px; position: fixed;
            border: 4px solid black; left: 40%; top: 10%;">';
    include "Views/user_panel.php";
    include "Views/create.form.html";
    include "Views/tools.form.html";
    include 'Views/main.show.php';
    echo '</div>';
}
