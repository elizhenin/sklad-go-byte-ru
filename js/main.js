$(document).ready(function(){

	$('.tooltip').tooltipster({ theme: '.tooltipster-shadow'});

	//выпадающая помощь в шапке сайта
	$('#headshot').on({
		'mouseenter': function(){
			$('.preorder-help-inner').show();
			$('.header-webform-body').show();
		},
		'mouseleave': function(){
		    $('.preorder-help-inner').hide();
			$('.header-webform-body').hide();
		}
	});
	
	//выпадающая корзина
	$('.basket-small-dropdown, .your-cart').on('mouseenter', function(){
		$('.sale-basket-small').addClass('opened');
	});
	
	$('.basket').on('mouseleave', function(){
		$('.sale-basket-small').removeClass('opened');		
	});
	
	//выпадающий список городов
	$('.active-city > a').on('click', function(e){
		e.preventDefault();
		$('.sub-cities').toggle();
	});
	
	//выпадающее меню
	$('.help-menu-links li.dropdown').hover(function(){
		$(this).addClass('jshover');
	}, function(){
		$(this).removeClass('jshover');		
	});
	
	//автооткрытие ссылки на landing
    if ($('.autoshow').length > 0) {
		setTimeout(landingShow, 2000);
	}
	
	$('.halflogo').hover(landingShow);
	
	//Картинки товара на странице детального описания товара
	var a = function(self){
		
	    self.anchor.addClass('fancybox').attr('rel', 'group').click(function(e){
			$('.jcarousel-container li .fancybox').attr('rel','group');
			$('.jcarousel-container li.active .fancybox').attr('rel','');
		
		}).fancybox({titleShow:false});
			      
	    $('.jcarousel-container li .clip').each(function(index){
			var img = $('img', this),
				href = $(img).attr('src')
				link = $('<a class="fancybox" rel="group" href="' + href + '"></a>');
	    	$(this).append(link);					
	      });	     
	   };
	
	$('#pikachoose').PikaChoose({		
		buildFinished:a,
		autoPlay:false, 
		carousel:true,
		thumbOpacity:0.7,
		text: {previous: "", next: "" }
	});
	
	$(".fancybox").fancybox();
	
	$('a.fancy-loop').click(function(e){
			
		$('.pika-stage a').trigger('click');
		e.preventDefault();
	});

	$('img.plax').plaxify();
	$.plax.enable({ "activityTarget": $('.slide-4')});
	$('.da-slider').cslider({autoplay:false});
	
	
	//ajax отправка товара в корзину
	//со страницы товара и страницы каталога
	$('.form-add-to-cart').submit(function(e){
		var id = $('[name=id]', this).val();
		var quantity = $('[name=quantity]', this).val(); 
		
		basketRequest(id, quantity, 'add');
		
		return false;
	});
	
	//с главной страницы
	$(document).on('click', '.button-buy', function(e){
		var id = $(this).attr('id');
		
		basketRequest(id, 1, 'add');

		e.preventDefault();
	});
	
	//удаление товара из корзины
	$(document).on('click', '.basket-small-remove', function(){
		var id = $(this).attr('id');
		basketRequest(id, 1, 'delete');
	});
	
	//фиксируем меню при прокрутке
	$(window).scroll(function(){
		var menu = $('#header-menu-wrapper');
		
		if(!menu.attr('top')){
			menu.attr('top', menu.offset().top);
		}		
		
		if($(this).scrollTop() >= menu.offset().top && menu.css('position') != 'fixed'){
			$(menu).css({position:'fixed', top: 0});
		}
		else if($(this).scrollTop() <= menu.attr('top')) {
			$(menu).css({position:'relative', top: 0});
		}
	});
	
	//переключение вкладок с характеристиками
	$(document).on('click', '.tabs-control li', function(e){
		var tabParent = $(this).parents('.tabs-control');
		$('.active', tabParent).removeClass('active');
		$(this).addClass('active');
		$('div:not(.hide)', tabParent.next('.tabs')).toggleClass('hide');
		$('[tab=' + $(this).attr('tab') + ']', tabParent.next('.tabs')).toggleClass('hide');
				
		e.preventDefault();
	});
	
	$('#order-form-wrapper .order-form-city').styler({zIndex: '9'});
	//$('.order-form-person-type+.jqselect .dropdown').click(function(){
	//	submitForm();
	//});
	
	$('.personal a').click(function(e){
		
		var href = $(this).attr('href');
		
		$('.personal-content').empty().load(href + ' #workarea');
		
		e.preventDefault();
	});
		
	$('.basket_form .cart-item-quantity input').keyup(function(){
		
		var totalSum = 0;
		
		$('.basket_form tbody tr').each(function(){
			var price = $('.cart-item-price', this).attr('price');
			var sum = $('.cart-item-quantity input', this).val();
			
			totalSum += parseFloat(price) * parseFloat(sum);
		})
		

		$('.basket_form .cart-item-price p').text(totalSum.formatMoney(2, '', ' ', ','));
		
	});
	
	
	//Всплывающее окно для похожих товаров
	$('.related-element').on('click', function(e){
		
		e.preventDefault();
		
		var accessories = false;
		
		if($(this).hasClass('accessories')){
			accessories = true;			
		}
		
		var url = 'http://' + document.location.hostname + '/catalog/element_ajax.php';			
		
		var top = $(window).height() / 2 - 290 + $(window).scrollTop() - $('.catalog-element').offset().top,
			left = $(window).width() / 2 - 365  - $('.catalog-element').offset().left;
		
		$('.related-frame-wrap').show();
		$('.related-frame-wrap').css({'top': top + 'px', left: left + 'px'});
		
		$.ajax({
			type: 'POST',
			url: url,
			data: {'elementID': $(this).attr('data-el-id'), 'accessories': accessories},
			success: function(data){
				$('.related-frame-wrap').html(data);
			}			
		})
	});
	
	$('.related-frame-wrap').draggable({handle: '.draggable-area'});
	
	//Кнопка закрыть
	$(document).on('click', '.related-frame-close, .related-frame-close-area', function(e){
		$('.related-frame-wrap').empty().hide();
		e.preventDefault();
	});
		
	//Прокрутка похожих товаров
	$('.related-carousel').jcarousel({
		buttonPrevHTML: '<span class="related-prev"></span>',
		buttonNextHTML: '<span class="related-next"></span>'
	});
	
	
	

	//**************************************************
	//Предзаказ товаров
	//**************************************************
	
	//Таймеры
	$('.digits').each(function(){
		
		strDate = $(this).attr('data-date');
		if(strDate){
			strDate = strDate.replace(/(\d+).(\d+).(\d+)/, '$2/$1/$3');
		}else{
			strDate = '00 00 00 00:00'
		}
		
		$(this).countdown({
			until: new Date(strDate), 
			layout: '<td class="days">{dnn}</td><td class="hours">{hnn}</td><td class="mins">{mnn}</td><td class="secs">{snn}</td>'
		});
	});
			

	//Раскрытие элементов на странице каталога
	$('.preorder-item.small').on('click', function(e){
		$('.preorder-item.big').hide();
		
		if($(this).hasClass('preorder-disabled')){
			return;
		}
		
		//определение позиции окна
		var that = $(this),
			parent = that.parent().parent(),
			left = that.position().left,
			top = that.position().top;
		
		if (left + that.width() >= parent.width() - left){
			left -= that.width() + 12;
		}
		
		if (top + that.height() >= parent.height() - top){
			top -= that.height() + 12;
		}
		
		$(this).next().css({'left': left, 'top': top}).show();
	});
	
	$('.preorder-item.small a').on('click', function(e){
		e.preventDefault();
	});
	
	$('.preorder-close').on('click', function(){
		$(this).parent().hide();
	});
	
	$(document).on('click', '.preorder-item-button a, .preorder-item-button-element a', function(e){
		e.stopPropagation();
		e.preventDefault();
		
		document.glButtonPreorder = this;
		
		if($(this).hasClass('inactive')){
			return;
		}
		
		var prform = $('.preorder-form-wrap');
				
		$('input[name=ID]', prform).val($(this).attr('data-id'));
		
		$('.preorder-form').show();
		$('.success-message, .invalid').hide();
		
		prform.show();
	});
	
	
	//Форма предзаказа товаров
	$('.preorder-form').on('submit', function(e){
		
		e.preventDefault();
		
		var url = $(this).attr('action'),
			valid = true;
		
		$('input[type=text]', this).each(function(){
			if(!$(this).val()){
				$('.invalid').show();
				valid = false;
			}
		});
		
		if(valid){
			$.ajax({
				type: "POST",
				url: url,
				data: $(this).serialize(),
				success: function(response){
					
					$('.preorder-form, .invalid').hide();
					$('.success-message').show();
					
					//сделаем кнопки Забронировать неактивными
					$(document.glButtonPreorder).addClass('inactive');
					parent = $(document.glButtonPreorder).parents('.preorder-item');
					if (parent.hasClass('small')){
						$('.preorder-item-button a', parent.next()).addClass('inactive');
					}else{
						$('.preorder-item-button a', parent.prev()).addClass('inactive');
					}
				}
			});
		}
		
	});
	
	
	//Панели предзаказа товара в шапке страницы
	$('.promo-item:not(.promo-9) a:not(.social)').on('click', function(e){
		if(Modernizr.csstransitions){
			e.preventDefault();			
		}
	});
	
	$(document).on('click', '.b-share__link', function(e){
		e.stopPropagation();
	});
	
	//Вращение плиток в шапке сайта
	window.canClick = true;
	window.plates = $('.promo-item:not(.promo-9)');
	window.plates.on('click', function(e){		
		if(window.canClick){
			rotatePanel(this);
		};
		
		window.canClick = false;
		setTimeout(function(){
			window.canClick = true
		}, 750);
	})
	.on('hover', function(e){
		$(this).toggleClass('hovered');
	});
	
	setInterval(rotatePanelsTimer, 2000);
	
	
	//Конпка переключения между видами списков для предзаказа
	$('.switch-control').on('click', function(e){
		var that = $(this),
			parent = that.parent();
		
		if(that.hasClass('mode-plate')){
			$('.preorder-table').hide();
			$('.preorder-item.small').show();
			parent.addClass('plate');
			parent.removeClass('table');
		}else{
			$('.preorder-table').show();
			$('.preorder-item').hide();
			parent.addClass('table');
			parent.removeClass('plate');
		}
	});
	
	
	//анимированный кролик в подвале
	if (!Modernizr.csstransitions) {
		$('.copyright').on({
			mouseenter: function(){
				$(this).css({bottom: '-85px'}).animate({bottom: '10px'}, 700);			
			},
			mouseleave: function(){
				$(this).animate({bottom: '-85px'}, 700);
			}
		});
	}

	//Яндекс Метрики и google аналитика
	//Кнопка купить
	try{
		if (cityCode == 'vrn') {
			window.yaCounter20929894 = new Ya.Metrika({
				id:20929894,
				webvisor:true,
				clickmap:true,
				trackLinks:true,
				accurateTrackBounce:true,
				trackHash:true,params:window.yaParams||{ }
			});
			window.yaCounter22916440 = new Ya.Metrika({
				id:22916440,
				webvisor:true,
				clickmap:true,
				trackLinks:true,
				accurateTrackBounce:true,
				trackHash:true
			});
		}
	}catch(e) {console.log(e);}


	$(document).on('click', '.button-buy', function(){
		try {
			yaCounter20929894.reachGoal('put_the_basket');
			yaCounter22916440.reachGoal('put_the_basket');
			_gaq.push(['_trackPageview', 'on_buy_product']);
		}
		catch(e) {console.log(e);}
	});

	$('#comp_a394cfcb78984d6490fbbca76adfa9fa').on('click', '.web_form_submit', function(){
		try {
			yaCounter22916440.reachGoal('send_order');
		}
		catch(e) {console.log(e);}
	});

	$('.form-add-to-cart').on('submit', function(){
		try {
			yaCounter20929894.reachGoal('put_the_basket');
			yaCounter22916440.reachGoal('put_the_basket');
			_gaq.push(['_trackPageview', 'on_buy_product']);
		}
		catch(e) {console.log(e);}
	});
	
	//Переход в корзину
	$('.your-cart').on('click', function(){
		try {
			yaCounter20929894.reachGoal('go_to_basket');
			_gaq.push(['_trackPageview', 'on_buy_go_to_basket']);
		}
		catch(e) {console.log(e);}				
	});
		
	//Переход к оформлению заказа
	$('#basketOrderButton2').on('click', function(){
		try {
			yaCounter20929894.reachGoal('checkout');
			_gaq.push(['_trackPageview', 'on_buy_checkout']);
		}
		catch(e) {console.log(e);}		
	});	
	
	$('.make-order-yes').on('click', function(){
		try {
			yaCounter20929894.reachGoal('go_to_basket');
			_gaq.push(['_trackPageview', 'on_buy_go_to_basket']);
			
			yaCounter20929894.reachGoal('checkout');
			_gaq.push(['_trackPageview', 'on_buy_checkout']);
		}
		catch(e) {console.log(e);}		
	});	
	
	//Окончательное оформление заказа
	//yaParams заполняется в шаблоне sale.personal.order.list/confirm		
	if (!jQuery.isEmptyObject(yaParams)){
		try {			
			yaCounter20929894.reachGoal('checkout_end');	
			_gaq.push(['_trackPageview', 'on_buy_checkout_end']);
		}
		catch(e){
			console.log(e);
		}
	}	
		
	if($('#map').length != 0){
		loadMap();
	}		     
	
	
	iphone.init();
	
});

