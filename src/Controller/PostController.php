<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
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

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        // to get any form error
        // $form->getErrors();

        // if any validator is used in the form we can use $form->isValid() to validate form in the controller

        if ($form->isSubmitted() && $form->isValid()) {

            // entity manager
            $em = $this->getDoctrine()->getManager();

            $file = $request->files->get('attachment');

            $em->persist($post);
            $em->flush();

            return $this->redirect($this->generateUrl('post.index'));

        }

        // return a response
        return $this->render('post/create.html.twig', [
            'form' => $form->createView()
        ]);

    }


    /**
     * @Route("/show/{id}", name="show")
     * @param Post $post
     * @return Response
     */
    public function show(Post $post) {

        // Param Converter, it will going to give the ID and it will going to look for the post in the Post entity and find that post
        // die is used as there is not View has been created yet. So program will end immediately after dump the value
//        dump($post);
//        die;

        //create the show view
        return $this->render('post/show.html.twig', [
            'post'=> $post
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     * @param Post $post
     * @return Response
     */
    public function remove(Post $post) {

        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        $this->addFlash('success', 'Post was removed');

        return $this->redirect($this->generateUrl('post.index'));

    }
}
