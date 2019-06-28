<?

use \Bitrix\Main\Page\Asset;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Web\Json;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/**
 * Bitrix vars
 *
 * @var ApiBuyoneclickComponent  $component
 * @var CBitrixComponentTemplate $this
 * @var array                    $arParams
 * @var array                    $arResult
 * @var array                    $arLangMessages
 * @var array                    $templateData
 *
 * @var string                   $templateFile
 * @var string                   $templateFolder
 * @var string                   $parentTemplateFolder
 * @var string                   $templateName
 * @var string                   $componentPath
 *
 * @var CDatabase                $DB
 * @var CUser                    $USER
 * @var CMain                    $APPLICATION
 * @var CUserTypeManager         $USER_FIELD_MANAGER
 */

if(method_exists($this, 'setFrameMode'))
	$this->setFrameMode(true);

$this->addExternalCss($templateFolder . '/styles.css');
$this->addExternalJs($templateFolder . '/init.js');

$component->formatParams($arParams);

ob_start();
?>
	<script type="text/javascript">
		jQuery(function ($) {
			$.fn.apiBuyoneclick({
				arParams: <?=Json::encode($arParams)?>
			});
		});
	</script>
<?
$str = ob_get_contents();
ob_end_clean();

Asset::getInstance()->addString($str);
