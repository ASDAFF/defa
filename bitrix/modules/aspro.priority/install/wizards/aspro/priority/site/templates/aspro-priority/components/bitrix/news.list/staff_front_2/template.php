<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc;?>
<?if($arResult['ITEMS']):?>
	<div class="item-views staff linked sections within front type_4 staff_scroll">
		<div class="maxwidth-theme">
			<div class="row">
				<div class="col-md-12">
					<?
					global $arTheme;
					$slideshowSpeed = (isset($arTheme['PARTNERSBANNER_SLIDESSHOWSPEED']['VALUE']) && abs(intval($arTheme['PARTNERSBANNER_SLIDESSHOWSPEED']['VALUE'])) ? $arTheme['PARTNERSBANNER_SLIDESSHOWSPEED']['VALUE'] : abs(intval($arTheme['PARTNERSBANNER_SLIDESSHOWSPEED'])));
					$animationSpeed = (isset($arTheme['PARTNERSBANNER_ANIMATIONSPEED']['VALUE']) && abs(intval($arTheme['PARTNERSBANNER_ANIMATIONSPEED']['VALUE'])) ? $arTheme['PARTNERSBANNER_ANIMATIONSPEED']['VALUE'] : abs(intval($arTheme['PARTNERSBANNER_ANIMATIONSPEED'])));
					$bAnimation = (bool)$slideshowSpeed;
					?>
					<?if($arParams['PAGER_SHOW_ALL']):?>
						<a class="show_all pull-right" href="<?=str_replace('#SITE'.'_DIR#', SITE_DIR, $arResult['LIST_PAGE_URL'])?>"><span><?=(strlen($arParams['SHOW_ALL_TITLE']) ? $arParams['SHOW_ALL_TITLE'] : GetMessage('S_TO_SHOW_ALL_STAFF'))?></span></a>
					<?endif;?>
					<h2><?=($arParams["TITLE"] ? $arParams["TITLE"] : Loc::getMessage("TITLE_STAFF"));?></h2>
					<div class="flexslider unstyled row front dark-nav view-control navigation-vcenter" data-plugin-options='{"directionNav": true, "controlNav" :false, "animationLoop": true, "slideshow": false, <?=($slideshowSpeed >= 0 ? '"slideshowSpeed": '.$slideshowSpeed.',' : '')?> <?=($animationSpeed >= 0 ? '"animationSpeed": '.$animationSpeed.',' : '')?> "counts": [3, 2, 2, 1], "itemMargin": 32}'>
						<ul class="slides items">
							<?foreach($arResult['ITEMS'] as $i => $arItem):?>
								<?
								// edit/add/delete buttons for edit mode
								$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
								$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
								// use detail link?
								$bDetailLink = $arParams['SHOW_DETAIL_LINK'] != 'N' && (!strlen($arItem['DETAIL_TEXT']) ? ($arParams['HIDE_LINK_WHEN_NO_DETAIL'] !== 'Y' && $arParams['HIDE_LINK_WHEN_NO_DETAIL'] != 1) : true);
								// preview image
								$bImage = strlen($arItem['FIELDS']['PREVIEW_PICTURE']['SRC']);
								$imageSrc = ($bImage ? $arItem['FIELDS']['PREVIEW_PICTURE']['SRC'] : SITE_TEMPLATE_PATH.'/images/svg/noimage_staff.svg');

								// show active date period
								$bActiveDate = strlen($arItem['DISPLAY_PROPERTIES']['PERIOD']['VALUE']) || ($arItem['DISPLAY_ACTIVE_FROM'] && in_array('DATE_ACTIVE_FROM', $arParams['FIELD_CODE']));
								?>
								<li class="item-wrap">
									<div class="item">
										<div class="wrap shadow clearfix" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
											<?if($imageSrc):?>
												<div class="image<?=($bImage ? "" : " wti" );?>">
													<div class="wrap">
														<?if($bDetailLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?endif;?>
															<?$img = ($bImage ? CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width' => 560, 'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array());?>
															<?$img['src'] = (strlen($img['src']) ? $img['src'] : SITE_TEMPLATE_PATH.'/images/svg/noimage_staff.svg');?>
															<img class="img-responsive" src="<?=$img['src']?>" alt="<?=($bImage ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($bImage ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" />
														<?if($bDetailLink):?></a><?endif;?>
													</div>
												</div>
											<?endif;?>
											<div class="body-info">
												<div class="wrap">
													<div class="top-block-wrapper">
														<?// post?>
														<?if((isset($arItem['PROPERTIES']['POST']) && $arItem['PROPERTIES']['POST']) && (isset($arItem['PROPERTIES']['POST']['VALUE']) && $arItem['PROPERTIES']['POST']['VALUE'])):?>
															<div class="post font_upper"><?=$arItem['PROPERTIES']['POST']['VALUE'];?></div>
														<?endif;?>
														<?// element name?>
														<?if(strlen($arItem['FIELDS']['NAME'])):?>
															<div class="title">
																<?if($bDetailLink):?><a class="dark-color" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?endif;?>
																	<?=$arItem['NAME']?>
																<?if($bDetailLink):?></a><?endif;?>
															</div>
														<?endif;?>
													</div>

													<?// props?>
													<?if((isset($arItem['MIDDLE_PROPS']) && $arItem['MIDDLE_PROPS']) || (isset($arItem['DISPLAY_PROPERTIES']['SEND_MESSAGE_BUTTON']) && $arItem['DISPLAY_PROPERTIES']['SEND_MESSAGE_BUTTON']['VALUE_XML_ID'] == 'Y')):?>
														<div class="middle-props bottom-block">
															<?if(isset($arItem['MIDDLE_PROPS']) && $arItem['MIDDLE_PROPS']):?>
																<div class="props">
																	<?foreach($arItem['MIDDLE_PROPS'] as $key => $arProp):?>
																		<div class="prop">
																			<div class="title-prop font_upper"><?=$arProp['NAME']?></div>
																			<div class="value font_sm"><?if($key == 'EMAIL'):?><!-- noindex --><a class="dark-color" href="mailto:<?=$arProp['VALUE'];?>" target="_blank" rel="nofollow"><?endif;?><?=$arProp['VALUE'];?><?if($key == 'EMAIL'):?></a><!-- /noindex --><?endif;?></div>
																		</div>
																	<?endforeach;?>
																</div>
															<?endif?>
															<?if(isset($arItem['SOCIAL_PROPS']) && $arItem['SOCIAL_PROPS']):?>
																<div class="bottom-props social_props">
																	<!-- noindex -->
																		<?foreach($arItem['SOCIAL_PROPS'] as $arProp):?>
																			<a href="<?=$arProp['VALUE'];?>" target="_blank" rel="nofollow" class="value <?=strtolower($arProp['CODE']);?>"><?=$arProp['VALUE'];?>
																				<?=(isset($arProp['FILE']) && $arProp['FILE'] ? CPriority::showIconSvg($arProp['FILE']) : '');?>
																			</a>
																		<?endforeach;?>
																	<!-- /noindex -->
																</div>
															<?endif;?>
															
															<?if(isset($arItem['DISPLAY_PROPERTIES']['SEND_MESSAGE_BUTTON']) && $arItem['DISPLAY_PROPERTIES']['SEND_MESSAGE_BUTTON']['VALUE_XML_ID'] == 'Y'):?>
																<div class="send_message_button">
																	<span class="animate-load btn btn-default btn-xs" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_question_staff");?>" data-autoload-staff="<?=CPriority::formatJsName($arItem['NAME']);?>" data-name="question_staff"><?=(strlen($arParams['SEND_MESSAGE_BUTTON_TEXT']) ? $arParams['SEND_MESSAGE_BUTTON_TEXT'] : Loc::getMessage('SEND_MESSAGE_BUTTON_TEXT'))?></span>
																</div>
															<?endif?>												
														</div>
													<?endif;?>
												</div>
											</div>
											<?if($bDetailLink):?>
												<a class="link_absolute" href="<?=$arItem['DETAIL_PAGE_URL']?>"></a>
											<?endif;?>
										</div>
									</div>
								</li>
							<?endforeach;?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
<?endif;?>