<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc;?>
<?if($arResult['ITEMS']):?>
	<div class="wraps">

		<?if($arParams["TITLE"]):?>
			<h4><?=$arParams["TITLE"];?></h4>
		<?endif;?>
		<div class="item-views list-type-block <?=($arParams['IMAGE_POSITION'] ? 'image_'.$arParams['IMAGE_POSITION'] : '')?> <?=$templateName;?>">
			<div class="row">
				<?foreach($arResult['ITEMS'] as $i => $arItem):?>
					<?
					// edit/add/delete buttons for edit mode
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					// use detail link?
					$bDetailLink = $arParams['SHOW_DETAIL_LINK'] != 'N' && (!strlen($arItem['DETAIL_TEXT']) ? ($arParams['HIDE_LINK_WHEN_NO_DETAIL'] !== 'Y' && $arParams['HIDE_LINK_WHEN_NO_DETAIL'] != 1) : true);
					// show preview picture?
					$bImage = isset($arItem['FIELDS']['PREVIEW_PICTURE']) && strlen($arItem['PREVIEW_PICTURE']['SRC']);
					$imageSrc = ($bImage ? $arItem['PREVIEW_PICTURE']['SRC'] : false);
					$imageDetailSrc = ($bImage ? $arItem['DETAIL_PICTURE']['SRC'] : false);
					?>

					<div class="col-md-3 col-sm-6 col-xs-6 col-m-12">
						<div class="item shadow <?=(isset($arParams['IMG_PADDING']) && $arParams['IMG_PADDING'] == 'Y' ? 'padding-img' : '');?> <?=($bImage ? '' : ' wti')?> clearfix" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
							<?if($bImage):?>
                                <?$img = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array( "width" => 296, "height" => 183), BX_RESIZE_IMAGE_EXACT, true);?>
								<div class="image <?=(isset($arParams['IMG_PADDING']) && $arParams['IMG_PADDING'] == 'Y' ? 'padding' : '');?>">
									<?if($bDetailLink):?>
										<a href="<?=$arItem['DETAIL_PAGE_URL']?>">
									<?endif;?>
										<img src="<?=$img["src"]?>" alt="<?=($bImage ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($bImage ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" class="img-responsive" />
									<?if($bDetailLink):?>
										</a>
									<?endif;?>
								</div>
							<?endif;?>
                            <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="hover-block">
                                <div class="title"><?=$arItem['NAME']?></div>
                                <div class="line"></div>
                                <div class="subtitle"><?=$arItem['PROPERTIES']['SERVICES_SUBTITLE']['VALUE']?></div>
                            </a>
							<div class="body-info">
								<?// element name?>
								<?if(strlen($arItem['FIELDS']['NAME'])):?>
									<div class="title-wrapper">
										<div class="title">
											<?if($bDetailLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="dark-color"><?endif;?>
												<span class="name"><?=$arItem['NAME']?></span>

											<?if($bDetailLink):?></a><?endif;?>
										</div>
									</div>
								<?endif;?>

								<?// element preview text?>
								<?/*if(strlen($arItem['FIELDS']['PREVIEW_TEXT'])):*/?><!--
									<div class="previewtext">
										<?/*if($arItem['PREVIEW_TEXT_TYPE'] == 'text'):*/?>
											<p><?/*=$arItem['FIELDS']['PREVIEW_TEXT']*/?></p>
										<?/*else:*/?>
											<?/*=$arItem['FIELDS']['PREVIEW_TEXT']*/?>
										<?/*endif;*/?>
									</div>
								--><?/*endif;*/?>
							</div>
						</div>
					</div>
				<?endforeach;?>
			</div>
		</div>
	</div>
<?endif;?>