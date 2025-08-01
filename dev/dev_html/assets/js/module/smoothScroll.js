/*! smoothScroll.js | v3.5.0 | license Copyright (C) 2019 - 2022 Taichi Matsutaka */
/**
 *
 * @name    : smoothScroll.js
 * @content : smoothScroll
 * @creation: 2019.??.??
 * @update  : 2022.08.20
 * @version : 3.5.0
 *
 */
(function(global) {[]
	global.smoothScroll = function(node,options){
		/////////////////////////////////////////////
		// defaults options
		/////////////////////////////////////////////
		this.nodeElements = Array.prototype.slice.call( document.querySelectorAll( node ) ,0) ;

		const defaults = {
			window        : window,
			documentTop   : false,
			easingFunction: function (t, b, c, d) { return c * t / d + b; },
			minus         : [0],
			speed         : 800,
			delay         : 0,
		}


		/////////////////////////////////////////////
		// options
		/////////////////////////////////////////////
		for( let option in options){
			defaults[option] = options[option];
		}
		this.options = defaults;


		/////////////////////////////////////////////
		// base
		/////////////////////////////////////////////
		this.base();


	};
	smoothScroll.prototype = {
		base: function(){
			const _this   = this;
			const options = this.options;


			/////////////////////////////////////////////
			// documentTop
			/////////////////////////////////////////////
			if( options['documentTop'] === true ){
				const documentTop = document.createElement('div');
				documentTop.setAttribute('id','document-top');
				document.body.insertBefore( documentTop , document.body.firstChild );
			}


			/////////////////////////////////////////////
			// scrollElm
			/////////////////////////////////////////////
			const scrollElm = (function() {
				if('scrollingElement' in document) return document.scrollingElement;
				if(navigator.userAgent.indexOf('WebKit') != -1) return document.body;
				return document.documentElement;
			})();


			/////////////////////////////////////////////
			// window
			/////////////////////////////////////////////
			let _window   = '';
			let _windowFrom   = '';

			if( options['window'] === window ){
				_window     = window;
				_windowFrom = scrollElm;
			} else{
				_window     = document.querySelector(options['window']);
				_windowFrom = _window;
			}



			this.nodeElements.forEach(function(target) {
				/////////////////////////////////////////////
				// click
				/////////////////////////////////////////////
				target.addEventListener('click', function(e) {
					e.preventDefault();
					const href           = target.getAttribute('href');
					const dataHref       = target.dataset.href;

					setTimeout(function(){
						const scrollFromTop  = _windowFrom.scrollTop;
						const scrollFromleft = _windowFrom.scrollLeft;
						let startTime        = Date.now();

						/* ----- hrefが#のみだったら、bodyをターゲットにする ----- */
						let scrollTarget = document.body;
						if( dataHref && dataHref !== '#' ){
							scrollTarget = document.querySelector( dataHref );
						} else if( href && href !== '#' ){
							scrollTarget = document.querySelector( href );
						}

						/* ----- 要素が存在したらアニメーション ----- */
						if( scrollTarget ){

							/* ---------- minus ---------- */
							let minus = 0;
							for ( let i = 0; i < options['minus'].length; i++) {
								if( options['minus'][i] !== '' ){
									let regexp = new RegExp('^(\\+|\\-)?(0[1-9]{0,2}|\\d{0,3})(,\\d{3})*(\\.[0-9]+)?$', 'g');

									if( regexp.test( options['minus'][i] ) === true ){
										minus += new Number( options['minus'][i] );
									} else{
										let minusElement = document.querySelectorAll( options['minus'][i] );

										for ( let i = 0; i < minusElement.length; i++ ) {
											minus += minusElement[i].clientHeight;
										}
									}
								}
							}

							/* ---------- offsetTop ---------- */
							const offsetTop  = scrollTarget.getBoundingClientRect().top - minus;
							const offsetLeft = scrollTarget.getBoundingClientRect().left - minus;

							/* ---------- animation ---------- */
							(function loop() {
								let currentTime = Date.now() - startTime;

								if( currentTime < options['speed'] ) {
									_window.scrollTo( options['easingFunction'](currentTime, scrollFromleft, offsetLeft, options['speed']) , options['easingFunction'](currentTime, scrollFromTop, offsetTop, options['speed']) );
									requestAnimationFrame(loop);
								} else {
									_window.scrollTo(offsetLeft + scrollFromleft, offsetTop + scrollFromTop);
								}
							})();
						}

					},options['delay']);

				})
			});
		},
	};

})(this);
