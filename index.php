<?php
/** op-module-develop:/index.php
 *
 * @created   2019-01-30
 * @version   1.0
 * @package   op-module-develop
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** declare
 *
 */
declare(strict_types=1);

/** namespace
 *
 * @created   2020-01-11
 */
namespace OP\DEVELOP;

//	...
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
	return ['phpinfo','admin','selftest','testcase','reference'];
}

//	...
if(!Env::isAdmin() ){
	echo $_SERVER['REMOTE_ADDR'];
	return;
};

//	...
Load('Args');

//	...
RootPath('develop', dirname(Unit('Router')->EndPoint()));

//	If is shell, Run controller.
if( Env::isShell() ){
	OP::Template('controller.inc.php');
	return;
}

//	Change the Layout.
if( $layout = OP()->Config('develop')['layout'] ?? 'flexbox' ){
	OP::Layout($layout);
}

/* @var $app UNIT\App */
$app->Title('develop');

//	...
OP::Template('index.phtml');
OP::Unit('WebPack')->Auto('menu.js');
OP::Unit('WebPack')->Auto('menu.css');
OP::Unit('WebPack')->Auto('develop.css');
