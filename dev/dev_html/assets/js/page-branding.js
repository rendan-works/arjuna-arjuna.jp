/**
 *
 * page-branding.js
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
	 * membersCarousel
	**************************************************************/
	const membersCarousel = function(){
		const carousel  = document.querySelector('.branding-members__carousel');
		let swiper      = null;
		let rotate      = 0;
		let rotateValue = 360 / 7;


		/**************************************************************
		 * onInit
		**************************************************************/
		swiper = new Swiper( carousel , {
			loop: true,
			autoplay: {
				delay: 4000,
			},
			speed         : 1200,
			slidesPerView : 'auto',
			navigation: {
				nextEl: '.branding-members__ui__next button',
				prevEl: '.branding-members__ui__prev button',
			},
			centeredSlides: true,
			breakpoints: {
				1024: {
					centeredSlides: false
				}
			},
			on: {
				init: function(){
					const slidesOdd = document.querySelectorAll('.swiper-slide:nth-of-type(2n-1)');

					for ( let i = 0; i < slidesOdd.length; i++ ) {
						slidesOdd[i].classList.add('-space');
					}
				},
				slideChangeTransitionStart: function () {
					if( swiper == null ){
						return false;
					}

					rotate -= rotateValue;
					carousel.style.setProperty('--rotate', rotate + 'deg' );

					const slides      = document.querySelectorAll('.swiper-slide');
					const slidesEven  = document.querySelectorAll('.swiper-slide:nth-of-type(2n)');
					const slidesOdd   = document.querySelectorAll('.swiper-slide:nth-of-type(2n-1)');
					const activeIndex = swiper.realIndex;

					for ( let i = 0; i < slides.length; i++ ) {
						slides[i].classList.remove('-space');
					}

					if ( activeIndex % 2 === 0 ) {
						for ( let i = 0; i < slidesOdd.length; i++ ) {
							slidesOdd[i].classList.add('-space');
						}
					} else{
						for ( let i = 0; i < slidesEven.length; i++ ) {
							slidesEven[i].classList.add('-space');
						}
					}
				},
				transitionStart: function (swiper) {
					swiper.autoplay.stop();
				},
				transitionEnd: function (swiper) {
					swiper.autoplay.start();
				},
			}
		});


	}
	membersCarousel();








})();