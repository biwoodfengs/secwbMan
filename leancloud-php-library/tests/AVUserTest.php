<?php namespace leancloud;
class AVUserTest extends \Enhance\TestFixture {

	public $AVUser;
	public $testUser;

	public function setUp(){
		$this->AVUser = new AVUser;
		$this->testUser = array(
			'username' => 'testUser'.rand(),
			'password' => 'testPass',
			'email' => 'testUser@AV.com',
			'customField' => 'customValue'
		);

	}

	public function signupWithTestuserExpectObjectId(){
		$AVUser = $this->AVUser;

		$return = $AVUser->signup($this->testUser['username'], $this->testUser['password']);

		//print_r($return);

		$deleteUser = new AVUser;
		$deleteUser->delete($return->objectId,$return->sessionToken);

		\Enhance\Assert::isTrue( property_exists($return,'objectId') );

	}

	public function signupWithEmailAndCustomFieldExpectObjectId(){
		$AVUser = $this->AVUser;
		$AVUser->username = $this->testUser['username'];
		$AVUser->password = $this->testUser['password'];
		$AVUser->email = $this->testUser['email'];
		$AVUser->customField = $this->testUser['customField'];

		$return = $AVUser->signup();

		$deleteUser = new AVUser;
		$deleteUser->delete((string)$return->objectId,(string)$return->sessionToken);

		\Enhance\Assert::isTrue( property_exists($return,'objectId') );

	}

	public function loginWithUsernameAndPasswordExpectObjectId(){
		$AVUser = $this->AVUser;
		$AVUser->username = $this->testUser['username'];
		$AVUser->password = $this->testUser['password'];

		$return = $AVUser->signup();

		$loginUser = new AVUser;
		$loginUser->username = $this->testUser['username'];
		$loginUser->password = $this->testUser['password'];

		$returnLogin = $loginUser->login();

		$deleteUser = new AVUser;
		$deleteUser->delete((string)$return->objectId,(string)$return->sessionToken);

		\Enhance\Assert::isTrue( property_exists($returnLogin,'objectId') );
	}

	public function getUserWithObjectIdExpectUsername(){
		$testUser = new AVUser;
		$testUser->username = $this->testUser['username'];
		$testUser->password = $this->testUser['password'];

		//need to clear properties after a call like this to make sure username/password aren't used for the get command below
		$user = $testUser->signup();

		$AVUser = new AVUser;
		$return = $AVUser->get($user->objectId);

		\Enhance\Assert::isTrue( property_exists($return,'username') );
	}

	public function queryUsersWithQueryExpectResultsKey(){
		$AVUser = $this->AVUser;
		$userQuery = new AVQuery('users');
		$userQuery->whereExists('phone');
		$return = $userQuery->find();

		\Enhance\Assert::isTrue( property_exists($return, 'results') );

	}

	public function deleteWithObjectIdExpectTrue(){
		$testUser = new AVUser;
		$testUser->username = $this->testUser['username'];
		$testUser->password = $this->testUser['password'];

		$user = $testUser->signup();

		$AVUser = $this->AVUser;
		$return = $AVUser->delete($user->objectId,$user->sessionToken);

		\Enhance\Assert::isTrue( $return );
	}
/*
	THESE TESTS RETURN ERROR EVERYTIME FROM PARSE BECAUSE OF AN INVALID FACEBOOK ID

	public function linkAccountsWithAddAuthDataExpectTrue(){
		$testUser = new AVUser;
		$testUser->username = $this->testUser['username'];
		$testUser->password = $this->testUser['password'];

		$user = $testUser->signup();

		$AVUser = new AVUser;

		//These technically don't have to be REAL, unless you want them to actually work :)
		$AVUser->addAuthData(array(
			'type' => 'facebook',
			'authData' => array(
				'id' => 'FACEBOOK_ID_HERE',
				'access_token' => 'FACEBOOK_ACCESS_TOKEN',
				'expiration_date' => "2012-12-28T23:49:36.353Z"
			)
		));

		$AVUser->addAuthData(array(
			'type' => 'twitter',
			'authData' => array(
				'id' => 'TWITTER_ID',
				'screen_name' => 'TWITTER_SCREEN_NAME',
				'consumer_key' => 'CONSUMER_KEY',
				'consumer_secret' => 'CONSUMER_SECRET',
				'auth_token' => 'AUTH_TOKEN',
				'auth_token_secret' => 'AUTH_TOKEN_SECRET',
			)
		));

		$return = $AVUser->linkAccounts($user->objectId,$user->sessionToken);

		\Enhance\Assert::isTrue( $return );
	}


	public function unlinkAccountWith(){

	}
*/

}

?>
