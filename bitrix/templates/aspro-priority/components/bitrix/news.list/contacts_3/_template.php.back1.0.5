<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<div class="item-views-wrapper <?=$templateName;?>">
	
	<?if($arResult['SECTIONS']):?>
		<div class="maxwidth-theme">
			<div class="row">
				<div class="col-md-12">
					<div class="contacts-stores">
						<?foreach($arResult['SECTIONS'] as $si => $arSection):?>
							<?$bHasSection = (isset($arSection['SECTION']) && $arSection['SECTION'])?>
							<?if($bHasSection):?>
								<?// edit/add/delete buttons for edit mode
								$arSectionButtons = CIBlock::GetPanelButtons($arSection['SECTION']['IBLOCK_ID'], 0, $arSection['SECTION']['ID'], array('SESSID' => false, 'CATALOG' => true));
								$this->AddEditAction($arSection['SECTION']['ID'], $arSectionButtons['edit']['edit_section']['ACTION_URL'], CIBlock::GetArrayByID($arSection['SECTION']['IBLOCK_ID'], 'SECTION_EDIT'));
								$this->AddDeleteAction($arSection['SECTION']['ID'], $arSectionButtons['edit']['delete_section']['ACTION_URL'], CIBlock::GetArrayByID($arSection['SECTION']['IBLOCK_ID'], 'SECTION_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
								<div class="section_name" id="<?=$this->GetEditAreaId($arSection['SECTION']['ID'])?>">
									<h4><?=$arSection['SECTION']['NAME'];?></h4>
								</div>
							<?endif;?>
							<?foreach($arSection['ITEMS'] as $i => $arItem):?>
								<?
								// edit/add/delete buttons for edit mode
								$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
								$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
								// use detail link?
								$bDetailLink = $arParams['SHOW_DETAIL_LINK'] != 'N' && (!strlen($arItem['DETAIL_TEXT']) ? ($arParams['HIDE_LINK_WHEN_NO_DETAIL'] !== 'Y' && $arParams['HIDE_LINK_WHEN_NO_DETAIL'] != 1) : true);
								// preview picture
								$bImage = strlen($arItem['FIELDS']['PREVIEW_PICTURE']['SRC']);
								$imageSrc = ($bImage ? $arItem['FIELDS']['PREVIEW_PICTURE']['SRC'] : false);
								$imageDetailSrc = ($bImage ? $arItem['FIELDS']['DETAIL_PICTURE']['SRC'] : false);
								?>

								<div class="item border shadow<?=(!$bImage ? ' wti' : '')?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
									<div class="row">
										<div class="col-md-6 col-sm-6 left-block">
											<?if($imageSrc):?>
												<div class="image pull-left">
													<?if($imageSrc):?>
														<img src="<?=$imageSrc;?>" alt="<?=$arItem['NAME'];?>" title="<?=$arItem['NAME'];?>" class="img-responsive"/>
													<?endif;?>
												</div>
											<?endif;?>
											<div class="top-wrap">
												<div class="title"><?=$arItem['NAME'];?></div>
												<div class="middle-prop">
													<?if($arItem['PROPERTIES']['MAP']['VALUE']):?>
														<div class="show_on_map font_upper"><span data-coordinates="<?=$arItem['PROPERTIES']['MAP']['VALUE'];?>">
															<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/show_on_map.svg');?>
															<?=GetMessage('SHOW_ON_MAP')?>
														</span></div>
													<?endif;?>
													<?if($arItem['PROPERTIES']['METRO']['VALUE']):?>
														<div class="metro font_upper"><span><?=$arItem['PROPERTIES']['METRO']['VALUE'];?></span></div>
													<?endif;?>
												</div>
												<?if($arItem['PROPERTIES']['SCHEDULE']['VALUE']):?>
													<div class="schedule"><span class="text font_xs"><?=$arItem['PROPERTIES']['SCHEDULE']['~VALUE']['TEXT'];?></span></span></div>
												<?endif;?>
												<div class="item-body media">
													<?if($arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE']):?>
														<div class="phones">
															<?foreach($arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE'] as $phone):?>
																<div class="phone">
																	<a href="tel:+<?=str_replace(array(' ', ',', '-', '(', ')'), '', $phone);?>" class="black"><?=$phone;?></a>
																</div>
															<?endforeach;?>
														</div>
													<?endif?>
													<?if($arItem['DISPLAY_PROPERTIES']['EMAIL']['VALUE']):?>
														<div class="emails">
															<?foreach($arItem['DISPLAY_PROPERTIES']['EMAIL']['VALUE'] as $email):?>
																<div class="email">
																	<a class="dark-color" href="mailto:<?=$email?>"><?=$email;?></a>
																</div>
															<?endforeach;?>
														</div>
													<?endif?>
												</div>
												<div class="button media">
													<span class="btn btn-default btn-xs btn-transparent animate-load question" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_question")?>" data-name="question"><?=(isset($arParams['S_FEEDBACK_BUTTON']) && $arParams['S_FEEDBACK_BUTTON'] ? $arParams['S_FEEDBACK_BUTTON'] : GetMessage('S_FEEDBACK_BUTTON'));?></span>
												</div>
											</div>
										</div>
										<div class="col-md-6 col-sm-6 right-block">
											<div class="button pull-right"><span class="btn btn-default btn-xs btn-transparent animate-load question" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_question")?>" data-name="question"><?=(isset($arParams['S_FEEDBACK_BUTTON']) && $arParams['S_FEEDBACK_BUTTON'] ? $arParams['S_FEEDBACK_BUTTON'] : GetMessage('S_FEEDBACK_BUTTON'));?></span></div>
											<div class="item-body">
												<div class="row">
													<?if($arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE']):?>
														<div class="phones col-md-6 col-sm-6">
															<?foreach($arItem['DISPLAY_PROPERTIES']['PHONE']['VALUE'] as $phone):?>
																<div class="phone">
																	<a href="tel:<?=str_replace(array(' ', ',', '-', '(', ')'), '', $phone);?>" class="black"><?=$phone;?></a>
																</div>
															<?endforeach;?>
														</div>
													<?endif?>
													<?if($arItem['DISPLAY_PROPERTIES']['EMAIL']['VALUE']):?>
														<div class="emails col-md-6 col-sm-6">
															<div class="email hidden-xs">
																<a class="dark-color" href="mailto:<?=$arItem['DISPLAY_PROPERTIES']['EMAIL']['VALUE'];?>"><?=$arItem['DISPLAY_PROPERTIES']['EMAIL']['VALUE'];?></a>
															</div>
														</div>
													<?endif?>
												</div>
											</div>
										</div>

									</div>
								</div>
							<?endforeach;?>
						<?endforeach;?>
					</div>
				</div>
			</div>
		</div>
	<?endif;?>
</div>