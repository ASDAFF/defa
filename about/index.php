<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("О компании | Офисная мебель ДЭФО");
$APPLICATION->SetPageProperty("description", "О магазине – офисная мебель ДЭФО.");
$APPLICATION->SetPageProperty("keywords", "о магазине мебель дэфо");?><style>
.bx_page {
	background:#fff;
	margin-top:0px;
	padding:0px;
	-webkit-box-sizing:border-box;
	-moz-box-sizing:border-box;
	box-sizing:border-box;	
}
.bx_sidebar  {
	display:none !important;
}
.workarea_wrap {
	overflow:hidden;
}
#openVideo {
	display: inline-block;
	cursor: pointer;
}
</style>

<div class="bx_page">
	<h1 style="margin:8px 40px;">О Компании</h1>
	<div class="sovok">
<?/* <span class="sovokCaptionTop">
		БОЛЕЕ 90 САЛОНОВ ДЭФО<br>
		 на территории Российской Федерации </span> */?>
	</div>
	<div class="sovok-caption">
		 МЕБЕЛЬНАЯ КОМПАНИЯ ДЭФО
	</div>
	<div class="spans">
		<p>
			 Один из крупнейших производителей и поставщиков офисной, гостиничной и домашней мебели на рынке России, более 20 лет радует своих клиентов и партнеров высоким качеством продукции, сервисом, а также широким ассортиментом!
		</p>
		<p>
			 За годы работы компания «ДЭФО» получила признание как со стороны профессионалов мебельного рынка, так и со стороны тысяч благодарных покупателей.
		</p>
	</div>
	<div class="sovok-caption">
		 ДЭФО СЕГОДНЯ:
	</div>
	<div class="spans defoToday">
		<div>
 <span class="span1">
			<div class="todayPics">
			</div>
			<div class="hrRed">
			</div>
			<div class="todayText">
				 Десятки фабрик по производству офисной, домашней, гостиничной мебели, кресел и стульев
			</div>
 </span> <span class="span2">
			<div class="todayPics">
			</div>
			<div class="hrRed">
			</div>
			<div class="todayText">
				 Свыше 100 собственных выставочных залов мебели на территории России.
			</div>
 </span> <span class="span3">
			<div class="todayPics">
			</div>
			<div class="hrRed">
			</div>
			<div class="todayText">
				 Современные логистические комплексы в Москве и Санкт-Петербурге общей площадью более 55000 кв.м., собственные склады в каждом городе, где открыт выставочный зал
			</div>
 </span>
		</div>
		<div>
 <span class="span4">
			<div class="todayPics">
			</div>
			<div class="hrRed">
			</div>
			<div class="todayText">
				 Собственный автопарк, коллектив профессиональных экспедиторов и сборщиков мебели в каждом городе, где работает салон ДЭФО
			</div>
 </span> <span class="span5">
			<div class="todayPics">
			</div>
			<div class="hrRed">
			</div>
			<div class="todayText">
				 Доставка и сборка мебели в любом городе России, экспресс-доставка за 24 часа
			</div>
 </span> <span class="span6">
			<div class="todayPics">
			</div>
			<div class="hrRed">
			</div>
			<div class="todayText">
				 Один из лидеров российского рынка по производству и продаже современной качественной мебели для дома
			</div>
 </span>
		</div>
	</div>
	<div class="sovok-caption">
		 Ассортиментная политика ДЭФО
	</div>
	<div class="spans">
		<p>
			 Мы тщательно разрабатываем дизайн каждой коллекции мебели, адаптируя ее к современным веяниям моды и спросу на конкретные модели. Мебель для офиса и дома «ДЭФО» производится из безопасных экологически чистых материалов на современном оборудовании. Последние веяния мебельной моды в сочетании с потребностями клиентов оказывают решающее влияние на формирование ассортимента «ДЭФО».
		</p>
 <img width="346px" src="/upload/about/assort_1.jpg" class="assort"> <img width="346px" src="/upload/about/assort_2.jpg" class="assort"> <img width="346px" src="/upload/about/assort_3.jpg" class="assort">
		<p>
			 На сегодняшний день модельный ряд «ДЭФО» значительно отличается от ассортимента других мебельных компаний и насчитывает свыше 25000 наименований мебели и аксессуаров, как собственного производства, так и ведущих отечественных и зарубежных производителей.
		</p>
		<p>
			 В штат компании входят дизайн-бюро и конструкторский отдел, разрабатывающие новые модели. Мебель собственного производства не раз отмечалась премиями, получала награды и сертификаты.
		</p>
	</div>
 <img width="375px" src="/upload/about/dobrosovestniy.png" height="56px" class="dobro">
	<div class="spans">
	</div>
	<div class="sovok-caption">
		 МЕБЕЛЬНАЯ КОМПАНИЯ ДЭФО ОКАЗЫВАЕТ РЯД УСЛУГ для вас совершенно <span class="red">бесплатно:</span>
	</div>
	<div class="spans forFree">
		<div class="forFree1">
			 Представитель компании свяжется с Вами, где бы Вы ни находились, в удобное для Вас время
		</div>
		<div class="forFree2">
			 Вызов менеджера, дизайнера в офис<br>
 <strong><?if ($_SESSION['city_code'] == 'sankt-peterburg') {
		$phone = '(812) 44 88 999';
	}
	if ($_SESSION['city_code'] == 'moskva') {
		$phone = '8 (800) 770 01 20';
	}?> <?=$phone?></strong>
		</div>
		<div class="forFree3">
			 Дизайн-проект любого офиса БЕСПЛАТНО
		</div>
		<div class="forFree4">
			 Подписка на корпоративные издания «ДЭФО» об ассортименте и специальных предложениях
		</div>
		<div class="forFree5">
			 Заказ каталога на сайте или у менеджера компании!
		</div>
	</div>
	<div class="highQuality">
	</div>
	<div class="sovok-caption">
		 Наши награды
	</div>
	<div class="spans nomargin">
		<p>
			 Высокий уровень обслуживания позволяет «ДЭФО» на протяжении нескольких лет занимать лидирующие позиции в Федеральном реестре Добросовестных поставщиков. Как надежный поставщик, компания регулярно принимает участие в тендерах и государственных заказах.
		</p>
	</div>
	<div class="noSpans">
 <img src="/upload/about/nagradi.jpg" height="313px">
	</div>
	<div class="sovok-caption">
		 СЛУЖБА ВЫСОКОГО СЕРВИСА ДЭФО
	</div>
	<div class="spans forService">
		<div class="spans defoService">
			<div>
 <span class="span1">
				<div class="servicePics">
				</div>
				<div class="hrRed">
				</div>
				<div class="serviceText">
					 Весь спектр услуг для частных и корпоративных клиентов: бесплатный вызов консультанта и дизайнера
				</div>
 </span> <span class="span2">
				<div class="servicePics">
				</div>
				<div class="hrRed">
				</div>
				<div class="serviceText">
					 Бесплатное выполнение дизайн-проекта (2-D и 3-D); предоставление каталогов
				</div>
 </span> <span class="span3">
				<div class="servicePics">
				</div>
				<div class="hrRed">
				</div>
				<div class="serviceText">
					 Доставка и сборка мебели; издание и рассылка газеты «ДЭФО» с новостями компании и другой полезной информацией
				</div>
 </span> <span class="span4">
				<div class="servicePics">
				</div>
				<div class="hrRed">
				</div>
				<div class="serviceText">
					 Интерактивная система контроля качества услуг позволит Вам оставить сообщение руководству компании «ДЭФО» и получить обратную связь в кратчайшие сроки!
				</div>
 </span>
			</div>
		</div>
	</div>
	<div class="sovok-caption">
		 НАШИ ПАРТНЕРЫ
	</div>
 <img src="/upload/about/partners.jpg" height="289px" class="partnersAbout">
	<div class="spans">
	</div>
	<div class="sovok-caption">
		 ФИЛЬМ О КОМПАНИИ ДЭФО
	</div>
 <a href="javascript:void(0);" id="openVideo"><img width="100%" src="<?=SITE_TEMPLATE_PATH;?>/images/film.png" border="0" class="img-responsive"></a>
	<? /*<iframe width="100%" height="490px" src="https://www.youtube.com/embed/z0P9EGQrlP8" frameborder="0" allowfullscreen></iframe>*/?>
	<div class="defo-caption-light">
		 Мы всегда открыты для сотрудничества и рады помочь во всем, что касается современного офиса!
	</div>
