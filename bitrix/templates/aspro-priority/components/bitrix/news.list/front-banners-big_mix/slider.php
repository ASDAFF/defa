<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();?>
<?$this->setFrameMode(true);?>

<?
global $arTheme;
$bHideOnNarrow = $arTheme['BIGBANNER_HIDEONNARROW']['VALUE'] === 'Y';
$slideshowSpeed = abs(intval($arTheme['BIGBANNER_SLIDESSHOWSPEED']['VALUE']));
$animationSpeed = abs(intval($arTheme['BIGBANNER_ANIMATIONSPEED']['VALUE']));
$bAnimation = ($slideshowSpeed && strlen($arTheme['BIGBANNER_ANIMATIONTYPE']['VALUE']));
if($arTheme['BIGBANNER_ANIMATIONTYPE']['VALUE'] === 'FADE'){
	$animationType = 'fade';
}
else{
	$animationType = 'slide';
	$animationDirection = 'horizontal';
	if($arTheme['BIGBANNER_ANIMATIONTYPE']['VALUE'] === 'SLIDE_VERTICAL'){
		$animationDirection = 'vertical';
	}
}
?>
<div class="banners-big wmix_banner front<?=($bHideOnNarrow ? ' hidden_narrow' : '')?>">
	<div class="maxwidth-banner">
		<div class="flexslider unstyled <?=($animationDirection == 'vertical' ? 'vertical' : '')?>" data-plugin-options='{"directionNav": true, "customDirection": ".nav-carousel a", "controlNav": true, "nav" : "normal", <?=($bAnimation ? '"slideshow": true,' : '"slideshow": false,')?> <?=($animationType ? '"animation": "'.$animationType.'",' : '')?> <?=($animationDirection ? '"direction": "'.$animationDirection.'",' : '')?> <?=($slideshowSpeed >= 0 ? '"slideshowSpeed": '.$slideshowSpeed.',' : '')?> <?=($animationSpeed >= 0 ? '"animationSpeed": '.$animationSpeed.',' : '')?> "animationLoop": true}'>
			<ul class="slides items">
				<?$bShowH1 = false;?>
				<?foreach($arResult['SECTIONS']['BIG']['ITEMS'] as $i => $arItem):?>
					<?
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					$imageBgSrc = is_array($arItem['DETAIL_PICTURE']) ? $arItem['DETAIL_PICTURE']['SRC'] : '';
					$type = $arItem['PROPERTIES']['BANNERTYPE']['VALUE_XML_ID'];
					$bOnlyImage = $type == 'T1' || !$type;
					$bLinkOnName = strlen($arItem['PROPERTIES']['LINKIMG']['VALUE']);
					$bSectionName = (isset($arItem['DISPLAY_PROPERTIES']['SECTION']) && strlen($arItem['DISPLAY_PROPERTIES']['SECTION']['VALUE']) ? true : false);
					$bH1 = (isset($arItem['DISPLAY_PROPERTIES']['TITLE_H1']) && $arItem['DISPLAY_PROPERTIES']['TITLE_H1']['VALUE_XML_ID'] == 'Y' ? true : false);
					// video options
					$videoSource = strlen($arItem['PROPERTIES']['VIDEO_SOURCE']['VALUE_XML_ID']) ? $arItem['PROPERTIES']['VIDEO_SOURCE']['VALUE_XML_ID'] : 'LINK';
					$videoSrc = $arItem['PROPERTIES']['VIDEO_SRC']['VALUE'];
					if($videoFileID = $arItem['PROPERTIES']['VIDEO']['VALUE']){
						$videoFileSrc = CFile::GetPath($videoFileID);
					}
					$videoPlayer = $videoPlayerSrc = '';
					if($bShowVideo = $arItem['PROPERTIES']['SHOW_VIDEO']['VALUE_XML_ID'] === 'YES' && ($videoSource == 'LINK' ? strlen($videoSrc) : strlen($videoFileSrc))){
						$colorSubstrates = ($arItem['PROPERTIES']['COLOR_SUBSTRATES']['VALUE_XML_ID'] ? $arItem['PROPERTIES']['COLOR_SUBSTRATES']['VALUE_XML_ID'] : '');
						$buttonVideoText = $arItem['PROPERTIES']['BUTTON_VIDEO_TEXT']['VALUE'];
						$bVideoLoop = $arItem['PROPERTIES']['VIDEO_LOOP']['VALUE_XML_ID'] === 'YES';
						$bVideoDisableSound = $arItem['PROPERTIES']['VIDEO_DISABLE_SOUND']['VALUE_XML_ID'] === 'YES';
						$bVideoAutoStart = $arItem['PROPERTIES']['VIDEO_AUTOSTART']['VALUE_XML_ID'] === 'YES';
						$bVideoCover = $arItem['PROPERTIES']['VIDEO_COVER']['VALUE_XML_ID'] === 'YES';
						$bVideoUnderText = $arItem['PROPERTIES']['VIDEO_UNDER_TEXT']['VALUE_XML_ID'] === 'YES';
						if(strlen($videoSrc) && $videoSource === 'LINK'){
							// videoSrc available values
							// YOTUBE:
							// https://youtu.be/WxUOLN933Ko
							// <iframe width="560" height="315" src="https://www.youtube.com/embed/WxUOLN933Ko" frameborder="0" allowfullscreen></iframe>
							// VIMEO:
							// https://vimeo.com/211336204
							// <iframe src="https://player.vimeo.com/video/211336204?title=0&byline=0&portrait=0" width="640" height="360" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
							// RUTUBE:
							// <iframe width="720" height="405" src="//rutube.ru/play/embed/10314281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowfullscreen></iframe>
							
							$videoPlayer = 'YOUTUBE';
							$videoSrc = htmlspecialchars_decode($videoSrc);
							if(strpos($videoSrc, 'iframe') !== false){
								$re = '/<iframe.*src=\"(.*)\".*><\/iframe>/isU';
								preg_match_all($re, $videoSrc, $arMatch);
								$videoSrc = $arMatch[1][0];
							}
							$videoPlayerSrc = $videoSrc;

							switch($videoSrc){
								case(($v = strpos($videoSrc, 'vimeo.com/')) !== false):
									$videoPlayer = 'VIMEO';
									if(strpos($videoSrc, 'player.vimeo.com/') === false){
										$videoPlayerSrc = str_replace('vimeo.com/', 'player.vimeo.com/', $videoPlayerSrc);
									}
									if(strpos($videoSrc, 'vimeo.com/video/') === false){
										$videoPlayerSrc = str_replace('vimeo.com/', 'vimeo.com/video/', $videoPlayerSrc);
									}
									break;
								case(($v = strpos($videoSrc, 'rutube.ru/')) !== false):
									$videoPlayer = 'RUTUBE';
									break;
								case(strpos($videoSrc, 'watch?') !== false && ($v = strpos($videoSrc, 'v=')) !== false):
									$videoPlayerSrc = 'https://www.youtube.com/embed/'.substr($videoSrc, $v + 2, 11);
									break;
								case(strpos($videoSrc, 'youtu.be/') !== false && $v = strpos($videoSrc, 'youtu.be/')):
									$videoPlayerSrc = 'https://www.youtube.com/embed/'.substr($videoSrc, $v + 9, 11);
									break;
								case(strpos($videoSrc, 'embed/') !== false && $v = strpos($videoSrc, 'embed/')):
									$videoPlayerSrc = 'https://www.youtube.com/embed/'.substr($videoSrc, $v + 6, 11);
									break;
							}

							$bVideoPlayerYoutube = $videoPlayer === 'YOUTUBE';
							$bVideoPlayerVimeo = $videoPlayer === 'VIMEO';
							$bVideoPlayerRutube = $videoPlayer === 'RUTUBE';

							if(strlen($videoPlayerSrc)){
								$videoPlayerSrc = trim($videoPlayerSrc.
									($bVideoPlayerYoutube ? '?autoplay=1&enablejsapi=1&controls=0&showinfo=0&rel=0&disablekb=1&iv_load_policy=3' :
									($bVideoPlayerVimeo ? '?autoplay=1&badge=0&byline=0&portrait=0&title=0' :
									($bVideoPlayerRutube ? '?quality=1&autoStart=0&sTitle=false&sAuthor=false&platform=someplatform' : '')))
								);
							}
						}
						else{
							$videoPlayer = 'HTML5';
							$videoPlayerSrc = $videoFileSrc;
						}
					}
					?>
					<li class="item<?=($bShowVideo ? ' wvideo' : '');?>" id="<?=$this->GetEditAreaId($arItem['ID'])?>" style="background:url('<?=$imageBgSrc?>') center center / cover no-repeat;" data-slide_index="<?=$i?>" <?=($arItem['PROPERTIES']['MAIN_COLOR']['VALUE'] ? ' data-color="'.$arItem['PROPERTIES']['MAIN_COLOR']['VALUE_XML_ID'].'"' : '')?><?=($bShowVideo ? ' data-video_source="'.$videoSource.'"' : '')?><?=(strlen($videoPlayer) ? ' data-video_player="'.$videoPlayer.'"' : '')?><?=(strlen($videoPlayerSrc) ? ' data-video_src="'.$videoPlayerSrc.'"' : '')?><?=($bVideoAutoStart ? ' data-video_autoplay="1"' : '')?><?=($bVideoDisableSound ? ' data-video_disable_sound="1"' : '')?><?=($bVideoLoop ? ' data-video_loop="1"' : '')?><?=($bVideoCover ? ' data-video_cover="1"' : '')?>>
						<div class="maxwidth-theme<?=($bOnlyImage && $bLinkOnName ? ' fulla' : '')?>">
							<div class="row <?=$arItem['PROPERTIES']['TEXTCOLOR']['VALUE_XML_ID']?> <?=($type != 'T2' ? 'righttext' : '')?>">
								<?$name = ($arItem['DETAIL_TEXT'] ? $arItem['DETAIL_TEXT'] : $arItem['NAME']);?>
								<?ob_start();?>
								<?if(!$bOnlyImage):?>
									<?
										$bShowButton1 = (strlen($arItem['PROPERTIES']['BUTTON1TEXT']['VALUE']) && strlen($arItem['PROPERTIES']['BUTTON1LINK']['VALUE']));
										$bShowButton2 = (strlen($arItem['PROPERTIES']['BUTTON2TEXT']['VALUE']) && strlen($arItem['PROPERTIES']['BUTTON2LINK']['VALUE']));
									?>
									<?if($bSectionName):?>
										<div class="section"><?=$arItem['DISPLAY_PROPERTIES']['SECTION']['VALUE']?></div>
									<?endif?>
									<?if($bH1 && !$bShowH1):?>
										<h1><?=$arItem['NAME'];?></h1>
										<?$bShowH1 = true;?>
									<?elseif($bLinkOnName):?>
										<a href="<?=$arItem['PROPERTIES']['LINKIMG']['VALUE']?>" class="title-link">
											<div class="title"><?=$name?></div>
										</a>
									<?else:?>
										<div class="title"><?=$name?></div>
									<?endif;?>
									<div class="text-block">
										<?=$arItem['PREVIEW_TEXT']?>
									</div>
									<div class="buttons">
										<?if($bShowVideo && !$bVideoAutoStart && !$bShowButton1 && !$bShowButton2):?>
											<span class="play btn-video small <?=(strlen($arItem['PROPERTIES']['BUTTON_VIDEO_CLASS']['VALUE_XML_ID']) ? $arItem['PROPERTIES']['BUTTON_VIDEO_CLASS']['VALUE_XML_ID'] : 'btn-default')?>" title="<?=$buttonVideoText?>"></span>
										<?elseif($bShowButton1 || $bShowButton2):?>
											<?if($bShowVideo && !$bVideoAutoStart):?>
												<span class="btn <?=(strlen($arItem['PROPERTIES']['BUTTON_VIDEO_CLASS']['VALUE_XML_ID']) ? $arItem['PROPERTIES']['BUTTON_VIDEO_CLASS']['VALUE_XML_ID'] : 'btn-default')?> btn-video" title="<?=$buttonVideoText?>"><?=$buttonVideoText?></span>
											<?endif;?>
											<?if($bShowButton1):?>
												<a href="<?=$arItem['PROPERTIES']['BUTTON1LINK']['VALUE']?>" class="btn <?=(strlen($arItem['PROPERTIES']['BUTTON1CLASS']['VALUE_XML_ID']) ? $arItem['PROPERTIES']['BUTTON1CLASS']['VALUE_XML_ID'] : 'btn-default')?>">
													<?=$arItem['PROPERTIES']['BUTTON1TEXT']['VALUE']?>
												</a>
											<?endif;?>
											<?if($bShowButton2):?>
												<a href="<?=$arItem['PROPERTIES']['BUTTON2LINK']['VALUE']?>" class="btn <?=(strlen($arItem['PROPERTIES']['BUTTON2CLASS']['VALUE_XML_ID'] ) ? $arItem['PROPERTIES']['BUTTON2CLASS']['VALUE_XML_ID'] : 'btn-default white')?>">
													<?=$arItem['PROPERTIES']['BUTTON2TEXT']['VALUE']?>
												</a>
											<?endif;?>
										<?endif;?>
									</div>
								<?endif;?>
								<?$text = ob_get_clean();?>

								<?ob_start();?>
								<?if(is_array($arItem['PREVIEW_PICTURE'])):?>
									<?if($bLinkOnName):?>
										<a href="<?=$arItem['PROPERTIES']['LINKIMG']['VALUE']?>" class="image">
											<img class="plaxy"  src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=($arItem['PREVIEW_PICTURE']['ALT'] ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($arItem['PREVIEW_PICTURE']['TITLE'] ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" />
										</a>
									<?else:?>
										<img class="plaxy" src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=($arItem['PREVIEW_PICTURE']['ALT'] ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])?>" title="<?=($arItem['PREVIEW_PICTURE']['TITLE'] ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])?>" />
									<?endif;?>
								<?endif;?>
								<?$img = ob_get_clean();?>

								<?if(!$bOnlyImage || (is_array($arItem['PREVIEW_PICTURE']) && !$bOnlyImage)):?>
									<div class="col-md-6 <?=$type == 'T2' ? 'text' : 'img'?>">
										<div class="inner">
											<?=$type == 'T2' ? $text : $img?>
										</div>
									</div>
									<div class="col-md-6 <?=$type == 'T2' ? 'img' : 'text'?>">
										<div class="inner">
											<?=$type == 'T2' ? $img : $text?>
										</div>
									</div>
								<?elseif($bOnlyImage && $bLinkOnName):?>
									<a href="<?=$arItem['PROPERTIES']['LINKIMG']['VALUE']?>"></a>
								<?elseif($bOnlyImage):?>
									<?if($bShowVideo && !$bVideoAutoStart):?>
										<div class="video_block">
											<span class="play btn-video  <?=(strlen($arItem['PROPERTIES']['BUTTON_VIDEO_CLASS']['VALUE_XML_ID']) ? $arItem['PROPERTIES']['BUTTON_VIDEO_CLASS']['VALUE_XML_ID'] : 'btn-default')?>" title="<?=$buttonVideoText?>"></span>
										</div>
									<?endif;?>
								<?endif;?>
								<div class="loading_video">
								  <hr/><hr/><hr/><hr/>
								</div>
							</div>
						</div>
						<?if($bShowVideo):?>
							<div class="overlay<?=($colorSubstrates ? ' '.$colorSubstrates : '');?>"></div>
						<?endif;?>						
					</li>
				<?endforeach;?>
			</ul>
			<div class="nav-carousel">
				<ul class="flex-direction-nav">
					<li class="flex-nav-prev">
						<a href="javascript:void(0)" class="flex-prev"><span>Prev</span></a>
					</li>
					<li class="flex-nav-next">
						<a href="javascript:void(0)" class="flex-next"><span>Next</span></a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
<?if($bInitYoutubeJSApi):?>
	<script type="text/javascript">
	BX.ready(function(){
		var tag = document.createElement('script');
		tag.src = "https://www.youtube.com/iframe_api";
		var firstScriptTag = document.getElementsByTagName('script')[0];
		firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	});
	</script>
<?endif;?>