<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true ) die();?>
<?$this->setFrameMode(true);?>
<?use \Bitrix\Main\Localization\Loc;?>
<?
if($arResult['EMPTY_ITEM'] != 'Y')
{
	// preview image
	$bShowImage = in_array('PREVIEW_PICTURE', $arParams['FIELD_CODE']);

	if($bShowImage){
		$bImage = strlen($arResult['FIELDS']['PREVIEW_PICTURE']['SRC']);
		$arImage = ($bImage ? CFile::ResizeImageGet($arResult['FIELDS']['PREVIEW_PICTURE']['ID'], array('width' => 1000, 'height' => 1000), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true) : array());
		$imageSrc = ($bImage ? $arImage['src'] : '');
	}

	$videoSource = strlen($arResult['PROPERTIES']['VIDEO_SOURCE']['VALUE_XML_ID']) ? $arResult['PROPERTIES']['VIDEO_SOURCE']['VALUE_XML_ID'] : 'LINK';
	$videoSrc = $arResult['PROPERTIES']['VIDEO_SRC']['VALUE'];
	if($videoFileID = $arResult['PROPERTIES']['VIDEO']['VALUE']){
		$videoFileSrc = CFile::GetPath($videoFileID);
	}
	$videoPlayer = $videoPlayerSrc = '';
	if($videoSource == 'LINK' ? strlen($videoSrc) : strlen($videoFileSrc)){
		$bVideo = true;
		$colorSubstrates = ($arResult['PROPERTIES']['COLOR_SUBSTRATES']['VALUE_XML_ID'] ? $arResult['PROPERTIES']['COLOR_SUBSTRATES']['VALUE_XML_ID'] : '');
		$buttonVideoText = $arResult['PROPERTIES']['BUTTON_VIDEO_TEXT']['VALUE'];
		$bVideoLoop = $arResult['PROPERTIES']['VIDEO_LOOP']['VALUE_XML_ID'] === 'YES';
		$bVideoDisableSound = $arResult['PROPERTIES']['VIDEO_DISABLE_SOUND']['VALUE_XML_ID'] === 'YES';
		$bVideoAutoStart = $arResult['PROPERTIES']['VIDEO_AUTOSTART']['VALUE_XML_ID'] === 'YES';
		$bVideoCover = $arResult['PROPERTIES']['VIDEO_COVER']['VALUE_XML_ID'] === 'YES';
		$bVideoUnderText = $arResult['PROPERTIES']['VIDEO_UNDER_TEXT']['VALUE_XML_ID'] === 'YES';
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

	<div class="item-views company front company_scroll type_1">
		<div class="company-block">
			<div class="row">
				<div class="item col-md-6">
					<div class="text">
						<?if($arParams['PAGER_SHOW_ALL'] && isset($arResult['DISPLAY_PROPERTIES']['URL']) && strlen($arResult['DISPLAY_PROPERTIES']['URL']['VALUE'])):?>
							<a class="show_all" href="<?=$arResult['DISPLAY_PROPERTIES']['URL']['VALUE'];?>"><span><?=(strlen($arParams['SHOW_ALL_TITLE']) ? $arParams['SHOW_ALL_TITLE'] : Loc::getMessage('S_TO_SHOW_ALL_COMPANY'))?></span></a>
						<?endif;?>
						<?if(isset($arResult['DISPLAY_PROPERTIES']['COMPANY_NAME']) && $arResult['DISPLAY_PROPERTIES']['COMPANY_NAME']['VALUE']):?>
							<h2><?=$arResult['DISPLAY_PROPERTIES']['COMPANY_NAME']['VALUE'];?></h2>
						<?endif;?>
						<?if((isset($arResult['DISPLAY_PROPERTIES']['COMPANY_TEXT']) && $arResult['DISPLAY_PROPERTIES']['COMPANY_TEXT']['VALUE'])):?>
							<div class="preview-text"><?=$arResult['DISPLAY_PROPERTIES']['COMPANY_TEXT']['~VALUE']['TEXT'];?></div>
						<?endif;?>
						<div class="buttons">
							<?if($arParams['PAGER_SHOW_ALL'] && isset($arResult['DISPLAY_PROPERTIES']['URL']) && strlen($arResult['DISPLAY_PROPERTIES']['URL']['VALUE'])):?>
								<a class="btn btn-default" href="<?=$arResult['DISPLAY_PROPERTIES']['URL']['VALUE'];?>"><span><?=(strlen($arParams['MORE_BUTTON_TITLE']) ? $arParams['MORE_BUTTON_TITLE'] : Loc::getMessage('S_TO_SHOW_ALL_MORE'))?></span></a>
							<?endif;?>

							<?if(isset($arResult['DISPLAY_PROPERTIES']['SHOW_BUTTON']) && $arResult['DISPLAY_PROPERTIES']['SHOW_BUTTON']['VALUE_XML_ID'] == 'Y'):?>
								<span>
									<span class="btn btn-default btn-transparent animate-load" data-event="jqm" data-param-id="<?=CPriority::getFormID("aspro_priority_question");?>" data-name="question"><?=(strlen($arParams['FORM_BUTTON_TITLE']) ? $arParams['FORM_BUTTON_TITLE'] : Loc::getMessage('FORM_BUTTON_TITLE'));?></span>
								</span>
							<?endif;?>
						</div>
					</div>
				</div>
				
				<?if($bImage):?>
					<div class="item col-md-6">
						<div class="image" style="background:url(<?=$imageSrc;?>) top center / cover no-repeat;"<?=($bShowVideo ? ' data-video_source="'.$videoSource.'"' : '')?><?=(strlen($videoPlayer) ? ' data-video_player="'.$videoPlayer.'"' : '')?><?=(strlen($videoPlayerSrc) ? ' data-video_src="'.$videoPlayerSrc.'"' : '')?><?=($bVideoAutoStart ? ' data-video_autoplay="1"' : '')?>>
							<?if($bVideo):?>
								<div class="play">
									<a class="fancybox" rel="nofollow">
										<video id="company_video" muted playsinline controls loop autoplay><source src="<?=$videoPlayerSrc;?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"' /></video>
									</a>
								</div>
							<?endif;?>
						</div>
					</div>
				<?endif;?>
			</div>
		</div>
	</div>
<?}?>