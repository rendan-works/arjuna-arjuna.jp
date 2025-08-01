/*! intervalChange.js | v4.8.0 | license Copyright (C) 2019 - 2024 Taichi Matsutaka */
/**
 *
 * @name    : intervalChange.js
 * @content : intervalChange
 * @creation: 2019.10.12
 * @update  : 2024.07.02
 * @version : 4.8.0
 *
 */
(function(global) {[]
	global.intervalChange = function(target,options){
		const _this = this;


		///////////////////////////////////////////////////////////////
		// defaults options
		///////////////////////////////////////////////////////////////
		if (typeof target === "string" || target instanceof String) {
			this.targetElements = Array.prototype.slice.call( document.querySelectorAll( target ) ,0) ;
		} else{
			if( target.length ){
				this.targetElements = target;
			} else{
				this.targetElements = [target];
			}
		}

		const defaults = {
			sliderSelector             : null,
			autoplay                   : true,
			immedStart                 : false,
			intervalSpeed              : 5000,
			startDelay                 : 0,
			put                        : false,
			putActiveClass             : 'is-put',
			putDelay                   : 1000,
			dots                       : false,
			dotsSelector               : null,
			dotsChildrenSelector       : 'li',
			dotsContainerSelector      : null,
			dotsContainerType          : 'target', // or 'document'
			dotsInnerHTML              : '',
			dotsActiveClass            : 'is-active',
			counter                    : false,
			counterClick               : false,
			counterContainerSelector   : null,
			zIndex                     : false,
			navigation                 : false,
			navigationContainerSelector: null,
			prevSelector               : null,
			nextSelector               : null,
			addData                    : false,

			setClass   : 'is-set',
			startClass : 'is-start',
			changeClass: 'is-change',
			activeClass: 'is-active',
			prevClass  : 'is-prev',
			nextClass  : 'is-next',

			dotsClass          : ['intervalChange__dots'],
			navigationPrevClass: ['intervalChange__prev'],
			navigationNextClass: ['intervalChange__next'],
			counterClass       : ['intervalChange__counter'],
			counterCurrentClass: ['intervalChange__counter__current'],
			counterTotalClass  : ['intervalChange__counter__total'],

			onInit       : null,
			onAddSlide   : null,
			onRemoveSlide: null,
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
	intervalChange.prototype = {
		base: function(){
			const _this   = this;
			const options = this.options;


			///////////////////////////////////////////////////////////////
			// 非アクティブ判定
			///////////////////////////////////////////////////////////////
			let hidden = '';
			let visibilityChange = '';

			if ( typeof document.hidden !== "undefined" ) {
				// Opera 12.10 や Firefox 18 以降でサポート
				hidden = "hidden";
				visibilityChange = "visibilitychange";
			} else if ( typeof document.msHidden !== "undefined" ) {
				hidden = "msHidden";
				visibilityChange = "msvisibilitychange";
			} else if ( typeof document.webkitHidden !== "undefined" ) {
				hidden = "webkitHidden";
				visibilityChange = "webkitvisibilitychange";
			}



			this.targetElements.forEach(function(target) {
				///////////////////////////////////////////////////////////////
				// variable
				///////////////////////////////////////////////////////////////
				let slider;

				if( options['sliderSelector'] != null ){
					slider = target.querySelector( options['sliderSelector'] );
				} else{
					slider = target.children[0];
				}

				let slide  = slider.children;
				let length = slide.length;

				let state  = 0;
				let zIndex = length;

				let timer = '';

				let dots;
				let dotsCell = [];
				let nav_prev;
				let nav_next;
				let counter;
				let counterCurrent;
				let counterTotal;



				///////////////////////////////////////////////////////////////
				// settings
				///////////////////////////////////////////////////////////////
				///////////////////////////////////////////
				// slide
				///////////////////////////////////////////
				/* ---------- 初期スライド ---------- */
				for ( let i = 0; i < length; i++ ) {
					if( i === 0 ){
						slide[i].classList.add( options['activeClass'] );
						if( options['put'] == true ){
							slide[i].classList.add( options['putActiveClass'] );
						}
					} else if( i === 1 ){
						slide[i].classList.add( options['nextClass'] );
					} else{
						slide[i].classList.add( options['prevClass'] );
					}
				}


				///////////////////////////////////////////
				// zIndex
				///////////////////////////////////////////
				if( options['zIndex'] == true ){
					/* ---------- 初期値 ---------- */
					for ( let i = 0; i < length; i++ ) {
						slide[i].style.zIndex = length - i;
					}
				}


				///////////////////////////////////////////
				// dots
				///////////////////////////////////////////
				if( options['dots'] == true && length > 1 ){
					/* ---------- dotsが指定してあればそれを使う ---------- */
					if( options['dotsSelector'] != null ){
						dots     = target.querySelector( options['dotsSelector'] );
						dotsCell = target.querySelectorAll( options['dotsChildrenSelector'] );

						for ( let i = 0; i < dotsCell.length; i++ ) {
							dotsCell[i].dataset.index = i;

							if( i == 0 ){
								dotsCell[i].classList.add( options['activeClass'] );
							}
						}
					} else{
						dots = document.createElement('ul');

						for (var i = 0; i < options['dotsClass'].length; i++) {
							dots.classList.add( options['dotsClass'][i] );
						}

						for ( let i = 0; i < length; i++ ) {
							const li = document.createElement('li');
							li.dataset.index = i;
							li.innerHTML = options['dotsInnerHTML']

							if( i == 0 ){
								li.classList.add( options['activeClass'] );
							}
							dots.appendChild( li );
						}

						/* ---------- 挿入先に指定があればそこへ挿入。なければ最後に追加 ---------- */
						if( options['dotsContainerSelector'] != null ){
							let dotsContainer = null;

							if( options['dotsContainerType'] === 'target' ){
								dotsContainer = target.querySelector( options['dotsContainerSelector'] );
							} else if( options['dotsContainerType'] === 'document' ){
								dotsContainer = document.querySelector( options['dotsContainerSelector'] );
							}

							if( dotsContainer ){
								dotsContainer.appendChild( dots );
							} else{
								target.appendChild( dots );
							}
						} else{
							target.appendChild( dots );
						}

						/* ---------- 最終的なcellを代入 ---------- */
						dotsCell = dots.querySelectorAll('li');
					}
				}


				///////////////////////////////////////////
				// navigation
				// prevSelectorとnextSelectorが両方ともnullならJavaScriptで生成し、
				// 指定があればその要素をナビゲーションとして使用する
				///////////////////////////////////////////
				if( options['navigation'] == true && length > 1 ){

					if( options['prevSelector'] == null && options['nextSelector'] == null ){
						/* ---------- 要素とクラスを生成 ---------- */
						nav_prev = document.createElement('div');
						nav_next = document.createElement('div');

						for (var i = 0; i < options['navigationPrevClass'].length; i++) {
							nav_prev.classList.add( options['navigationPrevClass'][i] );
						}

						for (var i = 0; i < options['navigationNextClass'].length; i++) {
							nav_next.classList.add( options['navigationNextClass'][i] );
						}

						/* ---------- 挿入先に指定があればそこへ挿入。なければ最後に追加 ---------- */
						if( options['navigationContainerSelector'] != null ){
							const navigationContainer = target.querySelector( options['navigationContainerSelector'] );
							target.appendChild( nav_prev );
							target.appendChild( nav_next );
						} else{
							target.appendChild( nav_prev );
							target.appendChild( nav_next );
						}
					} else{
						/* ---------- 要素とクラスを生成 ---------- */
						nav_prev = target.querySelector( options['prevSelector'] );
						nav_next = target.querySelector( options['nextSelector'] );
					}
				}

				target.classList.add( options['setClass'] );


				///////////////////////////////////////////
				// counter
				///////////////////////////////////////////
				if( options['counter'] == true ){
					/* ---------- 要素とクラスを生成 ---------- */
					if( options['counterClick'] == true ){
						counter = document.createElement('button');
					} else{
						counter = document.createElement('div');
					}
					counterCurrent = document.createElement('p');
					counterTotal   = document.createElement('p');

					for (var i = 0; i < options['counterClass'].length; i++) {
						counter.classList.add( options['counterClass'][i] );
					}
					for (var i = 0; i < options['counterCurrentClass'].length; i++) {
						counterCurrent.classList.add( options['counterCurrentClass'][i] );
					}
					for (var i = 0; i < options['counterTotalClass'].length; i++) {
						counterTotal.classList.add( options['counterTotalClass'][i] );
					}

					counter.appendChild( counterCurrent );
					counter.appendChild( counterTotal );

					/* ---------- 初期値 ---------- */
					counterCurrent.innerHTML = '1';
					counterTotal.innerHTML = length;

					/* ---------- 挿入先に指定があればそこへ挿入。なければ最後に追加 ---------- */
					if( options['counterContainerSelector'] != null ){
						const counterContainer = target.querySelector( options['counterContainerSelector'] );
						counterContainer.appendChild( counter );
					} else{
						target.appendChild( counter );
					}
				}


				///////////////////////////////////////////
				// addData
				///////////////////////////////////////////
				if( options['addData'] == true ){
					/* ---------- 初期値 ---------- */
					const firstData = slide[0].dataset.slide;
					target.dataset.slide = firstData;
				}


				///////////////////////////////////////////
				// 関数
				///////////////////////////////////////////
				/* ---------- onInit ---------- */
				if( typeof options['onInit'] === 'function' ){
					options['onInit']( target );
				}
				/* ---------- onAddSlide ---------- */
				if( typeof options['onAddSlide'] === 'function' ){
					options['onAddSlide']( target , slide[0] , dotsCell[0] );
				}






				///////////////////////////////////////////////////////////////
				// スライドを変更する関数等
				///////////////////////////////////////////////////////////////
				///////////////////////////////////////////
				// myPositionClass
				///////////////////////////////////////////
				function myPositionClass(state){
					let next = state;

					if( next >= length - 1 ){
						next = 0;
					} else{
						next++;
					}

					for ( let i = 0; i < slide.length; i++ ) {
						let target = slide[i];
						if( i == state ){
							target.classList.remove( options['prevClass'] );
							target.classList.remove( options['nextClass'] );
							target.classList.add( options['activeClass'] );
						} else if( i == next ){
							target.classList.remove( options['prevClass'] );
							target.classList.remove( options['activeClass'] );
							target.classList.add( options['nextClass'] );
						} else{
							target.classList.remove( options['nextClass'] );
							target.classList.remove( options['activeClass'] );
							target.classList.add( options['prevClass'] );
						}
					}
				}



				///////////////////////////////////////////
				// removeSlide
				///////////////////////////////////////////
				function removeSlide(state){
					let prevSlide = slide[ state ];
					let prevDotsCell;

					if( dots ){
						prevDotsCell = dotsCell[ state ];
					}

					// not click
					if( dots ){
						dots.classList.add( options['changeClass'] );
					}
					if( nav_prev || nav_next ){
						nav_prev.classList.add( options['changeClass'] );
						nav_next.classList.add( options['changeClass'] );
					}


					// prev
					if( options['put'] == true ){
						setTimeout(function(){
							prevSlide.classList.remove( options['putActiveClass'] );
							// not click
							if( dots ){
								dots.classList.remove( options['changeClass'] );
							}
							if( nav_prev || nav_next ){
								nav_prev.classList.remove( options['changeClass'] );
								nav_next.classList.remove( options['changeClass'] );
							}
						}, options['putDelay'] );
					}

					// dots
					if( dots ){
						prevDotsCell.classList.remove( options['dotsActiveClass'] );
					}

					/* ---------- onRemoveSlide ---------- */
					if( typeof options['onRemoveSlide'] === 'function' ){
						options['onRemoveSlide']( target , prevSlide , prevDotsCell );
					}
				}



				///////////////////////////////////////////
				// addSlide
				///////////////////////////////////////////
				function addSlide(state){
					let activeSlide = slide[ state ];
					let activeDotsCell;

					if( dots ){
						activeDotsCell = dotsCell[ state ];
					}

					// active
					if( options['zIndex'] == true ){
						zIndex++;
						activeSlide.style.zIndex = zIndex;
						zIndex = zIndex;
					}

					if( options['put'] == true ){
						activeSlide.classList.add( options['putActiveClass'] );
					} else{
						// not click
						if( dots ){
							dots.classList.remove( options['changeClass'] );
						}
						if( nav_prev || nav_next ){
							nav_prev.classList.remove( options['changeClass'] );
							nav_next.classList.remove( options['changeClass'] );
						}
					}

					// dots
					if( dots ){
						activeDotsCell.classList.add( options['dotsActiveClass'] );
					}

					/* ---------- onAddSlide ---------- */
					if( typeof options['onAddSlide'] === 'function' ){
						options['onAddSlide']( target , activeSlide , activeDotsCell );
					}
				}



				///////////////////////////////////////////
				// counter
				///////////////////////////////////////////
				let coutnerChange = function( state ){};

				if( options['counter'] == true ){
					coutnerChange = function( state ){
						let current = state;
						current++;
						counterCurrent.innerHTML = current;
					}
				}



				///////////////////////////////////////////
				// addData
				///////////////////////////////////////////
				let dataChange = function( state ){};

				if( options['addData'] == true ){
					dataChange = function( state ){
						const currentData = slide[state].dataset.slide;
						target.dataset.slide = currentData;
					}
				}






				///////////////////////////////////////////////////////////////
				// changeSlide
				///////////////////////////////////////////////////////////////
				function changeSlide( stateFunction ){
					if ( document[hidden] ) {
						clearInterval( timer );
						stopFlg = true;
					}

					/* remove */
					removeSlide( state );

					/* stateFunction */
					if( typeof stateFunction === 'function' ){
						stateFunction();
					}

					/* coutnerChange */
					coutnerChange( state );

					/* dataChange */
					dataChange( state );

					/* myPositionClass */
					myPositionClass( state );

					/* add */
					addSlide( state );
				}



				///////////////////////////////////////////////////////////////
				// StateFunctions
				///////////////////////////////////////////////////////////////
				///////////////////////////////////////////
				// nextStateFunction
				///////////////////////////////////////////
				function nextStateFunction(){
					if( state >= length - 1 ){
						state = 0;
					} else{
						state++;
					}

					let next = state;
					if( next >= length - 1 ){
						next = 0;
					} else{
						next++;
					}
				}


				///////////////////////////////////////////
				// prevStateFunction
				///////////////////////////////////////////
				function prevStateFunction(){
					if( state == 0 ){
						state = length - 1;
					} else{
						state--;
					}

					let next = state;
					if( next >= length - 1 ){
						next = 0;
					} else{
						next++;
					}
				}





				///////////////////////////////////////////////////////////////
				// eventChange
				///////////////////////////////////////////////////////////////
				function eventChange( stateFunction ){
					clearInterval( timer );
					changeSlide( stateFunction );

					/* setInterval */
					timer = setInterval(function(){
						changeSlide( nextStateFunction );
					}, options['intervalSpeed'] );
				}


				///////////////////////////////////////////
				// dots
				///////////////////////////////////////////
				if( options['dots'] == true && length > 1 ){
					for ( let i = 0; i < dotsCell.length; i++ ) {
						dotsCell[i].addEventListener('click',function(e){
							let index = this.dataset.index;

							eventChange(function(){
								state = index;

								let next = state;
								if( next >= length - 1 ){
									next = 0;
								} else{
									next++;
								}
							});
						});
					}
				}


				///////////////////////////////////////////
				// navigation nav_prev
				///////////////////////////////////////////
				if( nav_prev ){
					nav_prev.addEventListener('click',function(){
						event.preventDefault();
						event.stopPropagation();
						eventChange( prevStateFunction );
					});
				}


				///////////////////////////////////////////
				// navigation nav_next
				///////////////////////////////////////////
				if( nav_next ){
					nav_next.addEventListener('click',function(){
						event.preventDefault();
						event.stopPropagation();
						eventChange( nextStateFunction );
					});
				}


				///////////////////////////////////////////
				// counterClick
				///////////////////////////////////////////
				if( options['counterClick'] == true && length > 1 ){
					counter.addEventListener('click',function(){
						event.preventDefault();
						event.stopPropagation();
						eventChange( nextStateFunction );
					})
				}




				///////////////////////////////////////////////////////////////
				// start
				///////////////////////////////////////////////////////////////
				function start(){
					target.classList.add( options['startClass'] );
					timer = setInterval(function(){
						changeSlide( nextStateFunction );
					}, options['intervalSpeed'] );
				}

				if(
					options['immedStart'] == true &&
					options['autoplay'] == true &&
					length > 1
				){
					setTimeout(function(){
						start();
					},options['startDelay']);
				}

				window.addEventListener('load',function(){
					if(
						options['immedStart'] == false &&
						options['autoplay'] == true &&
						length > 1
					){
						setTimeout(function(){
							start();
						},options['startDelay']);
					}
				});


				///////////////////////////////////////////////////////////////
				// 非アクティブ状態では止める
				///////////////////////////////////////////////////////////////
				let stopFlg = false;

				window.addEventListener('load',function(){
					if (typeof document.addEventListener === "undefined" || hidden === undefined) {
					} else{
						document.addEventListener( visibilityChange , function(){
							if ( document[hidden] ) {
								clearInterval( timer );
								stopFlg = true;
								// console.log('stop - visibilityChange');
							} else{
								if( stopFlg === true ){
									start();
									// console.log('start - visibilityChange');
								}
							}
						}, false);
					}
				});


				///////////////////////////////////////////////////////////////
				// removes
				///////////////////////////////////////////////////////////////
				_this.removes.push( function(){
					clearInterval( timer );
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
