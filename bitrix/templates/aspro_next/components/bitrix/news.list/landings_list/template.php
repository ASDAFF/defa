<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>

<?if($arResult['ITEMS']):?>
	<?$i = 0;?>
	<div class="items landings_list">
		<?if($arParams["TITLE_BLOCK"]):?>
			<div class="title_block"><?=$arParams["TITLE_BLOCK"];?></div>
		<?endif;?>
		<div class="wrap">
			<ul class="clearfix">
				<?$compare_field = (isset($arParams["COMPARE_FIELD"]) && $arParams["COMPARE_FIELD"] ? $arParams["COMPARE_FIELD"] : "DETAIL_PAGE_URL");
				$bProp = (isset($arParams["COMPARE_PROP"]) && $arParams["COMPARE_PROP"] == "Y");?>
				<?foreach($arResult['ITEMS'] as $arItem):?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

					++$i;
					$bHidden = ($i > $arParams["SHOW_COUNT"] && $arParams["SHOW_COUNT"] > 1 ? true : false);
					$url = $arItem[$compare_field];
					if($bProp)
						$url = $arItem["PROPERTIES"][$compare_field]["VALUE"];
					// echo $url;
					?>
					<li class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<div>
							<?if(strlen($url)):?>
								<a class="<?=(strpos($APPLICATION->GetCurDir(), $url) !== false ? 'active' : '')?>" href="<?=$url?>" ><?=$arItem['NAME']?></a>
							<?else:?>
								<span><?=$arItem['NAME']?></span>
							<?endif?>
						</div>
					</li>
					<?if($bHidden && !$bHiddenOK):?>
						<?
						$bHiddenOK = true;
						?>
						</ul>
						<ul class="hidden_items clearfix">
					<?endif?>
				<?endforeach?>
			</ul>
			<?if($bHidden):?>
				<div class="more"><span data-opened="N" data-text="<?=GetMessage("HIDE");?>"><?=GetMessage("SHOW_ALL");?></span></div>
			<?endif?>
		</div>
	</div>
<?endif?>