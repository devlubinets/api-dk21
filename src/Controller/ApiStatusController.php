<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;


class ApiStatusController extends AbstractController
{
   public function getStatus(): JsonResponse
   {
      return new JsonResponse([
         'status' => 1,
         'message' => 'Api works fine'
      ]);
   }
}
