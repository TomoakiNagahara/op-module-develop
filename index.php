<?php
/**
 * unit-admin:/index.php
 *
 * @created   2019-01-30
 * @version   1.0
 * @package   unit-admin
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
/* @var $app OP\UNIT\App */

//	...
if(!OP\Env::isAdmin() ){
	return;
};

//	...
if( $_GET['phpinfo'] ?? null ){
	$app->Template('phpinfo.php');
}else{
	$app->Template('controller.php');
}
