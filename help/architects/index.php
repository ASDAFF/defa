<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Дизайнерам и архитекторам");
?>
    <div class="row architects">
        <div class="col-lg-12 big-banner">
            <div class="background-opacity">
                <h2>Для дизайнеров и архитекторов</h2>
                <p>
                     Зарегистрируйтесь и скачайте 3D-модели и другие материалы
                </p>
     <a href="/help/architects/3d-models/" class="simple-link">Список материалов</a>
                <?if(!$USER->IsAuthorized()):?>
                <p class="links-wrapper">
     <a href="/help/architects/3d-models/" data-event="jqm" data-param-type="auth" data-param-backurl="/help/architects/" data-name="auth">Войти</a> <a href="/auth/registration/?register=yes&backurl=/help/architects/?login=yes&wait_architect">Регистрация</a>
                </p>
                <?else:?>
                    <p class="links-wrapper">
                        <a href="/help/architects/3d-models/" style="width:100%">Перейти к материалам</a>
                    </p>
                <?endif;?>
            </div>
        </div>
    </div>

<div class="row text">
    <p>«ДЭФО» приглашает к сотрудничеству креативных дизайнеров, архитекторов и декораторов, дизайн-бюро и интерьерные студии. Если вы проектируете или оформляете офисные пространства, домашние кабинеты, рестораны, отели или квартиры, то мы готовы предложить более 40000 моделей современной мебели для реализации ваших идей.</p>
</div>

<div class="top_block">
	<h3 class="title_block big">Партнерство с «ДЭФО» это:</h3>
</div>
<div class="row services-specialist test-drive architects">
	<div class="col-lg-3 specialist-advantages">
		<h3 class="specialist-advantages-title">Индивидуальные условия начисления бонусов</h3>
	</div>
	<div class="col-lg-3 specialist-advantages">
		<h3 class="specialist-advantages-title">Гарантированная защита проекта</h3>
	</div>
	<div class="col-lg-3 specialist-advantages">
		<h3 class="specialist-advantages-title">Статус официального партнера после первой сделки</h3>
	</div>
	<div class="col-lg-3 specialist-advantages">
		<h3 class="specialist-advantages-title">Размещение ваших проектов на официальном сайте и социальных сетях «ДЭФО»</h3>
	</div>
</div>

<!--здесь не забыть добавить форму загрузить проект-->
<div class="top_block">
	<h3 class="title_block big">Преимущества работы с нами:</h3>