var landingShow = function() {
    var landing = $('.tolanding');
	
	if (landing.hasClass('active')) {
		return;
	}
	
	landing.addClass('active').animate({right: 0}, 500, function(){
		setTimeout(function(){
			landing.removeClass('active').animate({right: '-100%'}, 500);	
		}, 6000);		
	});		
}

function rotatePanelsTimer(){
	var index = Math.floor(Math.random() * window.plates.length),
		plate = window.plates[index];
	
	if (!$(plate).hasClass('hovered')){
		rotatePanel(plate);
	}
	//$(window.plates[index]).trigger('click');
}

function rotatePanel(panel){
	var insetTransform = $('.inset', panel).css('transform'),
	outsetTransform = $('.outset', panel).css('transform');

	$('.inset', panel).css({transform: outsetTransform});
	$('.outset', panel).css({transform: insetTransform});
};

function submitForm(val){
	if(val != 'Y') 
		document.getElementById('confirmorder').value = 'N';
	else{		
		$('#order-form').submit();		
		return true;
	}
				
	var form = $('#order-form'),
		data = $(form).serializeArray(),
		url = '/personal/order/make/index.php';
		
	for (var item in data)
	{
	  if (data[item].name == 'PERSON_TYPE') {
		data[item].value = $('.order-form-person-type option:selected').val();
	  }
	}
	
	$.ajax({
		type: 'POST',
		url: url,
		data: data,
		success: function(data)
		{
			$('#order-form-wrapper').empty().append($(data).find('#order-form'));
			
			$('#order-form-wrapper .order-form-city').styler({zIndex: '9'});
			//$('.order-form-person-type+.jqselect .dropdown').click(function(){
			//	submitForm();
			//});
		
			if($(data).find('#map').length > 0){
				loadMap();
			};
			
			
		}
	});
	
	return false;
}

