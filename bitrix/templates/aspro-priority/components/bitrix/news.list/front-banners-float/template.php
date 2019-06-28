<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?if($arResult['ITEMS']):?>
	<div class="mix_banners bottom clearfix">
		<?foreach($arResult['ITEMS'] as $arItem):?>
			<?
			// edit/add/delete buttons for edit mode
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			$textColor = (isset($arItem['DISPLAY_PROPERTIES']['TEXTCOLOR']) && strlen($arItem['DISPLAY_PROPERTIES']['TEXTCOLOR']['VALUE']) ? $arItem['DISPLAY_PROPERTIES']['TEXTCOLOR']['VALUE_XML_ID'] : '');
			$bWideBanner = (isset($arItem['DISPLAY_PROPERTIES']['WIDE']) && $arItem['DISPLAY_PROPERTIES']['WIDE']['VALUE'] == 'Y' ? true : false);
			?>

			<?if(strlen($arItem['PREVIEW_PICTURE']['SRC'])):?>
				<div class="item<?=($textColor ? ' '.$textColor : '')?><?=($bWideBanner ? ' wide' : '')?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>" style="background:url('<?=$arItem['PREVIEW_PICTURE']['SRC']?>') center top / cover no-repeat;">
					<div class="text">
						<?if(isset($arItem['DISPLAY_PROPERTIES']['SECTION']) && strlen($arItem['DISPLAY_PROPERTIES']['SECTION']['VALUE'])):?>
							<div class="section"><?=$arItem['DISPLAY_PROPERTIES']['SECTION']['VALUE']?></div>
						<?endif?>
						<?if(isset($arItem['FIELDS']['NAME']) && strlen($arItem['FIELDS']['NAME'])):?>
							<div class="title"><?=$arItem['FIELDS']['NAME']?></div>
						<?endif?>
					</div>
						<?if(isset($arItem['DISPLAY_PROPERTIES']['LINK']) && strlen($arItem['DISPLAY_PROPERTIES']['LINK']['VALUE'])):?>
						<a href="<?=$arItem['DISPLAY_PROPERTIES']['LINK']['VALUE']?>"></a>
					<?endif?>
				</div>
			<?endif?>
		<?endforeach;?>
	</div>
<?endif?>