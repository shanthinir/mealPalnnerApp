<?php

namespace App\Controller;

use App\Entity\Recipe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/{reactRouting}", name="home", defaults={"reactRouting": null})
     */
    public function index()
    {
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }


    /**
     * @Route("api/recipes", name="recipes")
     * @return Response
     */
    Public function getRecipes()
    {
        $data = [];
        $recipes = $this->getDoctrine()
            ->getRepository(Recipe::class)
            ->findAll();

        foreach ($recipes as $recipe) {
            $data [] = [
                'id'=> $recipe->getId(),
                'name' => $recipe->getName(),
                'author' => $recipe->getAuthorId(),
                'description' => $recipe->getDescription()
            ];
        }

        $response = new Response();

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->setContent(json_encode($data));

        return $response;
    }

    /**
     * @Route("api/recipe/{id}", name="viewRecipe")
     * @return Response
     */
    public function show($id)
    {
        $recipe = $this->getDoctrine()
            ->getRepository(Recipe::class)
            ->find($id);

        if (!$recipe) {
            throw $this->createNotFoundException(
                'No Recipe found for id '.$id
            );
        }

        $data [] = [
            'name' => $recipe->getName(),
            'author' => $recipe->getAuthorId(),
            'description' => $recipe->getDescription()
        ];

        $response = new Response();

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->setContent(json_encode($data));

        return $response;
    }


}
