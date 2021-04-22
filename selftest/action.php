<?php
/**
 * module-develop:/selftest/action.php
 *
 * @created   2019-01-30
 * @version   1.0
 * @package   module-develop
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** namespace
 *
 */
namespace OP;

/* @var $app UNIT\App */

//	...
$root = ConvertURL('develop:/selftest/');

//	...
$args = Unit('Router')->Args();

?>
<!--
<?php if( $list = include('list.php') ): ?>
<section>
[
	<?php foreach( $list as $name ): ?>
	<span class="menu"><a href="<?= $root . $name ?>"><?= $name ?></a></span>
	<?php endforeach; ?>
]
</section>
<?php else: ?>
<p style="margin: 1em;">No unit has a self-test method.</p>
<?php endif; ?>
 -->
<?php
//	...
if(!$name = ($args[1] ?? null) ){
	echo '<pre>';
	include('README.md');
	echo '</pre>';
	return;
}

//	...
if( file_exists( $path = ConvertPath("asset:/unit/{$name}/selftest/config.php") ) ){
	Unit('Selftest')->Auto($path);
}else{
	Unit($name)->Selftest();
}
