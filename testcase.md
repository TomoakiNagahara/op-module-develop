TESTCASE
===

# PHP syntax check

```php
<?php
/** This is PHP syntax highlight check
 * 
 *  Here multiline comment.
 *
 * @copyright onepice-framework
 */

//  Literal
$io = null ? true: false;
echo "This is {$var}!";
print 'This is $var!!';
print "This is $var!!";
var_dump(['foo'=>$var]);

//  Function
function OP() : OP {
	return new OP;
}

//  Class
class OP {
	//  ...
	static  $_static;
	private $_private;
	public  $_public;

	//  ...
	static function isAdmin() : bool {
	}

	//  ...
	function Unit(?string $unit_name){
	}
}

//  ...
if( OP()->isAdmin() ){
	return;
}

//	...
for($i=0; $i<count($var); $i++){
}

//	...
switch( gettype($var) ){
	case 'bool':
	break;
	case 'string':
	break;
	default:
}

?>
```
