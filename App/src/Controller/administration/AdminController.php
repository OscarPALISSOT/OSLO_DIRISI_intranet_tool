<?php

namespace App\Controller\administration;

use App\Entity\BasesDeDefense;
use App\Entity\Cirisi;
use App\Entity\Organisme;
use App\Entity\Quartiers;
use App\Entity\Rfz;
use App\Repository\BasesDeDefenseRepository;
use App\Repository\CirisiRepository;
use App\Repository\ContactRepository;
use App\Repository\EtatPdcRepository;
use App\Repository\GrandsComptesRepository;
use App\Repository\NatureAffaireRepository;
use App\Repository\OrganismeRepository;
use App\Repository\PriorisationRepository;
use App\Repository\QuartiersRepository;
use App\Repository\RfzRepository;
use App\Repository\SigleRepository;
use App\Repository\StatutPdcRepository;
use App\Repository\UsersRepository;
use Doctrine\Persistence\ManagerRegistry;
use League\Csv\Reader;
use phpDocumentor\Reflection\Types\This;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController {

    private RfzRepository $RfzRepository;
    private BasesDeDefenseRepository $BasesDeDefenseRepository;
    private ContactRepository $ContactRepository;
    private CirisiRepository $cirisiRepository;
    private QuartiersRepository $quartiersRepository;
    private OrganismeRepository $organismeRepository;
    private UsersRepository $usersRepository;
    private SigleRepository $sigleRepository;
    private GrandsComptesRepository $grandsComptesRepository;
    private PriorisationRepository $priorisationRepository;
    private NatureAffaireRepository $natureAffaireRepository;
    private StatutPdcRepository $statutPdcRepository;
    private ManagerRegistry $doctrine;
    private EtatPdcRepository $etatPdcRepository;

    public function __construct(BasesDeDefenseRepository $basesDeDefenseRepository, RfzRepository $RfzRepository, ContactRepository $contactRepository, CirisiRepository $cirisiRepository, QuartiersRepository $quartiersRepository, OrganismeRepository $organismeRepository, UsersRepository $usersRepository, SigleRepository $sigleRepository, GrandsComptesRepository $grandsComptesRepository, PriorisationRepository $priorisationRepository, NatureAffaireRepository $natureAffaireRepository, StatutPdcRepository $statutPdcRepository, ManagerRegistry $doctrine, EtatPdcRepository $etatPdcRepository)
    {
        $this->RfzRepository = $RfzRepository;
        $this->BasesDeDefenseRepository = $basesDeDefenseRepository;
        $this->ContactRepository = $contactRepository;
        $this->cirisiRepository = $cirisiRepository;
        $this->quartiersRepository = $quartiersRepository;
        $this->organismeRepository = $organismeRepository;
        $this->usersRepository = $usersRepository;
        $this->sigleRepository = $sigleRepository;
        $this->grandsComptesRepository = $grandsComptesRepository;
        $this->priorisationRepository = $priorisationRepository;
        $this->natureAffaireRepository = $natureAffaireRepository;
        $this->statutPdcRepository = $statutPdcRepository;
        $this->doctrine = $doctrine;
        $this->etatPdcRepository = $etatPdcRepository;
    }

    /**
     * @Route ("/Admin", name="Admin")
     * @return Response
     */
    public function index() : Response{
        return $this->render('administration/admin.html.twig', [
            'nbBdd' => count($this->BasesDeDefenseRepository->findAll()),
            'nbRfz' => count($this->RfzRepository->findAll()),
            'nbContact' => count($this->ContactRepository->findAll()),
            'nbCirisi' => count($this->cirisiRepository->findAll()),
            'nbQuartier' => count($this->quartiersRepository->findAll()),
            'nbOrganisme' => count($this->organismeRepository->findAll()),
            'nbUser' => count($this->usersRepository->findAll()),
            'nbSigle' => count($this->sigleRepository->findAll()),
            'nbPriorisation' => count($this->priorisationRepository->findAll()),
            'nbGrandComptes' => count($this->grandsComptesRepository->findAll()),
            'nbNatureAffaire' => count($this->natureAffaireRepository->findAll()),
            'nbStatutPdc' => count($this->statutPdcRepository->findAll()),
            'nbEtatPdc' => count($this->etatPdcRepository->findAll()),
        ]);
    }

    /**
     * @Route ("/Admin/ImportDataBase", name="importDatabase")
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
            $em = $this->doctrine->getManager();
            $csv = Reader::createFromPath($file->getRealPath());
            $csv->setHeaderOffset(0);
            $result = $csv->getRecords();

            foreach ( $result as $row){

                $rfz = $this->RfzRepository->findOneBy([
                    'rfz' => $row['Rfz'],
                ]);
                if ( $rfz == null){
                    $rfz = (new Rfz())
                        ->setRfz($row['Rfz'])
                    ;
                    $em->persist($rfz);
                    $em->flush();
                }

                $bdd = $this->BasesDeDefenseRepository->findOneBy([
                    'baseDefense' => $row['Bdd'],
                ]);

                if ($bdd == null){
                    $bdd = (new BasesDeDefense())
                        ->setBaseDefense($row['Bdd'])
                        ->setIdRfz($rfz)
                    ;
                    $em->persist($bdd);
                    $em->flush();
                }

                $cirisi = $this->cirisiRepository->findOneBy([
                    'cirisi' => $row['Cirisi'],
                ]);
                if ($cirisi == null){
                    $cirisi = (new Cirisi())
                        ->setCirisi($row['Cirisi'])
                        ->setIdBaseDefense($bdd)
                    ;
                    $em->persist($cirisi);
                    $em->flush();
                }

                $quartier = $this->quartiersRepository->findOneBy([
                    'trigramme' => $row['Trigramme'],
                ]);
                if ($quartier == null){
                    $quartier = (new Quartiers())
                        ->setQuartier($row['Quartier'])
                        ->setTrigramme($row['Trigramme'])
                        ->setAdresseQuartier($row['adresse'])
                        ->setIdBaseDefense($bdd)
                    ;
                    $em->persist($quartier);
                    $em->flush();
                }

                $organisme = (new Organisme())
                    ->setOrganisme($row['Organisme'])
                    ->setIdQuartier($quartier)
                ;
                $em->persist($organisme);
                $em->flush();
            }

            $jsonData = array(
                'message' => "Importation terminée",
            );
        }

        return $this->json($jsonData, 200);
    }
}