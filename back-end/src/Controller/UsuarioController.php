<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request    ;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Usuario;
use Doctrine\Persistence\ManagerRegistry;

class UsuarioController extends AbstractController
{
    #[Route('/usuario', name: 'criaUsuario', methods: ['POST'])]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();

        $usuario = new Usuario();
        $usuario->setNome($request->request->get('nome'));
        $usuario->setTelefone($request->request->get('telefone'));
        $usuario->setNascimento(new \DateTime($request->request->get('nascimento')));
        $usuario->setEmail($request->request->get('email'));
        $usuario->setSenha($request->request->get('senha'));
        $usuario->setCpf($request->request->get('cpf'));

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($usuario);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Usuário '.$usuario->getId().' salvo com sucesso');
    }

    #[Route('/usuarios', name: 'usuarios', methods: ['GET'])]
    public function index(ManagerRegistry $doctrine): Response
    {
        $ids = [];

        $usuarios = $doctrine->getRepository(Usuario::class)->findAll();

        for($i = 0; $i < sizeof($usuarios); $i++) {
            $ids[] = $usuarios[$i]->getId();
        }

        return new JsonResponse($ids);
    }

    #[Route('/usuario/{id}', name: 'usuario', methods: ['GET'])]
    public function show(ManagerRegistry $doctrine, int $id): Response
    {
        $usuario = $doctrine->getRepository(Usuario::class)->find($id);

        return $this->json([
            'id' => $usuario->getId(),
            'nome' => $usuario->getNome(),
            'telefone' => $usuario->getTelefone(),
            'nascimento' => $usuario->getNascimento(),
            'email' => $usuario->getEmail(),
            'senha' => $usuario->getSenha(),
            'cpf' => $usuario->getCpf(),
        ]);
    }
}
