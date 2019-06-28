<?
if(!defined('PRIORITY_MODULE_ID'))
	define('PRIORITY_MODULE_ID', 'aspro.priority');

use \Bitrix\Main\Localization\Loc,
	Bitrix\Main\Application,
	\Bitrix\Main\Config\Option,
	Bitrix\Main\IO\File,
	Bitrix\Main\Page\Asset;
Loc::loadMessages(__FILE__);

class CPriorityEvents{
	const MODULE_ID = PRIORITY_MODULE_ID;
	const addReviewFormSID = 'aspro_priority_add_review';
	
	function OnBeforeUserUpdateHandler(&$arFields){
		$bTmpUser = false;
		$bAdminSection = (defined('ADMIN_SECTION') && ADMIN_SECTION === true);

		if(strlen($arFields['NAME']))
			$arFields['NAME'] = trim($arFields['NAME']);

		if($bAdminSection)
	    {
	    	// include CMainPage
	        require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/include/mainpage.php");
	        // get site_id by host
	        $siteID = \CMainPage::GetSiteByHost();
	        if(!$siteID)
	            $siteID = "s1";
	    }
		$siteID = SITE_ID;
		$sChangeLogin = COption::GetOptionString(PRIORITY_MODULE_ID, 'LOGIN_EQUAL_EMAIL', 'N', $siteID);

		if(strlen($arFields['NAME']) && !strlen($arFields['LAST_NAME']) && !strlen($arFields['SECOND_NAME']))
		{
			if($siteID == 'ru')
				$siteID = 's1';
			if($bAdminSection)
				$bOneFIO = COption::GetOptionString(PRIORITY_MODULE_ID, 'PERSONAL_ONEFIO', 'Y', $siteID);
			else
			{
				$arFrontParametrs = CPriority::GetFrontParametrsValues($siteID);
				$bOneFIO = $arFrontParametrs['PERSONAL_ONEFIO'] !== 'N';
			}

			if($bOneFIO)
			{
				$arName = explode(' ', $arFields['NAME']);
				if($arName)
				{
					$arFields['NAME'] = '';
					$arFields['SECOND_NAME'] = '';
					foreach($arName as $i => $name)
					{
						if(!$i)
						{
							$arFields['LAST_NAME'] = $name;
						}
						else
						{
							if(!strlen($arFields['NAME']))
								$arFields['NAME'] = $name;

							elseif(!strlen($arFields['SECOND_NAME']))
								$arFields['SECOND_NAME'] = $name;

						}
					}
				}
			}
		}
		if(strlen($arFields["EMAIL"]))
		{
			if(!$bAdminSection)
			{
				$arFrontParametrs = CPriority::GetFrontParametrsValues($siteID);
				$sChangeLogin = $arFrontParametrs['LOGIN_EQUAL_EMAIL'];
			}
			if($sChangeLogin != "N")
			{
				$bEmailError = false;

				if(\Bitrix\Main\Config\Option::get('main', 'new_user_email_uniq_check', 'N') == 'Y')
				{
					$rsUser = CUser::GetList($by = "ID", $order = "ASC", array("=EMAIL" => $arFields["EMAIL"], "!ID" => $arFields["ID"]));
					if(!$bEmailError = intval($rsUser->SelectedRowsCount()) > 0)
					{
						$rsUser = CUser::GetList($by = "ID", $order = "ASC", array("LOGIN_EQUAL" => $arFields["EMAIL"], "!ID" => $arFields["ID"]));
						$bEmailError = intval($rsUser->SelectedRowsCount()) > 0;
					}
				}

				if($bEmailError){
					global $APPLICATION;
					$APPLICATION->throwException(Loc::getMessage("EMAIL_IS_ALREADY_EXISTS", array("#EMAIL#" => $arFields["EMAIL"])));
					return false;
				}
				else{
					// !admin
					if (!isset($GLOBALS["USER"]) || !is_object($GLOBALS["USER"])){
						$bTmpUser = True;
						$GLOBALS["USER"] = new \CUser;
					}

					if($bAdminSection)
					{
						if(isset($arFields['ID']) && $arFields['ID'])
						{
							if(!in_array(1, CUser::GetUserGroup($arFields['ID'])))
								$arFields['LOGIN'] = $arFields['EMAIL'];
						}
						elseif(isset($arFields['GROUP_ID']) && $arFields['GROUP_ID'])
						{
							$arUserGroups = array();
							$arTmpGroups = (array)$arFields['GROUP_ID'];
							foreach($arTmpGroups as $arGroup)
							{
								if(is_array($arGroup))
									$arUserGroups[] = $arGroup['GROUP_ID'];
								else
									$arUserGroups[] = $arGroup;
							}

							if(count(array_intersect($arUserGroups, array(1)))<=0)
								$arFields['LOGIN'] = $arFields['EMAIL'];
						}
						else
							$arFields['LOGIN'] = $arFields['EMAIL'];
					}
					else
					{
						if(!$GLOBALS['USER']->IsAdmin())
							$arFields["LOGIN"] = $arFields["EMAIL"];
					}
				}
			}
		}

		if ($bTmpUser)
			unset($GLOBALS["USER"]);

		return $arFields;
	}

