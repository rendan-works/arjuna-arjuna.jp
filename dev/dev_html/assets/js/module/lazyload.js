/*! lazyload.js | v3.4.1 | license Copyright (C) 2019 - 2022 Taichi Matsutaka */
/*
 *
 * @name    : lazyload.js
 * @content : lazyload frame
 * @creation: 2019.11.11
 * @update  : 2022.05.17
 * @version : 3.4.1
 *
 */
(function(global) {[]
	global.lazyload = function(target,options){
		///////////////////////////////////////////////////////////////
		// defaults options
		///////////////////////////////////////////////////////////////
		this.targetElements = Array.prototype.slice.call( document.querySelectorAll( target ) ,0) ;

		const defaults = {
			position  : 1,
			setClass  : 'is-set',
			objectFit : true,
			immedStart: false,

			getWindowSizeEvent: ['DOMContentLoaded','resize'],
			getScrollTopEvent : ['DOMContentLoaded','scroll'],
			setSourceEvent    : ['DOMContentLoaded','scroll'],
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
		this.removes = [];
		this.base();


	};
	lazyload.prototype = {
		base: function(){
			const _this   = this;
			const options = this.options;


			///////////////////////////////////////////////////////////////
			// variable
			///////////////////////////////////////////////////////////////
			const propRegex  = /(object-fit|object-position)\s*:\s*([-.\w\s%]+)/g;
			let scrollTop    = 0;
			let windowHeight = document.documentElement.clientHeight;


			///////////////////////////////////////////////////////////////
			// objectFit 判定
			///////////////////////////////////////////////////////////////
			const objectFitStyle = document.createElement('div');
			objectFitStyle.style.cssText = 'object-fit: cover;'

			function getStyle(el) {
				let style = getComputedStyle(el).fontFamily;
				let parsed;
				let props = {};
				while ((parsed = propRegex.exec(style)) !== null) {
					props[parsed[1]] = parsed[2];
				}
				return props;
			}


			//////////////////////////////////////////////////////////////
			// window size
			///////////////////////////////////////////////////////////////
			function getWindowSize(){
				windowHeight = document.documentElement.clientHeight;
			}

			if( options['immedStart'] === true ){
				getWindowSize();
			}

			for ( let i = 0; i < options['getWindowSizeEvent'].length; i++ ) {
				window.addEventListener( options['getWindowSizeEvent'][i] ,getWindowSize);
			}

			/* ---------- removes ---------- */
			_this.removes.push( function(){
				for ( let i = 0; i < options['getWindowSizeEvent'].length; i++ ) {
					window.removeEventListener( options['getWindowSizeEvent'][i] ,getWindowSize);
				}
			});



			///////////////////////////////////////////////////////////////
			// scrollTop
			///////////////////////////////////////////////////////////////
			function getScrollTop(){
				scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
			}

			if( options['immedStart'] === true ){
				getScrollTop();
			}

			for ( let i = 0; i < options['getScrollTopEvent'].length; i++ ) {
				window.addEventListener( options['getScrollTopEvent'][i] ,getScrollTop);
			}

			/* ---------- removes ---------- */
			_this.removes.push( function(){
				for ( let i = 0; i < options['getScrollTopEvent'].length; i++ ) {
					window.removeEventListener( options['getScrollTopEvent'][i] ,getScrollTop);
				}
			});





			this.targetElements.forEach(function(target) {

				///////////////////////////////////////////////////////////////
				// setSource
				///////////////////////////////////////////////////////////////
				function setSource(){
					let position = 1;

					if( options['position'] ){
						position = options['position'];
					}


					let offset = target.getBoundingClientRect().top + scrollTop;
					let starPosition = offset - windowHeight - ( windowHeight * position );

					if( scrollTop > starPosition ){
						if( !target.classList.contains( options['setClass'] ) ){
							const tag = target.tagName;
							let originalSource = target.dataset.original;

							if( tag === 'IMG' ){
								/////////////////////////////////////////////
								// IMG
								/////////////////////////////////////////////
								if( options['objectFit'] == true ){
									if ( !objectFitStyle.style.length ) {
										let style = getStyle(target);
										let fontFamily = style.fontFamily;

										if( style['object-fit'] !== undefined ){
											target.style.backgroundImage = 'url('+ originalSource +')';
										} else{
											target.setAttribute( 'src' , originalSource );
										}
									} else{
										target.setAttribute( 'src' , originalSource );
									}
								} else{
									target.setAttribute( 'src' , originalSource );
								}

								let image = new Image();
								image.src = originalSource;

								image.onload = function(){
									target.classList.add( options['setClass'] );

									target.removeAttribute('data-original');
									window.removeEventListener('scroll', setSource );
								};
							} else if( tag === 'IFRAME' || tag === 'VIDEO'  ){
								/////////////////////////////////////////////
								// IFRAME
								/////////////////////////////////////////////
								target.setAttribute('src',originalSource);
								target.classList.add( options['setClass'] );

								target.removeAttribute('data-original');
								window.removeEventListener('scroll', setSource );

								const isPlay = function(){
									target.classList.add('is-play');
									target.removeEventListener('play',isPlay);
								}

								if( tag === 'VIDEO' ){
									target.addEventListener('play',isPlay);
								}
							}
						}
					}
				}

				if( options['immedStart'] === true ){
					setSource();
				}
				for ( let i = 0; i < options['setSourceEvent'].length; i++ ) {
					window.addEventListener( options['setSourceEvent'][i] ,setSource);
				}

				/* ---------- removes ---------- */
				_this.removes.push( function(){
					for ( let i = 0; i < options['setSourceEvent'].length; i++ ) {
						window.removeEventListener( options['setSourceEvent'][i] ,setSource);
					}
				});



			});
		},
		remove: function(){
			/* removes に追加された関数をforで一つずつ実行する。 */
			const removes = this.removes;

			if( !removes ) return;

			for ( let i = 0; i < removes.length; i++ ) {
				removes[i]();
			}
		},
	};

})(this);
