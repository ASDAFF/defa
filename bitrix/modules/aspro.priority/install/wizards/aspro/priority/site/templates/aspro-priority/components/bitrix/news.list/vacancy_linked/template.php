<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
<?if($arResult['ITEMS']):?>
	<div class="row">
		<div class="col-md-12">
			<div class="item-views linked sections vacancys">
				<div class="items row">
					<?foreach($arResult['ITEMS'] as $arItem):?>
						<?
						// edit/add/delete buttons for edit mode
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						?>
						<div class="col-md-12 col-sm-12">
							<div class="item_wrap border shadow">
								<div class="item clearfix wti" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
									<div class="info">
										<?// section name?>
										<?if(in_array('NAME', $arParams['FIELD_CODE'])):?>
											<div class="title">
												<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="dark-color"><?=$arItem['NAME']?></a>
											</div>
										<?endif;?>
										
										<?if($arItem["DISPLAY_PROPERTIES"]):?>
											<div class="properties">
												<?$i = 0;?>
												<?foreach($arItem["DISPLAY_PROPERTIES"] as $PCODE => $arProperty):?>
													<?
													if($PCODE == 'PAY' || $arProperty['PROPERTY_TYPE'] == 'E' || $arProperty['PROPERTY_TYPE'] == 'G')
														continue;
													?>
													<div class="inner-wrapper">
														<div class="property <?=strtolower($PCODE);?>">
															<span class="value font_upper">
																<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
																	<?$val = implode(",  ", $arProperty["DISPLAY_VALUE"]);?>
																<?else:?>
																	<?$val = $arProperty["DISPLAY_VALUE"];?>
																<?endif;?>
																<?if($PCODE == "SITE"):?>
																	<!--noindex-->
																	<a href="<?=(strpos($arProperty['VALUE'], 'http') === false ? 'http://' : '').$arProperty['VALUE'];?>" rel="nofollow" target="_blank">
																		<?=$arProperty['VALUE'];?>
																	</a>
																	<!--/noindex-->
																<?elseif($PCODE == "EMAIL"):?>
																	<a href="mailto:<?=$val?>"><?=$val?></a>
																<?else:?>
																	<?=$val?>
																<?endif;?>
															</span>
															<?if($i != count($arItem["DISPLAY_PROPERTIES"]) - 2):?>
																<span class="separator font_upper">&mdash;</span>
															<?endif;?>
														</div>
													</div>
													<?++$i;?>
												<?endforeach;?>
											</div>
										<?endif;?>
										<?if(isset($arItem["DISPLAY_PROPERTIES"]['PAY']) && $arItem["DISPLAY_PROPERTIES"]['PAY']['VALUE']):?>
											<div class="pay"><?=$arItem["DISPLAY_PROPERTIES"]['PAY']['VALUE'];?></div>
										<?endif;?>
										
										<?if(in_array('PREVIEW_TEXT', $arParams['FIELD_CODE']) && strlen($arItem['PREVIEW_TEXT'])):?>
											<div class="previewtext"><?=$arItem['PREVIEW_TEXT']?></div>
										<?endif?>
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