<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); 

ShowMessage($arParams["~AUTH_RESULT"]); 


$APPLICATION->IncludeComponent( 
   "bitrix:main.register", 
   "", 
   Array( 
      "USER_PROPERTY_NAME" => "", 
      "SEF_MODE" => "N", 
      "SHOW_FIELDS" => Array("NAME", "SECOND_NAME", "LAST_NAME", "PERSONAL_MOBILE", "PERSONAL_NOTES"), 
      "REQUIRED_FIELDS" => Array("PERSONAL_MOBILE", "PERSONAL_NOTES"), 
      "AUTH" => "Y", 
      "USE_BACKURL" => "Y", 
      "SUCCESS_PAGE" => $APPLICATION->GetCurPageParam('',array('backurl')), 
      "SET_TITLE" => "N", 
      "USER_PROPERTY" => Array() 
   ) 
); 

?><p><a href="<?=$arResult["AUTH_AUTH_URL"]?>"><b><?=GetMessage("AUTH_AUTH")?></b></a></p><?

?>