<?php
/** op-module-develop:/reference.php
 *
 * @created   2023-02-01
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
switch( $meta = $args[1] ?? '' ){
	case '':
		$path = 'git:/README';
		break;

	case 'core':
	case 'asset':
		if( empty($args[2]) ){
			$path = $meta === 'core' ? "{$meta}:/README": "{$meta}:/reference/README";
		}else{
			$path = "{$meta}:/reference/{$args[2]}";
		}
		break;

	case 'unit':
		if( empty($args[3]) ){
			$path = "{$meta}:/{$args[2]}/README";
		}else{
			$path = "{$meta}:/{$args[2]}/reference/{$args[3]}";
		}
		break;

	default:
		foreach( OP::Unit('Git')->SubmoduleConfig() as $config ){
			if(!strpos($config['url'], $args[1]) ){
				continue;
			}
			if(!strpos($config['url'], $args[2]) ){
				continue;
			}
			break;
		}
		if( empty($args[3]) ){
			$path = "git:/{$config['path']}/README";
		}else{
			$path = "git:/{$config['path']}/reference/{$args[3]}";
		}
	break;
}

//	...
if( $path ?? null ){
	$path = OP::MetaPath($path.'.md');
	echo '<div class="markdown">';
	echo file_get_contents($path);
	echo '</div>';
}
