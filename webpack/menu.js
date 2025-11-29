
/** op-module-develop:/webpack/menu.js
 *
 * @created    2023-01-30
 * @version    1.0
 * @package    op-module-develop
 * @author     Tomoaki Nagahara
 * @copyright  Tomoaki Nagahara All rights reserved.
 */
//	...
document.addEventListener('DOMContentLoaded', function(){
	document.querySelectorAll('section.menu .fold .switch').forEach((node) => {
		node.addEventListener('click', (e) => {
			let items = e.target.parentNode.querySelector('.items');
				items.style.display = items.style.display ? '' : 'none';
		});
	});
});
//	...
console.log('develop:/webpack/menu.js');
