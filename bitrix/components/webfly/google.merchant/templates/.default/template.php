<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
if ($arParams["USE_SITE"] == "Y")
    $server_name = $arParams["SITE"];
else
    $server_name = $_SERVER["SERVER_NAME"];
?>
<?
if (!$arResult["SAVE_IN_FILE"]):
    echo '<?xml version="1.0"?>';
    ?>
    <rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">
        <channel>
            <title><?= toUTF8($arResult["SITE"]) ?></title>
            <link><? if ($arParams ["HTTPS_CHECK"] == "Y"): ?><?= "https://" . $server_name ?><? else: ?><?= "http://" . $server_name ?><? endif ?></link>
            <description><?= toUTF8($arResult["COMPANY"]) ?></description>
            <? foreach ($arResult["OFFER"] as $arOffer): ?>
                <item>
                    <title><?= toUTF8($arOffer["MODEL"]) ?></title>
                    <link><?= $arOffer["URL"] ?></link>
                    <description><?= toUTF8($arOffer["DESCRIPTION"]) ?></description>
                    <g:id><?= $arOffer["ID"] ?></g:id>
                    <g:condition>new</g:condition>
                    <g:price><?= $arOffer["PRICE"] ?> <?= ($arOffer["CURRENCY"] ? $arOffer["CURRENCY"] : $arParams["CURRENCY"]) ?></g:price>
                    <?if (!empty($arOffer["OLD_PRICE"])):?>
                    <g:sale_price><?= $arOffer["OLD_PRICE"] ?> <?= ($arOffer["CURRENCY"] ? $arOffer["CURRENCY"] : $arParams["CURRENCY"]) ?></g:sale_price>
                    <?endif?>
                    <g:availability><? if ($arOffer["AVAIBLE"] == 'false'): ?>preorder<? else: ?>in stock<? endif ?></g:availability>
                    <g:image_link><?= $arOffer["PICTURE"] ?></g:image_link><? foreach ($arOffer["MORE_PHOTO"] as $image): ?>
                        <g:additional_image_link><?= $image ?></g:additional_image_link><?
                    endforeach;

                    if ($arParams["LOCAL_DELIVERY_COST"]):
                        ?>
                        <g:shipping>
                            <g:country>RU</g:country>
                            <? //				<g:service>Standard</g:service>   ?>
                            <g:price><?= $arParams["LOCAL_DELIVERY_COST"] ?></g:price>
                        </g:shipping><?
                    endif;

//			<g:gtin>8808992787426</g:gtin>
//			<g:mpn>M2262D-PC</g:mpn>

                    if ($arOffer["DISPLAY_PROPERTIES"][$arParams["DEVELOPER"]]["DISPLAY_VALUE"]):
                        ?>

                        <g:brand><?= toUTF8($arOffer["DISPLAY_PROPERTIES"][$arParams["DEVELOPER"]]["DISPLAY_VALUE"]) ?></g:brand><?
                    endif;
 
                    if ($arOffer["GTIN"]):
                        ?>

                        <g:gtin><?= toUTF8($arOffer["GTIN"]) ?></g:gtin><?
                    endif;

                    if ($arParams["MARKET_CATEGORY_CHECK"] == 'Y'):
                        ?>

                        <g:google_product_category><?= toUTF8(str_replace('/', ' &gt; ', $arOffer["MARKET_CATEGORY"])) ?></g:google_product_category><? endif
                    ?>

                    <g:product_type><?= toUTF8($arOffer["CATEGORY"]) ?></g:product_type>
                    <? if (!empty($arOffer["GROUP_ID"])): ?>
                        <g:item_group_id><?= $arOffer["GROUP_ID"] ?></g:item_group_id>
                    <? endif; ?>

                </item>
            <? endforeach ?>
        </channel>
    </rss>
    <?
