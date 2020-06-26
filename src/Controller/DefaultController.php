<?php

namespace App\Controller;

use App\Entity\Recipe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
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
     * @Route("api/recipe/{id}", name="viewRecipe", requirements={"id"="\d+"} )
     * @param $id
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

    /**
     * @Route("api/recipe/submit", name="submitRecipe")
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(), true);

        $name = $data['name'];
        $description = $data['description'];

        if (empty($name) || empty($description)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $recipe = new Recipe();
        $recipe->setName($name);
        $recipe->setDescription($description);
        $recipe->setAuthorId(1);
        //TODO:: Refactor once user module is implemented

        // tell Doctrine you want to (eventually) save the Recipe (no queries yet)
        $entityManager->persist($recipe);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new JsonResponse(['status' => 'Recipe created!'], Response::HTTP_CREATED);
    }
}
