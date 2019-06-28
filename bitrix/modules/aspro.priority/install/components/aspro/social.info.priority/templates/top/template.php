<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true)die();?>
<?$this->setFrameMode(true);?>
<div class="social-icons">
	<?if($arParams["SOCIAL_TITLE"] && (!empty($arResult["SOCIAL_VK"]) || !empty($arResult["SOCIAL_ODNOKLASSNIKI"]) || !empty($arResult["SOCIAL_FACEBOOK"]) || !empty($arResult["SOCIAL_TWITTER"]) || !empty($arResult["SOCIAL_INSTAGRAM"]) || !empty($arResult["SOCIAL_MAIL"]) || !empty($arResult["SOCIAL_YOUTUBE"]) || !empty($arResult["SOCIAL_GOOGLEPLUS"]))):?>
		<div class="small_title"><?=$arParams["SOCIAL_TITLE"];?></div>
	<?endif;?>
	<!-- noindex -->
	<ul>
		<?if(!empty($arResult['SOCIAL_VK'])):?>
			<li class="vk">
				<a href="<?=$arResult['SOCIAL_VK']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_VK')?>">
					<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/social_vk.svg');?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_FACEBOOK'])):?>
			<li class="facebook">
				<a href="<?=$arResult['SOCIAL_FACEBOOK']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_FACEBOOK')?>">
					<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/social_facebook.svg');?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_TWITTER'])):?>
			<li class="twitter">
				<a href="<?=$arResult['SOCIAL_TWITTER']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_TWITTER')?>">
					<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/social_twitter.svg');?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_INSTAGRAM'])):?>
			<li class="instagram">
				<a href="<?=$arResult['SOCIAL_INSTAGRAM']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_INSTAGRAM')?>">
					<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/social_instagram.svg');?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_TELEGRAM'])):?>
			<li class="telegram">
				<a href="<?=$arResult['SOCIAL_TELEGRAM']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_TELEGRAM')?>">
					<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/social_telegram.svg');?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_YOUTUBE'])):?>
			<li class="ytb">
				<a href="<?=$arResult['SOCIAL_YOUTUBE']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_YOUTUBE')?>">
					<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/social_youtube.svg');?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_ODNOKLASSNIKI'])):?>
			<li class="odn">
				<a href="<?=$arResult['SOCIAL_ODNOKLASSNIKI']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_ODNOKLASSNIKI')?>">
					<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/social_odnoklassniki.svg');?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_GOOGLEPLUS'])):?>
			<li class="gplus">
				<a href="<?=$arResult['SOCIAL_GOOGLEPLUS']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_GOOGLEPLUS')?>">
					<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/social_google.svg');?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_MAIL'])):?>
			<li class="mail">
				<a href="<?=$arResult['SOCIAL_MAIL']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_MAILRU')?>">
					<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/social_mail.svg');?>
				</a>
			</li>
		<?endif;?>
		<?if(!empty($arResult['SOCIAL_YANDEX_DZEN'])):?>
			<li class="yandex_dzen">
				<a href="<?=$arResult['SOCIAL_YANDEX_DZEN']?>" target="_blank" rel="nofollow" title="<?=GetMessage('TEMPL_SOCIAL_YANDEX_DZEN')?>">
					<?=CPriority::showIconSvg(SITE_TEMPLATE_PATH.'/images/include_svg/yandex_zen.svg');?>
				</a>
			</li>
		<?endif;?>		
	</ul>
	<!-- /noindex -->
</div>