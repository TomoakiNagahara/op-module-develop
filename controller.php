<?php
/**
 * module-develop:/controller.php
 *
 * @created   2019-04-12
 * @version   1.0
 * @package   module-develop
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 */
namespace OP;

/** Load
 *
 */
Load('Args');

//	...
$args = Args();

//	...
$path = null;

//	...
while( $arg = array_shift($args) ){
	//	...
	$path .= $arg;

	//	...
	if( file_exists("{$path}.php") ){
		CurrentDirectory($path);
	}else{
		UnitDirectory();
		return;
	}
};

/** Current develop directory.
 *
 * @param  string $path
 */
function CurrentDirectory($path)
{
	//	...
	if( file_exists($temp = "{$path}.php") ){
		Template($temp);
	};

	//	...
	if( file_exists($temp = "{$path}/common.php") ){
		Template($temp);
	};

	//	...
	if( file_exists($temp = "{$path}/menu.phtml") ){
		Template($temp);
	};

	//	...
	if( file_exists($temp = "{$path}/action.php") ){
		Template($temp);
	};
}

/** Unit develop directory.
 *
 */
function UnitDirectory()
{
	//	...
	Template('menu_unit.phtml');

	//	...
	$args = Args();
	$unit = array_shift($args);
	$root = ConvertPath('asset:/unit').$unit.'/develop/';

	D($unit, $root, $args);

	//	...
	if( file_exists($path = join('/',$args).'/action.php') ){
		Template($path);
	}else
	if( file_exists($path = join('/',$args).'.php') ){

	}
	D($path);
}