	static function OnAfterUserRegisterHandler($arFields){

	}

	static function OnEndBufferContentHandler(&$content)
	{
		if(!defined('ADMIN_SECTION'))
		{
			if(defined('ASPRO_USE_ONENDBUFFERCONTENT_HANDLER') && ASPRO_USE_ONENDBUFFERCONTENT_HANDLER == 'Y')
			{
				global $SECTION_BNR_CONTENT, $arRegion;
				if($SECTION_BNR_CONTENT)
				{
					$start = strpos($content, '<!--title_content-->');
					if($start>0)
					{
						$end = strpos($content, '<!--end-title_content-->');

						if(($end>0) && ($end>$start))
						{
							if(defined("BX_UTF") && BX_UTF === true)
								$content = CPriority::utf8_substr_replace($content, "", $start, $end-$start);
							else
								$content = substr_replace($content, "", $start, $end-$start);
						}
					}
					$content = str_replace("body class=\"", "body class=\"with_banners ", $content);
				}

				//regionality
				foreach(CPriorityRegionality::$arSeoMarks as $mark => $field)
				{
					if(strpos($content, $mark) !== false)
					{
						if($arRegion)
							$content = str_replace($mark, $arRegion[$field], $content);
						else
							$content = str_replace($mark, '', $content);	
					}
				}
			}

			//process recaptcha
			if(\Aspro\Functions\CAsproPriorityReCaptcha::checkRecaptchaActive())
			{
				$count = 0;
				$contentReplace = preg_replace_callback(
					'!(<img\s[^>]*?src[^>]*?=[^>]*?)(\/bitrix\/tools\/captcha\.php\?(captcha_code|captcha_sid)=[0-9a-z]+)([^>]*?>)!',
					function ($arImage)
					{
						//replace src and style
						$arImage = array(
							'tag' => $arImage[1],
							'src' => $arImage[2],
							'tail' => $arImage[4],
						);

						return \Aspro\Functions\CAsproPriorityReCaptcha::callbackReplaceImage($arImage);
					},
					$content,
					-1,
					$count
				);

				if($count <= 0 || !$contentReplace)
					return;
				
				$content = $contentReplace;
				unset($contentReplace);

				$captcha_public_key = \Aspro\Functions\CAsproPriorityReCaptcha::getPublicKey();

				$ind = 0;
				while ($ind++ <= $count)
				{
					$uniqueId = randString(4);
					$content = preg_replace(
						'!<input\s[^>]*?name[^>]*?=[^>]*?captcha_word[^>]*?>!',
						"<div id='recaptcha-$uniqueId'
						class='g-recaptcha'
						data-sitekey='$captcha_public_key'></div>
					<script data-skip-moving='true'>
						if(typeof renderRecaptchaById !== 'undefined')
							renderRecaptchaById('recaptcha-$uniqueId');
					</script>", $content, 1
					);
				}

				$arSearchMessages = array(
					\Bitrix\Main\Localization\Loc::getMessage('FORM_CAPRCHE_TITLE_RECAPTCHA'),
					\Bitrix\Main\Localization\Loc::getMessage('FORM_CAPRCHE_TITLE_RECAPTCHA2'),
					\Bitrix\Main\Localization\Loc::getMessage('FORM_CAPRCHE_TITLE_RECAPTCHA3'),
				);

				$content = str_replace($arSearchMessages, \Bitrix\Main\Localization\Loc::getMessage('FORM_GENERAL_RECAPTCHA'), $content);
			}
			
			$content = str_replace('<script type="text/javascript"', '<script', $content);
		}
	}

