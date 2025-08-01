/**
 *
 * page-home.js
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
	const root   = document.body.dataset.root;
	const mqUpLg = getComputedStyle(document.documentElement).getPropertyValue('--mqUp-lg');







	/**
	 *
	 *
	 * .home-blog
	 *
	 *
	 */
	/**************************************************************
	 * blogCarousel
	**************************************************************/
	const blogCarousel = function(){
		const carousel   = document.querySelector('.home-blog__list');
		const mediaQuery = window.matchMedia( 'screen and ( min-width: '+ mqUpLg +'px )' );
		let swiper       = null;
		let initFlg      = false;


		/**************************************************************
		 * onInit
		**************************************************************/
		const onInit = function(){
			initFlg = true;

			swiper = new Swiper( carousel , {
				loop: true,
				autoplay: {
					delay: 4000,
				},
				speed: 1000,
				slidesPerView : 'auto',
				centeredSlides: true,
			});
		}


		/**************************************************************
		 * onDestroy
		**************************************************************/
		const onDestroy = function(){
			if( initFlg == true ){
				initFlg = false;
				swiper.destroy();
			}
		}



		/**************************************************************
		 * mediaQuery
		**************************************************************/
		const checkBreakPoint = function( mediaQuery ) {
			if ( mediaQuery.matches ) {
				onInit();
			} else{
				onDestroy();
			}
		}

		mediaQuery.addListener( checkBreakPoint ); // ブレイクポイントの度に
		checkBreakPoint( mediaQuery ); // 初回


	}
	blogCarousel();





})();