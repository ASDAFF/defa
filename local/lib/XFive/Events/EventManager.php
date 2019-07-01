<?php
/**
 * Класс в котором будут собраны вызовы всех событий, чтобы не писать простыню в init.php
 */

namespace XFive\Events;


class EventManager
{
    public function initEvents()
    {
        $bxEventManager = \Bitrix\Main\EventManager::getInstance();

		$bxEventManager->addEventHandler(
            "",
            "ModelOnAfterAdd",
            array(
                "XFive\Events\EventManager",
                "OnUpdateModelHL"
            )
        );
        $bxEventManager->addEventHandler(
            "",
            "ModelOnAfterUpdate",
            array(
                "XFive\Events\EventManager",
                "OnUpdateModelHL"
            )
        );
        $bxEventManager->addEventHandler(
            "",
            "ModelOnAfterDelete",
            array(
                "XFive\Events\EventManager",
                "OnUpdateModelHL"
            )
        );


    }

    /**x5 20190628 сбрасываем тэгированный кэш хайлоаблока Model
     * @param \Bitrix\Main\Entity\Event $event
     */
    public static function OnUpdateModelHL(\Bitrix\Main\Entity\Event $event){
        global $CACHE_MANAGER;
        $CACHE_MANAGER->ClearByTag('xaiload_model');
    }
}
