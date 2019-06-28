<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Стать партнером");
?>
<link rel="stylesheet" href="/css/animate.css" type="text/css" media="screen" />
<style>
.bx_sidebar {
	display:none !important;
}
</style>
<h1 style=" max-width: 1150px; margin: 0 auto;">Стать партнером</h1>
<div class="p1 partners">
	<div class="padmargin adv">
	Из Интервью генерального директора ДЭФО журналу «Chief Time» 
	о мебельной стратегии ДЭФО, март 2014 года:
	</div>
	<img src="img/p1.jpg" />
	<div class="transWrap">
		<p>
		<span></span>Выбирая Партнеров, на что Вы обращаете внимание 
	прежде всего?<em></em>
		</p>
		<p>
	<span></span>Есть три критерия – «кита»: положительная репутация партнера, экономическая выгода и то, 
	как нам удается выстроить с нашим потенциальным партнером «человеческий контакт»<em></em>
		</p>
	</div>
</div>
<div class="p2 partners">
	<div class="padmargin">
	Мебельным фабрикам
	</div>
	<p>
	Принимаем заявки мебельных фабрик, которые готовы сделать компании ДЭФО эксклюзивные предложения 
 в рамках представленного ассортимента.
	</p>
	<img src="img/p2.jpg" />
	<a href="#" class="popup_p">Заполнить форму о партнерстве</a>
</div>
<div class="p3 partners">
	<div class="padmargin">
	Дизайнерам и архитекторам
	</div>
	<p>
	Предложение тем, кто разрабатывает проекты для своих клиентов и ищет интересные мебельные и интерьерные решения для офиса и дома. Компания ДЭФО рада поучаствовать в этом процессе, помочь в выборе мебели, чтобы в минимальные сроки подготовить выгодное предложение, как для клиента, так и для дизайнера.
	</p>
	<img src="img/p3.jpg" />
	<a href="#" class="popup_p">Заполнить форму о партнерстве</a>
</div>
<div class="p4 partners">
	<div class="padmargin">
	ФРАНЧАЙЗИ
	</div>
	<p>
	Приглашаем к сотрудничеству партнеров-франчайзи, готовых быть частичкой крупной мебельной компании ДЭФО, получать эксклюзивные условия сотрудничества, печататься во всей рекламной продукции ДЭФО. А это, например, отличный сайт, три каталога  и полтора миллиона рекламных газет в год, которые распространяются по всей России.
	</p>
	<img src="img/p4.jpg" />
	<a href="#" class="popup_p">Заполнить форму о партнерстве</a>
</div>
<div class="p5 partners">
	<div class="padmargin">
	ДИЛЕРАМ
	</div>
	<p>
	Компания ДЭФО рада сотрудничать с новыми мебельными дилерами, которые готовы торговать ассортиментом офисной и домашней мебели. При дальнейшем сотрудничестве, рассматривается рост
 до партнера-франчайзи.
	</p>
	<img src="img/p5.jpg" />
	<a href="#" class="lastHref popup_p">Заполнить форму о партнерстве</a>
</div>
<script type="text/javascript">
$(function() {
	$('a.popup_p').fancybox({
        'overlayShow': true, // значения параметров можно посмотреть на сайте разработчика
        'padding': 0,
        'margin' : 0,
        'scrolling' : 'no',
        'titleShow': false,
        'type': 'ajax',
        'href': '/ajax_popup.php?anc=partner', // описание скрипта будет дано ниже по тексту:)
    });
})

$(".p1 .padmargin").addClass('animated zoomIn');
$(".p1 img").addClass('animated animated2 zoomIn');
$(".p1 .transWrap").addClass('animated animated3 zoomIn');
$(".p2 .padmargin").addClass('animated animated4 zoomIn');
$(".p2 p").addClass('animated animated5 zoomIn');
$(".p2 img").addClass('animated animated6 zoomIn');
var h = $(window).height();
$(window).scroll(function() {
	if ( ($(this).scrollTop()+h) >= $(".p2 img").offset().top) {
		$(".p2 a").addClass('animated zoomIn');
		$(".p3 .padmargin").addClass('animated animated2 zoomIn');
		$(".p3 p").addClass('animated animated4 fadeIn');
		$(".p3 img").addClass('animated animated5 fadeIn');
		$(".p3 a").addClass('animated6 zoomIn');
		/*$(".defoToday > div > .span3").addClass('animated animated6 fadeIn');*/
	}
	if ( ($(this).scrollTop()+h) >= $(".p3 img").offset().top) {
		$(".p4 .padmargin").addClass('animated animated2 zoomIn');
		$(".p4 p").addClass('animated animated4 fadeIn');
		$(".p4 img").addClass('animated animated5 fadeIn');
		$(".p4 a").addClass('animated6 zoomIn');
	}
	if ( ($(this).scrollTop()+h) >= $(".p4 img").offset().top) {
		$(".p5 .padmargin").addClass('animated animated2 zoomIn');
		$(".p5 p").addClass('animated animated4 fadeIn');
		$(".p5 img").addClass('animated animated5 fadeIn');
		$(".p5 a").addClass('animated6 zoomIn');
	}
})
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>