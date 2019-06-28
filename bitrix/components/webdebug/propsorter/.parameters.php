<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

// Info blocks
$arIBlockTypes = array();
$arIBlocks = array();
if (CModule::IncludeModule('iblock')) {
	$arIBlockTypes = CIBlockParameters::GetIBlockTypes(array('-'=>' '));
	$resIBlock = CIBlock::GetList(array('SORT'=>'ASC'), array('SITE_ID'=>$_REQUEST['site'], 'TYPE' => ($arCurrentValues['IBLOCK_TYPE']!='-'?$arCurrentValues['IBLOCK_TYPE']:'')));
	while($arIBlock = $resIBlock->GetNext(false,false)) {
		$arIBlocks[$arIBlock['ID']] = '['.$arIBlock['ID'].'] '.$arIBlock['NAME'];
	}
}

$arComponentParameters = array(
	'GROUPS' => array(
	),
	'PARAMETERS' => array(
		'IBLOCK_TYPE' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage('WDU_PROPSORTER_COMPONENT_IBLOCK_TYPE'),
			'TYPE' => 'LIST',
			'VALUES' => $arIBlockTypes,
			'DEFAULT' => '',
			'REFRESH' => 'Y',
		),
		'IBLOCK_ID' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage('WDU_PROPSORTER_COMPONENT_IBLOCK_ID'),
			'TYPE' => 'LIST',
			'VALUES' => $arIBlocks,
			'DEFAULT' => '',
			'ADDITIONAL_VALUES' => 'Y',
		),
		'PROPERTIES' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage('WDU_PROPSORTER_COMPONENT_PROPERTIES'),
			'TYPE' => 'LIST',
			'VALUES' => array(),
			'MULTIPLE' => 'Y',
			'SIZE' => '3',
			'ADDITIONAL_VALUES' => 'Y',
		),
		'EXCLUDE_PROPERTIES' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage('WDU_PROPSORTER_COMPONENT_EXCLUDE_PROPERTIES'),
			'TYPE' => 'LIST',
			'VALUES' => array(),
			'MULTIPLE' => 'Y',
			'SIZE' => '3',
			'ADDITIONAL_VALUES' => 'Y',
		),
		'WARNING_IF_EMPTY' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage('WDU_PROPSORTER_COMPONENT_WARNING_IF_EMPTY'),
			'TYPE' => 'CHECKBOX',
		),
		'WARNING_IF_EMPTY_TEXT' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage('WDU_PROPSORTER_COMPONENT_WARNING_IF_EMPTY_TEXT'),
			'TYPE' => 'TEXT',
		),
		'NOGROUP_SHOW' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage('WDU_PROPSORTER_COMPONENT_NOGROUP_SHOW'),
			'TYPE' => 'CHECKBOX',
			'DEFAULT' => 'Y',
		),
		'NOGROUP_NAME' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage('WDU_PROPSORTER_COMPONENT_NOGROUP_NAME'),
			'TYPE' => 'TEXT',
		),
		'MULTIPLE_SEPARATOR' => array(
			'PARENT' => 'BASE',
			'NAME' => GetMessage('WDU_PROPSORTER_COMPONENT_MULTIPLE_SEPARATOR'),
			'TYPE' => 'TEXT',
			'DEFAULT' => ', ',
		),
	),
);
?>