<?php
include ("base/db.php");
db();
// 错误处理函数
function customError($errno, $errstr)
{
    die("<b>Error:</b> [$errno] $errstr") ;
}
// 设置错误处理函数
set_error_handler("customError");

$dir_root   = dirname(dirname(__FILE__)).'/image';
function get_dir($dir){
    global $dir_root;
    $files = scandir($dir_root.'/'.$dir, SCANDIR_SORT_DESCENDING);
    $ret = array();
    foreach($files as $file){
        if($file == '.' || $file == '..')
            continue;
        if(strpos($file, '.')){
            $ret[count($ret)] = $dir.'/'.$file;
        }
        else{
            $ret = array_merge($ret, get_dir($dir.'/'.$file));
        }
    }
    return $ret;
}
$all_images = get_dir('');

$sql = "truncate table image_address";//清空表，重新填装
$ret = mysqli_query($conn, $sql);
if(!$ret){
    die("清空表出现错误！");
}
//重新填装表
foreach($all_images as $id => $image){
    preg_match('/(?<=\/)[^\/]+(?=\.)/', $image, $tmp);
    $title = $tmp[0];
    echo $id.':'.$title.'<br>';
    $sql =  "insert into image_address".
            "(title, address, addtime)".
            "values".
            "('$title', '$image', NOW())";
    $ret = mysqli_query($conn, $sql);
}
echo true;

?>