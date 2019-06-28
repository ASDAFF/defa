<?
define("STOP_STATISTICS", true);
define("PUBLIC_AJAX_MODE", true);

require_once($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
header('Content-Type: application/json; charset=' . LANG_CHARSET);

IncludeModuleLangFile(__FILE__);

$arResult = array();

if (\Bitrix\Main\Loader::includeModule('sale'))
	{
		if ((!empty($_REQUEST["city"]) && is_string($_REQUEST["city"])) || (!empty($_REQUEST["region"]) && is_string($_REQUEST["region"])) || (!empty($_REQUEST["country"]) && is_string($_REQUEST["country"])))
			{

				$city = $APPLICATION->UnJSEscape($_REQUEST["city"]);
				$region = $APPLICATION->UnJSEscape($_REQUEST["region"]);
				$country = $APPLICATION->UnJSEscape($_REQUEST["country"]);


				$arParams = array();
				$params = explode(",", $_REQUEST["params"]);
				foreach ($params as $param)
					{
						list($key, $val) = explode(":", $param);
						$arParams[$key] = $val;
					}

				if (CSaleLocation::isLocationProEnabled())
					{
						$cityType = \Bitrix\Sale\Location\TypeTable::getList(array('filter' => array('=CODE' => 'CITY'), 'select' => array('ID')))->fetch();

						$res = \Bitrix\Sale\Location\LocationTable::getList(array(
							'filter' => array(
								'NAME.NAME' => $city . "%",
								'TYPE_ID' => $cityType,
								'=PARENTS.NAME.LANGUAGE_ID' => LANGUAGE_ID,
								'PARENTS.NAME.NAME' => $region . "%",
							),
							'select' => array(
								"*",
								'ID' => 'ID',
								'CODE' => 'CODE',
								'CITY_NAME' => 'NAME.NAME',
								'I_ID' => 'PARENTS.ID',
								'I_NAME_RU' => 'PARENTS.NAME.NAME',
							),
							'order' => array(
								'PARENTS.DEPTH_LEVEL' => 'DESC'
							)
						));
						if ($item = $res->fetch())
							{ 
								$arResult = array(
									"ID" => $item["ID"],
									"CODE" => $item["CODE"],
									"NAME" => $item["CITY_NAME"],
									"REGION_NAME" => $item["I_NAME_RU"],
									"REGION_ID" => $item["I_ID"],

								);
							}
						else
							{
								$res = \Bitrix\Sale\Location\LocationTable::getList(array(
									'filter' => array(
										'NAME.NAME' => $city . "%",
										'TYPE_ID' => $cityType,
										'=PARENTS.NAME.LANGUAGE_ID' => LANGUAGE_ID,
									),
									'select' => array(
										"*",
										'ID' => 'ID',
										'CODE' => 'CODE',
										'CITY_NAME' => 'NAME.NAME',
										'I_ID' => 'PARENTS.ID',
										'I_NAME_RU' => 'PARENTS.NAME.NAME',
									),
									'order' => array(
										'PARENTS.DEPTH_LEVEL' => 'DESC'
									)
								));
								if ($item = $res->fetch())
									{
										$arResult = array(
											"ID" => $item["ID"],
											"CODE" => $item["CODE"],
											"NAME" => $item["CITY_NAME"],
											"REGION_NAME" => $item["I_NAME_RU"],
											"REGION_ID" => $item["I_ID"],

										);
										}
							}
					}
				else
					{
						$filter["~CITY_NAME"] = $city . "%";
						$filter["~COUNTRY_NAME"] = $country . "%";
						$filter["~REGION_NAME"] = $region . "%";
						$filter["LID"] = LANGUAGE_ID;


						$rsLocationsList = CSaleLocation::GetList(array(
							"CITY_NAME_LANG" => "ASC",
							"COUNTRY_NAME_LANG" => "ASC",
							"SORT" => "ASC",
						), $filter, false, array("nTopCount" => 10), array(
							"CODE",
							"ID",
							"CITY_ID",
							"CITY_NAME",
							"COUNTRY_NAME_LANG",
							"REGION_NAME_LANG",
							"COUNTRY_ID",
							"REGION_ID"
						));
						while ($arCity = $rsLocationsList->GetNext())
							{
								$arResult = array(
									"ID" => $arCity["ID"],
									"CODE" => $arCity["CODE"],
									"NAME" => $arCity["CITY_NAME"],
									"REGION_NAME" => $arCity["REGION_NAME_LANG"],
									"REGION_ID" => $arCity["REGION_ID"],
									"COUNTRY_NAME" => $arCity["COUNTRY_NAME_LANG"],
									"COUNTRY_ID" => $arCity["COUNTRY_ID"],
								);

							}
						if (sizeof($arResult) == 0)
							{
								// ��� ������� ������������ ��������, ����� ����� ����������� ��� ��������
								if ($region == GetMessage("GORILLAS_SUGGESTIONS_MOSKVA"))
									{
										$filter["~REGION_NAME"] = GetMessage("GORILLAS_SUGGESTIONS_MOSKOVSKAA");
									}
								if ($region == GetMessage("GORILLAS_SUGGESTIONS_SANKT_PETERBURG"))
									{
										$filter["~REGION_NAME"] = GetMessage("GORILLAS_SUGGESTIONS_LENINGRADSKAA");
									}
								if ($region == GetMessage("GORILLAS_SUGGESTIONS_SEVASTOPOLQ"))
									{
										$filter["~REGION_NAME"] = GetMessage("GORILLAS_SUGGESTIONS_KRYM");
									}
								if ($region == GetMessage("GORILLAS_SUGGESTIONS_BAYKONUR"))
									{
										unset($filter["~REGION_NAME"]);
										$filter["~COUNTRY_NAME"] = GetMessage("GORILLAS_SUGGESTIONS_KAZAHSTAN");
									}

								$filter["~CITY_NAME"] = $city . "%";
								$filter["LID"] = LANGUAGE_ID;


								$rsLocationsList = CSaleLocation::GetList(array(
									"CITY_NAME_LANG" => "ASC",
									"COUNTRY_NAME_LANG" => "ASC",
									"SORT" => "ASC",
								), $filter, false, array("nTopCount" => 10), array(
									"CODE",
									"CITY_ID",
									"CITY_NAME",
									"COUNTRY_NAME_LANG",
									"REGION_NAME_LANG",
									"COUNTRY_ID",
									"REGION_ID"
								));
								while ($arCity = $rsLocationsList->GetNext())
									{
										$arResult = array(
											"ID" => $arCity["ID"],
											"CODE" => $arCity["CODE"],
											"NAME" => $arCity["CITY_NAME"],
											"REGION_NAME" => $arCity["REGION_NAME_LANG"],
											"REGION_ID" => $arCity["REGION_ID"],
											"COUNTRY_NAME" => $arCity["COUNTRY_NAME_LANG"],
											"COUNTRY_ID" => $arCity["COUNTRY_ID"],
										);

									}

							}
					}
			}
	}

echo json_encode($arResult);
