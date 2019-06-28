<?if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true ) die();?>
<?$this->setFrameMode(true);?>
<?
use \Bitrix\Main\Localization\Loc;
// get element
$arItemFilter = CPriority::GetCurrentElementFilter($arResult["VARIABLES"], $arParams);
$arElement = CCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]), "MULTI" => "N")), $arItemFilter, false, false, array("ID", 'PREVIEW_TEXT', "IBLOCK_SECTION_ID", 'DETAIL_PICTURE', 'DETAIL_PAGE_URL', 'PROPERTY_LINK_PROJECTS', 'PROPERTY_LINK_REVIEWS', 'PROPERTY_DOCUMENTS'));
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
	<?@include_once('page_blocks/'.$arParams["ELEMENT_TYPE_VIEW"].'.php');?>
	<?
	if(is_array($arElement["IBLOCK_SECTION_ID"]) && count($arElement["IBLOCK_SECTION_ID"]) > 1){
		CPriority::CheckAdditionalChainInMultiLevel($arResult, $arParams, $arElement);
	}
	?>
<?endif;?>
<div style="clear:both"></div>
<hr class="bottoms" />
<div class="row">
	<div class="col-md-6 share">
		<?if($arParams["USE_SHARE"] == "Y" && $arElement):?>
			<div class="shares-block">
				<span class="text"><?=GetMessage('SHARE_TEXT')?></span>
				<script type="text/javascript" src="//yastatic.net/share2/share.js" async="async" charset="utf-8"></script>
				<div class="ya-share2" data-services="vkontakte,facebook,twitter,viber,whatsapp,odnoklassniki,moimir"></div>
			</div>
		<?endif;?>
	</div>
	<div class="col-md-6">
		<a class="back-url url-block" href="<?=$arResult['FOLDER'].$arResult['URL_TEMPLATES']['news']?>"><i class="fa fa-angle-left"></i><span><?=GetMessage('BACK_LINK')?></span></a>
	</div>
</div>