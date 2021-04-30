<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    /**
     * @Route("/home", name="get_a_recipe", methods={"GET"})
     */
    public function index(Request $request): Response
    {
        return $this->json([
            'message' => $request->query->get('page'),
            'path' => 'src/Controller/HomeController.php',
        ]);
    }

    /**
     * @Route("/recipe/{id}", name="get_all_recipe", methods={"GET"})
     */
    public function recipe(Request $request, $id) {

        return $this->json([
            'message' => 'request recipe' . $id,
            'page' => $request->query->get('page'),
        ]);
    }
}
