<?php
/** op-module-develop:/selftest/list.php
 *
 * @created   2020-04-17
 * @version   1.0
 * @package   op-module-develop
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 */
namespace OP;

//	...
$list = [];

//	...
foreach( glob( ConvertPath('asset:/unit/').'*', GLOB_ONLYDIR ) as $path ){
	//	Get unit name.
	$name = basename($path);

	//	Skip ignore directory.
	if( $name[0] === '_' ){
		continue;
	}

	//	Check selftest directory.
	if( file_exists( ConvertPath("asset:/unit/{$name}/selftest/config.php", false) ) ){
		//	...
		$list[] = $name;
		continue;
	}

	//	Load unit.
	if(!Unit::Load($name) ){
		continue;
	};

	//	Check method exists.
	if(!method_exists("\OP\UNIT\\{$name}",'Selftest') ){
		continue;
	};

	//	Add menu list.
	$list[] = $name;
}

//	...
return $list;
