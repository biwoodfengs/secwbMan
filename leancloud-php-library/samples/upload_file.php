<?php
include_once 'AV.php';
$file = new leancloud\AVFile('text/plain', 'Working at AVOS Cloud is Great');
$save = $file->save('hello.txt');
print_r($save);

$obj = new leancloud\AVObject('GameScore');
$obj->image = $obj->dataType('file', $save->objectId);
$obj->save();
?>
