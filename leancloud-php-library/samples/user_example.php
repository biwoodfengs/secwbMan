<?php
include_once '../AV.php';
$avUser = new leancloud\AVUser;
$avUser->email = 'wxxgreat@163.com';
$user = $avUser->signup('15926305768', 'aaaaaa');
print_r($user);

// $loginUser = new leancloud\AVUser;
// $loginUser->username = '15926305768';
// $loginUser->password = 'aaaaaa';
// $returnLogin = $loginUser->login();
// print_r($returnLogin);

$avUser->requestPasswordReset('wxxgreat@163.com');
?>
