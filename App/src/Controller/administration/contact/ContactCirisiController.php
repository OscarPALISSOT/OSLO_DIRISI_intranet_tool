<?php

namespace App\Controller\administration\contact;

use App\Entity\ContactCirisi;
use App\Entity\Contact;
use App\Repository\CirisiRepository;
use App\Repository\ContactcirisiRepository;
use App\Repository\ContactRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactCirisiController extends AbstractController {

    private $ContactCirisiRepository;
    private $ManagerRegistry;
    private $cirisiRepository;
    private $contactRepository;

    public function __construct(ContactcirisiRepository $ContactCirisiRepository, ManagerRegistry $doctrine, CirisiRepository $cirisiRepository, ContactRepository $contactRepository)
    {
        $this->ContactCirisiRepository = $ContactCirisiRepository;
        $this->ManagerRegistry = $doctrine;
        $this->cirisiRepository = $cirisiRepository;
        $this->contactRepository = $contactRepository;
    }

    /**
     * @Route ("/Admin/ContactCirisi", name="Admin_ContactCirisi")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request) : Response{
        $ContactCirisis = $paginator->paginate(
            $this->ContactCirisiRepository->findAllWithCirisi(),
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/
        );
        return $this->render('administration/Contact/contactCirisi.html.twig', [
            'ContactCirisis' => $ContactCirisis,
            'Cirisis' => $this->cirisiRepository->findAll(),
        ]);
    }

    /**
     * @Route ("/Admin/NewContactCirisi", name="Admin_ContactCirisi_New")
     * @param Request $request
     * @return Response
     */
    public function newContactCirisi(Request $request) : Response{
        $NewContactCirisi = new ContactCirisi();
        $NewContact = new Contact();
        $ContactCirisi = $request->request->get('intituleContactCirisi');
        $nomContactCirisi = $request->request->get('nomContactCirisi');
        $prenomContactCirisi = $request->request->get('prenomContactCirisi');
        $mailContactCirisi = $request->request->get('mailContactCirisi');
        $telContactCirisi = $request->request->get('telContactCirisi');
        $idContactCirisi = $request->request->get('cirisi');
        $NewContactCirisi->setIntituleContact($ContactCirisi);
        $NewContactCirisi->setNomContact($nomContactCirisi);
        $NewContactCirisi->setPrenomContact($prenomContactCirisi);
        $NewContactCirisi->setEmailContact($mailContactCirisi);
        $NewContactCirisi->setTelContact($telContactCirisi);
        $NewContact->setIntituleContact($ContactCirisi);
        $NewContact->setNomContact($nomContactCirisi);
        $NewContact->setPrenomContact($prenomContactCirisi);
        $NewContact->setEmailContact($mailContactCirisi);
        $NewContact->setTelContact($telContactCirisi);
        $cirisi = $this->cirisiRepository->find($idContactCirisi);

        if (!$cirisi){
            $jsonData = array(
                'message' => "Erreur, veuillez renseigner un CIRISI.",
            );
        }
        else{
            $NewContactCirisi->setIdCirisi($cirisi);

            if ($this->isCsrfTokenValid("CreateContactCirisi", $request->get('_token'))){
                $em = $this->ManagerRegistry->getManager();
                $em->persist($NewContact);
                $em->flush();
                $NewContactCirisi->setIdContact($this->contactRepository->find($NewContact->getIdContact()));
                $em->persist($NewContactCirisi);
                $em->flush();
            }
            $jsonData = array(
                'message' => 'Contact ajouté.',
            );
        }
        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/Admin/DeleteContactCirisi", name="Admin_ContactCirisi_Delete")
     * @param Request $request
     * @return Response
     */
    public function DeleteContactCirisi(Request $request): Response{
        $ContactCirisis = $this->ContactCirisiRepository->findAllWithCirisi();
        $nbContactCirisi = count($ContactCirisis);
        $ChekedId = array();
        for ( $i = 0; $i < $nbContactCirisi; $i++){
            if ($request->request->get('idChecked' . $ContactCirisis[$i]->getIdContact()->getIdContact())){
                $ChekedId[] = $ContactCirisis[$i]->getIdContact()->getIdContact();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'message' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $ContactCirisiToDelete = $this->ContactCirisiRepository->find($item);
                $ContactToDelete = $this->contactRepository->find($item);

                if ($this->isCsrfTokenValid("DeleteContactCirisi", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
                    $em->remove($ContactCirisiToDelete);
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
     * @Route ("/Admin/EditContactCirisi/{id}", name="Admin_ContactCirisi_Edit")
     * @param Request $request
     * @return Response
     */
    public function EditContactCirisi(Request $request) : Response{
        $id = $request->request->get('idEdit');
        $ContactCirisi = $this->ContactCirisiRepository->find($id);
        $Contact = $this->contactRepository->find($id);
        $intituleContactCirisi = $request->request->get('intituleContactCirisiEdit');
        $nomContactCirisi = $request->request->get('nomContactCirisiEdit');
        $prenomContactCirisi = $request->request->get('prenomContactCirisiEdit');
        $mailContactCirisi = $request->request->get('mailContactCirisiEdit');
        $telContactCirisi = $request->request->get('telContactCirisiEdit');
        $idContactCirisi = $request->request->get('cirisiEdit');
        $ContactCirisi->setIntituleContact($intituleContactCirisi);
        $ContactCirisi->setNomContact($nomContactCirisi);
        $ContactCirisi->setPrenomContact($prenomContactCirisi);
        $ContactCirisi->setEmailContact($mailContactCirisi);
        $ContactCirisi->setTelContact($telContactCirisi);
        $Contact->setIntituleContact($intituleContactCirisi);
        $Contact->setNomContact($nomContactCirisi);
        $Contact->setPrenomContact($prenomContactCirisi);
        $Contact->setEmailContact($mailContactCirisi);
        $Contact->setTelContact($telContactCirisi);
        $cirisi = $this->cirisiRepository->find($idContactCirisi);
        $ContactCirisi->setIdCirisi($cirisi);

        if ($this->isCsrfTokenValid("EditContactCirisi", $request->get('_token'))) {
            $em = $this->ManagerRegistry->getManager();
            $em->persist($Contact);
            $em->persist($ContactCirisi);
            $em->flush();
        }

        $jsonData = array(
            'message' => 'Contact modifié.',
        );

        return $this->json($jsonData, 200);
    }
}
