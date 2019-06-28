<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
<?use \Bitrix\Main\Localization\Loc;?>

<?if($arResult['SECTIONS']):?>
	<div class="item-views services-items type_3 front icons<?=(isset($arParams['SCROLL_CLASS']) && $arParams['SCROLL_CLASS'] ? ' '.$arParams['SCROLL_CLASS'] : '')?>">
		<div class="maxwidth-theme">
			<div class="row">
				<div class="left_wrap col-md-4">
					<div class="left_block">
						<?if($arParams['PAGER_SHOW_ALL']):?>
							<div class="title font_upper"><a class="dark-color" href="<?=str_replace('#SITE'.'_DIR#', SITE_DIR, $arResult['LIST_PAGE_URL'])?>"><?=($arParams["TITLE"] ? $arParams["TITLE"] : Loc::getMessage("TITLE_SERVICES"));?></a></div>
						<?endif?>
						<?// intro text?>
						<div class="text_before_items"><!--
							--><?$APPLICATION->IncludeComponent(
								"bitrix:main.include",
								"",
								Array(
									"AREA_FILE_SHOW" => "file",
									"PATH" => SITE_DIR."include/mainpage/".$arParams['INCLUDE_FILE'],
									"EDIT_TEMPLATE" => ""
								)
							);?><!--
						--></div>
						<?if($arParams['PAGER_SHOW_ALL']):?>
							<div class="button"><a class="btn btn-default btn-transparent" href="<?=str_replace('#SITE'.'_DIR#', SITE_DIR, $arResult['LIST_PAGE_URL'])?>"><?=(isset($arParams['SHOW_ALL_TITLE']) && strlen($arParams['SHOW_ALL_TITLE']) ? $arParams['SHOW_ALL_TITLE'] : Loc::getMessage('S_TO_SHOW_ALL_SERVICES'))?></a></div>
						<?endif?>
					</div>
				</div>
				<div class="right_wrap col-md-8">
					<div class="items flexbox">
						<?foreach($arResult['SECTIONS'] as $arItem):?>
							<?
							// edit/add/delete buttons for edit mode
							$arSectionButtons = CIBlock::GetPanelButtons($arItem['IBLOCK_ID'], 0, $arItem['ID'], array('SESSID' => false, 'CATALOG' => true));
							$this->AddEditAction($arItem['ID'], $arSectionButtons['edit']['edit_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_EDIT'));
							$this->AddDeleteAction($arItem['ID'], $arSectionButtons['edit']['delete_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

							// preview picture
							if($bShowSectionImage = in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE'])){
								$bImage = $arItem['UF_ICON'];
								$arSectionImage = $bImage ? CFile::ResizeImageGet($arItem['UF_ICON'], array('width' => 40, 'height' => 40), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array();
								$imageSectionSrc = ($bImage ? $arSectionImage['src'] :'');
								$bBackground = ($arItem['UF_BACKGROUND'] ? true : false);
							}
							?>
							<div class="item shadow border<?=($bBackground ? ' wbg' : '');?><?=($bShowSectionImage && $imageSectionSrc ? '' : ' wti')?> <?=$arParams['IMAGE_CATALOG_POSITION'];?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
								<div class="wrap">
									<?// icon or preview picture?>
									<?if($bShowSectionImage && $imageSectionSrc):?>
										<div class="image">
											<div class="wrap"><img src="<?=$imageSectionSrc?>" alt="<?=( $arItem['PICTURE']['ALT'] ? $arItem['PICTURE']['ALT'] : $arItem['NAME']);?>" title="<?=( $arItem['PICTURE']['TITLE'] ? $arItem['PICTURE']['TITLE'] : $arItem['NAME']);?>" class="img-responsive" /></div>
										</div>
									<?endif;?>
									
									<div class="body-info">
										<?// section name?>
										<?if(in_array('NAME', $arParams['FIELD_CODE'])):?>
											<div class="title"><a class="dark-color" href="<?=$arItem['SECTION_PAGE_URL']?>"><?=$arItem['NAME']?></a></div>
										<?endif;?>
									</div>
									<a href="<?=$arItem['SECTION_PAGE_URL']?>"></a>
								</div>
							</div>
						<?endforeach;?>
					</div>			
				</div>
			</div>
		</div>
	</div>
<?endif;?>