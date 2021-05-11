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
    /**
     * @Route ("/newrecipe/find/{id}", name="find_a_recipe")
     */
    public function findRecipe($id) {

        $recipe = $this->getDoctrine()->getRepository( Recipe::class)->find($id);
        if(!$recipe) {
            throw $this->createNotFoundException(
                'No recipe was found with this id:' . $id
            );

        }else {
            return $this->json([
                'id'=> $recipe->getId(),
                'name'=> $recipe->getName(),
                'ingredients'=> $recipe->getIngredients(),
                'difficulty' => $recipe->getDifficulty()
            ]);
        }

    }
    /**
     * @Route("/newrecipe/edit/{id}/{name}", name="edit_a_recipe")
     */
    public function editRecipe($id, $name) {
        $entityManager = $this->getDoctrine()->getManager();
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($id);

        if (!$recipe) {
            throw $this->createNotFoundException(
                'No recipe was found with the id: ' . $id
            );
        } else {
            $recipe->setName($name);
            $entityManager->flush();

            return $this->json([
                'message' => 'Edited a recipe with id ' . $id
            ]);
        }
    }

    /**
     * @Route("/newrecipe/remove/{id}", name="remove_a_recipe")
     */
    public function removeRecipe($id) {
        $entityManager = $this->getDoctrine()->getManager();
        $recipe = $this->getDoctrine()->getRepository(Recipe::class)->find($id);

        if (!$recipe) {
            throw $this->createNotFoundException(
                'No recipe was found with the id: ' . $id
            );
        } else {
            $entityManager->remove($recipe);
            $entityManager->flush();

            return $this->json([
                'message' => 'Removed the recipe with id ' . $id
            ]);
        }
    }


}