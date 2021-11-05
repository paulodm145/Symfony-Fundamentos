<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class ClienteController extends AbstractController
{
    /**
     * @Route("/cliente", name="cliente")
     */
    public function index(Request $request): Response
    {
        echo "<pre>";

        print_r( $request->query->get('pessoa')['telefone']);
        exit;

        return $this->render('cliente/index.html.twig', [
            'controller_name' => 'ClienteController',
        ]);
        //print_r( $request->query->all() );
        //print_r( $request->query->get('cor') );
        //print_r( $request->query->get('teste', 'Azul') ); parametro padrao
        //cliente?pessoa[nome]=Pedro&pessoa[idade]=23&pessoa[cpf]=10163364702
        //print_r( $request->query->all() );
    }
}
