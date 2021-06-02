<?php

/** namespace
 *
 */
namespace OP;

//	...
$args = Args();
$kind = array_shift($args);
$unit = array_shift($args);

//	...
if( $kind and array_search($kind, GetKindList()) === false ){
	Notice("Does not match kind. ($kind)");
	return;
}

//	...
if( $kind === 'phpinfo' ){
	Template("phpinfo.php");
	return;
}

//	...
if( empty($kind) ){
	return;
}

//	...
Load('Markdown');

/*
//	Why selftest when $unit is empty?
if( empty($unit) ){
	Markdown('./selftest/README.md');
	return;
}
*/

//	...
if( $kind === 'selftest' or $kind === 'admin' ){
	$path = "./{$kind}/";
}else{
	      if( $unit === 'asset' ){
		$path = "asset:/{$kind}/";
	}else if( $unit === 'core'  ){
		$path = "asset:/core/{$kind}/";
	}else if( $unit ){
		$path = "asset:/unit/{$unit}/$kind/";
	}else{
		return;
	}
}

//	...
switch( $kind ){
	//	...
	case 'admin':
	case 'selftest':
	case 'reference':
		Template($path.'action.php',['args'=>$args]);
		Markdown($path.'action.md');
		break;

	//	...
	case 'testcase':
		if( $args ){
			Template($path.join('/',$args).'.php', []);
			Markdown($path.join('/',$args).'.md');
		}else{
			Template($path.'action.php', []);
			Markdown($path.'action.md', false);
		}
		break;

	//	...
	default:
}
