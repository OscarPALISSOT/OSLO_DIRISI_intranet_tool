<?php

namespace App\Controller\gestion;

use App\Data\SearchDataAffaire;
use App\Entity\Affaire;
use App\form\filters\AffaireSearchForm;
use App\Repository\AffaireRepository;
use App\Repository\OrganismeRepository;
use App\Repository\PriorisationRepository;
use App\Repository\QuartiersRepository;
use App\Repository\SigleRepository;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use League\Csv\Reader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AffaireController extends AbstractController {

    private $ManagerRegistry;
    private $organismeRepository;
    private $sigleRepository;
    private $priorisationRepository;
    private $affaireRepository;
    private $quartiersRepository;

    public function __construct(ManagerRegistry $doctrine, OrganismeRepository $organismeRepository, SigleRepository $sigleRepository, PriorisationRepository $priorisationRepository, AffaireRepository $affaireRepository, QuartiersRepository $quartiersRepository)
    {
        $this->ManagerRegistry = $doctrine;
        $this->organismeRepository = $organismeRepository;
        $this->sigleRepository = $sigleRepository;
        $this->priorisationRepository = $priorisationRepository;
        $this->affaireRepository = $affaireRepository;
        $this->quartiersRepository = $quartiersRepository;
    }


    /**
     * @Route ("/{role}/Affaire", name="Affaire")
     * @param Paginator $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request) : Response{

        $Data = new SearchDataAffaire();
        $Data->page =$request->get('page', 1);
        $form = $this->createForm(AffaireSearchForm::class, $Data);
        $form->handleRequest($request);

        $Affaires = $this->affaireRepository->findAffaireSearch($Data);

        $role = $this->getUser()->getRoles();
        if ($role[0] == 'ROLE_ADMIN'){
            $role[0] = $request->get('role');

        }
        $sigles = $this->sigleRepository->findSigles();
        if ($request->get('Ajax')){
            return new JsonResponse([
                'content' => $this->renderView('gestion/affaire/_content.html.twig', [
                    'Affaires' => $Affaires,
                    'Organismes' => $this->organismeRepository->findAllWithQuartier(),
                ]),
                'sorting' => $this->renderView('gestion/affaire/_sorting.html.twig', [
                    'Affaires' => $Affaires,
                ]),
                'pagination' => $this->renderView('gestion/affaire/_pagination.html.twig', [
                    'Affaires' => $Affaires,
                ]),
                'secondModal' => $this->renderView('gestion/_secondModal.html.twig'),
            ]);
        }
        return $this->render('gestion/affaire/affaire.html.twig', [
            'Affaires' => $Affaires,
            'Organismes' => $this->organismeRepository->findAllWithQuartier(),
            'role' => $role[0],
            'title' => $this->sigleRepository->findOneBy([
                'intituleSigle' => 'internet_militaire'
            ]),
            'Prios' => $this->priorisationRepository->findAll(),
            'form' => $form->createView(),
            'sigles' => $sigles,
        ]);
    }


    /**
     * @Route ("/NewAffaire", name="Admin_Affaire_New")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function newAffaire(Request $request) : Response{
        $masterId = $request->request->get('masterId');
        $idoOrga = $request->request->get('orga');
        $orga = $this->organismeRepository->find($idoOrga);
        $idSupport = $request->request->get('support');
        $support = $this->supportAffaireRepository->find($idSupport);
        $debit = $request->request->get('Debit');
        $etat = $request->request->get('etat');
        $ipPfs = $request->request->get('ipPfs');
        $ipLanSubnet = $request->request->get('ipLanSubnet');
        $comment = $request->request->get('comment');
        $NewAffaire = (new Affaire())
            ->setMasterId($masterId)
            ->setIdOrganisme($orga)
            ->setIdSupport($support)
            ->setDebitAffaire($debit)
            ->setEtatAffaire($etat)
            ->setIpPfs($ipPfs)
            ->setIpLanSubnet($ipLanSubnet)
            ->setCommentaire($comment)
        ;
        if ($this->isCsrfTokenValid("CreateAffaire", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($NewAffaire);
            $em->flush();

            $jsonData = array(
                'message' => $this->sigleRepository->findOneBy([
                    'intituleSigle' => 'internet_militaire'
                ]) . ' ajouté',
            );
        }
        else{
            $jsonData = array(
                'message' => "Erreur lors de l'ajout",
            );
        }
        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/DeleteAffaire", name="Admin_Affaire_Delete")
     * @param Request $request
     * @return Response
     */
    public function DeleteAffaire(Request $request): Response{
        $Affaires = $this->affaireRepository->findAll();
        $nbAffaire = count($Affaires);
        $ChekedId = array();
        for ( $i = 0; $i < $nbAffaire; $i++){
            if ($request->request->get('idChecked' . $Affaires[$i]->getIdAffaire())){
                $ChekedId[] = $Affaires[$i]->getIdAffaire();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'message' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $affaireToDelete = $this->affaireRepository->find($item);

                if ($this->isCsrfTokenValid("DeleteAffaire", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
                    $em->remove($affaireToDelete);
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
     * @Route ("/EditAffaire/{id}", name="Admin_Affaire_Edit")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function EditAffaire(Request $request) : Response{
        $id = $request->request->get('idEdit');
        $masterId = $request->request->get('masterIdEdit');
        $idoOrga = $request->request->get('orgaEdit');
        $orga = $this->organismeRepository->find($idoOrga);
        $idSupport = $request->request->get('supportEdit');
        $support = $this->supportAffaireRepository->find($idSupport);
        $debit = $request->request->get('DebitEdit');
        $etat = $request->request->get('etatEdit');
        $ipPfs = $request->request->get('ipPfsEdit');
        $ipLanSubnet = $request->request->get('ipLanSubnetEdit');
        $date = new DateTime();
        $date->format('Y-m-d');
        $comment = $request->request->get('commentEdit');
        $Affaire = $this->affaireRepository->find($id)
            ->setMasterId($masterId)
            ->setIdOrganisme($orga)
            ->setIdSupport($support)
            ->setDebitAffaire($debit)
            ->setEtatAffaire($etat)
            ->setIpPfs($ipPfs)
            ->setIpLanSubnet($ipLanSubnet)
            ->setCommentaire($comment)
            ->setUpdateAt($date)
        ;

        if ($this->isCsrfTokenValid("EditAffaire", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($Affaire);
            $em->flush();
            $jsonData = array(
                'message' => $this->sigleRepository->findOneBy([
                        'intituleSigle' => 'internet_militaire'
                    ]) .' modifié',
            );

        }
        else{
            $jsonData = array(
                'message' => "Erreur lors de la modification",
            );
        }

        return $this->json($jsonData, 200);
    }


    /**
     * @Route ("/Admin/ImportAffaire", name="importAffaire")
     * @param Request $request
     * @return JsonResponse
     */
    public function import(Request $request) : JsonResponse
    {
        $file = $request->files->get('file', 'r');

        if ($file == null){
            $jsonData = array(
                'message' => "Erreur, veuillez renseignez un fichier.",
            );
        }
        else{

            $oldMessage = ',';

            $deletedFormat = '.';

            $str=file_get_contents($file->getRealPath());

            $str=str_replace($oldMessage, $deletedFormat,$str);
            file_put_contents($file->getRealPath(), $str);

            $oldMessage = ';';

            $deletedFormat = ',';

            $str=file_get_contents($file->getRealPath());

            $str=str_replace($oldMessage, $deletedFormat,$str);
            file_put_contents($file->getRealPath(), $str);
            $em = $this->ManagerRegistry->getManager();
            $csv = Reader::createFromPath($file->getRealPath());
            $csv->setHeaderOffset(0);
            $result = $csv->getRecords();


            foreach ( $result as $row){
                $Affaire = (new Affaire())
                    ->setMasterId($row['Master ID'])
                    ->setDebitAffaire($row['debit'])
                    ->setIpLanSubnet($row['IP LAN subnet'])
                    ->setIpPfs($row['adresse IP PFS'])
                    ->setIdOrganisme(
                        $this->organismeRepository->findOneBy([
                            'organisme' => $row['Entité'],
                            'idQuartier' => $this->quartiersRepository->findOneBy([
                                'trigramme' => $row['TRI']
                            ]),
                        ])
                    )
                    ->setIdSupport(
                        $this->supportAffaireRepository->findOneBy([
                            'support' => $row['support']
                        ])
                    )
                    ->setEtatAffaire(1)
                ;
                $em->persist($Affaire);
                $em->flush();
            }

            $jsonData = array(
                'message' => "Importation terminée",
            );
        }

        return $this->json($jsonData, 200);
    }

}