<?php

require_once('taglog.php');

class logTest extends PHPUnit_Framework_TestCase
{
	/**
	 * Where the messages go to
	 */
	protected $logfile;

	function setUp()
	{
		# Setup the error_log file
		$this->logfile = tempnam(sys_get_temp_dir(), 'l');
		@ini_set('error_log', $this->logfile);
	}

	/**
	 * @param string $tagsToLog Which tags to log
	 * @param array $messages Messages and tags to log
	 * @param int $count How many messages should get logged
	 *
	 * @dataProvider providerTestLog
	 */
	function testLog($tagsToLog, $messages, $count)
	{
		# Setup the logger
		TagLog::setTags($tagsToLog);

		# Loop through the messages and log them
		foreach ($messages as $msg => $tag) {
			TagLog::log($msg, $tag);
		}

		# Check the message count
		$lines = file($this->logfile);
		$loggedMessages = sizeof($lines);
		$this->assertEquals($loggedMessages, $count);
	}

	function providerTestLog()
	{
		$messages = array(
			'Msg1' => 'tag1',
			'Msg2' => 'tag2',
			'Msg3' => 'tag3');

		return array(
			# Don't log any messages
			array('', $messages, 0),

			# Log all messages
			array('*', $messages, 3),

			# Log messages with selected tags only
			array('tag1', $messages, 1),
			array('tag1,tag2', $messages, 2),
			array('tag1,tag2,tag3', $messages, 3));
	}
}
