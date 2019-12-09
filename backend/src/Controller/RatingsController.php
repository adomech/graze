<?php

namespace App\Controller;

use App\Repository\RatingsRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class RatingsController
{
    private $ratingsRepository;

    public function __construct(RatingsRepository $ratingsRepository )
    {
        $this->ratingsRepository = $ratingsRepository;
    }

    /**
     * @Route("/rating", name="update_rating", methods={"PUT"})
     */
    public function updateRating(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $updatedRating = $this->ratingsRepository->updateRating($data);
        return new JsonResponse(['status' => 'Rating changed'], Response::HTTP_OK);
    }
}
