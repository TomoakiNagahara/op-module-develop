<?php
/** op-module-develop:/controller.inc.php
 *
 * @created   ????
 * @version   1.0
 * @package   op-module-develop
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

/** declare
 *
 */
declare(strict_types=1);

/** namespace
 *
 */
namespace OP;

//	...
$args = Args();
$kind = array_shift($args);
$type = array_shift($args);
$file = array_shift($args);
$unit = null;
$path = null;

//	...
switch( $type ){
	case 'core':
	case 'asset':
		break;
	default:
		//	unit
		if( $type ){
			$unit = $type;
		}
		$type = 'unit';
	break;
}

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
if( $kind === 'selftest'  or
	$kind === 'admin'     ){
	$path = "./{$kind}/";
}else{
	//	...
	switch( $type ){
		case 'core':
			$path = "asset:/core/{$kind}/";
			break;

		case 'asset':
			$path = "asset:/{$kind}/";
			break;

		case 'unit':
			D($type, $unit);
			if( $unit === 'unit' ){
				//	...
			}else{
				$unit = str_replace('-', '/', $unit);
				$path = "asset:/{$unit}/$kind/";
			}
			D($path);
			break;

		default:
	}
	/*
	      if( $unit === 'asset' ){
		$path = "asset:/{$kind}/";
	}else if( $unit === 'core'  ){
		$path = "asset:/core/{$kind}/";
	}else if( $unit ){
		$path = "asset:/unit/{$unit}/$kind/";
	}else{
		return;
	}
	*/
}

//	Register a meta root path.
$endpoint = OP::Router()->EndPoint();
$endpoint = dirname($endpoint)."/{$kind}/";
RootPath($kind, $endpoint, false);

//	...
switch( $kind ){
	//	...
	case 'admin':
	case 'selftest':
		Template($path.'action.php',['args'=>$args]);
		Markdown($path.'action.md');
		break;

	//	...
	case 'testcase':
		echo '<section class="testcase">';
		//	...
		if( $file ){
			Template($path.$file.'.php', []);
			Markdown($path.$file.'.md');

			/* Git diff is poor. So comment out and make the diff correct.
			//	Get reference.
			if( $unit === 'asset' ){
				$path = "asset:/reference/{$args[0]}.md";
			}else{
				$path = "asset:/{$unit}/reference/{$args[0]}.md";
			}
			Markdown($path);
			*/
		}else if( $path ){
			Template($path.'action.php', []);
			Markdown($path.'action.md', false);
		}
		echo '</section>';
	//	break;

		//	...
	case 'reference':
		OP::Template('reference.phtml', ['type'=>$type, 'unit'=>$unit, 'file'=>$file]);
		break;

	//	...
	default:
}
