/*! contactForm.js | v4.9.0 | license Copyright (C) 2020 - 2024 Taichi Matsutaka */
/*
 *
 * @name    : contactForm.js
 * @content : contactForm
 * @creation: 2020.05.07
 * @update  : 2024.02.11
 * @version : 4.9.0
 *
 */
(function(global) {[]
	global.contactForm = function(target,options){
		/**************************************************************
		 * defaults options
		**************************************************************/
		this.targetElements = Array.prototype.slice.call( document.querySelectorAll( target ) ,0) ;

		const defaults = {
			scrollElement: 'body',
			controlClass: 'p-form__control',
			button      : '.p-form__button',
			submit      : '.p-form__submit',
			check       : '.p-form__check',

			required: [
				'[name="f_type"],[name="f_name"],[name="f_kana"],[name="f_mail"],[name="f_tel"]',
			],
			linkageRequired      : null,
			requiredStatus       : false,
			requiredStatusCurrent: '.js-count__current',
			requiredStatusTotal  : '.js-count__total',

			stepFunctions      : null,
			agree              : '[name="f_policy"]',
			emailCheck         : true,
			emailCheckRegex    : /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/,
			emailConfirm       : true,
			emailConfirmArray  : ['[name="f_mail"]','[name="f_mail-check"]'],
			telCheck           : true,
			telCheckRegex      : /^[0-9]+$/,
			yubinBango         : true,
			textareaPlaceholder: false,
			textareaSelector   : '.js-textarea',
			textareaDummyClass : 'p-form__txtbox--dummy',
			textareaKeepHeight : false,

			animation          : true,
			animationSpeed     : 500,
			animationDifference: [0],
			animationPosition  : 0,
			animationHierarchy : 1,
			animationEasing    : function (t, b, c, d) { return c * t / d + b; },

			errorTextClass       : [],
			errorTextEmailCheck  : '正しい形式で入力してください。',
			errorTextEmailConfirm: '確認用のメールアドレスが一致していません。',
			errorTextTelCheck    : '正しい形式で入力してください。',
			errorTextRequired    : '必須項目を入力してください。',

			errorClass   : 'is-error',
			disabledClass: 'is-disabled',
			doneClass    : 'is-done',
		}


		/**************************************************************
		 * options
		**************************************************************/
		for( let option in options){
			defaults[option] = options[option];
		}
		this.options = defaults;


		/**************************************************************
		 * base
		**************************************************************/
		this.removes = [];
		this.base();


	};
	contactForm.prototype = {
		base: function(){
			const _this   = this;
			const options = this.options;


			this.targetElements.forEach(function(target) {
				/**************************************************************
				 * variable
				**************************************************************/
				const form        = target;
				const button      = target.querySelector( options['button'] );
				const check       = target.querySelector( options['check'] );
				const submit      = target.querySelector( options['submit'] );
				const agree       = target.querySelectorAll( options['agree'] );
				const agreeLength = agree.length;

				let nowStep    = 1;
				let stepLength = 1;

				if( options['stepFunctions'] != null ) {
					stepLength = options['stepFunctions'].length;
				}

				let required = '';
				let email    = '';
				let tel      = '';

				if( stepLength > 1 ){
					target.dataset.state = nowStep;
					required = target.querySelectorAll( options['required'][ nowStep - 1 ] );
					email    = target.querySelectorAll('[data-step="' + nowStep + '"] [type="email"]');
					tel      = target.querySelectorAll('[data-step="' + nowStep + '"] [type="tel"]');

					/* stepFunctions */
					options['stepFunctions'][ nowStep - 1 ]();

				} else{
					required = target.querySelectorAll( options['required'][0] );
					email    = target.querySelectorAll('[type="email"]');
					tel      = target.querySelectorAll('[type="tel"]');
				}

				/*
				 * errorFlgs
				 *
				 * チェック項目毎に個別で管理
				 *
				 * trueがエラーあり、falseがエラーなし
				 * 通常は送信できる状態で、エラーがあればtrueに変更し送信させない。
				 *
				 */
				let errorFlg_required     = false;
				let errorFlg_emailCheck   = false;
				let errorFlg_emailConfirm = false;
				let errorFlg_telCheck     = false;


				/**************************************************************
				 * form reset
				**************************************************************/
				// form.reset();





				/**************************************************************
				 * searchControl
				 * controlClass を持つ親要素を取得
				**************************************************************/
				const searchControl = function( target ){
					let parents = [target];
					let parent = '';
					let control = target;

					for ( let i = 0; i > -1; i++ ) {
						parent = parents[i].parentNode;

						if( parent.classList.contains( options['controlClass'] ) ){
							control = parent;
							break;
						} else{
							parents.push(parent);
						}
					}

					return control;
				}



				/**************************************************************
				 * erroeMessage
				 * エラーメッセージの出力・削除
				**************************************************************/
				const erroeMessage = {
					add: function( target , text ){
						/* ---------- エラーメッセージを表示 ---------- */
						/* ----- pタグの準備 ----- */
						const p = document.createElement('p');

						/* ----- [name-ja] の部分をデータ属性の「data-name-ja」に置き換える ----- */
						const nameJa = target.dataset.nameJa;
						if( nameJa ) text = text.replace( '[name-ja]', nameJa );

						/* ----- 準備 ----- */
						p.innerHTML = text;
						p.classList.add( 'js-error-text' );

						/* ----- pタグを挿入するcontrolを取得 ----- */
						let control = searchControl( target );

						/* ----- pタグを追加 ----- */
						control.parentNode.appendChild( p );

						/* ----- オリジナルのクラスがあれば追加 ----- */
						for ( let i = 0; i < options['errorTextClass'].length; i++ ) {
							p.classList.add( options['errorTextClass'][i] );
						}

						/* ---------- エラークラスをcontrolに付与 ---------- */
						control.classList.remove( options['doneClass'] );
						control.classList.add( options['errorClass'] );
					},
					remove: function( target ){
						for ( let i = 0; i < target.length; i++ ) {
							/* ---------- エラーメッセージを削除 ---------- */
							let control = target[i].previousElementSibling;
							target[i].parentNode.removeChild( target[i] );

							/* ---------- エラークラスをcontrolから削除 ---------- */
							control.classList.remove( options['errorClass'] );
						}
					}
				}



				/**************************************************************
				 * checkDone
				 * 入力済みかのチェック
				 * 対象はcontrolClassの中の「input,select,textarea」である
				**************************************************************/
				const checkDone = function(){
					const input = target.querySelectorAll('.' + options['controlClass'] + ' input,' + '.' + options['controlClass'] + ' select,' + '.' + options['controlClass'] + ' textarea');


					/* ---------- isDone ---------- */
					const isDone = function( input ){
						const control = searchControl( input );

						/* ----- get value ----- */
						let value = '';

						if( input.type === 'radio' || input.type === 'checkbox' ){
							/* radio、checkboxの時は nameから複数を取得 */
							const inputs = target.querySelectorAll( '[name="'+ input.name +'"]' );

							for ( let j = 0; j < inputs.length; j++) {
								if( inputs[j].checked == true ){
									value = inputs[j].value;
									break;
								}
							}
						} else{
							/* 通常は valueを取得 */
							value = input.value;
						}

						/* ----- 判定 ----- */
						if( value !== '' ){
							control.classList.add( options['doneClass'] );
						} else{
							control.classList.remove( options['doneClass'] );
						}
					}


					/* ---------- check ---------- */
					for ( let i = 0; i < input.length; i++ ) {
						input[i].addEventListener('change',function(){
							isDone( input[i] );
						});
					}
				}
				checkDone();




				/**************************************************************
				 * linkageRequired
				 * チェックボックスに連動して必須項目を変更
				**************************************************************/
				const linkageRequired = function(){
					if( options['linkageRequired'] == null ) return false;


					/* ---------- Object.valuesが使えないブラウザでは、下記を実行 ---------- */
					if( !Object.values ) {
						Object.values = function(obj) {
							return Object.keys(obj).map(function(key) { return obj[key]; });
						}
					}

					/* ---------- オブジェクトを配列に変換 ---------- */
					let switchArray   = Object.keys( options['linkageRequired'] );
					let requiredArray = Object.values( options['linkageRequired'] );

					/* ---------- 要素を配列に格納 ---------- */
					let switchInput   = [];
					for ( let i = 0; i < switchArray.length; i++ ) {
						if( target.querySelector( switchArray[i] ) ){
							switchInput.push( target.querySelector( switchArray[i] ) );
						}
					}


					/* ---------- 判定 ---------- */
					for ( let i = 0; i < switchInput.length; i++ ) {
						switchInput[i].addEventListener('change',function(){

							let linkage_required = '';

							/* ----- 全てのinputをチェック ----- */
							for ( let i = 0; i < switchInput.length; i++ ) {
								if( switchInput[i].checked == true ){
									/* ----- checkedだったら、必須項目に追加 ----- */
									linkage_required += ',';
									linkage_required += requiredArray[i];
								} else{
									/* ----- checkedではなかったら、エラーメッセージを削除 ----- */
									let notRequiredInput = target.querySelectorAll( requiredArray[i] );

									for ( let i = 0; i < notRequiredInput.length; i++ ) {
										let control = searchControl( notRequiredInput[i] );
										let erroeText = control.parentNode.querySelectorAll('.js-error-text');
										erroeMessage.remove( erroeText );
									}
								}
							}

							/* ----- 変化した必須項目をセット -----  */
							required = target.querySelectorAll( options['required'] + linkage_required );
							requiredCheck.change( required );

						});
					}
				}
				linkageRequired();




				/**************************************************************
				 * agreeClick
				 * プライバシーポリシーのチェックでbuttonのクラスを制御
				**************************************************************/
				const agreeClick = function(){
					let agreeCount = 0;

					for ( let i = 0; i < agree.length; i++ ) {
						if( agree[i].checked == true ){
							agreeCount++;
						}
					}

					if( agreeCount == agreeLength ){
						button.classList.remove( options['disabledClass'] );
					} else{
						button.classList.add( options['disabledClass'] );
					}
				}

				if( button && agree ){
					button.classList.add( options['disabledClass'] );

					for ( let i = 0; i < agree.length; i++ ) {
						agree[i].addEventListener('change',function(){
							agreeClick();
						});
					}

					window.addEventListener('pageshow',function(){
						agreeClick();
					});
				}




				/**************************************************************
				 * requiredCheck
				 * 必須項目の判定
				**************************************************************/
				const requiredCheck = {
					check: function( input ){
						/* ---------- 判定 ---------- */
						let value = '';

						/* ----- get value ----- */
						if( input.type === 'radio' || input.type === 'checkbox' ){
							/* radio、checkboxの時は nameから複数を取得 */
							const inputs = target.querySelectorAll( '[name="'+ input.name +'"]' );

							for ( let j = 0; j < inputs.length; j++) {
								if( inputs[j].checked == true ){
									value = inputs[j].value;
									break;
								}
							}
						} else{
							/* 通常はは valueを取得 */
							value = input.value;
						}

						/* ----- 判定 ----- */
						if( value === '' ){
							erroeMessage.add( input , options['errorTextRequired'] );
							errorFlg_required = true;
						}
					},
					change: function( target ){
						/* ---------- change event ---------- */
						const _this = this;


						for ( let i = 0; i < target.length; i++) {
							target[i].addEventListener('change',function(){
								/* メッセージを削除 */
								let control = searchControl( this );
								let erroeText = control.parentNode.querySelectorAll('.js-error-text');
								erroeMessage.remove( erroeText );

								/* errorFlg初期化 */
								errorFlg_required = false;

								/* 判定 */
								_this.check( target[i] );
							});
						}
					},
					submit: function(){
						/* ---------- エラーメッセージを表示 ---------- */
						const _this = this;
						let name = '';

						for ( let i = 0; i < required.length; i++ ) {
							/* ----- ひとつ前のnameと現在のnameが一緒だったらスキップ ----- */
							if( name === required[i].name ){
								continue;
							}

							/* 判定 */
							_this.check( required[i] );

							/* ----- nameを再セット ----- */
							name = required[i].name;
						}
					}
				}
				requiredCheck.change( required );


				/**************************************************************
				 * yubinBango
				 * YubinBango.jsと連動
				 * YubinBango.jsで郵便番号から都道府県、市区町村などが自動で入力されますが、
				 * changeイベントが発動しません。
				 * それを補うために、郵便番号を入力したら、自動入力される要素も合わせて必須項目のチェックを行います。
				**************************************************************/
				if( options['yubinBango'] === true ){
					const postalCode = document.querySelector('.p-postal-code');
					const autoInput  = document.querySelectorAll('.p-region,.p-locality,.p-street-address');

					postalCode.addEventListener('change',function(){
						for ( let i = 0; i < autoInput.length; i++ ) {
							/* メッセージを削除 */
							let control = searchControl( autoInput[i] );
							let erroeText = control.parentNode.querySelectorAll('.js-error-text');
							erroeMessage.remove( erroeText );

							/* errorFlg初期化 */
							errorFlg_required = false;

							/* 判定 */
							setTimeout(function(){
								requiredCheck.check( autoInput[i] );
							},300);
						}
					});
				}





				/**************************************************************
				 * telCheck
				 * 電話番号が数字かどうか判定（ハイフンありでも機能）
				**************************************************************/
				const telCheck = {
					check: function( input ){
						/* ---------- 判定 ---------- */
						let value = input.value;

						if( options['telCheckRegex'] == '/^[0-9]+$/' ){
							// 数字のチェックだったら、ハイフンを削除して判定
							value = value.replace(/[━.*‐.*―.*－.*\-.*ー.*\-]/gi,'');
						}

						if( value !== '' && !value.match( options['telCheckRegex'] ) ) {
							erroeMessage.add( input , options['errorTextTelCheck'] );
							errorFlg_telCheck = true;
						}
					},
					change: function( target ){
						/* ---------- change event ---------- */
						if( options['telCheck'] === true ){
							const _this = this;

							for ( let i = 0; i < target.length; i++) {
								target[i].addEventListener('change',function(){
									const value = this.value;

									/* 全角を半角にする */
									const halfValue = value.replace(/[Ａ-Ｚａ-ｚ０-９]/g, function(s) {
										return String.fromCharCode(s.charCodeAt(0) - 65248);
									});
									this.value = halfValue;

									/* メッセージを削除 */
									let control = searchControl( this );
									let erroeText = control.parentNode.querySelectorAll('.js-error-text');
									erroeMessage.remove( erroeText );

									/* errorFlg初期化 */
									errorFlg_telCheck = false;

									/* 判定 */
									_this.check( this );
								});
							}
						}
					},
					submit: function( target ){
						/* ---------- submit ---------- */
						if( options['telCheck'] === true ){
							const _this = this;

							for ( let i = 0; i < target.length; i++) {
								/* 判定 */
								_this.check( target[i] );
							}
						}
					}
				}
				telCheck.change( tel );




				/**************************************************************
				 * emailCheck
				 * メールが正しい形式か判定
				**************************************************************/
				const emailCheck = {
					check: function( input ){
						/* ---------- 判定 ---------- */
						const value = input.value;
						if( value !== '' && !value.match( options['emailCheckRegex'] ) ){
							erroeMessage.add( input , options['errorTextEmailCheck'] );
							errorFlg_emailCheck = true;
						}
					},
					change: function( target ){
						/* ---------- change event ---------- */
						if( options['emailCheck'] === true ){
							const _this = this;

							for ( let i = 0; i < target.length; i++) {
								target[i].addEventListener('change',function(){
									/* メッセージを削除 */
									let control = searchControl( this );
									let erroeText = control.parentNode.querySelectorAll('.js-error-text');
									erroeMessage.remove( erroeText );

									/* errorFlg初期化 */
									errorFlg_emailCheck = false;

									/* 判定 */
									_this.check( this );
								});
							}
						}
					},
					submit: function( target ){
						/* ---------- submit ---------- */
						if( options['emailCheck'] === true ){
							const _this = this;

							for ( let i = 0; i < target.length; i++) {
								/* 判定 */
								_this.check( target[i] );
							}
						}
					}
				}
				emailCheck.change( email );




				/**************************************************************
				 * emailConfirm
				 * メールと確認が合っているかの判定
				**************************************************************/
				const emailConfirm = {
					check: function(){
						/* ---------- 判定 ---------- */
						const email      = document.querySelector( options['emailConfirmArray'][0] );
						const emailAgain = document.querySelector( options['emailConfirmArray'][1] );

						if( email.value !== emailAgain.value ){
							erroeMessage.add( emailAgain , options['errorTextEmailConfirm'] );
							errorFlg_emailConfirm = true;
						}
					},
					change: function(){
						/* ---------- change event ---------- */
						if( options['emailConfirm'] === true ){
							const _this = this;
							const emailAgain = document.querySelector( options['emailConfirmArray'][1] );

							if( emailAgain ){
								emailAgain.addEventListener('change',function(){
									/* メッセージを削除 */
									let control = searchControl( this );
									let erroeText = control.parentNode.querySelectorAll('.js-error-text');
									erroeMessage.remove( erroeText );

									/* errorFlg初期化 */
									errorFlg_emailConfirm = false;

									/* 判定 */
									_this.check( this );
								});
							}
						}
					},
					submit: function(){
						/* ---------- submit ---------- */
						if( options['emailConfirm'] === true ){
							const _this = this;
							const emailAgain = document.querySelector( options['emailConfirmArray'][1] );
							_this.check( emailAgain );
						}
					}
				}
				emailConfirm.change();






				/**************************************************************
				 * textareaPlaceholder
				 * テキストエリアのプレスホルダーは、一部のブラウでで改行できないので、その対策
				**************************************************************/
				if( options['textareaPlaceholder'] === true ){
					const textareaPlaceholder = function(){
						const textarea = document.querySelector( options['textareaSelector'] );

						if( !textarea ) return false;

						const textareaClass = textarea.getAttribute('class');
						const placeholder   = textarea.getAttribute('placeholder');

						/* ---------- プレスホルダーのシングルクォーテーションをダブルクォーテーションに置き換え ---------- */
						const placeholderReplaced = placeholder.replace(/'/g, '"')


						/* ---------- ダミーの要素を作って、そこの高さを取得する ----------  */
						const dummyTextarea = document.createElement('p');
						dummyTextarea.setAttribute('class', textareaClass );
						dummyTextarea.classList.add( options['textareaDummyClass'] );
						dummyTextarea.innerHTML = placeholderReplaced;
						textarea.parentNode.appendChild( dummyTextarea );
						textarea.setAttribute('placeholder',' ');

						/* ----- 配置 ----- */
						textarea.parentNode.style.position = 'relative';

						/* ----- textareaKeepHeight ----- */
						if( options['textareaKeepHeight'] === true ){
							const textareaKeepHeight = function(){
								const height = dummyTextarea.clientHeight;
								textarea.style.height = height + 10 + 'px';
							}

							window.addEventListener('load', textareaKeepHeight );
							window.addEventListener('resize', textareaKeepHeight );
						}


						/* ---------- 入力されたら非表示にする ----------  */
						const checkValue = function(){
							const letterLength = textarea.value.length;

							if( letterLength === 0 ){
								dummyTextarea.classList.remove('is-hidden');
							} else{
								dummyTextarea.classList.add('is-hidden');
							}
						};

						window.addEventListener('load', checkValue );
						textarea.addEventListener('keyup', checkValue );
						textarea.addEventListener('keydown', checkValue );
						textarea.addEventListener('change', checkValue );
					}
					textareaPlaceholder();
				}






				/**************************************************************
				 * scrollAnimation
				 * スクロールアニメーション
				**************************************************************/
				function scrollAnimation( _this ){
					if( options['animation'] == true ){
						let difference = 0;

						/* ---------- difference ---------- */
						if( options['animationDifference'] !== null ){
							let regexp = new RegExp('^(\\+|\\-)?(0[1-9]{0,2}|\\d{0,3})(,\\d{3})*(\\.[0-9]+)?$', 'g');

							for ( let i = 0; i < options['animationDifference'].length; i++ ) {
								if( regexp.test( options['animationDifference'][i] ) == true ){
									// 数値だったら
									difference += options['animationDifference'][i];
								} else{
									// 要素だったら
									let difference_element = document.querySelector( options['animationDifference'][i] );
									difference += difference_element.clientHeight;
								}
							}
						}


						/* ---------- animation ---------- */
						let _window   = '';
						let _windowFrom   = '';

						if( options['scrollElement'] === 'body' ){
							_window     = window;
							_windowFrom = (function() {
								if('scrollingElement' in document) return document.scrollingElement;
								if(navigator.userAgent.indexOf('WebKit') != -1) return document.body;
								return document.documentElement;
							})();
						} else{
							_window     = document.querySelector(options['scrollElement']);
							_windowFrom = _window;
						}


						/* ---------- animation ---------- */
						let start_time  = Date.now();
						let scroll_from = _windowFrom.scrollTop;
						let position    = _this.getBoundingClientRect().top - difference;

						(function loop() {
							let currentTime = Date.now() - start_time;
							if(currentTime < options['animationSpeed']) {
								_window.scrollTo(0, options['animationEasing'](currentTime, scroll_from, position, options['animationSpeed']));
								window.requestAnimationFrame(loop);
							} else {
								_window.scrollTo(0, position + scroll_from);
							}
						})();

					} else if( options['animation'] == false ){
						_window.scrollTo( 0 , options['animationPosition'] );
					}
				}







				/**************************************************************
				 * check click
				 * 確認ボタンを押した時
				**************************************************************/
				if( check ){
					check.addEventListener('click',function(e){
						e.preventDefault();

						/* ----- エラーメッセージ削除 -----  */
						const erroeText = document.querySelectorAll('.js-error-text');
						erroeMessage.remove( erroeText );

						/* ----- エラーチェック -----  */
						requiredCheck.submit();
						telCheck.submit( tel );
						emailCheck.submit( email );
						emailConfirm.submit();


						/* ----- エラーがなければ、フォームを作動 ----- */
						if(
							errorFlg_required     === false &&
							errorFlg_emailCheck   === false &&
							errorFlg_emailConfirm === false &&
							errorFlg_telCheck     === false
						){
							if( nowStep === stepLength ){
								target.submit();
								return false;
							} else{
								nowStep++;
								target.dataset.state = nowStep;

								/* ---------- stepFunctions ---------- */
								if( typeof options['stepFunctions'][ nowStep - 1 ] === 'function' ){
									options['stepFunctions'][ nowStep - 1 ]();
								}

								required = target.querySelectorAll( options['required'][ nowStep - 1 ] );
								email    = target.querySelectorAll('[data-step="' + nowStep + '"] [type="email"]');
								tel      = target.querySelectorAll('[data-step="' + nowStep + '"] [type="tel"]');

								requiredCheck.change( required );
								telCheck.change( tel );
								emailCheck.change( email );
							}
						} else{
							scrollAnimation( target );
						}


						/* ----- 次のためにフラグを初期化 ----- */
						errorFlg_required     = false;
						errorFlg_emailCheck   = false;
						errorFlg_emailConfirm = false;
						errorFlg_telCheck     = false;

					});
				}




				/**************************************************************
				 * submit click
				 * 送信ボタンを押した時
				**************************************************************/
				if( submit ){
					submit.addEventListener('click',function(e){
						e.preventDefault();
						target.submit();
					});
				}




				/**************************************************************
				 * requiredStatus
				 * 全てのエラーチェックが終わって判定するため一番最後
				 *
				 * status配列を、必須項目の分用意する。
				 * 入力済みが1、未入力が0とし、0の個数をカウントし判定する。
				**************************************************************/
				const requiredStatus = {
					currentTarget: document.querySelector( options['requiredStatusCurrent'] ),
					totalTarget  : document.querySelector( options['requiredStatusTotal'] ),
					init         : function(){
						const _this = requiredStatus;

						/* ---------- settings ---------- */
						_this.required  = [];
						_this.status    = [];
						_this.remaining = 0;

						_this.settings();

						/* ---------- load count ---------- */
						// load時は無駄がないように、必須項目のnameの種類分回す。
						for ( let i = 0; i < _this.required.length; i++) {
							_this.count( _this.required[i][0] );
						}

						/* ---------- change count ---------- */
						// change時は、変更されたものを基準に判定する
						// for ( let i = 0; i < required.length; i++) {
						// 	required[i].addEventListener('change', function(){
						// 		_this.count( required[i] );
						// 	});
						// }

						// 自動入力や住所自動入力対応のため、change時に全ての必須項目を判定する
						for ( let i = 0; i < required.length; i++) {
							required[i].addEventListener('change', function(){
								for ( let i = 0; i < _this.required.length; i++) {
									_this.count( _this.required[i][0] );
								}
							});
						}

					},
					settings: function(){
						const _this = requiredStatus;

						// ++した後データ属性をセットするので、-1からスタート
						let length     = -1;
						let nameAarray = [];

						for ( let i = 0; i < required.length; i++ ) {
							/* ---------- total ---------- */
							/*
								checkbox,radioなどnameが同じものは、まとめて一つとカウントする。
								合わせてstatus配列を生成
							*/
							const name = required[i].getAttribute('name');

							if( nameAarray.indexOf( name ) == -1 ){
								nameAarray.push( name );
								_this.status.push( 0 );
								_this.required.push( target.querySelectorAll('[name="'+ name +'"]') );
								length++;
							}

							/* ---------- index ---------- */
							required[i].dataset.n = length;
						}

						// -1からスタートしているので、1を足す
						_this.totalTarget.innerHTML = length + 1;

					},
					count: function( target ){
						const _this = requiredStatus;

						const control = searchControl( target );
						const num     = target.dataset.n;
						const name    = target.getAttribute('name');
						const type    = target.getAttribute('type');

						const inputs = form.querySelectorAll('[name="'+ name +'"]');

						let remaining = 0;


						/* ---------- checkbox,radioの場合、checkedで判定 ---------- */
						if( type == 'checkbox' || type == 'radio' ){
							for ( let i = 0; i < inputs.length; i++ ) {
								if( inputs[i].checked == true ){
									if( !control.classList.contains( options['errorClass'] ) ){
										_this.status[num] = 1;
									} else{
										_this.status[num] = 0;
									}
									break;
								} else{
									_this.status[num] = 0;
								}
							}
						} else{
							/* ---------- それ以外はvalueで判定 ---------- */
							let value = target.value;

							if( value !== "" ){
								if( !control.classList.contains( options['errorClass'] ) ){
									_this.status[num] = 1;
								} else{
									_this.status[num] = 0;
								}
							} else{
								_this.status[num] = 0;
							}
						}

						/* ---------- count ---------- */
						for ( let i = 0; i < _this.status.length; i++ ) {
							if( _this.status[i] == 0 ){
								remaining++;
							}
						}

						/* ---------- セット ---------- */
						_this.currentTarget.innerHTML = remaining;
						_this.remaining = remaining;

						/* ---------- 必須が全て記入されたかのチェック ---------- */
						if( _this.remaining == 0 ){
							// 全てチェックされた時の処理
							button.classList.remove( options['disabledClass'] );
						} else{
							button.classList.add( options['disabledClass'] );
						}

					},
				}

				if( options['requiredStatus'] === true && document.querySelector( options['requiredStatusCurrent'] ) ){
					window.addEventListener('pageshow',function(){
						requiredStatus.init();
					});
				}




			});
		},
	};

})(this);
