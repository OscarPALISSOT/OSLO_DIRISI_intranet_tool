<?php

namespace App\Controller\administration;

use App\Entity\Organisme;
use App\Repository\OrganismeRepository;
use App\Repository\QuartiersRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OrganismeController extends AbstractController {

    private OrganismeRepository $OrganismeRepository;
    private ManagerRegistry $ManagerRegistry;
    private QuartiersRepository $quartiersRepository;

    public function __construct(OrganismeRepository $OrganismeRepository, ManagerRegistry $doctrine, QuartiersRepository $quartiersRepository)
    {
        $this->OrganismeRepository = $OrganismeRepository;
        $this->ManagerRegistry = $doctrine;
        $this->quartiersRepository = $quartiersRepository;
    }

    /**
     * @Route ("/Admin/Organisme", name="Admin_Organisme")
     * @return Response
     */
    public function index() : Response{
        return $this->render('administration/organisme.html.twig', [
            'Organismes' => $this->OrganismeRepository->findAllWithQuartier(),
            'Quartiers' => $this->quartiersRepository->findAllWithBdd(),
        ]);
    }

    /**
     * @Route ("/Admin/NewOrganisme", name="Admin_Organisme_New")
     * @param Request $request
     * @return Response
     */
    public function newOrganisme(Request $request) : Response{
        $NewOrganisme = new Organisme();
        $Organisme = $request->request->get('organisme');
        $idQuartier = $request->request->get('quartier');
        $NewOrganisme->setOrganisme($Organisme);
        $Quartier = $this->quartiersRepository->find($idQuartier);
        if (!$Quartier){
            $jsonData = array(
                'Organisme' => "Erreur, veuillez renseigner une base de défense.",
            );
        }
        else{
            $NewOrganisme->setIdQuartier($Quartier);
            if ($this->isCsrfTokenValid("CreateOrganisme", $request->get('_token'))){
                $em = $this->ManagerRegistry->getManager();
                $em->persist($NewOrganisme);
                $em->flush();
            }
            $jsonData = array(
                'Organisme' => $Organisme,
            );
        }
        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/Admin/DeleteOrganisme", name="Admin_Organisme_Delete")
     * @param Request $request
     * @return Response
     */
    public function DeleteOrganisme(Request $request): Response{
        $Organismes = $this->OrganismeRepository->findAll();
        $nbOrganisme = count($Organismes);
        $ChekedId = array();
        for ( $i = 0; $i < $nbOrganisme; $i++){
            if ($request->request->get('idChecked' . $Organismes[$i]->getIdOrganisme())){
                $ChekedId[] = $Organismes[$i]->getIdOrganisme();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'Organisme' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $organismeToDelete = $this->OrganismeRepository->find($item);

                if ($this->isCsrfTokenValid("DeleteOrganisme", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
                    $em->remove($organismeToDelete);
                    $em->flush();
                }

            }
            $jsonData = array(
                'Organisme' => "Suppression terminée",
            );
        }
        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/Admin/EditOrganisme/{id}", name="Admin_Organisme_Edit")
     * @param Request $request
     * @return Response
     */
    public function EditOrganisme(Request $request) : Response{
        $id = $request->request->get('idEdit');
        $Organisme = $this->OrganismeRepository->find($id);
        $OrganismeName = $request->request->get('organismeEdit');
        $Organisme->setOrganisme($OrganismeName);
        $idQuartier = $request->request->get('quartierEdit');
        $Quartier = $this->quartiersRepository->find($idQuartier);
        $Organisme->setIdQuartier($Quartier);

        if ($this->isCsrfTokenValid("EditOrganisme", $request->get('_token'))) {
            $em = $this->ManagerRegistry->getManager();
            $em->persist($Organisme);
            $em->flush();
        }

        $jsonData = array(
            'Organisme' => $Organisme->getOrganisme(),
        );

        return $this->json($jsonData, 200);
    }
}
