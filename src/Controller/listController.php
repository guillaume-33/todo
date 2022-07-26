<?php

namespace App\Controller;

use App\Entity\Liste;
use App\Form\ListeType;
use App\Repository\ListeRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class listController extends AbstractController
{

    /**
     * @Route("/user_listes" , name="user_listes")
     */
public function readlistTodo(ListeRepository $listeRepository, Request $request){
   $listes=$listeRepository->findAll();

    return $this->render('user_listes.html.twig', [
                'listes'=>$listes
    ]);
}


// je recupere l'id de la liste grace a $id=request->query->get(liste veux dire quo'n cherche dans la table liste )
/**
 * @Route ("/update_liste", name="update_liste")
 */
    public function updateListe(ListeRepository $listeRepository, EntityManagerInterface $entityManager, Request $request, ){

        $id=$request->query->get('liste');

        $liste = $listeRepository->find($id);

        if($request->query->has('statut')) {
            $statut = $request->query->get('statut');

            $liste->setStatut($statut);

            $entityManager->persist($liste);
            $entityManager->flush();
        }
           $this->addFlash("success", "Liste mise a jour");

        return $this->render("update_liste.html.twig",[
                            'liste'=>$liste
        ]);
    }


    /**
     * @Route("/create_liste", name="create_liste")
     */
    public function createListe(Request $request, EntityManagerInterface $entityManager){

        $liste = new Liste();

        $form =$this->createForm(ListeType::class, $liste);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form ->isSubmitted()){

            $entityManager->persist($liste);
            $entityManager->flush();

            $this->addFlash('success', 'ajoutée');
        }
        return $this->render('create_liste.html.twig',[
            'form'=>$form->createView()]);
    }
}