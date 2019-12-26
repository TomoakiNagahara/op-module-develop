<?php
/**
 * unit-admin:/controller.php
 *
 * @created   2019-04-12
 * @version   1.0
 * @package   unit-admin
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
/* @var $app OP\UNIT\App */
$args = $app->Args();

//	...
$app->Template('common.php');

//	...
$path = null;

//	...
while( $arg = array_shift($args) ){
	//	...
	$path .= $arg;

	//	...
	if( file_exists($temp = "{$path}.php") ){
		$app->Template($temp);
	};

	//	...
	if( file_exists($temp = "{$path}/common.php") ){
		$app->Template($temp);
	};

	//	...
	if( file_exists($temp = "{$path}/menu.phtml") ){
		$app->Template($temp);
	};

	//	...
	if( file_exists($temp = "{$path}/action.php") ){
		$app->Template($temp);
	};
};
