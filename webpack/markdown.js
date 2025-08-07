
/** op-module-develop:/webpack/markdown.js
 *
 * @created   2023-01-20
 * @version   1.0
 * @package   op-module-develop
 * @author    Tomoaki Nagahara <tomoaki.nagahara@gmail.com>
 * @copyright Tomoaki Nagahara All right reserved.
 */

//	...
document.addEventListener('DOMContentLoaded', async function(){
	if( typeof marked !== 'undefined' ){
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
	}

	//	Apply markdown
	if( typeof marked !== 'undefined' ){
		//	..
		document.querySelectorAll('.markdown').forEach( async function(code){
			//	Get HTML from parsed markdown.
			let html = marked.parse(code.innerHTML);
			//	Remove LF code.
			while( html.search(/>\n/) !== -1 ){
				html = html.replace(">\n",'>');
			}
			//	Replace to amp. Maybe, This is marked.parse() missing.
			while( html.search(/&amp;/) !== -1 ){
				html = html.replace("&amp;",'&');
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
	if( typeof $OP?.Translate?.Popup !== 'undefined' ){
	document.querySelectorAll('div.markdown').forEach( async function(node){
		//	...
		node.querySelectorAll('h1,h2,h3,h4,h5,h6,p,li,th,td').forEach(function(node){
			$OP.Translate.Popup(node);
		});
	});
	}
});
