
/** op-module-develop:/markdown.js
 *
 * @created   2023-01-20
 * @version   1.0
 * @package   op-module-develop
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */
/* <?php if( OP()->Config('execute')['markdown'] ): ?> */
//	...
document.addEventListener('DOMContentLoaded', async function(){
	//	Apply markdown
	if( typeof marked !== 'undefined' ){
		//	..
		document.querySelectorAll('div.markdown').forEach( async function(code){
			code.innerHTML = marked.parse(code.innerText);
		});
	}

	/* <?php if( OP()->Config('execute')['highlight'] ): ?> */
	//	Apply syntax highlighting.
	if( typeof hljs !== 'undefined' ){
		//	...
		document.querySelectorAll('pre > code').forEach( async function(code){
			//	Do highlight for each code tag.
			hljs.highlightElement(code);
			//	Add class.
			['literal','keyword','title'].forEach((type) => {
				code.querySelectorAll('span.hljs-'+type).forEach((dom) => {
					dom.classList.add(dom.innerText);
				});
			});
		});
	};
	/* <?php endif; ?> */
});
/* <?php endif; ?> */
