<div class="list items">
	<div class="row margin0 flexbox">
		<?foreach($arResult['SECTIONS'] as $arSection):
			$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
			<div class="col-m-20 col-md-3 col-sm-4 col-xs-6">
				<div class="item" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
					<div class="img shine">
						<?if($arSection["PICTURE"]["SRC"]):?>
							<?$img = CFile::ResizeImageGet($arSection["PICTURE"]["ID"], array( "width" => 120, "height" => 120 ), BX_RESIZE_IMAGE_EXACT, true );?>
							<a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="thumb"><img src="<?=$img["src"]?>" alt="<?=($arSection["PICTURE"]["ALT"] ? $arSection["PICTURE"]["ALT"] : $arSection["NAME"])?>" title="<?=($arSection["PICTURE"]["TITLE"] ? $arSection["PICTURE"]["TITLE"] : $arSection["NAME"])?>" /></a>
						<?elseif($arSection["~PICTURE"]):?>
							<?$img = CFile::ResizeImageGet($arSection["~PICTURE"], array( "width" => 120, "height" => 120 ), BX_RESIZE_IMAGE_EXACT, true );?>
							<a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="thumb"><img src="<?=$img["src"]?>" alt="<?=($arSection["PICTURE"]["ALT"] ? $arSection["PICTURE"]["ALT"] : $arSection["NAME"])?>" title="<?=($arSection["PICTURE"]["TITLE"] ? $arSection["PICTURE"]["TITLE"] : $arSection["NAME"])?>" /></a>
						<?else:?>
							<a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="thumb"><img src="<?=SITE_TEMPLATE_PATH?>/images/no_photo_medium.png" alt="<?=$arSection["NAME"]?>" title="<?=$arSection["NAME"]?>" height="90" /></a>
						<?endif;?>
					</div>
					<div class="name">
						<a href="<?=$arSection['SECTION_PAGE_URL'];?>" class="dark_link"><?=$arSection['NAME'];?></a>
					</div>
				</div>
			</div>
		<?endforeach;?>
	</div>
</div>