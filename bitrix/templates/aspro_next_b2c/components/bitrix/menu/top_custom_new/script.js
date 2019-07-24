$(document).ready(function(){
    $(document).on('click','.sectionContainer .close',function() {
        $('.sectionContainer').removeClass('active');
    });

    /*$(document).on('mouseenter','lev-2-link',function () {
        /!*var wrap = $(this).parents('.level-2-wrap');*!/
        console.log('s');
    });*/




    $('.lev-2-link').mouseenter(function () {
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
        $(this).siblings().find('.level-3-wrap').removeClass('active');
        $(this).find('.level-3-wrap').addClass('active');

    });


    $('.level-3-wrap li').mouseenter(function () {
        $(this).siblings().removeClass('active');
        $(this).addClass('active');

    });


    $(document).on('mouseenter','.js-info-section-1',function(){
        var id = $(this).data('id');
        var data = "id="+id;
        var wrap = $(this).parent();
        BX.showWait();
        var postData = {
            id: id,
            sessid: BX.bitrix_sessid()
        };

        BX.ajax({
            timeout: 30,
            method: 'POST',
            dataType: 'html',
            url: '/local/tools/getSectionInfo.php',
            data: postData,
            onsuccess: function (result)
            {
                BX.closeWait();
                /*console.log(result);*/
                wrap.find('.sectionContainer').addClass('active');
                wrap.find('.sectionContainer .wrap').html(result);
                //x5 20190627 инициализируем слайдер для баннеров
                window.X5Slider();
            },
            onfailure : function()
            {
                BX.closeWait();

                wrap.find('.sectionContainer .wrap').html('Ошибка');
            }
        });
        return false;
    });

    $(document).on('mouseenter','.js-info-section',function(){
		var id = $(this).data('id');
		var data = "id="+id;
		var wrap = $(this).parents('.level-2-wrap');
        /*console.log(wrap);*/

        BX.showWait();
        var postData = {
            id: id,
            sessid: BX.bitrix_sessid()
        };

        BX.ajax({
            timeout: 20,
            method: 'POST',
            dataType: 'html',
            url: '/local/tools/getSectionInfo.php',
            data: postData,
            onsuccess: function (result)
            {
                BX.closeWait();
                wrap.find('.sectionContainer').addClass('active');

                wrap.find('.sectionContainer .wrap').html(result);



                $('.collections.mlist li .fix-icon').click(function () {
                    $(this).toggleClass('active');
                    $('.collections.mlist').toggleClass('opacity');
                });
                /*$('.js-series.mlist li').first().addClass('active');
                $('.mlist .model-elements').first().addClass('active');*/
                //x5 20190627 инициализируем слайдер для баннеров
                window.X5Slider();

            },
            onfailure : function()
            {
                BX.closeWait();

                wrap.find('.sectionContainer .wrap').html('Ошибка');
            }
        });
        return false;
	});

    $(document).on('mouseenter','.collections li',function(){
    	var id = $(this).data('id');
        $('.collections li').removeClass('active');
        $(this).addClass('active');
        $('.model-elements-list').removeClass('active');
    	$('.model'+id).addClass('active');
    });

    $(document).on('mouseenter','.model-elements',function(){
        var id = $(this).data('id');
        var sectionid = $(this).data('sectionid');
        var propid = $(this).data('propid');
        $('.model-elements-list li').removeClass('active');
        $(this).addClass('active');
        BX.showWait();
        var postData = {
            id: id,
            sectionid: sectionid,
            propid: propid,
            sessid: BX.bitrix_sessid()
        };


        BX.ajax({
            timeout: 20,
            method: 'POST',
            dataType: 'html',
            url: '/local/tools/getElementInfo.php',
            data: postData,
            onsuccess: function (result)
            {
                BX.closeWait();
                $('.ajax-element').html(result);
                //x5 20190626 выполняем js, который показывает ссылку Развернуть и фиксирует первоначальные размеры
                ElementInfoJsOnLoad();
            },
            onfailure : function()
            {
                BX.closeWait();

                $('#ajax-element').html('Ошибка');
            }
        });
        return false;

    });



    $(document).on('mouseenter','.collections.js-series.mlist li',function(){
         var id = $(this).data('id');

         //$('.model-elements-list.model'+id + ' ul .js-desc-series').addClass('active');
         $('.model-elements-list.model'+id + ' li:first').addClass('active');

    });

    $(document).on('mouseenter','.collections:not(.js-series) li',function() { // наведение мыши на офисные кресла -> модели
        var id = $(this).data('id');

        var modelId = $('.model'+id+' .mlist li:first').data('id');
        var sectionid = $('.model'+id+' .mlist li:first').data('sectionid');
        var propid = $('.model'+id+' .mlist li:first').data('propid');

        $('.model-elements-list li').removeClass('active');
        $('.model'+id+' .mlist li:first').addClass('active');



        BX.showWait();
        var postData = {
            id: modelId,
            sectionid: sectionid,
            propid: propid,
            sessid: BX.bitrix_sessid()
        };


        /* ---------------------------------------------- */
        BX.ajax({
            //timeout: 30,
            method: 'POST',
            dataType: 'html',
            url: '/local/tools/getElementInfo.php',
            data: postData,
            onsuccess: function (result)
            {
                BX.closeWait();
                $('.ajax-element').html(result);
                //x5 20190626 выполняем js, который показывает ссылку Развернуть и фиксирует первоначальные размеры
                ElementInfoJsOnLoad();
            },
            onfailure : function()
            {
                BX.closeWait();

                $('#ajax-element').html('Ошибка');
            }
        });
        return false;
        /* ---------------------------------------------- */

    });
    $(document).on('mouseenter','.js-series li,.js-desc-series',function(){
        var id = $(this).data('id');
        var sectionid = $(this).data('sectionid');
        $('.js-series li').removeClass('active');
        $('.model-elements-list li').removeClass('active');

        $(this).addClass('active');
        BX.showWait();
        var postData = {
            id: id,
            sectionid: sectionid,
            sessid: BX.bitrix_sessid()
        };


        BX.ajax({
            timeout: 20,
            method: 'POST',
            dataType: 'html',
            url: '/local/tools/getCollectionInfo.php',
            data: postData,
            onsuccess: function (result)
            {
                BX.closeWait();
                $('.ajax-element').html(result);
            },
            onfailure : function()
            {
                BX.closeWait();

                $('#ajax-element').html('Ошибка');
            }
        });
        return false;

    });



    $(document).on('mouseenter','.js-kit-series',function(){
        var id = $(this).data('id');
        var sectionid = $(this).data('sectionid');
        $('.js-series li').removeClass('active');
        $('.model-elements-list li').removeClass('active');

        $(this).addClass('active');
        BX.showWait();
        var postData = {
            id: id,
            sectionid: sectionid,
            sessid: BX.bitrix_sessid()
        };


        BX.ajax({
            timeout: 20,
            method: 'POST',
            dataType: 'html',
            url: '/local/tools/getKitInfo.php',
            data: postData,
            onsuccess: function (result)
            {
                BX.closeWait();
                $('.ajax-element').html(result);
            },
            onfailure : function()
            {
                BX.closeWait();

                $('#ajax-element').html('Ошибка');
            }
        });
        return false;

    });


    //x5 20190626 begin развернуть характиристики до нижней границы окна и, если надо, отобразить прокрутку
    ElementInfoJsOnLoad = function () {
        var props_block = $("div.ajax-element div.props");
        var startMaxHeight = parseInt(props_block.css('max-height'));
        var startHeight = parseInt(props_block.css('height'));
        props_block.parent().css('height', parseInt(startHeight) + 5);
        var scrollHeight = props_block.get(0).scrollHeight;
        props_block.attr("data-scrollheight", scrollHeight);
        props_block.attr("data-startheight", startHeight);
        props_block.attr("data-startmaxheight", startMaxHeight);

        if (startMaxHeight < scrollHeight) {
            props_block.parent().parent().find('a.characteristiky_expander').show();
        }
    };

    //обработчик на кнопку Развeрнуть характеристики
    $('div#ajax-sectionContainer').on('click','a.characteristiky_expander',function (e) {
        var link_expander = $(e.currentTarget);
        var props_block = $(e.currentTarget).parent().parent().find('div.props');
        var startMaxHeight = props_block.attr("data-startmaxheight");
        var startHeight = props_block.attr("data-startheight");
        if (props_block.hasClass('expanded')) {
            props_block.removeClass('expanded');
            props_block.removeClass('scrolled');
            props_block.animate({
                maxHeight: startMaxHeight + "px"
            }, 1000, function () {
                props_block.removeClass('scrolled');
                link_expander.html('Развернуть');
            });

        } else {

            var content_height = props_block.attr("data-scrollheight");

            $menu_container = $('#ajax-sectionContainer .bottom-section');
            var menu_top = $menu_container.offset().top;

            var top_props = props_block.offset().top;
            var props_bottom = top_props + props_block.height();
            var new_height = (menu_top-props_bottom) + parseInt(startHeight)-5;
            if ((parseInt(content_height) + 10) < new_height) {
                new_height = parseInt(content_height) + 5;
            }

            props_block.animate({
                maxHeight: new_height + 'px'
            }, 1000, 'swing', function () {
                props_block.addClass('scrolled');
                link_expander.html('Свернуть');
            });
            props_block.addClass('expanded');
        }
    });

    //x5 20190626 end

});