</div>
<div class="row services-specialist test-drive architects">
	<div class="col-lg-3 specialist-advantages">
		<h3 class="specialist-advantages-title">Огромный ассортимент</h3>
		<div class="specialist-advantages-hide">
			<p class="specialist-advantages-text">
                Более 40000 наименований моделей для офиса и дома
			</p>
		</div>
	</div>
	<div class="col-lg-3 specialist-advantages">
		<h3 class="specialist-advantages-title">Встречи в салонах</h3>
		<div class="specialist-advantages-hide">
			<p class="specialist-advantages-text">
                Салоны в разных районах города, где вы можете осмотреть материалы и товары на выставке, организовать встречу с клиентом или получить личную консультацию наших специалистов
			</p>
		</div>
	</div>
	<div class="col-lg-3 specialist-advantages">
		<h3 class="specialist-advantages-title">Персональный менеджер</h3>
		<div class="specialist-advantages-hide">
			<p class="specialist-advantages-text">
                При работе над проектом вы всегда можете обратиться к личному менеджеру, который  поможет разобраться в ассортименте, сделать заказ и сопроводит сделку
			</p>
		</div>
	</div>
	<div class="col-lg-3 specialist-advantages">
		<h3 class="specialist-advantages-title">Есть в наличии</h3>
		<div class="specialist-advantages-hide">
			<p class="specialist-advantages-text">
                Самые востребованные модели всегда в наличии на нашем складе – ваши клиенты могут получить мебель уже завтра
			</p>
		</div>
	</div>
	<div class="col-lg-3 specialist-advantages">
		<h3 class="specialist-advantages-title">Федеральная сеть</h3>
		<div class="specialist-advantages-hide">
			<p class="specialist-advantages-text">
                Вы можете расширять границы реализации ваших проектов, так как салоны «ДЭФО» представлены по всей России.
			</p>
		</div>
	</div>
	<div class="col-lg-3 specialist-advantages">
		<h3 class="specialist-advantages-title">Изготовим под заказ</h3>
		<div class="specialist-advantages-hide">
			<p class="specialist-advantages-text">
                Если Ваш проект требует нестандартных размеров или дизайна – мы изготовим мебель по вашему индивидуальному заказу.
			</p>
		</div>
	</div>
	<div class="col-lg-3 specialist-advantages">
		<h3 class="specialist-advantages-title">Комплексный сервис</h3>
		<div class="specialist-advantages-hide">
			<p class="specialist-advantages-text">
                Наши сотрудники позаботятся о всех этапах доставки, подъема, сборки и вывоза упаковки с объекта
			</p>
		</div>
	</div>
	<div class="col-lg-3 specialist-advantages">
		<h3 class="specialist-advantages-title">Гарантия и постгарантийное обслуживание</h3>
		<div class="specialist-advantages-hide">
			<p class="specialist-advantages-text">
                Мы предлагаем гарантию до 10 лет на ряд серий корпусной мебели и до 5 лет на офисные кресла. Оказываем услуги ремонта мебели по истечению гарантийного срока
			</p>
		</div>
	</div>
	<div class="col-lg-3 specialist-advantages">
		<h3 class="specialist-advantages-title">Специальные предложения</h3>
		<div class="specialist-advantages-hide">
			<p class="specialist-advantages-text">
                У нас проходят акции и распродажи, которые могут быть интересны вашим клиентам. Подпишитесь на нашу рассылку и будьте в курсе самых выгодных предложений и анонсов последних новинок
			</p>
		</div>
	</div>
</div>
<div class="top_block">
	<h3 class="title_block big">Как стать участником программы</h3>
</div>
<div class="row services about architects">
	<ol class="row services-steps">
		<li class="col-lg-3 services-step">
		<h4>Оставьте заявку на сайте</h4>
		<p class="about-text">
            С вами свяжется менеджер и расскажет об условиях сотрудничества
		</p>
 </li>
		<li class="col-lg-3 services-step">
		<h4>Заключите соглашение</h4>
		<p class="about-text">
            Подписание договора подтверждает партнерские намерения
		</p>
 </li>
		<li class="col-lg-3 services-step">
		<h4>Скачайте базу 3D моделей</h4>
		<p class="about-text">
            Вы получите свой персональный доступ к базе моделей и другим материалам
		</p>
 </li>
		<li class="col-lg-3 services-step">
		<h4>Создавайте проекты с мебелью «ДЭФО»</h4>
		<p class="about-text">

		</p>
 </li>
	</ol>
