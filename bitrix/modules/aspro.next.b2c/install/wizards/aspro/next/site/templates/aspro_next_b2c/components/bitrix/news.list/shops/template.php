<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?CNextB2c::drawShopsList($arResult['ITEMS'], $arParams, "N");?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]){?>
	<hr/>
	<?=$arResult["NAV_STRING"]?>
<?}?>