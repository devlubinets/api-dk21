<?php

namespace App\Controller;

use App\Service\GetDictionaryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CodeController extends AbstractController
{
   private $dictionaryService;

   public function __construct(GetDictionaryService $dictionaryService)
   {
      $this->dictionaryService = $dictionaryService;
   }


   public function getCode(string $searchWord): JsonResponse
   {
      $dictionaryData = $this->dictionaryService->getDictionaryData();
      foreach ($dictionaryData as $item) {
         if (strpos($item->getDescription(), $searchWord) !== false) {
               return new JsonResponse(['data' => ['code' => $item->getCode()]]);
            }
      }

      return new JsonResponse(['data' => null]);
   }
   public function getGroupOfCode(string $searchWord, int $quantityCodes): JsonResponse
   {
      $dictionaryData = $this->dictionaryService->getDictionaryData();
      $results = [];
      foreach ($dictionaryData as $item) {
         if (strpos($item->getDescription(), $searchWord) !== false) {
            $results[] = ['code' => $item->getCode()];
            if (count($results) >= $quantityCodes) {
               break;
            }
         }
      }

      return new JsonResponse(['data' => $results]);
   }
}
