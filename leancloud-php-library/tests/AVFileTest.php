<?php namespace leancloud;
class AVFileTest extends \Enhance\TestFixture {

	public function setUp(){

	}

	public function saveExpectName(){
		$return = \Enhance\Core::getCodeCoverageWrapper('AVFile', array('text/plain','Working at AVOS Cloud is great!'));
		$save = $return->save('hello.txt');

		\Enhance\Assert::isTrue( property_exists($save,'name') );
	}

	public function deleteWithUrlExpectTrue(){
		$file = new AVFile('text/plain','Working at AVOS Cloud is great!');
		$save = $file->save('hello.txt');

		//SET BOTH ARGUMENTS BELOW TO FALSE, SINCE WE ARE DELETING A FILE, NOT SAVING ONE
		$todelete = new AVFile;
		$return = $todelete->delete($save->name);

		\Enhance\Assert::isTrue( $return );
	}

}

?>
