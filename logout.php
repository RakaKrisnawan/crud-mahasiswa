<?php

// require necessary files

// log out user
session_start();
session_unset();
session_destroy();
header("Location: login.php");
exit;
