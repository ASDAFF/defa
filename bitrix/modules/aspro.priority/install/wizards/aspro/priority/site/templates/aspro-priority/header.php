<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?><!DOCTYPE html>
<?
if(CModule::IncludeModule("aspro.priority"))
	$arThemeValues = CPriority::GetFrontParametrsValues(SITE_ID);
?>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>" class="<?=($_SESSION['SESS_INCLUDE_AREAS'] ? 'bx_editmode ' : '')?><?=strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0' ) ? 'ie ie7' : ''?> <?=strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE 8.0' ) ? 'ie ie8' : ''?> <?=strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0' ) ? 'ie ie9' : ''?>">
	<head>
		<?global $APPLICATION;?>
		<?IncludeTemplateLangFile(__FILE__);?>
		<title><?$APPLICATION->ShowTitle()?></title>
		<?$APPLICATION->ShowMeta("viewport");?>
		<?$APPLICATION->ShowMeta("HandheldFriendly");?>
		<?$APPLICATION->ShowMeta("apple-mobile-web-app-capable", "yes");?>
		<?$APPLICATION->ShowMeta("apple-mobile-web-app-status-bar-style");?>
		<?$APPLICATION->ShowMeta("SKYPE_TOOLBAR");?>
		<?$APPLICATION->ShowHead();?>
		<?$APPLICATION->AddHeadString('<script>BX.message('.CUtil::PhpToJSObject($MESS, false).')</script>', true);?>
		<?if(CModule::IncludeModule("aspro.priority")) {CPriority::Start(SITE_ID);}?>
	</head>

	<body class="<?=CPriority::getConditionClass();?> mheader-v<?=$arThemeValues["HEADER_MOBILE"];?> footer-v<?=strtolower($arThemeValues['FOOTER_TYPE']);?> fill_bg_<?=strtolower($arThemeValues['SHOW_BG_BLOCK']);?> title-v<?=$arThemeValues["PAGE_TITLE"];?><?=($arThemeValues['ORDER_VIEW'] == 'Y' && $arThemeValues['ORDER_BASKET_VIEW']=='HEADER'? ' with_order' : '')?><?=($arThemeValues['CABINET'] == 'Y' ? ' with_cabinet' : '')?><?=(intval($arThemeValues['HEADER_PHONES']) > 0 ? ' with_phones' : '')?><?=($arThemeValues['DECORATIVE_INDENTATION'] == 'Y' ? ' with_decorate' : '')?> wheader_v<?=$arThemeValues['HEADER_TYPE']?><?=($arThemeValues['ROUND_BUTTON'] == 'Y' ? ' round_button' : '');?><?=($arThemeValues['PAGE_TITLE_POSITION'] == 'center' ? ' title_center' : '');?><?=(CSite::inDir(SITE_DIR."index.php") ? ' in_index' : '')?>">
		<div id="panel"><?$APPLICATION->ShowPanel();?></div>
		<?if(!CModule::IncludeModule("aspro.priority")):?>
			<?$APPLICATION->SetTitle(GetMessage("ERROR_INCLUDE_MODULE_PRIORITY_TITLE"));?>
			<?$APPLICATION->IncludeFile(SITE_DIR."include/error_include_module.php");?>
			<?die();?>
		<?endif;?>
		<?CPriority::SetJSOptions();?>
		<?global $arTheme;?>
		<?$arTheme = $APPLICATION->IncludeComponent("aspro:theme.priority", "", array(), false);?>

		<?include_once('defines.php');?>
		<?CPriority::get_banners_position('TOP_HEADER');?>
		<div class="cd-modal-bg"></div>
		<?CPriority::ShowPageType('mega_menu');?>

		<div class="header_wrap visible-lg visible-md title-v<?=$arTheme["PAGE_TITLE"]["VALUE"];?><?=($isIndex ? ' index' : '')?>">
			<?CPriority::ShowPageType('header', '', 'HEADER_TYPE');?>
		</div>

		<?CPriority::get_banners_position('TOP_UNDERHEADER');?>

		<?if($arTheme["TOP_MENU_FIXED"]["VALUE"] == 'Y'):?>
			<div id="headerfixed">
				<?CPriority::ShowPageType('header_fixed');?>
			</div>
		<?endif;?>

		<div id="mobileheader" class="visible-xs visible-sm">
			<?CPriority::ShowPageType('header_mobile');?>
			<div id="mobilemenu" class="<?=($arTheme["HEADER_MOBILE_MENU_OPEN"]["VALUE"] == '1' ? 'leftside':'dropdown')?><?=($arTheme['HEADER_MOBILE_MENU_COLOR']['VALUE'] ? ' '.$arTheme['HEADER_MOBILE_MENU_COLOR']['VALUE'] : '')?>">
				<?CPriority::ShowPageType('header_mobile_menu');?>
			</div>
		</div>


		<div class="body <?=($isIndex ? 'index' : '')?> hover_<?=$arTheme["HOVER_TYPE_IMG"]["VALUE"];?>">
			<div class="body_media"></div>

			<div role="main" class="main banner-<?=$arTheme["BANNER_WIDTH"]["VALUE"];?>">
				<?if(!$isIndex && !$is404 && !$isForm):?>

					<?$APPLICATION->ShowViewContent('section_bnr_content');?>
					<?if($APPLICATION->GetProperty("HIDETITLE")!=='Y'):?>
						<!--title_content--> 
						<? CPriority::ShowPageType('page_title');?>
						<!--end-title_content-->
					<?endif;?>

					<?$APPLICATION->ShowViewContent('top_section_filter_content');?>
				<?endif; // if !$isIndex && !$is404 && !$isForm?>

				<div class="container <?=($isCabinet ? 'cabinte-page' : '');?>">
					<?if(!$isIndex && !$isCatalog && !$isProjects):?>
						<?if($APPLICATION->GetProperty("FULLWIDTH")!=='Y' || $isServices):?>
							<div class="maxwidth-theme">
						<?endif;?>
								<div class="row">
							<?if($is404):?>
								<div class="col-md-12 col-sm-12 col-xs-12 content-md">
							<?else:?>
								<?if(!$isMenu):?>
									<div class="col-md-12 col-sm-12 col-xs-12 content-md">
								<?elseif($isMenu && !$isServices && ($arTheme["SIDE_MENU"]["VALUE"] == "RIGHT" || $isBlog)):?>
									<div class="col-md-9 col-sm-12 col-xs-12 content-md">
									<?CPriority::get_banners_position('CONTENT_TOP');?>
								<?elseif($isMenu && !$isServices && $arTheme["SIDE_MENU"]["VALUE"] == "LEFT" && !$isBlog):?>
									<div class="col-md-3 col-sm-3 hidden-xs hidden-sm left-menu-md">
										<?CPriority::ShowPageType('left_block')?>
									</div>										
									<div class="col-md-9 col-sm-12 col-xs-12 content-md">
									<?CPriority::get_banners_position('CONTENT_TOP');?>
								<?endif;?>
							<?endif;?>
					<?endif;?>
					<?CPriority::checkRestartBuffer();?>