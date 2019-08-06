<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? $this->setFrameMode( true );?>
<? $isSeries = false;
/*foreach ($arResult['SECTIONS'] as $arSection){
    if(!empty($arSection['UF_SERIES'])){
        $isSeries = true;
    }
}*/
//prmin($arResult,250);
if(!empty($arResult['SECTION']['UF_SERIES']))
{
    $isSeries=true;
}
if($isSeries){
    @include_once('series_new.php');
}else
    @include_once ('categories.php');
?>
