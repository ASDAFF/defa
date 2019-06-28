<?php
use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

Asset::getInstance()->addCss("/css/slick.css");
Asset::getInstance()->addCss("/css/design-project.css");
Asset::getInstance()->addJs("/js/slick.min.js");

$APPLICATION->SetTitle("Заказать дизайн-проект");?>

<?if(in_array($_SESSION['city_code'], array('sankt-peterburg', 'moskva')) or in_array($_SESSION['GEOIP']['cityName'], array('Санкт-Петербург', 'Москва'))):?>

<div class="design__banner">
	<div class="design_banner__mobile">
		<img src="/images/design-project/design-mobile.png" alt="design project" class="design_banner_mobile__img">
	</div>
	<h1 class="design__title_h1"><span class="design__red">БЕСПЛАТНЫЙ</span> ДИЗАЙН-ПРОЕКТ </br> ВАШЕГО ОФИСА</h1>
	<p class="design_banner__description">Не можете определиться с интерьером Вашего офиса?<br>
	Оставьте заявку, и мы все спланируем за Вас!</p>
	
	<?$APPLICATION->IncludeComponent(
	"api:main.feedback", 
	".default", 
	array(
		"ANCHOR" => "designproject",
		"ECOMMERCE_GOAL" => "dataLayer.push({'event': 'request_of_design', 'eventCategory': 'RequestDesign', 'eventAction':'Page'});",
		"USE_CAPTCHA" => "N",
		"USE_HIDDEN_PROTECTION" => "N",
		"REPLACE_FIELD_FROM" => "Y",
		"UNIQUE_FORM_ID" => "design_project",
		"OK_TEXT" => "Ваша заявка принята, в ближайшее время с вами свяжется наш менеджер.<script type='text/javascript'>function fcl() {\$('.fancybox-close').trigger('click');}function st() {setTimeout(fcl, 3000);}\$(document).ready(st);</script>",
		"EMAIL_TO" => "ishop@defo.ru",
		"EMAIL_TO_MOSCOW_OVERRIDE" => "lrn@defo.ru, voa@defo.ru",
		"DISPLAY_FIELDS" => array(
			0 => "AUTHOR_FIO",
			1 => "AUTHOR_EMAIL",
			2 => "AUTHOR_PERSONAL_MOBILE",
			3 => "AUTHOR_CITY",
			4 => "AUTHOR_MESSAGE",
		),
		"REQUIRED_FIELDS" => array(
			0 => "AUTHOR_FIO",
			1 => "AUTHOR_PERSONAL_MOBILE",
			2 => "AUTHOR_CITY",
		),
		"AUTHOR_CITY_IS_LIST" => "Y",
		"CUSTOM_FIELDS" => array(
		),
		"ADMIN_EVENT_MESSAGE_ID" => array(
		),
		"USER_EVENT_MESSAGE_ID" => array(
		),
		"TITLE_DISPLAY" => "N",
		"FORM_DESC" => "Укажите свои контактные данные, и менеджер интернет-магазина перезвонит Вам в ближайшее время",
		"FORM_TITLE" => "Бесплатный дизайн-проект",
		"FORM_TITLE_LEVEL" => "1",
		"FORM_STYLE_TITLE" => "margin-top: 0; font-weight: normal; font-size: 20px; padding-top: 0; color: #000;",
		"FORM_STYLE" => "text-align:left;",
		"FORM_STYLE_DIV" => "overflow:hidden; padding: 8px 0;",
		"FORM_STYLE_LABEL" => "display: block;min-width:160px;margin-bottom: 3px;float:left;",
		"FORM_STYLE_TEXTAREA" => "border: 2px dotted #ccc; width: 100%; padding:4px 6px 4px 32px; min-height: 128px; box-sizing: border-box; font-size: 13px;",
		"FORM_STYLE_INPUT" => "border: 2px dotted #ccc; width: 100%; padding: 4px 6px 4px 32px; box-sizing: border-box; font-size: 13px;",
		"FORM_STYLE_SELECT" => "min-width:232px;padding:3px 5px;",
		"FORM_STYLE_SUBMIT" => "margin: 12px; padding: 0 48px; background: #bc0000; border: none; color: #fff; font-size: 12px; height: 33px; line-height: 33px; cursor: pointer;",
		"FORM_SUBMIT_VALUE" => "Заказать",
		"INCLUDE_JQUERY" => "N",
		"VALIDTE_REQUIRED_FIELDS" => "N",
		"INCLUDE_PLACEHOLDER" => "Y",
		"INCLUDE_PRETTY_COMMENTS" => "N",
		"INCLUDE_FORM_STYLER" => "N",
		"HIDE_FORM_AFTER_SEND" => "Y",
		"SCROLL_TO_FORM_IF_MESSAGES" => "N",
		"SCROLL_TO_FORM_SPEED" => "1000",
		"BRANCH_ACTIVE" => "N",
		"SHOW_FILES" => "N",
		"USER_AUTHOR_FIO" => "",
		"USER_AUTHOR_NAME" => "",
		"USER_AUTHOR_LAST_NAME" => "",
		"USER_AUTHOR_SECOND_NAME" => "",
		"USER_AUTHOR_EMAIL" => "",
		"USER_AUTHOR_PERSONAL_MOBILE" => "",
		"USER_AUTHOR_WORK_COMPANY" => "",
		"USER_AUTHOR_POSITION" => "",
		"USER_AUTHOR_PROFESSION" => "",
		"USER_AUTHOR_STATE" => "",
		"USER_AUTHOR_CITY" => "",
		"USER_AUTHOR_STREET" => "",
		"USER_AUTHOR_ADRESS" => "",
		"USER_AUTHOR_PERSONAL_PHONE" => "",
		"USER_AUTHOR_WORK_PHONE" => "",
		"USER_AUTHOR_FAX" => "",
		"USER_AUTHOR_MAILBOX" => "",
		"USER_AUTHOR_WORK_MAILBOX" => "",
		"USER_AUTHOR_SKYPE" => "",
		"USER_AUTHOR_SQUARE" => "",
		"USER_AUTHOR_PLACES" => "",
		"USER_AUTHOR_ICQ" => "",
		"USER_AUTHOR_WWW" => "",
		"USER_AUTHOR_WORK_WWW" => "",
		"USER_AUTHOR_MESSAGE_THEME" => "",
		"USER_AUTHOR_MESSAGE" => "",
		"USER_AUTHOR_NOTES" => "",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"SHOW_CSS_MODAL_AFTER_SEND" => "N",
		"CSS_MODAL_HEADER" => "Информация",
		"CSS_MODAL_FOOTER" => "<a id=\"bxid_626505\" >Разработка модуля</a> - Тюнинг Софт",
		"CSS_MODAL_CONTENT" => "<p>Модуль <b>расширенная форма обратной связи битрикс с вложением</b> предназначен для отправки сообщений с сайта, включая код CAPTCHA и скрытую защиту от спама, и отличается от стандартной формы Битрикс:
<br> - <b>отправкой файлов вложениями или ссылками на файл</b>,
<br> - <b>встроенным конструктором форм,</b>
<br> - скрытой защитой от спама,
<br> - работой нескольких форм на одной странице,
<br> - встроенным фирменным валидатором форм,
<br> - 4 встроенными WEB 2.0 шаблонами,
<br> - дополнительными полями со своим именованием,
<br> - и многими другими функциями...
<br>подробнее читайте на странице модуля <a id=\"bxid_164623\" >Расширенная форма обратной связи</a>
</p>",
		"AJAX_OPTION_ADDITIONAL" => "",
		"IBLOCK_TYPE" => "aspro_priority_form",
		"IBLOCK_ID" => "61",
		"INSTALL_IBLOCK" => "Y",
		"COMPONENT_TEMPLATE" => ".default",
		"IBLOCK_ELEMENT_ACTIVE" => "Y",
		"DISABLE_SEND_MAIL" => "N",
		"OK_TEXT_AFTER" => "Мы свяжемся с Вами в самое ближайшее время.",
		"BCC" => "",
		"REDIRECT_PAGE" => "",
		"WRITE_ONLY_FILLED_VALUES" => "Y",
		"WRITE_MESS_DIV_STYLE" => "padding:10px;border-bottom:1px dashed #dadada;",
		"WRITE_MESS_DIV_STYLE_NAME" => "font-weight:bold;",
		"WRITE_MESS_DIV_STYLE_VALUE" => "",
		"WRITE_MESS_FILDES_TABLE" => "N",
		"WRITE_MESS_TABLE_STYLE" => "font-family: Open Sans,Tahoma,Arial,sans-serif; font-size: 13px; border-collapse:collapse; border-spacing:0;",
		"WRITE_MESS_TABLE_STYLE_NAME" => "border: 1px solid #e0e0e0; border-left-color:#fff; padding: 5px 30px 5px 0px; vertical-align: middle;",
		"WRITE_MESS_TABLE_STYLE_VALUE" => "border: 1px solid #e0e0e0; border-right-color:#fff; padding: 5px 30px 5px 10px; vertical-align: middle;",
		"FORM_CLASS" => "",
		"FIELD_ERROR_MESS" => "#FIELD_NAME# обязательное",
		"EMAIL_ERROR_MESS" => "Указанный E-mail некорректен",
		"DEFAULT_OPTION_TEXT" => "-- Выбрать --",
		"FORM_SUBMIT_CLASS" => "uk-button",
		"FORM_SUBMIT_STYLE" => "",
		"BUTTON_TEXT_BEFORE" => "",
		"FORM_TEXT_BEFORE" => "",
		"FORM_TEXT_AFTER" => "",
		"HIDE_FIELD_NAME" => "N",
		"HIDE_ASTERISK" => "N",
		"FORM_AUTOCOMPLETE" => "Y",
		"FIELD_BOX_SHADOW_ACTIVE" => "",
		"FIELD_BORDER_ACTIVE" => "",
		"FIELD_SIZE" => "default",
		"FIELD_NAME_POSITION" => "horizontal",
		"FORM_LABEL_TEXT_ALIGN" => "left",
		"FORM_LABEL_WIDTH" => "150",
		"FORM_FIELD_WIDTH" => "",
		"TEMPLATE_STYLE" => "uikit",
		"INCLUDE_CHOSEN" => "N",
		"INCLUDE_INPUTMASK" => "N",
		"INCLUDE_AUTOSIZE" => "N",
		"INCLUDE_VALIDATION" => "N",
		"INCLUDE_ICHECK" => "N",
		"INCLUDE_TOOLTIPSTER" => "N",
		"UUID_LENGTH" => "10",
		"UUID_PREFIX" => "",
		"USE_YM_GOALS" => "N",
		"USER_AUTHOR_WORK_CITY" => "",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"INCLUDE_CSSMODAL" => "N",
		"MODAL_WIDTH" => "",
		"MODAL_BUTTON_CLASS" => "uk-button uk-button-danger",
		"MODAL_BUTTON_HTML" => "Обратная связь",
		"MODAL_HEADER_HTML" => "Обратная связь",
		"MODAL_FOOTER_HTML" => "&copy; Форма обратной связи +",
		"SUBJECT" => "",
		"PAGE_TITLE" => "",
		"PAGE_URI" => "",
		"PAGE_URL" => "",
		"DIR_URL" => "",
		"DATETIME" => "",
		"USE_AGREEMENT" => "N",
		"SERVER_VARS" => array(
			0 => "",
			1 => "",
		),
		"REQUEST_VARS" => array(
			0 => "",
			1 => "",
		)
	),
	false
);?>
	<?/*<a href="javascript:void(0);" class="design_make_order__link">Заказать дизайн-проект</a>*/?>
	<p class="design_banner__additional">Работаем от любых площадей</p>
