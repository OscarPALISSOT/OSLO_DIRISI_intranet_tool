<?php

namespace App\Controller\administration\contact;

use App\Entity\Contact;
use App\Repository\ContactbddRepository;
use App\Repository\ContactCirisiRepository;
use App\Repository\ContactRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController {

    private ContactRepository $ContactRepository;
    private ManagerRegistry $ManagerRegistry;
    private ContactRepository $contactRepository;
    private ContactCirisiRepository $contactCirisiRepository;
    private ContactbddRepository $contactbddRepository;

    public function __construct(ContactRepository $ContactRepository, ManagerRegistry $doctrine, ContactRepository $contactRepository, ContactCirisiRepository $contactCirisiRepository, ContactbddRepository $contactbddRepository)
    {
        $this->ContactRepository = $ContactRepository;
        $this->ManagerRegistry = $doctrine;
        $this->contactRepository = $contactRepository;
        $this->contactCirisiRepository = $contactCirisiRepository;
        $this->contactbddRepository = $contactbddRepository;
    }

    /**
     * @Route ("/Admin/Contact", name="Admin_Contact")
     * @return Response
     */
    public function index() : Response{
        $Contacts = $this->ContactRepository->findAll();
        $i = 0;
        foreach ($Contacts as $contact){
            if ($this->contactbddRepository->find($contact->getIdContact()) or $this->contactCirisiRepository->find($contact->getIdContact())){
                unset($Contacts[$i]);
                $Contacts = array_values($Contacts);
            }
        }
        return $this->render('administration/Contact/contact.html.twig', [
            'Contacts' => $Contacts,
        ]);
    }

    /**
     * @Route ("/Admin/NewContact", name="Admin_Contact_New")
     * @param Request $request
     * @return Response
     */
    public function newContact(Request $request) : Response{
        $NewContact = new Contact();
        $NewContact = new Contact();
        $Contact = $request->request->get('intituleContact');
        $nomContact = $request->request->get('nomContact');
        $prenomContact = $request->request->get('prenomContact');
        $mailContact = $request->request->get('mailContact');
        $telContact = $request->request->get('telContact');
        $NewContact->setIntituleContact($Contact);
        $NewContact->setNomContact($nomContact);
        $NewContact->setPrenomContact($prenomContact);
        $NewContact->setEmailContact($mailContact);
        $NewContact->setTelContact($telContact);

        if ($this->isCsrfTokenValid("CreateContact", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($NewContact);
            $em->flush();
        }
        $jsonData = array(
            'Contact' => $Contact,
        );
        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/Admin/DeleteContact", name="Admin_Contact_Delete")
     * @param Request $request
     * @return Response
     */
    public function DeleteContact(Request $request): Response{
        $Contacts = $this->ContactRepository->findAll();
        $nbContact = count($Contacts);
        $ChekedId = array();
        for ( $i = 0; $i < $nbContact; $i++){
            if ($request->request->get('idChecked' . $Contacts[$i]->getIdContact())){
                $ChekedId[] = $Contacts[$i]->getIdContact();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'Contact' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $ContactToDelete = $this->contactRepository->find($item);

                if ($this->isCsrfTokenValid("DeleteContact", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
                    $em->remove($ContactToDelete);
                    $em->flush();
                }

            }
            $jsonData = array(
                'Contact' => "Suppression terminée",
            );
        }
        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/Admin/EditContact/{id}", name="Admin_Contact_Edit")
     * @param Request $request
     * @return Response
     */
    public function EditContact(Request $request) : Response{
        $id = $request->request->get('idEdit');
        $Contact = $this->contactRepository->find($id);
        $intituleContact = $request->request->get('intituleContactEdit');
        $nomContact = $request->request->get('nomContactEdit');
        $prenomContact = $request->request->get('prenomContactEdit');
        $mailContact = $request->request->get('mailContactEdit');
        $telContact = $request->request->get('telContactEdit');
        $Contact->setIntituleContact($intituleContact);
        $Contact->setNomContact($nomContact);
        $Contact->setPrenomContact($prenomContact);
        $Contact->setEmailContact($mailContact);
        $Contact->setTelContact($telContact);

        if ($this->isCsrfTokenValid("EditContact", $request->get('_token'))) {
            $em = $this->ManagerRegistry->getManager();
            $em->persist($Contact);
            $em->persist($Contact);
            $em->flush();
        }

        $jsonData = array(
            'Contact' => $Contact->getIntituleContact(),
        );

        return $this->json($jsonData, 200);
    }
}
