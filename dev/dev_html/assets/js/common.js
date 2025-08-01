/**
 *
 * common.js
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
	 * Font,Loading
	 *
	 * AdobeのWebフォントは読み込みが遅いので、読み込むまでローディングを表示。
	 * フォントの読み込みが完了すると、bodyに「wf-active」クラスが付与される。
	 * そのタイミングで独自イベントのfontLoadを発動する。
	 *
	 */
	const fontLoad = function(){
		const fontLoad = new CustomEvent('fontLoad');

		const root       = document.body.dataset.root;
		const currentDir = window.location.pathname + window.location.hash;

		let loadFlg     = false;
		let fontLoadFlg = false;

		let advanceId  = null;
		let advanceNum = 0;
		let countUp    = null;
		let countUpId  = null;

		const goal     = 100;
		let to         = goal - advanceNum;
		const duration = 4500;


		/**************************************************************
		 * loading
		**************************************************************/
		/******************************************
		 * init
		******************************************/
		if( currentDir === root && !sessionStorage.getItem('loading') && !location.hash ) {
			const loadingCounter = document.querySelector('.l-loading__counter');
			const loadingCounterNum = document.querySelector('.l-loading__counter__num');
			loadingCounter.classList.add('is-visible');

			/* ---------- easing ---------- */
			const easing = function(x){
				return x < 0.5 ? 16 * x * x * x * x * x : 1 - Math.pow(-2 * x + 2, 5) / 2;
			};


			/* ---------- advance ---------- */
			advanceId = setInterval(function(){
				advanceNum++;
				loadingCounterNum.innerText = String( advanceNum ).padStart(3, '0');
			},80);


			/* ---------- countup ---------- */

			const startTime = performance.now();

			countUp = function(){
				const elapsed      = performance.now() - startTime;
				const currentRatio = elapsed / duration;
				const num          = Math.round( to * easing( currentRatio ) ) + advanceNum;

				if ( num >= goal ) {
					loadingCounterNum.innerText = goal;
					cancelAnimationFrame( countUpId );

					setTimeout(function(){
						window.dispatchEvent( fontLoad );
					},500);
				} else {
					loadingCounterNum.innerText = String( num ).padStart(3, '0');
					countUpId = requestAnimationFrame( countUp );
				}
			}

		}


		/******************************************
		 * loadingOut
		******************************************/
		const loadingOut = () => {
			if( currentDir === root && !sessionStorage.getItem('loading') && !location.hash ) {
				/******************************************
				 * トップ1回目のローディング
				******************************************/
				clearInterval( advanceId );

				setTimeout(function(){
					to = goal - advanceNum;
					countUpId = requestAnimationFrame( countUp );
				},200);

				sessionStorage.setItem('loading', 'on');
			} else{
				/******************************************
				 * 2回目以降のローディング
				******************************************/
				window.dispatchEvent( fontLoad );
			}
		}


		/**************************************************************
		 * typekit
		**************************************************************/
		var config = {
			// kitId        : 'zej8ldg',
			kitId        : 'iln4brt',
			scriptTimeout: 3000,
			async        : true,
			active       : function(){
				if( fontLoadFlg == false && loadFlg == true ){
					loadingOut();
				}
				fontLoadFlg = true;
			},
		},
		head           = document.documentElement,
		timeout        = setTimeout(function () {
		head.className = head.className.replace(/\bwf-loading\b/g, "") + " wf-inactive";
		}, config.scriptTimeout),
		tk             = document.createElement("script"),
		font           = false,
		script         = document.getElementsByTagName("script")[0],
		a;

		head.className += " wf-loading";
		tk.src         = 'https://use.typekit.net/' + config.kitId + '.js';
		tk.async       = true;
		tk.onload      = tk.onreadystatechange = function () {
			a = this.readyState;
			if (font || a && a != "complete" && a != "loaded")
				return;
			font = true;
			clearTimeout(timeout);
			try {
				Typekit.load(config);
			} catch (e) {}
		};
		script.parentNode.insertBefore(tk, script)



		/**************************************************************
		 * event
		**************************************************************/
		window.addEventListener('load',function(){
			loadFlg = true;

			if( fontLoadFlg === true ){
				loadingOut();
			}
		});

	};
	fontLoad();
	window.addEventListener('fontLoad',function(){
		document.body.classList.add('is-fontLoad');
	});






	/**
	 *
	 * Svg
	 *
	 * imgタグなどからSVGを生成。
	 * common.cssに属するクラスは全てここで一括指定。
	 * ページ固有のものはimgタグやdata属性で直接指定。
	 *
	 */
	window.addEventListener('DOMContentLoaded', function(){
		/**************************************************************
		 * 直接指定
		**************************************************************/
		new changeSvg('img.js-svg',{});
		new changeSvg('[data-class="js-svg"]',{});


		/**************************************************************
		 * 一括指定
		**************************************************************/
		new changeSvg('.c-arrow:not(.-small):not(.-large)',{
			svg: root + 'assets/img/common/icon/arrow.svg',
		});
		new changeSvg('.c-arrow.-small',{
			svg  : root + 'assets/img/common/icon/arrow_small.svg',
		});
		new changeSvg('.c-arrow.-large',{
			svg  : root + 'assets/img/common/icon/arrow_large.svg',
		});
		new changeSvg('.c-arrow2.-small,.c-arrow2.-xsmall',{
			svg: root + 'assets/img/common/icon/arrow2_small.svg',
		});
		new changeSvg('.c-arrow2.-large',{
			svg: root + 'assets/img/common/icon/arrow2_large.svg',
		});
		new changeSvg('.c-call',{
			svg: root + 'assets/img/common/icon/call.svg',
		});
		new changeSvg('.c-index',{
			svg: root + 'assets/img/common/icon/index.svg',
		});
		new changeSvg('.c-down2',{
			svg: root + 'assets/img/common/icon/down2.svg',
		});

	});







	/**
	 *
	 *
	 * Base
	 *
	 *
	 */
	/**************************************************************
	 * isView
	**************************************************************/
	new isView('.js-loopslider-wrap',{
	});


	/**************************************************************
	 * cssVariable
	**************************************************************/
	new cssVariable(null,{
		vh: true,
		vw: true,
	});


	/**************************************************************
	 * useragent
	**************************************************************/
	new uaLite({
		device    : true,
		deviceType: true,
		browser   : true,
	});


	/**************************************************************
	 * canIUse
	**************************************************************/
	// new canIUse({
	// 	webp  : true,
	// 	tags  : null,
	// 	styles: null
	// });


	/**************************************************************
	 * isCurrent
	**************************************************************/
	new isCurrent('a',{
		currentClass: 'is-current',
		contain     : true,
		containClass: 'is-contain',
	});


	/**************************************************************
	 * lazyload
	**************************************************************/
	new lazyload('.js-lazyload',{
		position : 2,
		setClass : 'is-set',
		objectFit: true,

		getWindowSizeEvent: ['DOMContentLoaded','resize'],
		getScrollTopEvent : ['DOMContentLoaded','scroll'],
		setSourceEvent    : ['DOMContentLoaded','scroll'],
	});


	/**************************************************************
	 * addClass
	**************************************************************/
	window.addEventListener('fontLoad',function(){
		document.body.classList.add('is-load');
	});


	/**************************************************************
	 * smoothScroll
	**************************************************************/
	const easingFuncs = new getEasing({
		easing: 'easeInOutExpo',
	});

	new smoothScroll('a[href^="#"]',{
		documentTop   : true,
		easingFunction: easingFuncs,
		minus         : [0],
		speed         : 800,
	});






	/**
	 *
	 *
	 * Layout
	 *
	 *
	 */
	/**************************************************************
	 * popup
	**************************************************************/
	new popup('.l-header__button',{
		popupSelector  : '.l-sitemap',
		bg             : false,
		smoothScroll   : 'a[href^="#"]',
		popupOpenClass : 'is-open',
		buttonOpenClass: 'is-open',
		bodyOpenClass  : 'is-sitemap-open',
		basicId        : 'aria-sitemap',
		basicIdIndex   : false,
	});







	/**
	 *
	 *
	 * UI
	 *
	 *
	 */
	/**************************************************************
	 * accordion
	 * hoverとclickで親要素のクラスを変えて振り分ける
	 * 小要素のクラスは同じ
	 * スタイルは各々で指定する
	**************************************************************/
	new accordion('.js-accordion-click',{
		addHeight           : true,
		transitionDuration  : 500,
		switchSelector      : '.js-accordion__switch',
		closeSwitchSelector : null,
		panelSelector       : '.js-accordion__panel',
		event               : 'click',
		anotherElementClose : false,
		openClass           : 'is-open',
		firstOpenClass      : 'is-first',
		basicId             : 'aria-accordion-',
		onInit : null,
		onOpen : null,
		onClose: null,
	});
	new accordion('.js-accordion-click-mqDown-lg',{
		mediaQuery         : 'screen and ( max-width: '+ mqDownLg +'px )',
		transitionDuration : 500,
		addHeight          : true,
		switchSelector     : '.js-accordion__switch',
		closeSwitchSelector: null,
		panelSelector      : '.js-accordion__panel',
		event              : 'click',
		anotherElementClose: false,
		openClass          : 'is-open',
		firstOpenClass     : 'is-first',
		basicId            : 'aria-accordion-',
		onInit : null,
		onOpen : null,
		onClose: null,
	});


	/**************************************************************
	 * loopSlider
	**************************************************************/
	imagesLoaded( document.querySelectorAll('.js-loopslider img,.js-loopslider-mqUp-lg img'), function( instance ) {
		new loopSlider( '.js-loopslider,.js-loopslider-mqUp-lg', {
			mediaQuery    : null,
			sliderSelector: '.js-loopslider__content',
			resizeDelay   : 0,
			type          : 'horizontal',
			clone         : 3,
			speed         : 0.6,
			addSize       : 10,
		});
	});









	/**
	 *
	 *
	 * Component
	 *
	 *
	 */
	/**************************************************************
	 * p-card4-carousel
	**************************************************************/
	const ard4Swiper = function(){
		var swiper = new Swiper( '.p-card4-carousel' , {
			loop          : true,
			autoplay      : true,
			speed         : 1000,
			slidesPerView : 'auto',
			centeredSlides: false,
			mousewheel: {
				forceToAxis: true,
				releaseOnEdges: true,
				// sensitivity: 3
			},
		});
	}
	ard4Swiper();


	/**************************************************************
	 * p-article2
	**************************************************************/
	const article2Slider = function(){
		const length = document.querySelectorAll('.p-article2__figure__slide').length;

		if( length === 0 ) return false;

		if( length === 1 ){
			const ui = document.querySelector('.p-article2__figure__ui');
			ui.classList.add('is-hidden');
		}

		new intervalChange('.p-article2__figure',{
			sliderSelector             : '.p-article2__figure__content',
			autoplay                   : true,
			immedStart                 : false,
			intervalSpeed              : 4000,
			startDelay                 : 0,
			put                        : false,
			dots                       : false,
			counter                    : false,
			zIndex                     : false,
			navigation                 : true,
			prevSelector               : '.p-article2__figure__ui__prev',
			nextSelector               : '.p-article2__figure__ui__next',

			setClass   : 'is-set',
			startClass : 'is-start',
			changeClass: 'is-change',
			activeClass: 'is-active',
			prevClass  : 'is-prev',
			nextClass  : 'is-next',

			onInit       : null,
			onAddSlide   : null,
			onRemoveSlide: null,
		});
	}
	article2Slider();








	/**
	 *
	 *
	 * Effect
	 *
	 *
	 */
	/**************************************************************
	 * splitText
	**************************************************************/
	new splitText( '.js-splittext' , {
		mediaQuery  : null,
		type        : 'cssVariable',
		varName     : '--delay',
		delay       : true,
		delayDefault: 0,
		delayChange : 60,
		data        : false,
		depth       : false,
		textClass   : ['js-splittext__text'],
		random      : -1,
	});


	/**************************************************************
	 * parallax
	**************************************************************/
	new parallax('.js-parallax.-small',{
		direction    : 'vertical',
		move         : .2,
		speed        : 1,
		standard     : .5,
		centerMode   : true,
	});
	new parallax('.js-parallax.-medium',{
		direction    : 'vertical',
		move         : .15,
		speed        : 1,
		standard     : .5,
		centerMode   : true,
	});
	new parallax('.js-parallax.-large',{
		direction    : 'vertical',
		move         : .07,
		speed        : 1,
		standard     : .5,
		centerMode   : true,
	});


	/**************************************************************
	 * scrollClass
	**************************************************************/
	window.addEventListener('fontLoad',function(){
		const target = document.querySelectorAll('[class*="p-hero"],.js-load-trigger');

		for (let i = 0; i < target.length; i++) {
			target[i].classList.add('is-shown');
		}
	});


	new scrollClass('.js-trigger',{
		addClass: 'is-shown',
		IntersectionObserverOptions: {
			rootMargin: '-20% 0px -20%', // 5
		},
	});




})();