<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="delivery">
	<table class="table_delivery">

	<?if (	strlen($arResult["PROPERTIES"]["DELIVERY_DELIVERY_COST_CITY"]["VALUE"][0]) > 0 &&
			strlen($arResult["PROPERTIES"]["DELIVERY_DELIVERY_COST_REGION"]["VALUE"][0]) > 0 &&
			strlen($arResult["PROPERTIES"]["DELIVERY_DELIVERY_COST_CITY"]["VALUE"][1]) > 0 &&
			strlen($arResult["PROPERTIES"]["DELIVERY_DELIVERY_COST_REGION"]["VALUE"][1]) > 0) {?>
	<tr class="caption">
		<td class="border first main_caption"><?=GetMessage("DELIVERY_CAPTION_DELIVERY_AND_SERVICES")?>
		<td class="w85 tborder">
		<td class="border main_caption m36 w400"><?=strtoupper($arResult["NAME"])?>
		<td class="border main_caption m36 w400"><?=GetMessage("DELIVERY_CAPTION_REGION")?>
	
	<tr>
		<td rowspan="2" class="border bordered_grad first caption red"><?=GetMessage("DELIVERY_CAPTION_DELIVERY_COST")?>
		<td class="w85 grayed"><?=GetMessage("DELIVERY_CAPTION_ESHOP")?>
		<td class="border bordered w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_DELIVERY_COST_CITY"]["VALUE"][0])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_DELIVERY_COST_CITY"]["DESCRIPTION"][0])?></span>
		<td class="border bordered_gradi w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_DELIVERY_COST_REGION"]["VALUE"][0])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_DELIVERY_COST_REGION"]["DESCRIPTION"][0])?></span>
	<tr>
		<td class="w85 grayed"><?=GetMessage("DELIVERY_CAPTION_SALON")?>
		<td class="border bordered w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_DELIVERY_COST_CITY"]["VALUE"][1])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_DELIVERY_COST_CITY"]["DESCRIPTION"][1])?></span>
		<td class="border bordered_gradi w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_DELIVERY_COST_REGION"]["VALUE"][1])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_DELIVERY_COST_REGION"]["DESCRIPTION"][1])?></span>
	<?} else if (	strlen($arResult["PROPERTIES"]["DELIVERY_DELIVERY_COST_CITY"]["VALUE"][0]) > 0 &&
					strlen($arResult["PROPERTIES"]["DELIVERY_DELIVERY_COST_CITY"]["VALUE"][1]) > 0) {?>
	<tr class="caption">
		<td class="border first main_caption"><?=GetMessage("DELIVERY_CAPTION_DELIVERY_AND_SERVICES")?>
		<td class="w85 tborder">
		<td class="border main_caption m36 w400"><?=strtoupper($arResult["NAME"])?>
		<td class="border main_caption m36 w400"><?=GetMessage("DELIVERY_CAPTION_REGION")?>
	
	<tr>
		<td rowspan="2" class="border bordered_grad first caption red"><?=GetMessage("DELIVERY_CAPTION_DELIVERY_COST")?>
		<td class="w85 grayed"><?=GetMessage("DELIVERY_CAPTION_ESHOP")?>
		<td colspan="2" class="border bordered_gradi w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_DELIVERY_COST_CITY"]["VALUE"][0])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_DELIVERY_COST_CITY"]["DESCRIPTION"][0])?>
	<tr>
		<td class="w85 grayed"><?=GetMessage("DELIVERY_CAPTION_SALON")?>
		<td colspan="2" class="border bordered_gradi w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_DELIVERY_COST_CITY"]["VALUE"][1])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_DELIVERY_COST_CITY"]["DESCRIPTION"][1])?>
	<?} else if (	strlen($arResult["PROPERTIES"]["DELIVERY_DELIVERY_COST_CITY"]["VALUE"][0]) > 0 &&
					strlen($arResult["PROPERTIES"]["DELIVERY_DELIVERY_COST_REGION"]["VALUE"][0]) > 0) {?>
	<tr class="caption">
		<td class="border first main_caption"><?=GetMessage("DELIVERY_CAPTION_DELIVERY_AND_SERVICES")?>
		<td class="w85 tborder" style="border-bottom: 1px solid #dcdcdc;">
		<td class="border main_caption m36 w400"><?=strtoupper($arResult["NAME"])?>
		<td class="border main_caption m36 w400"><?=GetMessage("DELIVERY_CAPTION_REGION")?>
	
	<tr>
		<td colspan="2" class="border bordered_grad first caption red"><?=GetMessage("DELIVERY_CAPTION_DELIVERY_COST")?>
		<td class="border bordered w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_DELIVERY_COST_CITY"]["VALUE"][0])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_DELIVERY_COST_CITY"]["DESCRIPTION"][0])?>
		<td class="border bordered_gradi w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_DELIVERY_COST_REGION"]["VALUE"][0])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_DELIVERY_COST_REGION"]["DESCRIPTION"][0])?>
	<?} else if ( strlen($arResult["PROPERTIES"]["DELIVERY_DELIVERY_COST_CITY"]["VALUE"][0]) > 0) {?>
	<tr class="caption">
		<td class="border first main_caption"><?=GetMessage("DELIVERY_CAPTION_DELIVERY_AND_SERVICES")?>
		<td class="w85 tborder" style="border-bottom: 1px solid #dcdcdc;">
		<td class="border main_caption m36 w400"><?=strtoupper($arResult["NAME"])?>
		<td class="border main_caption m36 w400"><?=GetMessage("DELIVERY_CAPTION_REGION")?>
	
	<tr>
		<td colspan="2" class="border bordered_grad first caption red"><?=GetMessage("DELIVERY_CAPTION_DELIVERY_COST")?>
		<td colspan="2" class="border bordered_gradi w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_DELIVERY_COST_CITY"]["VALUE"][0])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_DELIVERY_COST_CITY"]["DESCRIPTION"][0])?>
	<?}?>

	
	<?if (	strlen($arResult["PROPERTIES"]["DELIVERY_ASSEMBLING_CITY"]["VALUE"][0]) > 0 &&
			strlen($arResult["PROPERTIES"]["DELIVERY_ASSEMBLING_REGION"]["VALUE"][0]) > 0 &&
			strlen($arResult["PROPERTIES"]["DELIVERY_ASSEMBLING_CITY"]["VALUE"][1]) > 0 &&
			strlen($arResult["PROPERTIES"]["DELIVERY_ASSEMBLING_REGION"]["VALUE"][1]) > 0) {?>
	<tr>
		<td rowspan="2" class="border bordered_grad first caption red"><?=GetMessage("DELIVERY_CAPTION_ASSEMBLING")?>
		<td class="w85 grayed"><?=GetMessage("DELIVERY_CAPTION_ESHOP")?>
		<td class="border bordered w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_ASSEMBLING_CITY"]["VALUE"][0])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_ASSEMBLING_CITY"]["DESCRIPTION"][0])?>
		<td class="border bordered_gradi w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_ASSEMBLING_REGION"]["VALUE"][0])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_ASSEMBLING_REGION"]["DESCRIPTION"][0])?>
	<tr>
		<td class="w85 grayed"><?=GetMessage("DELIVERY_CAPTION_SALON")?>
		<td class="border bordered w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_ASSEMBLING_CITY"]["VALUE"][1])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_ASSEMBLING_CITY"]["DESCRIPTION"][1])?>
		<td class="border bordered_gradi w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_ASSEMBLING_REGION"]["VALUE"][1])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_ASSEMBLING_REGION"]["DESCRIPTION"][1])?>
	<?} else if (	strlen($arResult["PROPERTIES"]["DELIVERY_ASSEMBLING_CITY"]["VALUE"][0]) > 0 &&
					strlen($arResult["PROPERTIES"]["DELIVERY_ASSEMBLING_CITY"]["VALUE"][1]) > 0) {?>
	<tr>
		<td rowspan="2" class="border bordered_grad first caption red"><?=GetMessage("DELIVERY_CAPTION_ASSEMBLING")?>
		<td class="w85 grayed"><?=GetMessage("DELIVERY_CAPTION_ESHOP")?>
		<td colspan="2" class="border bordered_gradi w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_ASSEMBLING_CITY"]["VALUE"][0])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_ASSEMBLING_CITY"]["DESCRIPTION"][0])?>
	<tr>
		<td class="w85 grayed"><?=GetMessage("DELIVERY_CAPTION_SALON")?>
		<td colspan="2" class="border bordered_gradi w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_ASSEMBLING_CITY"]["VALUE"][1])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_ASSEMBLING_CITY"]["DESCRIPTION"][1])?>
	<?} else if (	strlen($arResult["PROPERTIES"]["DELIVERY_ASSEMBLING_CITY"]["VALUE"][0]) > 0 &&
					strlen($arResult["PROPERTIES"]["DELIVERY_ASSEMBLING_REGION"]["VALUE"][0]) > 0) {?>
	<tr>
		<td colspan="2" class="border bordered_grad first caption red"><?=GetMessage("DELIVERY_CAPTION_ASSEMBLING")?>
		<td class="border bordered w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_ASSEMBLING_CITY"]["VALUE"][0])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_ASSEMBLING_CITY"]["DESCRIPTION"][0])?>
		<td class="border bordered_gradi w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_ASSEMBLING_REGION"]["VALUE"][0])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_ASSEMBLING_REGION"]["DESCRIPTION"][0])?>
	<?} else if ( strlen($arResult["PROPERTIES"]["DELIVERY_ASSEMBLING_CITY"]["VALUE"][0]) > 0) {?>
	<tr>
		<td colspan="2" class="border bordered_grad first caption red"><?=GetMessage("DELIVERY_CAPTION_ASSEMBLING")?>
		<td colspan="2" class="border bordered_gradi w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_ASSEMBLING_CITY"]["VALUE"][0])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_ASSEMBLING_CITY"]["DESCRIPTION"][0])?>
	<?}?>

	
	
	<?if (	strlen($arResult["PROPERTIES"]["DELIVERY_GARBAGE_REMOVAL_CITY"]["VALUE"][0]) > 0 &&
			strlen($arResult["PROPERTIES"]["DELIVERY_GARBAGE_REMOVAL_REGION"]["VALUE"][0]) > 0 &&
			strlen($arResult["PROPERTIES"]["DELIVERY_GARBAGE_REMOVAL_CITY"]["VALUE"][1]) > 0 &&
			strlen($arResult["PROPERTIES"]["DELIVERY_GARBAGE_REMOVAL_REGION"]["VALUE"][1]) > 0) {?>
	<tr>
		<td rowspan="2" class="border bordered_grad first caption red"><?=GetMessage("DELIVERY_CAPTION_GARBAGE_REMOVAL")?>
		<td class="w85 grayed"><?=GetMessage("DELIVERY_CAPTION_ESHOP")?>
		<td class="border bordered w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_GARBAGE_REMOVAL_CITY"]["VALUE"][0])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_GARBAGE_REMOVAL_CITY"]["DESCRIPTION"][0])?>
		<td class="border bordered_gradi w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_GARBAGE_REMOVAL_REGION"]["VALUE"][0])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_GARBAGE_REMOVAL_REGION"]["DESCRIPTION"][0])?>
	<tr>
		<td class="w85 grayed"><?=GetMessage("DELIVERY_CAPTION_SALON")?>
		<td class="border bordered w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_GARBAGE_REMOVAL_CITY"]["VALUE"][1])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_GARBAGE_REMOVAL_CITY"]["DESCRIPTION"][1])?>
		<td class="border bordered_gradi w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_GARBAGE_REMOVAL_REGION"]["VALUE"][1])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_GARBAGE_REMOVAL_REGION"]["DESCRIPTION"][1])?>
	<?} else if (	strlen($arResult["PROPERTIES"]["DELIVERY_GARBAGE_REMOVAL_CITY"]["VALUE"][0]) > 0 &&
					strlen($arResult["PROPERTIES"]["DELIVERY_GARBAGE_REMOVAL_CITY"]["VALUE"][1]) > 0) {?>
	<tr>
		<td rowspan="2" class="border bordered_grad first caption red"><?=GetMessage("DELIVERY_CAPTION_GARBAGE_REMOVAL")?>
		<td class="w85 grayed"><?=GetMessage("DELIVERY_CAPTION_ESHOP")?>
		<td colspan="2" class="border bordered_gradi w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_GARBAGE_REMOVAL_CITY"]["VALUE"][0])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_GARBAGE_REMOVAL_CITY"]["DESCRIPTION"][0])?>
	<tr>
		<td class="w85 grayed"><?=GetMessage("DELIVERY_CAPTION_SALON")?>
		<td colspan="2" class="border bordered_gradi w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_GARBAGE_REMOVAL_CITY"]["VALUE"][1])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_GARBAGE_REMOVAL_CITY"]["DESCRIPTION"][1])?>
	<?} else if (	strlen($arResult["PROPERTIES"]["DELIVERY_GARBAGE_REMOVAL_CITY"]["VALUE"][0]) > 0 &&
					strlen($arResult["PROPERTIES"]["DELIVERY_GARBAGE_REMOVAL_REGION"]["VALUE"][0]) > 0) {?>
	<tr>
		<td colspan="2" class="border bordered_grad first caption red"><?=GetMessage("DELIVERY_CAPTION_GARBAGE_REMOVAL")?>
		<td class="border bordered w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_GARBAGE_REMOVAL_CITY"]["VALUE"][0])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_GARBAGE_REMOVAL_CITY"]["DESCRIPTION"][0])?>
		<td class="border bordered_gradi w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_GARBAGE_REMOVAL_REGION"]["VALUE"][0])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_GARBAGE_REMOVAL_REGION"]["DESCRIPTION"][0])?>
	<?} else if ( strlen($arResult["PROPERTIES"]["DELIVERY_GARBAGE_REMOVAL_CITY"]["VALUE"][0]) > 0) {?>
	<tr>
		<td colspan="2" class="border bordered_grad first caption red"><?=GetMessage("DELIVERY_CAPTION_GARBAGE_REMOVAL")?>
		<td colspan="2" class="border bordered_gradi w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_GARBAGE_REMOVAL_CITY"]["VALUE"][0])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_GARBAGE_REMOVAL_CITY"]["DESCRIPTION"][0])?>
	<?}?>
	
	

	<?if (	strlen($arResult["PROPERTIES"]["DELIVERY_FLOORING_CITY"]["VALUE"][0]) > 0 &&
			strlen($arResult["PROPERTIES"]["DELIVERY_FLOORING_REGION"]["VALUE"][0]) > 0 &&
			strlen($arResult["PROPERTIES"]["DELIVERY_FLOORING_CITY"]["VALUE"][1]) > 0 &&
			strlen($arResult["PROPERTIES"]["DELIVERY_FLOORING_REGION"]["VALUE"][1]) > 0) {?>
	<tr>
		<td rowspan="2" class="border bordered_grad first caption red"><?=GetMessage("DELIVERY_CAPTION_FLOORING")?>
		<td class="w85 grayed"><?=GetMessage("DELIVERY_CAPTION_ESHOP")?>
		<td class="border bordered w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_FLOORING_CITY"]["VALUE"][0])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_FLOORING_CITY"]["DESCRIPTION"][0])?>
		<td class="border bordered_gradi w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_FLOORING_REGION"]["VALUE"][0])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_FLOORING_REGION"]["DESCRIPTION"][0])?>
	<tr>
		<td class="w85 grayed"><?=GetMessage("DELIVERY_CAPTION_SALON")?>
		<td class="border bordered w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_FLOORING_CITY"]["VALUE"][1])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_FLOORING_CITY"]["DESCRIPTION"][1])?>
		<td class="border bordered_gradi w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_FLOORING_REGION"]["VALUE"][1])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_FLOORING_REGION"]["DESCRIPTION"][1])?>
	<?} else if (	strlen($arResult["PROPERTIES"]["DELIVERY_FLOORING_CITY"]["VALUE"][0]) > 0 &&
					strlen($arResult["PROPERTIES"]["DELIVERY_FLOORING_CITY"]["VALUE"][1]) > 0) {?>
	<tr>
		<td rowspan="2" class="border bordered_grad first caption red"><?=GetMessage("DELIVERY_CAPTION_FLOORING")?>
		<td class="w85 grayed"><?=GetMessage("DELIVERY_CAPTION_ESHOP")?>
		<td colspan="2" class="border bordered_gradi w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_FLOORING_CITY"]["VALUE"][0])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_FLOORING_CITY"]["DESCRIPTION"][0])?>
	<tr>
		<td class="w85 grayed"><?=GetMessage("DELIVERY_CAPTION_SALON")?>
		<td colspan="2" class="border bordered_gradi w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_FLOORING_CITY"]["VALUE"][1])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_FLOORING_CITY"]["DESCRIPTION"][1])?>
	<?} else if ( strlen($arResult["PROPERTIES"]["DELIVERY_FLOORING_CITY"]["VALUE"][0]) > 0) {?>
	<tr>
		<td colspan="2" class="border bordered_grad first caption red"><?=GetMessage("DELIVERY_CAPTION_FLOORING")?>
		<td colspan="2" class="border bordered_gradi w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_FLOORING_CITY"]["VALUE"][0])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_FLOORING_CITY"]["DESCRIPTION"][0])?>
	<?}?>


	<tr>
		<td colspan="2" class="border bordered_grad first caption red"><?=GetMessage("DELIVERY_CAPTION_ESTIMATED_DELIVERY_TIME")?>
		<td colspan="2" class="border bordered_gradi w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_ESTIMATED_TIME_CITY"]["VALUE"][0])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_ESTIMATED_TIME_CITY"]["DESCRIPTION"][0])?>
			
	<tr>
		<td colspan="2" class="border bordered_grads first caption red"><?=GetMessage("DELIVERY_CAPTION_DELIVERY_MODE")?>
		<td colspan="2" class="border bordered_gradi w400">
			<?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_MODE_CITY"]["VALUE"][0])?>
			<span class="description"><?=htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_MODE_CITY"]["DESCRIPTION"][0])?>
			
	</table>
	
	
	<div class="pickup_line">
		<span class="caption red first"><?=GetMessage("DELIVERY_CAPTION_PICKUP")?></span>
		<p><?=GetMessage("DELIVERY_DESC_PICKUP_PLACE", Array(
			"#PICKUP_PLACE#" => htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_PICKUP"]["VALUE"]),
			"#WORKING_MODE#" => htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_PICKUP"]["DESCRIPTION"]),
		))?></p>
	</div>

	<?php
	if (strlen($arResult['PROPERTIES']['DELIVERY_24_HOURS']['VALUE']['TEXT']) > 0) {
		?>
		
		<div class="pickup_line">
			<span class="caption red first"><?= GetMessage('DELIVERY_CAPTION_DELIVERY_24_HOURS'); ?></span>
			<p><?= htmlspecialchars_decode($arResult['PROPERTIES']['DELIVERY_24_HOURS']['VALUE']['TEXT']); ?></p>
		</div>
		
		<?php
	}
	?>
	
	<?$docs = $arResult["PROPERTIES"]["DELIVERY_DOCUMENTS"];
	if ( count($docs["VALUE"]) > 0 && strlen($docs["VALUE"][0]) > 0) {?>
	<div class="documents_line">
		<span class="caption red first"><?=GetMessage("DELIVERY_CAPTION_DOCUMENTS")?></span>
		<table>
		<?for ( $i = 0; $i < count($docs["VALUE"]) && strlen($docs["VALUE"][$i]) > 0; ++$i) {?>
			<tr><td class="caption"><?=$docs["VALUE"][$i]?><td class="caption red"><?=GetMessage("DELIVERY_DOC_HREF", Array("#HREF#" => $docs["DESCRIPTION"][$i]))?>
		<?}?>
		</table>
	</div>
	<?}?>

	<?if(!empty($arResult["PROPERTIES"]["DELIVERY_REQUISITES"]["VALUE"])) :?>
		<div class="pickup_line">
			<span class="caption red first"><?=GetMessage("DELIVERY_CAPTION_REQUISITES")?></span>
			<p><?= htmlspecialchars_decode($arResult["PROPERTIES"]["DELIVERY_REQUISITES"]["VALUE"])?></p>
		</div>
	<?endif;?>

</div>
