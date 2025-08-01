/*! useragentLite.js | v1.0.1 | license Copyright (C) 2021 Taichi Matsutaka */
/*
 *
 * @name    : useragentLite.js
 * @content : useragentLite
 * @url     : https://github.com/taichaaan/js-useragent
 * @creation: 2021.10.26
 * @update  : 2021.11.01
 * @version : 1.0.1
 *
 */
(function(global) {[]
	global.uaLite = function(options){

		///////////////////////////////////////////////////////////////
		// defaults options
		///////////////////////////////////////////////////////////////
		const defaults = {
			device    : true,
			deviceType: true,
			browser   : true,
		}


		///////////////////////////////////////////////////////////////
		// options
		///////////////////////////////////////////////////////////////
		for( let option in options){
			defaults[option] = options[option];
		}
		this.options = defaults;


		///////////////////////////////////////////////////////////////
		// init
		///////////////////////////////////////////////////////////////
		this.init();


	};
	uaLite.prototype = {
		init: function(){
			const _this   = this;
			const options = this.options;

			_this.ua = {};

			_this.judgment();
			_this.addClass();
			// _this.check();
		},
		judgment:function(){
			/*
			 * 判定
			 * いろいろ判定する
			 */
			const _this   = this;
			const options = this.options;

			const ua           = navigator.userAgent.toLowerCase();
			const isTouchstart = window.ontouchstart === null?"touchstart":"click";


			///////////////////////////////////////////////////////////////
			// deviceType
			///////////////////////////////////////////////////////////////
			_this.ua.deviceType = (function(){
				const isTablet     =
					(
						ua.indexOf("windows") !== -1 &&
						ua.indexOf("touch") !== -1 &&
						ua.indexOf("tablet pc") == -1
					)||
					ua.indexOf("ipad") !== -1|| (ua.indexOf("android") !== -1 &&
					ua.indexOf("mobile") == -1)||  (ua.indexOf("firefox") !== -1 &&
					ua.indexOf("tablet") !== -1)|| ua.indexOf("kindle") !== -1|| ua.indexOf("silk") !== -1|| ua.indexOf("playbook") !== -1;
				const isSmartphone =
					(
						ua.indexOf("windows") !== -1 &&
						ua.indexOf("phone") !== -1
					) ||
					ua.indexOf("iphone") !== -1 || ua.indexOf("ipod") !== -1 || (ua.indexOf("android") !== -1 &&
					ua.indexOf("mobile") !== -1) || ( ua.indexOf("firefox") !== -1 &&
					ua.indexOf("mobile") !== -1) || ua.indexOf("blackberry") !== -1;

				if      ( isSmartphone && isTouchstart == 'touchstart' ) return ['smartphone'];
				else if ( isTablet && isTouchstart == 'touchstart' ) return ['tablet'];
				else if ( isTouchstart == 'click' ) return ['pc'];
				else if ( isTouchstart == 'touchstart' ) return ['tablet'];
			})();


			///////////////////////////////////////////////////////////////
			// device
			///////////////////////////////////////////////////////////////
			_this.ua.device = (function(){
				if      ( ua.indexOf('mac') > -1 && !('ontouchend' in document) ) return ['mac'];
				else if ( ua.indexOf('iphone') !== -1 || ua.indexOf('ipod') !== -1 ) return ['iphone'];
				else if ( ua.indexOf('ipad') !== -1 || ua.indexOf('mac') !== -1 && isTouchstart == 'touchstart' ) return ['ipad-mac'];
				else if ( ua.indexOf('ipad') !== - 1) return ['ipad'];
				else if ( ua.indexOf('android') !== -1 ) return ['android'];
				else if ( ua.indexOf('windows') !== -1 && ua.indexOf('phone') !== -1 ) return ['windows-phone'];
				else if ( ua.indexOf('windows') !== -1 ) return ['windows'];
				else return -1;
			})();



			///////////////////////////////////////////////////////////////
			// browser
			///////////////////////////////////////////////////////////////
			_this.ua.browser = (function(){
				if      ( ua.indexOf('edge') !== -1 ) return ['edge'];
				else if ( ua.indexOf("edga") !== -1 ) return ['edga'];
				else if ( ua.indexOf("edgios") !== -1 ) return ['edgios'];
				else if ( ua.indexOf("edg") !== -1 ) return ['edg'];
				else if ( ua.indexOf("iemobile") !== -1 ) return ['iemobile'];
				else if ( ua.indexOf('trident/7') !== -1 ) return ['ie','ie11'];
				else if ( ua.indexOf("msie") !== -1 && ua.indexOf('opera') === -1 ){
					if    ( ua.indexOf("msie 10.") !== -1 ) return ['ie','ie10'];
					else if ( ua.indexOf("msie 9.")  !== -1 ) return ['ie','ie9'];
					else if ( ua.indexOf("msie 8.")  !== -1 ) return ['ie','ie8'];
					else return -1;
				}
				else if ( ua.indexOf('crios')   !== -1 ) return ['crios'];
				else if ( ua.indexOf('gsa')     !== -1 ) return ['gsa'];
				else if ( ua.indexOf('yahoo')   !== -1 ) return ['yahoo'];
				else if ( ua.indexOf('fxios')   !== -1 ) return ['fxios'];
				else if ( ua.indexOf('firefox') !== -1 ) return ['firefox'];
				else if ( ua.indexOf('safari')  !== -1 && ua.indexOf('chrome') === -1 ) return ['safari'];
				else if ( ua.indexOf('chrome')  !== -1 && ua.indexOf('edge') === -1 )   return ['chrome'];
				else if ( ua.indexOf('opera')   !== -1 ) return ['opera'];
				else return -1;
			})();

		},
		addClass: function(){
			/*
			 * addClass
			 * bodyにクラスを付与
			 */
			const _this   = this;
			const options = this.options;

			const body   = document.body;
			const prefix = 'ua-';


			if( options['deviceType']  === true && _this.ua.deviceType !== -1 ){
				for ( let i = 0; i < _this.ua.deviceType.length; i++) {
					body.classList.add( prefix + _this.ua.deviceType[i] );
				}
			}
			if( options['device']  === true && _this.ua.device !== -1 ){
				for ( let i = 0; i < _this.ua.device.length; i++) {
					body.classList.add( prefix + _this.ua.device[i] );
				}
			}
			if( options['browser']  === true && _this.ua.browser !== -1 ){
				for ( let i = 0; i < _this.ua.browser.length; i++) {
					body.classList.add( prefix + _this.ua.browser[i] );
				}
			}

		},
		check: function(){
			/*
			 * 確認用
			 * タブレット、スマホでも確認できるように、アラートで表示
			 */
			const _this   = this;

			let check = '';

			for ( let i = 0; i < _this.ua.deviceType.length; i++) {
				check += _this.ua.deviceType[i] + ' , ';
			}
			for ( let i = 0; i < _this.ua.device.length; i++) {
				check += _this.ua.device[i] + ' , ';
			}
			for ( let i = 0; i < _this.ua.browser.length; i++) {
				check += _this.ua.browser[i] + ' , ';
			}

			alert( check );
		},
	};

})(this);
