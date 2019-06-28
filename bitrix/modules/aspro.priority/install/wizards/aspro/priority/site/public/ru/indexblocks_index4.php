<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?global $arMainPageOrder, $indexType, $arTheme; //global array for order blocks?>
<?if($arMainPageOrder && is_array($arMainPageOrder)):?>
	<?foreach($arMainPageOrder as $key => $optionCode):?>
		<div class="drag-block container<?=($arTheme["INDEX_TYPE"]["SUB_PARAMS"][$indexType][$optionCode]["VALUE"] == 'Y' ? '' : ' hidden');?>" data-class="<?=$optionCode?>_drag" data-order="<?=++$key;?>">
			<?//BIG_BANNER_INDEX?>
			<?if($optionCode == "BIG_BANNER_INDEX"):?>
				<?global $bBigBannersIndex;?>
				<?if($bBigBannersIndex):?>
					<div class="row margin0">
						<?/*$APPLICATION->IncludeComponent(
							"bitrix:news.list", 
							"front-banners-big_mix", 
							array(
								"IBLOCK_TYPE" => "aspro_priority_advt",
								"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_priority_advt"]["aspro_priority_advtbig"][0],
								"NEWS_COUNT" => "30",
								"SORT_BY1" => "SORT",
								"SORT_ORDER1" => "ASC",
								"SORT_BY2" => "ID",
								"SORT_ORDER2" => "ASC",
								"FILTER_NAME" => "",
								"FIELD_CODE" => array(
									0 => "NAME",
									1 => "PREVIEW_TEXT",
									2 => "PREVIEW_PICTURE",
									3 => "DETAIL_PICTURE",
									4 => "",
								),
								"PROPERTY_CODE" => array(
									0 => "",
									1 => "BANNERTYPE",
									2 => "TEXTCOLOR",
									3 => "LINKIMG",
									4 => "BUTTON1TEXT",
									5 => "BUTTON1CLASS",
									6 => "BUTTON2TEXT",
									7 => "BUTTON2LINK",
									8 => "SECTION",
									9 => "",
								),
								"CHECK_DATES" => "Y",
								"DETAIL_URL" => "",
								"AJAX_MODE" => "N",
								"AJAX_OPTION_JUMP" => "N",
								"AJAX_OPTION_STYLE" => "Y",
								"AJAX_OPTION_HISTORY" => "N",
								"CACHE_TYPE" => "A",
								"CACHE_TIME" => "3600000",
								"CACHE_FILTER" => "Y",
								"CACHE_GROUPS" => "N",
								"PREVIEW_TRUNCATE_LEN" => "",
								"ACTIVE_DATE_FORMAT" => "d.m.Y",
								"SET_TITLE" => "N",
								"SET_STATUS_404" => "N",
								"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
								"ADD_SECTIONS_CHAIN" => "N",
								"HIDE_LINK_WHEN_NO_DETAIL" => "N",
								"PARENT_SECTION" => "",
								"PARENT_SECTION_CODE" => "",
								"INCLUDE_SUBSECTIONS" => "N",
								"PAGER_TEMPLATE" => ".default",
								"DISPLAY_TOP_PAGER" => "N",
								"DISPLAY_BOTTOM_PAGER" => "N",
								"PAGER_TITLE" => "Новости",
								"PAGER_SHOW_ALWAYS" => "N",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600000",
								"PAGER_SHOW_ALL" => "N",
								"AJAX_OPTION_ADDITIONAL" => "",
								"COMPONENT_TEMPLATE" => "front-banners-big_mix",
								"IBLOCK_SMALL_BANNERS_TYPE" => "aspro_priority_advt",
								"IBLOCK_SMALL_BANNERS_ID" => CCache::$arIBlocks[SITE_ID]["aspro_priority_advt"]["aspro_priority_smbanners"][0],
								"SET_BROWSER_TITLE" => "Y",
								"SET_META_KEYWORDS" => "Y",
								"SET_META_DESCRIPTION" => "Y",
								"SET_LAST_MODIFIED" => "N",
								"STRICT_SECTION_CHECK" => "N",
								"PAGER_BASE_LINK_ENABLE" => "N",
								"SHOW_404" => "N",
								"MESSAGE_404" => ""
							),
							false
						);*/?>				
						<?$APPLICATION->IncludeComponent(
							"bitrix:news.list",
							"front-banners-big",
							array(
								"IBLOCK_TYPE" => "aspro_priority_advt",
								"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_priority_advt"]["aspro_priority_advtbig"][0],
								"NEWS_COUNT" => "30",
								"SORT_BY1" => "SORT",
								"SORT_ORDER1" => "ASC",
								"SORT_BY2" => "ID",
								"SORT_ORDER2" => "ASC",
								"FILTER_NAME" => "",
								"FIELD_CODE" => array(
									0 => "NAME",
									1 => "PREVIEW_TEXT",
									2 => "PREVIEW_PICTURE",
									3 => "DETAIL_PICTURE",
									4 => ""
								),
								"PROPERTY_CODE" => array(
									0 => "BANNERTYPE",
									1 => "TEXTCOLOR",
									2 => "LINKIMG",
									3 => "BUTTON1TEXT",
									4 => "BUTTON1LINK",
									4 => "BUTTON1CLASS",
									5 => "BUTTON2TEXT",
									6 => "BUTTON2LINK",
									7 => "BUTTON2CLASS",
									8 => "HEADER_COLOR",
									9 => "SECTION",
									10 => "TITLE_H1",
								),
								"CHECK_DATES" => "Y",
								"DETAIL_URL" => "",
								"AJAX_MODE" => "N",
								"AJAX_OPTION_JUMP" => "N",
								"AJAX_OPTION_STYLE" => "Y",
								"AJAX_OPTION_HISTORY" => "N",
								"CACHE_TYPE" => "A",
								"CACHE_TIME" => "3600000",
								"CACHE_FILTER" => "Y",
								"CACHE_GROUPS" => "N",
								"PREVIEW_TRUNCATE_LEN" => "",
								"ACTIVE_DATE_FORMAT" => "d.m.Y",
								"SET_TITLE" => "N",
								"SET_STATUS_404" => "N",
								"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
								"ADD_SECTIONS_CHAIN" => "N",
								"HIDE_LINK_WHEN_NO_DETAIL" => "N",
								"PARENT_SECTION" => "",
								"PARENT_SECTION_CODE" => "",
								"INCLUDE_SUBSECTIONS" => "N",
								"PAGER_TEMPLATE" => ".default",
								"DISPLAY_TOP_PAGER" => "N",
								"DISPLAY_BOTTOM_PAGER" => "N",
								"PAGER_TITLE" => "Новости",
								"PAGER_SHOW_ALWAYS" => "N",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600000",
								"PAGER_SHOW_ALL" => "N",
								"AJAX_OPTION_ADDITIONAL" => ""
							),
							false
						);?>
					</div>
				<?endif;?>
			<?endif;?>
			
			<?// TOP_FLOAT_BANNERS_INDEX?>
			<?if($optionCode == "TOP_FLOAT_BANNERS_INDEX"):?>
				<?global $bTopFloatBannersIndex;?>
				<?if($bTopFloatBannersIndex):?>
					<?CPriority::ShowPageType('index_component', 'float_banners', $optionCode, true);?>
				<?endif?>
			<?endif?>
						
			<?//TOP_SERVICES_INDEX?>
			<?if($optionCode == "TOP_SERVICES_INDEX"):?>
				<?global $bTopServicesIndex;?>
				
				<?if($bTopServicesIndex):?>
					<?CPriority::ShowPageType('index_component', 'services', $optionCode);?>
				<?endif;?>
			<?endif;?>

			<?//PORTFOLIO_INDEX?>
			<?if($optionCode == "PORTFOLIO_INDEX"):?>
				<?global $bPortfolioIndex;?>
				<?if($bPortfolioIndex):?>
					<div class="ajax_reload">
						<?CPriority::ShowPageType('index_component', 'projects', $optionCode);?>
					</div>
				<?endif;?>
			<?endif;?>
			
			<?//TOP_PRODUCTS_INDEX?>
			<?if($optionCode == "PRODUCTS_INDEX"):?>
				<?global $bProductsIndex;?>
				<?if($bProductsIndex):?>
					<?CPriority::ShowPageType('index_component', 'products', $optionCode);?>
				<?endif;?>
			<?endif;?>
			
			<?//CATALOG_INDEX?>
			<?if($optionCode == "CATALOG_INDEX"):?>
				<?global $bCatalogIndex;?>
				<?if($bCatalogIndex):?>
					<?CPriority::ShowPageType('index_component', 'tabs', $optionCode, true);?>
				<?endif;?>
			<?endif;?>

			<?// TOP_TARIFS_INDEX?>
			<?if($optionCode == "TOP_TARIFS_INDEX"):?>
				<?global $bTopTarifsIndex;?>
				<?if($bTopTarifsIndex):?>
					<div class="ajax_reload">				
						<?CPriority::ShowPageType('index_component', 'tarifs', $optionCode);?>
					</div>
				<?endif?>
			<?endif?>			
			
			<?//INSTAGRAMM_INDEX?>
			<?if($optionCode == "INSTAGRAMM_INDEX"):?>
				<?CPriority::ShowPageType('index_component', 'instagram', $optionCode);?>
			<?endif;?>
			
			<?//REVIEWS_INDEX?>
			<?if($optionCode == "REVIEWS_INDEX"):?>
				<?global $bReviewsIndex;?>
				<?if($bReviewsIndex):?>
					<?CPriority::ShowPageType('index_component', 'reviews', $optionCode);?>
				<?endif;?>
			<?endif;?>

			<?//COMPANY_INDEX?>
			<?if($optionCode == "COMPANY_INDEX"):?>
				<?global $bCompanyIndex;?>
				<?if($bCompanyIndex):?>
					<?CPriority::ShowPageType('index_component', 'company', $optionCode);?>
				<?endif;?>
			<?endif;?>
			
			<?//TEAM_INDEX?>
			<?if($optionCode == "TEAM_INDEX"):?>
				<?global $bTeamIndex;?>
				<?if($bTeamIndex):?>
					<?CPriority::ShowPageType('index_component', 'staff', $optionCode);?>
				<?endif;?>
			<?endif;?>
			
			<?//TIZERS_INDEX?>
			<?if($optionCode == "TEASERS_INDEX"):?>
				<?global $bTeasersIndex;?>
				<?if($bTeasersIndex):?>
					<?CPriority::ShowPageType('index_component', 'teasers', $optionCode);?>
				<?endif;?>
			<?endif;?>
	
			<?//NEWS_INDEX?>
			<?if($optionCode == "NEWS_INDEX"):?>
				<?global $bNewsIndex;?>
				<?if($bNewsIndex):?>
					<div class="ajax_reload">
						<?CPriority::ShowPageType('index_component', 'news', $optionCode);?>
					</div>
				<?endif;?>
			<?endif;?>
			
			<?//PARTNERS_INDEX?>
			<?if($optionCode == "PARTNERS_INDEX"):?>
				<?global $bPartnersIndex;?>
				<?if($bPartnersIndex):?>
					<?CPriority::ShowPageType('index_component', 'partners', $optionCode);?>
				<?endif;?>
			<?endif;?>
			<?//CONTACTS_INDEX?>
			<?if($optionCode == "CONTACTS_INDEX"):?>
				<?global $bContactsIndex;?>
				<?if($bContactsIndex):?>
					<?CPriority::ShowPageType('index_component', 'contacts', $optionCode);?>
				<?endif;?>
			<?endif;?>
			<?//CONSULT_INDEX?>
			<?if($optionCode == "CONSULT_INDEX"):?>
				<?global $bConsultIndex;?>
				<?if($bConsultIndex):?>
					<?CPriority::ShowPageType('index_component', 'info', $optionCode, true);?>
				<?endif;?>
			<?endif;?>
		</div>
	<?endforeach;?>
<?endif;?>