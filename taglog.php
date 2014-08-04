<?php

/**
 * Wrapper class for [error_log](http://php.net/error_log)
 * with the ability to log the messages only
 * when the tags are matching.
 */
class TagLog
{
	/**
	 * Array of tags to log
	 */
	protected static $tags = null;


	/**
	 * @param string $tags Either a list of coma-separated tags
	 *	is passed, or the "*"-wildcard is used, which logs
	 *	all debug messages. If this parameter is left empty,
	 *	no messages are logged.
	 */
	public static function setTags($tags=null)
	{
		self::$tags = ($tags) ? explode(',', $tags) : false;
	}


	/**
	 * @param string $msg The message to log
	 * @param string $tag The tag of the message
	 */
	public static function log($msg, $tag)
	{
		if (	self::$tags and
			(in_array($tag, self::$tags) or
				self::$tags[0] == '*'))
		{
			error_log($msg);
		}
	}
}

