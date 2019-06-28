<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
<?use \Bitrix\Main\Localization\Loc;?>
<?if($arResult['SECTIONS']):?>
	<div class="item-views services-items type_4 front<?=(isset($arParams['SECTION_CLASS']) && $arParams['SECTION_CLASS'] ? ' '.$arParams['SECTION_CLASS'] : '');?><?=(isset($arParams['SCROLL_CLASS']) && $arParams['SCROLL_CLASS'] ? ' '.$arParams['SCROLL_CLASS'] : '')?>">
		<div class="maxwidth-theme">
			<div class="row">
				<div class="col-md-12">
					<?if($arParams['PAGER_SHOW_ALL']):?>
						<a class="show_all pull-right" href="<?=str_replace('#SITE'.'_DIR#', SITE_DIR, $arResult['LIST_PAGE_URL'])?>"><span><?=(strlen($arParams['SHOW_ALL_TITLE']) ? $arParams['SHOW_ALL_TITLE'] : GetMessage('S_TO_SHOW_ALL_SERVICES'))?></span></a>
					<?endif;?>
					<h2><?=($arParams["TITLE"] ? $arParams["TITLE"] : Loc::getMessage("TITLE_SERVICES"));?></h2>
					<div class="clearfix"></div>
					<div class="items flexbox">
						<?foreach($arResult['SECTIONS'] as $arItem):?>
							<?
							// edit/add/delete buttons for edit mode
							$arSectionButtons = CIBlock::GetPanelButtons($arItem['IBLOCK_ID'], 0, $arItem['ID'], array('SESSID' => false, 'CATALOG' => true));
							$this->AddEditAction($arItem['ID'], $arSectionButtons['edit']['edit_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_EDIT'));
							$this->AddDeleteAction($arItem['ID'], $arSectionButtons['edit']['delete_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

							// preview picture
							if($bShowSectionImage = in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE'])){
								$bImage = strlen($arItem['~PICTURE']);
								$arSectionImage = ($bImage ? CFile::ResizeImageGet($arItem['~PICTURE'], array('width' => 388, 'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array());
								$imageSectionSrc = ($bImage ? $arSectionImage['src'] : '');
							}
							?>

							<div class="item border shadow<?=($bShowSectionImage && strlen($imageSectionSrc) ? '' : ' wti')?> <?=$arParams['IMAGE_CATALOG_POSITION'];?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
								<div class="wrap clearfix">
									<?// icon or preview picture?>
									<?if($bShowSectionImage && strlen($imageSectionSrc)):?>
										<div class="image">
											<div class="wrap">
												<a href="<?=$arItem['SECTION_PAGE_URL']?>">
													<img src="<?=$imageSectionSrc?>" alt="<?=( $arItem['PREVIEW_PICTURE']['ALT'] ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME']);?>" title="<?=( $arItem['PREVIEW_PICTURE']['TITLE'] ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME']);?>" class="img-responsive" />
												</a>
											</div>
										</div>
									<?endif;?>
									
									<div class="body-info">
										<?// section name?>
										<?if(in_array('NAME', $arParams['FIELD_CODE'])):?>
											<div class="title">
												<a class="dark-color" href="<?=$arItem['SECTION_PAGE_URL']?>"><?=$arItem['NAME']?></a>
											</div>
										<?endif;?>
										
										<?// section description?>
										<?if(in_array('PREVIEW_TEXT', $arParams['FIELD_CODE']) && strlen($arItem['DESCRIPTION'])):?>
											<div class="previewtext font_sm"><?=CPriority::truncateLengthText($arItem['DESCRIPTION'], $arParams['PREVIEW_TRUNCATE_LEN'])?></div>
										<?endif?>
									</div>
								</div>
							</div>
						<?endforeach;?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?endif;?>