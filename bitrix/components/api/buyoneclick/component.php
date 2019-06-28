<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
/**
 * Bitrix vars
 *
 * @var ApiBuyoneclick $this
 * @var array          $arParams
 * @var array          $arResult
 * @var string         $componentPath
 * @var string         $componentName
 * @var string         $componentTemplate
 *
 * @var CDatabase      $DB
 * @var CUser          $USER
 * @var CMain          $APPLICATION
 * @var CCacheManager  $CACHE_MANAGER
 *
 */

use \Bitrix\Main\Application;
use \Bitrix\Main\Text\Encoding;
use \Bitrix\Main\Localization\Loc;

//---------- Подготовим параметры ----------//
if($arParams)
{
	foreach($arParams as $key => $val)
		unset($arParams[ '~' . $key ]);
}



//---------- Логика компонента ----------//
$arResult = array(
	'FIELDS'     => array(),
	'VALUES'     => array(),
	'ERRORS'     => array(),
	'ORDER'      => array(),
	'IS_SUBMIT'  => false,
	'IS_SUCCESS' => false,
);

if($arParams['AJAX'] == 'Y')
{
	$context = Bitrix\Main\Application::getInstance()->getContext();
	$request = $context->getRequest();

	$formFields = $this->getOrderProps($arParams['PERSON_TYPE']);
	$postFields = $postErrors = array();

	if($post = $request->get('arPost'))
	{
		parse_str($post, $arPost);

		if(!Application::isUtfMode())
			$arPost = Encoding::convertEncoding($arPost, 'UTF-8', $context->getCulture()->getCharset());

		$postFields = $arPost['FIELDS'];
		$postSessid = $arPost['sessid'];
		$postSubmit = $arPost['ABOC_SUBMIT'] == 'Y';
		$postComment = strip_tags(trim($arPost['ABOC_COMMENT']));

		if($postSubmit && $postSessid == bitrix_sessid())
		{
			$bFoundErrors = false;
			if($formFields)
			{
				foreach($formFields as $fieldId => $arField)
				{
					$postFields[ $fieldId ] = strip_tags(trim($postFields[ $fieldId ]));

					//Validator
					if($arParams['REQ_FIELDS'] && in_array($fieldId, $arParams['REQ_FIELDS']))
					{
						if(empty($postFields[ $fieldId ]))
						{
							$postErrors[$fieldId] = str_replace('#FIELD#', $arField['NAME'], $arParams['MESS_ERROR_FIELD']);
						}
						elseif($arField['IS_EMAIL'] == 'Y' && !check_email($postFields[ $fieldId ]))
						{
							$postErrors[$fieldId] = Loc::getMessage('ABOC_CP_EMAIL_ERROR');
						}

						if($postErrors)
							$bFoundErrors = true;
					}
				}
			}

			if(!$bFoundErrors)
			{
				$arResult['IS_SUCCESS'] = true;
				$arResult['ORDER']      = $this->saveOrder($postFields, $postComment);
			}

			if($postComment)
				$postFields['ABOC_COMMENT'] = $postComment;
		}
	}


	$arResult['FIELDS']    = $formFields;
	$arResult['VALUES']    = $postFields;
	$arResult['ERRORS']    = $postErrors;
	$arResult['IS_SUBMIT'] = $postSubmit;


	//Disable composite mode when filter checked
	//$this->setFrameMode(false);
	$APPLICATION->RestartBuffer();

	$this->includeComponentTemplate('ajax_template');

	$APPLICATION->FinalActions();
	die();
}

$this->includeComponentTemplate();