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
        //x5 20190702 отправка сообщения о регистрации ар
        $bxEventManager->addEventHandler(
            "main",
            "OnAfterUserRegister",
            array(
                "XFive\Events\EventManager",
                "OnAfterArchitectRegister"
            )
        );


    }

    /**x5 20190628 сбрасываем тэгированный кэш хайлоаблока Model
     * @param \Bitrix\Main\Entity\Event $event
     */
    public static function OnUpdateModelHL(\Bitrix\Main\Entity\Event $event)
    {
        global $CACHE_MANAGER;
        $CACHE_MANAGER->ClearByTag('xaiload_model');
    }

    /**
     * x5 20190702 отправляем письмо о регистрации архитектора
     */
    public static function OnAfterArchitectRegister(&$arFields)
    {
        if ($arFields['UF_ARCHITECT'] == '1') {
            \Bitrix\Main\Mail\Event::send(array(
                "EVENT_NAME" => "CUSTOM_ARCHITECT_IS_REGISTERED",
                "LID" => $arFields['LID'],
                "C_FIELDS" => array(
                    'USER_ID' =>  $arFields['USER_ID'],
                    'LOGIN' =>  $arFields['LOGIN'],
                    'EMAIL' =>  $arFields['EMAIL'],
                    'NAME' => $arFields['NAME'],
                    'SECOND_NAME' => $arFields['SECOND_NAME'],
                    'LAST_NAME' => $arFields['LAST_NAME'],
                    'PERSONAL_PHONE' => $arFields['PERSONAL_PHONE'],
                    'USER_IP' =>  $arFields['USER_IP'],
                    'USER_HOST' =>  $arFields['USER_HOST']
                ),
            ));
        }
    }


}
