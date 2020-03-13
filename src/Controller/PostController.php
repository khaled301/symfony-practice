<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/post", name="post.")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @param PostRepository $postRepository
     * @return Response
     */
    public function index(PostRepository $postRepository)
    {
        $posts = $postRepository->findAll();
//        dump($posts);

        return $this->render('post/index.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request) {
        $post = new Post();

        $post->setTitle('This is going to be a title!');

        // entity manager
        $em = $this->getDoctrine()->getManager();

        $em->persist($post);

        $em->flush();

        // return a response
        return new Response('Post was created!');

    }


    /**
     * @Route("/show/{id}", name="show")
     * @param $id
     * @param PostRepository $postRepository
     * @return Response
     */
    public function show($id, PostRepository $postRepository) {

        $post = $postRepository->find($id);

        // die is used as there is not View has been created yet. So program will end immediately after dump the value
        dump($post);
        die;

        //create the show view
        return $this->render('post/show.html.twig', [
            'post'=> $post
        ]);
    }
}
