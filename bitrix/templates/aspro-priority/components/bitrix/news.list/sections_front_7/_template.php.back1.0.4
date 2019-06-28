<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
<?use \Bitrix\Main\Localization\Loc;?>

<?if($arResult['SECTIONS']):?>
	<div class="item-views services-items type_1 front icons<?=(isset($arParams['SCROLL_CLASS']) && $arParams['SCROLL_CLASS'] ? ' '.$arParams['SCROLL_CLASS'] : '')?>">
		<div class="maxwidth-theme">
			<div class="row">
				<div class="left_wrap col-md-3 col-sm-4">
					<div class="left_block">
						<?if($arParams['PAGER_SHOW_ALL']):?>
							<a class="show_all pull-right" href="<?=str_replace('#SITE'.'_DIR#', SITE_DIR, $arResult['LIST_PAGE_URL'])?>"><span><?=(strlen($arParams['SHOW_ALL_TITLE']) ? $arParams['SHOW_ALL_TITLE'] : GetMessage('S_TO_SHOW_ALL_SERVICES'))?></span></a>
						<?endif;?>
						<h2><?=($arParams["TITLE"] ? $arParams["TITLE"] : Loc::getMessage("TITLE_SERVICES"));?></h2>
						<div class="clearfix"></div>
						<?
						$arSection = array_values($arResult['SECTIONS']);
						?>
						<div class="menu_item_selected"><?=$arSection[0]['NAME']?></div>
						<ul class="menu">
							<?foreach($arSection as $key => $arItem):?>
								<li<?=($key == 0 ? ' class="selected"' : '')?>><span><?=$arItem['NAME']?></span></li>
							<?endforeach?>
						</ul>
						<?if($arParams['PAGER_SHOW_ALL']):?>
							<div class="all"><a class="font_upper" href="<?=str_replace('#SITE'.'_DIR#', SITE_DIR, $arResult['LIST_PAGE_URL'])?>"><?=(strlen($arParams['SHOW_ALL_TITLE']) ? $arParams['SHOW_ALL_TITLE'] : Loc::getMessage('S_TO_SHOW_ALL_SERVICES'))?></a></div>
						<?endif;?>
					</div>				</div>
				<div class="right_wrap col-md-9 col-sm-8">
					<div class="items row">
						<?
						$bFirst = true;
						$bArrows = (count($arResult['SECTIONS']) > 1 ? true : false);
						?>
						
						<?foreach($arResult['SECTIONS'] as $arItem):?>
							<?
							// edit/add/delete buttons for edit mode
							$arSectionButtons = CIBlock::GetPanelButtons($arItem['IBLOCK_ID'], 0, $arItem['ID'], array('SESSID' => false, 'CATALOG' => true));
							$this->AddEditAction($arItem['ID'], $arSectionButtons['edit']['edit_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_EDIT'));
							$this->AddDeleteAction($arItem['ID'], $arSectionButtons['edit']['delete_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

							// preview picture
							if($bShowSectionImage = in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE'])){
								$bImage = $arItem['UF_ICON'];
								$arSectionImage = $bImage ? CFile::ResizeImageGet($arItem['UF_ICON'], array('width' => 40, 'height' => 40), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array();
								$imageSectionSrc = ($bImage ? $arSectionImage['src'] :'');
							}
							?>
							<div class="item<?=($bFirst ? ' active' : '')?><?=($bArrows ? ' warrows' : '')?> col-md-12 col-sm-12 <?=($bShowSectionImage && strlen($imageSectionSrc) ? '' : ' wti')?> <?=$arParams['IMAGE_CATALOG_POSITION'];?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
								<div class="wrap clearfix">
									<div class="wrap border">
										<?// icon or preview picture?>
										<?if($bShowSectionImage && strlen($imageSectionSrc)):?>
											<div class="image"><a href="<?=$arItem['SECTION_PAGE_URL']?>"><img src="<?=$imageSectionSrc?>" alt="<?=( $arItem['PICTURE']['ALT'] ? $arItem['PICTURE']['ALT'] : $arItem['NAME']);?>" title="<?=( $arItem['PICTURE']['TITLE'] ? $arItem['PICTURE']['TITLE'] : $arItem['NAME']);?>" class="img-responsive" /></a></div>
										<?endif;?>
										
										<div class="body-info">
											<?// section name?>
											<?if(in_array('NAME', $arParams['FIELD_CODE'])):?>
												<div class="title">
													<a href="<?=$arItem['SECTION_PAGE_URL']?>" class="dark-color">
														<?=$arItem['NAME']?>
													</a>
												</div>
											<?endif;?>

											<?if(in_array('PREVIEW_TEXT', $arParams['FIELD_CODE']) && strlen($arItem['DESCRIPTION'])):?>
												<div class="previewtext"><?=$arItem['DESCRIPTION']?></div>
											<?endif;?>

											<?// section child?>
											<?if($arItem['CHILD']):?>
												<div class="text childs">
													<ul>
														<?foreach($arItem['CHILD'] as $arSubItem):?>
															<?
															$arItemsButtons = CIBlock::GetPanelButtons($arSubItem['IBLOCK_ID'], $arSubItem['ID'], 0, array('SESSID' => false, 'CATALOG' => true));
															$this->AddEditAction($arSubItem['ID'], $arItemsButtons['edit']['edit_element']['ACTION_URL'], CIBlock::GetArrayByID($arSubItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
															$this->AddDeleteAction($arSubItem['ID'], $arItemsButtons['edit']['delete_element']['ACTION_URL'], CIBlock::GetArrayByID($arSubItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
															?>
															<li id="<?=$this->GetEditAreaId($arSubItem['ID'])?>"><a href="<?=($arSubItem['SECTION_PAGE_URL'] ? $arSubItem['SECTION_PAGE_URL'] : $arSubItem['DETAIL_PAGE_URL'] );?>"><?=$arSubItem['NAME']?></a></li>
														<?endforeach;?>
													</ul>
												</div>
											<?endif;?>
										</div>
										<?if($bArrows):?>
											<div class="arrows">
												<span class="arrow prev"></span>
												<span class="arrow next"></span>
											</div>
										<?endif?>
									</div>
									<div class="more font_upper"><a href="<?=$arItem['SECTION_PAGE_URL']?>"><span><?=Loc::getMessage('MORE_SERVICE')?></span></a></div>
								</div>
							</div>
							<?$bFirst = false;?>
						<?endforeach;?>
					</div>			
				</div>
			</div>
		</div>
	</div>
<?endif;?>