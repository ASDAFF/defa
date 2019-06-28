<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>	

<?
global $isMenu, $arTheme;
use \Bitrix\Main\Localization\Loc;

$bOrderViewBasket = $arParams['ORDER_VIEW'];
$basketURL = (isset($arTheme['URL_BASKET_SECTION']) && strlen(trim($arTheme['URL_BASKET_SECTION']['VALUE'])) ? $arTheme['URL_BASKET_SECTION']['VALUE'] : SITE_DIR.'cart/');
$dataItem = ($bOrderViewBasket ? CPriority::getDataItem($arResult) : false);
$bFormQuestion = (isset($arResult['DISPLAY_PROPERTIES']['FORM_QUESTION']) && $arResult['DISPLAY_PROPERTIES']['FORM_QUESTION']['VALUE'] == 'Y');
$catalogLinkedTemplate = (isset($arTheme['ELEMENTS_TABLE_TYPE_VIEW']) && $arTheme['ELEMENTS_TABLE_TYPE_VIEW']['VALUE'] == 'catalog_table_2' ? 'catalog_linked_2' : 'catalog_linked');

/*set array props for component_epilog*/
$templateData = array(
	'DOCUMENTS' => $arResult['DISPLAY_PROPERTIES']['DOCUMENTS']['VALUE'],
	'LINK_SALE' => $arResult['DISPLAY_PROPERTIES']['LINK_SALE']['VALUE'],
	'LINK_FAQ' => $arResult['DISPLAY_PROPERTIES']['LINK_FAQ']['VALUE'],
	'LINK_PROJECTS' => $arResult['DISPLAY_PROPERTIES']['LINK_PROJECTS']['VALUE'],
	'LINK_SERVICES' => $arResult['DISPLAY_PROPERTIES']['LINK_SERVICES']['VALUE'],
	'LINK_GOODS' => $arResult['DISPLAY_PROPERTIES']['LINK_GOODS']['VALUE'],
	'LINK_PARTNERS' => $arResult['DISPLAY_PROPERTIES']['LINK_PARTNERS']['VALUE'],
	'LINK_SERTIFICATES' => $arResult['DISPLAY_PROPERTIES']['LINK_SERTIFICATES']['VALUE'],
	'LINK_VACANCYS' => $arResult['DISPLAY_PROPERTIES']['LINK_VACANCYS']['VALUE'],
	'LINK_STAFF' => $arResult['DISPLAY_PROPERTIES']['LINK_STAFF']['VALUE'],
	'LINK_REVIEWS' => $arResult['DISPLAY_PROPERTIES']['LINK_REVIEWS']['VALUE'],
	'BRAND_ITEM' => $arResult['BRAND_ITEM'],
	'GALLERY_BIG' => $arResult['GALLERY_BIG'],
	'VIDEO' => $arResult['VIDEO'],
	'VIDEO_IFRAME' => $arResult['VIDEO_IFRAME'],
	'DETAIL_TEXT' => $arResult['FIELDS']['DETAIL_TEXT'],
	'ORDER' => $bOrderViewBasket,
	'FORM_QUESTION' => $arResult['DISPLAY_PROPERTIES']['FORM_QUESTION']['VALUE'],
	'CATALOG_LINKED_TEMPLATE' => $catalogLinkedTemplate,
);
if(isset($arResult['PROPERTIES']['BNR_TOP']) && $arResult['PROPERTIES']['BNR_TOP']['VALUE_XML_ID'] == 'YES')
	$templateData['SECTION_BNR_CONTENT'] = true;
?>

<?// shot top banners start?>
<?$bShowTopBanner = (isset($arResult['SECTION_BNR_CONTENT'] ) && $arResult['SECTION_BNR_CONTENT'] == true);?>
<?if($bShowTopBanner):?>
	<?$this->SetViewTarget("section_bnr_content");?>
		<?CPriority::ShowTopDetailBanner($arResult, $arParams);?>
	<?$this->EndViewTarget();?>
<?endif;?>

