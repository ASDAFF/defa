<div class="mobileheader-v2">
	<div class="burger pull-left">
		<?=CNextB2c::showIconSvg("burger dark", SITE_TEMPLATE_PATH."/images/svg/Burger_big_white.svg");?>
		<?=CNextB2c::showIconSvg("close dark", SITE_TEMPLATE_PATH."/images/svg/Close.svg");?>
	</div>
	<div class="title-block col-sm-6 col-xs-5 pull-left"><?($APPLICATION->GetTitle() ? $APPLICATION->ShowTitle(false) : $APPLICATION->ShowTitle());?></div>
	<div class="right-icons pull-right">
		<div class="pull-right">
			<div class="wrap_icon">
				<button class="top-btn inline-search-show twosmallfont">
					<?=CNextB2c::showIconSvg("search big", SITE_TEMPLATE_PATH."/images/svg/Search_big_black.svg");?>
				</button>
			</div>
		</div>
		<div class="pull-right">
			<div class="wrap_icon wrap_basket">
				<?=CNextB2c::ShowBasketWithCompareLink('', 'big white', false, false, true);?>
			</div>
		</div>
		<div class="pull-right">
			<div class="wrap_icon wrap_cabinet">
				<?=CNextB2c::showCabinetLink(true, false, 'big white');?>
			</div>
		</div>
	</div>
</div>