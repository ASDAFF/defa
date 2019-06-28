<?if( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true ) die();?>
<?$this->setFrameMode(true);?>
<?global $bShowToogle;?>
<?
if(!function_exists("ShowSubItems")){
	function ShowSubItems($arItem){
		?>
		<?if($arItem["CHILD"]):?>
			<?$noMoreSubMenuOnThisDepth = false;?>
			<div class="submenu-wrapper hidden-block"<?=($arItem["SELECTED"] ? ' style="display:block;"' : '')?>>
				<ul class="submenu">
					<?foreach($arItem["CHILD"] as $arSubItem):?>
						<li class="item font_xs<?=($arSubItem["SELECTED"] ? " active opened" : "")?><?=($arSubItem["CHILD"] ? " child" : " no_child")?>">
							<a href="<?=$arSubItem["LINK"]?>"><?=$arSubItem["TEXT"]?><?=(isset($arSubItem['CHILD']) && $arSubItem['CHILD'] ? '<span class="arrow'.($arSubItem['SELECTED'] ? ' opened' : '').'"></span>' : '')?></a>
							<?if(!$noMoreSubMenuOnThisDepth):?>
								<?ShowSubItems($arSubItem);?>
							<?endif;?>
						</li>
						<?$noMoreSubMenuOnThisDepth |= CPriority::isChildsSelected($arSubItem["CHILD"]);?>
					<?endforeach;?>
				</ul>
			</div>
		<?endif;?>
		<?
	}
}
?>

<?if($arResult):?>
	<aside class="sidebar<?=($bShowToogle && isset($_COOKIE['MENU_CLOSED']) && $_COOKIE['MENU_CLOSED'] == 'Y' ? ' closed' : '')?>">
		<?if($bShowToogle):?>
			<?foreach($arResult as $arItem):?>
				<?if($arItem['PARAMS']['TYPE'] == 'PRODUCT'):?>
					<div class="switcher<?=(isset($_COOKIE['LEFT_CONTENT_CLOSED']) && $_COOKIE['LEFT_CONTENT_CLOSED'] == 'Y' ? ' collapsed' : '')?>"><span title="<?=GetMessage('SWITCHER_CLOSE');?>"><span class="circle"></span></span></div>
					<div class="catalog_opener"><span><?=$arItem['TEXT']?><span class="arrow"></span></span></div>
				<?endif;?>
			<?endforeach;?>
		<?endif;?>
		<ul class="nav nav-list side-menu">
			<?foreach($arResult as $arItem):?>
				<?
				if($arItem['PARAMS']['TYPE'] == 'PRODUCT')
					continue;
				?>
				<li class="item<?=($arItem["SELECTED"] ? " active opened" : "")?> <?=($arItem["CHILD"] ? " child" : "")?>">
					<a  href="<?=$arItem["LINK"]?>"><?=(isset($arItem["PARAMS"]["BLOCK"]) && $arItem["PARAMS"]["BLOCK"] ? $arItem["PARAMS"]["BLOCK"] : "");?><?=$arItem["TEXT"]?><?=(isset($arItem['CHILD']) && $arItem['CHILD'] ? '<span class="arrow'.($arItem['SELECTED'] ? ' opened' : '').'"></span>' : '')?></a>
					<?ShowSubItems($arItem);?>
				</li>
			<?endforeach;?>
		</ul>
	</aside>
<?endif;?>