</div>
<!--<div class="top_block">-->
<!--	<h3 class="title_block big tabs-title">Наши товары</h3>-->
<!--</div>-->
<!--<div class="row products-tabs architects series">-->
<!--	<div class="col-lg-12 products-tabs-card card">-->
<!--		<div class="row products-tabs-content">-->
<!--			<div class="col-lg-2 tabs-list-wrap">-->
<!--				<ul class="tabs-list">-->
<!--					<li class="tabs-item"><a href="">Мебель для офиса</a></li>-->
<!--					<li class="tabs-item active"><a href="">Кресла и стулья</a></li>-->
<!--					<li class="tabs-item"><a href="">Мебель для приемных</a></li>-->
<!--					<li class="tabs-item"><a href="">Переговорки</a></li>-->
<!--					<li class="tabs-item"><a href="">Мягкая мебель</a></li>-->
<!--				</ul>-->
<!--			</div>-->
<!--			<div class="col-lg-2 products-tabs-wrap">-->
<!--				<ul class="products-list">-->
<!--					<li class="products-item"><a href="">Тревизо</a></li>-->
<!--					<li class="products-item"><a href="">Ларус</a></li>-->
<!--					<li class="products-item active"><a href="">Пингеко</a></li>-->
<!--					<li class="products-item"><a href="">Гемсоун</a></li>-->
<!--					<li class="products-item"><a href="">Спич</a></li>-->
<!--					<li class="products-item"><a href="">Венеция</a></li>-->
<!--					<li class="products-item"><a href="">Прего</a></li>-->
<!--					<li class="products-item"><a href="">Плаза</a></li>-->
<!--					<li class="products-item"><a href="">Таурус</a></li>-->
<!--					<li class="products-item"><a href="">Смартекст</a></li>-->
<!--					<li class="products-item"><a href="">Вегас</a></li>-->
<!--					<li class="products-item"><a href="">Мастер</a></li>-->
<!--					<li class="products-item"><a href="">Нортон</a></li>-->
<!--					<li class="products-item"><a href="">Ричмонд</a></li>-->
<!--					<li class="products-item"><a href="">Лофт</a></li>-->
<!--				</ul>-->
<!--			</div>-->
<!--			<div class="col-lg-8 product-demo">-->
<!--				<div class="row">-->
<!--					<div class="col-lg-8 photo-demo">-->
<!--						<div class="series-slider-wrapper">-->
<!--							<div class="main-img main-slide">-->
<!-- <img width="1020" src="/images/trevizo-demo.jpg" height="683" alt="" class="series-item__main-photo">-->
<!--							</div>-->
<!--							<div class="toggle-img">-->
<!--								<div class="toggle-img-item">-->
<!-- <img width="1020" src="/images/trevizo-demo.jpg" height="683" alt="">-->
<!--								</div>-->
<!--								<div class="toggle-img-item">-->
<!-- <img width="1020" src="/images/trevizo-demo.jpg" height="683" alt="">-->
<!--								</div>-->
<!--								<div class="toggle-img-item">-->
<!-- <img width="1020" src="/images/trevizo-demo.jpg" height="683" alt="">-->
<!--								</div>-->
<!--								<div class="toggle-img-item">-->
<!-- <img width="1020" src="/images/trevizo-demo.jpg" height="683" alt="">-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div class="dedcription-demo">-->
<!--							<h4>Описание</h4>-->
<!--							<p>-->
<!--								 Президент-комплект LARUS воплощает лучшие традиции итальянского мебельного дизайна: он функционален, благодаря инновационным конструктивным решениям, основателен и, в то же время, изящен.-->
<!--							</p>-->
<!--						</div>-->
<!--					</div>-->
<!--					<div class="col-lg-4 about-demo">-->
<!--						<ul class="series-item-pros">-->
<!--							<li class="series-item-pros-element">-->
<!--							<div class="pros-icon">-->
<!-- <img src="https://via.placeholder.com/30x30" alt="">-->
<!--							</div>-->
<!-- <span class="pros-text">Описание преимущества</span> </li>-->
<!--							<li class="series-item-pros-element">-->
<!--							<div class="pros-icon">-->
<!-- <img src="https://via.placeholder.com/30x30" alt="">-->
<!--							</div>-->
<!-- <span class="pros-text">Описание преимущества</span> </li>-->
<!--							<li class="series-item-pros-element">-->
<!--							<div class="pros-icon">-->
<!-- <img src="https://via.placeholder.com/30x30" alt="">-->
<!--							</div>-->
<!-- <span class="pros-text">Описание преимущества</span> </li>-->
<!--							<li class="series-item-pros-element">-->
<!--							<div class="pros-icon">-->
<!-- <img src="https://via.placeholder.com/30x30" alt="">-->
<!--							</div>-->
<!-- <span class="pros-text">Описание преимущества</span> </li>-->
<!--						</ul>-->
<!--						<div class="series-item-color-solutions">-->
<!--							<h3>Цветовые решения</h3>-->
<!--							<div class="series-item-color-content">-->
<!--								<div class="series-item-color-wrapper">-->
<!--									<div class="series-item-color-pic" data-title="" style="background: url()">-->
<!-- <a href="#" class="series-item-color-link series-item-color-link-main" data-color-xml-id=""> <img src="https://via.placeholder.com/90x60" alt=""> </a>-->
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div class="series-item-color-solutions">-->
<!--							<h3>Дополнительные цвета</h3>-->
<!--							<div class="series-item-color-content">-->
<!--								<div class="series-item-color-wrapper">-->
<!--									<div class="series-item-color-pic" data-title="" style="background: url()">-->
<!-- <a href="#" class="series-item-color-link series-item-color-link-add" data-color-xml-id=""> <img src="https://via.placeholder.com/90x60" alt=""> </a>-->
<!--									</div>-->
<!--								</div>-->
<!--							</div>-->
<!--						</div>-->
<!-- <a href="" class="red-btn">Подробнее</a>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--		<div class="row">-->
<!--			<div class="col-lg-4 link-block">-->
<!-- <a href="/catalog" class="arrow-link">Перейти в каталог</a>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->
<!--<div class="top_block">-->
<!--	<h3 class="title_block big">Дизайнеры</h3>-->
<!--</div>-->
<!--<div class="row architects">-->
<!--	<div class="col-lg-12">-->
<!--		<p>-->
<!--			 Краткий текст о подразделе и как можно им пользоваться. Краткий текст о подразделе и как можно им пользоваться. Краткий текст о подразделе и как можно им пользоваться. Краткий текст о подразделе и как можно им пользоваться. Краткий текст о подразделе и как можно им пользоваться.-->
<!--		</p>-->
<!--	</div>-->
<!--	<div class="col-lg-3 designer-portfolio">-->
<!-- <img width="312" src="/images/design-project.jpg" height="200" alt="">-->
<!--		<div class="designer-portfolio-text">-->
<!-- <img width="151" src="/images/designer.jpg" height="151" alt="" class="designer-photo">-->
<!--			<h3 class="designer-name">Марта Ерофеева</h3>-->
<!--			<h4>Офис в современном стиле</h4>-->
<!--			<p>-->
<!--				 Концепция Open Space демонстрирует идею демократичного офиса, который организуется в достаточно большом помещенеии, не разделенном капитальными стенами.-->
<!--			</p>-->
<!-- <a href="" class="designer-portfolio-link">Заказать такой проект</a>-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="col-lg-3 designer-portfolio">-->
<!-- <img width="312" src="/images/design-project.jpg" height="200" alt="">-->
<!--		<div class="designer-portfolio-text">-->
<!-- <img width="151" src="/images/designer.jpg" height="151" alt="" class="designer-photo">-->
<!--			<h3 class="designer-name">Марта Ерофеева</h3>-->
<!--			<h4>Офис в современном стиле</h4>-->
<!--			<p>-->
<!--				 Концепция Open Space демонстрирует идею демократичного офиса, который организуется в достаточно большом помещенеии, не разделенном капитальными стенами.-->
<!--			</p>-->
<!-- <a href="" class="designer-portfolio-link">Заказать такой проект</a>-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="col-lg-3 designer-portfolio">-->
<!-- <img width="312" src="/images/design-project.jpg" height="200" alt="">-->
<!--		<div class="designer-portfolio-text">-->
<!-- <img width="151" src="/images/designer.jpg" height="151" alt="" class="designer-photo">-->
<!--			<h3 class="designer-name">Марта Ерофеева</h3>-->
<!--			<h4>Офис в современном стиле</h4>-->
<!--			<p>-->
<!--				 Концепция Open Space демонстрирует идею демократичного офиса, который организуется в достаточно большом помещенеии, не разделенном капитальными стенами.-->
<!--			</p>-->
<!-- <a href="" class="designer-portfolio-link">Заказать такой проект</a>-->
<!--		</div>-->
<!--	</div>-->
<!--	<div class="col-lg-3 designer-portfolio card">-->
<!--		<h4>Консультация</h4>-->
<!--		<p>-->
<!--			 Специалисты проконсультируют Вас по вопросам проектирования и реализации разработанного дизайна интерьера.-->
<!--		</p>-->
<!-- <a href="" class="red-btn">Консультация</a>-->
<!--	</div>-->
<!--</div>-->
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>