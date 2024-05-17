<?php

namespace App\Service;

use App\Model\DictionaryItem;
use SplObjectStorage;
use Smalot\PdfParser\Parser;

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
        $url = 'https://mspu.gov.ua/storage/app/sites/17/%D0%BE%D0%B1%D0%BE%D1%80%D0%BE%D0%BD%D0%BD%D1%96%20%D0%B7%D0%B0%D0%BA%D1%83%D0%BF%D1%96%D0%B2%D0%BB%D1%96%20%D1%84%D0%B0%D0%B9%D0%BB%D0%B8/dk021-2015.pdf';

        $fileContent = file_get_contents($url);
        if ($fileContent === FALSE) {
            throw new \Exception("Не удалось скачать PDF файл.");
        }
        return $fileContent;
    
    }

    protected function parsePDFFile($pdf): array
    {
        $parser = new Parser();
        $pdf = $parser->parseContent($pdf);
        $text = $pdf->getText();
            // echo  $text;
        $lines = explode("\n", $text);
        $dataArray = [];
    
        foreach ($lines as $line) {
            $parts = explode(" ", $line, 2);
            
            if (count($parts) == 2) {
                $code = trim($parts[0]);
                $description = trim($parts[1]);
                $dataArray[] = ["code" => $code, "description" => $description];
            }
        }
    
        return $dataArray;
    }
}