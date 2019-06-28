<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
if(\Bitrix\Main\Loader::includeModule('aspro.priority')){
	if($this->startResultCache(false, array($arParams["CACHE_GROUPS"]==="N"? false: $USER->GetGroups(), $arParams["TOKEN"]))){
		$inst=new CInstargramPriority($arParams["TOKEN"]);
		$arResult['POSTS']=$inst->getInstagramPosts();
		$arResult['USER']=$inst->getInstagramUser();
		/*$this->setResultCacheKeys(array(
			"POSTS",
			"USER",
		));*/
		$this->IncludeComponentTemplate();
	}
}
else{
	return;
}
?>