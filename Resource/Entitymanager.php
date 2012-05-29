<?php
/*
 Copyright (c) 2012 Ryan J. Geyer <me@ryangeyer.com>

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
		'Software'), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

// Effectively copy pasted from https://github.com/SpiffyJr/zfd2_tutorial
class RGeyer_Resource_Entitymanager extends Zend_Application_Resource_ResourceAbstract
{
	protected $_options = array(
		'connection' => array(
			'driver' => 'pdo_mysql', 
			'host' => 'localhost', 
			'dbname' => 'dbname', 
			'user' => 'root', 
			'password' => ''),
		'modelDir' => '/models',
		'proxyDir' => '/proxies',
		'proxyNamespace' => 'Proxies',
		'autoGenerateProxyClasses' => true
	);

	public function init()
	{
		$options = $this->getOptions();
		
		$config = new \Doctrine\ORM\Configuration;
		$cache = new \Doctrine\Common\Cache\ArrayCache;
		$driverImpl = $config->newDefaultAnnotationDriver($options['modelDir']);

		$config->setMetadataCacheImpl($cache);
		$config->setQueryCacheImpl($cache);
		$config->setProxyDir($options['proxyDir']);
		$config->setProxyNamespace($options['proxyNamespace']);
		$config->setAutoGenerateProxyClasses($options['autoGenerateProxyClasses']);
		$config->setMetadataDriverImpl($driverImpl);

		$em = \Doctrine\ORM\EntityManager::create($options['connection'], $config);
		Zend_Registry::set('em', $em);
		
		return $em;
	}
}