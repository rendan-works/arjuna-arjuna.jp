/*! splitText.js | v4.1.2 | license Copyright (C) 2020 - 2024 Taichi Matsutaka */
/*
 *
 * @name    : splitText.js
 * @content : splitText
 * @creation: 2020.02.02
 * @update  : 2024.01.10
 * @version : 4.1.2
 *
 */
(function(global) {[]
	global.splitText = function(target,options){
		splitText.prototype.init(target,options);
	};
	splitText.prototype = {
		init: function( target,options ){
			const _this = this;

			/**************************************************************
			 * defaults options
			************************************************************ */
			this.target = Array.prototype.slice.call( document.querySelectorAll( target ) ,0) ;

			const defaults = {
				mediaQuery  : null,
				type        : 'transition', // transition or animation or cssVariable
				varName     : '--transition-delay',
				delay       : true,
				delayDefault: 0,
				delayChange : 50,
				data        : false,
				depth       : false,
				splitClass  : null,
				textClass   : null,
				random      : -1,
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
			this.onConstructs   = [];
			this.onReconstructs = [];
			this.onDestroys     = [];
			this.startingFLg    = false;

			this.text           = [];
			this.length         = [];
			this.index          = [];
			this.splitText      = [];
			this.tag            = [];
			this.tagFlg         = [];
			this.specialText    = [];
			this.specialTextFlg = [];
			this.delay          = [];


			/**************************************************************
			 * method
			**************************************************************/
			this.settings();
			this.setUpSetInnerHTML();
			this.split();
			this.starting();

		},
		settings: function(){
			const _this = this;


			/**************************************************************
			 * options
			**************************************************************/
			if( _this.options['splitClass'] == null ){
				_this.options['splitClass'] = '';
			}
			if( _this.options['textClass'] == null ){
				_this.options['textClass'] = '';
			}


			/**************************************************************
			 * common setttings
			**************************************************************/
			for (let i = 0; i < _this.target.length; i++) {
				let text     = _this.target[i].innerHTML;
				text         = text.replace(/\r?\n/g, '').replace(/\r?\t/g, '');
				const length = text.length;

				/* ---------- 初期値 ---------- */
				_this.text.push(text);
				_this.length.push(length);
			}



			/**************************************************************
			 * addSettings
			**************************************************************/
			const addSettings = function(){
				_this.index          = [];
				_this.splitText      = [];
				_this.tag            = [];
				_this.tagFlg         = [];
				_this.specialText    = [];
				_this.specialTextFlg = [];
				_this.delay          = [];

				for (let i = 0; i < _this.target.length; i++) {
					_this.target[i].innerHTML = '';
					let delay    = _this.target[i].dataset.delay;

					/* ---------- 初期値 ---------- */
					_this.index.push(0);
					_this.splitText.push('');
					_this.tag.push('');
					_this.tagFlg.push(true);
					_this.specialText.push('');
					_this.specialTextFlg.push(true);

					if( delay ){
						_this.delay.push(new Number( delay ));
					} else{
						_this.delay.push(_this.options['delayDefault']);
					}
				}
			}

			this.onConstructs.push( function(){
				addSettings();
			});
			this.onReconstructs.push( function(){
				addSettings();
			});

		},
		setUpSetInnerHTML : function( target ){
			const _this = this;

			/**************************************************************
			 * initSetInnerHTML
			 * オプションに合わせて変動する関数
			**************************************************************/
			const setClass = function(split,text){
				for ( let i = 0; i < _this.options['splitClass'].length; i++ ) {
					split.classList.add( _this.options['splitClass'][i] );
				}
				for ( let i = 0; i < _this.options['textClass'].length; i++ ) {
					text.classList.add( _this.options['textClass'][i] );
				}
			}



			/**************************************************************
			 * setData
			**************************************************************/
			let setData = '';

			if( _this.options['data'] === true ){
				setData = function(span,c){
					span.dataset.text = c;
				}
			}
			else setData = function(span,c){}



			/**************************************************************
			 * setStyle
			**************************************************************/
			let setStyle = '';

			if( _this.options['type'] === 'transition' ){
				setStyle = function(span,delay){
					span.style.transitionDelay = delay + 'ms';
				}
			} else if( _this.options['type'] === 'animation' ){
				setStyle = function(span,delay){
					span.style.animationDelay = delay + 'ms';
				}
			} else if( _this.options['type'] === 'cssVariable' ){
				setStyle = function(span,delay){
					span.style.setProperty( _this.options['varName'] , delay + 'ms' );
				}
			}



			/**************************************************************
			 * setDelay
			**************************************************************/
			let setDelay = null;
			if( _this.options['random'] !== -1 ){
				/* init */
				let delays = [];
				const randomLength = Number( _this.options['random'] );

				setDelay = function(span,delay){
					if( delays.length === 0 ){
						for ( let i = 0; i < randomLength; i++ ) {
							delays.push( i * _this.options['delayChange'] );
						}
					}

					const random = Math.floor( Math.random() * delays.length );
					setStyle( span , delays[random] );

					delays.splice( random , 1 );
				}
			} else if( _this.options['delay'] === true ){
				setDelay = function(span,delay){
					setStyle( span , delay );
				}
			}
			else setDelay = function(span,delay){}



			/**************************************************************
			 * setInnerHTML
			**************************************************************/
			if( _this.options['depth'] === true ){
				_this.setInnerHTML = function(target,c,delay,split_text){
					if( c === ' ' ){
						c = '&nbsp;';
					}

					const outer = document.createElement('div');
					const span  = document.createElement('span');
					const span2 = document.createElement('span');
					span2.innerHTML = c;
					span.appendChild( span2 );
					outer.appendChild( span );

					// 諸々付与
					setClass(span,span2);
					setData( span2 , c );
					setDelay( span2 , delay );

					split_text = outer.innerHTML;
					return split_text;
				}
			} else{
				_this.setInnerHTML = function(target,c,delay,split_text){
					if( c === ' ' ){
						c = '&nbsp;';
					}

					const outer = document.createElement('div');
					const span  = document.createElement('span');
					span.innerHTML = c;
					outer.appendChild( span );

					// 諸々付与
					setClass(span,span);
					setData( span , c );
					setDelay( span , delay );

					split_text = outer.innerHTML;
					return split_text;
				}
			}

		},
		split: function(){
			const _this = this;

			/**************************************************************
			 * addSplit
			************************************************************ */
			const addSplit = function(){
				for (let i = 0; i < _this.text.length; i++) {
					_this.text[i].split('').forEach(function (c) {
						/* ---------- tag start ---------- */
						if( c === '<' ){
							_this.tagFlg[i] = false;
							_this.tag[i]    = '';
						} else if( c === '&' ){
							_this.specialTextFlg[i] = false;
							_this.specialText[i]    = '';
						}

						/* ---------- splitText ---------- */
						if( _this.tagFlg[i] === true && _this.specialTextFlg[i] === true ){
							_this.splitText[i] += _this.setInnerHTML( _this.target[i] , c , _this.delay[i] , _this.splitText[i] );
							_this.delay[i]     += _this.options['delayChange'];
						} else if( _this.tagFlg[i] === true && _this.specialTextFlg[i] === false ){
							_this.specialText[i] += c;
						} else if( _this.tagFlg[i] === false && _this.specialTextFlg[i] === true ){
							_this.tag[i] += c;
						}

						/* ---------- tag end ---------- */
						if( c === '>' ){
							_this.splitText[i] += _this.tag[i];
							_this.tag[i]     = '';
							_this.tagFlg[i] = true;
						} else if( c === ';' ){
							_this.splitText[i]       += _this.setInnerHTML( _this.target[i] , _this.specialText[i] , _this.delay[i] , _this.splitText[i] );
							_this.delay[i]           += _this.options['delayChange'];
							_this.specialText[i]     = '';
							_this.specialTextFlg[i] = true;
						}

						/* ---------- is-split ---------- */
						_this.index[i]++;
						if( _this.index[i] === _this.length[i]  ){
							_this.target[i].innerHTML = _this.splitText[i];
							_this.target[i].classList.add('is-split');
						}
					});
				}
			}

			this.onConstructs.push( function(){
				addSplit();
			});
			this.onReconstructs.push( function(){
				addSplit();
			});




			/**************************************************************
			 * removeSplit
			************************************************************ */
			const removeSplit = function(){
				for (let i = 0; i < _this.target.length; i++) {
					_this.target[i].innerHTML = _this.text[i];
				}
			}
			this.onDestroys.push( function(){
				removeSplit();
			});


		},
		starting: function( target ){
			const _this = this;

			/**************************************************************
			 * starting
			 * ブレイクポイントに合わせて発動
			**************************************************************/
			if( _this.options['mediaQuery'] == null ){
				_this.onConstruct();
			} else{
				const breakPoint = function(){
					const mediaQuery = window.matchMedia( _this.options['mediaQuery'] );

					function checkBreakPoint( mediaQuery ) {
						if ( mediaQuery.matches ) {
							if( _this.startingFLg == false ){
								_this.onConstruct();
							} else{
								_this.onReconstruct();
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
		onConstruct: function(){
			/**************************************************************
			 * 構築メソッド
			************************************************************ */
			const onConstructs = this.onConstructs;
			for ( let i = 0; i < onConstructs.length; i++ ) {
				onConstructs[i]();
			}
		},
		onReconstruct: function(){
			/**************************************************************
			 * 再構築メソッド
			************************************************************ */
			const onReconstructs = this.onReconstructs;
			for ( let i = 0; i < onReconstructs.length; i++ ) {
				onReconstructs[i]();
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
