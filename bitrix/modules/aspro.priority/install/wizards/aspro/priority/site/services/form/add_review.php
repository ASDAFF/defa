<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
$bitrixTemplateDir = $_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/templates/".WIZARD_TEMPLATE_ID;
if(!CModule::IncludeModule("form")) return;
if(!CModule::IncludeModule("main")) return;

$FORM_SID = "aspro_priority_add_review_".WIZARD_SITE_ID;
$dbSite = CSite::GetByID(WIZARD_SITE_ID);
if($arSite = $dbSite -> Fetch()) $lang = $arSite["LANGUAGE_ID"];
if(strlen($lang) <= 0) $lang = "ru";
	
WizardServices::IncludeServiceLang("forms.php", $lang);

/*Добавляем почтовое событие*/
if($db_res = CEventType::GetList(array("TYPE_ID" => "FORM_FILLING_".$FORM_SID))){ 
	$count = $db_res->SelectedRowsCount(); 
	if(!$count){
		$oEventType = new CEventType();
		$arFields = array("LID" => $lang, "EVENT_NAME" => "FORM_FILLING_".$FORM_SID, "NAME" => GetMessage("EVENT_NEW_ADD_REVIEW_NAME"), "DESCRIPTION" => GetMessage("EVENT_NEW_ADD_REVIEW_DESCRIPTION"));
		$oEventTypeSrcID = $oEventType->Add($arFields);
	}
}

/*Добавляем почтовый шаблон для данного сайта*/
$oEventMessage = new CEventMessage();
$by = "id"; $order = "asc";
$arFields = array("ACTIVE" => "Y", "EVENT_NAME" => "FORM_FILLING_".$FORM_SID, "LID" => WIZARD_SITE_ID, "EMAIL_FROM" => $wizard->GetVar("siteEmail"), "EMAIL_TO" => "#EMAIL#", "SUBJECT" => GetMessage("NEW_ADD_REVIEW_EMAIL_SUBJECT"), "MESSAGE" => GetMessage("NEW_ADD_REVIEW_EMAIL_TEXT"), "BODY_TYPE" => "html");
if($db_res = CEventMessage::GetList($by, $order, array("TYPE_ID" => "FORM_FILLING_".$FORM_SID, "SITE_ID" => array(WIZARD_SITE_ID)))){ 
	$count = $db_res->SelectedRowsCount(); 
	if($count > 0){
		while($res = $db_res->GetNext()){
			$oEventMessage->Update($res["ID"], $arFields);
		}
	}
	else{
		$oEventMessage->Add($arFields);
	}
}

/*Получить список шаблонов этого события*/
$arEventMessageIDs = array();
if($db_res = CEventMessage::GetList($by, $order, array ("TYPE_ID" => "FORM_FILLING_".$FORM_SID))){ 
	while($res = $db_res->GetNext()){
		$arEventMessageIDs[] = $res["ID"];
	}
}

