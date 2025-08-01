/**
 *
 * page-about.js
 *
 *
 */
(function($) {


	/**
	 *
	 *
	 * Variable
	 *
	 *
	 */
	/**************************************************************
	 * global
	**************************************************************/
	const root     = document.body.dataset.root;
	const mqUpLg   = getComputedStyle(document.documentElement).getPropertyValue('--mqUp-lg');
	const mqDownLg = getComputedStyle(document.documentElement).getPropertyValue('--mqDown-lg');







	/**
	 *
	 *
	 * .branding-members
	 *
	 *
	 */
	/**************************************************************
	 * introScrollAnimation
	**************************************************************/
	const introScrollAnimation = {
		intro : document.querySelector('.about-intro'),
		scroll: document.querySelector('.about-intro__scroll a'),

		ww: window.clientWidth,
		wh: document.documentElement.clientHeight,
		sy: document.documentElement.scrollTop || document.body.scrollTop,
		init: function(){
			this.createPosition();
			this.getSize();
			this.shownHidden();
			this.areaCreate();
		},
		createPosition: function(){
			const _this = this;

			const div = document.createElement('div');
			div.setAttribute('id', 'target-txt2Position');

			this.intro.insertAdjacentElement('afterend', div );
		},
		getSize: function(){
			const _this = this;


			/* ---------- getPosition ---------- */
			const getPosition = function(){
				_this.ww = window.innerWidth;
				_this.wh = document.documentElement.clientHeight;


				/* ----- offset ----- */
				_this.introOffset = _this.intro.getBoundingClientRect().top + _this.sy;


				/* ----- shownHidden ----- */
				_this.txtFrame    = 1600;
				_this.illustFrame = 1000;

				_this.txt1Position = _this.introOffset + _this.txtFrame;
				// _this.txt2Position = _this.txt1Position + _this.txtFrame;
				// _this.endPosition  = _this.txt2Position + _this.illustFrame;

				_this.intro.style.setProperty('--txt-frame', _this.txtFrame );
				_this.intro.style.setProperty('--illust-frame', _this.illustFrame );
			}
			window.addEventListener('load',getPosition);
			window.addEventListener('resize',getPosition);


			/* ---------- getSy ---------- */
			const getSy = function(){
				_this.sy = document.documentElement.scrollTop || document.body.scrollTop;
			}
			window.addEventListener('load',getSy);
			window.addEventListener('scroll',getSy);
		},
		shownHidden: function(){
			const _this = this;

			/* ---------- judge ---------- */
			const judge = function(){
				if( _this.sy < _this.txt1Position ){
					_this.intro.dataset.chapter = 1;
					_this.scroll.setAttribute('href','#target-txt1Position');
				} else{
					_this.intro.dataset.chapter = 2;
					_this.scroll.setAttribute('href','#target-txt2Position');

				// } else if( _this.sy > _this.txt1Position && _this.sy < _this.txt2Position ){
					// _this.intro.dataset.chapter = 2;
				// } else{
					// _this.intro.dataset.chapter = 3;
				}
			}

			window.addEventListener('load',judge);
			window.addEventListener('scroll',judge);
		},
		areaCreate: function(){
			const _this = this;

			const createDom = function( size , id ){
				const div = document.createElement('div');

				div.setAttribute('id', id );
				div.style.position        = 'absolute';
				div.style.top             = size + 10 + 'px';
				div.style.left            = '0';
				div.style.zIndex          = '10000';
				div.style.width           = '100%';

				document.body.appendChild( div );
			}

			const setPosition = function( size , id ){
				const div = document.getElementById( id );
				div.style.top = size + 10 + 'px';
			}

			window.addEventListener('load',function(){
				createDom( _this.txt1Position , 'target-txt1Position' );
				setPosition( _this.txt1Position , 'target-txt1Position' );
				// createDom( _this.endPosition , 'target-endPosition' );
				// setPosition( _this.endPosition , 'target-endPosition' );
			});
			window.addEventListener('resize',function(){
				setPosition( _this.txt1Position , 'target-txt1Position' );
				// setPosition( _this.endPosition , 'target-endPosition' );
			});

		},
	}
	introScrollAnimation.init();






	/**
	 *
	 *
	 * .branding-members
	 *
	 *
	 */
	/**************************************************************
	 * countMore
	**************************************************************/
	new cssVariable('.about-prize__table > div',{
		thisHeight              : true,
		thisHeightVarName       : '--height',
		thisHeightUnit          : 'px',
		thisHeightTargetSelector: 'dl',
		thisHeightDelay         : 0,
		thisHeightEvent         : null,
	});

	const countMore = function(){
		const target = document.querySelector('.about-prize');
		const button = document.querySelectorAll('.about-prize__button button');

		for ( let i = 0; i < button.length; i++ ) {
			button[i].addEventListener('click',function(){
				target.classList.toggle('is-open');
			});
		}
	}
	// countMore();









})();