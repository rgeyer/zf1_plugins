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

# TODO
Probably rename this zf1_goodies to more accurately reflect the fact that it's plugins, resources, and all sorts of other goodies