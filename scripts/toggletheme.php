<?php
if (isset($_SESSION["darkmode"])) unset($_SESSION["darkmode"]); else $_SESSION["darkmode"] = true;
header("Location: " . $_SERVER['HTTP_REFERER']);
