<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/main/install/wizard_sol/wizard.php");?>
<?include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/wizards/aspro/priority/css/styles.css");?>
<script>
	<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/wizards/aspro/priority/js/jquery-1.8.3.min.js");?>
	<?require_once($_SERVER['DOCUMENT_ROOT']."/bitrix/wizards/aspro/priority/js/jquery.keyboard.js");?>
	function setWizardBackgroundColor(theme){
		window.console&&console.log(theme);
		switch (theme) {
			case "1":
				$(".instal-bg").css("backgroundColor", "#2b7de0");
				break;
			case "2":
				$(".instal-bg").css("backgroundColor", "#6465f1");
				break;
			case "3":
				$(".instal-bg").css("backgroundColor", "#8059d8");
				break;
			case "4":
				$(".instal-bg").css("backgroundColor", "#a453b9");
				break;
			case "5":
				$(".instal-bg").css("backgroundColor", "#da3b64");
				break;
			case "6":
				$(".instal-bg").css("backgroundColor", "#d2334d");
				break;
			case "7":
				$(".instal-bg").css("backgroundColor", "#da2a34");
				break;
			case "8":
				$(".instal-bg").css("backgroundColor", "#ef5a54");
				break;
			case "9":
				$(".instal-bg").css("backgroundColor", "#f17036");
				break;
			case "10":
				$(".instal-bg").css("backgroundColor", "#fb992a");
				break;
			case "11":
				$(".instal-bg").css("backgroundColor", "#85b82d");
				break;
			case "12":
				$(".instal-bg").css("backgroundColor", "#1da72e");
				break;
			case "13":
				$(".instal-bg").css("backgroundColor", "#1ca263");
				break;
			case "14":
				$(".instal-bg").css("backgroundColor", "#1baf9f");
				break;
			case "15":
				$(".instal-bg").css("backgroundColor", "#25b3e5");
				break;
			case "16":
				$(".instal-bg").css("backgroundColor", "#2b97df");
				break;
			case "17":
				$(".instal-bg").css("backgroundColor", "#1b70ca");
				break;
			case "CUSTOM":
				$(".instal-bg").css("backgroundColor", "#de002b");
				break;
			default:
				$(".instal-bg").css("backgroundColor", "#de002b");
				break;
		}
	}
	$(document).ready(function(){
		$("body").keyboard('ctrl+shift+f', { preventDefault : true }, function () { document.location.href = document.location.href+"&fast=y"; } )
	});
</script>
<?if(isset($_REQUEST["fast"]) && (strtolower($_REQUEST["fast"])=="y")):?>
	<script>
		$(document).ready(function(){
			if($("input#installDemoData").length){
				$("input#installDemoData").attr("checked", "checked");
			}
			if($(".wizard-next-button").length){
				if($(".wizard-next-button").attr("value")!="������� �� ����"){
					$(".wizard-next-button").click();
				}
			}
		});
	</script>
<?endif;?>
<?

function setLastWritedIblockParams($id = false, $type = false, $code = false){
	$_SESSION["WIZARD_LAST_WRITTED_IBLOCK"]["ID"] = ($id && intVal($id)) ? intVal($id) : false;
	$_SESSION["WIZARD_LAST_WRITTED_IBLOCK"]["CODE"] = ($code && trim($code)) ? trim($code) : false;
	$_SESSION["WIZARD_LAST_WRITTED_IBLOCK"]["TYPE"] = ($type && trim($type)) ? trim($type) : false;

	if ( intVal($_SESSION["WIZARD_LAST_WRITTED_IBLOCK"]["ID"]) ||
		 trim($_SESSION["WIZARD_LAST_WRITTED_IBLOCK"]["TYPE"]) ||
		 trim($_SESSION["WIZARD_LAST_WRITTED_IBLOCK"]["CODE"]) )
	{return true;} else {return false;}
}

