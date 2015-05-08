<?php namespace leancloud;
include_once '../EnhanceTestFramework.php';
class AVQueryTest extends \Enhance\TestFixture {

	public $AVQuery;
	public $AVQueryUser;
	public $AVObject;
	public $AVObject2;

	public function setUp(){
		//setup test data to query
		$AVObject = new AVObject('test');
		$AVObject->score = 1111;
		$AVObject->name = 'Foo';
		$AVObject->mode = 'cheat';
		$this->AVObject = $AVObject->save();


		$AVObject2 = new AVObject('test');
		$AVObject2->score = 2222;
		$AVObject2->name = 'Bar';
		$AVObject2->mode = 'nocheat';
		$AVObject2->phone = '555-555-1234';
		$AVObject2->object1 = $AVObject2->dataType('pointer', array('test',$this->AVObject->objectId));
		$this->AVObject2 = $AVObject2->save();

		$this->AVQuery = \Enhance\Core::getCodeCoverageWrapper('AVQuery', array('test'));
		$this->AVQueryUser = \Enhance\Core::getCodeCoverageWrapper('AVQuery', array('users'));

	}

	public function findWithNameExpectResults(){
		$AVQuery = $this->AVQuery;
		$AVQuery->where('name','Foo');
		$return = $AVQuery->find();

		\Enhance\Assert::isTrue( is_array($return->results) );
	}

	public function findWithNameNotExpectResults(){
		$AVQuery = $this->AVQuery;
		$AVQuery->whereNotEqualTo('name','Foo');
		$return = $AVQuery->find();

		\Enhance\Assert::isTrue( is_array($return->results) );
	}

	public function findWithScoreGreaterExpectResults(){
		$AVQuery = $this->AVQuery;
		$AVQuery->whereGreaterThan('score',1500);
		$return = $AVQuery->find();

		\Enhance\Assert::isTrue( is_array($return->results) );
	}

	public function findWithScoreLessExpectResults(){
		$AVQuery = $this->AVQuery;
		$AVQuery->whereLessThan('score',1500);
		$return = $AVQuery->find();

		\Enhance\Assert::isTrue( is_array($return->results) );
	}

	public function findWithScoreGreaterOrEqualExpectResults(){
		$AVQuery = $this->AVQuery;
		$AVQuery->whereGreaterThanOrEqualTo('score',1111);
		$return = $AVQuery->find();

		\Enhance\Assert::isTrue( is_array($return->results) );
	}

	public function findWithScoreLessOrEqualExpectResults(){
		$AVQuery = $this->AVQuery;
		$AVQuery->whereLessThanOrEqualTo('score',1111);
		$return = $AVQuery->find();

		\Enhance\Assert::isTrue( is_array($return->results) );
	}

	public function findWithModeContainedInExpectResults(){
		$AVQuery = $this->AVQuery;
		$AVQuery->whereContainedIn('mode',array('cheat','test','mode'));
		$return = $AVQuery->find();

		\Enhance\Assert::isTrue( is_array($return->results) );
	}

	public function findWithNameNotContainedInExpectResults(){
		$AVQuery = $this->AVQuery;
		$AVQuery->whereNotContainedIn('name',array('cheat','test','mode'));
		$return = $AVQuery->find();

		\Enhance\Assert::isTrue( is_array($return->results) );
	}

	public function findWithScoreExistsExpectResults(){
		$AVQuery = $this->AVQuery;
		$AVQuery->whereExists('score');
		$return = $AVQuery->find();

		\Enhance\Assert::isTrue( is_array($return->results) );
	}

	public function findWithScoreDoesNotExistExpectResults(){
		$AVQuery = $this->AVQuery;
		$AVQuery->whereDoesNotExist('score');
		$return = $AVQuery->find();

		\Enhance\Assert::isTrue( is_array($return->results) );
	}

	public function findWithRegexExpectResults(){
		$AVQuery = $this->AVQuery;
		$AVQuery->whereRegex('name','^\bF.*');
		$return = $AVQuery->find();

		\Enhance\Assert::isTrue( is_array($return->results) );
	}

	public function findWithInQueryExpectResults(){
		$AVQuery = $this->AVQuery;
		$AVQuery->whereInQuery('object1','test', array('where' => array(
			'name' => array('$exists' => true)
		)));
		$return = $AVQuery->find();

		\Enhance\Assert::isTrue( is_array($return->results) );
	}

	public function findWithNotInQueryExpectResults(){
		$AVQuery = $this->AVQuery;
		$AVQuery->whereNotInQuery('object1','test', array('where' => array(
			'name' => array('$exists' => true)
		)));
		$return = $AVQuery->find();

		\Enhance\Assert::isTrue( is_array($return->results) );
	}




}
?>