	static function onBeforeResultAddHandler($WEB_FORM_ID, &$arFields, &$arrVALUES){
		if(!defined('ADMIN_SECTION'))
		{
			global $APPLICATION;
			$arTheme = CPriority::GetFrontParametrsValues(SITE_ID);

			if($arrVALUES['nspm'] && !isset($arrVALUES['captcha_sid']))
		    	$APPLICATION->ThrowException(Loc::getMessage('ERROR_FORM_CAPTCHA'));
AddMessage2Log($arrVALUES);
		  	if($arTheme['SHOW_LICENCE'] == 'Y' && ((!isset($arrVALUES['licenses_popup']) || !$arrVALUES['licenses_popup']) && (!isset($arrVALUES['licenses_inline']) || !$arrVALUES['licenses_inline'])))
		    	$APPLICATION->ThrowException(Loc::getMessage('ERROR_FORM_LICENSE'));
		}
	}
	
	public static function OnPageStartHandler(){
		if(defined("ADMIN_SECTION") || !\Aspro\Functions\CAsproPriorityReCaptcha::checkRecaptchaActive())
			return;

		$captcha_public_key = \Aspro\Functions\CAsproPriorityReCaptcha::getPublicKey();
		$assets = Asset::getInstance();

		$arCaptchaProp = array();
		$arCaptchaProp['recaptchaColor'] = strtolower(Option::get(self::MODULE_ID, 'GOOGLE_RECAPTCHA_COLOR', 'LIGHT'));
		$arCaptchaProp['recaptchaLogoShow'] = strtolower(Option::get(self::MODULE_ID, 'GOOGLE_RECAPTCHA_SHOW_LOGO', 'Y'));
		$arCaptchaProp['recaptchaSize'] = strtolower(Option::get(self::MODULE_ID, 'GOOGLE_RECAPTCHA_SIZE', 'NORMAL'));
		$arCaptchaProp['recaptchaBadge'] = strtolower(Option::get(self::MODULE_ID, 'GOOGLE_RECAPTCHA_BADGE', 'BOTTOMRIGHT'));
		$arCaptchaProp['recaptchaLang'] = LANGUAGE_ID;

		//add global object asproRecaptcha
		$scripts = "<script data-skip-moving='true'>";
		$scripts .= "window['asproRecaptcha'] = {params: ".\CUtil::PhpToJsObject($arCaptchaProp).",key: '".$captcha_public_key."'};";
		$scripts .= "</script>";
		$assets->addString($scripts);

		//add scripts
		$scriptsDir = $_SERVER['DOCUMENT_ROOT'].'/bitrix/js/'.self::MODULE_ID.'/captcha/';
		$scriptsPath = File::isFileExists($scriptsDir.'recaptcha.min.js')? $scriptsDir.'recaptcha.min.js' : $scriptsDir.'recaptcha.js';
		$scriptCode = File::getFileContents($scriptsPath);
		$scripts = "<script data-skip-moving='true'>".$scriptCode."</script>";
		$assets->addString($scripts);

		$scriptsPath = File::isFileExists($scriptsDir . 'replacescript.min.js') ? $scriptsDir . 'replacescript.min.js' : $scriptsDir . 'replacescript.js';
		$scriptCode = File::getFileContents($scriptsPath);
		$scripts = "<script data-skip-moving='true'>".$scriptCode."</script>";
		$assets->addString($scripts);

		//process post request
		$application = Application::getInstance();
		$request = $application->getContext()->getRequest();
		$arPostData = $request->getPostList()->toArray();

		$needReInit = false;

		if($arPostData['g-recaptcha-response'])
		{
			if($code = \Aspro\Functions\CAsproPriorityReCaptcha::getCodeByPostList($arPostData))
			{
				$_REQUEST['captcha_word'] = $_POST['captcha_word'] = $code;
				$needReInit = true;
			}
		}

		foreach($arPostData as $key => $arPost)
		{
			if(!is_array($arPost) || !$arPost['g-recaptcha-response'])
				continue;

			if($code = \Aspro\Functions\CAsproPriorityReCaptcha::getCodeByPostList($arPost))
			{
				$_REQUEST[$key]['captcha_word'] = $_POST[$key]['captcha_word'] = $code;
				$needReInit = true;
			}
		}
		if($needReInit)
		{
			\Aspro\Functions\CAsproPriorityReCaptcha::reInitContext($application, $request);
		}
	}

	static function OnBeforePrologHandler(){

	}

	static function OnBeforeSubscriptionAddHandler(&$arFields){
		if(!defined('ADMIN_SECTION'))
		{
			global $APPLICATION;
			$arTheme = CPriority::GetFrontParametrsValues(SITE_ID);

			if($arTheme['SHOW_LICENCE'] == 'Y' && (!isset($_REQUEST['licenses_subscribe'])))
			{
				$APPLICATION->ThrowException(\Bitrix\Main\Localization\Loc::getMessage('ERROR_FORM_LICENSE'));
				return false;
			}
		}
	}
	
