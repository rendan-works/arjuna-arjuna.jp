/*! isView.js | v1.0.1 | license Copyright (C) 2024 Taichi Matsutaka */
/**
 *
 * @name    : isView.js
 * @content : isView
 * @url     : https://github.com/taichaaan/js-isView
 * @creation: 2024.02.21
 * @update  : 2024.03.19
 * @version : 1.0.1
 *
 */
(function(global) {[]
	global.isView = function(target,options){
		const _this = this;

		/**************************************************************
		 * defaults options
		************************************************************ */
		this.target = Array.prototype.slice.call( document.querySelectorAll( target ) ,0) ;
		if( !this.target.length ) return false;

		const defaults = {
			mediaQuery: null,
			viewClass : 'is-running',
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


		/**************************************************************
		 * method
		**************************************************************/
		this.settings();
		this.setupCheck();
		this.setupVisivility();
		this.starting();
	};
	isView.prototype = {
		settings: function(){
			const _this = this;

			/**************************************************************
			 * 非アクティブ判定 settings
			**************************************************************/
			_this.hidden = '';
			_this.visibilityChange = '';

			if ( typeof document.hidden !== 'undefined' ) {
				_this.hidden           = 'hidden';
				_this.visibilityChange = 'visibilitychange';
			} else if ( typeof document.msHidden !== 'undefined' ) {
				_this.hidden           = 'msHidden';
				_this.visibilityChange = 'msvisibilitychange';
			} else if ( typeof document.webkitHidden !== 'undefined' ) {
				_this.hidden           = 'webkitHidden';
				_this.visibilityChange = 'webkitvisibilitychange';
			}

		},
		setupCheck: function(){
			const _this = this;

			/**************************************************************
			 * setupCheck
			**************************************************************/
			/* ---------- callback ---------- */
			const callback = function(entries) {
				entries.forEach(entry => {
					const index = _this.target.indexOf(entry.target);

					if( entry.isIntersecting === true ){
						entry.target.classList.add( _this.options['viewClass'] );
					} else{
						entry.target.classList.remove( _this.options['viewClass'] );
					}
				});
			}

			const observer = new IntersectionObserver(callback,_this.options['IntersectionObserverOptions']);

			for ( let i = 0; i < _this.target.length; i++ ) {
				/* ---------- observer ---------- */
				this.onStructures.push( function(){
					observer.observe( _this.target[i] );
				});
				this.onRestructures.push( function(){
					observer.observe( _this.target[i] );
				});
				this.onDestroys.push( function(){
					observer.disconnect();
				});
			}

		},
		setupVisivility: function(){
			const _this = this;

			/**************************************************************
			 * setupVisivility
			**************************************************************/
			const judge = function(){
				if ( document[_this.hidden] ) {
					for ( let i = 0; i < _this.target.length; i++ ) {
						_this.target[i].classList.remove( _this.options['viewClass'] );
					}
				} else{
					for ( let i = 0; i < _this.target.length; i++ ) {
						_this.target[i].classList.add( _this.options['viewClass'] );
					}
				}
			}
			const checkVisivility = function(){
				if (typeof document.addEventListener === "undefined" || _this.hidden === undefined) {
				} else{
					document.addEventListener(_this.visibilityChange,judge);
				}
			}
			this.onStructures.push( function(){
				checkVisivility();
			});
			this.onRestructures.push( function(){
				checkVisivility();
			});
			this.onDestroys.push( function(){
				document.removeEventListener(_this.visibilityChange,judge);
			});


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
