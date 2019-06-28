<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>

<?if($arResult['ITEMS']):?>
	<?$i = 0;?>
	<div class="item-views linked sections services landings_list">
		<h4><?=($arParams["TITLE_BLOCK"] ? $arParams["TITLE_BLOCK"] : GetMessage('TITLE_LANDINGS'));?></h4>
		<div class="items row">
			<?$compare_field = (isset($arParams["COMPARE_FIELD"]) && $arParams["COMPARE_FIELD"] ? $arParams["COMPARE_FIELD"] : "DETAIL_PAGE_URL");
			$bProp = (isset($arParams["COMPARE_PROP"]) && $arParams["COMPARE_PROP"] == "Y");?>
			<?foreach($arResult['ITEMS'] as $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

				$bHidden = ($i == $arParams["SHOW_COUNT"] && count($arResult['ITEMS']) > $arParams["SHOW_COUNT"] ? true : false);
				$hiddenBlock = ($i == $arParams["SHOW_COUNT"] && count($arResult['ITEMS']) > $arParams["SHOW_COUNT"] ? true : false);
				$url = $arItem[$compare_field];
				if($bProp)
					$url = $arItem["PROPERTIES"][$compare_field]["VALUE"];
				// preview picture
				if($bShowSectionImage = in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE'])){
					$bImage = (isset($arItem['FIELDS']['PREVIEW_PICTURE']) && strlen($arItem['PREVIEW_PICTURE']['SRC']));
					$arSectionImage = ($bImage ? CFile::ResizeImageGet($arItem['FIELDS']['PREVIEW_PICTURE']['ID'], array('width' => 388, 'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL, true) : array());
					$imageSectionSrc = ($bImage ? $arSectionImage['src'] : '');
				}
				?>
				<?if($hiddenBlock):?>
					<div class="hidden_items">
				<?endif;?>
				<div class="col-md-12 col-sm-12">
					<div class="item_wrap border shadow">
						<div class="item clearfix<?=($bShowSectionImage && strlen($imageSectionSrc) ? '' : ' wti')?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
							<?if($bShowSectionImage && strlen($imageSectionSrc)):?>
								<div class="image">
									<div class="wrap">
										<a href="<?=$url;?>">
											<img src="<?=$imageSectionSrc?>" alt="<?=( $arItem['PICTURE']['ALT'] ? $arItem['PICTURE']['ALT'] : $arItem['NAME']);?>" title="<?=( $arItem['PICTURE']['TITLE'] ? $arItem['PICTURE']['TITLE'] : $arItem['NAME']);?>" class="img-responsive" />
										</a>
									</div>
								</div>
							<?endif;?>
							<div class="info">
								<?// section name?>
								<?if(in_array('NAME', $arParams['FIELD_CODE'])):?>
									<div class="title">
										<a href="<?=$url;?>" class="dark-color"><?=$arItem['NAME']?></a>
									</div>
								<?endif;?>
								<?if(in_array('PREVIEW_TEXT', $arParams['FIELD_CODE']) && strlen($arItem['PREVIEW_TEXT'])):?>
									<div class="previewtext"><?=$arItem['PREVIEW_TEXT']?></div>
								<?endif?>
							</div>
							<?if(strlen($url)):?>
								<a class="arrow_open link" href="<?=$url;?>"></a>
							<?endif?>
						</div>
					</div>
				</div>
				<?++$i;?>
			<?endforeach?>
			<?if(count($arResult['ITEMS']) > $arParams["SHOW_COUNT"]):?>
				</div>
			<?endif;?>
		</div>
		<?if($bHidden):?>
			<div class="more font_upper"><span data-opened="N" data-text="<?=GetMessage("HIDE");?>"><?=GetMessage("SHOW_ALL");?></span></div>
		<?endif?>
	</div>
<?endif?>