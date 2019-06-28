<?
if (CModule::IncludeModule("sale") && CModule::IncludeModule("sebekon.deliveryprice") && class_exists('CDeliverySebekonYaRouteDefault')) {
	IncludeModuleLangFile('/bitrix/modules/sebekon.deliveryprice/include.php');

	class CDeliverySebekonYaRoute extends CDeliverySebekonYaRouteDefault {
		/*
			
			You can override Calculate and compability functions if it is required
		
		*/
		
		function Init() {
			$res = parent::Init();
			
			$res['SID'] = "sebekon_yaroute";
			$res['HANDLER'] = __FILE__;
			$res['DBGETSETTINGS'] = array("CDeliverySebekonYaRoute", "GetSettings");
			$res['DBSETSETTINGS'] = array("CDeliverySebekonYaRoute", "SetSettings");
			$res['GETCONFIG'] = array("CDeliverySebekonYaRoute", "GetConfig");
			$res['COMPABILITY'] = array("CDeliverySebekonYaRoute", "Compability");
			$res['CALCULATOR'] = array("CDeliverySebekonYaRoute", "Calculate");

			return $res;
		}
	}

	AddEventHandler("sale", "onSaleDeliveryHandlersBuildList", array('CDeliverySebekonYaRoute', 'Init'));
}
?>