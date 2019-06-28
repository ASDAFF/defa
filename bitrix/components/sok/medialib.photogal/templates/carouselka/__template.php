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
<script type="text/javascript" src="<?=$this->__component->__template->__folder?>/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="<?=$this->__component->__template->__folder?>/jcarousel.connected-carousels.js"></script>

<?foreach($arResult[COLLECTIONS] as $colkey => $colval){ 

?>

    
<?}?>
<?/*   </ul>
 </div>
<?} else{*/
$arFilterz = Array(array("name" => "watermark", "position" => "center", "size"=>"real", "file"=>$_SERVER['DOCUMENT_ROOT']."/upload/common/watermarksmall.png") );	


if($arParams[SET_P_TITLE]==Y){
	$APPLICATION->SetTitle($arResult[COLLECTIONS][$_GET[$colkey]][NAME]);
}
$arrr = $arResult[COLLECTIONS][$colkey][ITEMS];
?> 
 <div class="connected-carousels">
	<div class="stage">
		<div class="carousel carousel-stage">
			<ul> 
				<?
				foreach ($arResult[COLLECTIONS][$colkey][ITEMS] as $key => $item) { 
				$str=$item['PATH'];
				$patr= substr($str, 1, strlen($str));
				?> 
				  <li><img src="/watermark.php?image=<?=$patr?>" /> </li>
				 <? } ?> 
			 </ul>
		</div>
	</div>
	<div class="navigation">
		<a href="#" class="prev prev-navigation">&lsaquo;</a>
        <a href="#" class="next next-navigation">&rsaquo;</a>
		<div class="carousel carousel-navigation">
			<ul>
				<?
				foreach ($arrr as $key => $item) { 
					$str=$item['THUMB_PATH'];
					
					$patr= substr($str, 1, strlen($str));
					?>
					<li><img src="/watermark_small.php?image=<?=$patr?>"  data="<?=$patr?>" /></li> 
				<? } ?>
			</ul>
		</div>
	</div>
</div>
<?//}?>