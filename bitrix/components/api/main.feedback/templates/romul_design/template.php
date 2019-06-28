<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
/**
 * Bitrix vars
 *
 * @var CBitrixComponent         $component
 * @var CBitrixComponentTemplate $this
 * @var array                    $arParams
 * @var array                    $arResult
 * @var array                    $arLangMessages
 * @var array                    $templateData
 *
 * @var string                   $templateFile
 * @var string                   $templateFolder
 * @var string                   $parentTemplateFolder
 * @var string                   $templateName
 * @var string                   $componentPath
 *
 * @var CDatabase                $DB
 * @var CUser                    $USER
 * @var CMain                    $APPLICATION
 */

if (method_exists($this, 'setFrameMode')) {
    $this->setFrameMode(true);
}

$arResult['FORM_SUBMIT_VALUE'] = (strlen($arParams['FORM_SUBMIT_VALUE']) > 0) ? $arParams['FORM_SUBMIT_VALUE'] : GetMessage("MFT_SUBMIT");

if($arParams['TITLE_DISPLAY'] != 'N')
	$arResult['FORM_TITLE'] = '<h' . $arParams['FORM_TITLE_LEVEL'] . ' style="' . $arParams['FORM_STYLE_TITLE'] . '">' . $arParams['FORM_TITLE'] . '</h' . $arParams['FORM_TITLE_LEVEL'] . '>';

$tpl_class_name = 'tpl_default';

?>

<script type="text/javascript" src="/bitrix/components/api/main.feedback/js/jquery.maskedinput.min.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($){

        $('#UUID-<?= $arParams['UNIQUE_FORM_ID']; ?>').on('change keyup',function(){
            if(!$(this).length)
                $(this).val('');
        });

		<? if((count($arParams['REQUIRED_FIELDS']) && $arParams['VALIDTE_REQUIRED_FIELDS'])): ?>
			$("#<?= $arParams['UNIQUE_FORM_ID']; ?>").validateMainFeedback();
		<? endif; ?>
		<? if($arParams['INCLUDE_PRETTY_COMMENTS']): ?>
			$('#<?= $arParams['UNIQUE_FORM_ID']; ?> textarea').prettyComments();
		<? endif; ?>
		<? if($arParams['INCLUDE_FORM_STYLER']): ?>
			$('#<?= $arParams['UNIQUE_FORM_ID']; ?> input[type*="checkbox"], #<?= $arParams['UNIQUE_FORM_ID']; ?> input[type*="radio"]').styler();
		<? endif; ?>
		<? if($arParams['HIDE_FORM_AFTER_SEND'] && !empty($arResult["OK_MESSAGE"])): ?>
			$("#<?= $arParams['UNIQUE_FORM_ID']; ?>").hide();
		<? endif; ?>
		<? if($arParams['SCROLL_TO_FORM_IF_MESSAGES'] && (!empty($arResult["OK_MESSAGE"]) || !empty($arResult["ERROR_MESSAGE"]))): ?>
			$('html, body').animate({
				scrollTop: $(".api-feedback.<?=$tpl_class_name;?>").offset().top
			}, <?=$arParams['SCROLL_TO_FORM_SPEED'];?>);
		<? endif; ?>
		<? if($arParams['SHOW_CSS_MODAL_AFTER_SEND'] && !empty($arResult["OK_MESSAGE"])): ?>
			var html_css_modal = '<section class="semantic-content" id="modal-text-<?=$arParams["UNIQUE_FORM_ID"];?>" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">' +
									'<div class="modal-inner"><header><h2 id="modal-label"><?=htmlspecialcharsback(CUtil::JSEscape($arParams["CSS_MODAL_HEADER"]));?></h2></header>' +
										'<div class="modal-content"><?=htmlspecialcharsback(CUtil::JSEscape($arParams["CSS_MODAL_CONTENT"]));?></div>' +
										'<footer><p><?=htmlspecialcharsback(CUtil::JSEscape($arParams["CSS_MODAL_FOOTER"]));?></p></footer>' +
									'</div>' +
									'<a href="#!" class="modal-close" title="<?=GetMessage("CLOSE_CSS_MODAL_WINDOW")?>" data-dismiss="modal">&times;</a>' +
								'</section>';
			$('body').append(html_css_modal);

    		window.location.hash = '#modal-text-<?=$arParams['UNIQUE_FORM_ID'];?>';
		<? endif; ?>
		
		$(".tpl_default_author_personal_mobile > input").mask("99999999999", { placeholder: "_"});

		
	}); //END Ready
	
	history.pushState('', document.title, window.location.pathname);
