<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Entity\User;
use App\Entity\Ingredients;
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
        return $this->render('layout/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    /**
     * @Route("api/recipes", name="recipes")
     * @return Response
     */
    Public function getAllRecipes()
    {
        $data = [];
        $recipes = $this->getDoctrine()
            ->getRepository(Recipe::class)
            ->findAll();

        foreach ($recipes as $recipe) {
            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->find($recipe->getUserId());

            $ingredients = $this->getDoctrine()
                ->getRepository(Ingredients::class)
                ->findByRecipe($recipe->getId());

            $data [] = [
                'id'=> $recipe->getId(),
                'name' => $recipe->getName(),
                'user' => $user->getFirstName().' '.($user->getLastName()??'') ,
                'description' => $recipe->getDescription(),
                'dateCreated' => $recipe->getDateCreated(),
                'ingredients' => $ingredients
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
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($recipe->getUserId());

        $ingredients = $this->getDoctrine()
            ->getRepository(Ingredients::class)
            ->findByRecipe($recipe->getId());

        $data [] = [
            'name' => $recipe->getName(),
            'user' => $user->getFirstName().' '.($user->getLastName()??'') ,
            'description' => $recipe->getDescription(),
            'ingredients' => $ingredients
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

        if (empty($this->validateInput($name)) || empty($this->validateInput($description))) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $recipe = new Recipe();
        $recipe->setName($name);
        $recipe->setDescription($description);

        //TODO:: Refactor once user module is implemented
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find(rand(1,10));
        $recipe->setUser($user);

        // tell Doctrine you want to (eventually) save the Recipe (no queries yet)
        $entityManager->persist($recipe);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new JsonResponse(['status' => 'Recipe created!'], Response::HTTP_CREATED);
    }

    /**
     * @Route("api/recipe/update/{id}", name="updateRecipe", methods={"PUT"})
     * @param $id
     * @param Request $request
     * @return JsonResponse
     */
    public function update($id, Request $request): JsonResponse
    {
        $recipe = $this->getDoctrine()
            ->getRepository(Recipe::class)
            ->findOneBy(['id' => $id]);

        $data = json_decode($request->getContent(), true);

        $name = $data['name'] ?? '';
        $description = $data['description'] ?? '';
        $ingredients = $data['ingredients'] ?? '';

        if ($this->validateInput($name) || $this->validateInput($description) || $this->validateInput($ingredients)) {
            throw new NotFoundHttpException('Expecting mandatory parameters!');
        }

        $recipe->setName($data['name']);
        $recipe->setCategoryTag($data['category']);
        $recipe->setDescription($data['description']);
        $recipe->setIngredients($data['ingredients']);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($recipe);
        $entityManager->flush();

        return new JsonResponse($data, Response::HTTP_OK);
    }

    /**
     * @Route("api/recipe/delete/{id}", name="deleteRecipe", methods={"DELETE"})
     * @param $id
     * @return JsonResponse
     */
    public function delete($id): JsonResponse
    {
        $recipe = $this->getDoctrine()
            ->getRepository(Recipe::class)
            ->findOneBy(['id' => $id]);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($recipe);
        $entityManager->flush();

        return new JsonResponse(['status' => 'Recipe deleted'], Response::HTTP_OK);
    }

    /**
     * Basic validation for data input values
     * @param $value
     * @return string
     */
    public function validateInput($value) {
        $value = trim($value);
        $value = stripslashes($value);
        $value = htmlspecialchars($value);
        return $value;
    }
}
