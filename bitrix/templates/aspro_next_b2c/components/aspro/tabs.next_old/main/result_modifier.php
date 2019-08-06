<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
if ($arParams["TABS_CODE"] == "PODBORKI" && $APPLICATION->GetCurPage() == "/"){
		$renum = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>17, "CODE"=>"PODBORKI"));
	while($enum = $renum->GetNext()){
		$arEnum[$enum["ID"]] = $enum["XML_ID"];
	}

	$arFilter = array("IBLOCK_ID" => 17, "ACTIVE"=>"Y", "!PROPERTY_PODBORKI_VALUE" => false, "!PROPERTY_PODBORKIGROUP_VALUE" => false, "PROPERTY_PODBORKAISMAIN_VALUE" => "Y");
	$arSelect = array("ID", "IBLOCK_ID", "PROPERTY_PODBORKAISMAIN", "PROPERTY_PODBORKI");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);

	while($arItem = $res->Fetch()){
		$arCode[$arItem["PROPERTY_PODBORKI_ENUM_ID"]] = $arEnum[$arItem["PROPERTY_PODBORKI_ENUM_ID"]];
	}

	foreach ($arResult["TABS"] as $item){
		if (!in_array($item["CODE"], $arCode)){
			unset($arResult["TABS"][$item["CODE"]]);
		}
	}
}