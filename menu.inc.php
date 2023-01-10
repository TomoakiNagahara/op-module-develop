<?php

/** namespace
 *
 */
namespace OP;

//	Used by phpinfo.php.
if( $_GET['raw'] ?? null ){
	return;
}

//	...
$root = ConvertURL('develop:/');

//	...
$args = Args();
$kind = $args[0] ?? null;
$unit = $args[1] ?? null;

//	...
$kind_list = GetKindList();

//	...
if( $kind and array_search($kind, $kind_list) === false ){
	$kind = null;
}

//	...
if( $unit ){
	if( $unit === 'core' ){
		$base_dir = "asset:/core/{$kind}";
	}else if( $unit === 'asset' ){
		$base_dir = "asset:/{$kind}";
	}else{
		$base_dir = "asset:/unit/{$unit}/{$kind}";
	}
	$base_dir = ConvertPath($base_dir);
}else{
	$base_dir = null;
}

//	...
if( $kind === 'selftest' ){
	$base_dir = null;
}

?>

<!-- kind -->
<section class="menu">
	<?php foreach( $kind_list as $key ): ?>
	<span><a href="<?= $root . $key ?>"><?= $key ?></a></span>
	<?php endforeach; ?>
</section>

<?php if( empty($kind) ){ return; } ?>

<!-- unit -->
<section class="menu">
	<?php if( file_exists( RootPath('asset')."core/{$kind}/") ): ?><span><a href="<?= $root . $kind .'/core'  ?>">core</a></span><?php  endif; ?>
	<?php if( file_exists( RootPath('asset')."{$kind}/"     ) ): ?><span><a href="<?= $root . $kind .'/asset' ?>">asset</a></span><?php endif; ?>
	<?php foreach( glob(ConvertPath('asset:/unit/').'*', GLOB_ONLYDIR) as $unit_path ): ?>
		<?php
		//	...
		if(!file_exists($unit_path.'/'.$kind.'/') ){
			continue;
		}

		//	...
		$unit_name = basename($unit_path);

		?>
		<span><a href="<?= $root . $kind .'/'. $unit_name ?>"><?= $unit_name ?></a></span>
	<?php endforeach; ?>
</section>

<?php if( true and $base_dir ): ?>
<!-- file -->
<section class="menu">
	<?php foreach( glob($base_dir.'*') as $file_path ): ?>
		<?php
		//	...
		$ext = ($kind==='reference') ? 'md': 'php';

		//	...
		$file_name = basename($file_path);

		//	...
		$temp = explode('.', $file_name);

		//	NG -> file.inc.php, file.md, action.php
		if( count($temp) > 2 or ($temp[1] ?? null) !== $ext or $temp[0] === 'action' ){
			continue;
		}

		//	NG -> _file.php
		if( $file_name[0] === '_' ){
			continue;
		}

		/*
		//	OK -> File.php
		if( $kind === 'testcase' ){
			$case = strtoupper($file_name[0]);
			if( $case !== $file_name[0] ){
				continue;
			}
		}
		*/

		//	...
		$file = $temp[0];

		?>
		<span><a href="<?= $root . "{$kind}/{$unit}/$file" ?>"><?= $file ?></a></span>
	<?php endforeach; ?>
</section>
<?php endif; ?>

<?php if( false ): ?>
<!-- files -->
<section class="menu">
	<?php foreach( glob(ConvertPath('asset:/unit/')."{$unit}/{$kind}/*.php") as $file_path ): ?>
		<?php
		//	...
		$file_name = basename($file_path);
		$temp      = explode('.', $file_name);

		//	...
		if( count($temp) > 2 ){
			continue;
		}

		//	...
		$file_name = $temp[0];

		//	...
		if( $file_name === 'action' ){
			continue;
		}
		?>
		<span><a href="<?= $root . "{$kind}/{$unit}/{$file_name}" ?>"><?= $file_name ?></a></span>
	<?php endforeach; ?>
</section>
<?php endif; ?>
