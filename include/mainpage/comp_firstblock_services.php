<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>

<?
$rs = CIBlockElement::GetList (
    Array("SORT"=>"ASC"),
	Array("IBLOCK_ID"=>"2", "ACTIVE" => "Y", "ID" => $_COOKIE['current_region']),
 	Array("IBLOCK_ID", "ID", "NAME", "PROPERTY_SERVICES")
);

while ($arCity = $rs->GetNext()){
	$arCityServiceID[] = $arCity["PROPERTY_SERVICES_VALUE"];
}

$dbService = CIBlockElement::GetList (
	Array("SORT"=>"ASC"),
    Array("IBLOCK_ID"=>"14", "ACTIVE" => "Y", "ID" => $arCityServiceID),
    Array("IBLOCK_ID", "ID", "NAME", "DETAIL_PAGE_URL", "CODE")

);
?>
<?if (!empty($dbService)):?>
<div class="services-block">
<?/*while ($arService = $dbService->GetNext()):*/?><!--
	<a href="<?/*=$arService["DETAIL_PAGE_URL"];*/?>" class="services-btn">
		<?/*=$arService["NAME"];*/?>
	</a>
--><?/*endwhile;*/?>
    <a href="/services/dostavka/" class="services-btn">
        Доставка
    </a>
    <a href="/services/sborka/" class="services-btn">
        Сборка
    </a>
    <a href="/services/vyvoz-musora" class="services-btn">
        Вывоз упаковки
    </a>
    <a href="/services/pereezd/" class="services-btn">
        Переезд
    </a>
    <a href="/services/pereezd/" class="services-btn">
        Гарантия
    </a>
    	<!--<a href="/help/warranty/" class="services-btn">
    		Гарантия
    	</a>
    	<a href="/3d-online/" class="services-btn">
    		3D-планировщик
    	</a>-->
</div>
<?endif;?>
