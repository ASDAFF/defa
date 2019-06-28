<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<div class="mobileheader-v1">
	<?CPriority::ShowBurger();?>
	<div class="logo-block pull-left">
		<div class="logo<?=($arTheme["COLORED_LOGO"]["VALUE"] !== "Y" ? '' : ' colored')?>">
			<?=CPriority::ShowLogo();?>
		</div>
	</div>
	<div class="right-icons pull-right">
		<div class="pull-right">
			<div class="wrap_icon wrap_basket">
				<?=CPriority::showBasketLink('', '', '', '', true);?>
			</div>
		</div>
		<?if($arTheme["CABINET"]["VALUE"]=='Y'):?>
			<div class="pull-right">
				<div class="wrap_icon wrap_cabinet">
					<?=CPriority::showCabinetLink(true, false);?>
				</div>
			</div>
		<?endif;?>
		<div class="pull-right">
			<div class="wrap_icon">
				<?=CPriority::ShowSearch();?>
			</div>
		</div>		
	</div>
</div>