<?php
include_once 'EnhanceTestFramework.php';
include_once 'AV.php';

//UNCOMMENT AN INDIVIDUAL FILE TESTS OR JUST THE DISCOVERTESTS LINE FOR ALL TESTS
//include_once 'tests/AVObjectTest.php';
//include_once 'tests/AVQueryTest.php';
//include_once 'tests/AVUserTest.php';
//include_once 'tests/AVFileTest.php';
//include_once 'tests/AVPushTest.php';
//include_once 'tests/AVGeoPointTest.php';
\Enhance\Core::discoverTests('tests/');

\Enhance\Core::runTests();

?>
