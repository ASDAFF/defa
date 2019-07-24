<?php


namespace Tmetrika;


class Product {

    public $product;
    /**
     * @var Offer
     */
    public $Offers;
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
        $this->init();
        $this->loadOffers();
    }

    private function init()
    {
        $nextElement = \CIBlockElement::GetByID($this->id)->GetNextElement();

        $this->product = $nextElement->GetFields();
        $this->product['PROPS'] = $nextElement->GetProperties();
    }

    /**
     * @param bool $format
     *
     * @return mixed
     */
    public function getMinPrice($format = false)
    {
        $result = data_get($this->product, 'PROPS.MINIMUM_PRICE.VALUE');

        return $format ? number_format($result, 0, '.', ' ') : $result;
    }

    /**
     *
     */
    public function loadOffers()
    {

        $offers = \CCatalogSKU::getOffersList($this->id, null, null, ['NAME', 'CATALOG_PRICE', 'DETAIL_TEXT']);

        foreach ($offers[$this->id] as $key => $offer) {
            $this->Offers[] = new Offer($offer['ID']);
        }
    }

    /**
     * @return float|int|mixed
     */
    public function discountValue()
    {
        $saleValue = $this->Offers[0]->saleValue();
        if ($saleValue) {

            $minPrice = $this->getMinPrice();

            $result = ceil((int)$minPrice - ((int)$minPrice / 100 * (int)$saleValue));

            return number_format($result, 0, '.', ' ');
        }

        return false;
    }

    /**
     *
     */
    public function getColors()
    {
        /** @var Offer $offer */
        foreach ($this->Offers as $offer) {
            $color = $offer->getColor();

            if ($color)
                $colors[] = $color->getFile();
        }

        return $colors;

    }

}