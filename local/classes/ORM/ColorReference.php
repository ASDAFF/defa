<?php

namespace ORM;

use Arrilot\BitrixModels\Models\EloquentModel;

class ColorReference extends EloquentModel {

    protected $table = "next_color_reference";

    public function getFile($size = [])
    {
        if (count($size))
            return \CFile::ResizeImageGet($this->UF_FILE,['width' => $size['width'],'height' => $size['height']])['src'];

        return \CFIle::GetPath($this->UF_FILE);
    }

}