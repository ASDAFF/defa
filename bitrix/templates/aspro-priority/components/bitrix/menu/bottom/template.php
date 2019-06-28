<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
$this->setFrameMode(true);
$colmd = 12;
$colsm = 12;
?>
<?if($arResult):?>
	<?
	if(!function_exists("ShowSubItems2")){
		function ShowSubItems2($arItem){
			?>
			<?if($arItem["CHILD"]):?>
				<?$noMoreSubMenuOnThisDepth = false;
				$count = count($arItem["CHILD"]);?>
				<div class="wrap">
					<?foreach($arItem["CHILD"] as $arSubItem):?>
						<?
						if($arSubItem['PARAMS']['TYPE'] == 'PRODUCT'){
							$bProductItem = true;
							continue;
						}
						?>
						<?$bLink = strlen($arSubItem['LINK']);?>
						<div class="item<?=($arSubItem["SELECTED"] ? " active" : "")?>">
							<div class="title">
								<?if($bLink):?>
									<a href="<?=$arSubItem['LINK']?>"><?=$arSubItem['TEXT']?></a>
								<?else:?>
									<span><?=$arSubItem['TEXT']?></span>
								<?endif;?>
							</div>
						</div>
						<?$noMoreSubMenuOnThisDepth |= CPriority::isChildsSelected($arSubItem["CHILD"]);?>
					<?endforeach;?>
				</div>
			<?endif;?>
			<?
		}
	}
	?>
	<div class="bottom-menu">
		<div class="items">
			<?foreach($arResult as $i => $arItem):?>
					<?$bLink = strlen($arItem['LINK']);?>
					<div class="item<?=($arItem["SELECTED"] ? " active" : "")?>">
						<div class="title">
							<?if($bLink):?>
								<a href="<?=$arItem['LINK']?>"><?=$arItem['TEXT']?></a>
							<?else:?>
								<span><?=$arItem['TEXT']?></span>
							<?endif;?>
						</div>
					</div>
					<?ShowSubItems2($arItem);?>
			<?endforeach;?>
		</div>
	</div>
<?endif;?>