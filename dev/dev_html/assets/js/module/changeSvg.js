/*! changeSvg.js | v1.5.0 | license Copyright (C) 2021 - 2022 Taichi Matsutaka */
/*
 *
 * @name    : changeSvg.js
 * @content : changeSvg
 * @url     : https://github.com/taichaaan/js-changeSvg
 * @creation: 2021.06.08
 * @update  : 2022.09.23
 * @version : 1.5.0
 *
 */
(function(global) {[]
	global.changeSvg = function(target,options){
		///////////////////////////////////////////////////////////////
		// defaults options
		///////////////////////////////////////////////////////////////
		this.targetElements = Array.prototype.slice.call( document.querySelectorAll( target ) ,0) ;

		const defaults = {
			svg        : null,
			alt        : null,
			class      : null,
			immedStart : false,
			setSvgEvent: ['DOMContentLoaded'],

			onChange: null, // function( svg )
		}


		///////////////////////////////////////////////////////////////
		// options
		///////////////////////////////////////////////////////////////
		for( let option in options){
			defaults[option] = options[option];
		}
		this.options = defaults;


		///////////////////////////////////////////////////////////////
		// base
		///////////////////////////////////////////////////////////////
		this.base();


	};
	changeSvg.prototype = {
		base: function(){
			const _this   = this;
			const options = this.options;


			///////////////////////////////////////////////////////////////
			// callback
			///////////////////////////////////////////////////////////////
			const onChange = function( svg ){
				if( typeof options['onChange'] === 'function' ){
					options['onChange']( svg );
				}
			}


			///////////////////////////////////////////////////////////////
			// base
			///////////////////////////////////////////////////////////////
			const setSvg = function( target ){
				const tag = target.tagName;

				if( options['svg'] == null ){
					if( tag === 'IMG' ){
						var url       = target.getAttribute('src');
						var alt       = target.getAttribute('alt');
						var className = target.getAttribute('class');
					} else{
						var url       = target.dataset.svg;
						var alt       = target.dataset.alt;
						var className = target.dataset.class;
					}
				} else{
					var url       = options['svg'];
					var alt       = options['alt'];
					var className = options['class'];
				}


				const xhr = new XMLHttpRequest();
				xhr.open( 'GET', url , true );
				xhr.send(null);

				xhr.addEventListener('load',function(){
					const xml = xhr.responseXML;

					if (!xml) return;

					/* ---------- svgの作成 --------- */
					const svg  = xml.documentElement;
					const defs = svg.querySelector('defs');
					const path = svg.querySelectorAll('path');

					const width   = svg.getAttribute('width');
					const height  = svg.getAttribute('height');
					const viewBox = svg.getAttribute('viewBox');

					svg.removeAttribute('xmlns');
					svg.setAttribute('class', className );

					if( !viewBox && width && height ){
						svg.removeAttribute('width');
						svg.removeAttribute('height');
						svg.setAttribute('viewBox','0 0 '+ width +' ' + height + '');
					}

					if( alt ){
						const title = document.createElement('title');
						title.innerHTML = alt;
						svg.insertBefore(title, svg.firstChild);
					}

					if( path ){
						for ( let i = 0; i < path.length; i++ ) {
							path[i].removeAttribute('class');
							path[i].removeAttribute('fill');
						}
					}

					if( defs ){
						defs.parentNode.removeChild(defs);
					}


					/* ---------- 追加 --------- */
					if( tag === 'IMG' ){
						if( target.parentNode ){
							target.parentNode.insertBefore(svg, target);
							target.parentNode.removeChild(target);

							/* ---------- callback ---------- */
							onChange( svg );
						}
					} else{
						target.removeAttribute('data-svg');
						target.removeAttribute('data-alt');
						target.removeAttribute('data-class');
						target.appendChild( svg );

						/* ---------- callback ---------- */
						onChange( svg );
					}
				});
			}



			///////////////////////////////////////////////////////////////
			// forEach
			///////////////////////////////////////////////////////////////
			this.targetElements.forEach(function(target) {
				for ( let i = 0; i < options['setSvgEvent'].length; i++ ) {
					window.addEventListener( options['setSvgEvent'][i] , setSvg( target ) );
				}
			});

			if( options['immedStart'] === true ){
				_this.targetElements.forEach(function(target) {
					setSvg( target );
				});
			}



		},
	};

})(this);