	static function onAfterResultAddHandler($WEB_FORM_ID, $RESULT_ID){
		if(Option::get(self::MODULE_ID, 'AUTOMATE_SEND_FLOWLU', 'Y') == 'Y')
		{
			\Aspro\Functions\CAsproPriority::sendLeadCrmFromForm($WEB_FORM_ID, $RESULT_ID);
		}
		$dbRes = CForm::GetList($by, $order, array('ID' => $WEB_FORM_ID), $is_filtered);
		if($arRes = $dbRes->Fetch()){
			$SID = $arRes['SID'];
		}
		
		if(strpos($SID, self::addReviewFormSID) !== false){
			$arFormResult = CFormResult::GetDataByID($RESULT_ID, array(), $arResult, $arAnswer);
			
			if($arFormResult){
				$arTheme = CPriority::GetFrontParametrsValues(SITE_ID);
				$arIBlockReviews = CCache::CIBlock_GetList(array('SORT' => 'ASC', 'CACHE' => array('MULTI' => 'N')), array('CODE' => self::addReviewFormSID, 'SITE_ID' => SITE_ID));
				$arElementProperties = array();
				$el = new CIBlockElement;
				
				foreach($arFormResult as $arField){
					switch($arField[0]['FIELD_TYPE']){
						case('textarea'):
							$arElementProperties[$arField[0]['SID']]['VALUE'] = array('TEXT' => $arField[0]['USER_TEXT']);
							break;
						case('file'):
							$arElementProperties[$arField[0]['SID']] = CFile::MakeFileArray($arField[0]['USER_FILE_ID']);
							break;
						default:
							$arElementProperties[$arField[0]['SID']] = $arField[0]['USER_TEXT'];
							break;
					}
				}
								
				$arElementFields = array(
					"IBLOCK_ID" => $arIBlockReviews['ID'],
					"ACTIVE" => (isset($arTheme['MODERATION_REVIEWS']) && $arTheme['MODERATION_REVIEWS'] == 'Y' ? 'N' : 'Y'),
					"NAME" => GetMessage("DEFAULT_FORM_NAME").ConvertTimeStamp(),
					"PROPERTY_VALUES" => $arElementProperties,
				);
				
				$el->Add($arElementFields);
			}
		}		
	}
	
