<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<?
global $arTheme;
// get section items count and subsections
$arItemFilter = CPriority::GetCurrentSectionElementFilter($arResult["VARIABLES"], $arParams);
$arSectionFilter = CPriority::GetCurrentSectionFilter($arResult["VARIABLES"], $arParams);
$itemsCnt = CCache::CIblockElement_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]))), $arItemFilter, array());
$arSection = CCache::CIblockSection_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]), "MULTI" => "N")), $arSectionFilter, false, array('ID', 'DESCRIPTION', 'PICTURE', 'DETAIL_PICTURE', 'IBLOCK_ID', 'UF_TOP_SEO'));
CPriority::AddMeta(
	array(
		'og:description' => $arSection['DESCRIPTION'],
		'og:image' => (($arSection['PICTURE'] || $arSection['DETAIL_PICTURE']) ? CFile::GetPath(($arSection['PICTURE'] ? $arSection['PICTURE'] : $arSection['DETAIL_PICTURE'])) : false),
	)
);
$arSubSectionFilter = CPriority::GetCurrentSectionSubSectionFilter($arResult["VARIABLES"], $arParams, $arSection['ID']);
$arSubSections = CCache::CIblockSection_GetList(array("CACHE" => array("TAG" => CCache::GetIBlockCacheTag($arParams["IBLOCK_ID"]), "MULTI" => "Y")), $arSubSectionFilter, false, array("ID", "DEPTH_LEVEL"));

$sViewElementsTemplate = ($arParams["SECTION_ELEMENTS_TYPE_VIEW"] == "FROM_MODULE" ? $arTheme['SERVICES_SECTION_ELEMENTS_TYPE_VIEW']['VALUE'] : $arParams["SECTION_ELEMENTS_TYPE_VIEW"]);
?>
<?if(!$arSection && $arParams['SET_STATUS_404'] !== 'Y'):?>
	<div class="alert alert-warning"><?=GetMessage("SECTION_NOTFOUND")?></div>
<?elseif(!$arSection && $arParams['SET_STATUS_404'] === 'Y'):?>
	<?CPriority::goto404Page();?>
