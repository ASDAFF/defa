<?if($iCountElement):?>
	<!-- noindex -->
	<div class="filters-wrap">
		<div class="row">
			<?
			if($_SESSION['UF_VIEWTYPE_'.$arParams['IBLOCK_ID']] === NULL){
				$arUserFieldViewType = CUserTypeEntity::GetList(array(), array('ENTITY_ID' => 'IBLOCK_'.$arParams['IBLOCK_ID'].'_SECTION', 'FIELD_NAME' => 'UF_VIEWTYPE'))->Fetch();
				$resUserFieldViewTypeEnum = CUserFieldEnum::GetList(array(), array('USER_FIELD_ID' => $arUserFieldViewType['ID']));
				while($arUserFieldViewTypeEnum = $resUserFieldViewTypeEnum->GetNext()){
					$_SESSION['UF_VIEWTYPE_'.$arParams['IBLOCK_ID']][$arUserFieldViewTypeEnum['ID']] = $arUserFieldViewTypeEnum['XML_ID'];
				}
			}
			
			$sort_default = $arParams['SORT_PROP_DEFAULT'] ? $arParams['SORT_PROP_DEFAULT'] : 'name';
			$order_default = $arParams['SORT_DIRECTION'] ? $arParams['SORT_DIRECTION'] : 'asc';
			$arPropertySortDefault = array('name', 'sort');
			
			$arAvailableSort = array(
				'name' => array(
					'SORT' => 'NAME',
					'ORDER_VALUES' => array(
						'asc' => GetMessage('sort_title').GetMessage('sort_name_asc'),
						'desc' => GetMessage('sort_title').GetMessage('sort_name_desc'),
					),
				),
				'sort' => array(
					'SORT' => 'SORT',
					'ORDER_VALUES' => array(
						'asc' => GetMessage('sort_title').GetMessage('sort_sort', array('#ORDER#' => GetMessage('sort_prop_asc'))),
						'desc' => GetMessage('sort_title').GetMessage('sort_sort', array('#ORDER#' => GetMessage('sort_prop_desc'))),
					)
				),
			);
			
			
			foreach($arAvailableSort as $prop => $arProp){
				if(!in_array($prop, $arParams['SORT_PROP']) && $sort_default !== $prop){
					unset($arAvailableSort[$prop]);
				}
			}
			if($arParams['SORT_PROP']){
				if(!isset($_SESSION[$arParams['CATALOG_IBLOCK_ID'].md5(serialize((array)$arParams['SORT_PROP']))])){
					foreach($arParams['SORT_PROP'] as $prop){
						if(!isset($arAvailableSort[$prop])){
							$dbRes = CIBlockProperty::GetList(array(), array('ACTIVE' => 'Y', 'IBLOCK_ID' => $arParams['CATALOG_IBLOCK_ID'], 'CODE' => $prop));
							while($arPropperty = $dbRes->Fetch()){
								$arAvailableSort[$prop] = array(
									'SORT' => 'PROPERTY_'.$prop,
									'ORDER_VALUES' => array(),
								);

								if($prop == 'PRICE' || $prop == 'FILTER_PRICE'){									
									$arAvailableSort[$prop]['ORDER_VALUES']['asc'] = GetMessage('sort_title').GetMessage('sort_PRICE_asc');
									$arAvailableSort[$prop]['ORDER_VALUES']['desc'] = GetMessage('sort_title').GetMessage('sort_PRICE_desc');
								}
								else{
									$arAvailableSort[$prop]['ORDER_VALUES']['asc'] = GetMessage('sort_title_property', array('#CODE#' => $arPropperty['NAME'], '#ORDER#' => GetMessage('sort_prop_asc')));
									$arAvailableSort[$prop]['ORDER_VALUES']['desc'] = GetMessage('sort_title_property', array('#CODE#' => $arPropperty['NAME'], '#ORDER#' => GetMessage('sort_prop_desc')));
								}
							}
						}
					}
					$_SESSION[$arParams['IBLOCK_ID'].md5(serialize((array)$arParams['SORT_PROP']))] = $arAvailableSort;
				}
				else{
					$arAvailableSort = $_SESSION[$arParams['CATALOG_IBLOCK_ID'].md5(serialize((array)$arParams['SORT_PROP']))];
				}
			}

			if(array_key_exists('display', $_REQUEST) && !empty($_REQUEST['display'])){
				setcookie('catalogViewMode', $_REQUEST['display'], 0, SITE_DIR);
				$_COOKIE['catalogViewMode'] = $_REQUEST['display'];
			}
			if(array_key_exists('sort', $_REQUEST) && !empty($_REQUEST['sort'])){
				setcookie('catalogSort', $_REQUEST['sort'], 0, SITE_DIR);
				$_COOKIE['catalogSort'] = $_REQUEST['sort'];
			}
			if(array_key_exists('order', $_REQUEST) && !empty($_REQUEST['order'])){
				setcookie('catalogOrder', $_REQUEST['order'], 0, SITE_DIR);
				$_COOKIE['catalogOrder'] = $_REQUEST['order'];
			}
			if(array_key_exists('show', $_REQUEST) && !empty($_REQUEST['show'])){
				setcookie('catalogPageElementCount', $_REQUEST['show'], 0, SITE_DIR);
				$_COOKIE['catalogPageElementCount'] = $_REQUEST['show'];
			}

			if($arSection['UF_VIEWTYPE'] && isset($_SESSION['UF_VIEWTYPE_'.$arParams['IBLOCK_ID']][$arSection['UF_VIEWTYPE']])){
				$display = $_SESSION['UF_VIEWTYPE_'.$arParams['IBLOCK_ID']][$arSection['UF_VIEWTYPE']];
			}
			else{
				$display = !empty($_COOKIE['catalogViewMode']) ? $_COOKIE['catalogViewMode'] : $arParams['VIEW_TYPE'];
			}

			$show = !empty($_COOKIE['catalogPageElementCount']) ? $_COOKIE['catalogPageElementCount'] : $arParams['PAGE_ELEMENT_COUNT'];
			$sort = !empty($_COOKIE['catalogSort']) ? $_COOKIE['catalogSort'] : $sort_default;
			$order = !empty($_COOKIE['catalogOrder']) ? $_COOKIE['catalogOrder'] : $order_default;
			?>
			<div class="col-md-7 col-sm-5 col-xs-5 ordering-wrap">
				<div class="select-outer">
					<select class="sort">
						<?foreach($arAvailableSort as $newSort => $arSort):?>
							<?if(is_array($arSort['ORDER_VALUES'])):?>
								<?foreach($arSort['ORDER_VALUES'] as $newOrder => $sortTitle):?>
									<?
									$selected = ($sort == $newSort && $order == $newOrder);
									$titleSelected = ($selected && !$titleSelected ? $sortTitle : $titleSelected);
									?>
									<option <?=($selected ? "selected='selected'" : "")?>  value="<?=$APPLICATION->GetCurPageParam('sort='.$newSort.'&order='.$newOrder, array('sort', 'order'))?>" class="ordering"><span><?=$sortTitle?></span></option>
								<?endforeach;?>
							<?endif;?>
						<?endforeach;?>
					</select>
					<div class="sort_desktop with_dropdown font_xs">
						<span class="selected"><?=$titleSelected;?></span>
						<div class="dropdown">
							<div class="wrap">
								<?foreach($arAvailableSort as $newSort => $arSort):?>
									<?if(is_array($arSort['ORDER_VALUES'])):?>
										<?foreach($arSort['ORDER_VALUES'] as $newOrder => $sortTitle):?>
											<?$selected = ($sort == $newSort && $order == $newOrder);?>
											<div class="ordering<?=($selected ? " selected" : "")?>"><a href="<?=$APPLICATION->GetCurPageParam('sort='.$newSort.'&order='.$newOrder, array('sort', 'order'))?>"><?=$sortTitle?></a></div>
										<?endforeach;?>
									<?endif;?>
								<?endforeach;?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?//if(!$arSection['UF_VIEWTYPE'] && !isset($_SESSION['UF_VIEWTYPE_'.$arParams['IBLOCK_ID']][$arSection['UF_VIEWTYPE']])):?>
				<div class="col-md-5 col-sm-7 col-xs-7 display-type pull-right text-right">
					<a rel="nofollow" href="<?=$APPLICATION->GetCurPageParam('display=table', array('display'))?>" class="view-button view-tiles <?=$display == 'table' ? 'cur' : '';?>" alt="<?=GetMessage('T_LIST_VIEW');?>" title="<?=GetMessage('T_LIST_VIEW');?>">
						<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/display_table.svg');?>
					</a>
					<a rel="nofollow" href="<?=$APPLICATION->GetCurPageParam('display=list', array('display'))?>" class="view-button view-list <?=$display == 'list' ? 'cur' : '';?>" alt="<?=GetMessage('T_TABLE_VIEW');?>" title="<?=GetMessage('T_TABLE_VIEW');?>">
						<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/display_list.svg');?>
					</a>
					<a rel="nofollow" href="<?=$APPLICATION->GetCurPageParam('display=price', array('display'))?>" class="view-button view-price <?=$display == 'price' ? 'cur' : '';?>" alt="<?=GetMessage('T_PRICE_VIEW');?>" title="<?=GetMessage('T_PRICE_VIEW');?>">
						<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/display_price.svg');?>
					</a>
				</div>
			<?//endif;?>
		</div>
		<div class="clearfix"></div>
	</div>
	<!-- /noindex -->
<?endif;?>