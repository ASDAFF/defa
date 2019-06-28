<?if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true ) die();?>
<?$this->setFrameMode(true);?>
<?
// get element
$arItemFilter = CPriority::GetCurrentElementFilter($arResult["VARIABLES"], $arParams);
$arElement = CCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]), "MULTI" => "N")), $arItemFilter, false, false, array("ID", 'PREVIEW_TEXT', "IBLOCK_SECTION_ID", 'PREVIEW_PICTURE', 'DETAIL_PICTURE'));
?>
<?if(!$arElement && $arParams['SET_STATUS_404'] !== 'Y'):?>
	<div class="alert alert-warning"><?=GetMessage("ELEMENT_NOTFOUND")?></div>
<?elseif(!$arElement && $arParams['SET_STATUS_404'] === 'Y'):?>
	<?CPriority::goto404Page();?>
<?else:?>
	<?CPriority::CheckComponentTemplatePageBlocksParams($arParams, __DIR__);?>
	<?// rss
	if($arParams['USE_RSS'] !== 'N'){
		CPriority::ShowRSSIcon($arResult['FOLDER'].$arResult['URL_TEMPLATES']['rss']);
	}?>
	<?CPriority::AddMeta(
		array(
			'og:description' => $arElement['PREVIEW_TEXT'],
			'og:image' => (($arElement['PREVIEW_PICTURE'] || $arElement['DETAIL_PICTURE']) ? CFile::GetPath(($arElement['PREVIEW_PICTURE'] ? $arElement['PREVIEW_PICTURE'] : $arElement['DETAIL_PICTURE'])) : false),
		)
	);?>
	<?if($arParams["USE_SHARE"] == "Y" && $arElement):?>
		<div class="share top <?=($arParams['USE_RSS'] !== 'N' ? 'rss-block' : '');?>">
			<div class="shares-block">
				<script type="text/javascript" src="//yastatic.net/share2/share.js" async="async" charset="utf-8"></script>
				<div class="ya-share2" data-services="vkontakte,facebook,twitter,viber,whatsapp,odnoklassniki,moimir"></div>
			</div>
		</div>
		<style type="text/css">h1{padding-right:300px;}</style>
		<script type="text/javascript">
			$('h1').addClass('shares');
			$(document).ready(function(){
				if($('a.rss').length)
					$('a.rss').after($('.share.top'));
				else
					$('h1').before($('.share.top'));
				$('.share.top').show();
			})
		</script>
		<?if($arParams['USE_RSS'] !== 'N'):?>
			<style type="text/css">body h1{padding-right:360px;}</style>
		<?endif;?>
	<?endif;?>
	<div class="detail staff">
		<?@include_once('page_blocks/'.$arParams["ELEMENT_TYPE_VIEW"].'.php');?>
	</div>
	<?
	if(is_array($arElement["IBLOCK_SECTION_ID"]) && count($arElement["IBLOCK_SECTION_ID"]) > 1){
		CPriority::CheckAdditionalChainInMultiLevel($arResult, $arParams, $arElement);
	}
	?>
<?endif;?>
<div style="clear:both"></div>
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-6 share">
		<?if($arParams["USE_SHARE"] == "Y" && $arElement):?>
			<div class="shares-block">
				<svg class="svg svg-share" id="share.svg" xmlns="http://www.w3.org/2000/svg" width="14" height="16" viewBox="0 0 14 16"><path id="Ellipse_223_copy_8" data-name="Ellipse 223 copy 8" class="cls-1" d="M1613,203a2.967,2.967,0,0,1-1.86-.661l-3.22,2.01a2.689,2.689,0,0,1,0,1.3l3.22,2.01A2.961,2.961,0,0,1,1613,207a3,3,0,1,1-3,3,3.47,3.47,0,0,1,.07-0.651l-3.21-2.01a3,3,0,1,1,0-4.678l3.21-2.01A3.472,3.472,0,0,1,1610,200,3,3,0,1,1,1613,203Zm0,8a1,1,0,1,0-1-1A1,1,0,0,0,1613,211Zm-8-7a1,1,0,1,0,1,1A1,1,0,0,0,1605,204Zm8-5a1,1,0,1,0,1,1A1,1,0,0,0,1613,199Z" transform="translate(-1602 -197)"/></svg>
				<span class="text"><?=GetMessage('SHARE_TEXT')?></span>
				<script type="text/javascript" src="//yastatic.net/share2/share.js" async="async" charset="utf-8"></script>
				<div class="ya-share2" data-services="vkontakte,facebook,twitter,viber,whatsapp,odnoklassniki,moimir"></div>
			</div>
		<?endif;?>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-6">
		<a class="back-url url-block font_upper" href="<?=$arResult['FOLDER'].$arResult['URL_TEMPLATES']['news']?>"><span><?=GetMessage('BACK_LINK')?></span></a>
	</div>
</div>