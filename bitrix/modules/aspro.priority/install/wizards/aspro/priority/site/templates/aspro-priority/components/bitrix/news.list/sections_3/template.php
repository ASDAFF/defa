<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
<?use \Bitrix\Main\Localization\Loc;?>

<?if($arResult['SECTIONS']):?>
	<div class="item-views within type_2_within type_3_within services-items">
		<div class="items clearfix">
			<?foreach($arResult['SECTIONS'] as $arItem):?>
				<?
				// edit/add/delete buttons for edit mode
				$arSectionButtons = CIBlock::GetPanelButtons($arItem['IBLOCK_ID'], 0, $arItem['ID'], array('SESSID' => false, 'CATALOG' => true));
				$this->AddEditAction($arItem['ID'], $arSectionButtons['edit']['edit_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_EDIT'));
				$this->AddDeleteAction($arItem['ID'], $arSectionButtons['edit']['delete_section']['ACTION_URL'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'SECTION_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

				// preview picture
				if($bShowSectionImage = in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE'])){
					$bImage = strlen($arItem['~PICTURE']);
					$arSectionImage = ($bImage ? CFile::ResizeImageGet($arItem['~PICTURE'], array('width' => 538, 'height' => 538), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array());
					$imageSectionSrc = ($bImage ? $arSectionImage['src'] : '');
				}
				?>
				<div class="item shadow border<?=($bShowSectionImage && $imageSectionSrc ? '' : ' wti')?> <?=$arParams['IMAGE_CATALOG_POSITION'];?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
					<div class="wrap clearfix">
						<?// icon or preview picture?>
						<?if($bShowSectionImage && $imageSectionSrc):?>
							<div class="image">
								<a href="<?=$arItem['SECTION_PAGE_URL']?>"><img src="<?=$imageSectionSrc?>" alt="<?=( $arItem['PICTURE']['ALT'] ? $arItem['PICTURE']['ALT'] : $arItem['NAME']);?>" title="<?=( $arItem['PICTURE']['TITLE'] ? $arItem['PICTURE']['TITLE'] : $arItem['NAME']);?>" class="img-responsive" /></a>
							</div>
						<?endif;?>
						
						<div class="body-info">
							<?// section name?>
							<?if(in_array('NAME', $arParams['FIELD_CODE'])):?>
								<div class="title"><a class="dark-color" href="<?=$arItem['SECTION_PAGE_URL']?>"><?=$arItem['NAME']?></a></div>
							<?endif;?>

							<?if(in_array('PREVIEW_TEXT', $arParams['FIELD_CODE']) && strlen($arItem['DESCRIPTION'])):?>
								<div class="previewtext"><?=CPriority::truncateLengthText($arItem['DESCRIPTION'], $arParams['PREVIEW_TRUNCATE_LEN'])?></div>
							<?endif;?>
							<?// section child?>
							<?if($arItem['CHILD']):?>
								<div class="childs">
									<ul>
										<?foreach($arItem['CHILD'] as $arSubItem):?>
											<li class="font_sm">
												<a href="<?=($arSubItem['SECTION_PAGE_URL'] ? $arSubItem['SECTION_PAGE_URL'] : $arSubItem['DETAIL_PAGE_URL'] );?>">
													<span><?=$arSubItem['NAME']?></span>
													<?if($i < $arParams['ELEMENTS_COUNT'] && $i != count($arItem['CHILD'])):?>
														<span class="separator">&mdash;</span>
													<?endif?>
												</a>
											</li>
										<?endforeach;?>
									</ul>
								</div>
								<div class="toogle"><span class="font_upper" data-open_text="<?=Loc::getMessage('CLOSE_TEXT')?>" data-close_text="<?=Loc::getMessage('OPEN_TEXT')?>"><?=Loc::getMessage('OPEN_TEXT')?></span></div>
							<?endif;?>
							<a class="arrow_link" href="<?=$arItem['SECTION_PAGE_URL'];?>"></a>
						</div>
					</div>
				</div>
			<?endforeach;?>
		</div>	
	</div>
<?endif;?>