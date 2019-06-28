<?php
namespace Defo\Utils;

class PictureUtils
{
    /**
     * @param mixed $arImage
     * @param int $width
     * @param int $height
     * @return mixed
     */
    public static function getImage($arImage, $width = 0, $height = 0)
    {
        $arFilters = array(array(
            'name' => 'watermark',
            'type' => 'image',
            'position' => 'center',
            'coefficient' => 0.45,
            'file' => $_SERVER['DOCUMENT_ROOT'] . '/images/watermark.png',
        ));

        $arSize = array();
        if (is_array($arImage) || !$width || !$height) { // in series gallery
            $arSize = array(
                'width' => $width ?: $arImage['WIDTH'],
                'height' => $height ?: $arImage['HEIGHT']
            );
        } else { // in category
            $arSize = array(
                'width' => $width,
                'height' => $height
            );

            $arFilters['coefficient'] = 0.9;
        }


        return
            \CFile::ResizeImageGet(
                $arImage,
                $arSize,
                BX_RESIZE_IMAGE_PROPORTIONAL,
                false,
                $arFilters,
                false,
                false
            );
    }
}