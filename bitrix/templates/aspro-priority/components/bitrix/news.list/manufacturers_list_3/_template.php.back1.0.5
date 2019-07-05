<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc;?>
<?if($arResult['ITEMS']):?>
	<div class="item-views partners within type_3">
		<?// top pagination?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?>
			<div class="pagination_nav">		
				<?=$arResult["NAV_STRING"]?>
			</div>
		<?endif;?>
		<div class="items flexbox">
			<?foreach($arResult['ITEMS'] as $i => $arItem):?>
				<?
				// edit/add/delete buttons for edit mode
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				// use detail link?
				$bDetailLink = ($arParams['SHOW_DETAIL_LINK'] != 'N' ? true : false);
				// show preview picture?
				$bImage = (isset($arItem['FIELDS']['PREVIEW_PICTURE']) && strlen($arItem['PREVIEW_PICTURE']['SRC']));
				$nImageID = ($bImage ? (is_array($arItem['FIELDS']['PREVIEW_PICTURE']) ? $arItem['FIELDS']['PREVIEW_PICTURE']['ID'] : $arItem['FIELDS']['PREVIEW_PICTURE']) : "");
				$arImage = ($bImage ? CFile::ResizeImageGet($nImageID, array('width' => 1000, 'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL, true) : SITE_TEMPLATE_PATH.'/images/noimage.png');
				$imageSrc = $arImage['src'];
				$imageDetailSrc = ($bImage ? $arItem['FIELDS']['DETAIL_PICTURE']['SRC'] : false);
				?>
				
				<div class="item border shadow" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
					<?if($bImage):?>
						<div class="image">
							<?if($bDetailLink):?>
								<a href="<?=$arItem['DETAIL_PAGE_URL']?>">
							<?endif;?>
								<img src="<?=$imageSrc?>" alt="<?=($bImage ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($bImage ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" class="img-responsive" />
							<?if($bDetailLink):?>
								</a>
							<?endif;?>
						</div>
					<?endif;?>
					<?if(strlen($arItem['FIELDS']['NAME'])):?>
						<div class="title font_upper">
							<?if($bDetailLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="dark-color"><?endif;?>
								<?=$arItem['NAME']?>
							<?if($bDetailLink):?></a><?endif;?>
						</div>
					<?endif;?>
					<?if($bDetailLink):?>
						<a class="link_absolute" href="<?=$arItem['DETAIL_PAGE_URL']?>"></a>
					<?endif;?>
				</div>
			<?endforeach;?>
		</div>
		<?// bottom pagination?>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
			<div class="pagination_nav">		
				<?=$arResult["NAV_STRING"]?>
			</div>
		<?endif;?>								
	</div>
<?endif;?>