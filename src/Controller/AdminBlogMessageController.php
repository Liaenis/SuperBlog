<?php

namespace App\Controller;

use App\Entity\BlogMessage;
use App\Form\BlogMessageType;
use App\Repository\BlogMessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/blog/message")
 */
class AdminBlogMessageController extends AbstractController
{
    /**
     * @Route("/", name="admin_blog_message_index", methods={"GET"})
     */
    public function index(BlogMessageRepository $blogMessageRepository): Response
    {
        return $this->render('admin_blog_message/index.html.twig', [
            'blog_messages' => $blogMessageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_blog_message_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $blogMessage = new BlogMessage();
        $form = $this->createForm(BlogMessageType::class, $blogMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($blogMessage);
            $entityManager->flush();

            return $this->redirectToRoute('admin_blog_message_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_blog_message/new.html.twig', [
            'blog_message' => $blogMessage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_blog_message_show", methods={"GET"})
     */
    public function show(BlogMessage $blogMessage): Response
    {
        return $this->render('admin_blog_message/show.html.twig', [
            'blog_message' => $blogMessage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_blog_message_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, BlogMessage $blogMessage): Response
    {
        $form = $this->createForm(BlogMessageType::class, $blogMessage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_blog_message_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin_blog_message/edit.html.twig', [
            'blog_message' => $blogMessage,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="admin_blog_message_delete", methods={"POST"})
     */
    public function delete(Request $request, BlogMessage $blogMessage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$blogMessage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($blogMessage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_blog_message_index', [], Response::HTTP_SEE_OTHER);
    }
}
