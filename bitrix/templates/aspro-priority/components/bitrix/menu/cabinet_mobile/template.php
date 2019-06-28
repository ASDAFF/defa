<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?global $USER, $arTheme;?>
<?$bParent = $arResult && $USER->IsAuthorized();?>
<?$this->setFrameMode(true);?>

<div class="menu middle">
	<ul>
		<li<?=(CSite::inDir(SITE_DIR.'cabinet/') ? ' class="selected"' : '')?>>
			<a class="dark-color<?=($bParent ? ' parent' : '')?>" href="<?=SITE_DIR?>cabinet/">
				<?if($USER->IsAuthorized()):?>
					<svg class="svg svg-cabinet-login" width="16" height="18" viewBox="0 0 16 18">
						<path data-name="Rounded Rectangle 803 copy" class="cls-1" d="M933.5,961H922.469v0a2.486,2.486,0,0,1-1.848-4.13c0.018-.026.026-0.052,0.046-0.077,1.374-1.7,4.476-2.79,6.833-2.79h1c2.357,0,5.459,1.089,6.833,2.79,0.02,0.025.028,0.051,0.046,0.077A2.475,2.475,0,0,1,936,958.5,2.5,2.5,0,0,1,933.5,961Zm0.5-2.533h0a1.509,1.509,0,0,0-.619-0.9A10.224,10.224,0,0,0,928.5,956h-1a10.224,10.224,0,0,0-4.872,1.566,1.5,1.5,0,0,0-.619.9h0c0,0.01,0,.024,0,0.033a0.5,0.5,0,0,0,.5.5h11a0.5,0.5,0,0,0,.5-0.5C934,958.491,934,958.477,934,958.467ZM928,953a5,5,0,1,1,5-5A5,5,0,0,1,928,953Zm0-8a3,3,0,1,0,3,3A3,3,0,0,0,928,945Z" transform="translate(-920 -943)"/>
					</svg>
				<?else:?>
					<svg class="svg svg-cabinet" width="18" height="18" viewBox="0 0 18 18">
						<path data-name="Ellipse 206 copy 4" class="cls-1" d="M909,961a9,9,0,1,1,9-9A9,9,0,0,1,909,961Zm2.571-2.5a6.825,6.825,0,0,0-5.126,0A6.825,6.825,0,0,0,911.571,958.5ZM909,945a6.973,6.973,0,0,0-4.556,12.275,8.787,8.787,0,0,1,9.114,0A6.973,6.973,0,0,0,909,945Zm0,10a4,4,0,1,1,4-4A4,4,0,0,1,909,955Zm0-6a2,2,0,1,0,2,2A2,2,0,0,0,909,949Z" transform="translate(-900 -943)"/>
					</svg>
				<?endif;?>
				<span><?=GetMessage('MY_CABINET')?></span>
				<?if($bParent):?>
					<span class="arrow">
						<svg class="svg svg_triangle_right" width="3" height="5" viewBox="0 0 3 5">
							<path data-name="Rectangle 323 copy 9" class="cls-1" d="M960,958v-5l3,2.514Z" transform="translate(-960 -953)"/>
						</svg>
					</span>
				<?endif;?>
			</a>
			<?if($bParent):?>
				<ul class="dropdown">
					<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/close.svg');?>
				
					<li class="menu_back">
						<a href="" class="dark-color" rel="nofollow">
							<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/back.svg');?>
							<?=GetMessage('PRIORITY_T_MENU_BACK')?>
						</a>
					</li>
					<li class="menu_title"><a class="dark-color" href="<?=$arTheme['URL_CABINET']['VALUE'];?>"><?=GetMessage('MY_CABINET')?></a></li>
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
								<ul class="dropdown">
									<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/close.svg');?>
									
									<li class="menu_back">
										<a href="" class="dark-color" rel="nofollow">
											<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/back.svg');?>
											<?=GetMessage('PRIORITY_T_MENU_BACK')?>
										</a>
									</li>
									<li class="menu_title"><a class="dark-color" href="<?=$arSubItem['LINK'];?>"><?=$arItem['TEXT']?></a></li>
									<?foreach($arItem['CHILD'] as $arSubItem):?>
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
												<ul class="dropdown">
													<li class="menu_back">
														<a href="" class="dark-color" rel="nofollow">
															<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/back.svg');?>
															<?=GetMessage('PRIORITY_T_MENU_BACK')?>
														</a>
													</li>
													<li class="menu_title"><a class="dark-color" href="<?=$arSubSubItem['LINK'];?>"><?=$arSubItem['TEXT']?></a></li>
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
																<ul class="dropdown">
																	<li class="menu_back">
																		<a href="" class="dark-color" rel="nofollow">
																			<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/back.svg');?>
																			<?=GetMessage('PRIORITY_T_MENU_BACK')?>
																		</a>
																	</li>
																	<li class="menu_title"><?=$arSubSubItem['TEXT']?></li>
																	<?foreach($arSubSubItem["CHILD"] as $arSubSubSubItem):?>
																		<li<?=($arSubSubSubItem['SELECTED'] ? ' class="selected"' : '')?>>
																			<a class="dark-color<?=($bParent ? ' parent' : '')?>" href="<?=$arSubSubSubItem["LINK"]?>" title="<?=$arSubSubSubItem["TEXT"]?>">
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
			<?endif;?>
		</li>
	</ul>
</div>