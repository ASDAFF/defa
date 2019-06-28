<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
?>
<?if($arResult['ITEMS']):?>
	<div class="row">
		<div class="col-md-12">
			<div class="item-views linked sections services">
				<div class="items row">
					<?foreach($arResult['ITEMS'] as $arItem):?>
						<?
						// edit/add/delete buttons for edit mode
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

						// preview picture
						$bImage = (isset($arItem['FIELDS']['PREVIEW_PICTURE']) && strlen($arItem['PREVIEW_PICTURE']['SRC']));
						$nImageID = ($bImage ? (is_array($arItem['FIELDS']['PREVIEW_PICTURE']) ? $arItem['FIELDS']['PREVIEW_PICTURE']['ID'] : $arItem['FIELDS']['PREVIEW_PICTURE']) : "");
						$arImage = ($bImage ? CFile::ResizeImageGet($nImageID, array('width' => 388, 'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL, true) : SITE_TEMPLATE_PATH.'/images/noimage.png');
						$imageSrc = $arImage['src'];
						?>
						<div class="col-md-12 col-sm-12">
							<div class="item_wrap border shadow">
								<div class="item clearfix<?=($bImage && strlen($imageSrc) ? '' : ' wti')?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
									<?// icon or preview picture?>
									<?if($bImage && strlen($imageSrc)):?>
										<div class="image">
											<div class="wrap">
												<a href="<?=$arItem['DETAIL_PAGE_URL']?>">
													<img src="<?=$imageSrc?>" alt="<?=( $arItem['PICTURE']['ALT'] ? $arItem['PICTURE']['ALT'] : $arItem['NAME']);?>" title="<?=( $arItem['PICTURE']['TITLE'] ? $arItem['PICTURE']['TITLE'] : $arItem['NAME']);?>" class="img-responsive" />
												</a>
											</div>
										</div>
									<?endif;?>
									
									<div class="info">
										<?// section name?>
										<?if(in_array('NAME', $arParams['FIELD_CODE'])):?>
											<div class="title">
												<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="dark-color"><?=$arItem['NAME']?></a>
											</div>
										<?endif;?>
										<?if(in_array('PREVIEW_TEXT', $arParams['FIELD_CODE']) && strlen($arItem['PREVIEW_TEXT'])):?>
											<div class="previewtext"><?=$arItem['PREVIEW_TEXT']?></div>
										<?endif?>
									</div>
									<?if(strlen($arItem['DETAIL_PAGE_URL'])):?>
										<a class="arrow_open link" href="<?=$arItem['DETAIL_PAGE_URL']?>"></a>
									<?endif?>
								</div>
							</div>
						</div>
					<?endforeach;?>
				</div>
			</div>
		</div>
	</div>
<?endif;?>