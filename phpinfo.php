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

//	...
if( OP()->Request('raw') ?? null ){
	OP()->Layout(false);
	phpinfo();
	return;
}

//  ...
if( OP()->Request('session') ?? null ){
    //  ...
    $temp = [];

    //  ...
    $count = (int)($_SESSION['count'] ?? null);
    $count++;
    $temp['count'] = $_SESSION['count'] = $count;

    //  ...
    foreach([
        'session_save_path',
        'session_name',
        'session_cache_expire',
        'session_cache_limiter',
    ] as $function ){
        $temp[$function] = $function();
    }
    D($temp);
}

?>
<section class="menu">
        <span><a href="?raw=1">raw</a></span>
        <span><a href="?session=1">session</a></span>
</section>
<iframe src="?raw=1" style="width:100%; height: 80vh; border: 0;">aaa</iframe>
