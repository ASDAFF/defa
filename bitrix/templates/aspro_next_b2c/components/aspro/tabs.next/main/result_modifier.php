<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

if ($arParams["TABS_CODE"] == "PODBORKI" && $APPLICATION->GetCurPage() == "/"){
		$renum = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>17, "CODE"=>"PODBORKI"));
	while($enum = $renum->GetNext()){
		$arEnum[$enum["ID"]] = $enum["XML_ID"];
	}

	$arFilter = array("IBLOCK_ID" => 17, "ACTIVE"=>"Y", "!PROPERTY_PODBORKI_VALUE" => false);
	$arSelect = array("ID", 'NAME', "IBLOCK_ID", "PROPERTY_PODBORKAISMAIN", "PROPERTY_PODBORKI", 'PROPERTY_PODBORKIGROUP');
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

	while($arItem = $res->Fetch()){
		$arCode[$arItem["PROPERTY_PODBORKI_ENUM_ID"]] = $arEnum[$arItem["PROPERTY_PODBORKI_ENUM_ID"]];
		$arResult['PODBORKIGROUP_FILTER'][$arItem['PROPERTY_PODBORKIGROUP_VALUE']][] = $arItem["PROPERTY_PODBORKI_VALUE"];
	}
    $property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>17, "CODE"=>"PODBORKIGROUP"));
    while($enum_fields = $property_enums->GetNext())
    {
        $arResult['PODBORKIGROUP'][] = $enum_fields;
    }
    $arResult['SPISOK'] = GetGroups();
    function UserFieldValue($ID)
    {
        $UserField = CUserFieldEnum::GetList(array(), array("ID" => $ID));
        if($UserFieldAr = $UserField->GetNext())
        {
            return $UserFieldAr["VALUE"];
        }
        else return false;
    }
    foreach ($arResult['SPISOK'] as $key=> $arElement) {
        foreach ($arElement['PODBORKI'] as $arPodborka) {
            $arResult['SPISOK'][$key]['TABS'][] = UserFieldValue($arPodborka);
        }

    }
	foreach ($arResult["TABS"] as $item){
		if (!in_array($item["CODE"], $arCode)){
			unset($arResult["TABS"][$item["CODE"]]);
		}

	}


}



if($arParams["TABS_CODE"] == "HIT"){
    $arResult['TABS'] = GetMarks(['*'],['UF_SHOW_MAIN'=>1]);
        if($arResult['TABS']) {
            $idsesct = [];
            $idsitems = [];
            foreach ($arResult['TABS'] as $key => $TAB) {
                if (!in_array($key, $idsesct)) $idsesct[] = $key;
                if (!in_array($TAB['UF_XML_ID'], $idsitems)) $idsitems[] = $TAB['UF_XML_ID'];

            }
            if ($idsesct) {
                $arFilter = array('IBLOCK_ID' => $arParams["IBLOCK_ID"], 'UF_METKA' => $idsesct);
                $rsSections = CIBlockSection::GetList(array('SORT' => 'ASC'), $arFilter,false,array('ID','UF_METKA'));
                while ($arSection = $rsSections->Fetch()) {
                    $arSectionsids[] = $arSection['ID'];
                    $arSections[$arSection['ID']] = $arSection;


                }
            }
            if($idsitems || $arSectionsids){
                $arSelect = Array("ID", "IBLOCK_ID", "PROPERTY_HIT","IBLOCK_SECTION_ID");
                $arFilter = Array(
                    'IBLOCK_ID' => $arParams["IBLOCK_ID"],
                    "ACTIVE_DATE" => "Y",
                    "ACTIVE" => "Y",
                    array('LOGIC' => 'OR', '=PROPERTY_HIT' => $idsitems, '=IBLOCK_SECTION_ID' => $arSectionsids)

                );
                $res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
                while ($ob = $res->Fetch()) {
                    $arItemsId[] = $ob;
                }
            }


        }

        foreach ($arItemsId as $arItem){

            if($arItem['PROPERTY_HIT_VALUE']){
                $arResult['TABS'][$arItem['PROPERTY_HIT_VALUE']]['FILTER']['ID'][] = $arItem['ID'];
            }else{
                if(is_array($arSections[$arItem['IBLOCK_SECTION_ID']]['UF_METKA'])){
                    foreach ($arSections[$arItem['IBLOCK_SECTION_ID']]['UF_METKA'] as $mark){
                        $arResult['TABS'][$mark]['FILTER']['ID'][] = $arItem['ID'];
                    }
                }else{

                    $arResult['TABS'][$arSections[$arItem['IBLOCK_SECTION_ID']]['UF_METKA']]['FILTER']['ID'][] = $arItem['ID'];
                }

            }

        }
    if($USER->IsAdmin()){

       // \Bitrix\Main\Diag\Debug::dump($arResult["TABS"] );
    }
}


