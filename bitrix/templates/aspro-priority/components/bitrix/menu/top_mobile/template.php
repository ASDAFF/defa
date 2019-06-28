<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?$this->setFrameMode(true);?>
<?global $arTheme;?>
<?if($arResult):?>
	<div class="menu top">
		<ul class="top">
			<?foreach($arResult as $arItem):?>
				<?$bShowChilds = $arParams['MAX_LEVEL'] > 1;?>
				<?$bParent = $arItem['CHILD'] && $bShowChilds;?>
				<li<?=($arItem['SELECTED'] ? ' class="selected"' : '')?>>
					<a class="dark-color<?=($bParent ? ' parent' : '')?>" href="<?=$arItem["LINK"]?>" title="<?=$arItem["TEXT"]?>">
						<span><?=$arItem['TEXT']?></span>
						<?if($bParent):?>
							<span class="arrow">
								<svg class="svg svg_triangle_right" width="3" height="5" viewBox="0 0 3 5">
								  <path data-name="Rectangle 323 copy 9" class="cls-1" d="M960,958v-5l3,2.514Z" transform="translate(-960 -953)"/>
								</svg>
							</span>
						<?endif;?>
					</a>
					<?if($bParent):?>
						<ul class="dropdown<?=(!$arItem['CHILD'] ? ' wtc' : '')?>">
							<?if($arTheme['HEADER_MOBILE_MENU_OPEN']['VALUE'] == 1):?>
								<li>
									<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/close.svg');?>
								</li>
							<?endif;?>
						
							<li class="menu_back">
							<a href="" class="dark-color" rel="nofollow">
								<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/back.svg');?>
								<?=GetMessage('PRIORITY_T_MENU_BACK')?>
								</a>
							</li>
							<li class="menu_title"><a class="dark-color" href="<?=$arItem['LINK'];?>"><?=$arItem['TEXT']?></a></li>
							<?foreach($arItem['CHILD'] as $arSubItem):?>
								<?
								if($arSubItem['PARAMS']['TYPE'] == 'PRODUCT')
									continue;
								?>
							
								<?$bShowChilds = $arParams['MAX_LEVEL'] > 2;?>
								<?$bParent = $arSubItem['CHILD'] && $bShowChilds;?>
								<li<?=($arSubItem['SELECTED'] ? ' class="selected"' : '')?>>
									<a class="dark-color<?=($bParent ? ' parent' : '')?>" href="<?=$arSubItem["LINK"]?>" title="<?=$arSubItem["TEXT"]?>">
										<span><?=$arSubItem['TEXT']?></span>
										<?if($bParent):?>
											<span class="arrow">
												<svg class="svg svg_triangle_right" width="3" height="5" viewBox="0 0 3 5">
												  <path data-name="Rectangle 323 copy 9" class="cls-1" d="M960,958v-5l3,2.514Z" transform="translate(-960 -953)"/>
												</svg>
											</span>
										<?endif;?>
									</a>
									<?if($bParent):?>
										<ul class="dropdown<?=(!$arSubItem['CHILD'] ? ' wtc' : '')?>">
											<?if($arTheme['HEADER_MOBILE_MENU_OPEN']['VALUE'] == 1):?>
												<li>
													<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/close.svg');?>
												</li>
											<?endif;?>
										
											<li class="menu_back">
												<a href="" class="dark-color" rel="nofollow">
													<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/back.svg');?>
													<?=GetMessage('PRIORITY_T_MENU_BACK')?>
												</a>
											</li>
											<li class="menu_title"><a class="dark-color" href="<?=$arSubItem['LINK'];?>"><?=$arSubItem['TEXT']?></a></li>
											<?foreach($arSubItem["CHILD"] as $arSubSubItem):?>
												<?$bShowChilds = $arParams['MAX_LEVEL'] > 3;?>
												<?$bParent = $arSubSubItem['CHILD'] && $bShowChilds;?>
												<li<?=($arSubSubItem['SELECTED'] ? ' class="selected"' : '')?>>
													<a class="dark-color<?=($bParent ? ' parent' : '')?>" href="<?=$arSubSubItem["LINK"]?>" title="<?=$arSubSubItem["TEXT"]?>">
														<span><?=$arSubSubItem['TEXT']?></span>
														<?if($bParent):?>
															<span class="arrow">
																<svg class="svg svg_triangle_right" width="3" height="5" viewBox="0 0 3 5">
																	<path data-name="Rectangle 323 copy 9" class="cls-1" d="M960,958v-5l3,2.514Z" transform="translate(-960 -953)"/>
																</svg>
															</span>
														<?endif;?>
													</a>
													<?if($bParent):?>
														<ul class="dropdown<?=(!$arSubSubItem['CHILD'] ? ' wtc' : '')?>">
															<?if($arTheme['HEADER_MOBILE_MENU_OPEN']['VALUE'] == 1):?>
																<li>
																	<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/close.svg');?>
																</li>
															<?endif;?>
														
															<li class="menu_back">
																<a href="" class="dark-color" rel="nofollow">
																	<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/back.svg');?>
																	<?=GetMessage('PRIORITY_T_MENU_BACK')?>
																</a>
															</li>
															<li class="menu_title"><a class="dark-color" href="<?=$arSubSubItem['LINK'];?>"><?=$arSubSubItem['TEXT']?></a></li>
															<?foreach($arSubSubItem["CHILD"] as $arSubSubSubItem):?>
																<li<?=($arSubSubSubItem['SELECTED'] ? ' class="selected"' : '')?>>
																	<a class="dark-color" href="<?=$arSubSubSubItem["LINK"]?>" title="<?=$arSubSubSubItem["TEXT"]?>">
																		<span><?=$arSubSubSubItem['TEXT']?></span>
																	</a>
																</li>
															<?endforeach;?>
														</ul>
													<?endif;?>
												</li>
											<?endforeach;?>
										</ul>
									<?endif;?>
								</li>
							<?endforeach;?>
						</ul>
					<?endif;?>
				</li>
			<?endforeach;?>
		</ul>
	</div>
<?endif;?>