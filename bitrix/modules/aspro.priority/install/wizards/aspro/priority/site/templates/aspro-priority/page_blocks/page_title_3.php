<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<section class="page-top maxwidth-theme title_v3 <?CPriority::ShowPageProps('TITLE_CLASS');?>">	
	<div class="row">
		<div class="col-md-12">
			<h1 id="pagetitle"><?$APPLICATION->ShowTitle(false)?></h1>
			<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "corp", array(
				"START_FROM" => "0",
				"PATH" => "",
				"SITE_ID" => SITE_ID
				),
				false
			);?>				
		</div>
	</div>
</section>