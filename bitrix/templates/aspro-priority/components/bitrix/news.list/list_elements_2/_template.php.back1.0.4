<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
<?use \Bitrix\Main\Localization\Loc;?>

<?if($arResult['ITEMS']):?>
	<div class="item-views services-items type_5 icons type_2_within">
		<?if($arParams["DISPLAY_TOP_PAGER"]):?>
			<div class="pagination_nav">		
				<?=$arResult["NAV_STRING"]?>
			</div>
		<?endif;?>
		<div class="items flexbox clearfix">
			<?foreach($arResult['ITEMS'] as $arItem):?>
				<?
				// edit/add/delete buttons for edit mode
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

				// preview picture
				if($bShowSectionImage = in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE'])){
					$bImage = $arItem['PROPERTIES']['ICON']['VALUE'];
					$arSectionImage = $bImage ? CFile::ResizeImageGet($arItem['PROPERTIES']['ICON']['VALUE'], array('width' => 40, 'height' => 40), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array();
					$imageSectionSrc = ($bImage ? $arSectionImage['src'] :'');
				}
				?>

				<div class="item shadow border<?=($bShowSectionImage && $imageSectionSrc ? '' : ' wti')?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
					<div class="wrap">
						<?// icon or preview picture?>
						<?if($bShowSectionImage && $imageSectionSrc):?>
							<div class="image">
								<div class="wrap"><img src="<?=$imageSectionSrc?>" alt="<?=( $arItem['PREVIEW_PICTURE']['ALT'] ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME']);?>" title="<?=( $arItem['PREVIEW_PICTURE']['TITLE'] ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME']);?>" class="img-responsive" /></div>
							</div>
						<?endif;?>
						
						<div class="body-info">
							<?// section name?>
							<?if(in_array('NAME', $arParams['FIELD_CODE'])):?>
								<div class="title"><a class="dark-color" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></div>
							<?endif;?>
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