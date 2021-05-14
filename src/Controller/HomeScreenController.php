<?php


namespace App\Controller;


use App\Entity\Recipe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class HomeScreenController extends AbstractController
{


    /**
     * @Route("/newrecipe/add", name="add_new_recipe", methods={"POST"})
     */
    public function addRecipe(Request $request){
        $entityManager = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(), true);

        $newRecipe = new Recipe();
        $newRecipe->setName($data['name']);
        $newRecipe->setDescription($data['description']);
        $newRecipe->setRecipeIngredient($data["recipeIngredient"]);
       // $newRecipe->setRecipeIngredient(["test", "test2"]);
        $newRecipe->setImage($data["image"]);
       $newRecipe->setDirection($data["direction"]);
        //$newRecipe->setDirection(["step1", "step2"]);

        $entityManager->persist($newRecipe);

        $entityManager->flush();

    return new Response('try to add ....'  . $newRecipe->getId());
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
                'description' => $recipe->getDescription(),
                'ingredients'=> $recipe->getRecipeIngredient(),
                'image' =>$recipe->getImage(),
                'direction' => $recipe->getDirection()
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