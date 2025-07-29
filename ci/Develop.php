<?php
/**	op-module-develop:/ci/Develop.php
 *
 * @created    2025-07-29
 * @author     Tomoaki Nagahara
 * @copyright  Tomoaki Nagahara All right reserved.
 */

/**	declare
 *
 */
declare(strict_types=1);

/**	namespace
 *
 */
namespace OP;

/* @var $ci \OP\UNIT\CI\CI_Config */
$ci = OP()->Unit()->CI()->Config();

//	...
foreach( glob(__DIR__.'/Develop/*.php') as $path ){
	include($path);
}

//	...
return $ci->Get();
