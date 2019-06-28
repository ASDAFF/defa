<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?$this->setFrameMode(true);?>
<?if($arResult["ITEMS"]):?>
	<?global $arTheme;
	$bHideOnNarrow = $arTheme['BIGBANNER_HIDEONNARROW']['VALUE'] === 'Y';?>

    <?if($arParams["TITLE_BLOCK"] || $arParams["TITLE_BLOCK_ALL"]):?>
        <div class="top_block">
            <h3 class="title_block"><?=$arParams["TITLE_BLOCK"];?></h3>
        </div>
    <?endif;?>
	<div class="top_slider_wrapp maxwidth-banner<?=($bHideOnNarrow ? ' hidden_narrow' : '')?>">

		<div class="slider-container">
			<div class="slides">
				<?foreach($arResult["ITEMS"] as $arItem):?>
                <div class="slides-item">
                    <div class="slides-item-img">
                        <?if($arItem["PREVIEW_PICTURE"]):?>
                            <?if(!empty($arItem["PROPERTIES"]["URL_STRING"]["VALUE"])):?>
                            <a href="<?=$arItem["PROPERTIES"]["URL_STRING"]["VALUE"]?>" <?=(strlen($target) ? 'target="'.$target.'"' : '')?>>
                                <?endif;?>
                                <img class="plaxy" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=($arItem['PREVIEW_PICTURE']['ALT'] ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($arItem['PREVIEW_PICTURE']['TITLE'] ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" />
                                <?if(!empty($arItem["PROPERTIES"]["URL_STRING"]["VALUE"])):?>
                            </a>
                        <?endif;?>
                        <?endif;?>
                    </div>
                    <div class="slides-item-text">
                        <a href="<?=$arItem["PROPERTIES"]["URL_STRING"]["VALUE"]?>"><?= $arItem['NAME']?></a>
						<?if($arItem["PREVIEW_TEXT"]):?>
						<div class="banner_text"><?=$arItem["PREVIEW_TEXT"];?></div>
						<?endif;?>
						<?/*<p>Предлагаем вашему вниманию самых ярких...</p>*/?>
						<?if((!empty($arItem["PROPERTIES"]["BUTTON2TEXT"]["VALUE"]) && !empty($arItem["PROPERTIES"]["BUTTON2LINK"]["VALUE"])) || (!empty($arItem["PROPERTIES"]["BUTTON1TEXT"]["VALUE"]) && !empty($arItem["PROPERTIES"]["BUTTON1LINK"]["VALUE"]))):?>
							<div class="slides-item-link">
								<?if(trim($arItem["PROPERTIES"]["BUTTON1TEXT"]["VALUE"]) && trim($arItem["PROPERTIES"]["BUTTON1LINK"]["VALUE"])):?>
									<a href="<?=$arItem["PROPERTIES"]["BUTTON1LINK"]["VALUE"]?>" class="<?=!empty($arItem["PROPERTIES"]["BUTTON1CLASS"]["VALUE"]) ? $arItem["PROPERTIES"]["BUTTON1CLASS"]["VALUE"] : "btn btn-default btn-lg"?>" <?=(strlen($target) ? 'target="'.$target.'"' : '')?>>
										<?=$arItem["PROPERTIES"]["BUTTON1TEXT"]["VALUE"]?>
									</a>
								<?endif;?>
								<?if(!empty($arItem["PROPERTIES"]["BUTTON2TEXT"]["VALUE"]) && !empty($arItem["PROPERTIES"]["BUTTON2LINK"]["VALUE"])):?>
									<a href="<?=$arItem["PROPERTIES"]["BUTTON2LINK"]["VALUE"]?>" class="<?=!empty( $arItem["PROPERTIES"]["BUTTON2CLASS"]["VALUE"]) ? $arItem["PROPERTIES"]["BUTTON2CLASS"]["VALUE"] : "btn btn-default btn-lg btn-info"?>" <?=(strlen($target) ? 'target="'.$target.'"' : '')?>>
										<?=$arItem["PROPERTIES"]["BUTTON2TEXT"]["VALUE"]?>
									</a>
								<?endif;?>
							</div>
						<?endif;?>
						<?/*<div class="slides-item-link">
                            <p>12 товаров</p>
                            <a href=""></a>
						</div>*/?>
                    </div>
                </div>
				<?endforeach;?>

				<?/*foreach($arResult["ITEMS"] as $arItem):?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					$background = is_array($arItem["DETAIL_PICTURE"]) ? $arItem["DETAIL_PICTURE"]["SRC"] : $this->GetFolder()."/images/background.jpg";
					$target = $arItem["PROPERTIES"]["TARGETS"]["VALUE_XML_ID"];
					?>
					<li class="box<?=($arItem["PROPERTIES"]["TEXTCOLOR"]["VALUE_XML_ID"] ? " ".$arItem["PROPERTIES"]["TEXTCOLOR"]["VALUE_XML_ID"] : "");?><?=($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] ? " ".$arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] : " left");?>" data-nav_color="<?=($arItem["PROPERTIES"]["NAV_COLOR"]["VALUE_XML_ID"] ? $arItem["PROPERTIES"]["NAV_COLOR"]["VALUE_XML_ID"] : "");?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>" style="background-image: url('<?=$background?>') !important;">
						<?if($arItem["PROPERTIES"]["URL_STRING"]["VALUE"]):?>
							<a class="target" href="<?=$arItem["PROPERTIES"]["URL_STRING"]["VALUE"]?>" <?=(strlen($target) ? 'target="'.$target.'"' : '')?>></a>
						<?endif;?>
						<div class="wrapper_inner">	
							<?
							$position = "0% 100%";
							if($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"])
							{
								if($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] == "left")
									$position = "100% 100%";
								elseif($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] == "right")
									$position = "0% 100%";
								else
									$position = "center center";									
							}
							?>
							<table class="table-no-border">
								<tbody><tr>
									<?if($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] != "image"):?>
										<?ob_start();?>
											<td class="text <?=$arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"];?>">
												<?if($arItem["NAME"]):?>
													<div class="banner_title">
														<span>
															<?if($arItem["PROPERTIES"]["URL_STRING"]["VALUE"]):?>
																<a href="<?=$arItem["PROPERTIES"]["URL_STRING"]["VALUE"]?>" <?=(strlen($target) ? 'target="'.$target.'"' : '')?>>
															<?endif;?>
															<?=strip_tags($arItem["~NAME"], "<br><br/>");?>
															<?if($arItem["PROPERTIES"]["URL_STRING"]["VALUE"]):?>
																</a>
															<?endif;?>
														</span>
													</div>
												<?endif;?>
												<?if($arItem["PREVIEW_TEXT"]):?>
													<div class="banner_text"><?=$arItem["PREVIEW_TEXT"];?></div>
												<?endif;?>
												<?if((!empty($arItem["PROPERTIES"]["BUTTON2TEXT"]["VALUE"]) && !empty($arItem["PROPERTIES"]["BUTTON2LINK"]["VALUE"])) || (!empty($arItem["PROPERTIES"]["BUTTON1TEXT"]["VALUE"]) && !empty($arItem["PROPERTIES"]["BUTTON1LINK"]["VALUE"]))):?>
													<div class="banner_buttons">
														<?if(trim($arItem["PROPERTIES"]["BUTTON1TEXT"]["VALUE"]) && trim($arItem["PROPERTIES"]["BUTTON1LINK"]["VALUE"])):?>
															<a href="<?=$arItem["PROPERTIES"]["BUTTON1LINK"]["VALUE"]?>" class="<?=!empty($arItem["PROPERTIES"]["BUTTON1CLASS"]["VALUE"]) ? $arItem["PROPERTIES"]["BUTTON1CLASS"]["VALUE"] : "btn btn-default btn-lg"?>" <?=(strlen($target) ? 'target="'.$target.'"' : '')?>>
																<?=$arItem["PROPERTIES"]["BUTTON1TEXT"]["VALUE"]?>
															</a>
														<?endif;?>
														<?if(!empty($arItem["PROPERTIES"]["BUTTON2TEXT"]["VALUE"]) && !empty($arItem["PROPERTIES"]["BUTTON2LINK"]["VALUE"])):?>
															<a href="<?=$arItem["PROPERTIES"]["BUTTON2LINK"]["VALUE"]?>" class="<?=!empty( $arItem["PROPERTIES"]["BUTTON2CLASS"]["VALUE"]) ? $arItem["PROPERTIES"]["BUTTON2CLASS"]["VALUE"] : "btn btn-default btn-lg btn-info"?>" <?=(strlen($target) ? 'target="'.$target.'"' : '')?>>
																<?=$arItem["PROPERTIES"]["BUTTON2TEXT"]["VALUE"]?>
															</a>
														<?endif;?>
													</div>
												<?endif;?>
											</td>
										<?$text = ob_get_clean();?>
									<?endif;?>
									<?ob_start();?>
										<td class="img" >
											<?if($arItem["PREVIEW_PICTURE"]):?>
												<?if(!empty($arItem["PROPERTIES"]["URL_STRING"]["VALUE"])):?>
													<a href="<?=$arItem["PROPERTIES"]["URL_STRING"]["VALUE"]?>" <?=(strlen($target) ? 'target="'.$target.'"' : '')?>>
												<?endif;?>
												<img class="plaxy" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=($arItem['PREVIEW_PICTURE']['ALT'] ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($arItem['PREVIEW_PICTURE']['TITLE'] ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" />
												<?if(!empty($arItem["PROPERTIES"]["URL_STRING"]["VALUE"])):?>
													</a>
												<?endif;?>
											<?endif;?>
										</td>
									<?$image = ob_get_clean();?>
									<?
									if($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"]){
										if($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] == "left"){
											echo $text.$image;
										}
										elseif($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] == "right"){
											echo $image.$text;
										}
										elseif($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] == "center"){
											echo $text;
										}
										elseif($arItem["PROPERTIES"]["TEXT_POSITION"]["VALUE_XML_ID"] == "image"){
											echo $image;
										}
									}
									else{
										echo $text.$image;
									}
									?>
								</tr></tbody>
							</table>
						</div>
					</li>
				<?endforeach;*/?>
			</div>
		</div>
	</div>
<?endif;?>