<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContractController extends AbstractController
{
    #[Route('/contract', name: 'app_contract')]
    public function index(): Response
    {
        $contract_list = array(
            "nom" => "Steve",
            "nom_mecene" => "Apple",
            "date_debut" => "13/02/2003",
            "date_fin"   => "31/03/2023"
        );

        return $this->render('contract/index.html.twig', [
            'controller_name' => 'ContractController',
            "contract_list"   => $contract_list
        ]);
    }

    #[Route('/addContract', name: 'add_contract')]
    public function addContract() : Response {


        return $this->render('contract/add.html.twig', [
            'controller_name' => 'ContractController',
        ]);
    }
}
