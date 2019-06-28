<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="wd_propsorter">
	<?if(!empty($arResult['PROPS_GROUPS'])):?>
		<table>
			<tbody>
				<?$bFirstGroupPassed=false;?>
				<?foreach($arResult['PROPS_GROUPS'] as $arGroup):?>
					<?if($bFirstGroupPassed):?>
						<tr class="row_empty"><td colspan="2"></td></tr>
					<?endif?>
					<?if(strlen($arGroup['NAME'])):?>
						<tr class="row_header"><td colspan="2"><span><?=$arGroup['NAME'];?></span></td></tr>
					<?endif?>
					<?foreach($arGroup['ITEMS'] as $PropIndex => $arProp):?>
						<tr>
							<td class="cell_name"><span><?=$arProp['NAME']?></span></td>
							<td class="cell_value"><span><?=$arProp['DISPLAY_VALUE']?></span></td>
						</tr>
					<?endforeach?>
					<?$bFirstGroupPassed=true;?>
				<?endforeach?>
			</tbody>
		</table>
	<?elseif($arParams['WARNING_IF_EMPTY']=='Y' && strlen($arParams['WARNING_IF_EMPTY_TEXT'])):?>
		<div class="noprops"><?=$arParams['WARNING_IF_EMPTY_TEXT'];?></div>
	<?endif?>
</div>
