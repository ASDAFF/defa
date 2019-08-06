<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}
use Bitrix\Main\Loader;
use \Bitrix\Iblock\Component\ElementList;
use Sotbit\Crosssell\FilterGenerator;

if (!\Bitrix\Main\Loader::includeModule('iblock'))
{
    ShowError(Loc::getMessage('IBLOCK_MODULE_NOT_INSTALLED'));
    return;
}


class ComplexCollectionComponent extends CBitrixComponent
{

    private function getCollectionList($arParametersCollection){

        $collections = array();
        $collectionNames = array();
        foreach ($arParametersCollection as $id => $parameterId) {
            if (strpos($parameterId,'s') !== false){
                $catId = str_replace('s',"",$parameterId);
                $db_collection = \Sotbit\Crosssell\Orm\CrosssellTable::getList(array(
                    'filter' =>
                        array(
                            'SITES' => '%"'.SITE_ID.'\"%',
                            'TYPE_BLOCK' => 'COLLECTION',
                            'Active' => 'Y',
                            'CATEGORY_ID' => $catId
                        ),
                    'select' =>
                        array(
                            'ID', 'NAME', 'CATEGORY_ID', 'SORT'
                        ),
                ));
                while ($item = $db_collection->fetch()){
                    $collectionNames[$item['ID']] = array('ID' => $item['ID'], 'NAME' => $item['NAME'], 'SORT' => $item['SORT']);
                    array_push($collections, $item['ID']);
                }

            } elseif (strpos($parameterId,'e') !== false){
                $collectionId = str_replace('e',"",$parameterId);
                if (!in_array($collectionId, $collections)){
                    array_push($collections, $collectionId);
                    $db_collection = \Sotbit\Crosssell\Orm\CrosssellTable::getList(array(
                        'filter' =>
                            array(
                                'SITES' => '%"'.SITE_ID.'\"%',
                                'TYPE_BLOCK' => 'COLLECTION',
                                'Active' => 'Y',
                                'ID' => $collectionId
                            ),
                        'select' =>
                            array(
                                'ID', 'NAME', 'SORT'
                            ),
                    ));
                    while ($item = $db_collection->fetch()){
                        $collectionNames[$item['ID']] = array('ID' => $item['ID'], 'NAME' => $item['NAME'], 'SORT' => $item['SORT']);
                    }
                }
            }
        }

        $sorted = $this->array_msort($collectionNames, array('SORT'=>SORT_ASC));
        $collections = array();
        $collectionNames = array();
        foreach ($sorted as $collectionId => $collectionItem) {
            $collectionNames[$collectionId] = $collectionItem['NAME'];
            array_push($collections, $collectionId);
        }
        $result = array();
        $result['COLLECTION_IDS'] = $collections;
        $result['COLLECTION_NAMES'] = $collectionNames;
        return $result;

    }

    private function  array_msort($array, $cols)
    {
        $colarr = array();
        foreach ($cols as $col => $order) {
            $colarr[$col] = array();
            foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
        }
        $eval = 'array_multisort(';
        foreach ($cols as $col => $order) {
            $eval .= '$colarr[\''.$col.'\'],'.$order.',';
        }
        $eval = substr($eval,0,-1).');';
        eval($eval);
        $ret = array();
        foreach ($colarr as $col => $arr) {
            foreach ($arr as $k => $v) {
                $k = substr($k,1);
                if (!isset($ret[$k])) $ret[$k] = $array[$k];
                $ret[$k][$col] = $array[$k][$col];
            }
        }
        return $ret;

    }

    //delete empty collections
    private function deleteEmptyCollections($collections = false){
        //get collection object
        $filterGenerator = new FilterGenerator();

        if ($collections && is_array($collections)){

            $i = 0;
            foreach ($collections['COLLECTION_IDS'] as $collectionId){
                //get collection
                $colData = \Sotbit\Crosssell\Orm\CrosssellTable::getList(array('filter' => array(
                    'ID' => $collectionId,
                    'TYPE_BLOCK' => 'COLLECTION',
                    'SITES' => '%"'.SITE_ID.'\"%'
                )
                ))->fetch();

                //get filter for collection
                $filter = $filterGenerator->getFilter($colData['RULE1']);

                //check for count
                $cnt = CIBlockElement::GetList(
                    array(),
                    $filter,
                    array(),
                    false,
                    array('ID')
                );

                //delete if no elements to display
                if (($cnt == 0)){
                    unset($collections['COLLECTION_NAMES'][$collections['COLLECTION_IDS'][$i]]);
                    unset($collections['COLLECTION_IDS'][$i]);
                }
                $i++;
            }
        }
        return $collections;
    }


    public function executeComponent()
    {
        if(!Loader::includeModule('sotbit.crosssell')) {
            return;
        }
        $collections = $this->getCollectionList($this->arParams['COLLECTION_LIST']);
        $collections = $this->deleteEmptyCollections($collections);
        $this->arParams['COLLECTION_LIST'] = $collections['COLLECTION_IDS'];
        $this->arParams['FROM_COMPLEX'] = true;
        $this->arParams['COMPONENT_PATH'] = $this->GetPath();
        $this->arParams['COLLECTION_LIST_NAMES'] = $collections['COLLECTION_NAMES'];
        $this->arResult['IBLOCK_ID'] = $this->arParams['IBLOCK_ID'];

        $this->includeComponentTemplate();

        return $this->arResult;
    }
}

?>