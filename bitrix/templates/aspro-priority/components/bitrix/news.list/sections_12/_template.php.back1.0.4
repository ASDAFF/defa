<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
<?if($arResult['SECTIONS']):?>
	<div class="item-views catalog sections type_4_within type_12_within">
		<div class="items row margin0 list_block">
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
				<div class="col-md-12 col-sm-12">
					<div class="item border shadow<?=($bShowSectionImage ? '' : ' wti')?>  <?=$arParams['IMAGE_CATALOG_POSITION'];?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
						<?// icon or preview picture?>
						<?if($bShowSectionImage):?>
							<div class="image">
								<a href="<?=$arItem['SECTION_PAGE_URL']?>">
									<img src="<?=$imageSectionSrc?>" alt="<?=( $arItem['PICTURE']['ALT'] ? $arItem['PICTURE']['ALT'] : $arItem['NAME']);?>" title="<?=( $arItem['PICTURE']['TITLE'] ? $arItem['PICTURE']['TITLE'] : $arItem['NAME']);?>" class="img-responsive" />
								</a>
							</div>
						<?endif;?>
						
						<div class="info">
							<?// section name?>
							<?if(in_array('NAME', $arParams['FIELD_CODE'])):?>
								<div class="title">
									<a href="<?=$arItem['SECTION_PAGE_URL']?>" class="dark-color">
										<?=$arItem['NAME']?>
									</a>
								</div>
							<?endif;?>

							<?// section preview text?>
							<?if(strlen($arItem['UF_TOP_SEO']) && $arParams['SHOW_SECTION_PREVIEW_DESCRIPTION'] != 'N'):?>
								<div class="previewtext">
									<?=$arItem['UF_TOP_SEO']?>
								</div>
							<?elseif(strlen($arItem['DESCRIPTION']) && $arParams['SHOW_SECTION_PREVIEW_DESCRIPTION'] != 'N'):?>
								<div class="previewtext"><?=CPriority::truncateLengthText($arItem['DESCRIPTION'], $arParams['PREVIEW_TRUNCATE_LEN'])?></div>
							<?endif;?>
							<?// section child?>
							<?if($arItem['CHILD']):?>
								<div class="text childs">
									<ul>
										<?foreach($arItem['CHILD'] as $arSubItem):?>
											<li class="font_sm"><a class="colored" href="<?=($arSubItem['SECTION_PAGE_URL'] ? $arSubItem['SECTION_PAGE_URL'] : $arSubItem['DETAIL_PAGE_URL'] );?>"><?=$arSubItem['NAME']?></a></li>
										<?endforeach;?>
									</ul>
								</div>
							<?endif;?>
							<?if($arItem['CHILD']):?>
								<div class="button"><span class="opener font_upper" data-open_text="<?=GetMessage('CLOSE_TEXT');?>" data-close_text="<?=GetMessage('OPEN_TEXT');?>"><?=GetMessage('OPEN_TEXT');?></span></div>
							<?endif;?>
							<a href="<?=$arItem['SECTION_PAGE_URL']?>" class="arrow_open link"></a>
						</div>
					</div>
				</div>
			<?endforeach;?>
		</div>
	</div>
<?endif;?>