<?php

namespace App\Controller;

use App\Entity\Tarefa;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class TarefasController extends AbstractController
{
    /**
     * @Route("/tarefas", name="tarefas")
     */
    public function index(): Response
    {
        $entityManager = $this->getDoctrine()->getManager()->getRepository(Tarefa::class);
        $tarefas = $entityManager->findAll();
        return $this->render('tarefas/index.html.twig',['tarefas' => $tarefas]);    
    }

    public function update(Tarefa $tarefa)
    {
        return $this->render('tarefas/edit.html.twig',[ 'tarefa' => $tarefa ]);
    }

    public function delete(Tarefa $tarefa)
    {
        $entity = $this->getDoctrine()->getManager();
        $entity->remove($tarefa);
        $entity->flush();
        return $this->redirectToRoute('index');
    }

    public function edit(Request $request, Tarefa $tarefa)
    {
        if ( $request->isMethod("POST") ) {
            $tarefa->setTitle( $request->request->get('title') );
            $tarefa->setDescricao( $request->request->get('descricao') );
            $tarefa->setData( new DateTime() );
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('tarefas_show', ["id" => $tarefa->getId()]);
        }
    }

    /**
     * Inserir uma Tarefa
     * 
     * @return void
     */
    public function store(Request $request)
    {
        $isToken = $this->isCsrfTokenValid( 'cadastro_tarefas', $request->request->get('_token') );

        if ( $request->isMethod("POST") && $isToken) {

            $tarefa = new Tarefa;
            $rand_number = mt_rand(1,1000);

            $tarefa->setTitle( ($request->request->get('title') != "" ? $request->request->get('title').' - '.$rand_number : false) );
            $tarefa->setDescricao( $request->request->get('descricao') );
            $tarefa->setData( new DateTime() );
            $entity = $this->getDoctrine()->getManager();
            $entity->persist($tarefa);
            $entity->flush();

            return $this->redirectToRoute('tarefas_show', ["id" => $tarefa->getId()]);
        }


        /*
        echo "<pre>";
        print_r(
            $request->get("123")
            $request->attributes->get("_controller")
        );
        exit; 
        */

        // echo "<pre>";
        // print_r(
        //     $request->server->all()
        // );
        // exit;

        /**
        * $request->headers->get('content-type');
        */

        /*var_dump(
            $request->request->all()
        );
        return new Response(""); */
       
        //$url = $this->generateUrl('tarefas_show', ["id" => $tarefa->getId()]);
        //return new RedirectResponse($url);
        //return $this->redirect($url);
        //return  new Response( 'Registro Criado com sucesso !'. $tarefa->getTitle() );
    }

    public function new()
    {
        return $this->render("tarefas/novo.html.twig");
    }

    /** parameter converter */
    public function show(Tarefa $tarefa)
    {
        /* $tarefa = $this->getDoctrine()->getManager()->getRepository(Tarefa::class)->find($id);
        if ( !$tarefa ) { 
            throw $this->createNotFoundException('Tarefa não encontrada');
        }
        */
        return $this->render('tarefas/show.html.twig',[ 'tarefa' => $tarefa ]);
    }
}
