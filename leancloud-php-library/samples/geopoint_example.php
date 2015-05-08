<?php
include_once 'AV.php';
$obj = new leancloud\AVObject('GameScore');
$geo = new leancloud\AVGeoPoint(30.0, -20.0);
$obj->location = $geo->location;
$return = $obj->save();
$query = new leancloud\AVQuery('GameScore');
$query->whereNear('location', (new leancloud\AVGeoPoint(30.0, -20.0))->location);
$return = $query->find();
print_r($return);
?>
