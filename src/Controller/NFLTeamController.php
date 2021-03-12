<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\NFLTeam;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NFLTeamController extends AbstractController
{
    /**
     * @Route("/nfl-team", name="nfl_team")
     */
    public function index(): Response
    {
        $teams = $this->getDoctrine()->getRepository(NFLTeam::class)->findAll();

        return $this->render('nfl_team/index.html.twig', [
            'teams' => $teams,
        ]);
    }
}
