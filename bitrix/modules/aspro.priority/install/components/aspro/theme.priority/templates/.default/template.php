<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(false);?>
<?/*<span id="change_block_overlay"></span>*/?>
<?$customColorExist = isset($arResult['BASE_COLOR']['LIST']['CUSTOM']) && isset($arResult['BASE_COLOR_CUSTOM']);?>
<?if($_COOKIE['styleSwitcher'] == 'open'):?>
	<div class="jqmOverlay waiting"></div>
<?endif;?>

<div class="style-switcher new1 <?=$_COOKIE['styleSwitcher'] == 'open' ? 'active' : ''?>">
	<div class="switch animation-bg">
		<svg xmlns="http://www.w3.org/2000/svg" width="22" height="24" viewBox="0 0 22 24">
		  <defs>
		    <style>
		      .cls-2 {
		        fill: #333;
		        fill-rule: evenodd;
		      }
		    </style>
		  </defs>
		  <path data-name="Ellipse 12 copy 2" class="cls-2" d="M743,214H732.858a3.981,3.981,0,0,1-7.717,0H723a1,1,0,1,1,0-2h2.141a3.981,3.981,0,0,1,7.717,0H743A1,1,0,1,1,743,214Zm-14-3a2,2,0,1,0,2,2A2,2,0,0,0,729,211Zm14-5h-2.142a3.981,3.981,0,0,1-7.717,0H723a1,1,0,0,1,0-2h10.141a3.981,3.981,0,0,1,7.717,0H743A1,1,0,0,1,743,206Zm-6-3a2,2,0,1,0,2,2A2,2,0,0,0,737,203Zm-14,17h10.141a3.982,3.982,0,0,1,7.717,0H743a1,1,0,0,1,0,2h-2.142a3.982,3.982,0,0,1-7.717,0H723A1,1,0,0,1,723,220Zm14,3a2,2,0,1,0-2-2A2,2,0,0,0,737,223Z" transform="translate(-722 -201)"></path>
		</svg>		
	</div>
	<?if(CSite::inDir(SITE_DIR."index.php")):?>
		<?
		$bActive = (isset($_COOKIE['OVERSITE_PANEL_SHOW']) && $_COOKIE['OVERSITE_PANEL_SHOW'] == 'Y' ? true : false);
		?>
		<div class="oversite_button animation-bg<?=($bActive ? ' active' : '');?>"<?=($bActive ? ' title="'.GetMessage('DEACTIVATE_PANEL_OVERSITE').'"' : '');?>>
			<?if($bActive):?>
				<svg class="close_svg" height="17.969" viewBox="0 0 18 17.969">
					<path d="M845.413,248.984l7.3,7.292a1,1,0,0,1-1.417,1.412L844,250.4l-7.3,7.291a1,1,0,1,1-1.417-1.412l7.3-7.292-7.3-7.292a1,1,0,1,1,1.417-1.412l7.3,7.291,7.3-7.291a1,1,0,0,1,1.417,1.412Z" transform="translate(-835 -240)"/>
				</svg>
			<?else:?>
				<svg width="28" height="28" viewBox="0 0 28 28">
					<path d="M880.6,254.8l-5.8,5.8a8.2,8.2,0,0,1-11.6,0l-5.8-5.8a8.2,8.2,0,0,1,0-11.6l5.8-5.8a8.2,8.2,0,0,1,11.6,0l5.8,5.8A8.2,8.2,0,0,1,880.6,254.8Zm-1.425-10.181-5.822-5.822a6.174,6.174,0,0,0-8.733,0l-5.822,5.822a6.174,6.174,0,0,0,0,8.733l5.822,5.822a6.176,6.176,0,0,0,8.733,0l5.822-5.822A6.176,6.176,0,0,0,879.173,244.618Zm-2.452,7.076a0.993,0.993,0,0,1-1.4-1.407l1.3-1.3-1.328-1.293a1,1,0,0,1,0-1.407,0.987,0.987,0,0,1,1.4,0l2.04,1.986a1,1,0,0,1,0,1.407ZM869,253a4,4,0,1,1,4-4A4,4,0,0,1,869,253Zm0-6a2,2,0,1,0,2,2A2,2,0,0,0,869,247Zm1.287-4.314-1.3-1.3-1.293,1.331a0.994,0.994,0,1,1-1.407-1.4l1.986-2.042a1,1,0,0,1,1.407,0l2.017,2.011A0.994,0.994,0,1,1,870.287,242.686Zm-2.6,12.6,1.293,1.33,1.3-1.3a0.993,0.993,0,1,1,1.407,1.4l-2.017,2.012a1,1,0,0,1-1.407,0l-1.986-2.043A0.993,0.993,0,1,1,867.691,255.283Zm-6.277-6.3,1.3,1.3a0.993,0.993,0,1,1-1.4,1.407l-2.008-2.017a1,1,0,0,1,0-1.407l2.039-1.986a0.987,0.987,0,0,1,1.4,0,1,1,0,0,1,0,1.407Z" transform="translate(-855 -235)"/>
				</svg>
				<div class="tooltip">
					<div class="wrap">
						<div class="title"><?=GetMessage('OVERSITE_PANEL_TITLE');?></div>
						<div class="text"><?=GetMessage('OVERSITE_PANEL_HINT');?></div>
						<div class="image"><img src="<?=$this->__folder?>/images/Gif.gif"></div>
					</div>
				</div>
			<?endif;?>
		</div>
	<?endif;?>
	<div class="header <?=($arResult['CAN_SAVE'] ? 'can_save' : '')?>">
		<div class="buttons clearfix">
			<div class="button first">
				<div class="header-inner animation-bg reset">
					<svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12">
					  <path class="cls-1" d="M294,40h-3a1,1,0,1,1,0-2h0.43a3.951,3.951,0,0,0-6.367-.7l-2.132-.486A5.935,5.935,0,0,1,293,36.766V36a1,1,0,1,1,2,0v3A1,1,0,0,1,294,40Zm-8,1a1,1,0,0,1-1,1h-0.447a3.971,3.971,0,0,0,6.207.885l2.191,0.5A5.954,5.954,0,0,1,283,43.247V44a1,1,0,1,1-2,0V41a1,1,0,0,1,1-1h3A1,1,0,0,1,286,41Z" transform="translate(-281 -34)"></path>
					</svg>
					<?=GetMessage('THEME_DEFAULT')?>
				</div>
			</div>
			<?if($arResult['CAN_SAVE']):?>
				<div class="button second">
					<div class="save_btn animation-bg" title="<?=GetMessage("SAVE_CONFIG")?>">
						<span>
							<svg width="16" height="14" viewBox="0 0 16 14">
								<path d="M624,254H612a2,2,0,0,1-2-2v-8a2,2,0,0,1,2-2h3v2h-3v8h12v-8h-3v-2h3a2,2,0,0,1,2,2v8A2,2,0,0,1,624,254Zm-5.279-4.295a0.907,0.907,0,0,1-.291.193,0.993,0.993,0,0,1-.315.079h0A0.9,0.9,0,0,1,618,250a0.837,0.837,0,0,1-.179-0.044,0.971,0.971,0,0,1-.193-0.047,112.157,112.157,0,0,0-.307-0.2c-0.009-.01-0.012-0.022-0.021-0.032s-0.05-.033-0.068-0.057l-1.949-1.923a0.991,0.991,0,1,1,1.4-1.4L617,246.6V241a1,1,0,0,1,2,0v5.618l0.3-.3a0.991,0.991,0,0,1,1.4,1.4Z" transform="translate(-610 -240)"/>
							</svg>
							<?=GetMessage('SAVE_CONFIG');?>
						</span>
					</div>
				</div>
			<?endif;?>
		</div>
	</div>
	<form method="POST" name="style-switcher">
		<div class="left-block">
			<?$arParametrs = CPriority::$arParametrsList;
			$i = 0;?>
			<?foreach($arParametrs as $blockCode => $arBlock)
			{
				if(isset($arBlock['THEME'] ) && $arBlock['THEME'] == 'Y'):?>
					<?
					$active = '';
					if($_COOKIE['styleSwitcherTabIndex'])
					{
						if($i == $_COOKIE['styleSwitcherTabIndex'])
							$active = 'active';
					}
					elseif(!$i)
						$active = 'active';?>
					<div class="section-block <?=$blockCode;?> <?=$active;?>"><?=$arBlock['TITLE']?></div>
					<?$i++;?>
				<?else:?>
					<?unset($arParametrs[$blockCode]);?>
				<?endif;?>
			<?}?>
		</div>
		<div class="right-block">
			<div class="content-body">
				<?if($arParametrs)
				{
					$i = 0;
					foreach($arParametrs as $blockCode => $arBlock):?>
						<?
						$active = '';
						if($_COOKIE['styleSwitcherTabIndex'])
						{
							if($i == $_COOKIE['styleSwitcherTabIndex'])
								$active = 'active';
						}
						elseif(!$i)
							$active = 'active';
						if($optionCode == 'USE_BITRIX_FORM')
						{
							if(!\Bitrix\Main\ModuleManager::isModuleInstalled('form'))
								return;
						}
						?>

						<div class="block-item <?=$blockCode;?> <?=$active;?>">
							<?foreach($arResult as $optionCode => $arOption)
							{
								
								if(!is_array($arOption))
									continue;
								if($arOption['TYPE_BLOCK'] == $blockCode && (isset($arOption['THEME']) && $arOption['THEME'] == 'Y') && $optionCode !== 'BASE_COLOR_CUSTOM' && $optionCode !== 'CUSTOM_BGCOLOR_THEME' && !isset($arOption['GROUPS_EXT'])):?>
									<?if($optionCode == 'BGCOLOR_THEME' && $arResult['SHOW_BG_BLOCK']['VALUE'] != 'Y')
									{
										continue;
									}?>
									<div class="item<?=(isset($arOption['CLASS']) && strlen($arOption['CLASS']) ? ' '.$arOption['CLASS'] : '');?> <?=(!$arOption['TITLE'] ? 'hidden' : '');?>">
										<?if($arOption['TYPE'] == 'checkbox' && (isset($arOption['ONE_ROW']) && $arOption['ONE_ROW'] == 'Y')):?>
											<div class="options pull-left" data-code="<?=$optionCode?>">
												<?=ShowOptions($optionCode, $arOption);?>
											</div>
											<?=ShowOptionsTitle($optionCode, $arOption);?>
										<?elseif($arOption['TYPE'] == 'hidden'):?>
											<?=ShowOptionsTitle($optionCode, $arOption);?>
											<?=ShowOptions($optionCode, $arOption);?>
										<?else:?>
											<?=ShowOptionsTitle($optionCode, $arOption);?>
											<div class="options <?=((isset($arOption['REFRESH']) && $arOption['REFRESH'] == 'Y') ? 'refresh-block' : '');?>" data-code="<?=$optionCode?>">
												<?if(isset($arOption['TYPE_EXT']) && $arOption['TYPE_EXT'] == 'colorpicker'):?>
													<input type="hidden" id="<?=$optionCode?>" name="<?=$optionCode?>" value="<?=$arOption['VALUE']?>" />
													<?foreach($arOption['LIST'] as $colorCode => $arColor):?>
														<?if($colorCode !== 'CUSTOM'):?>
															<div class="base_color <?=($arColor['CURRENT'] == 'Y' ? 'current' : '')?>" data-value="<?=$colorCode?>" data-color="<?=$arColor['COLOR']?>">
																<span class="animation-all click_block" data-option-id="<?=$optionCode?>" data-option-value="<?=$colorCode?>" title="<?=$arColor['TITLE']?>"><span style="background-color: <?=$arColor['COLOR']?>;"></span></span>
															</div>
														<?endif;?>
													<?endforeach;?>
													<?if($customColorExist && (isset($arResult['BASE_COLOR_CUSTOM']['PARENT_PROP']) && $arResult['BASE_COLOR_CUSTOM']['PARENT_PROP'] == $optionCode)):?>
														<?$customColor = str_replace('#', '', (strlen($arResult['BASE_COLOR_CUSTOM']['VALUE']) ? $arResult['BASE_COLOR_CUSTOM']['VALUE'] : $arResult['BASE_COLOR']['LIST'][$arResult['BASE_COLOR']['DEFAULT']]['COLOR']));?>	
														<?$arColor = $arOption['LIST']['CUSTOM'];?>
														<div class="base_color base_color_custom <?=($arColor['CURRENT'] == 'Y' ? 'current' : '')?>" data-name="BASE_COLOR_CUSTOM" data-value="CUSTOM" data-color="#<?=$customColor?>">
															<span class="animation-all click_block" data-option-id="<?=$optionCode?>" data-option-value="CUSTOM" title="<?=$arColor['TITLE']?>" ><span style="background-color: #<?=$customColor?>;"></span></span>
															<input type="hidden" id="custom_picker" name="BASE_COLOR_CUSTOM" value="<?=$customColor?>" />
														</div>
													<?endif;?>
													<?if($customColorExist && (isset($arResult['CUSTOM_BGCOLOR_THEME']['PARENT_PROP']) && $arResult['CUSTOM_BGCOLOR_THEME']['PARENT_PROP'] == $optionCode)):?>
														<?$customColor = str_replace('#', '', (strlen($arResult['CUSTOM_BGCOLOR_THEME']['VALUE']) ? $arResult['CUSTOM_BGCOLOR_THEME']['VALUE'] : $arResult['CUSTOM_BGCOLOR_THEME']['LIST'][$arResult['CUSTOM_BGCOLOR_THEME']['DEFAULT']]['COLOR']));?>	
														<?$arColor = $arOption['LIST']['CUSTOM'];?>
														<div class="base_color base_color_custom <?=($arColor['CURRENT'] == 'Y' ? 'current' : '')?>" data-name="CUSTOM_BGCOLOR_THEME" data-value="CUSTOM" data-color="#<?=$customColor?>">
															<span class="animation-all click_block" data-option-id="<?=$optionCode?>" data-option-value="CUSTOM" title="<?=$arColor['TITLE']?>" ><span style="background-color: #<?=$customColor?>;"></span></span>
															<input type="hidden" id="custom_picker2" name="CUSTOM_BGCOLOR_THEME" value="<?=$customColor?>" />
														</div>
													<?endif;?>
												<?else:?>
													<?if(isset($arOption['COMMUNITY']) && $arOption['COMMUNITY'] && is_array($arOption['COMMUNITY'])):?>
														<?foreach($arOption['COMMUNITY'] as $keyCommunity => $arCommunity):?>
															<?=ShowOptions($optionCode, $arOption, array(), $arCommunity[$arResult[$keyCommunity]['VALUE']]);?>
														<?endforeach?>
													<?else:?>
														<?=ShowOptions($optionCode, $arOption);?>
													<?endif?>
												<?endif;?>
											</div>
											<?if(isset($arOption['SUB_PARAMS']) && $arOption['LIST'] && (isset($arOption['REFRESH']) && $arOption['REFRESH'] == 'Y')):?>
												<div>
													<?foreach($arOption['LIST'] as $key => $arListOption):?>
														<?if($arOption['SUB_PARAMS'][$key]):?>
															<div class="sup-params options refresh-block s_<?=$key;?> <?=($key == $arOption['VALUE'] ? 'active' : '');?>">
																<div class="title_wrap">
																	<div class="block-title"><span class="dotted-block"><span><?=(isset($arOption['MESSAGE_FOR_SUB_PARAMS']) && strlen($arOption['MESSAGE_FOR_SUB_PARAMS']) ? $arOption['MESSAGE_FOR_SUB_PARAMS'] : GetMessage('SUB_PARAMS'));?></span></span></div>
																</div>
																<div class="values">
																	<?$param = "SORT_ORDER_".$optionCode."_".$key;?>
																	<div class="inner-wrapper" data-key="<?=$key;?>">
																		<?if($arResult[$param])
																		{
																			$arOrder = explode(",", $arResult[$param]);
																			$arTmp = array();
																			foreach($arOrder as $name)
																			{
																				$arTmp[$name] = $arOption['SUB_PARAMS'][$key][$name];
																			}
																			$arOption['SUB_PARAMS'][$key] = $arTmp;
																			unset($arTmp);
																		}?>
																		<?foreach($arOption['SUB_PARAMS'][$key] as $key2 => $arSubOptions):?>
																			<?$isRow = (($arSubOptions['TYPE'] == 'checkbox' && (isset($arSubOptions['ONE_ROW']) && $arSubOptions['ONE_ROW'] == 'Y')) ? true : false);?>
																			<div class="option-wrapper <?=((isset($arSubOptions['DRAG']) && $arSubOptions['DRAG'] == 'N') ? "no_drag" : "");?><?=(($arSubOptions['VALUE'] == 'N' && $isRow) ? "disabled" : "");?>">
																				<div class="drag">
																					<svg xmlns="http://www.w3.org/2000/svg" width="5" height="16" viewBox="0 0 5 16">
																					  <defs>
																					    <style>
																					      .cls-1 {
																					        fill: #333;
																					        fill-rule: evenodd;
																					      }
																					    </style>
																					  </defs>
																					  <path data-name="Rectangle 53 copy 28" class="cls-1" d="M660,447v1l-2,3h-1l-2-3v-1h2v-8h-2v-1l2-3h1l2,3v1h-2v8h2Z" transform="translate(-655 -435)"></path>
																					</svg>
																				</div>
																				<?if($isRow):?>
																					<table class="">
																						<tr>
																							<td><div class="blocks"></div></td>
																							<td><div class="blocks block-title"><?=$arSubOptions['TITLE'];?></div></td>
																							<?/*<pre>
																							<?print_r($arSubOptions);?>
																							</pre>*/?>
																							<td>
																								<div class="blocks value<?=(isset($arSubOptions['HIDE_TOGGLE']) && $arSubOptions['HIDE_TOGGLE'] == 'Y' ? ' hide_block' : '');?>">
																									<?=ShowOptions($key.'_'.$key2, $arSubOptions, $arOption);?>
																								</div>
																							</td>
																						</tr>
																					</table>
																				<?else:?>
																					<div class="block-title"><?=$arSubOptions['TITLE'];?></div>																					
																					<div class="value">
																						<?=ShowOptions($key.'_'.$key2, $arSubOptions);?>
																					</div>
																				<?endif;?>
																			</div>
																		<?endforeach;?>
																	</div>
																</div>
																<input type="hidden" name="<?=$param;?>" value="<?=$arResult[$param];?>" />
																<?//show template index components?>
																<?if($arResult['TEMPLATE_PARAMS'][$key]):?>
																	<div class="templates_block">
																		<?foreach($arResult['TEMPLATE_PARAMS'][$key] as $code => $arTemplate):?>
																			<div class="item <?=str_replace('_TEMPLATE', '', $code);?> <?=($arTemplate['ACTIVE'] == 'N' ? 'hidden' : '');?>">
																				<?=ShowOptionsTitle($code, $arTemplate);?>
																				<div class="options" data-code="<?=$code?>">
																					<?=ShowOptions($code, $arTemplate);?>
																				</div>
																			</div>
																		<?endforeach;?>
																	</div>
																<?endif;?>																
															</div>
														<?endif;?>
													<?endforeach;?>
												</div>
											<?endif;?>											
										<?endif;?>
										<?if(isset($arOption['DEPENDENT_PARAMS']) && $arOption['DEPENDENT_PARAMS']) // show dependent options
										{?>
											<div class="options_wrap">
												<?foreach($arOption['DEPENDENT_PARAMS'] as $key => $arSubOptions)
												{
													if((!isset($arSubOptions['CONDITIONAL_VALUE']) || (isset($arOption['VALUE_IMPORTANT']) && $arOption['VALUE_IMPORTANT'] == 'Y') || ($arSubOptions['CONDITIONAL_VALUE'] && $arResult[$optionCode]['VALUE'] == $arSubOptions['CONDITIONAL_VALUE'])) && $arSubOptions['THEME'] == 'Y')
													{?>
														<div class="option_wrap option-wrapper<?=($arSubOptions['VALUE'] != 'Y' ? ' disabled' : '')?>">
															<?if($arSubOptions['TYPE'] == 'checkbox' && (isset($arSubOptions['ONE_ROW']) && $arSubOptions['ONE_ROW'] == 'Y')):?>
																<div class="borders item">
																	<div class="options dependent pull-left" data-code="<?=$key?>">
																		<?=ShowOptions($key, $arSubOptions);?>
																	</div>
																	<?=ShowOptionsTitle($key, $arSubOptions);?>
																</div>
															<?else:?>
																<?=ShowOptionsTitle($key, $arSubOptions);?>
																<div class="options dependent" data-code="<?=$key;?>">
																	<?echo ShowOptions($key, $arSubOptions);?>
																</div>
															<?endif;?>
														</div>
													<?}
												}?>
											</div>
										<?}?>
									</div>
								<?elseif((isset($arOption['OPTIONS']) && $arOption['OPTIONS']) && (isset($arOption['GROUPS_EXT']) && $arOption['GROUPS_EXT'] == 'Y') && $arOption['TYPE_BLOCK'] == $blockCode && (isset($arOption['THEME']) && $arOption['THEME'] == 'Y')): // show groups options?>
									<div class="item groups">
										<?=ShowOptionsTitle($blockCode, $arOption);?>
										<div class="rows options">
											<?foreach($arOption['OPTIONS'] as $key => $arValue):?>
												<?echo ShowOptions($key, $arValue);?>
											<?endforeach;?>
										</div>
									</div>
								<?endif;?>
							<?}?>
							<?$i++;?>
						</div>
					<?endforeach;?>
				<?}?>
			</div>
		</div>
	</form>
	<div class="clearfix"></div>
</div>
<script>
var objCountValues = <?=CUtil::PhpToJSObject($arResult['COUNT_VALUES'])?>;
</script>