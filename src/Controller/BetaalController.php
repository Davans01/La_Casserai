<?php

namespace App\Controller;

use App\Entity\Betaal;
use App\Form\BetaalType;
use App\Repository\BetaalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/betaal")
 */
class BetaalController extends AbstractController
{
    /**
     * @Route("/", name="betaal_index", methods={"GET"})
     */
    public function index(BetaalRepository $betaalRepository): Response
    {
        return $this->render('betaal/index.html.twig', [
            'betaals' => $betaalRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="betaal_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $betaal = new Betaal();
        $form = $this->createForm(BetaalType::class, $betaal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($betaal);
            $entityManager->flush();

            return $this->redirectToRoute('betaal_index');
        }

        return $this->render('betaal/new.html.twig', [
            'betaal' => $betaal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="betaal_show", methods={"GET"})
     */
    public function show(Betaal $betaal): Response
    {
        return $this->render('betaal/show.html.twig', [
            'betaal' => $betaal,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="betaal_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Betaal $betaal): Response
    {
        $form = $this->createForm(BetaalType::class, $betaal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('betaal_index');
        }

        return $this->render('betaal/edit.html.twig', [
            'betaal' => $betaal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="betaal_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Betaal $betaal): Response
    {
        if ($this->isCsrfTokenValid('delete'.$betaal->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($betaal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('betaal_index');
    }
}
