<?php


namespace Tmetrika;


use ORM\Tizers;

class Section {
    /**
     * @var mixed
     */
    private $id;

    /**
     * Section constructor.
     *
     * @param mixed $id
     */
    public function __construct($id)
    {
        $this->id = $id;
        $this->Section = \CIBlockSection::GetList([], [
            "ID"        => $id,
            "IBLOCK_ID" => 17 // todo вынести в константу
        ], false, [
            "UF_*",
        ])->GetNext();
    }

    public function Advantages()
    {
        foreach ($this->Section['UF_TIZERS'] as $tizer) {
            $tizers[] = Tizers::find($tizer);
        }


        return $tizers;
    }

    public function getSeriaUniqueColors()
    {
        $colors = [];
        $t = \CIblockElement::GetList([], ['IBLOCK_ID' => 17, 'SECTION_ID' => $this->id, 'ACTIVE' => 'Y']);
        while ($el = $t->GetNext()) {
            $product = new Product($el['ID']);

            $colors = array_merge($colors, $product->getColors());
        }

        return array_unique($colors);
    }

    public function getSeriaUniqueDopColors()
    {
        $colors = [];
        $t = \CIblockElement::GetList([], ['IBLOCK_ID' => 17, 'SECTION_ID' => $this->id, 'ACTIVE' => 'Y']);
        while ($el = $t->GetNext()) {
            $product = new Product($el['ID']);

            $colors = array_merge($colors, $product->getCustomColors('TEXTURE_KARKASA'));
            $colors = array_merge($colors, $product->getCustomColors('TEKSTURA_DVEREJ'));
        }

        return array_unique($colors);
    }

}