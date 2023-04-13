<?php
$conn;
function db(){
    global $conn;
    $conn = mysqli_connect('localhost', 'root', '1826223536');
    mysqli_select_db($conn, "image");//选择数据库
    mysqli_query($conn, "set names utf8");//指定编码
}
function iscookie(){
    if(isset($_COOKIE["PHPSESSID"])){
        $sid = $_COOKIE["PHPSESSID"];
        session_id($sid);
        session_start();
        if(isset($_SESSION['logged_in'])){
            return true;
        }
        else {
            setcookie("PHPSESSID","",time()-3600);
            session_destroy();
            return false;
        }
    }
    else
        return false;
}
?>