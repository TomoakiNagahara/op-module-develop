<?php
/** op-module-develop:/testcase.php
 *
 * @created   2023-01-30
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
$args = OP::Router()->Args();

//	...
switch( $meta = $args[1] ?? null ){
	case 'core':
	case 'asset':
		if(!empty($args[2]) ){
			$path = "{$meta}:/testcase/{$args[2]}";
		}
		break;

	case 'unit':
		if(!empty($args[3]) ){
			$path = "{$meta}:/{$args[2]}/testcase/{$args[3]}";
		}
		break;

	default:
		//	...
		foreach( OP::Unit('Git')->SubmoduleConfig() as $config ){
			if( isset($args[1]) and !strpos($config['url'], $args[1]) ){
				continue;
			}
			if( isset($args[2]) and !strpos($config['url'], $args[2]) ){
				continue;
			}
			break;
		}

		//	...
		if(!empty($args[3]) ){
			$path = "git:/{$config['path']}/testcase/{$args[3]}";
		}
	break;
}

//	...
if( $path ?? null ){
	OP::Markdown($path.'.md', false);
	OP::Template($path.'.php');
}
