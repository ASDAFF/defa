<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc;?>
<?if($arResult['SECTIONS']):?>
	<div class="item-views documents_list type_2">
		<?// top pagination?>
		<?if($arParams['DISPLAY_TOP_PAGER']):?>
			<div class="pagination_nav">		
				<?=$arResult['NAV_STRING']?>
			</div>
		<?endif;?>
		
		<div class="group-content">
			<?foreach($arResult['SECTIONS'] as $arSection):?>
				<?
				// edit/add/delete buttons for edit mode
				$arSectionButtons = CIBlock::GetPanelButtons($arSection['IBLOCK_ID'], 0, $arSection['ID'], array('SESSID' => false, 'CATALOG' => true));
				$this->AddEditAction($arSection['ID'], $arSectionButtons['edit']['edit_section']['ACTION_URL'], CIBlock::GetArrayByID($arSection['IBLOCK_ID'], 'SECTION_EDIT'));
				$this->AddDeleteAction($arSection['ID'], $arSectionButtons['edit']['delete_section']['ACTION_URL'], CIBlock::GetArrayByID($arSection['IBLOCK_ID'], 'SECTION_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div class="tab-pane" id="<?=$this->GetEditAreaId($arSection['ID'])?>">
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
						<?endif;?>
					<?endif;?>
					<?if($arSection['ITEMS']):?>
						<div class="docs-block">
							<div class="docs_wrap row margin0">
								<?foreach($arSection['ITEMS'] as $arItem):?>
									<?
									// edit/add/delete buttons for edit mode
									$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
									$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
									
									?>
									<?if(isset($arItem['DISPLAY_PROPERTIES']['DOCUMENT']) && $arItem['DISPLAY_PROPERTIES']['DOCUMENT']['VALUE']):?>
										<?
										$name = $arItem['NAME'];
										$id = $arItem['ID'];
										$arItem = CPriority::get_file_info($arItem['DISPLAY_PROPERTIES']['DOCUMENT']['VALUE']);										

										$bImage = false;
										if($arItem['TYPE'] == 'jpg' || $arItem['TYPE'] == 'jpeg' || $arItem['TYPE'] == 'bmp' || $arItem['TYPE'] == 'gif'){
											$bImage = true;
										}
										?>
										<div class="item pull-left" id="<?=$this->GetEditAreaId($id)?>">
											<div class="blocks border shadow clearfix <?=$arItem["TYPE"];?>">
												<div class="inner-wrapper">
													<div class="title">
														<a href="<?=$arItem['SRC']?>" class="dark-color text<?=($bImage ? ' fancybox' : '')?>" target="_blank"><?=$name;?></a>
													</div>
													<div class="filesize font_xs"><?=CPriority::filesize_format($arItem['FILE_SIZE']);?></div>
													<?if($bImage):?>
														<a class="arrow_link fancybox" href="<?=$arItem['SRC']?>"></a>
													<?else:?>
														<a href="<?=$arItem['SRC']?>" class="arrow_link" href="<?=$arItem['SRC']?>"></a>
													<?endif;?>
												</div>
											</div>
										</div>
									<?endif;?>
								<?endforeach;?>
							</div>
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