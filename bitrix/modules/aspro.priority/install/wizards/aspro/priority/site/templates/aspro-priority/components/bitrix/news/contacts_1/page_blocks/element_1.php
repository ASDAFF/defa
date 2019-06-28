<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?
$bUseMap = CPriority::GetFrontParametrValue('CONTACTS_USE_MAP', SITE_ID) != 'N';
$bUseFeedback = CPriority::GetFrontParametrValue('CONTACTS_USE_FEEDBACK', SITE_ID) != 'N';

$arPlacemarks = array();
$arItem = $arItem[0];
if($bUseMap && $arItem['PROPERTY_MAP_VALUE']){
	$arCoords = explode(',', $arItem['PROPERTY_MAP_VALUE']);
	
	$html = '';
	
	$html .= '<div class="title">'.$arItem['NAME'].'</div>';
	
	if(strlen($arItem['PROPERTY_SCHEDULE_VALUE']['TEXT']) || $arItem['PROPERTY_PHONE_VALUE'] || $arItem['PROPERTY_METRO_VALUE'] || $arItem['PROPERTY_EMAIL_VALUE']){
		$html .= '<div class="properties">';
			
			$html .= (strlen($arItem['PROPERTY_METRO_VALUE']) ? '<div class="property schedule"><div class="title-prop font_upper">'.$arProperties['METRO']['NAME'].'</div><div class="value font_sm">'.$arItem['PROPERTY_METRO_VALUE'].'</div></div>' : '');
			$html .= (strlen($arItem['PROPERTY_SCHEDULE_VALUE']['TEXT']) ? '<div class="property schedule"><div class="title-prop font_upper">'.$arProperties['SCHEDULE']['NAME'].'</div><div class="value font_sm">'.$arItem['PROPERTY_SCHEDULE_VALUE']['TEXT'].'</div></div>' : '');
			
			if($arItem['PROPERTY_PHONE_VALUE']){
				$phone = '';
				if(is_array($arItem['PROPERTY_PHONE_VALUE'])){
					foreach($arItem['PROPERTY_PHONE_VALUE'] as $value){
						$phone .= '<div class="value"><a rel= "nofollow" href="tel:'.str_replace(array(' ', ',', '-', '(', ')'), '', $value).'">'.$value.'</a></div>';
					}
				}
				else{
					$phone = '<div class="value font_sm"><a rel= "nofollow" href="tel:'.str_replace(array(' ', ',', '-', '(', ')'), '', $arItem['PROPERTY_PHONE_VALUE']).'">'.$arItem['PROPERTY_PHONE_VALUE'].'</a></div>';
				
					
				}
				$html .= '<div class="property phone"><div class="title-prop font_upper">'.$arProperties['PHONE']['NAME'].'</div>'.$phone.'</div>';
			}
		
			$html .= (strlen($arItem['PROPERTY_EMAIL_VALUE']) ? '<div class="property email"><div class="title-prop font_upper">'.$arProperties['EMAIL']['NAME'].'</div><div class="value font_sm"><a href="'.$arItem['PROPERTY_EMAIL_VALUE'].'">'.$arItem['PROPERTY_EMAIL_VALUE'].'</a></div></div>' : '');
		$html .= '</div>';
	}
	

	$arPlacemarks[] = array(
		"ID" => $arItem["ID"],
		"LAT" => $arCoords[0],
		"LON" => $arCoords[1],
		"TEXT" => $html,
	);
}
?>