</script>
<div class="api-feedback <?=$tpl_class_name;?>" style="<?= $arParams['FORM_STYLE'] ?>">
	<?= $arResult['FORM_TITLE'] ?>
	<?if(!empty($arResult["ERROR_MESSAGE"]))
	{
		?>
		<div class="ts-alert ts-alert-danger">
			<?= implode('<br>', $arResult["ERROR_MESSAGE"]); ?>
		</div>
	<?
	}
	if(!empty($arResult["OK_MESSAGE"]))
	{
		?>
		<div class="ts-alert ts-alert-success">
			<p><?= $arResult["OK_MESSAGE"] ?></p>
		</div>
		<?
	}
	?>
	<form
		action="<?=POST_FORM_ACTION_URI;?>"
		method="POST"
		enctype="multipart/form-data"
		class="api_feedback_form feedback"
		name="api_feedback_form"
		id="<?= $arParams['UNIQUE_FORM_ID']; ?>"
		onsubmit="location.href+='<?='#'.$arParams['ANCHOR']?>'; ga('send', 'event', 'form', 'submit', 'feedback');yaCounter<?= $_SESSION['yandex_counter']; ?>.reachGoal('feedback');">
		
		<?= bitrix_sessid_post() ?>
		<input type="hidden" name="UNIQUE_FORM_ID" value="<?= $arParams['UNIQUE_FORM_ID']; ?>" />
