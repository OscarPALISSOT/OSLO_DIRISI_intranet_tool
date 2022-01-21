<?php

namespace App\Controller\administration;

use App\Entity\Cirisi;
use App\Repository\BasesDeDefenseRepository;
use App\Repository\CirisiRepository;
use App\Repository\RfzRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CirisiController extends AbstractController {

    private CirisiRepository $CirisiRepository;
    private ManagerRegistry $ManagerRegistry;
    private BasesDeDefenseRepository $basesDeDefenseRepository;

    public function __construct(CirisiRepository $CirisiRepository, ManagerRegistry $doctrine, BasesDeDefenseRepository $basesDeDefenseRepository)
    {
        $this->CirisiRepository = $CirisiRepository;
        $this->ManagerRegistry = $doctrine;
        $this->basesDeDefenseRepository = $basesDeDefenseRepository;
    }

    /**
     * @Route ("/Admin/Cirisi", name="Admin_Cirisi")
     * @return Response
     */
    public function index() : Response{
        return $this->render('administration/cirisi.html.twig', [
            'Cirisis' => $this->CirisiRepository->findAllWithBdd(),
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
        $NewCirisi->setIdBaseDefense($Bdd);
        if ($this->isCsrfTokenValid("CreateCirisi", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($NewCirisi);
            $em->flush();
        }
        $jsonData = array(
            'Cirisi' => $Cirisi,
        );
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
                'Cirisi' => "Veuillez sélectionner au moins élément à supprimer",
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
                'Cirisi' => "Suppression terminée",
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
            'Cirisi' => $Cirisi->getCirisi(),
        );

        return $this->json($jsonData, 200);
    }
}
