<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */

$this->setFrameMode(true);

use \Bitrix\Main\Localization\Loc;

if($arResult['CURRENT_REGION'])
{?>
	<?$bSideType = ($arParams['FORM_TYPE'] == 'LATERAL');?>
	<?if(!$arResult['POPUP']):?>
		<?global $arTheme;?>
		<div class="region_wrapper">
			<div class="io_wrapper">
				<div>
					<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/svg/region.svg');?>
					<div class="js_city_chooser popup_link dark-color with_dropdown" data-event="jqm" data-name="city_chooser" data-param-url="<?=urlencode($APPLICATION->GetCurUri());?>" data-param-form_id="city_chooser">
						<span><?=$arResult['CURRENT_REGION']['NAME'];?></span><span class="arrow"><i></i></span>
					</div>
				</div>
				<?if($arResult['SHOW_REGION_CONFIRM']):?>
					<div class="confirm_region">
						<?
						$href = 'data-href="'.$arResult['REGIONS'][$arResult['REAL_REGION']['ID']]['URL'].'"';
						if($arTheme['USE_REGIONALITY']['DEPENDENT_PARAMS']['REGIONALITY_TYPE']['VALUE'] == 'SUBDOMAIN' && ($arResult['HOST'].$_SERVER['HTTP_HOST'].$arResult['URI'] == $arResult['REGIONS'][$arResult['REAL_REGION']['ID']]['URL']))
						$href = '';?>
						<div class="title"><?=Loc::getMessage('CITY_TITLE');?><span class="city"><?=$arResult['REAL_REGION']['NAME'];?>?</span></div>
						<div class="buttons">
							<span class="btn btn-default aprove" data-id="<?=$arResult['REAL_REGION']['ID'];?>" <?=$href;?>><?=Loc::getMessage('CITY_YES');?></span>
							<span class="btn btn-default white js_city_change"><?=Loc::getMessage('CITY_CHANGE');?></span>
						</div>
					</div>
				<?endif;?>
			</div>
		</div>
	<?else:?>
		<div class="popup_regions">
			<div class="search-page autocomplete-block" id="title-search-city">
				<div class="wrapper searchinput">
					<input id="search" class="autocomplete text" type="text" placeholder="<?=Loc::getMessage('CITY_PLACEHOLDER');?>">
					<div class="search_btn">
						<button class="btn btn-search" type="submit" name="s" value=""><i class="svg svg-search mask"></i></button>
					</div>
					<div class="js-autocomplete-block"></div>
				</div>
				<?if($arResult['FAVORITS']):?>
					<div class="favorits">
						<span class="title"><?=GetMessage('EXAMPLE_CITY');?></span>
						<div class="cities">
							<?foreach($arResult['FAVORITS'] as $arItem):?>
								<div class="item">
									<a href="<?=$arItem['URL'];?>" data-id="<?=$arItem['ID'];?>" class="name"><?=$arItem['NAME'];?></a>
								</div>
							<?endforeach;?>
						</div>
					</div>
				<?endif;?>
			</div>
			<div class="items ext_view">
				<?if($arResult['SECTION_LEVEL1']):?>
					<div class="block regions <?=($arResult['SECTION_LEVEL2'] ? 'okrug' : '');?>">
						<div class="title"><?=($arResult['SECTION_LEVEL2'] ? Loc::getMessage('OKRUG') : Loc::getMessage('REGION'));?></div>
						<div class="items_block">
							<?if($bSideType):?>
								<div class="dark-color js-region with_dropdown"><span>Text</span></div>
								<div class="dropdown">
									<div class="wrap">
										<div class="inner-wrap">
											<?foreach($arResult['SECTION_LEVEL1'] as $key => $arSection):?>
												<div class="item dark-color" data-id="<?=$key;?>"><?=$arSection['NAME'];?></div>
											<?endforeach;?>
										</div>
									</div>
								</div>
							<?else:?>
								<?foreach($arResult['SECTION_LEVEL1'] as $key => $arSection):?>
									<div class="item dark_link" data-id="<?=$key;?>">
										<span class="name">
											<?=$arSection['NAME'];?>
											<span class="arrow">
												<svg class="svg svg_triangle_right" width="3" height="5" viewBox="0 0 3 5">
												  <path data-name="Rectangle 323 copy 9" class="cls-1" d="M960,958v-5l3,2.514Z" transform="translate(-960 -953)"></path>
												</svg>
											</span>
										</span></div>
								<?endforeach;?>
							<?endif;?>
						</div>
					</div>
				<?endif;?>
				<?if($arResult['SECTION_LEVEL2']):?>
					<div class="block regions">
						<div class="title"><?=Loc::getMessage('REGION');?></div>
						<div class="items_block">
							<?if($bSideType):?>
								<div class="dark-color js-region with_dropdown"><span>Text</span></div>
								<div class="dropdown">
									<div class="wrap">
										<div class="inner-wrap">
											<?foreach($arResult['SECTION_LEVEL2'] as $key => $arSections):?>
												<div class="parent_block" data-id="<?=$key;?>">
													<?foreach($arSections as $key2 => $arSection):?>
														<div class="item dark-color" data-id="<?=$key2;?>"><?=$arSection['NAME'];?></div>
													<?endforeach;?>
												</div>
											<?endforeach;?>
										</div>
									</div>
								</div>
							<?else:?>
								<?foreach($arResult['SECTION_LEVEL2'] as $key => $arSections):?>
									<div class="parent_block" data-id="<?=$key;?>">
										<?foreach($arSections as $key2 => $arSection):?>
											<div class="item dark_link" data-id="<?=$key2;?>"><span class="name">
												<?=$arSection['NAME'];?>
												<span class="arrow">
													<svg class="svg svg_triangle_right" width="3" height="5" viewBox="0 0 3 5">
													  <path data-name="Rectangle 323 copy 9" class="cls-1" d="M960,958v-5l3,2.514Z" transform="translate(-960 -953)"></path>
													</svg>
												</span>
											</span></div>
										<?endforeach;?>
									</div>
								<?endforeach;?>
							<?endif;?>
						</div>
					</div>
				<?endif;?>
				<?if($arResult['REGIONS']):?>
					<div class="block cities">
						<div class="title"><?=Loc::getMessage('CITY');?></div>
						<div class="items_block">
							<?if($bSideType):?>
								<div class="dark-color js-region with_dropdown"><span><?=$arResult['CURRENT_REGION']['NAME'];?></span></div>
								<div class="dropdown">
									<div class="wrap">
										<div class="inner-wrap">
											<?foreach($arResult['REGIONS'] as $key => $arItem):?>
												<?$bCurrent = ($arResult['CURRENT_REGION']['ID'] == $arItem['ID']);?>
												<div class="item <?=($bCurrent ? 'current shown' : '');?> <?=((!$arResult['SECTION_LEVEL1'] && !$arResult['SECTION_LEVEL2']) ? 'shown' : '');?>" data-id="<?=((isset($arItem['IBLOCK_SECTION_ID']) && $arItem['IBLOCK_SECTION_ID']) ? $arItem['IBLOCK_SECTION_ID'] : 0);?>">
													<?if($bCurrent):?>
														<a href="<?=$arItem['URL'];?>" data-id="<?=$arItem['ID'];?>" class="dark-color"><span class="name"><?=$arItem['NAME'];?></span></a>
													<?else:?>
														<a href="<?=$arItem['URL'];?>" data-id="<?=$arItem['ID'];?>" class="dark-color"><?=$arItem['NAME'];?></a>
													<?endif;?>
												</div>
											<?endforeach;?>
										</div>
									</div>
								</div>
							<?else:?>
								<?foreach($arResult['REGIONS'] as $key => $arItem):?>
									<?$bCurrent = ($arResult['CURRENT_REGION']['ID'] == $arItem['ID']);?>
									<div class="item <?=($bCurrent ? 'current shown' : '');?> <?=((!$arResult['SECTION_LEVEL1'] && !$arResult['SECTION_LEVEL2']) ? 'shown' : '');?>" data-id="<?=((isset($arItem['IBLOCK_SECTION_ID']) && $arItem['IBLOCK_SECTION_ID']) ? $arItem['IBLOCK_SECTION_ID'] : 0);?>">
										<?if($bCurrent):?>
											<a href="<?=$arItem['URL'];?>" data-id="<?=$arItem['ID'];?>" class="dark-color"><span class="name"><?=$arItem['NAME'];?></span></a>
										<?else:?>
											<a href="<?=$arItem['URL'];?>" data-id="<?=$arItem['ID'];?>" class="dark-color"><?=$arItem['NAME'];?></a>
										<?endif;?>
									</div>
								<?endforeach;?>
							<?endif;?>
						</div>
					</div>
				<?endif;?>
			</div>
			<script>
				var arRegions = <?=CUtil::PhpToJsObject($arResult['JS_REGIONS']);?>
			</script>
		</div>
	<?endif;?>
<?}?>