</div>
<div class="design__scheme_work">
	<h2 class="design__title">Как это работает</h2>
	<?/*<div class="scheme_work__description">Дизайнеры ДЭФО создадут модель Вашего будущего офиса, подберут и расcчитают
	стоимость мебели в различных вариантах бюджета. Процесс создания бесплатного дизайна-проекта включает следующие этапы:</div>*/?>
	<div class="scheme_work__list">
		<div class="scheme_work_list__item icon1">
			<span class="scheme_work_item__description">1. Вы оставляете заявку</span>
		</div>
		<div class="scheme_work_list__item icon2">
			<span class="scheme_work_item__description">2. Специалист выезжает в офис и производит все необходимые</br> замеры</span>
		</div>
		<div class="scheme_work_list__item icon3">
			<span class="scheme_work_item__description">3. В течение 3 дней мы создаем</br> 2D-концепт и 3D-проект</span>
		</div>
		<div class="scheme_work_list__item icon4">
			<span class="scheme_work_item__description">4. Проводим ремонт и подбираем мебель по вашему</br> вкусу и бюджету</span>
		</div>
	</div>
</div>
<? $dbProjects = CIBlockElement::GetList(
	array(),
	array('IBLOCK_ID' => 50, 'ACTIVE' => 'Y'),
	false,
	false,
	array('IBLOCK_ID', 'ID')
);
while ($arProjects = $dbProjects->GetNextElement()) {
	$props = $arProjects->GetProperties();
	foreach ($props['PHOTO_DESIGN_PROJECT']['VALUE'] as $itemPhoto) {
		$file = CFile::GetByID($itemPhoto);
		$props['PHOTO_DESIGN_PROJECT_FILES'][] = $file->Fetch();
	}
	$projects[] = $props;
}
?>
<div class="design__portfolio">
	<h3 class="design__title">Примеры реализованных проектов</h3>
	<div class="portfolio_list">
		<? $countProject = 0; foreach ($projects as $project) : ?>
		<div class="portfolio__item"><? $countProject++;?>
			<div class="portfolio__characteristics">
				<?foreach ($project['ADVANTAGES_DESIGN_PROJECT']['VALUE'] as $projectAdvantages) :?>
					<div class="characteristic__item" style="width: <?= 100 / (count($projectAdvantages)-1)?>%;">
						<div class="caracteristic__text">
							<p class="characteristic__name"><?= $projectAdvantages['ADVANTAGES_DP_TITLE']?></p>
						<?for ($count = 1; count($projectAdvantages)-1 > $count; $count++) :?>
							<?if( !empty($projectAdvantages['ADVANTAGES_DP_'.$count]) ):?>
							<p class="characteristic__description">- <?= $projectAdvantages['ADVANTAGES_DP_'.$count]?></p>
							<?endif;?>
						<?endfor;?>
						</div>
					</div>
				<?endforeach;?>
			</div>
			<div class="portfolio__big_image big_image<?=$countProject;?>">
			<?foreach ($project['PHOTO_DESIGN_PROJECT_FILES'] as $itemPhoto) :?>
				<div class="portfolio_big_image__slide">
					<img src="/upload/<?= $itemPhoto['SUBDIR']?>/<?= $itemPhoto['FILE_NAME']?>" alt="<?= $project['NAME']. ' ' . $itemPhoto['DESCRIPTION']?>" class="portfolio_big_image__img">
					<?if(!empty($itemPhoto['DESCRIPTION'])):?>
					<span class="portfolio_big_image__name"><?= $itemPhoto['DESCRIPTION']?></span>
					<?endif;?>
				</div>
			<?endforeach;?>
			</div>
			<div class="portfolio__list_thumbnails list_thumbnails<?=$countProject;?>">
				<?foreach ($project['PHOTO_DESIGN_PROJECT_FILES'] as $itemPhoto) :?>
					<div class="portfolio_thumbnails__item">
						<img src="/upload/<?= $itemPhoto['SUBDIR']?>/<?= $itemPhoto['FILE_NAME']?>" alt="<?= $project['NAME']. ' ' . $itemPhoto['DESCRIPTION']?>">
						<?if(!empty($itemPhoto['DESCRIPTION'])):?>
						<span class="portfolio_thumbnails__name"><?= $itemPhoto['DESCRIPTION']?></span>
						<?endif;?>
					</div>
				<?endforeach;?>
			</div>
		</div>
		<?endforeach;?>
	</div>
	<script type="text/javascript">

		count = '<?=count($projects)?>';
		$(document).ready(function () {
			checkWidth();

			function checkWidth() {
				if($(window).width() > 991){
					$('.portfolio_list').slick({
						infinite: true,
						speed: 300,
						slidesToShow: 1,
						adaptiveHeight: true
					});
				} else {
					//$('.portfolio_list').destroySlider();
				}
			}
			$(window).on('resize', function () {
				checkWidth();
				$(window).on('resize', function () {
					checkWidth();
				})
			});


			//console.log(count);
			for (var i=count; i > 0; i--){
				$('.big_image'+i).slick({
					slidesToShow: 1,
					slidesToScroll: 1,
					arrows: false,
					dots: true,
					fade: true,
					asNavFor: '.list_thumbnails'+i
				});
				$('.list_thumbnails'+i).slick({
					slidesToShow: 5,
					slidesToScroll: 1,
					asNavFor: '.big_image'+i,
					focusOnSelect: true
				});
			}

			$('.page').addClass('mobile');
		})
	</script>
