<?php namespace leancloud;
class AVPushTest extends \Enhance\TestFixture {

	public function setUp(){
	}

	public function sendWithGlobalMessageExpectTrue(){
		$AVPush = \Enhance\Core::getCodeCoverageWrapper('AVPush', array( 'Global message to be sent out right away' ));
		$return = $AVPush->send();
		//print_r($return);
		\Enhance\Assert::isObject( $return );
	}

	public function sendWithDataExpectTrue(){
		$AVPush = \Enhance\Core::getCodeCoverageWrapper('AVPush');

		//$AVPush->channel = 'TEST_CHANNEL_ONE'; //this or channels required
		$AVPush->channels = array('TEST_CHANNEL_ONE','TEST_CHANNEL_TWO'); //this or just channel required
		$AVPush->alert = 'Testing Channel 1'; //required

		//BELOW SETTINGS ARE OPTIONAL, LOOKUP REST API DOCS HERE: http://AV.com/docs/rest#push FOR MORE INFO
		$AVPush->expiration_time = time( strtotime('+3 days') ); //expire 3 day from now
		//$AVPush->expiration_time_interval = 86400; //expire in 24 hours from now
		$AVPush->type = 'ios';
		$AVPush->badge = 538; //ios only
		$AVPush->sound = 'cheer'; //ios only
		$AVPush->content_available = 1; //ios only - for newsstand applications. Also, changed from content-available to content_available.
		//$AVPush->title = 'test notification title'; //android only - gives title to the notification

		//CUSTOM DATA CAN BE SENT VERY EASILY ALONG WITH YOUR NOTIFICATION MESSAGE AND CAN BE ACCESSED PROGRAMATICALLY VIA THE MOBILE DEVICE... JUST DON'T SET NAMES THE SAME AS RESERVERD ONES MENTIONED ABOVE
		$AVPush->customData = 'This data will be accessible in the ios and android SDK callback for push notifications';

		$return = $AVPush->send();

		\Enhance\Assert::isObject( $return );
	}

}

?>
