<?php namespace leancloud;
class AVObjectTest extends \Enhance\TestFixture {

	private $AVObject;

	public function setUp(){
		//$this->AVObject = new AVObject('test');
		$this->AVObject = \Enhance\Core::getCodeCoverageWrapper('AVObject', array('test'));
		$this->testfield1 = 'test1';
		$this->testfield2 = 'test2';
	}

	public function saveWithTestfield1ExpectObjectId(){
		$AVObject = $this->AVObject;
		$AVObject->testfield1 = $this->testfield1;
		$return = $AVObject->save();

		\Enhance\Assert::isTrue( property_exists($return,'objectId') );
	}

	public function getWithObjectIdExpectTest1(){
		$AVObject = $this->AVObject;
		$AVObject->testfield2 = $this->testfield2;
		$save = $AVObject->save();

		$return = $AVObject->get($save->objectId);

		\Enhance\Assert::areIdentical('test2', $return->testfield2);
	}

	public function updateWithObjectIdExpectupdatedAt(){
		$AVObject = $this->AVObject;
		$AVObject->testfield2 = $this->testfield2;
		$save = $AVObject->save();

		$updateObject = new AVObject('test');
		$updateObject->testfield2 = 'updated test2';
		$return = $AVObject->update($save->objectId);

		\Enhance\Assert::isTrue( property_exists($return, 'updatedAt') );
	}

	public function deleteWithObjectIdExpectEmpty(){
		$AVObject = $this->AVObject;
		$AVObject->testfield1 = $this->testfield2;
		$save = $AVObject->save();

		$return = $AVObject->delete($save->objectId);

		\Enhance\Assert::isTrue( $return );
	}

}

?>
