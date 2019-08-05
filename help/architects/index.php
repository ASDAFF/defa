<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Дизайнерам и архитекторам");
?><div class="row architects">
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
<div class="top_block">
	<h3 class="title_block big">Преимущества для покупателя</h3>
</div>
<div class="row services-specialist test-drive architects">
	<div class="col-lg-3 specialist-advantages">
		<h3 class="specialist-advantages-title">Приятные условия</h3>
		<div class="specialist-advantages-hide">
			<p class="specialist-advantages-text">
				 Краткое описание преимущества. Краткое описание преимущества. Краткое описание преимущества
			</p>
		</div>
	</div>
	<div class="col-lg-3 specialist-advantages">
		<h3 class="specialist-advantages-title">Разнообразие стилей</h3>
		<div class="specialist-advantages-hide">
			<p class="specialist-advantages-text">
				 Краткое описание преимущества. Краткое описание преимущества. Краткое описание преимущества
			</p>
		</div>
	</div>
	<div class="col-lg-3 specialist-advantages">
		<h3 class="specialist-advantages-title">Можно посмотреть в салоне</h3>
		<div class="specialist-advantages-hide">
			<p class="specialist-advantages-text">
				 Краткое описание преимущества. Краткое описание преимущества. Краткое описание преимущества
			</p>
		</div>
	</div>
	<div class="col-lg-3 specialist-advantages">
		<h3 class="specialist-advantages-title">Доставка 2-3 дня</h3>
		<div class="specialist-advantages-hide">
			<p class="specialist-advantages-text">
				 Краткое описание преимущества. Краткое описание преимущества. Краткое описание преимущества
			</p>
		</div>
	</div>
</div>
<div class="top_block">
	<h3 class="title_block big">Преимущества для дизайнера</h3>
</div>
<div class="row services-specialist test-drive architects">
	<div class="col-lg-3 specialist-advantages">
		<h3 class="specialist-advantages-title">Приятные условия</h3>
		<div class="specialist-advantages-hide">
			<p class="specialist-advantages-text">
				 Краткое описание преимущества. Краткое описание преимущества. Краткое описание преимущества
			</p>
		</div>
	</div>
	<div class="col-lg-3 specialist-advantages">
		<h3 class="specialist-advantages-title">Разнообразие стилей</h3>
		<div class="specialist-advantages-hide">
			<p class="specialist-advantages-text">
				 Краткое описание преимущества. Краткое описание преимущества. Краткое описание преимущества
			</p>
		</div>
	</div>
	<div class="col-lg-3 specialist-advantages">
		<h3 class="specialist-advantages-title">Можно посмотреть в салоне</h3>
		<div class="specialist-advantages-hide">
			<p class="specialist-advantages-text">
				 Краткое описание преимущества. Краткое описание преимущества. Краткое описание преимущества
			</p>
		</div>
	</div>
	<div class="col-lg-3 specialist-advantages">
		<h3 class="specialist-advantages-title">Доставка 2-3 дня</h3>
		<div class="specialist-advantages-hide">
			<p class="specialist-advantages-text">
				 Краткое описание преимущества. Краткое описание преимущества. Краткое описание преимущества
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
		<h4>Зарегистрироваться</h4>
		<p class="about-text">
			 Менеджер "ДЭФО" приедет к Вам в офис с каталогами и образцами текстур и фактур
		</p>
 </li>
		<li class="col-lg-3 services-step">
		<h4>Зарегистрироваться</h4>
		<p class="about-text">
			 Бесплатно и быстро дизайнер создаст проект расстановки мебели с учетом специфики работы каждого сотрудника
		</p>
 </li>
		<li class="col-lg-3 services-step">
		<h4>Зарегистрироваться</h4>
		<p class="about-text">
			 Специалисты отдела послепродажного обслуживания помогут подобрать наиболее подходящие условия поставки
		</p>
 </li>
		<li class="col-lg-3 services-step">
		<h4>Зарегистрироваться</h4>
		<p class="about-text">
			 Профессиональная служба доставки в кратчайшие сроки доставит заказанную мебель, соберет и установит, вывезет мусор
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
<div class="top_block">
	<h3 class="title_block big">Дизайнеры</h3>
</div>
<div class="row architects">
	<div class="col-lg-12">
		<p>
			 Краткий текст о подразделе и как можно им пользоваться. Краткий текст о подразделе и как можно им пользоваться. Краткий текст о подразделе и как можно им пользоваться. Краткий текст о подразделе и как можно им пользоваться. Краткий текст о подразделе и как можно им пользоваться.
		</p>
	</div>
	<div class="col-lg-3 designer-portfolio">
 <img width="312" src="/images/design-project.jpg" height="200" alt="">
		<div class="designer-portfolio-text">
 <img width="151" src="/images/designer.jpg" height="151" alt="" class="designer-photo">
			<h3 class="designer-name">Марта Ерофеева</h3>
			<h4>Офис в современном стиле</h4>
			<p>
				 Концепция Open Space демонстрирует идею демократичного офиса, который организуется в достаточно большом помещенеии, не разделенном капитальными стенами.
			</p>
 <a href="" class="designer-portfolio-link">Заказать такой проект</a>
		</div>
	</div>
	<div class="col-lg-3 designer-portfolio">
 <img width="312" src="/images/design-project.jpg" height="200" alt="">
		<div class="designer-portfolio-text">
 <img width="151" src="/images/designer.jpg" height="151" alt="" class="designer-photo">
			<h3 class="designer-name">Марта Ерофеева</h3>
			<h4>Офис в современном стиле</h4>
			<p>
				 Концепция Open Space демонстрирует идею демократичного офиса, который организуется в достаточно большом помещенеии, не разделенном капитальными стенами.
			</p>
 <a href="" class="designer-portfolio-link">Заказать такой проект</a>
		</div>
	</div>
	<div class="col-lg-3 designer-portfolio">
 <img width="312" src="/images/design-project.jpg" height="200" alt="">
		<div class="designer-portfolio-text">
 <img width="151" src="/images/designer.jpg" height="151" alt="" class="designer-photo">
			<h3 class="designer-name">Марта Ерофеева</h3>
			<h4>Офис в современном стиле</h4>
			<p>
				 Концепция Open Space демонстрирует идею демократичного офиса, который организуется в достаточно большом помещенеии, не разделенном капитальными стенами.
			</p>
 <a href="" class="designer-portfolio-link">Заказать такой проект</a>
		</div>
	</div>
	<div class="col-lg-3 designer-portfolio card">
		<h4>Консультация</h4>
		<p>
			 Специалисты проконсультируют Вас по вопросам проектирования и реализации разработанного дизайна интерьера.
		</p>
 <a href="" class="red-btn">Консультация</a>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>