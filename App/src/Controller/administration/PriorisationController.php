<?php

namespace App\Controller\administration;

use App\Entity\Priorisation;
use App\Repository\PriorisationRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PriorisationController extends AbstractController {

    private PriorisationRepository $PriorisationRepository;
    private ManagerRegistry $ManagerRegistry;

    public function __construct(PriorisationRepository $PriorisationRepository, ManagerRegistry $doctrine)
    {
        $this->PriorisationRepository = $PriorisationRepository;
        $this->ManagerRegistry = $doctrine;
    }

    /**
     * @Route ("/Admin/Priorisation", name="Admin_Priorisation")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request) : Response{
        $Priorisations = $paginator->paginate(
            $this->PriorisationRepository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/
        );
        return $this->render('administration/priorisation.html.twig', [
            'Priorisations' => $Priorisations,
        ]);
    }

    /**
     * @Route ("/Admin/NewPriorisation", name="Admin_Priorisation_New")
     * @param Request $request
     * @return Response
     */
    public function newPriorisation(Request $request) : Response{
        $NewPriorisation = new Priorisation();
        $Priorisation = $request->request->get('priorisation');
        $NewPriorisation->setPriorisation($Priorisation);
        if ($this->isCsrfTokenValid("CreatePriorisation", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($NewPriorisation);
            $em->flush();
        }
        $jsonData = array(
            'message' => 'Priorisation ajoutée',
        );
        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/Admin/DeletePriorisation", name="Admin_Priorisation_Delete")
     * @param Request $request
     * @return Response
     */
    public function DeletePriorisation(Request $request): Response{
        $Priorisations = $this->PriorisationRepository->findAll();
        $nbPriorisation = count($Priorisations);
        $ChekedId = array();
        for ( $i = 0; $i < $nbPriorisation; $i++){
            if ($request->request->get('idChecked' . $Priorisations[$i]->getIdPriorisation())){
                $ChekedId[] = $Priorisations[$i]->getIdPriorisation();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'message' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $priorisationToDelete = $this->PriorisationRepository->find($item);

                if ($this->isCsrfTokenValid("DeletePriorisation", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
                    $em->remove($priorisationToDelete);
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
     * @Route ("/Admin/EditPriorisation/{id}", name="Admin_Priorisation_Edit")
     * @param Request $request
     * @return Response
     */
    public function EditPriorisation(Request $request) : Response{
        $id = $request->request->get('idEdit');
        $Priorisation = $this->PriorisationRepository->find($id);
        $PriorisationName = $request->request->get('priorisationEdit');
        $Priorisation->setPriorisation($PriorisationName);

        if ($this->isCsrfTokenValid("EditPriorisation", $request->get('_token'))) {
            $em = $this->ManagerRegistry->getManager();
            $em->persist($Priorisation);
            $em->flush();
        }

        $jsonData = array(
            'message' => 'Priorisation modifiée',
        );

        return $this->json($jsonData, 200);
    }
}