/*! cssVariable.js | v2.5.0 | license Copyright (C) 2022 Taichi Matsutaka */
/*
 *
 * @name    : cssVariable.js
 * @content : cssVariable
 * @url     : https://github.com/taichaaan/js-cssVariable
 * @creation: 2022.02.25
 * @update  : 2022.12.05
 * @version : 2.5.0
 *
 */
(function(global) {[]
	global.cssVariable = function(target,options){
		///////////////////////////////////////////////////////////////
		// defaults options
		///////////////////////////////////////////////////////////////
		this.targetElements = document.querySelectorAll( target );

		const defaults = {
			vw              : false,
			vh              : false,
			addressbarHeight: false,
			scrollbarWidth  : false,

			thisWidth              : false,
			thisWidthVarName       : '--width',
			thisWidthUnit          : 'px',
			thisWidthTargetSelector: null,
			thisWidthDelay         : 0,
			thisWidthEvent         : null,

			thisHeight              : false,
			thisHeightVarName       : '--height',
			thisHeightUnit          : 'px',
			thisHeightTargetSelector: null,
			thisHeightDelay         : 0,
			thisHeightEvent         : null,
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
	cssVariable.prototype = {
		base: function(){
			const _this   = this;
			const options = this.options;
			const target  = this.targetElements;

			const userAgent = navigator.userAgent;





			///////////////////////////////////////////////////////////////
			// vw
			///////////////////////////////////////////////////////////////
			if( options['vw'] == true ){
				const vw = function(){
					/* ---------- setVariable ---------- */
					const setVariable = function(){
						const window_width = document.documentElement.clientWidth;
						const vw           = window_width / 100;
						document.documentElement.style.setProperty( '--vw', vw + 'px');
					}


					/* ---------- event ---------- */
					window.addEventListener('DOMContentLoaded',setVariable);
					window.addEventListener('resize',setVariable);

					/* ---------- removes ---------- */
					_this.removes.push( function(){
						window.removeEventListener('DOMContentLoaded',setVariable);
						window.removeEventListener('resize',setVariable);
					});
				}
				vw();
			}



			///////////////////////////////////////////////////////////////
			// vh
			///////////////////////////////////////////////////////////////
			if( options['vh'] == true ){
				const vh = function(){
					/* ---------- setVariable ---------- */
					const setVariable = function(){
						const window_width = document.documentElement.clientHeight;
						const vh            = window_width / 100;
						document.documentElement.style.setProperty( '--vh', vh + 'px');
					}

					const onOrientationchange = function(){
						setTimeout(function(){
							setVariable();
						},50);
					}


					/* ---------- event ---------- */
					window.addEventListener('DOMContentLoaded',setVariable);

					if (userAgent.indexOf('iPhone') >= 0 || userAgent.indexOf('iPad') >= 0 || userAgent.indexOf('Android') >= 0){
						window.addEventListener('orientationchange',onOrientationchange);
					} else{
						window.addEventListener('resize',setVariable);
					}

					/* ---------- removes ---------- */
					_this.removes.push( function(){
						window.removeEventListener('DOMContentLoaded',setVariable);
						window.removeEventListener('resize',setVariable);
						window.removeEventListener('orientationchange',onOrientationchange);
					});
				}
				vh();
			}



			///////////////////////////////////////////////////////////////
			// addressbarHeight
			///////////////////////////////////////////////////////////////
			if( options['addressbarHeight'] == true ){
				const addressbarHeight = function(){
					/* ---------- cssの100vhを取得するためのダミー要素を生成 ---------- */
					const dummyElement  = document.createElement('div');
					dummyElement.classList.add('js-cssVariable-100vh');
					dummyElement.style.position      = 'fixed';
					dummyElement.style.top           = '0';
					dummyElement.style.left          = '0';
					dummyElement.style.width         = '100%';
					dummyElement.style.height        = '100vh';
					dummyElement.style.pointerEvents = 'none';
					dummyElement.style.zIndex        = '-999999999999';
					dummyElement.style.opacity       = '0';
					dummyElement.style.visibility    = 'hidden';
					document.body.appendChild( dummyElement );

					/* ---------- setVariable ---------- */
					const setVariable = function(){
						const _100vh        = dummyElement.clientHeight;
						const window_height = window.innerHeight;

						const tabsize = _100vh - window_height;
						document.documentElement.style.setProperty( '--addressbar-height', tabsize + 'px');
					}


					/* ---------- event ---------- */
					window.addEventListener('DOMContentLoaded',setVariable);
					window.addEventListener('resize',setVariable);

					/* ---------- removes ---------- */
					_this.removes.push( function(){
						window.removeEventListener('DOMContentLoaded',setVariable);
						window.removeEventListener('resize',setVariable);
					});
				}
				addressbarHeight();
			}



			///////////////////////////////////////////////////////////////
			// setScrollbarWidth
			///////////////////////////////////////////////////////////////
			if( options['scrollbarWidth'] == true ){
				const scrollbarWidth = function(){
					/* ---------- setVariable ---------- */
					const setVariable = function(){
						const scrollbar = window.innerWidth - document.documentElement.clientWidth;
						document.documentElement.style.setProperty( '--scrollbar-width', scrollbar + 'px');
					}


					/* ---------- event ---------- */
					window.addEventListener('DOMContentLoaded',setVariable);

					/* ---------- removes ---------- */
					_this.removes.push( function(){
						window.removeEventListener('DOMContentLoaded',setVariable);
					});
				}
				scrollbarWidth();
			}



			///////////////////////////////////////////////////////////////
			// thisWidth
			///////////////////////////////////////////////////////////////
			if( options['thisWidth'] == true ){
				const thisWidth = function(){
					/* ---------- setVariable ---------- */
					let setVariable = null;

					if( options['thisWidthTargetSelector'] == null ){
						setVariable = function(){
							setTimeout(function(){
								for ( let i = 0; i < target.length; i++ ) {
									target[i].style.setProperty( options['thisWidthVarName'] , target[i].clientWidth + options['thisWidthUnit'] );
								}
							}, options['thisWidthDelay'] );
						}
					} else{
						setVariable = function(){
							setTimeout(function(){
								for ( let i = 0; i < target.length; i++ ) {
									const innerTarget = target[i].querySelector( options['thisWidthTargetSelector'] );

									if( innerTarget ){
										target[i].style.setProperty( options['thisWidthVarName'] , innerTarget.clientWidth + options['thisWidthUnit'] );
									}
								}
							}, options['thisWidthDelay'] );
						}
					}


					/* ---------- onOrientationchange ---------- */
					const onOrientationchange = function(){
						setTimeout(function(){
							setVariable();
						},50);
					}


					/* ---------- event ---------- */
					window.addEventListener('load',setVariable);

					if (userAgent.indexOf('iPhone') >= 0 || userAgent.indexOf('iPad') >= 0 || userAgent.indexOf('Android') >= 0){
						window.addEventListener('orientationchange',onOrientationchange);
					} else{
						window.addEventListener('resize',setVariable);
					}

					/* ---------- removes ---------- */
					_this.removes.push( function(){
						window.removeEventListener('load',setVariable);
						window.removeEventListener('resize',setVariable);
						window.removeEventListener('orientationchange',onOrientationchange);
					});

					/* ---------- originalEvent ---------- */
					if( options['thisWidthEvent'] != null ){
						for ( let i = 0; i < options['thisWidthEvent'].length; i++ ) {
							window.addEventListener( options['thisWidthEvent'][i] ,setVariable);

							/* ---------- removes ---------- */
							_this.removes.push( function(){
								window.removeEventListener( options['thisWidthEvent'][i] ,setVariable);
							});
						}
					}

				};
				thisWidth();
			}




			///////////////////////////////////////////////////////////////
			// thisHeight
			///////////////////////////////////////////////////////////////
			if( options['thisHeight'] == true ){
				const thisHeight = function(){
					/* ---------- setVariable ---------- */
					let setVariable = null;

					if( options['thisHeightTargetSelector'] == null ){
						setVariable = function(){
							setTimeout(function(){
								for ( let i = 0; i < target.length; i++ ) {
									target[i].style.setProperty( options['thisHeightVarName'] , target[i].clientHeight + options['thisHeightUnit'] );
								}
							}, options['thisHeightDelay'] );
						}
					} else{
						setVariable = function(){
							setTimeout(function(){
								for ( let i = 0; i < target.length; i++ ) {
									const innerTarget = target[i].querySelector( options['thisHeightTargetSelector'] );

									if( innerTarget ){
										target[i].style.setProperty( options['thisHeightVarName'] , innerTarget.clientHeight + options['thisHeightUnit'] );
									}
								}
							}, options['thisHeightDelay'] );
						}
					}


					/* ---------- onOrientationchange ---------- */
					const onOrientationchange = function(){
						setTimeout(function(){
							setVariable();
						},50);
					}


					/* ---------- event ---------- */
					window.addEventListener('load',setVariable);

					if (userAgent.indexOf('iPhone') >= 0 || userAgent.indexOf('iPad') >= 0 || userAgent.indexOf('Android') >= 0){
						window.addEventListener('orientationchange',onOrientationchange);
					} else{
						window.addEventListener('resize',setVariable);
					}

					/* ---------- removes ---------- */
					_this.removes.push( function(){
						window.removeEventListener('load',setVariable);
						window.removeEventListener('resize',setVariable);
						window.removeEventListener('orientationchange',onOrientationchange);
					});

					/* ---------- originalEvent ---------- */
					if( options['thisHeightEvent'] != null ){
						for ( let i = 0; i < options['thisHeightEvent'].length; i++ ) {
							window.addEventListener( options['thisHeightEvent'][i] ,setVariable);

							/* ---------- removes ---------- */
							_this.removes.push( function(){
								window.removeEventListener( options['thisHeightEvent'][i] ,setVariable);
							});
						}
					}

				};
				thisHeight();
			}





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