function getLastWritedIblockParams(){
	$arResult = array(
		"ID" => ($_SESSION["WIZARD_LAST_WRITTED_IBLOCK"]["ID"] ? intVal($_SESSION["WIZARD_LAST_WRITTED_IBLOCK"]["ID"]) : false),
		"TYPE" => ($_SESSION["WIZARD_LAST_WRITTED_IBLOCK"]["TYPE"] ? trim($_SESSION["WIZARD_LAST_WRITTED_IBLOCK"]["TYPE"]) : false),
		"CODE" => ($_SESSION["WIZARD_LAST_WRITTED_IBLOCK"]["CODE"] ? trim($_SESSION["WIZARD_LAST_WRITTED_IBLOCK"]["CODE"]) : false),
	);
	foreach($arResult as $key => $value){
		if(!$value){
			unset($arResult[$key]);
		}
	}
	return count($arResult) ? $arResult : false;
}

function clearLastWritedIblockParams(){
	unset($_SESSION["WIZARD_LAST_WRITTED_IBLOCK"]);
	return true;
}

class SelectSiteStep extends CSelectSiteWizardStep{
	function InitStep(){
		parent::InitStep();
		$wizard =& $this->GetWizard();
		$wizard->solutionName = "priority";
	}
}

class SelectTemplateStep extends CSelectTemplateWizardStep{
	function InitStep(){
		$wizard =& $this->GetWizard();

		$this->SetStepID("select_template");
		$this->SetTitle(GetMessage("SELECT_TEMPLATE_TITLE"));
		$this->SetSubTitle(GetMessage("SELECT_TEMPLATE_SUBTITLE"));

		if (!defined("WIZARD_DEFAULT_SITE_ID")){
			$this->SetPrevStep("select_site");
			$this->SetPrevCaption(GetMessage("PREVIOUS_BUTTON"));
		}
		else{
			$wizard =& $this->GetWizard();
			$wizard->SetVar("siteID", WIZARD_DEFAULT_SITE_ID);
		}

		$this->SetNextStep("select_theme");
		$this->SetNextCaption(GetMessage("NEXT_BUTTON"));
		$wizard->SetDefaultVars(Array("templateID" => "priority"));
	}

	function OnPostForm(){
		$wizard =& $this->GetWizard();

		$proactive = COption::GetOptionString("statistic", "DEFENCE_ON", "N");
		if ($proactive == "Y"){
			COption::SetOptionString("statistic", "DEFENCE_ON", "N");
			$wizard->SetVar("proactive", "Y");
		}
		else{
			$wizard->SetVar("proactive", "N");
		}

		if ($wizard->IsNextButtonClick()){
			$templatesPath = WizardServices::GetTemplatesPath($wizard->GetPath()."/site");
			$arTemplates = WizardServices::GetTemplates($templatesPath);
			$templateID = $wizard->GetVar("templateID");

			if (!array_key_exists($templateID, $arTemplates))
				$this->SetError(GetMessage("wiz_template"));

		}
	}

