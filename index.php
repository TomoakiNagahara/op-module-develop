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

/*
//	...
function Auto(){};
function Menu(){};
*/

/** namespace
 *
 */
namespace OP;

/** Get kind list.
 *
 */
/*
function GetKindList() : array {
	return ['phpinfo','admin','selftest','testcase','reference'];
}
*/

//	...
if(!OP::isAdmin() ){
	echo $_SERVER['REMOTE_ADDR'];
	return;
};

/*
//	...
Load('Args');

//	If is shell, Run controller.
if( Env::isShell() ){
	OP::Template('controller.inc.php');
	return;
}
*/

//	...
RootPath('develop', dirname(OP::Unit()->Router()->EndPoint()));

//	Change of Layout. This feature depends on op-layout-flexbox.
$layout = OP()->Config('layout');
$layout['name'] = OP()->Config('develop')['layout'] ?? 'flexbox';
$layout['path']['menu']['top']  = realpath("./layout/menu/top.phtml");
$layout['path']['menu']['left'] = realpath("./layout/menu/left.phtml");
OP()->Config('layout', $layout);

//	Change of Title.
$title = "Develop";
$html = OP()->Config('html');
$html['head']['title'] = ($html['head']['title'] ?? null) ? "{$title} | {$html['head']['title']}": $title;
OP()->Config('html', $html);

//	...
OP()->Template('index.phtml');
OP()->Unit('WebPack')->Auto('webpack');
OP()->Unit('WebPack')->Auto("asset:/webpack/");
