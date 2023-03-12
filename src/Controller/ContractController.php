<?php

namespace App\Controller;

use App\Entity\Contract;
use App\Form\ContractType;
use Doctrine\Persistence\ManagerRegistry;
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

    #[Route('/contract/add', name: 'contract.add')]
    public function addContract(ManagerRegistry $doctrine) : Response {

        //$this->getDoctrine();
        $entityManager = $doctrine->getManager();

        //$contract = new Contract();
        //$form = $this->createForm(ContractType::class, $contract);

        $contract = new Contract();
        //$name = $request->request->get("name");
        //$contract->setName($name);

        //$mecene_name = $request->request->get("mecene");
        $contract->setMeceneName($mecene_name);

        $begindate = $request->request->get("begin_date");
        $contract->setBeginDate($begindate);

        $enddate  = $request->request->get("end_date");
        $contract->setEndDate($enddate);

        $entityManager->persist($contract);
        $entityManager->flush();


        return $this->render('contract/add.html.twig', [
            'controller_name' => 'ContractController',
            //'form' => $form->createView()
        ]);
    }
}
