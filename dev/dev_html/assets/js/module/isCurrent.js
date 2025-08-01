/*! isCurrent.js | v3.1.0 | license Copyright (C) 2020 - 2022 Taichi Matsutaka */
/*
 *
 * @name    : isCurrent.js
 * @content : isCurrent
 * @creation: 2020.01.03
 * @update  : 2022.02.11
 * @version : 3.1.0
 *
 */
(function(global) {[]
	global.isCurrent = function(node,options){
		/////////////////////////////////////////////
		// defaults options
		/////////////////////////////////////////////
		this.nodeElements = Array.prototype.slice.call( document.querySelectorAll( node ) ,0) ;

		const defaults = {
			parameterHash: true,
			currentClass : 'is-current',
			contain      : false,
			containClass : 'is-contain',
		}


		/////////////////////////////////////////////
		// options
		/////////////////////////////////////////////
		for( let option in options){
			defaults[option] = options[option];
		}
		this.options = defaults;


		/////////////////////////////////////////////
		// base
		/////////////////////////////////////////////
		this.base();


	};
	isCurrent.prototype = {
		base: function(){
			const _this   = this;
			const options = this.options;


			/////////////////////////////////////////////
			// 相対パスを取得
			/////////////////////////////////////////////
			function getDir(path) {
				return path.replace(/\\/g, '/').replace(/^[^/]*\/\/[^/]*/, '');
			}
			let page_url = getDir( window.location.href ); // パラメーターやハッシュタグ含め全て相対パスで取得する

			if( options['parameterHash'] === false ){
				// falseならパラメーターやハッシュタグなしの相対パスで取得する
				page_url = window.location.pathname;
			}


			this.nodeElements.forEach(function(target) {
				/////////////////////////////////////////////
				// 判別
				/////////////////////////////////////////////
				let href = target.getAttribute('href');

				if( href == page_url ){
					target.classList.add( options['currentClass'] );
				}

				if( options['contain'] == true ){
					if ( page_url.indexOf( href ) != -1 ) {
						target.classList.add( options['containClass'] );
					}
				}
			});
		},
	};

})(this);