	function ShowStep(){
		if (!CModule::IncludeModule("aspro.priority")){
			$this->content .= "<p style='color:red'>".GetMessage("WIZ_NO_MODULE_")."</p>";
			?>
			<script type="text/javascript">
			$(document).ready(function() {
				$('.wizard-next-button').remove();
			});
			</script>
			<?
		}
		else{
			$wizard =& $this->GetWizard();

			$templatesPath = WizardServices::GetTemplatesPath($wizard->GetPath()."/site");
			$arTemplates = WizardServices::GetTemplates($templatesPath);

			if (empty($arTemplates))
				return;

			$templateID = $wizard->GetVar("templateID");
			if(isset($templateID) && array_key_exists($templateID, $arTemplates)){

				$defaultTemplateID = $templateID;
				$wizard->SetDefaultVar("templateID", $templateID);

			} else {

				$defaultTemplateID = COption::GetOptionString("main", "wizard_template_id", "", $wizard->GetVar("siteID"));
				if (!(strlen($defaultTemplateID) > 0 && array_key_exists($defaultTemplateID, $arTemplates)))
				{
					if (strlen($defaultTemplateID) > 0 && array_key_exists($defaultTemplateID, $arTemplates))
						$wizard->SetDefaultVar("templateID", $defaultTemplateID);
					else
						$defaultTemplateID = "";
				}
				elseif (strlen($defaultTemplateID) > 0 && array_key_exists($defaultTemplateID, $arTemplates))
					$wizard->SetDefaultVar("templateID", $defaultTemplateID);

			}

			global $SHOWIMAGEFIRST;
			$SHOWIMAGEFIRST = true;

			$this->content .= '<div id="solutions-container" class="inst-template-list-block">';
			foreach ($arTemplates as $templateID => $arTemplate)
			{
				if ($defaultTemplateID == "")
				{
					$defaultTemplateID = $templateID;
					$wizard->SetDefaultVar("templateID", $defaultTemplateID);
				}

				$this->content .= '<div class="inst-template-description">';
				$this->content .= $this->ShowRadioField("templateID", $templateID, Array("id" => $templateID, "class" => "inst-template-list-inp"));
				if ($arTemplate["SCREENSHOT"] && $arTemplate["PREVIEW"])
					$this->content .= CFile::Show2Images($arTemplate["PREVIEW"], $arTemplate["SCREENSHOT"], 150, 150, ' class="inst-template-list-img"');
				else
					$this->content .= CFile::ShowImage($arTemplate["SCREENSHOT"], 150, 150, ' class="inst-template-list-img"', "", true);

				$this->content .= '<label for="'.$templateID.'" class="inst-template-list-label">'.$arTemplate["NAME"].'<p>'.$arTemplate["DESCRIPTION"].'</p></label>';
				$this->content .= "</div>";

			}

			$this->content .= '</div>';
		}
	}
}

class SelectThemeStep extends CSelectThemeWizardStep{
	function InitStep(){
		$this->SetStepID("select_theme");
		$this->SetTitle(GetMessage("SELECT_THEME_TITLE"));
		$this->SetSubTitle(GetMessage("SELECT_THEME_SUBTITLE"));
		$this->SetPrevStep("select_template");
		$this->SetPrevCaption(GetMessage("PREVIOUS_BUTTON"));
		$this->SetNextStep("site_settings");
		$this->SetNextCaption(GetMessage("NEXT_BUTTON"));
	}

	function OnPostForm(){
		$wizard =& $this->GetWizard();
		if ($wizard->IsNextButtonClick()){
			$templateID = $wizard->GetVar("templateID");
			$themeVarName = $templateID."_themeID";
			$themeID = $wizard->GetVar($themeVarName);
			$templatesPath = WizardServices::GetTemplatesPath($wizard->GetPath()."/site");
			$arThemes = WizardServices::GetThemes($templatesPath."/".$templateID."/themes");

			if(!array_key_exists($themeID, $arThemes)){
				$this->SetError(GetMessage("wiz_template_color"));
			}
		}
	}

