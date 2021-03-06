<?php

namespace App\Controller;

use App\Entity\Item;
use App\Form\ItemRegistrationFormType;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EcoboutiqueController extends AbstractController
{
    /**
     * @Route("/ecoboutique", name="ecoboutique")
     */
    public function display(PaginatorInterface $paginator, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository(Item::class);
        $allItems = $rep->findAll();

        $numeroPage = $request->query->getInt('page', 1);
        $paginationItems= $paginator->paginate($allItems, $numeroPage);


        return $this->render('ecoboutique/index.html.twig', [
            'controller_name' => 'EcoboutiqueController','paginationItems'=>$paginationItems, 'items'=>$allItems
        ]);
    }
    /**
     * @Route("/ecoboutique/add/article", name="ecoboutique_add")
     */
    public function add(Request $req)
    {
        $item = new Item();
        $formulaireItem=$this->createForm(ItemRegistrationFormType::class, $item);
        $formulaireItem->handleRequest($req);
        if($formulaireItem->isSubmitted()&&$formulaireItem->isValid()){
            $fichier = $item->getImage();
            $nomFichierServeur = md5(uniqid()).".".$fichier->guessExtension();
            $fichier->move('dossierImages', $nomFichierServeur);
            $item->setImage($nomFichierServeur);
            $item->setUser($this->getUser());
            $em=$this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();
            return $this->RedirectToRoute('ecoboutique');

        }
        else {
            return $this->render('ecoboutique/add.html.twig', [
                'formulaire' => $formulaireItem->createView()
            ]);
        }
        
    }
}
