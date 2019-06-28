<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
<?if($arResult['ITEMS']):?>
	<div class="item-views catalog sections type_4_within">
		<?if($arParams["DISPLAY_TOP_PAGER"]):?>
			<div class="pagination_nav">		
				<?=$arResult["NAV_STRING"]?>
			</div>
		<?endif;?>
		<div class="items row margin0 list_block">
			<?foreach($arResult['ITEMS'] as $arItem):?>
				<?
				// edit/add/delete buttons for edit mode
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				// preview picture
				if($bShowSectionImage = in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE'])){
					$bImage = strlen($arItem['PREVIEW_PICTURE']['SRC']);
					$arSectionImage = ($bImage ? CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width' => 429, 'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL, true) : array());
					$imageSectionSrc = ($bImage ? $arSectionImage['src'] : '');
				}
				?>
				<div class="col-md-12 col-sm-12">
					<div class="item border shadow<?=($imageSectionSrc ? '' : ' wti')?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
						<?// icon or preview picture?>
						<?if($imageSectionSrc):?>
							<div class="image">
								<a href="<?=$arItem['DETAIL_PAGE_URL']?>">
									<img src="<?=$imageSectionSrc?>" alt="<?=( $arItem['PREVIEW_PICTURE']['ALT'] ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME']);?>" title="<?=( $arItem['PREVIEW_PICTURE']['TITLE'] ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME']);?>" class="img-responsive" />
								</a>
							</div>
						<?endif;?>
						
						<div class="info">
							<?// section name?>
							<?if(in_array('NAME', $arParams['FIELD_CODE'])):?>
								<div class="title">
									<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="dark-color">
										<?=$arItem['~NAME']?>
									</a>
								</div>
							<?endif;?>

							<?// section preview text?>
							<?if(strlen($arItem['UF_TOP_SEO']) && $arParams['SHOW_SECTION_PREVIEW_DESCRIPTION'] != 'N'):?>
								<div class="previewtext">
									<?=$arItem['UF_TOP_SEO']?>
								</div>
							<?elseif(strlen($arItem['PREVIEW_TEXT']) && $arParams['SHOW_SECTION_PREVIEW_DESCRIPTION'] != 'N'):?>
								<div class="previewtext">
									<?=$arItem['PREVIEW_TEXT']?>
								</div>
							<?endif;?>
							<?// section child?>
							<?if($arItem['CHILD']):?>
								<div class="text childs">
									<ul>
										<?foreach($arItem['CHILD'] as $arSubItem):?>
											<li class="font_sm"><a class="colored" href="<?=($arSubItem['SECTION_PAGE_URL'] ? $arSubItem['SECTION_PAGE_URL'] : $arSubItem['DETAIL_PAGE_URL'] );?>"><?=$arSubItem['NAME']?></a></li>
										<?endforeach;?>
									</ul>
								</div>
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
							
							<?if($arItem['CHILD']):?>
								<div class="button"><span class="opener font_upper" data-open_text="<?=GetMessage('CLOSE_TEXT');?>" data-close_text="<?=GetMessage('OPEN_TEXT');?>"><?=GetMessage('OPEN_TEXT');?></span></div>
							<?endif;?>
							<a class="arrow_link" href="<?=$arItem['DETAIL_PAGE_URL']?>"></a>
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