	function ShowStep(){
		$wizard =& $this->GetWizard();
		$templateID = $wizard->GetVar("templateID");
		$siteID = $wizard->GetVar("siteID");
		$templatesPath = WizardServices::GetTemplatesPath($wizard->GetPath()."/site");
		if(!$arThemes = WizardServices::GetThemes($templatesPath."/".$templateID."/themes")){
			return;
		}

		$this->sortThemes($arThemes);
		$themeVarName = $templateID."_themeID";

		$arCurSiteTheme = CPriority::GetBackParametrsValues($siteID);
		$ThemeID = $arCurSiteTheme["BASE_COLOR"];

		if(!strlen($ThemeID) || $ThemeID == "CUSTOM"){
			$ThemeID = "1";
		}
		if(strlen($ThemeID) && array_key_exists($ThemeID, $arThemes)){
			$defaultThemeID = $ThemeID;
			$wizard->SetDefaultVar($themeVarName, $ThemeID);
		}

		$this->content =
		'<script type="text/javascript">
		function SelectTheme(element, solutionId, imageUrl)
		{
			setWizardBackgroundColor(solutionId);

			var backgroundContainer = document.getElementsByClassName("instal-bg");

			var container = document.getElementById("solutions-container");
			var anchors = container.getElementsByTagName("SPAN");
			for (var i = 0; i < anchors.length; i++)
			{
				if (anchors[i].parentNode == container)
					anchors[i].className = "inst-template-color";
			}
			element.className = "inst-template-color inst-template-color-selected";
			var hidden = document.getElementById("selected-solution");
			if (!hidden)
			{
				hidden = document.createElement("INPUT");
				hidden.type = "hidden"
				hidden.id = "selected-solution";
				hidden.name = "selected-solution";
				container.appendChild(hidden);
			}
			hidden.value = solutionId;

			var preview = document.getElementById("solution-preview");
			if (!imageUrl)
				preview.style.display = "none";
			else
			{
				document.getElementById("solution-preview-image").src = imageUrl;
				preview.style.display = "";
			}
		}
		</script>'.
		'<div id="html_container">'.
		'<div class="inst-template-color-block" id="solutions-container"><style>#solution-preview-image{width:537px; height: 571px;}</style>';
		$ii = 0;
		$arDefaultTheme = array();
		foreach($arThemes as $themeID => $arTheme){
			if($themeID == "CUSTOM"){
				continue;
			}
			if($defaultThemeID == ""){
				$defaultThemeID = $themeID;
				$wizard->SetDefaultVar($themeVarName, $defaultThemeID);
			}
			if($defaultThemeID == $themeID){
				$arDefaultTheme = $arTheme;
			}
			++$ii;

			$this->content .= '
				<span themeName="'.$themeID.'" class="inst-template-color'.($defaultThemeID == $themeID ? " inst-template-color-selected" : "").'" ondblclick="SubmitForm(\'next\');"  onclick="SelectTheme(this, \''.$themeID.'\', \''.$arTheme["SCREENSHOT"].'\');">
					<span class="inst-templ-color-img">'.CFile::ShowImage($arTheme["SCREENSHOT"], 70, 64, ' border="0" class="solution-image"').'</span>
					<span class="inst-templ-color-name">'.$arTheme["NAME"].'</span>
				</span>';
		}

		$this->content .= '<script type="text/javascript">	$(document).ready(function(){setWizardBackgroundColor($(".inst-template-color-block .inst-template-color.inst-template-color-selected").attr("themeName"));});</script>';
		$this->content .= $this->ShowHiddenField($themeVarName, $defaultThemeID, array("id" => "selected-solution"));
		$this->content .=
			'</div>'.
			'<div id="solution-preview">'.
				'<b class="r3"></b><b class="r1"></b><b class="r1"></b>'.
					'<div class="solution-inner-item">'.
						CFile::ShowImage($arDefaultTheme["SCREENSHOT"], 682, 625, ' border="0" id="solution-preview-image"').
					'</div>'.
				'<b class="r1"></b><b class="r1"></b><b class="r3"></b>'.
			'</div>'.
		'</div>';
	}

	function sortThemes(&$arThemes){
		function cmpSort($t1, $t2){
			return ($t1["SORT"] > $t2["SORT"] ? 1 : ($t1["SORT"] < $t2["SORT"] ? -1 : 0));
		}
		uasort($arThemes, "cmpSort");
	}
}

