<?php

namespace App\Controller\administration;

use App\Entity\Quartiers;
use App\Repository\BasesDeDefenseRepository;
use App\Repository\QuartiersRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class QuartiersController extends AbstractController {

    private $QuartiersRepository;
    private $ManagerRegistry;
    private $basesDeDefenseRepository;

    public function __construct(QuartiersRepository $QuartiersRepository, ManagerRegistry $doctrine, BasesDeDefenseRepository $basesDeDefenseRepository)
    {
        $this->QuartiersRepository = $QuartiersRepository;
        $this->ManagerRegistry = $doctrine;
        $this->basesDeDefenseRepository = $basesDeDefenseRepository;
    }

    /**
     * @Route ("/Admin/Quartiers", name="Admin_Quartiers")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request) : Response{
        $Quartiers = $paginator->paginate(
            $this->QuartiersRepository->findAllWithBdd(),
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/
        );
        return $this->render('administration/quartiers.html.twig', [
            'Quartierss' => $Quartiers,
            'Bdds' => $this->basesDeDefenseRepository->findAll(),
        ]);
    }

    /**
     * @Route ("/Admin/NewQuartiers", name="Admin_Quartiers_New")
     * @param Request $request
     * @return Response
     */
    public function newQuartiers(Request $request) : Response{
        $NewQuartiers = new Quartiers();
        $Quartiers = $request->request->get('quartiers');
        $idQuartiers = $request->request->get('bdd');
        $trigramme = $request->request->get('trigramme');
        $adresseQuartiers = $request->request->get('adresseQuartier');
        $NewQuartiers->setQuartier($Quartiers);
        $NewQuartiers->setTrigramme($trigramme);
        $NewQuartiers->setAdresseQuartier($adresseQuartiers);
        $Bdd = $this->basesDeDefenseRepository->find($idQuartiers);
        if (!$Bdd){
            $jsonData = array(
                'message' => "Erreur, veuillez renseigner une base de défense.",
            );
        }
        else{
            $NewQuartiers->setIdBaseDefense($Bdd);
            if ($this->isCsrfTokenValid("CreateQuartiers", $request->get('_token'))){
                $em = $this->ManagerRegistry->getManager();
                $em->persist($NewQuartiers);
                $em->flush();
            }
            $jsonData = array(
                'message' => 'Presentation ajouté',
            );
        }
        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/Admin/DeleteQuartiers", name="Admin_Quartiers_Delete")
     * @param Request $request
     * @return Response
     */
    public function DeleteQuartiers(Request $request): Response{
        $Quartierss = $this->QuartiersRepository->findAll();
        $nbQuartiers = count($Quartierss);
        $ChekedId = array();
        for ( $i = 0; $i < $nbQuartiers; $i++){
            if ($request->request->get('idChecked' . $Quartierss[$i]->getIdQuartier())){
                $ChekedId[] = $Quartierss[$i]->getIdQuartier();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'message' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $quartiersToDelete = $this->QuartiersRepository->find($item);

                if ($this->isCsrfTokenValid("DeleteQuartiers", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
                    $em->remove($quartiersToDelete);
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
     * @Route ("/Admin/EditQuartiers/{id}", name="Admin_Quartiers_Edit")
     * @param Request $request
     * @return Response
     */
    public function EditQuartiers(Request $request) : Response{
        $id = $request->request->get('idEdit');
        $Quartiers = $this->QuartiersRepository->find($id);
        $QuartiersName = $request->request->get('quartiersEdit');
        $trigrammeEdit = $request->request->get('trigrammeEdit');
        $adresseEdit = $request->request->get('adresseQuartierEdit');
        $Quartiers->setQuartier($QuartiersName);
        $Quartiers->setTrigramme($trigrammeEdit);
        $Quartiers->setAdresseQuartier($adresseEdit);
        $idBdd = $request->request->get('bddEdit');
        $Bdd = $this->basesDeDefenseRepository->find($idBdd);
        $Quartiers->setIdBaseDefense($Bdd);

        if ($this->isCsrfTokenValid("EditQuartiers", $request->get('_token'))) {
            $em = $this->ManagerRegistry->getManager();
            $em->persist($Quartiers);
            $em->flush();
        }

        $jsonData = array(
            'message' => 'Presentation modifié',
        );

        return $this->json($jsonData, 200);
    }
}
