/*! popup.js | v5.4.0 | license Copyright (C) 2018 - 2024 Taichi Matsutaka */
/*
 *
 * @name    : popup.js
 * @content : popup
 * @creation: 2018.11.13
 * @update  : 2024.02.10
 * @version : 5.4.0
 *
 */
(function(global) {[]
	global.popup = function(node,options){
		///////////////////////////////////////////////////////////////
		// defaults options
		///////////////////////////////////////////////////////////////
		this.nodeElements = Array.prototype.slice.call( document.querySelectorAll( node ) ,0) ;
		const _this = this;

		const defaults = {
			popupSelector      : '.js-popup-body',
			closeButtonSelector: null,
			breakPointDown     : null,
			animationTime      : 0,
			// bg
			bg                 : true,
			bgContainerSelector: null,
			bgStyle            : true,
			bgClass            : 'js-popup-bg',
			bgZindex           : 99,
			bgColor            : 'rgba(75,73,72,0.5)',
			bgAnimation        : true,
			bgSpeed            : '500',
			bgEasing           : 'linear',
			// smoothScroll
			smoothScroll   : null,
			// openClass
			popupOpenClass : 'is-open',
			buttonOpenClass: 'is-open',
			bodyOpenClass  : 'is-popup-open',
			basicId        : 'aria-popup-',
			basicIdIndex   : true,

			onOpen : null,
			onClose: null,
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
	popup.prototype = {
		base: function(){
			const _this   = this;
			const options = this.options;

			///////////////////////////////////////////////////////////////
			// variable
			///////////////////////////////////////////////////////////////
			let index = 0;

			let openFlg   = false;
			let closeFlg  = false;

			let button             = null;
			let popup            = null;
			let bg                 = null;
			let closeButtonSelector_target = null;
			let smoothScroll       = null;

			if( options['closeButtonSelector'] != null ) closeButtonSelector_target = document.querySelectorAll( options['closeButtonSelector'] );
			if( options['smoothScroll'] != null ) smoothScroll = document.querySelectorAll( options['smoothScroll'] );

			let mediaQuerie = '';

			if( options['breakPointDown'] != null ){
				mediaQuerie = window.matchMedia( 'screen and ( max-width: '+ (options['breakPointDown'] - 1 ) +'px )' );
			} else{
				mediaQuerie = window.matchMedia( 'screen and ( min-width: 0px )' );
			}



			///////////////////////////////////////////////////////////////
			// bg
			///////////////////////////////////////////////////////////////
			/* ---------- setting ---------- */
			if( options['bg'] === true ){

				if( !document.querySelector( '.'+options['bgClass'] ) ){
					let div = document.createElement('div');
					div.setAttribute('class',options['bgClass']);

					const bgContainerSelector = document.querySelector( options['bgContainerSelector'] );

					if( options['bgStyle'] === true ){
						div.style.width           = '100%';
						div.style.height          = '100%';
						div.style.position        = 'fixed';
						div.style.top             = '0';
						div.style.left            = '0';
						div.style.backgroundColor = options['bgColor'];
						div.style.zIndex          = options['bgZindex'];
						div.style.opacity         = '0';
						div.style.visibility      = 'hidden';

						if( options['bgAnimation'] === true ){
							div.style.transition         = options['bgEasing'] + ' ' + options['bgSpeed'] + 'ms';
							div.style.transitionProperty = 'opacity,visibility';
						}
					}

					if( bgContainerSelector ){
						bgContainerSelector.appendChild(div);
					} else{
						document.body.appendChild(div);
					}
				}

				bg = document.querySelector('.' + options['bgClass']);

				/* ---------- event ---------- */
				bg.addEventListener('click',function(e){
					e.preventDefault();
					close();
				},false);
			}




			///////////////////////////////////////////////////////////////
			// close
			///////////////////////////////////////////////////////////////
			const close = function(){
				if( openFlg === true && closeFlg === true ){
					popup.classList.remove( options['popupOpenClass'] );
					button.classList.remove( options['buttonOpenClass'] );

					button.setAttribute('aria-expanded','false');
					popup.setAttribute('aria-hidden','true');

					if( options['bg'] === true ){
						bg.style.opacity    = '0';
						bg.style.visibility = 'hidden';
					}

					document.body.classList.remove( options['bodyOpenClass'] );

					closeFlg = false;

					setTimeout(function(){
						openFlg  = false;
					},options['animationTime']);
				}

				/* ---------- onClose ---------- */
				if( typeof options['onClose'] === 'function' ){
					options['onClose']();
				}
			}

			_this.close = close;



			///////////////////////////////////////////////////////////////
			// aria
			// aria-label または aria-labelledbyはHTMLで直接指定する。
			// aria-controls、aria-expanded、aria-hiddenはJavaScriptで指定
			///////////////////////////////////////////////////////////////
			/* ---------- idとaria-controlsは popupベース ---------- */
			const ariaSettings = function(){
				const popups = document.querySelectorAll(options['popupSelector']);

				for ( let i = 0; i < popups.length; i++ ) {
					const number = popups[i].dataset.popup;

					if( options['basicIdIndex'] == false ){
						index = '';
					} else{
						index++;
					}

					/* ---------- popup ---------- */
					popups[i].setAttribute('id', options['basicId'] + index );

					/* ---------- button ---------- */
					if( number ){
						_this.nodeElements[i].setAttribute('aria-controls', options['basicId'] + index );
					} else{
						for ( let j = 0; i < _this.nodeElements.length; i++ ) {
							_this.nodeElements[i].setAttribute('aria-controls', options['basicId'] + index );
						}
					}
				}

			}
			ariaSettings();




			this.nodeElements.forEach(function(target) {
				button = target;

				///////////////////////////////////////////////////////////////
				// aria
				// ブレイクポイントを跨ぐときに初期化
				///////////////////////////////////////////////////////////////
				let number = button.dataset.popup;
				if( number ){
					popup = document.querySelectorAll(options['popupSelector'] +'[data-popup="'+ number +'"]')[0];
				} else{
					popup = document.querySelectorAll(options['popupSelector'])[0];
				}

				/* ---------- aria-expanded , aria-hidden ---------- */
				const ariaData = function(){
					let mediaQuerie = '';
					mediaQuerie = window.matchMedia( 'screen and ( max-width: '+ (options['breakPointDown'] - 1 ) +'px )' );

					const checkBreakPoint = function( mediaQuerie ){
						if ( mediaQuerie.matches ) {
							target.setAttribute('aria-expanded','false');
							popup.setAttribute('aria-hidden','true');
						} else{
							target.setAttribute('aria-expanded','true');
							popup.setAttribute('aria-hidden','false');
						}
					}

					mediaQuerie.addListener( checkBreakPoint ); // ブレイクポイントの度に
					checkBreakPoint( mediaQuerie ); // 初回

					/* ---------- removes ---------- */
					_this.removes.push( function(){
						mediaQuerie.removeListener( checkBreakPoint );
					});
				}

				if( options['breakPointDown'] == null ){
					target.setAttribute('aria-expanded','false');
					popup.setAttribute('aria-hidden','true');
				} else{
					ariaData();
				}



				///////////////////////////////////////////////////////////////
				// open
				///////////////////////////////////////////////////////////////
				target.addEventListener('click',function(e){
					e.preventDefault();

					if ( mediaQuerie.matches ) {
						button = target;
						let number = button.dataset.popup;

						if( number ){
							popup = document.querySelectorAll(options['popupSelector'] +'[data-popup="'+ number +'"]')[0];
						} else{
							popup = document.querySelectorAll(options['popupSelector'])[0];
						}

						if( openFlg === false ){
							button.classList.add( options['buttonOpenClass']);
							popup.classList.add( options['popupOpenClass'] );

							button.setAttribute('aria-expanded','true');
							popup.setAttribute('aria-hidden','false');

							if( options['bg'] === true ){
								bg.style.opacity    = '1';
								bg.style.visibility = 'visible';
							}

							document.body.classList.add( options['bodyOpenClass'] );
							openFlg  = true;
							closeFlg = true;

							/* ---------- onOpen ---------- */
							if( typeof options['onOpen'] === 'function' ){
								options['onOpen']( target , popup );
							}

						} else{
							close();
						}
					}
				},false);



				///////////////////////////////////////////////////////////////
				// btn Close
				///////////////////////////////////////////////////////////////
				if( options['closeButtonSelector'] != null ){
					for ( let i = 0; i < closeButtonSelector_target.length; i++ ) {
						closeButtonSelector_target[i].addEventListener('click',function(e){
							e.preventDefault();
							close();
						},false);
					}
				}



				///////////////////////////////////////////////////////////////
				// smooth slick
				///////////////////////////////////////////////////////////////
				if( options['smoothScroll'] != null ){
					for ( let i = 0; i < smoothScroll.length; i++ ) {
						smoothScroll[i].addEventListener('click',function(e){
							e.preventDefault();
							close();
						},false);
					}
				}



				///////////////////////////////////////////////////////////////
				// resize
				///////////////////////////////////////////////////////////////
				/* ブレイクポイントを跨ぐときに閉じる */
				const breakStraddling = function(){
					let mediaQuerie = '';

					if( options['breakPointDown'] != null ){
						mediaQuerie = window.matchMedia( 'screen and ( min-width: '+ (options['breakPointDown'] ) +'px )' );
					}

					const checkBreakPoint = function( mediaQuerie ){
						if ( mediaQuerie.matches ) {
							close();
						}
					}

					mediaQuerie.addListener( checkBreakPoint ); // ブレイクポイントの度に

					/* ---------- removes ---------- */
					_this.removes.push( function(){
						mediaQuerie.removeListener( checkBreakPoint );
					});
				}

				if( options['breakPointDown'] != null ){
					breakStraddling();
				}



			});
		},
		close: function(){
		},
		remove: function(){
			/* removes に追加された関数をforで一つずつ実行する。 */
			const removes = this.removes;

			if( !removes ) return;

			for ( let i = 0; i < removes.length; i++ ) {
				removes[i]();
			}
		},
	}

})(this);
