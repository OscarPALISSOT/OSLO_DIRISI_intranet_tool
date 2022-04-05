<?php

namespace App\Controller\administration;

use App\Entity\Cirisi;
use App\Repository\BasesDeDefenseRepository;
use App\Repository\CirisiRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CirisiController extends AbstractController {

    private $CirisiRepository;
    private $ManagerRegistry;
    private $basesDeDefenseRepository;

    public function __construct(CirisiRepository $CirisiRepository, ManagerRegistry $doctrine, BasesDeDefenseRepository $basesDeDefenseRepository)
    {
        $this->CirisiRepository = $CirisiRepository;
        $this->ManagerRegistry = $doctrine;
        $this->basesDeDefenseRepository = $basesDeDefenseRepository;
    }

    /**
     * @Route ("/Admin/Cirisi", name="Admin_Cirisi")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */

    public function index(PaginatorInterface $paginator, Request $request) : Response{
        $Cirisis = $paginator->paginate(
            $this->CirisiRepository->findAllWithBddQuery(),
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/
        );
        return $this->render('administration/cirisi.html.twig', [
            'Cirisis' => $Cirisis,
            'Bdds' => $this->basesDeDefenseRepository->findAll(),
        ]);
    }

    /**
     * @Route ("/Admin/NewCirisi", name="Admin_Cirisi_New")
     * @param Request $request
     * @return Response
     */
    public function newCirisi(Request $request) : Response{
        $NewCirisi = new Cirisi();
        $Cirisi = $request->request->get('cirisi');
        $idCirisi = $request->request->get('bdd');
        $NewCirisi->setCirisi($Cirisi);
        $Bdd = $this->basesDeDefenseRepository->find($idCirisi);
        if (!$Bdd){
            $jsonData = array(
                'message' => "Erreur, veuillez renseigner une base de défense.",
            );
        }
        else{
            $NewCirisi->setIdBaseDefense($Bdd);
            if ($this->isCsrfTokenValid("CreateCirisi", $request->get('_token'))){
                $em = $this->ManagerRegistry->getManager();
                $em->persist($NewCirisi);
                $em->flush();
            }
            $jsonData = array(
                'message' => 'CIRISI ajouté',
            );
        }
        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/Admin/DeleteCirisi", name="Admin_Cirisi_Delete")
     * @param Request $request
     * @return Response
     */
    public function DeleteCirisi(Request $request): Response{
        $Cirisis = $this->CirisiRepository->findAll();
        $nbCirisi = count($Cirisis);
        $ChekedId = array();
        for ( $i = 0; $i < $nbCirisi; $i++){
            if ($request->request->get('idChecked' . $Cirisis[$i]->getIdCirisi())){
                $ChekedId[] = $Cirisis[$i]->getIdCirisi();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'message' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $cirisiToDelete = $this->CirisiRepository->find($item);

                if ($this->isCsrfTokenValid("DeleteCirisi", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
                    $em->remove($cirisiToDelete);
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
     * @Route ("/Admin/EditCirisi/{id}", name="Admin_Cirisi_Edit")
     * @param Request $request
     * @return Response
     */
    public function EditCirisi(Request $request) : Response{
        $id = $request->request->get('idEdit');
        $Cirisi = $this->CirisiRepository->find($id);
        $CirisiName = $request->request->get('cirisiEdit');
        $Cirisi->setCirisi($CirisiName);
        $idBdd = $request->request->get('bddEdit');
        $Bdd = $this->basesDeDefenseRepository->find($idBdd);
        $Cirisi->setIdBaseDefense($Bdd);

        if ($this->isCsrfTokenValid("EditCirisi", $request->get('_token'))) {
            $em = $this->ManagerRegistry->getManager();
            $em->persist($Cirisi);
            $em->flush();
        }

        $jsonData = array(
            'message' => 'CIRISI modifié',
        );

        return $this->json($jsonData, 200);
    }
}
