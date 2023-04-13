<?php
include ("base/db.php");
db();

function login($number, $key){
    if($number == '1679003041' && $key == '1826223536')
        return true;
    return false;
}

$number = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
$key = isset($_POST['key']) ? htmlspecialchars($_POST['key']) : '';

$username = login($number, $key);
if($username) {
    session_start();
    $_SESSION["logged_in"] = true;
    echo true;//跳转
}
else echo false;
?>