function loadMap(){
	
	ymaps.ready(function(){
		
		if (cityCode == 'lipetsk') {
			coord = [52.606845,39.573774];
			baloonStr = "<strong>Магазин компьютерной техники \"Byte\"</strong><div>ул. 8-ое марта 36"; 
		}else{
			coord = [51.667977,39.172731];
			baloonStr = "<strong>Магазин компьютерной техники \"Byte\"</strong><div>ул. 9 Января 68 \"З\""; 
		}
		
		myMap = new ymaps.Map("map", {
			center: coord,
			zoom: 16
		});

	myMap.setType('yandex#map');
	myMap.controls.add('mapTools');
  
	myMap.controls.add( new ymaps.control.ZoomControl() );
	
	myPlacemark = new ymaps.Placemark(coord, { 
		balloonContent: baloonStr 
	},
	{
		iconImageHref: '/bitrix/templates/ironbuy/images/marker.png',
		iconImageSize: [139, 42],
		iconImageOffset: [-10, -42]
	});	

	myMap.geoObjects.add(myPlacemark);
	    
//		функция для перерисовки карты
//	    myMap.container.fitToViewport();

	});
}

function basketRequest(id, quantity, action){
	var url = 'http://' + document.location.hostname + '/personal/cart/ajaxAddToCart.php';
	
	$.ajax({
		type: 'POST',
		url: url,
		data: {'elementID':id, 'quantity': quantity, 'action': action},
		success: function(data){
			var response = JSON.parse(data);
			
			//обновляем информацию о количестве и общей сумме
			$('.basket .total-count').text(declOfNum(response.count, ['товар', 'товара', 'товаров']));
			$('.basket .total-sum').text(response.totalSum);
			
			//обновляем таблицу с товарами
			$('.basket-small-table tbody').html(response.table);
			
			//меняем иконку корзины
			if(parseInt(response.count) == 0){
				$('.basket-icon').css({background: 'url("/bitrix/templates/ironbuy/images/index/shopping_cart.png") no-repeat center center'});
			}else{
				$('.basket-icon').css({background: 'url("/bitrix/templates/ironbuy/images/index/shopping_cart2.png") no-repeat center center'});
			}
			
			//всплывающее окно
			if(action == 'add'){
				$('.add-to-cart-message').stop().fadeIn(500).removeClass('hide');			
				setTimeout(function(){$('.add-to-cart-message').fadeOut(500)}, 10000);
				$('.add-to-cart-no').click(function(e){
					$('.add-to-cart-message').fadeOut(500);
					e.preventDefault();
				})
			};
		}		
	});
}

