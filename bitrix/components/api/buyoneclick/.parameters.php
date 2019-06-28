<?

use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Config\Option;
use \Bitrix\Sale\Location\LocationTable;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/** @var array $arCurrentValues */

Loc::loadMessages(__FILE__);

if(!Loader::includeModule('api.buyoneclick')) {
	ShowError(Loc::getMessage('ABOC_INC_MODULE_ERROR'));
	return false;
}

if(!Loader::includeModule('iblock')) {
	ShowError(Loc::getMessage('ABOC_INC_IBLOCK_MODULE_ERROR'));
	return false;
}

if(!Loader::includeModule('sale')) {
	ShowError(Loc::getMessage('ABOC_INC_SALE_MODULE_ERROR'));
	return false;
}

if(!Loader::includeModule('catalog')) {
	ShowError(Loc::getMessage('ABOC_INC_CATALOG_MODULE_ERROR'));
	return false;
}


//---------- Группы параметров стандартные ----------//
//BASE                  (сортировка 100). Основные параметры.
//DATA_SOURCE           (сортировка 200). Тип и ID инфоблока.
//VISUAL                (сортировка 300). Внешний вид.
//URL_TEMPLATES         (сортировка 400). Шаблоны ссылок
//SEF_MODE              (сортировка 500). ЧПУ.
//AJAX_SETTINGS         (сортировка 550). AJAX.
//CACHE_SETTINGS        (сортировка 600). Кэширование.
//ADDITIONAL_SETTINGS   (сортировка 700). Доп. настройки.
//COMPOSITE_SETTINGS    (сортировка 800). Композитный сайт


//---------- Типы инфоблоков ----------//
$arIblockTypes = CIBlockParameters::GetIBlockTypes(array('-' => Loc::getMessage('ABOC_EMPTY_OPTION')));


//---------- Инфоблоки ----------//
$arIblocks = array();
if($arCurrentValues['IBLOCK_TYPE']) {
	$rsIblocks = Bitrix\Iblock\IblockTable::getList(array(
		 'order'  => array('SORT' => 'ASC', 'NAME' => 'ASC'),
		 'filter' => array("=IBLOCK_TYPE_ID" => $arCurrentValues['IBLOCK_TYPE'], 'ACTIVE' => 'Y'),
		 'select' => array('ID', 'NAME'),
	));
	while($row = $rsIblocks->fetch())
		$arIblocks[ $row["ID"] ] = "[" . $row["ID"] . "] " . $row["NAME"];
}


//---------- Платежные системы ----------//
$arPaySystems = array('-' => Loc::getMessage('ABOC_EMPTY_OPTION'));
$rsPaySystems = Bitrix\Sale\Internals\PaySystemActionTable::getList(array(
	 'order'  => array('SORT' => 'ASC', 'NAME' => 'ASC'),
	 'filter' => array('ACTIVE' => 'Y'),
	 'select' => array('ID', 'NAME'),
));
while($row = $rsPaySystems->fetch())
	$arPaySystems[ $row['ID'] ] = '[' . $row['ID'] . '] ' . $row['NAME'];


//---------- Службы доставки ----------//
$arDeliveryServices = array('-' => Loc::getMessage('ABOC_EMPTY_OPTION'));
$rsDeliveryServices = Bitrix\Sale\Internals\DeliveryServiceTable::getList(array(
	 'order'  => array('SORT' => 'ASC', 'NAME' => 'ASC'),
	 'filter' => array('ACTIVE' => 'Y'),
	 'select' => array('ID', 'NAME'),
));
while($row = $rsDeliveryServices->fetch())
	$arDeliveryServices[ $row['ID'] ] = '[' . $row['ID'] . '] ' . $row['NAME'];


//---------- Типы плательщика ----------//
$arPersonTypes = array('-' => Loc::getMessage('ABOC_EMPTY_OPTION'));
$rsPersonType  = Bitrix\Sale\Internals\PersonTypeTable::getList(array(
	 'filter' => array('ACTIVE' => 'Y'),
));
while($row = $rsPersonType->fetch())
	$arPersonTypes[ $row['ID'] ] = '[' . $row['ID'] . '] ' . $row['NAME'];


//---------- Местоположение по умолчанию ----------//
$locationId   = '';
$saleLocation = Option::get('sale', 'location', '0000073738');
if(strlen($saleLocation) > 0) {
	$rsLocation = LocationTable::getList(array(
		 'select' => array('*', 'CITY_NAME' => 'NAME.NAME'),
		 'filter' => array(
				'=NAME.LANGUAGE_ID' => LANGUAGE_ID,
				//'%NAME.NAME'        => 'Moscow',
				'=CODE'             => $saleLocation,
				'!CITY_ID'          => false,
		 ),
		 'limit'  => 1,
	));
	if($arLocation = $rsLocation->fetch())
		$locationId = $arLocation['CITY_ID'];
}