class SiteSettingsStep extends CSiteSettingsWizardStep{
	function InitStep(){
		if (CModule::IncludeModule("aspro.priority")){
			$wizard =& $this->GetWizard();
			$wizard->solutionName = "priority";
			parent::InitStep();
			$this->SetNextCaption(GetMessage("NEXT_BUTTON"));
			$this->SetTitle(GetMessage("WIZ_STEP_SITE_SET"));
			$this->SetNextStep("data_install");
			$siteID = $wizard->GetVar("siteID");
			$obSite = new CSite;
			$arSite = $obSite->GetByID($siteID)->Fetch();
			$arCurSiteTheme = CPriority::GetBackParametrsValues($siteID);

			$phone = ($arCurSiteTheme['HEADER_PHONES'] ? ((isset($arCurSiteTheme['HEADER_PHONES_array_PHONE_VALUE_0']) && $arCurSiteTheme['HEADER_PHONES_array_PHONE_VALUE_0']) ? $arCurSiteTheme['HEADER_PHONES_array_PHONE_VALUE_0'] : '') : '');

			$shopVk = $arCurSiteTheme["SOCIAL_VK"];
			$shopFacebook = $arCurSiteTheme["SOCIAL_FACEBOOK"];
			$shopTwitter = $arCurSiteTheme["SOCIAL_TWITTER"];
			$shopInstagram = $arCurSiteTheme["SOCIAL_INSTAGRAM"];
			$shopTelegram = $arCurSiteTheme["SOCIAL_TELEGRAM"];
			$shopYoutube = $arCurSiteTheme["SOCIAL_YOUTUBE"];
			$shopOdnoklassniki = $arCurSiteTheme["SOCIAL_ODNOKLASSNIKI"];
			$shopGooglePlus = $arCurSiteTheme["SOCIAL_GOOGLEPLUS"];
			$shopMailRu = $arCurSiteTheme["SOCIAL_MAIL"];
			$wizard->SetDefaultVars(
				Array(
					"siteLogoSet" => false,
					"siteNameSet" => true,
					"siteName" => (strlen($arSite["SITE_NAME"]) ? $arSite["SITE_NAME"] : (strlen($arSite["NAME"]) ? $arSite["NAME"] : GetMessage("WIZ_COMPANY_NAME_DEF"))),
					"siteTelephone" => ($phone ? $phone : GetMessage("WIZ_COMPANY_TELEPHONE_DEF")),
					"siteCopy" => GetMessage("WIZ_COMPANY_COPY_DEF"),
					"siteEmail" => strip_tags($this->GetFileContent(WIZARD_SITE_PATH."include/footer/site-email.php", GetMessage("WIZ_COMPANY_EMAIL_DEF"))),
					"siteAddress" => $this->GetFileContent(WIZARD_SITE_PATH."include/header/site-address.php", GetMessage("WIZ_COMPANY_ADDRESS_DEF")),
					"siteSchedule" => $this-> GetFileContent(WIZARD_SITE_PATH."include/contacts-site-schedule.php", GetMessage("WIZ_COMPANY_SCHEDULE_DEF")),
					"shopVk" => (strlen($shopVk) ? $shopVk : GetMessage("WIZ_SHOP_VK_DEF")),
					"shopTwitter" => (strlen($shopTwitter) ? $shopTwitter : GetMessage("WIZ_SHOP_TWITTER_DEF")),
					"shopFacebook" => (strlen($shopFacebook) ? $shopFacebook : GetMessage("WIZ_SHOP_FACEBOOK_DEF")),
					"shopInstagram" => (strlen($shopInstagram) ? $shopInstagram : GetMessage("WIZ_SHOP_INSTAGRAM_DEF")),
					"shopTelegram" => (strlen($shopTelegram) ? $shopTelegram : GetMessage("WIZ_SHOP_TELEGRAM_DEF")),
					"shopYoutube" => (strlen($shopYoutube) ? $shopYoutube : GetMessage("WIZ_SHOP_YOUTUBE_DEF")),
					"shopOdnoklassniki" => (strlen($shopOdnoklassniki) ? $shopOdnoklassniki : GetMessage("WIZ_SHOP_ODNOKLASSNIKI_DEF")),
					"shopGooglePlus" => (strlen($shopGooglePlus) ? $shopGooglePlus : GetMessage("WIZ_SHOP_GOOGLEPLUS_DEF")),
					"shopMailRu" => (strlen($shopMailRu) ? $shopMailRu : GetMessage("WIZ_SHOP_MAILRU_DEF")),
					"siteMetaDescription" => GetMessage("wiz_site_desc"),
					"siteMetaKeywords" => GetMessage("wiz_keywords"),
				)
			);
		}
	}

