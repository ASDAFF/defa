<?php


namespace Tmetrika;


class Product
{

    public static $limit = 5;
    public static $showProps = [
        0 => "671",
        1 => "672",
        2 => "673",
        3 => "674",
        4 => "675",
        5 => "676",
        6 => "677",
        7 => "678",
        8 => "679",
        9 => "680",
        10 => "683",
        11 => "684",
        12 => "685",
        13 => "686",
        14 => "687",
        15 => "688",
        16 => "689",
        17 => "690",
        18 => "691",
        19 => "BRAND",
        20 => "TYPE_PRODUCT",
        21 => "SERIES",
        22 => "MODEL",
        23 => "CML2_ARTICLE",
        24 => "TEXTURE",
        25 => "COUNTRY_OF_ORIGIN",
        26 => "GARANTY",
        27 => "CML2_ATTRIBUTES",
        28 => "VIDEO_YOUTUBE",
        29 => "VYSOTA_DO_PODLOKOTNIKOV_HEIGHT_PODLOKOTNIK3",
        30 => "VYSOTA_MINIMALNAYA_HEIGHT_MIN3",
        31 => "VYSOTA_SIDENIYA_HEIGHT_SIDENIYA3",
        32 => "VYSOTA_SPINKI_HEIGHT_SPINKI3",
        33 => "GLUBINA_MINIMALNAYA_DEPTH_MIN3",
        34 => "GLUBINA_SIDENIYA_DEPTH_SIDENIYA3",
        35 => "DVERI_DOORS",
        36 => "DLINA_SM_LENGTH",
        37 => "ZHESTKOST_HARDNESS",
        38 => "KARKAS_KASKAS",
        39 => "KLASS_MEBELI_MEBELCLASS",
        40 => "KOLICHESTVO_MEST_V_SEKTSII_KOLVOMESTVSEKCII3",
        41 => "KOLICHESTVO_UPAKOVOK_KOLVOUPAK3",
        42 => "KOMPLEKT_KOMPLECT",
        43 => "KONSTRUKTSIYA_CONSTRUCTION",
        44 => "KRESTOVINA_CROSS",
        45 => "KROMKA_RABOCHIKH_POVERKHNOSTEY_KROMKA",
        46 => "MATERIAL_MATERIAL",
        47 => "MATERIAL_PATTERN",
        48 => "MATERIAL_NAPOLNENIYA_FILLING_MATERIAL",
        49 => "MATERIAL_OBIVKI_MATERIAL_OBIVKI3",
        50 => "MATERIAL_POKRYTIYA_COVER_MATERIAL",
        51 => "MEKHANIZM_MEHANIZM3",
        52 => "MEKHANIZM_KACHANIYA_MEHANIZM_KACHANIYA3",
        53 => "MEKHANIZMY_TILT",
        54 => "NAGRUZKA_NAGRUZKA",
        55 => "NAPOLNITELI_NAPOLNITELI",
        56 => "NAPRAVLYAYUSHCHIE_MDIRECTIONS",
        57 => "OBEM_TOVARA_OBYEM3",
        58 => "OPORY_OPORY",
        59 => "PODGOLOVNIK_PODGOLOVNIK3",
        60 => "PODLOKOTNIKI_ARMRESTS",
        61 => "PODLOKOTNIKI_PODLOKOTNIK3",
        62 => "POLKA_POLKA",
        63 => "POTREBLYAEMAYA_MOSHCHNOST_MOSCHNOST",
        64 => "POYASNICHNYY_UPOR_LUMBAR_SUPPORT3",
        65 => "RABOCHIE_POVERKHNOSTI_R_POVERHNOST",
        66 => "REGULIROVKA_VYSOTY_SIDENIYA_REGUL_VYSOTY_SIDEN3",
        67 => "REGULIROVKI_REGULATOR",
        68 => "ROLIKI_ROLIKI3",
        69 => "ROLIKI_SKATES",
        70 => "SETKA_V_SPINKE_SETKAVSPINKE3",
        71 => "SIDENE_SIDENIE",
        72 => "SOEDINITELNAYA_FURNITURA_SOED_FURNITURA",
        73 => "STOLESHNITSA_STOLESHNICA",
        74 => "TIP_BAZY_TYPE_BASE3",
        75 => "TIP_LAMPY_LAMPA_TYPE",
        76 => "TOLSHCHINA_THICKNESS",
        77 => "FASAD_FACADE",
        78 => "SHIRINA_SIDENIYA_WIDTH_SIDENIYA3",
        79 => "YASHCHIKI_BOXES",
        80 => "MATERIAL_OBIVKI_SPINKI_KRESLA",
        81 => "MATERIAL_OBIVKI_SIDENIYA_KRESLA",
        82 => "SIZES",
        83 => "PROP_159",
        84 => "WIDHT",
        85 => "DEPTH",
        86 => "HEIGHT",
        87 => "SHIRINAUPAK",
        88 => "VYSOTAUPAK",
        89 => "GLUBINAUPAK",
        90 => "GABARITYUPAK",
        91 => "BRUTTO",
        92 => "VOLUME",
        93 => "MATERIAL_PETEL",
        94 => "AMORTIZATORY_PETEL",
        95 => "MATERIAL_RUCHEK",
        96 => "DOVODCHIK",
        97 => "MATERIAL_KARKASA",
        98 => "TEXTURE_KARKASA",
        99 => "THICKNESS_KARKAS",
        100 => "MATERIAL_ZADNEJ_STENKI_KARKASA",
        101 => "TOLSHCHINA_ZADNEJ_STENKI_KARKASA",
        102 => "TIP_DVEREJ",
        103 => "MATERIAL_DVEREJ",
        104 => "TEKSTURA_DVEREJ",
        105 => "PROP_2033",
        106 => "PROP_2049",
        107 => "PROP_2065",
        108 => "PROP_2052",
        109 => "PROP_2027",
        110 => "PROP_2053",
        111 => "PROP_2083",
        112 => "PROP_2026",
        113 => "PROP_2044",
        114 => "PROP_162",
        115 => "PROP_2054",
        116 => "PROP_2017",
        117 => "PROP_2055",
        118 => "PROP_2069",
        119 => "PROP_2062",
        120 => "PROP_2061",
        121 => "RECOMMEND",
        122 => "NEW",
        123 => "STOCK",
        124 => "VIDEO",
        125 => "FILES",
    ];

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
