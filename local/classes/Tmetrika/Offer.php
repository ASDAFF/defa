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


        $value = data_get( $this->props, 'SKIDKA.VALUE', false);

        return $value ? str_replace("%", "", $value) : $value;
    }

    /**
     * @return ColorReference|null
     */
    public function getColor()
    {
        $xmlID =  data_get($this->props,'COLOR_REF.VALUE');

        if($xmlID)
            return ColorReference::where('UF_XML_ID',$xmlID)->first();

        return null;
    }


}