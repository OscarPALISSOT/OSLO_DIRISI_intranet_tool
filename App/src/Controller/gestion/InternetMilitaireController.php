<?php

namespace App\Controller\gestion;

use App\Data\SearchDataInternetMilitaire;
use App\Entity\InternetMilitaire;
use App\form\filters\InternetMilitaireSearchForm;
use App\Repository\FebRepository;
use App\Repository\InternetMilitaireRepository;
use App\Repository\OrganismeRepository;
use App\Repository\PriorisationRepository;
use App\Repository\QuartiersRepository;
use App\Repository\SigleRepository;
use App\Repository\SupportInternetMilitaireRepository;
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

class InternetMilitaireController extends AbstractController {

    private ManagerRegistry $ManagerRegistry;
    private OrganismeRepository $organismeRepository;
    private SigleRepository $sigleRepository;
    private PriorisationRepository $priorisationRepository;
    private InternetMilitaireRepository $internetMilitaireRepository;
    private QuartiersRepository $quartiersRepository;
    private SupportInternetMilitaireRepository $supportInternetMilitaireRepository;

    public function __construct(ManagerRegistry $doctrine, OrganismeRepository $organismeRepository, SigleRepository $sigleRepository, PriorisationRepository $priorisationRepository, InternetMilitaireRepository $internetMilitaireRepository, QuartiersRepository $quartiersRepository, SupportInternetMilitaireRepository $supportInternetMilitaireRepository)
    {
        $this->ManagerRegistry = $doctrine;
        $this->organismeRepository = $organismeRepository;
        $this->sigleRepository = $sigleRepository;
        $this->priorisationRepository = $priorisationRepository;
        $this->internetMilitaireRepository = $internetMilitaireRepository;
        $this->quartiersRepository = $quartiersRepository;
        $this->supportInternetMilitaireRepository = $supportInternetMilitaireRepository;
    }


