<?global $USER;?>
<div id="wrap_ajax_auth" class="form">
		<div class="form_head">
			<h2><?=!$USER->IsAuthorized()?\Bitrix\Main\Localization\Loc::getMessage('AUTH_AUTHORIZE'):\Bitrix\Main\Localization\Loc::getMessage('AUTH_ACCESS_RESTRICTED')?></h2>
</div>
    <div style="color:red"><?if(!$USER->IsAuthorized()):?><?=\Bitrix\Main\Localization\Loc::getMessage('AUTH_ONLY_FOR_ARCHITECT_NOT_AUTHORIZE');?><?else:?>
            <?=\Bitrix\Main\Localization\Loc::getMessage('AUTH_ONLY_FOR_ARCHITECT_AUTHORIZE');?>
    <?endif;?></div>
<?
global $USER;
if(!$USER->IsAuthorized()){
//x5 20190702 подключаю компонент, который используется в попап, чтобы не плодить лишние шаблоны
$APPLICATION->IncludeComponent(
    "bitrix:system.auth.form",
    "main",
    Array(
        "REGISTER_URL" => SITE_DIR."auth/registration/?register=yes",
        "PROFILE_URL" => SITE_DIR."auth/",
        "FORGOT_PASSWORD_URL" => SITE_DIR."auth/forgot-password/?forgot-password=yes",
        "AUTH_URL" => SITE_DIR."auth/",
        "SHOW_ERRORS" => "Y",
        "POPUP_AUTH" => "N",
        "AJAX_MODE" => "Y",
        "BACKURL" => ((isset($arResult["BACKURL"]) && $arResult["BACKURL"]) ? $arResult["BACKURL"] : ""),
        "CUSTOM_ITS_NOT_FROM_POPUP" => "Y"
    )
);
} else { ?>

    <div class="wrap_md1">
        <div class="main_info_block form">
            <div class="form-wr form-body">
                <form id="" name="" method="post" target="_top" action="">

                    <div class="row" data-sid="USER_LOGIN_POPUP">
                        <div class="form-group animated-labels input-filed">
                            <div class="col-md-12">
                                <label for="USER_EMAIL">Email <span class="required-star">*</span></label>
                                <div class="input">
                                    <input type="text" name="USER_EMAIL" id="USER_EMAIL_POPUP" class="form-control required" maxlength="50" value="<?=$USER->GetEmail()?>" autocomplete="on" tabindex="1"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="but-r">
                        <div class="filter block">
                            <div class="prompt remember pull-left">
                                <input type="checkbox" id="I_AM_ARCHITECT" name="USER_REMEMBER" value="Y" tabindex="5"/>
                                <label for="I_AM_ARCHITECT" title="Я архитектор" tabindex="5" style="padding-left:25px;">Я архитектор</label>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="buttons clearfix">
                            <button type="submit" class="btn btn-default bold" name="zayavka" value="" tabindex="4">
                                <span>Подать заявку</span>
                            </button>
                        </div>
                    </div>
                    <div style="padding:10px 0">
                        Отправляя заявку Вы даете согласие на обработку персональных данных и получение информационной рассылки
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?}?>
</div>