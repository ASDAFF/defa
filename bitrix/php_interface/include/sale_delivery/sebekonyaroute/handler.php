<?
namespace Sale\Handlers\Delivery;

use Bitrix\Main\Loader;
use Bitrix\Sale\Delivery\CalculationResult;
use Bitrix\Sale\Delivery\Services\Base;

if (file_exists($_SERVER['DOCUMENT_ROOT'].'/bitrix/php_interface/include/sale_delivery/sebekonyaroute/profile.php')) {
    include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/php_interface/include/sale_delivery/sebekonyaroute/profile.php');
}

if (Loader::includeModule("sale") && Loader::IncludeModule("sebekon.deliveryprice") && class_exists('\Sebekon\Delivery\YarouteDefaultHandler') && class_exists('\Sebekon\Delivery\YarouteProfile')) {
	
    \Bitrix\Main\Localization\Loc::loadMessages('/bitrix/modules/sebekon.deliveryprice/include.php');        

    class SebekonYarouteHandler extends \Sebekon\Delivery\YarouteDefaultHandler
    {
        
        public static function getChildrenClassNames()
        {
            return array(
                '\Sebekon\Delivery\YarouteProfile'
            );
        }
        
        /*
            You can place Your code Here
        */
    }
} else {
  class SebekonYarouteHandler extends \Bitrix\Sale\Delivery\Services\Base
  {
      /*
          Заглушка на случай удаления модуля
      */
     
      /**
    	 * Handler can't count concrete
    	 * @param Shipment $shipment
    	 * @throws SystemException
    	 * @return void
    	 */
      protected function calculateConcrete(\Bitrix\Sale\Shipment $shipment)
      {
          throw new \Bitrix\Main\SystemException('Module sebekon.deliveryprice has been disabled.');
      }
      
      public function isCompatible(\Bitrix\Sale\Shipment $shipment)
      {
          return false;
      }
  }
}
?>