	function ShowStep(){
		if (!CModule::IncludeModule("aspro.priority")){
			$this->content .= "<p style='color:red'>".GetMessage("WIZ_NO_MODULE_")."</p>";
			?>
			<script type="text/javascript">
			$(document).ready(function() {
				$('.wizard-next-button').remove();
			});
			</script>
			<?
		}
		else{
			$wizard =& $this->GetWizard();
			$templateID = $wizard->GetVar("templateID");
			$themeVarName = $templateID."_themeID";
			$themeID = $wizard->GetVar($themeVarName);
			$this->content .='<script type="text/javascript">$(document).ready(function(){setWizardBackgroundColor("'.$themeID.'");});</script>';

			$this->content .= '<div class="wizard-input-form">';
			if($wizard->GetVar('siteNameSet', true)){
				$this->content .= '
				<div class="wizard-input-form-block">
					<label for="siteName" class="wizard-input-title">'.GetMessage("WIZ_COMPANY_NAME").'</label><br />'
					.$this->ShowInputField('text', 'siteName', array("class"=>"wizard-field", "id" => "siteName")).'
				</div>';
			}

			if($wizard->GetVar('siteLogoSet', true)){
				$siteLogo = $wizard->GetVar("siteLogo", true);

				$this->content .= '
				<div class="wizard-input-form-block">
					<label for="siteLogo" class="wizard-input-title">'.GetMessage("WIZ_COMPANY_LOGO").'</label><br />'
					.CFile::ShowImage($siteLogo, 360, 90, "border=0 vspace=15") . '<br>' .
					$this->ShowFileField("siteLogo", Array("show_file_info" => "N", "id" => "siteLogo")).'
				</div>';
			}

			// copyright
			$this->content .= '
			<div class="wizard-input-form-block">
				<label for="siteCopy" class="wizard-input-title">'.GetMessage("WIZ_COMPANY_COPY").'</label><br />'
				.$this->ShowInputField('textarea', 'siteCopy', array("class"=>"wizard-field", "rows"=>"3", "id" => "siteCopy")).'
				<span style="display:inline-block;font-size:12px;margin-top:5px;vertical-align:top;">'.GetMessage("WIZ_COMPANY_COPY_NOTE").'</span>
			</div>';

			// phone
			$this->content .= '
			<div class="wizard-input-form-block">
				<label for="siteTelephone" class="wizard-input-title">'.GetMessage("WIZ_COMPANY_TELEPHONE").'</label><br />'
				.$this->ShowInputField('text', 'siteTelephone', array("class"=>"wizard-field", "id" => "siteTelephone")).'
				<span style="display:inline-block;font-size:12px;margin-top:5px;vertical-align:top;">'.GetMessage("WIZ_COMPANY_PHONE_NOTE").'</span>
			</div>';

			// email
			$this->content .= '
			<div class="wizard-input-form-block">
				<label for="siteEmail" class="wizard-input-title">'.GetMessage("WIZ_COMPANY_EMAIL").'</label><br />'
				.$this->ShowInputField('textarea', 'siteEmail', array("class"=>"wizard-field", "id" => "siteEmail")).'
			</div>';

			// address
			$this->content .= '
			<div class="wizard-input-form-block">
				<label for="siteAddress" class="wizard-input-title">'.GetMessage("WIZ_COMPANY_ADDRESS").'</label><br />'
				.$this->ShowInputField('textarea', 'siteAddress', array("class"=>"wizard-field", "id" => "siteAddress")).'
			</div>';

			// schedule
			$this->content .= '
			<div class="wizard-input-form-block">
				<label for="siteSchedule" class="wizard-input-title">'.GetMessage("WIZ_COMPANY_SCHEDULE").'</label><br />'
				.$this->ShowInputField('textarea', 'siteSchedule', array("class"=>"wizard-field", "id" => "siteSchedule")).'
			</div>';

			// social
			$this->content .= '
			<div class="wizard-input-form-block">
				<label for="shopTwitter" class="wizard-input-title">'.GetMessage("WIZ_SHOP_TWITTER").'</label><br />'
				.$this->ShowInputField('text', 'shopTwitter', array("class"=>"wizard-field", "id" => "shopTwitter")).'
			</div>';

			$this->content .= '
			<div class="wizard-input-form-block">
				<label for="shopVk" class="wizard-input-title">'.GetMessage("WIZ_SHOP_VK").'</label><br />'
				.$this->ShowInputField('text', 'shopVk', array("class"=>"wizard-field", "id" => "shopVk")).'
			</div>';

			$this->content .= '
			<div class="wizard-input-form-block">
				<label for="shopFacebook" class="wizard-input-title">'.GetMessage("WIZ_SHOP_FACEBOOK").'</label><br />'
				.$this->ShowInputField('text', 'shopFacebook', array("class"=>"wizard-field", "id" => "shopFacebook")).'
			</div>';

			$this->content .= '
			<div class="wizard-input-form-block">
				<label for="shopInstagram" class="wizard-input-title">'.GetMessage("WIZ_SHOP_INSTAGRAM").'</label><br />'
				.$this->ShowInputField('text', 'shopInstagram', array("class"=>"wizard-field", "id" => "shopInstagram")).'
			</div>';

			$this->content .= '
			<div class="wizard-input-form-block">
				<label for="shopTelegram" class="wizard-input-title">'.GetMessage("WIZ_SHOP_TELEGRAM").'</label><br />'
				.$this->ShowInputField('text', 'shopTelegram', array("class"=>"wizard-field", "id" => "shopTelegram")).'
			</div>';

			$this->content .= '
			<div class="wizard-input-form-block">
				<label for="shopYoutube" class="wizard-input-title">'.GetMessage("WIZ_SHOP_YOUTUBE").'</label><br />'
				.$this->ShowInputField('text', 'shopYoutube', array("class"=>"wizard-field", "id" => "shopYoutube")).'
			</div>';

			$this->content .= '
			<div class="wizard-input-form-block">
				<label for="shopOdnoklassniki" class="wizard-input-title">'.GetMessage("WIZ_SHOP_ODNOKLASSNIKI").'</label><br />'
				.$this->ShowInputField('text', 'shopOdnoklassniki', array("class"=>"wizard-field", "id" => "shopOdnoklassniki")).'
			</div>';

			$this->content .= '
			<div class="wizard-input-form-block">
				<label for="shopGooglePlus" class="wizard-input-title">'.GetMessage("WIZ_SHOP_GOOGLEPLUS").'</label><br />'
				.$this->ShowInputField('text', 'shopGooglePlus', array("class"=>"wizard-field", "id" => "shopGooglePlus")).'
			</div>';

			$this->content .= '
			<div class="wizard-input-form-block">
				<label for="shopMailRu" class="wizard-input-title">'.GetMessage("WIZ_SHOP_MAILRU").'</label><br />'
				.$this->ShowInputField('text', 'shopMailRu', array("class"=>"wizard-field", "id" => "shopMailRu")).'
			</div>';

			// meta
			$this->content .= '
			<div  id="bx_metadata" '.$styleMeta.'>
				<div class="wizard-input-form-block">
					<div class="wizard-metadata-title">'.GetMessage("wiz_meta_data").'</div>
					<label for="siteMetaDescription" class="wizard-input-title">'.GetMessage("wiz_meta_description").'</label>
					'.$this->ShowInputField("textarea", "siteMetaDescription", array("class" => "wizard-field", "id" => "siteMetaDescription", "style" => "width:100%", "rows"=>"3")).'
				</div>';

			$this->content .= '
				<div class="wizard-input-form-block">
					<label for="siteMetaKeywords" class="wizard-input-title">'.GetMessage("wiz_meta_keywords").'</label><br>
					'.$this->ShowInputField('text', 'siteMetaKeywords', array("class" => "wizard-field", "id" => "siteMetaKeywords")).'
				</div>
			</div>';

			$this->content .= $this->ShowHiddenField("installDemoData", "Y");
			$this->content .= '</div>';
		}
	}

