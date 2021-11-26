<?php
if (isset($_SESSION['getParams']['error'])){
    include "Views/error.text.form.php";
}
include "Views/auth.form.html";