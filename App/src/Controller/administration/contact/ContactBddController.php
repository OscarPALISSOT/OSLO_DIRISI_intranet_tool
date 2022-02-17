<?php

namespace App\Controller\administration\contact;

use App\Entity\ContactBdd;
use App\Entity\Contact;
use App\Repository\BasesDeDefenseRepository;
use App\Repository\ContactbddRepository;
use App\Repository\ContactRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactBddController extends AbstractController {

    private ContactbddRepository $ContactBddRepository;
    private ManagerRegistry $ManagerRegistry;
    private ContactRepository $contactRepository;
    private BasesDeDefenseRepository $bddRepository;

    public function __construct(ContactbddRepository $ContactBddRepository, ManagerRegistry $doctrine, BasesDeDefenseRepository $bddRepository, ContactRepository $contactRepository)
    {
        $this->ContactBddRepository = $ContactBddRepository;
        $this->ManagerRegistry = $doctrine;
        $this->contactRepository = $contactRepository;
        $this->bddRepository = $bddRepository;
    }

    /**
     * @Route ("/Admin/ContactBdd", name="Admin_ContactBdd")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request) : Response{
        $ContactBdds = $paginator->paginate(
            $this->ContactBddRepository->findAllWithBdd(),
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/
        );
        return $this->render('administration/Contact/contactBdd.html.twig', [
            'ContactBdds' => $ContactBdds,
            'Bdds' => $this->bddRepository->findAll(),
        ]);
    }

    /**
     * @Route ("/Admin/NewContactBdd", name="Admin_ContactBdd_New")
     * @param Request $request
     * @return Response
     */
    public function newContactBdd(Request $request) : Response{
        $NewContactBdd = new ContactBdd();
        $NewContact = new Contact();
        $ContactBdd = $request->request->get('intituleContactBdd');
        $nomContactBdd = $request->request->get('nomContactBdd');
        $prenomContactBdd = $request->request->get('prenomContactBdd');
        $mailContactBdd = $request->request->get('mailContactBdd');
        $telContactBdd = $request->request->get('telContactBdd');
        $idContactBdd = $request->request->get('bdd');
        $NewContactBdd->setIntituleContact($ContactBdd);
        $NewContactBdd->setNomContact($nomContactBdd);
        $NewContactBdd->setPrenomContact($prenomContactBdd);
        $NewContactBdd->setEmailContact($mailContactBdd);
        $NewContactBdd->setTelContact($telContactBdd);
        $NewContact->setIntituleContact($ContactBdd);
        $NewContact->setNomContact($nomContactBdd);
        $NewContact->setPrenomContact($prenomContactBdd);
        $NewContact->setEmailContact($mailContactBdd);
        $NewContact->setTelContact($telContactBdd);
        $bdd = $this->bddRepository->find($idContactBdd);
        if (!$bdd){
            $jsonData = array(
                'message' => "Erreur, veuillez renseigner une base de défense.",
            );
        }
        else{
            $NewContactBdd->setIdBaseDefense($bdd);

            if ($this->isCsrfTokenValid("CreateContactBdd", $request->get('_token'))){
                $em = $this->ManagerRegistry->getManager();
                $em->persist($NewContact);
                $em->flush();
                $NewContactBdd->setIdContact($this->contactRepository->find($NewContact->getIdContact()));
                $em->persist($NewContactBdd);
                $em->flush();
            }
            $jsonData = array(
                'message' => 'Contact ajouté',
            );
        }
        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/Admin/DeleteContactBdd", name="Admin_ContactBdd_Delete")
     * @param Request $request
     * @return Response
     */
    public function DeleteContactBdd(Request $request): Response{
        $ContactBdds = $this->ContactBddRepository->findAllWithBdd();
        $nbContactBdd = count($ContactBdds);
        $ChekedId = array();
        for ( $i = 0; $i < $nbContactBdd; $i++){
            if ($request->request->get('idChecked' . $ContactBdds[$i]->getIdContact()->getIdContact())){
                $ChekedId[] = $ContactBdds[$i]->getIdContact()->getIdContact();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'message' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $ContactBddToDelete = $this->ContactBddRepository->find($item);
                $ContactToDelete = $this->contactRepository->find($item);

                if ($this->isCsrfTokenValid("DeleteContactBdd", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
                    $em->remove($ContactBddToDelete);
                    $em->remove($ContactToDelete);
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
     * @Route ("/Admin/EditContactBdd/{id}", name="Admin_ContactBdd_Edit")
     * @param Request $request
     * @return Response
     */
    public function EditContactBdd(Request $request) : Response{
        $id = $request->request->get('idEdit');
        $ContactBdd = $this->ContactBddRepository->find($id);
        $Contact = $this->contactRepository->find($id);
        $intituleContactBdd = $request->request->get('intituleContactBddEdit');
        $nomContactBdd = $request->request->get('nomContactBddEdit');
        $prenomContactBdd = $request->request->get('prenomContactBddEdit');
        $mailContactBdd = $request->request->get('mailContactBddEdit');
        $telContactBdd = $request->request->get('telContactBddEdit');
        $idContactBdd = $request->request->get('bddEdit');
        $ContactBdd->setIntituleContact($intituleContactBdd);
        $ContactBdd->setNomContact($nomContactBdd);
        $ContactBdd->setPrenomContact($prenomContactBdd);
        $ContactBdd->setEmailContact($mailContactBdd);
        $ContactBdd->setTelContact($telContactBdd);
        $Contact->setIntituleContact($intituleContactBdd);
        $Contact->setNomContact($nomContactBdd);
        $Contact->setPrenomContact($prenomContactBdd);
        $Contact->setEmailContact($mailContactBdd);
        $Contact->setTelContact($telContactBdd);
        $bdd = $this->bddRepository->find($idContactBdd);
        $ContactBdd->setIdBaseDefense($bdd);

        if ($this->isCsrfTokenValid("EditContactBdd", $request->get('_token'))) {
            $em = $this->ManagerRegistry->getManager();
            $em->persist($Contact);
            $em->persist($ContactBdd);
            $em->flush();
        }

        $jsonData = array(
            'message' => 'Contact modifié.',
        );

        return $this->json($jsonData, 200);
    }
}
