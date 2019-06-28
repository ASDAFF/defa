<?
$MESS['MAIN_OPTIONS_SITE_ASPRO_TITLE'] = '#SITE_NAME#';
$MESS['PRIORITY_PAGE_TITLE'] = 'Интеграция с Flowlu';
$MESS['PRIORITY_NO_RIGHTS_FOR_VIEWING'] = 'Доступ закрыт';
$MESS['PRIORITY_MODULE_NOT_INCLUDED'] = 'Не удалось подключить модуль Аспро: Allcorp2';
$MESS['PRIORITY_MODULE_CONTROL_CENTER_ERROR'] = 'Не удалось получить информацию об установке решения';
$MESS['PRIORITY_MODULE_CONFIG_FLOWLU'] = 'Настройки';
$MESS['PRIORITY_MODULE_LINK_FLOWLU'] = 'Интеграция и соответствие полей';
$MESS['PRIORITY_MODULE_DOMAIN_FLOWLU'] = 'Ваш домен в flowlu';
$MESS['PRIORITY_MODULE_LOGIN_FLOWLU'] = 'Логин';
$MESS['PRIORITY_MODULE_PASSWORD_FLOWLU'] = 'Пароль';
$MESS['PRIORITY_MODULE_WEB_FORM_FLOWLU'] = 'Веб-формы';
$MESS['PRIORITY_MODULE_AUTOMATE_SEND_FLOWLU'] = 'Автоматически отправлять результаты в CRM';
$MESS['PRIORITY_MODULE_ACTIVE_FLOWLU'] = 'Включить интеграцию';
$MESS['PRIORITY_MODULE_TOKEN_FLOWLU'] = 'Ключ для авторизации в API';
$MESS['PRIORITY_MODULE_CHECK_AUTH'] = 'Проверить авторизацию';
$MESS['PRIORITY_MODULE_TOKEN_HINT'] = 'Управление API-ключами доступно в разделе Личный кабинет > Все настройки > API.';
$MESS['PRIORITY_MODULE_DOMEN_HINT'] = 'Указывайте домен без http:// и/или https://';
$MESS['PRIORITY_MODULE_SAVE_OPTION'] = 'Сохранить';
$MESS['PRIORITY_MODULE_DELETE_OPTION'] = 'Установить значения по умолчанию';
$MESS['PRIORITY_MODULE_DELETE_OPTION_TITLE'] = 'Внимание! Все настройки будут удалены. Продолжить?';
$MESS['PRIORITY_MODULE_DELETE_OPTION_TEXT'] = 'Сбросить';
$MESS['PRIORITY_MODULE_FIELDS_FLOWLU'] = 'Поля';
$MESS['PRIORITY_MODULE_ALL_FIELDS_FLOWLU'] = 'Поля веб-форм и CRM';
$MESS['PRIORITY_MODULE_RESULTS_FLOWLU'] = 'Результаты';
$MESS['PRIORITY_MODULE_ALL_RESULTS_FLOWLU'] = 'Результаты веб-форм';
$MESS['PRIORITY_MODULE_USE_LOG_FLOWLU'] = 'Использовать логирование';
$MESS['PRIORITY_MODULE_LEAD_NAME_FLOWLU_TITLE'] = 'Название лида с сайта по-умолчанию';
$MESS['PRIORITY_MODULE_LEAD_NAME_FLOWLU'] = 'Заявка с сайта';
$MESS['CRM_FIELD_TABLE'] = 'Поле CRM';
$MESS['FORM_FIELD_TABLE'] = 'Поле формы';
$MESS['FORM_RESULT_FIELD_TABLE'] = 'Результаты форм';
$MESS['FORM_CRM_ADD'] = 'Добавить';
$MESS['PRIORITY_MODULE_NO_FORM_FIELD_MATCHING'] = 'Необходимо <b>ввести верные данные</b> для авторизации, <b>включить интеграцию</b> и <b>установить соответствие полей</b> веб-форм и полей CRM на вкладке <b>"Поля"</b>.';

$MESS["FORM_FIELD_CRM_FIELDS_FORM_NAME_NO"] = "Не выбрано";
$MESS["FORM_RESULT_INFO"] = "Создан: DATE_CREATE Изменен: TIMESTAMP_X";
$MESS["FORM_RESULT_SEND"] = "отправлено";
$MESS["FORM_RESULT_NO_SEND"] = "неотправлено";
$MESS["DELETE_NODE"] = "удалить";
$MESS["SEND_CRM"] = "отправить в CRM";
$MESS["PRIORITY_MODULE_NO_FORM_RESULTS"] = "Нет результатов формы";

$MESS['PRIORITY_MODULE_AUTOMATE_SEND_FLOWLU_HINT'] = 'Если опция установлена, то после успешной отправки веб-формы произойдет автоматическое отправление результатов в CRM. Иначе, все результаты будут вручную отправляться через таблицу <b>"Результаты форм"</b> на вкладке <b>"Результаты"</b>';
$MESS['PRIORITY_MODULE_USE_LOG_FLOWLU_HINT'] = 'Все файлы с логами будут помещаться в папку <b>/upload/logs/aspor.allcorp2/crm/YY-mm-dd/flowlu_create_lead_request.log</b> (исходящие запросы с сайта в crm) и <b>/upload/logs/aspor.allcorp2/crm/YY-mm-dd/flowlu_create_lead_response.log</b> (ответ crm)';
$MESS['PRIORITY_MODULE_NO_FORMS'] = 'Не установлен модуль <b>"Веб-формы"</b>. Дальнейшая интеграция невозможна.';
$MESS['PRIORITY_MODULE_INTEGRATION_FLOWLU'] = 'Необходимо задать верные параметры в разделе <b>"Настройки"</b>. После чего будет доступна возможность включения интеграции с сайтом и задать соответствие полей веб-форм';
$MESS['PRIORITY_MODULE_DOMAIN_HINT'] = 'Необходимо ввести ваш домен 3го уровня (без https:// и .flowlu.ru).<br>Пример: https://<u>домен</u>.flowlu.ru - надо ввести <u>домен</u>.';

$MESS["ASPRO_PRIORITY_NO_SITE_INSTALLED"] = 'Не найдено сайтов с установленным решением &laquo;Аспро: Allcorp2;<br />
<input type="button" value="Установить" style="margin-top: 10px;" onclick="document.location.href=\'/bitrix/admin/wizard_install.php?lang=ru&wizardName=aspro:allcorp2&#SESSION_ID#\'">';
?>