<?php

namespace App\Controller\administration;

use App\Entity\Sigle;
use App\Repository\SigleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SigleController extends AbstractController {

    private SigleRepository $SigleRepository;
    private ManagerRegistry $ManagerRegistry;

    public function __construct(SigleRepository $SigleRepository, ManagerRegistry $doctrine)
    {
        $this->SigleRepository = $SigleRepository;
        $this->ManagerRegistry = $doctrine;
    }

    /**
     * @Route ("/Admin/Sigles", name="Admin_Sigle")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request) : Response{
        $Sigles = $paginator->paginate(
            $this->SigleRepository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/
        );
        return $this->render('administration/sigle.html.twig', [
            'Sigles' => $Sigles,
        ]);
    }

    /**
     * @Route ("/Admin/NewSigle", name="Admin_Sigle_New")
     * @param Request $request
     * @return Response
     */
    public function newSigle(Request $request) : Response{
        $NewSigle = new Sigle();
        $Sigle = $request->request->get('sigles');
        $intituleSigle = $request->request->get('intituleSigles');
        $NewSigle->setSigle($Sigle);
        $NewSigle->setIntituleSigle($intituleSigle);
        if (count($this->SigleRepository->findBy([
            'intituleSigle' => $intituleSigle,
        ])) > 0)
        {
            $jsonData = array(
                'message' => 'Sigle déjà existant pour cette entité',
            );
        }
        else if ($this->isCsrfTokenValid("CreateSigle", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($NewSigle);
            $em->flush();
            $jsonData = array(
                'message' => 'Sigle ajouté',
            );
        }
        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/Admin/DeleteSigle", name="Admin_Sigle_Delete")
     * @param Request $request
     * @return Response
     */
    public function DeleteSigle(Request $request): Response{
        $Sigles = $this->SigleRepository->findAll();
        $nbSigle = count($Sigles);
        $ChekedId = array();
        for ( $i = 0; $i < $nbSigle; $i++){
            if ($request->request->get('idChecked' . $Sigles[$i]->getIdSigle())){
                $ChekedId[] = $Sigles[$i]->getIdSigle();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'message' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $siglesToDelete = $this->SigleRepository->find($item);

                if ($this->isCsrfTokenValid("DeleteSigle", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
                    $em->remove($siglesToDelete);
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
     * @Route ("/Admin/EditSigle/{id}", name="Admin_Sigle_Edit")
     * @param Request $request
     * @return Response
     */
    public function EditSigle(Request $request) : Response{
        $id = $request->request->get('idEdit');
        $Sigle = $this->SigleRepository->find($id);
        $SigleName = $request->request->get('siglesEdit');
        $SigleIntitule = $request->request->get('intituleSiglesEdit');
        $Sigle->setSigle($SigleName);
        $Sigle->setIntituleSigle($SigleIntitule);

        if ($this->isCsrfTokenValid("EditSigle", $request->get('_token'))) {
            $em = $this->ManagerRegistry->getManager();
            $em->persist($Sigle);
            $em->flush();
        }

        $jsonData = array(
            'message' => 'Sigle modifié',
        );

        return $this->json($jsonData, 200);
    }
}