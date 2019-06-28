<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?if(\Bitrix\Main\Loader::includeModule('aspro.next.b2c'))
	$this->IncludeComponentTemplate();
else
	return;
?>