<!--        <span style='display: block; padding: 20px 0;'>--><?//=$arParams['FORM_DESC']?><!--</span>-->
		<? if($arParams['USE_HIDDEN_PROTECTION']): ?>
			<input type="text" class="hidden_protection" name="HIDDEN[NAME]" value="<?=$_REQUEST['HIDDEN']['NAME'];?>" />
			<input type="text" class="hidden_protection" name="HIDDEN[EMAIL]" value="<?=$_REQUEST['HIDDEN']['EMAIL'];?>" />
			<input type="text" class="hidden_protection" name="hidden_protection" value="<?=$_REQUEST['hidden_protection'];?>" />
		<? endif; ?>
		<? if(count($arParams['BRANCH_FIELDS']) && $arParams["BRANCH_ACTIVE"] == "Y"): ?>
			<div class="<?=$tpl_class_name;?>_BRANCH" style="<?= $arParams['FORM_STYLE_DIV'] ?>">
				<select name="BRANCH" id="<?=$tpl_class_name;?>_BRANCH" style="<?= $arParams['FORM_STYLE_SELECT']; ?>">
					<? foreach($arParams['BRANCH_FIELDS'] as $branchId => $arBranchFields): ?>
						<? $arBranch = explode('###', $arBranchFields); ?>
						<? if(count($arBranch)): ?>
							<option value="<?= $branchId ?>"<? if(intval($_POST["BRANCH"]) == $branchId): ?> selected="selected"<? endif ?>><?= $arBranch[0] ?></option>
						<? endif ?>
					<? endforeach ?>
				</select>
			</div>
			<? if($arParams["MSG_PRIORITY"] == "Y"): ?>
				<div class="<?=$tpl_class_name;?>_MSG_PRIORITY" style="<?= $arParams['FORM_STYLE_DIV'] ?>">
					<select name="MSG_PRIORITY" id="<?=$tpl_class_name;?>_MSG_PRIORITY" style="<?= $arParams['FORM_STYLE_SELECT']; ?>">
						<option value="5 (Lowest)"<? if($_POST['MSG_PRIORITY'] == '5 (Lowest)'): ?> selected="selected"<? endif; ?>><?= GetMessage("MSG_PRIORITY_5") ?></option>
						<option value="3 (Normal)"<? if($_POST['MSG_PRIORITY'] == '3 (Normal)'): ?> selected="selected"<? endif; ?>><?= GetMessage("MSG_PRIORITY_3") ?></option>
						<option value="1 (Highest)"<? if($_POST['MSG_PRIORITY'] == '1 (Highest)'): ?> selected="selected"<? endif; ?>><?= GetMessage("MSG_PRIORITY_1") ?></option>
					</select>
				</div>
			<? endif ?>
		<? endif ?>
		<?
		//Execute <input type="text">
		?>

		<?if(count($arParams['DISPLAY_FIELDS']) > 0)
		{
			foreach($arParams['DISPLAY_FIELDS'] as $FIELD)
			{
			    if ($FIELD == "AUTHOR_SQUARE" || $FIELD == "AUTHOR_PLACES") // это поля для площади и Рабочих мест!
			        continue;
				$field_name = !empty($arParams['USER_' . $FIELD]) ? $arParams['USER_' . $FIELD] : GetMessage('MFT_' . $FIELD);

				if($FIELD != 'AUTHOR_MESSAGE' && $FIELD != 'AUTHOR_NOTES')
				{?>
				<div class="<?=$tpl_class_name;?>_<?= ToLower($FIELD) ?>" style="<?//= $arParams['FORM_STYLE_DIV'] ?>">
					<?/*if(!$arParams['HIDE_FIELD_NAME']):?>
					<label style="<?= $arParams['FORM_STYLE_LABEL'] ?>"><?= $field_name ?>:
						<? if(empty($arParams["REQUIRED_FIELDS"]) || in_array($FIELD, $arParams["REQUIRED_FIELDS"])): ?>
							<span class="asterisk"> *</span>
						<? endif ?>
					</label>
					<?endif;*/?>
					<?if ( $FIELD != 'AUTHOR_CITY' || $arParams['AUTHOR_CITY_IS_LIST'] != true) {
						$label = $field_name.((empty($arParams["REQUIRED_FIELDS"]) || in_array($FIELD, $arParams["REQUIRED_FIELDS"]))? ' *': '');
						?>
						<input id="<?=$tpl_class_name;?>_<?= ToLower($FIELD) ?>" style="<?//= $arParams['FORM_STYLE_INPUT'] ?>" type="text" value="<?=$arResult[$FIELD]?>"
							placeholder="<?=$label?>" name="<?= ToLower($FIELD) ?>"
						<?/* if($arParams['INCLUDE_PLACEHOLDER']):?> placeholder="<?= $field_name ?>" <?endif*/?>
						<? if(empty($arParams["REQUIRED_FIELDS"]) || in_array($FIELD, $arParams["REQUIRED_FIELDS"])): ?> class="required"<? endif ?> />

					<?} else {?>
						<div class="author_city_list__wrap_input">
							<select name="<?=ToLower($FIELD)?>" onchange="this.style.color='#000';" id="author_city_list">
								<option <?=(!$arResult["AUTHOR_CITY"])?'selected="selected"':''?> disabled><?=$field_name.((empty($arParams["REQUIRED_FIELDS"]) || in_array($FIELD, $arParams["REQUIRED_FIELDS"]))? ' *': '')?></option>
								<?foreach ( $arParams['AUTHOR_CITY_LIST'] as $k=>$v) {?>
									<option value="<?=$k?>" <?=($k == $arResult["AUTHOR_CITY"])?'selected="selected"':''?>><?=$k?></option>
								<?}?>
							</select>
						</div>
						<div class="hint"><?=GetMessage('MFT_AUTHOR_CHOOSE_NEAREST')?></div>
					<?}?>
				</div>
				<?
				}
			}
			unset($FIELD);
		}
		?>
        <div class="tpl_default_author_square">
                <input id="tpl_default_author_square" style="" value="<?=$arResult["AUTHOR_SQUARE"]?>" placeholder="Площадь объекта" name="author_square" type="text">
         </div>

         <div class="tpl_default_author_places">
            <input id="tpl_default_author_places" style="" value="<?=$arResult["AUTHOR_PLACES"]?>" placeholder="Кол-во раб. мест" name="author_places" type="text">
         </div>

		<?if(!empty($arParams['CUSTOM_FIELDS'])):?>
			<?foreach($arParams['CUSTOM_FIELDS'] as $fk => $FIELD)
			{
				$arFields = explode('@', $FIELD);
				$optgroup = false; //Have groups in <select>
				$arGroup  = array();

				switch($arFields[1])
				{
					case "select":
						$arrExp   = $values = array();
						$size     = '';
						$multiple = in_array("multiple", $arFields) ? ' multiple="multiple"' : false;
						foreach($arFields as $arField)
						{
							if(substr($arField, 0, 4) == "size")
							{
								$arrExp = explode("=", $arField);
								$size   = ' size="' . $arrExp[1] . '"';
							}

							if(substr($arField, 0, 6) == "values")
							{
								if(strpos($arField, '##') === false)
									$values = explode("#", substr($arField, 7));
								else
								{
									$optgroup = true;
									$values   = explode("##", substr($arField, 7));
								}
							}
						}
						?>
						<div class="<?=$tpl_class_name;?>_<?= ToLower('CUSTOM_FIELD_' . $fk) ?>" style="<?= $arParams['FORM_STYLE_DIV'] ?>">
							<?if(!$arParams['HIDE_FIELD_NAME']):?>
							<?endif;?>
							<select name="CUSTOM_FIELDS[<?= $fk ?>][]" id="<?=$tpl_class_name;?>_<?= ToLower('CUSTOM_FIELD_' . $fk) ?>"
								<?= $multiple ?><?= $size ?> style="<?= $arParams['FORM_STYLE_SELECT']; ?>"
								<? if(in_array("required", $arFields)): ?> class="required" <? endif ?>>
								<?
								if ($optgroup)
								{
									foreach ($values as $k2 => $v2)
									{
										if (strpos($v2, '#') === false)
										{
											?><optgroup label="<?= $v2; ?>"><?
										}
										else
										{
											$arValues    = explode('#', $v2);
											$arValuesCnt = count($arValues);
											$l           = 0;
											foreach($arValues as $val)
											{
												$l++;
												?>
												<option<? if(strpos($arResult["CUSTOM_FIELD_" . $fk], $val) !== false): ?> selected<? endif; ?> value="<?= $val; ?>"><?= $val; ?></option><?
												if($arValuesCnt == $l)
													echo '</optgroup>';
											}
										}
									}
								}
								else
								{
									foreach($values as $k1 => $v)
									{
										?><option<? if(strpos($arResult["CUSTOM_FIELD_" . $fk], $v) !== false): ?> selected<? endif; ?> value="<?= $v ?>"><?= $v ?></option><?
									}
								}
								?>
							</select>
						</div><?
					break;

					//v1.2.9
					case "input":
						if($arFields[2]=="checkbox")
                        {
	                        $values = array();//����������� ������
	                        foreach($arFields as $arField)
	                        {
		                        if(substr($arField,0,6)=="values")
		                        {
			                        $values = explode("#",substr($arField,7));
		                        }
	                        }
	                        ?>
	                        <div class="<?=$tpl_class_name;?>_<?= ToLower('CUSTOM_FIELD_' . $fk) ?>" style="<?= $arParams['FORM_STYLE_DIV'] ?>">
	                            <?if(!$arParams['HIDE_FIELD_NAME']):?>
	                            <?endif;?>
		                        <div style="<?= $arParams['FORM_STYLE_INPUT'] ?>" class="option-qroup<? if(in_array("required", $arFields)): ?> required<? endif ?>">
			                        <?foreach($values as $k2=>$v):?>
				                        <label for="<?= $arParams['UNIQUE_FORM_ID']; ?>_FIELD_<?=$fk?>_<?=$k2?>">
					                        <input
						                        id="<?= $arParams['UNIQUE_FORM_ID']; ?>_FIELD_<?=$fk?>_<?=$k2?>"
						                        type="<?=$arFields[2]?>"
						                        name="CUSTOM_FIELDS[<?= $fk ?>][]"
						                        value="<?=$v?>"
						                        <? if(strpos($arResult["CUSTOM_FIELD_" . $fk], $v) !== false): ?> checked="checked"<?endif?>>
					                        <?=$v?>
				                        </label><br/>
			                        <?endforeach?>
		                        </div>
	                        </div>
	                    <?
	                    }
	                    elseif($arFields[2]=="radio")
	                    {
	                        $values = array();//����������� ������
	                        foreach($arFields as $arField)
	                        {
		                        if(substr($arField,0,6)=="values")
		                        {
			                        $values = explode("#",substr($arField,7));
		                        }
	                        }
	                        ?>
	                        <div class="<?=$tpl_class_name;?>_<?= ToLower('CUSTOM_FIELD_' . $fk) ?>" style="<?= $arParams['FORM_STYLE_DIV'] ?>">
		                        <?if(!$arParams['HIDE_FIELD_NAME']):?>
		                        <?endif;?>
		                        <div style="<?= $arParams['FORM_STYLE_INPUT'] ?>" class="option-qroup<? if(in_array("required", $arFields)): ?> required<? endif ?>">
			                        <?foreach($values as $k3=>$v):?>
				                        <label for="<?= $arParams['UNIQUE_FORM_ID']; ?>_FIELD_<?=$fk?>_<?=$k3?>">
					                        <input id="<?= $arParams['UNIQUE_FORM_ID']; ?>_FIELD_<?=$fk?>_<?=$k3?>"
					                               type="<?=$arFields[2]?>"
					                               name="CUSTOM_FIELDS[<?= $fk ?>][]"
					                               value="<?=$v?>"
						                            <? if($arResult["CUSTOM_FIELD_" . $fk] == $v): ?> checked="checked"<?endif?>>
					                        <?=$v?>
				                        </label><br/>
			                        <?endforeach?>
		                        </div>
	                        </div>
	                    <?
	                    }
						elseif($arFields[2]=="date")
						{
							$values = array();//����������� ������
							$bDateMultiple = false;
							foreach($arFields as $arField)
							{
								if(substr($arField, 0, 4) == "size")
								{
									$arrExp = explode("=", $arField);
									if(intval($arrExp[1]) >=2)
										$bDateMultiple = true;
								}

								if(substr($arField,0,6)=="values")
								{
									$values = explode("#",substr($arField,7));
								}

								$arResultDateValues = explode(':~:',$arResult["CUSTOM_FIELD_".$fk]);
							}
							?>
							<div class="<?=$tpl_class_name;?>_<?= ToLower('CUSTOM_FIELD_' . $fk) ?> date-group" style="<?= $arParams['FORM_STYLE_DIV'] ?>">
								<?if(!$arParams['HIDE_FIELD_NAME']):?>

								<?endif;?>
								<input type="text"
								       id="<?= $arParams['UNIQUE_FORM_ID']; ?>_FIELD_<?=$fk?>_1"
								       name="CUSTOM_FIELDS[<?=$fk?>][]"
								       value="<?=$arResultDateValues[0]?>"
								       style="<?= $arParams['FORM_STYLE_INPUT'] ?>"
									<?if($arParams['INCLUDE_PLACEHOLDER']):?> placeholder="<?=date('d.m.Y');?>" <?endif?>
									<? if(in_array("required", $arFields)): ?> class="required"<? endif ?>>
									<?$APPLICATION->IncludeComponent(
										"bitrix:main.calendar",
										"",
										Array(
											"SHOW_INPUT" => "N",
											"FORM_NAME" => "api_feedback_form",
											"INPUT_NAME" => $arParams['UNIQUE_FORM_ID'] ."_FIELD_". $fk ."_1",
											"INPUT_NAME_FINISH" => "",
											"INPUT_VALUE" => "",
											"INPUT_VALUE_FINISH" => "",
											"SHOW_TIME" => "N",
											"HIDE_TIMEBAR" => "Y"
										),
										null,
										Array(
											'HIDE_ICONS' => 'Y'
										)
									);?>
								<?if($bDateMultiple):?>
									<input type="text"
									       id="<?= $arParams['UNIQUE_FORM_ID']; ?>_FIELD_<?=$fk?>_2"
									       name="CUSTOM_FIELDS[<?=$fk?>][]"
									       value="<?=$arResultDateValues[1]?>"
									       style="<?= $arParams['FORM_STYLE_INPUT'] ?>"
										<?if($arParams['INCLUDE_PLACEHOLDER']):?> placeholder="<?=date('d.m.Y');?>" <?endif?>
										<? if(in_array("required", $arFields)): ?> class="required"<? endif ?>>
									<?$APPLICATION->IncludeComponent(
										"bitrix:main.calendar",
										"",
										Array(
											"SHOW_INPUT" => "N",
											"FORM_NAME" => "api_feedback_form",
											"INPUT_NAME" => $arParams['UNIQUE_FORM_ID'] ."_FIELD_". $fk ."_2",
											"INPUT_NAME_FINISH" => "",
											"INPUT_VALUE" => "",
											"INPUT_VALUE_FINISH" => "",
											"SHOW_TIME" => "N",
											"HIDE_TIMEBAR" => "Y"
										),
										null,
										Array(
											'HIDE_ICONS' => 'Y'
										)
									);?>
								<?endif;?>
							</div>
						<?
						}
                        elseif($arFields[2]=="coupon")
                        {
                            $button_value = '';
                            foreach($arFields as $arField)
                            {
                                if(substr($arField, 0, 12) == "button_value")
                                {
                                    $button_value = str_replace('button_value=','',$arField);
                                }
                            }
                            ?>
                            <div class="<?=$tpl_class_name;?>_<?= ToLower('CUSTOM_FIELD_' . $fk) ?>" style="<?= $arParams['FORM_STYLE_DIV'] ?>">
                                <?if(!$arParams['HIDE_FIELD_NAME']):?>

                                <?endif;?>
                                <input type="text"
                                       readonly=""
                                       id="UUID-<?= $arParams['UNIQUE_FORM_ID']; ?>"
                                       name="CUSTOM_FIELDS[<?=$fk?>][]"
                                       value="<?=$arResult["CUSTOM_FIELD_".$fk]?>"
                                       style="<?= $arParams['FORM_STYLE_INPUT'] ?>"
                                    <?if($arParams['INCLUDE_PLACEHOLDER']):?> placeholder="<?= $arFields[0] ?>" <?endif?>
                                    <? if(in_array("required", $arFields)): ?> class="required"<? endif ?>>
                                <?if(!$arResult["CUSTOM_FIELD_".$fk]):?>
                                    <?if($button_value && $arResult['UUID']):?>
                                        <button type="button" onclick="$('#UUID-<?= $arParams['UNIQUE_FORM_ID']; ?>').val('<?=$arResult['UUID'];?>'); $(this).detach();" class="api-btn"><?=$button_value;?></button>
                                    <?endif;?>
                                <?endif;?>
                            </div>
                        <?}
	                    else
	                    {?>
	                        <div class="<?=$tpl_class_name;?>_<?= ToLower('CUSTOM_FIELD_' . $fk) ?>" style="<?= $arParams['FORM_STYLE_DIV'] ?>">
		                        <?if(!$arParams['HIDE_FIELD_NAME']):?>
		                        <
		                        <?endif;?>
		                        <input type="<?=$arFields[2]=='email' ? 'text' : $arFields[2];?>"
		                               name="CUSTOM_FIELDS[<?=$fk?>][]"
		                               value="<?=$arResult["CUSTOM_FIELD_".$fk]?>"
		                               style="<?= $arParams['FORM_STYLE_INPUT'] ?>"
			                            <?if($arParams['INCLUDE_PLACEHOLDER']):?> placeholder="<?= $arFields[0] ?>" <?endif?>
			                            <? if(in_array("required", $arFields)): ?> class="required"<? endif ?>>
	                        </div>
	                    <?}
                    break;

					case "textarea":
						?>
						<div class="<?=$tpl_class_name;?>_<?= ToLower('CUSTOM_FIELD_' . $fk) ?>" style="<?= $arParams['FORM_STYLE_DIV'] ?>">
							<?if(!$arParams['HIDE_FIELD_NAME']):?>

							<?endif;?>
							<textarea name="CUSTOM_FIELDS[<?=$fk?>][]"
							          style="<?= $arParams['FORM_STYLE_TEXTAREA'] ?>"
									  <?if($arParams['INCLUDE_PLACEHOLDER']):?> placeholder="<?= $arFields[0] ?>" <?endif?>
									  <? if(in_array("required", $arFields)): ?> class="required"<? endif ?>><?=$arResult["CUSTOM_FIELD_".$fk]?></textarea>
						</div>
						<?
					break;
					//\\v1.2.9
				}
			}
			?>
		<? endif; ?>
		<?
		//Execute <textarea>
		if(count($arParams['DISPLAY_FIELDS']) > 0)
		{
			foreach($arParams['DISPLAY_FIELDS'] as $FIELD)
			{
				$field_name = !empty($arParams['USER_' . $FIELD]) ? $arParams['USER_' . $FIELD] : GetMessage('MFT_' . $FIELD);

				if($FIELD == 'AUTHOR_MESSAGE' || $FIELD == 'AUTHOR_NOTES')
				{?>
				<div class="<?=$tpl_class_name;?>_<?= ToLower($FIELD) ?>" style="<?//= $arParams['FORM_STYLE_DIV'] ?>">
					<?/*if(!$arParams['HIDE_FIELD_NAME']):?>
					<label style="<?= $arParams['FORM_STYLE_LABEL'] ?>"><?= $field_name ?>:
						<? if(empty($arParams["REQUIRED_FIELDS"]) || in_array($FIELD, $arParams["REQUIRED_FIELDS"])): ?>
							<span class="asterisk"> *</span>
						<? endif ?>
					</label>
					<?endif;*/?>
					<textarea style="<?//=$arParams['FORM_STYLE_TEXTAREA'] ?>" <?if($arParams['INCLUDE_PLACEHOLDER']):?>
						placeholder="Комментарий" <?endif?>
						<?/*placeholder="<?=$field_name.((empty($arParams["REQUIRED_FIELDS"]) || in_array($FIELD, $arParams["REQUIRED_FIELDS"]))? ' *': '')?>" <?endif*/?>
					  name="<?= ToLower($FIELD) ?>"
						<? if(empty($arParams["REQUIRED_FIELDS"]) || in_array($FIELD, $arParams["REQUIRED_FIELDS"])): ?> class="required"<? endif ?>><?=$arResult[$FIELD]?></textarea>
				</div>
				<?
				}
			}
			unset($FIELD);
		}
		?>
		<? if($arParams['SHOW_FILES']): ?>
			<div class="<?=$tpl_class_name;?>_<?= ToLower('UPLOAD_FILES'); ?>" style="<?= $arParams['FORM_STYLE_DIV'] ?>">
				<? for($i = 0; $i < $arParams['COUNT_INPUT_FILE']; $i++): ?>
					<div class="api-file-string">
						<?if(!$arParams['HIDE_FIELD_NAME']):?>
						<label style="<?= $arParams['FORM_STYLE_LABEL'] ?>"><?= $arParams['FILE_DESCRIPTION'][$i]; ?></label>
						<?endif;?>
						<div class="api-file-wrap">
							<span class="api-btn api-btn-small" onclick="$('#<?=$tpl_class_name;?>_finput_<?= $i ?>').click()"><?= GetMessage('MSG_SELECT_FILE') ?></span>
							<span class="api-file-name" id="<?=$tpl_class_name;?>_fname_<?= $i ?>"><?= GetMessage('MSG_FILE_NOT_SELECT') ?></span>
							<input type="file"
							       name="UPLOAD_FILES[]"
							       id="<?=$tpl_class_name;?>_finput_<?= $i ?>"
							       onchange="$('#<?=$tpl_class_name;?>_fname_<?= $i ?>').text(this.value);"
								<?if($arParams['SET_ATTACHMENT_REQUIRED']):?> class="required"<?endif;?>>
						</div>
					</div>
				<? endfor; ?>
				<?if($arParams['SHOW_ATTACHMENT_EXTENSIONS']):?>
					<div class="api-file-string">
						<?if(!$arParams['HIDE_FIELD_NAME']):?>

						<?endif;?>
						<div class="api-file-wrap api-file-ext"><?=$arParams['FILE_EXTENSIONS'];?></div>
					</div>
				<?endif;?>
			</div>
		<? endif; ?>
		<? if($arParams['USE_CAPTCHA']): ?>
			<div class="mf-captcha">
				<?if(!$arParams['HIDE_FIELD_NAME']):?>

				<?endif;?>
				<div class="mf-captcha-wrap"> 
					<input type="hidden" name="captcha_sid" value="<?= $arResult['capCode'] ?>">
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult['capCode'] ?>" width="180" height="40" alt="CAPTCHA">
					<div class="mf-text"><?= GetMessage('MFT_CAPTCHA_CODE') ?> <span class="asterisk">*</span></div>
					<input type="text" name="captcha_word" size="30" maxlength="45" value="" class="required" autocomplete="off">
				</div>
			</div>
		<? endif; ?>
		<div class="api-submit" style='text-align: center;'>
            <input type="submit2" name="submit2" class="<?=$arParams['FORM_SUBMIT_CLASS'];?>2" id="<?=$arParams['FORM_SUBMIT_ID'];?>2" value="<?=$arResult['FORM_SUBMIT_VALUE'];?>">
		</div>
	</form>
</div>
