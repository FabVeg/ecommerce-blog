<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use App\Entity\Produit;
use App\Repository\ProduitRepository;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Entity\AboutUs;
use App\Repository\AboutUsRepository;
use App\Entity\Contact;
use App\Repository\ContactRepository;



class SiteController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(ProduitRepository $repo, CategorieRepository $repoc)
    {
        $produits = $repo->findAll();
        $categories = $repoc->findAll();

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'SiteController',
            'produits'=>$produits,
            'categories'=>$categories,
        ]);
      
    }
    
     /**
     * @Route("/produit/{id}", name="produit")
     */
    public function produitindex(Produit $produit)
    {
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'SiteController',
            'produit' => $produit
        ]);
    }

    /**
     * @Route("/categories", name="categories")
     */
    public function categoriesindex(CategorieRepository $repo)
    {
        $categories=$repo->findAll();
        return $this->render('categories/index.html.twig', [
            'controller_name' => 'SiteController',
            'categories'=>$categories
        ]);
        return $categories;
    }

     /**
     * @Route("/about-us", name="about-us")
     */
    public function aboutusindex(AboutUsRepository $repo)
    {
        $aboutuss=$repo->findAll();
        return $this->render('aboutus/index.html.twig', [
            'controller_name' => 'SiteController',
            'aboutuss'=>$aboutuss,
        ]);
    }


    /**
     * @Route("/contact", name="contact")
     */
    public function contactindex(ContactRepository $repo)
    {
        $contacts=$repo->findAll();
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'SiteController',
            'contacts'=>$contacts,
        ]);
    }
    /**
     * @Route("/blog", name="blog")
     */
    public function blogindex(ArticleRepository $repo)
    {
        $articles=$repo->findAll();
        return $this->render('blog/index.html.twig', [
            'controller_name' => 'SiteController',
            'articles'=> $articles
        ]);
    }
    /**
     * @Route("/article/{id}", name="article")
     */
    public function articleindex(Article $article)
    {
        return $this->render('blog/article.html.twig', [
            'controller_name' => 'SiteController',
            'article' => $article
        ]);
    }
}
