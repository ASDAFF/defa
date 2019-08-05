<?php


namespace Tmetrika;


class Product
{

    /**
     * Парсинг настроек каталога
     * @return array
     */
    public static function parseSettings()
    {
        $content = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/catalog/index.php");

        $matches = [];
        preg_match('#"DETAIL_PROPERTY_CODE".*=>.*array\(([\s\S]*?)\)#', $content, $matches);

        $array = $matches[1];

        preg_match_all('#"(.*)"#', $array, $matches);

        $codes = array_filter($matches[1]);

        preg_match('#"VISIBLE_PROP_COUNT".*=>.*"(.*)",#', $content, $matches);
        $limit = $matches[1];

        return [
            "props" => $codes,
            "limit" => intval($limit),
        ];
    }

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

    public function __get($name)
    {
        if (isset($this->{$name}))
            return $this->{$name};

        if (function_exists($name))
            return $this->{$name}();
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
     * @return mixed
     */
    public function detailPicture()
    {
        return \CFile::ResizeImageGet($this->product["DETAIL_PICTURE"], ['width' => 200, 'height' => 200])['src'];
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

    /**
     * @param $colorCode
     *
     * @return array
     */
    public function getCustomColors($colorCode)
    {
        $colors = [];
        /** @var Offer $offer */
        foreach ($this->Offers as $offer) {
            $color = $offer->getColor($colorCode);

            if ($color)
                $colors[] = $color->getFile();
        }

        return $colors;
    }

    public function Actions()
    {
        return data_get($this->product, "PROPS.LINK_SALE.VALUE");
    }

    /**
     * @return |null
     */
    public function Schema()
    {
        $schema = data_get($this->product, "PROPS.PRODUCT_SCHEME.VALUE");
        return $schema ? \CFile::GetPath($schema) : null;
    }


}
