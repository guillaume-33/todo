<?php

namespace App\Controller;

use App\Entity\Tache;
use App\Form\ListeType;
use App\Repository\ListeRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/app")
 */
class listController extends AbstractController
{

    /**
     * @Route("/user_listes" , name="user_listes")
     */
public function readlistTodo(ListeRepository $listeRepository, Request $request){
    $user=$this->getUser();
   $listes=$listeRepository->findby(['destinataire'=>$user]);

    return $this->render('user_listes.html.twig', [
                'listes'=>$listes
    ]);
}


// je recupere l'id de la liste grace a $id=request->query->get('liste')(liste veux dire qu'on cherche dans la table liste )
/**
 * @Route ("/update_liste", name="update_liste")
 */
    public function updateListe(ListeRepository $listeRepository, EntityManagerInterface $entityManager, Request $request, )
    {
        $id=$request->query->get('liste');

        $liste = $listeRepository->find($id);

        $user = $this->getUser();//je recupère l'utilisateur en ligne
        if($user=== $liste->getDestinataire()) { //verifie que l'utilisateur soit bien le destinataire
            if ($request->query->has('statut')) {
                $statut = $request->query->get('statut');

                $liste->setStatut($statut);

                $entityManager->persist($liste);
                $entityManager->flush();
            }
            $this->addFlash("success", "Liste mise a jour");

            return $this->render("update_liste.html.twig", [
                'liste' => $liste
            ]);
        }else{
            return $this->render('user_listes.html.twig');
        }
    }


    /**
     * @Route("/create_liste", name="create_liste")
     */
    public function createListe(Request $request, EntityManagerInterface $entityManager){

        $liste = new Tache();

        $form =$this->createForm(ListeType::class, $liste);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form ->isValid()){

            $entityManager->persist($liste);
            $entityManager->flush();

            $this->addFlash('success', 'ajoutée');
        }
        return $this->render('create_liste.html.twig',[
            'form'=>$form->createView()]);
    }
}