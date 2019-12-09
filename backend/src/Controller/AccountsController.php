<?php

namespace App\Controller;

use App\Repository\AccountsRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AccountsController
{
    private $accountsRepository;

    public function __construct(AccountsRepository $accountsRepository)
    {
        $this->accountsRepository = $accountsRepository;
    }

    /**
     * @Route("/boxes/{id}", name="get_boxes", methods={"GET"})
     */
    public function get($id): JsonResponse
    {
        $data = $this->accountsRepository->findProductsByAccountId($id);

        return new JsonResponse($data, Response::HTTP_OK);
    }
}
