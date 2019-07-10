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
<?$arOrder = explode(",", $arParams["LIST_PRODUCT_BLOCKS_ORDER"]);?>
<?$arTabOrder = explode(",", $arParams["LIST_PRODUCT_BLOCKS_TAB_ORDER"]);?>
<?$bShowFormQuestion = ($templateData['FORM_QUESTION'] == 'YES');?>

<?foreach($arOrder as $value):?>
	<div class="drag_block <?=$value;?>">
		<?//show tab block?>
		<?if($value == "tab"):?>
			<?
			$i = 0;
			$bShowDetailTextTab = (strlen($templateData['DETAIL_TEXT']) ? ++$i : '');
			$bShowTarifTab = (!empty($templateData['LINK_TARIFS']) ? ++$i : '');
			$bShowPropsTab = (!empty($templateData['CHARACTERISTICS']) ? ++$i : '');
			$bShowDocsTab = (!empty($templateData['DOCUMENTS']) ? ++$i : '');
			$bShowVideoTab = (!empty($templateData['VIDEO']) || !empty($templateData['VIDEO_IFRAME']) ? ++$i : '');
			$bShowFaqTab = (!empty($templateData['LINK_FAQ']) ? ++$i : '');
			$bShowProjecTab = (!empty($templateData['LINK_PROJECTS']) ? ++$i : '');

			if($bShowTarifTab || $bShowDetailTextTab || $bShowPropsTab || $bShowDocsTab || $bShowVideoTab || $bShowFaqTab || $bShowProjecTab):?>
				<div class="tabs">
					<?if($i > 1):?>
						<ul class="nav nav-tabs font_upper_md">
							<?$iTab = 0;?>
							<?foreach($arTabOrder as $value):?>
								<?//show desc block?>
								<?if($value == "desc"):?>
									<?if($bShowDetailTextTab):?>
										<li class="shadow border <?=(!($iTab++) ? 'active' : '')?>"><a href="#desc" data-toggle="tab"><?=($arParams["T_DESC"] ? $arParams["T_DESC"] : Loc::getMessage("T_DESC"));?></a></li>
									<?endif;?>
								<?endif;?>
								<?//show char block?>
								<?if($value == "char"):?>
									<?if($bShowPropsTab):?>
										<li class="shadow border <?=(!($iTab++) ? 'active' : '')?>"><a href="#props" data-toggle="tab"><?=($arParams["T_CHARACTERISTICS"] ? $arParams["T_CHARACTERISTICS"] : Loc::getMessage("T_CHARACTERISTICS"));?></a></li>
									<?endif;?>
								<?endif;?>
								<?//show tarifs block?>
								<?if($value == "tarifs"):?>
									<?if($bShowTarifTab):?>
										<li class="shadow border <?=(!($iTab++) ? 'active' : '')?>"><a href="#tarifs" data-toggle="tab"><?=($arParams["T_TARIF"] ? $arParams["T_TARIF"] : Loc::getMessage("T_TARIF"));?></a></li>
									<?endif;?>
								<?endif;?>

								<?//show projects block?>
								<?if($value == "projects"):?>
									<?if($bShowProjecTab):?>
										<li class="shadow border <?=(!($iTab++) ? 'active' : '')?>"><a href="#projects" class="projects-link" data-toggle="tab"><?=($arParams["T_PROJECTS"] ? $arParams["T_PROJECTS"] : Loc::getMessage("T_PROJECTS"));?></a></li>
									<?endif;?>
								<?endif;?>
								<?//show docs block?>
								<?if($value == "docs"):?>
									<?if($bShowDocsTab):?>
										<li class="shadow border <?=(!($iTab++) ? 'active' : '')?>"><a href="#docs" data-toggle="tab"><?=($arParams["T_DOCS"] ? $arParams["T_DOCS"] : Loc::getMessage("T_DOCS"));?></a></li>
									<?endif;?>
								<?endif;?>
								<?//show faq block?>
								<?if($value == "faq"):?>
									<?if($bShowFaqTab):?>
										<li class="shadow border <?=(!($iTab++) ? 'active' : '')?>"><a href="#faq" data-toggle="tab"><?=($arParams["T_FAQ"] ? $arParams["T_FAQ"] : Loc::getMessage("T_FAQ"));?></a></li>
									<?endif;?>
								<?endif;?>
								<?//show video block?>
								<?if($value == "video"):?>
									<?if($bShowVideoTab):?>
										<li class="shadow border <?=(!($iTab++) ? 'active' : '')?>"><a href="#video" data-toggle="tab"><?=($arParams["T_VIDEO"] ? $arParams["T_VIDEO"] : Loc::getMessage("T_VIDEO"));?></a></li>
									<?endif;?>
								<?endif;?>
							<?endforeach;?>
						</ul>
					<?endif;?>
					<div class="tab-content<?=($i <= 1 ? ' not_tabs' : '')?>">
						<?$iTab = 0;?>
						<?foreach($arTabOrder as $value):?>
							<?//show desc block?>
							<?if($value == "desc"):?>
								<?if($bShowDetailTextTab):?>
									<div class="tab-pane <?=(!($iTab++) ? 'active' : '')?>" id="desc">
										<div class="title-tab-heading border shadow visible-xs"><?=($arParams["T_DESC"] ? $arParams["T_DESC"] : Loc::getMessage("T_DESC"));?><span class="arrow_open"></span></div>
										<div class="content" itemprop="description">
											<?if($templateData['PREVIEW_TEXT'] || $templateData['DETAIL_TEXT']):?>
												<div class="content" itemprop="description">
													<?if(!$templateData['SECTION_BNR_CONTENT'] && strlen($templateData['PREVIEW_TEXT'])):?>
														<div class="introtext"><?=$templateData['PREVIEW_TEXT'];?></div>
													<?endif;?>

													<?// element detail text?>
													<?if(strlen($templateData['DETAIL_TEXT'])):?>
														<?=$templateData['DETAIL_TEXT'];?>
													<?endif;?>
												</div>
											<?endif;?>
										</div>
									</div>
								<?endif;?>
							<?endif;?>
							<?//show projects block?>
							<?if($value == "projects"):?>
								<?if($bShowProjecTab):?>
									<div class="tab-pane <?=(!($iTab++) ? 'active' : '')?>" id="projects">
										<div class="title-tab-heading border shadow visible-xs"><?=($arParams["T_PROJECTS"] ? $arParams["T_PROJECTS"] : Loc::getMessage("T_PROJECTS"));?><span class="arrow_open"></span></div>
										<?$GLOBALS['arrProjectFilter'] = array('ID' => $templateData['LINK_PROJECTS']);?>
										<?$APPLICATION->IncludeComponent(
											"bitrix:news.list",
											"projects_linked",
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
												"PAGER_TITLE" => "�������",
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
							<?endif;?>
							<?//show tarifs block?>
							<?if($value == "tarifs"):?>
								<?if($bShowTarifTab):?>
									<div class="tab-pane <?=(!($iTab++) ? 'active' : '')?>" id="tarifs">
										<div class="title-tab-heading border shadow visible-xs"><?=($arParams["T_TARIF"] ? $arParams["T_TARIF"] : Loc::getMessage("T_TARIF"));?><span class="arrow_open"></span></div>
										<?$GLOBALS['arrTarifsFilter'] = array('ID' => $templateData['LINK_TARIFS']);?>
										<?include_once(str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'])."/include/comp_tarifs_services.php");?>
									</div>
								<?endif;?>
							<?endif;?>
							<?//show char block?>
							<?if($value == "char"):?>
								<?if($bShowPropsTab):?>
									<div class="tab-pane chars <?=(!($iTab++) ? 'active' : '')?>" id="props">
										<div class="title-tab-heading border shadow visible-xs"><?=($arParams["T_CHARACTERISTICS"] ? $arParams["T_CHARACTERISTICS"] : Loc::getMessage("T_CHARACTERISTICS"));?><span class="arrow_open"></span></div>
										<div class="char-wrapp">
											<table class="props_table">
												<?foreach($templateData['CHARACTERISTICS'] as $arProp):?>
													<tr class="char">
														<td class="char_name<?=($arProp['HINT'] ? ' whint' : '')?>">
															<span>
																<?=$arProp['NAME']?>
																<?if($arProp['HINT']):?>
																	<span class="hint">
																		<span class="icons" data-toggle="tooltip" data-placement="top" title="<?=$arProp['HINT']?>"></span>
																	</span>
																<?endif;?>
															</span>
														</td>
														<td class="char_value">
															<span>
																<?if(is_array($arProp['DISPLAY_VALUE'])):?>
																	<?foreach($arProp['DISPLAY_VALUE'] as $key => $value):?>
																		<?if($arProp['DISPLAY_VALUE'][$key + 1]):?>
																			<?=$value.'&nbsp;/ '?>
																		<?else:?>
																			<?=$value?>
																		<?endif;?>
																	<?endforeach;?>
																<?else:?>
																	<?=$arProp['DISPLAY_VALUE']?>
																<?endif;?>
															</span>
														</td>
													</tr>
												<?endforeach;?>
											</table>
										</div>
									</div>
								<?endif;?>
							<?endif;?>
							<?//show docs block?>
							<?if($value == "docs"):?>
								<?if($bShowDocsTab):?>
									<div class="tab-pane docs-block <?=(!($iTab++) ? 'active' : '')?>" id="docs">
										<div class="title-tab-heading border shadow visible-xs"><?=($arParams["T_DOCS"] ? $arParams["T_DOCS"] : Loc::getMessage("T_DOCS"));?><span class="arrow_open"></span></div>
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
								<?endif;?>
							<?endif;?>
							<?//show faq block?>
							<?if($value == "faq"):?>
								<?if($bShowFaqTab):?>
									<div class="tab-pane <?=(!($iTab++) ? 'active' : '')?>" id="faq">
										<div class="title-tab-heading border shadow visible-xs"><?=($arParams["T_FAQ"] ? $arParams["T_FAQ"] : Loc::getMessage("T_FAQ"));?><span class="arrow_open"></span></div>
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
												"PAGER_TITLE" => "�������",
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
							<?endif;?>
							<?//show video block?>
							<?if($value == "video"):?>
								<?if($bShowVideoTab):?>
									<div class="tab-pane <?=(!($iTab++) ? 'active' : '')?>" id="video">
										<div class="title-tab-heading border shadow visible-xs"><?=($arParams["T_VIDEO"] ? $arParams["T_VIDEO"] : Loc::getMessage("T_VIDEO"));?><span class="arrow_open"></span></div>
										<div class="video">
											<?
											if($templateData['VIDEO'] && $templateData['VIDEO_IFRAME'])
												$count = 2;
											elseif($templateData['VIDEO'])
												$count = count($templateData['VIDEO']);
											elseif($templateData['VIDEO_IFRAME'])
												$count = count($templateData['VIDEO_IFRAME']);
											?>
											<?if($templateData['VIDEO']):?>
												<?foreach($templateData['VIDEO'] as $i => $arVideo):?>
													<div class="item">
														<div class="video_body">
															<video id="js-video_<?=$i?>" width="350" height="217"  class="video-js" controls="controls" preload="metadata" data-setup="{}">
																<source src="<?=$arVideo["path"]?>" type='video/mp4' />
																<p class="vjs-no-js">
																	To view this video please enable JavaScript, and consider upgrading to a web browser that supports HTML5 video
																</p>
															</video>
														</div>
														<div class="title"><?=(strlen($arVideo["title"]) ? $arVideo["title"] : '')?></div>
													</div>
												<?endforeach;?>
											<?endif;?>
											<?if($templateData['VIDEO_IFRAME']):?>
												<?foreach($templateData['VIDEO_IFRAME'] as $i => $video):?>
													<div class="item">
														<div class="video_body">
															<?if(strpos($video, '<iframe') !== false):?>
																<?=$video;?>
															<?else:?>
																<?
																$video = str_replace('watch?v=', 'embed/', $video);
																$video = str_replace('youtu.be/', 'youtube.com/embed/', $video)
																?>
																<iframe width="560" height="315" src="<?=$video;?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
															<?endif;?>
															<?//=str_replace('src=', 'width="350" height="217" src=', str_replace(array('width', 'height'), array('data-width', 'data-height'), $video));?>
														</div>
														<div class="title"></div>
													</div>
												<?endforeach;?>
											<?endif;?>
										</div>
									</div>
								<?endif;?>
							<?endif;?>
						<?endforeach;?>
					</div>
				</div>
			<?endif;?>
		<?endif;?>
		<?// order block?>
		<?if($value == 'order' && ($templateData['FORM_ORDER'] == 'YES' || $bShowFormQuestion)):?>
			<?
			$bPrice = ($templateData['PRICE'] || $templateData['PRICE_OLD'] ? true : false);
			?>
			<div class="drag_block <?=$value;?>">
				<table class="order-block">
					<tr>
						<td class="text_wrap col-md-<?=($bPrice ? 6 : 9);?> col-sm-8 col-xs-7 valign">
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
						<td class="col-md-<?=($bPrice ? 6 : 3);?> col-sm-4 col-xs-5 valign">
							<?if($bPrice):?>
								<div class="prices media">
									<?if($templateData['PRICE']):?>
										<span class="price"><?=$templateData['PRICE'];?></span>
									<?endif;?>
									<?if($templateData['PRICE_OLD']):?>
										<span class="price old"><?=$templateData['PRICE_OLD'];?></span>
									<?endif;?>
								</div>
							<?endif;?>
							<div class="btns<?=($bPrice ? ' pull-right' : '');?>">
								<?if($templateData['FORM_ORDER'] == 'YES'):?>
									<span><span class="btn btn-default btn-lg animate-load order" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_order_services")?>" data-name="order_services" data-autoload-service="<?=CPriority::formatJsName($arResult['NAME']);?>" data-autoload-project="<?=CPriority::formatJsName($arResult['NAME']);?>"><span><?=(strlen($arParams['S_ORDER_SERVISE']) ? $arParams['S_ORDER_SERVISE'] : Loc::getMessage('S_ORDER_SERVISE'))?></span></span>
								<?endif;?>
								<?if($bShowFormQuestion):?>
									<span><span class="btn btn-default btn-lg btn-transparent animate-load question" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_question")?>" data-name="question" data-autoload-service="<?=CPriority::formatJsName($arResult['NAME']);?>" data-autoload-need_product="<?=CPriority::formatJsName($arResult['NAME']);?>">
										<svg id="qmark.svg" xmlns="http://www.w3.org/2000/svg" width="7" height="13.031" viewBox="0 0 7 13.031">
											<path id="_copy" data-name="? copy" class="cls-1" d="M701.006,188.223c0,2.755-3.462,2.647-3.462,5.312a1.223,1.223,0,0,0,.027.43l0.909,0a1.088,1.088,0,0,1-.072-0.282c0-2.449,3.589-2.305,3.589-5.654,0-1.656-1.244-3.061-3.494-3.061a4.167,4.167,0,0,0-3.491,1.8l0.716,0.594a3.156,3.156,0,0,1,2.7-1.389A2.324,2.324,0,0,1,701.006,188.223Zm-4,8.722a1,1,0,1,0,1.99,0A1,1,0,0,0,697.007,196.945Z" transform="translate(-695 -184.969)"/>
										</svg>
									</span></span>
								<?endif;?>
							</div>
							<?if($bPrice):?>
								<div class="prices pull-right">
									<?if($templateData['PRICE']):?>
										<span class="price"><?=$templateData['PRICE'];?></span>
									<?endif;?>
									<?if($templateData['PRICE_OLD']):?>
										<span class="price old"><?=$templateData['PRICE_OLD'];?></span>
									<?endif;?>
								</div>
							<?endif;?>
						</td>
					</tr>
				</table>
			</div>
		<?endif;?>
		<?//show gallery block?>
		<?if($value == "gallery"):?>
			<?if(count($templateData['GALLERY_BIG'])):?>
				<?
				$bShowSmallGallery = $templateData['GALLERY_TYPE'] === 'small';
				?>
				<div class="wraps galerys-block">
					<span class="switch_gallery<?=($bShowSmallGallery ? ' small' : '');?>"></span>
					<div class="title small-gallery font_xs"<?=($bShowSmallGallery ? ' style="display:block;"' : '');?>><?=count($templateData['GALLERY_BIG']).'&nbsp;'.Loc::getMessage('T_GALLERY_TITLE')?></div>
					<div class="title big-gallery font_xs"<?=($bShowSmallGallery ? ' style="display:none;"' : '');?>><span class="slide-number">1</span> / <?=count($templateData['GALLERY_BIG'])?></div>
					<div class="big-gallery-block thmb1 flexslider unstyled row bigs wsmooth"<?=($bShowSmallGallery ? ' style="display:none;"' : '');?> id="slider" data-plugin-options='{"animation": "slide", "directionNav": true, "controlNav" :false, "animationLoop": true, "slideshow": false, "sync": ".gallery-wrapper .small-gallery", "counts": [1, 1, 1], "smoothHeight": true}'>
						<ul class="slides items">
							<?foreach($templateData['GALLERY_BIG'] as $i => $arPhoto):?>
								<li class="col-md-12 item">
									<img src="<?=$arPhoto['PREVIEW']['src']?>" class="img-responsive inline" title="<?=$arPhoto['TITLE']?>" alt="<?=$arPhoto['ALT']?>" />
									<a href="<?=$arPhoto['DETAIL']['SRC']?>" class="fancybox" rel="gallery" target="_blank" title="<?=$arPhoto['TITLE']?>">
										<span class="zoom">
											<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/zoom.svg');?>
										</span>
									</a>
								</li>
							<?endforeach;?>
						</ul>
					</div>
					<div class="small-gallery-block"<?=($bShowSmallGallery ? ' style="display:block;"' : '');?>>
						<div class="front bigs">
							<div class="items row">
								<?foreach($templateData['GALLERY_BIG'] as $i => $arPhoto):?>
									<div class="col-md-3 col-sm-4 col-xs-6">
										<div class="item">
											<div class="wrap">
												<img src="<?=$arPhoto['PREVIEW']['src']?>" class="img-responsive inline" title="<?=$arPhoto['TITLE']?>" alt="<?=$arPhoto['ALT']?>" />
											</div>
										</div>
									</div>
								<?endforeach;?>
							</div>
						</div>
					</div>
				</div>
			<?endif;?>
		<?endif;?>

		<?//show brand block?>
		<?/*if($value == "brand"):?>
			<?if($templateData["BRAND_ITEM"]):?>
				<div class="wraps barnd-block">
					<hr />
					<h4><?=(strlen($arParams['T_DEV']) ? $arParams['T_DEV'] : GetMessage('T_DEV'))?></h4>
					<div class="item-views list list-type-block image_left">
						<div class="items row">
							<div class="col-md-12">
								<div class="item noborder clearfix">
									<?$preview_text = (($templateData["BRAND_ITEM"]['PREVIEW_TEXT'] && $templateData["BRAND_ITEM"]['DETAIL_TEXT']) ? $templateData["BRAND_ITEM"]['PREVIEW_TEXT'] : '');?>
									<?$detail_text = ($templateData["BRAND_ITEM"]['DETAIL_TEXT'] ? $templateData["BRAND_ITEM"]['DETAIL_TEXT'] : $templateData["BRAND_ITEM"]['PREVIEW_TEXT']);?>
									<?if($templateData["BRAND_ITEM"]['IMAGE']):?>
										<div class="image">
											<a href="<?=$templateData["BRAND_ITEM"]['DETAIL_PAGE_URL'];?>">
												<img src="<?=$templateData["BRAND_ITEM"]['IMAGE']['src'];?>" alt="<?=$templateData["BRAND_ITEM"]['NAME'];?>" title="<?=$templateData["BRAND_ITEM"]['NAME'];?>" class="img-responsive">
											</a>
										</div>
									<?endif;?>
									<div class="body-info">
										<?if($templateData["BRAND_ITEM"]['NAME']):?>
											<div class="title"><?=$templateData["BRAND_ITEM"]['NAME'];?></div>
										<?endif;?>
										<?if($detail_text):?>
											<div class="previewtext">
												<?=$detail_text;?>
											</div>
										<?endif;?>
										<?if($templateData["BRAND_ITEM"]['PROPERTY_SITE_VALUE']):?>
											<div class="properties">
												<div class="inner-wrapper">
													<!-- noindex -->
													<a class="property icon-block site" href="<?=$templateData["BRAND_ITEM"]['PROPERTY_SITE_VALUE'];?>" target="_blank" rel="nofollow">
														<?=$templateData["BRAND_ITEM"]['PROPERTY_SITE_VALUE'];?>
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
				</div>
			<?endif;?>
		<?endif;*/?>
		<?//show services block?>
		<?if($value == "services"):?>
			<?if($templateData['LINK_SERVICES']):?>
				<div class="wraps">
					<h4><?=(strlen($arParams['T_SERVICES']) ? $arParams['T_SERVICES'] : Loc::getMessage('T_SERVICES'))?></h4>
					<?$GLOBALS['arrServicesFilter'] = array('ID' => $templateData['LINK_SERVICES']);?>
					<?$APPLICATION->IncludeComponent(
						"bitrix:news.list",
						$arParams["SERVICES_LINK_ELEMENTS_TEMPLATE"],
						array(
							"IBLOCK_TYPE" => "aspro_priority_content",
							"IBLOCK_ID" => $arParams["IBLOCK_ID"],
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
								0 => "ICON",
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
							"PAGER_TITLE" => "�������",
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
		<?endif;?>
		<?//show sale block?>
		<?if($value == "sale"):?>
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
								"PAGER_TITLE" => "�������",
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
		<?endif;?>
		<?//show goods block?>
		<?if($value == "goods"):?>
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
							"PAGER_TITLE" => "�������",
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
		<?endif;?>
		<?// show partners block?>
		<?if($value == 'partners'):?>
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
							"PAGER_TITLE" => "�������",
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
		<?endif?>
		<?// show reviews block?>
		<?if($value == 'reviews'):?>
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
							"PAGER_TITLE" => "�������",
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
		<?endif?>
		<?// show staff block?>
		<?if($value == 'staff'):?>
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
							"PAGER_TITLE" => "�������",
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
		<?endif?>
		<?// show vacancys block?>
		<?if($value == 'vacancys'):?>
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
							"PAGER_TITLE" => "�������",
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
		<?endif?>
		<?// show sertificates block?>
		<?if($value == 'sertificates'):?>
			<?if($templateData['LINK_SERTIFICATES']):?>
				<div class="wraps goods-block">
					<h4><?=(strlen($arParams['T_SERTIFICATES']) ? $arParams['T_SERTIFICATES'] : Loc::getMessage('T_SERTIFICATES'))?></h4>
					<?$GLOBALS['arrSertificatesFilter'] = array('ID' => $templateData['LINK_SERTIFICATES']);?>
					<?$APPLICATION->IncludeComponent(
						"bitrix:news.list",
						"services-slider",
						array(
							"IBLOCK_TYPE" => "aspro_priority_content",
							"IBLOCK_ID" => $arParams["SERTIFICATES_IBLOCK_ID"],
							"NEWS_COUNT" => "20",
							"SORT_BY1" => "SORT",
							"SORT_ORDER1" => "ASC",
							"SORT_BY2" => "ID",
							"SORT_ORDER2" => "DESC",
							"FILTER_NAME" => "arrSertificatesFilter",
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
							"PAGER_TITLE" => "�������",
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
		<?endif?>
		<?//show comments block?>
		<?if($value == "comments"):?>
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
		<?endif;?>
	</div>
<?endforeach;?>