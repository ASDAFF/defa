<?
namespace Sebekon\Delivery;

use Bitrix\Main\Loader;
use Bitrix\Sale\Delivery\CalculationResult;
use Bitrix\Sale\Delivery\Services\Base;

if (Loader::includeModule("sale") && Loader::IncludeModule("sebekon.deliveryprice") && class_exists('\Sebekon\Delivery\YarouteDefaultProfile')) {
    class YarouteProfile extends \Sebekon\Delivery\YarouteDefaultProfile
    {
        /*
            You can place Your code Here
        */
    }
} else {
  class YarouteProfile extends \Bitrix\Sale\Delivery\Services\Base
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