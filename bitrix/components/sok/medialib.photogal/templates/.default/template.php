<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
$dir = $APPLICATION->GetCurPage(true);

/*if($_GET[GALLERY_ID]==''){
if($arParams[SET_P_TITLE]==Y){
$APPLICATION->SetTitle($arParams[MAIN_TITLE]);
}
?>
<div id="object1"> 
  <ul class="galthumbnails"> 
<? */?>
<?foreach($arResult[COLLECTIONS] as $colkey => $colval){ 

?>

    
<?}?>
<?/*   </ul>
 </div>
<?} else{*/

if($arParams[SET_P_TITLE]==Y){
$APPLICATION->SetTitle($arResult[COLLECTIONS][$_GET[$colkey]][NAME]);
}

?> 
<ul class="galthumbnails"> 
<?
foreach ($arResult[COLLECTIONS][$colkey][ITEMS] as $key => $item) { 
$str=$item['PATH'];
$patr= substr($str, 1, strlen($str));
?> 
  <li class="galspan2"> <a href="/watermark.php?image=<?echo $patr;?>" class="thumbnail fancygal" title="<?=$item['NAME']?>"  rel="gal1"> <div class="galimg"><img id="tm<?=$key?>" src="<?=$item['PATH']?>" alt="<?=$item['NAME']?>" /> 
  </div>
      <? /*
	  <div class="ntc">      
         <div class="caption" style="position: relative; padding: 0px;">
         <?$str_name=substr($item['NAME'],0,30);
         echo $str_name;
         if (strlen($str_name)==30){
         echo "...";
         }?>
         </div>
      </div>
	  */?>
     </a> </li>
 <? } ?> </ul>
<?if($arParams[SHOW_B_LINK]==Y){?>

<a href="<?=$dir?>" class="galblink"><?=$arParams[SHOW_B_LINK_VALUE]?></a>

<? }?>
<script type="text/javascript">
  $(document).ready(function() {
    $('.fancygal').fancybox({
nextClick : true
});
  });
</script>
<?//}?>