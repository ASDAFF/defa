<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<div class="page-top-wrapper grey">
	<section class="page-top title_v2 maxwidth-theme <?CPriority::ShowPageProps('TITLE_CLASS');?>">	
		<div class="row">
			<div class="col-md-12">
				<?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "corp", array(
					"START_FROM" => "0",
					"PATH" => "",
					"SITE_ID" => SITE_ID
					),
					false
				);?>
				<div class="page-top-main"><h1 id="pagetitle"><?$APPLICATION->ShowTitle(false)?></h1></div>
			</div>
		</div>
	</section>
</div>