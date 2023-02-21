
/** op-module-develop:/markdown.js
 *
 * @created   2023-01-20
 * @version   1.0
 * @package   op-module-develop
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

//	...
document.addEventListener('DOMContentLoaded', async function(){
	//	...
	marked.setOptions({
		gfm:         true,
		tables:      true,
		breaks:      false,
		/*
		pedantic:    false,
		smartLists:  true,
		smartypants: false,
		sanitize:    true,
		langPrefix: 'language-',
		highlight:   function(code, lang) {
			return   code;
		}
		*/
	});
	//	Apply markdown
	if( typeof marked !== 'undefined' ){
		//	..
		document.querySelectorAll('div.markdown').forEach( async function(code){
			//	Get HTML from parsed markdown.
			let html = marked.parse(code.innerText);
			//	Remove LF code.
			while( html.search(/>\n/) !== -1 ){
				html = html.replace(">\n",'>');
			}
			//	Replace to HTML.
			code.innerHTML = html;
		});
	}

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

	//	Mouse over translate
	document.querySelectorAll('div.markdown').forEach( async function(node){
		node.querySelectorAll('h1,h2,h3,h4,h5,h6,p,li,th,td').forEach( async function(node){
			//	...
			node.addEventListener('mouseover', async function(e){
				let target = e.target;
				let minwin = GetFloatingWindow();
					minwin.style.top  = e.clientY + 10 + 'px';
					minwin.style.left = e.clientX + 10 + 'px';
				if( minwin.innerHTML !== '' ){
					return;
				}else if( minwin.innerHTML === '?' ){
					return;
				}else{
					minwin.innerHTML = '?';
				}
				//	...
				$OP['Translate'](target.innerHTML, function(translate){
					minwin.innerHTML = translate;
				});
			}, false);

			//	...
			node.addEventListener('mouseleave', async function(e){
				let target = e.target;
				let minwin = GetFloatingWindow();
					minwin.style.top  = 0+'px';
					minwin.style.left = 0+'px';
					minwin.innerHTML  = '';
			}, false);
		});
	});

	//	...
	function GetFloatingWindow(){
		//	...
		let minwin = document.querySelector('#translated_window');
		if(!minwin ){
			minwin = document.createElement('span');
			minwin.id = 'translated_window';
			minwin.style.zIndex   = 100;
			minwin.style.position = 'fixed';
			document.querySelector("body").appendChild(minwin);
		}

		//	...
		minwin.innerHTML = '';

		//	...
		return minwin;
	}
});
