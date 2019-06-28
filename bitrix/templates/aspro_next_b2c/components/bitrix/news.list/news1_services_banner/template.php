<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?if($arResult['ITEMS']):?>
	<?$isAjax = (isset($_GET["AJAX_REQUEST"]) && $_GET["AJAX_REQUEST"] == "Y");?>
	<?$isWideImg = (isset($arParams['IMAGE_WIDE']) && $arParams['IMAGE_WIDE'] == 'Y');?>
	<?if(!$isAjax):?>
	<div class="item-views list list-type-block wide_img <?=($arParams['IMAGE_POSITION'] ? 'image_'.$arParams['IMAGE_POSITION'] : '')?> <?=($templateName = $component->{'__parent'}->{'__template'}->{'__name'})?>">

		<?// top pagination?>
		<?if($arParams['DISPLAY_TOP_PAGER']):?>
			<?=$arResult['NAV_STRING']?>
		<?endif;?>

		<?
		$bHasSection = false;
		if($arParams['PARENT_SECTION'] && (isset($arResult['SECTIONS']) && $arResult['SECTIONS']))
		{
			if(isset($arResult['SECTIONS'][$arParams['PARENT_SECTION']]) && $arResult['SECTIONS'][$arParams['PARENT_SECTION']])
				$bHasSection = true;
		}
		if($bHasSection)
		{
			// edit/add/delete buttons for edit mode
			$arSectionButtons = CIBlock::GetPanelButtons($arResult['SECTIONS'][$arParams['PARENT_SECTION']]['IBLOCK_ID'], 0, $arResult['SECTIONS'][$arParams['PARENT_SECTION']]['ID'], array('SESSID' => false, 'CATALOG' => true));
			$this->AddEditAction($arResult['SECTIONS'][$arParams['PARENT_SECTION']]['ID'], $arSectionButtons['edit']['edit_section']['ACTION_URL'], CIBlock::GetArrayByID($arResult['SECTIONS'][$arParams['PARENT_SECTION']]['IBLOCK_ID'], 'SECTION_EDIT'));
			$this->AddDeleteAction($arResult['SECTIONS'][$arParams['PARENT_SECTION']]['ID'], $arSectionButtons['edit']['delete_section']['ACTION_URL'], CIBlock::GetArrayByID($arResult['SECTIONS'][$arParams['PARENT_SECTION']]['IBLOCK_ID'], 'SECTION_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="section" id="<?=$this->GetEditAreaId($arResult['SECTIONS'][$arParams['PARENT_SECTION']]['ID'])?>">
			<?
		}?>
		<div class="items row">
			<?// show section items?>
	<?endif;?>
			<?
				$count=count($arResult['ITEMS']);
				$current=0;
			?>
			<?foreach($arResult['ITEMS'] as $i => $arItem):?>
				<?
				$current++;
				// edit/add/delete buttons for edit mode
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				// use detail link?
				$bDetailLink = $arParams['SHOW_DETAIL_LINK'] != 'N' && (!strlen($arItem['DETAIL_TEXT']) ? ($arParams['HIDE_LINK_WHEN_NO_DETAIL'] !== 'Y' && $arParams['HIDE_LINK_WHEN_NO_DETAIL'] != 1) : true);
				$bImage = isset($arItem['FIELDS']['PREVIEW_PICTURE']) && strlen($arItem['PREVIEW_PICTURE']['SRC']);
				$imageSrc = ($bImage ? $arItem['PREVIEW_PICTURE']['SRC'] : false);
				$imageDetailSrc = ($bImage ? $arItem['DETAIL_PICTURE']['SRC'] : false);
				// show active date period
				$bActiveDate = strlen($arItem['DISPLAY_PROPERTIES']['PERIOD']['VALUE']) || ($arItem['DISPLAY_ACTIVE_FROM'] && in_array('DATE_ACTIVE_FROM', $arParams['FIELD_CODE']));
				?>
				<div class="col-md-12">
					<div class="item noborder<?=($bImage ? '' : ' wti')?><?=($bActiveDate ? ' wdate' : '')?> clearfix" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
						<div class="body-info">
							<?// element name?>
							<?if(strlen($arItem['FIELDS']['NAME'])):?>
								<div class="title">
									<?if($bDetailLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="dark-color"><?endif;?>
										<?=$arItem['NAME']?>
									<?if($bDetailLink):?></a><?endif;?>
								</div>
							<?endif;?>



							<?// section title?>
							<?if(strlen($arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['NAME']) && $isWideImg):?>
								<span class="section_name">
									//&nbsp;<?=$arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['NAME']?>
								</span>
							<?endif;?>





						</div>
					</div>
					<?//if($current<$count):?>

					<?//endif;?>
				</div>
			<?endforeach;?>
		<?if(!$isAjax):?>
		</div>
		<?if($bHasSection):?>
			</div>
		<?endif;?>
		<?endif;?>

	<?if(!$isAjax):?>
	</div>
	<?endif;?>
<?endif;?>
