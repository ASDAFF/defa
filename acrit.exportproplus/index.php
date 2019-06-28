<?
$documentRoot = $_SERVER["DOCUMENT_ROOT"];

if( isset( $_REQUEST["ozoninfo"] ) || isset( $_REQUEST["vkinfo"] ) || isset( $_REQUEST["fbinfo"] ) || isset( $_REQUEST["instagraminfo"] ) || isset( $_REQUEST["okinfo"] ) ){
    require( $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php" );
    if( CModule::IncludeModule( "acrit.exportproplus" ) ){?>
        <div style="width: 100%; text-align: center; font-size: 18px; margin: 40px 0; padding: 40px 0; border: 1px solid #ccc; border-radius: 6px; background: #f5f5f5;">
            <?=GetMessage( "ACRIT_EXPORT_FINISHED" );?>
        </div>
    <?}
    require( $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php" );
}
else{
    $filePath = $_SERVER["REQUEST_URI"];
    if( stripos( $filePath, "xml" ) !== false ){
        if( stripos( $documentRoot.$filePath, "?" ) !== false ){
            $arRequest = explode( "?", $filePath );
            $filePath = $arRequest[0];
        }
    }

    $document = false;
    if( file_exists( $documentRoot.$filePath ) ){
        $document = $documentRoot.$filePath;
    }
    elseif( file_exists( $documentRoot."/upload/acrit.exportproplus/".$filePath ) ){
        $document = $documentRoot."/upload/acrit.exportproplus/".$filePath;
    }
    elseif( file_exists( $documentRoot."/upload/".$filePath ) ){
        $document = $documentRoot."/upload/".$filePath;
    }

    $inputEncoding = $_REQUEST["encoding"];

    if( $document ){
        if( stripos( $filePath, "xml" ) !== false ){
            header( "Expires: Thu, 19 Feb 1998 13:24:18 GMT");
            header( "Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
            header( "Cache-Control: no-cache, must-revalidate");
            header( "Cache-Control: post-check=0,pre-check=0");
            header( "Pragma: no-cache");
            header( "Content-Type: application/xml; charset=".$inputEncoding );
            echo file_get_contents( $document );
        }
        elseif( stripos( $filePath, "zip" ) !== false ){
            header( "Pragma: public" );
            header( "Expires: 0" );
            header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
            header( "Cache-Control: public" );
            header( "Content-Type: application/zip" );
            header( "Content-Transfer-Encoding: Binary" );
            header( "Content-Length: ".filesize( $document ) );
            header( "Content-Disposition: attachment; filename=\"".basename( $document )."\"" );
            readfile( $document );
            exit;
        }
        else{
            header( "Pragma: public" );
            header( "Expires: 0" );
            header( "Cache-Control: must-revalidate, post-check=0, pre-check=0" );
            header( "Cache-Control: private", false );
            header( "Content-Type: text/csv" );
            header( "Content-Disposition: attachment;filename=".$filePath );

            echo file_get_contents( $document );
        }
        die();
    }
}
?>