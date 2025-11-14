<?php
/** op-module-develop:/admin/action.php
 *
 * @created   2019-01-30
 * @copied    2020-08-25   Copy from op-module-develop:/selftest/action.php
 * @version   1.0
 * @package   op-module-develop
 * @author    Tomoaki Nagahara
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 */
namespace OP;

//	...
$develop_root = ConvertURL('develop:/admin/');

?>
<?php if( $list = include('list.php') ): ?>
<section>
[
	<?php foreach( $list as $name ): ?>
	<span class="menu"><a href="<?= $develop_root . $name ?>"><?= $name ?></a></span>
	<?php endforeach; ?>
]
</section>
<?php else: ?>
<p style="margin: 1em;">No unit has an admin directory.</p>
<?php endif; ?>
<?php
//	...
$args = Unit('Router')->Args();
if(!$name = $args[1] ?? null ){
	return;
}

//	Build meta path.
$meta_path = "asset:/unit/{$name}/admin/action.php";

//	...
if( file_exists( ConvertPath($meta_path) ) ){
	Template($meta_path);
}else{
	D("There is no action.php file in the admin directory. ($meta_path)");
}
