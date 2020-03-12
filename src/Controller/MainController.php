<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig');

//        return new HttpFoundation\Response('<h1>Symfony Tutorial from freeCodeCamp!</h1>');
    }

    /**
     * @Route("/custom/{name?}", name="custom")
     * @param HttpFoundation\Request $request
     * @return HttpFoundation\Response
     */
    public function custom(HttpFoundation\Request $request) {

//        dump($request->attributes->get('name'));
//        dump($request->get('name'));
//        dump($request);

        $name = $request->get('name');
        return $this->render('home/custom.html.twig', [
            'name' => $name
        ]);

//        return new HttpFoundation\Response('<h1>Welcome to Custom Page ' . $name .' !</h1>');
    }
}
