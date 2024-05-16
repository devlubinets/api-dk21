<?php

namespace App\Tests\Service;

use App\Service\GetDictionaryService;

trait GetDictionaryServiceTrait
{
    /** @var GetDictionaryService $getDictionaryService */
    protected GetDictionaryService $getDictionaryService;

    /**
     * @return GetDictionaryService
     */
    public function getGetDictionaryService(): GetDictionaryService
    {
        return $this->getDictionaryService;
    }

    /**
     * @param GetDictionaryService $getDictionaryService
     * @return self
     */
    public function setGetDictionaryService(GetDictionaryService $getDictionaryService): self
    {
        $this->getDictionaryService = $getDictionaryService;

        return $this;
    }
}