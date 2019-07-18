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

    protected function getIdsForLetter($letter)
    {
        $baseFilter = [
            "ACTIVE" => "Y",
            "IBLOCK_ID" => $this->catalogId,
        ];

        $nameFilter = ["NAME" => "{$letter}%"];
        $rusNameFilter = ["UF_NAME_RUS" => "{$letter}%"];

        $query = CIBlockSection::GetList([], $baseFilter + $nameFilter);

        $ids = [];

        while ($element = $query->GetNext()) {
            $ids[] = $element["ID"];
        }

        $query = CIBlockSection::GetList([], $baseFilter + $rusNameFilter);


        while ($element = $query->GetNext()) {
            $ids[] = $element["ID"];
        }

        return array_unique($ids);
    }


    /**
     * Получение данных для буквы
     * @param $letter
     * @return array|bool
     */
    public function getDataForLetter($letter)
    {
        $ids = $this->getIdsForLetter($letter);
        $sections = [];
        $series = [];

        if ($ids) {
            $query = CIBlockSection::GetList([
                "NAME" => "ASC",

            ], [
                "UF_SERIES" => 0,
                "IBLOCK_ID" => $this->catalogId,
                "ID" => $ids
            ]);

            while ($section = $query->GetNext()) {
                $sections[] = $section;
            }

            $query = CIBlockSection::GetList([
                "NAME" => "ASC",
            ], [
                "UF_SERIES" => 1,
                "IBLOCK_ID" => $this->catalogId,
                "ID" => $ids
            ]);


            while ($seria = $query->GetNext()) {
                $series[] = $seria;
            }
        }

        $query = CIBlockElement::GetList([
            "NAME" => "ASC",
        ], [
            "IBLOCK_ID" => $this->catalogId,
            "ACTIVE" => "Y",
            [
                "LOGIC" => "OR",
                "NAME" => "{$letter}%",
                "PROPERTY_RUSSIAN_NAME" => "{$letter}%",
            ]
        ], false, [
            "nPageSize" => 150,
        ]);

        $elements = [];

        while ($element = $query->GetNext()) {
            $elements[] = $element;
        }

        // в букве есть что-то для вывода
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
