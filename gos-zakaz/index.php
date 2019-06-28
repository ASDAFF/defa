<?php
use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

Asset::getInstance()->addCss("/css/gov-order.css");

$APPLICATION->SetTitle("Государственный заказ");
?><div class="gov-order">
	<div class="gov-order__content">
		<h1 class="gov-order__title">Государственный заказ</h1>
	</div>
 <section class="gov-order__section">
	<p class="gov-order__p">
		 Компания ДЭФО обладает большим опытом и потенциалом для участия в конкурсных процедурах, как в сфере государственных закупок по 44-ФЗ и 223 ФЗ, так и в коммерческих конкурсах.
	</p>
	<h2 class="gov-order__h2">Опыт компании ДЭФО</h2>
	<p class="gov-order__p">
		 Компания ДЭФО – это крупная компания федерального уровня с присутствием во всех регионах Российской Федерации:
	</p>
	<ul class="gov-order__list">
		<li class="gov-order__item">участие в тендерных процедурах не только на основных федеральных торговых электронных площадках, но и на множества региональных;</li>
		<li class="gov-order__item">присутствие в качестве поставщиков более чем на 50 федеральных и региональных электронных площадках;</li>
		<li class="gov-order__item">принимаем участие во всех типах конкурсных процедур</li>
	</ul>
	<p class="gov-order__p">
		 Компания ДЭФО имеет 20-летний опыт работы в сфере государственных закупок - ответственный партнер и надежный поставщик:
	</p>
	<ul class="gov-order__list">
		<li class="gov-order__item">более трехсот исполненных государственных контрактов только за 2017 год;</li>
		<li class="gov-order__item">более тысячи успешно исполненных контрактов за последние три года по государственным и коммерческим тендерным процедурам;</li>
		<li class="gov-order__item">оказывает активную помощь клиентам в подготовке технических заданий определенной номенклатуры товара, для их последующего включения в конкурсную документацию </li>
	</ul>
	<p class="gov-order__p">
		 В ассортименте ДЭФО представлен широкий выбор мебели собственного производства, а также ведущих зарубежных и российских производителей:
	</p>
	<ul class="gov-order__list">
		<li class="gov-order__item">мебель для персонала;</li>
		<li class="gov-order__item">кабинеты для руководителей различного класса;</li>
		<li class="gov-order__item">мебель для приемных зон, зон коммуникации, зон приема пищи;</li>
		<li class="gov-order__item">кресла для залов;</li>
		<li class="gov-order__item">кресла и стулья;</li>
		<li class="gov-order__item">офисная мягкая мебель;</li>
		<li class="gov-order__item">офисные перегородки;</li>
		<li class="gov-order__item">гостиничная мебель;</li>
		<li class="gov-order__item">офисный свет.</li>
	</ul>
	<h2 class="gov-order__h2">Преимущества тендерной работы с ДЭФО:</h2>
	<p class="gov-order__advantages_item">
 <span class="gov-order__span">Профессиональная компетентность - многолетний опыт работы в сфере государственных закупок, знания всех требований и нормативов федеральных законов N-44 и N-223.</span>
	</p>
	<p class="gov-order__advantages_item">
 <span class="gov-order__span">Минимальные сроки выполнения заказа и осуществления поставки товара. </span>
	</p>
 <br>
	<p class="gov-order__advantages_item">
 <span class="gov-order__span">Персональный специалист по тендерному обслуживанию, в ходе сотрудничества по проекту обеспечивает высокий уровень сервиса и постоянный контроль над выполнением задач.</span>
	</p>
	<p class="gov-order__advantages_item">
 <span class="gov-order__span">Конструктивное решение задач - ассортимент не ограничен готовыми решениями, ДЭФО предлагает индивидуальный дизайн-проект для оборудования рабочего пространства любой сложности.</span>
	</p>
	<p class="gov-order__advantages_item">
 <span class="gov-order__span">Полное сопровождение и комплекс услуг: тест-драйв рабочего места перед покупкой, подготовка документации, дизайн-проект, доставка и профессиональная сборка, послегарантийное обслуживание.</span>
	</p>
	<? if (CModule::IncludeModule("iblock")):
		$dbCityList = CIBlockElement::GetList(
			Array(),
			Array("IBLOCK_ID" => 21, "ACTIVE" => "Y"),
			false,
			false,
			Array("IBLOCK_ID", "ID", "CODE", "PROPERTY_GOV_ORDER")
		);
		while($arCity = $dbCityList->GetNext()){
			if($_SESSION["city_code"] == $arCity['CODE']) {
				echo htmlspecialcharsBack($arCity["PROPERTY_GOV_ORDER_VALUE"]["TEXT"]);
			}
		}
	endif;?>
 </section>
</div>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>