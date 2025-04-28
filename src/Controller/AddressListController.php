<?php

namespace App\Controller;

use App\Entity\Estimate;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AddressListController extends AbstractController
{
    #[Route('/address/list', name: 'app_address_list', methods: ['GET'])]
    public function index(Estimate $estimate): Response
    {
        if ($estimate->getId() === 1) {
            return $this->json([
                ['text' => 'Adresse 1', 'value' => '1'],
                ['text' => 'Adresse 2', 'value' => '2'],
            ]);
        }

        return $this->json([
            ['text' => 'Adresse 2', 'value' => '2']
        ]);
    }
}
