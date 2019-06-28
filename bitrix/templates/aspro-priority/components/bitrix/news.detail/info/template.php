<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?if($arResult):?>
	<div class="main_info greyline">
		<div class="maxwidth-theme">
			<div class="item clearfix">
				<?
				$bMainAction = (isset($arResult['DISPLAY_PROPERTIES']['MAIN_ACTION_PICTURE']) && $arResult['DISPLAY_PROPERTIES']['MAIN_ACTION_PICTURE']['VALUE'] ? true : false);
				?>
				<?if($bMainAction):?>
					<?
					$arImage = CFile::ResizeImageGet($arResult['DISPLAY_PROPERTIES']['MAIN_ACTION_PICTURE']['VALUE'], array('width' => 250, 'height' => 275), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
					?>
					<div class="image"><img class="img-responsive" src="<?=$arImage['src'];?>" alt="<?=$arResult['NAME'];?>" title="<?=$arResult['NAME'];?>"></div>
				<?endif;?>
				<div class="body-info<?=(!$bMainAction ? ' wti' : '')?>">
					<?if(isset($arResult['DISPLAY_PROPERTIES']['INFO_BLOCK_NAME']) && $arResult['DISPLAY_PROPERTIES']['INFO_BLOCK_NAME']['VALUE']):?>
						<div class="title"><h2><?=$arResult['DISPLAY_PROPERTIES']['INFO_BLOCK_NAME']['VALUE'];?></h2></div>
					<?endif;?>
					<?if(isset($arResult['DISPLAY_PROPERTIES']['INFO_BLOCK_TEXT']) && $arResult['DISPLAY_PROPERTIES']['INFO_BLOCK_TEXT']['VALUE']):?>
						<div class="previewtext"><?=$arResult['DISPLAY_PROPERTIES']['INFO_BLOCK_TEXT']['~VALUE']['TEXT'];?></div>
					<?endif;?>
					<?
					$bOrderButton = (isset($arResult['DISPLAY_PROPERTIES']['ORDER_FORM']) && $arResult['DISPLAY_PROPERTIES']['ORDER_FORM']['VALUE_XML_ID'] == 'Y' ? true : false);
					$bCallbackButton = (isset($arResult['DISPLAY_PROPERTIES']['CALLBACK_FORM']) && $arResult['DISPLAY_PROPERTIES']['CALLBACK_FORM']['VALUE_XML_ID'] == 'Y' ? true : false);
					?>
					<?if($bOrderButton || $bCallbackButton):?>
						<div class="buttons">
							<?if($bOrderButton):?>
								<div class="button">
									<span class="order_button btn btn-default animate-load" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_question");?>" data-name="question"><?=($arParams['ORDER_BUTTON_TITLE'] ? $arParams['ORDER_BUTTON_TITLE'] : GetMessage('ORDER_BUTTON_TITLE'));?></span>
								</div>
							<?endif;?>
							<?if($bCallbackButton):?>
								<div class="button">
									<span class="callback-block btn btn-default btn-transparent animate-load" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_callback");?>" data-name="callback"><?=($arParams['CALLBACK_BUTTON_TITLE'] ? $arParams['CALLBACK_BUTTON_TITLE'] : GetMessage('CALLBACK_BUTTON_TITLE'));?></span>
								</div>
							<?endif;?>
						</div>
					<?endif;?>
				</div>
			</div>
		</div>
	</div>
<?endif;?>