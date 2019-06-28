<?php
/**
 * Priority module
 * @copyright 2017 Aspro
 */

CModule::AddAutoloadClasses(
	'aspro.priority',
	array(
		'priority' => 'install/index.php',
		'CPriority' => 'classes/general/CPriority.php',
		'CCache' => 'classes/general/CCache.php',
		//'CPriorityCache' => 'classes/general/CPriorityCache.php',
		'CPriorityTools' => 'classes/general/CPriorityTools.php',
		'CPriorityEvents' => 'classes/general/CPriorityEvents.php',
		'CInstargramPriority' => 'classes/general/CInstargramPriority.php',
		'CPriorityRegionality' => 'classes/general/CPriorityRegionality.php', //for regions
		'Aspro\\Functions\\CAsproPriority' => 'lib/functions/CAsproPriority.php', //for only solution functions
		'Aspro\\Functions\\CAsproPriorityCRM' => 'lib/functions/CAsproPriorityCRM.php', //for crm
		'Aspro\\Functions\\CAsproPriorityCustom' => 'lib/functions/CAsproPriorityCustom.php', //for user custom functions
		'Aspro\\Functions\\CAsproPriorityReCaptcha' => 'lib/functions/CAsproPriorityReCaptcha.php', //for google reCaptcha
	)
);

/* custom events */

// AddEventHandler('aspro.priority', 'OnAsproShowPageType', array('\Aspro\Functions\CAsproPriorityCustom', 'OnAsproShowPageTypeHandler')); 
// function - CPriority::ShowPageType

// AddEventHandler('aspro.priority', 'OnAsproParameters', array('\Aspro\Functions\CAsproPriorityCustom', 'OnAsproParametersHandler')); 
// function - CPriority::$arParametrsList

//AddEventHandler('aspro.priority', 'OnAsproRegionalityAddSelectFieldsAndProps', array('\Aspro\Functions\CAsproPriorityCustom', 'OnAsproRegionalityAddSelectFieldsAndPropsHandler')); // regionality

/*function OnAsproRegionalityAddSelectFieldsAndPropsHandler(&$arSelect){
	if($arSelect)
	{
		// $arSelect[] = 'PROPERTY_TEST';
	}
}*/

//AddEventHandler('aspro.priority', 'OnAsproRegionalityGetElements', array('\Aspro\Functions\CAsproPriorityCustom', 'OnAsproRegionalityGetElementsHandler')); // regionality

/*function OnAsproRegionalityGetElementsHandler(&$arItems){
	if($arItems)
	{
		print_r($arItems);
		foreach($arItems as $key => $arItem)
		{
			$arItems[$key]['TEST'] = CUSTOM_VALUE;
		}
	}
}*/