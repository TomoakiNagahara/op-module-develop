<?php
/** op-module-develop:/admin/list.php
 *
 * @created   2020-04-17
 * @copied    2020-08-25   Copy from op-module-develop:/selftest/list.php
 * @version   1.0
 * @package   op-module-develop
 * @author    Tomoaki Nagahara
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 */
namespace OP;

//	Init
$list = [];

//	Get unit root path.
$unit_root = ConvertPath('asset:/unit/');

//	Loop at unit directory.
foreach( glob( $unit_root.'*', GLOB_ONLYDIR ) as $path ){

	//	Get unit name.
	$name = basename($path);

	//	Build file path.
	$file = $unit_root . "{$name}/admin/action.php";

	//	Check file path.
	if( file_exists($file) ){
		//	File path exists.
		$list[] = $name;
		continue;
	}
}

//	Return unit name list.
return $list;
