<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?$this->setFrameMode(true);?>
<?
global $arTheme, $orderViewBasketHtml;
$iVisibleItemsMenu = ($arTheme['MAX_VISIBLE_ITEMS_MENU']['VALUE'] ? $arTheme['MAX_VISIBLE_ITEMS_MENU']['VALUE'] : 10);
$sViewTypeMenu = (isset($arTheme['VIEW_TYPE_MENU']) && is_array($arTheme['VIEW_TYPE_MENU']) && $arTheme['VIEW_TYPE_MENU']['VALUE'] ? $arTheme['VIEW_TYPE_MENU']['VALUE'] : $arTheme['VIEW_TYPE_MENU']);
$sCountElementsMenuWide = "count_".$arTheme['COUNT_ITEMS_IN_LINE_MENU_WIDE']['VALUE'];
$sCountElementsMenuFull = "count_".$arTheme['COUNT_ITEMS_IN_LINE_MENU_FULL']['VALUE'];
$headerType = (isset($arTheme['HEADER_TYPE']) && is_array($arTheme['HEADER_TYPE']) && $arTheme['HEADER_TYPE']['VALUE'] ? $arTheme['HEADER_TYPE']['VALUE'] : $arTheme['HEADER_TYPE']);
$arFullHeaderValues = array('1', '2', '6');
$sIconPosition = (isset($arTheme['ICONS_POSITION']['VALUE']) && $arTheme['ICONS_POSITION']['VALUE'] ? $arTheme['ICONS_POSITION']['VALUE'] : $arTheme['ICONS_POSITION']);
$bShowImage = (isset($arTheme['SHOW_CATALOG_SECTIONS_IMAGE']['VALUE']) && $arTheme['SHOW_CATALOG_SECTIONS_IMAGE']['VALUE'] == 'Y' || $arTheme['SHOW_CATALOG_SECTIONS_IMAGE'] == 'Y' ? true : false);
$bShowIcons = (isset($arTheme['SHOW_CATALOG_SECTIONS_IMAGE']['DEPENDENT_PARAMS']) && $arTheme['SHOW_CATALOG_SECTIONS_IMAGE']['DEPENDENT_PARAMS']['CATALOG_SECTIONS_IMAGE_TYPE']['VALUE'] == 'icons' || $arTheme['CATALOG_SECTIONS_IMAGE_TYPE'] == 'icons' ? true : false);
$bImagePositionTop = (isset($arTheme['SHOW_CATALOG_SECTIONS_IMAGE']['DEPENDENT_PARAMS']) && $arTheme['SHOW_CATALOG_SECTIONS_IMAGE']['DEPENDENT_PARAMS']['CATALOG_ICONS_POSITION']['VALUE'] == 'top' || $arTheme['CATALOG_ICONS_POSITION'] == 'top' ? true : false);
?>

