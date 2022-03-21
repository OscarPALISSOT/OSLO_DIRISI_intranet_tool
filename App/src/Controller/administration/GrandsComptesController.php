<?php

namespace App\Controller\administration;

use App\Entity\GrandsComptes;
use App\Repository\GrandsComptesRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GrandsComptesController extends AbstractController {

    private $GrandsComptesRepository;
    private $ManagerRegistry;

    public function __construct(GrandsComptesRepository $GrandsComptesRepository, ManagerRegistry $doctrine)
    {
        $this->GrandsComptesRepository = $GrandsComptesRepository;
        $this->ManagerRegistry = $doctrine;
    }

    /**
     * @Route ("/Admin/GrandsComptes", name="Admin_GrandsComptes")
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request) : Response{
        $GrandsComptess = $paginator->paginate(
            $this->GrandsComptesRepository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/
        );
        return $this->render('administration/grandsComptes.html.twig', [
            'GrandsComptess' => $GrandsComptess,
        ]);
    }

    /**
     * @Route ("/Admin/NewGrandsComptes", name="Admin_GrandsComptes_New")
     * @param Request $request
     * @return Response
     */
    public function newGrandsComptes(Request $request) : Response{
        $NewGrandsComptes = new GrandsComptes();
        $GrandsComptes = $request->request->get('grandsComptes');
        $NewGrandsComptes->setGrandsComptes($GrandsComptes);
        if ($this->isCsrfTokenValid("CreateGrandsComptes", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($NewGrandsComptes);
            $em->flush();
        }
        $jsonData = array(
            'message' => 'Grand compte ajouté',
        );
        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/Admin/DeleteGrandsComptes", name="Admin_GrandsComptes_Delete")
     * @param Request $request
     * @return Response
     */
    public function DeleteGrandsComptes(Request $request): Response{
        $GrandsComptess = $this->GrandsComptesRepository->findAll();
        $nbGrandsComptes = count($GrandsComptess);
        $ChekedId = array();
        for ( $i = 0; $i < $nbGrandsComptes; $i++){
            if ($request->request->get('idChecked' . $GrandsComptess[$i]->getIdGrandsComptes())){
                $ChekedId[] = $GrandsComptess[$i]->getIdGrandsComptes();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'message' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $grandsComptesToDelete = $this->GrandsComptesRepository->find($item);

                if ($this->isCsrfTokenValid("DeleteGrandsComptes", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
                    $em->remove($grandsComptesToDelete);
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
     * @Route ("/Admin/EditGrandsComptes/{id}", name="Admin_GrandsComptes_Edit")
     * @param Request $request
     * @return Response
     */
    public function EditGrandsComptes(Request $request) : Response{
        $id = $request->request->get('idEdit');
        $GrandsComptes = $this->GrandsComptesRepository->find($id);
        $GrandsComptesName = $request->request->get('grandsComptesEdit');
        $GrandsComptes->setGrandsComptes($GrandsComptesName);

        if ($this->isCsrfTokenValid("EditGrandsComptes", $request->get('_token'))) {
            $em = $this->ManagerRegistry->getManager();
            $em->persist($GrandsComptes);
            $em->flush();
        }

        $jsonData = array(
            'message' => 'Grand compte modifié',
        );

        return $this->json($jsonData, 200);
    }
}