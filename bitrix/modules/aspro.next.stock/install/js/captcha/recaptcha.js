(function (win, doc, tag, func, obj){
	win.onLoadRenderRecaptcha = function(){
		for(var reCaptchaId in win[func].args)
		{
			if (win[func].args.hasOwnProperty(reCaptchaId))
				realRenderRecaptchaById(win[func].args[reCaptchaId][0]);
		}
		win[func] = function(id){
			realRenderRecaptchaById(id);
		}
	};

	function realRenderRecaptchaById(id){
		var gCaptcha = doc.getElementById(id);
		if(!gCaptcha)
			return;
		
		if(gCaptcha.className.indexOf('g-recaptcha') < 0)
			return;
		
		if(!win.grecaptcha)
			return;
		
		if(!!gCaptcha.children.length)
			return;
		
		var tmp_id = grecaptcha.render(
			id,{
				'sitekey': win[obj].key + '',
				'theme': win[obj].params.recaptchaColor + '',
				'size': win[obj].params.recaptchaSize + '',
				'callback': 'onCaptchaVerify'+win[obj].params.recaptchaSize,
				'badge': win[obj].params.recaptchaBadge
			}
		);
		$(gCaptcha).attr('data-widgetid', tmp_id);
	}

	win[func] = win[func] || function (){
		win[func].args = win[func].args || [];
		win[func].args.push(arguments);
		(function(d, s, id){
			var js;
			if(d.getElementById(id))
				return;
			js = d.createElement(s);
			js.id = id;
			js.src = '//www.google.com/recaptcha/api.js?hl=' + win[obj].params.recaptchaLang + '&onload=onLoadRenderRecaptcha&render=explicit';
			d.head.appendChild(js);
		}(doc, tag, 'recaptchaApiLoader'));
	};
})(window, document, 'script', 'renderRecaptchaById', 'asproRecaptcha');