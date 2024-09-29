<?php

namespace App\Controller;

use App\Entity\AttributesValues;
use App\Repository\AttributesValuesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(AttributesValuesRepository $repoValues): Response
    {
        $attributesValues = $repoValues->findAll();

        return $this->render('home/index.html.twig', [
            'attributesValues' => $attributesValues,
        ]);
    }
    
    #[Route('/show/{id}', name: 'app_show')]
    public function show(AttributesValues $attributeValue): Response
    {
        return $this->render('home/show.html.twig', [
            'attributeValue' => $attributeValue,
        ]);
    }

}