<div class="row">
	<div class="col-md-12">
		<?// element name?>
		<?if($arParams['DISPLAY_NAME'] != 'N' && strlen($arResult['NAME'])):?>
			<h2><?=$arResult['NAME']?></h2>
		<?endif;?>

		<?// single detail image?>
		<?if($arResult['FIELDS']['DETAIL_PICTURE']):?>
			<?
			$atrTitle = (strlen($arResult['DETAIL_PICTURE']['DESCRIPTION']) ? $arResult['DETAIL_PICTURE']['DESCRIPTION'] : (strlen($arResult['DETAIL_PICTURE']['TITLE']) ? $arResult['DETAIL_PICTURE']['TITLE'] : $arResult['NAME']));
			$atrAlt = (strlen($arResult['DETAIL_PICTURE']['DESCRIPTION']) ? $arResult['DETAIL_PICTURE']['DESCRIPTION'] : (strlen($arResult['DETAIL_PICTURE']['ALT']) ? $arResult['DETAIL_PICTURE']['ALT'] : $arResult['NAME']));
			?>
			<?if($arResult['PROPERTIES']['PHOTOPOS']['VALUE_XML_ID'] == 'LEFT'):?>
				<div class="detailimage image-left col-md-4 col-sm-4 col-xs-12"><a href="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="fancybox" title="<?=$atrTitle?>"><img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="img-responsive" title="<?=$atrTitle?>" alt="<?=$atrAlt?>" /></a></div>
			<?elseif($arResult['PROPERTIES']['PHOTOPOS']['VALUE_XML_ID'] == 'RIGHT'):?>
				<div class="detailimage image-right col-md-4 col-sm-4 col-xs-12"><a href="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="fancybox" title="<?=$atrTitle?>"><img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="img-responsive" title="<?=$atrTitle?>" alt="<?=$atrAlt?>" /></a></div>
			<?elseif($arResult['PROPERTIES']['PHOTOPOS']['VALUE_XML_ID'] == 'TOP'):?>
				<?$this->SetViewTarget('top_section_filter_content');?>
				<div class="detailimage image-head"><img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="img-responsive" title="<?=$atrTitle?>" alt="<?=$atrAlt?>"/></div>
				<?$this->EndViewTarget();?>
			<?else:?>
				<div class="detailimage image-wide"><a href="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="fancybox" title="<?=$atrTitle?>"><img src="<?=$arResult['DETAIL_PICTURE']['SRC']?>" class="img-responsive" title="<?=$atrTitle?>" alt="<?=$atrAlt?>" /></a></div>
			<?endif;?>
		<?endif;?>

		<?if($arResult['COMPANY']):?>
			<div class="wraps barnd-block">
				<div class="item-views list list-type-block image_left">
					<?if($arResult['COMPANY']['PROPERTY_SLOGAN_VALUE']):?>
						<div class="slogan"><?=$arResult['COMPANY']['PROPERTY_SLOGAN_VALUE'];?></div>
					<?endif;?>
					<div class="items row">
						<div class="col-md-12">
							<div class="item noborder clearfix">
								<?if($arResult['COMPANY']['IMAGE-BIG']):?>
									<div class="image">
										<a href="<?=$arResult['COMPANY']['DETAIL_PAGE_URL'];?>">
											<img src="<?=$arResult['COMPANY']['IMAGE-BIG']['src'];?>" alt="<?=$arResult['COMPANY']['NAME'];?>" title="<?=$arResult['COMPANY']['NAME'];?>" class="img-responsive">
										</a>
									</div>
								<?endif;?>
								<div class="body-info">
									<?if($arResult['COMPANY']['DETAIL_TEXT']):?>
										<div class="previewtext">
											<?=$arResult['COMPANY']['DETAIL_TEXT'];?>
										</div>
									<?endif;?>
									<?if($arResult['COMPANY']['PROPERTY_SITE_VALUE']):?>
										<div class="properties">
											<div class="inner-wrapper">
												<!-- noindex -->
												<a class="property icon-block site" href="<?=$arResult['COMPANY']['PROPERTY_SITE_VALUE'];?>" target="_blank" rel="nofollow">
													<?=$arResult['COMPANY']['PROPERTY_SITE_VALUE'];?>
												</a>
												<!-- /noindex -->
											</div>
										</div>
									<?endif;?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr>
			</div>
		<?endif;?>

		<?// date active from or dates period active?>
		<?
		$bdate = (strlen($arResult['DISPLAY_PROPERTIES']['PERIOD']['VALUE']) || ($arResult['DISPLAY_ACTIVE_FROM'] && in_array('DATE_ACTIVE_FROM', $arParams['FIELD_CODE'])) ? true : false)
		?>
		<?if($bdate || $arResult['SECTION']):?>
			<div class="top-wrapper">
				<?if($bdate):?>
					<div class="period font_xs">
						<?if(strlen($arResult['DISPLAY_PROPERTIES']['PERIOD']['VALUE'])):?>
							<span class="date"><?=$arResult['DISPLAY_PROPERTIES']['PERIOD']['VALUE']?></span>
						<?else:?>
							<span class="date"><?=$arResult['DISPLAY_ACTIVE_FROM']?></span>
						<?endif;?>
					</div>
				<?endif;?>
				<?if(isset($arResult['SECTION'])):?>
					<div class="section_name font_upper_md"><?=$arResult['SECTION']['NAME']?></div>
				<?endif;?>
			</div>
		<?endif;?>
		
		<?if(strlen($arResult['FIELDS']['DETAIL_TEXT'])):?>
			<div class="content">
				<?if(!$bShowTopBanner && strlen($arResult['FIELDS']['PREVIEW_TEXT'])):?>
					<div class="introtext">
						<?if($arResult['PREVIEW_TEXT_TYPE'] == 'text'):?>
							<p><?=$arResult['FIELDS']['PREVIEW_TEXT'];?></p>
						<?else:?>
							<?=$arResult['FIELDS']['PREVIEW_TEXT'];?>
						<?endif;?>
					</div>
				<?endif;?>
			
				<?// element detail text?>
				<?if(strlen($arResult['FIELDS']['DETAIL_TEXT'])):?>
					<?if($arResult['DETAIL_TEXT_TYPE'] == 'text'):?>
						<p><?=$arResult['FIELDS']['DETAIL_TEXT'];?></p>
					<?else:?>
						<?=$arResult['FIELDS']['DETAIL_TEXT'];?>
					<?endif;?>
				<?endif;?>
			</div>
		<?endif;?>

		<?// order block?>
		<?if($arResult['DISPLAY_PROPERTIES']['FORM_ORDER']['VALUE_XML_ID'] == 'YES' || $bShowFormQuestion):?>
			<table class="order-block">
				<tr>
					<td class="col-md-9 col-sm-8 col-xs-7 valign">
						<div class="text">
							<?$APPLICATION->IncludeComponent(
								'bitrix:main.include',
								'',
								Array(
									'AREA_FILE_SHOW' => 'file',
									'PATH' => SITE_DIR.'include/ask_services.php',
									'EDIT_TEMPLATE' => ''
								)
							);?>
						</div>
					</td>
					<td class="col-md-3 col-sm-4 col-xs-5 valign">
						<div class="btns">
							<?if($arResult['DISPLAY_PROPERTIES']['FORM_ORDER']['VALUE_XML_ID'] == 'YES'):?>
								<span><span class="btn btn-default btn-lg animate-load order" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_order_services")?>" data-name="order_services"><span><?=(strlen($arParams['S_ORDER_SERVISE']) ? $arParams['S_ORDER_SERVISE'] : Loc::getMessage('S_ORDER_SERVISE'))?></span></span>
							<?endif;?>
							<?if($bShowFormQuestion):?>
								<span><span class="btn btn-default btn-lg btn-transparent animate-load question" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_question")?>" data-name="order_services" data-autoload-service="<?=CPriority::formatJsName($arResult['NAME']);?>" data-autoload-project="<?=CPriority::formatJsName($arResult['NAME']);?>">
									<svg id="qmark.svg" xmlns="http://www.w3.org/2000/svg" width="7" height="13.031" viewBox="0 0 7 13.031">
										<path id="_copy" data-name="? copy" class="cls-1" d="M701.006,188.223c0,2.755-3.462,2.647-3.462,5.312a1.223,1.223,0,0,0,.027.43l0.909,0a1.088,1.088,0,0,1-.072-0.282c0-2.449,3.589-2.305,3.589-5.654,0-1.656-1.244-3.061-3.494-3.061a4.167,4.167,0,0,0-3.491,1.8l0.716,0.594a3.156,3.156,0,0,1,2.7-1.389A2.324,2.324,0,0,1,701.006,188.223Zm-4,8.722a1,1,0,1,0,1.99,0A1,1,0,0,0,697.007,196.945Z" transform="translate(-695 -184.969)"/>
									</svg>
								</span></span>
							<?endif;?>
						</div>
					</td>
				</tr>
			</table>
		<?endif;?>
	</div>
</div>