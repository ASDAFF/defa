<?
/**
 * Priority module
 * @copyright 2017 Aspro
 */

if(!defined('PRIORITY_MODULE_ID'))
	define('PRIORITY_MODULE_ID', 'aspro.priority');

IncludeModuleLangFile(__FILE__);
use \Bitrix\Main\Type\Collection,
	Bitrix\Main\IO\File,
	\Bitrix\Main\Config\Option;

// initialize module parametrs list and default values
include_once __DIR__.'/../../parametrs.php';

class CPriority{
	const MODULE_ID = PRIORITY_MODULE_ID;
	const PARTNER_NAME = 'aspro';
	const SOLUTION_NAME = 'priority';
	const devMode = false; // set to false before release

	static $panelBottom = false;
	
	static $arParametrsList = array();
	private static $arMetaParams = array();
	private static $arComponentsName = array();

	public function checkModuleRight($reqRight = 'R', $bShowError = false){
		global  $APPLICATION;

		if($APPLICATION->GetGroupRight(self::MODULE_ID) < $reqRight){
			if($bShowError){
				$APPLICATION->AuthForm(GetMessage('PRIORITY_ACCESS_DENIED'));
			}
			return false;
		}

		return true;
	}

	public static function ClearSomeComponentsCache($SITE_ID){
		CBitrixComponent::clearComponentCache('bitrix:news.list', $SITE_ID);
		CBitrixComponent::clearComponentCache('bitrix:news.detail', $SITE_ID);
	}

	public static function AjaxAuth(){
		if(!defined('ADMIN_SECTION') && isset($_REQUEST['auth_service_id']) && $_REQUEST['auth_service_id'])
		{
			if($_REQUEST['auth_service_id']):
				global $APPLICATION, $CACHE_MANAGER;?>
				<?$APPLICATION->IncludeComponent(
					"bitrix:system.auth.form",
					"popup",
					array(
						"PROFILE_URL" => "",
						"SHOW_ERRORS" => "Y",
						"POPUP_AUTH" => "Y"
					)
				);?>
			<?endif;?>
		<?}
	}

