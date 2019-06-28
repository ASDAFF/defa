<?php
// Autofill second articul field in offer form
?>
<script>
    document.getElementsByTagName("body")[0].addEventListener("DOMSubtreeModified", function() {
        var articulElement = document.getElementById("tr_PROPERTY_57");
        var articulInput;
        var materialElement = document.getElementById("tr_PROPERTY_58");
        var materialSelect;
        var materialOptions;

        if (!!articulElement) {
            articulInput = articulElement.getElementsByTagName("input")[0];
        }
        if (!!materialElement) {
            materialSelect = materialElement.getElementsByTagName("select")[0];

            if (materialElement.hasAttribute("already")) {

                return;
            }
        }
        if (!!materialSelect) {
            materialOptions = materialSelect.getElementsByTagName("option");
        }

        if (!!articulElement && !!materialOptions) {
            articulInput.addEventListener("keyup", function () {
                for (var i = 0; i < materialOptions.length; ++i) {
                    if (materialOptions[i].hasAttribute("selected")) {
                        materialOptions[i].removeAttribute("selected");
                    }
                }
                for (var i = 0; i < materialOptions.length; ++i) {
                    if (materialOptions[i].value === articulInput.value) {
                        materialOptions[i].setAttribute("selected", "selected");

                        break;
                    }
                }
            });

            materialElement.setAttribute("already", "true");
        }
    });
</script>

<script>
    document.getElementsByTagName("body")[0].addEventListener("DOMSubtreeModified", function() {
        var articulElement = document.getElementById("tr_PROPERTY_226");
        var articulInput;
        var materialElement = document.getElementById("tr_PROPERTY_227");
        var materialSelect;
        var materialOptions;

        if (!!articulElement) {
            articulInput = articulElement.getElementsByTagName("input")[0];
        }
        if (!!materialElement) {
            materialSelect = materialElement.getElementsByTagName("select")[0];

            if (materialElement.hasAttribute("already")) {

                return;
            }
        }
        if (!!materialSelect) {
            materialOptions = materialSelect.getElementsByTagName("option");
        }

        if (!!articulElement && !!materialOptions) {
            articulInput.addEventListener("keyup", function () {
                for (var i = 0; i < materialOptions.length; ++i) {
                    if (materialOptions[i].hasAttribute("selected")) {
                        materialOptions[i].removeAttribute("selected");
                    }
                }
                for (var i = 0; i < materialOptions.length; ++i) {
                    if (materialOptions[i].value === articulInput.value) {
                        materialOptions[i].setAttribute("selected", "selected");

                        break;
                    }
                }
            });

            materialElement.setAttribute("already", "true");
        }
    });
</script>

<?php
// Autoupdate order list
?>
<div id="custom__update-status"
     style="position: fixed; bottom: 0; left: 0; right: 0; z-index: 9999; height: 20px; opacity: .3; pointer-events: none;">
</div>

<script>
    document.addEventListener("DOMContentLoaded", function (event) {
        if (typeof tbl_sale_order !== "undefined") {
            var i = 0;
            var interval = 1000;
            var timeout = 60000;
            var steps = timeout / interval;
            var customUpdateStatus = document.getElementById("custom__update-status");

            setInterval(function () {
                var percentage = interval * i++ / timeout * 100;
                customUpdateStatus.style.backgroundImage =
                    "linear-gradient(to right, #0f0 0%, #0f0 "+percentage+"%, #fff "+percentage+"%, #fff 100%)";
                if (i === steps) {
                    i = 0;

                    var admSelect = document.getElementById("tbl_sale_order_result_div")
                        .getElementsByClassName('adm-navigation')[0]
                        .getElementsByClassName('adm-select')[0];

                    if (admSelect[admSelect.selectedIndex].value === '0') {
                        tbl_sale_order.GetAdminList(
                            '/bitrix/admin/sale_order.php?PAGEN_1=1&SHOWALL_1=1&lang=ru&mode=list&table_id=tbl_sale_order'
                        );
                    } else {
                        tbl_sale_order.GetAdminList(
                            '/bitrix/admin/sale_order.php?PAGEN_1=1&SHOWALL_1=0&SIZEN_1='
                            + admSelect[admSelect.selectedIndex].value + '&lang=ru&mode=list&table_id=tbl_sale_order');
                    }
                }
            }, interval);
        }
    });
</script>

<?php
// Add copy function for highload block (tbl_eshop_pattern_reference)
?>
<script>
    function addCopyFunction(event) {
        var eshopPatternReferenceTable = document.getElementById("tbl_eshop_pattern_reference");
        if (!eshopPatternReferenceTable) {

            return;
        }

        var eshopPatternReferenceRows = eshopPatternReferenceTable.getElementsByClassName("adm-list-table-row");
        for (var rowIndex = 0; rowIndex < eshopPatternReferenceRows.length; ++rowIndex) {
            //Probe one
            var row = eshopPatternReferenceRows[rowIndex];
            var rowOnconText = row.oncontextmenu.toString().match(/^[^{]*{([\s\S]*)}$/m)[1];
            rowOnconText = rowOnconText.replace("return", "");
            var rowOnconArray = eval(rowOnconText);

            // domsubtreemodified go off many times
            if (rowOnconArray.length > 3) {

                continue;
            }
            /*var isAlready = false;
            for (var i = 0; i < rowOnconArray.length; ++i) {
                if (rowOnconArray[i].GLOBAL_ICON === "adm-menu-copy") {
                    var redirectParts = rowOnconArray[i].ONCLICK.split("'");
                    var redirectPath = redirectParts[1];
                    if (redirectPath.valueOf("/local/") >= 0) {
                        isAlready = true;

                        break;
                    }
                }
            }
            if (isAlready) {

                continue;
            }*/
            //

            // get element (from table) id
            var id = -1;
            for (var i = 0; i < rowOnconArray.length; ++i) {
                if (rowOnconArray[i].GLOBAL_ICON === "adm-menu-edit") {
                    var redirectParts = rowOnconArray[i].ONCLICK.split("'");
                    var redirectPath = redirectParts[1];
                    var redirectArgumentsString = redirectPath.slice(redirectPath.indexOf("?") + 1);
                    var redirectArguments = redirectArgumentsString.split("&");
                    var redirectArgumentsValues = {};
                    for (var j = 0; j < redirectArguments.length; ++j) {
                        var keyValueArray = redirectArguments[j].split("=");
                        redirectArgumentsValues[keyValueArray[0]] = keyValueArray[1];
                    }

                    id = redirectArgumentsValues.ID;

                    break;
                }
            }

            rowOnconArray.splice(1, 0,
                {'SEPARATOR': true},
                {
                    'GLOBAL_ICON': 'adm-menu-copy',
                    'TEXT': 'Копировать (defo)',
                    'ONCLICK': 'BX.adminPanel.Redirect([],' +
                    '\'/local/admin/highloadblock_row_edit.php?ENTITY_ID=3&lang=ru&ID=' + id +
                    '&action=copy&<?=bitrix_sessid_get()?>\', event);'
                },
                {'SEPARATOR': true}
            );

            rowOnconText = JSON.stringify(rowOnconArray);
            row.oncontextmenu = new Function("event", "return " + rowOnconText);
        }
    }


    document.addEventListener("DOMContentLoaded", function(event) {
        var uri = location.href;
        if (uri.indexOf("highloadblock_rows_list.php") > 0) {
            var resultDiv = document.getElementById("tbl_eshop_pattern_reference_result_div");
            resultDiv.addEventListener("DOMSubtreeModified", function (event) {
                addCopyFunction(event);
            });
        }
    });
</script>
