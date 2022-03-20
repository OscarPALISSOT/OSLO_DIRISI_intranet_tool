<?php

namespace App\Controller\administration;

use App\Entity\ClassementDl;
use App\Repository\ClassementDlRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ClassementDlController extends AbstractController {

    private ClassementDlRepository $ClassementDlRepository;
    private ManagerRegistry $ManagerRegistry;

    public function __construct(ClassementDlRepository $ClassementDlRepository, ManagerRegistry $doctrine)
    {
        $this->ClassementDlRepository = $ClassementDlRepository;
        $this->ManagerRegistry = $doctrine;
    }

    /**
     * @Route ("/Admin/ClassementDl", name="Admin_ClassementDl")
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PaginatorInterface $paginator, Request $request) : Response{
        $ClassementDls = $paginator->paginate(
            $this->ClassementDlRepository->findAll(),
            $request->query->getInt('page', 1), /*page number*/
            12 /*limit per page*/
        );
        return $this->render('administration/classementDl.html.twig', [
            'ClassementDls' => $ClassementDls,
        ]);
    }

    /**
     * @Route ("/Admin/NewClassementDl", name="Admin_ClassementDl_New")
     * @param Request $request
     * @return Response
     */
    public function newClassementDl(Request $request) : Response{
        $NewClassementDl = new ClassementDl();
        $ClassementDl = $request->request->get('classementDl');
        $NewClassementDl->setClassementDl($ClassementDl);
        if ($this->isCsrfTokenValid("CreateClassementDl", $request->get('_token'))){
            $em = $this->ManagerRegistry->getManager();
            $em->persist($NewClassementDl);
            $em->flush();
        }
        $jsonData = array(
            'message' => 'ClassementDl ajouté',
        );
        return $this->json($jsonData, 200);
    }

    /**
     * @Route ("/Admin/DeleteClassementDl", name="Admin_ClassementDl_Delete")
     * @param Request $request
     * @return Response
     */
    public function DeleteClassementDl(Request $request): Response{
        $ClassementDls = $this->ClassementDlRepository->findAll();
        $nbClassementDl = count($ClassementDls);
        $ChekedId = array();
        for ( $i = 0; $i < $nbClassementDl; $i++){
            if ($request->request->get('idChecked' . $ClassementDls[$i]->getIdClassementDl())){
                $ChekedId[] = $ClassementDls[$i]->getIdClassementDl();
            }
        }
        if (count($ChekedId) == 0){
            $jsonData = array(
                'message' => "Veuillez sélectionner au moins élément à supprimer",
            );
        }
        else{
            foreach ($ChekedId as $item){
                $classementDlToDelete = $this->ClassementDlRepository->find($item);

                if ($this->isCsrfTokenValid("DeleteClassementDl", $request->get('_token'))){
                    $em = $this->ManagerRegistry->getManager();
                    $em->remove($classementDlToDelete);
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
     * @Route ("/Admin/EditClassementDl/{id}", name="Admin_ClassementDl_Edit")
     * @param Request $request
     * @return Response
     */
    public function EditClassementDl(Request $request) : Response{
        $id = $request->request->get('idEdit');
        $ClassementDl = $this->ClassementDlRepository->find($id);
        $ClassementDlName = $request->request->get('classementDlEdit');
        $ClassementDl->setClassementDl($ClassementDlName);

        if ($this->isCsrfTokenValid("EditClassementDl", $request->get('_token'))) {
            $em = $this->ManagerRegistry->getManager();
            $em->persist($ClassementDl);
            $em->flush();
        }

        $jsonData = array(
            'message' => 'ClassementDl modifié',
        );

        return $this->json($jsonData, 200);
    }
}