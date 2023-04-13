<?php
include ("base/db.php");
db();
if(!iscookie()){
    die('cookie验证错误');
}

$sql = "select * from image_address";
$ret = mysqli_query($conn, $sql);

if(!mysqli_num_rows($ret)){
    die("暂时没有图片呢");
};

$reet = array();
while($row = mysqli_fetch_array($ret, MYSQLI_ASSOC)){
    $temp = array(
        "id" => $row['id'],
        "title" => $row['title'],
        "address" => '/image'.$row['address'],
        "addtime" => $row['addtime']
    );
    $reet[] = $temp;
}
$ret_json = json_encode($reet);

echo $ret_json;
?>