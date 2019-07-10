<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);

use \Bitrix\Main\Localization\Loc;

$arParams['COUNT_IN_LINE'] = (isset($arParams['COUNT_IN_LINE']) ? intval($arParams['COUNT_IN_LINE']) : 3);
$arParams['COUNT_IN_LINE'] = (($arParams['COUNT_IN_LINE'] >= 1 && $arParams['COUNT_IN_LINE'] <= 6) ? $arParams['COUNT_IN_LINE'] : 3);
?>
<?if($arResult['SECTIONS']):?>
	<div class="item-views partners within">
		<?// top pagination?>
		<?if($arParams["DISPLAY_TOP_PAGER"]):?>
			<div class="pagination_nav">
				<?=$arResult["NAV_STRING"]?>
			</div>
		<?endif;?>
		<div class="<?=($arParams['SHOW_TABS'] == 'Y' ? 'tab-content' : 'group-content')?>">
			<?// group elements by sections?>
			<?foreach($arResult['SECTIONS'] as $SID => $arSection):?>
				<?
				// edit/add/delete buttons for edit mode
				$arSectionButtons = CIBlock::GetPanelButtons($arSection['IBLOCK_ID'], 0, $arSection['ID'], array('SESSID' => false, 'CATALOG' => true));
				$this->AddEditAction($arSection['ID'], $arSectionButtons['edit']['edit_section']['ACTION_URL'], CIBlock::GetArrayByID($arSection['IBLOCK_ID'], 'SECTION_EDIT'));
				$this->AddDeleteAction($arSection['ID'], $arSectionButtons['edit']['delete_section']['ACTION_URL'], CIBlock::GetArrayByID($arSection['IBLOCK_ID'], 'SECTION_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div id="<?=$this->GetEditAreaId($arSection['ID'])?>" class="tab-pane <?=(!$si++ || !$arSection['ID'] ? 'active' : '')?>">

					<?if($arParams['SHOW_SECTION_PREVIEW_DESCRIPTION'] == 'Y'):?>

						<?if($arParams['SHOW_SECTION_NAME'] != 'N'):?>
							<?// section name?>
							<?if(strlen($arSection['NAME'])):?>
								<h3><?=$arSection['NAME']?></h3>
							<?endif;?>
						<?endif;?>

						<?// section description text/html?>
						<?if(strlen($arSection['DESCRIPTION']) && strpos($_SERVER['REQUEST_URI'], 'PAGEN') === false):?>
							<div class="text_before_items">
								<?=$arSection['DESCRIPTION']?>
							</div>
							<?if($arParams['SHOW_SECTION_DESC_DIVIDER'] == 'Y'):?>
								<hr class="sect-divider" />
							<?endif;?>
						<?endif;?>
					<?endif;?>

					<?// show section items?>
					<?if($arParams['VIEW_TYPE'] !== 'accordion'):?>
						<div class="row sid items">
					<?endif;?>
						<?foreach($arSection['ITEMS'] as $i => $arItem):?>
							<?
							// edit/add/delete buttons for edit mode
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
							// use detail link?
							$bDetailLink = $arParams['SHOW_DETAIL_LINK'] != 'N' && (!strlen($arItem['DETAIL_TEXT']) ? ($arParams['HIDE_LINK_WHEN_NO_DETAIL'] !== 'Y' && $arParams['HIDE_LINK_WHEN_NO_DETAIL'] != 1) : true);
							// preview picture
							$bImage = (isset($arItem['FIELDS']['PREVIEW_PICTURE']) && strlen($arItem['PREVIEW_PICTURE']['SRC']));
							$nImageID = ($bImage ? (is_array($arItem['FIELDS']['PREVIEW_PICTURE']) ? $arItem['FIELDS']['PREVIEW_PICTURE']['ID'] : $arItem['FIELDS']['PREVIEW_PICTURE']) : "");
							$arImage = ($bImage ? CFile::ResizeImageGet($nImageID, array('width' => 388, 'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL, true) : SITE_TEMPLATE_PATH.'/images/noimage.png');
							$imageSrc = $arImage['src'];
							// show active date period
							$bActiveDate = strlen($arItem['DISPLAY_PROPERTIES']['PERIOD']['VALUE']) || ($arItem['DISPLAY_ACTIVE_FROM'] && in_array('DATE_ACTIVE_FROM', $arParams['FIELD_CODE']));
							?>

							<?ob_start();?>
								<?// element name?>
								<?if(strlen($arItem['FIELDS']['NAME'])):?>
									<div class="title">
										<?if($bDetailLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="dark-color"><?endif;?>
											<?=$arItem['NAME']?>
										<?if($bDetailLink):?></a><?endif;?>
									</div>
								<?endif;?>

								<?// date active period?>
								<?if($bActiveDate):?>
									<div class="period">
										<?if(strlen($arItem['DISPLAY_PROPERTIES']['PERIOD']['VALUE'])):?>
											<span class="date"><?=$arItem['DISPLAY_PROPERTIES']['PERIOD']['VALUE']?></span>
										<?else:?>
											<span class="date"><?=$arItem['DISPLAY_ACTIVE_FROM']?></span>
										<?endif;?>
									</div>
									<?unset($arItem['DISPLAY_PROPERTIES']['PERIOD']);?>
								<?endif;?>

								<?// element preview text?>
								<div class="previewtext font_xs">
									<?if(strlen($arItem['FIELDS']['PREVIEW_TEXT']) || strlen($arItem['FIELDS']['DETAIL_TEXT'])):?>
										<div>
											<?if(strlen($arItem['FIELDS']['PREVIEW_TEXT'])):?>
												<?if($arItem['PREVIEW_TEXT_TYPE'] == 'text'):?>
													<p><?=$arItem['FIELDS']['PREVIEW_TEXT']?></p>
												<?else:?>
													<?=$arItem['FIELDS']['PREVIEW_TEXT']?>
												<?endif;?>
											<?endif;?>
										</div>

										<?// element detail text?>
										<div>
											<?if(strlen($arItem['FIELDS']['DETAIL_TEXT'])):?>
												<?if($arItem['DETAIL_TEXT_TYPE'] == 'text'):?>
													<p><?=$arItem['FIELDS']['DETAIL_TEXT']?></p>
												<?else:?>
													<?=$arItem['FIELDS']['DETAIL_TEXT']?>
												<?endif;?>
											<?endif;?>
										</div>
									<?endif;?>
								</div>

								<?// button?>
								<?if(strlen($arItem['DISPLAY_PROPERTIES']['TITLE_BUTTON']['VALUE']) && strlen($arItem['DISPLAY_PROPERTIES']['LINK_BUTTON']['VALUE'])):?>
									<div>
										<a class="btn btn-default btn-sm" href="<?=$arItem['DISPLAY_PROPERTIES']['LINK_BUTTON']['VALUE']?>" target="_blank">
											<?=$arItem['DISPLAY_PROPERTIES']['TITLE_BUTTON']['VALUE']?>
										</a>
									</div>
									<?unset($arItem['DISPLAY_PROPERTIES']['TITLE_BUTTON']);?>
									<?unset($arItem['DISPLAY_PROPERTIES']['LINK_BUTTON']);?>
								<?endif;?>

								<?// element display properties?>
								<?if($arItem['DISPLAY_PROPERTIES']):?>
									<div class="properties">
										<?foreach($arItem['DISPLAY_PROPERTIES'] as $PCODE => $arProperty):?>
											<?if($arProperty['DISPLAY_VALUE']):?>
												<?if(in_array($PCODE, array('PERIOD', 'TITLE_BUTTON', 'LINK_BUTTON'))) continue;?>
												<div class="property <?=strtolower($PCODE);?>">
													<div class="title-prop font_upper"><?=$arProperty['NAME']?></div>
													<div class="value">
														<?if(is_array($arProperty['DISPLAY_VALUE'])):?>
															<?$val = implode('&nbsp;/&nbsp;', $arProperty['DISPLAY_VALUE']);?>
														<?else:?>
															<?$val = $arProperty['DISPLAY_VALUE'];?>
														<?endif;?>
														<?if($PCODE == 'SITE'):?>
															<!--noindex-->
															<a href="<?=(strpos($arProperty['VALUE'], 'http') === false ? 'http://' : '').$arProperty['VALUE'];?>" rel="nofollow" target="_blank">
																<?=strpos($arProperty['VALUE'], '?') === false ? $arProperty['VALUE'] : explode('?', $arProperty['VALUE'])[0]?>
															</a>
															<!--/noindex-->
														<?elseif($PCODE == 'EMAIL'):?>
															<a href="mailto:<?=$val?>"><?=$val?></a>
														<?else:?>
															<?=$val?>
														<?endif;?>
													</div>
												</div>
											<?endif;?>
										<?endforeach;?>
									</div>
								<?endif;?>
							<?$textPart = ob_get_clean();?>

							<?ob_start();?>
								<?if($bImage):?>
									<div class="image <?=($bImage ? '' : ' wti')?>">
										<?if($bDetailLink):?>
											<a href="<?=$arItem['DETAIL_PAGE_URL']?>">
										<?elseif($arItem['FIELDS']['DETAIL_PICTURE']):?>
											<a href="<?=$imageDetailSrc?>" alt="<?=($bImage ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($bImage ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" class="img-inside fancybox">
										<?endif;?>
											<img src="<?=$imageSrc?>" alt="<?=($bImage ? $arItem['FIELDS']['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($bImage ? $arItem['FIELDS']['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" class="img-responsive" />
										<?if($bDetailLink):?>
											</a>
										<?elseif($arItem['FIELDS']['DETAIL_PICTURE']):?>
											<span class="zoom"></span></a>
										<?endif;?>
									</div>
								<?endif;?>
							<?$imagePart = ob_get_clean();?>

							<?if($arParams['VIEW_TYPE'] == 'list'):?>
								<div class="col-md-12">
									<div class="item border shadow<?=($bImage ? '' : ' wti')?> clearfix noborder" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
										<?if($bImage):?>
											<?=$imagePart?>
										<?endif;?>
										<div class="body-info">
											<?=$textPart?>
											<?if($bDetailLink):?>
												<div class="link-block-more">
													<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="btn-inline sm rounded black"><?=GetMessage('TO_ALL')?><i class="fa fa-angle-right"></i></a>
												</div>
											<?endif;?>
										</div>
									</div>
									<hr />
								</div>
							<?elseif($arParams['VIEW_TYPE'] == 'table'):?>
								<div class="item-wrap col-md-4 col-sm-6 col-xs-6 count_<?=$arParams['COUNT_IN_LINE']?>">
									<div class="item border shadow<?=($bImage ? '' : ' wti')?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
										<div class="row">
											<div class="col-md-12">
												<?if(!$bImage):?>
													<div class="text"><?=$textPart?></div>
												<?else:?>
													<?=$imagePart?>
													<div class="text"><?=$textPart?></div>
												<?endif;?>
											</div>
										</div>
									</div>
								</div>
							<?elseif($arParams['VIEW_TYPE'] == 'accordion'):?>
								<div class="accordion-type-1">
									<div class="item border shadow<?=($bImage ? '' : ' wti')?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
										<div class="accordion-head accordion-close" data-toggle="collapse" data-parent="#accordion<?=$arSection['ID']?>" href="#accordion<?=$arItem['ID']?>_<?=$arSection['ID']?>">
											<span><?=$arItem['NAME']?><i class="fa fa-angle-down"></i></span>
											<?if(in_array('PAY', $arParams['PROPERTY_CODE'])):?>
												<div class="pay">
													<?if($arItem['DISPLAY_PROPERTIES']['PAY']['VALUE']):?>
														<?=GetMessage('PAY_ABOUT')?>&nbsp;<b><?=$arItem['DISPLAY_PROPERTIES']['PAY']['VALUE']?></b>
													<?else:?>
														<?=GetMessage('PAY_INTERVIEWS')?>
													<?endif;?>
												</div>
											<?endif;?>
										</div>
										<div id="accordion<?=$arItem['ID']?>_<?=$arSection['ID']?>" class="panel-collapse collapse">
											<div class="accordion-body">
												<div class="row">
													<?if(!$bImage):?>
														<div class="col-md-12"><div class="text"><?=$textPart?></div></div>
													<?elseif($arParams["IMAGE_POSITION"] == "right"):?>
														<div class="col-md-9"><div class="text"><?=$textPart?></div></div>
														<div class="col-md-3"><?=$imagePart?></div>
													<?else:?>
														<div class="col-md-3"><?=$imagePart?></div>
														<div class="col-md-9"><div class="text"><?=$textPart?></div></div>
													<?endif;?>
												</div>
											</div>
										</div>
									</div>
								</div>
							<?endif;?>
						<?endforeach;?>
					<?if($arParams['VIEW_TYPE'] !== 'accordion'):?>
						</div>
					<?endif;?>
				</div>
			<?endforeach;?>
		</div>
		<?// bottom pagination?>
		<?if($arParams['DISPLAY_BOTTOM_PAGER']):?>
			<div class="pagination_nav">
				<?=$arResult['NAV_STRING']?>
			</div>
		<?endif;?>
	</div>
<?endif;?>