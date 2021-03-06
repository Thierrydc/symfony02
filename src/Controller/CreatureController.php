<?php

namespace App\Controller;

use App\Entity\Creature;
use App\Form\CreatureAddType;
use App\Repository\CreatureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreatureController extends AbstractController
{
    /**
     * @Route("/creature", name="app_creature_index")
     */
    public function index(CreatureRepository $creatureRepository): Response
    {
        $creatures = $creatureRepository->findAll();

        return $this->render('creature/index.html.twig', [
            'creatures' => $creatures,
        ]);
    }

    /**
     * @Route("/creature/{id<\d+>}", name="app_creature_show")
     */
    public function show(CreatureRepository $creatureRepository, int $id): Response
    {
        $creature = $creatureRepository->find($id);

        return $this->render('creature/show.html.twig', [
            'creature' => $creature,
        ]);
    }

    /**
     * @Route("/creature/create", name="app_creature_create")
     * @Route("/creature/{id<\d+>}/update", name="app_creature_update")
     */
    public function update(Creature $creature = null, Request $request, EntityManagerInterface $em)
    {
        if (!$creature) {
            $form = $this->createForm(CreatureAddType::class);
            $creature = new Creature();
        } else {
            $form = $this->createForm(CreatureAddType::class, $creature);
        }

        $form->handleRequest($request);git 
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($creature);
            $em->flush();

            return $this->redirectToRoute('app_creature_index');
        }

        return $this->render('creature/update.html.twig', [
            'creature' => $creature,
            'form' => $form->createView(),
            'isModification' => null !== $creature->getId(),
        ]);
    }
}
