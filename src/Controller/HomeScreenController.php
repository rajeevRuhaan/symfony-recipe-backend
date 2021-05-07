<?php


namespace App\Controller;


use App\Entity\Recipe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeScreenController extends AbstractController
{


    /**
     * @Route("/newrecipe/add", name="add_new_recipe")
     */
    public function addRecipe(){
        $entityManager = $this->getDoctrine()->getManager();

        $newRecipe = new Recipe();
        $newRecipe->setName('Omlet');
        $newRecipe->setIngredients('Omlet, oil');
        $newRecipe->setDifficulty('easy');

        $newRecipe1 = new Recipe();
        $newRecipe1->setName('coffee');
        $newRecipe1->setIngredients('coffee, milk, sugar');
        $newRecipe1->setDifficulty('very easy');


        $entityManager->persist($newRecipe);
        $entityManager->persist($newRecipe1);
        $entityManager->flush();

    return new Response('try to add ....' . $newRecipe1->getId() . " " . $newRecipe->getId());
    }

    /**
     * @Route("/newrecipe/all", name="get_all_recipe")
     */
    public function getAllRecipe() {
        $recipes = $this->getDoctrine()->getRepository(Recipe::class)->findAll();
        $response = [];

        foreach ($recipes as $recipe) {
            $response[] = array (
                'name' => $recipe->getName(),
                'ingredients' => $recipe->getIngredients(),
                'difficulty' => $recipe->getDifficulty()

            );
        }
        return $this->json($response);
    }

}