<?php
/**	op-asset-model:/.Init/GitHooks.php
 *
 * @created   2025-10-02
 * @license   Apache-2.0
 * @package   op-asset-model
 * @copyright (C) 2025 Tomoaki Nagahara
 */

/**	declare
 *
 */
declare(strict_types=1);

/**	namespace
 *
 */
namespace OP;

/**	".hooks" is symbolic link
 *
 */
$op_hooks = ".hooks";

/**	Check directory exists
 *
 */
if(!is_dir($op_hooks)){
	echo "\nError: This directory was not found: {$op_hooks}\n\n";
	exit(__LINE__);
}

/** Register OP hooks into *this submodule* repo
 *
 */
$path = escapeshellarg($op_hooks);
`git config core.hooksPath {$path}`;

/** Verify
 *
 */
if( $op_hooks === ($hooks_path = trim(`git config --get core.hooksPath 2>/dev/null`)) ){
	echo "OK: core.hooksPath is set to {$hooks_path}\n";
}else{
	echo "\nError: Failed to set core.hooksPath. Current: {$hooks_path}\n\n";
	exit(__LINE__);
}
