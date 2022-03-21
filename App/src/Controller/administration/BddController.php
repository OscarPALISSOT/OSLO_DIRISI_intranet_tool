<?php

namespace App\Controller\administration;

use App\Entity\BasesDeDefense;
use App\Repository\BasesDeDefenseRepository;
use App\Repository\RfzRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BddController extends AbstractController {

    private BasesDeDefenseRepository $BddRepository;
    private ManagerRegistry $ManagerRegistry;
    private RfzRepository $rfzRepository;

    public function __construct(BasesDeDefenseRepository $BddRepository, ManagerRegistry $doctrine, RfzRepository $rfzRepository)
    {
        $this->BddRepository = $BddRepository;
        $this->ManagerRegistry = $doctrine;
        $this->rfzRepository = $rfzRepository;
    }

    /**
     * @Route ("/Admin/BasesDeDefense", name="Admin_Bdd")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request) : Response{
        $Bdds = $paginator->paginate(
            $this->BddRepository->findAllWithRfzQuery(),
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/
        );
        return $this->render('administration/bdd.html.twig', [
            'Bdds' => $Bdds,
            'Rfzs' => $this->rfzRepository->findAll(),
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
        $idRfz = $request->request->get('rfz');

        $NewBdd->setBaseDefense($Bdd);
        $Rfz = $this->rfzRepository->find($idRfz);
        if (!$Rfz){
            $jsonData = array(
                'message' => "Erreur, veuillez renseigner un routeur.",
            );
        }
        else{
            $NewBdd->setIdRfz($Rfz);
            if ($this->isCsrfTokenValid("CreateBdd", $request->get('_token'))){
                $em = $this->ManagerRegistry->getManager();
                $em->persist($NewBdd);
                $em->flush();
            }
            $jsonData = array(
                'message' => 'Base de défense ajoutée',
            );
        }
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
                'message' => "Veuillez sélectionner au moins élément à supprimer",
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
                'message' => "Suppression terminée",
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
        $idRfz = $request->request->get('rfzEdit');
        $Rfz = $this->rfzRepository->find($idRfz);
        $Bdd->setIdRfz($Rfz);

        if ($this->isCsrfTokenValid("EditBdd", $request->get('_token'))) {
            $em = $this->ManagerRegistry->getManager();
            $em->persist($Bdd);
            $em->flush();
        }

        $jsonData = array(
            'message' => 'Base de défense modifiée',
        );

        return $this->json($jsonData, 200);
    }
}