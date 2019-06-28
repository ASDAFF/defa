<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc;?>
<?if($arResult['ITEMS']):?>
	<div class="item-views news-items type_1 front news_list">
		<?if($arParams["DISPLAY_TOP_PAGER"]):?>
			<div class="pagination_nav">	
				<?=$arResult["NAV_STRING"]?>
			</div>
		<?endif;?>
		
		<div class="items row flexbox">
			<?$arParams['LINE_ELEMENT_COUNT_LIST'] = ($arParams['LINE_ELEMENT_COUNT_LIST'] <=0 ? 3 : $arParams['LINE_ELEMENT_COUNT_LIST']);?>
			<?foreach($arResult['ITEMS'] as $i => $arItem):?>
				<?
				// edit/add/delete buttons for edit mode
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				// use detail link?
				$bDetailLink = $arParams['SHOW_DETAIL_LINK'] != 'N' && (!strlen($arItem['DETAIL_TEXT']) ? ($arParams['HIDE_LINK_WHEN_NO_DETAIL'] !== 'Y' && $arParams['HIDE_LINK_WHEN_NO_DETAIL'] != 1) : true);
				// preview image
				$bImage = strlen($arItem['FIELDS']['PREVIEW_PICTURE']['SRC']);
				$imageSrc = ($bImage ? $arItem['FIELDS']['PREVIEW_PICTURE']['SRC'] : '');

				// show active date period
				$bActiveDate = strlen($arItem['DISPLAY_PROPERTIES']['PERIOD']['VALUE']) || ($arItem['DISPLAY_ACTIVE_FROM'] && in_array('DATE_ACTIVE_FROM', $arParams['FIELD_CODE']));
				
				?>
				<div class="item<?=(!$bImage ? ' wti' : '')?> col-md-4 col-sm-4 col-xs-6">
					<div class="wrap border shadow clearfix" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<?if($imageSrc):?>
							<div class="image<?=($bImage ? "" : " wti" );?>">
								<div class="wrap">
									<?if($bDetailLink):?><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?endif;?>
										<img class="img-responsive" src="<?=$imageSrc?>" alt="<?=($bImage ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($bImage ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" />
									<?if($bDetailLink):?></a><?endif;?>
								</div>
							</div>
						<?endif;?>
						<div class="body-info">
							<div class="wrap">
								<?// section title?>
								<?if(strlen($arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['NAME'])):?>								
									<div class="section_name"><?=$arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['NAME']?></div>
								<?endif;?>
							
								<?// element name?>
								<?if(strlen($arItem['FIELDS']['NAME'])):?>
									<div class="title font_md">
										<?if($bDetailLink):?><a class="dark-color" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?endif;?>
											<?=$arItem['NAME']?>
										<?if($bDetailLink):?></a><?endif;?>
									</div>
								<?endif;?>

								<?// element preview text?>
								<?if(strlen($arItem['FIELDS']['PREVIEW_TEXT']) && !$bImage):?>
									<div class="previewtext">
										<?if($arItem['PREVIEW_TEXT_TYPE'] == 'text'):?>
											<p><?=$arItem['FIELDS']['PREVIEW_TEXT']?></p>
										<?else:?>
											<?=$arItem['FIELDS']['PREVIEW_TEXT']?>
										<?endif;?>
									</div>
								<?endif;?>

								<?// date active period?>
								<?if($bActiveDate):?>
									<div class="period">
										<?if(strlen($arItem['DISPLAY_PROPERTIES']['PERIOD']['VALUE'])):?>
											<span class="date font_xs"><?=$arItem['DISPLAY_PROPERTIES']['PERIOD']['VALUE']?></span>
										<?else:?>
											<span class="date font_xs"><?=$arItem['DISPLAY_ACTIVE_FROM']?></span>
										<?endif;?>
									</div>
								<?endif;?>
							</div>
						</div>
					</div>
				</div>
			<?endforeach;?>
		</div>
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
			<div class="pagination_nav">		
				<?=$arResult["NAV_STRING"]?>
			</div>
		<?endif;?>				
	</div>
<?endif;?>