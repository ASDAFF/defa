<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc;?>
<div class="item-views partners within type_3">
	<?// top pagination?>
	<?if($arParams["DISPLAY_TOP_PAGER"]):?>
		<div class="pagination_nav">		
			<?=$arResult["NAV_STRING"]?>
		</div>
	<?endif;?>
	<div class="group-content">
		<?// group elements by sections?>
		<?foreach($arResult['SECTIONS'] as $SID => $arSection):?>
			<?
			// edit/add/delete buttons for edit mode
			$arSectionButtons = CIBlock::GetPanelButtons($arSection['IBLOCK_ID'], 0, $arSection['ID'], array('SESSID' => false, 'CATALOG' => true));
			$this->AddEditAction($arSection['ID'], $arSectionButtons['edit']['edit_section']['ACTION_URL'], CIBlock::GetArrayByID($arSection['IBLOCK_ID'], 'SECTION_EDIT'));
			$this->AddDeleteAction($arSection['ID'], $arSectionButtons['edit']['delete_section']['ACTION_URL'], CIBlock::GetArrayByID($arSection['IBLOCK_ID'], 'SECTION_DELETE'), array('CONFIRM' => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div id="<?=$this->GetEditAreaId($arSection['ID'])?>" class="tab-pane <?=(!$si++ || !$arSection['ID'] ? 'active' : '')?>">

				<?if($arParams['SHOW_SECTION_PREVIEW_DESCRIPTION'] == 'Y'):?>
					<?if($arParams['SHOW_SECTION_NAME'] != 'N'):?>
						<?// section name?>
						<?if(strlen($arSection['NAME'])):?>
							<h3><?=$arSection['NAME']?></h3>
						<?endif;?>
					<?endif;?>

					<?// section description text/html?>
					<?if(strlen($arSection['DESCRIPTION']) && strpos($_SERVER['REQUEST_URI'], 'PAGEN') === false):?>
						<div class="text_before_items">
							<?=$arSection['DESCRIPTION']?>
						</div>
					<?endif;?>
				<?endif;?>

				<div class="items clearfix">
					<?foreach($arSection['ITEMS'] as $i => $arItem):?>
						<?
						// edit/add/delete buttons for edit mode
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						// use detail link?
						$bDetailLink = $arParams['SHOW_DETAIL_LINK'] != 'N' && (!strlen($arItem['DETAIL_TEXT']) ? ($arParams['HIDE_LINK_WHEN_NO_DETAIL'] !== 'Y' && $arParams['HIDE_LINK_WHEN_NO_DETAIL'] != 1) : true);
						// show preview picture?
						$bImage = strlen($arItem['FIELDS']['PREVIEW_PICTURE']['SRC']);
						$imageSrc = ($bImage ? $arItem['FIELDS']['PREVIEW_PICTURE']['SRC'] : false);
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