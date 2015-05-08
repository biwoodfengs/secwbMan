<?php
include_once 'AV.php';
$obj = new leancloud\AVObject('GameScore');
$obj->score = 1000;
$obj->name = 'dennis zhuang';
$save = $obj->save();
print_r($save);
$updateObject = new leancloud\AVObject('GameScore');
$updateObject->score = 2000;
$return = $updateObject->update($save->objectId);
$deleteObject = new leancloud\AVObject('GameScore');
//取消注释来删除对象。
//$return = $deleteObject->delete($save->objectId);
?>
