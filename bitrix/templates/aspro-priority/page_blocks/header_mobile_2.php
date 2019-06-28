<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>

<div class="mobileheader-v2">
	<?CPriority::ShowBurger('white');?>
	<div class="title-block col-sm-8 col-xs-7 pull-left"><?$APPLICATION->ShowTitle(false)?></div>
	<div class="right-icons pull-right">
		<?if($arTheme['ORDER_VIEW']['DEPENDENT_PARAMS']['ORDER_BASKET_VIEW']['VALUE']=='HEADER'):?>
			<div class="pull-right">
				<div class="wrap_icon wrap_basket">
					<?=CPriority::showBasketLink('', 'white', '', '');?>
				</div>
			</div>
		<?endif;?>
		<?if($arTheme["CABINET"]["VALUE"]=='Y'):?>
			<div class="pull-right">
				<div class="wrap_icon wrap_cabinet">
					<?=CPriority::showCabinetLink(true, false, 'white');?>
				</div>
			</div>
		<?endif;?>
		<div class="pull-right">
			<div class="wrap_icon">
				<?=CPriority::ShowSearch('', 'white');?>
			</div>
		</div>		
	</div>
</div>