//---------- PARAMETERS ----------//
$arComponentParameters = array(
	 'GROUPS' => array(
			'GROUP_SOURCE'  => array(
				 'NAME' => Loc::getMessage('ABOC_PARAM_GROUP_SOURCE'),
				 'SORT' => 100,
			),
			'GROUP_BASE'    => array(
				 'NAME' => Loc::getMessage('ABOC_PARAM_GROUP_BASE'),
				 'SORT' => 110,
			),
			'GROUP_MODAL'   => array(
				 'NAME' => Loc::getMessage('ABOC_PARAM_GROUP_MODAL'),
				 'SORT' => 120,
			),
			'GROUP_SUCCESS' => array(
				 'NAME' => Loc::getMessage('ABOC_PARAM_GROUP_SUCCESS'),
				 'SORT' => 130,
			),
	 ),

	 'PARAMETERS' => array(

		 //Источник данных
		 'IBLOCK_TYPE'        => array(
				'PARENT'  => 'GROUP_SOURCE',
				'NAME'    => Loc::getMessage('ABOC_PARAM_IBLOCK_TYPE'),
				'TYPE'    => 'LIST',
				'VALUES'  => $arIblockTypes,
				'REFRESH' => 'Y',
		 ),
		 'IBLOCK_ID'          => array(
				'PARENT'            => 'GROUP_SOURCE',
				'NAME'              => Loc::getMessage('ABOC_PARAM_IBLOCK_ID'),
				'TYPE'              => 'LIST',
				'ADDITIONAL_VALUES' => 'Y',
				'VALUES'            => $arIblocks,
				'REFRESH'           => 'Y',
		 ),
		 'IBLOCK_FIELD' => CIBlockParameters::GetFieldCode(Loc::getMessage('ABOC_PARAM_IBLOCK_FIELD'), 'GROUP_SOURCE'),

		 //Основные параметры
		 'USE_JQUERY'         => array(
				'PARENT'  => 'GROUP_BASE',
				'NAME'    => Loc::getMessage('ABOC_PARAM_USE_JQUERY'),
				'TYPE'    => 'CHECKBOX',
				'DEFAULT' => 'N',
		 ),
		 'PAY_SYSTEM'         => array(
				'PARENT' => 'GROUP_BASE',
				'NAME'   => Loc::getMessage('ABOC_PARAM_PAY_SYSTEM'),
				'TYPE'   => 'LIST',
				'VALUES' => $arPaySystems,
		 ),
		 'DELIVERY_SERVICE'   => array(
				'PARENT' => 'GROUP_BASE',
				'NAME'   => Loc::getMessage('ABOC_PARAM_DELIVERY_SERVICE'),
				'TYPE'   => 'LIST',
				'VALUES' => $arDeliveryServices,
		 ),
		 'LOCATION_ID'        => array(
				'PARENT'  => 'GROUP_BASE',
				'NAME'    => Loc::getMessage('ABOC_PARAM_LOCATION_ID'),
				'TYPE'    => 'STRING',
				'DEFAULT' => $locationId,
		 ),
		 'REDIRECT_PAGE'      => array(
				'PARENT'  => 'GROUP_BASE',
				'NAME'    => Loc::getMessage('ABOC_PARAM_REDIRECT_PAGE'),
				'TYPE'    => 'STRING',
				'DEFAULT' => '',
		 ),
		 'MESS_ERROR_FIELD'   => array(
				'PARENT'  => 'GROUP_BASE',
				'NAME'    => Loc::getMessage('ABOC_PARAM_MESS_ERROR_FIELD'),
				'TYPE'    => 'STRING',
				'DEFAULT' => Loc::getMessage('ABOC_PARAM_MESS_ERROR_FIELD_DEFAULT'),
		 ),
		 'BIND_USER'          => array(
				'PARENT' => 'GROUP_BASE',
				'NAME'   => Loc::getMessage('ABOC_PARAM_BIND_USER'),
				'TYPE'   => 'CHECKBOX',
		 ),
		 'SHOW_COMMENT'       => array(
				'PARENT'  => 'GROUP_BASE',
				'NAME'    => Loc::getMessage('ABOC_PARAM_SHOW_COMMENT'),
				'TYPE'    => 'CHECKBOX',
				'DEFAULT' => 'Y',
		 ),
		 'SHOW_QUANTITY'      => array(
				'PARENT'  => 'GROUP_BASE',
				'NAME'    => Loc::getMessage('ABOC_PARAM_SHOW_QUANTITY'),
				'TYPE'    => 'CHECKBOX',
				'DEFAULT' => 'Y',
		 ),
		 'PERSON_TYPE'        => array(
				'PARENT'  => 'GROUP_BASE',
				'NAME'    => Loc::getMessage('ABOC_PARAM_PERSON_TYPE'),
				'TYPE'    => 'LIST',
				'VALUES'  => $arPersonTypes,
				'REFRESH' => 'Y',
		 ),

		 //Модальное окно
		 'MODAL_HEADER'       => array(
				'PARENT'  => 'GROUP_MODAL',
				'NAME'    => Loc::getMessage('ABOC_PARAM_MODAL_HEADER'),
				'TYPE'    => 'STRING',
				'DEFAULT' => Loc::getMessage('ABOC_PARAM_MODAL_HEADER_DEFAULT'),
		 ),
		 'MODAL_TEXT_BEFORE'  => array(
				'PARENT'  => 'GROUP_MODAL',
				'NAME'    => Loc::getMessage('ABOC_PARAM_MODAL_TEXT_BEFORE'),
				'TYPE'    => 'STRING',
				'ROWS'    => 4,
				'COLS'    => 60,
				'DEFAULT' => Loc::getMessage('ABOC_PARAMMODAL_TEXT_BEFORE_DEFAULT'),
		 ),
		 'MODAL_TEXT_AFTER'   => array(
				'PARENT'  => 'GROUP_MODAL',
				'NAME'    => Loc::getMessage('ABOC_PARAM_MODAL_TEXT_AFTER'),
				'TYPE'    => 'STRING',
				'ROWS'    => 4,
				'COLS'    => 60,
				'DEFAULT' => Loc::getMessage('ABOC_PARAM_MODAL_TEXT_AFTER_DEFAULT'),
		 ),
		 'MODAL_FOOTER'       => array(
				'PARENT'  => 'GROUP_MODAL',
				'NAME'    => Loc::getMessage('ABOC_PARAM_MODAL_FOOTER'),
				'TYPE'    => 'STRING',
				'ROWS'    => 4,
				'COLS'    => 60,
				'DEFAULT' => Loc::getMessage('ABOC_PARAM_MODAL_FOOTER_DEFAULT'),
		 ),
		 'MODAL_TEXT_BUTTON'  => array(
				'PARENT'  => 'GROUP_MODAL',
				'NAME'    => Loc::getMessage('ABOC_PARAM_MODAL_TEXT_BUTTON'),
				'TYPE'    => 'STRING',
				'DEFAULT' => Loc::getMessage('ABOC_PARAM_MODAL_TEXT_BUTTON_DEFAULT'),
		 ),

		 //Сообщение
		 'MESS_SUCCESS_TITLE' => array(
				'PARENT'  => 'GROUP_SUCCESS',
				'NAME'    => Loc::getMessage('ABOC_PARAM_MESS_SUCCESS_TITLE'),
				'TYPE'    => 'STRING',
				'ROWS'    => 4,
				'COLS'    => 60,
				'DEFAULT' => Loc::getMessage('ABOC_PARAM_MESS_SUCCESS_TITLE_DEFAULT'),
		 ),
		 'MESS_SUCCESS_INFO'  => array(
				'PARENT'  => 'GROUP_SUCCESS',
				'NAME'    => Loc::getMessage('ABOC_PARAM_MESS_SUCCESS_INFO'),
				'TYPE'    => 'STRING',
				'ROWS'    => 4,
				'COLS'    => 60,
				'DEFAULT' => Loc::getMessage('ABOC_PARAM_MESS_SUCCESS_INFO_DEFAULT'),
		 ),
	 ),
);
CIBlockParameters::GetFieldCode('IBLOCK_FIELDS', 'VISUAL');

