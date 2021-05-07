<?php
/** op-module-develop:/phpinfo.php
 *
 * @created   2019-04-12
 * @version   1.0
 * @package   op-module-develop
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 */
namespace OP;

/** use
 *
 */
use function OP\Layout;

//	...
if( $_GET['raw'] ?? null ){
	Layout(false);
	phpinfo();
	return;
}

?>
<iframe src="<?= $_SERVER['REQUEST_URI'] . '?raw=1' ?>" style="width:100%; height: 80vh; border: 0;">aaa</iframe>
