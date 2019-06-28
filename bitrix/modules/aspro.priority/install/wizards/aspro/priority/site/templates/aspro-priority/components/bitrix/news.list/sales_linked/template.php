<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?if($arResult['ITEMS']):?>
	<div class="item-views sales linked sections">
		<div class="items row">
			<?foreach($arResult['ITEMS'] as $i => $arItem):?>
				<?
				$current++;
				// edit/add/delete buttons for edit mode
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				// use detail link?
				$bDetailLink = $arParams['SHOW_DETAIL_LINK'] != 'N' && (!strlen($arItem['DETAIL_TEXT']) ? ($arParams['HIDE_LINK_WHEN_NO_DETAIL'] !== 'Y' && $arParams['HIDE_LINK_WHEN_NO_DETAIL'] != 1) : true);
				$bImage = strlen($arItem['FIELDS']['PREVIEW_PICTURE']['SRC']);
				$imageSrc = ($bImage ? $arItem['FIELDS']['PREVIEW_PICTURE']['SRC'] : '');
				$imageDetailSrc = ($bImage ? $arItem['FIELDS']['DETAIL_PICTURE']['SRC'] : false);
				// show active date period
				$bActiveDate = strlen($arItem['DISPLAY_PROPERTIES']['PERIOD']['VALUE']) || ($arItem['DISPLAY_ACTIVE_FROM'] && in_array('DATE_ACTIVE_FROM', $arParams['FIELD_CODE']));
				?>
				<div class="col-md-12">
					<div class="item_wrap shadow border">
						<div class="item<?=($imageSrc ? '' : ' wti')?><?=($bActiveDate ? ' wdate' : '')?> clearfix" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
							<?if($imageSrc):?>
								<div class="image">
									<?if($bDetailLink):?>
										<a href="<?=$arItem['DETAIL_PAGE_URL']?>">
									<?endif;?>
										<img src="<?=$imageSrc?>" alt="<?=($bImage ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($bImage ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" class="img-responsive" />
									<?if($bDetailLink):?>
										</a>
									<?endif;?>
								</div>
							<?endif;?>
							<div class="info">
								<?// section title?>
								<?if(isset($arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]) && strlen($arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['NAME'])):?>
									<div class="section_name font_upper"><?=$arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['NAME']?></div>
								<?endif;?>
								
								<?if(isset($arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]) && strlen($arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['NAME']) && $arItem['DISPLAY_ACTIVE_FROM']):?>
									<span class="separator font_upper">&mdash;</span>
								<?endif;?>

								<?// date active period?>
								<?if($bActiveDate):?>
									<div class="period font_upper">
										<?if(strlen($arItem['DISPLAY_PROPERTIES']['PERIOD']['VALUE'])):?>
											<span class="date"><?=$arItem['DISPLAY_PROPERTIES']['PERIOD']['VALUE']?></span>
										<?else:?>
											<span class="date"><?=$arItem['DISPLAY_ACTIVE_FROM']?></span>
										<?endif;?>
									</div>
								<?endif;?>
								
								<?// element name?>
								<?if(strlen($arItem['FIELDS']['NAME'])):?>
									<div class="title">
										<?if($bDetailLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="dark-color"><?endif;?>
											<?=$arItem['NAME']?>
										<?if($bDetailLink):?></a><?endif;?>
									</div>
								<?endif;?>

								<?// element preview text?>
								<?if(isset($arItem['FIELDS']['PREVIEW_TEXT']) && strlen($arItem['FIELDS']['PREVIEW_TEXT'])):?>
									<div class="previewtext">
										<?if($arItem['PREVIEW_TEXT_TYPE'] == 'text'):?>
											<p><?=$arItem['FIELDS']['PREVIEW_TEXT']?></p>
										<?else:?>
											<?=$arItem['FIELDS']['PREVIEW_TEXT']?>
										<?endif;?>
									</div>
								<?endif;?>
								
								<?// element display properties?>
								<?if($arItem['DISPLAY_PROPERTIES']):?>
									<div class="properties">
										<?foreach($arItem['DISPLAY_PROPERTIES'] as $PCODE => $arProperty):?>
											<?if(in_array($PCODE, array('PERIOD', 'TITLE_BUTTON', 'LINK_BUTTON'))) continue;?>
											<?$bIconBlock = ($PCODE == 'EMAIL' || $PCODE == 'PHONE' || $PCODE == 'SITE');?>
											<div class="inner-wrapper">
												<div class="property <?=($bIconBlock ? "icon-block" : "");?> <?=strtolower($PCODE);?>">
													<?if(!$bIconBlock):?>
														<?=$arProperty['NAME']?>:&nbsp;
													<?endif;?>
													<?if(is_array($arProperty['DISPLAY_VALUE'])):?>
														<?$val = implode('&nbsp;/&nbsp;', $arProperty['DISPLAY_VALUE']);?>
													<?else:?>
														<?$val = $arProperty['DISPLAY_VALUE'];?>
													<?endif;?>
													<?if($PCODE == 'SITE'):?>
														<!--noindex-->
														<a href="<?=(strpos($arProperty['VALUE'], 'http') === false ? 'http://' : '').$arProperty['VALUE'];?>" rel="nofollow" target="_blank">
															<?=$arProperty['VALUE'];?>
														</a>
														<!--/noindex-->
													<?elseif($PCODE == 'EMAIL'):?>
														<a href="mailto:<?=$val?>"><?=$val?></a>
													<?else:?>
														<?=$val?>
													<?endif;?>
												</div>
											</div>
										<?endforeach;?>
									</div>
								<?endif;?>
								<?if(strlen($arItem['DETAIL_PAGE_URL'])):?>
									<a class="arrow_open link" href="<?=$arItem['DETAIL_PAGE_URL']?>"></a>
								<?endif?>
							</div>
						</div>
					</div>
				</div>
			<?endforeach;?>
		</div>
	</div>
<?endif;?>
