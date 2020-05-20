<?php

namespace App\Controller;

use App\Entity\Seizoen;
use App\Form\SeizoenType;
use App\Repository\SeizoenRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/seizoen")
 */
class SeizoenController extends AbstractController
{
    /**
     * @Route("/", name="seizoen_index", methods={"GET"})
     */
    public function index(SeizoenRepository $seizoenRepository): Response
    {
        return $this->render('seizoen/index.html.twig', [
            'seizoens' => $seizoenRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="seizoen_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $seizoen = new Seizoen();
        $form = $this->createForm(SeizoenType::class, $seizoen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($seizoen);
            $entityManager->flush();

            return $this->redirectToRoute('seizoen_index');
        }

        return $this->render('seizoen/new.html.twig', [
            'seizoen' => $seizoen,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="seizoen_show", methods={"GET"})
     */
    public function show(Seizoen $seizoen): Response
    {
        return $this->render('seizoen/show.html.twig', [
            'seizoen' => $seizoen,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="seizoen_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Seizoen $seizoen): Response
    {
        $form = $this->createForm(SeizoenType::class, $seizoen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('seizoen_index');
        }

        return $this->render('seizoen/edit.html.twig', [
            'seizoen' => $seizoen,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="seizoen_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Seizoen $seizoen): Response
    {
        if ($this->isCsrfTokenValid('delete'.$seizoen->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($seizoen);
            $entityManager->flush();
        }

        return $this->redirectToRoute('seizoen_index');
    }
}
