# Description
A collection of custom Zend Framework 1.x plugins I use in various projects.

# Installation
If you want to use any of these plugins you can add them to your project pretty easily if you're using git.

```bash
git submodule add git://github.com/rgeyer/zf1_plugins.git library/RGeyer
```

If you're using some other VCS just grab these files and put them under ~/library/RGeyer.

You can then follow the directions for each plugin below to include them.

# Plugins

## Controller

### WebSessionLogger
This plugin will assign a unique SHA1 to each request that comes into any controller.  When any new request is started it will write to the log file with that unique SHA.

#### Usage
Add the following to your application.ini, the log stream format includes the '%request_id% value which will be replaced with the SHA

```ini
; Logging - You can substitute your own settings if desired
resources.log.stream.writerName = "Stream"
resources.log.stream.writerParams.stream = APPLICATION_PATH "/../logs/application.log"
resources.log.stream.writerParams.mode = "a"
resources.log.stream.filterName = "Priority"
resources.log.stream.filterParams.priority = 4
resources.log.stream.formatterName = "Simple"
; This line is vital, the %request_id% is the SHA that's unique to each request.
resources.log.stream.formatterParams.format = "%timestamp% %priorityName% (%request_id%): %message% %info%" PHP_EOL

; Controller plugin to log individual requests by a unique id
autoloadernamespaces[] = "RGeyer_"
resources.frontController.plugins.WebSessionLogger = 'RGeyer_Controller_Plugin_WebSessionLogger'
```

Here's some example output

```log
2012-05-28T23:44:59+00:00 INFO (bd52996fda8556ecb2ece72d648c1f99faa9f0bc): Request started for anonymous 
2012-05-28T23:45:00+00:00 INFO (d5c8b503e9706e71e54ab21126daab0c393aed4a): Request started for anonymous 
2012-05-28T23:45:00+00:00 INFO (d5c8b503e9706e71e54ab21126daab0c393aed4a): Request started for anonymous 
2012-05-28T23:45:00+00:00 NOTICE (d5c8b503e9706e71e54ab21126daab0c393aed4a): Page not found exception 'Zend_Controller_Dispatcher_Exception' with message 'Invalid controller specified (favicon.ico)' in /Applications/XAMPP/xamppfiles/lib/php/pear/Zend/Controller/Dispatcher/Standard.php:248
Stack trace:
#0 /Applications/XAMPP/xamppfiles/lib/php/pear/Zend/Controller/Front.php(954): Zend_Controller_Dispatcher_Standard->dispatch(Object(Zend_Controller_Request_Http), Object(Zend_Controller_Response_Http))
#1 /Applications/XAMPP/xamppfiles/lib/php/pear/Zend/Application/Bootstrap/Bootstrap.php(97): Zend_Controller_Front->dispatch()
#2 /Applications/XAMPP/xamppfiles/lib/php/pear/Zend/Application.php(366): Zend_Application_Bootstrap_Bootstrap->run()
#3 /Users/ryangeyer/Code/PHP/zf_base/public/index.php(26): Zend_Application->run()
#4 {main}
2012-05-28T23:45:00+00:00 NOTICE (d5c8b503e9706e71e54ab21126daab0c393aed4a): Request Parameters
```

# TODO
Probably rename this zf1_goodies to more accurately reflect the fact that it's plugins, resources, and all sorts of other goodies