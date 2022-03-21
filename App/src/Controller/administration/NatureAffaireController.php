<?php

namespace App\Controller\administration;

use App\Entity\NatureAffaire;
use App\Repository\NatureAffaireRepository;
use App\Repository\SigleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NatureAffaireController extends AbstractController {

    private NatureAffaireRepository $NatureAffaireRepository;
    private ManagerRegistry $ManagerRegistry;
    private SigleRepository $sigleRepository;
    private NatureAffaireRepository $natureAffaireRepository;

    public function __construct(NatureAffaireRepository $NatureAffaireRepository, ManagerRegistry $doctrine, SigleRepository $sigleRepository, NatureAffaireRepository $natureAffaireRepository)
    {
        $this->NatureAffaireRepository = $NatureAffaireRepository;
        $this->ManagerRegistry = $doctrine;
        $this->sigleRepository = $sigleRepository;
        $this->natureAffaireRepository = $natureAffaireRepository;
    }

    /**
     * @Route ("/Admin/NatureAffaire", name="Admin_NatureAffaire")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request) : Response{
        $NatureAffaires = $paginator->paginate(
            $this->NatureAffaireRepository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/
        );
        return $this->render('administration/natureAffaire.html.twig', [
            'SiglesNature' => $this->sigleRepository->findNatureSigles(),
            'Sigles' => $this->sigleRepository->findSigles(),
            'NatureAffaires' => $NatureAffaires,
        ]);
    }

    /**
     * @Route ("/Admin/NewNatureAffaire", name="Admin_NatureAffaire_New")
     * @param Request $request
     * @return Response
     */
    public function newNatureAffaire(Request $request) : Response{
        $NewNatureAffaire = new NatureAffaire();
        $NatureAffaire = $request->request->get('natureAffaire');
        $NewNatureAffaire->setNatureAffaire($NatureAffaire);
        if (count($this->natureAffaireRepository->findBy([
                'natureAffaire' => $NatureAffaire,
            ])) > 0)
        {
            $jsonData = array(
                'message' => 'Nature déja existante',
            );
        }
        else if ($this->isCsrfTokenValid("CreateNatureAffaire", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($NewNatureAffaire);
            $em->flush();
            $jsonData = array(
                'message' => 'Nature ajoutée',
            );
        }

        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/Admin/DeleteNatureAffaire", name="Admin_NatureAffaire_Delete")
     * @param Request $request
     * @return Response
     */
    public function DeleteNatureAffaire(Request $request): Response{
        $NatureAffaires = $this->NatureAffaireRepository->findAll();
        $nbNatureAffaire = count($NatureAffaires);
        $ChekedId = array();
        for ( $i = 0; $i < $nbNatureAffaire; $i++){
            if ($request->request->get('idChecked' . $NatureAffaires[$i]->getIdNatureAffaire())){
                $ChekedId[] = $NatureAffaires[$i]->getIdNatureAffaire();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'message' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $natureAffaireToDelete = $this->NatureAffaireRepository->find($item);

                if ($this->isCsrfTokenValid("DeleteNatureAffaire", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
                    $em->remove($natureAffaireToDelete);
                    $em->flush();
                }

            }
            $jsonData = array(
                'message' => "Suppression terminée",
            );
        }
        return $this->json($jsonData, 200);
    }
}