    /**
     * @Route ("/{role}/InternetMilitaire", name="InternetMilitaire")
     * @param Paginator $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request) : Response{

        $Data = new SearchDataInternetMilitaire();
        $Data->page =$request->get('page', 1);
        $form = $this->createForm(InternetMilitaireSearchForm::class, $Data);
        $form->handleRequest($request);

        $InternetMilitaires = $this->internetMilitaireRepository->findInternetMilitaireSearch($Data);

        $role = $this->getUser()->getRoles();
        if ($role[0] == 'ROLE_ADMIN'){
            $role[0] = $request->get('role');

        }
        $sigles = $this->sigleRepository->findSigles();
        if ($request->get('Ajax')){
            return new JsonResponse([
                'content' => $this->renderView('gestion/internetMilitaire/_content.html.twig', [
                    'InternetMilitaires' => $InternetMilitaires,
                    'Organismes' => $this->organismeRepository->findAllWithQuartier(),
                    'Supports' =>$this->supportInternetMilitaireRepository->findAll(),
                ]),
                'sorting' => $this->renderView('gestion/internetMilitaire/_sorting.html.twig', [
                    'InternetMilitaires' => $InternetMilitaires,
                ]),
                'pagination' => $this->renderView('gestion/internetMilitaire/_pagination.html.twig', [
                    'InternetMilitaires' => $InternetMilitaires,
                ]),
                'secondModal' => $this->renderView('gestion/_secondModal.html.twig'),
            ]);
        }
        return $this->render('gestion/internetMilitaire/InternetMilitaire.html.twig', [
            'InternetMilitaires' => $InternetMilitaires,
            'Organismes' => $this->organismeRepository->findAllWithQuartier(),
            'Supports' =>$this->supportInternetMilitaireRepository->findAll(),
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
     * @Route ("/NewInternetMilitaire", name="Admin_InternetMilitaire_New")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function newInternetMilitaire(Request $request) : Response{
        $masterId = $request->request->get('masterId');
        $idoOrga = $request->request->get('orga');
        $orga = $this->organismeRepository->find($idoOrga);
        $idSupport = $request->request->get('support');
        $support = $this->supportInternetMilitaireRepository->find($idSupport);
        $debit = $request->request->get('Debit');
        $etat = $request->request->get('etat');
        $ipPfs = $request->request->get('ipPfs');
        $ipLanSubnet = $request->request->get('ipLanSubnet');
        $Date = $request->request->get('date');
        $date = new DateTime($Date);
        $date->format('Y-m-d');
        $comment = $request->request->get('comment');
        $NewInternetMilitaire = (new InternetMilitaire())
            ->setMasterId($masterId)
            ->setIdOrganisme($orga)
            ->setIdSupport($support)
            ->setDebitInternetMilitaire($debit)
            ->setEtatInternetMilitaire($etat)
            ->setIpPfs($ipPfs)
            ->setIpLanSubnet($ipLanSubnet)
            ->setDateDeValidation($date)
            ->setCommentaire($comment)
        ;
        if ($this->isCsrfTokenValid("CreateInternetMilitaire", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($NewInternetMilitaire);
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
     * @Route ("/DeleteInternetMilitaire", name="Admin_InternetMilitaire_Delete")
     * @param Request $request
     * @return Response
     */
    public function DeleteInternetMilitaire(Request $request): Response{
        $InternetMilitaires = $this->internetMilitaireRepository->findAll();
        $nbInternetMilitaire = count($InternetMilitaires);
        $ChekedId = array();
        for ( $i = 0; $i < $nbInternetMilitaire; $i++){
            if ($request->request->get('idChecked' . $InternetMilitaires[$i]->getIdInternetMilitaire())){
                $ChekedId[] = $InternetMilitaires[$i]->getIdInternetMilitaire();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'message' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $internetMilitaireToDelete = $this->internetMilitaireRepository->find($item);

                if ($this->isCsrfTokenValid("DeleteInternetMilitaire", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
                    $em->remove($internetMilitaireToDelete);
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
     * @Route ("/EditInternetMilitaire/{id}", name="Admin_InternetMilitaire_Edit")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function EditInternetMilitaire(Request $request) : Response{
        $id = $request->request->get('idEdit');
        $masterId = $request->request->get('masterIdEdit');
        $idoOrga = $request->request->get('orgaEdit');
        $orga = $this->organismeRepository->find($idoOrga);
        $idSupport = $request->request->get('supportEdit');
        $support = $this->supportInternetMilitaireRepository->find($idSupport);
        $debit = $request->request->get('DebitEdit');
        $etat = $request->request->get('etatEdit');
        $ipPfs = $request->request->get('ipPfsEdit');
        $ipLanSubnet = $request->request->get('ipLanSubnetEdit');
        $Date = $request->request->get('dateEdit');
        $date = new DateTime($Date);
        $date->format('Y-m-d');
        $comment = $request->request->get('commentEdit');
        $InternetMilitaire = $this->internetMilitaireRepository->find($id)
            ->setMasterId($masterId)
            ->setIdOrganisme($orga)
            ->setIdSupport($support)
            ->setDebitInternetMilitaire($debit)
            ->setEtatInternetMilitaire($etat)
            ->setIpPfs($ipPfs)
            ->setIpLanSubnet($ipLanSubnet)
            ->setDateDeValidation($date)
            ->setCommentaire($comment)
        ;

        if ($this->isCsrfTokenValid("EditInternetMilitaire", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($InternetMilitaire);
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
     * @Route ("/Admin/ImportInternetMilitaire", name="importInternetMilitaire")
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
                $InternetMilitaire = (new InternetMilitaire())
                    ->setMasterId($row['Master ID'])
                    ->setDebitInternetMilitaire($row['debit'])
                    ->setIpLanSubnet($row['IP LAN subnet'])
                    ->setIpPfs($row['adresse IP PFS'])
                    ->setIdOrganisme(
                        $this->organismeRepository->findOneBy([
                            'organisme' => $row['Entité'],
                            'idQuartier' => $this->quartiersRepository->findOneBy([
                                'trigramme' => $row['TRI']
                            ])->getIdQuartier(),
                        ])
                    )
                ;
                $em->persist($InternetMilitaire);
                $em->flush();
            }

            $jsonData = array(
                'message' => "Importation terminée",
            );
        }

        return $this->json($jsonData, 200);
    }

}