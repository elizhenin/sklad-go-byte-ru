$(document).ready(function() {

    $('.tooltip').tooltipster({theme: '.tooltipster-shadow'});

    setTimeout(function(){
        $('.feedback-message').fadeOut(700)
    }, 5000);

    //выпадающая помощь в шапке сайта
    $('.webform-title span').on({
        'mouseenter': function () {
            $('.preorder-help-inner').show();
            $('.header-webform-body').show();
        }
    });

    $("input[name$='deliv_id']").change(function() {
        var test = $(this).val();
        if(test == 2){
            $("#map").stop(true,true).slideUp();
            $('.op4').fadeIn();
        }else{
            $("#map").stop(true,true).slideDown();
            $('.op4').fadeOut();
        }

    });

    $('.header-webform-body').on({
        'mouseleave': function () {
            $('.preorder-help-inner').hide();
            $('.header-webform-body').hide();
        }
    });

    //выпадающая корзина
    $('.basket-small-dropdown, .your-cart').on('mouseenter', function () {
        $('.sale-basket-small').addClass('opened');
    });

    $('.basket').on('mouseleave', function () {
        $('.sale-basket-small').removeClass('opened');
    });

    //выпадающий список городов
    $('.active-city > a').on('click', function (e) {
        e.preventDefault();
        $('.sub-cities').toggle();
    });

    //выпадающее меню
    $('.help-menu-links li.dropdown').hover(function () {
        $(this).addClass('jshover');
    }, function () {
        $(this).removeClass('jshover');
    });

    //автооткрытие ссылки на landing

    $('img.plax').plaxify();
    $.plax.enable({"activityTarget": $('.slide-4')});
    $('.da-slider').cslider({autoplay: false});


    //фиксируем меню при прокрутке
    $(window).scroll(function () {
        var menu = $('#header-menu-wrapper');

        if (!menu.attr('top')) {
            menu.attr('top', menu.offset().top);
        }

        if ($(this).scrollTop() >= menu.offset().top && menu.css('position') != 'fixed') {
            $(menu).css({position: 'fixed', top: 0});
        }
        else if ($(this).scrollTop() <= menu.attr('top')) {
            $(menu).css({position: 'relative', top: 0});
        }
    });

    //переключение вкладок с характеристиками



    $('.personal a').click(function (e) {

        var href = $(this).attr('href');

        $('.personal-content').empty().load(href + ' #workarea');

        e.preventDefault();
    });


    //Всплывающее окно для похожих товаров


    //Прокрутка похожих товаров
    $('.related-carousel').jcarousel({
        scroll: 1,
        buttonPrevHTML: '<span class="related-prev"></span>',
        buttonNextHTML: '<span class="related-next"></span>'
    });

    //Раскрытие элементов на странице каталога
    $('.preorder-item.small').on('click', function (e) {
        $('.preorder-item.big').hide();

        if ($(this).hasClass('preorder-disabled')) {
            return;
        }

        //определение позиции окна
        var that = $(this),
            parent = that.parent().parent(),
            left = that.position().left,
            top = that.position().top;

        if (left + that.width() >= parent.width() - left) {
            left -= that.width() + 12;
        }

        if (top + that.height() >= parent.height() - top) {
            top -= that.height() + 12;
        }

        $(this).next().css({'left': left, 'top': top}).show();
    });

    $('.preorder-item.small a').on('click', function (e) {
        e.preventDefault();
    });

    $('.preorder-close').on('click', function () {
        $(this).parent().hide();
    });

    $(document).on('click', '.preorder-item-button a, .preorder-item-button-element a', function (e) {
        e.stopPropagation();
        e.preventDefault();

        document.glButtonPreorder = this;

        if ($(this).hasClass('inactive')) {
            return;
        }

        var prform = $('.preorder-form-wrap');

        $('input[name=ID]', prform).val($(this).attr('data-id'));

        $('.preorder-form').show();
        $('.success-message, .invalid').hide();

        prform.show();
    });


    //Форма предзаказа товаров
    $('.preorder-form').on('submit', function (e) {

        e.preventDefault();

        var url = $(this).attr('action'),
            valid = true;

        $('input[type=text]', this).each(function () {
            if (!$(this).val()) {
                $('.invalid').show();
                valid = false;
            }
        });

        if (valid) {
            $.ajax({
                type: "POST",
                url: url,
                data: $(this).serialize(),
                success: function (response) {

                    $('.preorder-form, .invalid').hide();
                    $('.success-message').show();

                    //сделаем кнопки Забронировать неактивными
                    $(document.glButtonPreorder).addClass('inactive');
                    parent = $(document.glButtonPreorder).parents('.preorder-item');
                    if (parent.hasClass('small')) {
                        $('.preorder-item-button a', parent.next()).addClass('inactive');
                    } else {
                        $('.preorder-item-button a', parent.prev()).addClass('inactive');
                    }
                }
            });
        }

    });


    ymaps.ready(init);

    function init(){
        var myMap = new ymaps.Map ("map", {
            center: [51.66772617, 39.17602591],
            zoom: 16
        });
        myMap.controls.add(
            new ymaps.control.ZoomControl()
        );
        var myPlacemark = new ymaps.Placemark([51.66791298, 39.17285018], {
            hintContent: 'Дисконт центр "Byte"',
            balloonContent: 'Дисконт центр "BYTE"<br><span>9 января 68з, 3 этаж</span>'
        } , {
            iconImageHref: 'http://gobyte.studio-pulse.ru/images/logo.png',
            iconImageSize: [130, 39],
            iconImageOffset: [-10, -50]

        });

        myMap.geoObjects.add(myPlacemark);
    }


    //Панели предзаказа товара в шапке страницы
    $('.promo-item:not(.promo-9) a:not(.social)').on('click', function (e) {
        if (Modernizr.csstransitions) {
            e.preventDefault();
        }
    });

    //Вращение плиток в шапке сайта
    window.canClick = true;
    window.plates = $('.promo-item:not(.promo-9)');
    window.plates.on('click', function (e) {
        if (window.canClick) {
            rotatePanel(this);
        }
        window.canClick = false;
        setTimeout(function () {
            window.canClick = true
        }, 750);
    })
        .on('hover', function (e) {
            $(this).toggleClass('hovered');
        });

    setInterval(rotatePanelsTimer, 2000);


    //Конпка переключения между видами списков для предзаказа
    $('.switch-control').on('click', function (e) {
        var that = $(this),
            parent = that.parent();

        if (that.hasClass('mode-plate')) {
            $('.preorder-table').hide();
            $('.preorder-item.small').show();
            parent.addClass('plate');
            parent.removeClass('table');
        } else {
            $('.preorder-table').show();
            $('.preorder-item').hide();
            parent.addClass('table');
            parent.removeClass('plate');
        }
    });


    function rotatePanelsTimer() {
        var index = Math.floor(Math.random() * window.plates.length),
            plate = window.plates[index];

        if (!$(plate).hasClass('hovered')) {
            rotatePanel(plate);
        }
        //$(window.plates[index]).trigger('click');
    }

    function rotatePanel(panel) {
        var insetTransform = $('.inset', panel).css('transform'),
            outsetTransform = $('.outset', panel).css('transform');

        $('.inset', panel).css({transform: outsetTransform});
        $('.outset', panel).css({transform: insetTransform});
    }


});