/*Получить форму и её сайты*/
$form_id = false;
$arFormSiteIDs = array();
if($arForm = CForm::GetBySID($FORM_SID)->Fetch()){
	if(($form_id = $arForm["ID"]) > 0){
		/*Форма есть*/
		$arFormSiteIDs = CForm::GetSiteArray($arForm['ID']);
	}
}
$arFormSiteIDs[] = WIZARD_SITE_ID;
$arFormSiteIDs = array_unique($arFormSiteIDs);
/*Обновляем форму или создаем*/
if($form_id){
	$arFields = array(
		"arSITE"			=> $arFormSiteIDs,
		"arMAIL_TEMPLATE"	=> $arEventMessageIDs,
	);

	$form_id = CForm::Set($arFields, $form_id, "N");
	if($form_id < 0){
		return;
	}
}
else{
	$arFields = array(
		"NAME"				=> GetMessage("ADD_REVIEW_FORM_NAME"),
		"SID"				=> $FORM_SID,
		"C_SORT"			=> 300,
		"BUTTON"			=> GetMessage("ADD_REVIEW_BUTTON_NAME"),
		"DESCRIPTION"		=> GetMessage("ADD_REVIEW_FORM_DESCRIPTION"),
		"DESCRIPTION_TYPE"	=> "text",
		"STAT_EVENT1"		=> "form",
		"STAT_EVENT2"		=> "",
		"arSITE"			=> $arFormSiteIDs,
		"arMENU"			=> array( "ru" => GetMessage("ADD_REVIEW_FORM_NAME") ),
		"arGROUP"			=> array( "2" => "10" ),
		"arMAIL_TEMPLATE"	=> $arEventMessageIDs
	);	
	$form_id = CForm::Set($arFields);
	if($form_id < 0){
		return;
	}
	
	/* Добавляем вопросы */
	$arANSWER = array();
	$arANSWER[] = array("MESSAGE" => " ", "C_SORT" => 100, "ACTIVE" => "Y", "FIELD_TYPE" => "text", "FIELD_PARAM" => "");
	$arFields = array("FORM_ID" => $form_id, "ACTIVE" => "Y", "TITLE" => GetMessage("ADD_REVIEW_FORM_ADD_REVIEW_1"), "TITLE_TYPE" => "text", "SID" => "NAME", "C_SORT" => 100, "ADDITIONAL" => "N", "REQUIRED" => "Y", "arANSWER" => $arANSWER);
	CFormField::Set($arFields);

	$arANSWER = array();
	$arANSWER[] = array("MESSAGE" => " ", "C_SORT" => 200, "ACTIVE" => "Y", "FIELD_TYPE" => "text", "FIELD_PARAM" => "");
	$arFields = array("FORM_ID" => $form_id, "ACTIVE" => "Y", "TITLE" => GetMessage("ADD_REVIEW_FORM_ADD_REVIEW_2"), "TITLE_TYPE" => "text", "SID" => "POST", "C_SORT" => 200, "ADDITIONAL" => "N", "REQUIRED" => "N", "arANSWER" => $arANSWER);
	CFormField::Set($arFields);

	$arANSWER = array();
	$arANSWER[] = array("MESSAGE" => " ", "C_SORT" => 300, "ACTIVE" => "Y", "FIELD_TYPE" => "file", "FIELD_PARAM" => "");
	$arFields = array("FORM_ID" => $form_id, "ACTIVE" => "Y", "TITLE" => GetMessage("ADD_REVIEW_FORM_ADD_REVIEW_3"), "TITLE_TYPE" => "file", "SID" => "FILE", "C_SORT" => 400, "ADDITIONAL" => "N", "REQUIRED" => "N", "arANSWER" => $arANSWER);
	CFormField::Set($arFields);
	
	$arANSWER = array();
	$arANSWER[] = array("MESSAGE" => " ", "C_SORT" => 400, "ACTIVE" => "Y", "FIELD_TYPE" => "text", "FIELD_PARAM" => "");
	$arFields = array("FORM_ID" => $form_id, "ACTIVE" => "Y", "TITLE" => GetMessage("ADD_REVIEW_FORM_ADD_REVIEW_4"), "TITLE_TYPE" => "text", "SID" => "VIDEO", "C_SORT" => 400, "ADDITIONAL" => "N", "REQUIRED" => "N", "arANSWER" => $arANSWER);
	CFormField::Set($arFields);
	
	$arANSWER = array();
	$arANSWER[] = array("MESSAGE" => " ", "C_SORT" => 500, "ACTIVE" => "Y", "FIELD_TYPE" => "hidden", "FIELD_PARAM" => "");
	$arFields = array("FORM_ID" => $form_id, "ACTIVE" => "Y", "TITLE" => GetMessage("ADD_REVIEW_FORM_ADD_REVIEW_5"), "TITLE_TYPE" => "text", "SID" => "RATING", "C_SORT" => 500, "ADDITIONAL" => "N", "REQUIRED" => "N", "arANSWER" => $arANSWER);
	CFormField::Set($arFields);

	$arANSWER = array();
	$arANSWER[] = array("MESSAGE" => " ", "C_SORT" => 600, "ACTIVE" => "Y", "FIELD_TYPE" => "textarea", "FIELD_PARAM" => "");
	$arFields = array("FORM_ID" => $form_id, "ACTIVE" => "Y", "TITLE" => GetMessage("ADD_REVIEW_FORM_ADD_REVIEW_6"), "TITLE_TYPE" => "text", "SID" => "MESSAGE", "C_SORT" => 600, "ADDITIONAL" => "N", "REQUIRED" => "Y", "arANSWER" => $arANSWER);
	CFormField::Set($arFields);

	/* Добавляем статус */
	$arFields = array("FORM_ID" => $form_id, "C_SORT" => 100, "ACTIVE" => "Y", "TITLE" => "DEFAULT", "DEFAULT_VALUE" => "Y", "arPERMISSION_VIEW" => array(2), "arPERMISSION_MOVE" => array(2), "arPERMISSION_EDIT" => array(2), "arPERMISSION_DELETE" => array(2));
	CFormStatus::Set($arFields);
}

/*Заменяем макросы*/
CWizardUtil::ReplaceMacros($bitrixTemplateDir."/header.php", array("ADD_REVIEW_FORM_ID" => $form_id));
?>