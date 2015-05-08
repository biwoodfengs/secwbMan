<?php
//{"did":"eF7Q9SUSwVLg6YAwQaRLtt"}
include_once '../AV.php';
	$query = new leancloud\AVQuery('DID');

	$query->setLimit(10);
	//$query->setSkip(10);
	$query->where('','');/*说明：没有限制时，必须写成这样!!! nmb。。。*/
	$return = $query->find();
	//var_dump($return->results);
	foreach($return->results  as $value)
	{
		var_dump($value->did);
	}
	
	var_dump( $query->getCount() );
?>
