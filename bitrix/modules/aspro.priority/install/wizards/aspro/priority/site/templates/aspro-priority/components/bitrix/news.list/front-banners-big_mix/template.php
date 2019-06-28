<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>
<div class="mixed_banners clearfix">
	<?if($arResult['SECTIONS']['BIG']):?>
		<div class="big_banners_block">
			<?include('slider.php');?>
		</div>
	<?endif;?>
	<?if($arResult['SECTIONS']['BIG'] && $arResult['SECTIONS']['SMALL']):?>
		<div class="small_banners_block">
			<?include('normal.php');?>
		</div>
	<?endif;?>
</div>