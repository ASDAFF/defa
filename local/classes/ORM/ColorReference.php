<?php

namespace ORM;
use Arrilot\BitrixModels\Models\EloquentModel;

class ColorReference extends EloquentModel {

    protected $table = "next_color_reference";

    public function getFile()
    {
        return \CFIle::GetPath($this->UF_FILE);
    }

}