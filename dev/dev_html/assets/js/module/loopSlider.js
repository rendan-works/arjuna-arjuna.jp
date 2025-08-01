/*! loopSlider.js | v4.1.0 | license Copyright (C) 2018 - 2024 Taichi Matsutaka */
/*
 *
 * @name    : loopSlider.js
 * @content : loopSlider
 * @url     : https://github.com/taichaaan/js-loopSlider
 * @creation: 2018.09.04
 * @update  : 2024.02.10
 * @version : 4.1.0
 *
 */
(function(global) {[]
	global.loopSlider = function(target,options){
		const _this = this;

		/**************************************************************
		 * defaults options
		************************************************************ */
		this.target = Array.prototype.slice.call( document.querySelectorAll( target ) ,0) ;
		if( !this.target.length ) return false;

		const defaults = {
			mediaQuery    : null,
			scrollElement   : 'body',
			sliderSelector: '.js-loopslider__content',
			resizeDelay   : 0,
			type          : 'horizontal',
			clone         : 3,
			speed         : 0.567,
			addSize       : 1,

			// moveState          : false,
			// moveStateSelector  : null,
			// moveStateEndValue  : 2,
			// moveStateStartValue: 100,

			scrollMove      : false,
			scrollMoveSpeed : .05,
			scrollMoveAmount: 0.5,

			onInit: null,
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

		this.slider           = [];
		this.originalChildren = [];
		this.cloneChildren    = [];
		this.allChildren      = [];

		this.originalLength = [];

		this.originalSize = [];
		this.allSize      = [];

		this.translate      = [];
		this.translateReset = [];
		this.translateGoal  = [];

		this.timer         = null;
		this.currentWidth  = null;

		this.window   = null;
		this.document = null;

		this.requestId     = null;
		this.animationSy   = 0;
		this.prevSy        = 0;
		this.scrollMoveFlg = true;


		/**************************************************************
		 * method
		**************************************************************/
		this.initWindowDocument();
		this.settings();
		this.setupSetCssVariable();
		this.setupScrollMove();
		// this.setupMoveState();
		// this.setupDrag();
		this.starting();

	};
	loopSlider.prototype = {
		initWindowDocument: function(){
			const _this = this;

			/**************************************************************
			 * initWindowDocument
			**************************************************************/
			if( _this.options['scrollElement'] === 'body' ){
				_this.window   = window;
				_this.document = document.documentElement;
			} else{
				_this.window   = document.querySelector(_this.options['scrollElement']);
				_this.document = _this.window;
			}
		},
		settings: function(){
			const _this = this;


			/**************************************************************
			 * common setttings
			**************************************************************/
			for (let i = 0; i < _this.target.length; i++) {
				_this.slider[i]           = _this.target[i].querySelector( _this.options['sliderSelector'] );
				_this.originalChildren[i] = _this.slider[i].children;

				_this.originalLength[i] = _this.originalChildren[i].length;

				_this.target[i].style.setProperty('--original-length', _this.originalLength[i] );
			}



			/**************************************************************
			 * addSettings
			**************************************************************/
			const addSettings = function(){
				for (let i = 0; i < _this.target.length; i++) {
					let fragment = document.createDocumentFragment();

					/* ---------- clone appenChild ---------- */
					for ( let j = 0; j < _this.options['clone']; j++ ) {
						for ( let k = 0; k < _this.originalChildren[i].length; k++ ) {
							const clone = _this.originalChildren[i][k].cloneNode(true);
							clone.classList.add('is-clone');
							fragment.append(clone);
						}
					}

					_this.slider[i].append( fragment );

					_this.cloneChildren[i] = _this.slider[i].querySelectorAll('.is-clone');
					_this.allChildren[i]   = _this.slider[i].children;

					/* ---------- add class ---------- */
					_this.slider[i].classList.add('is-set');

					/* ---------- onInit ---------- */
					if( typeof _this.options['onInit'] === 'function' ){
						_this.options['onInit']();
					}
				}
			}

			this.onStructures.push( function(){
				addSettings();
			});
			this.onRestructures.push( function(){
				addSettings();
			});



			/**************************************************************
			 * removeSettings
			**************************************************************/
			const removeSettings = function(){
				for (let i = 0; i < _this.cloneChildren.length; i++) {
					/* ---------- clone remove ---------- */
					for ( let j = 0; j < _this.cloneChildren[i].length; j++ ) {
						_this.slider[i].removeChild( _this.cloneChildren[i][j] );
					}

					/* ---------- remove class ---------- */
					_this.slider[i].classList.remove('is-set');
				}
			}

			this.onDestroys.push( function(){
				removeSettings();
			});

		},
		setupSetCssVariable: function(){
			const _this = this;


			/**************************************************************
			 * setupSetCssVariable
			 * CSS変数を付与するイベント
			 *
			 * 全体の横幅やスピードなどをここで一括指定
			**************************************************************/
			let setCssVariable = null;

			if( _this.options['type'] === 'horizontal' ){
				/* ---------- horizontal ----------- */
				setCssVariable = function(){
					for ( let i = 0; i < _this.target.length; i++ ) {
						_this.originalSize[i] = 0;
						_this.allSize[i]      = 0;

						for ( let j = 0; j < _this.allChildren[i].length; j++ ) {
							const childWidth = _this.allChildren[i][j].clientWidth;

							if( j < _this.originalLength[i] ){
								_this.originalSize[i] += childWidth;
							}

							_this.allSize[i] += childWidth;
						}

						const duration      = _this.originalSize[i] / _this.options['speed'] * 20 + 'ms';
						const originalWidth = _this.originalSize[i] + 'px';
						const allSize       = _this.allSize[i] + _this.options['addSize'] + 'px';

						_this.target[i].style.setProperty('--animation-duration-horizontal', duration );
						_this.target[i].style.setProperty('--original-width', originalWidth );
						_this.target[i].style.setProperty('--all-width', allSize );
					}
				}
			} else if( _this.options['type'] === 'vertical' ){
				/* ---------- vertical ----------- */
				setCssVariable = function(){
					for ( let i = 0; i < _this.target.length; i++ ) {
						_this.originalSize[i] = 0;
						_this.allSize[i]      = 0;

						for ( let j = 0; j < _this.allChildren[i].length; j++ ) {
							const childHeight = _this.allChildren[i][j].clientHeight;

							if( i < _this.originalLength[i] ){
								_this.originalSize[i] += childHeight;
							}

							_this.allSize[i] += childHeight;
						}

						const duration      = _this.originalSize[i] / _this.options['speed'] * 20 + 'ms';
						const originalWidth = _this.originalSize[i] + 'px';
						const allSize       = _this.allSize[i] + _this.options['addSize'] + 'px';

						_this.target[i].style.setProperty('--animation-duration-horizontal', duration );
						_this.target[i].style.setProperty('--original-width', originalWidth );
						_this.target[i].style.setProperty('--all-width', allSize );
					}
				}
			}


			/* ---------- onResize ---------- */
			const onResize = function(){
				if ( _this.currentWidth == window.innerWidth ) return;
				_this.currentWidth = window.innerWidth;
				if ( _this.timer > 0 ) clearTimeout(_this.timer);

				_this.timer = setTimeout(function () {
					setCssVariable();
				}, _this.options['resizeDelay'] );
			}


			/* ---------- push ---------- */
			this.onStructures.push( function(){
				setCssVariable();
				window.addEventListener('load',setCssVariable);
				window.addEventListener('resize',onResize);
			});
			this.onRestructures.push( function(){
				setCssVariable();
				window.addEventListener('resize',onResize);
			});

			this.onDestroys.push( function(){
				window.removeEventListener('load',setCssVariable);
				window.removeEventListener('resize',onResize);
			});

		},
		setupScrollMove: function(){
			const _this = this;


			/**************************************************************
			 * setupScrollMove
			 * スクロールに合わせて制御
			 * 現状左から右に移動のみ
			**************************************************************/
			if( _this.options['scrollMove'] === true ){
				/* ---------- settings ---------- */
				const setTransformReset = function(){
					for ( let i = 0; i < _this.originalSize.length; i++ ) {
						_this.translateReset[i] = _this.originalSize[i] * -2;
						_this.translate[i]      = _this.originalSize[i] * -1;
						_this.translateGoal[i]  = _this.originalSize[i] * -1;

						_this.slider[i].style.transform = 'translate3d( '+ _this.translate[i] +'px,0, 0)';
					}
				}

				const addSettings = function(){
					for ( let i = 0; i < _this.originalSize.length; i++ ) {
						_this.translate[i] = _this.originalSize[i] * -1;
					}

					setTransformReset();
					window.addEventListener('resize',setTransformReset);
				}
				const removeSettings = function(){
					window.removeEventListener('resize',setTransformReset);
				}


				/* ---------- animation ---------- */
				const animation = function(){
					const syAbs = Math.abs( _this.sy - _this.animationSy );
					_this.animationSy += ( _this.sy - _this.animationSy ) * _this.options['scrollMoveSpeed'];

					for ( let i = 0; i < _this.slider.length; i++ ) {
						_this.translate[i] += ( _this.translateGoal[i] - _this.translate[i] ) * _this.options['scrollMoveSpeed'];
						_this.slider[i].style.transform = 'translate3d( '+ _this.translate[i] +'px,0, 0)';

						if( _this.translate[i] <= _this.translateReset[i] ){
							_this.translate[i]     = _this.originalSize[i] * -1;
							_this.translateGoal[i] = _this.translateGoal[i] + _this.originalSize[i];
						}
					}

					if(
						_this.sy == Math.round( _this.animationSy * 10) / 10 &&
						_this.scrollMoveFlg == false
					){
						window.cancelAnimationFrame( _this.requestId );
						setTimeout(function(){
							_this.scrollMoveFlg = true;
						},20);
					}
				}

				const animationLoop = function(){
					_this.requestId = window.requestAnimationFrame(animationLoop);
					animation();
				};

				const start = function(){
					_this.sy = _this.document.scrollTop;

					const syAbs = Math.abs( _this.sy - _this.prevSy ) * _this.options['scrollMoveAmount'];

					for ( let i = 0; i < _this.translateGoal.length; i++ ) {
						_this.translateGoal[i] -= syAbs;
					}

					if( _this.scrollMoveFlg == true ){
						animationLoop();
						_this.scrollMoveFlg = false;
					}

					_this.prevSy = _this.sy;
				}


				/* ---------- push ---------- */
				this.onStructures.push( function(){
					addSettings();
					_this.window.addEventListener('scroll',start);
				});
				this.onRestructures.push( function(){
					addSettings();
					_this.window.addEventListener('scroll',start);
				});

				this.onDestroys.push( function(){
					removeSettings();
					_this.window.removeEventListener('scroll',start);

					for ( let i = 0; i < _this.slider.length; i++ ) {
						_this.slider[i].style.transform = 'translate3d(0,0,0)';
					}
				});
			}

		},
		setupMoveState: function(){
			const _this = this;


			/**************************************************************
			 * setupMoveState [開発中]
			 * 現状横方向のみ
			**************************************************************/
			// let moveState = function(){};

			// if( _this.options['moveState'] === true && _this.options['moveStateSelector'] != null ){
			// 	const state_target = document.querySelector( _this.options['moveStateSelector'] ) ;

			// 	/* ---------- moveState ---------- */
			// 	moveState = function(){
			// 		const state = ( translate - judgement ) / originalSize * 100;
			// 		state_target.style.transform = 'translate3d( '+ state +'%, 0, 0)';

			// 		if( state < _this.options['moveStateEndValue'] ){
			// 			state_target.classList.add('is-end');
			// 		} else if( state < _this.options['moveStateStartValue'] && state_target.classList.contains('is-end') ){
			// 			state_target.classList.remove('is-end');
			// 		}
			// 	}
			// }



			// /* ---------- push ---------- */
			// this.onStructures.push( function(){
			// 	setCssVariable();
			// });
			// this.onRestructures.push( function(){
			// });

			// this.onDestroys.push( function(){
			// });

		},
		setupDrag: function(){
			const _this = this;


			/**************************************************************
			 * setupDrag [開発中]
			**************************************************************/
			// if( options['drag'] === true ){
			// 	const drag_target = document.querySelector( options['dragSelector'] ) ;
			// 	let defaultMouseClientX = 0;
			// 	let defaultTranslate = 0;
			// 	let dragTranslate = 0;

			// 	/* ---------- dragMove ---------- */
			// 	const dragMove = function(){
			// 		const moveValue = defaultMouseClientX - event.clientX;
			// 		dragTranslate = defaultTranslate - moveValue;
			// 		target.style.transform = 'translate3d( '+ dragTranslate +'px, 0, 0)';
			// 	}

			// 	target.addEventListener('mousedown',function(){
			// 		target.classList.add('is-dragging');

			// 		/* ----- stop -----  */
			// 		window.cancelAnimationFrame(requestId);

			// 		/* ----- drag -----  */
			// 		defaultMouseClientX = event.clientX;
			// 		defaultTranslate = translate;
			// 		target.addEventListener('mousemove',dragMove);
			// 	});


			// 	/* ---------- removeDragMove ---------- */
			// 	const removeDragMove = function(){
			// 		target.classList.remove('is-dragging');
			// 		target.removeEventListener('mousemove',dragMove);
			// 		translate = dragTranslate;
			// 		animationLoop();
			// 	}

			// 	target.addEventListener('mouseup',removeDragMove);
			// 	document.body.addEventListener('mouseleave',removeDragMove);
			// }



			// /* ---------- push ---------- */
			// this.onStructures.push( function(){
			// 	setCssVariable();
			// });
			// this.onRestructures.push( function(){
			// });

			// this.onDestroys.push( function(){
			// });

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