//begin_basket
function basket_preview()
{
    jQuery.ajax({
        url: '/basket/preview',
        type: 'POST',
        success: function (data) {
            if (data != '') {
                fields = JSON.parse(data);
                $('.total-count').text(fields.count);
                $('.total-sum').text(fields.total);
                $('.basket-small-table').html('<tbody>'+fields.items+'</tbody>');
            }
        }
    });
}
function basket_edit()
{
    jQuery.ajax({
        url: '/basket/edit',
        type: 'POST',
        success: function (data) {
            if (data != '') {
                fields = JSON.parse(data);
                $('#basket-count').text(fields.count);
                $('#basket-sum').text(fields.total);
                $('#basket-table-tbody').html(fields.items);
            }
        }
    });
}

function basket_add(product) {
    jQuery.ajax({
        url: '/basket/add',
        type: 'POST',
        data: {id: product}
    });
}


function basket_del(product) {
    jQuery.ajax({
        url: '/basket/del',
        type: 'POST',
        data: {id: product},
        success: function () {
           $('#basket-tr'+product).remove();
        }
    });
}

setInterval (function(){basket_preview();}, 2000);
//end_basket

function request_product(product)
{
    $('#request'+product).show();
    $('.clse').click(function(){
        $('#request'+product).hide();
    });
}


$(function() {
    $('.fancyb').fancybox();
    $( "#prod-tabs" ).tabs();
});

$(document).ready(function (){
    var a = function(self){
        self.anchor.addClass('fancyb');
    };
    $("#prod-gal").PikaChoose({buildFinished:a});
    $('a.fancy-loop').click(function(e){

        $('.pika-stage a').trigger('click');
        e.preventDefault();
    });
});
