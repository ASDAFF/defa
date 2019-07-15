<?php


class AlphabetMenu extends CBitrixComponent
{

    protected $catalogId = 17;

    protected $alphabet = [
        "а",
        "б",
        "в",
        "г",
        "д",
        "е",
        "ё",
        "ж",
        "з",
        "и",
        "й",
        "к",
        "л",
        "м",
        "н",
        "о",
        "п",
        "р",
        "с",
        "т",
        "у",
        "ф",
        "х",
        "ц",
        "ч",
        "ш",
        "щ",
        "ъ",
        "ы",
        "ь",
        "э",
        "ю",
        "я",
    ];

    public function executeComponent()
    {
        $t = "sdfg";

        dd($t);

        $data = [];

        $this->arResult["LETTERS"] = $data;

        $this->includeComponentTemplate();
    }

    public function getDataForLetter($letter)
    {
        $sections = CIBlockSection::GetList([
            "NAME" => "ASC",
        ], [
            "IBLOCK_ID" => $this->catalogId
        ]);
    }


}