	function OnPostForm(){
		$wizard =& $this->GetWizard();

		$res = $this->SaveFile("siteLogo", Array("extensions" => "gif,jpg,jpeg,png", "max_height" => 50, "max_width" => 190, "make_preview" => "Y"));
		if(file_exists(WIZARD_SITE_PATH."include/logo.jpg")){
			$wizard->SetVar("siteLogoSet", true);
		}
	}
}

class DataInstallStep extends CDataInstallWizardStep{
	function InitStep(){
		$wizard =& $this->GetWizard();
		$this->SetStepID("data_install");
		$this->SetTitle(GetMessage("WIZ_STEP_INSTALL_DATA"));
		$this->SetSubTitle(GetMessage("WIZ_STEP_INSTALL_DATA"));
		$templateID = $wizard->GetVar("templateID");
		$ThemeID = $wizard->GetVar($templateID."_themeID");
		$this->content .='<script type="text/javascript">$(document).ready(function(){setWizardBackgroundColor("'.$ThemeID.'");});</script>';
	}

	function CorrectServices(&$arServices){
		if($_SESSION["BX_priority_LOCATION"] == "Y") $this->repeatCurrentService = true;
		else $this->repeatCurrentService = false;
		$wizard =& $this->GetWizard();

		$iblockParams = getLastWritedIblockParams();
		if ($iblockParams && intVal($iblockParams["ID"]) && trim($iblockParams["CODE"])){
			switch ($iblockParams["CODE"]){
				//perform any manipulations with last installed infoblock
				default:
				break;
			}
		}
		clearLastWritedIblockParams(); //cuz correct need only once

		if($wizard->GetVar("installDemoData") != "Y"){
		}
	}
}