	public static function OnAfterIBlockElementAddUpdateHandler(&$arFields){
		\Bitrix\Main\Loader::includeModule('iblock');
		$catalogIBlockCode = 'aspro_priority_catalog';
		$tarifIBlockCode = 'aspro_priority_tarif';
		$arIBlock = CIBlock::GetList(array(), array('ID' => $arFields['IBLOCK_ID']))->Fetch();
		if($arIBlock['CODE'] == $catalogIBlockCode){
			$catalogIBlockProperties = array();
			
			$dbRes = CIBlockProperty::GetList(array(), array('ACTIVE' => 'Y', 'IBLOCK_CODE' => $catalogIBlockCode, 'CODE' => 'PRICE'));
			if($arRes = $dbRes->GetNext()){
				$catalogIBlockProperties[$arRes['CODE']] = $arRes['ID'];
			}
			
			$dbRes = CIBlockProperty::GetList(array(), array('ACTIVE' => 'Y', 'IBLOCK_CODE' => $catalogIBlockCode, 'CODE' => 'FILTER_PRICE'));
			if($arRes = $dbRes->GetNext()){
				$catalogIBlockProperties[$arRes['CODE']] = $arRes['ID'];
			}
			
			if(isset($arFields['PROPERTY_VALUES'][$catalogIBlockProperties['PRICE']]) && $arFields['PROPERTY_VALUES'][$catalogIBlockProperties['PRICE']] && isset($arFields['PROPERTY_VALUES'][$catalogIBlockProperties['FILTER_PRICE']])){
				if(is_array($arFields['PROPERTY_VALUES'][$catalogIBlockProperties['PRICE']])){
					foreach($arFields['PROPERTY_VALUES'][$catalogIBlockProperties['PRICE']] as $arValue){
						preg_match_all('/[0-9.,]/', str_replace(' ', '', $arValue['VALUE']), $arFilterPrice);
						$filterPrice = str_replace(' ', '', CPriority::FormatSumm(implode('', $arFilterPrice[0]), 1));
					}
				}
				
				if($filterPrice){
					CIBlockElement::SetPropertyValueCode($arFields['ID'], 'FILTER_PRICE', $filterPrice);
				}
			}
		}
		
		if($arIBlock['CODE'] == $tarifIBlockCode){
			$tarifIBlockProperties = array();
			
			$dbRes = CIBlockProperty::GetList(array(), array('ACTIVE' => 'Y', 'IBLOCK_CODE' => $tarifIBlockCode));
			while($arRes = $dbRes->GetNext()){
				$tarifIBlockProperties[$arRes['CODE']] = $arRes['ID'];
			}
			
			if($tarifIBlockProperties){
				foreach($tarifIBlockProperties as $keyProp => $arProp){
					if(strpos($keyProp, 'TARIF_PRICE_') !== false){
						if(is_array($arFields['PROPERTY_VALUES'][$arProp])){
							foreach($arFields['PROPERTY_VALUES'][$arProp] as $arValue){
								preg_match_all('/[0-9.,]/', str_replace(' ', '', $arValue['VALUE']), $arFilterPrice);
								$key = str_replace('TARIF_PRICE_', '', $keyProp);
								$filterPrice = str_replace(' ', '', CPriority::FormatSumm(implode('', $arFilterPrice[0]), 1));
								CIBlockElement::SetPropertyValueCode($arFields['ID'], 'FILTER_PRICE_'.$key, $filterPrice);
							}
						}
					}
				}
			}
		}

		//region events
		if(isset(CCache::$arIBlocks[$arIBlock['LID']]['aspro_priority_regionality']['aspro_priority_regions'][0]) && CCache::$arIBlocks[$arIBlock['LID']]['aspro_priority_regionality']['aspro_priority_regions'][0])
			$iRegionIBlockID = CCache::$arIBlocks[$arIBlock['LID']]['aspro_priority_regionality']['aspro_priority_regions'][0];
		else
			return;
		if($iRegionIBlockID == $arFields['IBLOCK_ID'])
		{
			$arSite = CSite::GetList($by, $sort, array("ACTIVE"=>"Y", "ID" =>  $arIBlock['LID']))->Fetch();
			$arSite['DIR'] = str_replace('//', '/', '/'.$arSite['DIR']);
			if(!strlen($arSite['DOC_ROOT'])){
				$arSite['DOC_ROOT'] = $_SERVER['DOCUMENT_ROOT'];
			}
			$arSite['DOC_ROOT'] = str_replace('//', '/', $arSite['DOC_ROOT'].'/');
			$siteDir = str_replace('//', '/', $arSite['DOC_ROOT'].$arSite['DIR']);

			$arProperty = CIBlockElement::GetProperty($arFields["IBLOCK_ID"], $arFields["ID"], "sort", "asc", array("CODE" => "MAIN_DOMAIN"))->Fetch();
			$xml_file = (isset($arFields["SITE_MAP"]) && $arFields["SITE_MAP"] ? $arFields["SITE_MAP"] : "sitemap.xml");
			if($arProperty["VALUE"])
			{
				if(file_exists($siteDir.'robots.txt'))
				{
					// copy($siteDir.'robots.txt', $siteDir.'aspro_regions/robots/robots_'.$arProperty["VALUE"].'.txt' );
					CopyDirFiles($siteDir.'robots.txt', $siteDir.'aspro_regions/robots/robots_'.$arProperty["VALUE"].'.txt', true, true);

					$arFile = file($siteDir.'aspro_regions/robots/robots_'.$arProperty["VALUE"].'.txt');
					$bHasHostRobots = $bHasHostSitemap = false;
					foreach($arFile as $key => $str)
					{
						if(strpos($str, "Host" ) !== false)
						{
							$arFile[$key] = "Host: ".(CMain::isHTTPS() ? "https://" : "http://").$arProperty["VALUE"]."\r\n";
							$bHasHostRobots = true;
						}
							
						if(strpos($str, "Sitemap" ) !== false)
						{
							$arFile[$key] = "Sitemap: ".(CMain::isHTTPS() ? "https://" : "http://").$arProperty["VALUE"]."/".$xml_file."\r\n";
							$bHasHostSitemap = true;
						}
					}
					
					if(!$bHasHostRobots)
						$arFile[] = "\r\nHost: ".(CMain::isHTTPS() ? "https://" : "http://").$arProperty["VALUE"];
					if(!$bHasHostSitemap && \Bitrix\Main\Loader::includeModule('statistic'))
						$arFile[] = "\r\nSitemap: ".(CMain::isHTTPS() ? "https://" : "http://").$arProperty["VALUE"]."/".$xml_file;

					$strr = implode("", $arFile);
					file_put_contents($siteDir.'aspro_regions/robots/robots_'.$arProperty["VALUE"].'.txt', $strr);
				}
			}
		}
	}
}
?>