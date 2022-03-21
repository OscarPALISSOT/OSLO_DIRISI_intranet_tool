<?php

namespace App\Controller\administration;

use App\Entity\SupportInternetMilitaire;
use App\Repository\SigleRepository;
use App\Repository\SupportInternetMilitaireRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SupportInternetMilitaireController extends AbstractController {

    private $SupportInternetMilitaireRepository;
    private $ManagerRegistry;
    private $sigleRepository;

    public function __construct(SupportInternetMilitaireRepository $SupportInternetMilitaireRepository, ManagerRegistry $doctrine, SigleRepository $sigleRepository)
    {
        $this->SupportInternetMilitaireRepository = $SupportInternetMilitaireRepository;
        $this->ManagerRegistry = $doctrine;
        $this->sigleRepository = $sigleRepository;
    }

    /**
     * @Route ("/Admin/SupportInternetMilitaire", name="Admin_SupportInternetMilitaire")
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request) : Response{
        $SupportInternetMilitaires = $paginator->paginate(
            $this->SupportInternetMilitaireRepository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/
        );
        $sigles = $this->sigleRepository->findSigles();
        return $this->render('administration/supportInternetMilitaire.html.twig', [
            'SupportInternetMilitaires' => $SupportInternetMilitaires,
            'sigles' => $sigles,
        ]);
    }

    /**
     * @Route ("/Admin/NewSupportInternetMilitaire", name="Admin_SupportInternetMilitaire_New")
     * @param Request $request
     * @return Response
     */
    public function newSupportInternetMilitaire(Request $request) : Response{
        $NewSupportInternetMilitaire = new SupportInternetMilitaire();
        $SupportInternetMilitaire = $request->request->get('supportInternetMilitaire');
        $NewSupportInternetMilitaire->setSupport($SupportInternetMilitaire);
        if ($this->isCsrfTokenValid("CreateSupportInternetMilitaire", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($NewSupportInternetMilitaire);
            $em->flush();
        }
        $jsonData = array(
            'message' => 'Support ajouté',
        );
        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/Admin/DeleteSupportInternetMilitaire", name="Admin_SupportInternetMilitaire_Delete")
     * @param Request $request
     * @return Response
     */
    public function DeleteSupportInternetMilitaire(Request $request): Response{
        $SupportInternetMilitaires = $this->SupportInternetMilitaireRepository->findAll();
        $nbSupportInternetMilitaire = count($SupportInternetMilitaires);
        $ChekedId = array();
        for ( $i = 0; $i < $nbSupportInternetMilitaire; $i++){
            if ($request->request->get('idChecked' . $SupportInternetMilitaires[$i]->getIdSupportInternetMilitaire())){
                $ChekedId[] = $SupportInternetMilitaires[$i]->getIdSupportInternetMilitaire();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'message' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $supportInternetMilitaireToDelete = $this->SupportInternetMilitaireRepository->find($item);

                if ($this->isCsrfTokenValid("DeleteSupportInternetMilitaire", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
                    $em->remove($supportInternetMilitaireToDelete);
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
     * @Route ("/Admin/EditSupportInternetMilitaire/{id}", name="Admin_SupportInternetMilitaire_Edit")
     * @param Request $request
     * @return Response
     */
    public function EditSupportInternetMilitaire(Request $request) : Response{
        $id = $request->request->get('idEdit');
        $SupportInternetMilitaire = $this->SupportInternetMilitaireRepository->find($id);
        $SupportInternetMilitaireName = $request->request->get('supportInternetMilitaireEdit');
        $SupportInternetMilitaire->setSupport($SupportInternetMilitaireName);

        if ($this->isCsrfTokenValid("EditSupportInternetMilitaire", $request->get('_token'))) {
            $em = $this->ManagerRegistry->getManager();
            $em->persist($SupportInternetMilitaire);
            $em->flush();
        }

        $jsonData = array(
            'message' => 'Support modifié',
        );

        return $this->json($jsonData, 200);
    }
}