class FinishStep extends CFinishWizardStep{
	function InitStep(){
		$this->SetStepID("finish");
		$this->SetNextStep("finish");
		$this->SetTitle(GetMessage("FINISH_STEP_TITLE"));
		$this->SetNextCaption(GetMessage("wiz_go"));
	}

	function checkValid(){
		return true;
	}

	function ShowStep(){
		$wizard =& $this->GetWizard();

		$templateID = $wizard->GetVar("templateID");
		$ThemeID = $wizard->GetVar($templateID."_themeID");
		$this->content .='<script type="text/javascript">$(document).ready(function(){setWizardBackgroundColor("'.$ThemeID.'");});</script>';

		if($wizard->GetVar("installDemoData") == "Y")
		{
			if(!CModule::IncludeModule("iblock")) return;
		}

		if ($wizard->GetVar("proactive") == "Y")
			COption::SetOptionString("statistic", "DEFENCE_ON", "Y");

		$siteID = WizardServices::GetCurrentSiteID($wizard->GetVar("siteID"));
		$rsSites = CSite::GetByID($siteID);
		$siteDir = "/";
		if ($arSite = $rsSites->Fetch())
			$siteDir = $arSite["DIR"];

		$wizard->SetFormActionScript(str_replace("//", "/", $siteDir."/?finish"));

		$this->CreateNewIndex();

		COption::SetOptionString("main", "wizard_solution", $wizard->solutionName, false, $siteID);

		$this->content .= GetMessage("FINISH_STEP_CONTENT");
		$this->content .= "";

		if ($wizard->GetVar("installDemoData") == "Y")
			$this->content .= GetMessage("FINISH_STEP_REINDEX");

		if(CModule::IncludeModule("aspro.priority")) {
			CPriority::sendAsproBIAction("wizard_installed");
		}

		COption::SetOptionString("aspro.priority", "WIZARD_DEMO_INSTALLED", "Y");
	}
}
?>