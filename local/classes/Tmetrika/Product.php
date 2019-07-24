<?php

namespace Tmetrika;

class Product {

    public $Parent;
    private $id;
    /**
     * @var null
     */
    private $parentID;

    public function __construct($id, $parentID = null)
    {
        $this->id = $id;
        $this->parentID = $parentID;

        $this->getParent();
    }

    /**
     * @return mixed
     */
    public function saleValue()
    {
        $element = \CIBlockElement::GetByID($this->id)->GetNextElement()->GetProperties();

        $value = data_get($element, 'SKIDKA.VALUE', false);

        return $value ? str_replace("%", "", $value) : $value;
    }

    /**
     * @return float|int|mixed
     */
    public function discountValue()
    {
        if ($this->saleValue()) {
            $minPrice = $this->getMinPrice();

            $result = ceil((int)$minPrice - ((int)$this->getMinPrice() / 100 * (int)$this->saleValue()));

            return number_format($result, 0, '.', ' ');
        }

        return false;
    }

    /**
     * @param bool $format
     *
     * @return mixed
     */
    public function getMinPrice($format = false)
    {
        $result = data_get($this->Parent, 'PROPS.MINIMUM_PRICE.VALUE');

        return $format ? number_format($result, 0, '.', ' ') : $result;
    }

    /**
     *
     */
    private function getParent()
    {
        if (!$this->parentID)
            $this->parentID = \CCatalogSku::GetProductInfo($this->id)['ID'];


        $nextElement = \CIBlockElement::GetByID($this->parentID)->GetNextElement();

        $element = $nextElement->GetFields();
        $element['PROPS'] = $nextElement->GetProperties();

        $this->Parent = $element;


    }


}