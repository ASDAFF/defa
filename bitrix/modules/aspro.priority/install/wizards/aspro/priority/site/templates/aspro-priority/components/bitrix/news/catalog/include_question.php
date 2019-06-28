<div class="ask_question shadow">
	<div class="image">
		<?
		$arImage = ($arStaffElement['PREVIEW_PICTURE'] ? CFile::ResizeImageGet($arStaffElement['PREVIEW_PICTURE'], array('width' => 160, 'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : SITE_TEMPLATE_PATH.'/images/svg/Staff_noimage2.svg');
		?>
		<a href="<?=$arStaffElement['DETAIL_PAGE_URL'];?>"><img class="img-responsive" src="<?=$arImage['src'];?>" alt="<?=$arStaffElement['NAME'];?>" title="<?=$arStaffElement['NAME'];?>" /></a>
	</div>
	<div class="body-info">
		<?if($arStaffElement['PROPERTY_POST_VALUE']):?>
			<div class="post font_upper"><?=$arStaffElement['PROPERTY_POST_VALUE'];?></div>
		<?endif;?>
		<div class="name"><a class="dark-color" href="<?=$arStaffElement['DETAIL_PAGE_URL'];?>"><?=$arStaffElement['NAME'];?></a></div>
		<?if($arStaffElement['PROPERTY_PHONE_VALUE']):?>
			<?
			$href = 'tel:'.str_replace(array(' ', '-', '(', ')'), '', $arStaffElement['PROPERTY_PHONE_VALUE']);
			?>
			<div class="phone font_sm">
				<a href="<?=$href;?>"><?=$arStaffElement['PROPERTY_PHONE_VALUE']?></a>
			</div>
		<?endif;?>
	</div>
	<div class="button font_upper"><span class="animate-load" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_question_staff");?>" data-autoload-staff="<?=CPriority::formatJsName($arStaffElement['NAME'])?>" data-name="question_staff"><?=GetMessage('ASK_QUESTION_BUTTON');?></span></div>
</div>