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
        $data = [];

        foreach ($this->alphabet as $letter) {
            $letter = mb_strtoupper($letter);

            $letterData = $this->getDataForLetter($letter);

            // не добавляем пустые буквы
            if ($letterData !== false) {
                $data[$letter] = $letterData;
            }

        }

        $this->arResult["LETTERS"] = $data;

        $this->includeComponentTemplate();
    }


    /**
     * Получение данных для буквы
     * @param $letter
     * @return array
     */
    public function getDataForLetter($letter)
    {
        $query = CIBlockSection::GetList([
            "NAME" => "ASC",
        ], [
            "ACTIVE" => "Y",
            "IBLOCK_ID" => $this->catalogId,
            "UF_SERIES" => 0,
            "NAME" => "{$letter}%"
        ]);

        $sections = [];

        while ($section = $query->GetNext()) {
            $sections[] = $section;
        }

        $query = CIBlockSection::GetList([
            "NAME" => "ASC",
        ], [
            "ACTIVE" => "Y",
            "IBLOCK_ID" => $this->catalogId,
            "UF_SERIES" => 1,
            "NAME" => "{$letter}%"
        ]);

        $series = [];

        while ($seria = $query->GetNext()) {
            $series[] = $seria;
        }

        $query = CIBlockElement::GetList([
            "NAME" => "ASC",
        ], [
            "IBLOCK_ID" => $this->catalogId,
            "ACTIVE" => "Y",
            "NAME" => "{$letter}%"
        ], false, [
            "nPageSize" => 15,
        ]);

        $elements = [];

        while ($element = $query->GetNext()) {
            $elements[] = $element;
        }

        $count = count($sections) + count($series) + count($elements);

        if ($count > 0) {
            return [
                "SECTIONS" => $sections,
                "SERIES" => $series,
                "ELEMENTS" => $elements
            ];
        }

        return false;

    }


}
