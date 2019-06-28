<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
<?use \Bitrix\Main\Localization\Loc;?>

<?if($arResult['SECTIONS']):?>
	<div class="item-views catalog sections">
		<?if($arParams["DISPLAY_TOP_PAGER"]):?>
			<div class="pagination_nav">		
				<?=$arResult["NAV_STRING"]?>
			</div>
		<?endif;?>
	
		<div class="items row margin0 row_block">
			<?foreach($arResult['SECTIONS'] as $arItem):?>
				<?
				// edit/add/delete buttons for edit mode
				$arSectionButtons = CIBlock::GetPanelButtons($arItem['IBLOCK_ID'], 0, $arItem['ID'], array('SESSID' => false, 'CATALOG' => true));
				$this->AddEditAction($arItem['ID'], $arSectionButtons['edit']['edit_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_EDIT'));
				$this->AddDeleteAction($arItem['ID'], $arSectionButtons['edit']['delete_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				// preview picture
				if($bShowSectionImage = in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE']) && $arResult['SECTIONS_ICON']){
					$bImage = (isset($arResult['SECTIONS_ICON'][$arItem['ID']]) && $arResult['SECTIONS_ICON'][$arItem['ID']]['UF_ICON']);
					$arSectionImage = ($bImage ? CFile::ResizeImageGet($arResult['SECTIONS_ICON'][$arItem['ID']]['UF_ICON'], array('width' => 40, 'height' => 40), BX_RESIZE_IMAGE_PROPORTIONAL, true) : array());
					$imageSectionSrc = ($bImage ? $arSectionImage['src'] : '');
				}
				else if($bShowSectionImage = in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE'])){
					$bImage = strlen($arItem['~PICTURE']);
					$arSectionImage = ($bImage ? CFile::ResizeImageGet($arItem['~PICTURE'], array('width' => 60, 'height' => 60), BX_RESIZE_IMAGE_PROPORTIONAL, true) : array());
					$imageSectionSrc = ($bImage ? $arSectionImage['src'] : '');
				}
				?>
				<div class="item-wrap col-md-3 col-sm-6 col-xs-6">
					<div class="item border shadow<?=(isset($arParams['SHOW_ICONS']) && $arParams['SHOW_ICONS'] ? ' wicons' : '');?><?=($bShowSectionImage && $imageSectionSrc ? '' : ' wti')?>  slice-item <?=$arParams['IMAGE_CATALOG_POSITION'];?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
						<?// icon or preview picture?>
						<?if($bShowSectionImage && $imageSectionSrc):?>
							<div class="image">
								<a href="<?=$arItem['SECTION_PAGE_URL']?>">
									<img src="<?=$imageSectionSrc?>" alt="<?=( $arItem['PICTURE']['ALT'] ? $arItem['PICTURE']['ALT'] : $arItem['NAME']);?>" title="<?=( $arItem['PICTURE']['TITLE'] ? $arItem['PICTURE']['TITLE'] : $arItem['NAME']);?>" class="img-responsive" />
								</a>
							</div>
						<?endif;?>
						
						<div class="info">
							<?// section name?>
							<?if(in_array('NAME', $arParams['FIELD_CODE'])):?>
								<div class="title">
									<a href="<?=$arItem['SECTION_PAGE_URL']?>" class="dark-color">
										<?=$arItem['NAME']?>
									</a>
								</div>
							<?endif;?>
							
							<?// count elements?>
							<?
							$countElements = ($arItem['CHILD'] ? count($arItem['CHILD']) : 0);
							?>
							<div class="count_elements font_upper"><?=CPriority::Vail($countElements, array(Loc::getMessage('COUNT_ELEMENTS_TITLE'), Loc::getMessage('COUNT_ELEMENTS_TITLE_2'), Loc::getMessage('COUNT_ELEMENTS_TITLE_3')));?></div>

							<?// section preview text?>
							<?if(strlen($arItem['UF_TOP_SEO']) && $arParams['SHOW_SECTION_PREVIEW_DESCRIPTION'] != 'N'):?>
								<div class="text">
									<?=$arItem['UF_TOP_SEO']?>
								</div>
							<?endif;?>
						</div>
					</div>
				</div>
			<?endforeach;?>
		</div>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
			<div class="pagination_nav">		
				<?=$arResult["NAV_STRING"]?>
			</div>
		<?endif;?>		
	</div>
<?endif;?>