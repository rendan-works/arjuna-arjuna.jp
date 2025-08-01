/**! scrollClass.js | v3.3.0 | license Copyright (C) 2020 - 2024 Taichi Matsutaka */
/**
 *
 * @name    : scrollClass.js
 * @content : scrollClass
 * @url     : https://github.com/taichaaan/js-scrollClass
 * @creation: 2020.01.02
 * @update  : 2024.07.04
 * @version : 3.3.0
 *
 * All rights reserved.
 * This code is proprietary and confidential.
 * Unauthorized copying, sharing, distribution, or use of this code in any form is strictly prohibited.
 *
 */
(function(global) {[]
	global.scrollClass = function(target,options){
		const _this = this;

		/**************************************************************
		 * defaults options
		************************************************************ */
		if (typeof target === "string" || target instanceof String) {
			this.target = Array.prototype.slice.call( document.querySelectorAll( target ) ,0) ;
		} else{
			if( target.length ){
				this.target = target;
			} else{
				this.target = [target];
			}
		}

		const defaults = {
			mediaQuery    : null,
			addClass      : 'is-shown',
			timeout       : 0,
			onShown       : null, // function( target ){},
			structuresLoad: true,

			IntersectionObserverOptions: {
				rootMargin: '0px 0px',
			},
		}


		/**************************************************************
		 * options
		************************************************************ */
		for( let option in options){
			defaults[option] = options[option];
		}
		this.options = defaults;


		/**************************************************************
		 * property
		************************************************************ */
		this.observer       = [];
		this.onStructures   = [];
		this.onRestructures = [];
		this.onDestroys     = [];
		this.startingFLg    = false;


		/**************************************************************
		 * method
		**************************************************************/
		this.setupCheck();
		this.starting();
	};
	scrollClass.prototype = {
		setupCheck: function(){
			const _this = this;

			/**************************************************************
			 * setupCheck
			**************************************************************/
			for ( let i = 0; i < _this.target.length; i++ ) {
				/* ---------- callback ---------- */
				const callback = function(entries) {
					if( entries[0].isIntersecting === true ){
						_this.observer[i].disconnect();
						_this.target[i].classList.add( _this.options['addClass'] );

						/* ---------- onShown ---------- */
						if( typeof _this.options['onShown'] === 'function' ){
							_this.options['onShown']( _this.target[i] );
						}
					}
				}

				/* ---------- observer ---------- */
				const init = function(){
					setTimeout(function(){
						_this.observer[i] = new IntersectionObserver(callback,_this.options['IntersectionObserverOptions']);
						_this.observer[i].observe( _this.target[i] );
					},_this.options['timeout']);
				}
				this.onStructures.push( function(){
					if( _this.options['structuresLoad'] === true ){
						window.addEventListener('load',init);
					} else{
						init();
					}
				});
				this.onRestructures.push( function(){
					init();
				});
				this.onDestroys.push( function(){
					_this.observer[i].disconnect();
				});
			}

		},
		starting: function(){
			const _this = this;

			/**************************************************************
			 * starting
			 * ブレイクポイントに合わせて発動
			**************************************************************/
			if( _this.options['mediaQuery'] == null ){
				_this.onStructure();
			} else{
				const breakPoint = function(){
					const mediaQuery = window.matchMedia( _this.options['mediaQuery'] );

					function checkBreakPoint( mediaQuery ) {
						if ( mediaQuery.matches ) {
							if( _this.startingFLg == false ){
								_this.onStructure();
							} else{
								_this.onRestructure();
							}
						} else{
							_this.onDestroy();
						}
					}

					mediaQuery.addListener( checkBreakPoint ); // ブレイクポイントの度に
					checkBreakPoint( mediaQuery ); // 初回
				}
				breakPoint();
			}

			_this.startingFLg = true;
		},
		onStructure: function(){
			/**************************************************************
			 * 構築メソッド
			************************************************************ */
			const onStructures = this.onStructures;
			for ( let i = 0; i < onStructures.length; i++ ) {
				onStructures[i]();
			}
		},
		onRestructure: function(){
			/**************************************************************
			 * 再構築メソッド
			************************************************************ */
			const onRestructures = this.onRestructures;
			for ( let i = 0; i < onRestructures.length; i++ ) {
				onRestructures[i]();
			}
		},
		onDestroy: function(){
			/**************************************************************
			 * 破壊メソッド
			************************************************************ */
			const onDestroys = this.onDestroys;
			for ( let i = 0; i < onDestroys.length; i++ ) {
				onDestroys[i]();
			}
		},
	};

})(this);
