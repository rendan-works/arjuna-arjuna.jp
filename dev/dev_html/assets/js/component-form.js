/**
 *
 * component-form.js
 *
 *
 */
(function($) {



	/**************************************************************
	 * contactForm
	**************************************************************/
	const easingFuncs = new getEasing({
		easing: 'easeInOutExpo',
	});

	new contactForm('.p-form',{
		scrollElement: 'body',
		controlClass: 'p-form__control',
		button      : '.p-form__button',
		submit      : '.p-form__submit a',
		check       : '.p-form__check a',

		required: [
			'[name="f_name"],[name="f_tel"],[name="f_mail"],[name="f_mail-check"],[name="f_address"],[name="f_message"]',
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
		yubinBango         : false,
		textareaPlaceholder: false,

		animation          : true,
		animationSpeed     : 500,
		animationDifference: [100],
		animationPosition  : 0,
		animationHierarchy : 1,
		animationEasing    : easingFuncs,

		errorTextClass       : ['p-form__error'],
		errorTextEmailCheck  : '※正しい形式で入力してください。',
		errorTextEmailConfirm: '※確認用のメールアドレスが一致していません。',
		errorTextTelCheck    : '※正しい形式で入力してください。',
		errorTextRequired    : '※必須項目を入力してください。',

		errorClass   : 'is-error',
		disabledClass: 'is-disabled',
		doneClass    : 'is-done',
	});









})();
