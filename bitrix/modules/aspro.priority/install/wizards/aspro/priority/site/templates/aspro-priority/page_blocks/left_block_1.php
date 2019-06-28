<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?global $isCabinet, $showLeftCallback, $showLeftAskQuestion, $showLeftAddReview, $showLeftMap;?>
<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"left",
	array(
		"ROOT_MENU_TYPE" => ($isCabinet ? "cabinet" : "left"),
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600000",
		"MENU_CACHE_USE_GROUPS" => ($isCabinet ? "Y" : "N"),
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "4",
		"CHILD_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "Y",
		"COMPONENT_TEMPLATE" => "left",
	),
	false
);?>
<div class="sidearea">
	<?$APPLICATION->ShowViewContent('under_sidebar_content');?>
	<?$APPLICATION->ShowViewContent('catalog_question_form');?>
	<?CPriority::get_banners_position('SIDE');?>
	<?if($showLeftCallback == 'Y' || $showLeftAskQuestion == 'Y' || $showLeftAddReview == 'Y' || $showLeftMap == 'Y'):?>
		<div class="side_forms">
			<?CPriority::checkShowForm($showLeftCallback, array('ICON_CLASS' => 'callback_icon', 'FORM_CODE' => 'aspro_priority_callback', 'FORM_NAME' => 'callback', 'FORM_TEXT' => GetMessage('CALLBACK_FORM_BUTTON_TEXT')));?>
			<?CPriority::checkShowForm($showLeftAskQuestion, array('ICON_CLASS' => 'question_icon', 'FORM_CODE' => 'aspro_priority_question', 'FORM_NAME' => 'question', 'FORM_TEXT' => GetMessage('ASK_QUESTION_FORM_BUTTON_TEXT')));?>
			<?CPriority::checkShowForm($showLeftAddReview, array('ICON_CLASS' => 'add_review_icon', 'FORM_CODE' => 'aspro_priority_add_review', 'FORM_NAME' => 'add_review', 'FORM_TEXT' => GetMessage('ADD_REVIEW_FORM_BUTTON_TEXT')));?>
			<?CPriority::checkShowForm($showLeftMap, array('ICON_CLASS' => 'map_icon', 'FORM_CODE' => 'map', 'FORM_NAME' => 'map', 'FORM_TEXT' => GetMessage('MAP_FORM_BUTTON_TEXT')));?>
		</div>
	<?endif;?>
</div>