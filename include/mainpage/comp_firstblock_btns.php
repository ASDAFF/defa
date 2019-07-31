<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>

<?
if (!$_COOKIE['current_region'])
	$ufCityBnts = 8;
else
	$ufCityBnts = 8;
$rsGroups = CIBlockSection::GetList (
    Array("SORT"=>"ASC"),
	Array("IBLOCK_ID"=>"56", "ACTIVE" => "Y", "UF_CITY_BNTS" => $ufCityBnts),
 	false,
 	Array("IBLOCK_ID", "ID", "NAME", "UF_*")
);

if ($arGroup = $rsGroups->GetNext()){
    ?> <div class="right-btn-content">

    <?$dbBtns = CIBlockElement::GetList (
        Array("SORT"=>"ASC"),
        Array("IBLOCK_ID"=>"56", "ACTIVE" => "Y", "SECTION_ID " => $arGroup["ID"]),
        Array("IBLOCK_ID", "ID", "NAME", "PREVIEW_TEXT", "PROPERTY_LINK_BTN")

    );

    while ($arBtn = $dbBtns->GetNext()){?>
        <a href="<?=$arBtn["PROPERTY_LINK_BTN_VALUE"]?>" class="right-btn">
            <?=$arBtn["NAME"];?>
            <span><?=$arBtn["PREVIEW_TEXT"];?></span>
        </a>


    <?}?>
    </div>
<?}?>
