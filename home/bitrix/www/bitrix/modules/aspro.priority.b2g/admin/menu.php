<?
AddEventHandler('main', 'OnBuildGlobalMenu', 'OnBuildGlobalMenuHandlerPriorityB2G');
function OnBuildGlobalMenuHandlerPriorityB2G(&$arGlobalMenu, &$arModuleMenu){

	if(!defined('PRIORITY_B2G_MENU_INCLUDED')){
		define('PRIORITY_B2G_MENU_INCLUDED', true);

		IncludeModuleLangFile(__FILE__);
		$moduleID = 'aspro.priority.b2g';

		$GLOBALS['APPLICATION']->SetAdditionalCss("/bitrix/css/".$moduleID."/menu.css");

		if($GLOBALS['APPLICATION']->GetGroupRight($moduleID) >= 'R'){
			$arGenerate = array(
						'text' => GetMessage('PRIORITY_MENU_GENERATE_FILES_TEXT'),
						'title' => GetMessage('PRIORITY_MENU_GENERATE_FILES_TITLE'),
						'sort' => 20,
						'url' => '/bitrix/admin/'.$moduleID.'_generate_robots.php?mid=main',
						'icon' => 'imi_marketing',
						'page_icon' => 'pi_typography',
						'items_id' => 'gfiles',
						"items" => array(
							array(
								'text' => GetMessage('PRIORITY_MENU_GENERATE_ROBOTS_TEXT'),
								'title' => GetMessage('PRIORITY_MENU_GENERATE_ROBOTS_TITLE'),
								'sort' => 20,
								'url' => '/bitrix/admin/'.$moduleID.'_generate_robots.php?mid=main',
								'icon' => '',
								'page_icon' => 'pi_typography',
								'items_id' => 'grobots',
							)
						)
					);
			if(\Bitrix\Main\Loader::includeModule('statistic'))
			{
				$arGenerate["items"][] = array(
					'text' => GetMessage('PRIORITY_MENU_GENERATE_SITEMAP_TEXT'),
					'title' => GetMessage('PRIORITY_MENU_GENERATE_SITEMAP_TITLE'),
					'sort' => 20,
					'url' => '/bitrix/admin/'.$moduleID.'_generate_sitemap.php?mid=main',
					'icon' => '',
					'page_icon' => 'pi_typography',
					'items_id' => 'gsitemap',
				);
			}
			$arMenuPriority = array(
				'text' => GetMessage('PRIORITY_B2G_GLOBAL_MENU_TEXT'),
				'title' => GetMessage('PRIORITY_B2G_GLOBAL_MENU_TITLE'),
				'sort' => 10,
				'icon' => 'imi_priority',
				'page_icon' => 'pi_typography',
				'items_id' => 'global_menu_aspro_priority_b2g_items',
				"items" => array(
					array(
						'text' => GetMessage('PRIORITY_MENU_CONTROL_CENTER_TEXT'),
						'title' => GetMessage('PRIORITY_MENU_CONTROL_CENTER_TITLE'),
						'sort' => 10,
						'url' => '/bitrix/admin/'.$moduleID.'_mc.php',
						'icon' => 'imi_control_center',
						'page_icon' => 'pi_control_center',
						'items_id' => 'control_center',
					),
					array(
						'text' => GetMessage('PRIORITY_MENU_TYPOGRAPHY_TEXT'),
						'title' => GetMessage('PRIORITY_MENU_TYPOGRAPHY_TITLE'),
						'sort' => 20,
						'url' => '/bitrix/admin/'.$moduleID.'_options.php?mid=main',
						'icon' => 'imi_typography',
						'page_icon' => 'pi_typography',
						'items_id' => 'main',
					),	
					array(
						'text' => GetMessage('PRIORITY_MENU_CRM_TEXT'),
						'title' => GetMessage('PRIORITY_MENU_CRM_TITLE'),
						'sort' => 20,
						'url' => '/bitrix/admin/'.$moduleID.'_crm_amo.php?mid=main',
						'icon' => 'imi_marketing',
						'page_icon' => 'pi_typography',
						'items_id' => 'gfiles',
						"items" => array(
							array(
								'text' => GetMessage('PRIORITY_MENU_AMO_CRM_TEXT'),
								'title' => GetMessage('PRIORITY_MENU_AMO_CRM_TITLE'),
								'sort' => 20,
								'url' => '/bitrix/admin/'.$moduleID.'_crm_amo.php?mid=main',
								'icon' => '',
								'page_icon' => 'pi_typography',
								'items_id' => 'grobots',
							),
							array(
								'text' => GetMessage('PRIORITY_MENU_FLOWLU_CRM_TEXT'),
								'title' => GetMessage('PRIORITY_MENU_FLOWLU_CRM_TITLE'),
								'sort' => 20,
								'url' => '/bitrix/admin/'.$moduleID.'_crm_flowlu.php?mid=main',
								'icon' => '',
								'page_icon' => 'pi_typography',
								'items_id' => 'gsitemap',
							),	
						)
					),
					$arGenerate
				),
			);
			
			if(!isset($arGlobalMenu['global_menu_aspro'])){
				$arGlobalMenu['global_menu_aspro'] = array(
					'menu_id' => 'global_menu_aspro',
					'text' => GetMessage('PRIORITY_GLOBAL_ASPRO_MENU_TEXT'),
					'title' => GetMessage('PRIORITY_GLOBAL_ASPRO_MENU_TITLE'),
					'sort' => 1000,
					'items_id' => 'global_menu_aspro_items',
				);
			}
			
			$arGlobalMenu['global_menu_aspro']['items']['aspro.priority.b2g'] = $arMenuPriority;
		}
	}
}
?>