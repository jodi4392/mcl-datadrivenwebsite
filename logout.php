<?php
require_once 'core/init.php';
//we might want to check if the user is logged in first???
$user = new User();
$user->logout();
Redirect::to('index.php');
?>