<?if($arResult):?>
	<div class="menu-only<?=($bImagePositionTop ? ' image_top' : '')?><?=($bShowIcons ? ' with_icons' : '')?> catalog_icons_<?=$arTheme['SHOW_CATALOG_SECTIONS_IMAGE']['VALUE'];?> icons_position_<?=$sIconPosition?> view_type_<?=$sViewTypeMenu?> <?=(in_array($headerType, $arFullHeaderValues) ? 'count_menu_full_'.$sCountElementsMenuFull : 'count_menu_wide_'.$sCountElementsMenuWide)?>">
		<nav class="mega-menu sliced">
			<div class="table-menu">
				<div class="marker-nav"></div>
				<table>
					<tr>
						<?$index = 0;?>
						<?foreach($arResult as $arItem):?>					
							<?$bShowChilds = $arParams["MAX_LEVEL"] > 1;?>
							<?$bFullDropdown = (isset($arItem['PARAMS']['FULL_DROPDOWN']) && $arItem['PARAMS']['FULL_DROPDOWN'] == 'Y' ? true : false);?>
							<?$dropdownClass = (isset($arItem['PARAMS']['FULL_DROPDOWN']) && $arItem['PARAMS']['FULL_DROPDOWN'] == 'Y' ? ' full_dropdown' : ' normal_dropdown');?>
							<td class="menu-item unvisible<?=$dropdownClass?> <?=($arItem["CHILD"] ? "dropdown" : "")?>  <?=($arItem["SELECTED"] ? "active" : "")?><?=($index == count($arResult) - 1 ? ' last_item' : '')?>">
								<div class="wrap">
									<a class="font_xs dark-color<?=($arItem["CHILD"] && $bShowChilds ? " dropdown-toggle" : "")?>" href="<?=$arItem["LINK"]?>">
										<span><?=$arItem["TEXT"]?></span>
									</a>
									<?if($arItem["CHILD"] && $bShowChilds):?>
										<span class="tail"></span>
										<ul class="dropdown-menu">
											<?foreach($arItem["CHILD"] as $arSubItem):?>
												<?$bShowChilds = $arParams["MAX_LEVEL"] > 2;?>
												<li class="item clearfix <?=($arSubItem["CHILD"] && $bShowChilds ? "dropdown-submenu" : "")?> <?=($arSubItem["SELECTED"] ? "active" : "")?>">
													<?if($bShowImage):?>
														<?
														if($bShowIcons){
															$arPicture = ($arSubItem['PARAMS']['ICON'] ? CFile::ResizeImageGet($arSubItem['PARAMS']['ICON'], array('width'=>40, 'height'=>40), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : '');														
														}
														else{
															$arPicture = ($arSubItem['PARAMS']['PICTURE'] ? CFile::ResizeImageGet($arSubItem['PARAMS']['PICTURE'], array('width'=>60, 'height'=>60), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : '');														
														}
														
														$bBackground = ($arSubItem['PARAMS']['ICON_BACKGROUND'] ? true : false);
														?>
														<?if($arPicture):?>
															<div class="image<?=($bBackground ? ' wbg' : '');?><?=($bShowIcons && !$arSubItem['PARAMS']['ICON_BACKGROUND'] ? ' wtbg' : '');?>">
																<a href="<?=$arSubItem["LINK"]?>"><img src="<?=$arPicture['src']?>" alt="<?=$arSubItem['NAME']?>" title="<?=$arSubItem['NAME']?>" /></a>
															</div>
														<?endif?>
													<?endif;?>
													<div class="menu_body<?=($bShowImage && $arPicture ? ' with_image' : '')?>">
														<a class="dark-color" href="<?=$arSubItem["LINK"]?>" title="<?=$arSubItem["TEXT"]?>"><?=$arSubItem["TEXT"]?><?=($arSubItem["CHILD"] && $bShowChilds ? '<span class="arrow"><i></i></span>' : '')?></a>
														<?if($arSubItem["CHILD"] && $bShowChilds):?>
															<ul class="dropdown-menu">
																<?
																$i = 0;
																$iCountChilds = count($arSubItem["CHILD"]);
																?>

																<?foreach($arSubItem["CHILD"] as $arSubSubItem):?>																
																	<?$bShowChilds = ($arParams["MAX_LEVEL"] > 3 && $sViewTypeMenu != 'LINE');?>
																	<li class="<?=($arSubSubItem["CHILD"] && $bShowChilds ? "dropdown-submenu" : "")?> <?=(++$i > $iVisibleItemsMenu ? 'collapsed' : '');?> <?=($arSubSubItem["SELECTED"] ? "active" : "")?>">
																		<a href="<?=$arSubSubItem["LINK"]?>" title="<?=$arSubSubItem["TEXT"]?>">
																			<span><?=$arSubSubItem["TEXT"]?></span>
																			<?if($i != count($arSubItem["CHILD"]) && $sViewTypeMenu == 'LINE'):?>
																				<span class="separator">&mdash;</span>
																			<?endif?>
																		</a>
																		<?if($arSubSubItem["CHILD"] && $bShowChilds):?>
																			<ul class="dropdown-menu">
																				<?foreach($arSubSubItem["CHILD"] as $arSubSubSubItem):?>
																					<li class="<?=($arSubSubSubItem["SELECTED"] ? "active" : "")?>">
																						<a href="<?=$arSubSubSubItem["LINK"]?>" title="<?=$arSubSubSubItem["TEXT"]?>"><?=$arSubSubSubItem["TEXT"]?></a>
																					</li>
																				<?endforeach;?>
																			</ul>
																		<?endif;?>
																	</li>
																<?endforeach;?>
																<?if($bFullDropdown && $iCountChilds > $iVisibleItemsMenu):?>
																	<?
																	$sMoreOpenText = str_replace('#COUNT_ELEMENTS#', $iCountChilds - $iVisibleItemsMenu, \Bitrix\Main\Localization\Loc::getMessage("S_MORE_ITEMS_BUTTON"));
																	?>
																	<li class="more_items"><span class="dark-color with_dropdown" data-open_text="<?=$sMoreOpenText?>" data-close_text="<?=\Bitrix\Main\Localization\Loc::getMessage("S_MORE_ITEMS_BUTTON_CLOSE")?>"><?=$sMoreOpenText;?></span></li>
																<?endif;?>
															</ul>
														<?endif;?>
													</div>
												</li>
											<?endforeach;?>
										</ul>
									<?endif;?>
								</div>
							</td>
							<?++$index;?>
						<?endforeach;?>

						<td class="dropdown normal_dropdown js-dropdown nosave unvisible">
							<div class="wrap">
								<a class="dropdown-toggle more-items" href="#"></a>
								<span class="tail"></span>
								<ul class="dropdown-menu"></ul>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</nav>
	</div>
<?endif;?>

<?
	/*function update_menu() {			
	
		//return; 
		var tablemenu = document.getElementsByClassName("table-menu")[0];
		list = tablemenu.getElementsByClassName("menu-item");
		
		function getCookie(cname) {
			var name = cname + "=";
			var ca = document.cookie.split(';');
			for(var i = 0; i < ca.length; i++) {
				var c = ca[i];
				while (c.charAt(0) == ' ') {
					c = c.substring(1);
				}
				if (c.indexOf(name) == 0) {
					return c.substring(name.length, c.length);
				}
			}
			return false;
		}
		
		
		var menu_items_limit = getCookie('mil');
		var menu_items_show_more = getCookie('mism');

		showmore = tablemenu.getElementsByClassName("js-dropdown")[0];	
		
		if ((menu_items_show_more !== false) && ( menu_items_limit !== false)) {
			console.log('go limit: '+ menu_items_limit  + '; show more:' + menu_items_show_more);
			if (menu_items_show_more == 1) {
				showmore.classList.remove("unvisible");
			} else {
				showmore.classList.add("unvisible");		
			}
			
			for (var i = 0; i < list.length; i++) {
				if (i<menu_items_limit) {
					list[i].classList.remove("unvisible");
				} else {
					list[i].classList.add("unvisible");
				}
				
				if (i==menu_items_limit-1) {
					if (list[i].nextSibling) {
					  list[i].parentNode.insertBefore(showmore, list[i].nextSibling);
					}
					else {
					  list[i].parentNode.appendChild(showmore);
					}
				}
			}
		}
		
		tablemenu.classList.remove("unvisible");
		tablemenu.style.visibility = "";
	}
	
	
	update_menu(); */
?>

