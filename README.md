TagLog
======

Debugging PHP applications by using the [error_log](http://php.net/error_log) function is very comfortable, but you have to edit the code in place and add or remove the debugging messages as you proceed.

TagLog is a wrapper-class for the error_log function and allows you to keep your debug-messages in the code for later usage. TagLog extends error_log by adding the possibility to set tags for each message. When the application is running, only the messages with the chosen tags get logged; the *-wildcard will log everything:

~~~
# ...

TagLog::log('My message', 'mytag1');	# Won't get logged
TagLog::log('My message', 'mytag2');	# Won't get logged
TagLog::log('My message', 'mytag3');	# Won't get logged
# By default TagLog won't log any message!

# By setting the tags to log, the logging starts:
TagLog::setTags('*');			# Log everything!
TagLog::log('My message', 'mytag1');	# Will get logged
TagLog::log('My message', 'mytag2');	# Will get logged
TagLog::log('My message', 'mytag3');	# Will get logged

TagLog::setTags('mytag2');		# Configure which tags to log
TagLog::log('My message', 'mytag1');	# Won't get logged
TagLog::log('My message', 'mytag2');	# Will get logged
TagLog::log('My message', 'mytag3');	# Won't get logged

# ...
~~~


Installation
------------

Just download the taglog.php script or use composer!
