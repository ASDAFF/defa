/**
 * x5 20190627
 * Слайдер - смена слайдов через определенный интервал (плавность смены реализована css transition)
 * Особенности слайдера:
 * - не навешивается никаких событий
 * - один обработчик обрабатывает несколько слайдеров с разным интервалом смены слайдов
 * - подхватывает динамически вставляемый html слайдеров
 * - при отстутствии на странице html слайдеров прерывается выполнение кода
 * - многократный вызов функции window.X5Slider() не запускает многократные setTimeout - проверяется наличие активного handler
 * - картинкам в слайдере можно не указывать src, а указать data-img-src - в этом случае картинка подгрузится только в момент ее показа. src на старте стоит присвоить картинку из 1px, пустой src увеличивает время ответа
 *
 * В:Как запустить слайдер?
 * повесить на ul класс x5slider, установить атрибут data-interval=1000 (частота смены слайдера в миллисекундах) и выполнить следующий js
 * window.X5Slider(); или window.X5Slider.init(); - оба варианта равнозначны
 * В: Как остановить все слайдеры?
 * window.X5Slider.clear(); - остановятся все слайдеры.
 * В: Как остановить один слайдер, чтобы другие продолжали работать?
 * Удалите у него класс x5slider и он перестанет подхватываться скриптом
 * В: Надо ли после вставки динамического контента инициализировать слайдер?
 * Да, потому что в случае отсутствия слайдера обработчик прерывается. В любом случае многократная инициализация слайдера не влечет множественные setTimeout
 */

(function (window) {

    if (!window.X5Slider) {

        window.X5Slider = function () {
            window.X5Slider.init();
        }

        window.X5Slider.timeouthandle = null;
        window.X5Slider.iter_interval = 1000;

        /**
         * x5 20190627 запускает обработчик слайдеров, проверяет, чтобы не было запущено более одного обработчика
         * @returns handler setTimeout
         */
        window.X5Slider.init = function () {
            if (window.X5Slider.timeouthandle != null) {
                return window.X5Slider.timeouthandle;
            }
            return window.X5Slider.setNextIteration();
        }

        window.X5Slider.setNextIteration = function () {
            var self = window.X5Slider;
            //console.log('iter_interval=' + window.X5Slider.iter_interval);
            //отображаем картинки для активных слайдов всех слайдеров
            var curSlide = $('.x5slider').find('.showing');
            curSlide.each(function(index1,value1){
                window.X5Slider.loadImagesForSlide($(value1));
            });

            window.X5Slider.timeouthandle = setTimeout(function () {
                self.iteration();
            }, window.X5Slider.iter_interval);
            return window.X5Slider.timeouthandle;
        }

        window.X5Slider.iteration = function () {
            /*console.log('iteration');
            console.log(new Date().toTimeString());*/
            var sliders = $('.x5slider');
            if (sliders.length <= 0) {
                console.log('clear слайдеров нет');
                window.X5Slider.clear();
                return false;
            }

            sliders.each(function (index, value) {
                //console.log(value);
                var curSlider = $(value);
                var lasttime = curSlider.attr('data-lasttime');
                var interval = curSlider.attr('data-interval');
                var slides = sliders.children();
                if (slides.length > 1) {
                    if (interval == undefined) {
                        curSlider.attr('data-interval', window.X5Slider.iter_interval);
                        interval = window.X5Slider.iter_interval;
                    }
                    var curTime = Date.now();

                    if (lasttime == undefined) {
                        curSlider.attr('data-lasttime', Date.now());
                        curSlider.attr('data-currentslide', Date.now());
                    } else if ((curTime - lasttime) > interval) {
                        //console.log(new Date().toTimeString());
                        var currentSlide = sliders.find('.showing').first();
                        var currentSlideIndex = currentSlide.index();
                        var nextSlideIndex = (currentSlideIndex + 1) % slides.length;

                        var nextSlide = slides.eq(nextSlideIndex);

                        window.X5Slider.loadImagesForSlide(nextSlide);

                        slides.eq(currentSlideIndex).removeClass('showing');
                        nextSlide.addClass('showing');
                        curSlider.attr('data-lasttime', Date.now());
                    }
                }
            });

            window.X5Slider.setNextIteration();
        }

        window.X5Slider.loadImagesForSlide = function(slide){
            var imgs = slide.find('img');
            imgs.each(function (index1, value1) {
                //debugger;
                var img = $(value1);
                var preloadsrc = img.attr('data-img-src');
                var src = img.attr('src');
                if(preloadsrc!=undefined&&src!=preloadsrc) img.attr('src',preloadsrc);
            });
        }

        window.X5Slider.clear = function () {
            if (window.X5Slider.timeouthandle != null) clearTimeout(window.X5Slider.timeouthandle);
            window.X5Slider.timeouthandle = null;
        }

    }
})(window);