<div class="contacts front contacts_page clearfix type_2" itemscope itemtype="http://schema.org/Organization">
	<div class="row margin0">
		<div class="item padding0 <?=($bUseMap ? 'col-md-6' : 'col-md-12')?>">
			<div class="left_block padding0">
				<?if(in_array('NAME', $arParams['LIST_FIELD_CODE'])):?>
					<div class="top_block">
						<div class="address">
							<span itemprop="address"><?=$arItem['NAME']?></span>
						</div>
					</div>
				<?endif;?>
				<div class="bottom_block">
					<div class="properties">
						<?if(in_array('METRO', $arParams['LIST_PROPERTY_CODE']) && $arItem['PROPERTY_METRO_VALUE']):?>
							<div class="property metro">
								<div class="title font_upper"><?=$arProperties['METRO']['NAME'];?></div>
								<div class="value"><?=$arItem['PROPERTY_METRO_VALUE'];?></div>
							</div>
						<?endif;?>
						<?if(in_array('SCHEDULE', $arParams['LIST_PROPERTY_CODE']) && $arItem['PROPERTY_SCHEDULE_VALUE']):?>
							<div class="property schedule">
								<div class="title font_upper"><?=$arProperties['SCHEDULE']['NAME'];?></div>
								<div class="value" itemprop="openingHours"><?=$arItem['PROPERTY_SCHEDULE_VALUE']['TEXT'];?></div>
							</div>
						<?endif;?>
						<?if(in_array('EMAIL', $arParams['LIST_PROPERTY_CODE']) && $arItem['PROPERTY_EMAIL_VALUE']):?>
							<div class="property email">
								<div class="title font_upper"><?=$arProperties['EMAIL']['NAME'];?></div>
								<div class="value" itemprop="email"><a class="dark-color" href="mailto:<?=$arItem['PROPERTY_EMAIL_VALUE'];?>"><?=$arItem['PROPERTY_EMAIL_VALUE'];?></a></div>
							</div>
						<?endif;?>
						<?if(in_array('PHONE', $arParams['LIST_PROPERTY_CODE']) && $arItem['PROPERTY_PHONE_VALUE']):?>
							<div class="property phone">
								<div class="title font_upper"><?=$arProperties['PHONE']['NAME'];?></div>
								<?if(is_array($arItem['PROPERTY_PHONE_VALUE'])):?>
									<?foreach($arItem['PROPERTY_PHONE_VALUE'] as $phone):?>
										<div class="value" >
											<a href="tel:<?=str_replace(array(' ', ',', '-', '(', ')'), '', $phone);?>" class="black" itemprop="telephone"><?=$phone;?></a>
										</div>
									<?endforeach;?>
								<?else:?>
									<div class="value" >
										<a href="tel:<?=str_replace(array(' ', ',', '-', '(', ')'), '', $arItem['PROPERTY_PHONE_VALUE']);?>" class="black" itemprop="telephone"><?=$arItem['PROPERTY_PHONE_VALUE'];?></a>
									</div>
								<?endif;?>
							</div>
						<?endif;?>
					</div>
					<div class="social-block">
						<?$APPLICATION->IncludeFile("/include/social.php", Array(), Array("MODE" => "html", "TEMPLATE" => "include_area.php", "NAME" => "Social"));?>
					</div>
					<?if(!$arItem['DETAIL_PICTURE']):?>
						<div class="feedback item">
							<div class="wrap">
								<?if(in_array('PREVIEW_TEXT', $arParams['LIST_FIELD_CODE']) && $arItem['PREVIEW_TEXT']):?>
									<div class="previewtext"><?=$arItem['PREVIEW_TEXT'];?></div>
								<?endif;?>
								<?if($bUseFeedback):?>
									<div class="button"><span class="btn btn-default btn-transparent animate-load question" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_question")?>" data-name="question"><?=($arParams['TITLE_BUTTON'] ? $arParams['TITLE_BUTTON'] : GetMessage('TITLE_BUTTON'));?></span></div>
								<?endif;?>
							</div>
						</div>
					<?endif;?>
				</div>
			</div>
		</div>
		<?if($bUseMap):?>
			<div class="item col-md-6 padding0">
				<div class="right_block">
					<?$APPLICATION->IncludeComponent(
						"bitrix:map.yandex.view", 
						"map", 
						array(
							"INIT_MAP_TYPE" => "MAP",
							"MAP_DATA" => serialize(array("yandex_lat"=>$arCoords[0],"yandex_lon"=>$arCoords[1],"yandex_scale"=>16,"PLACEMARKS"=>$arPlacemarks)),
							"MAP_WIDTH" => "100%",
							"MAP_HEIGHT" => "650",
							"CONTROLS" => array(
								0 => "ZOOM",
								1 => "TYPECONTROL",
								2 => "SCALELINE",
							),
							"OPTIONS" => array(
								0 => "ENABLE_DBLCLICK_ZOOM",
								1 => "ENABLE_DRAGGING",
							),
							"MAP_ID" => "MAP_v33",
							"COMPONENT_TEMPLATE" => "map"
						),
						false
					);?>
				</div>
			</div>
		<?endif;?>
		<div class="clearfix"></div>
		<?if($arItem['DETAIL_PICTURE']):?>
			<div class="col-md-6 padding0 image item">
					<?$img = CFile::ResizeImageGet($arItem['DETAIL_PICTURE'], array('width' => 991, 'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);?>
					<img src="<?=$img['src'];?>" alt="<?=$arItem['NAME'];?>">
			</div>
			<div class="col-md-6 padding0 feedback item">
				<div class="wrap">
					<?if(in_array('PREVIEW_TEXT', $arParams['LIST_FIELD_CODE']) && $arItem['PREVIEW_TEXT']):?>
						<div class="previewtext"><?=$arItem['PREVIEW_TEXT'];?></div>
					<?endif;?>
					<?if($bUseFeedback):?>
						<div class="button"><span class="btn btn-default btn-lg btn-transparent animate-load question" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_question")?>" data-name="question"><?=($arParams['TITLE_BUTTON'] ? $arParams['TITLE_BUTTON'] : GetMessage('TITLE_BUTTON'));?></span></div>
					<?endif;?>
				</div>
			</div>
		<?endif;?>
	</div>
</div>
<style>
.page-top-wrapper.grey{margin-bottom:0;}
</style>