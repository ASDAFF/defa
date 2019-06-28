<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if (!CModule::IncludeModule('webdebug.utilities')) {
	return;
}

if (!is_array($arParams['PROPERTIES'])) {
	$arParams['PROPERTIES'] = array();
}
if (!is_array($arParams['EXCLUDE_PROPERTIES'])) {
	$arParams['EXCLUDE_PROPERTIES'] = array();
}
if (strlen($arParams['MULTIPLE_SEPARATOR'])===0) {
	$arParams['MULTIPLE_SEPARATOR'] = ', ';
}
$arParams['NOGROUP_SHOW'] = $arParams['NOGROUP_SHOW']!='N' ? true : false;

$arResult['PROPS_GROUPS'] = false;
$arResult['PROPS_GROUPS'] = CWDU_IBlockPropSorter::GetPropGroupsArray($arParams['IBLOCK_ID']);
if ($arParams['NOGROUP_SHOW']) {
	$arResult['PROPS_GROUPS_TMP'] = array(
		'_NO_GROUP_' => array(
			'NAME' => $arParams['NOGROUP_NAME'],
			'CODE' => '_NO_GROUP_',
			'SORT' => '0',
			'ACTIVE' => 'Y',
		),
	);
	foreach($arResult['PROPS_GROUPS'] as $Key => $arGroup) {
		$arResult['PROPS_GROUPS_TMP'][$Key] = $arGroup;
	}
	$arResult['PROPS_GROUPS'] = $arResult['PROPS_GROUPS_TMP'];
}

if (!empty($arResult['PROPS_GROUPS'])) {
	foreach($arParams["PROPERTIES"] as $Key => $arProp) {
		if(in_array($Key,$arParams['EXCLUDE_PROPERTIES']) || (isset($arProp['DISPLAY_VALUE']) && is_string($arProp['DISPLAY_VALUE']) && strlen($arProp['DISPLAY_VALUE'])===0) 
			|| (!isset($arProp['DISPLAY_VALUE']) && is_array($arProp['VALUE']) && empty($arProp['VALUE'])) 
			|| (!isset($arProp['DISPLAY_VALUE']) && !is_array($arProp['VALUE']) && is_string($arProp['VALUE']) && strlen($arProp['VALUE'])===0)) 
			continue;
		$PropSort = $arProp['SORT'];
		$ParentKey = CWDU_IBlockPropSorter::GetPropGroupsParentGroupKey($arResult['PROPS_GROUPS'], $arProp['SORT']);
		if ($ParentKey==false) {
			if (!$arParams['NOGROUP_SHOW']) {
				continue;
			}
			$ParentKey = '_NO_GROUP_';
		}
		if (!is_array($arResult['PROPS_GROUPS'][$ParentKey]['ITEMS'])) {
			$arResult['PROPS_GROUPS'][$ParentKey]['ITEMS'] = array();
		}
		$arProp['DISPLAY_VALUE'] = isset($arProp['DISPLAY_VALUE']) ? (is_array($arProp['DISPLAY_VALUE']) ? implode($arParams['MULTIPLE_SEPARATOR'], $arProp['DISPLAY_VALUE']) : $arProp['DISPLAY_VALUE']) : (is_array($arProp['VALUE']) ? implode($arParams['MULTIPLE_SEPARATOR'], $arProp['VALUE']) : $arProp['VALUE']);
		$arResult['PROPS_GROUPS'][$ParentKey]['ITEMS'][strlen($arProp['CODE'])?$arProp['CODE']:$arProp['ID']] = $arProp;
	}
	foreach($arResult['PROPS_GROUPS'] as $Key => $arGroup) {
		if (!is_array($arGroup['ITEMS']) || empty($arGroup['ITEMS']) || $arGroup['ACTIVE']=='N') {
			unset($arResult['PROPS_GROUPS'][$Key]);
		}
	}
}

$this->IncludeComponentTemplate();
?>