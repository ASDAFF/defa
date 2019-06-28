<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<?
$bRating = (in_array('RATING', $arParams['PROPERTY_CODE']) ? true : false);
?>

<div class="item-views reviews_items">
	<?// top pagination?>
	<?if($arParams['DISPLAY_TOP_PAGER']):?>
		<div class="pagination_nav">
			<?=$arResult['NAV_STRING']?>
		</div>
	<?endif;?>
	
	<?if($arResult['SECTIONS']):?>
		<div class="group-content">
			<?// group elements by sections?>
			<?foreach($arResult['SECTIONS'] as $si => $arSection):?>
				<?if($arParams['SHOW_SECTION_PREVIEW_DESCRIPTION'] == 'Y'):?>
					<?// section name?>
					<?if(strlen($arSection['NAME'])):?>
						<h3><?=$arSection['NAME']?></h3>
					<?endif;?>

					<?// section description text/html?>
					<?if(strlen($arSection['DESCRIPTION'])):?>
						<div class="text_before_items">
							<?=$arSection['DESCRIPTION']?>
						</div>
					<?endif;?>
				<?endif;?>

				<?// show section items?>
				<div class="row sid-<?=$arSection['ID']?> items">
					<?foreach($arSection['ITEMS'] as $i => $arItem):?>
						<?
						// edit/add/delete buttons for edit mode
						$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
						$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
						// post
						$name = (isset($arItem['DISPLAY_PROPERTIES']['NAME']) && strlen($arItem['DISPLAY_PROPERTIES']['NAME']['VALUE']) ? $arItem['DISPLAY_PROPERTIES']['NAME']['VALUE'] : '');
						$post = (isset($arItem['DISPLAY_PROPERTIES']['POST']) && strlen($arItem['DISPLAY_PROPERTIES']['POST']['VALUE']) ? $arItem['DISPLAY_PROPERTIES']['POST']['VALUE'] : '');
						$review = (isset($arItem['DISPLAY_PROPERTIES']['MESSAGE']) && strlen($arItem['DISPLAY_PROPERTIES']['MESSAGE']['VALUE']['TEXT']) ? $arItem['DISPLAY_PROPERTIES']['MESSAGE']['~VALUE']['TEXT'] : '');
						$answer = (isset($arItem['FIELDS']['DETAIL_TEXT']) && strlen($arItem['FIELDS']['DETAIL_TEXT']) ? $arItem['FIELDS']['DETAIL_TEXT'] : '');
						$arVideo = (isset($arItem['DISPLAY_PROPERTIES']['VIDEO']) && is_array($arItem['DISPLAY_PROPERTIES']['VIDEO']['VALUE']) ? $arItem['DISPLAY_PROPERTIES']['VIDEO']['~VALUE'] : '');
						$bLogo = false;
						
						$bImage = strlen($arItem['~PREVIEW_PICTURE']);
						$arImage = ($bImage ? CFile::ResizeImageGet($arItem['~PREVIEW_PICTURE'], array('width' => 80, 'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array());
						if(!$arImage && strlen($arItem['FIELDS']['DETAIL_PICTURE']['SRC'])){
							$bImage = strlen($arItem['FIELDS']['DETAIL_PICTURE']['SRC']);
							$arImage = ($bImage ? CFile::ResizeImageGet($arItem['FIELDS']['DETAIL_PICTURE']['ID'], array('width' => 90, 'height' => 10000), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array());
							$imageSrc = ($bImage ? $arImage['src'] : '');
							$bLogo = ($imageSrc ? true : false);
						}						
						?>

						<div class="col-md-12">
							<div class="item   clearfix<?=($bImage ? '' : ' wti')?><?=($bLogo ? ' wlogo' : '')?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>">
								<div class="question border clearfix">
									<div class="right_block pull-right clearfix">
										<?if($bImage && $arImage['src']):?>
											<div class="image  <?=($bImage ? '' : 'wpi')?>">
												<img src="<?=$arImage['src']?>" alt="<?=( $arItem['PREVIEW_PICTURE']['ALT'] ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME']);?>" title="<?=( $arItem['PREVIEW_PICTURE']['TITLE'] ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME']);?>" class="img-responsive" />
											</div>
										<?endif;?>
										<div class="body-info">
											<?if($post):?>
												<div class="post font_upper"><?=$post?></div>
											<?endif;?>
											
											<div class="title-wrapper<?=($bRating ? ' wrating' : '')?> <?=($bHasSocProps ? 'bottom-props' : '');?>">
												<?if($name):?>
													<div class="title"><?=$name?></div>
												<?endif?>
												<?/*if($bHasSocProps):?>
													<!-- noindex -->
														<?foreach($arItem['SOCIAL_PROPS'] as $arProp):?>
															<a href="<?=$arProp['VALUE'];?>" target="_blank" rel="nofollow" class="value <?=strtolower($arProp['CODE']);?>"><?=$arProp['VALUE'];?></a>
														<?endforeach;?>
													<!-- /noindex -->
												<?endif;*/?>
											</div>
										</div>
									</div>
									<div class="left_block">
										<div class="body-info">
											<?$bHasSocProps = (isset($arItem['SOCIAL_PROPS']) && $arItem['SOCIAL_PROPS']);?>
											<div class="top-wrapper">
												<?if($bRating):?>
													<?
													$ratingValue = ($arItem['DISPLAY_PROPERTIES']['RATING']['VALUE'] ? $arItem['DISPLAY_PROPERTIES']['RATING']['VALUE'] : 0);
													?>
													<div class="rating_wrap clearfix">
														<div class="rating current_<?=$ratingValue?>" title="<?=GetMessage('RATING_MESSAGE_'.$ratingValue)?>">
															<span class="stars_current "></span>
														</div>
													</div>
												<?endif?>
												<?if(isset($arItem['DISPLAY_ACTIVE_FROM']) && strlen($arItem['DISPLAY_ACTIVE_FROM'])):?>
													<div class="date font_xs"><?=$arItem['DISPLAY_ACTIVE_FROM'];?></div>
												<?endif;?>
											</div>
											<?if($review):?>
												<div class="text"><?=$review?></div>
											<?endif;?>
											<?if($arItem['DISPLAY_PROPERTIES']['FILE']['VALUE']):?>
												<div class="row docs-block">
													<?
													$countFile = count($arItem['DISPLAY_PROPERTIES']['FILE']['VALUE']);
													$colMdFile = ($countFile == 1 ? 12 : ($countFile == 2 ? 6 : 4));
													?>
													<?foreach((array)$arItem['DISPLAY_PROPERTIES']['FILE']['VALUE'] as $docID):?>
														<?$arFile = CPriority::get_file_info($docID);?>
														<div class="col-md-<?=$colMdFile;?>">
															<?
															$fileName = substr($arFile['ORIGINAL_NAME'], 0, strrpos($arFile['ORIGINAL_NAME'], '.'));
															$fileTitle = (strlen($arFile['DESCRIPTION']) ? $arFile['DESCRIPTION'] : $fileName);
															?>
															<div class="blocks clearfix <?=$arFile['TYPE']?>">
																<div class="inner-wrapper">
																	<a href="<?=$arFile['SRC']?>" class="dark-color text" target="_blank"><?=$fileTitle?></a>
																	<div class="filesize"><?=CPriority::filesize_format($arFile['FILE_SIZE']);?></div>
																</div>
															</div>
														</div>
													<?endforeach;?>
												</div>
											<?endif;?>
											<?if($arVideo):?>
												<div class="video">
													<?foreach($arVideo as $value):?>
														<div class="video-inner"><?=$value;?></div>
													<?endforeach;?>
												</div>
											<?endif;?>
										</div>
									</div>
								</div>
								<?if($answer):?>
									<?
									$arStaff = (isset($arItem['DISPLAY_PROPERTIES']['STAFF']['VALUE']) && isset($arResult['STAFF'][$arItem['DISPLAY_PROPERTIES']['STAFF']['VALUE']]) ? $arResult['STAFF'][$arItem['DISPLAY_PROPERTIES']['STAFF']['VALUE']] : array());
									?>
									<div class="answer border">
										<?if($arStaff && $arStaff['PREVIEW_PICTURE']):?>
											<?
											$bImageStaff = true;
											$img = CFile::ResizeImageGet($arStaff['PREVIEW_PICTURE'], array('width' => 40, 'height' => 40), BX_RESIZE_IMAGE_EXACT, true);
											?>
											<div class="image_staff">
												<img src="<?=$img['src'];?>" alt="<?=$arStaff['NAME'];?>" title="<?=$arStaff['NAME'];?>">
											</div>
										<?endif;?>
										<div class="text<?=(!$bImageStaff ? ' wti' : '')?>">
											<div class="staff">
												<span class="title font_upper"><?=$arStaff['NAME'];?></span>
												<?if($arStaff['PROPERTY_POST_VALUE']):?>
													<span class="post font_upper">, <?=$arStaff['PROPERTY_POST_VALUE'];?></span>
												<?endif;?>
											</div>
											<div class="wrap_text font_xs"><?=$answer?></div>
										</div>
									</div>
								<?endif?>
							</div>
						</div>
					<?endforeach;?>
				</div>
			<?endforeach;?>
		</div>
	<?endif;?>

	<?// bottom pagination?>
	<?if($arParams['DISPLAY_BOTTOM_PAGER']):?>
		<div class="pagination_nav">
			<?=$arResult['NAV_STRING']?>
		</div>
	<?endif;?>
</div>