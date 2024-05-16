<?php

namespace App\Tests\Service;

use App\Service\GetDictionaryService;
use PHPUnit\Framework\TestCase;

class GetDictionaryServiceTest extends TestCase
{
    use GetDictionaryServiceTrait;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->getDictionaryService = new GetDictionaryService();
    }

    /**
     * @return void
     */
    public function testGetDictionaryData(): void
    {
        $result = $this->getGetDictionaryService()->getDictionaryData();

        $this->assertIsObject($result);
    }
}
