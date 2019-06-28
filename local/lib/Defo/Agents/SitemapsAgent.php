<?php
namespace Defo\Agents;

class SitemapsAgent{
    static function updateSitemaps(){
        \Bitrix\Main\Loader::includeModule('iblock');

        $res = CIBlockElement::GetList(Array("NAME" => "ASC"), Array("IBLOCK_ID" => 21, "ACTIVE" => "Y", "!PROPERTY_DOMAIN" => false), false, false, Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_DOMAIN"));
        while ($ob = $res->GetNextElement()){
            $arFields = $ob->GetFields();
            $arProps = $ob->GetProperties();
            $arDomains[$arFields["ID"]] = $arProps["DOMAIN"]["VALUE"];

        }

        foreach ($arDomains as $id=>$domain){
            mkdir($_SERVER["DOCUMENT_ROOT"]."/sitemaps/".$domain);
            $fp[$id] = @fopen($_SERVER["DOCUMENT_ROOT"]."/sitemaps/".$domain."/sitemap_iblock_10.xml", "wb");
        }

        return '\Defo\Agents\SitemapsAgent::updateSitemaps();';
    }
}