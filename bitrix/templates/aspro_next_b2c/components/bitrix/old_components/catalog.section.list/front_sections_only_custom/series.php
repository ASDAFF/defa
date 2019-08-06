<?
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

?>





<?if($arResult['SECTIONS']):?>



    <?var_dump('series');?>

    <? $dbPros = CIBlockElement::GetList( //преимущества серий
      array(),
      array("IBLOCK_ID" => 53, "ACTIVE" => "Y"),
      array("IBLOCK_ID", "ID", "NAME", "PROPERTY_PROS_ICON")
    );



    while ($arPros = $dbPros->GetNext()) {

        $imgAdvantage = CFile::ResizeImageGet(
            $arPros['PROPERTY_PROS_ICON_VALUE'],
            array('width'=>'50', 'height'=>50),
            BX_RESIZE_IMAGE_EXACT
        );
        $arAdvantages[$arPros["ID"]] = $arPros;
        $arAdvantages[$arPros['ID']]['IMAGE'] = $imgAdvantage;

    }


    ?>






    <div class="sections_wrapper series">
        <?if($arParams["TITLE_BLOCK"] || $arParams["TITLE_BLOCK_ALL"]):?>
            <div class="top_block">
                <h3 class="title_block"><?=$arParams["TITLE_BLOCK"];?></h3>
                <a href="<?=SITE_DIR.$arParams["ALL_URL"];?>"><?=$arParams["TITLE_BLOCK_ALL"] ;?></a>
            </div>
        <?endif;?>
        <div class="list items">
            <div class="row margin0 flexbox">

                <?foreach($arResult['SECTIONS'] as $arSection):

                    $this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_EDIT"));
                    $this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arSection["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_SECTION_DELETE_CONFIRM')));?>

                        <div class="series-item" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
                            <div class="name">
                                <a href="<?=$arSection['SECTION_PAGE_URL'];?>" class="dark_link fo"><?=$arSection['NAME'];?></a>
                            </div>
                            <?if ($arParams["SHOW_SECTION_LIST_PICTURES"]!="N"):?>
                                <div class="img shine col-md-4">
                                    <?if($arSection["PICTURE"]["SRC"]):?>
                                        <?$img = CFile::ResizeImageGet($arSection["PICTURE"]["ID"], array( "width" => 438, "height" => 300 ), BX_RESIZE_IMAGE_EXACT, true );?>
                                        <a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="thumb"><img src="<?=$img["src"]?>" alt="<?=($arSection["PICTURE"]["ALT"] ? $arSection["PICTURE"]["ALT"] : $arSection["NAME"])?>" title="<?=($arSection["PICTURE"]["TITLE"] ? $arSection["PICTURE"]["TITLE"] : $arSection["NAME"])?>" /></a>
                                    <?elseif($arSection["~PICTURE"]):?>
                                        <?$img = CFile::ResizeImageGet($arSection["~PICTURE"], array( "width" => 120, "height" => 120 ), BX_RESIZE_IMAGE_EXACT, true );?>
                                        <a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="thumb"><img src="<?=$img["src"]?>" alt="<?=($arSection["PICTURE"]["ALT"] ? $arSection["PICTURE"]["ALT"] : $arSection["NAME"])?>" title="<?=($arSection["PICTURE"]["TITLE"] ? $arSection["PICTURE"]["TITLE"] : $arSection["NAME"])?>" /></a>
                                    <?else:?>
                                        <a href="<?=$arSection["SECTION_PAGE_URL"]?>" class="thumb"><img src="<?=SITE_TEMPLATE_PATH?>/images/catalog_category_noimage.png" alt="<?=$arSection["NAME"]?>" title="<?=$arSection["NAME"]?>" /></a>
                                    <?endif;?>
                                </div>
                            <?endif;?>
                            <div class="col-md-8">
                                <div class="series-item-info">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="series-item-description">
                                                <?=truncate($arSection["DESCRIPTION"],200, array('html' => true, 'ending' => '...'))?>
                                            </div>


                                            <ul class="series-item-pros">
                                                <?foreach($arSection['UF_PROS_SERIES'] as $arAdv):?>
                                                    <li>
                                                        <div class="pros-icon">
                                                            <img src="<?=($arAdvantages[$arAdv]['IMAGE']['src']);?>" alt="">
                                                        </div>
                                                        <span class="pros-text"><?=($arAdvantages[$arAdv]['NAME']);?></span>
                                                    </li>
                                                <?endforeach;?>
                                            </ul>

                                            <a href="#" class="order-testdrive">Заказать тест-драйв</a>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="series-item-color">

                                                <?
                                                // get textures
                                                $propTextures = array("PROPERTY_COLOR_REF");
                                                $dbProducts = CIBlockElement::GetList(
                                                    array(),
                                                    array("IBLOCK_ID" => 17, "ACTIVE" => "Y", "SECTION_ID" => $arSection["ID"]),
                                                    array("ID_BLOCK", "ID", "NAME", "PROPERTY_IS_SET", "PREVIEW_PICTURE")
                                                );
                                                $arIdProducts = $arProducts = $arSets = null;
                                                while ($arProduct = $dbProducts->GetNext()){
                                                	$arProducts[] = $arProduct;
                                                    $arIdProducts[] = $arProduct["ID"];
                                                }

                                                $arElements = CCatalogSKU::getOffersList($arIdProducts, array(), array("ID", "IBLOCK_ID", "PROPERTY_COLOR_REF"), array("CODE" => "PROPERTY_COLOR_REF") );
                                                $arColors = null;
                                                foreach ($arElements as $arElement ){
                                                    foreach ($arElement as $arScu) {
                                                        if(!empty($arScu["PROPERTY_COLOR_REF_VALUE"]))
                                                            $arColors[$arScu["PROPERTY_COLOR_REF_VALUE"]] = $arScu["PROPERTY_COLOR_REF_VALUE"];
                                                    }
                                                }
                                                foreach ($arProducts as $key => $arProduct){
                                                	if(!empty($arProduct["PROPERTY_IS_SET_VALUE"])){
                                                		$arSets[] = $arProduct;
														unset($arProducts[$key]);
													}
												}

                                                ?>
                                                <h3>Цветовые решения</h3>
                                                <div class="series-item-color-content">
                                                    <?if(!empty($arColors) and CModule::IncludeModule('highloadblock')) {
                                                        foreach ($arColors as $arColor) {
                                                            $hlblock = HL\HighloadBlockTable::getById(3)->fetch(); // id highload блока
                                                            $entity = HL\HighloadBlockTable::compileEntity($hlblock);
                                                            $entityClass = $entity->getDataClass();

                                                            $res = $entityClass::getList(array(
                                                                'select' => array('ID', "UF_NAME", "UF_XML_ID", "UF_FILE"),
                                                                //'order' => array('ID' => 'ASC'),
                                                                'filter' => array('UF_XML_ID' => $arColor)
                                                            ));

                                                            $rowColor = $res->fetch();

                                                            // Влад, если будешь вставлять картинкой, то можно вставить альт от сюда $rowColor['UF_NAME']; ?>
                                                            <div style="background: url(<?= CFile::GetPath($rowColor["UF_FILE"])?>)"></div>
                                                            <?
                                                        }
                                                    } else {?>
                                                    <div></div>
                                                    <?}?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="series-item-info-bottom">
                                                <h3>Популярные комплекты</h3>
                                                <div class="popular-content">
													<?if(!empty($arSets)) : foreach ($arSets as $arSet) {?>
														<a href="javascript:;">
															<img src="<?= CFile::GetPath($arSet["PREVIEW_PICTURE"])?>" alt="">
														</a>
													<?}
													else:?>
                                                    <a href="javascript:;" style="background: #e7e7e7;">
                                                        <img src="" alt="">
                                                    </a>
                                                    <a href="javascript:;" style="background: #e7e7e7;">
                                                        <img src="" alt="">
                                                    </a>
                                                    <a href="javascript:;" style="background: #e7e7e7;">
                                                        <img src="" alt="">
                                                    </a>
                                                    <a href="javascript:;" style="background: #e7e7e7;">
                                                        <img src="" alt="">
                                                    </a>
                                                    <a href="javascript:;" style="background: #e7e7e7;">
                                                        <img src="" alt="">
                                                    </a>
														<?endif;?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="series-item-info-bottom">
                                                <h3>Популярные товары</h3>
                                                <div class="popular-content products">
													<?if(!empty($arProducts)): foreach (array_slice($arProducts, 0, 4) as $arProduct) {
														if($arProduct["PREVIEW_PICTURE"]) {?>
														<a href="javascript:;">
															<img src="<?= CFile::GetPath($arProduct["PREVIEW_PICTURE"])?>" alt="">
														</a>
														<?}
													} else :?>
                                                    <a href="javascript:;" style="background: #e7e7e7;">
                                                        <img src="" alt="">
                                                    </a>
                                                    <a href="javascript:;" style="background: #e7e7e7;">
                                                        <img src="" alt="">
                                                    </a>
                                                    <a href="javascript:;" style="background: #e7e7e7;">
                                                        <img src="" alt="">
                                                    </a>
                                                    <a href="javascript:;" style="background: #e7e7e7;">
                                                        <img src="" alt="">
                                                    </a>
                                                    <a href="javascript:;" style="background: #e7e7e7;">
                                                        <img src="" alt="">
                                                    </a>
													<?endif;?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                <?endforeach;?>
            </div>
        </div>
    </div>
<?endif;?>