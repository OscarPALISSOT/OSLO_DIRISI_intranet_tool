<?php

namespace App\Controller\administration;

use App\Entity\BasesDeDefense;
use App\Repository\BasesDeDefenseRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BddController extends AbstractController {

    private BasesDeDefenseRepository $BddRepository;
    private ManagerRegistry $ManagerRegistry;

    public function __construct(BasesDeDefenseRepository $BddRepository, ManagerRegistry $doctrine)
    {
        $this->BddRepository = $BddRepository;
        $this->ManagerRegistry = $doctrine;
    }

    /**
     * @Route ("/Admin/BasesDeDefense", name="Admin_Bdd")
     * @return Response
     */
    public function index() : Response{
        return $this->render('administration/bdd/bdd.html.twig', [
            'bdds' => $this->BddRepository->findAll(),
        ]);
    }

    /**
     * @Route ("/Admin/NewBasesDeDefense", name="Admin_Bdd_New")
     * @param Request $request
     * @return Response
     */
    public function newBdd(Request $request) : Response{
        $NewBdd = new BasesDeDefense();
        $Bdd = $request->request->get('bdd');
        $NewBdd->setBaseDefense($Bdd);
        if ($this->isCsrfTokenValid("CreateBdd", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($NewBdd);
            $em->flush();
        }
        $jsonData = array(
            'Bdd' => $Bdd,
        );
        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/Admin/DeleteBasesDeDefense", name="Admin_Bdd_Delete")
     * @param Request $request
     * @return Response
     */
    public function DeleteBdd(Request $request): Response{
        $Bdds = $this->BddRepository->findAll();
        $nbBdd = count($Bdds);
        $ChekedId = array();
        for ( $i = 0; $i < $nbBdd; $i++){
            if ($request->request->get('idChecked' . $Bdds[$i]->getIdBaseDefense())){
                $ChekedId[] = $Bdds[$i]->getIdBaseDefense();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'Bdd' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $bddToDelete = $this->BddRepository->find($item);

                if ($this->isCsrfTokenValid("DeleteBdd", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
                    $em->remove($bddToDelete);
                    $em->flush();
                }

            }
            $jsonData = array(
                'Bdd' => "Suppression terminée",
            );
        }
        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/Admin/EditBasesDeDefense/{id}", name="Admin_Bdd_Edit")
     * @param Request $request
     * @return Response
     */
    public function EditBdd(Request $request) : Response{
        $id = $request->request->get('idEdit');
        $Bdd = $this->BddRepository->find($id);
        $BddName = $request->request->get('bddEdit');
        $Bdd->setBaseDefense($BddName);

        if ($this->isCsrfTokenValid("EditBdd", $request->get('_token'))) {
            $em = $this->ManagerRegistry->getManager();
            $em->persist($Bdd);
            $em->flush();
        }

        $jsonData = array(
            'Bdd' => $Bdd->getBaseDefense(),
        );

        return $this->json($jsonData, 200);
    }
}