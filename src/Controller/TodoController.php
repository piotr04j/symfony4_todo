<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\AddTask;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class TodoController extends AbstractController
{
    public function index(Request $request)
    {

        $form = $this->createForm(AddTask::class);
        $tasks= $this->getDoctrine()
            ->getRepository(Task::class)
            ->findAll();

        return $this->render('todo/list.html.twig', [
            'form' => $form->createView(),
            'tasks' => $tasks
        ]);

    }

    /**
     * @param Response $response
     */
    public function formHandler (Response $response)
    {

//        $form->handleRequest($request);
//        if ($form->isSubmitted()) {
//            $userData = $form->getData();
//            $task = new Task();
//            $task->setContent($userData['task']);
//            $task->setTodo(true);
//            $task->setWip(false);
//            $task->setDone(false);
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($task);
//            $em->flush();
//        }
//        $value = $request->request->get('task');
        $response->setContent('Hello World ');
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'text/html');
        $response->send();

    }
}