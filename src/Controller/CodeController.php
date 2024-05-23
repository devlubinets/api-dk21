<?php

namespace App\Controller;

use App\Service\GetDictionaryService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class CodeController extends AbstractController
{
    private $dictionaryService;

    public function __construct(GetDictionaryService $dictionaryService)
    {
        $this->dictionaryService = $dictionaryService;
    }

    #[Route('/code/getCode/{searchWord}', name: 'app_get_code')]
    public function getCode(string $searchWord)
    {
        $storage = $this->dictionaryService->getDictionaryData();
        foreach ($storage as $item) {
            if (stripos($item->getDescription(), $searchWord) !== false) {
                return new JsonResponse(['data' => ['code' => $item->getCode()]]);
            }
        }
        return new JsonResponse(['error' => 'Code not found']);
    }
    #[Route('/code/getGroupOfCode/{searchWord}/{quantityCodes}', name: 'app_get_group_of_code')]

    public function getGroupOfCode(string $searchWord, int $quantityCodes)
    {
        $storage = $this->dictionaryService->getDictionaryData();
        $groupCodes = [];
        $counter = 0;
        foreach ($storage as $item) {
            if (stripos($item->getDescription(), $searchWord) !== false) {
                $groupCodes[] = ['code' => $item->getCode()];
                $counter++;
                if ($counter >= $quantityCodes) {
                    break;
                }
            }
        }
        return new JsonResponse(['data' => $groupCodes]);
    }
}
