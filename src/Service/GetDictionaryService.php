<?php

namespace App\Service;

use App\Model\DictionaryItem;
use SplObjectStorage;

class GetDictionaryService
{
    /**
     * @return SplObjectStorage
     */
    public function getDictionaryData(): SplObjectStorage
    {
        $storage = new SplObjectStorage();

        //todo: Get pdf from uri https://mspu.gov.ua/storage/app/sites/17/%D0%BE%D0%B1%D0%BE%D1%80%D0%BE%D0%BD%D0%BD%D1%96%20%D0%B7%D0%B0%D0%BA%D1%83%D0%BF%D1%96%D0%B2%D0%BB%D1%96%20%D1%84%D0%B0%D0%B9%D0%BB%D0%B8/dk021-2015.pdf
        $pdf = $this->retrievePDFFile();

        //todo: parse file
           /*
            * [
            *   ["code" => "03121210-0", "description" => "Квіткові композиції"],
            *   ["code" => "03130000-1", "description" => "Сільськогосподарські культури для виробництва напоїв і прянощі"],
            *   ...
            * ]
            *
            * */
        $rawDictionaryData = $this->parsePDFFile($pdf);

        foreach ($rawDictionaryData as $dictionaryRow) {
            //todo: put each dictionary row to new DictionaryItem object
            $dictionaryItem = new DictionaryItem();
            $dictionaryItem->setCode($dictionaryRow["code"])->setDescription($dictionaryRow["description"]);
            //todo: attach new DictionaryItem object by SplObjectStorage
            $storage->attach($dictionaryItem);
        }

        return $storage;
    }

    protected function retrievePDFFile()
    {

    }

    protected function parsePDFFile($pdf): array
    {

    }
}