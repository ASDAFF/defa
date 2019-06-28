<div class="list items">
	<div class="popular-block">
        <?$i=1;?>
		<?foreach($arResult['SECTIONS'] as $arSection):
			$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));?>
			<div class="popular_item item_<?=$i;?> <?=($i%5==0 || $i==1 ? "wide66" : "wide33")?> <?=($i%6==0 || $i==2 ? "height100" : "height50")?>">

                <?if($arSection["PICTURE"]["SRC"]):?>
                <?$img = CFile::ResizeImageGet($arSection["PICTURE"]["ID"], array( "width" => 120, "height" => 120 ), BX_RESIZE_IMAGE_EXACT, true );?>
				<div class="item" id="<?=$this->GetEditAreaId($arSection['ID']);?>" style="background-image: url(<?=$img["src"]?>);">
                    <div class="item-content">
                        <!--<div class="img shine">
                            <?/*if($arSection["PICTURE"]["SRC"]):*/?>
                                <?/*$img = CFile::ResizeImageGet($arSection["PICTURE"]["ID"], array( "width" => 120, "height" => 120 ), BX_RESIZE_IMAGE_EXACT, true );*/?>
                                <a href="<?/*=$arSection["SECTION_PAGE_URL"]*/?>" class="thumb"><img src="<?/*=$img["src"]*/?>" alt="<?/*=($arSection["PICTURE"]["ALT"] ? $arSection["PICTURE"]["ALT"] : $arSection["NAME"])*/?>" title="<?/*=($arSection["PICTURE"]["TITLE"] ? $arSection["PICTURE"]["TITLE"] : $arSection["NAME"])*/?>" /></a>
                            <?/*elseif($arSection["~PICTURE"]):*/?>
                                <?/*$img = CFile::ResizeImageGet($arSection["~PICTURE"], array( "width" => 120, "height" => 120 ), BX_RESIZE_IMAGE_EXACT, true );*/?>
                                <a href="<?/*=$arSection["SECTION_PAGE_URL"]*/?>" class="thumb"><img src="<?/*=$img["src"]*/?>" alt="<?/*=($arSection["PICTURE"]["ALT"] ? $arSection["PICTURE"]["ALT"] : $arSection["NAME"])*/?>" title="<?/*=($arSection["PICTURE"]["TITLE"] ? $arSection["PICTURE"]["TITLE"] : $arSection["NAME"])*/?>" /></a>
                            <?/*else:*/?>
                                <a href="<?/*=$arSection["SECTION_PAGE_URL"]*/?>" class="thumb"><img src="<?/*=SITE_TEMPLATE_PATH*/?>/images/no_photo_medium.png" alt="<?/*=$arSection["NAME"]*/?>" title="<?/*=$arSection["NAME"]*/?>" height="90" /></a>
                            <?/*endif;*/?>
                        </div>-->
                        <div class="name">
                            <a href="<?=$arSection['SECTION_PAGE_URL'];?>" class="dark_link"><?=$arSection['NAME'];?></a>
                        </div>
                    </div>

				</div>
                <?elseif($arSection["~PICTURE"]):?>

                    <?$img = CFile::ResizeImageGet($arSection["~PICTURE"], array( "width" => 120, "height" => 120 ), BX_RESIZE_IMAGE_EXACT, true );?>
                <div class="item" id="<?=$this->GetEditAreaId($arSection['ID']);?>" style="background-image: url(<?=$img["src"]?>);">
                    <div class="item-content">
                        <div class="name">
                            <a href="<?=$arSection['SECTION_PAGE_URL'];?>" class="dark_link"><?=$arSection['NAME'];?></a>
                        </div>
                    </div>
                </div>

                <?else:?>
                <div class="item" id="<?=$this->GetEditAreaId($arSection['ID']);?>" style="background-image: url(<?=SITE_TEMPLATE_PATH?>/images/no_photo_medium.png);">
                    <div class="item-content">
                        <div class="name">
                            <a href="<?=$arSection['SECTION_PAGE_URL'];?>" class="dark_link"><?=$arSection['NAME'];?></a>
                        </div>
                    </div>
                </div>
                <?endif;?>
			</div>
        <?$i++?>
		<?endforeach;?>
	</div>
</div>