<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arServices = Array(
	"main" => array(
		"NAME" => GetMessage("SERVICE_MAIN_SETTINGS"),
		"STAGES" => array(
			"public.php",
			"template.php",
			"theme.php",
			"menu.php",
			"settings.php",
		),
	),
	"form" => array(
		"NAME" => GetMessage("SERVICE_FORM_DEMO_DATA"),
		"STAGES" => array(
			"callback.php",
			//"consultation.php",
			"add_review.php",
			"resume.php",
			"question.php",
			"order_services.php",
			"order_project.php",
			"order_product.php",
			"director.php",
			"toorder.php",
			"question_staff.php",
			//"errors_updates.php",
		)
	),	
	"iblock" => Array(
		"NAME" => GetMessage("SERVICE_IBLOCK_DEMO_DATA"),
		"STAGES" => Array(
			"types.php",
			"regions.php",
			"advtbig.php",
			"banners.php",
			"smbanners.php",
			"float_banners.php",
			//"bg_images.php",
			"tizers.php",
			//"reviews.php",
			"staff.php",
			"vacancy.php",
			"faq.php",
			"licenses.php",
			"licenses2.php",
			"hl_tizers.php",
			"hl_tizers_content.php",
			"hl_colors.php",
			"hl_colors_content.php",
			//"hl_company_content.php",
			//"hl_contact.php",
			//"hl_contact_content.php",
			"news_personal.php",
			"projects.php",
			"partners.php",
			"forms.php",
			//"articles.php",
			"tarif.php",
			"static.php",
			"contact.php",
			"add_review.php",
			"manufactures.php",
			"services.php",
			"news.php",
			"catalog.php",
			"catalog_info.php",
			"landing.php",
			"links.php",
		),
	),
	"search" => array(
		"NAME" => GetMessage("SERVICE_SEARCH"),
		"STAGES" => array(
			"search.php",
		),
	),
);
?>