</div>
 <script>
$(".sovok").addClass('animated zoomIn');
$(".sovok-caption").eq(0).addClass('animated animated2 zoomIn');
$(".spans").eq(0).addClass('animated animated3 zoomIn');
var h = $(window).height();
$(window).scroll(function() {
	if ( ($(this).scrollTop()+h) >= $(".sovok-caption").eq(1).offset().top) {
		$(".sovok-caption").eq(1).addClass('animated animated2 zoomIn');
		//$(".defoToday > div > span").css({visibility:"visible"});
		$(".defoToday > div > .span1").addClass('animated animated4 fadeIn');
		$(".defoToday > div > .span2").addClass('animated animated5 fadeIn');
		$(".defoToday > div > .span3").addClass('animated animated6 fadeIn');
	}
	if ( ($(this).scrollTop()+h) >= $(".defoToday > div > .span4").offset().top) {

		$(".defoToday > div > .span4").addClass('animated animated4 fadeIn');
		$(".defoToday > div > .span5").addClass('animated animated5 fadeIn');
		$(".defoToday > div > .span6").addClass('animated animated6 fadeIn');
	}
	if ( ($(this).scrollTop()+h) >= $(".sovok-caption").eq(2).offset().top) {
		$(".sovok-caption").eq(2).addClass('animated zoomIn');
		$(".spans").eq(2).find("p").eq(0).addClass('animated bounceInUp');
		$(".spans").eq(2).find("img").eq(0).addClass('animated animated4 fadeIn');
		$(".spans").eq(2).find("img").eq(1).addClass('animated animated5 fadeIn');
		$(".spans").eq(2).find("img").eq(2).addClass('animated animated6 fadeIn');
		
	}
	if ( ($(this).scrollTop()+h) >= $(".dobro").offset().top) {
		$(".dobro").addClass('animated rollIn');
	}
	if ( ($(this).scrollTop()+h) >= $(".sovok-caption").eq(3).offset().top) {
		$(".sovok-caption").eq(3).addClass('animated animated2 zoomIn');
		$(".forFree1").addClass('animated animated3 fadeIn');
		$(".forFree2").addClass('animated animated4 fadeIn');
		$(".forFree3").addClass('animated animated5 fadeIn');
		$(".forFree4").addClass('animated animated6 fadeIn');
		$(".forFree5").addClass('animated animated7 fadeIn');
	}
	
	if ( ($(this).scrollTop()+h) >= $(".highQuality").offset().top) {
		$(".highQuality").addClass('animated animated4 bounceInRight');
	}
	if ( ($(this).scrollTop()+h) >= $(".sovok-caption").eq(4).offset().top) {
		$(".sovok-caption").eq(4).addClass('animated animated2 zoomIn');
		$(".spans.nomargin").addClass('animated animated3 bounceInUp');
	}
	if ( ($(this).scrollTop()+h) >= $(".noSpans").offset().top) {
		$(".noSpans").addClass('animated animated5 zoomIn');
	}
	if ( ($(this).scrollTop()+h) >= $(".sovok-caption").eq(5).offset().top) {
		$(".sovok-caption").eq(5).addClass('animated animated2 zoomIn');
		$(".defoService .span1").addClass('animated animated3 fadeIn');
		$(".defoService .span2").addClass('animated animated4 fadeIn');
		$(".defoService .span3").addClass('animated animated5 fadeIn');
		$(".defoService .span4").addClass('animated animated6 fadeIn');
	}
	if ( ($(this).scrollTop()+h) >= $(".sovok-caption").eq(6).offset().top) {
		$(".sovok-caption").eq(6).addClass('animated animated2 zoomIn');
		$(".partnersAbout").addClass('animated animated5 zoomIn');
	}
	if ( ($(this).scrollTop()+h) >= $(".sovok-caption").eq(7).offset().top) {
		$(".sovok-caption").eq(7).addClass('animated animated2 zoomIn');
	}
	
	
})

</script><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>