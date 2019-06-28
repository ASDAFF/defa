<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
<?use \Bitrix\Main\Localization\Loc;?>

<?if($arResult['ITEMS']):?>
	<div class="item-views services-items within type_2 type_1_within">
		<?if($arParams["DISPLAY_TOP_PAGER"]):?>
			<div class="pagination_nav">		
				<?=$arResult["NAV_STRING"]?>
			</div>
		<?endif;?>
		<div class="items row flexbox">
			<?foreach($arResult['ITEMS'] as $arItem):?>
				<?
				// edit/add/delete buttons for edit mode
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

				// preview picture
				if($bShowSectionImage = in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE'])){
					$bImage = strlen($arItem['PREVIEW_PICTURE']['SRC']);
					$arSectionImage = ($bImage ? CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width' => 735, 'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array());
					$imageSectionSrc = ($bImage ? $arSectionImage['src'] : '');
				}
				?>
				<div class="item col-md-4 col-sm-4 col-xs-6 <?=($bShowSectionImage && $imageSectionSrc ? '' : ' wti')?>" data-id="<?=$arItem['ID'];?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
					<div class="wrap shadow">
						<?// icon or preview picture?>
						<?if($bShowSectionImage && $imageSectionSrc):?>
							<div class="image">
								<div class="wrap"><img src="<?=$imageSectionSrc?>" alt="<?=( $arItem['PREVIEW_PICTURE']['ALT'] ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME']);?>" title="<?=( $arItem['PREVIEW_PICTURE']['TITLE'] ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME']);?>" class="img-responsive" /></div>
							</div>
						<?endif;?>
						
						<div class="body-info">
							<div class="wrap">
								<?// section name?>
								<?if(in_array('NAME', $arParams['FIELD_CODE'])):?>
									<div class="title"><a class="dark-color" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></div>
								<?endif;?>
								<?// section description?>
								<?if(in_array('PREVIEW_TEXT', $arParams['FIELD_CODE']) && strlen($arItem['PREVIEW_TEXT'])):?>
									<div class="bottom-block">
										<div class="previewtext font_xs"><?=CPriority::truncateLengthText($arItem['PREVIEW_TEXT'], $arParams['PREVIEW_TRUNCATE_LEN'])?></div>
									</div>
								<?endif?>
								<?if($arItem['DISPLAY_PROPERTIES']):?>
									<div class="properties">
										<?foreach($arItem['DISPLAY_PROPERTIES'] as $arProperty):?>
											<?
											if($arProperty['CODE'] == 'PRICE' || $arProperty['CODE'] == 'PRICE_OLD'){
												continue;
											}
											?>
											<?if($arProperty['VALUE']):?>
												<div class="property">
													<span class="title-prop"><?=$arProperty['NAME'];?></span>:
													<span class="value"> <?=$arProperty['VALUE'];?></span>
												</div>
											<?endif;?>
										<?endforeach;?>
									</div>
								<?endif;?>
								<?if(isset($arItem['DISPLAY_PROPERTIES']['PRICE']) && $arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE']):?>
									<div class="prices">
										<div class="price"><?=CPriority::FormatPriceShema($arItem['DISPLAY_PROPERTIES']['PRICE']['VALUE']);?></div>
										<?if(isset($arItem['DISPLAY_PROPERTIES']['PRICE_OLD']) && $arItem['DISPLAY_PROPERTIES']['PRICE_OLD']['VALUE']):?>
											<div class="price_old"><?=$arItem['DISPLAY_PROPERTIES']['PRICE_OLD']['VALUE'];?></div>
										<?endif;?>
									</div>
								<?endif;?>
							</div>
						</div>
						<a href="<?=$arItem['DETAIL_PAGE_URL']?>"></a>
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