</div>
<div class="main__logos main__logos_bg">
	<div class="main_logos__content">
		<h3 class="design__title">
			Наши партнеры
		</h3>
		<?$APPLICATION->IncludeComponent(
			"defo:sections.list",
			"partners",
			array(
				"IBLOCK_ID" => "51",
				"IBLOCK_TYPE" => "product_list",
				"COMPONENT_TEMPLATE" => "partners",
				"PROPERTY_CODE" => array(
					0 => "LINK_PARTNER",
					1 => "LOGO_PARTNER",
					2 => "",
				)
			),
			false
		);?>
	</div>
</div>
<div class="design__banner_bottom" style="background: url(/images/design-project/banner-bottom.jpg) no-repeat center top;">
	<h3 class="design__title">Остались вопросы?<br>Звоните!</h3>
	<div class="banner_bottom__description">
		<?if($_SESSION['city_code'] == 'sankt-peterburg'):?>
		<a href="tel:88007700120" class="banner_bottom__link_tel">8(800) 770 01 20</a>
		<?elseif($_SESSION['city_code'] == 'moskva'):?>
		<a href="tel:88005054579" class="banner_bottom__link_tel">8 (800) 505 45 79</a>
		<?endif;?>
		<span class="banner_bottom__span">Бесплатный звонок по РФ</span>
	</div>
	<a href="javascript:void(0);" class="design_make_order__link">Заказать дизайн-проект</a>
</div>

<?else:?>
	<?LocalRedirect("/404.php", "404 Not Found");?>
<?endif;?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>