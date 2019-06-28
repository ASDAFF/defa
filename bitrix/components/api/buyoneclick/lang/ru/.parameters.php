<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();


$MESS['ABOC_INC_MODULE_ERROR']         = 'Модуль "TS Купить в 1 клик" не установлен';
$MESS['ABOC_INC_IBLOCK_MODULE_ERROR']  = 'Модуль "Информационные блоки" не установлен';
$MESS['ABOC_INC_SALE_MODULE_ERROR']    = 'Модуль "Интернет-магазин" не установлен';
$MESS['ABOC_INC_CATALOG_MODULE_ERROR'] = 'Модуль "Торговый каталог" не установлен';
$MESS['ABOC_EMPTY_OPTION']             = '-- Выбрать --';


//---------- PARAMETERS ----------//


//Источник данных
$MESS['ABOC_PARAM_GROUP_SOURCE'] = 'Источник данных';
$MESS['ABOC_PARAM_IBLOCK_TYPE']  = 'Тип инфоблока';
$MESS['ABOC_PARAM_IBLOCK_ID']    = 'Инфоблок';
$MESS['ABOC_PARAM_IBLOCK_FIELD'] = 'Поля инфоблока';


//Основные параметры
$MESS['ABOC_PARAM_GROUP_BASE']               = 'Основные параметры';
$MESS['ABOC_PARAM_USE_JQUERY']               = 'Включить jQuery';
$MESS['ABOC_PARAM_USE_JQUERY_TIP']           = 'Включайте только если не всплывает форма или вообще не подключен в шаблоне сайта jQuery';
$MESS['ABOC_PARAM_PAY_SYSTEM']               = 'Платежная система по умолчанию';
$MESS['ABOC_PARAM_DELIVERY_SERVICE']         = 'Служба доставки по умолчанию';
$MESS['ABOC_PARAM_BIND_USER']                = 'Привязать заказ к авторизованному пользователю';
$MESS['ABOC_PARAM_SHOW_COMMENT']             = 'Выводить поле комментарий';
$MESS['ABOC_PARAM_SHOW_QUANTITY']            = 'Выводить счетчик количества';
$MESS['ABOC_PARAM_LOCATION_ID']              = 'Местоположение по умолчанию';
$MESS['ABOC_PARAM_REDIRECT_PAGE']            = 'Редирект на указанную страницу';
$MESS['ABOC_PARAM_PERSON_TYPE']              = 'Тип плательщика';
$MESS['ABOC_PARAM_SHOW_FIELDS']              = 'Выводить поля';
$MESS['ABOC_PARAM_REQ_FIELDS']               = 'Обязательные поля';
$MESS['ABOC_PARAM_MESS_ERROR_FIELD']         = 'Текст ошибки в поле';
$MESS['ABOC_PARAM_MESS_ERROR_FIELD_DEFAULT'] = '#FIELD# обязательное';


//Модальное окно
$MESS['ABOC_PARAM_GROUP_MODAL']               = 'Модальное окно';
$MESS['ABOC_PARAM_MODAL_HEADER']              = 'Заголовок окна';
$MESS['ABOC_PARAM_MODAL_HEADER_DEFAULT']      = 'ЗАКАЗ В 1 КЛИК';
$MESS['ABOC_PARAM_MODAL_TEXT_BEFORE']         = 'Текст над формой';
$MESS['ABOC_PARAMMODAL_TEXT_BEFORE_DEFAULT']  = 'Оставьте пожалуйста свои контактные данные.
Наши менеджеры свяжутся с вами для уточнения деталей заказа.';
$MESS['ABOC_PARAM_MODAL_TEXT_AFTER']          = 'Текст под формой';
$MESS['ABOC_PARAM_MODAL_TEXT_AFTER_DEFAULT']  = 'Нажатием кнопки «Оформить заказ» я даю свое согласие на обработку персональных данных в соответствии с указанными <a href="#">здесь</a> условиями.';
$MESS['ABOC_PARAM_MODAL_FOOTER']              = 'Текст подвала окна';
$MESS['ABOC_PARAM_MODAL_FOOTER_DEFAULT']      = '';
$MESS['ABOC_PARAM_MODAL_TEXT_BUTTON']         = 'Текст кнопки';
$MESS['ABOC_PARAM_MODAL_TEXT_BUTTON_DEFAULT'] = 'Оформить заказ';


//Сообщение
$MESS['ABOC_PARAM_GROUP_SUCCESS']              = 'Сообщение';
$MESS['ABOC_PARAM_MESS_SUCCESS_TITLE']         = 'Сообщение о принятом заказе';
$MESS['ABOC_PARAM_MESS_SUCCESS_TITLE_DEFAULT'] = 'Спасибо! Ваш заказ принят!';
$MESS['ABOC_PARAM_MESS_SUCCESS_INFO']          = 'Дополнительная информация';
$MESS['ABOC_PARAM_MESS_SUCCESS_INFO_DEFAULT']  = 'Заказ №#ORDER_ID# от #ORDER_DATE#

Ваш заказ принят для исполнения.
Ожидайте звонка оператора, в ближайшее время он свяжется с Вами для уточнения даты доставки и необходимых деталей.

Если заказ оформлен в ночное время, оператор свяжется с Вами после 9-00.';


//--------- TIP ---------//
$MESS['IBLOCK_FIELD_TIP']  = 'Выбранные поля элемента будут доступны в шаблоне, а также можно вывести в форме изображение товара и описание';
$MESS['LOCATION_ID_TIP']   = 'ID местоположения по умолчанию, узнать нужный Вам ID можете в админке в списке местоположений';
$MESS['REDIRECT_PAGE_TIP'] = 'Например: /order/success.php<br>Например: /personal/order/make/';
$MESS['BIND_USER_TIP']     = 'Если пользователь вошел на сайт (авторизовался), то можно к нему привязать заказ, иначе заказ привяжется к пользователю модуля buyOneClick';