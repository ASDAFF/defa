<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<div class="mix_banners clearfix">
	<?foreach($arResult['SECTIONS']['SMALL']['ITEMS'] as $arItem):?>
		<?
		$arItemsButtons = CIBlock::GetPanelButtons($arItem['IBLOCK_ID'], $arItem['ID'], 0, array('SESSID' => false, 'CATALOG' => false));
		$this->AddEditAction($arItem['ID'], $arItemsButtons['edit']['edit_element']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
		$this->AddDeleteAction($arItem['ID'], $arItemsButtons['edit']['delete_element']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		$textColor = (isset($arResult['PROPERTY_TEXTCOLOR'][$arItem['PROPERTY_TEXTCOLOR_ENUM_ID']]) && strlen($arResult['PROPERTY_TEXTCOLOR'][$arItem['PROPERTY_TEXTCOLOR_ENUM_ID']]) ? $arResult['PROPERTY_TEXTCOLOR'][$arItem['PROPERTY_TEXTCOLOR_ENUM_ID']] : '');
		?>
		<?if(strlen($arItem['PREVIEW_PICTURE'])):?>
			<div class="item<?=($textColor ? ' '.$textColor : '')?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>" style="background:url('<?=$arItem['PREVIEW_PICTURE']?>') center center / cover no-repeat;">
				<div class="text">
					<?if(strlen($arItem['PROPERTY_SECTION_VALUE'])):?>
						<div class="section"><?=$arItem['PROPERTY_SECTION_VALUE']?></div>
					<?endif?>
					<div class="title"><?=$arItem['NAME']?></div>
				</div>
				<?if(strlen($arItem['PROPERTY_LINK_VALUE'])):?>
					<a href="<?=$arItem['PROPERTY_LINK_VALUE']?>"></a>
				<?endif?>
			</div>
		<?endif?>
	<?endforeach;?>
</div>