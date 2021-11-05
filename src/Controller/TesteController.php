<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TesteController extends AbstractController
{
    public function index(int $max, \Twig\Environment $twig): Response
    {
        $number = random_int(0, $max);

        $content = $twig->render('teste/index.html.twig',[
            "number" => $number
        ]);

        return new Response($content);
    }

    public function show(\Twig\Environment $twig)
    {
        $content = $twig->render('teste/show.html.twig',
            [
                "escola" => "treinaweb",
                "cursos" => [
                    0 => ["name" => "Laravel"],
                    1 => ["name" => "Symfony"],
                    2 => ["name" => "Phalcon"]
                ]
            ]
        );
        return new Response($content);
    }
}