if($arCurrentValues['PERSON_TYPE'] > 0) {
	//Свойства заказа
	$arOrderProps = array();
	$rsOrderProps = Bitrix\Sale\Internals\OrderPropsTable::getList(array(
		 'order'  => array('SORT' => 'ASC', 'NAME' => 'ASC'),
		 'filter' => array('=ACTIVE' => 'Y', '=PERSON_TYPE_ID' => $arCurrentValues['PERSON_TYPE']),
		 'select' => array('ID', 'NAME', 'PERSON_TYPE_ID'),
	));
	while($row = $rsOrderProps->fetch())
		$arOrderProps[ $row['ID'] ] = '[' . $row['ID'] . '] ' . $row['NAME'];

	$arComponentParameters['PARAMETERS']['SHOW_FIELDS'] = array(
		 'PARENT'   => 'GROUP_BASE',
		 'NAME'     => Loc::getMessage('ABOC_PARAM_SHOW_FIELDS'),
		 'TYPE'     => 'LIST',
		 'VALUES'   => $arOrderProps,
		 'MULTIPLE' => 'Y',
		 'SIZE'     => count($arOrderProps),
	);
	$arComponentParameters['PARAMETERS']['REQ_FIELDS']  = array(
		 'PARENT'   => 'GROUP_BASE',
		 'NAME'     => Loc::getMessage('ABOC_PARAM_REQ_FIELDS'),
		 'TYPE'     => 'LIST',
		 'VALUES'   => $arOrderProps,
		 'MULTIPLE' => 'Y',
		 'SIZE'     => count($arOrderProps),
	);
}

?>
<style type="text/css">
	.bxcompprop-content-table textarea{
		-webkit-box-sizing: border-box !important; -moz-box-sizing: border-box !important; box-sizing: border-box !important;
		width: 90% !important;
		min-height: 60px !important;
	}
</style>