	public static function GetSections($arItems, $arParams){
		$arSections = array(
			'PARENT_SECTIONS' => array(),
			'CHILD_SECTIONS' => array(),
			'ALL_SECTIONS' => array(),
		);
		if(is_array($arItems) && $arItems)
		{
			$arSectionsIDs = array();
			foreach($arItems as $arItem)
			{
				if($SID = $arItem['IBLOCK_SECTION_ID'])
					$arSectionsIDs[] = $SID;
			}
			if($arSectionsIDs)
			{
				$arSections['ALL_SECTIONS'] = CCache::CIBLockSection_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'GROUP' => array('ID'), 'MULTI' => 'N')), array('ID' => $arSectionsIDs));
				$bCheckRoot = false;
				foreach($arSections['ALL_SECTIONS'] as $key => $arSection)
				{
					if($arSection['DEPTH_LEVEL'] > 1)
					{
						$bCheckRoot = true;
						$arSections['CHILD_SECTIONS'][$key] = $arSection;
						unset($arSections['ALL_SECTIONS'][$key]);

						$arFilter = array('IBLOCK_ID'=>$arSection['IBLOCK_ID'], '<=LEFT_BORDER' => $arSection['LEFT_MARGIN'], '>=RIGHT_BORDER' => $arSection['RIGHT_MARGIN'], 'DEPTH_LEVEL' => 1);
						$arSelect = array('ID', 'SORT', 'IBLOCK_ID', 'NAME');
						$arParentSection = CCache::CIBLockSection_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'MULTI' => 'N')), $arFilter, false, $arSelect);

						$arSections['ALL_SECTIONS'][$arParentSection['ID']]['SECTION'] = $arParentSection;
						$arSections['ALL_SECTIONS'][$arParentSection['ID']]['CHILD_IDS'][$arSection['ID']] = $arSection['ID'];

						$arSections['PARENT_SECTIONS'][$arParentSection['ID']] = $arParentSection;
					}
					else
					{
						$arSections['ALL_SECTIONS'][$key]['SECTION'] = $arSection;
						$arSections['PARENT_SECTIONS'][$key] = $arSection;
					}
				}

				if($bCheckRoot)
				{
					// get root sections
					$arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y', 'DEPTH_LEVEL' => 1, 'ID' => array_keys($arSections['ALL_SECTIONS']));
					$arSelect = array('ID', 'SORT', 'IBLOCK_ID', 'NAME');
					$arRootSections = CCache::CIBLockSection_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']))), $arFilter, false, $arSelect);
					foreach($arRootSections as $arSection)
					{
						$arSections['ALL_SECTIONS']['SORTED'][$arSection['ID']] = $arSections['ALL_SECTIONS'][$arSection['ID']];
						unset($arSections['ALL_SECTIONS'][$arSection['ID']]);
					}
					foreach($arSections['ALL_SECTIONS']['SORTED'] as $key => $arSection)
					{
						$arSections['ALL_SECTIONS'][$key] = $arSection;
					}
					unset($arSections['ALL_SECTIONS']['SORTED']);
				}
			}
		}
		return $arSections;
	}

	public static function ShowPageType($type = 'indexblocks', $componentTemplate = '', $paramName = '', $oneTemplateComponent = false){
		global $APPLICATION, $arTheme;
		$path = $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/page_blocks/'.$type.'_';
		$file = null;

		if(is_array($arTheme) && $arTheme)
		{
			switch($type):
				case 'page_contacts':
					$path = str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'].'/'.SITE_DIR.'contacts/'.$type);
					$file = $path.'_'.$arTheme['PAGE_CONTACTS']['VALUE'].'.php';
					break;
				case 'search_title_component':
					$path = str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'].'/'.SITE_DIR.'include/footer/');
					$file = $path.'site-search.php';
					break;
				case 'mega_menu':
					//$path = str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'].'/'.SITE_DIR.'include/header/');
					$file = $path.$arTheme['MEGA_MENU']['VALUE'].'.php';
					break;
				case 'basket_component':
					$path = str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'].'/'.SITE_DIR.'include/footer/');
					$file = $path.'site-basket.php';
					break;
				case 'auth_component':
					$path = str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'].'/'.SITE_DIR.'include/footer/');
					$file = $path.'site-auth.php';
					break;
				case 'bottom_counter':
					$path = str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'].'/'.SITE_DIR.'include/');
					$file = $path.'invis-counter.php';
					break;
				case 'page_width':
					$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/width-'.$arTheme['PAGE_WIDTH']['VALUE'].'.css');
					break;
				case 'h1_style':
					if ($arTheme['H1_STYLE']['VALUE']=='Normal') {
						$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/h1-normal.css');
					}elseif(1) {
						$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/h1-bold.css');
					}
					break;
				case 'footer':
					$file = $path.(isset($arTheme['FOOTER_TYPE']['VALUE']) && $arTheme['FOOTER_TYPE']['VALUE'] ? $arTheme['FOOTER_TYPE']['VALUE'] : $arTheme['FOOTER_TYPE']).'.php';
					break;
				case 'header':
					$file = $path.(isset($arTheme['HEADER_TYPE']) && !is_array($arTheme['HEADER_TYPE']) && $arTheme['HEADER_TYPE'] ? $arTheme['HEADER_TYPE'] : $arTheme['HEADER_TYPE']['VALUE']).'.php';
					break;
				case 'header_fixed':
					$file = $path.$arTheme['TOP_MENU_FIXED']['DEPENDENT_PARAMS']['HEADER_FIXED']['VALUE'].'.php';
					break;
				case 'header_mobile':
					$file = $path.$arTheme['HEADER_MOBILE']['VALUE'].'.php';
					break;
				case 'header_mobile_menu':
					$file = $path.$arTheme['HEADER_MOBILE_MENU']['VALUE'].'.php';
					break;
				case 'left_block':
					$file = $path.$arTheme['VIEW_TYPE_LEFT_BLOCK']['VALUE'].'.php';
					break;
				case 'page_title':
					$file = $path.$arTheme['PAGE_TITLE']['VALUE'].'.php';
					break;
				case 'index_component':
					if($componentTemplate){
						if(!$oneTemplateComponent){
							$componentTemplateValue = (isset($arTheme['TEMPLATE_PARAMS']) ? $arTheme['TEMPLATE_PARAMS'][$arTheme['INDEX_TYPE']['VALUE']][$arTheme['INDEX_TYPE']['VALUE'].'_'.$paramName.'_TEMPLATE']['VALUE'] : $arTheme[$arTheme['INDEX_TYPE'].'_'.$paramName.'_TEMPLATE']);//(isset($arTheme[strtoupper($componentTemplate).'_TEMPLATE']) && !is_array($arTheme[strtoupper($componentTemplate).'_TEMPLATE']) ? $arTheme[strtoupper($componentTemplate).'_TEMPLATE'] : (isset($arTheme[strtoupper($componentTemplate).'_TEMPLATE']) && $arTheme[strtoupper($componentTemplate).'_TEMPLATE']['VALUE'] ? $arTheme[strtoupper($componentTemplate).'_TEMPLATE']['VALUE'] : ''));
							$file = $path = str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'].'/'.SITE_DIR.'include/mainpage/components/'.$componentTemplate.'/'.$componentTemplate.'_'.$componentTemplateValue.'.php');
						}
						else{
							$file = $path = str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'].'/'.SITE_DIR.'include/mainpage/components/'.$componentTemplate.'/'.$componentTemplate.'.php');
						}
					}
					break;
				default:
					global $arMainPageOrder;
					if(isset($arTheme['INDEX_TYPE']['SUB_PARAMS'][$arTheme['INDEX_TYPE']['VALUE']]))
					{
						$order = $arTheme["SORT_ORDER_INDEX_TYPE_".$arTheme["INDEX_TYPE"]["VALUE"]];
						if($order)
							$arMainPageOrder = explode(",", $order);
						else
							$arMainPageOrder = array_keys($arTheme['INDEX_TYPE']['SUB_PARAMS'][$arTheme['INDEX_TYPE']['VALUE']]);
						foreach(GetModuleEvents(PRIORITY_MODULE_ID, 'OnAsproShowPageType', true) as $arEvent) // event for manipulation arMainPageOrder
							ExecuteModuleEventEx($arEvent, array($arTheme, &$arMainPageOrder));
					}

					$path = str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'].'/b2g/'.SITE_DIR.$type);
					$file = $path.'_'.$arTheme['INDEX_TYPE']['VALUE'].'.php';
					break;
			endswitch;
			
			if ($file) {
				if(isset($_COOKIE['OVERSITE_PANEL_SHOW']) && $_COOKIE['OVERSITE_PANEL_SHOW'] == 'Y' && (CSite::InDir(SITE_DIR.'index.php') || CSite::InDir(SITE_DIR.'ajax/options_change_oversite.php'))&& ((isset($arTheme['THEME_SWITCHER']['VALUE']) && $arTheme['THEME_SWITCHER']['VALUE'] == 'Y') || isset($arTheme['THEME_SWITCHER']) && $arTheme['THEME_SWITCHER'] == 'Y') && $paramName){
					$arParams = self::$arParametrsList;
					$slideshowSpeed = (isset($arTheme['PARTNERSBANNER_SLIDESSHOWSPEED']['VALUE']) && abs(intval($arTheme['PARTNERSBANNER_SLIDESSHOWSPEED']['VALUE'])) ? $arTheme['PARTNERSBANNER_SLIDESSHOWSPEED']['VALUE'] : abs(intval($arTheme['PARTNERSBANNER_SLIDESSHOWSPEED'])));
					$animationSpeed = (isset($arTheme['PARTNERSBANNER_ANIMATIONSPEED']['VALUE']) && abs(intval($arTheme['PARTNERSBANNER_ANIMATIONSPEED']['VALUE'])) ? $arTheme['PARTNERSBANNER_ANIMATIONSPEED']['VALUE'] : abs(intval($arTheme['PARTNERSBANNER_ANIMATIONSPEED'])));					
					$indexType = ($arTheme['INDEX_TYPE'] && !is_array($arTheme['INDEX_TYPE']) ? $arTheme['INDEX_TYPE'] : $arTheme['INDEX_TYPE']['VALUE']);
					$countSubParams = count($arParams['INDEX_PAGE']['OPTIONS']['INDEX_TYPE']['SUB_PARAMS'][$indexType]);
					$title = $arParams['INDEX_PAGE']['OPTIONS']['INDEX_TYPE']['SUB_PARAMS'][$indexType][$paramName]['TITLE'];
					$title = str_replace('"', '', $title);
					$title = str_replace(GetMessage('IN_INDEX_PAGE'), '', $title);
					$bListTemplates = (isset($arParams[strtoupper($type)]['OPTIONS'][$paramName]['LIST']) && $arParams[strtoupper($type)]['OPTIONS'][$paramName]['LIST'] ? true : false);
					$bComponentsListTemplates = (isset($arParams['INDEX_PAGE']['OPTIONS']['INDEX_TYPE']['SUB_PARAMS'][$indexType][$paramName]['TEMPLATE']['LIST']) && $arParams['INDEX_PAGE']['OPTIONS']['INDEX_TYPE']['SUB_PARAMS'][$indexType][$paramName]['TEMPLATE']['LIST'] ? true : false);
					?>
					<div id="<?=$paramName?>" class="change_block<?=(!$bListTemplates && !$bComponentsListTemplates ? ' no_templates' : '');?>">
						<span class="top_border_changer"></span>
						<span class="right_border_changer"></span>
						<span class="bottom_border_changer"></span>
						<span class="left_border_changer"></span>
						<?if($componentTemplate):?>
							<?
							self::$arComponentsName[] = $componentTemplate;
							?>
							<?if(!$oneTemplateComponent):?>
								<span title="<?=GetMessage('ACTION_BACKWARD');?>" class="change_params left_params" data-param_name="<?=$paramName?>" data-param_value="<?=(isset($arTheme['TEMPLATE_PARAMS']) && $arTheme['TEMPLATE_PARAMS'][$arTheme['INDEX_TYPE']['VALUE']][$arTheme['INDEX_TYPE']['VALUE'].'_'.$paramName.'_TEMPLATE']['VALUE'] ? intval($arTheme['TEMPLATE_PARAMS'][$arTheme['INDEX_TYPE']['VALUE']][$arTheme['INDEX_TYPE']['VALUE'].'_'.$paramName.'_TEMPLATE']['VALUE']) - 1 : intval($arTheme[$arTheme['INDEX_TYPE'].'_'.$paramName.'_TEMPLATE']) - 1)?>" data-type="<?=$type?>" data-component_template="<?=$componentTemplate?>">
									<svg class="change_params_svg" width="19" height="10" viewBox="0 0 19 10">
										<path d="M707,250H696v2.9a0.985,0.985,0,0,1-.273.8,1,1,0,0,1-1.408,0l-5.021-3.968a1,1,0,0,1,0-1.411l5.021-4.031a1,1,0,0,1,1.408,0,0.985,0.985,0,0,1,.273.8V248h11A1,1,0,0,1,707,250Z" transform="translate(-689.031 -244)"/>
									</svg>
								</span>
							<?endif;?>
							<div class="actions">
								<span class="action_down" title="<?=GetMessage('ACTION_DOWN');?>" data-min_order="2" data-max_order="<?=$countSubParams;?>">
									<svg width="10" height="17" viewBox="0 0 10 17">
										<path d="M740,242h-8a1,1,0,0,1,0-2h8A1,1,0,0,1,740,242Zm-8.706,8.292a0.98,0.98,0,0,1,.8-0.274H735V245a1,1,0,0,1,1-1h0a1,1,0,0,1,1,1v5.018h2.9a0.982,0.982,0,0,1,.8.274,1,1,0,0,1,0,1.411l-3.968,5.03a1,1,0,0,1-1.411,0l-4.03-5.03A1,1,0,0,1,731.294,250.292Z" transform="translate(-731 -240)"/>
									</svg>
								</span>
								<span class="action_up" title="<?=GetMessage('ACTION_UP');?>" data-min_order="2" data-max_order="<?=$countSubParams;?>">
									<svg width="10" height="17" viewBox="0 0 10 17">
										<path d="M740,242h-8a1,1,0,0,1,0-2h8A1,1,0,0,1,740,242Zm-8.706,8.292a0.98,0.98,0,0,1,.8-0.274H735V245a1,1,0,0,1,1-1h0a1,1,0,0,1,1,1v5.018h2.9a0.982,0.982,0,0,1,.8.274,1,1,0,0,1,0,1.411l-3.968,5.03a1,1,0,0,1-1.411,0l-4.03-5.03A1,1,0,0,1,731.294,250.292Z" transform="translate(-731 -240)"/>
									</svg>
								</span>
								<span class="action_hide" title="<?=GetMessage('ACTION_DEACTIVATE');?>" data-param_name="<?=$indexType.'_'.$paramName;?>" data-block="<?=$paramName;?>" data-title="<?=$title;?>">
									<svg width="18" height="18" viewBox="0 0 18 18">
										<path d="M764,258a9,9,0,1,1,9-9A9,9,0,0,1,764,258Zm0-16a7,7,0,1,0,7,7A7,7,0,0,0,764,242Zm3.723,10.723a1,1,0,0,1-1.414,0L764,250.414l-2.309,2.309a1,1,0,1,1-1.414-1.414L762.586,249l-2.309-2.309a1,1,0,1,1,1.414-1.414L764,247.586l2.309-2.309a1,1,0,1,1,1.414,1.414L765.414,249l2.309,2.309A1,1,0,0,1,767.723,252.723Z" transform="translate(-755 -240)"/>
									</svg>								
								</span>
							</div>
						<?else:?>
							<span title="<?=GetMessage('ACTION_BACKWARD');?>" class="change_params left_params" data-param_name="<?=$paramName?>" data-param_value="<?=(isset($arTheme[$paramName]['VALUE']) && $arTheme[$paramName]['VALUE'] ? intval($arTheme[$paramName]['VALUE']) - 1 : intval($arTheme[$paramName]) - 1)?>" data-type="<?=$type?>" data-component_template="<?=$componentTemplate?>">
								<svg class="change_params_svg" width="19" height="10" viewBox="0 0 19 10">
									<path d="M707,250H696v2.9a0.985,0.985,0,0,1-.273.8,1,1,0,0,1-1.408,0l-5.021-3.968a1,1,0,0,1,0-1.411l5.021-4.031a1,1,0,0,1,1.408,0,0.985,0.985,0,0,1,.273.8V248h11A1,1,0,0,1,707,250Z" transform="translate(-689.031 -244)"/>
								</svg>
							</span>
						<?endif;?>
					
						<div class="wrap">
							<?@include_once $file;?>
						</div>
						<?if($componentTemplate):?>	
							<?if(!$oneTemplateComponent):?>
								<span title="<?=GetMessage('ACTION_FORWARD');?>" class="change_params right_params" data-param_name="<?=$paramName?>" data-param_value="<?=(isset($arTheme['TEMPLATE_PARAMS']) && $arTheme['TEMPLATE_PARAMS'][$arTheme['INDEX_TYPE']['VALUE']][$arTheme['INDEX_TYPE']['VALUE'].'_'.$paramName.'_TEMPLATE']['VALUE'] ? intval($arTheme['TEMPLATE_PARAMS'][$arTheme['INDEX_TYPE']['VALUE']][$arTheme['INDEX_TYPE']['VALUE'].'_'.$paramName.'_TEMPLATE']['VALUE']) + 1 : intval($arTheme[$arTheme['INDEX_TYPE'].'_'.$paramName.'_TEMPLATE']) + 1)?>" data-type="<?=$type?>" data-component_template="<?=$componentTemplate?>">
									<svg class="change_params_svg" width="19" height="10" viewBox="0 0 19 10">
										<path d="M728.733,249.735L723.7,253.7a1,1,0,0,1-1.411,0,0.981,0.981,0,0,1-.273-0.8V250H711a1,1,0,0,1,0-2h11.02v-2.906a0.982,0.982,0,0,1,.273-0.8,1,1,0,0,1,1.411,0l5.029,4.031A1,1,0,0,1,728.733,249.735Z" transform="translate(-710 -244)"/>
									</svg>
								</span>
							<?endif;?>
						<?else:?>
							<span title="<?=GetMessage('ACTION_FORWARD');?>" class="change_params right_params" data-param_name="<?=$paramName?>" data-param_value="<?=(isset($arTheme[$paramName]['VALUE']) && $arTheme[$paramName]['VALUE'] ? intval($arTheme[$paramName]['VALUE']) + 1 : intval($arTheme[$paramName]) + 1)?>" data-type="<?=$type?>" data-component_template="<?=$componentTemplate?>">
								<svg class="change_params_svg" width="19" height="10" viewBox="0 0 19 10">
									<path d="M728.733,249.735L723.7,253.7a1,1,0,0,1-1.411,0,0.981,0.981,0,0,1-.273-0.8V250H711a1,1,0,0,1,0-2h11.02v-2.906a0.982,0.982,0,0,1,.273-0.8,1,1,0,0,1,1.411,0l5.029,4.031A1,1,0,0,1,728.733,249.735Z" transform="translate(-710 -244)"/>
								</svg>
							</span>
						<?endif;?>
						<?if($bListTemplates || $bComponentsListTemplates):?>
							<div class="variant_panel <?=$paramName;?>">
								<div class="close_panel">
									<svg width="10" height="10" viewBox="0 0 10 10">
										<path d="M604.41,596.984l3.276,3.276a1.008,1.008,0,0,1-1.426,1.425l-3.276-3.276-3.276,3.276a1.008,1.008,0,0,1-1.425-1.425l3.276-3.276-3.276-3.276a1.008,1.008,0,1,1,1.425-1.426l3.276,3.276,3.276-3.276a1.008,1.008,0,0,1,1.426,1.426Z" transform="translate(-598 -592)"/>
									</svg>
								</div>
							
								<div class="maxwidth-theme">
									<?if(($paramName == 'HEADER_TYPE' || $paramName == 'FOOTER_TYPE') && $bListTemplates):?>
										<?
										$headerType = ($arTheme['HEADER_TYPE'] && !is_array($arTheme['HEADER_TYPE']) ? $arTheme['HEADER_TYPE'] : $arTheme['HEADER_TYPE']['VALUE']);
										$footerType = ($arTheme['FOOTER_TYPE'] && !is_array($arTheme['FOOTER_TYPE']) ? $arTheme['FOOTER_TYPE'] : $arTheme['FOOTER_TYPE']['VALUE']);
										$variantType = ($paramName == 'HEADER_TYPE' ? $headerType : $footerType);
										?>
										<div class="variant_flexslider">
											<ul class="slides">
												<?foreach($arParams[strtoupper($type)]['OPTIONS'][$paramName]['LIST'] as $key => $arList):?>
													<?if($key != 'custom'):?>
														<li class="variant<?=($key == $variantType ? ' active' : '');?>" data-param_name="<?=$paramName;?>" data-param_value="<?=$key;?>" data-type="<?=$type?>"><?=$arList['TITLE'];?></li>
													<?endif;?>
												<?endforeach;?>
											</ul>
										</div>
									<?elseif($componentTemplate && $bComponentsListTemplates):?>
										<?
										$variantType = $arTheme['TEMPLATE_PARAMS'][$indexType][$indexType.'_'.$paramName.'_TEMPLATE']['VALUE'];
										?>
										
										<div class="variant_flexslider items wimage">
											<ul class="slides">
												<?foreach($arParams['INDEX_PAGE']['OPTIONS']['INDEX_TYPE']['SUB_PARAMS'][$indexType][$paramName]['TEMPLATE']['LIST'] as $key => $arList):?>
													<?if($key != 'custom'):?>
														<li class="variant item<?=($key == $variantType ? ' active' : '');?>" data-param_name="<?=$paramName;?>" data-param_value="<?=$key;?>" data-type="<?=$type?>" data-component_template="<?=$componentTemplate?>">
															<div class="title"><?=$arList['TITLE'];?></div>
															<div class="image"><img src="<?=$arList['IMG'];?>" alt="<?=$arList['TITLE'];?>" title="<?=$arList['TITLE'];?>"></div>
														</li>
													<?endif;?>
												<?endforeach;?>
											</ul>
										</div>
									<?endif;?>
								</div>
							</div>
						<?endif;?>
					</div>
					<?if(!self::$panelBottom && $type == 'footer'):?>
						<?
						$bSaveButton = ($GLOBALS['USER']->IsAdmin() && ((isset($_SESSION['THEME']) && $_SESSION['THEME']) && (isset($_SESSION['THEME'][SITE_ID]) && $_SESSION['THEME'][SITE_ID])) ? true : false);
						?>
						<div class="bottom_panel clearfix<?=($bSaveButton ? ' wsavebtn' : '')?>">
							<div class="right_block">
								<div class="close">
									<svg width="12" height="12" viewBox="0 0 12 12">
										<path d="M828.41,248.984l4.276,4.276a1.008,1.008,0,0,1-1.426,1.426l-4.276-4.277-4.276,4.277a1.008,1.008,0,1,1-1.425-1.426l4.276-4.276-4.276-4.276a1.008,1.008,0,0,1,1.425-1.425l4.276,4.276,4.276-4.276a1.008,1.008,0,0,1,1.426,1.425Z" transform="translate(-821 -243)"/>
									</svg>
									<span class="tooltip"><?=GetMessage('DEACTIVATE_PANEL');?></span>
								</div>
								<div class="reset">
									<svg width="14" height="12" viewBox="0 0 14 12">
									  <path d="M294,40h-3a1,1,0,1,1,0-2h0.43a3.951,3.951,0,0,0-6.367-.7l-2.132-.486A5.935,5.935,0,0,1,293,36.766V36a1,1,0,1,1,2,0v3A1,1,0,0,1,294,40Zm-8,1a1,1,0,0,1-1,1h-0.447a3.971,3.971,0,0,0,6.207.885l2.191,0.5A5.954,5.954,0,0,1,283,43.247V44a1,1,0,1,1-2,0V41a1,1,0,0,1,1-1h3A1,1,0,0,1,286,41Z" transform="translate(-281 -34)"></path>
									</svg>
									<span class="tooltip"><?=GetMessage('ACTION_RESET');?></span>
								</div>
							
								<?if($bSaveButton):?>
									<div class="save_btn changer" title="<?=GetMessage('SAVE_BUTTON');?>">
										<span>
											<svg width="16" height="14" viewBox="0 0 16 14">
												<path d="M624,254H612a2,2,0,0,1-2-2v-8a2,2,0,0,1,2-2h3v2h-3v8h12v-8h-3v-2h3a2,2,0,0,1,2,2v8A2,2,0,0,1,624,254Zm-5.279-4.295a0.907,0.907,0,0,1-.291.193,0.993,0.993,0,0,1-.315.079h0A0.9,0.9,0,0,1,618,250a0.837,0.837,0,0,1-.179-0.044,0.971,0.971,0,0,1-.193-0.047,112.157,112.157,0,0,0-.307-0.2c-0.009-.01-0.012-0.022-0.021-0.032s-0.05-.033-0.068-0.057l-1.949-1.923a0.991,0.991,0,1,1,1.4-1.4L617,246.6V241a1,1,0,0,1,2,0v5.618l0.3-.3a0.991,0.991,0,0,1,1.4,1.4Z" transform="translate(-610 -240)"/>
											</svg>
											<span><?=GetMessage('SAVE_BUTTON')?></span>
										</span>
									</div>
								<?endif;?>
							</div>
							<div class="components">
								<span class="tooltip action_activate"><?=GetMessage('ACTION_ACTIVATE');?></span>
								<span class="tooltip action_select"><?=GetMessage('ACTION_SELECT_VARIANT');?></span>
								<div class="slider clearfix">
									<ul class="slides">									
										<?foreach($arTheme['INDEX_TYPE']['SUB_PARAMS'][$indexType] as $key => $arComponentParams):?>
											<?
											$variantType = $arTheme['TEMPLATE_PARAMS'][$indexType][$indexType.'_'.$key.'_TEMPLATE']['VALUE'];
											?>
										
											<?if($arComponentParams['VALUE'] == 'N'):?>
												<?
												$componentTitle = str_replace('"', '', $arComponentParams['TITLE']);
												$componentTitle = str_replace(GetMessage('IN_INDEX_PAGE'), '', $componentTitle);
												?>
												<li class="item<?=(isset($arComponentParams['TEMPLATE']) && $arComponentParams['TEMPLATE']['LIST'] ? ' wtemplates' : '');?>">
													<span class="add_block" data-param_name="<?=$indexType.'_'.$key;?>" data-block="<?=$key;?>">
														<svg width="10" height="10" viewBox="0 0 10 10">
															<path d="M784,250h-3v3a1,1,0,0,1-2,0v-3h-3a1,1,0,0,1,0-2h3v-3a1,1,0,0,1,2,0v3h3A1,1,0,0,1,784,250Z" transform="translate(-775 -244)"/>
														</svg>
													</span>
													<div class="title">
														<span><?=$componentTitle;?></span>
													</div>
													
													<?if(isset($arComponentParams['TEMPLATE']['LIST']) && $arComponentParams['TEMPLATE']['LIST']):?>
														<div class="variant_panel <?=$key;?>">
															<div class="close_panel">
																<svg width="10" height="10" viewBox="0 0 10 10">
																	<path d="M604.41,596.984l3.276,3.276a1.008,1.008,0,0,1-1.426,1.425l-3.276-3.276-3.276,3.276a1.008,1.008,0,0,1-1.425-1.425l3.276-3.276-3.276-3.276a1.008,1.008,0,1,1,1.425-1.426l3.276,3.276,3.276-3.276a1.008,1.008,0,0,1,1.426,1.426Z" transform="translate(-598 -592)"/>
																</svg>
															</div>
															<div class="maxwidth-theme">
																<div class="variant_flexslider wimage">
																	<ul class="slides">
																		<?foreach($arComponentParams['TEMPLATE']['LIST'] as $keyList => $arList):?>
																			<?if($keyList != 'custom'):?>
																				<li class="variant<?=($keyList == $variantType ? ' active' : '');?>" data-param_name="<?=$key;?>" data-param_value="<?=$keyList;?>" data-type="index_component" data-component_template="<?=$arComponentParams['COMPONENT_NAME'];?>">
																					<div class="title"><?=$arList['TITLE'];?></div>
																					<div class="image"><img src="<?=$arList['IMG'];?>" alt="<?=$arList['TITLE'];?>" title="<?=$arList['TITLE'];?>"></div>
																					<span class="select_variant">
																						<span>
																							<svg width="16" height="16" viewBox="0 0 16 16">
																								<path d="M595,598h-6v6a1,1,0,0,1-2,0v-6h-6a1,1,0,1,1,0-2h6v-6a1,1,0,0,1,2,0v6h6A1,1,0,1,1,595,598Z" transform="translate(-580 -589)"/>
																							</svg>
																						</span>
																					</span>
																				</li>
																			<?endif;?>
																		<?endforeach;?>
																	</ul>
																</div>
															</div>
														</div>
													<?endif;?>
												</li>
											<?endif;?>
										<?endforeach;?>
									</ul>
								</div>
							</div>
						</div>
						<?self::$panelBottom = true;?>
					<?endif;?>					
				<?
				}
				else{
					@include_once $file;
				}
			}
		}
	}

	public static function ShowLogo(){
		global $arSite;
		$arTheme = self::GetFrontParametrsValues(SITE_ID);
		$text = '<a href="'.SITE_DIR.'">';
		
		if($arImg = unserialize(Option::get(PRIORITY_MODULE_ID, "LOGO_IMAGE", serialize(array())))){
			$text .= '<img src="'.CFile::GetPath($arImg[0]).'" alt="'.$arSite["SITE_NAME"].'" title="'.$arSite["SITE_NAME"].'" />';
		}
		elseif(self::checkContentFile(SITE_DIR.'/include/logo_svg.php')){
			$text .= File::getFileContents($_SERVER['DOCUMENT_ROOT'].SITE_DIR.'/include/logo_svg.php');
		}
		else{
			$text .= '<img src="'.$arTheme["LOGO_IMAGE"].'" alt="'.$arSite["SITE_NAME"].'" title="'.$arSite["SITE_NAME"].'" />';
		}
		$text .= '</a>';

		return $text;
	}
	
	public static function showIconSvg($path){
		$iconSVG = '';
		
		if(file_exists($_SERVER['DOCUMENT_ROOT'].$path)){
			$iconSVG = File::getFileContents($_SERVER['DOCUMENT_ROOT'].$path);
		}

		return $iconSVG;
	}
	
	public static function GetBackParametrsValues($SITE_ID, $bStatic = true){
		if($bStatic)
			static $arValues;

		if($bStatic && $arValues === NULL || !$bStatic){
			$arDefaultValues = $arValues = $arNestedValues = array();
			$bNestedParams = false;

			// get site template
			$arTemplate = self::GetSiteTemplate($SITE_ID);

			// add custom values for PAGE_CONTACTS
			if(isset(self::$arParametrsList['SECTION']['OPTIONS']['PAGE_CONTACTS']['LIST'])){
				// get site dir
				$arSite = CSite::GetByID($SITE_ID)->Fetch();
				$siteDir = str_replace('//', '/', $arSite['DIR']).'/';
				if($arPageBlocks = self::GetIndexPageBlocks($_SERVER['DOCUMENT_ROOT'].$siteDir.'contacts', 'page_contacts_', '')){
					foreach($arPageBlocks as $page => $value){
						$value_ = str_replace('page_contacts_', '', $value);
						if(!isset(self::$arParametrsList['SECTION']['OPTIONS']['PAGE_CONTACTS']['LIST'][$value_])){
							self::$arParametrsList['SECTION']['OPTIONS']['PAGE_CONTACTS']['LIST'][$value_] = array(
								'TITLE' => $value,
								'HIDE' => 'Y',
								'IS_CUSTOM' => 'Y',
							);
						}
					}
					if(!self::$arParametrsList['SECTION']['OPTIONS']['PAGE_CONTACTS']['DEFAULT']){
						self::$arParametrsList['SECTION']['OPTIONS']['PAGE_CONTACTS']['DEFAULT'] = key(self::$arParametrsList['SECTION']['OPTIONS']['PAGE_CONTACTS']['LIST']);
					}
				}
			}

			if($arTemplate && $arTemplate['PATH']){
				// add custom values for BLOG_PAGE
				if(isset(self::$arParametrsList['SECTION']['OPTIONS']['BLOG_PAGE'])){
					self::Add2OptionCustomComponentTemplatePageBlocks(self::$arParametrsList['SECTION']['OPTIONS']['BLOG_PAGE'], $arTemplate['PATH'].'/components/bitrix/news/blog');
				}

				// add custom values for PROJECTS_PAGE
				if(isset(self::$arParametrsList['SECTION']['OPTIONS']['PROJECTS_PAGE'])){
					self::Add2OptionCustomComponentTemplatePageBlocks(self::$arParametrsList['SECTION']['OPTIONS']['PROJECTS_PAGE'], $arTemplate['PATH'].'/components/bitrix/news/projects');
				}

				// add custom values for NEWS_PAGE
				if(isset(self::$arParametrsList['SECTION']['OPTIONS']['NEWS_PAGE'])){
					self::Add2OptionCustomComponentTemplatePageBlocks(self::$arParametrsList['SECTION']['OPTIONS']['NEWS_PAGE'], $arTemplate['PATH'].'/components/bitrix/news/news');
				}

				// add custom values for REVIEWS_PAGE
				if(isset(self::$arParametrsList['SECTION']['OPTIONS']['REVIEWS_PAGE'])){
					self::Add2OptionCustomComponentTemplatePageBlocks(self::$arParametrsList['SECTION']['OPTIONS']['REVIEWS_PAGE'], $arTemplate['PATH'].'/components/bitrix/news/reviews');
				}

				// add custom values for STAFF_PAGE
				if(isset(self::$arParametrsList['SECTION']['OPTIONS']['STAFF_PAGE'])){
					self::Add2OptionCustomComponentTemplatePageBlocks(self::$arParametrsList['SECTION']['OPTIONS']['STAFF_PAGE'], $arTemplate['PATH'].'/components/bitrix/news/staff');
				}

				// add custom values for PARTNERS_PAGE
				if(isset(self::$arParametrsList['SECTION']['OPTIONS']['PARTNERS_PAGE'])){
					self::Add2OptionCustomComponentTemplatePageBlocks(self::$arParametrsList['SECTION']['OPTIONS']['PARTNERS_PAGE'], $arTemplate['PATH'].'/components/bitrix/news/partners');
				}

				// add custom values for VACANCY_PAGE
				if(isset(self::$arParametrsList['SECTION']['OPTIONS']['VACANCY_PAGE'])){
					self::Add2OptionCustomComponentTemplatePageBlocks(self::$arParametrsList['SECTION']['OPTIONS']['VACANCY_PAGE'], $arTemplate['PATH'].'/components/bitrix/news/vacancy');
				}

				// add custom values for LICENSES_PAGE
				if(isset(self::$arParametrsList['SECTION']['OPTIONS']['LICENSES_PAGE'])){
					self::Add2OptionCustomComponentTemplatePageBlocks(self::$arParametrsList['SECTION']['OPTIONS']['LICENSES_PAGE'], $arTemplate['PATH'].'/components/bitrix/news/documents');
				}

				// add custom values for DOCUMENTS_PAGE
				if(isset(self::$arParametrsList['SECTION']['OPTIONS']['DOCUMENTS_PAGE'])){
					self::Add2OptionCustomComponentTemplatePageBlocks(self::$arParametrsList['SECTION']['OPTIONS']['DOCUMENTS_PAGE'], $arTemplate['PATH'].'/components/bitrix/news/documents');
				}

				// add custom values for MANUFACTURERS_PAGE
				if(isset(self::$arParametrsList['SECTION']['OPTIONS']['MANUFACTURERS_PAGE'])){
					self::Add2OptionCustomComponentTemplatePageBlocks(self::$arParametrsList['SECTION']['OPTIONS']['MANUFACTURERS_PAGE'], $arTemplate['PATH'].'/components/bitrix/news/manufacturers');
				}
				
				// add custom values for SERVICES_PAGE_DETAIL
				if(isset(self::$arParametrsList['SERVICES_PAGE']['OPTIONS']['SERVICES_PAGE_DETAIL'])){
					self::Add2OptionCustomComponentTemplatePageBlocksElement(self::$arParametrsList['SERVICES_PAGE']['OPTIONS']['SERVICES_PAGE_DETAIL'], $arTemplate['PATH'].'/components/bitrix/news/services');
				}

				// add custom values for CATALOG_PAGE_DETAIL
				if(isset(self::$arParametrsList['CATALOG_PAGE']['OPTIONS']['CATALOG_PAGE_DETAIL'])){
					self::Add2OptionCustomComponentTemplatePageBlocksElement(self::$arParametrsList['CATALOG_PAGE']['OPTIONS']['CATALOG_PAGE_DETAIL'], $arTemplate['PATH'].'/components/bitrix/news/catalog');
				}

				// add custom values for ELEMENTS_TABLE_TYPE_VIEW
				if(isset(self::$arParametrsList['CATALOG_PAGE']['OPTIONS']['ELEMENTS_TABLE_TYPE_VIEW'])){
					self::Add2OptionCustomComponentTemplatePageBlocksElement(self::$arParametrsList['CATALOG_PAGE']['OPTIONS']['ELEMENTS_TABLE_TYPE_VIEW'], $arTemplate['PATH'].'/components/bitrix/news/catalog', 'ELEMENTS_TABLE');
				}

				// add custom values for ELEMENTS_LIST_TYPE_VIEW
				if(isset(self::$arParametrsList['CATALOG_PAGE']['OPTIONS']['ELEMENTS_LIST_TYPE_VIEW'])){
					self::Add2OptionCustomComponentTemplatePageBlocksElement(self::$arParametrsList['CATALOG_PAGE']['OPTIONS']['ELEMENTS_LIST_TYPE_VIEW'], $arTemplate['PATH'].'/components/bitrix/news/catalog', 'ELEMENTS_LIST');
				}

				// add custom values for ELEMENTS_PRICE_TYPE_VIEW
				if(isset(self::$arParametrsList['CATALOG_PAGE']['OPTIONS']['ELEMENTS_PRICE_TYPE_VIEW'])){
					self::Add2OptionCustomComponentTemplatePageBlocksElement(self::$arParametrsList['CATALOG_PAGE']['OPTIONS']['ELEMENTS_PRICE_TYPE_VIEW'], $arTemplate['PATH'].'/components/bitrix/news/catalog', 'ELEMENTS_PRICE');
				}
				
				// add custom values for SECTIONS_TYPE_VIEW
				if(isset(self::$arParametrsList['CATALOG_PAGE']['OPTIONS']['SECTIONS_TYPE_VIEW'])){
					self::Add2OptionCustomComponentTemplatePageBlocks(self::$arParametrsList['CATALOG_PAGE']['OPTIONS']['SECTIONS_TYPE_VIEW'], $arTemplate['PATH'].'/components/bitrix/news/catalog', 'SECTIONS_TYPE_VIEW');
				}
				
				// add custom values for SECTIONS_TYPE_VIEW
				if(isset(self::$arParametrsList['SERVICES_PAGE']['OPTIONS']['SERVICES_SECTIONS_TYPE_VIEW'])){
					self::Add2OptionCustomComponentTemplatePageBlocks(self::$arParametrsList['SERVICES_PAGE']['OPTIONS']['SERVICES_SECTIONS_TYPE_VIEW'], $arTemplate['PATH'].'/components/bitrix/news/services', 'SECTIONS_TYPE_VIEW');
				}
			}

			if(self::$arParametrsList && is_array(self::$arParametrsList))
			{
				foreach(self::$arParametrsList as $blockCode => $arBlock)
				{
					if($arBlock['OPTIONS'] && is_array($arBlock['OPTIONS']))
					{						
						foreach($arBlock['OPTIONS'] as $optionCode => $arOption)
						{
							if($arOption['TYPE'] !== 'note' && $arOption['TYPE'] !== 'includefile'){
								if($arOption['TYPE'] === 'array'){
									$itemsKeysCount = Option::get(self::MODULE_ID, $optionCode, '0', $SITE_ID);
									if($arOption['OPTIONS'] && is_array($arOption['OPTIONS'])){
										for($itemKey = 0, $cnt = $itemsKeysCount + 1; $itemKey < $cnt; ++$itemKey){
											$_arParameters = array();
											$arOptionsKeys = array_keys($arOption['OPTIONS']);
											foreach($arOptionsKeys as $_optionKey){
												$arrayOptionItemCode = $optionCode.'_array_'.$_optionKey.'_'.$itemKey;
												$arValues[$arrayOptionItemCode] = Option::get(self::MODULE_ID, $arrayOptionItemCode, '', $SITE_ID);
												$arDefaultValues[$arrayOptionItemCode] = $arOption['OPTIONS'][$_optionKey]['DEFAULT'];
											}
										}
									}
									$arValues[$optionCode] = $itemsKeysCount;
									$arDefaultValues[$optionCode] = 0;
								}
								else{
									$arDefaultValues[$optionCode] = $arOption['DEFAULT'];
									$arValues[$optionCode] = Option::get(self::MODULE_ID, $optionCode, $arOption['DEFAULT'], $SITE_ID);

									if(isset($arOption['SUB_PARAMS']) && $arOption['SUB_PARAMS']) //get nested params default value
									{
										if($arOption['TYPE'] == 'selectbox' && (isset($arOption['LIST'])) && $arOption['LIST'])
										{
											$bNestedParams = true;
											$arNestedValues[$optionCode] = $arOption['LIST'];
											foreach($arOption['LIST'] as $key => $value)
											{
												if($arOption['SUB_PARAMS'][$key])
												{
													foreach($arOption['SUB_PARAMS'][$key] as $key2 => $arSubOptions)
													{
														$arDefaultValues[$key.'_'.$key2] = $arSubOptions['DEFAULT'];
														
														//set default template index components
														if(isset($arSubOptions['TEMPLATE']) && $arSubOptions['TEMPLATE'])
														{
															$code_tmp = $key.'_'.$key2.'_TEMPLATE';
															$arDefaultValues[$code_tmp] = $arSubOptions['TEMPLATE']['DEFAULT'];
															$arValues[$code_tmp] = Option::get(self::MODULE_ID, $code_tmp, $arSubOptions['TEMPLATE']['DEFAULT'], $SITE_ID);
														}
													}

													//sort order prop for main page
													$param = 'SORT_ORDER_'.$optionCode.'_'.$key;
													$arValues[$param] = Option::get(self::MODULE_ID, $param, '', $SITE_ID);
													$arDefaultValues[$param] = '';
												}
											}
										}
									}

									if(isset($arOption['DEPENDENT_PARAMS']) && $arOption['DEPENDENT_PARAMS']) //get dependent params default value
									{
										foreach($arOption['DEPENDENT_PARAMS'] as $key => $arSubOption)
										{
											$arDefaultValues[$key] = $arSubOption['DEFAULT'];
											$arValues[$key] = Option::get(self::MODULE_ID, $key, $arSubOption['DEFAULT'], $SITE_ID);
										}
									}
								}
							}
						}
					}
				}
			}

			if($arNestedValues && $bNestedParams) //get nested params bd value
			{
				foreach($arNestedValues as $key => $arAllValues)
				{
					$arTmpValues = array();
					foreach($arAllValues as $key2 => $arOptionValue)
					{
						$arTmpValues = unserialize(Option::get(self::MODULE_ID, 'NESTED_OPTIONS_'.$key.'_'.$key2, serialize(array()), $SITE_ID));
						if($arTmpValues)
						{
							foreach($arTmpValues as $key3 => $value)
							{
								$arValues[$key2.'_'.$key3] = $value;
							}
						}
					}

				}
			}

			if($arValues && is_array($arValues))
			{
				foreach($arValues as $optionCode => $arOption)
				{
					if(!isset($arDefaultValues[$optionCode]))
						unset($arValues[$optionCode]);
				}
			}

			if($arDefaultValues && is_array($arDefaultValues))
			{
				foreach($arDefaultValues as $optionCode => $arOption)
				{
					if(!isset($arValues[$optionCode]))
						$arValues[$optionCode] = $arOption;
				}
			}

			foreach($arValues as $key => $value)
			{
				if($key == 'LOGO_IMAGE' || $key == 'LOGO_IMAGE_LIGHT' || $key == 'FAVICON_IMAGE' || $key == 'APPLE_TOUCH_ICON_IMAGE'){
					$arValue = unserialize(Option::get(self::MODULE_ID, $key, serialize(array()), $SITE_ID));
					$arValue = (array)$arValue;
					$fileID = $arValue ? current($arValue) : false;

					if($key === 'FAVICON_IMAGE')
						$arValues[$key] = str_replace('//', '/', SITE_DIR.'/favicon.ico');

					if($fileID)
					{
						if($key !== 'FAVICON_IMAGE')
							$arValues[$key] = CFIle::GetPath($fileID);
					}
					else
					{
						if($key === 'APPLE_TOUCH_ICON_IMAGE')
							$arValues[$key] = str_replace('//', '/', SITE_DIR.'/include/apple-touch-icon.png');
						elseif($key === 'LOGO_IMAGE')
							$arValues[$key] = str_replace('//', '/', SITE_DIR.'/logo.png');
					}

					if(!file_exists(str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'].$arValues[$key]))){
						$arValues[$key] = '';
					}
					else
					{
						if($key === 'FAVICON_IMAGE')
							$arValues[$key] .= '?'.filemtime(str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'].$arValues[$key]));
					}

				}
			}

			if(!defined('ADMIN_SECTION'))
			{
				// replace #SITE_DIR#
				if($arValues && is_array($arValues))
				{
					foreach($arValues as $optionCode => $arOption)
					{
						if(!is_array($arOption))
							$arValues[$optionCode] = str_replace('#SITE_DIR#', SITE_DIR, $arOption);
					}
				}

				// define RECAPTCHA CONST
				if($arValues['CAPTCHA_FORM_TYPE'] === 'RECAPTCHA' || $arValues['CAPTCHA_FORM_TYPE'] === 'RECAPTCHA2'){
					if(!defined('RECAPTCHA_SITE_KEY')){
						define('RECAPTCHA_SITE_KEY', $arValues['RECAPTCHA_SITE_KEY']);
					}
					if(!defined('RECAPTCHA_SECRET_KEY')){
						define('RECAPTCHA_SECRET_KEY', $arValues['RECAPTCHA_SECRET_KEY']);
					}
				}
			}
		}

		return $arValues;
	}

	public static function GetFrontParametrsValues($SITE_ID){
		if(!strlen($SITE_ID))
			$SITE_ID = SITE_ID;
		$arBackParametrs = self::GetBackParametrsValues($SITE_ID);

		if($arBackParametrs['THEME_SWITCHER'] === 'Y')
			$arValues = array_merge((array)$arBackParametrs, (array)$_SESSION['THEME'][$SITE_ID]);
		else
			$arValues = (array)$arBackParametrs;

		return $arValues;
	}

	public static function GetFrontParametrValue($optionCode, $SITE_ID = SITE_ID){
		static $arFrontParametrs;

		if(!isset($arFrontParametrs)){
			$arFrontParametrs = self::GetFrontParametrsValues($SITE_ID);
		}

		return $arFrontParametrs[$optionCode];
	}

	public static function ShowAdminRow($optionCode, $arOption, $arTab, $arControllerOption, $bShowIcon = false){
		$optionName = $arOption["TITLE"];
		$optionType = $arOption["TYPE"];
		$optionList = $arOption["LIST"];
		$optionDefault = $arOption["DEFAULT"];
		$optionVal = $arTab["OPTIONS"][$optionCode];
		$optionSize = $arOption["SIZE"];
		$optionCols = $arOption["COLS"];
		$optionRows = $arOption["ROWS"];
		$optionChecked = $optionVal == "Y" ? "checked" : "";
		$optionDisabled = isset($arControllerOption[$optionCode]) || array_key_exists("DISABLED", $arOption) && $arOption["DISABLED"] == "Y" ? "disabled" : "";
		$optionSup_text = array_key_exists("SUP", $arOption) ? $arOption["SUP"] : "";
		$optionController = isset($arControllerOption[$optionCode]) ? "title='".GetMessage("MAIN_ADMIN_SET_CONTROLLER_ALT")."'" : "";
		$optionsSiteID = $arTab["SITE_ID"];
		$isArrayItem = strpos($optionCode, '_array_') !== false;
		if($optionCode == 'USE_BITRIX_FORM')
		{
			if(!\Bitrix\Main\ModuleManager::isModuleInstalled('form'))
				return;
		}
		?>
		<?if($optionType == "dynamic_iblock"):?>
			<?if(\Bitrix\Main\Loader::IncludeModule('iblock')):?>
				<td colspan="2">
					<div class="title"  align="center"><b><?=$optionName;?></b></div>
					<?
					$arIblocks = array();
					$arSort = array(
						"SORT" => "ASC",
						"ID" => "ASC"
					);
					$arFilter = array(
						"ACTIVE" => "Y",
						"SITE_ID" => $optionsSiteID,
						"TYPE" => "aspro_priority_form"
					);
					$rsItems = CIBlock::GetList($arSort, $arFilter);
					while($arItem = $rsItems->Fetch()){
						if($arItem["CODE"] != "aspro_priority_example" && $arItem["CODE"] != "aspro_priority_order_page")
						{
							$arItem['THEME_VALUE'] = Option::get(self::MODULE_ID, htmlspecialcharsbx($optionCode)."_".htmlspecialcharsbx(strtoupper($arItem['CODE'])), $optionsSiteID);
							$arIblocks[] = $arItem;
						}
					}
					if($arIblocks):?>
						<table width="100%">
							<?foreach($arIblocks as $arIblock):?>
								<tr>
									<td class="adm-detail-content-cell-l" width="50%">
										<?=GetMessage("SUCCESS_SEND_FORM", array("#IBLOCK_CODE#" => $arIblock["NAME"]));?>
									</td>
									<td class="adm-detail-content-cell-r" width="50%">
										<input type="text" <?=((isset($arOption['PARAMS']) && isset($arOption['PARAMS']['WIDTH'])) ? 'style="width:'.$arOption['PARAMS']['WIDTH'].'"' : '');?> <?=$optionController?> size="<?=$optionSize?>" maxlength="255" value="<?=htmlspecialcharsbx($arIblock['THEME_VALUE'])?>" name="<?=htmlspecialcharsbx($optionCode)."_".htmlspecialcharsbx($arIblock['CODE'])."_".$optionsSiteID?>" <?=$optionDisabled?>>
									</td>
								</tr>
							<?endforeach;?>
						</table>
					<?endif;?>
				</td>
			<?endif;?>
		<?elseif($optionType == "note"):?>
			<?if($optionCode == 'USE_FORMS_GOALS_NOTE'){
				$FORMS_GOALS_LIST = '';
				$arIblocksIDs = array();
				$bUseForm = (\Bitrix\Main\Config\Option::get(self::MODULE_ID, 'USE_BITRIX_FORM', 'N', $optionsSiteID) == 'Y' && \Bitrix\Main\Loader::includeModule('form'));
				if($bUseForm)
				{
					$arOption["NOTE"] = GetMessage("USE_FORM_GOALS_NOTE_TITLE2");
					$rsForm = CForm::GetList($by = 'id', $order = 'asc', array('ACTIVE' => 'Y', 'SITE' => array($optionsSiteID)), $is_filtered);
					if($arForm = $rsForm->Fetch())
						$FORMS_GOALS_LIST .= $arForm['NAME'].' - <i>goal_webform_success_'.$arForm['ID'].'</i><br />';
				}
				else
				{
					if(CCache::$arIBlocks[$optionsSiteID]['aspro_priority_form'] && is_array(CCache::$arIBlocks[$optionsSiteID]['aspro_priority_form'])){
						foreach(CCache::$arIBlocks[$optionsSiteID]['aspro_priority_form'] as $arIDs){
							if($arIDs && is_array($arIDs)){
								foreach($arIDs as $IBLOCK_ID){
									if(CCache::$arIBlocksInfo && CCache::$arIBlocksInfo[$IBLOCK_ID] && is_array(CCache::$arIBlocksInfo[$IBLOCK_ID])){
										$FORMS_GOALS_LIST .= CCache::$arIBlocksInfo[$IBLOCK_ID]['NAME'].' - <i>goal_webform_success_'.$IBLOCK_ID.'</i><br />';
									}
								}
							}
						}
					}
				}
				$arOption["NOTE"] = str_replace('#FORMS_GOALS_LIST#', $FORMS_GOALS_LIST, $arOption["NOTE"]);
			}
			?>
			<td colspan="2" align="center">
				<?=BeginNote('align="center"');?>
				<?=$arOption["NOTE"]?>
				<?=EndNote();?>
			</td>
		<?else:?>
			<?if(!$isArrayItem):?>
				<td class="adm-detail-content-cell-l <?=(in_array($optionType, array("multiselectbox", "textarea", "statictext", "statichtml")) ? "adm-detail-valign-top" : "")?>" width="50%"<?=(isset($arOption['SHOW_DEPENDENT_PARAMS']) && $arOption['SHOW_DEPENDENT_PARAMS'] == 'Y' ? ' style="font-weight:bold;"' : '')?>>
					<?if($optionType == "checkbox"):?>
						<label for="<?=htmlspecialcharsbx($optionCode)."_".$optionsSiteID?>"><?=$optionName?></label>
					<?else:?>
						<?if($optionCode != 'CUSTOM_FONT_HASH'):?>
							<?=$optionName.($optionCode == "BASE_COLOR_CUSTOM" ? ' #' : '')?>
						<?endif;?>
					<?endif;?>
					<?if(strlen($optionSup_text)):?>
						<span class="required"><sup><?=$optionSup_text?></sup></span>
					<?endif;?>
				</td>
			<?endif;?>
			<td<?=(!$isArrayItem ? ' width="50%" ' : '')?>>
				<?
				if($optionCode == 'PAGE_CONTACTS')
				{
					$siteDir = str_replace('//', '/', $arTab['SITE_DIR']).'/';
					if($arPageBlocks = self::GetIndexPageBlocks($_SERVER['DOCUMENT_ROOT'].$siteDir.'contacts', 'page_contacts_', '')){
						$arTmp = array();
						foreach($arPageBlocks as $page => $value)
						{
							$value_ = str_replace('page_contacts_', '', $value);
							$arTmp[$value_] = $value;
						}
						foreach($arOption['LIST'] as $key_list => $arValue)
						{
							if(isset($arTmp[$key_list]))
								;
							else
								unset($arOption['LIST'][$key_list]);
						}
					}
					$optionList = $arOption['LIST'];
				}
				elseif($optionCode == 'BLOG_PAGE')
				{
					$optionList = self::getActualParamsValue( $arTab, $arOption, '/components/bitrix/news/blog');
				}
				elseif($optionCode == 'NEWS_PAGE')
				{
					$optionList = self::getActualParamsValue( $arTab, $arOption, '/components/bitrix/news/news');
				}
				elseif($optionCode == 'PROJECTS_PAGE')
				{
					$optionList = self::getActualParamsValue( $arTab, $arOption, '/components/bitrix/news/projects');
				}
				elseif($optionCode == 'STAFF_PAGE')
				{
					$optionList = self::getActualParamsValue( $arTab, $arOption, '/components/bitrix/news/staff');
				}
				elseif($optionCode == 'PARTNERS_PAGE')
				{
					$optionList = self::getActualParamsValue( $arTab, $arOption, '/components/bitrix/news/partners');
				}
				elseif($optionCode == 'REVIEWS_PAGE')
				{
					$optionList = self::getActualParamsValue( $arTab, $arOption, '/components/bitrix/news/reviews');
				}
				elseif($optionCode == 'VACANCY_PAGE')
				{
					$optionList = self::getActualParamsValue( $arTab, $arOption, '/components/bitrix/news/vacancy');
				}
				elseif($optionCode == 'LICENSES_PAGE')
				{
					$optionList = self::getActualParamsValue( $arTab, $arOption, '/components/bitrix/news/documents');
				}
				elseif($optionCode == 'DOCUMENTS_PAGE')
				{
					$optionList = self::getActualParamsValue( $arTab, $arOption, '/components/bitrix/news/documents');
				}
				elseif($optionCode == 'MANUFACTURERS_PAGE')
				{
					$optionList = self::getActualParamsValue( $arTab, $arOption, '/components/bitrix/news/manufacturers');
				}
				?>
				<?if($optionType == "checkbox" || $optionType == "hidden"):?>
					<input type="<?=($optionType == 'hidden' ? 'hidden' : 'checkbox')?>" <?=((isset($arOption['DEPENDENT_PARAMS']) && $arOption['DEPENDENT_PARAMS']) ? "class='depend-check'" : "");?> <?=$optionController?> id="<?=htmlspecialcharsbx($optionCode)."_".$optionsSiteID?>" name="<?=htmlspecialcharsbx($optionCode)."_".$optionsSiteID?>" value="Y" <?=$optionChecked?> <?=$optionDisabled?> <?=(strlen($optionDefault) ? $optionDefault : "")?>>
					<?if($bShowIcon):?>
						<span class="drag"></span>
					<?endif;?>
				<?elseif($optionType == "text" || $optionType == "password" || $optionType == 'hidden'):?>
					<input type="<?=$optionType?>" <?=((isset($arOption['PARAMS']) && isset($arOption['PARAMS']['WIDTH'])) ? 'style="width:'.$arOption['PARAMS']['WIDTH'].'"' : '');?> <?=$optionController?> size="<?=$optionSize?>" maxlength="255" value="<?=htmlspecialcharsbx($optionVal)?>" name="<?=htmlspecialcharsbx($optionCode)."_".$optionsSiteID?>" <?=$optionDisabled?> <?=($optionCode == "password" ? "autocomplete='off'" : "")?>>
				<?elseif($optionType == "selectbox"):?>
					<?
					if(!is_array($optionList)) $optionList = (array)$optionList;
					$arr_keys = array_keys($optionList);
					?>
					<?/*?>
					<?for($j = 0, $c = count($arr_keys); $j < $c; ++$j):?>
						<div class="image<?=($optionVal == $arr_keys[$j] ? ' selected' : '')?>" data-option-value="<?=$arr_keys[$j];?>" data-select="Y">
							<img src="<?=$optionList[$arr_keys[$j]]['IMG'];?>" alt="<?=$optionList[$arr_keys[$j]]['TITLE'];?>" title="<?=$optionList[$arr_keys[$j]]['TITLE'];?>">
						</div>
					<?endfor;?>
					*/?>
					<select name="<?=htmlspecialcharsbx($optionCode)."_".$optionsSiteID?>" <?=$optionController?> <?=$optionDisabled?><?// style="display:none;"?>>
						<?for($j = 0, $c = count($arr_keys); $j < $c; ++$j):?>
							<option value="<?=$arr_keys[$j]?>" <?if($optionVal == $arr_keys[$j]) echo "selected"?>><?=htmlspecialcharsbx((is_array($optionList[$arr_keys[$j]]) ? $optionList[$arr_keys[$j]]["TITLE"] : $optionList[$arr_keys[$j]]))?></option>
						<?endfor;?>
					</select>
					<?foreach($optionList as $optionListCode => $option):?>
						<?if(isset($option['SUB_PARAMS']) && $option['SUB_PARAMS']):?>
							<?foreach($option['SUB_PARAMS'] as $paramCode => $arParam):?>
								<?if($arParam['TYPE'] == 'checkbox'):?>
									<span class="extra_params">
										<input type="checkbox" name="<?=htmlspecialcharsbx($optionCode)."_".$optionListCode."_".$paramCode."_".$optionsSiteID;?>" id="<?=htmlspecialcharsbx($optionCode)."_".$optionListCode."_".$paramCode."_".$optionsSiteID;?>">
										<label for="<?=htmlspecialcharsbx($optionCode)."_".$optionListCode."_".$paramCode."_".$optionsSiteID;?>"><?=$arParam['TITLE'];?></span>
									</span>
								<?endif;?>
							<?endforeach;?>
						<?endif?>
					<?endforeach;?>
				<?elseif($optionType == "multiselectbox"):?>
					<?
					if(!is_array($optionList)) $optionList = (array)$optionList;
					$arr_keys = array_keys($optionList);
					if(!is_array($optionVal)) $optionVal = (array)$optionVal;
					?>
					<select size="<?=$optionSize?>" <?=$optionController?> <?=$optionDisabled?> multiple name="<?=htmlspecialcharsbx($optionCode)."_".$optionsSiteID?>[]" >
						<?for($j = 0, $c = count($arr_keys); $j < $c; ++$j):?>
							<option value="<?=$arr_keys[$j]?>" <?if(in_array($arr_keys[$j], $optionVal)) echo "selected"?>><?=htmlspecialcharsbx((is_array($optionList[$arr_keys[$j]]) ? $optionList[$arr_keys[$j]]["TITLE"] : $optionList[$arr_keys[$j]]))?></option>
						<?endfor;?>
					</select>
				<?elseif($optionType == "textarea"):?>
					<textarea <?=$optionController?> <?=$optionDisabled?> rows="<?=$optionRows?>" cols="<?=$optionCols?>" name="<?=htmlspecialcharsbx($optionCode)."_".$optionsSiteID?>"><?=htmlspecialcharsbx($optionVal)?></textarea>
				<?elseif($optionType == "statictext"):?>
					<?=htmlspecialcharsbx($optionVal)?>
				<?elseif($optionType == "statichtml"):?>
					<?=$optionVal?>
				<?elseif($optionType == "file"):?>
					<?$val = unserialize(Option::get(self::MODULE_ID, $optionCode, serialize(array()), $optionsSiteID));

					$arOption['MULTIPLE'] = 'N';
					if($optionCode == 'LOGO_IMAGE'){
						$arOption['WIDTH'] = 394;
						$arOption['HEIGHT'] = 140;
					}
					elseif($optionCode == 'FAVICON_IMAGE'){
						$arOption['WIDTH'] = 16;
						$arOption['HEIGHT'] = 16;
					}
					elseif($optionCode == 'APPLE_TOUCH_ICON_IMAGE'){
						$arOption['WIDTH'] = 180;
						$arOption['HEIGHT'] = 180;
					}
					self::__ShowFilePropertyField($optionCode."_".$optionsSiteID, $arOption, $val);?>
				<?elseif($optionType === 'includefile'):?>
					<?
					if(!is_array($arOption['INCLUDEFILE'])){
						$arOption['INCLUDEFILE'] = array($arOption['INCLUDEFILE']);
					}
					foreach($arOption['INCLUDEFILE'] as $includefile){
						$includefile = str_replace('//', '/', str_replace('#SITE_DIR#', $arTab['SITE_DIR'].'/', $includefile));
						if(strpos($includefile, '#') === false){
							$template = (isset($arOption['TEMPLATE']) && strlen($arOption['TEMPLATE']) ? 'include_area.php' : $arOption['TEMPLATE']);
							$href = (!strlen($includefile) ? "javascript:;" : "javascript: new BX.CAdminDialog({'content_url':'/bitrix/admin/public_file_edit.php?site=".$arTab['SITE_ID']."&bxpublic=Y&from=includefile&templateID=".TEMPLATE_NAME."&path=".$includefile."&lang=".LANGUAGE_ID."&template=".$template."&subdialog=Y&siteTemplateId=".TEMPLATE_NAME."','width':'1009','height':'503'}).Show();");
							?><a class="adm-btn" href="<?=$href?>" name="<?=htmlspecialcharsbx($optionCode)."_".$optionsSiteID?>" title="<?=GetMessage('OPTIONS_EDIT_BUTTON_TITLE')?>"><?=GetMessage('OPTIONS_EDIT_BUTTON_TITLE')?></a>&nbsp;<?
						}
					}
					?>
				<?endif;?>
			</td>
		<?endif;?>
		<?
	}

	public static function getActualParamsValue($arTab, $arOption, $path){
		$optionList = $arOption['LIST'];
		// get site template
		$arTemplate = self::GetSiteTemplate($arTab['SITE_ID']);
		if($arTemplate && $arTemplate['PATH'])
		{
			if($arPageBlocks = self::GetComponentTemplatePageBlocks($arTemplate['PATH'].$path))
			{
				foreach($arOption['LIST'] as $key_list => $arValue)
				{
					if(isset($arPageBlocks['ELEMENTS'][$key_list]))
						;
					else
						unset($arOption['LIST'][$key_list]);
				}
			}
			$optionList = $arOption['LIST'];
		}
		return $optionList;
	}

	public static function CheckColor($strColor){
		$strColor = substr(str_replace('#', '', $strColor), 0, 6);
		$strColor = base_convert(base_convert($strColor, 16, 2), 2, 16);
		for($i = 0, $l = 6 - (function_exists('mb_strlen') ? mb_strlen($strColor) : strlen($strColor)); $i < $l; ++$i)
			$strColor = '0'.$strColor;
		return $strColor;
	}

	public static function UpdateFrontParametrsValues(){
		$arBackParametrs = self::GetBackParametrsValues(SITE_ID);
		if($arBackParametrs['THEME_SWITCHER'] === 'Y')
		{
			if($_REQUEST && isset($_REQUEST['BASE_COLOR']))
			{
				if($_REQUEST['THEME'] === 'default')
				{
					if(self::$arParametrsList && is_array(self::$arParametrsList))
					{
						foreach(self::$arParametrsList as $blockCode => $arBlock)
						{
							unset($_SESSION['THEME'][SITE_ID]);
							$_SESSION['THEME'][SITE_ID] = null;

							if(isset($_SESSION['THEME_ACTION']))
							{
								unset($_SESSION['THEME_ACTION'][SITE_ID]);
								$_SESSION['THEME_ACTION'][SITE_ID] = null;
							}
						}
					}
					Option::set(self::MODULE_ID, "NeedGenerateCustomTheme", 'Y', SITE_ID);
					Option::set(self::MODULE_ID, 'NeedGenerateCustomThemeBG', 'Y', SITE_ID);
				}
				else
				{
					if(self::$arParametrsList && is_array(self::$arParametrsList))
					{
						foreach(self::$arParametrsList as $blockCode => $arBlock)
						{
							if($arBlock['OPTIONS'] && is_array($arBlock['OPTIONS']))
							{
								foreach($arBlock['OPTIONS'] as $optionCode => $arOption)
								{
									if($arOption['THEME'] === 'Y')
									{
										if(isset($_REQUEST[$optionCode]))
										{
											if($optionCode == 'BASE_COLOR_CUSTOM' || $optionCode == 'CUSTOM_BGCOLOR_THEME')
												$_REQUEST[$optionCode] = self::CheckColor($_REQUEST[$optionCode]);
											
											if($optionCode == 'BASE_COLOR' && $_REQUEST[$optionCode] === 'CUSTOM')
												Option::set(self::MODULE_ID, "NeedGenerateCustomTheme", 'Y', SITE_ID);
											
											if($optionCode == 'CUSTOM_BGCOLOR_THEME' && $_REQUEST[$optionCode] === 'CUSTOM')
												Option::set(self::MODULE_ID, "NeedGenerateCustomThemeBG", 'Y', SITE_ID);

											if(isset($arOption['LIST']))
											{
												if(isset($arOption['LIST'][$_REQUEST[$optionCode]]))
												{
													$_SESSION['THEME'][SITE_ID][$optionCode] = $_REQUEST[$optionCode];
												}
												else
												{
													$_SESSION['THEME'][SITE_ID][$optionCode] = $arOption['DEFAULT'];
												}
											}
											else
											{
												$_SESSION['THEME'][SITE_ID][$optionCode] = $_REQUEST[$optionCode];
											}
											if($optionCode == 'ORDER_VIEW')
												self::ClearSomeComponentsCache(SITE_ID);

											if(isset($arOption['SUB_PARAMS']) && $arOption['SUB_PARAMS']) //nested params
											{

												if($arOption['TYPE'] == 'selectbox' && isset($arOption['LIST']))
												{
													$propValue = $_SESSION['THEME'][SITE_ID][$optionCode];
													if($arOption['SUB_PARAMS'][$propValue])
													{
														foreach($arOption['SUB_PARAMS'][$propValue] as $subkey => $arSubvalue)
														{
															if($_REQUEST[$propValue.'_'.$subkey])
																$_SESSION['THEME'][SITE_ID][$propValue.'_'.$subkey] = $_REQUEST[$propValue.'_'.$subkey];
															else
															{
																if($arSubvalue['TYPE'] == 'checkbox')
																	$_SESSION['THEME'][SITE_ID][$propValue.'_'.$subkey] = 'N';
																else
																	$_SESSION['THEME'][SITE_ID][$propValue.'_'.$subkey] = $arSubvalue['DEFAULT'];
															}
															//set default template index components
															if(isset($arSubvalue['TEMPLATE']) && $arSubvalue['TEMPLATE'])
															{
																
																$code_tmp = $propValue.'_'.$subkey.'_TEMPLATE';
																if($_REQUEST[$code_tmp])
																	$_SESSION['THEME'][SITE_ID][$code_tmp] = $_REQUEST[$code_tmp];
															}															
														}

														//sort order prop for main page
														$param = 'SORT_ORDER_'.$optionCode.'_'.$propValue;
														if(isset($_REQUEST[$param]))
														{
															if($_REQUEST[$param])
																$_SESSION['THEME'][SITE_ID][$param] = $_REQUEST[$param];
															else
																$_SESSION['THEME'][SITE_ID][$param] = '';
														}
													}
												}
											}

											if(isset($arOption['DEPENDENT_PARAMS']) && $arOption['DEPENDENT_PARAMS']) //dependent params
											{
												foreach($arOption['DEPENDENT_PARAMS'] as $key => $arSubOptions)
												{
													if($arSubOptions['THEME'] == 'Y')
													{
														if($_REQUEST[$key])
															$_SESSION['THEME'][SITE_ID][$key] = $_REQUEST[$key];
														else
														{
															if($arSubOptions['TYPE'] == 'checkbox')
															{
																if(isset($_SESSION['THEME_ACTION']) && (isset($_SESSION['THEME_ACTION'][SITE_ID][$key]) && $_SESSION['THEME_ACTION'][SITE_ID][$key]))
																{
																	$_SESSION['THEME'][SITE_ID][$key] = $_SESSION['THEME_ACTION'][SITE_ID][$key];
																	unset($_SESSION['THEME_ACTION'][SITE_ID][$key]);
																}
																else
																	$_SESSION['THEME'][SITE_ID][$key] = 'N';
															}
															else
															{
																if(isset($_SESSION['THEME_ACTION']) && (isset($_SESSION['THEME_ACTION'][SITE_ID][$key]) && $_SESSION['THEME_ACTION'][SITE_ID][$key]))
																{
																	$_SESSION['THEME'][SITE_ID][$key] = $_SESSION['THEME_ACTION'][SITE_ID][$key];
																	unset($_SESSION['THEME_ACTION'][SITE_ID][$key]);
																}
																else
																	$_SESSION['THEME'][SITE_ID][$key] = $arSubOptions['DEFAULT'];
															}
														}
													}
												}
											}

											$bChanged = true;
										}
										else
										{
											if($arOption['TYPE'] == 'checkbox' && !$_REQUEST[$optionCode])
											{
												$_SESSION['THEME'][SITE_ID][$optionCode] = 'N';
												if(isset($arOption['DEPENDENT_PARAMS']) && $arOption['DEPENDENT_PARAMS']) //dependent params save
												{
													foreach($arOption['DEPENDENT_PARAMS'] as $key => $arSubOptions)
													{
														if($arSubOptions['THEME'] == 'Y')
														{
															if(isset($_SESSION['THEME'][SITE_ID][$key]))
																$_SESSION['THEME_ACTION'][SITE_ID][$key] = $_SESSION['THEME'][SITE_ID][$key];
															else
																$_SESSION['THEME_ACTION'][SITE_ID][$key] = $arBackParametrs[$key];
														}
													}
												}
											}

											if(isset($arOption['SUB_PARAMS']) && $arOption['SUB_PARAMS']) //nested params
											{

												if($arOption['TYPE'] == 'selectbox' && isset($arOption['LIST']))
												{
													$propValue = $_SESSION['THEME'][SITE_ID][$optionCode];
													if($arOption['SUB_PARAMS'][$propValue])
													{
														foreach($arOption['SUB_PARAMS'][$propValue] as $subkey => $arSubvalue)
														{

															if($_REQUEST[$propValue.'_'.$subkey])
																$_SESSION['THEME'][SITE_ID][$propValue.'_'.$subkey] = $_REQUEST[$propValue.'_'.$subkey];
															else
																$_SESSION['THEME'][SITE_ID][$propValue.'_'.$subkey] = 'N';
														}
													}
												}

											}
										}
									}
								}
							}
						}
					}
					if(isset($_REQUEST["backurl"]) && $_REQUEST["backurl"])
						LocalRedirect($_REQUEST["backurl"]);
				}
				if(isset($_REQUEST["BASE_COLOR"]) && $_REQUEST["BASE_COLOR"])
					LocalRedirect($_SERVER["HTTP_REFERER"]);
			}
		}
		else
		{
			unset($_SESSION['THEME'][SITE_ID]);
			if(isset($_SESSION['THEME_ACTION'][SITE_ID]))
				unset($_SESSION['THEME_ACTION'][SITE_ID]);
		}
	}

	public static function GenerateMinCss($file){
		if(file_exists($file))
		{
			$content = @file_get_contents($file);
			if($content !== false)
			{
				$content = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $content);
				$content = str_replace(array("\r\n", "\r", "\n", "\t"), '', $content);
				$content = preg_replace('/ {2,}/', ' ', $content);
				$content = str_replace(array(' : ', ': ', ' :',), ':', $content);
				$content = str_replace(array(' ; ', '; ', ' ;'), ';', $content);
				$content = str_replace(array(' > ', '> ', ' >'), '>', $content);
				$content = str_replace(array(' + ', '+ ', ' +'), '+', $content);
				$content = str_replace(array(' { ', '{ ', ' {'), '{', $content);
				$content = str_replace(array(' } ', '} ', ' }'), '}', $content);
				$content = str_replace(array(' ( ', '( ', ' ('), '(', $content);
				$content = str_replace(array(' ) ', ') ', ' )'), ')', $content);
				$content = str_replace('and(', 'and (', $content);
				$content = str_replace(')li', ') li', $content);
				$content = str_replace(').', ') .', $content);
				@file_put_contents(dirname($file).'/'.basename($file, '.css').'.min.css', $content);
			}
		}
		return false;
	}

	public static function GenerateThemes(){
		$arBackParametrs = self::GetBackParametrsValues(SITE_ID);
		$arBaseColors = self::$arParametrsList['MAIN']['OPTIONS']['BASE_COLOR']['LIST'];
		$arBaseBgColors = self::$arParametrsList['MAIN']['OPTIONS']['BGCOLOR_THEME']['LIST'];
		$isCustomThemeBG = $_SESSION['THEME'][SITE_ID]['BGCOLOR_THEME'] === 'CUSTOM';
		$isCustomTheme = $_SESSION['THEME'][SITE_ID]['BASE_COLOR'] === 'CUSTOM';

		$bNeedGenerateAllThemes = Option::get(self::MODULE_ID, 'NeedGenerateThemes', 'N', SITE_ID) === 'Y';
		$bNeedGenerateCustomTheme = Option::get(self::MODULE_ID, 'NeedGenerateCustomTheme', 'N', SITE_ID) === 'Y';
		$bNeedGenerateCustomThemeBG = Option::get(self::MODULE_ID, 'NeedGenerateCustomThemeBG', 'N', SITE_ID) === 'Y';

		$baseColorCustom = $baseColorBGCustom = '';
		$lastGeneratedBaseColorCustom = Option::get(self::MODULE_ID, 'LastGeneratedBaseColorCustom', '', SITE_ID);
		if(isset(self::$arParametrsList['MAIN']['OPTIONS']['BASE_COLOR_CUSTOM']))
		{
			$baseColorCustom = $arBackParametrs['BASE_COLOR_CUSTOM'] = str_replace('#', '', $arBackParametrs['BASE_COLOR_CUSTOM']);
			if($arBackParametrs['THEME_SWITCHER'] === 'Y' && strlen($_SESSION['THEME'][SITE_ID]['BASE_COLOR_CUSTOM']))
				$baseColorCustom = $_SESSION['THEME'][SITE_ID]['BASE_COLOR_CUSTOM'] = str_replace('#', '', $_SESSION['THEME'][SITE_ID]['BASE_COLOR_CUSTOM']);
		}

		$lastGeneratedBaseColorBGCustom = Option::get(self::MODULE_ID, 'LastGeneratedBaseColorBGCustom', '', SITE_ID);
		if(isset(self::$arParametrsList['MAIN']['OPTIONS']['CUSTOM_BGCOLOR_THEME']))
		{
			$baseColorBGCustom = $arBackParametrs['CUSTOM_BGCOLOR_THEME'] = str_replace('#', '', $arBackParametrs['CUSTOM_BGCOLOR_THEME']);
			if($arBackParametrs['THEME_SWITCHER'] === 'Y' && strlen($_SESSION['THEME'][SITE_ID]['CUSTOM_BGCOLOR_THEME']))
				$baseColorBGCustom = $_SESSION['THEME'][SITE_ID]['CUSTOM_BGCOLOR_THEME'] = str_replace('#', '', $_SESSION['THEME'][SITE_ID]['CUSTOM_BGCOLOR_THEME']);
		}

		$bGenerateAll = self::devMode || $bNeedGenerateAllThemes;
		$bGenerateCustom = $bGenerateAll || $bNeedGenerateCustomTheme || ($arBackParametrs['THEME_SWITCHER'] === 'Y' && $isCustomTheme && strlen($baseColorCustom) && $baseColorCustom != $lastGeneratedBaseColorCustom);
		$bGenerateCustomBG = $bGenerateAll || $bNeedGenerateCustomThemeBG || ($arBackParametrs['THEME_SWITCHER'] === 'Y' && $isCustomThemeBG && strlen($baseColorBGCustom) && $baseColorBGCustom != $lastGeneratedBaseColorBGCustom);

		if($arBaseColors && is_array($arBaseColors) && ($bGenerateAll || $bGenerateCustom || $bGenerateCustomBG)){
			if(!class_exists('lessc')){
				include_once 'lessc.inc.php';
			}
			$less = new lessc;
			try{
				foreach($arBaseColors as $colorCode => $arColor)
				{
					if(($bCustom = ($colorCode == 'CUSTOM')) && $bGenerateCustom)
					{
						if(strlen($baseColorCustom))
						{
							$less->setVariables(array('bcolor' => (strlen($baseColorCustom) ? '#'.$baseColorCustom : $arBaseColors[self::$arParametrsList['MAIN']['OPTIONS']['BASE_COLOR']['DEFAULT']]['COLOR'])));
						}
					}
					elseif($bGenerateAll)
					{
						$less->setVariables(array('bcolor' => $arColor['COLOR']));
					}

					if($bGenerateAll || ($bCustom && $bGenerateCustom))
					{
						if(defined('SITE_TEMPLATE_PATH'))
						{
							$themeDirPath = $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/themes/'.$colorCode.($colorCode !== 'CUSTOM' ? '' : '_'.SITE_ID).'/';
							if(!is_dir($themeDirPath)) mkdir($themeDirPath, 0755, true);
								$output = $less->compileFile(__DIR__.'/../../css/colors.less', $themeDirPath.'colors.css');
							if($output)
							{
								if($bCustom)
									Option::set(self::MODULE_ID, 'LastGeneratedBaseColorCustom', $baseColorCustom, SITE_ID);
								
								self::GenerateMinCss($themeDirPath.'colors.css');
							}
						}
					}
				}
				foreach($arBaseBgColors as $colorCode => $arColor)
				{
					if(($bCustom = ($colorCode == 'CUSTOM')) && $bGenerateCustomBG)
					{
						if(strlen($baseColorBGCustom))
						{
							$footerBgColor = $baseColorBGCustom === "FFFFFF" ? "F6F6F7" : $baseColorBGCustom;
							$less->setVariables(array('bcolor' => (strlen($baseColorBGCustom) ? '#'.$baseColorBGCustom : $arBaseBgColors[self::$arParametrsList['MAIN']['OPTIONS']['BGCOLOR_THEME']['DEFAULT']]['COLOR']), 'fcolor' => '#'.$footerBgColor));
						}
					}
					elseif($bGenerateAll)
					{
						$less->setVariables(array('bcolor' => $arColor['COLOR'], 'fcolor' => $arColor['COLOR']));
					}

					if($bGenerateAll || ($bCustom && $bGenerateCustomBG))
					{
						if(defined('SITE_TEMPLATE_PATH'))
						{
							$themeDirPath = $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/bg_color/'.strToLower($colorCode.($colorCode !== 'CUSTOM' ? '' : '_'.SITE_ID)).'/';
							if(!is_dir($themeDirPath))
								mkdir($themeDirPath, 0755, true);
							$output = $less->compileFile(__DIR__.'/../../css/bgtheme.less', $themeDirPath.'bgcolors.css');
							if($output)
							{
								if($bCustom)
									Option::set(self::MODULE_ID, 'LastGeneratedBaseColorBGCustom', $baseColorBGCustom, SITE_ID);
								
								self::GenerateMinCss($themeDirPath.'bgcolors.css');
							}
						}
					}
				}
			}
			catch(exception $e){
				echo 'Fatal error: '.$e->getMessage();
				die();
			}

			if($bNeedGenerateAllThemes)
				Option::set(self::MODULE_ID, "NeedGenerateThemes", 'N', SITE_ID);
			if($bNeedGenerateCustomTheme)
				Option::set(self::MODULE_ID, "NeedGenerateCustomTheme", 'N', SITE_ID);
			if($bNeedGenerateCustomThemeBG)
				Option::set(self::MODULE_ID, "NeedGenerateCustomThemeBG", 'N', SITE_ID);
		}
	}

	public static function sendAsproBIAction($action = 'unknown') {
		if(CModule::IncludeModule('main')){

		}
	}

	public static function correctInstall(){
		if(CModule::IncludeModule('main')){
			if(Option::get(self::MODULE_ID, 'WIZARD_DEMO_INSTALLED') == 'Y'){
				require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/classes/general/wizard.php');
				@set_time_limit(0);
				if(!CWizardUtil::DeleteWizard(self::PARTNER_NAME.':'.self::SOLUTION_NAME)){
					if(!DeleteDirFilesEx($_SERVER['DOCUMENT_ROOT'].'/bitrix/wizards/'.self::PARTNER_NAME.'/'.self::SOLUTION_NAME.'/')){
						self::removeDirectory($_SERVER['DOCUMENT_ROOT'].'/bitrix/wizards/'.self::PARTNER_NAME.'/'.self::SOLUTION_NAME.'/');
					}
				}

				UnRegisterModuleDependences('main', 'OnBeforeProlog', self::MODULE_ID, __CLASS__, 'correctInstall');
				Option::set(self::MODULE_ID, 'WIZARD_DEMO_INSTALLED', 'N');
			}
		}
	}

	protected function getBitrixEdition(){
		$edition = 'UNKNOWN';

		if(CModule::IncludeModule('main')){
			include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/classes/general/update_client.php');
			$arUpdateList = CUpdateClient::GetUpdatesList(($errorMessage = ''), 'ru', 'Y');
			if(array_key_exists('CLIENT', $arUpdateList) && $arUpdateList['CLIENT'][0]['@']['LICENSE']){
				$edition = $arUpdateList['CLIENT'][0]['@']['LICENSE'];
			}
		}

		return $edition;
	}

	protected function removeDirectory($dir){
		if($objs = glob($dir.'/*')){
			foreach($objs as $obj){
				if(is_dir($obj)){
					self::removeDirectory($obj);
				}
				else{
					if(!@unlink($obj)){
						if(chmod($obj, 0777)){
							@unlink($obj);
						}
					}
				}
			}
		}
		if(!@rmdir($dir)){
			if(chmod($dir, 0777)){
				@rmdir($dir);
			}
		}
	}

	public static function get_file_info($fileID){
		$file = CFile::GetFileArray($fileID);
		$pos = strrpos($file['FILE_NAME'], '.');
		$file['FILE_NAME'] = substr($file['FILE_NAME'], $pos);
		if(!$file['FILE_SIZE']){
			// bx bug in some version
			$file['FILE_SIZE'] = filesize($_SERVER['DOCUMENT_ROOT'].$file['SRC']);
		}
		$frm = explode('.', $file['FILE_NAME']);
		$frm = $frm[1];
		
		switch($frm){
			case 'doc':
				$type = 'doc';
				break;
			case 'docx':
				$type = 'doc';
				break;
			case 'xls':
				$type = 'xls';
				break;
			case 'xlsx':
				$type = 'xlsx';
				break;
			case 'jpg':
				$type = 'jpg';
				break;
			case 'jpeg':
				$type = 'jpeg';
				break;
			case 'png':
				$type = 'png';
				break;
			case 'ppt':
				$type = 'ppt';
				break;
			case 'tif':
				$type = 'tif';
				break;
			case 'txt':
				$type = 'txt';
				break;
			case 'pdf':
				$type = 'pdf';
				break;
			default:
				$type = '';
				break;
		}
		
		return $arr = array('TYPE' => $type, 'FILE_SIZE' => $file['FILE_SIZE'], 'SRC' => $file['SRC'], 'DESCRIPTION' => $file['DESCRIPTION'], 'ORIGINAL_NAME' => $file['ORIGINAL_NAME']);
	}

	public static function filesize_format($filesize){
		$formats = array(GetMessage('CT_NAME_b'), GetMessage('CT_NAME_KB'), GetMessage('CT_NAME_MB'), GetMessage('CT_NAME_GB'), GetMessage('CT_NAME_TB'));
		$format = 0;
		while($filesize > 1024 && count($formats) != ++$format){
			$filesize = round($filesize / 1024, 1);
		}
		$formats[] = GetMessage('CT_NAME_TB');
		return $filesize.' '.$formats[$format];
	}

	public static function getChilds($input, &$start = 0, $level = 0){
		$arIblockItemsMD5 = array();

		if(!$level){
			$lastDepthLevel = 1;
			if($input && is_array($input)){
				foreach($input as $i => $arItem){
					if($arItem['DEPTH_LEVEL'] > $lastDepthLevel){
						if($i > 0){
							$input[$i - 1]['IS_PARENT'] = 1;
						}
					}
					$lastDepthLevel = $arItem['DEPTH_LEVEL'];
				}
			}
		}

		$childs = array();
		$count = count($input);
		for($i = $start; $i < $count; ++$i){
			$item = $input[$i];
			if(!isset($item)){
				continue;
			}
			if($level > $item['DEPTH_LEVEL'] - 1){
				break;
			}
			else{
				if(!empty($item['IS_PARENT'])){
					$i++;
					$item['CHILD'] = self::getChilds($input, $i, $level + 1);
					$i--;
				}

				$childs[] = $item;
			}
		}
		$start = $i;

		if(is_array($childs)){
			foreach($childs as $j => $item){
				if($item['PARAMS']){
					$md5 = md5($item['TEXT'].$item['LINK'].$item['SELECTED'].$item['PERMISSION'].$item['ITEM_TYPE'].$item['IS_PARENT'].serialize($item['ADDITIONAL_LINKS']).serialize($item['PARAMS']));

					// check if repeat in one section chids list
					if(isset($arIblockItemsMD5[$md5][$item['PARAMS']['DEPTH_LEVEL']])){
						if(isset($arIblockItemsMD5[$md5][$item['PARAMS']['DEPTH_LEVEL']][$level]) || ($item['DEPTH_LEVEL'] === 1 && !$level)){
							unset($childs[$j]);
							continue;
						}
					}
					if(!isset($arIblockItemsMD5[$md5])){
						$arIblockItemsMD5[$md5] = array($item['PARAMS']['DEPTH_LEVEL'] => array($level => true));
					}
					else{
						$arIblockItemsMD5[$md5][$item['PARAMS']['DEPTH_LEVEL']][$level] = true;
					}
				}
			}
		}

		if(!$level){
			$arIblockItemsMD5 = array();
		}

		return $childs;
	}

	public static function sort_sections_by_field($arr, $name){
		$count = count($arr);
		for($i = 0; $i < $count; $i++){
			for($j = 0; $j < $count; $j++){
				if(strtoupper($arr[$i]['NAME']) < strtoupper($arr[$j]['NAME'])){
					$tmp = $arr[$i];
					$arr[$i] = $arr[$j];
					$arr[$j] = $tmp;
				}
			}
		}
		return $arr;
	}

	public static function getIBItems($prop, $checkNoImage){
		$arID = array();
		$arItems = array();
		$arAllItems = array();

		if($prop && is_array($prop)){
			foreach($prop as $reviewID){
				$arID[]=$reviewID;
			}
		}
		if($checkNoImage) $empty=false;
		$arItems = self::cacheElement(false, array('ID' => $arID, 'ACTIVE' => 'Y'));
		if($arItems && is_array($arItems)){
			foreach($arItems as $key => $arItem){
				if($checkNoImage){
					if(empty($arProject['PREVIEW_PICTURE'])){
						$empty=true;
					}
				}
				$arAllItems['ITEMS'][$key] = $arItem;
				if($arItem['DETAIL_PICTURE']) $arAllItems['ITEMS'][$key]['DETAIL'] = CFile::GetFileArray( $arItem['DETAIL_PICTURE'] );
				if($arItem['PREVIEW_PICTURE']) $arAllItems['ITEMS'][$key]['PREVIEW'] = CFile::ResizeImageGet( $arItem['PREVIEW_PICTURE'], array('width' => 425, 'height' => 330), BX_RESIZE_IMAGE_EXACT, true );
			}
		}
		if($checkNoImage) $arAllItems['NOIMAGE'] = 'YES';

		return $arAllItems;
	}

	public static function showBgImage($siteID, $arTheme){
		global $APPLICATION;
		if($arTheme['SHOW_BG_BLOCK'] == 'Y')
		{
			$arBanner = self::checkBgImage($siteID);
			// print_r($arBanner); 
			// die();
			if($arBanner)
			{
				$image = CFile::GetFileArray($arBanner['PREVIEW_PICTURE']);
				$class = 'bg_image_site opacity1';
				if($arBanner['PROPERTY_FIXED_BANNER_VALUE'] == 'Y')
					$class .= ' fixed';
				if(self::IsMainPage())
					$class .= ' opacity';
				echo '<span class=\''.$class.'\' style=\'background-image:url('.$image["SRC"].');\'></span>';
			}
		}
		return true;
	}

	public static function checkBgImage($siteID){
		global $APPLICATION;
		static $arBanner;
		if($arBanner === NULL)
		{
			$arItems = CCache::CIBLockElement_GetList(array('SORT' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag(CCache::$arIBlocks[$siteID]['aspro_priority_content']['aspro_priority_bg_images'][0]))), array('IBLOCK_ID' => CCache::$arIBlocks[$siteID]['aspro_priority_content']['aspro_priority_bg_images'][0], 'ACTIVE'=>'Y'), false, false, array('ID', 'NAME', 'PREVIEW_PICTURE', 'PROPERTY_URL', 'PROPERTY_FIXED_BANNER', 'PROPERTY_URL_NOT_SHOW'));
			$arBanner = array();

			if($arItems)
			{
				$curPage = $APPLICATION->GetCurPage();
				foreach($arItems as $arItem)
				{
					if(isset($arItem['PROPERTY_URL_VALUE']) && $arItem['PREVIEW_PICTURE'])
					{
						if(!is_array($arItem['PROPERTY_URL_VALUE']))
							$arItem['PROPERTY_URL_VALUE'] = array($arItem['PROPERTY_URL_VALUE']);
						if($arItem['PROPERTY_URL_VALUE'])
						{
							foreach($arItem['PROPERTY_URL_VALUE'] as $url)
							{
								$url=str_replace('SITE_DIR', SITE_DIR, $url);
								if($arItem['PROPERTY_URL_NOT_SHOW_VALUE'])
								{
									if(!is_array($arItem['PROPERTY_URL_NOT_SHOW_VALUE']))
										$arItem['PROPERTY_URL_NOT_SHOW_VALUE'] = array($arItem['PROPERTY_URL_NOT_SHOW_VALUE']);
									foreach($arItem['PROPERTY_URL_NOT_SHOW_VALUE'] as $url_not_show)
									{
										$url_not_show=str_replace('SITE_DIR', SITE_DIR, $url_not_show);
										if(CSite::InDir($url_not_show))
											break 2;
									}
									foreach($arItem['PROPERTY_URL_NOT_SHOW_VALUE'] as $url_not_show)
									{
										$url_not_show = str_replace('SITE_DIR', SITE_DIR, $url_not_show);
										if(CSite::InDir($url_not_show))
										{
											// continue;
											break 2;
										}
										else
										{
											if(CSite::InDir($url))
											{
												$arBanner = $arItem;
												break;
											}
										}
									}
								}
								else
								{
									if(CSite::InDir($url))
									{
										$arBanner = $arItem;
										break;
									}
								}
							}
						}
					}
				}
			}
		}
		return $arBanner;
	}

	public static function getSectionChilds($PSID, &$arSections, &$arSectionsByParentSectionID, &$arItemsBySectionID, &$aMenuLinksExt){
		if($arSections && is_array($arSections)){
			foreach($arSections as $arSection){
				if($arSection['IBLOCK_SECTION_ID'] == $PSID){
					$arItem = array($arSection['NAME'], $arSection['SECTION_PAGE_URL'], array(), array('FROM_IBLOCK' => 1, 'DEPTH_LEVEL' => $arSection['DEPTH_LEVEL'], 'PICTURE' => $arSection['PICTURE'], 'ICON' => $arSection['UF_ICON'], 'ICON_BACKGROUND' => $arSection['UF_BACKGROUND']));
					$arItem[3]['IS_PARENT'] = (isset($arItemsBySectionID[$arSection['ID']]) || isset($arSectionsByParentSectionID[$arSection['ID']]) ? 1 : 0);
					$aMenuLinksExt[] = $arItem;
					if($arItem[3]['IS_PARENT']){
						// subsections
						self::getSectionChilds($arSection['ID'], $arSections, $arSectionsByParentSectionID, $arItemsBySectionID, $aMenuLinksExt);
						// section elements
						if($arItemsBySectionID[$arSection['ID']] && is_array($arItemsBySectionID[$arSection['ID']])){
							foreach($arItemsBySectionID[$arSection['ID']] as $arItem){
								if(is_array($arItem['DETAIL_PAGE_URL'])){
									if(isset($arItem['CANONICAL_PAGE_URL'])){
										$arItem['DETAIL_PAGE_URL'] = $arItem['CANONICAL_PAGE_URL'];
									}
									else{
										$arItem['DETAIL_PAGE_URL'] = $arItem['DETAIL_PAGE_URL'][key($arItem['DETAIL_PAGE_URL'])];
									}
								}
								$aMenuLinksExt[] = array($arItem['NAME'], $arItem['DETAIL_PAGE_URL'], array(), array('FROM_IBLOCK' => 1, 'DEPTH_LEVEL' => ($arSection['DEPTH_LEVEL'] + 1), 'IS_ITEM' => 1));
							}
						}
					}
				}
			}
		}
	}

	public static function isChildsSelected($arChilds){
		if($arChilds && is_array($arChilds)){
			foreach($arChilds as $arChild){
				if($arChild['SELECTED']){
					return $arChild;
				}
			}
		}
		return false;
	}

	public static function SetJSOptions(){
		global $arSite;
		$arFrontParametrs = CPriority::GetFrontParametrsValues(SITE_ID);
		$tmp = $arFrontParametrs['DATE_FORMAT'];
		$DATE_MASK = ($tmp == 'DOT' ? 'd.m.y' : ($tmp == 'HYPHEN' ? 'd-m-y' : ($tmp == 'SPACE' ? 'd m y' : ($tmp == 'SLASH' ? 'd/m/y' : 'd:m:y'))));
		$VALIDATE_DATE_MASK = ($tmp == 'DOT' ? '^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{4}$' : ($tmp == 'HYPHEN' ? '^[0-9]{1,2}\-[0-9]{1,2}\-[0-9]{4}$' : ($tmp == 'SPACE' ? '^[0-9]{1,2} [0-9]{1,2} [0-9]{4}$' : ($tmp == 'SLASH' ? '^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$' : '^[0-9]{1,2}\:[0-9]{1,2}\:[0-9]{4}$'))));
		$DATE_PLACEHOLDER = ($tmp == 'DOT' ? GetMessage('DATE_FORMAT_DOT') : ($tmp == 'HYPHEN' ? GetMessage('DATE_FORMAT_HYPHEN') : ($tmp == 'SPACE' ? GetMessage('DATE_FORMAT_SPACE') : ($tmp == 'SLASH' ? GetMessage('DATE_FORMAT_SLASH') : GetMessage('DATE_FORMAT_COLON')))));
		$DATETIME_MASK = ($tmp == 'DOT' ? 'd.m.y' : ($tmp == 'HYPHEN' ? 'd-m-y' : ($tmp == 'SPACE' ? 'd m y' : ($tmp == 'SLASH' ? 'd/m/y' : 'd:m:y')))).' h:s';
		$DATETIME_PLACEHOLDER = ($tmp == 'DOT' ? GetMessage('DATE_FORMAT_DOT') : ($tmp == 'HYPHEN' ? GetMessage('DATE_FORMAT_HYPHEN') : ($tmp == 'SPACE' ? GetMessage('DATE_FORMAT_SPACE') : ($tmp == 'SLASH' ? GetMessage('DATE_FORMAT_SLASH') : GetMessage('DATE_FORMAT_COLON'))))).' '.GetMessage('TIME_FORMAT_COLON');
		$VALIDATE_DATETIME_MASK = ($tmp == 'DOT' ? '^[0-9]{1,2}\.[0-9]{1,2}\.[0-9]{4} [0-9]{1,2}\:[0-9]{1,2}$' : ($tmp == 'HYPHEN' ? '^[0-9]{1,2}\-[0-9]{1,2}\-[0-9]{4} [0-9]{1,2}\:[0-9]{1,2}$' : ($tmp == 'SPACE' ? '^[0-9]{1,2} [0-9]{1,2} [0-9]{4} [0-9]{1,2}\:[0-9]{1,2}$' : ($tmp == 'SLASH' ? '^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4} [0-9]{1,2}\:[0-9]{1,2}$' : '^[0-9]{1,2}\:[0-9]{1,2}\:[0-9]{4} [0-9]{1,2}\:[0-9]{1,2}$'))));

		//get domains
		$arSite = CSite::GetByID(SITE_ID)->Fetch();
		$arDomains = array();
		if(strlen($arSite['DOMAINS']) > 1)
			$arDomains = explode("\n", $arSite['DOMAINS']);
		if($arSite['SERVER_NAME'])
			$arDomains[] = $arSite['SERVER_NAME'];
		if($arDomains)
			array_unique($arDomains);
		$strListDomains = implode(',', $arDomains);
		
		?>
		<script>
		var arBasketItems = {};
		var arPriorityOptions = ({
			'SITE_DIR' : '<?=SITE_DIR?>',
			'SITE_ID' : '<?=SITE_ID?>',
			'SITE_TEMPLATE_PATH' : '<?=SITE_TEMPLATE_PATH?>',
			//'SITE_ADDRESS' : "<?=$arSite['SERVER_NAME'];?>",
			'SITE_ADDRESS' : "<?=($strListDomains ? CUtil::PhpToJsObject($strListDomains) : $strListDomains);?>",
			'THEME' : ({
				'THEME_SWITCHER' : '<?=$arFrontParametrs['THEME_SWITCHER']?>',
				'BASE_COLOR' : '<?=$arFrontParametrs['BASE_COLOR']?>',
				'BASE_COLOR_CUSTOM' : '<?=$arFrontParametrs['BASE_COLOR_CUSTOM']?>',
				'TOP_MENU' : '<?=$arFrontParametrs['TOP_MENU']?>',
				'LOGO_IMAGE' : '<?=$arFrontParametrs['LOGO_IMAGE']?>',
				'LOGO_IMAGE_LIGHT' : '<?=$arFrontParametrs['LOGO_IMAGE_LIGHT']?>',
				'TOP_MENU_FIXED' : '<?=$arFrontParametrs['TOP_MENU_FIXED']?>',
				'COLORED_LOGO' : '<?=$arFrontParametrs['COLORED_LOGO']?>',
				'SIDE_MENU' : '<?=$arFrontParametrs['SIDE_MENU']?>',
				'SCROLLTOTOP_TYPE' : '<?=$arFrontParametrs['SCROLLTOTOP_TYPE']?>',
				'SCROLLTOTOP_POSITION' : '<?=$arFrontParametrs['SCROLLTOTOP_POSITION']?>',
				'CAPTCHA_FORM_TYPE' : '<?=$arFrontParametrs['CAPTCHA_FORM_TYPE']?>',
				'PHONE_MASK' : '<?=$arFrontParametrs['PHONE_MASK']?>',
				'VALIDATE_PHONE_MASK' : '<?=$arFrontParametrs['VALIDATE_PHONE_MASK']?>',
				'DATE_MASK' : '<?=$DATE_MASK?>',
				'DATE_PLACEHOLDER' : '<?=$DATE_PLACEHOLDER?>',
				'VALIDATE_DATE_MASK' : '<?=($VALIDATE_DATE_MASK)?>',
				'DATETIME_MASK' : '<?=$DATETIME_MASK?>',
				'DATETIME_PLACEHOLDER' : '<?=$DATETIME_PLACEHOLDER?>',
				'VALIDATE_DATETIME_MASK' : '<?=($VALIDATE_DATETIME_MASK)?>',
				'VALIDATE_FILE_EXT' : '<?=$arFrontParametrs['VALIDATE_FILE_EXT']?>',
				'SOCIAL_VK' : '<?=$arFrontParametrs['SOCIAL_VK']?>',
				'SOCIAL_FACEBOOK' : '<?=$arFrontParametrs['SOCIAL_FACEBOOK']?>',
				'SOCIAL_TWITTER' : '<?=$arFrontParametrs['SOCIAL_TWITTER']?>',
				'SOCIAL_YOUTUBE' : '<?=$arFrontParametrs['SOCIAL_YOUTUBE']?>',
				'SOCIAL_ODNOKLASSNIKI' : '<?=$arFrontParametrs['SOCIAL_ODNOKLASSNIKI']?>',
				'SOCIAL_GOOGLEPLUS' : '<?=$arFrontParametrs['SOCIAL_GOOGLEPLUS']?>',
				'BANNER_WIDTH' : '<?=$arFrontParametrs['BANNER_WIDTH']?>',
				'TEASERS_INDEX' : '<?=$arFrontParametrs[$arFrontParametrs['INDEX_TYPE'].'_TEASERS_INDEX']?>',
				'CATALOG_INDEX' : '<?=$arFrontParametrs[$arFrontParametrs['INDEX_TYPE'].'_CATALOG_INDEX']?>',
				'PORTFOLIO_INDEX' : '<?=$arFrontParametrs[$arFrontParametrs['INDEX_TYPE'].'_PORTFOLIO_INDEX']?>',
				'INSTAGRAMM_INDEX' : '<?=(isset($arFrontParametrs[$arFrontParametrs['INDEX_TYPE'].'_INSTAGRAMM_INDEX']) ? $arFrontParametrs[$arFrontParametrs['INDEX_TYPE'].'_INSTAGRAMM_INDEX'] : 'Y')?>',
				'BIGBANNER_ANIMATIONTYPE' : '<?=$arFrontParametrs['BIGBANNER_ANIMATIONTYPE']?>',
				'BIGBANNER_SLIDESSHOWSPEED' : '<?=$arFrontParametrs['BIGBANNER_SLIDESSHOWSPEED']?>',
				'BIGBANNER_ANIMATIONSPEED' : '<?=$arFrontParametrs['BIGBANNER_ANIMATIONSPEED']?>',
				'PARTNERSBANNER_SLIDESSHOWSPEED' : '<?=$arFrontParametrs['PARTNERSBANNER_SLIDESSHOWSPEED']?>',
				'PARTNERSBANNER_ANIMATIONSPEED' : '<?=$arFrontParametrs['PARTNERSBANNER_ANIMATIONSPEED']?>',
				'ORDER_VIEW' : '<?=$arFrontParametrs['ORDER_VIEW']?>',
				'ORDER_BASKET_VIEW' : '<?=$arFrontParametrs['ORDER_BASKET_VIEW']?>',
				'URL_BASKET_SECTION' : '<?=$arFrontParametrs['URL_BASKET_SECTION']?>',
				'URL_ORDER_SECTION' : '<?=$arFrontParametrs['URL_ORDER_SECTION']?>',
				'PAGE_WIDTH' : '<?=$arFrontParametrs['PAGE_WIDTH']?>',
				'PAGE_CONTACTS' : '<?=$arFrontParametrs['PAGE_CONTACTS']?>',
				'HEADER_TYPE' : '<?=$arFrontParametrs['HEADER_TYPE']?>',
				'HEADER_TOP_LINE' : '<?=$arFrontParametrs['HEADER_TOP_LINE']?>',
				'HEADER_FIXED' : '<?=$arFrontParametrs['HEADER_FIXED']?>',
				'HEADER_MOBILE' : '<?=$arFrontParametrs['HEADER_MOBILE']?>',
				'HEADER_MOBILE_MENU' : '<?=$arFrontParametrs['HEADER_MOBILE_MENU']?>',
				'HEADER_MOBILE_MENU_SHOW_TYPE' : '<?=$arFrontParametrs['HEADER_MOBILE_MENU_SHOW_TYPE']?>',
				'TYPE_SEARCH' : '<?=$arFrontParametrs['TYPE_SEARCH']?>',
				'PAGE_TITLE' : '<?=$arFrontParametrs['PAGE_TITLE']?>',
				'INDEX_TYPE' : '<?=$arFrontParametrs['INDEX_TYPE']?>',
				'FOOTER_TYPE' : '<?=$arFrontParametrs['FOOTER_TYPE']?>',
				'FOOTER_TYPE' : '<?=$arFrontParametrs['FOOTER_TYPE']?>',
				'PRINT_BUTTON' : '<?=$arFrontParametrs['PRINT_BUTTON']?>',
				'SHOW_SMARTFILTER' : '<?=$arFrontParametrs['SHOW_SMARTFILTER']?>',
				'LICENCE_CHECKED' : '<?=$arFrontParametrs['LICENCE_CHECKED']?>',
				'FILTER_VIEW' : '<?=$arFrontParametrs['FILTER_VIEW']?>',
				'YA_GOLAS' : '<?=$arFrontParametrs['YA_GOLAS']?>',
				'YA_COUNTER_ID' : '<?=$arFrontParametrs['YA_COUNTER_ID']?>',
				'USE_FORMS_GOALS' : '<?=$arFrontParametrs['USE_FORMS_GOALS']?>',
				'USE_SALE_GOALS' : '<?=$arFrontParametrs['USE_SALE_GOALS']?>',
				'USE_DEBUG_GOALS' : '<?=$arFrontParametrs['USE_DEBUG_GOALS']?>',
				'IS_BASKET_PAGE' : '<?=CPriority::IsBasketPage($arFrontParametrs["URL_BASKET_SECTION"])?>',
				'IS_ORDER_PAGE' : '<?=CPriority::IsBasketPage($arFrontParametrs["URL_ORDER_SECTION"])?>',
				'FORM_TYPE' : '<?=$arFrontParametrs["FORM_TYPE"]?>',
				'INSTAGRAMM_INDEX_TEMPLATE' : '<?=$arFrontParametrs[$arFrontParametrs['INDEX_TYPE'].'_INSTAGRAMM_INDEX_TEMPLATE'];?>',
			})
		});
		</script>
		<?
		Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID('options-block');
		self::checkBasketItems();
		Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID('options-block', '');
	}

	public static function __ShowFilePropertyField($name, $arOption, $values){
		global $bCopy, $historyId;
		if(!is_array($values)){
			$values = array($values);
		}

		if($bCopy || empty($values)){
			$values = array('n0' => 0);
		}

		$optionWidth = $arOption['WIDTH'] ? $arOption['WIDTH'] : 200;
		$optionHeight = $arOption['HEIGHT'] ? $arOption['HEIGHT'] : 100;


		if($arOption['MULTIPLE'] == 'N'){
			foreach($values as $key => $val){
				if(is_array($val)){
					$file_id = $val['VALUE'];
				}
				else{
					$file_id = $val;
				}
				if($historyId > 0){
					echo CFileInput::Show($name.'['.$key.']', $file_id,
						array(
							'IMAGE' => $arOption['IMAGE'],
							'PATH' => 'Y',
							'FILE_SIZE' => 'Y',
							'DIMENSIONS' => 'Y',
							'IMAGE_POPUP' => 'Y',
							'MAX_SIZE' => array(
								'W' => $optionWidth,
								'H' => $optionHeight,
							),
						)
					);
				}
				else{

					echo CFileInput::Show($name.'['.$key.']', $file_id,
						array(
							'IMAGE' => $arOption['IMAGE'],
							'PATH' => 'Y',
							'FILE_SIZE' => 'Y',
							'DIMENSIONS' => 'Y',
							'IMAGE_POPUP' => 'Y',
							'MAX_SIZE' => array(
							'W' => $optionWidth,
							'H' => $optionHeight,
							),
						),
						array(
							'upload' => true,
							'medialib' => true,
							'file_dialog' => true,
							'cloud' => true,
							'del' => true,
							'description' => $arOption['WITH_DESCRIPTION'] == 'Y',
						)
					);
				}
				break;
			}
		}
		else{
			$inputName = array();
			foreach($values as $key => $val){
				if(is_array($val)){
					$inputName[$name.'['.$key.']'] = $val['VALUE'];
				}
				else{
					$inputName[$name.'['.$key.']'] = $val;
				}
			}
			if($historyId > 0){
				echo CFileInput::ShowMultiple($inputName, $name.'[n#IND#]',
					array(
						'IMAGE' => $arOption['IMAGE'],
						'PATH' => 'Y',
						'FILE_SIZE' => 'Y',
						'DIMENSIONS' => 'Y',
						'IMAGE_POPUP' => 'Y',
						'MAX_SIZE' => array(
							'W' => $optionWidth,
							'H' => $optionHeight,
						),
					),
				false);
			}
			else{
				echo CFileInput::ShowMultiple($inputName, $name.'[n#IND#]',
					array(
						'IMAGE' => $arOption['IMAGE'],
						'PATH' => 'Y',
						'FILE_SIZE' => 'Y',
						'DIMENSIONS' => 'Y',
						'IMAGE_POPUP' => 'Y',
						'MAX_SIZE' => array(
							'W' => $optionWidth,
							'H' => $optionHeight,
						),
					),
				false,
					array(
						'upload' => true,
						'medialib' => true,
						'file_dialog' => true,
						'cloud' => true,
						'del' => true,
						'description' => $arOption['WITH_DESCRIPTION'] == 'Y',
					)
				);
			}
		}
	}

	public static function IsCompositeEnabled(){
		if(class_exists('CHTMLPagesCache')){
			if(method_exists('CHTMLPagesCache', 'GetOptions')){
				if($arHTMLCacheOptions = CHTMLPagesCache::GetOptions()){
					if(method_exists('CHTMLPagesCache', 'isOn')){
						if (CHTMLPagesCache::isOn()){
							if(isset($arHTMLCacheOptions['AUTO_COMPOSITE']) && $arHTMLCacheOptions['AUTO_COMPOSITE'] === 'Y'){
								return 'AUTO_COMPOSITE';
							}
							else{
								return 'COMPOSITE';
							}
						}
					}
					else{
						if($arHTMLCacheOptions['COMPOSITE'] === 'Y'){
							return 'COMPOSITE';
						}
					}
				}
			}
		}

		return false;
	}

	public static function EnableComposite($auto = false){
		if(class_exists('CHTMLPagesCache')){
			if(method_exists('CHTMLPagesCache', 'GetOptions')){
				if($arHTMLCacheOptions = CHTMLPagesCache::GetOptions()){
					$arHTMLCacheOptions['COMPOSITE'] = 'Y';
					$arHTMLCacheOptions['AUTO_UPDATE'] = 'Y'; // standart mode
					$arHTMLCacheOptions['AUTO_UPDATE_TTL'] = '0'; // no ttl delay
					$arHTMLCacheOptions['AUTO_COMPOSITE'] = ($auto ? 'Y' : 'N'); // auto composite mode
					CHTMLPagesCache::SetEnabled(true);
					CHTMLPagesCache::SetOptions($arHTMLCacheOptions);
					bx_accelerator_reset();
				}
			}
		}
	}

	public static function GetCurrentElementFilter(&$arVariables, &$arParams){
        $arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'INCLUDE_SUBSECTIONS' => 'Y');
        if($arParams['CHECK_DATES'] == 'Y'){
            $arFilter = array_merge($arFilter, array('ACTIVE' => 'Y', 'SECTION_GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y'));
        }
        if($arVariables['ELEMENT_ID']){
            $arFilter['ID'] = $arVariables['ELEMENT_ID'];
        }
        elseif(strlen($arVariables['ELEMENT_CODE'])){
            $arFilter['CODE'] = $arVariables['ELEMENT_CODE'];
        }
		if($arVariables['SECTION_ID']){
			$arFilter['SECTION_ID'] = ($arVariables['SECTION_ID'] ? $arVariables['SECTION_ID'] : false);
		}
		if($arVariables['SECTION_CODE']){
			$arFilter['SECTION_CODE'] = ($arVariables['SECTION_CODE'] ? $arVariables['SECTION_CODE'] : false);
		}
        if(!$arFilter['SECTION_ID'] && !$arFilter['SECTION_CODE']){
            unset($arFilter['SECTION_GLOBAL_ACTIVE']);
        }
        return $arFilter;
    }

	public static function GetCurrentSectionFilter(&$arVariables, &$arParams){
		$arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID']);
		if($arParams['CHECK_DATES'] == 'Y'){
			$arFilter = array_merge($arFilter, array('ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y'));
		}
		if($arVariables['SECTION_ID']){
			$arFilter['ID'] = $arVariables['SECTION_ID'];
		}
		if(strlen($arVariables['SECTION_CODE'])){
			$arFilter['CODE'] = $arVariables['SECTION_CODE'];
		}
		if(!$arVariables['SECTION_ID'] && !strlen($arFilter['CODE'])){
			$arFilter['ID'] = 0; // if section not found
		}
		return $arFilter;
	}

	public static function GetCurrentSectionElementFilter(&$arVariables, &$arParams, $CurrentSectionID = false){
		$arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'INCLUDE_SUBSECTIONS' => 'N');
		if($arParams['CHECK_DATES'] == 'Y'){
			$arFilter = array_merge($arFilter, array('ACTIVE' => 'Y', 'SECTION_GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y'));
		}
		if(!$arFilter['SECTION_ID'] = ($CurrentSectionID !== false ? $CurrentSectionID : ($arVariables['SECTION_ID'] ? $arVariables['SECTION_ID'] : false))){
			unset($arFilter['SECTION_GLOBAL_ACTIVE']);
		}
		if(!$arFilter['SECTION_ID'] && $arVariables['SECTION_CODE'])
			$arFilter['SECTION_CODE'] = $arVariables['SECTION_CODE'];		
		
		if(strlen($arParams['FILTER_NAME'])){
			$GLOBALS[$arParams['FILTER_NAME']] = (array)$GLOBALS[$arParams['FILTER_NAME']];
			foreach($arUnsetFilterFields = array('SECTION_ID', 'SECTION_CODE', 'SECTION_ACTIVE', 'SECTION_GLOBAL_ACTIVE') as $filterUnsetField){
				foreach($GLOBALS[$arParams['FILTER_NAME']] as $filterField => $filterValue){
					if(($p = strpos($filterUnsetField, $filterField)) !== false && $p < 2){
						unset($GLOBALS[$arParams['FILTER_NAME']][$filterField]);
					}
				}
			}
			if($GLOBALS[$arParams['FILTER_NAME']]){
				$arFilter = array_merge($arFilter, $GLOBALS[$arParams['FILTER_NAME']]);
			}
		}
		return $arFilter;
	}

	public static function GetCurrentSectionSubSectionFilter(&$arVariables, &$arParams, $CurrentSectionID = false){
		$arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID']);
		if($arParams['CHECK_DATES'] == 'Y'){
			$arFilter = array_merge($arFilter, array('ACTIVE' => 'Y', 'GLOBAL_ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y'));
		}
		if(!$arFilter['SECTION_ID'] = ($CurrentSectionID !== false ? $CurrentSectionID : ($arVariables['SECTION_ID'] ? $arVariables['SECTION_ID'] : false))){
			$arFilter['INCLUDE_SUBSECTIONS'] = 'N';array_merge($arFilter, array('INCLUDE_SUBSECTIONS' => 'N', 'DEPTH_LEVEL' => '1'));
			$arFilter['DEPTH_LEVEL'] = '1';
			unset($arFilter['GLOBAL_ACTIVE']);
		}
		return $arFilter;
	}

	public static function GetIBlockAllElementsFilter(&$arParams){
		$arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'INCLUDE_SUBSECTIONS' => 'Y');
		if($arParams['CHECK_DATES'] == 'Y'){
			$arFilter = array_merge($arFilter, array('ACTIVE' => 'Y', 'ACTIVE_DATE' => 'Y'));
		}
		if(strlen($arParams['FILTER_NAME']) && (array)$GLOBALS[$arParams['FILTER_NAME']]){
			$arFilter = array_merge($arFilter, (array)$GLOBALS[$arParams['FILTER_NAME']]);
		}
		return $arFilter;
	}

	public static function CheckSmartFilterSEF($arParams, $component){
		if($arParams['SEF_MODE'] === 'Y' && strlen($arParams['FILTER_URL_TEMPLATE']) && is_object($component)){
			$arVariables = $arDefaultUrlTemplates404 = $arDefaultVariableAliases404 = $arDefaultVariableAliases = array();
			$smartBase = ($arParams["SEF_URL_TEMPLATES"]["section"] ? $arParams["SEF_URL_TEMPLATES"]["section"] : "#SECTION_ID#/");
			$arParams["SEF_URL_TEMPLATES"]["smart_filter"] = $smartBase."filter/#SMART_FILTER_PATH#/apply/";
			$arComponentVariables = array("SECTION_ID", "SECTION_CODE", "ELEMENT_ID", "ELEMENT_CODE", "action");
			$engine = new CComponentEngine($component);
			$engine->addGreedyPart("#SECTION_CODE_PATH#");
			$engine->addGreedyPart("#SMART_FILTER_PATH#");
			$engine->setResolveCallback(array("CIBlockFindTools", "resolveComponentEngine"));
			$arUrlTemplates = CComponentEngine::MakeComponentUrlTemplates($arDefaultUrlTemplates404, $arParams["SEF_URL_TEMPLATES"]);
			$componentPage = $engine->guessComponentPath($arParams["SEF_FOLDER"], $arUrlTemplates, $arVariables);
			if($componentPage === 'smart_filter'){
				$arVariableAliases = CComponentEngine::MakeComponentVariableAliases($arDefaultVariableAliases404, $arParams["VARIABLE_ALIASES"]);
				CComponentEngine::InitComponentVariables($componentPage, $arComponentVariables, $arVariableAliases, $arVariables);
				return $arResult = array("FOLDER" => $arParams["SEF_FOLDER"], "URL_TEMPLATES" => $arUrlTemplates, "VARIABLES" => $arVariables, "ALIASES" => $arVariableAliases);
			}
		}

		return false;
	}

	public static function AddMeta($arParams = array()){
		self::$arMetaParams = array_merge((array)self::$arMetaParams, (array)$arParams);
	}

	public static function SetMeta(){
		global $APPLICATION, $arSite, $arRegion;

		$PageH1 = $APPLICATION->GetTitle();
		$PageMetaTitleBrowser = $APPLICATION->GetPageProperty('title');
		$DirMetaTitleBrowser = $APPLICATION->GetDirProperty('title');
		$PageMetaDescription = $APPLICATION->GetPageProperty('description');
		$DirMetaDescription = $APPLICATION->GetDirProperty('description');

		$bShowSiteName = (Option::get(self::MODULE_ID, "HIDE_SITE_NAME_TITLE", "N") == "N");
		$site_name = $arSite['SITE_NAME'];
		if(!$bShowSiteName){
			$site_name = '';
		}

		// set title
		if(!CSite::inDir(SITE_DIR.'index.php')){
			if(!strlen($PageMetaTitleBrowser)){
				if(!strlen($DirMetaTitleBrowser)){
					$PageMetaTitleBrowser = $PageH1.((strlen($PageH1) && strlen($site_name)) ? ' - ' : '' ).$site_name;
					$APPLICATION->SetPageProperty('title', $PageMetaTitleBrowser);
				}
			}
		}
		else{
			if(!strlen($PageMetaTitleBrowser)){
				if(!strlen($DirMetaTitleBrowser)){
					$PageMetaTitleBrowser = $site_name.((strlen($site_name) && strlen($PageH1)) ? ' - ' : '' ).$PageH1;
					$APPLICATION->SetPageProperty('title', $PageMetaTitleBrowser);
				}
			}
		}

		// check Open Graph required meta properties
		if(!strlen(self::$arMetaParams['og:title'])){
			self::$arMetaParams['og:title'] = $PageMetaTitleBrowser;
		}
		if(!strlen(self::$arMetaParams['og:type'])){
			self::$arMetaParams['og:type'] = 'website';
		}
		if(!strlen(self::$arMetaParams['og:image'])){
			self::$arMetaParams['og:image'] = SITE_DIR.'logo.svg'; // site logo
		}
		if(!strlen(self::$arMetaParams['og:url'])){
			self::$arMetaParams['og:url'] = $_SERVER['REQUEST_URI'];
		}
		if(!strlen(self::$arMetaParams['og:description'])){
			self::$arMetaParams['og:description'] = (strlen($PageMetaDescription) ? $PageMetaDescription : $DirMetaDescription);
		}

		foreach(self::$arMetaParams as $metaName => $metaValue){
			if(strlen($metaValue = strip_tags($metaValue))){
				$APPLICATION->AddHeadString('<meta property="'.$metaName.'" content="'.$metaValue.'" />', true);
				if($metaName === 'og:image'){
					$APPLICATION->AddHeadString('<link rel="image_src" href="'.$metaValue.'"  />', true);
				}
			}
		}

		if($arRegion)
		{
			$arTagSeoMarks = array();
			foreach($arRegion as $key => $value)
			{
				if(strpos($key, 'PROPERTY_REGION_TAG') !== false && strpos($key, '_VALUE_ID') === false)
				{
					$tag_name = str_replace(array('PROPERTY_', '_VALUE'), '', $key);
					$arTagSeoMarks['#'.$tag_name.'#'] = $key;
				}
			}
			if($arTagSeoMarks)
				CPriorityRegionality::addSeoMarks($arTagSeoMarks);
		}

	}

	public static function PrepareItemProps($arProps){
		if(is_array($arProps) && $arProps)
		{
			foreach($arProps as $PCODE => $arProperty)
			{
				if(in_array($PCODE, array('PERIOD', 'TITLE_BUTTON', 'LINK_BUTTON', 'REDIRECT', 'DOCUMENTS', 'FORM_ORDER', 'FORM_QUESTION', 'PHOTOPOS', 'TASK_PROJECT', 'PHOTOS', 'GALLEY_BIG')))
					unset($arProps[$PCODE]);
				elseif(!$arProperty["VALUE"])
					unset($arProps[$PCODE]);
			}
		}
		else
			$arProps = array();

		return $arProps;
	}

	public static function ShowCabinetLink($icon=true, $text=true, $class_icon='', $show_mess=false, $message=''){
		global $APPLICATION;
		$html = '';
		$userID = self::GetUserID();
		if(!$message)
				$message = GetMessage('CABINET_LINK');
		if($userID)
		{
			global $USER;

			$html .= '<a class="personal-link dark-color'.($text ? /*' with_dropdown'*/ '' : '').'" href="'.SITE_DIR.'cabinet/">';
			if($icon){
				$html .= self::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/user_login.svg');
			}

			if($text)
				$html .= '<span class="wrap">';

				if ($text && strlen($USER->GetFirstName()))
					$html .= '<span class="name">'.$USER->GetFirstName().'</span>';
				if(strlen($show_mess && $USER->GetFirstName()))
					$html .= '<span class="title">'.$USER->GetFirstName().'</span>';

			if($text)
				$html .= '</span>';

			$html .= '</a>';
		}
		else
		{
			$url = ((isset($_GET['backurl']) && $_GET['backurl']) ? $_GET['backurl'] : $APPLICATION->GetCurUri());
			$html .= '<a class="personal-link dark-color animate-load" data-event="jqm" data-param-type="auth" data-param-backurl="'.$url.'" data-name="auth" href="'.SITE_DIR.'cabinet/">';
			if($icon){
				$html .= self::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/user.svg');
				
			}

			if($text)
				$html .= '<span class="wrap">';

				if($text)
					$html .= '<span class="name">'.GetMessage('LOGIN').'</span>';
				if($show_mess && $message)
					$html .= '<span class="title">'.$message.'</span>';
			if($text)
				$html .= '</span>';

			$html .= '</a>';
		}

		return $html;
	}

	public static function ShowPrintLink($txt=''){
		$html = '';

		$arTheme = self::GetFrontParametrsValues(SITE_ID);
		if($arTheme['PRINT_BUTTON'] == 'Y')
		{
			if(!$txt)
				$txt = GetMessage('PRINT_LINK');
			$html = '<div class="print-link">'.self::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/print.svg');
			if($txt)
				$html .= '<span class="text">'.$txt.'</span>';
			$html .= '</div>';
		}
		return $html;
	}

	public static function ShowSearch($class_button='', $class_icon='', $text=''){
		$arTheme = self::GetFrontParametrsValues(SITE_ID);
		$searchType1 = (isset($arTheme['TYPE_SEARCH']['VALUE']) && $arTheme['TYPE_SEARCH']['VALUE'] == 'corp' || $arTheme['TYPE_SEARCH'] == 'corp' ? ' corp_search' : '');
		?>
		<button class="top-btn inline-search-show<?=($class_button ? ' '.$class_button : '');?><?=$searchType1;?>">
			<?=self::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/search.svg');?>
			<span class="title"><?=$text;?></span>
		</button>
		<?
	}
	
	public static function ShowBasketLink($class_link='top-btn hover', $class_icon='', $txt='', $show_price = false, $ignoreHide = false){
		$html = '';
		$userID = self::GetUserID();

		$arTheme = self::GetFrontParametrsValues(SITE_ID);
		$arItems = ((isset($_SESSION[SITE_ID][$userID]['BASKET_ITEMS']) && is_array($_SESSION[SITE_ID][$userID]['BASKET_ITEMS']) && $_SESSION[SITE_ID][$userID]['BASKET_ITEMS']) ? $_SESSION[SITE_ID][$userID]['BASKET_ITEMS'] : array());
		$count = ($arItems ? count($arItems) : 0 );
		$allSumm = 0;
		if($arItems)
		{
			foreach($arItems as $arItem)
			{
				if(strlen(trim($arItem['PROPERTY_PRICE_VALUE'])))
					$allSumm += floatval(str_replace(' ', '', $arItem['PROPERTY_FILTER_PRICE_VALUE'])) * $arItem['QUANTITY'];
			}
		}
		$title_text = GetMessage("TITLE_BASKET", array("#SUMM#" => self::FormatSumm($allSumm, 1)));
		$summ_text = GetMessage("BASKET_SUMM", array("#SUMM#" => self::FormatSumm($allSumm, 1)));
		if((int)$count <= 0)
			$title_text = GetMessage("EMPTY_BASKET");
		if($ignoreHide && $arTheme['ORDER_VIEW'] == 'Y' || ($arTheme['ORDER_VIEW'] == 'Y' && $arTheme['ORDER_BASKET_VIEW'] == 'HEADER' && (!self::IsBasketPage($arTheme['URL_BASKET_SECTION']) && !self::IsOrderPage($arTheme['URL_ORDER_SECTION']))))
		{
			$html = '<!-- noindex --><a rel="nofollow" title="'.$title_text.'" href="'.$arTheme['URL_BASKET_SECTION'].'" class="basket-link '.$class_link.' '.$class_icon.($count ? ' basket-count' : '').'"><span class="js-basket-block">'.self::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/basket.svg');
			if($show_price)
				$html .= '<div class="wrap">';

				if($txt)
					$html .= '<span class="title dark_link">'.$txt.'</span>';

				if($show_price)
					$html .= '<span class="prices">'.($allSumm ? $summ_text : GetMessage('EMPTY_BASKET')).'</span>';
			if($show_price)
				$html .= '</div>';

			$html .= '<span class="count">'.$count.'</span>';
			$html .= '</span></a><!-- /noindex -->';
		}

		return $html;
	}

	public static function ShowMobileMenuCabinet(){
		global $APPLICATION, $arTheme;

		if($arTheme['CABINET']['VALUE'] === 'Y'){
			?>			
			<?$APPLICATION->IncludeComponent(
				"bitrix:menu",
				"cabinet_mobile",
				Array(
					"COMPONENT_TEMPLATE" => "cabinet_mobile",
					"MENU_CACHE_TIME" => "3600000",
					"MENU_CACHE_TYPE" => "A",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"MENU_CACHE_GET_VARS" => array(
					),
					"DELAY" => "N",
					"MAX_LEVEL" => "4",
					"ALLOW_MULTI_SELECT" => "Y",
					"ROOT_MENU_TYPE" => "cabinet",
					"CHILD_MENU_TYPE" => "left",
					"USE_EXT" => "Y"
				)
			);?>
			<?
		}
	}

	public static function ShowMobileMenuBasket(){
		global $arTheme;

		$basketUrl = trim($arTheme['ORDER_VIEW']['DEPENDENT_PARAMS']['URL_BASKET_SECTION']['VALUE']);
		$orderUrl = trim($arTheme['ORDER_VIEW']['DEPENDENT_PARAMS']['URL_ORDER_SECTION']['VALUE']);
		$bShowBasket = $arTheme['ORDER_VIEW']['VALUE'] === 'Y' && strlen($basketUrl) && (!CSite::inDir($basketUrl) && (strlen($orderUrl) ? !CSite::inDir($orderUrl) : true));
		$userID = CUser::GetID();
		$userID = $userID > 0 ? $userID : 0;
		$cntItems = isset($_SESSION[SITE_ID][$userID]['BASKET_ITEMS']) && is_array($_SESSION[SITE_ID][$userID]['BASKET_ITEMS']) ? count($_SESSION[SITE_ID][$userID]['BASKET_ITEMS']) : 0;

		if($bShowBasket){
			?>
			<div class="menu middle">
				<ul>
					<li class="counters">
						<a class="dark-color ready" href="<?=$basketUrl?>">
							<svg class="svg svg-basket" width="19" height="16" viewBox="0 0 19 16">
								<path data-name="Ellipse 2 copy 9" class="cls-1" d="M956.047,952.005l-0.939,1.009-11.394-.008-0.952-1-0.953-6h-2.857a0.862,0.862,0,0,1-.952-1,1.025,1.025,0,0,1,1.164-1h2.327c0.3,0,.6.006,0.6,0.006a1.208,1.208,0,0,1,1.336.918L943.817,947h12.23L957,948v1Zm-11.916-3,0.349,2h10.007l0.593-2Zm1.863,5a3,3,0,1,1-3,3A3,3,0,0,1,945.994,954.005ZM946,958a1,1,0,1,0-1-1A1,1,0,0,0,946,958Zm7.011-4a3,3,0,1,1-3,3A3,3,0,0,1,953.011,954.005ZM953,958a1,1,0,1,0-1-1A1,1,0,0,0,953,958Z" transform="translate(-938 -944)"/>
							</svg>
							<span><span class="title"><?=GetMessage('BASKET')?></span><span class="count<?=(!$cntItems ? ' empted' : '')?>"><?=$cntItems?></span></span>
						</a>
					</li>
				</ul>
			</div>
			<?
		}
	}
	
	public static function ShowBurger($class_icon=''){
		?>
		<div class="burger pull-left">
			<?=self::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/burger.svg');?>
			<?=self::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/close.svg');?>
		</div>
		<?
	}

	public static function ShowMobileMenuContacts(){
		global $APPLICATION, $arRegion, $arTheme;
		$arBackParametrs = self::GetBackParametrsValues(SITE_ID);
		$iCountPhones = ($arRegion ? count($arRegion['PHONES']) : $arBackParametrs['HEADER_PHONES']);
		?>
		<div class="contacts">
			<?// show regions
			self::ShowMobileRegions();?>
			<?if($iCountPhones): // count of phones?>
				<?
				$phone = ($arRegion ? $arRegion['PHONES'][0] : $arBackParametrs['HEADER_PHONES_array_PHONE_VALUE_0']);
				$href = 'tel:'.str_replace(array(' ', '-', '(', ')'), '', $phone);

				static $mphones_call;

				$iCalledID = ++$mphones_call;?>

				<?if($arRegion):?>
					<?$frame = new \Bitrix\Main\Page\FrameHelper('mobile-phone-block'.$iCalledID);?>
					<?$frame->begin();?>
				<?endif;?>

				<div class="phones">
					<ul>
						<li>
							<a href="<?=$href?>" class="dark-color<?=($iCountPhones > 1 ? ' parent' : '')?>">
								<i class="svg svg-phone"></i>
								<span><?=$phone?></span>
								<?if($iCountPhones > 1):?>
									<span class="arrow">
										<svg class="svg svg_triangle_right" xmlns="http://www.w3.org/2000/svg" width="3" height="5" viewBox="0 0 3 5">
										  <path data-name="Rectangle 323 copy 9" class="cls-1" d="M960,958v-5l3,2.514Z" transform="translate(-960 -953)"/>
										</svg>
									</span>
								<?endif;?>
							</a>
							<?if($iCountPhones > 1): // if more than one?>
								<ul class="dropdown">
									<li>
										<svg class="svg svg-close<?=($class_icon ? ' '.$class_icon : '');?>" width="14" height="14" viewBox="0 0 14 14">
										  <path data-name="Rounded Rectangle 568 copy 16" class="cls-1" d="M1009.4,953l5.32,5.315a0.987,0.987,0,0,1,0,1.4,1,1,0,0,1-1.41,0L1008,954.4l-5.32,5.315a0.991,0.991,0,0,1-1.4-1.4L1006.6,953l-5.32-5.315a0.991,0.991,0,0,1,1.4-1.4l5.32,5.315,5.31-5.315a1,1,0,0,1,1.41,0,0.987,0.987,0,0,1,0,1.4Z" transform="translate(-1001 -946)"/>
										</svg>
									</li>
								
									<li class="menu_back">
										<a href="" class="dark-color" rel="nofollow">
											<svg class="svg svg-back" width="16" height="12" viewBox="0 0 16 12">
												<path data-name="Rounded Rectangle 804" d="M998,953H986.4l3.313,3.286a1,1,0,0,1,0,1.414,0.99,0.99,0,0,1-1.407,0l-5.034-4.993a1,1,0,0,1,0-1.414l5.034-5.024a0.992,0.992,0,0,1,1.407,0,1.006,1.006,0,0,1,0,1.415L986.384,951H998A1,1,0,0,1,998,953Z" transform="translate(-983 -946)"/>
											</svg>
											<?=GetMessage('PRIORITY_T_MENU_BACK')?>
										</a>
									</li>
									<?for($i = 0; $i < $iCountPhones; ++$i):?>
										<?
										$phone = ($arRegion ? $arRegion['PHONES'][$i] : $arBackParametrs['HEADER_PHONES_array_PHONE_VALUE_'.$i]);
										$href = 'tel:'.str_replace(array(' ', '-', '(', ')'), '', $phone);
										?>
										<li><a href="<?=$href?>" class="dark-color"><?=$phone?></a></li>
									<?endfor;?>
									<li><span class="callback font_upper colored" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_callback");?>" data-name="callback"><?=GetMessage('S_CALLBACK')?></span></li>
								</ul>
							<?endif;?>
						</li>
					</ul>
				</div>

				<?if($arRegion):?>
					<?$frame->end();?>
				<?endif;?>

			<?endif;?>

			<?if($arRegion):?>
			<?$frame = new \Bitrix\Main\Page\FrameHelper('mobile-contact-block');?>
			<?$frame->begin();?>
			<?endif;?>

			<?if($arRegion):?>
				<?if($arRegion['PROPERTY_EMAIL_VALUE']):?>
					<div class="email">
						<i class="svg svg-email"></i>
						<?foreach($arRegion['PROPERTY_EMAIL_VALUE'] as $value):?>
							<a href="mailto:<?=$value;?>"><?=$value;?></a>
						<?endforeach;?>
					</div>
				<?endif;?>
			<?else:?>
				<div class="email">
					<i class="svg svg-email"></i>
					<?$APPLICATION->IncludeFile(SITE_DIR."include/footer/site-email.php", array(), array(
							"MODE" => "html",
							"NAME" => "Address",
							"TEMPLATE" => "include_area.php",
						)
					);?>
				</div>
			<?endif;?>

			<?if($arRegion):?>
				<?if($arRegion['PROPERTY_ADDRESS_VALUE']):?>
					<div class="address">
						<i class="svg svg-address"></i>
						<?=$arRegion['PROPERTY_ADDRESS_VALUE']['TEXT'];?>
					</div>
				<?endif;?>
			<?else:?>
				<div class="address">
					<i class="svg svg-address"></i>
					<?$APPLICATION->IncludeFile(SITE_DIR."include/header/site-address.php", array(), array(
							"MODE" => "html",
							"NAME" => "Address",
							"TEMPLATE" => "include_area.php",
						)
					);?>
				</div>
			<?endif;?>

			<?if($arRegion):?>
			<?$frame->end();?>
			<?endif;?>

		</div>
		<?
	}

	public static function ShowListRegions(){?>
		<?global $arTheme, $APPLICATION;
		static $list_regions_call;
		$iCalledID = ++$list_regions_call;?>
		<?$frame = new \Bitrix\Main\Page\FrameHelper('header-regionality-block'.$iCalledID);?>
		<?$frame->begin();?>
		<?$APPLICATION->IncludeComponent(
			"aspro:regionality.list.priority",
			strtolower($arTheme["USE_REGIONALITY"]["DEPENDENT_PARAMS"]["REGIONALITY_VIEW"]["VALUE"]),
			Array(
				
			),false, array('HIDE_ICONS' => 'Y')
		);?>
		<?$frame->end();?>
	<?}

	public static function ShowMobileRegions(){
		global $APPLICATION, $arRegion, $arRegions;

		if($arRegion):
			$type_regions = self::GetFrontParametrValue('REGIONALITY_TYPE');
			static $mregions_call;

			$iCalledID = ++$mregions_call;
			$arRegions = CPriorityRegionality::getRegions();
			$regionID = ($arRegion ? $arRegion['ID'] : '');
			$iCountRegions = count($arRegions);?>
			<?Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID('mobile-region-block'.$iCalledID);?>
			<!-- noindex -->
			<div class="menu middle mobile_regions">
				<ul>
					<li>
						<a rel="nofollow" href="" class="dark-color<?=($iCountRegions > 1 ? ' parent' : '')?>">
							<i class="svg">
								<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/svg/region.svg');?>
							</i>
							<span><?=$arRegion['NAME'];?></span>
							<?if($iCountRegions > 1):?>
								<span class="arrow">
									<svg class="svg svg_triangle_right" xmlns="http://www.w3.org/2000/svg" width="3" height="5" viewBox="0 0 3 5">
									  <path data-name="Rectangle 323 copy 9" class="cls-1" d="M960,958v-5l3,2.514Z" transform="translate(-960 -953)"/>
									</svg>
								</span>
							<?endif;?>
						</a>
						<?if($iCountRegions > 1): // if more than one?>
							<?$host = (CMain::IsHTTPS() ? 'https://' : 'http://');
							$uri = $APPLICATION->GetCurUri();?>
							<ul class="dropdown">
								<li>
									<svg class="svg svg-close<?=($class_icon ? ' '.$class_icon : '');?>" width="14" height="14" viewBox="0 0 14 14">
									  <path data-name="Rounded Rectangle 568 copy 16" class="cls-1" d="M1009.4,953l5.32,5.315a0.987,0.987,0,0,1,0,1.4,1,1,0,0,1-1.41,0L1008,954.4l-5.32,5.315a0.991,0.991,0,0,1-1.4-1.4L1006.6,953l-5.32-5.315a0.991,0.991,0,0,1,1.4-1.4l5.32,5.315,5.31-5.315a1,1,0,0,1,1.41,0,0.987,0.987,0,0,1,0,1.4Z" transform="translate(-1001 -946)"/>
									</svg>
								</li>
								<li class="menu_back">
									<a href="" class="dark-color" rel="nofollow">
										<svg class="svg svg-back" width="16" height="12" viewBox="0 0 16 12">
											<path data-name="Rounded Rectangle 804" d="M998,953H986.4l3.313,3.286a1,1,0,0,1,0,1.414,0.99,0.99,0,0,1-1.407,0l-5.034-4.993a1,1,0,0,1,0-1.414l5.034-5.024a0.992,0.992,0,0,1,1.407,0,1.006,1.006,0,0,1,0,1.415L986.384,951H998A1,1,0,0,1,998,953Z" transform="translate(-983 -946)"/>
										</svg>
										<?=GetMessage('PRIORITY_T_MENU_BACK')?>
									</a>
								</li>
								<li class="menu_title"><span class="title"><?=\Bitrix\Main\Localization\Loc::getMessage('PRIORITY_T_MENU_REGIONS')?></span></li>
								<?foreach($arRegions as $arItem):?>
									<?$href = $uri;
									if($arItem['PROPERTY_MAIN_DOMAIN_VALUE'] && $type_regions == 'SUBDOMAIN')
										$href = $host.$arItem['PROPERTY_MAIN_DOMAIN_VALUE'].$uri;
									?>
									<li><a rel="nofollow" href="<?=$href?>" class="dark-color city_item" data-id="<?=$arItem['ID'];?>"><?=$arItem['NAME'];?></a></li>
								<?endforeach;?>
							</ul>
						<?endif;?>
					</li>
				</ul>
			</div>
			<!-- /noindex -->
			<?Bitrix\Main\Page\Frame::getInstance()->finishDynamicWithID('mobile-region-block'.$iCalledID);?>
		<?endif;
	}

	public static function ShowTopDetailBanner($arResult, $arParams, $formCode = ''){
		$bg = ((isset($arResult['PROPERTIES']['BNR_TOP_BG']) && $arResult['PROPERTIES']['BNR_TOP_BG']['VALUE']) ? CFile::GetPath($arResult['PROPERTIES']['BNR_TOP_BG']['VALUE']) : SITE_TEMPLATE_PATH.'/images/top-bnr.jpg');
		$bShowBG = (isset($arResult['PROPERTIES']['BNR_TOP_IMG']) && $arResult['PROPERTIES']['BNR_TOP_IMG']['VALUE']);
		$title = ($arResult['IPROPERTY_VALUES'] && strlen($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) ? htmlspecialchars_decode($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']) : htmlspecialchars_decode($arResult['NAME']));
		//$text_color_style = ((isset($arResult['PROPERTIES']['CODE_TEXT']) && $arResult['PROPERTIES']['CODE_TEXT']['VALUE']) ? 'style="color:'.$arResult['PROPERTIES']['CODE_TEXT']['VALUE'].'"' : '');
		$bLightBanner = (isset($arResult['PROPERTIES']['CODE_TEXT']) && $arResult['PROPERTIES']['CODE_TEXT']['VALUE_XML_ID'] == 'light' ? true : false);
		$bLanding = (isset($arResult['IS_LANDING']) && $arResult['IS_LANDING'] == 'Y');
		$animationType = (isset($arResult['PROPERTIES']['BANNER_IMG_ANIMATION']) && $arResult['PROPERTIES']['BANNER_IMG_ANIMATION']['VALUE'] ? $arResult['PROPERTIES']['BANNER_IMG_ANIMATION']['VALUE_XML_ID'] : 'Up');
		?>
		<div class="banners-content">
			<div class="maxwidth-banner" style="background: url(<?=$bg;?>) 50% 50% no-repeat;">
				<div class="row">
					<div class="maxwidth-theme">
						<div class="col-md-6 text animated delay06 duration08 item_block fadeInUp<?=($bLightBanner ? ' light' : '')?>">
							<h1><?=$title?></h1>
							<div class="intro-text">
								<?if($bLanding):?>
									<p><?=$arResult['PROPERTIES']['ANONS']['VALUE'];?></p>
								<?else:?>
									<?if($arResult['PREVIEW_TEXT_TYPE'] == 'text'):?>
										<p><?=$arResult['FIELDS']['PREVIEW_TEXT'];?></p>
									<?else:?>
										<?=$arResult['FIELDS']['PREVIEW_TEXT'];?>
									<?endif;?>
								<?endif;?>
							</div>
							<div class="buttons">
								<?if($bLanding):?>
									<?if($arResult['PROPERTIES']['BUTTON_TEXT']['VALUE']):?>
										<span>
											<span class="btn <?=($arResult['PROPERTIES']['BUTTONCLASS']['VALUE'] ? $arResult['PROPERTIES']['BUTTONCLASS']['VALUE_XML_ID'] : 'btn-default');?> btn-lg scroll_btn"><?=$arResult['PROPERTIES']['BUTTON_TEXT']['VALUE'];?></span>
										</span>
									<?endif;?>
								<?else:?>
									<?if($arResult['DISPLAY_PROPERTIES']['FORM_ORDER']['VALUE_XML_ID'] == 'YES'):?>
										<span>
											<span class="btn <?=($arResult['PROPERTIES']['BUTTON1CLASS']['VALUE'] ? $arResult['PROPERTIES']['BUTTON1CLASS']['VALUE_XML_ID'] : 'btn-default');?> btn-lg animate-load" data-event="jqm" data-param-id="<?=($formCode ? self::getFormID($formCode) : self::getFormID("aspro_priority_order_services"));?>" data-name="order_services" data-autoload-service="<?=self::formatJsName($arResult['NAME'])?>" data-autoload-project="<?=self::formatJsName($arResult['NAME'])?>" data-autoload-product="<?=self::formatJsName($arResult['NAME'])?>"><span><?=(strlen($arParams['S_ORDER_SERVISE']) ? $arParams['S_ORDER_SERVISE'] : \Bitrix\Main\Localization\Loc::getMessage('S_ORDER_SERVISE'))?></span></span>
										</span>
									<?endif;?>

									<?if($arResult['DISPLAY_PROPERTIES']['FORM_QUESTION']['VALUE_XML_ID'] == 'YES' || $arResult['PROPERTIES']['FORM_QUESTION']['VALUE_XML_ID'] == 'Y'):?>
										<span>
											<span class="btn <?=($arResult['PROPERTIES']['BUTTON2CLASS']['VALUE'] ? $arResult['PROPERTIES']['BUTTON2CLASS']['VALUE_XML_ID'] : 'btn-default white');?> btn-lg animate-load" data-event="jqm" data-param-id="<?=self::getFormID("aspro_priority_question");?>" data-autoload-need_product="<?=self::formatJsName($arResult['NAME'])?>" data-name="question"><span><?=(strlen($arParams['S_ASK_QUESTION']) ? $arParams['S_ASK_QUESTION'] : \Bitrix\Main\Localization\Loc::getMessage('S_ASK_QUESTION'))?></span></span>
										</span>
									<?endif;?>
								<?endif;?>
							</div>
						</div>
						<?if($bShowBG):?>
							<div class="col-md-6 hidden-xs hidden-sm img animated delay09 duration08 item_block fadeIn<?=$animationType;?>">
								<div class="inner">
									<img src="<?=CFile::GetPath($arResult['PROPERTIES']['BNR_TOP_IMG']['VALUE']);?>" alt="<?=$title;?>" title="<?=$title;?>" draggable="false">
								</div>
							</div>
						<?endif;?>
					</div>
				</div>
			</div>
		</div>
	<?}

	public static function formatJsName($name = ''){
		return htmlspecialcharsbx($name);
	}
	
	public static function GetUserID(){
		static $userID;
		if($userID === NULL)
		{
			global $USER;
			$userID = CUser::GetID();
			$userID = ($userID > 0 ? $userID : 0);
		}
		return $userID;
	}

	public static function CheckAdditionalChainInMultiLevel(&$arResult, &$arParams, &$arElement){
		global $APPLICATION;
		$APPLICATION->arAdditionalChain = false;
		if($arParams['INCLUDE_IBLOCK_INTO_CHAIN'] == 'Y' && isset(CCache::$arIBlocksInfo[$arParams['IBLOCK_ID']]['NAME']))
			$APPLICATION->AddChainItem(CCache::$arIBlocksInfo[$arParams['IBLOCK_ID']]['NAME'], $arElement['~LIST_PAGE_URL']);

		if($arParams['ADD_SECTIONS_CHAIN'] == 'Y')
		{
			if($arSection = CCache::CIBlockSection_GetList(array('CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arElement['IBLOCK_ID']), 'MULTI' => 'N')), self::GetCurrentSectionFilter($arResult['VARIABLES'], $arParams), false, array('ID', 'NAME')))
			{
				$rsPath = CIBlockSection::GetNavChain($arParams['IBLOCK_ID'], $arSection['ID']);
				$rsPath->SetUrlTemplates('', $arParams['SECTION_URL']);
				while($arPath = $rsPath->GetNext())
				{
					$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arParams['IBLOCK_ID'], $arPath['ID']);
					$arPath['IPROPERTY_VALUES'] = $ipropValues->getValues();
					$arSection['PATH'][] = $arPath;
					$arSection['SECTION_URL'] = $arPath['~SECTION_PAGE_URL'];
				}

				foreach($arSection['PATH'] as $arPath)
				{
					if($arPath['IPROPERTY_VALUES']['SECTION_PAGE_TITLE'] != '')
						$APPLICATION->AddChainItem($arPath['IPROPERTY_VALUES']['SECTION_PAGE_TITLE'], $arPath['~SECTION_PAGE_URL']);
					else
						$APPLICATION->AddChainItem($arPath['NAME'], $arPath['~SECTION_PAGE_URL']);
				}
			}
		}
		if($arParams['ADD_ELEMENT_CHAIN'] == 'Y')
		{
			$ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues($arParams['IBLOCK_ID'], $arElement['ID']);
			$arElement['IPROPERTY_VALUES'] = $ipropValues->getValues();
			if($arElement['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'] != '')
				$APPLICATION->AddChainItem($arElement['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']);
			else
				$APPLICATION->AddChainItem($arElement['NAME']);
		}
	}

	public static function CheckDetailPageUrlInMultilevel(&$arResult){
		if($arResult['ITEMS']){
			$arItemsIDs = $arItems = array();
			$CurrentSectionID = false;
			foreach($arResult['ITEMS'] as $arItem)
				$arItemsIDs[] = $arItem['ID'];

			$arItems = CCache::CIBLockElement_GetList(array('CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']), 'GROUP' => array('ID'), 'MULTI' => 'N')), array('ID' => $arItemsIDs), false, false, array('ID', 'IBLOCK_SECTION_ID', 'DETAIL_PAGE_URL'));
			if($arResult['SECTION']['PATH'])
			{
				for($i = count($arResult['SECTION']['PATH']) - 1; $i >= 0; --$i)
				{
					if(CSite::InDir($arResult['SECTION']['PATH'][$i]['SECTION_PAGE_URL']))
					{
						$CurrentSectionID = $arResult['SECTION']['PATH'][$i]['ID'];
						break;
					}
				}
			}
			foreach($arResult['ITEMS'] as $i => $arItem)
			{
				if(is_array($arItems[$arItem['ID']]['DETAIL_PAGE_URL']))
				{
					if($arItems[$arItem['ID']]['DETAIL_PAGE_URL'][$CurrentSectionID])
						$arResult['ITEMS'][$i]['DETAIL_PAGE_URL'] = $arItems[$arItem['ID']]['DETAIL_PAGE_URL'][$CurrentSectionID];
				}
				if(is_array($arItems[$arItem['ID']]['IBLOCK_SECTION_ID']))
					$arResult['ITEMS'][$i]['IBLOCK_SECTION_ID'] = $CurrentSectionID;
			}
		}
	}

	public static function Start($siteID = 's1'){
		global $APPLICATION, $arRegion;
		if(CModule::IncludeModuleEx(self::MODULE_ID) == 1)
		{
			if(!defined('ASPRO_USE_ONENDBUFFERCONTENT_HANDLER')){
				define('ASPRO_USE_ONENDBUFFERCONTENT_HANDLER', 'Y');
			}

			$APPLICATION->SetPageProperty("viewport", "initial-scale=1.0, width=device-width");
			$APPLICATION->SetPageProperty("HandheldFriendly", "true");
			$APPLICATION->SetPageProperty("apple-mobile-web-app-capable", "yes");
			$APPLICATION->SetPageProperty("apple-mobile-web-app-status-bar-style", "black");
			$APPLICATION->SetPageProperty("SKYPE_TOOLBAR", "SKYPE_TOOLBAR_PARSER_COMPATIBLE");

			self::UpdateFrontParametrsValues(); //update theme values

			self::GenerateThemes($siteID); //generate theme.css and bgtheme.css
			$arTheme = self::GetFrontParametrsValues($siteID); //get site options
			// print_r($arTheme);
			if($arTheme['USE_REGIONALITY'] == 'Y')
				$arRegion = CPriorityRegionality::getCurrentRegion(); //get current region from regionality module

			if($arTheme['CUSTOM_FONT']){
				$APPLICATION->AddHeadString('<'.$arTheme['CUSTOM_FONT'].'>');
				
				$string = str_replace('link href=', '', $arTheme['CUSTOM_FONT']);
				$stringLength = strlen($string);
				$startLetter = strpos($string, '=');
				$string = substr($string, $startLetter + 1, $stringLength);
				$endLetter = strpos($string, ':');
				$string = ($endLetter ? substr($string, 0, $endLetter) : $string);
				$string = str_replace('" rel="stylesheet"', '', $string);
				$endLetter = strpos($string, '&amp');
				$string = ($endLetter ? substr($string, 0, $endLetter) : $string);
				$path = $_SERVER['DOCUMENT_ROOT'].'/'.SITE_TEMPLATE_PATH.'/css/google_font.css';
				$content = "body,h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6, .popup-window,body div.bx-yandex-map,.fancybox-title{font-family: '".str_replace('+', ' ', $string)."', sans-serif;}";
				$md5Content = md5($content);
				$customFontHash = $arTheme['CUSTOM_FONT_HASH'];
				$bPutContent = ($customFontHash == $md5Content ? false : true);
				
				if($bPutContent /*&& file_exists($path)*/){
					file_put_contents($path, $content);
					COption::SetOptionString(self::MODULE_ID, 'CUSTOM_FONT_HASH', $md5Content, false, $siteID);
				}
			}
			elseif(!$arTheme['FONT_STYLE'] || !self::$arParametrsList['MAIN']['OPTIONS']['FONT_STYLE']['LIST'][$arTheme['FONT_STYLE']])
				$font_family = 'Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,500,600,700,800&subset=latin,cyrillic-ext';
			else
				$font_family = self::$arParametrsList['MAIN']['OPTIONS']['FONT_STYLE']['LIST'][$arTheme['FONT_STYLE']]['LINK'];

			if(strlen($font_family)){ 
				$APPLICATION->SetAdditionalCSS(/*(CMain::IsHTTPS() ? 'https' : 'http').*/'https://fonts.googleapis.com/css?family='.$font_family);
			}

			$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/bootstrap.css');
			$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/fonts/font-awesome/css/font-awesome.min.css');
			$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/vendor/flexslider/flexslider.css');
			$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/jquery.fancybox.css');
			$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/theme-elements.css');
			$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/jqModal.css');
			$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/theme-responsive.css');
			$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/print.css');
			$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/animation/animate.min.css');
			$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/jquery.mCustomScrollbar.min.css');
			$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/animation/animation_ext.css');
			$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/jquery.onoff.css');

			if ($arTheme['H1_STYLE']=='2') // 2 - Normal
				$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/h1-normal.css');
			elseif(1) // 1 - Bold
				$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/h1-bold.css');

			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.actual.min.js');
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/browser.js');
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.fancybox.min.js');
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/vendor/jquery.easing.js');
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/vendor/jquery.appear.js');
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/vendor/jquery.cookie.js');
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/vendor/bootstrap.js');
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/vendor/flexslider/jquery.flexslider.min.js');
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/vendor/jquery.validate.min.js');
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.uniform.min.js');
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jqModal.min.js');
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.autocomplete.js');
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery-ui.min.js');
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.inputmask.bundle.min.js', true);
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/detectmobilebrowser.js');
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/matchMedia.js');
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.waypoints.min.js');
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.counterup.js');
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.alphanumeric.js');
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.mobile.custom.touch.min.js');
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.mousewheel-3.0.6.min.js');
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.mCustomScrollbar.min.js');
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.onoff.min.js');
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/jquery.autoresize.min.js');
			//$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/modernizr.js');
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/velocity.min.js');
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/general.js');
			$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/js/custom.js');


			if(strlen($arTheme['FAVICON_IMAGE']))
				$APPLICATION->AddHeadString('<link rel="shortcut icon" href="'.$arTheme['FAVICON_IMAGE'].'" type="image/x-icon" />', true);
			
			if(strlen($arTheme['APPLE_TOUCH_ICON_IMAGE']))
				$APPLICATION->AddHeadString('<link rel="apple-touch-icon" sizes="180x180" href="'.$arTheme['APPLE_TOUCH_ICON_IMAGE'].'" />', true);

			CJSCore::Init(array('jquery2', 'fx'));
			CAjax::Init();

			self::showBgImage($siteID, $arTheme);
		}
		else
		{
			$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH.'/css/styles.css');
			$APPLICATION->SetTitle(GetMessage("ERROR_INCLUDE_MODULE"));
			$APPLICATION->IncludeFile(SITE_DIR."include/error_include_module.php", Array(), Array()); die();
		}
	}

	public static function ShowPageProps($prop){
		/** @global CMain $APPLICATION */
		global $APPLICATION;
		$APPLICATION->AddBufferContent(array("CPriority", "GetPageProps"), $prop);
	}

	public static function GetPageProps($prop){
		/** @global CMain $APPLICATION */
		global $APPLICATION;

		if($prop == 'ERROR_404')
		{
			return (defined($prop) ? 'with_error' : '');
		}
		else
		{
			$val = $APPLICATION->GetProperty($prop);
			if(!empty($val))
				return $val;
		}
		return '';
	}

	public static function CopyFaviconToSiteDir($arValue, $siteID = ''){
		if(($siteID)){
			if(!is_array($arValue))
				$arValue=unserialize($arValue);
			
			if($arValue[0]){
				$imageSrc = $_SERVER['DOCUMENT_ROOT'].CFile::GetPath($arValue[0]);
			}
			else{
				if($arTemplate = self::GetSiteTemplate($siteID)){
					$imageSrc = str_replace('//', '/', $arTemplate['PATH'].'/images/favicon.ico');
				}
			}
			$arSite = CSite::GetByID($siteID)->Fetch();

			@unlink($imageDest = $arSite['ABS_DOC_ROOT'].'/'.$arSite['DIR'].'/favicon.ico');
			if(file_exists($imageSrc)){
				@copy($imageSrc, $arSite['ABS_DOC_ROOT'].'/'.$arSite['DIR'].'/favicon.ico');
			}else{
				@copy($arSite['ABS_DOC_ROOT'].'/'.$arSite['DIR'].'/include/favicon.ico', $arSite['ABS_DOC_ROOT'].'/'.$arSite['DIR'].'/favicon.ico');
			}
		}
	}

	public static function GetSiteTemplate($siteID = ''){
		$arTemplate = array();

		if(strlen($siteID)){
			$dbRes = CSite::GetTemplateList($siteID);
			while($arTemplate = $dbRes->Fetch()){
				if(!strlen($arTemplate['CONDITION'])){
					if(file_exists(($arTemplate['PATH'] = $_SERVER['DOCUMENT_ROOT'].'/bitrix/templates/'.$arTemplate['TEMPLATE']))){
						break;
					}
					elseif(file_exists(($arTemplate['PATH'] = $_SERVER['DOCUMENT_ROOT'].'/local/templates/'.$arTemplate['TEMPLATE']))){
						break;
					}
				}
			}
		}

		return $arTemplate;
	}

	public static function FormatSumm($strPrice, $quantity){
		$strSumm = '';

		if(strlen($strPrice = trim($strPrice))){
			$currency = '';
			$price = floatval(str_replace(' ', '', $strPrice));
			$summ = $price * $quantity;

			$strSumm = str_replace(trim(str_replace($currency, '', $price)), str_replace('.00', '', number_format($summ, 2, '.', ' ')), $price);
		}

		return $strSumm;
	}

	public static function FormatPriceShema($strPrice = ''){
		if(strlen($strPrice = trim($strPrice))){
			$arCur = array(
				'$' => 'USD',
				GetMessage('PRIORITY_CUR_EUR1') => 'EUR',
				GetMessage('PRIORITY_CUR_RUB1') => 'RUB',
				GetMessage('PRIORITY_CUR_RUB2') => 'RUB',
				GetMessage('PRIORITY_CUR_UAH1') => 'UAH',
				GetMessage('PRIORITY_CUR_UAH2') => 'UAH',
				GetMessage('PRIORITY_CUR_RUB3') => 'RUB',
				GetMessage('PRIORITY_CUR_RUB4') => 'RUB',
				GetMessage('PRIORITY_CUR_RUB5') => 'RUB',
				GetMessage('PRIORITY_CUR_RUB6') => 'RUB',
				GetMessage('PRIORITY_CUR_RUB3') => 'RUB',
				GetMessage('PRIORITY_CUR_UAH3') => 'UAH',
				GetMessage('PRIORITY_CUR_RUB5') => 'RUB',
				GetMessage('PRIORITY_CUR_UAH6') => 'UAH',
			);
			foreach($arCur as $curStr => $curCode){
				if(strpos($strPrice, $curStr) !== false){
					$priceVal = str_replace($curStr, '', $strPrice);
					return str_replace(array($curStr, $priceVal), array('<span class="currency" itemprop="priceCurrency" content="'.$curCode.'">'.$curStr.'</span>', '<span itemprop="price" content="'.$priceVal.'">'.$priceVal.'</span>'), $strPrice);
				}
			}
		}
		return $strPrice;
	}

	public static function GetBannerStyle($bannerwidth, $topmenu){
        /*$style = "";

        if($bannerwidth == "WIDE"){
            $style = ".maxwidth-banner{max-width: 1550px;}";
        }
        elseif($bannerwidth == "MIDDLE"){
            $style = ".maxwidth-banner{max-width: 1450px;}";
        }
        elseif($bannerwidth == "NARROW"){
            $style = ".maxwidth-banner{max-width: 1343px; padding: 0 16px;}";
			if($topmenu !== 'LIGHT'){
				$style .= ".banners-big{margin-top:20px;}";
			}
        }
        else{
            $style = ".maxwidth-banner{max-width: auto;}";
        }

        return "<style>".$style."</style>";*/
    }

    public static function GetIndexPageBlocks($pageAbsPath, $pageBlocksPrefix, $pageBlocksDirName = 'page_blocks'){
    	$arResult = array();

    	if($pageAbsPath && $pageBlocksPrefix){
    		$pageAbsPath = str_replace('//', '//', $pageAbsPath).'/';
    		if(is_dir($pageBlocksAbsPath = str_replace('', '', $pageAbsPath.(strlen($pageBlocksDirName) ? $pageBlocksDirName : '')))){
    			if($arPageBlocks = glob($pageBlocksAbsPath.'/*.php')){
		    		foreach($arPageBlocks as $file){
						$file = str_replace('.php', '', basename($file));
						if(strpos($file, $pageBlocksPrefix) !== false){
							$arResult[$file] = $file;
						}
					}
    			}
    		}
    	}

    	return $arResult;
    }

    public static function GetComponentTemplatePageBlocks($templateAbsPath, $pageBlocksDirName = 'page_blocks'){
    	$arResult = array('SECTIONS' => array(), 'SUBSECTIONS' => array(), 'ELEMENTS' => array(), 'ELEMENTS_TABLE' => array(), 'ELEMENTS_LIST' => array(), 'ELEMENTS_PRICE' => array(), 'ELEMENT' => array());

    	if($templateAbsPath){
    		$templateAbsPath = str_replace('//', '//', $templateAbsPath).'/';
    		if(is_dir($pageBlocksAbsPath = str_replace('//', '/', $templateAbsPath.(strlen($pageBlocksDirName) ? $pageBlocksDirName : '')))){
    			if($arPageBlocks = glob($pageBlocksAbsPath.'/*.php')){
		    		foreach($arPageBlocks as $file){
						$file = str_replace('.php', '', basename($file));
						if(strpos($file, 'sections_') !== false){
							$arResult['SECTIONS'][$file] = $file;
						}
						elseif(strpos($file, 'section_') !== false){
							$arResult['SUBSECTIONS'][$file] = $file;
						}
						elseif(strpos($file, 'list_elements_') !== false){
							$arResult['ELEMENTS'][$file] = $file;
						}
						elseif(strpos($file, 'catalog_table') !== false){
							$arResult['ELEMENTS_TABLE'][$file] = $file;
						}
						elseif(strpos($file, 'catalog_list') !== false){
							$arResult['ELEMENTS_LIST'][$file] = $file;
						}
						elseif(strpos($file, 'catalog_price') !== false){
							$arResult['ELEMENTS_PRICE'][$file] = $file;
						}
						elseif(strpos($file, 'element_') !== false){
							$arResult['ELEMENT'][$file] = $file;
						}
					}
    			}
    		}
    	}

    	return $arResult;
    }
	
    public static function GetComponentTemplatePageBlocksParams($arPageBlocks){
    	$arResult = array();

    	if($arPageBlocks && is_array($arPageBlocks)){
    		if(isset($arPageBlocks['SECTIONS']) && $arPageBlocks['SECTIONS'] && is_array($arPageBlocks['SECTIONS'])){
    			$arResult['SECTIONS_TYPE_VIEW'] = array(
					'PARENT' => 'BASE',
					'SORT' => 1,
					'NAME' => GetMessage('M_SECTIONS_TYPE_VIEW'),
					'TYPE' => 'LIST',
					'VALUES' => $arPageBlocks['SECTIONS'],
					'DEFAULT' => key($arPageBlocks['SECTIONS']),
				);
    		}
    		if(isset($arPageBlocks['SUBSECTIONS']) && $arPageBlocks['SUBSECTIONS'] && is_array($arPageBlocks['SUBSECTIONS'])){
    			$arResult['SECTION_TYPE_VIEW'] = array(
					'PARENT' => 'BASE',
					'SORT' => 1,
					'NAME' => GetMessage('M_SECTION_TYPE_VIEW'),
					'TYPE' => 'LIST',
					'VALUES' => $arPageBlocks['SUBSECTIONS'],
					'DEFAULT' => key($arPageBlocks['SUBSECTIONS']),
				);
    		}
    		if(isset($arPageBlocks['ELEMENTS']) && $arPageBlocks['ELEMENTS'] && is_array($arPageBlocks['ELEMENTS'])){
    			$arResult['SECTION_ELEMENTS_TYPE_VIEW'] = array(
					'PARENT' => 'BASE',
					'SORT' => 1,
					'NAME' => GetMessage('M_SECTION_ELEMENTS_TYPE_VIEW'),
					'TYPE' => 'LIST',
					'VALUES' => $arPageBlocks['ELEMENTS'],
					'DEFAULT' => key($arPageBlocks['ELEMENTS']),
				);
    		}
    		if(isset($arPageBlocks['ELEMENTS_PRICE']) && $arPageBlocks['ELEMENTS_PRICE'] && is_array($arPageBlocks['ELEMENTS_PRICE'])){
    			$arResult['ELEMENTS_PRICE_TYPE_VIEW'] = array(
					'PARENT' => 'BASE',
					'SORT' => 1,
					'NAME' => GetMessage('M_ELEMENTS_PRICE_TYPE_VIEW'),
					'TYPE' => 'LIST',
					'VALUES' => $arPageBlocks['ELEMENTS_PRICE'],
					'DEFAULT' => key($arPageBlocks['ELEMENTS_PRICE']),
				);
    		}
    		if(isset($arPageBlocks['ELEMENTS_LIST']) && $arPageBlocks['ELEMENTS_LIST'] && is_array($arPageBlocks['ELEMENTS_LIST'])){
    			$arResult['ELEMENTS_LIST_TYPE_VIEW'] = array(
					'PARENT' => 'BASE',
					'SORT' => 1,
					'NAME' => GetMessage('M_ELEMENTS_LIST_TYPE_VIEW'),
					'TYPE' => 'LIST',
					'VALUES' => $arPageBlocks['ELEMENTS_LIST'],
					'DEFAULT' => key($arPageBlocks['ELEMENTS_LIST']),
				);
    		}
    		if(isset($arPageBlocks['ELEMENTS_TABLE']) && $arPageBlocks['ELEMENTS_TABLE'] && is_array($arPageBlocks['ELEMENTS_TABLE'])){
    			$arResult['ELEMENTS_TABLE_TYPE_VIEW'] = array(
					'PARENT' => 'BASE',
					'SORT' => 1,
					'NAME' => GetMessage('M_ELEMENTS_TABLE_TYPE_VIEW'),
					'TYPE' => 'LIST',
					'VALUES' => $arPageBlocks['ELEMENTS_TABLE'],
					'DEFAULT' => key($arPageBlocks['ELEMENTS_TABLE']),
				);
    		}
    		/*if(isset($arPageBlocks['SECTIONS_TYPE_VIEW']) && $arPageBlocks['SECTIONS_TYPE_VIEW'] && is_array($arPageBlocks['SECTIONS_TYPE_VIEW'])){
    			$arResult['SECTIONS_TYPE_VIEW'] = array(
					'PARENT' => 'BASE',
					'SORT' => 1,
					'NAME' => GetMessage('M_SECTIONS_TYPE_VIEW'),
					'TYPE' => 'LIST',
					'VALUES' => $arPageBlocks['SECTIONS_TYPE_VIEW'],
					'DEFAULT' => key($arPageBlocks['SECTIONS_TYPE_VIEW']),
				);
    		}*/
    		if(isset($arPageBlocks['ELEMENT']) && $arPageBlocks['ELEMENT'] && is_array($arPageBlocks['ELEMENT'])){
    			$arResult['ELEMENT_TYPE_VIEW'] = array(
					'PARENT' => 'BASE',
					'SORT' => 1,
					'NAME' => GetMessage('M_ELEMENT_TYPE_VIEW'),
					'TYPE' => 'LIST',
					'VALUES' => $arPageBlocks['ELEMENT'],
					'DEFAULT' => key($arPageBlocks['ELEMENT']),
				);
    		}
    	}

    	return $arResult;
    }


   protected function IsComponentTemplateHasModuleElementsPageBlocksParam($templateName, $arExtParams = array()){
    	$section_param = ((isset($arExtParams['SECTION']) && $arExtParams['SECTION']) ? $arExtParams['SECTION'] : 'SECTION');
		$template_param = ((isset($arExtParams['OPTION']) && $arExtParams['OPTION']) ? $arExtParams['OPTION'] : strtoupper($templateName));	

	    return $templateName && isset(self::$arParametrsList[$section_param]['OPTIONS'][$template_param.'_PAGE']);
    }

    protected function IsComponentTemplateHasModuleElementPageBlocksParam($templateName, $arExtParams = array()){
    	$section_param = ((isset($arExtParams['SECTION']) && $arExtParams['SECTION']) ? $arExtParams['SECTION'] : 'SECTION');
    	$template_param = ((isset($arExtParams['OPTION']) && $arExtParams['OPTION']) ? $arExtParams['OPTION'] : strtoupper($templateName));
	    return $templateName && isset(self::$arParametrsList[$section_param]['OPTIONS'][$template_param.'_PAGE_DETAIL']);
    }

    protected function IsComponentTemplateHasModuleElementsTemplatePageBlocksParam($templateName, $arExtParams = array()){
    	$section_param = ((isset($arExtParams['SECTION']) && $arExtParams['SECTION']) ? $arExtParams['SECTION'] : 'SECTION');
    	$template_param = ((isset($arExtParams['OPTION']) && $arExtParams['OPTION']) ? $arExtParams['OPTION'] : strtoupper($templateName));
		$custom_param = (isset($arExtParams['CUSTOM_PARAM']) && strlen($arExtParams['CUSTOM_PARAM']) ? strtoupper($arExtParams['CUSTOM_PARAM']) : '');
		
		if(isset($arExtParams['CUSTOM_PARAM']) && strlen($arExtParams['CUSTOM_PARAM'])){
			return $templateName && isset(self::$arParametrsList[$section_param]['OPTIONS'][$arExtParams['CUSTOM_PARAM']]);
		}
		else{
			return $templateName && isset(self::$arParametrsList[$section_param]['OPTIONS'][$template_param]);
		}
    }

    public static function AddComponentTemplateModulePageBlocksParams($templateAbsPath, &$arParams, $arExtParams = array()){
    	if($templateAbsPath && $arParams && is_array($arParams)){
    		$templateAbsPath = str_replace('//', '//', $templateAbsPath).'/';
    		$templateName = basename($templateAbsPath);
			
    		if(self::IsComponentTemplateHasModuleElementsPageBlocksParam($templateName, $arExtParams)){
    			$arParams['SECTION_ELEMENTS_TYPE_VIEW']['VALUES'] = array_merge(array('FROM_MODULE' => GetMessage('M_FROM_MODULE_PARAMS')), $arParams['SECTION_ELEMENTS_TYPE_VIEW']['VALUES']);
    			$arParams['SECTION_ELEMENTS_TYPE_VIEW']['DEFAULT'] = 'FROM_MODULE';
    		}
    		if(self::IsComponentTemplateHasModuleElementPageBlocksParam($templateName, $arExtParams)){
    			$arParams['ELEMENT_TYPE_VIEW']['VALUES'] = array_merge(array('FROM_MODULE' => GetMessage('M_FROM_MODULE_PARAMS')), $arParams['ELEMENT_TYPE_VIEW']['VALUES']);
    			$arParams['ELEMENT_TYPE_VIEW']['DEFAULT'] = 'FROM_MODULE';
    		}
    		if(self::IsComponentTemplateHasModuleElementsTemplatePageBlocksParam($templateName, $arExtParams)){
    			$arParams[$arExtParams['OPTION']]['VALUES'] = array_merge(array('FROM_MODULE' => GetMessage('M_FROM_MODULE_PARAMS')), $arParams[$arExtParams['OPTION']]['VALUES']);
    			$arParams[$arExtParams['OPTION']]['DEFAULT'] = 'FROM_MODULE';
    		}
    	}
    }

    public static function CheckComponentTemplatePageBlocksParams(&$arParams, $templateAbsPath, $pageBlocksDirName = 'page_blocks'){
    	$arPageBlocks = self::GetComponentTemplatePageBlocks($templateAbsPath, $pageBlocksDirName);

    	if(!isset($arParams['SECTIONS_TYPE_VIEW']) || !$arParams['SECTIONS_TYPE_VIEW'] || (!isset($arPageBlocks['SECTIONS'][$arParams['SECTIONS_TYPE_VIEW']]) && $arParams['SECTIONS_TYPE_VIEW'] !== 'FROM_MODULE')){
    		$arParams['SECTIONS_TYPE_VIEW'] = key($arPageBlocks['SECTIONS']);
    	}
    	if(!isset($arParams['SECTION_TYPE_VIEW']) || !$arParams['SECTION_TYPE_VIEW'] || (!isset($arPageBlocks['SUBSECTIONS'][$arParams['SECTION_TYPE_VIEW']]) && $arParams['SECTION_TYPE_VIEW'] !== 'FROM_MODULE')){
    		$arParams['SECTION_TYPE_VIEW'] = key($arPageBlocks['SUBSECTIONS']);
    	}
    	if(!isset($arParams['SECTION_ELEMENTS_TYPE_VIEW']) || !$arParams['SECTION_ELEMENTS_TYPE_VIEW'] || (!isset($arPageBlocks['ELEMENTS'][$arParams['SECTION_ELEMENTS_TYPE_VIEW']]) && $arParams['SECTION_ELEMENTS_TYPE_VIEW'] !== 'FROM_MODULE')){
    		$arParams['SECTION_ELEMENTS_TYPE_VIEW'] = key($arPageBlocks['ELEMENTS']);
    	}
    	if(!isset($arParams['ELEMENTS_TABLE_TYPE_VIEW']) || !$arParams['ELEMENTS_TABLE_TYPE_VIEW'] || (!isset($arPageBlocks['ELEMENTS_TABLE'][$arParams['ELEMENTS_TABLE_TYPE_VIEW']]) && $arParams['ELEMENTS_TABLE_TYPE_VIEW'] !== 'FROM_MODULE')){
    		$arParams['ELEMENTS_TABLE_TYPE_VIEW'] = key($arPageBlocks['ELEMENTS_TABLE']);
    	}
    	if(!isset($arParams['ELEMENTS_LIST_TYPE_VIEW']) || !$arParams['ELEMENTS_LIST_TYPE_VIEW'] || (!isset($arPageBlocks['ELEMENTS_LIST'][$arParams['ELEMENTS_LIST_TYPE_VIEW']]) && $arParams['ELEMENTS_LIST_TYPE_VIEW'] !== 'FROM_MODULE')){
    		$arParams['ELEMENTS_LIST_TYPE_VIEW'] = key($arPageBlocks['ELEMENTS_LIST']);
    	}
    	if(!isset($arParams['ELEMENTS_PRICE_TYPE_VIEW']) || !$arParams['ELEMENTS_PRICE_TYPE_VIEW'] || (!isset($arPageBlocks['ELEMENTS_PRICE'][$arParams['ELEMENTS_PRICE_TYPE_VIEW']]) && $arParams['ELEMENTS_PRICE_TYPE_VIEW'] !== 'FROM_MODULE')){
    		$arParams['ELEMENTS_PRICE_TYPE_VIEW'] = key($arPageBlocks['ELEMENTS_PRICE']);
    	}
    	if(!isset($arParams['ELEMENT_TYPE_VIEW']) || !$arParams['ELEMENT_TYPE_VIEW'] || (!isset($arPageBlocks['ELEMENT'][$arParams['ELEMENT_TYPE_VIEW']]) && $arParams['ELEMENT_TYPE_VIEW'] !== 'FROM_MODULE')){
    		$arParams['ELEMENT_TYPE_VIEW'] = key($arPageBlocks['ELEMENT']);
    	}
    }

    public static function Add2OptionCustomComponentTemplatePageBlocks(&$arOption, $templateAbsPath){
		if($arOption && isset($arOption['LIST'])){
			if($arPageBlocks = self::GetComponentTemplatePageBlocks($templateAbsPath)){
				foreach($arPageBlocks['ELEMENTS'] as $page => $value){
					if(!isset($arOption['LIST'][$page])){
						$arOption['LIST'][$page] = array(
							'TITLE' => $value,
							'HIDE' => 'Y',
							'IS_CUSTOM' => 'Y',
						);
					}
				}
				if(!$arOption['DEFAULT'] && $arOption['LIST']){
					$arOption['DEFAULT'] = key($arOption['LIST']);
				}
			}
		}
    }

    public static function Add2OptionCustomComponentTemplatePageBlocksElement(&$arOption, $templateAbsPath, $field = 'ELEMENT'){
		if($arOption && isset($arOption['LIST'])){

			if($arPageBlocks = self::GetComponentTemplatePageBlocks($templateAbsPath)){
				foreach($arPageBlocks[$field] as $page => $value){
					if(!isset($arOption['LIST'][$page])){
						$arOption['LIST'][$page] = array(
							'TITLE' => $value,
							'HIDE' => 'Y',
							'IS_CUSTOM' => 'Y',
						);
					}
				}
				if(!$arOption['DEFAULT'] && $arOption['LIST']){
					$arOption['DEFAULT'] = key($arOption['LIST']);
				}
			}
		}
    }
	
	public static function OnSearchGetURL($arFields)
    {
    	if(strpos($arFields["URL"], "#YEAR#") !== false)
    	{
			$arElement = CCache::CIblockElement_GetList(array('CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arFields['PARAM2']), 'MULTI' => 'N')), array('ID' => $arFields['ITEM_ID']), false, false, array('ID', 'ACTIVE_FROM'));
	    	if($arElement['ACTIVE_FROM'])
	    	{
	    		if($arDateTime = ParseDateTime($arElement['ACTIVE_FROM'], FORMAT_DATETIME))
	    		{
			        $url = str_replace("#YEAR#", $arDateTime['YYYY'], $arFields['URL']);
			        return $url;
	    		}
	    	}
    	}
		return $arFields["URL"];
    }

    public static function FormatNewsUrl($arItem){
    	$url = $arItem['DETAIL_PAGE_URL'];
    	if(strlen($arItem['DISPLAY_PROPERTIES']['REDIRECT']['VALUE']))
		{
			$url = $arItem['DISPLAY_PROPERTIES']['REDIRECT']['VALUE'];
			return $url;
		}
    	if($arItem['ACTIVE_FROM'])
    	{
    		if($arDateTime = ParseDateTime($arItem['ACTIVE_FROM'], FORMAT_DATETIME))
    		{
		        $url = str_replace("#YEAR#", $arDateTime['YYYY'], $arItem['DETAIL_PAGE_URL']);
		        return $url;
    		}
    	}
    	return $url;
    }

    public static function GetItemsYear($arParams){
    	$arResult = array();
    	$arItems = CCache::CIBLockElement_GetList(array('SORT' => 'ASC', 'NAME' => 'ASC', 'CACHE' => array('TAG' => CCache::GetIBlockCacheTag($arParams['IBLOCK_ID']))), array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'ACTIVE' => 'Y'), false, false, array('ID', 'NAME', 'ACTIVE_FROM'));
		if($arItems)
		{
			foreach($arItems as $arItem)
			{
				if($arItem['ACTIVE_FROM'])
				{
					if($arDateTime = ParseDateTime($arItem['ACTIVE_FROM'], FORMAT_DATETIME))
						$arResult[$arDateTime['YYYY']] = $arDateTime['YYYY'];
				}
			}
		}
		return $arResult;
    }

	public static function GetDirMenuParametrs($dir){
		if(strlen($dir)){
			$file = str_replace('//', '/', $dir.'/.section.php');
			if(file_exists($file)){
				@include($file);
				return $arDirProperties;
			}
		}

		return false;
	}

	public static function IsMainPage(){
		static $result;

		if(!isset($result))
			$result = CSite::InDir(SITE_DIR.'index.php');

		return $result;
	}

	public static function IsBasketPage($url_link = ''){
		static $result;

		if(!isset($result)){
			if(!$url_link)
			{
				$arOptions = self::GetBackParametrsValues(SITE_ID);
				if(!strlen($arOptions["URL_BASKET_SECTION"]))
					$arOptions["URL_BASKET_SECTION"] = SITE_DIR."cart/";
				$url_link = $arOptions["URL_BASKET_SECTION"];
			}
			$result = CSite::InDir($url_link);
		}

		return $result;
	}

	public static function IsOrderPage($url_link = ''){
		static $result;

		if(!isset($result)){
			if(!$url_link)
			{
				$arOptions = self::GetBackParametrsValues(SITE_ID);
				if(!strlen($arOptions["URL_ORDER_SECTION"]))
					$arOptions["URL_ORDER_SECTION"] = SITE_DIR."cart/order/";
				$url_link = $arOptions["URL_ORDER_SECTION"];
			}
			$result = CSite::InDir($url_link);
		}

		return $result;
	}

	public static function getConditionClass(){
		global $APPLICATION;
		$class = '';
		if($APPLICATION->GetProperty('MENU') === 'N')
			$class = 'hide_menu_page';
		if($APPLICATION->GetProperty('HIDETITLE') === 'N')
			$class .= ' hide_title_page';
		if($APPLICATION->GetProperty('FULLWIDTH') === 'Y')
			$class .= ' wide_page';

		$arSiteThemeOptions = self::GetFrontParametrsValues(SITE_ID);
		$class .= ' regionality_'.strtolower($arSiteThemeOptions['USE_REGIONALITY']);

		return $class;
	}

	public static function goto404Page(){
		global $APPLICATION;

		if($_SESSION['SESS_INCLUDE_AREAS']){
			echo '</div>';
		}
		echo '</div>';
		$APPLICATION->IncludeFile(SITE_DIR.'404.php', array(), array('MODE' => 'html'));
		die();
	}

	public static function checkRestartBuffer(){
		global $APPLICATION;
		static $bRestarted;

		if($bRestarted)
			die();


		if((isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == "xmlhttprequest") || (strtolower($_REQUEST['ajax']) == 'y'))
		{
			$APPLICATION->RestartBuffer();
			$bRestarted = true;
		}
	}

	public static function UpdateFormEvent(&$arFields){
		if($arFields['ID'] && $arFields['IBLOCK_ID'])
		{
			// find aspro form event for this iblock
			$arEventIDs = array('ASPRO_SEND_FORM_'.$arFields['IBLOCK_ID'], 'ASPRO_SEND_FORM_ADMIN_'.$arFields['IBLOCK_ID']);
			$arLangIDs = array('ru', 'en');
			static $arEvents;
			if($arEvents == NULL)
			{
				foreach($arEventIDs as $EVENT_ID)
				{
					foreach($arLangIDs as $LANG_ID)
					{
						$resEvents = CEventType::GetByID($EVENT_ID, $LANG_ID);
						$arEvents[$EVENT_ID][$LANG_ID] = $resEvents->Fetch();
					}
				}
			}
			if($arEventIDs)
			{
				foreach($arEventIDs as $EVENT_ID)
				{
					foreach($arLangIDs as $LANG_ID)
					{
						if($arEvent = &$arEvents[$EVENT_ID][$LANG_ID])
						{
							if(strpos($arEvent['DESCRIPTION'], $arFields['NAME'].': #'.$arFields['CODE'].'#') === false){
								$arEvent['DESCRIPTION'] = str_replace('#'.$arFields['CODE'].'#', '-', $arEvent['DESCRIPTION']);
								$arEvent['DESCRIPTION'] .= $arFields['NAME'].': #'.$arFields['CODE']."#\n";
								CEventType::Update(array('ID' => $arEvent['ID']), $arEvent);
							}
						}
					}
				}
			}
		}
	}

	public static function ShowHeaderPhones($class = ''){
		global $arRegion;
		static $hphones_call;

		$iCalledID = ++$hphones_call;
		$arBackParametrs = self::GetBackParametrsValues(SITE_ID);
		$iCountPhones = ($arRegion ? count($arRegion['PHONES']) : $arBackParametrs['HEADER_PHONES']);
		?>
		<?if($arRegion):?>
			<?$frame = new \Bitrix\Main\Page\FrameHelper('header-allphones-block'.$iCalledID);?>
			<?$frame->begin();?>
		<?endif;?>

		<?if($iCountPhones): // count of phones?>
			<?
			$phone = ($arRegion ? $arRegion['PHONES'][0] : $arBackParametrs['HEADER_PHONES_array_PHONE_VALUE_0']);
			$href = 'tel:'.str_replace(array(' ', '-', '(', ')'), '', $phone);
			?>
			<div class="phone<?=($iCountPhones > 1 ? ' with_dropdown' : '')?>">
				<div class="wrap">
					<div>
						<svg class="svg svg-phone<?=($class ? ' '.$class : '')?>" width="5" height="13" viewBox="0 0 5 13">
							<path class="cls-phone" d="M785.738,193.457a22.174,22.174,0,0,0,1.136,2.041,0.62,0.62,0,0,1-.144.869l-0.3.3a0.908,0.908,0,0,1-.805.33,4.014,4.014,0,0,1-1.491-.274c-1.2-.679-1.657-2.35-1.9-3.664a13.4,13.4,0,0,1,.024-5.081c0.255-1.316.73-2.991,1.935-3.685a4.025,4.025,0,0,1,1.493-.288,0.888,0.888,0,0,1,.8.322l0.3,0.3a0.634,0.634,0,0,1,.113.875c-0.454.8-.788,1.37-1.132,2.045-0.143.28-.266,0.258-0.557,0.214l-0.468-.072a0.532,0.532,0,0,0-.7.366,8.047,8.047,0,0,0-.023,4.909,0.521,0.521,0,0,0,.7.358l0.468-.075c0.291-.048.4-0.066,0.555,0.207h0Z" transform="translate(-782 -184)"/>
						</svg>
						<a href="<?=$href?>"><?=$phone?></a>
					</div>
				</div>
				<?if($iCountPhones > 1): // if more than one?>
					<div class="dropdown">
						<div class="wrap">
							<?for($i = 1; $i < $iCountPhones; ++$i):?>
								<?
								$phone = ($arRegion ? $arRegion['PHONES'][$i] : $arBackParametrs['HEADER_PHONES_array_PHONE_VALUE_'.$i]);
								$href = 'tel:'.str_replace(array(' ', '-', '(', ')'), '', $phone);
								?>
								<div class="more_phone"><a href="<?=$href?>"><?=$phone?></a></div>
							<?endfor;?>
						</div>
					</div>
				<?endif;?>
			</div>
		<?endif;?>

		<?if($arRegion):?>
			<?$frame->end();?>
		<?endif;?>
		<?
	}

	public static function showAddress($class = ''){
		global $arRegion, $APPLICATION;
		static $addr_call;
		$iCalledID = ++$addr_call;
		$regionID = ($arRegion ? $arRegion['ID'] : '');?>

		<?if($arRegion):?>
		<?$frame = new \Bitrix\Main\Page\FrameHelper('address-block'.$iCalledID);?>
		<?$frame->begin();?>
		<?endif;?>

			<?if($arRegion):?>
				<?if($arRegion['PROPERTY_ADDRESS_VALUE']):?>
					<div <?=($class ? 'class="'.$class.'"' : '')?>>
						<?=$arRegion['PROPERTY_ADDRESS_VALUE']['TEXT'];?>
					</div>
				<?endif;?>
			<?else:?>
				<div <?=($class ? 'class="'.$class.'"' : '')?>>
					<?$APPLICATION->IncludeFile(SITE_DIR."include/header/site-address.php", array(), array(
							"MODE" => "html",
							"NAME" => "Address",
							"TEMPLATE" => "include_area.php",
						)
					);?>
				</div>
			<?endif;?>

		<?if($arRegion):?>
		<?$frame->end();?>
		<?endif;?>

	<?}

	public static function showEmail($class = ''){
		global $arRegion, $APPLICATION;
		static $email_call;
		$iCalledID = ++$email_call;
		$regionID = ($arRegion ? $arRegion['ID'] : '');?>

		<?if($arRegion):?>
		<?$frame = new \Bitrix\Main\Page\FrameHelper('email-block'.$iCalledID);?>
		<?$frame->begin();?>
		<?endif;?>

			<?if($arRegion):?>
				<?if($arRegion['PROPERTY_EMAIL_VALUE']):?>
					<div <?=($class ? 'class="'.$class.'"' : '')?>>
						<?foreach($arRegion['PROPERTY_EMAIL_VALUE'] as $value):?>
							<a href="mailto:<?=$value;?>"><span><?=$value;?></span></a>
						<?endforeach;?>
					</div>
				<?endif;?>
			<?else:?>
				<div <?=($class ? 'class="'.$class.'"' : '')?>>
					<?$APPLICATION->IncludeFile(SITE_DIR."include/footer/site-email.php", array(), array(
							"MODE" => "html",
							"NAME" => "Address",
							"TEMPLATE" => "include_area.php",
						)
					);?>
				</div>
			<?endif;?>

		<?if($arRegion):?>
		<?$frame->end();?>
		<?endif;?>

	<?}

	public static function checkBasketItems(){
		if(!defined(ADMIN_SECTION) && !CSite::inDir(SITE_DIR.'/ajax/')){
			?>
			<script>
				var arBasketItems = <?=CUtil::PhpToJSObject(self::getBasketItems(), false)?>;
			</script>
			<?
		}
	}

	public static function getBasketItems(){
		global $APPLICATION, $arSite, $USER;
		CModule::IncludeModule('iblock');

		if(!defined(ADMIN_SECTION)){
			$userID = CUser::GetID();
			$userID = ($userID > 0 ? $userID : 0);
			$arBackParametrs = self::GetFrontParametrsValues(SITE_ID);
			$bOrderViewBasket = ($arBackParametrs['ORDER_VIEW'] == 'Y' ? true : false);

			if($bOrderViewBasket && isset($_SESSION[SITE_ID][$userID]['BASKET_ITEMS']) && is_array($_SESSION[SITE_ID][$userID]['BASKET_ITEMS']) && $_SESSION[SITE_ID][$userID]['BASKET_ITEMS']){
				$arIBlocks = $arBasketItemsIDs = array();

				foreach($_SESSION[SITE_ID][$userID]['BASKET_ITEMS'] as $arBasketItem){
					if(isset($arBasketItem['IBLOCK_ID']) && intval($arBasketItem['IBLOCK_ID']) > 0 && !in_array($arBasketItem['IBLOCK_ID'], $arIBlocks))
						$arIBlocks[] = $arBasketItem['IBLOCK_ID'];

					$arBasketItemsIDs[] = $arBasketItem['ID'];
				}

				$dbRes = CIBlockElement::GetList(array(), array('IBLOCK_ID' => $arIBlocks, 'ID' => $arBasketItemsIDs, 'PROPERTY_FORM_ORDER_VALUE' => false), false, false, array('ID'));
				while($arRes = $dbRes->Fetch()){
					unset($_SESSION[SITE_ID][$userID]['BASKET_ITEMS'][$arRes['ID']]);
				}

				return $_SESSION[SITE_ID][$userID]['BASKET_ITEMS'];
			}

			return array();
		}

		return false;
	}

	// DO NOT USE - FOR OLD VERSIONS
	public static function linkShareImage($previewPictureID = false, $detailPictureID = false){
		global $APPLICATION;

		if($linkSaherImageID = ($detailPictureID ? $detailPictureID : ($previewPictureID ? $previewPictureID : false)))
			$APPLICATION->AddHeadString('<link rel="image_src" href="'.CFile::GetPath($linkSaherImageID).'"  />', true);
	}

	public static function processBasket(){
		global $USER;
		$userID = CUser::GetID();
		$userID = ($userID > 0 ? $userID : 0);

		if(isset($_REQUEST['itemData']) && is_array($_REQUEST['itemData']))
			$_REQUEST['itemData'] = array_map('self::conv', $_REQUEST['itemData']);

		if(isset($_REQUEST['removeAll']) && $_REQUEST['removeAll'] === 'Y')
		{
			unset($_SESSION[SITE_ID][$userID]['BASKET_ITEMS']);
		}
		elseif(isset($_REQUEST['itemData']['ID']) && intval($_REQUEST['itemData']['ID']) > 0)
		{
			if(!is_array($_SESSION[SITE_ID][$userID]['BASKET_ITEMS']))
				$_SESSION[SITE_ID][$userID]['BASKET_ITEMS'] = array();


			if(isset($_REQUEST['remove']) && $_REQUEST['remove'] === 'Y')
			{
				if(isset($_SESSION[SITE_ID][$userID]['BASKET_ITEMS']) && isset($_SESSION[SITE_ID][$userID]['BASKET_ITEMS'][$_REQUEST['itemData']['ID']])){
					unset($_SESSION[SITE_ID][$userID]['BASKET_ITEMS'][$_REQUEST['itemData']['ID']]);
				}
			}
			elseif(isset($_REQUEST['quantity']) && floatval($_REQUEST['quantity']) > 0)
			{
				$_SESSION[SITE_ID][$userID]['BASKET_ITEMS'][$_REQUEST['itemData']['ID']] = (isset($_SESSION[SITE_ID][$userID]['BASKET_ITEMS'][$_REQUEST['itemData']['ID']]) ? $_SESSION[SITE_ID][$userID]['BASKET_ITEMS'][$_REQUEST['itemData']['ID']] : $_REQUEST['itemData']);
				$_SESSION[SITE_ID][$userID]['BASKET_ITEMS'][$_REQUEST['itemData']['ID']]['QUANTITY'] = $_REQUEST['quantity'];

			}
		}
		return $_SESSION[SITE_ID][$userID]['BASKET_ITEMS'];
	}

	public static function conv($n){
		return iconv('UTF-8', SITE_CHARSET, $n);
	}

	public static function getDataItem($el){
		$dataItem = array(
			"IBLOCK_ID" => $el['IBLOCK_ID'],
			"ID" => $el['ID'],
			"NAME" => $el['NAME'],
			"DETAIL_PAGE_URL" => $el['DETAIL_PAGE_URL'],
			"PREVIEW_PICTURE" => $el['PREVIEW_PICTURE']['ID'],
			"DETAIL_PICTURE" => $el['DETAIL_PICTURE']['ID'],
			"PROPERTY_FILTER_PRICE_VALUE" => $el['PROPERTIES']['FILTER_PRICE']['VALUE'],
			"PROPERTY_PRICE_VALUE" => $el['PROPERTIES']['PRICE']['VALUE'],
			"PROPERTY_PRICEOLD_VALUE" => $el['PROPERTIES']['PRICEOLD']['VALUE'],
			"PROPERTY_ARTICLE_VALUE" => $el['PROPERTIES']['ARTICLE']['VALUE'],
			"PROPERTY_STATUS_VALUE" => $el['PROPERTIES']['STATUS']['VALUE_ENUM_ID'],
		);

		global $APPLICATION;
		$dataItem = $APPLICATION->ConvertCharsetArray($dataItem, SITE_CHARSET, 'UTF-8');
		$dataItem = htmlspecialchars(json_encode($dataItem));
		return $dataItem;
	}

	public static function utf8_substr_replace($original, $replacement, $position, $length){
		$startString = mb_substr($original, 0, $position, "UTF-8");
		$endString = mb_substr($original, $position + $length, mb_strlen($original), "UTF-8");

		$out = $startString.$replacement.$endString;

		return $out;
	}

	public static function ShowRSSIcon($href){
		?>
		<style type="text/css">h1{padding-right:50px;}</style>
		<script>
		$(document).ready(function () {
			if($('.detail.news .top-wrapper').length){
				$('.detail.news .top-wrapper').prepend('<a class="rss" href="<?=$href?>" title="rss" target="_blank"><svg width="14" height="14" viewBox="0 0 14 14"><path d="M941,196a1,1,0,0,0,1-1v-1a10,10,0,0,1,10-10h1a1,1,0,0,0,0-2h-1a12,12,0,0,0-12,12v1A1,1,0,0,0,941,196Zm12-9h-1a7,7,0,0,0-7,7v1a1,1,0,1,0,2,0v-1a5,5,0,0,1,5-5h1A1,1,0,0,0,953,187Zm-1,5a2,2,0,1,0,2,2A2,2,0,0,0,952,192Z" transform="translate(-940 -182)"/></svg></a>');
			}
			else{
				$('h1').before('<a class="rss" href="<?=$href?>" title="rss" target="_blank"><svg width="14" height="14" viewBox="0 0 14 14"><path d="M941,196a1,1,0,0,0,1-1v-1a10,10,0,0,1,10-10h1a1,1,0,0,0,0-2h-1a12,12,0,0,0-12,12v1A1,1,0,0,0,941,196Zm12-9h-1a7,7,0,0,0-7,7v1a1,1,0,1,0,2,0v-1a5,5,0,0,1,5-5h1A1,1,0,0,0,953,187Zm-1,5a2,2,0,1,0,2,2A2,2,0,0,0,952,192Z" transform="translate(-940 -182)"/></svg></a>');
			}
		});
		</script>
		<?
		$GLOBALS['APPLICATION']->AddHeadString('<link rel="alternate" type="application/rss+xml" title="rss" href="'.$href.'" />');
	}

	public static function getFieldImageData(array &$arItem, array $arKeys, $entity = 'ELEMENT', $ipropertyKey = 'IPROPERTY_VALUES'){
		if (empty($arItem) || empty($arKeys))
            return;

        $entity = (string)$entity;
        $ipropertyKey = (string)$ipropertyKey;

        foreach ($arKeys as $fieldName)
        {
            if(!isset($arItem[$fieldName]) || (!isset($arItem['~'.$fieldName]) || !$arItem['~'.$fieldName]))
                continue;
            $imageData = false;
            $imageId = (int)$arItem['~'.$fieldName];
            if ($imageId > 0)
                $imageData = \CFile::getFileArray($imageId);
            unset($imageId);
            if (is_array($imageData))
            {
                if (isset($imageData['SAFE_SRC']))
                {
                    $imageData['UNSAFE_SRC'] = $imageData['SRC'];
                    $imageData['SRC'] = $imageData['SAFE_SRC'];
                }
                else
                {
                    $imageData['UNSAFE_SRC'] = $imageData['SRC'];
                    $imageData['SRC'] = \CHTTP::urnEncode($imageData['SRC'], 'UTF-8');
                }
                $imageData['ALT'] = '';
                $imageData['TITLE'] = '';

                if ($ipropertyKey != '' && isset($arItem[$ipropertyKey]) && is_array($arItem[$ipropertyKey]))
                {
                    $entityPrefix = $entity.'_'.$fieldName;
                    if (isset($arItem[$ipropertyKey][$entityPrefix.'_FILE_ALT']))
                        $imageData['ALT'] = $arItem[$ipropertyKey][$entityPrefix.'_FILE_ALT'];
                    if (isset($arItem[$ipropertyKey][$entityPrefix.'_FILE_TITLE']))
                        $imageData['TITLE'] = $arItem[$ipropertyKey][$entityPrefix.'_FILE_TITLE'];
                    unset($entityPrefix);
                }
                if ($imageData['ALT'] == '' && isset($arItem['NAME']))
                    $imageData['ALT'] = $arItem['NAME'];
                if ($imageData['TITLE'] == '' && isset($arItem['NAME']))
                    $imageData['TITLE'] = $arItem['NAME'];
            }
            $arItem[$fieldName] = $imageData;
            unset($imageData);
        }

        unset($fieldName);
	}

	public static function drawFormField($FIELD_SID, $arQuestion, $type = 'POPUP'){?>
		<?$arQuestion["HTML_CODE"] = str_replace('name=', 'data-sid="'.$FIELD_SID.'" name=', $arQuestion["HTML_CODE"]);?>
		<?$arQuestion["HTML_CODE"] = str_replace('left', '', $arQuestion["HTML_CODE"]);?>
		<?$arQuestion["HTML_CODE"] = str_replace('size="0"', '', $arQuestion["HTML_CODE"]);?>
		<?if($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden' && $FIELD_SID != 'RATING'):?>
			<?=$arQuestion["HTML_CODE"];?>
		<?else:?>
			<div class="row" data-SID="<?=$FIELD_SID?>">
				<div class="col-md-12">
					<div class="form-group <?=( $arQuestion['STRUCTURE'][0]['FIELD_TYPE'] != "file" ? "animated-labels" : "");?> <?=( $arQuestion['VALUE'] || $_REQUEST['form_'.$arQuestion['STRUCTURE'][0]['FIELD_TYPE'].'_'.$arQuestion['STRUCTURE'][0]['ID']] || $arQuestion['STRUCTURE'][0]['VALUE'] ? "input-filed" : "");?><?=( $arQuestion['FIELD_TYPE'] == 'list' ? "input-filed" : "");?>">
						<?if($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] != "file"):?>
							<label for="<?=$type.'_'.$FIELD_SID?>"><span><?=$arQuestion["CAPTION"]?><?=($arQuestion["REQUIRED"] == "Y" ? '&nbsp;<span class="required-star">*</span>' : '')?></span></label>
						<?endif;?>
						<div class="input">
							<?
							if(strpos($arQuestion["HTML_CODE"], "class=") === false)
							{
								$arQuestion["HTML_CODE"] = str_replace('input', 'input class=""', $arQuestion["HTML_CODE"]);
							}
							$arQuestion["HTML_CODE"] = str_replace('class="', 'class="form-control ', $arQuestion["HTML_CODE"]);
							$arQuestion["HTML_CODE"] = str_replace('class="', 'id="'.$type.'_'.$FIELD_SID.'" class="', $arQuestion["HTML_CODE"]);


							if(is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])){
								$arQuestion["HTML_CODE"] = str_replace('class="', 'class="error ', $arQuestion["HTML_CODE"]);
							}
							if($arQuestion["REQUIRED"] == "Y"){
								$arQuestion["HTML_CODE"] = str_replace('name=', 'required name=', $arQuestion["HTML_CODE"]);
							}
							if($arQuestion["STRUCTURE"][0]["FIELD_TYPE"] == "email"){
								$arQuestion["HTML_CODE"] = str_replace('type="text"', 'type="email"', $arQuestion["HTML_CODE"]);
							}

							if(strpos($arQuestion["HTML_CODE"], "phone") !== false){
								$arQuestion["HTML_CODE"] = str_replace('type="text"', 'type="tel"', $arQuestion["HTML_CODE"]);
							}
							?>
							<?if($FIELD_SID == 'RATING'):?>
								<div class="rating_wrap clearfix">
									<div class="rating">
										<span class="star" data-current_width="20" data-rating_value="1" data-message="<?=GetMessage('RATING_MESSAGE_1')?>"></span>
										<span class="star" data-current_width="40" data-rating_value="2" data-message="<?=GetMessage('RATING_MESSAGE_2')?>"></span>
										<span class="star" data-current_width="60" data-rating_value="3" data-message="<?=GetMessage('RATING_MESSAGE_3')?>"></span>
										<span class="star" data-current_width="80" data-rating_value="4" data-message="<?=GetMessage('RATING_MESSAGE_4')?>"></span>
										<span class="star" data-current_width="100" data-rating_value="5" data-message="<?=GetMessage('RATING_MESSAGE_5')?>"></span>
										<span class="stars_current" data-rating="0"></span>
									</div>
									<div class="rating_message" data-message="<?=GetMessage('RATING_MESSAGE_0')?>"><?=GetMessage('RATING_MESSAGE_0')?></div>
									<?=str_replace('type="text"', 'type="hidden"', $arQuestion["HTML_CODE"])?>
								</div>
							<?else:?>
								<?=$arQuestion["HTML_CODE"]?>
							<?endif?>
							<?if($arQuestion['FIELD_TYPE'] == "file" && $arQuestion['MULTIPLE'] == 'Y'):?>
								<div class="add_file"><span><?=GetMessage('JS_FILE_ADD');?></span></div>
							<?endif;?>
						</div>
						<?if( !empty( $arQuestion["HINT"] ) ){?>
							<div class="hint"><?=$arQuestion["HINT"]?></div>
						<?}?>
					</div>
				</div>
			</div>
		<?endif;?>
	<?}

	public static function getFormID($code = '', $site = SITE_ID){
		global $arTheme;
		$form_id = 0;
		if($code)
		{
			if(self::GetFrontParametrValue('USE_BITRIX_FORM') == 'Y' && \Bitrix\Main\Loader::includeModule('form'))
			{
				$rsForm = CForm::GetList($by = 'id', $order = 'asc', array('ACTIVE' => 'Y', 'SID' => $code, 'SITE' => array($site), 'SID_EXACT_MATCH' => 'N'), $is_filtered);
				if($item = $rsForm->Fetch())
					$form_id = $item['ID'];
				else
					$form_id = CCache::$arIBlocks[$site]["aspro_priority_form"][$code][0];
			}
			else
			{
				$form_id = CCache::$arIBlocks[$site]["aspro_priority_form"][$code][0];
			}
		}
		return $form_id;
	}

	function truncateLengthText($text = '', $length = 0){
		if(strlen($text)){
			$obParser = new CTextParser;
			$text = $obParser->html_cut($text, intval($length));
		}
		
		return $text;
	}
	
	public static function Vail($count, $arMessages, $bStrOnly = false){
		$ost10 = $count % 10;
		$ost100 = $count % 100;

		if(!$count || !$ost10 || ($ost100 > 10 && $ost100 < 20)){
			return (!$bStrOnly ? intval($count).' ' : '').$arMessages[2];
		}
		if($ost10 > 1 && $ost10 < 5){
			return (!$bStrOnly ? intval($count).' ' : '').$arMessages[1];
		}
		if($ost10 === 1){
			return (!$bStrOnly ? intval($count).' ' : '').$arMessages[0];
		}

		return (!$bStrOnly ? intval($count).' ' : '').$arMessages[2];
	}
	
	public static function checkShowForm($showFormValue = '', $arParams = array()){
		if($showFormValue && $showFormValue == 'Y'){
		?>
			<div class="button font_upper_md<?=(strlen($arParams['ICON_CLASS']) ? ' '.$arParams['ICON_CLASS'] : '');?>">
				<span class="dark-color animate-load border shadow" title="<?=$arParams['FORM_TEXT'];?>" data-event="jqm" data-param-id="<?=($arParams['FORM_CODE'] == 'map' ? 'map' : self::getFormID($arParams['FORM_CODE']));?>" data-name="<?=$arParams['FORM_NAME'];?>"<?=($arParams['FORM_CODE'] == 'map' ? ' data-param-type="map" data-iblock_id="'.CCache::$arIBlocks[SITE_ID]["aspro_priority_content"]["aspro_priority_contact"][0].'"' : '')?><?=($arParams['FORM_CODE'] == 'map' ? ' data-map_button="Y"' : '')?>>
					<span>
						<?if($arParams['FORM_NAME'] == 'callback'):?>
							<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/callback.svg');?>
						<?elseif($arParams['FORM_NAME'] == 'question'):?>
							<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/question.svg');?>
						<?elseif($arParams['FORM_NAME'] == 'add_review'):?>
							<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/add_review.svg');?>
						<?elseif($arParams['FORM_NAME'] == 'map'):?>
							<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/map.svg');?>
						<?endif?>
					
						<?=$arParams['FORM_TEXT'];?>
					</span>
				</span>
			</div>
		<?
		}
	}
	
	public static function checkContentFile($path){
		if(File::isFileExists($_SERVER['DOCUMENT_ROOT'].$path))
			$content = File::getFileContents($_SERVER['DOCUMENT_ROOT'].$path);
		return (!empty($content));
	}
	
	public static function get_banners_position($position) {
		$arTheme = self::GetFrontParametrsValues(SITE_ID);
		if ($arTheme["ADV_".$position] == 'Y') {
			global $APPLICATION;
			$APPLICATION->IncludeComponent(
				"bitrix:news.list",
				"banners",
				array(
					"IBLOCK_TYPE" => "aspro_priority_advt",
					"IBLOCK_ID" => CCache::$arIBlocks[SITE_ID]["aspro_priority_advt"]["aspro_priority_banners"][0],
					"POSITION"	=> $position,
					"PAGE"		=> $APPLICATION->GetCurPage(),
					"NEWS_COUNT" => "100",
					"SORT_BY1" => "SORT",
					"SORT_ORDER1" => "ASC",
					"SORT_BY2" => "ID",
					"SORT_ORDER2" => "ASC",
					"FIELD_CODE" => array(
						0 => "NAME",
						2 => "PREVIEW_PICTURE",
					),
					"PROPERTY_CODE" => array(
						0 => "LINK",
						1 => "TARGET",
						2 => "BGCOLOR",
						3 => "SHOW_SECTION",
						4 => "SHOW_PAGE",
						5 => "HIDDEN_XS",
						6 => "HIDDEN_SM",
						7 => "POSITION",
						8 => "SIZING",
					),
					"CHECK_DATES" => "Y",
					"FILTER_NAME" => "arFilterBanners",
					"DETAIL_URL" => "",
					"AJAX_MODE" => "N",
					"AJAX_OPTION_JUMP" => "N",
					"AJAX_OPTION_STYLE" => "Y",
					"AJAX_OPTION_HISTORY" => "N",
					"CACHE_TYPE" => "A",
					"CACHE_TIME" => "3600000",
					"CACHE_FILTER" => "Y",
					"CACHE_GROUPS" => "N",
					"PREVIEW_TRUNCATE_LEN" => "150",
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
					"DISPLAY_BOTTOM_PAGER" => "N",
					"PAGER_TITLE" => "",
					"PAGER_SHOW_ALWAYS" => "N",
					"PAGER_DESC_NUMBERING" => "N",
					"PAGER_DESC_NUMBERING_CACHE_TIME" => "3600000",
					"PAGER_SHOW_ALL" => "N",
					"AJAX_OPTION_ADDITIONAL" => "",
					"SHOW_DETAIL_LINK" => "N",
					"SET_BROWSER_TITLE" => "N",
					"SET_META_KEYWORDS" => "N",
					"SET_META_DESCRIPTION" => "N",
					"COMPONENT_TEMPLATE" => "banners",
					"SET_LAST_MODIFIED" => "N",
					"COMPOSITE_FRAME_MODE" => "A",
					"COMPOSITE_FRAME_TYPE" => "AUTO",
					"PAGER_BASE_LINK_ENABLE" => "N",
					"SHOW_404" => "N",
					"MESSAGE_404" => ""
				),
				false, array('ACTIVE_COMPONENT' => 'Y')
			);
		}
	}
}?>