<?php
/** op-module-develop:/index.php
 *
 * @created   2019-01-30
 * @version   1.0
 * @package   op-module-develop
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 * @created   2020-01-11
 */
namespace OP\TESTCASE;

function Auto(){};
function Menu(){};

/** namespace
 *
 */
namespace OP;

/** Get kind list.
 *
 */
function GetKindList() : array {
	return ['phpinfo','admin','selftest','testcase','unittest'];
}

/* @var $app UNIT\App */

//	...
if(!Env::isAdmin() ){
	echo $_SERVER['REMOTE_ADDR'];
	return;
};

//	...
Load('Args');

//	...
RootPath('develop', dirname(Unit('Router')->EndPoint()));

//	...
if( $layout = Env::Get('develop')['layout'] ?? 'white' ){
	$app->Layout($layout);
}

//	...
$app->WebPack(__DIR__.'/develop.css');

//	...
$app->Title('develop');

//	...
Template('index.phtml');
