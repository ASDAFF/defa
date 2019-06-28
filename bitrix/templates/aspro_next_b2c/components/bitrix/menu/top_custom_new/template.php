<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?$this->setFrameMode(true);?>
<?
global $arTheme;
$iVisibleItemsMenu = ($arTheme['MAX_VISIBLE_ITEMS_MENU']['VALUE'] ? $arTheme['MAX_VISIBLE_ITEMS_MENU']['VALUE'] : 10);
?>
<?if($arResult):?>
	<div class="table-menu">
		<ul>
			<!--<tr>-->
				<?foreach($arResult as $arItem):?>

					<?$bShowChilds = $arParams["MAX_LEVEL"] > 1;
					$bWideMenu = (isset($arItem['PARAMS']['CLASS']) && strpos($arItem['PARAMS']['CLASS'], 'wide_menu') !== false);?>
					<li class="menu-item unvisible <?=($arItem["CHILD"] ? "dropdown" : "")?> <?=(isset($arItem["PARAMS"]["CLASS"]) ? $arItem["PARAMS"]["CLASS"] : "");?>  <?=($arItem["SELECTED"] ? "active" : "")?>" style="display: <?=($arItem["ACTIVE"] ? "none" : "")?>;">
						<div class="wrap">
							<a class="<?=($arItem["CHILD"] && $bShowChilds ? "dropdown-toggle" : "")?> js-info-section-1" data-id="<?=$arItem['PARAMS']['ID']?>" href="<?=$arItem["LINK"]?>">

                                <div>
									<?if(isset($arItem["PARAMS"]["CLASS"]) && strpos($arItem["PARAMS"]["CLASS"], "sale_icon") !== false):?>
										<?=CNext::showIconSvg('sale', SITE_TEMPLATE_PATH.'/images/svg/Sale.svg', '', '');?>
									<?endif;?>
									<?=$arItem["TEXT"]?>
									<div class="line-wrapper"><span class="line"></span></div>
								</div>
							</a>
							<?if($arItem["CHILD"] && $bShowChilds):?>
								<span class="tail"></span>
                            <div class="level-2">
								<div class="level-2-wrap dropdown-menu">
								<ul class="">
									<?foreach($arItem["CHILD"] as $arSubItem):?>
										<?$bShowChilds = $arParams["MAX_LEVEL"] > 2;?>
										<?$bHasPicture = (isset($arSubItem['PARAMS']['PICTURE']) && $arSubItem['PARAMS']['PICTURE'] && $arTheme['SHOW_CATALOG_SECTIONS_ICONS']['VALUE'] == 'Y');?>
                                        <li class="lev-2-link <?=($arSubItem["SELECTED"] ? "active" : "")?> <?=($bHasPicture ? "has_img" : "")?>">
											<?if($bHasPicture && $bWideMenu):
												$arImg = CFile::ResizeImageGet($arSubItem['PARAMS']['PICTURE'], array('width' => 60, 'height' => 60), BX_RESIZE_PROPORTIONAL_ALT);
												if(is_array($arImg)):?>
													<div class="menu_img"><img src="<?=$arImg["src"]?>" alt="<?=$arSubItem["TEXT"]?>" title="<?=$arSubItem["TEXT"]?>" /></div>
												<?endif;?>
											<?endif;?>
											<a class="dropdown-toggle js-info-section " data-id="<?=$arSubItem['PARAMS']['ID']?>" href="<?=$arSubItem["LINK"]?>" title="<?=$arSubItem["TEXT"]?>"><span class="name"><?=$arSubItem["TEXT"]?></span><?=($arSubItem["CHILD"] && $bShowChilds ? '<span class="arrow"><i></i></span>' : '')?></a>
											<?if($arSubItem["CHILD"] && $bShowChilds):?>
												<?$iCountChilds = count($arSubItem["CHILD"]);?>
                                                <div class="level-3">
												<ul class="level-3-wrap  dropdown-menu">
													<?foreach($arSubItem["CHILD"] as $key => $arSubSubItem):?>
														<?$bShowChilds = $arParams["MAX_LEVEL"] > 3;?>
														<?$arLevelIndex = array();
														?>
														<li class="<?=(++$key > $iVisibleItemsMenu ? 'collapsed' : '');?> <?=($arSubSubItem["CHILD"] && $bShowChilds && !empty($arLevelIndex) ? "dropdown-submenu" : "")?> <?/*=($arSubSubItem["SELECTED"] ? "active" : "")*/?>">
															<a class="js-info-section" data-id="<?=$arSubSubItem['PARAMS']['ID']?>" href="<?=$arSubSubItem["LINK"]?>" title="<?=$arSubSubItem["TEXT"]?>"><span class="name"><?=$arSubSubItem["TEXT"]?></span>
                                                                <?/*if($arSubSubItem['PARAMS']['MODEL']):*/?><!--
                                                                <span class="i">i</span>
                                                                --><?/*endif;*/?>
                                                            </a>
															<?if($arSubSubItem["CHILD"] && $bShowChilds):?>

																<?if(!empty($arLevelIndex)) :?>
																<ul class="">
																	<?foreach ($arLevelIndex as $levelIndex):?>
																		<div class="row">
																		<?foreach ($levelIndex as $indexSection):?>
																			<?$arSubSubSubItem = $arSubSubItem["CHILD"][$indexSection];
																			$arImg = $arSubSubSubItem['PROPERTIES']['PICTURE_RESIZE']?>
																			<div class=" <?=($arSubSubSubItem["SELECTED"] ? "active" : "")?>">
																				<a href="<?=$arSubSubSubItem["LINK"]?>" title="<?=$arSubSubSubItem["TEXT"]?>">
																					<?if(is_array($arImg)):?>
																						<div class="menu_img"><img src="<?=$arImg["src"]?>" alt="<?=$arSubSubSubItem["TEXT"]?>" title="<?=$arSubSubSubItem["TEXT"]?>" /></div>
																					<?endif;?>
																					<span class="name"><?=$arSubSubSubItem["TEXT"]?></span>
																				</a>
																			</div>
																		<?endforeach;?>
																		</div>
																	<?endforeach;?>
                                                                    <a class="more-item-link" href="<?=$arSubSubItem["LINK"]?>">Посмотреть все</a>
																</ul>
																<?endif;?>
															<?endif;?>
														</li>
													<?endforeach;?>
													<?if($iCountChilds > $iVisibleItemsMenu && $bWideMenu):?>
														<li><span class="colored more_items with_dropdown"><?=\Bitrix\Main\Localization\Loc::getMessage("S_MORE_ITEMS");?></span></li>
													<?endif;?>
												</ul>
                                                </div>
											<?endif;?>
										</li>
									<?endforeach;?>
                                </ul>

                                    <div class="popup sectionContainer">
                                        <div class="wrap" id="ajax-sectionContainer"></div>
                                    </div>
								</div>
                            </div>
							<?endif;?>
						</div>
					</li>
				<?endforeach;?>

				<!--<li class="menu-item dropdown js-dropdown nosave unvisible">
					<div class="wrap">
						<a class="dropdown-toggle more-items" href="#">
							<span><?/*=\Bitrix\Main\Localization\Loc::getMessage("S_MORE_ITEMS");*/?></span>
						</a>
						<span class="tail"></span>
						<ul class="dropdown-menu"></ul>
					</div>
				</li>-->

			<!--</tr>-->
		</ul>
	</div>
<?endif;?>