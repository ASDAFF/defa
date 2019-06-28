<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?if (empty($arResult["CATEGORIES"])) return;?>
<div class="bx_searche">
	<div class="items">
		<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
			<?foreach($arCategory["ITEMS"] as $i => $arItem):?>
				<?//=$arCategory["TITLE"]?>
				<?if($category_id === "all"):?>
				<?elseif(isset($arResult["ELEMENTS"][$arItem["ITEM_ID"]])):
					$arElement = $arResult["ELEMENTS"][$arItem["ITEM_ID"]];?>
					<a class="bx_item_block<?=(!$arElement["PICTURE"] ? ' wti' : '')?>" href="<?=$arItem["URL"]?>">
						<div class="maxwidth-theme">
							<div class="bx_img_element">
								<?if(is_array($arElement["PICTURE"])):?>
									<div class="bx_image" style="background-image: url('<?=$arElement["PICTURE"]["src"]?>')"></div>
								<?endif;?>
							</div>
							<div class="bx_item_element">
								<span><?=htmlspecialchars_decode($arItem["NAME"])?></span>
							</div>
							<div style="clear:both;"></div>
						</div>
					</a>
				<?else:?>
					<?if($arItem["MODULE_ID"]):?>
						<a class="bx_item_block others_result<?=(!$arItem["PICTURE"] ? ' wti' : '')?>" href="<?=$arItem["URL"]?>">
							<div class="maxwidth-theme">
								<div class="bx_item_element">
									<span><?=htmlspecialchars_decode($arItem["NAME"])?></span>
								</div>
								<div style="clear:both;"></div>
							</div>
						</a>
					<?endif;?>
				<?endif;?>
			<?endforeach;?>
		<?endforeach;?>
	</div>
	<div class="bx_item_block all_result">
		<div class="bx_item_element">
			<a class="all_result_title btn btn-default" href="<?=$arResult["CATEGORIES"]['all']['ITEMS'][0]["URL"]?>"><?=$arResult["CATEGORIES"]['all']['ITEMS'][0]["NAME"]?></a>
		</div>
	</div>
	
</div>
<script>
$(document).ready(function(){
	$('.title-search-result .bx_searche .items').mCustomScrollbar();
});
</script>