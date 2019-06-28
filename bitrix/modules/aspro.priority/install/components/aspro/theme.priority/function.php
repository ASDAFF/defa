<?
function ShowOptions($optionCode, $arOption, $arParentOption = array(), $arCommunityValues = array(), $optionValue = ''){
	$isRow = (isset($arOption['IS_ROW']) && $arOption['IS_ROW'] == 'Y');
	$isPreview = (isset($arOption['PREVIEW']) && $arOption['PREVIEW']);
?>
<?
	if($arOption['TYPE'] == 'checkbox'):?>
		<?$isChecked = ($arOption['VALUE'] == 'Y');?>
		<?if($isRow):?>
			<div class="<?=(isset($arOption['ROW_CLASS']) && $arOption['ROW_CLASS'] ? $arOption['ROW_CLASS'] : '');?>">
				<div class="link-item animation-boxs <?=(isset($arOption['POSITION_BLOCK']) && $arOption['POSITION_BLOCK'] ? $arOption['POSITION_BLOCK'] : '');?> <?=(!$isChecked ? 'disabled' : '');?>">
		<?endif;?>
			<?ob_start();?>
				<?if((!isset($arOption['HIDE_TITLE']) || $arOption['HIDE_TITLE'] != 'Y') && (isset($arOption['TITLE']) && $arOption['TITLE'])):?><span><?=$arOption['TITLE']?></span><?endif;?>
			<?$title = ob_get_contents();
			ob_end_clean();?>

			<?ob_start();?>
				<?if(isset($arOption['BACKGROUND'])):?>
					<div class="background_option">
						<?if(isset($arOption['BACKGROUND']['TITLE']) && $arOption['BACKGROUND']['TITLE']):?>
							<span class="back_title"><?=$arOption['BACKGROUND']['TITLE'];?></span>
							<input class="back_input ajax_save_option" type="checkbox" id="<?=$optionCode?>_BACKGOUND" name="<?=$optionCode?>_BACKGOUND" value="<?=$arOption['BACKGOUND']['VALUE']?>" />
						<?endif;?>
					</div>
				<?endif;?>
				<?/*if(isset($arOption['PARENT']) && strlen($arOption['PARENT']) && $arOption['PARENT'] == $arParentOption['VALUE']):?>
				<?print_r($arParentOption['VALUE']);?>
					<input type="checkbox" id="<?=$optionCode?>" <?=((isset($arOption['SMALL_TOGGLE']) && $arOption['SMALL_TOGGLE']) ? "data-height=22" : "");?> class="custom-switch" name="<?=$optionCode?>" value="<?=$arOption['VALUE']?>" <?=($isChecked ? "checked" : "");?> />
				<?elseif(!isset($arOption['PARENT'])):*/?>
					<input type="checkbox" id="<?=$optionCode?>" <?=((isset($arOption['SMALL_TOGGLE']) && $arOption['SMALL_TOGGLE']) ? "data-height=22" : "");?> class="custom-switch" name="<?=$optionCode?>" value="<?=$arOption['VALUE']?>" <?=($isChecked ? "checked" : "");?> />
				<?//endif;?>
			<?$input = ob_get_contents();
			ob_end_clean();?>
			<?if(isset($arOption['IMG']) && $arOption['IMG']):?>
				<?=$title;?>
				<div class="img"><img src="<?=$arOption['IMG'];?>" alt="<?=$arOption['TITLE']?>" title="<?=$arOption['TITLE']?>"/></div>
				<div class="input"><?=$input;?></div>
			<?elseif(isset($arOption['GROUP']) && $arOption['GROUP']):?>
				<span class="inner-table-block"><?=$title;?></span>
				<span class="inner-table-block"><?=$input;?></span>
			<?else:?>
				<?=$input;?>
			<?endif;?>
		<?if($isRow):?>
				</div>
			</div>
		<?endif;?>
	<?elseif($arOption['TYPE'] == 'hidden'):?>
		<input type="hidden" id="<?=$optionCode?>" name="<?=$optionCode?>" value="<?=(isset($arOption['VALUE_IMPORTANT']) && $arOption['VALUE_IMPORTANT'] == 'Y' ? 'Y' : $arOption['VALUE']);?>" />
	<?elseif($arOption['TYPE'] == 'selectbox' || $arOption['TYPE'] == 'multiselectbox'):?>
		<input type="hidden"<?=($optionCode != 'HEADER_TYPE' && $optionCode != 'FOOTER_TYPE' ? ' id="'.$optionCode.'"' : '');?> name="<?=$optionCode?>" value="<?=$arOption['VALUE']?>" />
		<?if(isset($arOption['GROUPS']) && $arOption['GROUPS'] == 'Y'):?>
			<?
			$arGroups = array();
			foreach($arOption['LIST'] as $variantCode => $arVariant)
			{
				if(isset($arVariant['HIDE']) && $arVariant['HIDE'] == 'Y') continue;
				$group = ((isset($arVariant['GROUP']) && $arVariant['GROUP']) ? $arVariant['GROUP'] : GetMessage('NO_GROUP'));
				$arGroups[$group]['LIST'][$variantCode] = array(
					'TITLE' => ((isset($arVariant['VALUE']) && $arVariant['VALUE']) ? $arVariant['VALUE'] : $arVariant['TITLE']),
					'CURRENT' => ((isset($arVariant['CURRENT']) && $arVariant['CURRENT']) ? $arVariant['CURRENT'] : 'N')
				);
			}
			if($arGroups)
			{
				foreach($arGroups as $key => $arGroup)
				{?>
					<div class="group">
						<div class="title"><?=$key;?></div>
						<div class="values">
							<div class="inner-values">
								<?foreach($arGroup['LIST'] as $variantCode => $arVariant):?>
									<a href="javascript:;" data-option-id="<?=$optionCode?>" data-option-value="<?=$variantCode?>" class="link-item animation-boxs <?=$arVariant['CURRENT'] == 'Y' ? 'current' : ''?>">
										<?if(isset($arVariant['IMG']) && $arVariant['IMG']):?>
											<span><img src="<?=$arVariant['IMG'];?>" alt="<?=$arVariant['TITLE']?>" title="<?=$arVariant['TITLE']?>"/></span>
										<?endif;?>
										<?if(!isset($arVariant['HIDE_TITLE']) || $arVariant['HIDE_TITLE'] != 'Y'):?><span><?=$arVariant['TITLE']?></span><?endif;?>
									</a>
								<?endforeach;?>
							</div>
						</div>
					</div>
				<?}
			}?>	
		<?else:?>
			<?if($isRow):?>
				<div class="rows items">
			<?endif;?>
			<?if($arOption['LIST']):?>
				<?
				$bTabs = (isset($arOption['IS_TABS']) && $arOption['IS_TABS'] == 'Y' ? true : false);
				?>
				<?if($bTabs):?>
					<div class="tabs">
						<div class="wrap">
							<?foreach($arOption['LIST'] as $variantCode => $arVariant):?>
								<?
								if($variantCode == 'custom'){
									continue;
								}
								?>
								<?ob_start();?>
									<?if((!isset($arVariant['HIDE_TITLE']) || $arVariant['HIDE_TITLE'] != 'Y') && (isset($arVariant['TITLE']) && $arVariant['TITLE'])):?><span><?=$arVariant['TITLE']?></span><?endif;?>
								<?$title = ob_get_contents();
								ob_end_clean();?>

								<div class="tab<?=($arVariant['CURRENT'] == 'Y' ? ' current' : '')?>">
									<a href="javascript:;" <?=($isPreview && (isset($arOption['PREVIEW']['SCROLL_BLOCK']) && $arOption['PREVIEW']['SCROLL_BLOCK']) ? "data-option-type='".$arOption['PREVIEW']['SCROLL_BLOCK']."'" : "");?> <?=($isPreview && isset($arOption['PREVIEW']['URL']) ? "data-option-url='".str_replace('//', '/', SITE_DIR.$arOption['PREVIEW']['URL'])."'" : "");?> data-option-id="<?=$optionCode?>" data-option-value="<?=$variantCode?>" class="link-item animation-boxs <?=(isset($arVariant['POSITION_BLOCK']) && $arVariant['POSITION_BLOCK'] ? $arVariant['POSITION_BLOCK'] : '');?> <?=$arVariant['CURRENT'] == 'Y' ? 'current' : ''?>"><span class="title"><?=$title;?></span></a>
								</div>
							<?endforeach;?>
						</div>
					</div>
					<div class="tabs_content">
						<div class="opener_wrap">
							<span class="opener_tab">
								<svg width="10" height="6" viewBox="0 0 10 6">
									<path d="M974.282,191.291a0.991,0.991,0,0,1,1.4,0l4.017,4.022a0.993,0.993,0,0,1-1.4,1.4l-4.016-4.022A0.994,0.994,0,0,1,974.282,191.291Zm4.016,4.022,4.017-4.022a0.992,0.992,0,0,1,1.4,1.4l-4.016,4.022A0.993,0.993,0,0,1,978.3,195.313Z" transform="translate(-974 -191)"/>
								</svg>						
							</span>
						</div>
				<?endif;?>
				<?foreach($arOption['LIST'] as $variantCode => $arVariant):
					if(isset($arVariant['HIDE']) && $arVariant['HIDE'] == 'Y') continue;?>
					<?if($isRow || $bTabs):?>
						<div class="item<?=($arVariant['CURRENT'] == 'Y' ? ' current' : '')?> <?=(isset($arVariant['ROW_CLASS']) && $arVariant['ROW_CLASS'] ? $arVariant['ROW_CLASS'] : '');?>">
					<?endif;?>
					<?if(!$bTabs):?>
						<a href="javascript:;" <?=($isPreview && (isset($arOption['PREVIEW']['SCROLL_BLOCK']) && $arOption['PREVIEW']['SCROLL_BLOCK']) ? "data-option-type='".$arOption['PREVIEW']['SCROLL_BLOCK']."'" : "");?> <?=($isPreview && isset($arOption['PREVIEW']['URL']) ? "data-option-url='".str_replace('//', '/', SITE_DIR.$arOption['PREVIEW']['URL'])."'" : "");?> data-option-id="<?=$optionCode?>" data-option-value="<?=$variantCode?>" class="link-item animation-boxs <?=(isset($arVariant['POSITION_BLOCK']) && $arVariant['POSITION_BLOCK'] ? $arVariant['POSITION_BLOCK'] : '');?> <?=$arVariant['CURRENT'] == 'Y' ? 'current' : ''?>">
					<?endif;?>
						<?ob_start();?>
							<?if(!$bTabs && (!isset($arVariant['HIDE_TITLE']) || $arVariant['HIDE_TITLE'] != 'Y') && (isset($arVariant['TITLE']) && $arVariant['TITLE'])):?><span><?=$arVariant['TITLE']?></span><?endif;?>
						<?$title = ob_get_contents();
						ob_end_clean();?>

						<?ob_start();?>
							<?if($bTabs):?>
								<?if($arVariant['CURRENT'] == 'Y'):?>
									<img src="<?=$arVariant['IMG'];?>" alt="<?=$arVariant['TITLE']?>" title="<?=$arVariant['TITLE']?>"/>
								<?endif;?>
							<?else:?>
								<span><img src="<?=$arVariant['IMG'];?>" alt="<?=$arVariant['TITLE']?>" title="<?=$arVariant['TITLE']?>"/></span>
							<?endif;?>
						<?$img = ob_get_contents();
						ob_end_clean();?>

						<?if(isset($arVariant['IMG']) && $arVariant['IMG']):?>
							<?if(isset($arVariant['POSITION_TITLE']) && $arVariant['POSITION_TITLE']):?>
								<?if($arVariant['POSITION_TITLE'] == 'left'):?>
									<span class="inner-table-block" <?=((isset($arVariant['TITLE_WIDTH']) && $arVariant['TITLE_WIDTH']) ? "style='width:".$arVariant['TITLE_WIDTH']."'" : "");?>><?=$title;?></span>
									<span class="inner-table-block"><?=$img;?></span>
								<?endif;?>
							<?else:?>
								<span class="title"><?=$title;?></span>
								<?=$img;?>
							<?endif;?>
						<?else:?>
							<?=$title;?>
						<?endif;?>

						<?if($arVariant['SUB_PARAMS']):?>
							<?foreach($arVariant['SUB_PARAMS'] as $paramCode => $arExtraParam):?>
								<?if($arExtraParam['TYPE'] == 'checkbox'):?>
									<?$isChecked = ($arExtraParam['VALUE'] == 'Y' ? true : false);?>
									<?ob_start();?>
										<?if((!isset($arExtraParam['HIDE_TITLE']) || $arExtraParam['HIDE_TITLE'] != 'Y') && (isset($arExtraParam['TITLE']) && $arExtraParam['TITLE'])):?><span><?=$arExtraParam['TITLE']?></span><?endif;?>
									<?$title = ob_get_contents();
									ob_end_clean();?>

									<?ob_start();?>
										<input type="checkbox" id="<?=$optionCode.'_'.$variantCode.'_'.$paramCode;?>" <?=((isset($arExtraParam['SMALL_TOGGLE']) && $arExtraParam['SMALL_TOGGLE']) ? "data-height=22" : "");?> class="custom-switch" name="<?=$optionCode.'_'.$variantCode.'_'.$paramCode;?>" value="<?=$arExtraParam['VALUE']?>" <?=($isChecked ? "checked" : "");?> />
									<?$input = ob_get_contents();
									ob_end_clean();?>
									<div class="extra_params">
										<span class="input-block"><?=$input;?></span>
										<span class="title-block"><?=$title;?></span>
									</div>
								<?endif;?>
							<?endforeach;?>
						<?endif;?>
					<?if(!$bTabs):?>
						</a>
					<?endif;?>
					<?if($isRow || $bTabs):?>
						</div>
					<?endif;?>
				<?endforeach;?>
			<?if($bTabs):?>
				</div>
			<?endif;?>
			<?elseif($arOption['COMMUNITY'] && $arCommunityValues):?>
				<?foreach($arCommunityValues as $variantCode => $arVariant):
					if(isset($arVariant['HIDE']) && $arVariant['HIDE'] == 'Y') continue;?>
					<?if($isRow):?>
						<div class="<?=(isset($arVariant['ROW_CLASS']) && $arVariant['ROW_CLASS'] ? $arVariant['ROW_CLASS'] : '');?>">
					<?endif;?>
					<a href="javascript:;" <?=($isPreview && (isset($arOption['PREVIEW']['SCROLL_BLOCK']) && $arOption['PREVIEW']['SCROLL_BLOCK']) ? "data-option-type='".$arOption['PREVIEW']['SCROLL_BLOCK']."'" : "");?> <?=($isPreview && isset($arOption['PREVIEW']['URL']) ? "data-option-url='".str_replace('//', '/', SITE_DIR.$arOption['PREVIEW']['URL'])."'" : "");?> data-option-id="<?=$optionCode?>" data-option-value="<?=$variantCode?>" class="link-item animation-boxs <?=(isset($arVariant['POSITION_BLOCK']) && $arVariant['POSITION_BLOCK'] ? $arVariant['POSITION_BLOCK'] : '');?> <?=$arVariant['CURRENT'] == 'Y' ? 'current' : ''?>">

						<?ob_start();?>
							<?if((!isset($arVariant['HIDE_TITLE']) || $arVariant['HIDE_TITLE'] != 'Y') && (isset($arVariant['TITLE']) && $arVariant['TITLE'])):?><span><?=$arVariant['TITLE']?></span><?endif;?>
						<?$title = ob_get_contents();
						ob_end_clean();?>

						<?ob_start();?>
							<span><img src="<?=$arVariant['IMG'];?>" alt="<?=$arVariant['TITLE']?>" title="<?=$arVariant['TITLE']?>"/></span>
						<?$img = ob_get_contents();
						ob_end_clean();?>

						<?if(isset($arVariant['IMG']) && $arVariant['IMG']):?>
							<?if(isset($arVariant['POSITION_TITLE']) && $arVariant['POSITION_TITLE']):?>
								<?if($arVariant['POSITION_TITLE'] == 'left'):?>
									<span class="inner-table-block" <?=((isset($arVariant['TITLE_WIDTH']) && $arVariant['TITLE_WIDTH']) ? "style='width:".$arVariant['TITLE_WIDTH']."'" : "");?>><?=$title;?></span>
									<span class="inner-table-block"><?=$img;?></span>
								<?endif;?>
							<?else:?>
								<span class="title"><?=$title;?></span>
								<?=$img;?>
							<?endif;?>
						<?else:?>
							<?=$title;?>
						<?endif;?>
					</a>
					<?if($isRow):?>
						</div>
					<?endif;?>
				<?endforeach;?>
			<?endif?>
			<?if($isRow):?>
				</div>
			<?endif;?>
		<?endif;?>
	<?elseif($arOption['TYPE'] == 'text'):?>
		<input type="text" class="form-control" id="<?=$optionCode?>" <?=((isset($arOption['PARAMS']) && isset($arOption['PARAMS']['WIDTH'])) ? 'style="width:'.$arOption['PARAMS']['WIDTH'].'"' : '');?> name="<?=$optionCode?>" value="<?=$arOption['VALUE']?>" />
	<?elseif($arOption['TYPE'] == 'textarea'):?>
		<?// text here?>
	<?endif;?>
<?}?>

<?function ShowOptionsTitle($optionCode, $arOption){?>
	<?if(!isset($arOption['HIDE_TITLE']) || $arOption['HIDE_TITLE'] != 'Y'):?>
		<div class="title"><?=$arOption['TITLE'];?><?=((isset($arOption['HINT']) && $arOption['HINT']) ? "<span class='tooltip-link' data-placement='bottom' data-trigger='click' data-toggle='tooltip' data-original-title='".$arOption['HINT']."'>?</span>" : "");?></div>
	<?endif;?>
<?}?>