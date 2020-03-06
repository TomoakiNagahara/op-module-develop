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
$list = [];

//	...
foreach( glob( ConvertPath('unit:/').'*', GLOB_ONLYDIR ) as $path ){
	//	Get unit name.
	$name = basename($path);

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
$root = ConvertURL('develop:/selftest/');

?>
<?php if( $list ?? null ): ?>
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
<?php
//	...
if(!$name = $app->Args()[1] ?? null ){
	return;
}

//	...
Unit::Singleton($name)->Selftest();
