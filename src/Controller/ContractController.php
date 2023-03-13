<?php

namespace App\Controller;

use App\Entity\Contract;
use App\Form\ContractType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContractController extends AbstractController
{
    #[Route('/contract', name: 'contract')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Contract::class);

        $contract_list = $repository->findAll();

        return $this->render('contract/index.html.twig', [
            'contract_list'   => $contract_list
        ]);
    }

    #[Route('/contract/{id<\d+>}', name: 'contract.info')]
    public function infoContract(Contract $contract = null, $id): Response
    {
        //$repository = $doctrine->getRepository(Contract::class);
        //$contract = $repository->find($id);
        if (!$contract){
            $this->addFlash('error', "Le contract d'ID $id n'existe pas.");
            return $this->redirectToRoute('app_contract');
        }
        return $this->render('contract/detail.html.twig', [
            'contract'   => $contract
        ]);
    }

    #[Route('/contract/add', name: 'contract.add')]
    public function addContract(ManagerRegistry $doctrine, Request $request) : Response {

        $entityManager = $doctrine->getManager();

        $contract = new Contract();
        $form = $this->createForm(ContractType::class, $contract);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $entityManager->persist($contract);
            $entityManager->flush();

            $this->addFlash('info', "Le contrat de ".$contract->getName()." a été ajouté.");
            return $this->redirectToRoute("contract");
        } else {
            return $this->render('contract/add.html.twig', [
                'contract' => $contract,
                'form' => $form->createView()
            ]);
        }
    }

    #[Route('/contract/delete/{id}', name: 'contract.delete')]
    public function deleteContract(Contract $contract = null, ManagerRegistry $doctrine): RedirectResponse {

        if ($contract) {
            $manager = $doctrine->getManager();
            $manager->remove($contract);
            $manager->flush();

            $this->addFlash('success', "Ce contrat a bien été supprimé.");
        } else {
            $this->addFlash('error', "Contrat inexistant.");
        }

        return $this->redirectToRoute("app_contract");
    }
}
