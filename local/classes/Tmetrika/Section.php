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
}