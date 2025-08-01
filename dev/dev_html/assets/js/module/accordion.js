/*! accordion.js | v6.1.2 | license Copyright (C) 2020 - 2024 Taichi Matsutaka */
/*
 *
 * @name    : accordion.js
 * @content : accordion
 * @url     : https://github.com/taichaaan/js-accordion
 * @creation: 2020.01.05
 * @update  : 2024.03.20
 * @version : 6.1.2
 *
 */
(function(global) {[]
	global.accordion = function(target,options){
		const _this = this;

		/**************************************************************
		 * defaults options
		************************************************************ */
		this.target = Array.prototype.slice.call( document.querySelectorAll( target ) ,0) ;

		const defaults = {
			mediaQuery                 : null,
			addHeight                  : true,
			transitionDuration         : 500,
			switchSelector             : null,
			closeSwitchSelector        : null,
			ancestorCloseSwitchSelector: null,
			panelSelector              : null,
			event                      : 'click',
			targetHoverOutClose        : false,
			anotherElementClose        : false,
			openClass                  : 'is-open',
			firstOpenClass             : 'is-first',
			basicId                    : 'aria-accordion-',
			onInit                     : null,
			onOpen                     : null,
			onClose                    : null,
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
		this.onStructures   = [];
		this.onRestructures = [];
		this.onDestroys     = [];
		this.startingFLg    = false;

		this.isTouchstart = window.ontouchstart === null?"touchstart":"click";

		this.prevIndex = null;
		this.timer     = [];

		this.switchButton        = [];
		this.closeSwitch         = [];
		this.ancestorCloseSwitch = null;
		this.panel               = [];
		this.panelChildren       = [];


		this.onClick      = [];
		this.onMouseenter = [];
		this.onMouseleave = [];


		/**************************************************************
		 * method
		**************************************************************/
		this.settings();
		this.setupOnInit();
		this.setupEvent();
		this.setupTargetHoverOutClose();
		this.setupAncestorCloseSwitch();
		this.starting();

	};
	accordion.prototype = {
		settings: function(){
			const _this = this;

			/**************************************************************
			 * switchButton
			 * closeSwitch
			 * panel
			 * panelChildren
			**************************************************************/
			for (let i = 0; i < _this.target.length; i++) {
				_this.switchButton[i]  = _this.target[i].querySelector( _this.options['switchSelector'] );
				_this.panel[i]         = _this.target[i].querySelector( _this.options['panelSelector'] );
				_this.panelChildren[i] = _this.panel[i].children[0];
			}

			if( _this.options['closeSwitchSelector'] != null ){
				for (let i = 0; i < _this.target.length; i++) {
					_this.closeSwitch[i] = _this.target[i].querySelector( _this.options['closeSwitchSelector'] );
				}
			}
			if( _this.options['ancestorCloseSwitchSelector'] != null ){
				_this.ancestorCloseSwitch = document.querySelector( _this.options['ancestorCloseSwitchSelector'] );
			}



			/**************************************************************
			 * aria
			 * aria-label または aria-labelledbyはHTMLで直接指定する。
			 * aria-controls、aria-expanded、aria-hiddenはJavaScriptで指定
			**************************************************************/
			/* ---------- aria-controls ---------- */
			let index = 0;

			// aria-controlsはindexで番号をずらしながら付与する
			for (let i = 0; i < _this.target.length; i++) {
				_this.switchButton[i].setAttribute('aria-controls', _this.options['basicId'] + index );
				_this.panel[i].setAttribute('id', _this.options['basicId'] + index );
				index++;
			}


			/* ---------- aria-expanded , aria-hidden ---------- */
			const addAria = function(){
				for (let i = 0; i < _this.target.length; i++) {
					_this.switchButton[i].setAttribute('aria-expanded','false');
					_this.panel[i].setAttribute('aria-hidden','true');
				}
			}

			const removeAria = function(){
				for (let i = 0; i < _this.target.length; i++) {
					_this.switchButton[i].setAttribute('aria-expanded','true');
					_this.panel[i].setAttribute('aria-hidden','false');
				}
			}

			this.onStructures.push( function(){
				addAria();
			});
			this.onRestructures.push( function(){
				addAria();
			});
			this.onDestroys.push( function(){
				removeAria();
			});
		},
		setupOnInit: function(){
			const _this = this;

			/**************************************************************
			 * setupOnInit
			 * onInit関数のセットアップ
			**************************************************************/
			const onInit = function(){
				if( typeof _this.options['onInit'] === 'function' ){
					for (let i = 0; i < _this.target.length; i++) {
						_this.options['onInit']( _this.target[i] , _this.switchButton[i] , _this.panel[i] , _this.panelChildren[i] );
					}
				}
			}

			this.onStructures.push( function(){
				onInit();
			});
			this.onRestructures.push( function(){
				onInit();
			});
		},
		setupEvent: function(){
			const _this = this;

			/**************************************************************
			 * setupEvent
			 * オプションに合わせてイベントをセットアップ
			**************************************************************/
			for ( let i = 0; i < _this.target.length; i++ ) {
				_this.onClick[i] = function(){
					_this.accordionEvent(event,i);
				}
				_this.onMouseenter[i] = function(){
					_this.target[i].classList.add('is-start');
					_this.accordionEvent(event,i);
				}
				_this.onMouseleave[i] = function(){
					if( _this.target[i].classList.contains('is-start') && _this.target[i].classList.contains( _this.options['openClass'] ) ){
						_this.accordionEvent(event,i);
					}
				}
			}

			if( _this.options['event'] == 'click' ){
				/* ---------- click ---------- */
				for ( let i = 0; i < _this.switchButton.length; i++ ) {
					_this.onStructures.push(function(){_this.switchButton[i].addEventListener('click',_this.onClick[i]) });
					_this.onRestructures.push(function(){_this.switchButton[i].addEventListener('click',_this.onClick[i]) });
					_this.onDestroys.push(function(){_this.switchButton[i].removeEventListener('click',_this.onClick[i]) });
					_this.onDestroys.push(function(){_this.switchButton[i].removeEventListener('click',_this.onClick[i]) });
				}
				if( _this.options['closeSwitchSelector'] != null ){
					for ( let i = 0; i < _this.closeSwitch.length; i++ ) {
						_this.onStructures.push(function(){_this.closeSwitch[i].addEventListener('click',_this.onClick[i]) });
						_this.onRestructures.push(function(){_this.closeSwitch[i].addEventListener('click',_this.onClick[i]) });
						_this.onDestroys.push(function(){_this.closeSwitch[i].removeEventListener('click',_this.onClick[i]) });
					}
				}
			} else if( _this.options['event'] == 'hover' ){
				/* ---------- hover ---------- */
				if( _this.isTouchstart == 'click' ){
					for ( let i = 0; i < _this.switchButton.length; i++ ) {
						_this.onStructures.push(function(){_this.switchButton[i].addEventListener('mouseenter',_this.onMouseenter[i]) });
						_this.onRestructures.push(function(){_this.switchButton[i].addEventListener('mouseenter',_this.onMouseenter[i]) });
						_this.onDestroys.push(function(){_this.switchButton[i].removeEventListener('mouseenter',_this.onMouseenter[i]) });
						_this.onStructures.push(function(){_this.target[i].addEventListener('mouseleave',_this.onMouseleave[i]) });
						_this.onRestructures.push(function(){_this.target[i].addEventListener('mouseleave',_this.onMouseleave[i]) });
						_this.onDestroys.push(function(){_this.target[i].removeEventListener('mouseleave',_this.onMouseleave[i]) });
					}
				} else{
					for ( let i = 0; i < _this.switchButton.length; i++ ) {
						_this.onStructures.push(function(){_this.switchButton[i].addEventListener('click',_this.onClick[i]) });
						_this.onRestructures.push(function(){_this.switchButton[i].addEventListener('click',_this.onClick[i]) });
						_this.onDestroys.push(function(){_this.switchButton[i].removeEventListener('click',_this.onClick[i]) });
					}

					if( _this.options['closeSwitchSelector'] != null ){
						for ( let i = 0; i < _this.closeSwitch.length; i++ ) {
							_this.onStructures.push(function(){_this.closeSwitch[i].addEventListener('click',_this.onClick[i]) });
							_this.onRestructures.push(function(){_this.closeSwitch[i].addEventListener('click',_this.onClick[i]) });
							_this.onDestroys.push(function(){_this.closeSwitch[i].removeEventListener('click',_this.onClick[i]) });
						}
					}
				}
			}


			/**************************************************************
			 * onDestroys close
			 * 破壊の時にaccordionCloseも発動する
			**************************************************************/
			_this.close = function(){
				// const _this = _this;

				/**************************************************************
				 * close
				 * 全てのアコーディオンを閉じるメソッド
				 * 外部から操作できるように追加
				************************************************************ */
				for ( let i = 0; i < _this.target.length; i++ ) {
					_this.accordionClose(i);
				}
			}

			_this.onDestroys.push( function(){
				_this.close();
			});


		},
		close: function(){
		},
		accordionOpen: function(i){
			const _this = this;

			/**************************************************************
			 * accordionOpen
			**************************************************************/
			_this.switchButton[i].setAttribute('aria-expanded','true');
			_this.panel[i].setAttribute('aria-hidden','false');
			_this.target[i].classList.add( _this.options['openClass'] );

			if( _this.options['addHeight'] == true ){
				const childrenHeihgt = _this.panelChildren[i].clientHeight;
				_this.panel[i].style.height = childrenHeihgt + 'px';

				_this.timer[i] = setTimeout(function(){
					_this.panel[i].style.height = 'auto';
				}, _this.options['transitionDuration'] );
			}

			/* ---------- onOpen ---------- */
			if( typeof _this.options['onOpen'] === 'function' ){
				_this.options['onOpen']( _this.target[i] , _this.switchButton[i] , _this.panel[i] , _this.panelChildren[i] );
			}
		},
		accordionClose: function(i){
			const _this = this;

			/**************************************************************
			 * accordionClose
			**************************************************************/
			_this.switchButton[i].setAttribute('aria-expanded','false');
			_this.panel[i].setAttribute('aria-hidden','true');
			_this.target[i].classList.remove( _this.options['openClass'] );



			if( _this.options['addHeight'] == true ){
				const childrenHeihgt = _this.panelChildren[i].clientHeight;
				_this.panel[i].style.height = childrenHeihgt + 'px';

				clearTimeout( _this.timer[i] );

				setTimeout(function(){
					_this.panel[i].style.height = '';
				},0);

				/*
				 最初から開いている場合は、
				 アニメーションするために高さを指定した後に、100ms遅れて高さを無くす。
				*/
				if( _this.target[i].classList.contains( _this.options['firstOpenClass'] ) ){
					const childrenHeihgt = _this.panelChildren[i].clientHeight;
					_this.panel[i].style.height = childrenHeihgt + 'px';

					setTimeout(function(){
						_this.target[i].classList.remove( _this.options['firstOpenClass'] );
						_this.panel[i].style.height = '';
					},100);
				}
			}

			/* ---------- onClose ---------- */
			if( typeof _this.options['onClose'] === 'function' ){
				_this.options['onClose']( _this.target[i] , _this.switchButton[i] , _this.panel[i] , _this.panelChildren[i] );
			}
		},
		accordionSwitch: function(i){
			const _this = this;

			/**************************************************************
			 * accordionSwitch
			**************************************************************/
			if( _this.options['anotherElementClose'] === true ){
				/* 開いた状態で別の要素を開けた時、前の要素を非表示にしたい時 */
				if( _this.prevIndex != null && _this.prevIndex != i ){
					_this.accordionClose(_this.prevIndex);
				}

				_this.prevIndex = i;
			}

			if( _this.target[i].classList.contains( _this.options['openClass'] ) ){
				if( _this.options['ancestorCloseSwitchSelector'] === null ){
					_this.accordionClose(i);
				}
			} else{
				_this.accordionOpen(i);
			}
		},
		accordionEvent: function(e,i){
			const _this   = this;

			/**************************************************************
			 * accordionEvent
			************************************************************ */
			e.preventDefault();
			_this.accordionSwitch(i);
		},
		setupTargetHoverOutClose: function(){
			const _this = this;

			/**************************************************************
			 * setupTargetHoverOutClose
			 * targetをホバーアウトした時に閉じる
			************************************************************ */
			if( _this.options['targetHoverOutClose'] === true ){
				const onMouseleave = function(){
					const target = this;
					const panel  = target.querySelector( _this.options['panelSelector'] );
					const id     = panel.getAttribute('id');
					const i      = id.replace( _this.options['basicId'] ,'');
					_this.accordionClose(i);
				}

				this.onStructures.push( function(){
					for ( let i = 0; i < _this.target.length; i++ ) {
						_this.target[i].addEventListener('mouseleave',onMouseleave);
					}
				});
				this.onRestructures.push( function(){
					for ( let i = 0; i < _this.target.length; i++ ) {
						_this.target[i].addEventListener('mouseleave',onMouseleave);
					}
				});
				this.onDestroys.push( function(){
					for ( let i = 0; i < _this.target.length; i++ ) {
						_this.target[i].removeEventListener('mouseleave',onMouseleave);
					}
				});
			}

		},
		setupAncestorCloseSwitch: function(){
			const _this = this;

			/**************************************************************
			 * setupAncestorCloseSwitch
			 * 親要素でcloseする時
			************************************************************ */
			if( _this.options['ancestorCloseSwitchSelector'] !== null ){
				this.onStructures.push( function(){
					_this.ancestorCloseSwitch.addEventListener('mouseleave', _this.close );
				});
				this.onRestructures.push( function(){
					_this.ancestorCloseSwitch.addEventListener('mouseleave', _this.close );
				});
				this.onDestroys.push( function(){
					_this.ancestorCloseSwitch.removeEventListener('mouseleave', _this.close );
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
