
<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
<?if($arResult['ITEMS']):?>
	<div class="row">
		<div class="col-md-12">
			<div class="item-views linked sections partners">
				<div class="items row">
					<?foreach($arResult['ITEMS'] as $arItem):?>
						<?
						// edit/add/delete buttons for edit mode
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

						// preview picture
						if($bShowSectionImage = in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE'])){
							$bImage = (isset($arItem['FIELDS']['PREVIEW_PICTURE']) && strlen($arItem['PREVIEW_PICTURE']['SRC']));
							$arSectionImage = ($bImage ? CFile::ResizeImageGet($arItem['FIELDS']['PREVIEW_PICTURE']['ID'], array('width' => 388, 'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL, true) : array());
							$imageSectionSrc = ($bImage ? $arSectionImage['src'] : '');
						}
						?>
						<div class="col-md-12 col-sm-12">
							<div class="item_wrap border shadow">
								<div class="item clearfix<?=($bShowSectionImage && strlen($imageSectionSrc) ? '' : ' wti')?> <?=$arParams['IMAGE_CATALOG_POSITION'];?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
									<?// icon or preview picture?>
									<?if($bShowSectionImage && strlen($imageSectionSrc)):?>
										<div class="image">
											<div class="wrap">
												<a href="<?=$arItem['DETAIL_PAGE_URL']?>">
													<img src="<?=$imageSectionSrc?>" alt="<?=( $arItem['PICTURE']['ALT'] ? $arItem['PICTURE']['ALT'] : $arItem['NAME']);?>" title="<?=( $arItem['PICTURE']['TITLE'] ? $arItem['PICTURE']['TITLE'] : $arItem['NAME']);?>" class="img-responsive" />
												</a>
											</div>
										</div>
									<?endif;?>
									
									<div class="info">
										<?// section name?>
										<?if(in_array('NAME', $arParams['FIELD_CODE'])):?>
											<div class="title">
												<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="dark-color"><?=$arItem['NAME']?></a>
											</div>
										<?endif;?>
										<?if(in_array('PREVIEW_TEXT', $arParams['FIELD_CODE']) && strlen($arItem['PREVIEW_TEXT'])):?>
											<div class="previewtext"><?=$arItem['PREVIEW_TEXT']?></div>
										<?endif?>
										<?if($arItem["DISPLAY_PROPERTIES"]):?>
											<div class="properties">
												<?foreach($arItem["DISPLAY_PROPERTIES"] as $PCODE => $arProperty):?>
													<?
													if($arProperty['PROPERTY_TYPE'] == 'E' || $arProperty['PROPERTY_TYPE'] == 'G')
														continue;
													?>
													<div class="inner-wrapper">
														<div class="property  <?=strtolower($PCODE);?>">
															<div class="title-prop font_upper"><?=$arProperty['NAME']?></div>
															<div class="value">
																<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
																	<?$val = implode(", ", $arProperty["DISPLAY_VALUE"]);?>
																<?else:?>
																	<?$val = $arProperty["DISPLAY_VALUE"];?>
																<?endif;?>
																<?if($PCODE == "SITE"):?>
																	<!--noindex-->
																	<a class="dark-color" href="<?=(strpos($arProperty['VALUE'], 'http') === false ? 'http://' : '').$arProperty['VALUE'];?>" rel="nofollow" target="_blank">
																		<?=strpos($arProperty['VALUE'], '?') === false ? $arProperty['VALUE'] : explode('?', $arProperty['VALUE'])[0]?>
																	</a>
																	<!--/noindex-->
																<?elseif($PCODE == "EMAIL"):?>
																	<a class="dark-color" href="mailto:<?=$val?>"><?=$val?></a>
																<?else:?>
																	<?=$val?>
																<?endif;?>
															</div>
														</div>
													</div>
												<?endforeach;?>
											</div>
										<?endif;?>
									</div>
									<?if(strlen($arItem['DETAIL_PAGE_URL'])):?>
										<a class="arrow_open link" href="<?=$arItem['DETAIL_PAGE_URL']?>"></a>
									<?endif?>
								</div>
							</div>
						</div>
					<?endforeach;?>
				</div>
			</div>
		</div>
	</div>
<?endif;?>