else:
    if (!function_exists("itemsCycle")) {

        function itemsCycle(&$savedXML, $arResult, $arParams) {
            foreach ($arResult["OFFER"] as $arOffer):

                $savedXML .= '<item>';
                $savedXML .= '<title>' . toUTF8($arOffer["MODEL"]) . '</title>';
                $savedXML .= '<link>' . $arOffer["URL"] . '</link>';
                $savedXML .= '<description>' . toUTF8($arOffer["DESCRIPTION"]) . '</description>';
                $savedXML .= '<g:id>' . $arOffer["ID"] . '</g:id>';
                $savedXML .= '<g:condition>new</g:condition>';
                $savedXML .= '<g:price>' . $arOffer["PRICE"];
                ($arOffer["CURRENCY"] ? $savedXML .= " " . $arOffer["CURRENCY"] : $savedXML .= " " . $arParams["CURRENCY"]);
                $savedXML .= '</g:price>';
                if (!empty($arOffer["OLD_PRICE"])):
                $savedXML .= '<g:sale_price>' . $arOffer["OLD_PRICE"];
                ($arOffer["CURRENCY"] ? $savedXML .= " " . $arOffer["CURRENCY"] : $savedXML .= " " . $arParams["CURRENCY"]);
                $savedXML .= '</g:sale_price>';
                endif;
                $savedXML .= '<g:availability>';
                if ($arOffer["AVAIBLE"] == 'false')
                    $savedXML .= 'preorder';
                else
                    $savedXML .= 'in stock';
                $savedXML .= '</g:availability>';
                $savedXML .= '<g:image_link>' . $arOffer["PICTURE"] . '</g:image_link>';

                foreach ($arOffer["MORE_PHOTO"] as $image):

                    $savedXML .= '<g:additional_image_link>' . $image . '</g:additional_image_link>';

                endforeach;

                if ($arParams["LOCAL_DELIVERY_COST"]):

                    $savedXML .= '<g:shipping>';
                    $savedXML .= '<g:country>RU</g:country>';
                    $savedXML .= '<g:price>' . $arParams["LOCAL_DELIVERY_COST"] . '</g:price>';
                    $savedXML .= '</g:shipping>';
                endif;

                if ($arOffer["DISPLAY_PROPERTIES"][$arParams["DEVELOPER"]]["DISPLAY_VALUE"]):

                    $savedXML .= '<g:brand>' . toUTF8($arOffer["DISPLAY_PROPERTIES"][$arParams["DEVELOPER"]]["DISPLAY_VALUE"]) . '</g:brand>';

                endif;

                if ($arOffer["GTIN"]):

                    $savedXML .= '<g:gtin>' . toUTF8($arOffer["GTIN"]) . '</g:gtin>';

                endif;

                if ($arParams["MARKET_CATEGORY_CHECK"] == 'Y'):

                    $savedXML .= '<g:google_product_category>';
                    $savedXML .= toUTF8(str_replace('/', ' &gt; ', $arOffer["MARKET_CATEGORY"]));
                    $savedXML .= '</g:google_product_category>';

                endif;

                $savedXML .= '<g:product_type>' . toUTF8($arOffer["CATEGORY"]) . '</g:product_type>';

                if (!empty($arOffer["GROUP_ID"])):

                    $savedXML .= '<g:item_group_id>' . $arOffer["GROUP_ID"] . '</g:item_group_id>';

                endif;

                $savedXML .= '</item>';
            endforeach;
        }

    }
    if (!function_exists("xmlHeader")) {

        function xmlHeader(&$savedXML, $arResult, $arParams, $server_name) {
            $savedXML = '<?xml version="1.0"?>';
            $savedXML .= '<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">';
            $savedXML .= '<channel>';
            $savedXML .= '<title>' . toUTF8($arResult["SITE"]) . '</title>';
            $savedXML .= '<link>';
            if ($arParams ["HTTPS_CHECK"] == "Y"):
                $savedXML .= "https://" . $server_name;
            else:
                $savedXML .= "http://" . $server_name;
            endif;
            $savedXML .= '</link>';
            $savedXML .= '<description>' . toUTF8($arResult["COMPANY"]) . '</description>';
        }

    }
    $wf_page = $APPLICATION->GetCurDir();
    $permanent_file = $_SERVER["DOCUMENT_ROOT"] . $wf_page . '/saved_file.xml';
    $temp_file = $_SERVER["DOCUMENT_ROOT"] . $wf_page . '/saved_file_temp.xml';
    $arParams["BIG_CATALOG_PROP"] = trim($arParams["BIG_CATALOG_PROP"]);
    if (!empty($arParams["BIG_CATALOG_PROP"]) and $_SESSION["WFGM_FINISH"] != "Yes") {
        if ((($arResult["WF_CURR"] - $arParams["BIG_CATALOG_PROP"]) < $arResult["WF_FULL"])) {
            if ($arResult["WF_CURR"] < $arResult["WF_FULL"]) {
                if ($arResult["WF_NUM"] == 1) {
                    xmlHeader($savedXML, $arResult, $arParams, $server_name);
                    itemsCycle($savedXML, $arResult, $arParams);
                    file_put_contents("saved_file_temp.xml", $savedXML, LOCK_EX);
                }
                else {
                    if (file_exists($temp_file) and file_get_contents($temp_file, NULL, NULL, 0, 5) == "<?xml") {
                        itemsCycle($savedXML, $arResult, $arParams);
                        file_put_contents("saved_file_temp.xml", $savedXML, FILE_APPEND | LOCK_EX);
                    }
                }
                $arResult["WF_NUM"] ++;
                if ($arResult["WF_NUM"] == 21) {
                    if (file_exists($temp_file) and file_get_contents($temp_file, NULL, NULL, 0, 5) == "<?xml") {
                        $savedXML .= '</channel></rss>';
                        file_put_contents("saved_file_temp.xml", $savedXML, FILE_APPEND | LOCK_EX);
                        echo GetMessage("LOAD_FAIL");
                        $_SESSION["WFGM_FINISH"] = "Yes";
                        if (file_exists($permanent_file))
                            unlink($permanent_file);
                        rename($temp_file, $permanent_file);
                    }
                }
                else {
                    $url = $APPLICATION->GetCurPageParam("WF_PAGE={$arResult["WF_NUM"]}", array("WF_PAGE"));
                    LocalRedirect($url);
                }
            }
            else {
                if ($arResult["WF_NUM"] == 1) {
                    xmlHeader($savedXML, $arResult, $arParams, $server_name);
                    itemsCycle($savedXML, $arResult, $arParams);
                    $savedXML .= '</channel></rss>';
                    file_put_contents("saved_file_temp.xml", $savedXML, LOCK_EX);
                    echo GetMessage("FILE_SAVED_TO", array("#URL#" => $APPLICATION->GetCurDir() . "saved_file.xml"));
                    $_SESSION["WFGM_FINISH"] = "Yes";
                    if (file_exists($temp_file)) {
                        if (file_exists($permanent_file))
                            unlink($permanent_file);
                        rename($temp_file, $permanent_file);
                    }
                }
                else {
                    if (file_exists($temp_file) and file_get_contents($temp_file, NULL, NULL, 0, 5) == "<?xml") {
                        itemsCycle($savedXML, $arResult, $arParams);
                        $savedXML .= '</channel></rss>';
                        file_put_contents("saved_file_temp.xml", $savedXML, FILE_APPEND | LOCK_EX);
                        echo GetMessage("FILE_SAVED_TO", array("#URL#" => $wf_page . "saved_file.xml"));
                        $_SESSION["WFGM_FINISH"] = "Yes";
                        if (file_exists($permanent_file))
                            unlink($permanent_file);
                        rename($temp_file, $permanent_file);
                    }
                }
            }
        }
    }
    else {
        xmlHeader($savedXML, $arResult, $arParams, $server_name);
        itemsCycle($savedXML, $arResult, $arParams);
        $savedXML .= '</channel></rss>';
        file_put_contents("saved_file.xml", $savedXML, LOCK_EX);
        echo GetMessage("FILE_SAVED_TO", array("#URL#" => $APPLICATION->GetCurDir() . "saved_file.xml"));
    }

endif;

function toUTF8($str) {
    if (SITE_CHARSET == "utf-8" or SITE_CHARSET == "UTF-8")
        return $str;
    else {
        return iconv("windows-1251", "utf-8", $str);
    }
}