function declOfNum(number, titles)
{
    var cases = [2, 0, 1, 1, 1, 2];
    return number + " " + titles[ (number%100>4 && number%100<20)? 2 : cases[Math.min(number%10, 5)] ];
}

Number.prototype.formatMoney = function(places, symbol, thousand, decimal) {
	places = !isNaN(places = Math.abs(places)) ? places : 2;
	symbol = symbol !== undefined ? symbol : "$";
	thousand = thousand || ",";
	decimal = decimal || ".";
	var number = this, 
	    negative = number < 0 ? "-" : "",
	    i = parseInt(number = Math.abs(+number || 0).toFixed(places), 10) + "",
	    j = (j = i.length) > 3 ? j % 3 : 0;
	return symbol + negative + (j ? i.substr(0, j) + thousand : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousand) + (places ? decimal + Math.abs(number - i).toFixed(places).slice(2) : "");
};


//эффект переливающегося отблиска на тексте
iphone = {

	letter_animate_time 	: 50,
	
	/* init iPhone functions */
	init : function(){

		iphone.prepareTextAnimate();		
		iphone.startTextAnimate();

	},
	
	startTextAnimate : function(){
		iphone.animateLetters();
	},
		
	prepareTextAnimate : function () {
		var start_text = $('.promo-9 .gotopreorder');
		var end_text = '';
		
		if(start_text.length > 0){
			start_text = start_text.html();
			for(var i = 0; i< start_text.length; i++){
				end_text += '<span style="opacity:1">' + start_text.charAt(i) + '</span>';
			}
			$('.promo-9 .gotopreorder').html(end_text);
				
			var spans = $('.promo-9 .gotopreorder').children('span');
			for (var i = 0; i < spans.length; i++){
				$(spans[ i ]).attr('id', 'spans_'+i);
			}
		}
	},
		
	animateLetters : function() {
		setTimeout(function(){
			iphone.animateCicle();
		}, iphone.pannels_animate_time);
		
		letters_interval = setInterval(function(){
			iphone.animateCicle();
		},2500);
	},

	animateCicle : function(){
		for (var i = 0; i < 25; ++i) {
			(function(i) {
				setTimeout(function(){
					$('#spans_'+i).stop().animate({'opacity':'0.3'}, iphone.letter_animate_time, function(){
						setTimeout(function(){ $('#spans_' + i).stop().animate({'opacity':'1'}, iphone.letter_animate_time) }, iphone.letter_animate_time*4);
					});
				}, (i * iphone.letter_animate_time*1.2));
			})(i);
		}
	}
}