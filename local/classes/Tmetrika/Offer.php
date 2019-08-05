<?php

namespace Tmetrika;

use ORM\ColorReference;

class Offer {

    public $props;
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
        $this->props = \CIBlockElement::GetByID($this->id)->GetNextElement()->GetProperties();
    }

    /**
     * @return mixed
     */
    public function saleValue()
    {


        $value = data_get($this->props, 'SKIDKA.VALUE', false);

        return $value ? str_replace("%", "", $value) : $value;
    }

    /**
     * @param null $colorCode
     *
     * @return ColorReference|null
     */
    public function getColor($colorCode = null)
    {
        $colorCode = !$colorCode ? 'COLOR_REF' : $colorCode;
        $xmlID = data_get($this->props, $colorCode . '.VALUE');

        if ($xmlID)
            return ColorReference::where('UF_XML_ID', $xmlID)->first();

        return null;
    }


}