/**
 *
 * wp-admin.js
 *
 *
 */

(function($) {


	/**************************************************************
	 * load
	**************************************************************/
	window.addEventListener('load' , function(){
		document.body.classList.add('is-load');
	});






	/**************************************************************
	 * DOMContentLoaded
	**************************************************************/
	window.addEventListener('DOMContentLoaded',function(){

		/**
		 *
		 *
		 * ユーザー識別
		 *
		 *
		 */
		const isUser = function(){
			const target = document.querySelector('.username') || document.querySelector('.display-name');
			const name   = target.innerHTML;
			document.body.classList.add('user-' + name);
		}
		isUser();





		/**
		 *
		 *
		 * カテゴリーのラジオボタン変更
		 *
		 *
		 */
		const termChangeRadioButton = function(){
			const category_checklist = document.querySelectorAll('#categorychecklist [type="checkbox"],#works_clientchecklist [type="checkbox"],#works_industrychecklist [type="checkbox"]');
			const editinline         = document.querySelectorAll('.editinline');

			/*
			 * 詳細画面のチェックボタンをラジオボタンに
			 */
			function radio( _this ){
				for ( let i = 0; i < _this.length; i++ ) {
					_this[i].setAttribute('type','radio');
				}
			}
			radio( category_checklist );

			/*
			 * クイック編集は、クリックされてからエディタ画面が生成されるので、
			 * 生成後 チェックボタンをラジオボタンにする
			 */
			for (var i = 0; i < editinline.length; i++) {
				editinline[i].addEventListener('click',function(e){
					e.preventDefault();
					let _this = this;
					setTimeout(function(){
						let post    = _this.parentNode.parentNode.parentNode.parentNode;
						let id      = post.getAttribute('id');
						let edit_id = id.replace( 'post' , 'edit' );
						let edit    = document.getElementById( edit_id );
						let checkbox = edit.querySelectorAll('.category-checklist [type="checkbox"],.works_client-checklist [type="checkbox"],.works_industry-checklist [type="checkbox"]');

						if( checkbox.length ){
							radio( checkbox );
						}
					});
				});
			}
		}
		termChangeRadioButton();






		/**
		 *
		 *
		 * スマートカスタムフィールドの説明で改行
		 * 全角スペースで改行を入れます。
		 *
		 *
		 */
		const SCFDescriptionBr = function(){
			const description = document.querySelectorAll('.description');

			for ( let i = 0; i < description.length; i++ ) {
				const target = description[i];

				let text = target.textContent;
				text     = text.replace(/\r?\n/g, '').replace(/\r?\t/g, '');
				target.innerHTML = '';

				text.split('').forEach(function (c) {
					if( c === '　' ){
						target.insertAdjacentHTML( 'beforeend' , '<br>' );
					} else{
						target.insertAdjacentHTML( 'beforeend' , c );
					}
				});
			}
		}
		SCFDescriptionBr();





		/**
		 *
		 *
		 * エンターで公開・更新されるのを防ぐ
		 *
		 *
		 */
		/*
		 * inputでエンターキーを押した際、公開をクリックした時と同じになってしまうので、
		 * 必須項目チェックが見落とされてしまう。
		 * 以下は、タイトルとsmart-custom-fieldsが入ったinputを対象とし、enterキーを無効にしています。
		 * ※textareaは改行があるため、制御の必要なし。
		 */
		const notEnterPublic = function(){
			const title_input = document.querySelectorAll('[name="post_title"]');
			const scf_input   = document.querySelectorAll('input[name^="smart-custom-fields"');

			function preventEnter(target){
				for ( let i = 0; i < target.length; i++ ) {
					target[i].addEventListener('keypress',function(e){
						if( e.keyCode === 13 ){
							e.preventDefault();
						}
					});
				}
			}

			preventEnter( title_input );
			preventEnter( scf_input );
		}
		notEnterPublic();






	});

})();
