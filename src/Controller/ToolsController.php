<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ToolsController extends AbstractController
{
    /**
     * @Route("/tools", name="tools")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Listagem de Ferramentas digitais',
            'path' => 'src/Controller/ToolsController.php',
        ]);
    }
}
