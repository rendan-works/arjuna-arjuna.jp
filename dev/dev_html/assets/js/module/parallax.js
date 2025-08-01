/*! parallax.js | v2.0.3 | license Copyright (C) 2020 - 2024 Taichi Matsutaka */
/**
 *
 * @name    : parallax.js
 * @content : parallax
 * @url     : https://github.com/taichaaan/js-parallax
 * @creation: 2020.03.11
 * @update  : 2024.03.19
 * @version : 2.0.3
 *
 */
(function(global) {[]
	global.parallax = function(target,options){
		const _this = this;

		/**************************************************************
		 * defaults options
		************************************************************ */
		this.target = Array.prototype.slice.call( document.querySelectorAll( target ) ,0) ;
		if( !this.target.length ) return false;

		const defaults = {
			mediaQuery: null,
			direction : 'vertical', // horizontal
			move      : 0.1,
			speed     : 1,
			standard  : 0,
			centerMode: false,
			IntersectionObserverOptions: {
				rootMargin: "0px 0px"
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

		this.animation      = [];
		this.animationLoop  = [];
		this.startAnimation = [];
		this.stopAnimation  = [];

		this.standard   = 0;
		this.centerMode = 0;

		this.moveTarget = [];
		this.height     = [];
		this.offset     = [];
		this.difference = [];

		this.translate = [];
		this.requestId = [];


		/**************************************************************
		 * method
		**************************************************************/
		this.getSize();
		this.settings();
		this.getSizePosition();
		this.setupScrollAnimation();
		this.setupRequestAnimationFrame();
		this.IntersectionObserver();
		this.starting();
	};
	parallax.prototype = {
		getSize: function(){
			const _this = this;

			/**************************************************************
			 * window size
			**************************************************************/
			const getWindowSize = function(){
				_this.wh = document.documentElement.clientHeight;
			}
			const getScrollTop = function(){
				_this.sy = document.documentElement.scrollTop || document.body.scrollTop;
				if( _this.sy < 0 ) _this.sy = 0;
			}

			this.onStructures.push( function(){
				window.addEventListener('DOMContentLoaded',getWindowSize);
				window.addEventListener('resize',getWindowSize);
				window.addEventListener('load',getScrollTop);
				window.addEventListener('scroll',getScrollTop);
			});
			this.onRestructures.push( function(){
				getWindowSize();
				getScrollTop();
				window.addEventListener('resize',getWindowSize);
				window.addEventListener('scroll',getScrollTop);
			});
			this.onDestroys.push( function(){
				window.removeEventListener('DOMContentLoaded',getWindowSize);
				window.removeEventListener('resize',getWindowSize);
				window.removeEventListener('load',getScrollTop);
				window.removeEventListener('scroll',getScrollTop);
			});
		},
		settings: function(){
			const _this = this;

			/**************************************************************
			 * common setttings
			**************************************************************/
			for ( let i = 0; i < _this.target.length; i++ ) {
				_this.moveTarget[i] = _this.target[i].children[0];
				_this.offset[i]     = 0;
				_this.translate[i]  = 0;
				_this.requestId[i]  = null;
			}

			if( _this.options['centerMode'] === true ){
				_this.centerMode = .5;
			}
		},
		getSizePosition: function(){
			const _this = this;

			/**************************************************************
			 * getSizePosition
			**************************************************************/
			const getSizePosition = function(){
				_this.standard = _this.wh * _this.options['standard'];

				for ( let i = 0; i < _this.target.length; i++ ) {
					_this.height[i]     = _this.target[i].clientHeight;
					_this.difference[i] = _this.standard - _this.height[i] * _this.centerMode;
				}
			}

			this.onStructures.push( function(){
				getSizePosition();
				window.addEventListener('load',getSizePosition);
				window.addEventListener('resize',getSizePosition);
			});
			this.onRestructures.push( function(){
				getSizePosition();
				window.addEventListener('resize',getSizePosition);
			});
			this.onDestroys.push( function(){
				window.removeEventListener('load',getSizePosition);
				window.removeEventListener('resize',getSizePosition);
			});
		},
		setupScrollAnimation: function(){
			const _this = this;

			/**************************************************************
			 * setupScrollAnimation
			 * スピードが1ならスクロールに合わせて移動
			**************************************************************/
			if( _this.options['speed'] === 1 ){
				if( _this.options['direction'] === 'vertical' ){
					for ( let i = 0; i < _this.target.length; i++ ) {
						_this.animation[i] = function(){
							_this.offset[i] = ( _this.target[i].getBoundingClientRect().top - _this.difference[i] ) * _this.options['move'];
							_this.moveTarget[i].style.transform = 'translate3d( 0 , '+ _this.offset[i] +'px , 0 )';
						}
					}
				} else{
					for ( let i = 0; i < _this.target.length; i++ ) {
						_this.animation[i] = function(){
							_this.offset[i] = ( _this.target[i].getBoundingClientRect().top - _this.difference[i] ) * _this.options['move'];
							_this.moveTarget[i].style.transform = 'translate3d( '+ _this.offset[i] +'px , 0 , 0 )';
						}
					}
				}

				for ( let i = 0; i < _this.target.length; i++ ) {
					_this.startAnimation[i] = function(){
						_this.animation[i]();
						window.addEventListener('scroll',_this.animation[i]);
					}
					_this.stopAnimation[i] = function(){
						window.removeEventListener('scroll',_this.animation[i]);
					}
				}
			}
		},
		setupRequestAnimationFrame: function(){
			const _this = this;

			/**************************************************************
			 * setupRequestAnimationFrame
			 * スピードが1以外ならsetupRequestAnimationFrameで移動
			**************************************************************/
			if( _this.options['speed'] !== 1 ){
				if( _this.options['direction'] === 'vertical' ){
					for ( let i = 0; i < _this.target.length; i++ ) {
						_this.animation[i] = function(){
							_this.offset[i]     = ( _this.target[i].getBoundingClientRect().top - _this.difference[i] ) * _this.options['move'];
							_this.translate[i] += ( _this.offset[i] - _this.translate[i] ) * _this.options['speed'];
							_this.moveTarget[i].style.transform = 'translate3d( 0 , '+ _this.translate[i] +'px , 0 )';
						}
					}
				} else{
					for ( let i = 0; i < _this.target.length; i++ ) {
						_this.animation[i] = function(){
							_this.offset[i]     = ( _this.target.getBoundingClientRect().top - _this.difference[i] ) * _this.options['move'];
							_this.translate[i] += ( _this.offset[i] - _this.translate[i] ) * _this.options['speed'];
							_this.moveTarget[i].style.transform = 'translate3d( '+ _this.translate[i] +'px , 0 , 0 )';
						}
					}
				}

				for ( let i = 0; i < _this.target.length; i++ ) {
					_this.animationLoop[i] = function(){
						_this.requestId[i] = window.requestAnimationFrame(_this.animationLoop[i]);
						_this.animation[i]();
					}

					_this.startAnimation[i] = function(){
						_this.animationLoop[i]();
					}
					_this.stopAnimation[i] = function(){
						window.cancelAnimationFrame( _this.requestId[i] );
					}
				}
			}
		},
		IntersectionObserver: function(){
			const _this = this;

			/**************************************************************
			 * IntersectionObserver
			 * 画面内でスタート、画面外でストップ
			**************************************************************/
			/* ---------- callback ---------- */
			const callback = function(entries) {
				entries.forEach(entry => {
					const index = _this.target.indexOf(entry.target);

					if( entry.isIntersecting === true ){
						_this.startAnimation[ index ]();
					} else{
						_this.stopAnimation[ index ]();
					}
				});
			}

			const observer = new IntersectionObserver(callback,_this.options['IntersectionObserverOptions']);

			for ( let i = 0; i < _this.target.length; i++ ) {
				/* ---------- observer ---------- */
				this.onStructures.push( function(){
					window.addEventListener('load',function(){
						observer.observe( _this.target[i] );
					})
				});
				this.onRestructures.push( function(){
					observer.observe( _this.target[i] );
				});
				this.onDestroys.push( function(){
					_this.stopAnimation[i]();
					_this.moveTarget[i].style.transform = '';

					if( observer ){
						observer.disconnect();
					}
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
