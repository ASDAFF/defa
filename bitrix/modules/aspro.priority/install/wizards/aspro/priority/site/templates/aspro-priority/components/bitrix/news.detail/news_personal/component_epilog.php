<?
use \Bitrix\Main\Localization\Loc;
Loc::loadMessages(__FILE__);
if(isset($templateData['SECTION_BNR_CONTENT']) && $templateData['SECTION_BNR_CONTENT'] == true)
{
	global $SECTION_BNR_CONTENT;
	$SECTION_BNR_CONTENT = true;
}
$bOrderViewBasket = $templateData["ORDER"];
?>

<div class="row">
	<div class="col-md-12">
		<div class="detail">
			<?//show docs block?>
			<?if($templateData['DOCUMENTS']):?>
				<div class="wraps">
					<h4><?=($arParams["T_DOCS"] ? $arParams["T_DOCS"] : Loc::getMessage("T_DOCS"));?></h4>
					<div class="docs-block">
						<div class="docs_wrap">
							<div class="row">
								<?foreach($templateData['DOCUMENTS'] as $docID):?>
									<?$arItem = CPriority::get_file_info($docID);?>
									<div class="col-md-4">
										<?
										$fileName = substr($arItem['ORIGINAL_NAME'], 0, strrpos($arItem['ORIGINAL_NAME'], '.'));
										$fileTitle = (strlen($arItem['DESCRIPTION']) ? $arItem['DESCRIPTION'] : $fileName);

										?>
										<div class="blocks clearfix <?=$arItem["TYPE"];?>">
											<div class="inner-wrapper">
												<a href="<?=$arItem['SRC']?>" class="dark-color text" target="_blank"><?=$fileTitle?></a>
												<div class="filesize font_xs"><?=CPriority::filesize_format($arItem['FILE_SIZE']);?></div>
											</div>
										</div>
									</div>
								<?endforeach;?>
							</div>
						</div>
					</div>
				</div>
			<?endif;?>

			<?//show projects block?>
			<?if($templateData['LINK_PROJECTS']):?>
				<div class="wraps">
					<h4><?=($arParams["T_PROJECTS"] ? $arParams["T_PROJECTS"] : Loc::getMessage("T_PROJECTS"));?></h4>
					<?$GLOBALS['arrProjectFilter'] = array('ID' => $templateData['LINK_PROJECTS']);?>
					<?$APPLICATION->IncludeComponent(
						"bitrix:news.list",
						"projects_linked_2",
						array(
							"IBLOCK_TYPE" => "aspro_priority_content",
							"IBLOCK_ID" => $arParams["PROJECTS_IBLOCK_ID"],
							"NEWS_COUNT" => "20",
							"SORT_BY1" => "SORT",
							"SORT_ORDER1" => "ASC",
							"SORT_BY2" => "ID",
							"SORT_ORDER2" => "DESC",
							"FILTER_NAME" => "arrProjectFilter",
							"FIELD_CODE" => array(
								0 => "NAME",
								1 => "PREVIEW_TEXT",
								2 => "PREVIEW_PICTURE",
								3 => "",
							),
							"PROPERTY_CODE" => array(
								0 => "LINK",
								1 => "TEXTCOLOR",
							),
							"CHECK_DATES" => "Y",
							"DETAIL_URL" => "",
							"AJAX_MODE" => "N",
							"AJAX_OPTION_JUMP" => "N",
							"AJAX_OPTION_STYLE" => "Y",
							"AJAX_OPTION_HISTORY" => "N",
							"CACHE_TYPE" => "A",
							"CACHE_TIME" => "36000000",
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
							"INCLUDE_SUBSECTIONS" => "Y",
							"PAGER_TEMPLATE" => ".default",
							"DISPLAY_TOP_PAGER" => "N",
							"DISPLAY_BOTTOM_PAGER" => "Y",
							"PAGER_TITLE" => "Новости",
							"PAGER_SHOW_ALWAYS" => "N",
							"PAGER_DESC_NUMBERING" => "N",
							"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
							"PAGER_SHOW_ALL" => "N",
							"VIEW_TYPE" => "list",
							"IMAGE_POSITION" => "left",
							"COUNT_IN_LINE" => "3",
							"SHOW_TITLE" => "Y",
							"T_PROJECTS" => ($arParams["T_PROJECTS"] ? $arParams["T_PROJECTS"] : Loc::getMessage("T_PROJECTS")),
							"AJAX_OPTION_ADDITIONAL" => ""
						),
						false, array("HIDE_ICONS" => "Y")
					);?>
				</div>
			<?endif;?>

			<?//show faq block?>
			<?if($templateData['LINK_FAQ']):?>
				<div class="wraps">
					<h4><?=($arParams["T_FAQ"] ? $arParams["T_FAQ"] : Loc::getMessage("T_FAQ"));?></h4>
					<?$GLOBALS['arrFaqFilter'] = array('ID' => $templateData['LINK_FAQ']);?>
					<?$APPLICATION->IncludeComponent(
						"bitrix:news.list",
						"items_list",
						array(
							"IBLOCK_TYPE" => "aspro_priority_content",
							"IBLOCK_ID" => $arParams["FAQ_IBLOCK_ID"],
							"NEWS_COUNT" => "20",
							"SORT_BY1" => "SORT",
							"SORT_ORDER1" => "ASC",
							"SORT_BY2" => "ID",
							"SORT_ORDER2" => "DESC",
							"FILTER_NAME" => "arrFaqFilter",
							"FIELD_CODE" => array(
								0 => "PREVIEW_TEXT",
								1 => "",
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
							"CACHE_TYPE" => "A",
							"CACHE_TIME" => "36000000",
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
							"INCLUDE_SUBSECTIONS" => "Y",
							"PAGER_TEMPLATE" => ".default",
							"DISPLAY_TOP_PAGER" => "N",
							"DISPLAY_BOTTOM_PAGER" => "Y",
							"PAGER_TITLE" => "Новости",
							"PAGER_SHOW_ALWAYS" => "N",
							"PAGER_DESC_NUMBERING" => "N",
							"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
							"PAGER_SHOW_ALL" => "N",
							"VIEW_TYPE" => "accordion",
							"IMAGE_POSITION" => "left",
							"SHOW_SECTION_PREVIEW_DESCRIPTION" => "Y",
							"COUNT_IN_LINE" => "3",
							"SHOW_TITLE" => "Y",
							"T_TITLE" => ($arParams["T_FAQ"] ? $arParams["T_FAQ"] : Loc::getMessage("T_FAQ")),
							"AJAX_OPTION_ADDITIONAL" => "",
							"SHOW_SECTION_NAME" => "N"
						),
						false, array("HIDE_ICONS" => "Y")
					);?>
				</div>
			<?endif;?>		
				<?if($templateData['LINK_SERVICES']):?>
					<div class="wraps">
						<h4><?=(strlen($arParams['T_SERVICES']) ? $arParams['T_SERVICES'] : Loc::getMessage('T_SERVICES'))?></h4>
						<?$GLOBALS['arrServicesFilter'] = array('ID' => $templateData['LINK_SERVICES']);?>
						<?$APPLICATION->IncludeComponent(
							"bitrix:news.list",
							$arParams["SERVICES_LINK_ELEMENTS_TEMPLATE"],
							array(
								"IBLOCK_TYPE" => "aspro_priority_content",
								"IBLOCK_ID" => $arParams["SERVICES_IBLOCK_ID"],
								"NEWS_COUNT" => "20",
								"SORT_BY1" => "SORT",
								"SORT_ORDER1" => "ASC",
								"SORT_BY2" => "ID",
								"SORT_ORDER2" => "DESC",
								"FILTER_NAME" => "arrServicesFilter",
								"FIELD_CODE" => array(
									0 => "PREVIEW_PICTURE",
									1 => "NAME",
									2 => "PREVIEW_TEXT",
								),
								"PROPERTY_CODE" => array(
									0 => "",
									1 => "",
								),
								"CHECK_DATES" => "Y",
								"DETAIL_URL" => "",
								"AJAX_MODE" => "N",
								"AJAX_OPTION_JUMP" => "N",
								"AJAX_OPTION_STYLE" => "Y",
								"AJAX_OPTION_HISTORY" => "N",
								"CACHE_TYPE" => "A",
								"CACHE_TIME" => "36000000",
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
								"INCLUDE_SUBSECTIONS" => "Y",
								"PAGER_TEMPLATE" => ".default",
								"DISPLAY_TOP_PAGER" => "N",
								"DISPLAY_BOTTOM_PAGER" => "Y",
								"PAGER_TITLE" => "Новости",
								"PAGER_SHOW_ALWAYS" => "N",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
								"PAGER_SHOW_ALL" => "N",
								"VIEW_TYPE" => "table",
								"BIG_BLOCK" => "Y",
								"IMAGE_POSITION" => "left",
								"COUNT_IN_LINE" => "2",
							),
							false, array("HIDE_ICONS" => "Y")
						);?>
					</div>
				<?endif;?>
			<?//show sale block?>
				<?if(count($templateData['LINK_SALE'])):?>
					<?$GLOBALS['arrSaleFilter'] = array('ID' => $templateData['LINK_SALE']); ?>
					<div class="wraps">
						<h4><?=(strlen($arParams['T_NEWS']) ? $arParams['T_NEWS'] : Loc::getMessage('T_NEWS'))?></h4>
						<div class="stockblock">
							<?$APPLICATION->IncludeComponent(
								"bitrix:news.list",
								"sales_linked",
								array(
									"IBLOCK_TYPE" => "aspro_priority_content",
									"IBLOCK_ID" => $arParams["NEWS_IBLOCK_ID"],
									"NEWS_COUNT" => "20",
									"SORT_BY1" => "SORT",
									"SORT_ORDER1" => "ASC",
									"SORT_BY2" => "ID",
									"SORT_ORDER2" => "DESC",
									"FILTER_NAME" => "arrSaleFilter",
									"FIELD_CODE" => array(
										0 => "NAME",
										1 => "PREVIEW_TEXT",
										3 => "DATE_ACTIVE_FROM",
										4 => "PREVIEW_PICTURE",
									),
									"PROPERTY_CODE" => array(
										0 => "PERIOD",
										1 => "REDIRECT",
										2 => "",
									),
									"CHECK_DATES" => "Y",
									"DETAIL_URL" => "",
									"AJAX_MODE" => "N",
									"AJAX_OPTION_JUMP" => "N",
									"AJAX_OPTION_STYLE" => "Y",
									"AJAX_OPTION_HISTORY" => "N",
									"CACHE_TYPE" => "A",
									"CACHE_TIME" => "36000000",
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
									"INCLUDE_SUBSECTIONS" => "Y",
									"PAGER_TEMPLATE" => ".default",
									"DISPLAY_TOP_PAGER" => "N",
									"DISPLAY_BOTTOM_PAGER" => "Y",
									"PAGER_TITLE" => "Новости",
									"PAGER_SHOW_ALWAYS" => "N",
									"PAGER_DESC_NUMBERING" => "N",
									"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
									"PAGER_SHOW_ALL" => "N",
									"VIEW_TYPE" => "table",
									"BIG_BLOCK" => "Y",
									"IMAGE_POSITION" => "left",
									"COUNT_IN_LINE" => "2",
								),
								false, array("HIDE_ICONS" => "Y")
							);?>
						</div>
					</div>
				<?endif;?>
				
			<?//show goods block?>
				<?if($templateData['LINK_GOODS']):?>
					<div class="wraps goods-block">
						<h4><?=(strlen($arParams['T_ITEMS']) ? $arParams['T_ITEMS'] : Loc::getMessage('T_ITEMS'))?></h4>
						<?$GLOBALS['arrGoodsFilter'] = array('ID' => $templateData['LINK_GOODS']);?>
						<?$APPLICATION->IncludeComponent(
							"bitrix:news.list",
							$templateData['CATALOG_LINKED_TEMPLATE'],
							Array(
								"S_ORDER_PRODUCT" => $arParams["S_ORDER_SERVISE"],
								"IBLOCK_TYPE" => "aspro_priority_catalog",
								"IBLOCK_ID" => $arParams["CATALOG_IBLOCK_ID"],
								"NEWS_COUNT" => "20",
								"SORT_BY1" => "SORT",
								"SORT_ORDER1" => "ASC",
								"SORT_BY2" => "ID",
								"SORT_ORDER2" => "DESC",
								"FILTER_NAME" => "arrGoodsFilter",
								"FIELD_CODE" => array(
									0 => "NAME",
									1 => "PREVIEW_TEXT",
									2 => "PREVIEW_PICTURE",
									3 => "DETAIL_PICTURE",
									4 => "",
								),
								"PROPERTY_CODE" => array(
									0 => "PRICE",
									1 => "PRICEOLD",
									2 => "STATUS",
									3 => "ARTICLE",
									6 => "CATEGORY",
									7 => "RECOMMEND",
									10 => "DELIVERY",
									21 => "SUPPLIED",
									23 => "LANGUAGES",
									24 => "DURATION",
									25 => "UPDATES",
									26 => "RANGE_MEASURE",
									27 => "WORK_TEMP",
									28 => "NUM_CHANNELS",
									29 => "DIMENSIONS",
									30 => "MASS",
									31 => "MAX_SPEED",
									32 => "MODEL_ENGINE",
									33 => "VOLUME_ENGINE",
									34 => "SEATS",
									35 => "COUNTRY",
									36 => "WORK_PRESSURE",
									37 => "BENDING_ANGLE",
									38 => "ENGINE_POWER",
									39 => "WORK_SPEED",
									40 => "GUARANTEE",
									41 => "COMMUNIC_PORT",
									42 => "INNER_MEMORY",
									43 => "PRESS_POWER",
									44 => "MAXIMUM_PRESSURE",
									45 => "MAX_SIZE_ZAG",
									46 => "BENDING_SIZE",
									47 => "MAX_MASS_ZAG",
									48 => "POWER_LS",
									49 => "V_DVIGATELJA",
									50 => "RAZGON",
									51 => "BRAND",
									52 => "PROIZVODITEKNOST",
									53 => "MAX_POWER_LS",
									54 => "LINK_SERTIFICATES",
									55 => "MAX_POWER",
									56 => "AGE",
									57 => "KARTOPR",
									58 => "DEPTH",
									59 => "GRUZ",
									60 => "GRUZ_STRELI",
									61 => "DLINA_STRELI",
									62 => "DLINA",
									63 => "CLASS",
									64 => "KOL_FORMULA",
									65 => "MARK_STEEL",
									66 => "MODEL",
									67 => "POWER",
									68 => "VOLUME",
									69 => "PROIZVODSTVO",
									70 => "SIZE",
									71 => "SPEED",
									72 => "TYPE_TUR",
									73 => "THICKNESS",
									74 => "MARK",
									75 => "FREQUENCY",
									76 => "WIDTH_PROHOD",
									77 => "WIDTH_PROEZD",
									78 => "WIDTH",
									79 => "PLACE_CLOUD",
									80 => "TYPE",
									81 => "COLOR",
									82 => "",
									83 => "",
								),
								"CHECK_DATES" => "Y",
								"DETAIL_URL" => "",
								"PREVIEW_TRUNCATE_LEN" => "",
								"ACTIVE_DATE_FORMAT" => "d.m.Y",
								"SET_TITLE" => "N",
								"SET_STATUS_404" => "N",
								"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
								"ADD_SECTIONS_CHAIN" => "N",
								"HIDE_LINK_WHEN_NO_DETAIL" => "N",
								"PARENT_SECTION" => "",
								"PARENT_SECTION_CODE" => "",
								"INCLUDE_SUBSECTIONS" => "Y",
								"CACHE_TYPE" => "A",
								"CACHE_TIME" => "36000000",
								"CACHE_FILTER" => "Y",
								"CACHE_GROUPS" => "N",
								"PAGER_TEMPLATE" => ".default",
								"DISPLAY_TOP_PAGER" => "N",
								"DISPLAY_BOTTOM_PAGER" => "Y",
								"PAGER_TITLE" => "Новости",
								"PAGER_SHOW_ALWAYS" => "N",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
								"PAGER_SHOW_ALL" => "N",
								"AJAX_MODE" => "N",
								"AJAX_OPTION_JUMP" => "N",
								"AJAX_OPTION_STYLE" => "Y",
								"AJAX_OPTION_HISTORY" => "N",
								"SHOW_DETAIL_LINK" => "Y",
								"COUNT_IN_LINE" => "3",
								"IMAGE_POSITION" => "left",
								"ORDER_VIEW" => $bOrderViewBasket,
							),
						false, array("HIDE_ICONS" => "Y")
						);?>
					</div>
				<?endif;?>
			<?// show partners block?>
				<?if($templateData['LINK_PARTNERS']):?>
					<div class="wraps goods-block">
						<h4><?=(strlen($arParams['T_PARTNERS']) ? $arParams['T_PARTNERS'] : Loc::getMessage('T_PARTNERS'))?></h4>
						<?$GLOBALS['arrPartnersFilter'] = array('ID' => $templateData['LINK_PARTNERS']);?>
						<?$APPLICATION->IncludeComponent(
							"bitrix:news.list",
							"partners_linked",
							array(
								"IBLOCK_TYPE" => "aspro_priority_content",
								"IBLOCK_ID" => $arParams["PARTNERS_IBLOCK_ID"],
								"NEWS_COUNT" => "20",
								"SORT_BY1" => "SORT",
								"SORT_ORDER1" => "ASC",
								"SORT_BY2" => "ID",
								"SORT_ORDER2" => "DESC",
								"FILTER_NAME" => "arrPartnersFilter",
								"FIELD_CODE" => array(
									0 => "PREVIEW_PICTURE",
									1 => "NAME",
									2 => "PREVIEW_TEXT",
								),
								"PROPERTY_CODE" => array(
									0 => "SITE",
									1 => "PHONE",
								),
								"CHECK_DATES" => "Y",
								"DETAIL_URL" => "",
								"AJAX_MODE" => "N",
								"AJAX_OPTION_JUMP" => "N",
								"AJAX_OPTION_STYLE" => "Y",
								"AJAX_OPTION_HISTORY" => "N",
								"CACHE_TYPE" => "A",
								"CACHE_TIME" => "36000000",
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
								"INCLUDE_SUBSECTIONS" => "Y",
								"PAGER_TEMPLATE" => ".default",
								"DISPLAY_TOP_PAGER" => "N",
								"DISPLAY_BOTTOM_PAGER" => "Y",
								"PAGER_TITLE" => "Новости",
								"PAGER_SHOW_ALWAYS" => "N",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
								"PAGER_SHOW_ALL" => "N",
								"VIEW_TYPE" => "table",
								"BIG_BLOCK" => "Y",
								"IMAGE_POSITION" => "left",
								"COUNT_IN_LINE" => "2",
							),
							false, array("HIDE_ICONS" => "Y")
						);?>
					</div>
				<?endif;?>
			<?// show reviews block?>
				<?if($templateData['LINK_REVIEWS']):?>
					<div class="wraps goods-block">
						<h4><?=(strlen($arParams['T_REVIEWS']) ? $arParams['T_REVIEWS'] : Loc::getMessage('T_REVIEWS'))?></h4>
						<?$GLOBALS['arrReviewsFilter'] = array('ID' => $templateData['LINK_REVIEWS']);?>
						<?$APPLICATION->IncludeComponent(
							"bitrix:news.list",
							"reviews_linked",
							array(
								"IBLOCK_TYPE" => "aspro_priority_content",
								"IBLOCK_ID" => $arParams["REVIEWS_IBLOCK_ID"],
								"NEWS_COUNT" => "20",
								"SORT_BY1" => "SORT",
								"SORT_ORDER1" => "ASC",
								"SORT_BY2" => "ID",
								"SORT_ORDER2" => "DESC",
								"FILTER_NAME" => "arrReviewsFilter",
								"FIELD_CODE" => array(
									0 => "PREVIEW_PICTURE",
									1 => "NAME",
									2 => "PREVIEW_TEXT",
									3 => "DETAIL_PICTURE",
								),
								"PROPERTY_CODE" => array(
									0 => "NAME",
									1 => "POST",
									2 => "RATING",
									3 => "MESSAGE",
								),
								"CHECK_DATES" => "Y",
								"DETAIL_URL" => "",
								"AJAX_MODE" => "N",
								"AJAX_OPTION_JUMP" => "N",
								"AJAX_OPTION_STYLE" => "Y",
								"AJAX_OPTION_HISTORY" => "N",
								"CACHE_TYPE" => "A",
								"CACHE_TIME" => "36000000",
								"CACHE_FILTER" => "Y",
								"CACHE_GROUPS" => "N",
								"PREVIEW_TRUNCATE_LEN" => "300",
								"ACTIVE_DATE_FORMAT" => "d.m.Y",
								"SET_TITLE" => "N",
								"SET_STATUS_404" => "N",
								"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
								"ADD_SECTIONS_CHAIN" => "N",
								"HIDE_LINK_WHEN_NO_DETAIL" => "Y",
								"PARENT_SECTION" => "",
								"PARENT_SECTION_CODE" => "",
								"INCLUDE_SUBSECTIONS" => "Y",
								"PAGER_TEMPLATE" => ".default",
								"DISPLAY_TOP_PAGER" => "N",
								"DISPLAY_BOTTOM_PAGER" => "Y",
								"PAGER_TITLE" => "Новости",
								"PAGER_SHOW_ALWAYS" => "N",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
								"PAGER_SHOW_ALL" => "N",
								"VIEW_TYPE" => "table",
								"BIG_BLOCK" => "Y",
								"IMAGE_POSITION" => "left",
								"COUNT_IN_LINE" => "2",
							),
							false, array("HIDE_ICONS" => "Y")
						);?>
					</div>
				<?endif;?>
			<?// show staff block?>
				<?if($templateData['LINK_STAFF']):?>
					<div class="wraps goods-block">
						<h4><?=(strlen($arParams['T_STAFF']) ? $arParams['T_STAFF'] : Loc::getMessage('T_STAFF'))?></h4>
						<?$GLOBALS['arrStaffFilter'] = array('ID' => $templateData['LINK_STAFF']);?>
						<?$APPLICATION->IncludeComponent(
							"bitrix:news.list",
							"staff_linked",
							array(
								"IBLOCK_TYPE" => "aspro_priority_content",
								"IBLOCK_ID" => $arParams["STAFF_IBLOCK_ID"],
								"NEWS_COUNT" => "20",
								"SORT_BY1" => "SORT",
								"SORT_ORDER1" => "ASC",
								"SORT_BY2" => "ID",
								"SORT_ORDER2" => "DESC",
								"FILTER_NAME" => "arrStaffFilter",
								"FIELD_CODE" => array(
									0 => "PREVIEW_PICTURE",
									1 => "NAME",
									2 => "",
								),
								"PROPERTY_CODE" => array(
									0 => "POST",
									1 => "PHONE",
									2 => "EMAIL",
									3 => "SEND_MESSAGE_BUTTON",
								),
								"CHECK_DATES" => "Y",
								"DETAIL_URL" => "",
								"AJAX_MODE" => "N",
								"AJAX_OPTION_JUMP" => "N",
								"AJAX_OPTION_STYLE" => "Y",
								"AJAX_OPTION_HISTORY" => "N",
								"CACHE_TYPE" => "A",
								"CACHE_TIME" => "36000000",
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
								"INCLUDE_SUBSECTIONS" => "Y",
								"PAGER_TEMPLATE" => ".default",
								"DISPLAY_TOP_PAGER" => "N",
								"DISPLAY_BOTTOM_PAGER" => "Y",
								"PAGER_TITLE" => "Новости",
								"PAGER_SHOW_ALWAYS" => "N",
								"PAGER_DESC_NUMBERING" => "N",
								"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
								"PAGER_SHOW_ALL" => "N",
								"VIEW_TYPE" => "table",
								"BIG_BLOCK" => "Y",
								"IMAGE_POSITION" => "left",
								"COUNT_IN_LINE" => "2",
							),
							false, array("HIDE_ICONS" => "Y")
						);?>
					</div>
				<?endif;?>
			<?// show vacancys block?>
			<?if($templateData['LINK_VACANCYS']):?>
				<div class="wraps goods-block">
					<h4><?=(strlen($arParams['T_VACANCYS']) ? $arParams['T_VACANCYS'] : Loc::getMessage('T_VACANCYS'))?></h4>
					<?$GLOBALS['arrVacancysFilter'] = array('ID' => $templateData['LINK_VACANCYS']);?>
					<?$APPLICATION->IncludeComponent(
						"bitrix:news.list",
						"vacancy_linked",
						array(
							"IBLOCK_TYPE" => "aspro_priority_content",
							"IBLOCK_ID" => $arParams["VACANCYS_IBLOCK_ID"],
							"NEWS_COUNT" => "20",
							"SORT_BY1" => "SORT",
							"SORT_ORDER1" => "ASC",
							"SORT_BY2" => "ID",
							"SORT_ORDER2" => "DESC",
							"FILTER_NAME" => "arrVacancysFilter",
							"FIELD_CODE" => array(
								0 => "PREVIEW_PICTURE",
								1 => "NAME",
								2 => "PREVIEW_TEXT",
							),
							"PROPERTY_CODE" => array(
								0 => "CITY",
								1 => "PAY",
								2 => "QUALITY",
								3 => "WORK_TYPE",
							),
							"CHECK_DATES" => "Y",
							"DETAIL_URL" => "",
							"AJAX_MODE" => "N",
							"AJAX_OPTION_JUMP" => "N",
							"AJAX_OPTION_STYLE" => "Y",
							"AJAX_OPTION_HISTORY" => "N",
							"CACHE_TYPE" => "A",
							"CACHE_TIME" => "36000000",
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
							"INCLUDE_SUBSECTIONS" => "Y",
							"PAGER_TEMPLATE" => ".default",
							"DISPLAY_TOP_PAGER" => "N",
							"DISPLAY_BOTTOM_PAGER" => "Y",
							"PAGER_TITLE" => "Новости",
							"PAGER_SHOW_ALWAYS" => "N",
							"PAGER_DESC_NUMBERING" => "N",
							"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
							"PAGER_SHOW_ALL" => "N",
							"VIEW_TYPE" => "table",
							"BIG_BLOCK" => "Y",
							"IMAGE_POSITION" => "left",
							"COUNT_IN_LINE" => "2",
						),
						false, array("HIDE_ICONS" => "Y")
					);?>
				</div>
			<?endif;?>

			<?//show comments block?>
			<?if($arParams["DETAIL_USE_COMMENTS"] == "Y"):?>
				<?$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/rating_likes.js");?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:catalog.comments",
					"main",
					array(
						'CACHE_TYPE' => $arParams['CACHE_TYPE'],
						'CACHE_TIME' => $arParams['CACHE_TIME'],
						'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
						"COMMENTS_COUNT" => $arParams['COMMENTS_COUNT'],
						"ELEMENT_CODE" => "",
						"ELEMENT_ID" => $arResult["ID"],
						"FB_USE" => $arParams["FB_USE"],
						"IBLOCK_ID" => $arParams["IBLOCK_ID"],
						"IBLOCK_TYPE" => "aspro_priority_content",
						"SHOW_DEACTIVATED" => "N",
						"TEMPLATE_THEME" => "blue",
						"URL_TO_COMMENT" => "",
						"VK_USE" => $arParams["VK_USE"],
						"AJAX_POST" => "Y",
						"WIDTH" => "",
						"COMPONENT_TEMPLATE" => ".default",
						"BLOG_USE" => $arParams["BLOG_USE"],
						"BLOG_TITLE" => $arParams["BLOG_TITLE"],
						"BLOG_URL" => $arParams["BLOG_URL"],
						"PATH_TO_SMILE" => '',
						"EMAIL_NOTIFY" => $arParams["BLOG_EMAIL_NOTIFY"],
						"SHOW_SPAM" => "Y",
						"SHOW_RATING" => "Y",
						"RATING_TYPE" => "like_graphic",
						"FB_TITLE" => $arParams["FB_TITLE"],
						"FB_USER_ADMIN_ID" => "",
						"FB_APP_ID" => $arParams["FB_APP_ID"],
						"FB_COLORSCHEME" => "light",
						"FB_ORDER_BY" => "reverse_time",
						"VK_TITLE" => $arParams["VK_TITLE"],
						"VK_API_ID" => $arParams["VK_API_ID"]
					),
					false, array("HIDE_ICONS" => "Y")
				);?>
			<?endif;?>
		</div>
	</div>
</div>