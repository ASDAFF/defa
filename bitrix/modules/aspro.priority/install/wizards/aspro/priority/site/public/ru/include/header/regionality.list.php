<?global $arTheme;
static $list_regions_call;
$iCalledID = ++$list_regions_call;?>
<?$frame = new \Bitrix\Main\Page\FrameHelper('header-regionality-block'.$iCalledID);?>
<?$frame->begin();?>
<?$APPLICATION->IncludeComponent(
	"aspro:regionality.list.priority",
	strtolower($arTheme["USE_REGIONALITY"]["DEPENDENT_PARAMS"]["REGIONALITY_VIEW"]["VALUE"]),
	Array(
		
	),false, array('HIDE_ICONS' => 'Y')
);?>
<?$frame->end();?>