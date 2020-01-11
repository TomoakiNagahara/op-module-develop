<?php
/**
 * module-develop:/index.php
 *
 * @created   2019-01-30
 * @version   1.0
 * @package   module-develop
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 * @created   2020-01-11
 */
namespace OP;

/* @var $app UNIT\App */

//	...
if(!Env::isAdmin() ){
	return;
};

//	...
RootPath('develop', dirname($app->EndPoint()));

//	...
$app->WebPack(__DIR__.'/develop.css');

//	...
$app->Title('develop');

//	...
$app->Template('index.phtml');
