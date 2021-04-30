<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeScreenController extends AbstractController
{
    /**
     * @Route("/homeScreen", methods={"GET", "DELETE"})
     */
public function home() {
  /* $resp = new Response('<h1>hello world</h1>');
    return $resp;*/

    return $this->json(['message' => 'hello world']);


}

}