/**
 *
 * @name   : base.js
 * @author : Taichi Matsutaka
 *
 * Copyright (C) 2021 - 2023 Taichi Matsutaka
 *
 *
 */
(function($) {


	/**
	 *
	 *
	 * Base
	 *
	 *
	 */
	/**************************************************************
	 * AnimationFrame
	**************************************************************/
	const requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;
	const cancelAnimationFrame  = window.cancelAnimationFrame || window.mozcancelAnimationFrame || window.webkitcancelAnimationFrame || window.mscancelAnimationFrame;
	window.requestAnimationFrame = requestAnimationFrame;
	window.cancelAnimationFrame  = cancelAnimationFrame;





	/**************************************************************
	 * customEventSetting
	**************************************************************/
	const customEventSetting = function(){
		if ( typeof window.CustomEvent === "function" ) return false;

		function CustomEvent ( event, params ) {
			params = params || { bubbles: false, cancelable: false, detail: undefined };
			var evt = document.createEvent( 'CustomEvent' );
			evt.initCustomEvent( event, params.bubbles, params.cancelable, params.detail );
			return evt;
		}

		CustomEvent.prototype = window.Event.prototype;
		window.CustomEvent = CustomEvent;
	}
	customEventSetting();






	/**************************************************************
	 * telUserAgent
	**************************************************************/
	const telUserAgent = function(){
		const target       = document.querySelectorAll('[href^="tel"]:not([data-pc-href])');
		const pcHrefTarget = document.querySelectorAll('[data-pc-href]');

		if( !navigator.userAgent.match(/(iPhone|Android)/) ){
			for ( let i = 0; i < target.length; i++ ) {
				target[i].style.pointerEvents = 'none';
				target[i].addEventListener('click',function(e){
					e.preventDefault();
				},false);
			}

			for ( let i = 0; i < pcHrefTarget.length; i++ ) {
				const pcHref = pcHrefTarget[i].dataset.pcHref;

				if( pcHref ){
					pcHrefTarget[i].setAttribute('href',pcHref);
				}
			}
		}
	}
	telUserAgent();





	/**************************************************************
	 * imgAttribute
	**************************************************************/
	const imgAttribute = function(){
		const target = document.getElementsByTagName('img');

		for ( let i = 0; i < target.length; i++ ) {
			target[i].setAttribute('onmousedown','return false');   //ドラッグ無効
			target[i].setAttribute('onselectstart','return false'); //ドラッグ無効
			// target[i].setAttribute('oncontextmenu','return false'); //右クリック無効
		}
	}
	imgAttribute();





	/**
	 *
	 *
	 * Scope
	 *
	 *
	 */
	/**************************************************************
	 * judgeYoutube
	**************************************************************/
	const judgeYoutube = function(){
		const target = document.querySelectorAll('.c-youtube2');

		for ( let i = 0; i < target.length; i++ ) {
			const iframe = target[i].querySelector('iframe[src*="youtube"]');

			if( iframe ){
				target[i].classList.add('is-aspect');
			}
		}
	}
	judgeYoutube();



















})();
