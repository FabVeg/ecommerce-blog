<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ManagerRegistry;


use App\Entity\Categorie;
use App\Repository\CategorieRepository;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use App\Form\ProduitType;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

     /**
     * @Route("/categorieadmin", name="categorieadmin", methods={"GET","POST"})
     */
    public function categorieadminindex(Request $request, ManagerRegistry $cmanager, CategorieRepository $repo)
    {
        if($request->request->get('titre')!=null){
            $titre=$request->request-get('titre');
            $image=$request->request-get('image');

            $categorie = new Categorie();
            $categorie-setTitre($titre);
            $categorie-setImage($image);

            $manager=$cmanager-getManager();
            $manager->persist($categorie);
            $manager->flush();
        }

        $categorieadmin = $repo->findAll();

        return $this->render('categorieadmin/index.html.twig', [
            'controller_name' => 'AdminController',
            'categorieadmin' => $categorieadmin
        ]);
    }

      /**
     * @Route("/produitadmin", name="produitadmin", methods={"GET","POST"})
     */
    public function produitadminindex(Request $request, ManagerRegistry $cmanager, ProduitRepository $repo)
    {
        $produit = new Produit;
        $form = $this->createForm(ProduitType::class, $produit);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager=$cmanager->getManager();
            $manager->persist($produit);
            $manager->flush();
        }

        $produitadmin = $repo->findAll();

        return $this->render('produitadmin/index.html.twig', [
            'controller_name' => 'AdminController',
            'produitform' => $form->createView(),
            'produita' => $produitadmin
        ]);
    }

     /**
     * @Route("/editproduitadmin/{id}", name="editproduitadmin", methods={"GET","POST"})
     */
    public function editproduitadminindex(Request $request, ManagerRegistry $cmanager)
    {
        $form = $this->createForm(ProduitType::class, $produit);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $manager=$cmanager->getManager();
            $manager->persist($produit);
            $manager->flush();
        }

        return $this->render('editproduitadmin/index.html.twig', [
            'controller_name' => 'AdminController',
            'produitform' => $form->createView()
        ]);
    }
}
