<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc;?>
<?
if($arResult['EMPTY_ITEM'] != 'Y')
{
	// preview image
	$bImage = strlen($arResult['PROPERTIES']['PICTURE_TYPE_3']['VALUE']);
	$arImage = ($bImage ? CFile::ResizeImageGet($arResult['PROPERTIES']['PICTURE_TYPE_3']['VALUE'], array('width' => 1000, 'height' => 1000), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array());
	$imageSrc = ($bImage ? $arImage['src'] : '');

	$bgImage = ($arResult['PROPERTIES']['PICTURE_TYPE_3_BG']['VALUE']);
	$bgImageSrc = ($bgImage ? CFile::GetPath($arResult['PROPERTIES']['PICTURE_TYPE_3_BG']['VALUE']) : '');
	?>

	<div class="item-views company front company_scroll type_3">
		<div class="company-block"<?=($bgImage ? ' style="background:url('.$bgImageSrc.') center top / cover no-repeat;"' : '');?>>
			<div class="row flexbox">
				<div class="item col-md-6">
					<div class="text">
						<?if($arParams['PAGER_SHOW_ALL'] && isset($arResult['DISPLAY_PROPERTIES']['URL']) && strlen($arResult['DISPLAY_PROPERTIES']['URL']['VALUE'])):?>
							<a class="show_all" href="<?=$arResult['DISPLAY_PROPERTIES']['URL']['VALUE'];?>"><span><?=(strlen($arParams['SHOW_ALL_TITLE']) ? $arParams['SHOW_ALL_TITLE'] : Loc::getMessage('S_TO_SHOW_ALL_COMPANY'))?></span></a>
						<?endif;?>
					
						<?if(isset($arResult['DISPLAY_PROPERTIES']['COMPANY_NAME']) && $arResult['DISPLAY_PROPERTIES']['COMPANY_NAME']['VALUE']):?>
							<h2><?=$arResult['DISPLAY_PROPERTIES']['COMPANY_NAME']['VALUE'];?></h2>
						<?endif;?>
						<?if((isset($arResult['DISPLAY_PROPERTIES']['COMPANY_TEXT']) && $arResult['DISPLAY_PROPERTIES']['COMPANY_TEXT']['VALUE'])):?>
							<div class="preview-text"><?=$arResult['DISPLAY_PROPERTIES']['COMPANY_TEXT']['~VALUE']['TEXT'];?></div>
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
				
				<?if($bImage):?>
					<div class="item col-md-6">
						<div class="image"><img class="img-responsive" src="<?=$imageSrc;?>" alt="<?=$arResult['NAME']?>"></div>
					</div>
				<?endif;?>
			</div>
		</div>
	</div>
<?}?>