<?else:?>
	<?CPriority::CheckComponentTemplatePageBlocksParams($arParams, __DIR__);?>
	<?// rss
	if($arParams['USE_RSS'] !== 'N'){
		CPriority::ShowRSSIcon(CComponentEngine::makePathFromTemplate($arResult['FOLDER'].$arResult['URL_TEMPLATES']['rss_section'], array_map('urlencode', $arResult['VARIABLES'])));
	}
	//seo
	$arSeoItems = CCache::CIBLockElement_GetList(array('CACHE' => array("MULTI" =>"Y", "TAG" => CCache::GetIBlockCacheTag($arParams["LANDING_IBLOCK_ID"]))), array("IBLOCK_ID" => $arParams["LANDING_IBLOCK_ID"], "ACTIVE"=>"Y"), false, false, array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "DETAIL_PICTURE", "PROPERTY_FILTER_URL", "PROPERTY_FORM_QUESTION", "PROPERTY_TIZERS", "PROPERTY_SECTION", "PROPERTY_LINK_REGION", "DETAIL_TEXT", "PROPERTY_SEO_TEXT", "ElementValues"));
	$arSeoItemsSection = CCache::CIBLockElement_GetList(array('CACHE' => array("MULTI" =>"N", "TAG" => CCache::GetIBlockCacheTag($arParams["LANDING_IBLOCK_ID"]))), array("IBLOCK_ID" => $arParams["LANDING_IBLOCK_ID"], "ACTIVE"=>"Y", 'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID']), false, false, array("PROPERTY_SECTION"));
	$arSeoItem = array();
	if($arSeoItems)
	{
		$current_url =  $APPLICATION->GetCurDir();
		$url = urldecode(str_replace(' ', '+', $current_url));
		foreach($arSeoItems as $arItem)
		{
			if(urldecode($arItem["PROPERTY_FILTER_URL_VALUE"]) == $url)
			{
				$arSeoItem = $arItem;
				break;
			}
		}
		if($arSeoItem['PROPERTY_LINK_REGION_VALUE'] && $arRegion)
		{
			if(!is_array($arSeoItem['PROPERTY_LINK_REGION_VALUE']))
				$arSeoItem['PROPERTY_LINK_REGION_VALUE'] = (array)$arSeoItem['PROPERTY_LINK_REGION_VALUE'];
			if(!in_array($arRegion['ID'], $arSeoItem['PROPERTY_LINK_REGION_VALUE']))
				$arSeoItem = array();
		}
		
		if($arSeoItem){
			$arSeoItemBanner = array();
			$dbRes = CIBlockElement::GetProperty($arItem['IBLOCK_ID'], $arItem['ID'], array(), array());
			while($arRes = $dbRes->Fetch()){
				$arSeoItemBanner['PROPERTIES'][$arRes['CODE']] = $arRes;
			}
		}
		//unset($arSeoItems);
	}
	?>

	<div class="main-section-wrapper">
		<?if($arSection['UF_TOP_SEO'] && strpos($_SERVER['REQUEST_URI'], 'PAGEN') === false):?>
			<div class="maxwidth-theme">
				<div class="text_before_items">
					<p class="introtext"><?=$arSection['UF_TOP_SEO'];?></p>
				</div>
			</div>
		<?endif;?>

		<div class="maxwidth-theme">
			<div class="row">
				<?if($arTheme["SIDE_MENU"]["VALUE"] == "RIGHT"):?>
					<div class="col-md-9 col-sm-12 col-xs-12 content-md">
					<?CPriority::get_banners_position('CONTENT_TOP');?>
				<?elseif($arTheme["SIDE_MENU"]["VALUE"] == "LEFT"):?>
					<div class="col-md-3 col-sm-3 hidden-xs hidden-sm left-menu-md">
						<?CPriority::ShowPageType('left_block')?>
					</div>
					<div class="col-md-9 col-sm-12 col-xs-12 content-md">
					<?CPriority::get_banners_position('CONTENT_TOP');?>
				<?endif;?>
				<?/*if($arSubSections):?>
					<?// sections list?>
					<?@include_once('page_blocks/section6.php');?>
				<?endif;*/?>
				<?// section elements?>
				<?if($arSeoItem):?>
					<div class="seo_block">
						<?if($arSeoItem["DETAIL_PICTURE"]):?>
							<div class="image"><img src="<?=CFile::GetPath($arSeoItem["DETAIL_PICTURE"]);?>" alt="" title="" class="img-responsive"/></div>
						<?endif;?>
						<div class="description">
							<?if($arSeoItem["DETAIL_TEXT"]):?>
								<?=$arSeoItem["DETAIL_TEXT"]?>
							<?endif;?>
							<?if($arSeoItem["PROPERTY_FORM_QUESTION_VALUE"]):?>
								<table class="order-block noicons">
									<tbody>
										<tr>
											<td class="col-md-9 col-sm-8 col-xs-7 valign">
												<div class="text">
													<?$APPLICATION->IncludeComponent(
														 'bitrix:main.include',
														 '',
														 Array(
															  'AREA_FILE_SHOW' => 'page',
															  'AREA_FILE_SUFFIX' => 'ask',
															  'EDIT_TEMPLATE' => ''
														 )
													);?>		
												</div>
											</td>
											<td class="col-md-3 col-sm-4 col-xs-5 valign">
												<div class="btns">
													<span class="btn btn-default btn-lg animate-load" data-event="jqm" data-param-id="<?=CPriority::getFormID('aspro_priority_question');?>" data-name="question"><?=(strlen($arParams['S_ASK_QUESTION']) ? $arParams['S_ASK_QUESTION'] : GetMessage('S_ASK_QUESTION'))?></span>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							<?endif;?>
						</div>
					</div>
				<?endif;?>
				
				<?@include_once('page_blocks/'.$sViewElementsTemplate.'.php');?>

				<?if($arSection['DESCRIPTION'] && strpos($_SERVER['REQUEST_URI'], 'PAGEN') === false && !$arSeoItem):?>
					<div class="text_after_items">
						<?=$arSection['DESCRIPTION'];?>
					</div>
				<?endif;?>
				<?if($arSeoItems):?>
					<?if($arSeoItem["PROPERTY_SEO_TEXT_VALUE"]['TEXT']):?>
						<div class="bottom_seo"><?=$arSeoItem["PROPERTY_SEO_TEXT_VALUE"]['TEXT'];?></div>
					<?endif;?>
					<?
					if($arSeoItem){
						if(!isset($arSeoItem["IPROPERTY_VALUES"]))
						{
							$ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues($arSeoItem["IBLOCK_ID"], $arSeoItem["ID"]);
							$arSeoItem["IPROPERTY_VALUES"] = $ipropValues->getValues();
						}
						$langing_seo_h1 = ($arSeoItem["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"] != "" ? $arSeoItem["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"] : $arSeoItem["NAME"]);
						$langing_seo_title = ($arSeoItem["IPROPERTY_VALUES"]["ELEMENT_META_TITLE"] != "" ? $arSeoItem["IPROPERTY_VALUES"]["ELEMENT_META_TITLE"] : $langing_seo_h1);
						$APPLICATION->SetTitle($langing_seo_h1);
						$APPLICATION->AddChainItem($langing_seo_h1);

						if($langing_seo_title)
							$APPLICATION->SetPageProperty("title", $langing_seo_title);
						
						if($arSeoItem["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"])
							$APPLICATION->SetPageProperty("description", $arSeoItem["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"]);
						
						if($arSeoItem["IPROPERTY_VALUES"]['ELEMENT_META_KEYWORDS'])
							$APPLICATION->SetPageProperty("keywords", $arSeoItem["IPROPERTY_VALUES"]['ELEMENT_META_KEYWORDS']);
						
						$arSeoItemBanner['IPROPERTY_VALUES'] = $arSeoItem["IPROPERTY_VALUES"];
						$arSeoItemBanner['NAME'] = $arSeoItem["NAME"];
						$arSeoItemBanner['FIELDS']['PREVIEW_TEXT'] = $arSeoItem["PREVIEW_TEXT"];
					}
					?>
					<?if(isset($arSeoItemBanner['PROPERTIES']['BNR_TOP']) && $arSeoItemBanner['PROPERTIES']['BNR_TOP']['VALUE_XML_ID'] == 'YES'):?>
						<?
						global $SECTION_BNR_CONTENT;
						$SECTION_BNR_CONTENT = true;
						?>
						<?$this->SetViewTarget("section_bnr_content");?>
							<?CPriority::ShowTopDetailBanner($arSeoItemBanner, $arParams);?>
						<?$this->EndViewTarget();?>
					<?endif;?>
					
					<?if($arSeoItemsSection["PROPERTY_SECTION_VALUE"]):?>
						<?$GLOBALS["arLandingSections"] = array("PROPERTY_SECTION" => $arSeoItemsSection["PROPERTY_SECTION_VALUE"], "!ID" => $arSeoItem["ID"]);?>
						<?$APPLICATION->IncludeComponent(
							"bitrix:news.list", 
							"landings_list", 
							array(
								"IBLOCK_TYPE" => "aspro_priority_advt",
								"IBLOCK_ID" => $arParams["LANDING_IBLOCK_ID"],
								"NEWS_COUNT" => ($arParams["LANDING_SECTION_COUNT"] < 1 ? 1 : $arParams["LANDING_SECTION_COUNT"]),
								"SHOW_COUNT" => ($arParams["LANDING_SECTION_COUNT_VISIBLE"] < 1 ? 1 : $arParams["LANDING_SECTION_COUNT_VISIBLE"]),
								"COMPARE_FIELD" => "FILTER_URL",
								"COMPARE_PROP" => "Y",
								"SORT_BY1" => "SORT",
								"SORT_ORDER1" => "ASC",
								"SORT_BY2" => "ID",
								"SORT_ORDER2" => "DESC",
								"FILTER_NAME" => "arLandingSections",
								"FIELD_CODE" => array(
									0 => "PREVIEW_PICTURE",
									1 => "PREVIEW_TEXT",
									2 => "NAME",
								),
								"PROPERTY_CODE" => array(
									0 => "LINK",
									1 => "",
								),
								"CHECK_DATES" => "Y",
								"DETAIL_URL" => "",
								"AJAX_MODE" => "N",
								"AJAX_OPTION_JUMP" => "N",
								"AJAX_OPTION_STYLE" => "Y",
								"AJAX_OPTION_HISTORY" => "N",
								"CACHE_TYPE" =>$arParams["CACHE_TYPE"],
								"CACHE_TIME" => $arParams["CACHE_TIME"],
								"CACHE_FILTER" => "Y",
								"CACHE_GROUPS" => "N",
								"PREVIEW_TRUNCATE_LEN" => "150",
								"ACTIVE_DATE_FORMAT" => "j F Y",
								"SET_TITLE" => "N",
								"SET_STATUS_404" => "N",
								"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
								"ADD_SECTIONS_CHAIN" => "N",
								"HIDE_LINK_WHEN_NO_DETAIL" => "N",
								"PARENT_SECTION" => "",
								"PARENT_SECTION_CODE" => "",
								"INCLUDE_SUBSECTIONS" => "Y",
								"PAGER_TEMPLATE" => "",
								"DISPLAY_TOP_PAGER" => "N",
								"DISPLAY_BOTTOM_PAGER" => "N",
								"PAGER_TITLE" => "",
								"PAGER_SHOW_ALWAYS" => "N",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
								"PAGER_SHOW_ALL" => "N",
								"AJAX_OPTION_ADDITIONAL" => "",
								"COMPONENT_TEMPLATE" => "next",
								"SET_BROWSER_TITLE" => "N",
								"SET_META_KEYWORDS" => "N",
								"SET_META_DESCRIPTION" => "N",
								"SET_LAST_MODIFIED" => "N",
								"PAGER_BASE_LINK_ENABLE" => "N",
								"TITLE_BLOCK" => $arParams["LANDING"],
								"SHOW_404" => "N",
								"MESSAGE_404" => ""
							),
							false, array("HIDE_ICONS" => "Y")
						);?>
					<?endif;?>
				<?endif;?>
				<?if($arTheme["SIDE_MENU"]["VALUE"] == "LEFT"):?>
					<?CPriority::get_banners_position('CONTENT_BOTTOM');?>
					</div><?// class=col-md-9 col-sm-9 col-xs-8 content-md?>
				<?elseif($arTheme["SIDE_MENU"]["VALUE"] == "RIGHT"):?>
					<?CPriority::get_banners_position('CONTENT_BOTTOM');?>
					</div><?// class=col-md-9 col-sm-9 col-xs-8 content-md?>
					<div class="col-md-3 col-sm-3 hidden-xs hidden-sm right-menu-md">
						<?CPriority::ShowPageType('left_block')?>
					</div>
				<?endif;?>
			</div>
		</div>
	</div>
<?endif;?>