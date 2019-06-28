<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc;?>
<?
if($arResult['EMPTY_ITEM'] != 'Y')
{
	// preview image
	$bShowImage = in_array('DETAIL_PICTURE', $arParams['FIELD_CODE']);

	if($bShowImage){
		$bImage = strlen($arResult['FIELDS']['DETAIL_PICTURE']['SRC']);
		$arImage = ($bImage ? CFile::ResizeImageGet($arResult['FIELDS']['DETAIL_PICTURE']['ID'], array('width' => 1000, 'height' => 1000), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array());
		$imageSrc = ($bImage ? $arImage['src'] : '');
	}
	?>

	<div class="item-views company front type_4 company_scroll">
		<div class="company-block maxwidth-theme">
			<div class="row">
				<div class="item left_block col-md-4">
					<div class="text">
						<?if($arParams['PAGER_SHOW_ALL'] && isset($arResult['DISPLAY_PROPERTIES']['URL']) && strlen($arResult['DISPLAY_PROPERTIES']['URL']['VALUE'])):?>
							<a class="show_all" href="<?=$arResult['DISPLAY_PROPERTIES']['URL']['VALUE'];?>"><span><?=(strlen($arParams['SHOW_ALL_TITLE']) ? $arParams['SHOW_ALL_TITLE'] : Loc::getMessage('S_TO_SHOW_ALL_COMPANY'))?></span></a>
						<?endif;?>
					
						<?if(isset($arResult['DISPLAY_PROPERTIES']['COMPANY_NAME']) && $arResult['DISPLAY_PROPERTIES']['COMPANY_NAME']['VALUE']):?>
							<h2><?=$arResult['DISPLAY_PROPERTIES']['COMPANY_NAME']['VALUE'];?></h2>
						<?endif;?>
						<div class="buttons">
							<?if($arParams['PAGER_SHOW_ALL'] && isset($arResult['DISPLAY_PROPERTIES']['URL']) && strlen($arResult['DISPLAY_PROPERTIES']['URL']['VALUE'])):?>
								<a class="btn btn-default" href="<?=$arResult['DISPLAY_PROPERTIES']['URL']['VALUE'];?>"><span><?=(strlen($arParams['MORE_BUTTON_TITLE']) ? $arParams['MORE_BUTTON_TITLE'] : Loc::getMessage('S_TO_SHOW_ALL_MORE'))?></span></a>
							<?endif;?>

							<?if(isset($arResult['DISPLAY_PROPERTIES']['SHOW_BUTTON']) && $arResult['DISPLAY_PROPERTIES']['SHOW_BUTTON']['VALUE_XML_ID'] == 'Y'):?>
								<span>
									<span class="btn btn-default btn-transparent animate-load" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_question");?>" data-name="resume"><?=(strlen($arParams['FORM_BUTTON_TITLE']) ? $arParams['FORM_BUTTON_TITLE'] : Loc::getMessage('FORM_BUTTON_TITLE'));?></span>
								</span>
							<?endif;?>
						</div>
					</div>
				</div>
				
				<div class="item right_block col-md-8">
					<?if((isset($arResult['DISPLAY_PROPERTIES']['COMPANY_TEXT']) && $arResult['DISPLAY_PROPERTIES']['COMPANY_TEXT']['VALUE'])):?>
						<div class="preview-text"><?=$arResult['DISPLAY_PROPERTIES']['COMPANY_TEXT']['~VALUE']['TEXT'];?></div>
					<?endif;?>
					<?if(isset($arResult['COMPANY_PROPS']) && $arResult['COMPANY_PROPS']):?>
						<div class="front_tizers">
							<div class="props row flexbox">
								<?foreach($arResult['COMPANY_PROPS'] as $arProp):?>
									<div class="item-wrap col-md-6 col-sm-6 col-xs-6">
										<div class="item clearfix<?=(!$arProp['UF_FILE'] ? ' wti' : '')?>">
											<?if(isset($arProp['UF_FILE']) && $arProp['UF_FILE']):?>
												<div class="image"><img src="<?=$arProp['UF_FILE_FORMAT']['SMALL']['src']?>" alt="<?=$arProp['UF_NAME']?>" title="<?=$arProp['UF_NAME']?>" /></div>
											<?endif;?>
											<div class="body-info">
												<div class="title"><?=$arProp['UF_NAME']?></div>
												<?if(isset($arProp['UF_DESCRIPTION']) && $arProp['UF_DESCRIPTION']):?>
													<div class="value font_xs"><?if(isset($arProp['UF_FULL_DESCRIPTION']) && $arProp['UF_FULL_DESCRIPTION']):?><?=$arProp['UF_FULL_DESCRIPTION'];?><?endif;?><span <?=((isset($arProp['UF_CLASS']) && $arProp['UF_CLASS']) ? "class=".$arProp['UF_CLASS'] : "")?> data-value="<?=$arProp['UF_DESCRIPTION'];?>"><?=((int)$arProp['UF_DESCRIPTION'] ? 0 : $arProp['UF_DESCRIPTION']);?></span></div>
												<?endif;?>
											</div>
										</div>
									</div>
								<?endforeach;?>
							</div>
						</div>
					<?endif;?>
				</div>
			</div>
		</div>
	</div>
<?}?>